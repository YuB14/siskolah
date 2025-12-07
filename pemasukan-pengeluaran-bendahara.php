<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    session_start();

    if (!isset($_SESSION['guru_login'])) {
        header("Location: login-guru.html");
        exit;
    }

    if ($_SESSION['guru_jabatan'] !== 'Bendahara') {
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

    <title>Siskolah - Pemasukan & Pengeluaran</title>

    <!-- Bootstrap & FontAwesome -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">

    <style>
        /* Tabel rapi */
        #dataTable th, #dataTable td {
            padding: 0.75rem 0.5rem;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        #dataTable tbody tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }

        td.text-center a.btn {
            margin: 0 2px;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard-bendahara.php">
                <div class="sidebar-brand-icon">
                    <img src="./img/school-solid-full.svg" alt="Logo" style="width: 40px; height: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">Siskolah</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard-bendahara.php">
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
                <a class="nav-link" href="pemasukan-pengeluaran-bendahara.php">
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
                    <div id="collapseSPP" class="collapse" aria-labelledby="headingSPP" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kelas X :</h6>
                        <a class="collapse-item" href="spp-x-a-bendahara.php">X A</a>
                        <a class="collapse-item" href="spp-x-b-bendahara.php">X B</a>
                        <a class="collapse-item" href="spp-x-c-bendahara.php">X C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XI :</h6>
                        <a class="collapse-item" href="spp-xi-a-bendahara.php">XI A</a>
                        <a class="collapse-item" href="spp-xi-b-bendahara.php">XI B</a>
                        <a class="collapse-item" href="spp-xi-c-bendahara.php">XI C</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Kelas XII :</h6>
                        <a class="collapse-item" href="spp-xii-a-bendahara.php">XII A</a>
                        <a class="collapse-item" href="spp-xii-b-bendahara.php">XII B</a>
                        <a class="collapse-item" href="spp-xii-c-bendahara.php">XII C</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Aktivitas Sekolah</div>

            <!-- Nav Item - Absensi Guru -->
            <li class="nav-item">
                <a class="nav-link" href="absensi-guru-bendahara.php">
                    <i class="fas fa-fw fa-user-check"></i>
                    <span>Absensi Guru</span>
                </a>
            </li>
            
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Bendahara</span>
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

                <?php include('./library/koneksi.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 text-gray-800 mb-0">Pemasukan & Pengeluaran</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Pemasukan & Pengeluaran</li>
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

                    showAlert('added', 'Data keuangan berhasil ditambah!');
                    showAlert('updated', 'Data keuangan berhasil diupdate!');
                    showAlert('deleted', 'Data keuangan berhasil dihapus!');
                    ?>

                    <!-- Card Tabel -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pemasukan & Pengeluaran</h6>
                            <div class="d-flex align-items-center">
                                <!-- Tambah Data Pemasukan & Pengeluaran -->
                                <a href="tambah-data-pemasukan-pengeluaran-bendahara.php" class="btn btn-sm btn-primary btn-icon-split mr-2">
                                    <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                                    <span class="text">Tambah Data Pemasukan & Pengeluaran</span>
                                </a>

                                <!-- Dropdown Visibility -->
                                <div class="dropdown mr-2">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                        id="dropdownVisibility" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-eye mr-1"></i> Visibility
                                    </button>
                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownVisibility">
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="0" id="colID" checked><label class="form-check-label" for="colID">ID Keuangan</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="1" id="colTanggal" checked><label class="form-check-label" for="colTanggal">Tanggal</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="2" id="colJenis" checked><label class="form-check-label" for="colJenis">Jenis</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="3" id="colKategori" checked><label class="form-check-label" for="colKategori">Kategori</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="4" id="colJumlah" checked><label class="form-check-label" for="colJumlah">Jumlah</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="5" id="colKeterangan" checked><label class="form-check-label" for="colKeterangan">Keterangan</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="6" id="colNamaPJ" checked><label class="form-check-label" for="colNamaPJ">Nama Penanggung Jawab</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="7" id="colEdit" checked><label class="form-check-label" for="colEdit">Edit</label></div>
                                        <div class="form-check"><input class="form-check-input col-toggle" type="checkbox" value="8" id="colHapus" checked><label class="form-check-label" for="colHapus">Hapus</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID Keuangan</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Nama Penanggung Jawab</th>
                                            <th style="width: 70px; text-align: center;">Edit</th>
                                            <th style="width: 70px; text-align: center;">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT keuangan.*, guru.nama_lengkap 
                                            FROM keuangan 
                                            LEFT JOIN guru ON keuangan.nip = guru.nip";
                                    $query = mysqli_query($koneksi, $sql);

                                    while($row = mysqli_fetch_assoc($query)) {
                                        $kode = $row['nip']; 
                                        $namaGuru = $row['nama_lengkap']; 
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id_keuangan'] ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                            <td><?php echo $row['jenis'] ?></td>
                                            <td><?php echo $row['kategori'] ?></td>
                                            <td><?php echo "Rp " . number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                            <td><?php echo $row['keterangan'] ?></td>
                                            <td><?php echo $row['nama_lengkap'] ?></td>
                                            <td class="text-center">
                                                <a href="update-pemasukan-pengeluaran-bendahara.php?id_keuangan=<?php echo $row['id_keuangan']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <!-- Tombol Hapus-->
                                                <button class="btn btn-sm btn-danger btn-hapus" data-id="<?php echo $row['id_keuangan']; ?>" data-kategori="<?php echo $row['kategori']; ?>">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <!-- Modal Global -->
                                                <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data keuangan <strong id="namaKategori"></strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <a id="btnConfirmHapus" href="hapus-pemasukan-pengeluaran-bendahara.php" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID Keuangan</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Nama Penanggung Jawab</th>
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
            <!-- End Content -->

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
        <!-- End Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->

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

    <!-- JS Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- DataTables JS -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <!-- Buttons -->
    <script src="vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="vendor/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="vendor/jszip/jszip.min.js"></script>
    <script src="vendor/pdfmake/pdfmake.min.js"></script>
    <script src="vendor/pdfmake/vfs_fonts.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                responsive: true,
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" + // length menu + search sejajar
                     "<'row'<'col-12'B>>" +               // buttons
                     "<'row'<'col-12'tr>>" +              // table
                     "<'row'<'col-sm-5'i><'col-sm-7'p>>", 
                buttons: [
                    { extend: 'pdfHtml5', text: 'Export PDF', className: 'd-none' },
                    { extend: 'excelHtml5', text: 'Export Excel', className: 'd-none' },
                    { extend: 'csvHtml5', text: 'Export CSV', className: 'd-none' },
                    { extend: 'copyHtml5', text: 'Copy', className: 'd-none' },
                    { extend: 'print', text: 'Print', className: 'd-none' }
                ]
            });

            // Generate Report dropdown
            $('#dropdownReport .dropdown-item').each(function() {
                var btnText = $(this).text().trim();
                $(this).on('click', function(e){
                    e.preventDefault();
                    table.button(btnText).trigger();
                });
            });

            // Toggle kolom visibility
            $('.col-toggle').on('change', function() {
                var colIndex = $(this).val();
                table.column(colIndex).visible($(this).is(':checked'));
            });
        });
    </script>

    <script>
    $(document).on('click', '.btn-hapus', function() {
        let id = $(this).data('id');
        let kategori = $(this).data('kategori');
        $('#namaKategori').text(kategori);
        $('#btnConfirmHapus').attr('href', 'hapus-pemasukan-pengeluaran-bendahara.php?id_keuangan=' + id);
        $('#hapusModal').modal('show');
    });
    </script>

</body>
</html>