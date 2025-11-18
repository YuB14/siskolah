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

    <title>Siskolah - Absensi Siswa X-A</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Buttons extension -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Buttons extension JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>

    <!-- File export dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

<body id="page-top">

    <!-- Page Wrapper -->
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
                        <a class="collapse-item" href="">X A</a>
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
                    <span>Mata Pelajaran</span>
                </a>
                <div id="collapseJadwalMapel" class="collapse" aria-labelledby="headingJadwalMapel" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="jadwal-mata-pelajaran-x-a.php">X A</a>
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
                        <a class="collapse-item" href="nilai-siswa-x-a.php">X A</a>
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
        <span class="badge badge-danger badge-counter" id="notifCount">0</span>
    </a>

    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">

        <h6 class="dropdown-header">
            Alerts Center
        </h6>

        <!-- Tempat menampilkan notifikasi -->
        <div id="notifList">
            <!-- isi notifikasi akan dimuat otomatis -->
        </div>

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
                        <h1 class="h3 text-gray-800 mb-0">absensi-siswa</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Data Absensi Siswa</li>
                        </ol>
                    </div>

                     <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- Judul Card -->
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Absensi Siswa</h6>

                            <!-- Container tombol -->
                            <div class="d-flex align-items-center">
                                <!-- Tombol Tambah Kelas -->
                                <a href="tambah-absensi-siswa-x-a.php" class="btn btn-sm btn-primary btn-icon-split mr-2 btn-equal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Absensi Siswa<span>
                                </a>

                                <!-- Tombol Visibility Dropdown -->
                                <div class="dropdown mr-2">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle btn-equal align-items-center" type="button" 
                                            id="dropdownVisibility" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye mr-1"></i>
                                        </span>
                                        <span class="text">Visibility</span>
                                    </button>
                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownVisibility">
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="0" id="colID" checked>
                                            <label class="form-check-label" for="colID">ID Absensi </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="1" id="colNama" checked>
                                            <label class="form-check-label" for="colNama">Nisn</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="2" id="colTanggalTanggapan" checked>
                                            <label class="form-check-label" for="colTanggalTanggapan">Nama Siswa</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="3" id="colJenis" checked>
                                            <label class="form-check-label" for="colJenis">Tanggal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="4" id="colStatus" checked>
                                            <label class="form-check-label" for="colTanggalTanggapan">Status</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="5" id="colKeterangan" checked>
                                            <label class="form-check-label" for="colTanggalTanggapan">Keterangan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="6" id="colEdit" checked>
                                            <label class="form-check-label" for="colEdit">Edit</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="7" id="colHapus" checked>
                                            <label class="form-check-label" for="colHapus">Hapus</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Dropdown Generate Report -->
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-primary dropdown-toggle shadow-sm" href="#" 
                                        id="dropdownReport" role="button" data-toggle="dropdown" 
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-download fa-sm text-white-50 mr-1"></i> Generate Report
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownReport">
                                        <a class="dropdown-item export-pdf" href="#">
                                            <i class="fas fa-file-pdf fa-sm text-danger mr-2"></i> Export PDF
                                        </a>
                                        <a class="dropdown-item export-excel" href="#">
                                            <i class="fas fa-file-excel fa-sm text-success mr-2"></i> Export Excel
                                        </a>
                                        <a class="dropdown-item export-csv" href="#">
                                            <i class="fas fa-file-csv fa-sm text-info mr-2"></i> Export CSV
                                        </a>
                                        <a class="dropdown-item export-copy" href="#">
                                            <i class="fas fa-copy fa-sm text-dark mr-2"></i> Copy
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item export-print" href="#">
                                            <i class="fas fa-print fa-sm text-primary mr-2"></i> Print
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Absensi</th>
                                            <th>Nisn</th>
                                            <th>Nama Siswa</th>
                                            <th>Tanggal </th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = " SELECT a.id_absensi, a.nisn, s.nama_lengkap, a.tanggal, 
                                    a.status, a.keterangan FROM absensi_siswa a JOIN siswa s 
                                    ON a.nisn = s.nisn ORDER BY a.id_absensi DESC ";



                                    $query = mysqli_query($koneksi, $sql);

                                    while($result = mysqli_fetch_array($query)) {
                                        $kode = $result['id_absensi'];
                                        ?>
                                        <tr>
                                            <td><?php echo $result['id_absensi']; ?></td>
                                            <td><?php echo $result['nisn']; ?></td>
                                            <td><?php echo $result['nama_lengkap']; ?></td>
                                            <td><?php echo $result['tanggal']; ?></td>
                                            <td><?php echo $result['status']; ?></td>
                                            <td><?php echo $result['keterangan']; ?></td>
                                
                                            
                                        <td class="text-center">
                                            <a href="edit-absensi-siswa.php?id_absensi=<?= $result['id_absensi']; ?>" 
                                            class="btn btn-primary btn-sm" 
                                            style="border-radius: 8px;">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                        </td>

                                        <td class="text-center">
                                            <a href="hapus-absensi-siswa-x-a.php?id_absensi=<?= $result['id_absensi']; ?>" 
                                            onclick="return confirm('Yakin ingin menghapus data ini?')" 
                                            class="btn btn-danger btn-sm"
                                            style="border-radius: 8px;">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>

                                        </tr>
                                    <?php
                                    }                 
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID Absensi</th>
                                            <th>Nisn</th>
                                            <th>Nama Siswa</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>  
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

    <!-- Modal Edit Pengaduan -->
<div class="modal fade" id="modalEditPengaduan" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="update-pengaduan.php" method="POST">
      <div class="modal-content">
        
        <!-- HEADER BIRU -->
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalEditLabel">Edit Pengaduan</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>

        <!-- ISI FORM -->
        <div class="modal-body">
          <!-- ID tersembunyi -->
          <input type="hidden" name="id_pengaduan" id="edit_id_pengaduan">

          <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" id="edit_nama_siswa" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Judul Pengaduan</label>
            <input type="text" name="judul_pengaduan" id="edit_judul_pengaduan" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Isi Pengaduan</label>
            <textarea name="isi_pengaduan" id="edit_isi_pengaduan" class="form-control" rows="3" required></textarea>
          </div>

          <div class="form-group">
            <label>Tanggapan Guru</label>
            <textarea name="tanggapan" id="edit_tanggapan" class="form-control" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label>Tanggal Tanggapan</label>
            <input type="date" name="tanggal_tanggapan" id="edit_tanggal_tanggapan" class="form-control">
          </div>
        </div>

        <!-- FOOTER -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>

      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: '<i class="fas fa-download"></i> Generate Report',
                className: 'btn btn-primary dropdown-toggle',
                buttons: [
                    { extend: 'pdfHtml5', text: '<i class="far fa-file-pdf"></i> Export PDF', titleAttr: 'PDF' },
                    { extend: 'excelHtml5', text: '<i class="far fa-file-excel"></i> Export Excel', titleAttr: 'Excel' },
                    { extend: 'csvHtml5', text: '<i class="fas fa-file-csv"></i> Export CSV', titleAttr: 'CSV' },
                    { extend: 'copyHtml5', text: '<i class="fas fa-copy"></i> Copy', titleAttr: 'Copy' },
                    { extend: 'print', text: '<i class="fas fa-print"></i> Print', titleAttr: 'Print' }
                ]
            }
        ]
    });
});
</script>

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

<!-- script edit-->
<script>
function editPengaduan(id, nama, judul, isi, tanggapan, tanggal) {
  document.getElementById('edit_id_pengaduan').value = id;
  document.getElementById('edit_nama_siswa').value = nama;
  document.getElementById('edit_judul_pengaduan').value = judul;
  document.getElementById('edit_isi_pengaduan').value = isi;
  document.getElementById('edit_tanggapan').value = tanggapan;
  document.getElementById('edit_tanggal_tanggapan').value = tanggal;
}
</script>

<script>
function loadNotif() {
    fetch("notif.php")
        .then(res => res.json())
        .then(data => {
            console.log(data); // CEK DI CONSOLE

            document.getElementById("notifCount").innerText = data.count;

            let listHtml = "";

            data.items.forEach(n => {
                listHtml += `
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">${n.tanggal}</div>
                            <span class="font-weight-bold">${n.jenis}: ${n.judul}</span>
                        </div>
                    </a>
                `;
            });

            document.getElementById("notifList").innerHTML = listHtml;
        })
        .catch(err => console.log("Fetch error:", err));
}

// jalan saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", loadNotif);
</script>

</body>

</html>