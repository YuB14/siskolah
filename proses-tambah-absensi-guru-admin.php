<?php 
require_once "./library/koneksi.php";
session_start();

// CEK LOGIN
if (!isset($_SESSION['guru_login'])) {
    header("Location: login-guru.html");
    exit;
}

// CEK ROLE Admin
if ($_SESSION['guru_jabatan'] !== 'Admin') {
    header("Location: login-guru.html");
    exit;
}

// AMBIL NIP LOGIN YANG BENAR
$nip_login = $_SESSION['guru_nip'];

// CEK METODE POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: absensi-guru-admin.php");
    exit;
}

$status      = $_POST['status'] ?? null;
$nip_list    = $_POST['nip'] ?? [];
$tanggal     = $_POST['tanggal'] ?? date("Y-m-d");
$keterangan  = $_POST['keterangan'] ?? "";
$foto_base64 = $_POST['foto_data'] ?? "";

if (!$status || empty($nip_list)) {
    echo "<script>alert('Data tidak lengkap!'); window.location='absensi-guru-admin.php';</script>";
    exit;
}

// ====== SIMPAN FOTO ======
$nama_file_foto = null;

if (!empty($foto_base64)) {
    $foto_parts = explode(",", $foto_base64);
    if (count($foto_parts) == 2) {
        $img_data = base64_decode($foto_parts[1]);

        $nama_file_foto = "abs_guru_" . time() . "_" . rand(1000, 9999) . ".jpg";

        $folder = "uploads/foto_absensi_guru/";
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        file_put_contents($folder . $nama_file_foto, $img_data);
    }
}

// ====== SIMPAN ABSENSI ======

foreach ($nip_list as $nip) {

    // Cek apakah guru sudah absen hari ini
    $check = mysqli_query($koneksi, "
        SELECT id_absensi FROM absensi_guru
        WHERE nip = '$nip' AND DATE(tanggal) = '$tanggal'
        LIMIT 1
    ");

    if (mysqli_num_rows($check) > 0) {
        echo "<script>
                alert('Guru dengan NIP $nip sudah mengisi absensi hari ini!');
                window.location='absensi-guru-admin.php';
              </script>";
        exit;
    }

    // Insert data baru
    mysqli_query($koneksi, "
        INSERT INTO absensi_guru (nip, status, foto, tanggal, keterangan, created_at)
        VALUES ('$nip', '$status', '$nama_file_foto', '$tanggal', '$keterangan', NOW())
    ");
}

header('Location: absensi-guru-admin.php?status=added');
exit;

?>