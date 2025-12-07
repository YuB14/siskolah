<?php
session_start();
include './library/koneksi.php'; // koneksi sudah benar

// Pastikan form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    // Cek email
    $query = mysqli_query($koneksi, 
        "SELECT * FROM siswa WHERE email = '$email' LIMIT 1"
    );

    if (mysqli_num_rows($query) === 1) {

        $data = mysqli_fetch_assoc($query);

        // Cek password HASH
        if (password_verify($password, $data['password'])) {

            // ---- SET SESSION LOGIN SISWA ----
            $_SESSION['login_siswa'] = true;
            $_SESSION['nisn'] = $data['nisn'];   // PENTING!
            $_SESSION['id_siswa'] = $data['id_siswa'];
            $_SESSION['nama_siswa'] = $data['nama_lengkap'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['id_kelas'] = $data['id_kelas'];

            header("Location: kelas-siswa.php");
            exit;
        } 
        else {
            echo "<script>
                alert('Password salah!');
                window.location.href='login-siswa.html';
            </script>";
            exit;
        }

    } else {
        echo "<script>
            alert('Email tidak terdaftar!');
            window.location.href='login-siswa.html';
        </script>";
        exit;
    }

} else {
    header("Location: login-siswa.html");
    exit;
}
?>