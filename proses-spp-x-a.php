<?php
require_once "./library/koneksi.php";

// Cek apakah tombol simpan ditekan
if (isset($_POST['simpan'])) {
    
    // Ambil data dari form
    $id_kelas = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $tahun_ajaran = mysqli_real_escape_string($koneksi, $_POST['tahun_ajaran']);
    $nisn_array = isset($_POST['nisn']) ? $_POST['nisn'] : [];
    $bulan_array = isset($_POST['bulan']) ? $_POST['bulan'] : [];
    
    // Validasi input
    if (empty($nisn_array)) {
        header("Location: spp-x-a.php?status=error&msg=Pilih minimal 1 siswa");
        exit();
    }
    
    if (empty($bulan_array)) {
        header("Location: spp-x-a.php?status=error&msg=Pilih minimal 1 bulan");
        exit();
    }
    
    // Tanggal bayar = hari ini
    $tanggal_bayar = date('Y-m-d');
    
    // Counter untuk tracking
    $berhasil = 0;
    $gagal = 0;
    $sudah_ada = 0;
    
    // Begin transaction untuk keamanan data
    mysqli_begin_transaction($koneksi);
    
    try {
        // Loop setiap siswa yang dipilih
        foreach ($nisn_array as $nisn) {
            $nisn = mysqli_real_escape_string($koneksi, $nisn);
            
            // Loop setiap bulan yang dipilih
            foreach ($bulan_array as $bulan) {
                $bulan = mysqli_real_escape_string($koneksi, $bulan);
                
                // Cek apakah data sudah ada
                $cekQuery = mysqli_query($koneksi, "
                    SELECT id_pembayaran, status 
                    FROM pembayaran_spp 
                    WHERE nisn = '$nisn' 
                    AND bulan = '$bulan' 
                    AND tahun_ajaran = '$tahun_ajaran'
                ");
                
                if (mysqli_num_rows($cekQuery) > 0) {
                    // Data sudah ada, cek statusnya
                    $dataCek = mysqli_fetch_assoc($cekQuery);
                    
                    if ($dataCek['status'] === 'Lunas') {
                        // Sudah lunas, skip
                        $sudah_ada++;
                        continue;
                    } else {
                        // Update status jadi lunas (untuk status 'Belum Lunas')
                        $updateQuery = "
                            UPDATE pembayaran_spp 
                            SET status = 'Lunas',
                                tanggal_bayar = '$tanggal_bayar'
                            WHERE id_pembayaran = '{$dataCek['id_pembayaran']}'
                        ";
                        
                        if (mysqli_query($koneksi, $updateQuery)) {
                            $berhasil++;
                        } else {
                            $gagal++;
                            throw new Exception("Gagal update: " . mysqli_error($koneksi));
                        }
                    }
                } else {
                    // Data belum ada, insert baru
                    $insertQuery = "
                        INSERT INTO pembayaran_spp 
                        (nisn, id_kelas, bulan, tahun_ajaran, tanggal_bayar, status) 
                        VALUES 
                        ('$nisn', '$id_kelas', '$bulan', '$tahun_ajaran', '$tanggal_bayar', 'Lunas')
                    ";
                    
                    if (mysqli_query($koneksi, $insertQuery)) {
                        $berhasil++;
                    } else {
                        $gagal++;
                        throw new Exception("Gagal insert: " . mysqli_error($koneksi));
                    }
                }
            }
        }
        
        // Commit transaction jika semua berhasil
        mysqli_commit($koneksi);
        
        // Redirect dengan pesan sukses
        $message = "$berhasil pembayaran berhasil disimpan";
        if ($sudah_ada > 0) {
            $message .= ", $sudah_ada sudah lunas sebelumnya";
        }
        if ($gagal > 0) {
            $message .= ", $gagal gagal";
        }
        
        header("Location: spp-x-a.php?status=added&msg=" . urlencode($message));
        exit();
        
    } catch (Exception $e) {
        // Rollback jika ada error
        mysqli_rollback($koneksi);
        
        header("Location: spp-x-a.php?status=error&msg=" . urlencode("Terjadi kesalahan: " . $e->getMessage()));
        exit();
    }
    
} else {
    // Jika akses langsung tanpa submit
    header("Location: spp-x-a.php");
    exit();
}
?>