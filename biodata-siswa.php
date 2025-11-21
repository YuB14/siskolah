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

    <title>Siskolah - Biodata Siswa</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">

    <style>
        /* Tabel rapi */
        #dataTable th, #dataTable td {
            padding: 0.75rem 0.5rem;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        #dataTable tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        td.text-center a.btn {
            margin: 0 2px;
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

                <?php include('./library/koneksi.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 text-gray-800 mb-0">Biodata Siswa</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Data Siswa</li>
                        </ol>
                    </div>

                    <!-- ALERT SUKSES TAMBAH -->
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'added'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data siswa berhasil ditambah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <?php endif; ?>

                    <!-- ALERT SUKSES HAPUS -->
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data siswa berhasil diupdate!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <?php endif; ?>

                    <!-- ALERT SUKSES HAPUS -->
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data siswa berhasil dihapus!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <?php endif; ?>

                    <!-- Card Tabel -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Siswa</h6>
                            <div class="d-flex align-items-center">
                                <!-- Tambah Siswa -->
                                <a href="tambah-siswa.php" class="btn btn-sm btn-primary btn-icon-split mr-2">
                                    <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                                    <span class="text">Tambah Siswa</span>
                                </a>

                                <!-- Dropdown Visibility -->
                                <div class="dropdown mr-2">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                        id="dropdownVisibility" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-eye mr-1"></i> Visibility
                                    </button>
                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownVisibility">
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="0" id="colNISN" checked><label class="form-check-label" for="colNISN">NISN</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="1" id="colNama" checked><label class="form-check-label" for="colNama">Nama Lengkap</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="2" id="colJK" checked><label class="form-check-label" for="colJK">Jenis Kelamin</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="3" id="colTTL" checked><label class="form-check-label" for="colTTL">Tanggal Lahir</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="4" id="colAlamat" checked><label class="form-check-label" for="colAlamat">Alamat</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="5" id="colNoHP" checked><label class="form-check-label" for="colNoHP">No HP</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="6" id="colEmail" checked><label class="form-check-label" for="colEmail">Email</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="7" id="colKelas" checked><label class="form-check-label" for="colKelas">Kelas</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="8" id="colTanggalMasuk" checked><label class="form-check-label" for="colTanggalMasuk">Tanggal Masuk</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="9" id="colStatus" checked><label class="form-check-label" for="colStatus">Status</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="10" id="colEdit" checked><label class="form-check-label" for="colEdit">Edit</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="11" id="colHapus" checked><label class="form-check-label" for="colHapus">Hapus</label></div>
                                    </div>
                                </div>

                                <!-- Search Bar -->
                                <form method="GET" action="">
                                    <div class="input-group mb-3">
                                        <input type="text" name="keyword" 
                                            class="form-control" 
                                            placeholder="Cari nama siswa..."
                                            value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                                        <button class="btn btn-primary" type="submit">Cari</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                            <?php
                            // Pastikan koneksi sudah ada
                            require_once './library/koneksi.php';

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
                            while($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <div class="col-md-4 col-lg-3 mb-4">
                                    <div class="card shadow-sm border-0 h-100">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <img src="uploads/foto-siswa/<?php echo $row['foto']; ?>" 
                                                    alt="Foto Siswa" 
                                                    class="rounded-circle" 
                                                    width="90" height="90"
                                                    onerror="this.src='assets/img/default-avatar.png'">
                                            </div>
                                            <h5 class="card-title mb-1 text-primary"><?php echo $row['nama_lengkap']; ?></h5>
                                            <p class="mb-1 text-muted"><?php echo $row['nama_kelas']; ?></p>
                                            <p class="small mb-1"><strong>NISN:</strong> <?php echo $row['nisn']; ?></p>
                                            <p class="small mb-1"><strong>Jenis Kelamin:</strong> <?php echo $row['jenis_kelamin']; ?></p>
                                            <p class="small mb-1"><strong>Tanggal Lahir:</strong> <?php echo date('d-m-Y', strtotime($row['tanggal_lahir'])); ?></p>
                                            <p class="small mb-1"><strong>Status:</strong> <?php echo $row['status']; ?></p>
                                        </div>
                                        <div class="card-footer bg-white text-center">
                                            <a href="update-siswa.php?nisn=<?php echo $row['nisn']; ?>" 
                                            class="btn btn-sm btn-warning mr-2">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <button class="btn btn-sm btn-danger" 
                                                    data-toggle="modal" 
                                                    data-target="#hapusModal<?php echo $row['nisn']; ?>">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapusModal<?php echo $row['nisn']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?php echo $row['nisn']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel<?php echo $row['nisn']; ?>">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data siswa <strong><?php echo $row['nama_lengkap']; ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <a href="hapus-siswa.php?nisn=<?php echo $row['nisn']; ?>" class="btn btn-danger">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End Content -->

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
        <!-- End Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->

    <!-- Scroll to Top -->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

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

    <!-- JS Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- DataTables JS -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <!-- Buttons -->
    <script src="vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="vendor/jszip/jszip.min.js"></script>
    <script src="vendor/pdfmake/pdfmake.min.js"></script>
    <script src="vendor/pdfmake/vfs_fonts.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                responsive: true,
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" + // length menu + search sejajar
                    "<'row'<'col-12'B>>" +               // buttons
                    "<'row'<'col-12'tr>>" +              // table
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>", 
                buttons: [
                    { extend: 'pdfHtml5', text: 'Export PDF', className: 'd-none' },
                    { extend: 'excelHtml5', text: 'Export Excel', className: 'd-none' },
                    { extend: 'csvHtml5', text: 'Export CSV', className: 'd-none' },
                    { extend: 'copyHtml5', text: 'Copy', className: 'd-none' },
                    { extend: 'print', text: 'Print', className: 'd-none' }
                ]
            });

            // Mapping dropdown item text ke tombol DataTables
            var buttonMap = {
                'Export PDF': 0,
                'Export Excel': 1,
                'Export CSV': 2,
                'Copy': 3,
                'Print': 4
            };

            // Generate Report dropdown
            $('#dropdownReport .dropdown-item').each(function() {
                var btnText = $(this).text().trim();
                $(this).on('click', function(e){
                    e.preventDefault();
                    var btnIndex = buttonMap[btnText];
                    if (btnIndex !== undefined) {
                        table.button(btnIndex).trigger();
                    }
                });
            });

            // Toggle kolom visibility
            $('.col-toggle').on('change', function() {
                var colIndex = $(this).val();
                table.column(colIndex).visible($(this).is(':checked'));
            });
        });
    </script>

</body>
</html>