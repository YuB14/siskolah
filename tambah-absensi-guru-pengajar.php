<?php
session_start();
require_once "./library/koneksi.php";

// 1. Cek login
if (!isset($_SESSION['guru_login'])) {
    header("Location: login-guru.html");
    exit;
}

// 2. Cek role Bendahara
if ($_SESSION['guru_jabatan'] !== 'Pengajar') {
    header("Location: login-guru.html");
    exit;
}

// 3. Ambil data guru login berdasarkan session yang BENAR
$nip_login = $_SESSION['guru_nip'];

$queryGuru = mysqli_query($koneksi, "
    SELECT nip, nama_lengkap 
    FROM guru 
    WHERE nip = '$nip_login'
");

$dataGuru = mysqli_fetch_assoc($queryGuru);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />
    <title>Siskolah - Tambah Absensi Guru</title>

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
                                <a class="dropdown-item" href="logout.php" action="logout.php" data-toggle="modal" data-target="#logoutModal">
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
                        <h1 class="h3 text-gray-800 mb-0">Tambah Absensi Guru</h1>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="dashboard-pengajar.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="absensi-guru-pengajar.php">Data Absensi Guru</a></li>
                            <li class="breadcrumb-item active">Tambah Absensi Guru</li>
                        </ol>
                    </div>

                    <!-- Card Form langsung di bawah judul -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Absensi</h3>
                        </div>

                        <form action="proses-tambah-absensi-guru-pengajar.php" method="POST">
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
                                            Daftar Guru
                                        </h5>

                                        <div class="form-group">
                                            <label>Cari Guru</label>
                                            <input type="text" id="searchGuru" class="form-control" placeholder="Cari NIP / Nama...">
                                        </div>

                                        <div class="card shadow-sm mb-2 siswa-item">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <strong><?= htmlspecialchars($dataGuru['nama_lengkap']); ?></strong><br>
                                                    <small>NIP: <?= $dataGuru['nip']; ?></small>
                                                </div>
                                                <div>
                                                    <input type="checkbox" name="nip[]" value="<?= $dataGuru['nip']; ?>" checked>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Foto, Tanggal dan Keterangan -->
                                    <div class="col-12 mt-4">

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan jika diperlukan..."></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label fw-bold">Foto Absensi Guru</label>

                                            <!-- Input disembunyikan (untuk dikirim ke PHP) -->
                                            <input type="hidden" name="foto_data" id="foto_data">

                                            <button type="button" class="btn btn-primary" onclick="openCamera()">Ambil Foto</button>

                                            <!-- Preview foto -->
                                            <img id="previewFoto" style="margin-top: 15px; max-width: 300px; display:none; border:1px solid #ccc;">

                                            <!-- Modal kamera -->
                                            <div id="cameraModal" style="
                                                display:none; 
                                                position:fixed; 
                                                top:0; left:0; 
                                                width:100%; height:100%; 
                                                background:rgba(0,0,0,0.7); 
                                                justify-content:center; 
                                                align-items:center;
                                            ">
                                                <div style="background:white; padding:20px; border-radius:10px;">
                                                    <video id="cameraStream" autoplay style="width:300px; border:1px solid #ccc;"></video>
                                                    <br><br>
                                                    <button type="button" class="btn btn-success" onclick="takePhoto()">Capture</button>
                                                    <button type="button" class="btn btn-danger" onclick="closeCamera()">Tutup</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Absensi
                                </button>
                                <a href="absensi-guru-bendahara.php" class="btn btn-secondary">
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
    placeholder: "Pilih NIP atau nama guru",
    allowClear: true,
    width: '100%',
    minimumResultsForSearch: Infinity // 🔥 Hilangkan kolom pencarian di dropdown
    });


    // Isi otomatis nama siswa
    $('#nip').on('change', function() {
        let nama = $(this).find(':selected').data('nama');
        $('#nama_guru').val(nama || '');
    });
    });
    </script>

    <script>
    document.getElementById('searchGuru').addEventListener('keyup', function() {

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

    <script>
    let stream;

    function openCamera() {
        const modal = document.getElementById('cameraModal');
        modal.style.display = 'flex';

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(s => {
                stream = s;
                document.getElementById('cameraStream').srcObject = stream;
            })
            .catch(err => {
                alert("Kamera tidak dapat diakses: " + err);
            });
    }

    function takePhoto() {
        const video = document.getElementById('cameraStream');
        const canvas = document.createElement('canvas');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert ke Base64
        const dataURL = canvas.toDataURL('image/png');

        // Simpan ke input hidden untuk dikirim ke PHP
        document.getElementById('foto_data').value = dataURL;

        // Tampilkan preview
        document.getElementById('previewFoto').src = dataURL;
        document.getElementById('previewFoto').style.display = 'block';

        closeCamera();
    }

    function closeCamera() {
        const modal = document.getElementById('cameraModal');
        modal.style.display = 'none';

        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
    }

    document.querySelector("form").addEventListener("submit", function(e) {
        let foto = document.getElementById("foto_data").value;

        if (!foto) {
            alert("Silakan ambil foto absensi terlebih dahulu!");
            e.preventDefault(); // cegah submit
        }
    });

    </script>

</body>

</html>