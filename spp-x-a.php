<?php
require_once "./library/koneksi.php";

// Ambil id_kelas dari nama kelas X-A
$queryKelas = mysqli_query($koneksi, "SELECT id_kelas FROM kelas WHERE nama_kelas = 'X-A'");
$dataKelas  = mysqli_fetch_assoc($queryKelas);
$id_kelas   = $dataKelas['id_kelas'];

// Ambil siswa berdasarkan id_kelas
$querySiswa = mysqli_query($koneksi, "
    SELECT nisn, nama_lengkap 
    FROM siswa 
    WHERE id_kelas = '$id_kelas'
    ORDER BY nama_lengkap ASC
");

if (!$querySiswa) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Ambil semua data pembayaran untuk siswa di kelas ini
$queryPembayaran = mysqli_query($koneksi, "
    SELECT nisn, bulan, status 
    FROM pembayaran_spp 
    WHERE nisn IN (SELECT nisn FROM siswa WHERE id_kelas = '$id_kelas')
    AND status = 'Lunas'
");

$statusBayarAll = [];
while ($row = mysqli_fetch_assoc($queryPembayaran)) {
    $statusBayarAll[$row['nisn']][$row['bulan']] = $row['status'];
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

    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />

    <title>Siskolah - SPP Kelas X-A</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
    .lunas {
        background-color: #28a745 !important;
        color: white !important;
        font-weight: bold;
        border-radius: 8px;
        padding: 5px;
    }
    .belum-lunas {
        background-color: #dc3545 !important;
        color: white !important;
        font-weight: bold;
        border-radius: 8px;
        padding: 5px;
    }
    .bulan-label {
        cursor: pointer;
        transition: all 0.3s;
    }
    .bulan-label:hover {
        transform: scale(1.05);
    }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.html">
                <div class="sidebar-brand-icon">
                    <img src="./img/school-solid-full.svg" alt="Logo" style="width: 40px; height: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">Siskolah</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Keuangan
            </div>

            <!-- Nav Item - Pemasukan & Pengeluaran -->
            <li class="nav-item">
                <a class="nav-link" href="pemasukan-pengeluaran.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pemasukan & Pengeluaran</span></a>
            </li>

            <!-- Nav Item - SPP -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSPP"
                    aria-expanded="true" aria-controls="collapseSPP">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>SPP</span>
                </a>
                <div id="collapseSPP" class="collapse" aria-labelledby="headingSPP" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="spp-x-a.php">X A</a>
                        <a class="collapse-item" href="spp-x-b.php">X B</a>
                        <a class="collapse-item" href="spp-x-c.php">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="spp-xi-a.php">XI A</a>
                        <a class="collapse-item" href="spp-xi-b.php">XI B</a>
                        <a class="collapse-item" href="spp-xi-c.php">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="spp-xii-a.php">XII A</a>
                        <a class="collapse-item" href="spp-xii-b.php">XII B</a>
                        <a class="collapse-item" href="spp-xii-c.php">XII C</a>
                    </div>
                </div>
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
                        <a class="collapse-item" href="biodata-guru.php">Guru</a>
                        <a class="collapse-item" href="biodata-siswa.php">Siswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Kelas -->
            <li class="nav-item">
                <a class="nav-link" href="kelas.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kelas</span></a>
            </li>

            <!-- Nav Item - Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="mata-pelajaran.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Mata Pelajaran</span></a>
            </li>

            <!-- Nav Item - Jadwal Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseJadwalMapel"
                    aria-expanded="true" aria-controls="collapseJadwalMapel">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Jadwal Mata Pelajaran</span>
                </a>
                <div id="collapseJadwalMapel" class="collapse" aria-labelledby="headingJadwalMapel" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-x-a.php">X A</a>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-x-b.php">X B</a>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-x-c.php">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-xi-a.php">XI A</a>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-xi-b.php">XI B</a>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-xi-c.php">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-xii-a.php">XII A</a>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-xii-b.php">XII B</a>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-xii-c.php">XII C</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Aktivitas Sekolah
            </div>

            <!-- Nav Item - Absensi Guru -->
            <li class="nav-item">
                <a class="nav-link" href="absensi-guru.php">
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
                        <a class="collapse-item" href="absensi-siswa-x-a.php">X A</a>
                        <a class="collapse-item" href="absensi-siswa-x-b.php">X B</a>
                        <a class="collapse-item" href="absensi-siswa-x-c.php">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="absensi-siswa-xi-a.php">XI A</a>
                        <a class="collapse-item" href="absensi-siswa-xi-b.php">XI B</a>
                        <a class="collapse-item" href="absensi-siswa-xi-c.php">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="absensi-siswa-xii-a.php">XII A</a>
                        <a class="collapse-item" href="absensi-siswa-xii-a.php">XII B</a>
                        <a class="collapse-item" href="absensi-siswa-xii-a.php">XII C</a>
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
                        <a class="collapse-item" href="nilai-siswa-x-a.php">X A</a>
                        <a class="collapse-item" href="nilai-siswa-x-b.php">X B</a>
                        <a class="collapse-item" href="nilai-siswa-x-c.php">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="nilai-siswa-xi-a.php">XI A</a>
                        <a class="collapse-item" href="nilai-siswa-xi-b.php">XI B</a>
                        <a class="collapse-item" href="nilai-siswa-xi-c.php">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="nilai-siswa-xii-a.php">XII A</a>
                        <a class="collapse-item" href="nilai-siswa-xii-b.php">XII B</a>
                        <a class="collapse-item" href="nilai-siswa-xii-c.php">XII C</a>
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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
                        <h1 class="h3 text-gray-800 mb-0">SPP Kelas X-A</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                            <li class="breadcrumb-item active">Data SPP Kelas X-A</li>
                        </ol>
                    </div>

                    <!-- ALERT SUKSES TAMBAH UPDATE HAPUS -->
                    <?php
                    function showAlert($status, $message) {
                        if (isset($_GET['status']) && $_GET['status'] == $status) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
                                . $message .
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                                    <span aria-hidden="true">&times;</span>
                                </button></div>';
                        }
                    }

                    showAlert('added', 'Data SPP kelas X-A berhasil ditambah!');
                    showAlert('updated', 'Data SPP kelas X-A diupdate!');
                    showAlert('deleted', 'Data SPP kelas X-A dihapus!');
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- Judul Card -->
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data SPP Kelas X-A</h6>
                            
                        </div>
                        <div class="card-body">

                            <form method="POST" action="proses-spp-x-a.php">
                                <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">

                                <div class="row">
                                    <!-- PANEL KIRI – DATA SISWA -->
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="font-weight-bold text-primary mb-0">Cari Siswa</h5>
                                                <div>
                                                    <button type="button" id="selectAll" class="btn btn-sm btn-primary">Pilih Semua</button>
                                                    <button type="button" id="deselectAll" class="btn btn-sm btn-secondary">Batal Semua</button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" id="searchSiswa" class="form-control" placeholder="Cari NISN / Nama...">
                                            </div>

                                            <div class="border rounded p-3" style="max-height: 400px; overflow-y:auto;">
                                                <?php 
                                                mysqli_data_seek($querySiswa, 0); // Reset pointer
                                                while ($row = mysqli_fetch_assoc($querySiswa)) { 
                                                ?>
                                                    <div class="card shadow-sm mb-2 siswa-item">
                                                        <div class="card-body d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <strong><?= htmlspecialchars($row['nama_lengkap']); ?></strong><br>
                                                                <small>NISN: <?= $row['nisn']; ?></small>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" name="nisn[]" value="<?= $row['nisn']; ?>" class="siswa-checkbox">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="tahunAjaranSelect">Pilih Tahun Ajaran</label>
                                                <select name="tahun_ajaran" class="custom-select form-control-sm" id="tahunAjaranSelect">
                                                    <?php
                                                    $start = 2023;
                                                    $jumlah = 5;
                                                    
                                                    for ($i = 0; $i < $jumlah; $i++) {
                                                        $th = $start + $i;
                                                        $next = $th + 1;
                                                        $selected = ("$th/$next" == $tahunAjaran) ? 'selected' : '';
                                                        echo "<option value='$th/$next' $selected>$th/$next</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PANEL KANAN – PILIH BULAN -->
                                    <div class="col-md-8">
                                        <div class="card shadow p-3">
                                            <h5 class="font-weight-bold mb-3 text-primary">Pilih Bulan Pembayaran</h5>
                                            <small class="text-muted mb-3">Hijau = Lunas, Merah = Belum Lunas, Abu-abu = Dapat dipilih</small>

                                            <div class="row" id="bulanContainer">
                                                <?php
                                                $bulan_arr = ["JAN","FEB","MAR","APR","MEI","JUN","JUL","AGU","SEP","OKT","NOV","DES"];
                                                foreach ($bulan_arr as $b) {
                                                ?>
                                                <div class="col-md-4 mb-3">
                                                    <label class="card p-2 bulan-label bg-light" data-bulan="<?= $b ?>">
                                                        <input type="checkbox" name="bulan[]" value="<?= $b ?>" class="bulan-checkbox">
                                                        <strong class="ml-2"><?= $b ?></strong>
                                                    </label>
                                                </div>
                                                <?php } ?>
                                            </div>

                                            <button type="submit" name="simpan" class="btn btn-success btn-block mt-3">
                                                Simpan Pembayaran
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>    
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

    <!-- Script custom toggle Visibility + hubungkan Generate Report -->
    <script>
    $(document).ready(function() {
        // Cek apakah DataTable sudah diinisialisasi
        var table;
        if ( ! $.fn.DataTable.isDataTable('#dataTable') ) {
            table = $('#dataTable').DataTable({
                dom: 'Bfrtip', // menampilkan tombol DataTables
                buttons: [
                    { extend: 'pdfHtml5', text: 'Export PDF', className: 'd-none' },
                    { extend: 'excelHtml5', text: 'Export Excel', className: 'd-none' },
                    { extend: 'csvHtml5', text: 'Export CSV', className: 'd-none' },
                    { extend: 'copyHtml5', text: 'Copy', className: 'd-none' },
                    { extend: 'print', text: 'Print', className: 'd-none' }
                ]
            });
        } else {
            table = $('#dataTable').DataTable();
        }

        // Hubungkan dropdown custom Generate Report
        $('#dropdownReport .dropdown-item').each(function() {
            var btnText = $(this).text().trim();
            $(this).on('click', function(e){
                e.preventDefault();
                table.button(btnText).trigger();
            });
        });

        // Toggle kolom Visibility
        $('.col-toggle').on('change', function() {
            var colIndex = $(this).val();
            var column = table.column(colIndex);
            column.visible($(this).is(':checked'));
        });
    });
    </script>

    <script>
    // Data status pembayaran dari PHP
    const statusBayarData = <?= json_encode($statusBayarAll) ?>;

    $(document).ready(function() {
        // Fungsi update tampilan bulan
        function updateBulanDisplay() {
            let selectedNisn = [];
            
            // Ambil semua siswa yang dipilih
            $('.siswa-checkbox:checked').each(function() {
                selectedNisn.push($(this).val());
            });

            // Reset semua bulan ke default
            $('.bulan-label').each(function() {
                let bulan = $(this).data('bulan');
                let checkbox = $(this).find('.bulan-checkbox');
                
                if (selectedNisn.length === 0) {
                    // Tidak ada siswa dipilih
                    $(this).removeClass('lunas belum-lunas').addClass('bg-light');
                    checkbox.prop('disabled', true).prop('checked', false);
                    checkbox.show();
                    $(this).find('strong').text(bulan);
                } else {
                    // Cek status pembayaran untuk bulan ini
                    let semuaLunas = true;
                    let adaLunas = false;
                    
                    selectedNisn.forEach(nisn => {
                        if (statusBayarData[nisn] && statusBayarData[nisn][bulan] === 'Lunas') {
                            adaLunas = true;
                        } else {
                            semuaLunas = false;
                        }
                    });
                    
                    if (semuaLunas && adaLunas) {
                        // Semua siswa sudah lunas
                        $(this).removeClass('bg-light belum-lunas').addClass('lunas');
                        checkbox.hide();
                        $(this).find('strong').html('✔ ' + bulan);
                    } else if (adaLunas && !semuaLunas) {
                        // Sebagian lunas, sebagian belum
                        $(this).removeClass('bg-light lunas').addClass('belum-lunas');
                        checkbox.prop('disabled', false).show();
                        $(this).find('strong').text(bulan + ' (Sebagian)');
                    } else {
                        // Belum ada yang lunas
                        $(this).removeClass('lunas').addClass('bg-light belum-lunas');
                        checkbox.prop('disabled', false).prop('checked', false).show();
                        $(this).find('strong').text(bulan);
                    }
                }
            });
        }

        // Event listener untuk checkbox siswa
        $('.siswa-checkbox').on('change', updateBulanDisplay);

        // Pilih semua siswa
        $('#selectAll').on('click', function() {
            $('.siswa-checkbox').prop('checked', true);
            updateBulanDisplay();
        });

        // Batal semua siswa
        $('#deselectAll').on('click', function() {
            $('.siswa-checkbox').prop('checked', false);
            updateBulanDisplay();
        });

        // Pencarian siswa
        $('#searchSiswa').on('keyup', function() {
            let filter = this.value.toLowerCase();
            $('.siswa-item').each(function() {
                let nama = $(this).find('strong').text().toLowerCase();
                let nisn = $(this).find('small').text().toLowerCase();
                
                if (nama.includes(filter) || nisn.includes(filter)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Init tampilan
        updateBulanDisplay();
    });
    </script>
    
</body>
</html>