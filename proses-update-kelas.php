<?php
require_once './library/koneksi.php';

// Pastikan ID kelas dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<script>alert('Akses tidak valid!');window.location='kelas.php';</script>";
    exit;
}

// Ambil data dari form
$id_kelas   = $_POST['id_kelas'] ?? '';
$nama_kelas = $_POST['nama_kelas'] ?? '';
$nip        = $_POST['nip'] ?? '';

// Validasi data wajib
if (empty($id_kelas) || empty($nama_kelas) || empty($nip)) {
    echo "<script>alert('Semua field wajib diisi!');window.history.back();</script>";
    exit;
}

// Siapkan query update
$stmt = $koneksi->prepare("UPDATE kelas SET nama_kelas = ?, nip = ? WHERE id_kelas = ?");
$stmt->bind_param("sss", $nama_kelas, $nip, $id_kelas);

// Eksekusi dan cek hasil
if ($stmt->execute()) {
    header("Location: kelas.php?status=updated");
} else {
    echo "<script>alert('Gagal memperbarui data: " . addslashes($stmt->error) . "');window.history.back();</script>";
}

// Tutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>