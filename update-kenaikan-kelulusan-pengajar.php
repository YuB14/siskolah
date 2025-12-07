<?php
require_once "./library/koneksi.php";

// Proses Update
if (isset($_POST['update'])) {
    $nisnList = $_POST['nisn'] ?? [];
    $kelasBaru = $_POST['kelas'];
    $statusBaru = $_POST['status'];

    if (count($nisnList) > 0) {
        foreach ($nisnList as $nisn) {
            $nisn = mysqli_real_escape_string($koneksi, $nisn);
            $kelasBaru = mysqli_real_escape_string($koneksi, $kelasBaru);
            $statusBaru = mysqli_real_escape_string($koneksi, $statusBaru);
            
            mysqli_query($koneksi, "
                UPDATE siswa 
                SET id_kelas = '$kelasBaru',
                    status = '$statusBaru'
                WHERE nisn = '$nisn'
            ");
        }
        header("Location: kenaikan-kelulusan-pengajar.php?success=1");
        exit;
    } else {
        $error = "Pilih minimal 1 siswa!";
    }
}

// Ambil data siswa dengan filter pencarian dan kelas
$cari = $_GET['cari'] ?? '';
$filterKelas = $_GET['filter_kelas'] ?? '';

$sqlSiswa = "
    SELECT s.nisn, s.nama_lengkap, k.nama_kelas, s.status, s.id_kelas
    FROM siswa s
    LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
    WHERE 1=1
";

if ($cari != '') {
    $cari = mysqli_real_escape_string($koneksi, $cari);
    $sqlSiswa .= " AND (s.nisn LIKE '%$cari%' OR s.nama_lengkap LIKE '%$cari%')";
}

if ($filterKelas != '') {
    $filterKelas = mysqli_real_escape_string($koneksi, $filterKelas);
    $sqlSiswa .= " AND s.id_kelas = '$filterKelas'";
}

$sqlSiswa .= " ORDER BY s.nama_lengkap ASC";
$querySiswa = mysqli_query($koneksi, $sqlSiswa);
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

    // Hanya boleh diakses Bendahara
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

    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />
    <title>Siskolah - Update Kenaikan & Kelulusan</title>

    <!-- Font & Template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        .card.shadow-sm:hover {
            background-color: #f8f9fc;
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

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 text-gray-800 mb-0">Update Kenaikan & Kelulusan</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                            <li class="breadcrumb-item active">Update Kenaikan & Kelulusan</li>
                        </ol>
                    </div>

                    <!-- Alert Success -->
                    <?php if(isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> Data kenaikan/kelulusan siswa berhasil diupdate.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Alert Error -->
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> <?= $error ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <!-- Form Update -->
                    <form action="" method="POST" id="formUpdate">
                        <div class="row">

                            <!-- KIRI: Cari & Pilih Siswa -->
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Pilih Siswa</h6>
                                    </div>
                                    <div class="card-body">
                                        
                                        <!-- Form Pencarian Real-time -->
                                        <div class="mb-3">
                                            <div class="input-group">
                                                <input type="text" id="searchInput" class="form-control" 
                                                    placeholder="Ketik untuk mencari NISN atau Nama..." 
                                                    autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Filter Kelas -->
                                        <div class="mb-3">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-filter"></i> Filter Berdasarkan Kelas
                                            </label>
                                            <select id="filterKelas" class="custom-select rounded-0">
                                                <option value="">-- Semua Kelas --</option>
                                                <?php
                                                $qKelasFilter = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas ASC");
                                                while($kf = mysqli_fetch_assoc($qKelasFilter)){
                                                    $selected = ($filterKelas == $kf['id_kelas']) ? 'selected' : '';
                                                    echo "<option value='{$kf['id_kelas']}' $selected>{$kf['nama_kelas']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Tombol Pilih Semua / Batal Semua -->
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-sm btn-success" id="selectAll">
                                                Pilih Semua
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary" id="deselectAll">
                                                Batal Semua
                                            </button>
                                            <span id="selectedCount" class="ml-2 badge badge-info">0 dipilih</span>
                                        </div>

                                        <hr>

                                        <!-- Daftar Siswa -->
                                        <div id="siswaList" style="max-height: 450px; overflow-y: auto;">
                                            <?php if(mysqli_num_rows($querySiswa) > 0): ?>
                                                <?php while($s = mysqli_fetch_assoc($querySiswa)): ?>
                                                    <div class="card shadow-sm mb-2 p-2 siswa-item" 
                                                         data-nama="<?= strtolower($s['nama_lengkap']) ?>" 
                                                         data-nisn="<?= $s['nisn'] ?>"
                                                         data-kelas="<?= $s['id_kelas'] ?>">
                                                        <label class="mb-0 cursor-pointer">
                                                            <input type="checkbox" name="nisn[]" value="<?= $s['nisn'] ?>" class="checkbox-siswa">
                                                            <strong><?= htmlspecialchars($s['nama_lengkap']) ?></strong>
                                                            <br>
                                                            <small class="text-muted">
                                                                NISN: <?= $s['nisn'] ?> | 
                                                                Kelas: <?= $s['nama_kelas'] ?? 'Belum ada' ?> | 
                                                                Status: <?= $s['status'] ?? '-' ?>
                                                            </small>
                                                        </label>
                                                    </div>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle"></i> Tidak ada data siswa yang ditemukan.
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- KANAN: Update Kelas & Status -->
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Update Kelas & Status</h6>
                                    </div>
                                    <div class="card-body">

                                        <!-- Pilih Kelas Baru -->
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-school"></i> Pilih Kelas Baru
                                            </label>
                                            <select class="custom-select rounded-0" name="kelas" required>
                                                <option value="">-- Pilih Kelas --</option>
                                                <?php
                                                $qKelas = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas ORDER BY nama_kelas ASC");
                                                while($k = mysqli_fetch_assoc($qKelas)){
                                                    echo "<option value='{$k['id_kelas']}'>{$k['nama_kelas']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- Pilih Status -->
                                        <div class="form-group">
                                            <label class="font-weight-bold">
                                                <i class="fas fa-flag"></i> Status Siswa
                                            </label>
                                            <select class="custom-select rounded-0" name="status" required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                                <option value="Lulus">Lulus</option>
                                            </select>
                                        </div>

                                        <hr>

                                        <!-- Info -->
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i> 
                                            <strong>Petunjuk:</strong>
                                            <ol class="mb-0 pl-3">
                                                <li>Gunakan <strong>pencarian real-time</strong> atau <strong>filter kelas</strong> untuk menemukan siswa</li>
                                                <li>Centang siswa yang akan diupdate</li>
                                                <li>Pilih kelas baru dan status siswa</li>
                                                <li>Klik "Update Sekarang" untuk menyimpan</li>
                                            </ol>
                                        </div>

                                        <!-- Tombol Update -->
                                        <button type="submit" name="update" class="btn btn-success btn-block">
                                            Update Sekarang
                                        </button>

                                        <a href="kenaikan-kelulusan-pengajar.php" class="btn btn-secondary btn-block mt-2">
                                            Kembali
                                        </a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

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

    <!-- Scroll to Top -->
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

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        // Fungsi Update Counter
        function updateCounter() {
            const checked = document.querySelectorAll("input[name='nisn[]']:checked").length;
            document.getElementById('selectedCount').textContent = checked + ' dipilih';
        }

        // Pilih Semua Checkbox (DIPERBAIKI)
        document.getElementById('selectAll').addEventListener('click', function() {
            const items = document.querySelectorAll('.siswa-item');
            
            items.forEach(item => {
                // Cek apakah item terlihat (tidak disembunyikan)
                if (item.style.display !== 'none') {
                    const checkbox = item.querySelector('.checkbox-siswa');
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                }
            });
            
            updateCounter();
        });

        // Batal Semua Checkbox (DIPERBAIKI)
        document.getElementById('deselectAll').addEventListener('click', function() {
            document.querySelectorAll('.checkbox-siswa').forEach(el => {
                el.checked = false;
            });
            updateCounter();
        });

        // Update counter saat checkbox diubah
        document.querySelectorAll('.checkbox-siswa').forEach(checkbox => {
            checkbox.addEventListener('change', updateCounter);
        });

        // Pencarian Real-time
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const items = document.querySelectorAll('.siswa-item');
            
            items.forEach(item => {
                const nama = item.getAttribute('data-nama');
                const nisn = item.getAttribute('data-nisn');
                
                if (nama.includes(searchValue) || nisn.includes(searchValue)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Filter Berdasarkan Kelas
        document.getElementById('filterKelas').addEventListener('change', function() {
            const kelasValue = this.value;
            const items = document.querySelectorAll('.siswa-item');
            
            items.forEach(item => {
                const kelasItem = item.getAttribute('data-kelas');
                
                if (kelasValue === '' || kelasItem === kelasValue) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Reset pencarian saat filter kelas diubah
            document.getElementById('searchInput').value = '';
        });

        // Konfirmasi sebelum submit
        document.getElementById('formUpdate').addEventListener('submit', function(e) {
            const checked = document.querySelectorAll("input[name='nisn[]']:checked").length;
            
            if (checked === 0) {
                e.preventDefault();
                alert('Pilih minimal 1 siswa untuk diupdate!');
                return false;
            }
            
            if (!confirm('Apakah Anda yakin ingin mengupdate ' + checked + ' siswa?')) {
                e.preventDefault();
                return false;
            }
        });
    </script>

</body>

</html>