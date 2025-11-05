<?php
// Memanggil koneksi
include './library/koneksi.php';

// Cek apakah ada parameter id_kelas
if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];

    // Siapkan query hapus
    $stmt = $koneksi->prepare("DELETE FROM kelas WHERE id_kelas = ?");
    $stmt->bind_param("s", $id_kelas);

    if ($stmt->execute()) {
        // Jika berhasil hapus, redirect ke halaman kelas dengan status deleted
        header("Location: kelas.php?status=deleted");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Jika tidak ada id_kelas, redirect kembali
    header("Location: kelas.php");
    exit;
}
?>
