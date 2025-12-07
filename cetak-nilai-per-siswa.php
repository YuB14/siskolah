<?php
require_once "./library/koneksi.php";

$selectedSiswa = $_GET['siswa'] ?? [];
if (!is_array($selectedSiswa)) $selectedSiswa = $selectedSiswa ? [$selectedSiswa] : [];

$where = ["1=1"];
if (!empty($selectedSiswa)) {
    $escaped = array_map(function($n) use ($koneksi) {
        return "'" . mysqli_real_escape_string($koneksi, $n) . "'";
    }, $selectedSiswa);
    $where[] = "s.nisn IN (" . implode(",", $escaped) . ")";
}

$sql = "SELECT 
    s.nisn, s.nama_lengkap, k.nama_kelas, g.nama_lengkap AS wali_kelas,
    mp.nama_mapel,
    ns.nilai_tugas_1, ns.nilai_tugas_2, ns.nilai_tugas_3, ns.nilai_tugas_4, ns.nilai_tugas_5, ns.nilai_tugas_6,
    ns.nilai_uh_1, ns.nilai_uh_2, ns.nilai_uh_3,
    ns.nilai_uts, ns.nilai_uas,
    ns.semester, ns.tahun_ajaran
FROM nilai_siswa ns
JOIN siswa s ON ns.nisn = s.nisn
JOIN kelas k ON ns.id_kelas = k.id_kelas
JOIN guru g ON k.nip = g.nip
JOIN mata_pelajaran mp ON ns.id_mapel = mp.id_mapel
WHERE " . implode(" AND ", $where) . "
ORDER BY s.nama_lengkap, mp.nama_mapel";

$result = mysqli_query($koneksi, $sql);
$dataSiswa = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dataSiswa[$row['nisn']]['info'] = [
        'nama' => $row['nama_lengkap'],
        'kelas' => $row['nama_kelas'],
        'wali_kelas' => $row['wali_kelas'],
        'semester' => $row['semester'],
        'tahun_ajaran' => $row['tahun_ajaran']
    ];
    $dataSiswa[$row['nisn']]['nilai'][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Nilai Per Siswa - SISKOLAH</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f4f4f4; }
        .siswa { background: white; margin: 30px auto; padding: 40px; width: 210mm; min-height: 297mm; box-shadow: 0 0 20px rgba(0,0,0,0.1); page-break-after: always; position: relative; }
        table.info { width: 100%; margin: 20px 0; font-size: 16px; }
        table.info td:first-child { font-weight: bold; width: 180px; }
        table.nilai { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }
        table.nilai th { background: #2c3e50; color: white; padding: 12px; }
        table.nilai td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        table.nilai tbody tr:nth-child(even) { background: #f9f9f9; }
        .ttd { margin-top: 80px; text-align: right; float: right; width: 300px; }
        @media print { body { background: white; } .siswa { box-shadow: none; margin: 0; padding: 30px; } }
    </style>
</head>
<body onload="window.print()">
<?php foreach ($dataSiswa as $nisn => $s): ?>
<div class="siswa">
    <!-- HEADER DENGAN LOGO -->
    <div style="position:relative; padding-left:140px; min-height:120px; margin-bottom:30px;">
        <img src="./img/school-solid-full.svg" alt="Logo Siskolah" 
             style="position:absolute; left:0; top:0; width:120px; height:120px; object-fit:contain;">
        <div style="text-align:center; padding-top:15px;">
            <h2 style="margin:0; font-size:28px; color:#2c3e50;">SISKOLAH</h2>
            <h3 style="margin:10px 0; font-size:20px; color:#34495e;">LAPORAN NILAI SISWA</h3>
            <hr style="border:2px solid #2c3e50; width:320px; margin:15px auto 0;">
        </div>
    </div>

    <table class="info">
        <tr><td>Nama Siswa</td><td>: <strong><?= htmlspecialchars($s['info']['nama']) ?></strong></td></tr>
        <tr><td>Kelas</td><td>: <?= $s['info']['kelas'] ?></td></tr>
        <tr><td>Wali Kelas</td><td>: <?= htmlspecialchars($s['info']['wali_kelas']) ?></td></tr>
        <tr><td>Semester / Tahun Ajaran</td><td>: <?= $s['info']['semester'] ?> / <?= $s['info']['tahun_ajaran'] ?></td></tr>
    </table>

    <table class="nilai">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Mata Pelajaran</th>
                <th>Rata² Tugas</th>
                <th>Rata² UH</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach ($s['nilai'] as $n): 
            $tugas = array_filter([$n['nilai_tugas_1'],$n['nilai_tugas_2'],$n['nilai_tugas_3'],$n['nilai_tugas_4'],$n['nilai_tugas_5'],$n['nilai_tugas_6']]);
            $uh = array_filter([$n['nilai_uh_1'],$n['nilai_uh_2'],$n['nilai_uh_3']]);
            $rt = !empty($tugas) ? round(array_sum($tugas)/count($tugas),1) : 0;
            $ru = !empty($uh) ? round(array_sum($uh)/count($uh),1) : 0;
            
            // RUMUS K13 STANDAR
            $akhir = round(
                ($rt * 0.3) + 
                ($ru * 0.2) + 
                ($n['nilai_uts'] ?? 0) * 0.2 + 
                ($n['nilai_uas'] ?? 0) * 0.3
            );
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td style="text-align:left; padding-left:10px;"><?= htmlspecialchars($n['nama_mapel']) ?></td>
                <td><?= $rt ?></td>
                <td><?= $ru ?></td>
                <td><?= $n['nilai_uts'] ?? '-' ?></td>
                <td><?= $n['nilai_uas'] ?? '-' ?></td>
                <td><strong><?= $akhir ?></strong></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="ttd">
        <p>Mengetahui,</p>
        <p>Wali Kelas</p>
        <br><br><br>
        <strong><u><?= htmlspecialchars($s['info']['wali_kelas']) ?></u></strong>
    </div>
    <div style="clear:both;"></div>
</div>
<?php endforeach; ?>

<div style="text-align:center; margin:50px;">
    <button onclick="window.close()" style="padding:15px 40px; font-size:18px; background:#007bff; color:white; border:none; border-radius:5px; cursor:pointer;">
        Tutup Halaman
    </button>
</div>
</body>
</html>