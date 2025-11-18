<?php
require_once "./library/koneksi.php";

if (isset($_GET['id_absensi'])) {
    $id_absensi = $_GET['id_absensi'];
    $query = mysqli_query($koneksi, "
    SELECT absensi_siswa.*, siswa.nama_lengkap 
    FROM absensi_siswa 
    JOIN siswa ON absensi_siswa.nisn = siswa.nisn
    WHERE absensi_siswa.id_absensi = '$id_absensi'
");

    if (mysqli_num_rows($query) == 0) {
        echo "<script>alert('Data absensi tidak ditemukan!'); window.location='absensi-siswa.php';</script>";
        exit;
    }

    $data = mysqli_fetch_assoc($query);
} else {
    echo "<script>alert('ID absensi tidak ditemukan!'); window.location='absensi-siswa.php';</script>";
    exit;
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />
    <title>Siskolah - Edit Pengaduan</title>

    <!-- Font & Template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="./img/school-solid-full.svg" alt="Logo" style="width: 40px; height: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">Siskolah</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Keuangan
            </div>

            <!-- Nav Item - Subsidi Pemerintah -->
            <li class="nav-item">
                <a class="nav-link" href="subsidi-pemerintah.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Subsidi Pemerintah</span></a>
            </li>

            <!-- Nav Item - SPP -->
            <li class="nav-item">
                <a class="nav-link" href="spp.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>SPP</span></a>
            </li>

            <!-- Nav Item - Pengeluaran -->
            <li class="nav-item">
                <a class="nav-link" href="pengeluaran.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pengeluaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Informasi Sekolah
            </div>

            <!-- Nav Item - Menu Kolaborasi Biodata -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBiodata"
                    aria-expanded="true" aria-controls="collapseBiodata">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Biodata</span>
                </a>
                <div id="collapseBiodata" class="collapse" aria-labelledby="headingBiodata"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Biodata Pengguna:</h6>
                        <a class="collapse-item" href="biodata-admin.html">Admin</a>
                        <a class="collapse-item" href="biodata-guru.html">Guru</a>
                        <a class="collapse-item" href="biodata-siswa.html">Siswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Kelas -->
            <li class="nav-item">
                <a class="nav-link" href="kelas.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kelas</span></a>
            </li>

            <!-- Nav Item - Guru Mapel -->
            <li class="nav-item">
                <a class="nav-link" href="guru-mapel.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Guru Mapel</span></a>
            </li>

            <!-- Nav Item - Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMapel"
                    aria-expanded="true" aria-controls="collapseMapel">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Mata Pelajaran</span>
                </a>
                <div id="collapseMapel" class="collapse" aria-labelledby="headingMapel" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="#">X A</a>
                        <a class="collapse-item" href="#">X B</a>
                        <a class="collapse-item" href="#">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="#">XI A</a>
                        <a class="collapse-item" href="#">XI B</a>
                        <a class="collapse-item" href="#">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="#">XII A</a>
                        <a class="collapse-item" href="#">XII B</a>
                        <a class="collapse-item" href="#">XII C</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Nilai Siswa
            </div>

            <!-- Nav Item - Absensi Guru -->
            <li class="nav-item">
                <a class="nav-link" href="absensi-guru.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Absensi Guru</span></a>
            </li>

            <!-- Nav Item - Absensi Siswa -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsensiSiswa"
                    aria-expanded="true" aria-controls="collapseAbsensiSiswa">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Absensi Siswa</span>
                </a>
                <div id="collapseAbsensiSiswa" class="collapse" aria-labelledby="headingAbsensiSiswa" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="absensi-siswa.php">X A</a>
                        <a class="collapse-item" href="#">X B</a>
                        <a class="collapse-item" href="#">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="#">XI A</a>
                        <a class="collapse-item" href="#">XI B</a>
                        <a class="collapse-item" href="#">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="#">XII A</a>
                        <a class="collapse-item" href="#">XII B</a>
                        <a class="collapse-item" href="#">XII C</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Nilai Siswa -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNilaiSiswa"
                    aria-expanded="true" aria-controls="collapseNilaiSiswa">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Nilai Siswa</span>
                </a>
                <div id="collapseNilaiSiswa" class="collapse" aria-labelledby="headingNilaiSiswa" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="#">X A</a>
                        <a class="collapse-item" href="#">X B</a>
                        <a class="collapse-item" href="#">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="#">XI A</a>
                        <a class="collapse-item" href="#">XI B</a>
                        <a class="collapse-item" href="#">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="#">XII A</a>
                        <a class="collapse-item" href="#">XII B</a>
                        <a class="collapse-item" href="#">XII C</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                Masukan
            </div>

            <!-- Nav Item - Pengaduan -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaduan"
                    aria-expanded="false" aria-controls="collapsePengaduan">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pengaduan</span>
                </a>

                <div id="collapsePengaduan" class="collapse" aria-labelledby="headingPengaduan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Jenis Pengaduan:</h6>
                        <a class="collapse-item" href="pengaduan.php">Pengaduan Siswa</a>
                        <a class="collapse-item" href="pengaduan-guru.php">Pengaduan Guru</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Kritik & Saran -->
                        <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKritik-saran"
                    aria-expanded="false" aria-controls="collapseKritik-saran">
                    <i class="fas fa-fw fa-table"></i>
                    <span>kritik-saran</span>
                </a>

                    <div id="collapseKritik-saran" class="collapse" aria-labelledby="headingKritk-saran" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Jenis kritik-saran:</h6>
                        <a class="collapse-item" href="kritik-saran.php">Kritik dan saran</a>
                        <a class="collapse-item" href="tanggapan-kritik-saran.php">Tanggapan Kritik & Saran</a>
                    </div>
                </div>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>


<!-- Main Content -->
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800 mb-0">Edit Absensi Siswa</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="pengaduan.php">Data Absensi Siswa</a></li>
            <li class="breadcrumb-item active">Absensi Siswa</li>
        </ol>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Absensi Siswa</h3>
        </div>

        <form action="proses-edit-absensi-siswa.php" method="POST" enctype="multipart/form-data">
            <div class="card-body">

                <!-- ID absensi -->
                <input type="hidden" name="id_absensi" value="<?= $data['id_absensi']; ?>">

                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input type="text" name="nisn" id="nisn" class="form-control"
                        value="<?= htmlspecialchars($data['nisn']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" name="nama_siswa" id="nama_lengkap" class="form-control"
                        value="<?= htmlspecialchars($data['nama_lengkap']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="form-control" value="<?= $data['tanggal']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="status">Status Kehadiran</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Hadir" <?= ($data['status'] == 'Hadir') ? 'selected' : ''; ?>>Hadir</option>
                        <option value="Izin" <?= ($data['status'] == 'Izin') ? 'selected' : ''; ?>>Izin</option>
                        <option value="Sakit" <?= ($data['status'] == 'Sakit') ? 'selected' : ''; ?>>Sakit</option>
                        <option value="Alpa" <?= ($data['status'] == 'Alpa') ? 'selected' : ''; ?>>Alpa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="4" required><?= htmlspecialchars($data['keterangan']); ?></textarea>
                </div>

            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="pengaduan.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Siskolah 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top -->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    
<script>
document.getElementById('nisn').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    document.getElementById('nama_siswa').value = selected.getAttribute('data-nama') || '';
});
</script>

    </script>

</body>
</html>
