<?php
require_once "./library/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dari form
    $id_mapel     = mysqli_real_escape_string($koneksi, $_POST['id_mapel']);
    $nama_mapel   = mysqli_real_escape_string($koneksi, $_POST['nama_mapel']);
    $nip          = mysqli_real_escape_string($koneksi, $_POST['nip']);

    // Validasi wajib isi
    if (empty($id_mapel) || empty($nama_mapel) || empty($nip)) {
        echo "<script>
                alert('Semua field wajib diisi!');
                window.location.href='tambah-mata-pelajaran-admin.php';
              </script>";
        exit;
    }

    // Cek apakah NIP ada di tabel guru (hindari FK error)
    $cekGuru = mysqli_query($koneksi, "SELECT nip FROM guru WHERE nip='$nip'");
    if (mysqli_num_rows($cekGuru) == 0) {
        echo "<script>
                alert('NIP Pengajar tidak ditemukan di tabel guru!');
                window.location.href='tambah-mata-pelajaran-admin.php';
              </script>";
        exit;
    }

    // Query Insert
    $query = "
        INSERT INTO mata_pelajaran (id_mapel, nama_mapel, nip)
        VALUES ('$id_mapel', '$nama_mapel', '$nip')
    ";

    if (mysqli_query($koneksi, $query)) {
        header('Location: mata-pelajaran-admin.php?status=added');
    } else {
        echo "<script>
                alert('Gagal menambah data: " . mysqli_error($koneksi) . "');
                window.location.href='tambah-mata-pelajaran-admin.php';
              </script>";
    }

} else {
    // Jika file diakses langsung
    header("Location: tambah-mata-pelajaran-admin.php");
    exit;
}
?>
