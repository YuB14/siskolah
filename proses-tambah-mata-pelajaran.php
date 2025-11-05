<?php
// Memanggil koneksi database
require_once "./library/koneksi.php";

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);

    // Validasi input
    if (empty($nama_mapel)) {
        echo "<script>alert('Nama Mata Pelajaran tidak boleh kosong!');window.history.back();</script>";
        exit;
    }

    // Cek apakah nama_mapel sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran WHERE nama_mapel = '$nama_mapel'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Nama Mata Pelajaran sudah ada!');window.history.back();</script>";
        exit;
    }

    // Insert data ke tabel mata_pelajaran
    $insert = mysqli_query($koneksi, "INSERT INTO mata_pelajaran (id_mapel, nama_mapel) VALUES ('$id_mapel', '$nama_mapel')");

    if ($insert) {
        echo header('Location: mata-pelajaran.php?status=added');    
    } else {
        echo "<script>alert('Gagal menambahkan data!');window.history.back();</script>";
    }
} else {
    // Jika langsung akses file ini tanpa submit form
    header('Location: mata-pelajaran.php');
    exit;
}
?>
