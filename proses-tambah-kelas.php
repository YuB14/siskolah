<?php
require_once "./library/koneksi.php";

// Pastikan form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil data dari form
    $id_kelas   = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $nip        = $_POST['nip'];

    // Validasi sederhana
    if (empty($id_kelas) || empty($nama_kelas) || empty($nip)) {
        echo "<script>
                alert('Semua field wajib diisi!');
                window.location.href='tambah-kelas.php';
              </script>";
        exit;
    }

    // Query insert
    $sql = "INSERT INTO kelas (id_kelas, nama_kelas, nip) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $id_kelas, $nama_kelas, $nip);
        $execute = mysqli_stmt_execute($stmt);

        if ($execute) {
            header('Location: kelas.php?status=added');
        } else {
            echo "<script>
                    alert('Gagal menambahkan kelas: " . mysqli_error($koneksi) . "');
                    window.location.href='tambah-kelas.php';
                  </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
                alert('Gagal menyiapkan statement!');
                window.location.href='tambah-kelas.php';
              </script>";
    }
} else {
    // Jika file diakses langsung tanpa submit
    echo "<script>
            alert('Akses tidak valid!');
            window.location.href='kelas.php';
          </script>";
}
?>
