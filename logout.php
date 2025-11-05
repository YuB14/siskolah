<?php
    //aktivasi session php
    session_start();

    //menghapus data session
    session_destroy();

    //redirect ke halaman login
    header("location:login.php");
?>