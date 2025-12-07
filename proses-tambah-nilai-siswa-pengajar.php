<?php
require_once "./library/koneksi.php";

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data dari form
    $id_nilai = mysqli_real_escape_string($koneksi, $_POST['id_nilai']);
    $nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $id_mapel = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $tahun_ajaran = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran']);
    
    // Ambil nilai-nilai
    $nilai_tugas_1 = isset($_POST['nilai_tugas_1']) && $_POST['nilai_tugas_1'] !== '' ? (int)$_POST['nilai_tugas_1'] : 0;
    $nilai_tugas_2 = isset($_POST['nilai_tugas_2']) && $_POST['nilai_tugas_2'] !== '' ? (int)$_POST['nilai_tugas_2'] : 0;
    $nilai_tugas_3 = isset($_POST['nilai_tugas_3']) && $_POST['nilai_tugas_3'] !== '' ? (int)$_POST['nilai_tugas_3'] : 0;
    $nilai_tugas_4 = isset($_POST['nilai_tugas_4']) && $_POST['nilai_tugas_4'] !== '' ? (int)$_POST['nilai_tugas_4'] : 0;
    $nilai_tugas_5 = isset($_POST['nilai_tugas_5']) && $_POST['nilai_tugas_5'] !== '' ? (int)$_POST['nilai_tugas_5'] : 0;
    $nilai_tugas_6 = isset($_POST['nilai_tugas_6']) && $_POST['nilai_tugas_6'] !== '' ? (int)$_POST['nilai_tugas_6'] : 0;
    
    $nilai_uh_1 = isset($_POST['nilai_uh_1']) && $_POST['nilai_uh_1'] !== '' ? (int)$_POST['nilai_uh_1'] : 0;
    $nilai_uh_2 = isset($_POST['nilai_uh_2']) && $_POST['nilai_uh_2'] !== '' ? (int)$_POST['nilai_uh_2'] : 0;
    $nilai_uh_3 = isset($_POST['nilai_uh_3']) && $_POST['nilai_uh_3'] !== '' ? (int)$_POST['nilai_uh_3'] : 0;
    
    $nilai_uts = isset($_POST['nilai_uts']) && $_POST['nilai_uts'] !== '' ? (int)$_POST['nilai_uts'] : 0;
    $nilai_uas = isset($_POST['nilai_uas']) && $_POST['nilai_uas'] !== '' ? (int)$_POST['nilai_uas'] : 0;
    
    // Validasi data wajib dengan pesan spesifik
    $errors = [];

    if (empty($nisn)) {
        $errors[] = "NISN siswa belum dipilih";
    }
    if (empty($id_kelas)) {
        $errors[] = "Kelas belum terisi";
    }
    if (empty($id_mapel)) {
        $errors[] = "Mata pelajaran belum dipilih";
    }
    if (empty($semester)) {
        $errors[] = "Semester belum dipilih";
    }
    if (empty($tahun_ajaran)) {
        $errors[] = "Tahun ajaran belum dipilih";
    }

    if (!empty($errors)) {
        $errorMsg = implode("\\n- ", $errors);
        echo "<script>
                alert('Data wajib tidak lengkap:\\n- $errorMsg');
                window.history.back();
            </script>";
        exit;
    }
    
    // Cek apakah data sudah ada (berdasarkan NISN, Mata Pelajaran, Semester, dan Tahun Ajaran)
    $cekQuery = "SELECT * FROM nilai_siswa 
                 WHERE nisn = '$nisn' 
                 AND id_mapel = '$id_mapel' 
                 AND semester = '$semester' 
                 AND tahun_ajaran = '$tahun_ajaran'";
    
    $cekResult = mysqli_query($koneksi, $cekQuery);
    
    if (mysqli_num_rows($cekResult) > 0) {
        echo "<script>
                alert('Data nilai untuk siswa ini pada mata pelajaran, semester, dan tahun ajaran yang sama sudah ada!');
                window.history.back();
              </script>";
        exit;
    }
    
    // Prepare statement untuk insert
    $query = "INSERT INTO nilai_siswa (
                id_nilai, nisn, id_kelas, id_mapel, 
                nilai_tugas_1, nilai_tugas_2, nilai_tugas_3, nilai_tugas_4, nilai_tugas_5, nilai_tugas_6,
                nilai_uh_1, nilai_uh_2, nilai_uh_3,
                nilai_uts, nilai_uas,
                semester, tahun_ajaran
              ) VALUES (
                '$id_nilai', '$nisn', '$id_kelas', '$id_mapel',
                " . ($nilai_tugas_1 !== NULL ? $nilai_tugas_1 : 0) . ",
                " . ($nilai_tugas_2 !== NULL ? $nilai_tugas_2 : 0) . ",
                " . ($nilai_tugas_3 !== NULL ? $nilai_tugas_3 : 0) . ",
                " . ($nilai_tugas_4 !== NULL ? $nilai_tugas_4 : 0) . ",
                " . ($nilai_tugas_5 !== NULL ? $nilai_tugas_5 : 0) . ",
                " . ($nilai_tugas_6 !== NULL ? $nilai_tugas_6 : 0) . ",
                " . ($nilai_uh_1 !== NULL ? $nilai_uh_1 : 0) . ",
                " . ($nilai_uh_2 !== NULL ? $nilai_uh_2 : 0) . ",
                " . ($nilai_uh_3 !== NULL ? $nilai_uh_3 : 0) . ",
                " . ($nilai_uts !== NULL ? $nilai_uts : 0) . ",
                " . ($nilai_uas !== NULL ? $nilai_uas : 0) . ",
                '$semester', '$tahun_ajaran'
              )";
    
    // Eksekusi query
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        header('Location: nilai-siswa-pengajar.php?status=added');
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }
    
} else {
    // Jika bukan metode POST, redirect ke halaman form
    header("Location: tambah-nilai-siswa-pengajar.php");
    exit;
}
?>