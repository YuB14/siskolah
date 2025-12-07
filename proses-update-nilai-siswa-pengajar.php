<?php
require_once "./library/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id_nilai = mysqli_real_escape_string($koneksi, $_POST['id_nilai']);
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $tahun_ajaran = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran']);
    
    // Ambil nilai-nilai
    $nilai_tugas_1 = isset($_POST['nilai_tugas_1']) && $_POST['nilai_tugas_1'] !== '' ? (int)$_POST['nilai_tugas_1'] : NULL;
    $nilai_tugas_2 = isset($_POST['nilai_tugas_2']) && $_POST['nilai_tugas_2'] !== '' ? (int)$_POST['nilai_tugas_2'] : NULL;
    $nilai_tugas_3 = isset($_POST['nilai_tugas_3']) && $_POST['nilai_tugas_3'] !== '' ? (int)$_POST['nilai_tugas_3'] : NULL;
    $nilai_tugas_4 = isset($_POST['nilai_tugas_4']) && $_POST['nilai_tugas_4'] !== '' ? (int)$_POST['nilai_tugas_4'] : NULL;
    $nilai_tugas_5 = isset($_POST['nilai_tugas_5']) && $_POST['nilai_tugas_5'] !== '' ? (int)$_POST['nilai_tugas_5'] : NULL;
    $nilai_tugas_6 = isset($_POST['nilai_tugas_6']) && $_POST['nilai_tugas_6'] !== '' ? (int)$_POST['nilai_tugas_6'] : NULL;
    
    $nilai_uh_1 = isset($_POST['nilai_uh_1']) && $_POST['nilai_uh_1'] !== '' ? (int)$_POST['nilai_uh_1'] : NULL;
    $nilai_uh_2 = isset($_POST['nilai_uh_2']) && $_POST['nilai_uh_2'] !== '' ? (int)$_POST['nilai_uh_2'] : NULL;
    $nilai_uh_3 = isset($_POST['nilai_uh_3']) && $_POST['nilai_uh_3'] !== '' ? (int)$_POST['nilai_uh_3'] : NULL;
    
    $nilai_uts = isset($_POST['nilai_uts']) && $_POST['nilai_uts'] !== '' ? (int)$_POST['nilai_uts'] : NULL;
    $nilai_uas = isset($_POST['nilai_uas']) && $_POST['nilai_uas'] !== '' ? (int)$_POST['nilai_uas'] : NULL;
    
    // Validasi data wajib
    if (empty($nisn) || empty($id_kelas) || empty($id_mapel) || empty($semester) || empty($tahun_ajaran)) {
        echo "<script>
                alert('Data wajib tidak boleh kosong!');
                window.history.back();
              </script>";
        exit;
    }
    
    // Cek apakah data duplikat (kecuali data yang sedang diedit)
    $cekQuery = "SELECT * FROM nilai_siswa 
                 WHERE nisn = '$nisn' 
                 AND id_mapel = '$id_mapel' 
                 AND semester = '$semester' 
                 AND tahun_ajaran = '$tahun_ajaran'
                 AND id_nilai != '$id_nilai'";
    
    $cekResult = mysqli_query($koneksi, $cekQuery);
    
    if (mysqli_num_rows($cekResult) > 0) {
        echo "<script>
                alert('Data nilai untuk siswa ini pada mata pelajaran, semester, dan tahun ajaran yang sama sudah ada!');
                window.history.back();
              </script>";
        exit;
    }
    
    // Update query
    $query = "UPDATE nilai_siswa SET
                nisn = '$nisn',
                id_kelas = '$id_kelas',
                id_mapel = '$id_mapel',
                nilai_tugas_1 = " . ($nilai_tugas_1 !== NULL ? $nilai_tugas_1 : 'NULL') . ",
                nilai_tugas_2 = " . ($nilai_tugas_2 !== NULL ? $nilai_tugas_2 : 'NULL') . ",
                nilai_tugas_3 = " . ($nilai_tugas_3 !== NULL ? $nilai_tugas_3 : 'NULL') . ",
                nilai_tugas_4 = " . ($nilai_tugas_4 !== NULL ? $nilai_tugas_4 : 'NULL') . ",
                nilai_tugas_5 = " . ($nilai_tugas_5 !== NULL ? $nilai_tugas_5 : 'NULL') . ",
                nilai_tugas_6 = " . ($nilai_tugas_6 !== NULL ? $nilai_tugas_6 : 'NULL') . ",
                nilai_uh_1 = " . ($nilai_uh_1 !== NULL ? $nilai_uh_1 : 'NULL') . ",
                nilai_uh_2 = " . ($nilai_uh_2 !== NULL ? $nilai_uh_2 : 'NULL') . ",
                nilai_uh_3 = " . ($nilai_uh_3 !== NULL ? $nilai_uh_3 : 'NULL') . ",
                nilai_uts = " . ($nilai_uts !== NULL ? $nilai_uts : 'NULL') . ",
                nilai_uas = " . ($nilai_uas !== NULL ? $nilai_uas : 'NULL') . ",
                semester = '$semester',
                tahun_ajaran = '$tahun_ajaran'
              WHERE id_nilai = '$id_nilai'";
    
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        header("Location: nilai-siswa-pengajar.php?status=updated");
    } else {
        echo "<script>
                alert('Gagal mengupdate data: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }
    
} else {
    header("Location: nilai-siswa-pengajar.php");
    exit;
}
?>