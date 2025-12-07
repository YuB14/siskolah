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
                //memanggil koneksi
                include ('./library/koneksi.php');
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Judul Halaman -->
                        <h1 class="h3 text-gray-800 mb-0">Absensi Siswa X-A</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Absensi Siswa X-A</li>
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

                    showAlert('added', 'Data absensi siswa berhasil ditambah!');
                    showAlert('updated', 'Data absensi siswa berhasil diupdate!');
                    showAlert('deleted', 'Data absensi siswa berhasil dihapus!');
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- Judul Card -->
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Absensi Siswa</h6>

                            <!-- Container tombol -->
                            <div class="d-flex align-items-center">
                                <!-- Tombol Tambah Kelas -->
                                <a href="tambah-absensi-siswa-x-a-pengajar.php" class="btn btn-sm btn-primary btn-icon-split mr-2 btn-equal">
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
                                    $sql = "SELECT 
                                        a.id_absensi,
                                        a.nisn,
                                        s.nama_lengkap,
                                        k.nama_kelas,
                                        a.tanggal,
                                        a.status,
                                        a.keterangan
                                    FROM absensi_siswa a
                                    JOIN siswa s ON a.nisn = s.nisn
                                    JOIN kelas k ON s.id_kelas = k.id_kelas
                                    WHERE k.nama_kelas = 'X-A'
                                    ORDER BY a.id_absensi DESC";

                                    $query = mysqli_query($koneksi, $sql);

                                    while($result = mysqli_fetch_array($query)) {
                                        $kode = $result['id_absensi'];
                                        ?>
                                        <tr>
                                            <td><?php echo $result['id_absensi']; ?></td>
                                            <td><?php echo $result['nisn']; ?></td>
                                            <td><?php echo $result['nama_lengkap']; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($result['tanggal'])); ?></td>
                                            <td><?php echo $result['status']; ?></td>
                                            <td><?php echo $result['keterangan']; ?></td>
                                
                                            <td class="text-center">
                                                <a href="update-absensi-siswa-x-a-pengajar.php?id_absensi=<?php echo $result['id_absensi']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <!-- Tombol hapus yang memicu modal -->
                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $result['id_absensi']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <!-- Modal Hapus -->
                                                <div class="modal fade" id="hapusModal<?php echo $result['id_absensi']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel<?php echo $result['id_absensi']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">                                                            
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hapusModalLabel<?php echo $result['id_absensi']; ?>">Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus data absensi siswa <strong><?php echo $result['nama_lengkap']; ?></strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <a href="hapus-absensi-x-a-pengajar.php?id_absensi=<?php echo $result['id_absensi']; ?>" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                <div class="modal-body">Pilih "Logout" jika anda benar-benar ingin logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Log Out</a>
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

</body>

</html>