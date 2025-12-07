<?php
require_once "./library/koneksi.php";

if (isset($_POST['nisn']) && isset($_POST['status'])) {
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    foreach ($_POST['nisn'] as $nisn) {

        // Cek apakah sudah absen hari ini
        $cek = mysqli_query($koneksi, "
            SELECT * FROM absensi_siswa 
            WHERE nisn = '$nisn' 
              AND tanggal = '$tanggal'
            LIMIT 1
        ");

        if (mysqli_num_rows($cek) > 0) {
            // Jika sudah absen → skip & jangan insert
            continue;
        }

        // Jika belum → insert absen hari ini
        mysqli_query($koneksi, "
            INSERT INTO absensi_siswa (nisn, tanggal, status, keterangan)
            VALUES ('$nisn', '$tanggal', '$status', '$keterangan')
        ");
    }

    header('Location: absensi-siswa-xii-a-pengajar.php?status=added');
    exit;
} else {
    echo "<script>
        alert('Silakan pilih minimal satu siswa dan status kehadiran!');
        window.history.back();
    </script>";
}
?>