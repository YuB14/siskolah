<?php
require_once "./library/koneksi.php";

// Pastikan parameter ada
if (!isset($_GET['nama_mapel'])) {
    echo "<script>alert('Parameter tidak ditemukan!'); window.location.href='guru-mapel.php';</script>";
    exit;
}

$nama_mapel = $_GET['nama_mapel'];

// Ambil id_mapel dari nama_mapel
$sql_mapel = "SELECT id_mapel FROM mata_pelajaran WHERE nama_mapel = ?";
$stmt_mapel = mysqli_prepare($koneksi, $sql_mapel);
mysqli_stmt_bind_param($stmt_mapel, "s", $nama_mapel);
mysqli_stmt_execute($stmt_mapel);
$result_mapel = mysqli_stmt_get_result($stmt_mapel);

if (mysqli_num_rows($result_mapel) == 0) {
    echo "<script>alert('Data mata pelajaran tidak ditemukan!'); window.location.href='guru-mapel.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($result_mapel);
$id_mapel = $row['id_mapel'];

// Hapus data guru_mapel berdasarkan id_mapel
$sql_delete = "DELETE FROM guru_mapel WHERE id_mapel = ?";
$stmt_delete = mysqli_prepare($koneksi, $sql_delete);
mysqli_stmt_bind_param($stmt_delete, "s", $id_mapel);

if (mysqli_stmt_execute($stmt_delete)) {
    header('Location: guru-mapel.php?status=deleted');
} else {
    echo "<script>
        alert('Gagal menghapus data guru mapel!');
        window.location.href='guru-mapel.php';
    </script>";
}

mysqli_stmt_close($stmt_delete);
mysqli_close($koneksi);
?>
