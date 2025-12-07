<?php
require_once './library/koneksi.php';

// Pastikan parameter NIP diterima
if (!isset($_GET['nip']) || $_GET['nip'] == '') {
    header("Location: biodata-guru-admin.php?status=error");
    exit();
}

$nip = mysqli_real_escape_string($koneksi, $_GET['nip']);

// Ambil data guru untuk cek foto
$query = mysqli_query($koneksi, "SELECT foto FROM guru WHERE nip='$nip'");
$data  = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    header("Location: biodata-guru-admin.php?status=error");
    exit();
}

// Hapus foto jika ada
if (!empty($data['foto'])) {
    $filePath = "uploads/foto-guru/" . $data['foto'];
    if (file_exists($filePath)) {
        unlink($filePath); // Hapus file foto
    }
}

// Hapus data guru dari database
$delete = mysqli_query($koneksi, "DELETE FROM guru WHERE nip='$nip'");

if ($delete) {
    header("Location: biodata-guru-admin.php?status=deleted");
} else {
    header("Location: biodata-guru-admin.php?status=error");
}

exit();
?>