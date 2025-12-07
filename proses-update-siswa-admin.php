<?php
require_once "./library/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<script>alert('Akses tidak valid!');window.location='biodata-siswa-admin.php';</script>";
    exit;
}

// Ambil data POST
$nisn_lama      = mysqli_real_escape_string($koneksi, $_POST['nisn_lama']);
$nisn_baru      = mysqli_real_escape_string($koneksi, $_POST['nisn']);
$nama_lengkap   = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
$jenis_kelamin  = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
$tanggal_lahir  = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
$alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$no_hp          = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
$email          = mysqli_real_escape_string($koneksi, $_POST['email']);
$id_kelas       = mysqli_real_escape_string($koneksi, $_POST['id_kelas']);
$tanggal_masuk  = mysqli_real_escape_string($koneksi, $_POST['tanggal_masuk']);
$status         = mysqli_real_escape_string($koneksi, $_POST['status']);
$password       = mysqli_real_escape_string($koneksi, $_POST['password']);

// Ambil data siswa lama
$q = mysqli_query($koneksi, "SELECT foto FROM siswa WHERE nisn = '$nisn_lama'");
$dataLama = mysqli_fetch_assoc($q);
$foto_lama = $dataLama['foto'];

// ===============================
// 1. CEK JIKA NISN DIUBAH → TIDAK BOLEH DUPLIKAT
// ===============================
if ($nisn_lama != $nisn_baru) {
    $cekNISN = mysqli_query($koneksi, "SELECT nisn FROM siswa WHERE nisn = '$nisn_baru' LIMIT 1");
    if (mysqli_num_rows($cekNISN) > 0) {
        echo "<script>alert('NISN baru sudah digunakan oleh siswa lain!');window.history.back();</script>";
        exit;
    }
}

// ===============================
// 2. PROSES UPLOAD FOTO (OPSIONAL)
// ===============================
$nama_file_baru = $foto_lama; // default jika tidak upload foto baru

if (!empty($_FILES['foto']['name'])) {

    $foto      = $_FILES['foto']['name'];
    $tmp       = $_FILES['foto']['tmp_name'];
    $size      = $_FILES['foto']['size'];
    $ext       = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    $allowed   = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($ext, $allowed)) {
        echo "<script>alert('Format foto tidak valid! (jpg/jpeg/png/webp)');window.history.back();</script>";
        exit;
    }

    if ($size > 2000000) { // 2MB
        echo "<script>alert('Ukuran foto terlalu besar! Maksimal 2MB');window.history.back();</script>";
        exit;
    }

    // Nama file unik
    $nama_file_baru = "siswa_" . time() . "." . $ext;

    // Hapus foto lama jika bukan default
    if ($foto_lama != "" && file_exists("uploads/foto-siswa/$foto_lama")) {
        unlink("uploads/foto-siswa/$foto_lama");
    }

    // Upload foto baru
    move_uploaded_file($tmp, "uploads/foto-siswa/" . $nama_file_baru);
}

// ===============================
// 3. PERSIAPAN QUERY UPDATE
// ===============================

$queryUpdate = "
    UPDATE siswa SET
        nisn            = '$nisn_baru',
        nama_lengkap    = '$nama_lengkap',
        jenis_kelamin   = '$jenis_kelamin',
        tanggal_lahir   = '$tanggal_lahir',
        alamat          = '$alamat',
        no_hp           = '$no_hp',
        email           = '$email',
        id_kelas        = '$id_kelas',
        tanggal_masuk   = '$tanggal_masuk',
        status          = '$status',
        foto            = '$nama_file_baru'
";

// Jika password diisi → update
if (!empty($password)) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $queryUpdate .= ", password = '$password_hash'";
}

$queryUpdate .= " WHERE nisn = '$nisn_lama'";

// ===============================
// 4. EKSEKUSI QUERY UPDATE
// ===============================
$update = mysqli_query($koneksi, $queryUpdate);

if ($update) {
    header("Location: biodata-siswa-admin.php?status=updated");
} else {
    echo "<script>
            alert('Gagal memperbarui data: " . addslashes(mysqli_error($koneksi)) . "');
            window.history.back();
          </script>";
}
?>