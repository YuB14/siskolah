<?php
require_once "./library/koneksi.php";

// pastikan ada parameter id_pengaduan yang dikirim lewat URL
if (isset($_GET['id_pengaduan'])) {
    $id = $_GET['id_pengaduan'];

    // query hapus data
    $query = "DELETE FROM pengaduan_siswa WHERE id_pengaduan = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>
                alert('Data pengaduan berhasil dihapus!');
                window.location='pengaduan.php'; // ganti ke halaman tampilan data
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
                window.location='pengaduan.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID Pengaduan tidak ditemukan!');
            window.location='pengaduan.php';
          </script>";
}
?>
