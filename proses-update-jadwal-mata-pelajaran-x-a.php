<?php
require_once "./library/koneksi.php"; // Pastikan $koneksi adalah objek mysqli

// Fungsi bantu untuk menampilkan alert JS dan kembali
function js_alert_back($message) {
    echo "<script>alert(" . json_encode($message) . "); window.history.back();</script>";
    exit;
}

// Pastikan form dikirim lewat POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: jadwal-mata-pelajaran-x-a.php");
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

// Normalisasi jam agar selalu dalam format HH:MM
$jam_mulai   = date('H:i', strtotime($jam_mulai));
$jam_selesai = date('H:i', strtotime($jam_selesai));

// Validasi wajib isi
if ($id_jadwal === '' || $hari === '' || $id_mapel === '' || $nip === '' || $id_kelas === '' || $jam_mulai === '' || $jam_selesai === '') {
    js_alert_back('Semua field wajib diisi.');
}

// Validasi format waktu HH:MM (24 jam)
$timePattern = '/^([01]\d|2[0-3]):[0-5]\d$/';
if (!preg_match($timePattern, $jam_mulai) || !preg_match($timePattern, $jam_selesai)) {
    js_alert_back('Format waktu tidak valid. Gunakan format HH:MM (24 jam).');
}

// Pastikan jam selesai > jam mulai
$dtMulai = DateTime::createFromFormat('H:i', $jam_mulai);
$dtSelesai = DateTime::createFromFormat('H:i', $jam_selesai);
if (!$dtMulai || !$dtSelesai) {
    js_alert_back('Waktu tidak bisa diproses. Periksa kembali format.');
}
if ($dtSelesai <= $dtMulai) {
    js_alert_back('Jam selesai harus lebih besar dari jam mulai.');
}

// ===== Cek bentrok jadwal lain di database (hari + kelas yang sama) =====
// Tidak menghitung dirinya sendiri (id_jadwal berbeda)
$cekSql = "
    SELECT id_jadwal, jam_mulai, jam_selesai
    FROM jadwal_mapel
    WHERE hari = ?
      AND id_kelas = ?
      AND id_jadwal <> ?
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
    $stmt->bind_param(
        'sssssssssss',
        $hari,
        $id_kelas,
        $id_jadwal,
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
        $row = $result->fetch_assoc();
        $stmt->close();
        js_alert_back("Jadwal bentrok dengan jadwal lain (" . $row['jam_mulai'] . " - " . $row['jam_selesai'] . ") pada hari yang sama.");
    }
    $stmt->close();
} else {
    js_alert_back('Gagal menyiapkan query pemeriksaan: ' . $koneksi->error);
}

// ===== Jika tidak bentrok, lakukan UPDATE =====
$updateSql = "
    UPDATE jadwal_mapel
    SET hari = ?, id_mapel = ?, nip = ?, id_kelas = ?, jam_mulai = ?, jam_selesai = ?
    WHERE id_jadwal = ?
";

if ($stmt2 = $koneksi->prepare($updateSql)) {
    $stmt2->bind_param(
        'sssssss',
        $hari,
        $id_mapel,
        $nip,
        $id_kelas,
        $jam_mulai,
        $jam_selesai,
        $id_jadwal
    );

    if ($stmt2->execute()) {
        $stmt2->close();
        header("Location: jadwal-mata-pelajaran-x-a.php?status=updated");
        exit;
    } else {
        $err = $stmt2->error ?: $koneksi->error;
        $stmt2->close();
        js_alert_back('Gagal memperbarui jadwal: ' . $err);
    }
} else {
    js_alert_back('Gagal mempersiapkan query update: ' . $koneksi->error);
}
?>