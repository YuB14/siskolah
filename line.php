<?php
// line.php
include './library/koneksi.php';
header('Content-Type: application/json');

$sql = "
    SELECT 
        DATE_FORMAT(tanggal, '%Y-%m') AS bulan,
        SUM(CASE WHEN jenis = 'Pemasukan'  THEN jumlah ELSE 0 END) AS pemasukan,
        SUM(CASE WHEN jenis = 'Pengeluaran' THEN jumlah ELSE 0 END) AS pengeluaran
    FROM keuangan
    GROUP BY DATE_FORMAT(tanggal, '%Y-%m')
    ORDER BY bulan ASC
";

$result = mysqli_query($koneksi, $sql);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $bulan = date('F Y', strtotime($row['bulan'].'-01'));
    $data[] = [
        'bulan'      => $bulan,
        'pemasukan'  => (float)$row['pemasukan'],
        'pengeluaran'=> (float)$row['pengeluaran']
    ];
}

echo json_encode($data);
?>