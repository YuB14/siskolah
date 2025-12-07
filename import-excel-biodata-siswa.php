<!DOCTYPE html>
<html>
<head>

    <?php
    session_start();

    // Jika belum login
    if (!isset($_SESSION['guru_login'])) {
        header("Location: login-guru.html");
        exit;
    }

    // Ambil jabatan dari session login guru
    $jabatan = $_SESSION['guru_jabatan']; 

    // Hanya boleh diakses Admin
    if ($jabatan !== 'Admin') {
        header("Location: login-guru.html");
        exit;
    }
    ?>

    <title>Import Excel Siswa</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h3><i class="fas fa-file-excel"></i> Import Data Siswa</h3>
                </div>
                <div class="card-body">
                    <form action="proses-import-excel-siswa.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Pilih File Excel (.xlsx)</label>
                            <input type="file" name="fileexcel" class="form-control" accept=".xlsx" required>
                            <small class="text-muted mt-2">
                                <b>Urutan kolom di Excel:</b><br>
                                NISN | Nama Lengkap | Kelas | Alamat<br>
                                Contoh: 1 | Andi Saputra | 10-A | Jl. Merpati No. 12<br>
                                <span style="color:green;"> HARUS SESUAI!</span>
                            </small>
                        </div>
                        <button type="submit" class="btn btn-success btn-block btn-lg">
                            <i class="fas fa-upload"></i> Upload & Import 
                        </button>
                    </form>
                    <hr>
                    <a href="biodata-siswa-admin.php" class="btn btn-secondary btn-block">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>