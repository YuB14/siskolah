<?php
require_once './library/koneksi.php';

// Pastikan form dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    header('Location: guru-mapel.php');
    exit;
}

// Ambil data dari form
$id_guru_mapel = $_POST['id_guru_mapel'] ?? '';
$id_mapel = $_POST['id_mapel'] ?? '';
$nip = $_POST['nip'] ?? '';

// Validasi input
if (empty($id_guru_mapel) || empty($id_mapel) || empty($nip)) {
    echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
    exit;
}

// Escape data untuk keamanan
$id_guru_mapel = mysqli_real_escape_string($koneksi, $id_guru_mapel);
$id_mapel = mysqli_real_escape_string($koneksi, $id_mapel);
$nip = mysqli_real_escape_string($koneksi, $nip);

// Update data
$updateSQL = "UPDATE guru_mapel SET id_mapel='$id_mapel', nip='$nip' WHERE id_guru_mapel='$id_guru_mapel'";

if (mysqli_query($koneksi, $updateSQL)) {
    // Redirect jika berhasil
    header('Location: guru-mapel.php?status=updated');
    exit;
} else {
    // Tampilkan error jika gagal
    $error = "Gagal update data: " . mysqli_error($koneksi);
    echo "<script>alert('$error'); window.history.back();</script>";
    exit;
}
?>
