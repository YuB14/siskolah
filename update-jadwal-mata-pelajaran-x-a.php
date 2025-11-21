<?php
require_once './library/koneksi.php';

// Pastikan ID jadwal tersedia
if (!isset($_GET['id_jadwal'])) {
    header('Location: jadwal-mata-pelajaran-x-a.php');
    exit;
}

$id_jadwal = mysqli_real_escape_string($koneksi, $_GET['id_jadwal']);

// Ambil data jadwal berdasarkan ID
$sql = "SELECT 
            jm.id_jadwal,
            jm.hari,
            jm.id_mapel,
            jm.id_kelas,
            jm.nip,
            mp.nama_mapel,
            g.nama_lengkap,
            k.nama_kelas,
            jm.jam_mulai,
            jm.jam_selesai
        FROM jadwal_mapel jm
        INNER JOIN kelas k ON jm.id_kelas = k.id_kelas
        INNER JOIN mata_pelajaran mp ON jm.id_mapel = mp.id_mapel
        INNER JOIN guru g ON jm.nip = g.nip
        WHERE jm.id_jadwal = '$id_jadwal'";

$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) == 0) {
    echo "Data tidak ditemukan!";
    exit;
}

$data = mysqli_fetch_assoc($query);

// Ambil data dropdown
$guruQuery  = mysqli_query($koneksi, "SELECT nip, nama_lengkap FROM guru ORDER BY nama_lengkap ASC");
$mapelQuery = mysqli_query($koneksi, "SELECT id_mapel, nama_mapel FROM mata_pelajaran ORDER BY nama_mapel ASC");
$kelasQuery = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas ASC");
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

    <title>Siskolah - Update Kelas</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Judul Halaman -->
                        <h1 class="h3 text-gray-800 mb-0">Update Data Kelas</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="kelas.php">Data Kelas</a></li>
                            <li class="breadcrumb-item active">Update Data Kelas</li>
                        </ol>
                    </div>

                    <!-- Card Form langsung di bawah judul -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tabel pengisian</h3>
                        </div>
                        <form action="proses-update-jadwal-mata-pelajaran-x-a.php" method="POST">
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label for="exampleInputIDJadwal">ID Jadwal</label>
                                    <!-- readonly: tampil sebagai teks tapi tidak bisa diubah; tetap dikirim saat submit -->
                                    <input type="text"
                                        name="id_jadwal"
                                        class="form-control"
                                        id="exampleInputIDJadwal"
                                        placeholder="Masukkan ID Jadwal"
                                        required
                                        readonly
                                        value="<?php echo htmlspecialchars($data['id_jadwal']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDay">Hari</label>
                                    <select class="custom-select rounded-0" name="hari" id="exampleInputDay" required>
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="Senin"  <?php if($data['hari'] == 'Senin')  echo 'selected'; ?>>Senin</option>
                                        <option value="Selasa" <?php if($data['hari'] == 'Selasa') echo 'selected'; ?>>Selasa</option>
                                        <option value="Rabu"   <?php if($data['hari'] == 'Rabu')   echo 'selected'; ?>>Rabu</option>
                                        <option value="Kamis"  <?php if($data['hari'] == 'Kamis')  echo 'selected'; ?>>Kamis</option>
                                        <option value="Jumat"  <?php if($data['hari'] == 'Jumat')  echo 'selected'; ?>>Jumat</option>
                                        <option value="Sabtu"  <?php if($data['hari'] == 'Sabtu')  echo 'selected'; ?>>Sabtu</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleSelectMapel">Mata Pelajaran</label>
                                    <select class="custom-select form-control-sm"
                                            name="id_mapel"
                                            id="exampleSelectMapel"
                                            required>
                                        <?php
                                        // Fetch semua mapel
                                        $queryMapel = mysqli_query($koneksi, "SELECT id_mapel, nama_mapel FROM mata_pelajaran ORDER BY nama_mapel");
                                        while($mapel = mysqli_fetch_assoc($queryMapel)) {
                                            $selected = ($mapel['id_mapel'] == $data['id_mapel']) ? 'selected' : '';
                                            echo "<option value='{$mapel['id_mapel']}' $selected>{$mapel['nama_mapel']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGuru">Guru Pengajar</label>
                                    <select class="custom-select form-control-sm"
                                            name="nip"
                                            id="exampleSelectGuru"
                                            required>
                                        <?php
                                        // Fetch semua guru
                                        $queryGuru = mysqli_query($koneksi, "SELECT nip, nama_lengkap FROM guru ORDER BY nama_lengkap");
                                        while($guru = mysqli_fetch_assoc($queryGuru)) {
                                            $selected = ($guru['nip'] == $data['nip']) ? 'selected' : '';
                                            echo "<option value='{$guru['nip']}' $selected>{$guru['nama_lengkap']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['nama_kelas']); ?>" readonly>
                                    <input type="hidden" name="id_kelas" value="<?php echo htmlspecialchars($data['id_kelas']); ?>">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputTimeStart">Jam Mulai</label>
                                    <input type="time" 
                                        name="jam_mulai" 
                                        class="form-control" 
                                        id="exampleInputTimeStart"
                                        placeholder="Masukkan Jam Mulai"
                                        required
                                        value="<?php echo htmlspecialchars($data['jam_mulai']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputTimeEnd">Jam Berakhir</label>
                                    <input type="time" 
                                        name="jam_selesai" 
                                        class="form-control" 
                                        id="exampleInputTimeEnd"
                                        placeholder="Masukkan Jam Berakhir"
                                        required
                                        value="<?php echo htmlspecialchars($data['jam_selesai']); ?>">
                                </div>

                            </div>
                            <div class="card-footer">
                                    <!-- tombol submit -->
                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
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

</body>

</html>