<?php
require_once "./library/koneksi.php";

// Ambil data dari form
$nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
$tanggal = $_POST['tanggal'];
$jenis= mysqli_real_escape_string($koneksi, $_POST['jenis']);
$isi = mysqli_real_escape_string($koneksi, $_POST['isi']);



// Validasi: pastikan semua data wajib terisi
if (empty($nisn) || empty($tanggal) || empty($jenis) || empty($isi)) {
    echo "<script>alert('Semua field wajib diisi!'); window.location='tambah-kritik-saran.php';</script>";
    exit;
}

// Cek apakah NISN valid (terdaftar di tabel siswa)
$cekSiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
if (mysqli_num_rows($cekSiswa) == 0) {
    echo "<script>alert('NISN tidak ditemukan dalam data siswa!'); window.location='tambah-kritik-saran.php';</script>";
    exit;
}

$sql = "INSERT INTO kritik_saran (nisn, tanggal, jenis, isi)
        VALUES ('$nisn', '$tanggal', '$jenis', '$isi')";

if (mysqli_query($koneksi, $sql)) {
    echo header('Location: kritik-saran.php?status=added');
} else {
    echo "<script>
            alert('Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi) . "');
            window.location='tambah-kritik-saram.php';
          </script>";
}
?>
