<?php
require_once "./library/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_kritik_saran'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $isi = $_POST['isi'];

    // Query update
    $query = "UPDATE kritik_saran 
              SET tanggal='$tanggal', jenis='$jenis', isi='$isi' 
              WHERE id_kritik_saran='$id'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: kritik-saran.php?status=updated");
        exit;
    } else {
        echo "<script>
                alert('Gagal menyimpan perubahan: " . mysqli_error($koneksi) . "');
                window.location='kritik-saran.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Akses tidak sah!');
            window.location='kritik-saran.php';
          </script>";
}
?>
