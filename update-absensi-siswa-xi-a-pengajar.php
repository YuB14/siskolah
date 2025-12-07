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
        echo "<script>alert('Data absensi tidak ditemukan!'); window.location='absensi-siswa-xi-a-pengajar.php';</script>";
        exit;
    }

    $data = mysqli_fetch_assoc($query);
} else {
    echo "<script>alert('ID absensi tidak ditemukan!'); window.location='absensi-siswa-xi-a-pengajar.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    session_start();

    if (!isset($_SESSION['guru_login'])) {
        header("Location: login-guru.html");
        exit;
    }

    if ($_SESSION['guru_jabatan'] !== 'Pengajar') {
        header("Location: login-guru.html");
        exit;
    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />
    <title>Siskolah - Update Absensi Siswa XI-A</title>

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard-pengajar.php">
                <div class="sidebar-brand-icon">
                    <img src="./img/school-solid-full.svg" alt="Logo" style="width: 40px; height: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">Siskolah</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Home</div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard-pengajar.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Informasi Sekolah</div>

            <!-- Nav Item - Menu Kolaborasi Biodata -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBiodata"
                    aria-expanded="true" aria-controls="collapseBiodata">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Biodata</span>
                </a>
                <div id="collapseBiodata" class="collapse" aria-labelledby="headingBiodata" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Biodata Pengguna:</h6>
                        <a class="collapse-item" href="biodata-guru-pengajar.php">Guru</a>
                        <a class="collapse-item" href="biodata-siswa-pengajar.php">Siswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="mata-pelajaran-pengajar.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>

            <!-- Nav Item - Jadwal Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="jadwal-mata-pelajaran-pengajar.php">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Jadwal Mata Pelajaran</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Aktivitas Sekolah</div>

            <!-- Nav Item - Absensi Guru -->
            <li class="nav-item">
                <a class="nav-link" href="absensi-guru-pengajar.php">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Absensi Guru</span>
                </a>
            </li>

            <!-- Nav Item - Absensi Siswa -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsensiSiswa"
                    aria-expanded="true" aria-controls="collapseAbsensiSiswa">
                    <i class="fas fa-fw fa-clipboard-check"></i>
                    <span>Absensi Siswa</span>
                </a>
                <div id="collapseAbsensiSiswa" class="collapse" aria-labelledby="headingAbsensiSiswa" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="absensi-siswa-x-a-pengajar.php">X A</a>
                        <a class="collapse-item" href="absensi-siswa-x-b-pengajar.php">X B</a>
                        <a class="collapse-item" href="absensi-siswa-x-c-pengajar.php">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="absensi-siswa-xi-a-pengajar.php">XI A</a>
                        <a class="collapse-item" href="absensi-siswa-xi-b-pengajar.php">XI B</a>
                        <a class="collapse-item" href="absensi-siswa-xi-c-pengajar.php">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="absensi-siswa-xii-a-pengajar.php">XII A</a>
                        <a class="collapse-item" href="absensi-siswa-xii-b-pengajar.php">XII B</a>
                        <a class="collapse-item" href="absensi-siswa-xii-c-pengajar.php">XII C</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Nilai Siswa -->
            <li class="nav-item">
                <a class="nav-link" href="nilai-siswa-pengajar.php">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Nilai Siswa</span>
                </a>
            </li>

            <!-- Nav Item - Kenaikan & Kelulusan -->
            <li class="nav-item">
                <a class="nav-link" href="kenaikan-kelulusan-pengajar.php">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Kenaikan & Kelulusan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">Masukan</div>

            <!-- Nav Item - Pengaduan -->
            <li class="nav-item">
                <a class="nav-link" href="pengaduan-guru-pengajar.php">
                    <i class="fas fa-fw fa-exclamation-triangle"></i>
                    <span>Pengaduan</span>
                </a>
            </li>

            <!-- Nav Item - Kritik & Saran -->
             <li class="nav-item">
                <a class="nav-link" href="tanggapan-kritik-saran-pengajar.php">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Kritik & Saran</span>
                </a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link p-2 mr-2">
                        <i class="fa fa-bars fa-lg"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Pengajar</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Main Content -->
                <div class="container-fluid">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 text-gray-800 mb-0">Update Absensi Siswa XI-A</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="absensi-siswa-xi-a-pengajar.php">Data Absensi Siswa XI-A</a></li>
                            <li class="breadcrumb-item active">Tambah Absensi Siswa XI-A</li>
                        </ol>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Absensi Siswa</h3>
                        </div>

                        <form action="proses-update-absensi-siswa-xi-a-pengajar.php" method="POST" enctype="multipart/form-data">
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
                                    <a href="absensi-siswa-xi-a-pengajar.php" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

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

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apakah anda ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" jika anda benar-benar ingin logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>

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

</body>
</html>
