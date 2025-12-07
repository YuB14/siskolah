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
    <title>Siskolah - Dashboard</title>
    
    <link rel="shortcut icon" href="./img/school-solid-full.svg" type="image/x-icon" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        /* Custom Styles untuk Dashboard yang Lebih Menarik */
        .stat-card {
            border-radius: 15px;
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            position: relative;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--color-start), var(--color-end));
        }
        
        .stat-card.success {
            --color-start: #1cc88a;
            --color-end: #13855c;
        }
        
        .stat-card.primary {
            --color-start: #4e73df;
            --color-end: #224abe;
        }
        
        .stat-card.danger {
            --color-start: #e74a3b;
            --color-end: #be2617;
        }
        
        .stat-card.warning {
            --color-start: #f6c23e;
            --color-end: #dda20a;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .icon-success { background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%); }
        .icon-primary { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); }
        .icon-danger { background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%); }
        .icon-warning { background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%); }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            margin-top: 8px;
        }
        
        .chart-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .chart-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
            border: none;
        }
        
        .feature-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 60px 40px;
            margin-top: 40px;
            color: white;
            text-align: center;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .feature-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .feature-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }
        
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.2);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .feature-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .quick-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .quick-btn {
            flex: 1;
            min-width: 200px;
            padding: 15px 25px;
            border-radius: 10px;
            border: 2px solid #4e73df;
            background: white;
            color: #4e73df;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .quick-btn:hover {
            background: #4e73df;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 40px;
            color: white;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .welcome-banner h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .welcome-banner p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .dashboard-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .dashboard-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .dashboard-header p {
            opacity: 0.9;
            position: relative;
            z-index: 1;
            font-size: 1.05rem;
        }

        .dashboard-content {
            padding: 30px;
            background: #f8f9fa;
        }

        .iframe-wrapper {
            position: relative;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .iframe-wrapper:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: opacity 0.3s ease;
        }

        .loading-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            margin-top: 20px;
            color: #667eea;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .powerbi-iframe {
            width: 100%;
            height: 650px;
            border: none;
            display: block;
        }

        .dashboard-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .info-icon.blue {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .info-icon.purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .info-icon.green {
            background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        }

        .info-content h3 {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .info-content p {
            font-size: 1rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .fullscreen-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(102, 126, 234, 0.9);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .fullscreen-btn:hover {
            background: rgba(102, 126, 234, 1);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .dashboard-header {
                padding: 20px;
            }

            .dashboard-header h1 {
                font-size: 1.5rem;
            }

            .dashboard-content {
                padding: 15px;
            }

            .powerbi-iframe {
                height: 500px;
            }

            .info-card {
                padding: 15px;
            }
        }

        .fullscreen-mode {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            border-radius: 0;
            margin: 0;
        }

        .fullscreen-mode .powerbi-iframe {
            height: 100vh;
        }
    
    </style>
</head>

<body id="page-top">

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

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TOPBAR TETAP SAMA -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link p-2 mr-2">
                        <i class="fa fa-bars fa-lg"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter" id="notifCount">0</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <h6 class="dropdown-header">Alerts Center</h6>
                                <div id="notifList"></div>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Pengajar</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- ============================================ -->
                <!-- BAGIAN CONTENT YANG DIPERBAIKI MULAI DI SINI -->
                <!-- ============================================ -->
                
                <div class="container-fluid">
                    
                    <!-- Welcome Banner -->
                    <div class="welcome-banner">
                        <div style="position: relative; z-index: 1;">
                            <h2>Selamat Datang di Dashboard Siskolah! 🎓</h2>
                            <p>Kelola seluruh aktivitas sekolah dengan mudah dan efisien</p>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row">
                        <!-- Card 1: Data Sekolah -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card success shadow">
                                <div class="card-body" style="padding: 25px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="stat-label">Data Sekolah</div>
                                            <div class="stat-number">
                                                <span id="total_guru" style="font-size: 1.5rem;">0</span>
                                                <span style="font-size: 0.9rem; color: #6c757d;"> Guru</span>
                                            </div>
                                            <div class="stat-number" style="font-size: 1.5rem; margin-top: 10px;">
                                                <span id="total_siswa">0</span>
                                                <span style="font-size: 0.9rem; color: #6c757d;"> Siswa</span>
                                            </div>
                                        </div>
                                        <div class="stat-icon icon-success">
                                            <i class="fas fa-users text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Pengaduan -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="pengaduan.php" style="text-decoration:none;">
                                <div class="card stat-card primary shadow">
                                    <div class="card-body" style="padding: 25px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="stat-label">Pengaduan</div>
                                                <div class="stat-number">
                                                    <span id="jumlah_pengaduan">0</span>
                                                </div>
                                                <small class="text-muted">Perlu ditindaklanjuti</small>
                                            </div>
                                            <div class="stat-icon icon-primary">
                                                <i class="fas fa-comments text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Card 3: Kritik & Saran -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="kritik-saran.php" style="text-decoration:none;">
                                <div class="card stat-card warning shadow">
                                    <div class="card-body" style="padding: 25px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="stat-label">Kritik & Saran</div>
                                                <div class="stat-number">
                                                    <span id="jumlah_kritik">0</span>
                                                </div>
                                                <small class="text-muted">Masukan berharga</small>
                                            </div>
                                            <div class="stat-icon icon-warning">
                                                <i class="fas fa-lightbulb text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Card 4: SPP Belum Lunas -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="spp-x-a.php" style="text-decoration:none;">
                                <div class="card stat-card danger shadow">
                                    <div class="card-body" style="padding: 25px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="stat-label">SPP Belum Lunas</div>
                                                <div class="stat-number pulse-animation">
                                                    <span id="jumlah_belum_lunas">0</span>
                                                </div>
                                                <small class="text-muted">Siswa tertunggak</small>
                                            </div>
                                            <div class="stat-icon icon-danger">
                                                <i class="fas fa-exclamation-circle text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <a href="biodata-siswa.php" class="quick-btn">
                            <i class="fas fa-user-graduate mr-2"></i> Kelola Siswa
                        </a>
                        <a href="biodata-guru.php" class="quick-btn">
                            <i class="fas fa-chalkboard-teacher mr-2"></i> Kelola Guru
                        </a>
                        <a href="absensi-guru.php" class="quick-btn">
                            <i class="fas fa-clipboard-check mr-2"></i> Absensi
                        </a>
                        <a href="mata-pelajaran.php" class="quick-btn">
                            <i class="fas fa-book mr-2"></i> Mata Pelajaran
                        </a>
                    </div>

                    <!-- Charts -->
                    <div class="row mt-4">
                        <!-- Grafik Keuangan -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card chart-card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        Grafik Keuangan Bulanan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart" style="height: 350px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart Absensi -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card chart-card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-chart-pie mr-2"></i>
                                        Absensi Siswa Hari Ini
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Hadir
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Izin
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Sakit
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Alpa
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

 <div class="dashboard-container" id="dashboardContainer">
        <div class="dashboard-header">
            <h1>
                <div class="dashboard-icon">📊</div>
                Dashboard Analitik Siskolah
            </h1>
            <p>Visualisasi data sekolah secara real-time dengan Power BI</p>
        </div>

        <div class="dashboard-content">
            <div class="dashboard-info">
                <div class="info-card">
                    <div class="info-icon blue">📈</div>
                    <div class="info-content">
                        <h3>Status</h3>
                        <p>Live Dashboard</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon purple">🔄</div>
                    <div class="info-content">
                        <h3>Update</h3>
                        <p>Refresh Data</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon green">✓</div>
                    <div class="info-content">
                        <h3>Platform</h3>
                        <p>Power BI</p>
                    </div>
                </div>
            </div>

            <div class="iframe-wrapper" id="iframeWrapper">
                <button class="fullscreen-btn" id="fullscreenBtn" onclick="toggleFullscreen()">
                    <span id="fullscreenIcon">⛶</span>
                    <span id="fullscreenText">Fullscreen</span>
                </button>
                
                <div class="loading-overlay" id="loadingOverlay">
                    <div class="spinner"></div>
                    <div class="loading-text">Memuat Dashboard...</div>
                </div>

                <iframe 
                    id="powerbiFrame"
                    class="powerbi-iframe"
                    title="Final Dashboard - Siskolah"
                    src="https://app.powerbi.com/view?r=eyJrIjoiODJlMjU1MzMtMmQyOS00YTk4LWIwZTctY2I1NmFhNDFkMGYyIiwidCI6ImE2OWUxOWU4LWYwYTQtNGU3Ny1iZmY2LTk1NjRjODgxOWIxNCJ9"
                    frameborder="0"
                    allowFullScreen="true">
                </iframe>
            </div>
        </div>
    </div>

                    <!-- Feature Section -->
                    <div class="feature-section">
                        <h2 class="mb-2">
                            <i class="fas fa-star mr-3"></i>
                            Fitur Unggulan Siskolah
                        </h2>
                        <p style="font-size: 1.1rem; opacity: 0.9;">
                            Sistem informasi sekolah yang lengkap dan mudah digunakan
                        </p>

                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-school"></i>
                                </div>
                                <div class="feature-title">Manajemen Kelas</div>
                                <p style="opacity: 0.8; margin: 0;">Kelola data kelas dan siswa dengan mudah</p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="feature-title">Data Guru & Mapel</div>
                                <p style="opacity: 0.8; margin: 0;">Manajemen guru dan mata pelajaran terpadu</p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="feature-title">Absensi Digital</div>
                                <p style="opacity: 0.8; margin: 0;">Sistem absensi siswa dan guru real-time</p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div class="feature-title">Sistem Nilai</div>
                                <p style="opacity: 0.8; margin: 0;">Pencatatan dan pelaporan nilai otomatis</p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="feature-title">Pengaduan & Kritik</div>
                                <p style="opacity: 0.8; margin: 0;">Saluran komunikasi dua arah yang efektif</p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="feature-title">Keuangan Sekolah</div>
                                <p style="opacity: 0.8; margin: 0;">Manajemen SPP dan keuangan terintegrasi</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top -->
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
                <div class="modal-body">Pilih "Log Out" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script>
    // Load Notifications
    function loadNotif() {
        fetch("notif.php")
            .then(res => res.json())
            .then(data => {
                document.getElementById("notifCount").innerText = data.count;
                let listHtml = "";
                data.items.forEach(n => {
                    listHtml += `
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">${n.tanggal}</div>
                                <span class="font-weight-bold">${n.jenis}: ${n.judul}</span>
                            </div>
                        </a>
                    `;
                });
                document.getElementById("notifList").innerHTML = listHtml;
            })
            .catch(err => console.error("Fetch error:", err));
    }

    // Load Dashboard Stats
    document.addEventListener('DOMContentLoaded', () => {
        loadNotif();

        function ambilData(url, callback) {
            fetch(url)
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    return res.json();
                })
                .then(data => callback(data))
                .catch(err => console.error(`Gagal fetch ${url}:`, err));
        }

        ambilData('kartu.php?tipe=pengaduan', data => {
            const el = document.getElementById('jumlah_pengaduan');
            if (el && data.total !== undefined) el.textContent = data.total;
        });

        ambilData('kartu.php?tipe=kritik', data => {
            const el = document.getElementById('jumlah_kritik');
            if (el && data.total !== undefined) el.textContent = data.total;
        });

        ambilData('kartu.php?tipe=sekolah', data => {
            const g = document.getElementById('total_guru');
            const s = document.getElementById('total_siswa');
            if (g && s && data.guru !== undefined && data.siswa !== undefined) {
                g.textContent = data.guru;
                s.textContent = data.siswa;
            }
        });

        fetch('kartu.php?tipe=spp_belum_lunas')
            .then(res => res.json())
            .then(data => {
                document.getElementById('jumlah_belum_lunas').textContent = data.total;
            });
    });

// Line Chart - Keuangan Bulanan (PAKAI PHP MURNI)
fetch('line.php')
  .then(response => response.json())
  .then(data => {
    const labels = data.map(item => item.bulan);
    const pemasukan = data.map(item => item.pemasukan);
    const pengeluaran = data.map(item => item.pengeluaran);

    const ctx = document.getElementById('myAreaChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [
          {
            label: 'Pemasukan',
            data: pemasukan,
            borderColor: '#4e73df',
            backgroundColor: 'rgba(78, 115, 223, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
          },
          {
            label: 'Pengeluaran',
            data: pengeluaran,
            borderColor: '#e74a3b',
            backgroundColor: 'rgba(231, 74, 59, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'top' }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: value => 'Rp ' + value.toLocaleString('id-ID')
            }
          }
        }
      }
    });
  })
  .catch(err => {
    console.error('Error:', err);
    document.querySelector('#myAreaChart').parentElement.innerHTML = 
      '<p class="text-center text-muted">Gagal memuat grafik keuangan</p>';
  });

// Pie Chart - Absensi Siswa (PAKAI PHP MURNI)
   fetch('pie.php')
  .then(response => response.json())
  .then(data => {
    const labels = data.map(item => item.status);
    const values = data.map(item => item.jumlah);
    const total = values.reduce((a, b) => a + b, 0);


    const warnaAbsensi = {
      'Hadir': '#4e73df',
      'Izin' : '#1cc88a',
      'Sakit': '#f6c23e',
      'Alpa' : '#e74a3b'
    };

    const backgroundColors = labels.map(label => warnaAbsensi[label] || '#999999');
    const hoverColors = labels.map(label => 
      label === 'Hadir' ? '#2e59d9' :
      label === 'Izin'  ? '#17a673' :
      label === 'Sakit' ? '#dda20a' :
      label === 'Alpa'  ? '#c0392b' : '#666666'
    );

    const ctx = document.getElementById('myPieChart').getContext('2d');
    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: values,
          backgroundColor: backgroundColors,
          hoverBackgroundColor: hoverColors,
          borderWidth: 3,
          borderColor: '#fff'
        }]
      },
      options: {
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom' },
          tooltip: {
            callbacks: {
              label: context => {
                const percent = ((context.raw / total) * 100).toFixed(1);
                return `${context.label}: ${context.raw} siswa (${percent}%)`;
              }
            }
          }
        }
      }
    });
  });
    </script>

    <script>
        // Hide loading overlay when iframe loads
        const iframe = document.getElementById('powerbiFrame');
        const loadingOverlay = document.getElementById('loadingOverlay');

        iframe.addEventListener('load', function() {
            setTimeout(() => {
                loadingOverlay.classList.add('hidden');
            }, 500);
        });

        // Fullscreen functionality
        function toggleFullscreen() {
            const wrapper = document.getElementById('iframeWrapper');
            const btn = document.getElementById('fullscreenBtn');
            const icon = document.getElementById('fullscreenIcon');
            const text = document.getElementById('fullscreenText');
            
            wrapper.classList.toggle('fullscreen-mode');
            
            if (wrapper.classList.contains('fullscreen-mode')) {
                icon.textContent = '✕';
                text.textContent = 'Tutup';
                btn.style.background = 'rgba(231, 74, 59, 0.9)';
            } else {
                icon.textContent = '⛶';
                text.textContent = 'Fullscreen';
                btn.style.background = 'rgba(102, 126, 234, 0.9)';
            }
        }

        // ESC key to exit fullscreen
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const wrapper = document.getElementById('iframeWrapper');
                if (wrapper.classList.contains('fullscreen-mode')) {
                    toggleFullscreen();
                }
            }
        });

        // Show error message if iframe fails to load
        setTimeout(() => {
            if (loadingOverlay && !loadingOverlay.classList.contains('hidden')) {
                loadingOverlay.innerHTML = `
                    <div style="text-align: center; color: #e74a3b;">
                        <div style="font-size: 3rem; margin-bottom: 15px;">⚠️</div>
                        <div style="font-weight: 600; font-size: 1.1rem; margin-bottom: 10px;">
                            Dashboard Tidak Dapat Dimuat
                        </div>
                        <div style="color: #6c757d; font-size: 0.95rem;">
                            Periksa koneksi internet atau coba refresh halaman
                        </div>
                    </div>
                `;
            }
        }, 15000); // 15 seconds timeout
    </script>
</body>
</html>