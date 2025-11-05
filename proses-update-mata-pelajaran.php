<?php
require_once './library/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Ambil data dari form
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $nama_mapel = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);

    // Cek apakah nama_mapel kosong
    if (empty($nama_mapel)) {
        echo "<script>alert('Nama Mata Pelajaran tidak boleh kosong!');window.history.back();</script>";
        exit;
    }

    // Update data mata pelajaran
    $updateSQL = "UPDATE mata_pelajaran 
                  SET nama_mapel = '$nama_mapel' 
                  WHERE id_mapel = '$id_mapel'";

    if (mysqli_query($koneksi, $updateSQL)) {
        // Redirect ke halaman mata-pelajaran.php dengan status sukses
        header('Location: mata-pelajaran.php?status=updated');
        exit;
    } else {
        // Jika gagal, tampilkan error
        $error = mysqli_error($koneksi);
        echo "<script>alert('Gagal update data: $error');window.history.back();</script>";
        exit;
    }
} else {
    // Jika diakses langsung tanpa POST
    header('Location: mata-pelajaran.php');
    exit;
}
?>
