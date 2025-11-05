<?php
include('./library/koneksi.php');

if (!isset($_GET['id_mapel'])) {
    header('Location: mata-pelajaran.php');
    exit;
}

$id_mapel = $_GET['id_mapel'];

// Prepared statement dengan string
$stmt = $koneksi->prepare("DELETE FROM mata_pelajaran WHERE id_mapel = ?");
$stmt->bind_param("s", $id_mapel);

if ($stmt->execute()) {
    header("Location: mata-pelajaran.php?status=deleted");
    exit;
} else {
    echo "Terjadi kesalahan saat menghapus data: " . $stmt->error;
}

$stmt->close();
$koneksi->close();
?>
