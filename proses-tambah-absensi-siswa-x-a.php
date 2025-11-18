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

    echo "<script>
        alert('Absensi berhasil disimpan untuk " . count($_POST['nisn']) . " siswa!');
        window.location.href='absensi-siswa.php';
    </script>";
} else {
    echo "<script>
        alert('Silakan pilih minimal satu siswa dan status kehadiran!');
        window.history.back();
    </script>";
}
?>
