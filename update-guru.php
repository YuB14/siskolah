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

    <title>Siskolah - Update Guru</title>

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

                // pastikan ada param, contoh: edit-guru.php?nip=1234567890
                if (!isset($_GET['nip'])) {
                    // redirect atau tampilkan error
                    header('Location: biodata-guru.php');
                    exit;
                }

                $nip = mysqli_real_escape_string($koneksi, $_GET['nip']);
                $q = mysqli_query($koneksi, "SELECT * FROM guru WHERE nip = '$nip' LIMIT 1");
                if (!$q || mysqli_num_rows($q) == 0) {
                    // tidak ditemukan
                    header('Location: biodata-guru.php?msg=notfound');
                    exit;
                }
                $row = mysqli_fetch_assoc($q);
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Header Page -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Judul Halaman -->
                        <h1 class="h3 text-gray-800 mb-0">Update Guru</h1>

                        <!-- Breadcrumb -->
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                            <li class="breadcrumb-item active"><a href="biodata-guru.php">Data Biodata Guru</a></li>
                            <li class="breadcrumb-item active">Update Guru</li>
                        </ol>
                    </div>

                    <!-- Card Form langsung di bawah judul -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tabel pengisian</h3>
                        </div>
                        <form action="proses-update-guru.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <!-- Hidden field: simpan nip lama (kunci) -->
                                <input type="hidden" name="nip_lama" value="<?php echo htmlspecialchars($row['nip']); ?>">

                                <div class="form-group">
                                    <label for="exampleInputNIP">NIP</label>
                                    <!-- jika NIP juga bisa di-edit: tampilkan value, tapi hati-hati relasi DB -->
                                    <input type="text" name="nip" class="form-control" id="exampleInputNIP"
                                        placeholder="Masukkan NIP Guru" required
                                        value="<?php echo htmlspecialchars($row['nip']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="foto" class="form-label fw-bold">Foto Guru</label>

                                    <!-- Tampilkan foto lama -->
                                    <div class="mb-2">
                                        <img src="uploads/foto-guru/<?php echo $row['foto']; ?>" 
                                            alt="Foto Guru" 
                                            style="width: 100px; height:auto; border-radius:6px; border:1px solid #ddd;">
                                    </div>

                                    <!-- Input file custom -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" 
                                            placeholder="Belum ada file dipilih" id="fileName" readonly>

                                        <button class="btn btn-primary" 
                                                type="button" 
                                                onclick="document.getElementById('foto').click()">
                                            Pilih Foto
                                        </button>
                                    </div>

                                    <input type="file" 
                                        name="foto" 
                                        id="foto" 
                                        accept="image/*" 
                                        style="display:none;">
                                    
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                                </div>

                                <script>
                                document.getElementById('foto').addEventListener('change', function() {
                                    let fileName = this.files.length > 0 ? this.files[0].name : '';
                                    document.getElementById('fileName').value = fileName;
                                });
                                </script>

                                <div class="form-group">
                                    <label for="exampleInputName">Nama Lengkap Guru</label>
                                    <input type="text" name="nama_lengkap" class="form-control" id="exampleInputName"
                                        placeholder="Masukkan Nama Lengkap Guru" required
                                        value="<?php echo htmlspecialchars($row['nama_lengkap']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectJabatan">Jabatan</label>
                                    <select class="custom-select form-control-sm"
                                            name="jabatan"
                                            id="exampleSelectJabatan"
                                            required>
                                        <option value="" disabled>-- Pilih Jabatan --</option>
                                        <option value="Kepala Sekolah" <?php if($row['jabatan']=='Kepala Sekolah') echo 'selected'; ?>>Kepala Sekolah</option>
                                        <option value="Bendahara" <?php if($row['jabatan']=='Bendahara') echo 'selected'; ?>>Bendahara</option>
                                        <option value="Admin" <?php if($row['jabatan']=='Admin') echo 'selected'; ?>>Admin</option>
                                        <option value="Pengajar" <?php if($row['jabatan']=='Pengajar') echo 'selected'; ?>>Pengajar</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGender">Jenis Kelamin</label>
                                    <select class="custom-select form-control-sm"
                                            name="jenis_kelamin"
                                            id="exampleSelectGender"
                                            required>
                                        <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" <?php if($row['jenis_kelamin']=='Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php if($row['jenis_kelamin']=='Perempuan') echo 'selected'; ?>>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDateBirth">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        class="form-control form-control-sm"
                                        id="exampleInputDateBirth"
                                        style="font-size: 16px;"
                                        required
                                        value="<?php echo htmlspecialchars($row['tanggal_lahir']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputAdress">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" id="exampleInputAdress"
                                        placeholder="Masukkan Alamat Rumah Guru"
                                        required
                                        value="<?php echo htmlspecialchars($row['alamat']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputNumberHP">No HP</label>
                                    <input type="text" name="no_hp" class="form-control" id="exampleInputNumberHP"
                                        placeholder="Masukkan No HP Guru"
                                        pattern="^08[0-9]{8,11}$"
                                        maxlength="13"
                                        required
                                        title="Nomor HP harus diawali 08 dan terdiri dari 10-13 digit angka"
                                        value="<?php echo htmlspecialchars($row['no_hp']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail"
                                        placeholder="Masukkan Email Guru"
                                        required
                                        value="<?php echo htmlspecialchars($row['email']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDate">Tanggal Masuk</label>
                                    <input type="date" name="tanggal_masuk"
                                        class="form-control form-control-sm"
                                        id="exampleInputDate"
                                        style="font-size: 16px;"
                                        required
                                        value="<?php echo htmlspecialchars($row['tanggal_masuk']); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectStatus">Status</label>
                                    <select class="custom-select form-control-sm"
                                            name="status"
                                            id="exampleSelectStatus"
                                            required>
                                        <option value="" disabled>-- Pilih Status Guru --</option>
                                        <option value="Aktif" <?php if($row['status']=='Aktif') echo 'selected'; ?>>Aktif</option>
                                        <option value="Tidak Aktif" <?php if($row['status']=='Tidak Aktif') echo 'selected'; ?>>Tidak Aktif</option>
                                    </select>
                                </div>

                                <!-- Password: tip—biarkan kosong untuk tidak merubah -->
                                <div class="form-group">
                                    <label for="exampleInputPassword">Password (kosongkan jika tidak ingin mengganti)</label>
                                    <div class="input-group">
                                        <input type="password"
                                            name="password"
                                            class="form-control"
                                            id="exampleInputPassword"
                                            placeholder="Masukkan Password Guru (opsional)"
                                            minlength="6">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                                <i id="toggleIcon" class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                    <!-- tombol submit -->
                                    <button type="update" name="update" class="btn btn-primary">Update</button>
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

</body>

</html>