<?php
require_once './library/koneksi.php';

// Pastikan request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Akses tidak valid!');window.location='kelas-admin.php';</script>";
    exit;
}

$id_kelas   = $_POST['id_kelas'] ?? '';
$nama_kelas = $_POST['nama_kelas'] ?? '';
$nip        = $_POST['nip'] ?? '';

// Validasi data wajib
if (empty($id_kelas) || empty($nama_kelas) || empty($nip)) {
    echo "<script>alert('Semua field wajib diisi!');window.history.back();</script>";
    exit;
}

/* ============================================================
   CEK APAKAH NIP SUDAH MENJADI WALI KELAS DI KELAS LAIN
   ============================================================ */

$cek = $koneksi->prepare("
    SELECT id_kelas 
    FROM kelas 
    WHERE nip = ? AND id_kelas != ?
    LIMIT 1
");
$cek->bind_param("ss", $nip, $id_kelas);
$cek->execute();
$hasil = $cek->get_result();

if ($hasil->num_rows > 0) {
    echo "<script>
        alert('Gagal! Guru ini sudah menjadi wali kelas di kelas lain.');
        window.history.back();
    </script>";
    exit;
}
$cek->close();

/* ============================================================
   PROSES UPDATE KELAS
   ============================================================ */

$stmt = $koneksi->prepare("
    UPDATE kelas 
    SET nama_kelas = ?, nip = ?
    WHERE id_kelas = ?
");
$stmt->bind_param("sss", $nama_kelas, $nip, $id_kelas);

if ($stmt->execute()) {
    header("Location: kelas-admin.php?status=updated");
} else {
    echo "<script>alert('Gagal memperbarui data: " . addslashes($stmt->error) . "');window.history.back();</script>";
}

$stmt->close();
$koneksi->close();
?>