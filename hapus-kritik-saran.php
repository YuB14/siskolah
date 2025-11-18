<?php
require_once "./library/koneksi.php";

// pastikan ada parameter id_pengaduan yang dikirim lewat URL
if (isset($_GET['id_kritik_saran'])) {
    $id = $_GET['id_kritik_saran'];

    // query hapus data
    $query = "DELETE FROM kritik_saran WHERE id_kritik_saran = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: kritik-saran.php?status=deleted");
        exit;
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location='kritik-saran.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID Pengaduan tidak ditemukan!');
            window.location='kritik-saran.php';
          </script>";
}
?>
