<?php
// Hubungkan ke database
require_once "./library/koneksi.php";

// Pastikan data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form tanggapan
    $id_pengaduan = mysqli_real_escape_string($koneksi, $_POST['id_pengaduan']);
    $tanggapan = mysqli_real_escape_string($koneksi, $_POST['tanggapan']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $tanggal_tanggapan = mysqli_real_escape_string($koneksi, $_POST['tanggal_tanggapan']);

    // Validasi sederhana
    if (empty($tanggapan) || empty($status) || empty($tanggal_tanggapan)) {
        echo "<script>alert('Semua field wajib diisi!'); window.location='pengaduan-guru.php';</script>";
        exit;
    }

    // Query update data tanggapan ke tabel pengaduan
    $query = "
        UPDATE pengaduan_siswa 
        SET 
            tanggapan = '$tanggapan',
            status = '$status',
            tanggal_tanggapan = '$tanggal_tanggapan'
        WHERE id_pengaduan = '$id_pengaduan'
    ";

    // Jalankan query dan cek hasilnya
    if (mysqli_query($koneksi, $query)) {
        echo header('Location: tanggapan.php?status=added');
    } else {
        echo "<script>
                alert('Gagal menyimpan tanggapan! Coba lagi.');
                window.location.href = 'pengaduan-guru.php';
              </script>";
    }
} else {
    // Jika bukan metode POST
    echo "<script>
            alert('Akses tidak valid!');
            window.location.href = 'pengaduan-guru.php';
          </script>";
}
?>
