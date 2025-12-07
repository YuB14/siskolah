<?php
// Hubungkan ke database
require_once "./library/koneksi.php";

// Pastikan data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form kritik dan saran
    $id_kritik_saran = mysqli_real_escape_string($koneksi, $_POST['id_kritik_saran']);
    $tanggapan = mysqli_real_escape_string($koneksi, $_POST['tanggapan']);
    $tanggal_tanggapan = mysqli_real_escape_string($koneksi, $_POST['tanggal_tanggapan']);

    // Validasi sederhana
    if (empty($tanggapan) || empty($tanggal_tanggapan)) {
        echo "<script>alert('Semua field wajib diisi!'); window.location='tanggapan-kritik-saran.php';</script>";
        exit;
    }

    // Query update data tanggapan ke tabel pengaduan
    $query = "
        UPDATE kritik_saran 
        SET 
            tanggapan = '$tanggapan',
            tanggal_tanggapan = '$tanggal_tanggapan'
        WHERE id_kritik_saran = '$id_kritik_saran'
    ";

    // Jalankan query dan cek hasilnya
    if (mysqli_query($koneksi, $query)) {
        echo header('Location: tanggapan-kritik-saran.php?status=added');
    } else {
        echo "<script>
                alert('Gagal menyimpan tanggapan! Coba lagi.');
                window.location.href = 'tanggapan-kritik-saran.php';
              </script>";
    }
} else {
    // Jika bukan metode POST
    echo "<script>
            alert('Akses tidak valid!');
            window.location.href = 'tanggapan-kritik-saran.php';
          </script>";
}
?>
