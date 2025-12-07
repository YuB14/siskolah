<?php
require_once "./library/koneksi.php";

// Ambil data terakhir dari tabel keuangan untuk mencari id terakhir
$query = mysqli_query($koneksi, "SELECT id_jadwal FROM jadwal_mapel ORDER BY id_jadwal DESC LIMIT 1");
$row = mysqli_fetch_assoc($query);

if ($row) {
    // Ambil angka terakhir dari id terakhir
    $lastId = $row['id_jadwal'];
    $num = (int) substr($lastId, 6); // asumsikan format ID: "KLS0001"
    $num++;
} else {
    $num = 1; // jika tabel masih kosong
}

// Buat id_kelas baru dengan format KLS0001, KLS0002, dst.
$id_jadwal = 'JDWL' . str_pad($num, 4, '0', STR_PAD_LEFT);
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

    // Hanya boleh diakses Admin
    if ($jabatan !== 'Admin') {
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

    <title>Siskolah - Tambah Jadwal Mapel</title>

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard-admin.php">
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
                <a class="nav-link" href="dashboard-admin.php">
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
                        <a class="collapse-item" href="biodata-guru-admin.php">Guru</a>
                        <a class="collapse-item" href="biodata-siswa-admin.php">Siswa</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Kelas -->
            <li class="nav-item">
                <a class="nav-link" href="kelas-admin.php">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Kelas</span>
                </a>
            </li>

            <!-- Nav Item - Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="mata-pelajaran-admin.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>

            <!-- Nav Item - Jadwal Mata Pelajaran -->
            <li class="nav-item">
                <a class="nav-link" href="jadwal-mata-pelajaran-admin.php">
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
                <a class="nav-link" href="absensi-guru-admin.php">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Absensi Guru</span>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
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

                $filterMapel = $_GET['mata_pelajaran'] ?? '';

                if ($filterMapel != '') {
                    $queryGuru = mysqli_query($koneksi, "
                        SELECT g.nip, g.nama_lengkap
                        FROM guru g
                        INNER JOIN mata_pelajaran mp ON g.nip = mp.nip
                        WHERE mp.id_mapel = '$filterMapel'
                    ");
                } else {
                    $queryGuru = mysqli_query($koneksi, "SELECT * FROM guru WHERE 1=0");
                }

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
                        <h1 class="h3 text-gray-800 mb-0">Tambah Jadwal Mapel</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-admin.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="jadwal-mata-pelajaran-admin.php">Data Jadwal Mapel</a></li>
                            <li class="breadcrumb-item active">Tambah Jadwal Mapel</li>
                        </ol>
                    </div>

                    <!-- Card Form langsung di bawah judul -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tabel pengisian</h3>
                        </div>
                        <form action="proses-tambah-jadwal-mata-pelajaran-admin.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputIDJadwal">ID Jadwal</label>
                                    <input type="text" name="id_jadwal" value="<?php echo $id_jadwal; ?>" class="form-control" id="exampleInputIDJadwal" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="mataPelajaran">Mata Pelajaran</label>
                                    <select class="custom-select rounded-0" name="id_mapel" id="mataPelajaran"
                                        onchange="window.location='tambah-jadwal-mata-pelajaran-admin.php?mata_pelajaran='+this.value" required>

                                        <option value="">-- Pilih Mata Pelajaran --</option>

                                        <?php while($row = mysqli_fetch_assoc($queryMapel)) { ?>
                                            <option value="<?php echo $row['id_mapel']; ?>"
                                                <?php echo ($filterMapel == $row['id_mapel']) ? 'selected' : ''; ?>>
                                                <?php echo $row['nama_mapel']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputDay">Hari</label>
                                    <select class="custom-select rounded-0" name="hari" class="form-control" id="exampleInputDay" required>
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="guruPengajar">Guru Pengajar</label>
                                    <select class="custom-select rounded-0" name="nip" id="guruPengajar" required>
                                        <option value="">-- Pilih Guru Pengajar --</option>
                                        <?php while($row = mysqli_fetch_assoc($queryGuru)) { ?>
                                            <option value="<?php echo $row['nip']; ?>">
                                                <?php echo $row['nama_lengkap']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Kelas">Kelas</label>
                                    <select class="custom-select rounded-0" name="id_kelas" id="Kelas" required>
                                        <option value="">-- Pilih Nama Kelas --</option>
                                        <?php while($row = mysqli_fetch_assoc($queryKelas)) { ?>
                                            <option value="<?php echo $row['id_kelas']; ?>">
                                                <?php echo $row['nama_kelas']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTimeStart">Jam Mulai</label>
                                    <input type="time" name="jam_mulai" class="form-control" id="exampleInputTimeStart" 
                                        placeholder="Masukkan Jam Mulai" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTimeEnd">Jam Berakhir</label>
                                    <input type="time" name="jam_selesai" class="form-control" id="exampleInputTimeEnd" 
                                        placeholder="Masukkan Jam Berakhir" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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

    
    <script>
    document.getElementById("formJadwal").addEventListener("submit", function(event) {
        const jamMulai = document.getElementById("exampleInputTimeStart").value;
        const jamSelesai = document.getElementById("exampleInputTimeEnd").value;

        if (jamMulai && jamSelesai && jamSelesai <= jamMulai) {
            alert("Jam selesai harus lebih besar dari jam mulai!");
            event.preventDefault(); // menghentikan submit form
        }
    });
    </script>

</body>

</html>