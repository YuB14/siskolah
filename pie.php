<?php
// pie.php
include './library/koneksi.php';
header('Content-Type: application/json');

$sql = "
    SELECT 
        status,
        COUNT(*) AS jumlah
    FROM absensi_siswa
    WHERE DATE(tanggal) = CURDATE()
    GROUP BY status
";

$result = mysqli_query($koneksi, $sql);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'status' => $row['status'],
        'jumlah' => (int)$row['jumlah']
    ];
}

// Kalau hari ini belum ada absensi → kasih default biar chart nggak error
if (empty($data)) {
    $data = [
        ['status' => 'Hadir',  'jumlah' => 0],
        ['status' => 'Izin',   'jumlah' => 0],
        ['status' => 'Sakit',  'jumlah' => 0],
        ['status' => 'Alpa',   'jumlah' => 0]
    ];
}

echo json_encode($data);
?>