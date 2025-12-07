<!DOCTYPE html>
<html lang="en">

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

    // Hanya boleh diakses Bendahara
    if ($jabatan !== 'Admin') {
        header("Location: login-guru.html");
        exit;
    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />

    <title>Siskolah - Biodata Siswa</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        /* Card Siswa Styling */
        .student-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }

        .student-photo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #4e73df;
        }

        .student-info {
            font-size: 0.85rem;
        }

        .student-info strong {
            color: #5a5c69;
        }

        .badge-status {
            padding: 0.35em 0.65em;
            font-size: 0.75rem;
        }

        /* Search Box */
        .search-box {
            max-width: 400px;
        }

        /* Filter Badge */
        .filter-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard-admin.php">
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
                <a class="nav-link" href="dashboard-admin.php">
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
                        <a class="collapse-item" href="biodata-guru-admin.php">Guru</a>
                        <a class="collapse-item" href="biodata-siswa-admin.php">Siswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Kelas -->
            <li class="nav-item">
                <a class="nav-link" href="kelas-admin.php">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Kelas</span>
                </a>
            </li>

            <!-- Nav Item - Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="mata-pelajaran-admin.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>

            <!-- Nav Item - Jadwal Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="jadwal-mata-pelajaran-admin.php">
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
                <a class="nav-link" href="absensi-guru-admin.php">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Absensi Guru</span>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
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

                <?php require_once './library/koneksi.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-user-graduate text-primary"></i> Biodata Siswa
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="dashboard-admin.php">Home</a></li>
                                <li class="breadcrumb-item active">Biodata Siswa</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Alert Messages -->
                    <?php if (isset($_GET['status'])): ?>
                        <?php
                        $alertMessages = [
                            'added' => 'Data siswa berhasil ditambah!',
                            'updated' => 'Data siswa berhasil diupdate!',
                            'deleted' => 'Data siswa berhasil dihapus!'
                        ];
                        $status = $_GET['status'];
                        if (isset($alertMessages[$status])):
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <strong>Berhasil!</strong> <?= $alertMessages[$status] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Filter & Search Section -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Search Box -->
                                <div class="col-md-6">
                                    <form method="GET" action="" class="form-inline">
                                        <div class="input-group search-box w-100">
                                            <input type="text" name="keyword" class="form-control" 
                                                   placeholder="Cari NISN, Nama, atau Kelas..." 
                                                   value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search"></i> Cari
                                                </button>
                                                <?php if (isset($_GET['keyword']) && $_GET['keyword'] != ''): ?>
                                                    <a href="biodata-siswa.php" class="btn btn-secondary">
                                                        <i class="fas fa-times"></i> Reset
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Tambah Siswa Button -->
                                <div class="col-md-6 text-right">
                                    <a href="import-excel-biodata-siswa-admin.php" class="btn btn-primary btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-file-excel"></i>
                                        </span>
                                        <span class="text">Import Siswa</span>
                                    </a>
                                    <a href="tambah-siswa-admin.php" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Siswa</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Active Filter Badge -->
                            <?php if (isset($_GET['keyword']) && $_GET['keyword'] != ''): ?>
                            <div class="mt-3">
                                <span class="filter-badge">
                                    <i class="fas fa-filter"></i> Hasil pencarian untuk: 
                                    <strong>"<?= htmlspecialchars($_GET['keyword']) ?>"</strong>
                                </span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php
                    // Ambil input pencarian
                    $keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';

                    // Query berdasarkan kondisi pencarian
                    if ($keyword != '') {
                        $sql = "SELECT siswa.*, kelas.nama_kelas 
                                FROM siswa 
                                LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                                WHERE siswa.nama_lengkap LIKE '%$keyword%' 
                                OR siswa.nisn LIKE '%$keyword%' 
                                OR kelas.nama_kelas LIKE '%$keyword%'
                                ORDER BY siswa.nama_lengkap ASC";
                    } else {
                        $sql = "SELECT siswa.*, kelas.nama_kelas 
                                FROM siswa 
                                LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                                ORDER BY siswa.nama_lengkap ASC";
                    }
                    
                    $query = mysqli_query($koneksi, $sql);
                    $jumlahData = mysqli_num_rows($query);
                    ?>

                    <!-- Info Jumlah Data -->
                    <div class="mb-3">
                        <h6 class="text-gray-700">
                            <i class="fas fa-info-circle text-info"></i> 
                            Menampilkan <strong><?= $jumlahData ?></strong> data siswa
                        </h6>
                    </div>

                    <!-- Cards Siswa -->
                    <?php if ($jumlahData > 0): ?>
                    <div class="row">
                        <?php while($row = mysqli_fetch_assoc($query)): ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card student-card shadow border-left-primary">
                                <div class="card-body text-center">
                                    <!-- Foto Siswa -->
                                    <div class="mb-3">
                                        <?php 
                                        $fotoPath = !empty($row['foto']) ? 'uploads/foto-siswa/' . $row['foto'] : 'assets/img/default-avatar.png';
                                        ?>
                                        <img src="<?= $fotoPath ?>" 
                                             alt="Foto Siswa" 
                                             class="student-photo rounded-circle shadow-sm"
                                             onerror="this.src='assets/img/default-avatar.png'">
                                    </div>

                                    <!-- Nama & Kelas -->
                                    <h5 class="card-title mb-1 text-primary font-weight-bold">
                                        <?= htmlspecialchars($row['nama_lengkap']) ?>
                                    </h5>
                                    <p class="mb-2">
                                        <span class="badge badge-primary">
                                            <?= htmlspecialchars($row['nama_kelas'] ?? 'Belum Ada Kelas') ?>
                                        </span>
                                    </p>

                                    <!-- Divider -->
                                    <hr class="my-2">

                                    <!-- Detail Siswa -->
                                    <div class="student-info text-left">
                                        <p class="mb-1">
                                            <strong><i class="fas fa-id-card text-muted"></i> NISN:</strong> 
                                            <?= $row['nisn'] ?>
                                        </p>
                                        <p class="mb-1">
                                            <strong><i class="fas fa-venus-mars text-muted"></i> Jenis Kelamin:</strong> 
                                            <?= $row['jenis_kelamin'] ?>
                                        </p>
                                        <p class="mb-1">
                                            <strong><i class="fas fa-birthday-cake text-muted"></i> Tanggal Lahir:</strong> 
                                            <?= date('d M Y', strtotime($row['tanggal_lahir'])) ?>
                                        </p>
                                        <p class="mb-1">
                                            <strong><i class="fas fa-map-marker-alt text-muted"></i> Alamat:</strong> 
                                            <?= strlen($row['alamat']) > 30 ? substr($row['alamat'], 0, 30) . '...' : $row['alamat'] ?>
                                        </p>
                                        <p class="mb-2">
                                            <strong><i class="fas fa-flag text-muted"></i> Status:</strong> 
                                            <?php
                                            $statusClass = '';
                                            switch($row['status']) {
                                                case 'Aktif':
                                                    $statusClass = 'badge-success';
                                                    break;
                                                case 'Tidak Aktif':
                                                    $statusClass = 'badge-secondary';
                                                    break;
                                                case 'Lulus':
                                                    $statusClass = 'badge-info';
                                                    break;
                                                default:
                                                    $statusClass = 'badge-warning';
                                            }
                                            ?>
                                            <span class="badge <?= $statusClass ?> badge-status">
                                                <?= $row['status'] ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Card Footer dengan Tombol -->
                                <div class="card-footer bg-white text-center py-2">
                                    <a href="update-siswa-admin.php?nisn=<?= $row['nisn'] ?>" 
                                       class="btn btn-sm btn-warning mr-1" title="Edit Data">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" 
                                            data-toggle="modal" 
                                            data-target="#hapusModal<?= $row['nisn'] ?>"
                                            title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="hapusModal<?= $row['nisn'] ?>" tabindex="-1" role="dialog" 
                             aria-labelledby="hapusModalLabel<?= $row['nisn'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="hapusModalLabel<?= $row['nisn'] ?>">
                                            <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus data siswa:</p>
                                        <div class="alert alert-warning">
                                            <strong>Nama:</strong> <?= htmlspecialchars($row['nama_lengkap']) ?><br>
                                            <strong>NISN:</strong> <?= $row['nisn'] ?><br>
                                            <strong>Kelas:</strong> <?= htmlspecialchars($row['nama_kelas'] ?? '-') ?>
                                        </div>
                                        <p class="text-danger"><strong>Perhatian:</strong> Data yang dihapus tidak dapat dikembalikan!</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                    <a href="hapus-siswa-admin.php?nisn=<?= $row['nisn'] ?>" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i> Ya, Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php else: ?>
                <!-- Tidak Ada Data -->
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-user-slash fa-5x text-gray-300 mb-3"></i>
                        <h4 class="text-gray-600">Tidak Ada Data Siswa</h4>
                        <?php if (isset($_GET['keyword']) && $_GET['keyword'] != ''): ?>
                        <p class="text-muted">Tidak ditemukan data siswa dengan kata kunci "<?= htmlspecialchars($_GET['keyword']) ?>"</p>
                        <a href="biodata-siswa.php" class="btn btn-primary">
                            <i class="fas fa-redo"></i> Tampilkan Semua Data
                        </a>
                        <?php else: ?>
                        <p class="text-muted">Belum ada data siswa yang terdaftar</p>
                        <a href="tambah-siswa.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Siswa Pertama
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Siskolah 2024</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End Content Wrapper -->

</div>
<!-- End Page Wrapper -->

<!-- Scroll to Top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" jika anda benar-benar ingin logout.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- JS Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>