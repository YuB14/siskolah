<?php
session_start();

// Hapus semua data session
$_SESSION = [];
session_unset();

// Hapus session di server
session_destroy();

// Redirect
header("Location: login-guru.html");
exit;
?>
