<?php
session_start();

// Cek login guru pengajar
if (!isset($_SESSION['guru_login'])) {
    header("Location: login-guru.html");
    exit;
}

if ($_SESSION['guru_jabatan'] !== 'Pengajar') {
    header("Location: login-guru.html");
    exit;
}

// Memanggil koneksi
include('./library/koneksi.php');

// Pastikan id_absensi ada di URL
if (isset($_GET['id_absensi'])) {
    $id_absensi = intval($_GET['id_absensi']);

    // Query hapus
    $sql = "DELETE FROM absensi_siswa WHERE id_absensi = '$id_absensi'";

    if (mysqli_query($koneksi, $sql)) {
        // Jika berhasil, kembalikan ke halaman utama
        header("Location: absensi-siswa-xi-b-pengajar.php?status=deleted");
        exit;
    } else {
        // Jika gagal
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location.href = 'absensi-siswa-xi-b-pengajar.php';
              </script>";
    }

} else {
    // Jika tidak ada id_absensi
    echo "<script>
            alert('ID Absensi tidak ditemukan.');
            window.location.href = 'absensi-siswa-xi-b-pengajar.php';
          </script>";
}
?>
