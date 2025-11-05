<?php
require_once "./library/koneksi.php";

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form dan amankan
    $nisn           = mysqli_real_escape_string($koneksi, $_POST['nisn']);
    $nama_lengkap   = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $jenis_kelamin  = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tanggal_lahir  = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp          = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email']);
    $id_kelas       = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
    $tanggal_masuk  = mysqli_real_escape_string($koneksi, $_POST['tanggal_masuk']);
    $status         = mysqli_real_escape_string($koneksi, $_POST['status']);
    $password       = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // --- Upload foto ---
    $foto = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];
    $size = $_FILES['foto']['size'];
    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $folder_upload = "uploads/foto-siswa/";

    // Cek folder ada atau tidak
    if (!is_dir($folder_upload)) {
        mkdir($folder_upload, 0777, true);
    }

    $newFileName = "";
    if (!empty($foto)) {
        if ($error === UPLOAD_ERR_OK) {
            if (in_array($ext, $allowed_ext)) {
                if ($size <= 2 * 1024 * 1024) { // max 2MB
                    $newFileName = uniqid("siswa_", true) . "." . $ext;
                    $path = $folder_upload . $newFileName;

                    if (!move_uploaded_file($tmp_name, $path)) {
                        echo "<script>alert('Gagal memindahkan file foto. Cek izin folder server.'); window.history.back();</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Ukuran file foto terlalu besar (max 2MB).'); window.history.back();</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Format file tidak diizinkan. Hanya JPG, JPEG, PNG, GIF.'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat upload foto.'); window.history.back();</script>";
            exit;
        }
    } else {
        $newFileName = "default-avatar.png"; // jika tidak upload foto
    }

    // --- Cek duplikasi NISN ---
    $cek_nisn = mysqli_query($koneksi, "SELECT nisn FROM siswa WHERE nisn = '$nisn'");
    if (mysqli_num_rows($cek_nisn) > 0) {
        echo "<script>alert('NISN sudah terdaftar!'); window.history.back();</script>";
        exit;
    }

    // --- Insert ke database ---
    $query = "INSERT INTO siswa 
        (nisn, nama_lengkap, jenis_kelamin, tanggal_lahir, alamat, no_hp, email, id_kelas, tanggal_masuk, status, password, foto)
        VALUES 
        ('$nisn', '$nama_lengkap', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$no_hp', '$email', '$id_kelas', '$tanggal_masuk', '$status', '$password', '$newFileName')";

    if (mysqli_query($koneksi, $query)) {
        header('Location: biodata-siswa.php?status=added');
    } else {
        echo "<script>
                alert('Gagal menambahkan data siswa: " . mysqli_error($koneksi) . "');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Akses tidak sah!');
            window.location.href='biodata-siswa.php';
          </script>";
}
?>