<?php
require_once "./library/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mapel = $_POST['id_mapel'];
    $nip = $_POST['nip'];

    // Validasi input
    if (empty($id_mapel) || empty($nip)) {
        echo "<script>alert('Semua field wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Cek apakah mata pelajaran sudah diajar oleh guru lain
    $cek = $koneksi->prepare("SELECT * FROM guru_mapel WHERE id_mapel = ?");
    $cek->bind_param("s", $id_mapel);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Mata pelajaran ini sudah diajar oleh guru lain!'); window.history.back();</script>";
        exit;
    }

    // Insert data baru
    $stmt = $koneksi->prepare("INSERT INTO guru_mapel (id_mapel, nip) VALUES (?, ?)");
    $stmt->bind_param("ss", $id_mapel, $nip);

    if ($stmt->execute()) {
        header('Location: guru-mapel.php?status=added');
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data.'); window.history.back();</script>";
    }
}
?>
