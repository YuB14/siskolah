<?php
require_once './library/koneksi.php';

// Pastikan form disubmit melalui POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil data dari form
    $id_mapel    = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $nama_mapel  = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);
    $nip         = mysqli_real_escape_string($koneksi, $_POST['nip']);

    // Validasi sederhana
    if (empty($id_mapel) || empty($nama_mapel) || empty($nip)) {
        header("Location: mata-pelajaran-admin.php?status=empty");
        exit;
    }

    // Query UPDATE
    $sql = "
        UPDATE mata_pelajaran SET
            nama_mapel = '$nama_mapel',
            nip        = '$nip'
        WHERE id_mapel = '$id_mapel'
    ";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        header("Location: mata-pelajaran-admin.php?status=updated");
        exit;
    } else {
        echo "Gagal update data: " . mysqli_error($koneksi);
        exit;
    }

} else {
    // Jika tidak melalui POST, redirect
    header("Location: mata-pelajaran-admin.php");
    exit;
}
?>