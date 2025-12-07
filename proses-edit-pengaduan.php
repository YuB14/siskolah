<?php
require_once "./library/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tanggal_pengaduan = $_POST['tanggal_pengaduan'];
    $judul = $_POST['judul'];
    $isi_pengaduan = $_POST['isi_pengaduan'];
    $status = $_POST['status'];

    $query = mysqli_query($koneksi, "UPDATE pengaduan_siswa
        SET tanggal_pengaduan='$tanggal_pengaduan', 
            judul='$judul', 
            isi_pengaduan='$isi_pengaduan', 
            status='$status' 
        WHERE id_pengaduan='$id_pengaduan'");

    if ($query) {
       header("Location: pengaduan.php?status=updated");
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui data!'); window.history.back();</script>";
    }
}
?>
