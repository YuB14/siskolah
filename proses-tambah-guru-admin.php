<?php
require_once "./library/koneksi.php";

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil semua data
    $nip            = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $nama_lengkap   = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $jabatan        = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $jenis_kelamin  = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tanggal_lahir  = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp          = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email']);
    $tanggal_masuk  = mysqli_real_escape_string($koneksi, $_POST['tanggal_masuk']);
    $status         = mysqli_real_escape_string($koneksi, $_POST['status']);
    $password       = password_hash($_POST['password'], PASSWORD_DEFAULT); // HASH PASSWORD

    // ==============================
    // CEK NIP APAKAH SUDAH ADA
    // ==============================
    $cekNip = mysqli_query($koneksi, "SELECT nip FROM guru WHERE nip='$nip'");
    if (mysqli_num_rows($cekNip) > 0) {
        echo "<script>
                alert('Gagal! NIP sudah terdaftar.');
                window.location.href='tambah-guru-admin.php';
              </script>";
        exit;
    }

    // ==============================
    // PROSES UPLOAD FOTO
    // ==============================
    $fotoName = $_FILES['foto']['name'];
    $fotoTmp  = $_FILES['foto']['tmp_name'];
    $folder   = "uploads/foto-guru/";

    // Jika user upload foto
    if (!empty($fotoName)) {

        // validasi tipe file
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            echo "<script>
                    alert('Format foto tidak valid! Hanya JPG, JPEG, PNG, WEBP');
                    window.location.href='tambah-guru-admin.php';
                  </script>";
            exit;
        }

        // membuat nama file unik
        $newFotoName = "guru_" . time() . "." . $ext;

        // upload file
        move_uploaded_file($fotoTmp, $folder . $newFotoName);
    } else {
        // jika tidak upload gambar
        $newFotoName = "default.png";
    }

    // ==============================
    // SIMPAN DATA GURU KE DATABASE
    // ==============================
    $query = mysqli_query($koneksi, "
        INSERT INTO guru 
        (nip, nama_lengkap, jabatan, jenis_kelamin, tanggal_lahir, alamat, no_hp, email, tanggal_masuk, status, password, foto)
        VALUES
        ('$nip', '$nama_lengkap', '$jabatan', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$no_hp', '$email', '$tanggal_masuk', '$status', '$password', '$newFotoName')
    ");

    if ($query) {
        header('Location: biodata-guru-admin.php?status=added');
    } else {
        echo "<script>
                alert('Gagal menyimpan data!');
                window.location.href='tambah-guru-admin.php';
              </script>";
    }
}
?>