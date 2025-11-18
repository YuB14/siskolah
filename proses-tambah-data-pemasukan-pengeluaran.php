<?php 
require_once "./library/koneksi.php";

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dari form
    $id_keuangan = $_POST['id_keuangan'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $kategori = $_POST['kategori'];

    // Hapus Rp dan titik ribuan agar tersimpan sebagai integer
    $jumlah = str_replace(['Rp','.',','], '', $_POST['jumlah']); 
    $jumlah = intval($jumlah); // pastikan angka

    $keterangan = $_POST['keterangan'];
    $nip = $_POST['nip'];

    // Validasi sederhana
    if (empty($id_keuangan) || empty($tanggal) || empty($jenis) || empty($kategori) || empty($jumlah) || empty($keterangan) || empty($nip)) {
        echo "<script>alert('Semua field harus diisi'); window.history.back();</script>";
        exit;
    }

    // Prepared statement
    $stmt = $koneksi->prepare("INSERT INTO keuangan (id_keuangan, tanggal, jenis, kategori, jumlah, keterangan, nip) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $id_keuangan, $tanggal, $jenis, $kategori, $jumlah, $keterangan, $nip);

    if ($stmt->execute()) {
        header('Location: pemasukan-pengeluaran.php?status=added');
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $koneksi->close();

} else {
    // Redirect jika tidak POST
    header("Location: tambah-data-pemasukan-pengeluaran.php");
    exit;
}
?>
