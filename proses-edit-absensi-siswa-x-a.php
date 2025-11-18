<?php
require_once "./library/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_absensi = mysqli_real_escape_string($koneksi, $_POST['id_absensi']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    // Jalankan query update
    $query = mysqli_query($koneksi, "
        UPDATE absensi_siswa 
        SET 
            tanggal = '$tanggal',
            status = '$status',
            keterangan = '$keterangan'
        WHERE id_absensi = '$id_absensi'
    ");

    // Cek hasil
    if ($query) {
        echo "<script>
                alert('Data absensi berhasil diperbarui!');
                window.location='absensi-siswa.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }
}
?>
