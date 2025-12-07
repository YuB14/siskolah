<?php
require_once './library/koneksi.php';

// Pastikan parameter NISN diterima
if (!isset($_GET['nisn']) || $_GET['nisn'] == '') {
    header("Location: biodata-siswa-admin.php?status=error");
    exit();
}

$nisn = mysqli_real_escape_string($koneksi, $_GET['nisn']);

// Ambil data siswa untuk cek foto
$query = mysqli_query($koneksi, "SELECT foto FROM siswa WHERE nisn='$nisn'");
$data  = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    header("Location: biodata-siswa-admin.php?status=error");
    exit();
}

// Hapus foto jika ada
if (!empty($data['foto'])) {
    $filePath = "uploads/foto-siswa/" . $data['foto'];
    if (file_exists($filePath)) {
        unlink($filePath); // Hapus file foto
    }
}

// Hapus data siswa dari database
$delete = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn='$nisn'");

if ($delete) {
    header("Location: biodata-siswa-admin.php?status=deleted");
} else {
    header("Location: biodata-siswa-admin.php?status=error");
}

exit();
?>