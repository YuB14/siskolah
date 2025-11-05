<?php
require_once "./library/koneksi.php"; // pastikan $koneksi adalah objek mysqli

// Fungsi bantu menampilkan alert JS dan kembali
function js_alert_back($message) {
    echo "<script>alert(" . json_encode($message) . "); window.history.back();</script>";
    exit;
}

// Pastikan form dikirim lewat POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: tambah-jadwal-mata-pelajaran-x-a.php");
    exit;
}

// Ambil dan trim input
$id_jadwal   = isset($_POST['id_jadwal']) ? trim($_POST['id_jadwal']) : '';
$hari        = isset($_POST['hari']) ? trim($_POST['hari']) : '';
$id_mapel    = isset($_POST['id_mapel']) ? trim($_POST['id_mapel']) : '';
$nip         = isset($_POST['nip']) ? trim($_POST['nip']) : '';
$id_kelas    = isset($_POST['id_kelas']) ? trim($_POST['id_kelas']) : '';
$jam_mulai   = isset($_POST['jam_mulai']) ? trim($_POST['jam_mulai']) : '';
$jam_selesai = isset($_POST['jam_selesai']) ? trim($_POST['jam_selesai']) : '';

// Basic required validation
if ($id_jadwal === '' || $hari === '' || $id_mapel === '' || $nip === '' || $id_kelas === '' || $jam_mulai === '' || $jam_selesai === '') {
    js_alert_back('Semua field wajib diisi.');
}

// Validasi format waktu HH:MM (24 jam)
$timePattern = '/^([01]\d|2[0-3]):[0-5]\d$/';
if (!preg_match($timePattern, $jam_mulai) || !preg_match($timePattern, $jam_selesai)) {
    js_alert_back('Format waktu tidak valid. Gunakan format HH:MM (24 jam).');
}

// Pastikan jam_selesai > jam_mulai (gunakan DateTime untuk robust)
$dtMulai = DateTime::createFromFormat('H:i', $jam_mulai);
$dtSelesai = DateTime::createFromFormat('H:i', $jam_selesai);
if (!$dtMulai || !$dtSelesai) {
    js_alert_back('Waktu tidak bisa diproses. Periksa kembali format.');
}
if ($dtSelesai <= $dtMulai) {
    js_alert_back('Jam selesai harus lebih besar dari jam mulai.');
}

// ===== Cek bentrok jadwal di database (hari + kelas yang sama) =====
// Kita gunakan prepared statement dan kondisi overlap yang komprehensif
$cekSql = "
    SELECT id_jadwal, jam_mulai, jam_selesai
    FROM jadwal_mapel
    WHERE hari = ?
      AND id_kelas = ?
      AND (
          (jam_mulai <= ? AND jam_selesai > ?)          -- mulai baru di dalam jadwal lama
          OR
          (jam_mulai < ? AND jam_selesai >= ?)          -- selesai baru di dalam jadwal lama
          OR
          (? <= jam_mulai AND ? > jam_mulai)            -- jadwal lama mulai di dalam jadwal baru
          OR
          (jam_mulai = ?)                                -- jam mulai persis sama
          OR
          (jam_selesai = ?)                              -- jam selesai persis sama
      )
    LIMIT 1
";

if ($stmt = $koneksi->prepare($cekSql)) {
    // urutan parameter sesuai ? di query
    // 1: hari
    // 2: id_kelas
    // 3: jam_mulai
    // 4: jam_mulai
    // 5: jam_selesai
    // 6: jam_selesai
    // 7: jam_mulai
    // 8: jam_selesai
    // 9: jam_mulai
    // 10: jam_selesai
    $stmt->bind_param(
        'ssssssssss',
        $hari,
        $id_kelas,
        $jam_mulai,
        $jam_mulai,
        $jam_selesai,
        $jam_selesai,
        $jam_mulai,
        $jam_selesai,
        $jam_mulai,
        $jam_selesai
    );

    if (!$stmt->execute()) {
        $stmt->close();
        js_alert_back('Gagal memeriksa jadwal: ' . $koneksi->error);
    }

    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        // Jika ditemukan jadwal bentrok
        $row = $result->fetch_assoc();
        $existing_start = $row['jam_mulai'];
        $existing_end   = $row['jam_selesai'];
        $stmt->close();
        js_alert_back("Jadwal bentrok dengan jadwal lain ($existing_start - $existing_end) pada hari yang sama.");
    }
    $stmt->close();
} else {
    js_alert_back('Gagal menyiapkan query pemeriksaan: ' . $koneksi->error);
}

// ===== Jika tidak bentrok, lakukan INSERT =====
$insertSql = "
    INSERT INTO jadwal_mapel (id_jadwal, hari, id_mapel, nip, id_kelas, jam_mulai, jam_selesai)
    VALUES (?, ?, ?, ?, ?, ?, ?)
";

if ($stmt2 = $koneksi->prepare($insertSql)) {
    $stmt2->bind_param(
        'sssssss',
        $id_jadwal,
        $hari,
        $id_mapel,
        $nip,
        $id_kelas,
        $jam_mulai,
        $jam_selesai
    );

    if ($stmt2->execute()) {
        $stmt2->close();
        // Redirect ke halaman daftar dengan status sukses
        header("Location: jadwal-mata-pelajaran-x-a.php?status=added");
        exit;
    } else {
        $err = $stmt2->error ?: $koneksi->error;
        $stmt2->close();
        js_alert_back('Gagal menambahkan jadwal: ' . $err);
    }
} else {
    js_alert_back('Gagal mempersiapkan query insert: ' . $koneksi->error);
}