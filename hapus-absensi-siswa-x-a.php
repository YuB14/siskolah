<?php
require_once "./library/koneksi.php";

if (isset($_GET['id_absensi'])) {
    $id_absensi = mysqli_real_escape_string($koneksi, $_GET['id_absensi']);

    $query = "DELETE FROM absensi_siswa WHERE id_absensi = '$id_absensi'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Data absensi berhasil dihapus!');
                window.location='absensi-siswa.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location='absensi-siswa.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID Absensi tidak ditemukan!');
            window.location='absensi-siswa.php';
          </script>";
}
?>
