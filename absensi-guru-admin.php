<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    session_start();

    if (!isset($_SESSION['guru_login'])) {
        header("Location: login-guru.html");
        exit;
    }

    if ($_SESSION['guru_jabatan'] !== 'Admin') {
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

    <title>Siskolah - Absensi Guru</title>

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

    <style>
        /* Styling untuk tabel agar lebih rapi */
        #dataTable {
            font-size: 0.9rem;
        }
        
        #dataTable thead th {
            background-color: #4e73df;
            color: white;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            padding: 12px 8px;
        }
        
        #dataTable tbody td {
            vertical-align: middle;
            padding: 10px 8px;
        }
        
        /* Styling untuk foto absensi */
        .foto-absensi-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px;
        }
        
        .foto-absensi {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e3e6f0;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        
        .foto-absensi:hover {
            transform: scale(1.1);
            border-color: #4e73df;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* Styling untuk badge status */
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-hadir {
            background-color: #1cc88a;
            color: white;
        }
        
        .status-izin {
            background-color: #f6c23e;
            color: white;
        }
        
        .status-sakit {
            background-color: #36b9cc;
            color: white;
        }
        
        .status-alpha {
            background-color: #e74a3b;
            color: white;
        }
        
        /* Styling untuk tombol aksi */
        .btn-action-group {
            display: flex;
            gap: 5px;
            justify-content: center;
        }
        
        .btn-action {
            padding: 6px 10px;
            font-size: 0.85rem;
        }
        
        /* Styling untuk kolom yang lebih sempit */
        #dataTable td:nth-child(1) { /* ID Absensi */
            text-align: center;
            font-weight: 600;
            color: #4e73df;
        }
        
        #dataTable td:nth-child(2) { /* NIP */
            text-align: center;
        }
        
        #dataTable td:nth-child(5) { /* Tanggal */
            text-align: center;
            white-space: nowrap;
        }
        
        #dataTable td:nth-child(8) { /* Jam Absensi */
            text-align: center;
            white-space: nowrap;
            font-size: 0.85rem;
        }
        
        /* Modal untuk preview foto */
        .modal-foto .modal-body {
            text-align: center;
            padding: 20px;
        }
        
        .modal-foto img {
            max-width: 100%;
            max-height: 70vh;
            border-radius: 8px;
        }
        
        /* Responsive untuk tabel */
        @media (max-width: 768px) {
            .foto-absensi {
                width: 60px;
                height: 60px;
            }
            
            #dataTable {
                font-size: 0.8rem;
            }
        }
    </style>

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
                //memanggil koneksi
                include ('./library/koneksi.php');
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Judul Halaman -->
                        <h1 class="h3 text-gray-800 mb-0">Absensi Guru</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-admin.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Absensi Guru</li>
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

                    showAlert('added', 'Data absensi guru berhasil ditambah!');
                    showAlert('updated', 'Data absensi guru berhasil diupdate!');
                    showAlert('deleted', 'Data absensi guru berhasil dihapus!');
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- Judul Card -->
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Absensi Guru</h6>

                            <!-- Container tombol -->
                            <div class="d-flex align-items-center">
                                <!-- Tombol Tambah Kelas -->
                                <a href="tambah-absensi-guru-admin.php" class="btn btn-sm btn-primary btn-icon-split mr-2 btn-equal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span class="text">Tambah Absensi Guru<span>
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
                                            <label class="form-check-label" for="colID">ID Absensi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="1" id="colNIP" checked>
                                            <label class="form-check-label" for="colNIP">NIP</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="2" id="colNama" checked>
                                            <label class="form-check-label" for="colNama">Nama Guru</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="3" id="colFoto" checked>
                                            <label class="form-check-label" for="colFoto">Foto</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="4" id="colTanggal" checked>
                                            <label class="form-check-label" for="colTanggal">Tanggal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="5" id="colStatus" checked>
                                            <label class="form-check-label" for="colStatus">Status</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="6" id="colKeterangan" checked>
                                            <label class="form-check-label" for="colKeterangan">Keterangan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="7" id="colEdit" checked>
                                            <label class="form-check-label" for="colEdit">Edit</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input col-toggle" type="checkbox" value="8" id="colHapus" checked>
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
                                            <th>NIP</th>
                                            <th>Nama Guru</th>
                                            <th>Foto Absensi</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Jam Absensi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT a.id_absensi, a.nip, g.nama_lengkap, a.foto, a.tanggal, 
                                                a.status, a.keterangan, a.created_at 
                                                FROM absensi_guru a 
                                                JOIN guru g ON a.nip = g.nip 
                                                ORDER BY a.id_absensi DESC";

                                        $query = mysqli_query($koneksi, $sql);

                                        while($result = mysqli_fetch_array($query)) {
                                            $kode = $result['id_absensi'];
                                            
                                            // Tentukan class badge berdasarkan status
                                            $statusClass = 'badge-status ';
                                            switch(strtolower($result['status'])) {
                                                case 'hadir':
                                                    $statusClass .= 'status-hadir';
                                                    break;
                                                case 'izin':
                                                    $statusClass .= 'status-izin';
                                                    break;
                                                case 'sakit':
                                                    $statusClass .= 'status-sakit';
                                                    break;
                                                case 'alpha':
                                                case 'alpa':
                                                    $statusClass .= 'status-alpha';
                                                    break;
                                                default:
                                                    $statusClass .= 'status-hadir';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $result['id_absensi']; ?></td>
                                                <td><?php echo $result['nip']; ?></td>
                                                <td><?php echo $result['nama_lengkap']; ?></td>
                                                <td>
                                                    <div class="foto-absensi-container">
                                                        <?php 
                                                        $foto_path = "uploads/foto_absensi_guru/" . $result['foto'];
                                                        // Cek apakah file foto ada
                                                        if(file_exists($foto_path) && !empty($result['foto'])) {
                                                            ?>
                                                            <img src="<?php echo $foto_path; ?>" 
                                                                alt="Foto Absensi <?php echo $result['nama_lengkap']; ?>" 
                                                                class="foto-absensi"
                                                                data-toggle="modal" 
                                                                data-target="#fotoModal<?php echo $result['id_absensi']; ?>"
                                                                onerror="this.src='img/no-image.png';">
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="img/no-image.png" 
                                                                alt="Tidak ada foto" 
                                                                class="foto-absensi">
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td><?php echo date('d-m-Y', strtotime($result['tanggal'])); ?></td>
                                                <td class="text-center">
                                                    <span class="<?php echo $statusClass; ?>">
                                                        <?php echo $result['status']; ?>
                                                    </span>
                                                </td>
                                                <td><?php echo !empty($result['keterangan']) ? $result['keterangan'] : '-'; ?></td>
                                                <td><?php echo date('d-m-Y H:i', strtotime($result['created_at'])); ?></td>
                                            </tr>
                                            
                                            <!-- Modal Preview Foto -->
                                            <div class="modal fade modal-foto" id="fotoModal<?php echo $result['id_absensi']; ?>" 
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                Foto Absensi - <?php echo $result['nama_lengkap']; ?>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="<?php echo $foto_path; ?>" 
                                                                alt="Foto Absensi <?php echo $result['nama_lengkap']; ?>">
                                                            <p class="mt-3 mb-0 text-muted">
                                                                <small>Tanggal: <?php echo date('d-m-Y H:i', strtotime($result['created_at'])); ?></small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID Absensi</th>
                                            <th>NIP</th>
                                            <th>Nama Guru</th>
                                            <th>Foto Absensi</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Jam Absensi</th>
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
    
</body>

</html>