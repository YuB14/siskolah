<?php
require_once "./library/koneksi.php";

$filterMapel = $_GET['mapel'] ?? ''; 
$filterKelas = $_GET['kelas'] ?? '';

$where = [];

if ($filterMapel != '') $where[] = "nilai_siswa.id_mapel = '$filterMapel'";
if ($filterKelas != '') $where[] = "nilai_siswa.id_kelas = '$filterKelas'";

$filterSQL = "";
if (count($where) > 0) {
    $filterSQL = "WHERE " . implode(" AND ", $where);
}

$query = mysqli_query($koneksi, "
    SELECT nilai_siswa.*, 
           siswa.nama_lengkap, 
           mata_pelajaran.nama_mapel
    FROM nilai_siswa
    JOIN siswa ON nilai_siswa.nisn = siswa.nisn
    JOIN mata_pelajaran ON nilai_siswa.id_mapel = mata_pelajaran.id_mapel
    $filterSQL
    ORDER BY siswa.nama_lengkap ASC
");
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

    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />

    <title>Siskolah - Nilai Siswa</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">

    <style>
        /* Custom Styling */
        .filter-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fc;
        }

        #dataTable thead th {
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            border-color: #4e73df;
            padding: 0.75rem 0.5rem;
            vertical-align: middle;
        }

        #dataTable tbody td {
            font-size: 0.85rem;
            padding: 0.75rem 0.5rem;
            vertical-align: middle;
        }

        .badge-nilai {
            padding: 0.35em 0.65em;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .nilai-tinggi {
            background-color: #1cc88a;
            color: white;
        }

        .nilai-sedang {
            background-color: #f6c23e;
            color: white;
        }

        .nilai-rendah {
            background-color: #e74a3b;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-equal {
            min-width: 100px;
        }

        .filter-dropdown-menu {
            min-width: 280px;
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
        }

        .active-filters {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .filter-tag {
            background-color: #4e73df;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-tag .remove-filter {
            cursor: pointer;
            font-weight: bold;
        }

        .filter-tag .remove-filter:hover {
            color: #ff6b6b;
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
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <i class="fas fa-graduation-cap text-primary"></i> Nilai Siswa
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                                <li class="breadcrumb-item">Data Nilai Siswa</a></li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Alert Messages -->
                    <?php
                    $alertMessages = [
                        'added' => ['icon' => 'check-circle', 'message' => 'Data nilai siswa berhasil ditambah!'],
                        'updated' => ['icon' => 'check-circle', 'message' => 'Data nilai siswa berhasil diupdate!'],
                        'deleted' => ['icon' => 'check-circle', 'message' => 'Data nilai siswa berhasil dihapus!']
                    ];

                    if (isset($_GET['status']) && isset($alertMessages[$_GET['status']])):
                        $alert = $alertMessages[$_GET['status']];
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-<?= $alert['icon'] ?>"></i> <strong>Berhasil!</strong> <?= $alert['message'] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <!-- NOTIFIKASI FILTER AKTIF -->
                    <?php if (!empty($_GET['siswa'])): 
                        $siswaList = (array)$_GET['siswa'];
                        $placeholders = str_repeat('?,', count($siswaList)-1).'?';
                        $stmt = $koneksi->prepare("SELECT nisn, nama_lengkap FROM siswa WHERE nisn IN ($placeholders) ORDER BY nama_lengkap");
                        $stmt->bind_param(str_repeat('s', count($siswaList)), ...$siswaList);
                        $stmt->execute();
                        $res = $stmt->get_result();
                    ?>
                    <div class="alert alert-info alert-dismissible fade show">
                        <i class="fas fa-info-circle"></i>
                        <strong>Filter aktif:</strong> 
                        <?php while ($row = $res->fetch_assoc()): ?>
                            <span class="badge badge-primary ml-1"><?= htmlspecialchars($row['nama_lengkap']) ?></span>
                        <?php endwhile; ?>
                        <a href="nilai-siswa-pengajar.php" class="float-right text-danger"><small>Hapus filter</small></a>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                    <?php endif; ?>

                    <?php
                    // Query data nilai siswa
                    $sql = "
                        SELECT 
                            ns.id_nilai,
                            s.nama_lengkap,
                            k.nama_kelas,
                            mp.nama_mapel,
                            ns.nilai_tugas_1,
                            ns.nilai_tugas_2,
                            ns.nilai_tugas_3,
                            ns.nilai_tugas_4,
                            ns.nilai_tugas_5,
                            ns.nilai_tugas_6,
                            ns.nilai_uh_1,
                            ns.nilai_uh_2,
                            ns.nilai_uh_3,
                            ns.nilai_uts,
                            ns.nilai_uas,
                            ns.nilai_akhir,
                            ns.semester,
                            ns.tahun_ajaran
                        FROM nilai_siswa ns
                        INNER JOIN siswa s ON ns.nisn = s.nisn
                        INNER JOIN kelas k ON ns.id_kelas = k.id_kelas
                        INNER JOIN mata_pelajaran mp ON ns.id_mapel = mp.id_mapel
                    ";

                    if ($filterMapel != '') {
                        $filterMapel = mysqli_real_escape_string($koneksi, $filterMapel);
                        $sql .= " AND ns.id_mapel = '$filterMapel'";
                    }

                    if ($filterKelas != '') {
                        $filterKelas = mysqli_real_escape_string($koneksi, $filterKelas);
                        $sql .= " AND ns.id_kelas = '$filterKelas'";
                    }

                    $sql .= " ORDER BY s.nama_lengkap ASC";
                    $query = mysqli_query($koneksi, $sql);
                    $jumlahData = mysqli_num_rows($query);
                    ?>

                    <!-- Active Filters Display -->
                    <?php if ($filterMapel != '' || $filterKelas != ''): ?>
                    <div class="active-filters">
                        <div class="mr-2" style="line-height: 2;">
                            <strong>Filter Aktif:</strong>
                        </div>
                        <?php if ($filterMapel != ''): 
                            $namaMapel = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_mapel FROM mata_pelajaran WHERE id_mapel = '$filterMapel'"));
                        ?>
                        <span class="filter-tag">
                            <i class="fas fa-book"></i>
                            <?= htmlspecialchars($namaMapel['nama_mapel']) ?>
                            <span class="remove-filter" onclick="removeFilter('mapel')">&times;</span>
                        </span>
                        <?php endif; ?>
                        
                        <?php if ($filterKelas != ''): 
                            $namaKelas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama_kelas FROM kelas WHERE id_kelas = '$filterKelas'"));
                        ?>
                        <span class="filter-tag">
                            <i class="fas fa-school"></i>
                            <?= htmlspecialchars($namaKelas['nama_kelas']) ?>
                            <span class="remove-filter" onclick="removeFilter('kelas')">&times;</span>
                        </span>
                        <?php endif; ?>
                        
                        <a href="nilai-siswa-pengajar.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times"></i> Hapus Semua Filter
                        </a>
                    </div>
                    <?php endif; ?>

                    <!-- Info Jumlah Data -->
                    <div class="mb-3">
                        <h6 class="text-gray-700">
                            <i class="fas fa-info-circle text-info"></i> 
                            Menampilkan <strong><?= $jumlahData ?></strong> data nilai siswa
                        </h6>
                    </div>

                    <!-- Data Table Card -->
                    <?php if ($jumlahData > 0): ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-table"></i> Tabel Data Nilai Siswa
                                    </h6>
                                </div>
                                <!-- Action Buttons -->
                                <div class="col-md-6">
                                    <div class="action-buttons justify-content-end">
                                        <a href="tambah-nilai-siswa-pengajar.php" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i> Tambah Nilai
                                        </a>

                                        <!-- Filter Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" 
                                                    type="button" id="dropdownFilter" data-toggle="dropdown" 
                                                    aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right filter-dropdown-menu" aria-labelledby="dropdownFilter">
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

                                        <!-- Filter Siswa (Multi Select) -->
                                        <div class="dropdown mr-0">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownFilterSiswa" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-users mr-1"></i> 
                                                <span id="selectedCount">Pilih Siswa</span>
                                            </button>
                                            <div class="dropdown-menu p-3" style="width: 350px; max-height: 400px; overflow-y: auto;" aria-labelledby="dropdownFilterSiswa">
                                                <div class="form-group mb-2">
                                                    <input type="text" id="searchSiswa" class="form-control form-control-sm" placeholder="Cari nama siswa...">
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="selectAllSiswa">
                                                    <label class="custom-control-label font-weight-bold" for="selectAllSiswa">Pilih Semua</label>
                                                </div>
                                                <hr class="my-2">
                                                <?php
                                                $qsiswa = mysqli_query($koneksi, "
                                                    SELECT DISTINCT ns.nisn, s.nama_lengkap 
                                                    FROM nilai_siswa ns
                                                    INNER JOIN siswa s ON ns.nisn = s.nisn
                                                    INNER JOIN kelas k ON ns.id_kelas = k.id_kelas
                                                    ORDER BY s.nama_lengkap
                                                ");
                                                while ($sis = mysqli_fetch_assoc($qsiswa)) {
                                                    $checked = (isset($_GET['siswa']) && in_array($sis['nisn'], (array)$_GET['siswa'])) ? 'checked' : '';
                                                    echo '<div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input siswa-checkbox" id="siswa'.$sis['nisn'].'" value="'.$sis['nisn'].'" '.$checked.'>
                                                            <label class="custom-control-label" for="siswa'.$sis['nisn'].'">'.$sis['nama_lengkap'].'</label>
                                                        </div>';
                                                }
                                                ?>
                                                <hr class="mt-2">
                                                <button type="button" class="btn btn-primary btn-sm btn-block" id="applyFilterSiswa">Terapkan</button>
                                            </div>
                                        </div>

                                        <!-- Export Dropdown -->
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-download"></i> Export
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right shadow">
                                                <a class="dropdown-item" href="cetak-nilai-per-siswa.php?<?php
                                                    $params = [];
                                                    if (!empty($_GET['siswa'])) {
                                                        foreach ((array)$_GET['siswa'] as $s) {
                                                            $params[] = 'siswa[]=' . urlencode($s);
                                                        }
                                                    }
                                                    echo !empty($params) ? implode('&', $params) : '';
                                                ?>" target="_blank">
                                                    <i class="fas fa-file-pdf text-danger"></i> Cetak PDF (Per Siswa)
                                                </a>
                                                <a class="dropdown-item export-excel" href="#">
                                                    <i class="fas fa-file-excel text-success"></i> Export Excel
                                                </a>
                                                <a class="dropdown-item export-csv" href="#">
                                                    <i class="fas fa-file-csv text-info"></i> Export CSV
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item export-print" href="#">
                                                    <i class="fas fa-print text-primary"></i> Print
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Mata Pelajaran</th>
                                            <th>T1</th>
                                            <th>T2</th>
                                            <th>T3</th>
                                            <th>T4</th>
                                            <th>T5</th>
                                            <th>T6</th>
                                            <th>UH1</th>
                                            <th>UH2</th>
                                            <th>UH3</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                            <th>Nilai Akhir</th>
                                            <th>Semester</th>
                                            <th>Tahun Ajaran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    while ($result = mysqli_fetch_array($query)):
                                        // Hitung nilai akhir
                                        $total_nilai = 
                                            $result['nilai_tugas_1'] +
                                            $result['nilai_tugas_2'] +
                                            $result['nilai_tugas_3'] +
                                            $result['nilai_tugas_4'] +
                                            $result['nilai_tugas_5'] +
                                            $result['nilai_tugas_6'] +
                                            $result['nilai_uh_1'] +
                                            $result['nilai_uh_2'] +
                                            $result['nilai_uh_3'] +
                                            $result['nilai_uts'] +
                                            $result['nilai_uas'];

                                        $nilai_akhir = round($total_nilai / 11);

                                        // Tentukan badge warna
                                        if ($nilai_akhir >= 80) {
                                            $badgeClass = 'nilai-tinggi';
                                        } elseif ($nilai_akhir >= 60) {
                                            $badgeClass = 'nilai-sedang';
                                        } else {
                                            $badgeClass = 'nilai-rendah';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($result['nama_lengkap']) ?></td>
                                        <td><?= htmlspecialchars($result['nama_mapel']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_tugas_1']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_tugas_2']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_tugas_3']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_tugas_4']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_tugas_5']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_tugas_6']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_uh_1']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_uh_2']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_uh_3']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_uts']) ?></td>
                                        <td class="text-center"><?= intval($result['nilai_uas']) ?></td>
                                        <td class="text-center">
                                            <span class="badge badge-nilai <?= $badgeClass ?>">
                                                <?= $nilai_akhir ?>
                                            </span>
                                        </td>
                                        <td class="text-center"><?= $result['semester'] ?></td>
                                        <td><?= $result['tahun_ajaran'] ?></td>
                                        <td class="text-center">
                                            <a href="update-nilai-siswa-pengajar.php?id_nilai=<?= $result['id_nilai'] ?>" 
                                            class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" 
                                                    data-toggle="modal" 
                                                    data-target="#hapusModal<?= $result['id_nilai'] ?>"
                                                    title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusModal<?= $result['id_nilai'] ?>" tabindex="-1" role="dialog" 
                                        aria-labelledby="hapusModalLabel<?= $result['id_nilai'] ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="hapusModalLabel<?= $result['id_nilai'] ?>">
                                                        <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus data nilai siswa:</p>
                                                    <div class="alert alert-warning">
                                                        <strong>Nama:</strong> <?= htmlspecialchars($result['nama_lengkap']) ?><br>
                                                        <strong>Mata Pelajaran:</strong> <?= htmlspecialchars($result['nama_mapel']) ?><br>
                                                        <strong>Semester:</strong> <?= $result['semester'] ?> - <?= $result['tahun_ajaran'] ?>
                                                    </div>
                                                    <p class="text-danger"><strong>Perhatian:</strong> Data yang dihapus tidak dapat dikembalikan!</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        <i class="fas fa-times"></i> Batal
                                                    </button>
                                                    <a href="hapus-nilai-siswa-pengajar.php?id_nilai=<?= $result['id_nilai'] ?>" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Ya, Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- Empty State -->
                    <div class="card shadow">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-clipboard-list fa-5x text-gray-300 mb-3"></i>
                            <h4 class="text-gray-600">Tidak Ada Data Nilai</h4>
                            <p class="text-muted">
                                <?php if ($filterMapel != '' || $filterKelas != ''): ?>
                                    Tidak ditemukan data nilai dengan filter yang diterapkan
                                <?php else: ?>
                                    Belum ada data nilai siswa yang terdaftar untuk kelas ini
                                <?php endif; ?>
                            </p>
                            <?php if ($filterMapel != '' || $filterKelas != ''): ?>
                            <a href="nilai-siswa-pengajar.php" class="btn btn-primary">
                                <i class="fas fa-redo"></i> Tampilkan Semua Data
                            </a>
                            <?php else: ?>
                            <a href="tambah-nilai-siswa-pengajar.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Nilai Pertama
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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
                <div class="modal-body">Pilih "Log Out" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Log Out</a>
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

    <!-- DataTables Buttons JS -->
    <script src="vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="vendor/jszip/jszip.min.js"></script>
    <script src="vendor/pdfmake/pdfmake.min.js"></script>
    <script src="vendor/pdfmake/vfs_fonts.js"></script>

    <!-- Custom Scripts -->
    <script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                { extend: 'pdfHtml5', text: 'Export PDF', className: 'd-none', title: 'Nilai Siswa' },
                { extend: 'excelHtml5', text: 'Export Excel', className: 'd-none', title: 'Nilai Siswa Kelas' },
                { extend: 'csvHtml5', text: 'Export CSV', className: 'd-none', title: 'Nilai Siswa Kelas' },
                { extend: 'print', text: 'Print', className: 'd-none', title: 'Nilai Siswa Kelas' }
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            pageLength: 10,
            order: [[1, 'asc']],
            responsive: true
        });

        // Export button handlers
        $('.export-pdf').click(function(e) {
            e.preventDefault();
            table.button(0).trigger();
        });

        $('.export-excel').click(function(e) {
            e.preventDefault();
            table.button(1).trigger();
        });

        $('.export-csv').click(function(e) {
            e.preventDefault();
            table.button(2).trigger();
        });

        $('.export-print').click(function(e) {
            e.preventDefault();
            table.button(3).trigger();
        });

        // Prevent dropdown from closing when clicking inside
        $('.filter-dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });
    });

    // Filter button handler
    document.getElementById('btnFilter').addEventListener('click', function() {
        let mapel = document.getElementById('filterMapel').value;
        let kelas = document.getElementById('filterKelas').value;

        let url = "nilai-siswa-pengajar.php?";
        let params = [];
        
        if (mapel !== "") params.push("mapel=" + mapel);
        if (kelas !== "") params.push("kelas=" + kelas);

        if (params.length > 0) {
            url += params.join("&");
        }

        window.location.href = url;
    });

    // Reset filter handler
    document.getElementById('btnResetFilter').addEventListener('click', function() {
        window.location.href = "nilai-siswa-pengajar.php";
    });

    // Remove individual filter
    function removeFilter(type) {
        let currentUrl = new URL(window.location.href);
        currentUrl.searchParams.delete(type);
        window.location.href = currentUrl.toString();
    }
    </script>

    <script>
    $(document).ready(function() {
    let selectedCount = $('.siswa-checkbox:checked').length;
    const totalSiswa = <?= mysqli_num_rows(mysqli_query($koneksi, "
        SELECT DISTINCT ns.nisn 
        FROM nilai_siswa ns
        JOIN kelas k ON ns.id_kelas = k.id_kelas 
        WHERE k.nama_kelas = ''
    ")) ?>;

    function updateSelectedCount() {
        selectedCount = $('.siswa-checkbox:checked').length;
        if (selectedCount === 0) {
            $('#selectedCount').text('Pilih Siswa');
        } else if (selectedCount === totalSiswa) {
            $('#selectedCount').text('Semua Siswa (' + selectedCount + ')');
        } else {
            $('#selectedCount').text(selectedCount + ' Siswa Dipilih');
        }
    }

    // BIAR DROPDOWN GAK KETUTUP PAS KLIK CHECKBOX / SEARCH
    $(document).on('click', '.dropdown-menu', function(e) {
        e.stopPropagation();
    });

    // Select All
    $('#selectAllSiswa').on('change', function() {
        $('.siswa-checkbox').prop('checked', this.checked);
        updateSelectedCount();
    });

    // Checkbox individu
    $(document).on('change', '.siswa-checkbox', function() {
        updateSelectedCount();
        
        // Auto uncheck "Select All" kalau ada yang di-uncheck
        if (!this.checked) {
            $('#selectAllSiswa').prop('checked', false);
        }
        // Auto check "Select All" kalau semua tercentang
        else if ($('.siswa-checkbox:checked').length === totalSiswa) {
            $('#selectAllSiswa').prop('checked', true);
        }
    });

    // Search siswa
    $('#searchSiswa').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.custom-control').each(function() {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(value));
        });
    });

    // Terapkan Filter
    $('#applyFilterSiswa').on('click', function() {
        const selected = [];
        $('.siswa-checkbox:checked').each(function() {
            selected.push($(this).val());
        });

        const url = new URL(window.location.href);
        url.searchParams.delete('siswa[]');
        selected.forEach(nisn => url.searchParams.append('siswa[]', nisn));

        window.location.href = url.toString();
    });

    // Update counter saat halaman pertama kali dibuka
    updateSelectedCount();
    });
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>

    <script>
    $(document).ready(function() {
        // PRINT → pakai div khusus yang sudah kamu buat
        $('.export-print').on('click', function(e) {
            e.preventDefault();
            window.print();
        });

        // PDF → pakai jsPDF + autoTable dari div print-area
        $('.export-pdf').on('click', function(e) {
            e.preventDefault();

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('l', 'mm', 'a4'); // landscape biar muat semua kolom

            doc.setFontSize(16);
            doc.text("LAPORAN NILAI SISWA KELAS ", 148, 15, { align: "center" });
            doc.setFontSize(11);
            doc.text("Dicetak pada: <?= date('d F Y H:i:s') ?>", 148, 23, { align: "center" });

            doc.autoTable({
                html: '#print-area table',
                startY: 35,
                theme: 'grid',
                headStyles: { fillColor: [41, 128, 185], textColor: 255, fontSize: 9 },
                styles: { fontSize: 8, cellPadding: 2 },
                columnStyles: { 0: { cellWidth: 10 } } // kolom No lebih kecil
            });

            doc.save('Laporan_Nilai_Kelas_<?= date("d-m-Y") ?>.pdf');
        });

        // EXCEL, CSV, COPY → pakai DataTables Buttons (paling akurat)
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel'
            ],
            paging: false,
            info: false,
            searching: false
        });

        $('.export-copy').click', function() { $('#dataTable').DataTable().button('.buttons-copy').trigger(); });
        $('.export-csv').click(function() { $('#dataTable').DataTable().button('.buttons-csv').trigger(); });
        $('.export-excel').click(function() { $('#dataTable').DataTable().button('.buttons-excel').trigger(); });
    });
    </script>

    <!-- CSS Print supaya cuma print-area yang kelihatan -->
    <style>
    @media print {
        body * { visibility: hidden; }
        #print-area, #print-area * { visibility: visible; }
        #print-area { position: absolute; left: 0; top: 0; width: 100%; }
    }
    </style>
</body>
</html>