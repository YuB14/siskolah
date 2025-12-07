<?php
session_start();

// Cek apakah siswa sudah login
if (!isset($_SESSION['login_siswa']) || $_SESSION['login_siswa'] !== true) {
    header("Location: login-siswa.html?msg=belum_login");
    exit;
}

// (Opsional) tambah keamanan regenerate session
if (!isset($_SESSION['regenerated'])) {
    session_regenerate_id(true);
    $_SESSION['regenerated'] = true;
}
?>
