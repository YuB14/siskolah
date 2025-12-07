<?php
require_once "library/koneksi.php";
require_once "SimpleXLSX.php";

use Shuchkin\SimpleXLSX;

if (!isset($_FILES['fileexcel']) || $_FILES['fileexcel']['error'] !== 0) {
    die("<h3 style='color:red;text-align:center;'>File gagal diupload!</h3>");
}

$file = $_FILES['fileexcel']['tmp_name'];

if ($xlsx = SimpleXLSX::parse($file)) {
    $rows = $xlsx->rows();
    $sukses = 0;
    $gagal  = 0;

    foreach ($rows as $i => $row) {
        if ($i == 0) continue; // Skip header

        // Ambil kolom sesuai Excel kamu
        $nisn           = trim($row[0] ?? '');
        $nama           = trim($row[1] ?? '');
        $jk             = trim($row[2] ?? '');
        $tgl_lahir      = trim($row[3] ?? '');
        $alamat         = trim($row[4] ?? '');
        $no_hp          = trim($row[5] ?? '');
        $email          = trim($row[6] ?? '');
        $kelas_excel    = trim($row[7] ?? '');

        if (empty($nisn) || empty($nama) || empty($kelas_excel)) {
            $gagal++;
            continue;
        }

        // Escape data
        $nisn = mysqli_real_escape_string($koneksi, $nisn);
        $nama = mysqli_real_escape_string($koneksi, $nama);
        $jk   = mysqli_real_escape_string($koneksi, $jk);
        $tgl_lahir = mysqli_real_escape_string($koneksi, $tgl_lahir);
        $alamat = mysqli_real_escape_string($koneksi, $alamat);
        $no_hp  = mysqli_real_escape_string($koneksi, $no_hp);
        $email  = mysqli_real_escape_string($koneksi, $email);
        $kelas_excel = mysqli_real_escape_string($koneksi, $kelas_excel);

        // Cek apakah kelas ada (tabel kelas.id_kelas = KLS0000001)
        $q = mysqli_query($koneksi, "SELECT id_kelas FROM kelas WHERE id_kelas='$kelas_excel'");
        if (mysqli_num_rows($q) == 0) {
            // kelas tidak ditemukan -> gagal
            $gagal++;
            continue;
        }
        $id_kelas = mysqli_fetch_assoc($q)['id_kelas'];

        // Cek duplikat NISN
        $cek = mysqli_query($koneksi, "SELECT nisn FROM siswa WHERE nisn='$nisn'");
        if (mysqli_num_rows($cek) > 0) {
            $gagal++;
            continue;
        }

        // Insert siswa lengkap
        $sql = "INSERT INTO siswa (
                    nisn, foto, nama_lengkap, jenis_kelamin, tanggal_lahir, 
                    alamat, no_hp, email, id_kelas, tanggal_masuk, status, password
                ) VALUES (
                    '$nisn',
                    'default-avatar.png',
                    '$nama',
                    '$jk',
                    '$tgl_lahir',
                    '$alamat',
                    '$no_hp',
                    '$email',
                    '$id_kelas',
                    NOW(),
                    'Aktif',
                    md5('123456')  -- password default
                )";

        if (mysqli_query($koneksi, $sql)) {
            $sukses++;
        } else {
            $gagal++;
        }
    }

    echo "<div style='text-align:center; padding:60px; font-family:Arial; background:#f8fff8;'>
            <h1 style='color:green;'>IMPORT BERHASIL!</h1>
            <h3>Berhasil: <b>$sukses</b> siswa</h3>
            <h3 style='color:orange;'>Gagal/Duplikat/Kelas tidak ditemukan: <b>$gagal</b></h3>
            <br><br>
            <a href='biodata-siswa.php' style='padding:15px 40px; background:#28a745; color:white; text-decoration:none; border-radius:10px; font-size:20px;'>
                KEMBALI KE BIODATA SISWA
            </a>
          </div>";

} else {
    echo "Error: " . SimpleXLSX::parseError();
}
?>
