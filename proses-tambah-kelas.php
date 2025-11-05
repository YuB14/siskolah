<?php
require_once './library/koneksi.php';

// Pastikan ada parameter id_kelas
if (!isset($_GET['id_kelas'])) {
    echo "<script>alert('ID Kelas tidak ditemukan!');window.location='kelas.php';</script>";
    exit;
}

$id_kelas = $_GET['id_kelas'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = trim($_POST['nama_kelas']);
    $nip = $_POST['nip'];

    // 1️⃣ Cek apakah nama_kelas sudah dipakai kelas lain
    $cek = $koneksi->prepare("SELECT COUNT(*) FROM kelas WHERE nama_kelas = ? AND id_kelas != ?");
    $cek->bind_param("ss", $nama_kelas, $id_kelas);
    $cek->execute();
    $cek->bind_result($jumlah);
    $cek->fetch();
    $cek->close();

    if ($jumlah > 0) {
        echo "<script>alert('Nama kelas \"$nama_kelas\" sudah digunakan oleh kelas lain!');window.location='proses-update-kelas.php?id_kelas=$id_kelas';</script>";
        exit;
    }

    // 2️⃣ Jika aman, lakukan update
    $update = $koneksi->prepare("UPDATE kelas SET nama_kelas = ?, nip = ? WHERE id_kelas = ?");
    $update->bind_param("sss", $nama_kelas, $nip, $id_kelas);

    if ($update->execute()) {
        echo "<script>alert('Data kelas berhasil diperbarui!');window.location='kelas.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . addslashes($koneksi->error) . "');</script>";
    }

    $update->close();
}
?>
