<?php
require_once "./library/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_nilai       = mysqli_real_escape_string($koneksi, $_POST['id_nilai']);
    $nisn           = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $id_kelas       = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $id_mapel       = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $semester       = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $tahun_ajaran   = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran']);

    // Fungsi bantu untuk ubah input kosong jadi 0
    function nilai($v) {
        return ($v === '' || $v === null) ? 0 : floatval($v);
    }

    // Ambil nilai, kosong = 0
    $nilai_tugas_1 = nilai($_POST['nilai_tugas_1'] ?? 0);
    $nilai_tugas_2 = nilai($_POST['nilai_tugas_2'] ?? 0);
    $nilai_tugas_3 = nilai($_POST['nilai_tugas_3'] ?? 0);
    $nilai_tugas_4 = nilai($_POST['nilai_tugas_4'] ?? 0);
    $nilai_tugas_5 = nilai($_POST['nilai_tugas_5'] ?? 0);
    $nilai_tugas_6 = nilai($_POST['nilai_tugas_6'] ?? 0);
    $nilai_uh_1    = nilai($_POST['nilai_uh_1'] ?? 0);
    $nilai_uh_2    = nilai($_POST['nilai_uh_2'] ?? 0);
    $nilai_uh_3    = nilai($_POST['nilai_uh_3'] ?? 0);
    $nilai_uts     = nilai($_POST['nilai_uts'] ?? 0);
    $nilai_uas     = nilai($_POST['nilai_uas'] ?? 0);

    // Kumpulkan semua nilai dalam array
    $semua_nilai = [
        $nilai_tugas_1, $nilai_tugas_2, $nilai_tugas_3,
        $nilai_tugas_4, $nilai_tugas_5, $nilai_tugas_6,
        $nilai_uh_1, $nilai_uh_2, $nilai_uh_3,
        $nilai_uts, $nilai_uas
    ];

    // Hitung hanya nilai yang diisi (tidak nol)
    $nilai_terisi = array_filter($semua_nilai, fn($n) => $n > 0);

    // Simpan ke database
    $query = "
        INSERT INTO nilai_siswa (
            id_nilai, nisn, id_kelas, id_mapel,
            nilai_tugas_1, nilai_tugas_2, nilai_tugas_3,
            nilai_tugas_4, nilai_tugas_5, nilai_tugas_6,
            nilai_uh_1, nilai_uh_2, nilai_uh_3,
            nilai_uts, nilai_uas, semester, tahun_ajaran
        ) VALUES (
            '$id_nilai', '$nisn', '$id_kelas', '$id_mapel',
            '$nilai_tugas_1', '$nilai_tugas_2', '$nilai_tugas_3',
            '$nilai_tugas_4', '$nilai_tugas_5', '$nilai_tugas_6',
            '$nilai_uh_1', '$nilai_uh_2', '$nilai_uh_3',
            '$nilai_uts', '$nilai_uas','$semester', '$tahun_ajaran'
        )
    ";

    if (mysqli_query($koneksi, $query)) {
        echo header('Location: nilai-siswa-x-a.php?status=added'); 
    } else {
        echo "<script>
            alert('Gagal menyimpan data nilai siswa: " . mysqli_error($koneksi) . "');
            window.history.back();
        </script>";
    }

} else {
    echo "<script>
        alert('Akses tidak sah!');
        window.location.href = 'nilai-siswa-x-a.php';
    </script>";
}
?>
