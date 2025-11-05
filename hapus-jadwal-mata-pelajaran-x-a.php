<?php
// hapus-jadwal-mata-pelajaran-x-a.php

// 1️⃣ Panggil koneksi database
include('./library/koneksi.php');

// 2️⃣ Periksa apakah parameter id_jadwal ada di URL
if (isset($_GET['id_jadwal'])) {
    $id_jadwal = $_GET['id_jadwal'];

    // 3️⃣ Lindungi dari SQL Injection
    $id_jadwal = mysqli_real_escape_string($koneksi, $id_jadwal);

    // 4️⃣ Query hapus data berdasarkan id_jadwal
    $sql = "DELETE FROM jadwal_mapel WHERE id_jadwal = '$id_jadwal'";
    $query = mysqli_query($koneksi, $sql);

    // 5️⃣ Cek hasil eksekusi query
    if ($query) {
        // Jika berhasil dihapus
        header("Location: jadwal-mata-pelajaran-x-a.php?status=deleted");
        exit;
    } else {
        // Jika gagal menghapus
        echo "
            <script>
                alert('Gagal menghapus data jadwal! Silakan coba lagi.');
                window.location.href='jadwal-mata-pelajaran-x-a.php';
            </script>
        ";
        exit;
    }
} else {
    // 6️⃣ Jika tidak ada parameter id_jadwal
    echo "
        <script>
            alert('ID jadwal tidak ditemukan!');
            window.location.href='jadwal-mata-pelajaran-x-a.php';
        </script>
    ";
    exit;
}
?>