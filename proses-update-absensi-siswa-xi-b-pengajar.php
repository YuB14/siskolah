<?php
require_once "./library/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_absensi = mysqli_real_escape_string($koneksi, $_POST['id_absensi']);
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']); // pastikan field ini tersedia
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    // Cek apakah absensi lain di tanggal yang sama sudah ada
    $cek = mysqli_query($koneksi, "
        SELECT id_absensi 
        FROM absensi_siswa
        WHERE nisn = '$nisn'
          AND tanggal = '$tanggal'
          AND id_absensi != '$id_absensi'
        LIMIT 1
    ");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
                alert('Gagal! Siswa ini sudah memiliki absensi pada tanggal tersebut.');
                window.history.back();
              </script>";
        exit;
    }

    // Jika aman → update
    $query = mysqli_query($koneksi, "
        UPDATE absensi_siswa 
        SET 
            tanggal = '$tanggal',
            status = '$status',
            keterangan = '$keterangan'
        WHERE id_absensi = '$id_absensi'
    ");

    if ($query) {
        header("Location: absensi-siswa-xi-b-pengajar.php?status=updated");
    } else {
        echo "<script>
                alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }
}
?>