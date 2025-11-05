<?php
require_once './library/koneksi.php';

// Pastikan form di-submit melalui tombol "update"
if (isset($_POST['update'])) {
    // Ambil dan amankan semua input
    $id_nilai      = mysqli_real_escape_string($koneksi, $_POST['id_nilai']);
    $nisn          = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $id_kelas      = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $id_mapel      = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $semester      = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $tahun_ajaran  = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran']);

    // Field nilai — tidak wajib diisi, jadi gunakan ternary operator
    $nilai_tugas_1 = !empty($_POST['nilai_tugas_1']) ? intval($_POST['nilai_tugas_1']) : NULL;
    $nilai_tugas_2 = !empty($_POST['nilai_tugas_2']) ? intval($_POST['nilai_tugas_2']) : NULL;
    $nilai_tugas_3 = !empty($_POST['nilai_tugas_3']) ? intval($_POST['nilai_tugas_3']) : NULL;
    $nilai_tugas_4 = !empty($_POST['nilai_tugas_4']) ? intval($_POST['nilai_tugas_4']) : NULL;
    $nilai_tugas_5 = !empty($_POST['nilai_tugas_5']) ? intval($_POST['nilai_tugas_5']) : NULL;
    $nilai_tugas_6 = !empty($_POST['nilai_tugas_6']) ? intval($_POST['nilai_tugas_6']) : NULL;
    $nilai_uh_1    = !empty($_POST['nilai_uh_1']) ? intval($_POST['nilai_uh_1']) : NULL;
    $nilai_uh_2    = !empty($_POST['nilai_uh_2']) ? intval($_POST['nilai_uh_2']) : NULL;
    $nilai_uh_3    = !empty($_POST['nilai_uh_3']) ? intval($_POST['nilai_uh_3']) : NULL;
    $nilai_uts     = !empty($_POST['nilai_uts']) ? intval($_POST['nilai_uts']) : NULL;
    $nilai_uas     = !empty($_POST['nilai_uas']) ? intval($_POST['nilai_uas']) : NULL;

    // Query update data
    $query = "
        UPDATE nilai_siswa 
        SET 
            nisn = '$nisn',
            id_kelas = '$id_kelas',
            id_mapel = '$id_mapel',
            nilai_tugas_1 = " . ($nilai_tugas_1 === NULL ? "NULL" : $nilai_tugas_1) . ",
            nilai_tugas_2 = " . ($nilai_tugas_2 === NULL ? "NULL" : $nilai_tugas_2) . ",
            nilai_tugas_3 = " . ($nilai_tugas_3 === NULL ? "NULL" : $nilai_tugas_3) . ",
            nilai_tugas_4 = " . ($nilai_tugas_4 === NULL ? "NULL" : $nilai_tugas_4) . ",
            nilai_tugas_5 = " . ($nilai_tugas_5 === NULL ? "NULL" : $nilai_tugas_5) . ",
            nilai_tugas_6 = " . ($nilai_tugas_6 === NULL ? "NULL" : $nilai_tugas_6) . ",
            nilai_uh_1 = " . ($nilai_uh_1 === NULL ? "NULL" : $nilai_uh_1) . ",
            nilai_uh_2 = " . ($nilai_uh_2 === NULL ? "NULL" : $nilai_uh_2) . ",
            nilai_uh_3 = " . ($nilai_uh_3 === NULL ? "NULL" : $nilai_uh_3) . ",
            nilai_uts = " . ($nilai_uts === NULL ? "NULL" : $nilai_uts) . ",
            nilai_uas = " . ($nilai_uas === NULL ? "NULL" : $nilai_uas) . ",
            semester = '$semester',
            tahun_ajaran = '$tahun_ajaran'
        WHERE id_nilai = '$id_nilai'
    ";

    $update = mysqli_query($koneksi, $query);

    if ($update) {
        echo header('Location: nilai-siswa-x-a.php?status=updated'); 
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat memperbarui data!');
                window.history.back();
              </script>";
    }
} else {
    // Jika akses langsung tanpa submit form
    header("Location: nilai-siswa-x-a.php");
    exit;
}
?>