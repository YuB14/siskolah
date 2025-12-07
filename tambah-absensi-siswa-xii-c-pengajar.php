<?php
require_once "./library/koneksi.php";

// Ambil id_kelas dari nama kelas X-C
$queryKelas = mysqli_query($koneksi, "SELECT id_kelas FROM kelas WHERE nama_kelas = 'XII-C'");
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
    <title>Siskolah - Tambah Absensi Siswa XII-C</title>

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

               <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Judul Halaman -->
                        <h1 class="h3 text-gray-800 mb-0">Tambah Absensi Siswa XII-C</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="absensi-siswa-xii-c-pengajar.php">Data Absensi Siswa XII-C</a></li>
                            <li class="breadcrumb-item active">Tambah Absensi Siswa XII-C</li>
                        </ol>
                    </div>

                    <!-- Card Form langsung di bawah judul -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Absensi</h3>
                        </div>

                        <form action="proses-tambah-absensi-siswa-xii-c-pengajar.php" method="POST">
                            <div class="card-body">
                                <div class="row">

                                    <!-- Kiri: Kategori Kehadiran -->
                                    <div class="col-md-3 text-center">
                                        <h5 class="mb-4">Status Kehadiran</h5>
                                        <div class="d-flex flex-column align-items-start">
                                            <label class="mb-3">
                                                <input type="radio" name="status" value="Hadir" required> Hadir
                                            </label>
                                            <label class="mb-3">
                                                <input type="radio" name="status" value="Izin"> Izin
                                            </label>
                                            <label class="mb-3">
                                                <input type="radio" name="status" value="Sakit"> Sakit
                                            </label>
                                            <label>
                                                <input type="radio" name="status" value="Alpa"> Alpa
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Kanan: Daftar Siswa -->
                                    <div class="col-md-9">
                                        <h5 class="mb-4 d-flex justify-content-between align-items-center">
                                            Daftar Siswa
                                            <div>
                                                <button type="button" id="selectAll" class="btn btn-sm btn-primary">Pilih Semua</button>
                                                <button type="button" id="deselectAll" class="btn btn-sm btn-secondary">Batal Semua</button>
                                            </div>
                                        </h5>

                                        <div class="form-group">
                                            <label>Cari Siswa</label>
                                            <input type="text" id="searchSiswa" class="form-control" placeholder="Cari NISN / Nama...">
                                        </div>

                                        <div class="border rounded p-3" style="max-height: 400px; overflow-y:auto;">
                                            <?php while ($row = mysqli_fetch_assoc($querySiswa)) { ?>
                                                <div class="card shadow-sm mb-2 siswa-item">
                                                    <div class="card-body d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong><?= htmlspecialchars($row['nama_lengkap']); ?></strong><br>
                                                            <small>NISN: <?= $row['nisn']; ?></small>
                                                        </div>
                                                        <div>
                                                            <input type="checkbox" name="nisn[]" value="<?= $row['nisn']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>

                                    <!-- Tanggal dan Keterangan -->
                                    <div class="col-12 mt-4">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan jika diperlukan..."></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Absensi
                                </button>
                                <a href="absensi-siswa-xii-c-pengajar.php" class="btn btn-secondary">
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

    <!-- Scroll to Top -->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

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

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Aktifkan Select2
           $('#nisn').select2({
    placeholder: "Pilih NISN atau nama siswa",
    allowClear: true,
    width: '100%',
    minimumResultsForSearch: Infinity // 🔥 Hilangkan kolom pencarian di dropdown
    });


    // Isi otomatis nama siswa
    $('#nisn').on('change', function() {
        let nama = $(this).find(':selected').data('nama');
        $('#nama_siswa').val(nama || '');
    });
    });
    </script>

    <script>
    // Pilih semua
    document.getElementById('selectAll').onclick = function() {
        document.querySelectorAll("input[name='nisn[]']").forEach(el => el.checked = true);
    };

    // Batal semua
    document.getElementById('deselectAll').onclick = function() {
        document.querySelectorAll("input[name='nisn[]']").forEach(el => el.checked = false);
    };
    </script>

    <script>
    document.getElementById('searchSiswa').addEventListener('keyup', function() {

    let filter = this.value.toLowerCase();
    let list = document.querySelectorAll(".card.shadow-sm");

    // Array untuk sorting manual
    let match = [];
    let noMatch = [];

    list.forEach(card => {

        let nama = card.querySelector("strong").textContent.toLowerCase();
        let nisn = card.querySelector("small").textContent.toLowerCase();

        if (nama.includes(filter) || nisn.includes(filter)) {
            match.push(card);
            card.style.display = "";
        } else {
            noMatch.push(card);
            card.style.display = "";
        }
    });

    // Render ulang: matched → paling atas
    let container = document.querySelector(".border.rounded.p-3");
    container.innerHTML = "";

    match.forEach(c => container.appendChild(c));
    noMatch.forEach(c => container.appendChild(c));

    });
    </script>
</body>

</html>