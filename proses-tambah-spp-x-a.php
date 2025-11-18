<?php
require_once "./library/koneksi.php";

// Pastikan form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pembayaran = mysqli_real_escape_string($koneksi, $_POST['id_pembayaran']);
    $nisn           = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $id_kelas       = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $bulan          = mysqli_real_escape_string($koneksi, $_POST['bulan']);
    $tahun_ajaran   = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran']);
    $tanggal        = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $status         = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Jika status Lunas tapi tanggal kosong, isi otomatis tanggal hari ini
    if ($status === "Lunas" && empty($tanggal)) {
        $tanggal = date('Y-m-d');
    }

    // Query insert data ke tabel pembayaran_spp
    $query = "
        INSERT INTO pembayaran_spp (
            id_pembayaran,
            nisn,
            id_kelas,
            bulan,
            tahun_ajaran,
            tanggal_bayar,
            status
        ) VALUES (
            '$id_pembayaran',
            '$nisn',
            '$id_kelas',
            '$bulan',
            '$tahun_ajaran',
            " . (!empty($tanggal) ? "'$tanggal'" : "NULL") . ",
            '$status'
        )
    ";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header('Location: spp-x-a.php?status=added');
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }

} else {
    echo "<script>
            alert('Akses tidak sah!');
            window.location.href = 'spp-x-a.php';
          </script>";
}
?>
