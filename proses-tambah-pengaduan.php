<?php
require_once "./library/koneksi.php";

// Ambil data dari form
$nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
$tanggal_pengaduan = $_POST['tanggal_pengaduan'];
$judul= mysqli_real_escape_string($koneksi, $_POST['judul']);
$isi_pengaduan = mysqli_real_escape_string($koneksi, $_POST['isi_pengaduan']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']); // biasanya "Diajukan"



// Validasi: pastikan semua data wajib terisi
if (empty($nisn) || empty($tanggal_pengaduan) || empty($judul) || empty($isi_pengaduan)) {
    echo "<script>alert('Semua field wajib diisi!'); window.location='tambah-pengaduan.php';</script>";
    exit;
}

// Cek apakah NISN valid (terdaftar di tabel siswa)
$cekSiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
if (mysqli_num_rows($cekSiswa) == 0) {
    echo "<script>alert('NISN tidak ditemukan dalam data siswa!'); window.location='tambah-pengaduan.php';</script>";
    exit;
}

$sql = "INSERT INTO pengaduan_siswa (nisn, tanggal_pengaduan, judul, isi_pengaduan, status)
        VALUES ('$nisn', '$tanggal_pengaduan', '$judul', '$isi_pengaduan', '$status')";

if (mysqli_query($koneksi, $sql)) {
    echo header('Location: pengaduan.php?status=added');
} else {
    echo "<script>
            alert('Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi) . "');
            window.location='tambah-pengaduan.php';
          </script>";
}
?>
