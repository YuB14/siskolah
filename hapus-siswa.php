<?php
require_once "./library/koneksi.php";

if (isset($_GET['nisn'])) {
    $nisn = mysqli_real_escape_string($koneksi, $_GET['nisn']);
    $query = "DELETE FROM siswa WHERE nisn = '$nisn'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: biodata-siswa.php?status=deleted");
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: biodata-siswa.php");
    exit;
}
?>
