<?php
require_once "./library/koneksi.php";

if (!isset($_POST['update'])) {
    header('Location: biodata-siswa.php');
    exit;
}

$nisn_lama = $_POST['nisn_lama']; // kunci lama
$nisn = $_POST['nisn'];
$nama_lengkap = $_POST['nama_lengkap'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$id_kelas = $_POST['id_kelas'];
$tanggal_masuk = $_POST['tanggal_masuk'];
$status = $_POST['status'];
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validasi dasar (opsional) ...

// Jika password tidak kosong -> hash dan sertakan di update, jika kosong -> jangan update password
if ($password !== '') {
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE siswa SET nisn=?, nama_lengkap=?, jenis_kelamin=?, tanggal_lahir=?, alamat=?, no_hp=?, email=?, id_kelas=?, tanggal_masuk=?, status=?, password=? WHERE nisn=?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssss",
        $nisn, $nama_lengkap, $jenis_kelamin, $tanggal_lahir, $alamat, $no_hp, $email, $id_kelas, $tanggal_masuk, $status, $password_hashed, $nisn_lama
    );
} else {
    // tanpa password
    $sql = "UPDATE siswa SET nisn=?, nama_lengkap=?, jenis_kelamin=?, tanggal_lahir=?, alamat=?, no_hp=?, email=?, id_kelas=?, tanggal_masuk=?, status=? WHERE nisn=?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssss",
        $nisn, $nama_lengkap, $jenis_kelamin, $tanggal_lahir, $alamat, $no_hp, $email, $id_kelas, $tanggal_masuk, $status, $nisn_lama
    );
}

if (mysqli_stmt_execute($stmt)) {
    // sukses
    header('Location: biodata-siswa.php?status=updated');
} else {
    // error
    header('Location: edit-siswa.php?nisn='.$nisn_lama.'&msg=error');
}
exit;
?>
