<?php
include('./library/koneksi.php');

$q = mysqli_query($koneksi, "
    SELECT 
        id_pengaduan AS id,
        judul,
        tanggal_pengaduan AS tanggal,
        'pengaduan_siswa' AS jenis
    FROM pengaduan_siswa

    UNION

    SELECT 
        id_kritik_saran AS id,
        jenis,
        tanggal,
        'kritik_saran' AS jenis
    FROM kritik_saran

    ORDER BY tanggal DESC
    LIMIT 10
");

$data = [];
while ($row = mysqli_fetch_assoc($q)) {
    $data[] = $row;
}

echo json_encode([
    "count" => count($data),
    "items" => $data
]);
