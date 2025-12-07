<?php
session_start();
require_once "./library/koneksi.php";

// Pastikan hanya Kepala Sekolah yang boleh proses
if (!isset($_SESSION['guru_login']) || !isset($_SESSION['guru_nip'])) {
    die("<script>alert('Akses ditolak!'); window.location='login-guru.html';</script>");
}

if ($_SESSION['guru_jabatan'] !== 'Kepala Sekolah') {
    die("<script>alert('Akses hanya untuk Kepala Sekolah!'); window.location='login-guru.html';</script>");
}

$status      = $_POST['status'] ?? '';
$nipList     = $_POST['nip'] ?? [];
$tanggal     = $_POST['tanggal'] ?? '';
$keterangan  = $_POST['keterangan'] ?? '';
$fotoData    = $_POST['foto_data'] ?? '';

if (empty($status) || empty($nipList) || empty($tanggal)) {
    die("<script>alert('Data tidak lengkap!'); window.history.back();</script>");
}


// ============================
// Proses foto base64 → file
// ============================

$fotoFilename = null;

if (!empty($fotoData)) {

    // Format base64: data:image/png;base64,xxxxx
    $fotoParts = explode(",", $fotoData);

    if (count($fotoParts) == 2) {

        $imageBase64 = base64_decode($fotoParts[1]);

        // Nama file unik
        $fotoFilename = "absensi_guru_" . time() . "_" . rand(1000, 9999) . ".png";

        // Path folder tujuan
        $folderPath = "uploads/foto_absensi_guru/";
        
        // Pastikan folder ada
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Full path file
        $savePath = $folderPath . $fotoFilename;

        // Simpan file
        file_put_contents($savePath, $imageBase64);
    }
}


// ============================
// Insert absensi untuk tiap guru
// ============================

$inserted = 0;

foreach ($nipList as $nip) {

    $nip = mysqli_real_escape_string($koneksi, $nip);

    // Cek apakah guru sudah diabsen tanggal yang sama
    $cek = mysqli_query($koneksi, "
        SELECT id_absensi 
        FROM absensi_guru 
        WHERE nip = '$nip' AND tanggal = '$tanggal'
        LIMIT 1
    ");

    if (mysqli_num_rows($cek) > 0) {
        continue; // Jika sudah ada, skip
    }

    // Insert absensi
    $query = mysqli_query($koneksi, "
        INSERT INTO absensi_guru (nip, status, tanggal, keterangan, foto)
        VALUES ('$nip', '$status', '$tanggal', '$keterangan', '$fotoFilename')
    ");

    if ($query) {
        $inserted++;
    }
}


// ============================
// Notifikasi hasil
// ============================

if ($inserted > 0) {
    header("Location: absensi-guru.php?status=added");
} else {
    echo "<script>
            alert('Tidak ada data disimpan (mungkin sudah diabsen)!');
            window.location='absensi-guru.php';
          </script>";
}
?>   