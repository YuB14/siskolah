<?php
// Panggil koneksi database
require_once './library/koneksi.php';

// Pastikan parameter id_nilai dikirimkan melalui URL
if (!isset($_GET['id_nilai'])) {
    // Jika tidak ada id_nilai, kembalikan ke halaman utama
    header('Location: nilai-siswa-x-a.php?status=error');
    exit;
}

$id_nilai = mysqli_real_escape_string($koneksi, $_GET['id_nilai']);

// Cek apakah data dengan id tersebut ada di tabel
$cek = mysqli_query($koneksi, "SELECT id_nilai FROM nilai_siswa WHERE id_nilai = '$id_nilai'");

if (mysqli_num_rows($cek) > 0) {
    // Hapus data dari tabel nilai_siswa
    $hapus = mysqli_query($koneksi, "DELETE FROM nilai_siswa WHERE id_nilai = '$id_nilai'");

    if ($hapus) {
        // Jika berhasil dihapus, kembali ke halaman utama dengan pesan sukses
        header('Location: nilai-siswa-x-a.php?status=deleted');
        exit;
    } else {
        // Jika gagal menghapus (misal karena foreign key constraint)
        header('Location: nilai-siswa-x-a.php?status=delete_failed');
        exit;
    }
} else {
    // Jika data tidak ditemukan
    header('Location: nilai-siswa-x-a.php?status=not_found');
    exit;
}
?>
