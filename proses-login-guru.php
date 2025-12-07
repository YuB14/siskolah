<?php
session_start();
require_once "./library/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Ambil data guru berdasarkan email
    $query = mysqli_query($koneksi, "
        SELECT * FROM guru WHERE email = '$email' LIMIT 1
    ");

    if (mysqli_num_rows($query) === 1) {
        $data = mysqli_fetch_assoc($query);

        // Verifikasi password hash
        if (password_verify($password, $data['password'])) {

            // Simpan session
            $_SESSION['guru_login'] = true;
            $_SESSION['guru_nip'] = $data['nip'];
            $_SESSION['guru_nama'] = $data['nama_lengkap'];
            $_SESSION['guru_jabatan'] = $data['jabatan'];

            // Arahkan berdasarkan jabatan
            switch ($data['jabatan']) {

                case 'Kepala Sekolah':
                    header("Location: dashboard.php");
                    exit;

                case 'Bendahara':
                    header("Location: dashboard-bendahara.php");
                    exit;

                case 'Admin':
                    header("Location: dashboard-admin.php");
                    exit;

                case 'Pengajar':
                    header("Location: dashboard-pengajar.php");
                    exit;

                default:
                    // Jika jabatan tidak dikenali
                    header("Location: ./guru/dashboard.php");
                    exit;
            }
        } 
        else {
            // Password salah
            echo "<script>alert('Password salah!'); window.history.back();</script>";
            exit;
        }
    } 
    else {
        // Email tidak ditemukan
        echo "<script>alert('Email tidak ditemukan!'); window.history.back();</script>";
        exit;
    }
} 
else {
    echo "Akses ditolak.";
    exit;
}
?>