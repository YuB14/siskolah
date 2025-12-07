<?php
require_once "./library/koneksi.php";

// Ambil ID terakhir (berdasarkan angka, bukan huruf)
$q = mysqli_query($koneksi, "
    SELECT id_nilai 
    FROM nilai_siswa
    WHERE id_nilai LIKE 'NLAI%'
    ORDER BY CAST(SUBSTRING(id_nilai, 5) AS UNSIGNED) DESC
    LIMIT 1
");

$r = mysqli_fetch_assoc($q);

if ($r) {
    $lastNum = (int) substr($r['id_nilai'], 4);
    $newNum = $lastNum + 1;
} else {
    $newNum = 1;
}

$id_nilai = 'NLAI' . str_pad($newNum, 4, '0', STR_PAD_LEFT);
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

    <title>Siskolah - Tambah Nilai Siswa</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Tambahkan Select2 CSS di bagian <head> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />

    <style>
        .custom-search-container {
            position: relative;
        }
        
        .search-input-wrapper {
            position: relative;
            margin-bottom: 5px;
        }
        
        .search-siswa-input {
            width: 100%;
            padding: 8px 35px 8px 12px;
            border: 1px solid #d1d3e2;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        
        .search-siswa-input:focus {
            border-color: #4e73df;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        
        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #858796;
        }
        
        .siswa-select-wrapper {
            position: relative;
        }
        
        .siswa-select {
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #d1d3e2;
            border-radius: 4px;
            background: white;
        }
        
        .siswa-option {
            padding: 10px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f8f9fc;
            transition: background-color 0.2s;
        }
        
        .siswa-option:hover {
            background-color: #f8f9fc;
        }
        
        .siswa-option.selected {
            background-color: #4e73df;
            color: white;
        }
        
        .siswa-option.hidden {
            display: none;
        }
        
        .siswa-option-nama {
            font-weight: 600;
            color: #2c3e50;
            display: block;
        }
        
        .siswa-option.selected .siswa-option-nama {
            color: white;
        }
        
        .siswa-option-nisn {
            font-size: 0.85em;
            color: #7f8c8d;
            display: block;
            margin-top: 2px;
        }
        
        .siswa-option.selected .siswa-option-nisn {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .no-results {
            padding: 20px;
            text-align: center;
            color: #858796;
            font-style: italic;
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
                require_once "./library/koneksi.php";

                // ambil data siswa
                $querySiswa = mysqli_query($koneksi, "
                    SELECT s.nisn, s.nama_lengkap, s.id_kelas, k.nama_kelas
                    FROM siswa s
                    LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
                    ORDER BY s.nama_lengkap ASC
                ");

                //ambil data mata pelajaran
                $queryMapel = mysqli_query($koneksi, "SELECT id_mapel, nama_mapel FROM mata_pelajaran ORDER BY nama_mapel ASC");

                //ambil data kelas
                $queryKelas = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas ASC");
                $kelas = mysqli_fetch_assoc($queryKelas); // ambil satu baris data
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Judul Halaman -->
                        <h1 class="h3 text-gray-800 mb-0">Tambah Nilai Siswa</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="nilai-siswa-pengajar.php">Data Nilai Siswa</a></li>
                            <li class="breadcrumb-item active">Tambah Nilai Siswa</li>
                        </ol>
                    </div>

                    <!-- Card Form langsung di bawah judul -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tabel pengisian</h3>
                        </div>
                        <form action="proses-tambah-nilai-siswa-pengajar.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body">

                                <!-- SECTION 1: Data Dasar -->
                                <div class="card mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="m-0 font-weight-bold">
                                            <i class="fas fa-user-graduate"></i> Data Siswa & Mata Pelajaran
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">ID Nilai</label>
                                                    <input type="text" name="id_nilai" value="<?php echo $id_nilai; ?>" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Nama Siswa <span class="text-danger">*</span></label>
                                                    
                                                    <div class="custom-search-container">
                                                        <!-- Input pencarian -->
                                                        <div class="search-input-wrapper">
                                                            <input type="text" 
                                                                class="search-siswa-input" 
                                                                id="searchSiswaInput" 
                                                                placeholder="Ketik untuk mencari siswa..."
                                                                autocomplete="off">
                                                            <i class="fas fa-search search-icon"></i>
                                                        </div>
                                                        
                                                        <!-- Hidden input untuk nilai yang dikirim -->
                                                        <input type="hidden" name="nisn" id="selectedNisn" required>
                                                        
                                                        <!-- Container untuk menampilkan pilihan -->
                                                        <div class="siswa-select-wrapper">
                                                            <div class="siswa-select" id="siswaSelect">
                                                                <?php
                                                                // Query siswa beserta id_kelas dan nama kelas
                                                                $querySiswaDropdown = mysqli_query($koneksi, "
                                                                    SELECT s.nisn, s.nama_lengkap, s.id_kelas, k.nama_kelas
                                                                    FROM siswa s
                                                                    LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
                                                                    ORDER BY s.nama_lengkap ASC
                                                                ");

                                                                if ($querySiswaDropdown && mysqli_num_rows($querySiswaDropdown) > 0) {
                                                                    while ($row = mysqli_fetch_assoc($querySiswaDropdown)) {
                                                                        $nisn = htmlspecialchars($row['nisn'] ?? '', ENT_QUOTES);
                                                                        $nama_lengkap = htmlspecialchars($row['nama_lengkap'] ?? '', ENT_QUOTES);
                                                                        $id_kelas = htmlspecialchars($row['id_kelas'] ?? '', ENT_QUOTES);
                                                                        $nama_kelas = htmlspecialchars($row['nama_kelas'] ?? '', ENT_QUOTES);
                                                                        $data_nama = strtolower($nama_lengkap);
                                                                        ?>
                                                                        <div class="siswa-option"
                                                                            data-nisn="<?= $nisn; ?>"
                                                                            data-nama="<?= $data_nama; ?>"
                                                                            data-id-kelas="<?= $id_kelas; ?>"
                                                                            data-nama-kelas="<?= $nama_kelas; ?>">
                                                                            <span class="siswa-option-nama"><?= $nama_lengkap; ?></span>
                                                                            <span class="siswa-option-nisn">NISN: <?= $nisn; ?> | Kelas: <?= $nama_kelas; ?></span>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    echo '<div class="no-results">Belum ada data siswa.</div>';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Kelas <span class="text-danger">*</span></label>
                                                    <!-- Hidden input untuk id_kelas -->
                                                    <input type="hidden" name="id_kelas" id="selectedIdKelas" required>
                                                    <!-- Input text tampilannya saja -->
                                                    <input type="text" class="form-control" id="exampleInputName" placeholder="Nama Kelas otomatis" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Mata Pelajaran <span class="text-danger">*</span></label>
                                                    <select class="custom-select" name="id_mapel" required>
                                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                                        <?php 
                                                        mysqli_data_seek($queryMapel, 0);
                                                        while($row = mysqli_fetch_assoc($queryMapel)) { 
                                                        ?>
                                                            <option value="<?= $row['id_mapel']; ?>">
                                                                <?= $row['nama_mapel']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SECTION 2: Nilai-Nilai -->
                                <div class="row">
                                    
                                    <!-- Kolom Kiri: Nilai Tugas -->
                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-header bg-success text-white">
                                                <h6 class="m-0 font-weight-bold">
                                                    <i class="fas fa-book"></i> Nilai Tugas
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                $tugas = [
                                                    "nilai_tugas_1" => "Tugas 1",
                                                    "nilai_tugas_2" => "Tugas 2",
                                                    "nilai_tugas_3" => "Tugas 3",
                                                    "nilai_tugas_4" => "Tugas 4",
                                                    "nilai_tugas_5" => "Tugas 5",
                                                    "nilai_tugas_6" => "Tugas 6"
                                                ];
                                                foreach ($tugas as $name => $label) {
                                                    echo "
                                                    <div class='form-group'>
                                                        <label class='font-weight-bold'>$label</label>
                                                        <input type='number' name='$name' class='form-control' placeholder='0-100' min='0' max='100'>
                                                    </div>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Tengah: Nilai Ulangan Harian -->
                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-header bg-info text-white">
                                                <h6 class="m-0 font-weight-bold">
                                                    <i class="fas fa-clipboard-check"></i> Nilai Ulangan Harian
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                $ulangan = [
                                                    "nilai_uh_1" => "Ulangan Harian 1",
                                                    "nilai_uh_2" => "Ulangan Harian 2",
                                                    "nilai_uh_3" => "Ulangan Harian 3"
                                                ];
                                                foreach ($ulangan as $name => $label) {
                                                    echo "
                                                    <div class='form-group'>
                                                        <label class='font-weight-bold'>$label</label>
                                                        <input type='number' name='$name' class='form-control' placeholder='0-100' min='0' max='100'>
                                                    </div>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan: UTS, UAS, Semester, Tahun Ajaran -->
                                    <div class="col-md-4">
                                        <!-- Card UTS & UAS -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-warning text-white">
                                                <h6 class="m-0 font-weight-bold">
                                                    <i class="fas fa-file-alt"></i> Nilai UTS & UAS
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Nilai UTS</label>
                                                    <input type="number" name="nilai_uts" class="form-control" placeholder="0-100" min="0" max="100">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Nilai UAS</label>
                                                    <input type="number" name="nilai_uas" class="form-control" placeholder="0-100" min="0" max="100">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card Semester & Tahun Ajaran -->
                                        <div class="card mb-3">
                                            <div class="card-header bg-secondary text-white">
                                                <h6 class="m-0 font-weight-bold">
                                                    <i class="fas fa-calendar-alt"></i> Periode
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Semester <span class="text-danger">*</span></label>
                                                    <select class="custom-select" name="semester" required>
                                                        <option value="">-- Pilih Semester --</option>
                                                        <option value="1">Semester 1 (Ganjil)</option>
                                                        <option value="2">Semester 2 (Genap)</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="font-weight-bold">Tahun Ajaran <span class="text-danger">*</span></label>
                                                    <select name="tahun_ajaran" class="custom-select" required>
                                                        <option value="">-- Pilih Tahun Ajaran --</option>
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
                                    </div>

                                </div>

                                <!-- Info Keterangan -->
                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle"></i> 
                                    <strong>Catatan:</strong> 
                                    <ul class="mb-0">
                                        <li>Semua nilai diisi dalam rentang <strong>0-100</strong></li>
                                        <li>Field dengan tanda <span class="text-danger">*</span> wajib diisi</li>
                                        <li>Nilai akhir akan dihitung otomatis berdasarkan rata-rata semua nilai</li>
                                    </ul>
                                </div>

                            </div>

                            <!-- FOOTER: Tombol Submit & Kembali -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Data Nilai
                                </button>
                                <a href="nilai-siswa-pengajar.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- JavaScript untuk Custom Search -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchSiswaInput'); // input pencarian
        const siswaSelect = document.getElementById('siswaSelect');       // container dropdown
        const selectedNisn = document.getElementById('selectedNisn');    // hidden input nisn
        const selectedIdKelas = document.getElementById('selectedIdKelas'); // hidden input id_kelas
        const kelasInput = document.getElementById('exampleInputName');   // input readonly nama kelas

        // Set event click setiap opsi siswa
        siswaSelect.querySelectorAll('.siswa-option').forEach(option => {
            option.addEventListener('click', function() {
                const nisn = this.getAttribute('data-nisn');
                const idKelas = this.getAttribute('data-id-kelas'); // ID asli (KLS001, KLS002, dll)
                const namaKelas = this.getAttribute('data-nama-kelas'); // Nama kelas (X A, XI B, dll)
                const namaSiswa = this.getAttribute('data-nama');

                // isi hidden input dengan ID kelas asli
                selectedNisn.value = nisn;
                selectedIdKelas.value = idKelas; // ID kelas untuk database
                kelasInput.value = namaKelas;    // Nama kelas untuk tampilan

                // tampilkan nama siswa di input pencarian
                searchInput.value = namaSiswa.charAt(0).toUpperCase() + namaSiswa.slice(1);

                // sembunyikan dropdown
                siswaSelect.style.display = 'none';
            });
        });

        // Event pencarian dengan filter
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const options = siswaSelect.querySelectorAll('.siswa-option');
            let hasResults = false;

            options.forEach(option => {
                const nama = option.getAttribute('data-nama');
                if (nama.includes(searchTerm)) {
                    option.classList.remove('hidden');
                    hasResults = true;
                } else {
                    option.classList.add('hidden');
                }
            });

            siswaSelect.style.display = 'block';
        });

        // Sembunyikan dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !siswaSelect.contains(e.target)) {
                siswaSelect.style.display = 'none';
            }
        });

        // Tampilkan dropdown saat focus pada input
        searchInput.addEventListener('focus', function() {
            siswaSelect.style.display = 'block';
        });
    });
    </script>

</body>

</html>