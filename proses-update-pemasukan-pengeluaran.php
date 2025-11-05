<?php
require_once './library/koneksi.php';

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dari form
    $id_keuangan = $_POST['id_keuangan'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis']; // pastikan name di form untuk penanggung jawab bukan 'jenis', nanti akan konflik
    $kategori = $_POST['kategori'];
    $jumlah = str_replace(['Rp ', '.', ','], ['', '', '.'], $_POST['jumlah']); // hapus Rp, titik ribuan, ubah koma jadi titik
    $keterangan = $_POST['keterangan'];
    $nip = $_POST['nip']; // ambil penanggung jawab

    // Validasi minimal
    if(empty($id_keuangan) || empty($tanggal) || empty($jenis) || empty($kategori) || empty($jumlah) || empty($nip)){
        die("Data tidak lengkap!");
    }

    // Query update
    $updateSQL = "UPDATE keuangan SET 
                    tanggal = '$tanggal',
                    jenis = '$jenis',
                    kategori = '$kategori',
                    jumlah = '$jumlah',
                    keterangan = '$keterangan',
                    nip = '$nip'
                  WHERE id_keuangan = '$id_keuangan'";

    if(mysqli_query($koneksi, $updateSQL)){
        // Redirect ke halaman utama dengan status sukses
        header("Location: pemasukan-pengeluaran.php?status=updated");
        exit;
    } else {
        // Jika gagal update
        echo "Gagal update data: " . mysqli_error($koneksi);
    }
} else {
    // Jika akses langsung file
    header("Location: pemasukan-pengeluaran.php");
    exit;
}
