<?php
require_once "./library/koneksi.php";

// Ambil parameter filter dari GET
$filterMapel = $_GET['mapel'] ?? '';
$filterGuru = $_GET['guru'] ?? '';
$filterKelas = $_GET['kelas'] ?? '';

// Inisialisasi array WHERE
$where = [];

// Filter mapel
if ($filterMapel != '') {
    $filterMapel = mysqli_real_escape_string($koneksi, $filterMapel);
    $where[] = "jm.id_mapel = '$filterMapel'";
}

// Filter guru
if ($filterGuru != '') {
    $filterGuru = mysqli_real_escape_string($koneksi, $filterGuru);
    $where[] = "jm.nip = '$filterGuru'";
}

// Filter kelas
if ($filterKelas != '') {
    $filterKelas = mysqli_real_escape_string($koneksi, $filterKelas);
    $where[] = "jm.id_kelas = '$filterKelas'";
}

// Build WHERE clause hanya jika ada filter
$filterSQL = "";
if (!empty($where)) {
    $filterSQL = "WHERE " . implode(" AND ", $where);
}

// Query dengan filter
$sql = "
    SELECT 
        jm.id_jadwal,
        jm.hari,
        mp.nama_mapel,
        g.nama_lengkap,
        k.nama_kelas,
        jm.jam_mulai,
        jm.jam_selesai
    FROM jadwal_mapel jm
    INNER JOIN kelas k ON jm.id_kelas = k.id_kelas
    INNER JOIN mata_pelajaran mp ON jm.id_mapel = mp.id_mapel
    INNER JOIN guru g ON jm.nip = g.nip
    $filterSQL
    ORDER BY 
        CASE 
            WHEN jm.hari = 'Senin' THEN 1
            WHEN jm.hari = 'Selasa' THEN 2
            WHEN jm.hari = 'Rabu' THEN 3
            WHEN jm.hari = 'Kamis' THEN 4
            WHEN jm.hari = 'Jumat' THEN 5
            WHEN jm.hari = 'Sabtu' THEN 6
            WHEN jm.hari = 'Minggu' THEN 7
        END, 
        jm.jam_mulai ASC
";

$query = mysqli_query($koneksi, $sql);

// Cek jika query error
if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}

$jumlahData = mysqli_num_rows($query);
?>

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

    // Hanya boleh diakses Pengajar
    if ($jabatan !== 'Pengajar') {
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

    <title>Siskolah - Jadwal Mata Pelajaran</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Tambahan CSS untuk Active Filters -->
    <style>
    .active-filters {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        align-items: center;
        padding: 0.5rem 0;
    }

    .filter-tag {
        background-color: #4e73df;
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-tag .remove-filter {
        cursor: pointer;
        font-weight: bold;
        font-size: 1.2rem;
        line-height: 1;
        margin-left: 0.25rem;
        transition: color 0.2s;
    }

    .filter-tag .remove-filter:hover {
        color: #ff6b6b;
    }

    .filter-dropdown-menu {
        min-width: 300px;
        padding: 1.25rem;
    }

    .filter-section {
        margin-bottom: 1rem;
    }

    .filter-section:last-child {
        margin-bottom: 0;
    }

    .filter-label {
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        color: #5a5c69;
        display: block;
    }
    
    .btn-equal {
        min-width: 100px;
    }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
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

                <?php
                //memanggil koneksi
                include ('./library/koneksi.php');
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Judul Halaman -->
                        <h1 class="h3 text-gray-800 mb-0">Jadwal Mata Pelajaran</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Jadwal Mapel</li>
                        </ol>
                    </div>

                     <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- Judul Card -->
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Jadwal Mapel</h6>

                            <!-- Container tombol -->
                            <div class="d-flex align-items-center">

                                <!-- DROPDOWN FILTER -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right filter-dropdown-menu"
                                        aria-labelledby="dropdownFilter">
                                        <form id="filterForm">
                                            <!-- PILIH MATA PELAJARAN -->
                                            <div class="filter-section">
                                                <label class="filter-label">
                                                    <i class="fas fa-book text-primary"></i> Mata Pelajaran
                                                </label>
                                                <select id="filterMapel" class="custom-select custom-select-sm">
                                                    <option value="">-- Semua Mapel --</option>
                                                    <?php
                                                    $qMapel = mysqli_query($koneksi, "SELECT * FROM mata_pelajaran ORDER BY nama_mapel ASC");
                                                    while ($m = mysqli_fetch_assoc($qMapel)) {
                                                        $selected = ($filterMapel == $m['id_mapel']) ? 'selected' : '';
                                                        echo "<option value='{$m['id_mapel']}' $selected>{$m['nama_mapel']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- PILIH GURU PENGAJAR -->
                                            <div class="filter-section">
                                                <label class="filter-label">
                                                    <i class="fas fa-user text-primary"></i> Guru Pengajar
                                                </label>
                                                <select id="filterGuru" class="custom-select custom-select-sm">
                                                    <option value="">-- Semua Guru --</option>
                                                    <?php
                                                    $qGuru = mysqli_query($koneksi, "SELECT * FROM guru WHERE jabatan = 'Pengajar' ORDER BY nama_lengkap ASC");
                                                    while ($g = mysqli_fetch_assoc($qGuru)) {
                                                        $selected = ($filterGuru == $g['nip']) ? 'selected' : '';
                                                        echo "<option value='{$g['nip']}' $selected>{$g['nama_lengkap']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- PILIH KELAS -->
                                            <div class="filter-section">
                                                <label class="filter-label">
                                                    <i class="fas fa-school text-primary"></i> Kelas
                                                </label>
                                                <select id="filterKelas" class="custom-select custom-select-sm">
                                                    <option value="">-- Semua Kelas --</option>
                                                    <?php
                                                    $qKelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                                                    while ($k = mysqli_fetch_assoc($qKelas)) {
                                                        $selected = ($filterKelas == $k['id_kelas']) ? 'selected' : '';
                                                        echo "<option value='{$k['id_kelas']}' $selected>{$k['nama_kelas']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- TOMBOL FILTER -->
                                            <div class="filter-section">
                                                <button type="button" class="btn btn-primary btn-sm btn-block" id="btnFilter">
                                                    <i class="fas fa-check"></i> Terapkan Filter
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm btn-block" id="btnResetFilter">
                                                    <i class="fas fa-redo"></i> Reset Filter
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Active Filters Display -->
                        <?php if ($filterMapel != '' || $filterGuru != ''): ?>
                        <div class="card-header py-2 bg-light">
                            <div class="active-filters">
                                <span class="mr-2 font-weight-bold text-muted">Filter Aktif:</span>
                                
                                <?php if ($filterMapel != ''): 
                                    $qNamaMapel = mysqli_query($koneksi, "SELECT nama_mapel FROM mata_pelajaran WHERE id_mapel = '$filterMapel'");
                                    if ($rowMapel = mysqli_fetch_assoc($qNamaMapel)) {
                                        $namaMapel = $rowMapel['nama_mapel'];
                                ?>
                                    <span class="filter-tag">
                                        <i class="fas fa-book"></i> <?php echo htmlspecialchars($namaMapel); ?>
                                        <span class="remove-filter" onclick="removeFilter('mapel')">×</span>
                                    </span>
                                <?php 
                                    }
                                endif; ?>
                                
                                <?php if ($filterGuru != ''): 
                                    $qNamaGuru = mysqli_query($koneksi, "SELECT nama_lengkap FROM guru WHERE nip = '$filterGuru' AND jabatan = 'Pengajar'");
                                    if ($rowGuru = mysqli_fetch_assoc($qNamaGuru)) {
                                        $namaGuru = $rowGuru['nama_lengkap'];
                                ?>
                                    <span class="filter-tag">
                                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($namaGuru); ?>
                                        <span class="remove-filter" onclick="removeFilter('guru')">×</span>
                                    </span>
                                <?php 
                                    }
                                endif; ?>

                                <?php if ($filterKelas != ''): 
                                    $qNamaKelas = mysqli_query($koneksi, "SELECT nama_kelas FROM kelas WHERE id_kelas = '$filterKelas'");
                                    if ($rowKelas = mysqli_fetch_assoc($qNamaKelas)) {
                                        $namaKelas = $rowKelas['nama_kelas'];
                                ?>
                                        <span class="filter-tag">
                                            <i class="fas fa-school"></i> <?= htmlspecialchars($namaKelas); ?>
                                            <span class="remove-filter" onclick="removeFilter('kelas')">×</span>
                                        </span>
                                <?php 
                                    }
                                endif; 
                                ?>

                                <button class="btn btn-sm btn-outline-danger ml-2" onclick="resetAllFilters()">
                                    <i class="fas fa-times"></i> Reset Semua
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Jadwal</th>
                                            <th>Hari</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru Pengajar</th>
                                            <th>Kelas</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // GUNAKAN QUERY YANG SUDAH ADA DI ATAS - JANGAN BUAT QUERY BARU
                                    if ($jumlahData > 0) {
                                        while ($result = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($result['id_jadwal']); ?></td>
                                            <td><?php echo htmlspecialchars($result['hari']); ?></td>
                                            <td><?php echo htmlspecialchars($result['nama_mapel']); ?></td>
                                            <td><?php echo htmlspecialchars($result['nama_lengkap']); ?></td>
                                            <td><?php echo htmlspecialchars($result['nama_kelas']); ?></td>
                                            <td><?php echo htmlspecialchars($result['jam_mulai']); ?></td>
                                            <td><?php echo htmlspecialchars($result['jam_selesai']); ?></td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="9" class="text-center">Tidak ada data jadwal yang ditemukan</td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID Jadwal</th>
                                            <th>Hari</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru Pengajar</th>
                                            <th>Kelas</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="vendor/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- DataTables Buttons JS -->
    <script src="vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="vendor/jszip/jszip.min.js"></script>
    <script src="vendor/pdfmake/pdfmake.min.js"></script>
    <script src="vendor/pdfmake/vfs_fonts.js"></script>

    <!-- JAVASCRIPT untuk Filter - PERBAIKAN: URL YANG BENAR -->
    <script>
    $(document).ready(function() {
        // Fungsi untuk menerapkan filter
        $('#btnFilter').on('click', function() {
            var mapel = $('#filterMapel').val();
            var guru = $('#filterGuru').val();
            var kelas = $('#filterKelas').val();
            
            // Build URL dengan parameter - GUNAKAN NAMA FILE YANG BENAR
            var url = 'jadwal-mata-pelajaran.php?';
            var params = [];
            
            if (mapel !== '') params.push('mapel=' + encodeURIComponent(mapel));
            if (guru !== '') params.push('guru=' + encodeURIComponent(guru));
            if (kelas !== '') params.push('kelas=' + encodeURIComponent(kelas));
            
            if (params.length > 0) {
                url += params.join('&');
            } else {
                url = 'jadwal-mata-pelajaran.php';
            }
            
            // Redirect ke URL dengan filter
            window.location.href = url;
        });
        
        // Fungsi untuk reset filter
        $('#btnResetFilter').on('click', function() {
            window.location.href = 'jadwal-mata-pelajaran.php';
        });
        
        // Enter key untuk apply filter
        $('#filterForm select').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#btnFilter').click();
            }
        });
    });

    // Fungsi untuk remove individual filter
    function removeFilter(type) {
        var url = new URL(window.location.href);
        url.searchParams.delete(type);
        
        // Jika tidak ada parameter lagi, redirect ke halaman tanpa query string
        if (url.search === '' || url.search === '?') {
            window.location.href = 'jadwal-mata-pelajaran.php';
        } else {
            window.location.href = url.toString();
        }
    }

    // Fungsi untuk reset semua filter
    function resetAllFilters() {
        window.location.href = 'jadwal-mata-pelajaran.php';
    }
    </script>

</body>

</html>