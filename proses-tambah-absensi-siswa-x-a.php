<?php
require_once "./library/koneksi.php";

if (isset($_POST['nisn']) && isset($_POST['status'])) {
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    foreach ($_POST['nisn'] as $nisn) {
        mysqli_query($koneksi, "INSERT INTO absensi_siswa (nisn, tanggal, status, keterangan)
                                VALUES ('$nisn', '$tanggal', '$status', '$keterangan')");
    }

    header('Location: absensi-siswa-x-a.php?status=added');
} else {
    echo "<script>
        alert('Silakan pilih minimal satu siswa dan status kehadiran!');
        window.history.back();
    </script>";
}
?>
