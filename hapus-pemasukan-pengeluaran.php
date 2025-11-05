<?php
require_once './library/koneksi.php';

// Pastikan parameter id_keuangan ada di URL
if (!isset($_GET['id_keuangan'])) {
    header('Location: pemasukan-pengeluaran.php');
    exit;
}

$id_keuangan = $_GET['id_keuangan'];

// Cek apakah data dengan id_keuangan ini ada di database
$cek = mysqli_query($koneksi, "SELECT * FROM keuangan WHERE id_keuangan = '$id_keuangan'");
if (mysqli_num_rows($cek) === 0) {
    // Jika data tidak ditemukan, kembalikan ke halaman utama dengan pesan error
    header('Location: pemasukan-pengeluaran.php?status=notfound');
    exit;
}

// Hapus data dari tabel keuangan
$query = mysqli_query($koneksi, "DELETE FROM keuangan WHERE id_keuangan = '$id_keuangan'");

// Cek hasil eksekusi query
if ($query) {
    header('Location: pemasukan-pengeluaran.php?status=deleted');
    exit;
} else {
    // Jika gagal, arahkan dengan status gagal
    header('Location: pemasukan-pengeluaran.php?status=error');
    exit;
}
?>
