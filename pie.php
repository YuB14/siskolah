<?php
include('./library/koneksi.php');

// Ambil jumlah tiap status absensi
$sql = "
    SELECT 
        status,
        COUNT(*) AS jumlah
    FROM absensi_siswa
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

echo json_encode($data);
?>
