<?php
require_once "./library/koneksi.php";

// Ambil id_kelas dari nama kelas XII-B
$queryKelas = mysqli_query($koneksi, "SELECT id_kelas FROM kelas WHERE nama_kelas = 'XII-B'");
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
    die("Query gagal (siswa): " . mysqli_error($koneksi));
}

// Ambil semua data pembayaran untuk siswa di kelas ini
$queryPembayaran = mysqli_query($koneksi, "
    SELECT nisn, bulan, tahun_ajaran, status 
    FROM pembayaran_spp 
    WHERE nisn IN (SELECT nisn FROM siswa WHERE id_kelas = '$id_kelas')
");

if (!$queryPembayaran) {
    die("Query gagal (pembayaran): " . mysqli_error($koneksi));
}

// Susun array status pembayaran
$statusBayarAll = [];
while ($row = mysqli_fetch_assoc($queryPembayaran)) {
    $nisn  = $row['nisn'];
    $tahun = $row['tahun_ajaran'];
    $bulan = $row['bulan'];

    $statusBayarAll[$nisn][$tahun][$bulan] = $row['status'];
}
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
    if ($jabatan !== 'Kepala Sekolah') {
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

    <title>Siskolah - SPP Kelas XII-B</title>

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
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Home</div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Keuangan</div>

            <!-- Nav Item - Pemasukan & Pengeluaran -->
            <li class="nav-item">
                <a class="nav-link" href="pemasukan-pengeluaran.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pemasukan & Pengeluaran</span>
                </a>
            </li>

            <!-- Nav Item - SPP -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSPP"
                    aria-expanded="true" aria-controls="collapseSPP">
                    <i class="fas fa-fw fa-money-bill-wave"></i>
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
                        <a class="collapse-item" href="biodata-guru.php">Guru</a>
                        <a class="collapse-item" href="biodata-siswa.php">Siswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Kelas -->
            <li class="nav-item">
                <a class="nav-link" href="kelas.php">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Kelas</span>
                </a>
            </li>

            <!-- Nav Item - Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="mata-pelajaran.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>

            <!-- Nav Item - Jadwal Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="jadwal-mata-pelajaran.php">
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
                <a class="nav-link" href="absensi-guru.php">
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
                        <a class="collapse-item" href="absensi-siswa-xii-b.php">XII B</a>
                        <a class="collapse-item" href="absensi-siswa-xii-c.php">XII C</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Nilai Siswa -->
            <li class="nav-item">
                <a class="nav-link" href="nilai-siswa.php">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Nilai Siswa</span>
                </a>
            </li>

            <!-- Nav Item - Kenaikan & Kelulusan -->
            <li class="nav-item">
                <a class="nav-link" href="kenaikan-kelulusan.php">
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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaduan"
                    aria-expanded="false" aria-controls="collapsePengaduan">
                    <i class="fas fa-fw fa-exclamation-triangle"></i>
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
                    <i class="fas fa-fw fa-comments"></i>
                    <span>Kritik & Saran</span>
                </a>
                <div id="collapseKritik-saran" class="collapse" aria-labelledby="headingKritik-saran" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Jenis Kritik & Saran:</h6>
                        <a class="collapse-item" href="kritik-saran.php">Kritik dan Saran</a>
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

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Kepala Sekolah</span>
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
                        <h1 class="h3 text-gray-800 mb-0">SPP Kelas XII-B</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-bendahara.html">Home</a></li>
                            <li class="breadcrumb-item active">Data SPP Kelas XII-B</li>
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

                    showAlert('added', 'Data SPP kelas XII-B berhasil ditambah!');
                    showAlert('updated', 'Data SPP kelas XII-B diupdate!');
                    showAlert('deleted', 'Data SPP kelas XII-B dihapus!');
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- Judul Card -->
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data SPP Kelas XII-B</h6>
                            
                        </div>
                        <div class="card-body">

                            <form method="POST">
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
const statusBayarData = <?= json_encode($statusBayarAll) ?>;

$(document).ready(function () {

    function updateBulanDisplay() {
        let selectedNisn = [];

        // Ambil siswa yang dipilih
        $('.siswa-checkbox:checked').each(function () {
            selectedNisn.push($(this).val());
        });

        // Ambil tahun ajaran
        let tahunAjaran = $('#tahunAjaranSelect').val();

        // Loop semua bulan
        $('.bulan-label').each(function () {

            let bulan = $(this).data('bulan');
            let checkbox = $(this).find('.bulan-checkbox');

            if (selectedNisn.length === 0) {
                $(this).removeClass('lunas belum-lunas').addClass('bg-light');
                checkbox.prop('disabled', true).prop('checked', false).show();
                $(this).find('strong').text(bulan);
                return;
            }

            let semuaLunas = true;
            let adaLunas = false;

            selectedNisn.forEach(nisn => {
                if (
                    statusBayarData[nisn] &&
                    statusBayarData[nisn][tahunAjaran] &&
                    statusBayarData[nisn][tahunAjaran][bulan] === 'Lunas'
                ) {
                    adaLunas = true;
                } else {
                    semuaLunas = false;
                }
            });

            if (semuaLunas && adaLunas) {
                $(this).removeClass('bg-light belum-lunas').addClass('lunas');
                checkbox.hide();
                $(this).find('strong').html("✔ " + bulan);
            } else if (adaLunas && !semuaLunas) {
                $(this).removeClass('bg-light lunas').addClass('belum-lunas');
                checkbox.prop('disabled', false).show();
                $(this).find('strong').text(bulan + " (Sebagian)");
            } else {
                $(this).removeClass('lunas').addClass('bg-light belum-lunas');
                checkbox.prop('disabled', false).prop('checked', false).show();
                $(this).find('strong').text(bulan);
            }
        });

    }

    // EVENT LISTENER

    // Ketika siswa dicentang
    $('.siswa-checkbox').on('change', updateBulanDisplay);

    // Ketika tahun ajaran diganti
    $('#tahunAjaranSelect').on('change', updateBulanDisplay);

    // Pilih semua
    $('#selectAll').on('click', function () {
        $('.siswa-checkbox').prop('checked', true);
        updateBulanDisplay();
    });

    // Batal semua
    $('#deselectAll').on('click', function () {
        $('.siswa-checkbox').prop('checked', false);
        updateBulanDisplay();
    });

    // Cari siswa
    $('#searchSiswa').on('keyup', function () {
        let filter = this.value.toLowerCase();
        $('.siswa-item').each(function () {
            let nama = $(this).find('strong').text().toLowerCase();
            let nisn = $(this).find('small').text().toLowerCase();

            if (nama.includes(filter) || nisn.includes(filter)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Inisialisasi awal
    updateBulanDisplay();

});
</script>
</body>
</html>