<?php
require_once "./library/koneksi.php";
header('Content-Type: application/json');

$tipe = $_GET['tipe'] ?? '';

if ($tipe == 'pengaduan') {
    $bulan = date('m'); // bulan sekarang (01–12)
    $tahun = date('Y'); // tahun sekarang (misal 2025)

    $q = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total 
        FROM pengaduan_siswa 
        WHERE MONTH(tanggal_pengaduan) = '$bulan' AND YEAR(tanggal_pengaduan) = '$tahun'
    ");
    $d = mysqli_fetch_assoc($q);

    echo json_encode(["total" => (int)$d['total']]);
    exit;
}


if ($tipe == 'kritik') {
    $q = mysqli_query($koneksi, "
        SELECT COUNT(*) AS total 
        FROM kritik_saran 
        WHERE MONTH(tanggal) = MONTH(CURDATE()) 
          AND YEAR(tanggal) = YEAR(CURDATE())
    ");
    $d = mysqli_fetch_assoc($q);
    echo json_encode(["total" => (int)$d['total']]);
    exit;
}


if ($tipe == 'spp_belum_lunas') {
    $q = mysqli_query($koneksi, "
        SELECT COUNT(DISTINCT nisn) AS total 
        FROM pembayaran_spp 
        WHERE status = 'Belum Lunas'
    ");
    $d = mysqli_fetch_assoc($q);
    echo json_encode(["total" => (int)$d['total']]);
    exit;
}


// 🔹 Tambahan: ambil jumlah guru dan siswa
if ($tipe == 'sekolah') {
    $qGuru = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM guru");
    $dGuru = mysqli_fetch_assoc($qGuru);

    $qSiswa = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa");
    $dSiswa = mysqli_fetch_assoc($qSiswa);

    $totalGuru = (int)($dGuru['total'] ?? 0);
    $totalSiswa = (int)($dSiswa['total'] ?? 0);

    echo json_encode([
        "guru" => $totalGuru,
        "siswa" => $totalSiswa
    ]);
    exit;
}

// Jika tipe tidak sesuai
echo json_encode(["error" => "tipe tidak valid"]);
