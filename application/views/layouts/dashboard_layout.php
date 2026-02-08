<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Dashboard'); ?> | UMKM Banggai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #E27D60;      /* Terracotta */
            --primary-rgb: 226, 125, 96;
            --secondary: #85B66F;    /* Olive Green */
            --accent: #FFD166;       /* Gold Yellow */
            --bg-ivory: #FFF8F0;     /* Ivory Background */
            --text-dark: #3E2723;    /* Dark Brown Font */
            --white: #FFFFFF;
            --light-gray: #F8F9FA;
            --medium-gray: #9E9E9E;
            --shadow: rgba(62, 39, 35, 0.1);
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --bs-primary-rgb: var(--primary-rgb);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-ivory);
            color: var(--text-dark);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6, .fw-bold, .fw-bolder { 
            font-family: 'Inter', sans-serif; 
            font-weight: 700;
        }

        /* Enhanced Navbar */
        .header-navbar { 
            background: var(--white);
            box-shadow: 0 2px 20px var(--shadow);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .header-navbar .nav-link { 
            font-weight: 600; 
            color: var(--text-dark);
            margin: 0 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            position: relative;
        }

        .header-navbar .nav-link:hover,
        .header-navbar .nav-link.active { 
            color: var(--white);
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(226, 125, 96, 0.3);
        }

        .header-navbar .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
        }

        /* Main Content */
        .dashboard-main {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        /* Cards */
        .card { 
            border: none; 
            border-radius: 1rem;
            box-shadow: 0 4px 20px var(--shadow);
            transition: all 0.3s ease;
            background: var(--white);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(62, 39, 35, 0.15);
        }

        .card-header {
            background: var(--white);
            border-bottom: 2px solid var(--bg-ivory);
            padding: 1.5rem;
            border-radius: 1rem 1rem 0 0 !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stats Cards */
        .stats-card {
            background: var(--gradient);
            color: var(--white);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .stats-card:hover::before {
            transform: translateX(100%);
        }

        .stats-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .stats-card .stats-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .stats-card:hover .stats-icon {
            transform: scale(1.1) rotate(360deg);
            background: rgba(255,255,255,0.3);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(226, 125, 96, 0.3);
        }

        .btn-primary:hover {
            background: #d16749;
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(226, 125, 96, 0.4);
        }

        .btn-outline-primary {
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--secondary);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: #729a5e;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: var(--accent);
            border: none;
            color: var(--text-dark);
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background: #e6c866;
            color: var(--text-dark);
            transform: translateY(-2px);
        }

        /* Tables */
        .table {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 20px var(--shadow);
        }

        .table thead th {
            background: var(--gradient);
            color: var(--white);
            border: none;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(226, 125, 96, 0.05);
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1rem;
            border-color: rgba(62, 39, 35, 0.1);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(133, 182, 111, 0.1) 0%, rgba(133, 182, 111, 0.05) 100%);
            color: var(--secondary);
            border-left: 4px solid var(--secondary);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(226, 125, 96, 0.1) 0%, rgba(226, 125, 96, 0.05) 100%);
            color: var(--primary);
            border-left: 4px solid var(--primary);
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(255, 209, 102, 0.1) 0%, rgba(255, 209, 102, 0.05) 100%);
            color: #b8860b;
            border-left: 4px solid var(--accent);
        }

        /* Dropdown */
        .dropdown-menu {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(62, 39, 35, 0.15);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            margin: 0 0.5rem;
        }

        .dropdown-item:hover {
            background: var(--bg-ivory);
            color: var(--primary);
            transform: translateX(5px);
        }

        .dropdown-divider {
            border-color: rgba(62, 39, 35, 0.1);
            margin: 0.5rem 1rem;
        }

        /* Form Controls */
        .form-control, .form-select {
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(226, 125, 96, 0.25);
        }

        /* Page Title */
        .page-title {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background: var(--white);
            border-top: 2px solid var(--bg-ivory);
            padding: 1.5rem 0;
            margin-top: auto;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Quick Action Cards */
        .quick-action {
            background: var(--white);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 20px var(--shadow);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .quick-action:hover {
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: 0 15px 40px rgba(62, 39, 35, 0.15);
        }

        .quick-action .action-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--white);
            transition: all 0.3s ease;
        }

        .quick-action:hover .action-icon {
            transform: scale(1.2) rotate(360deg);
        }

        /* P0 FIX: Prevent horizontal overflow on all screens */
        html, body {
            overflow-x: hidden;
        }

        /* ========================================
           MOBILE DASHBOARD REDESIGN 
           ======================================== */
        
        @media (max-width: 768px) {
            /* Compact Dashboard Main */
            .dashboard-main {
                padding: 0.75rem 0;
            }

            /* Minimalist Page Header */
            .d-flex.justify-content-between.align-items-center.mb-4 {
                flex-direction: row !important;
                align-items: center !important;
                margin-bottom: 1rem !important;
                padding: 0;
            }

            .page-title {
                font-size: 1.25rem !important;
                margin-bottom: 0 !important;
            }

            /* Hide role badge on mobile - shown in drawer */
            .d-flex.justify-content-between.align-items-center.mb-4 .badge,
            .d-flex.justify-content-between.align-items-center.mb-4 small {
                display: none !important;
            }

            /* Compact Stats Cards - Horizontal Layout */
            .stats-card {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                text-align: left !important;
                padding: 0.875rem 1rem !important;
                margin-bottom: 0.5rem !important;
                border-radius: 0.75rem;
            }

            .stats-card .stats-icon {
                width: 42px;
                height: 42px;
                margin: 0 !important;
                margin-right: 0.875rem !important;
                flex-shrink: 0;
                font-size: 1.1rem;
            }

            .stats-card h3, 
            .stats-card h4,
            .stats-card .stats-value {
                font-size: 1.25rem !important;
                margin-bottom: 0 !important;
            }

            .stats-card p,
            .stats-card small,
            .stats-card .stats-label {
                font-size: 0.75rem !important;
                margin-bottom: 0 !important;
                opacity: 0.9;
            }

            .stats-card-content {
                flex: 1;
            }

            /* Disable hover effects on mobile */
            .stats-card:hover {
                transform: none !important;
            }

            .stats-card:hover .stats-icon {
                transform: none !important;
            }

            /* Compact Cards */
            .card {
                margin-bottom: 0.75rem !important;
                border-radius: 0.75rem !important;
            }

            .card-header {
                padding: 0.875rem 1rem !important;
            }

            .card-body {
                padding: 0.875rem 1rem !important;
            }

            /* Compact Buttons */
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            .btn-sm {
                padding: 0.35rem 0.75rem;
                font-size: 0.8rem;
            }

            /* Header Navbar Compact */
            .header-navbar .nav-link {
                margin: 0.25rem 0;
                text-align: center;
            }

            /* Quick Actions Grid */
            .quick-action {
                padding: 1rem;
                margin-bottom: 0.5rem;
            }

            .quick-action .action-icon {
                width: 40px;
                height: 40px;
                margin-bottom: 0.5rem;
            }

            /* Table Mobile Card View */
            .table-responsive-mobile thead {
                display: none;
            }

            .table-responsive-mobile tbody tr {
                display: block;
                background: var(--white);
                border-radius: 0.75rem;
                margin-bottom: 0.5rem;
                padding: 0.75rem;
                box-shadow: 0 2px 8px var(--shadow);
            }

            .table-responsive-mobile tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.4rem 0;
                border: none;
                border-bottom: 1px solid rgba(62, 39, 35, 0.08);
                font-size: 0.875rem;
            }

            .table-responsive-mobile tbody td:last-child {
                border-bottom: none;
            }

            .table-responsive-mobile tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--text-dark);
                font-size: 0.8rem;
            }

            /* Footer Compact */
            .footer {
                padding: 0.75rem 0;
            }

            .footer .row {
                flex-direction: column;
                text-align: center;
            }

            .footer .col-md-6 {
                margin-bottom: 0.5rem;
            }

            .footer small {
                font-size: 0.75rem;
            }
        }

        /* Extra Small Phones */
        @media (max-width: 360px) {
            .container {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }

            .page-title {
                font-size: 1.1rem !important;
            }

            .stats-card {
                padding: 0.75rem !important;
            }

            .stats-card .stats-icon {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }

            .stats-card h3,
            .stats-card h4,
            .stats-card .stats-value {
                font-size: 1.1rem !important;
            }

            .card-header,
            .card-body {
                padding: 0.75rem !important;
            }
        }

        /* Loading State */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    </head>
    <body>
        <!-- Enhanced Header -->
        <header class="header-navbar sticky-top">
            <nav class="navbar navbar-expand-lg container">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold" href="<?php echo site_url('/'); ?>">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        <span style="color: var(--text-dark);">UMKM</span><span style="color: var(--primary);">Banggai</span>
                    </a>
                    
                    <!-- Mobile: Off-Canvas Trigger -->
                    <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#dashboardMobileNav" aria-controls="dashboardMobileNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <!-- Desktop Navigation -->
                    <div class="collapse navbar-collapse d-none d-lg-flex" id="navbarDashboard">
                        <?php 
                            $role = $this->session->userdata('role');
                            $controller = $this->router->fetch_class();
                        ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php if ($role == 'admin'): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($controller == 'admin' && $this->uri->segment(2) == '') ? 'active' : ''; ?>" href="<?php echo site_url('admin'); ?>"><i class="fas fa-home me-2"></i>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'manajemen_pengguna') ? 'active' : ''; ?>" href="<?php echo site_url('admin/manajemen_pengguna'); ?>"><i class="fas fa-users me-2"></i>Pengguna</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'manajemen_toko') ? 'active' : ''; ?>" href="<?php echo site_url('admin/manajemen_toko'); ?>"><i class="fas fa-store me-2"></i>Toko</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'manajemen_kategori') ? 'active' : ''; ?>" href="<?php echo site_url('admin/manajemen_kategori'); ?>"><i class="fas fa-tags me-2"></i>Kategori</a>
                                </li>
                            <?php elseif ($role == 'penjual'): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($controller == 'seller' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == 'index')) ? 'active' : ''; ?>" href="<?php echo site_url('seller'); ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>" href="<?php echo site_url('seller/produk'); ?>"><i class="fas fa-box-open me-2"></i>Produk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'toko' || $this->uri->segment(2) == 'pengaturan_toko') ? 'active' : ''; ?>" href="<?php echo site_url('seller/toko'); ?>"><i class="fas fa-store-alt me-2"></i>Toko</a>
                                </li>
                            <?php else: // Pengguna ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($controller == 'user' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == 'index')) ? 'active' : ''; ?>" href="<?php echo site_url('user'); ?>"><i class="fas fa-home me-2"></i>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'favorit') ? 'active' : ''; ?>" href="<?php echo site_url('user/favorit'); ?>"><i class="fas fa-heart me-2"></i>Favorit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ($controller == 'user' && $this->uri->segment(2) == 'profile') ? 'active' : ''; ?>" href="<?php echo site_url('user/profile'); ?>"><i class="fas fa-user me-2"></i>Profil</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        $foto = $this->session->userdata('foto');
                                        $foto_url = base_url('public/img/profile/' . $foto);
                                    ?>
                                    <?php if ($foto && file_exists(FCPATH . 'public/img/profile/' . $foto)): ?>
                                        <img src="<?php echo $foto_url; ?>" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;" alt="Foto Profil">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user fa-sm text-white"></i>
                                        </div>
                                    <?php endif; ?>
                                    <span class="fw-bold"><?php echo htmlspecialchars($this->session->userdata('nama')); ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <?php
                                        $profile_url = '';
                                        if ($role == 'admin') {
                                            $profile_url = site_url('admin/profile');
                                        } elseif ($role == 'penjual') {
                                            $profile_url = site_url('seller/profile');
                                        } else {
                                            $profile_url = site_url('user/profile');
                                        }
                                    ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo $profile_url; ?>">
                                            <i class="fas fa-user-edit fa-fw me-2 text-muted"></i>Edit Profil
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="<?php echo site_url('auth/logout'); ?>">
                                            <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Mobile Off-Canvas Dashboard Menu -->
        <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="dashboardMobileNav" aria-labelledby="dashboardMobileNavLabel">
            <div class="offcanvas-header border-bottom py-3">
                <h6 class="offcanvas-title fw-bold mb-0" id="dashboardMobileNavLabel">
                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>Menu Dashboard
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-0">
                <!-- User Profile Card -->
                <div class="p-3 bg-light border-bottom">
                    <div class="d-flex align-items-center">
                        <?php if ($foto && file_exists(FCPATH . 'public/img/profile/' . $foto)): ?>
                            <img src="<?php echo $foto_url; ?>" class="rounded-circle me-3" style="width: 48px; height: 48px; object-fit: cover;" alt="Foto">
                        <?php else: ?>
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        <?php endif; ?>
                        <div>
                            <div class="fw-bold"><?php echo htmlspecialchars($this->session->userdata('nama')); ?></div>
                            <span class="badge bg-primary rounded-pill text-capitalize"><?php echo $role; ?></span>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation Links -->
                <nav class="flex-grow-1 p-2">
                    <?php if ($role == 'admin'): ?>
                        <a class="mobile-dash-link <?php echo ($controller == 'admin' && $this->uri->segment(2) == '') ? 'active' : ''; ?>" href="<?php echo site_url('admin'); ?>">
                            <i class="fas fa-home fa-fw"></i>Dashboard
                        </a>
                        <a class="mobile-dash-link <?php echo ($this->uri->segment(2) == 'manajemen_pengguna') ? 'active' : ''; ?>" href="<?php echo site_url('admin/manajemen_pengguna'); ?>">
                            <i class="fas fa-users fa-fw"></i>Pengguna
                        </a>
                        <a class="mobile-dash-link <?php echo ($this->uri->segment(2) == 'manajemen_toko') ? 'active' : ''; ?>" href="<?php echo site_url('admin/manajemen_toko'); ?>">
                            <i class="fas fa-store fa-fw"></i>Toko
                        </a>
                        <a class="mobile-dash-link <?php echo ($this->uri->segment(2) == 'manajemen_kategori') ? 'active' : ''; ?>" href="<?php echo site_url('admin/manajemen_kategori'); ?>">
                            <i class="fas fa-tags fa-fw"></i>Kategori
                        </a>
                    <?php elseif ($role == 'penjual'): ?>
                        <a class="mobile-dash-link <?php echo ($controller == 'seller' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard')) ? 'active' : ''; ?>" href="<?php echo site_url('seller'); ?>">
                            <i class="fas fa-tachometer-alt fa-fw"></i>Dashboard
                        </a>
                        <a class="mobile-dash-link <?php echo ($this->uri->segment(2) == 'produk') ? 'active' : ''; ?>" href="<?php echo site_url('seller/produk'); ?>">
                            <i class="fas fa-box-open fa-fw"></i>Produk
                        </a>
                        <a class="mobile-dash-link <?php echo ($this->uri->segment(2) == 'toko' || $this->uri->segment(2) == 'pengaturan_toko') ? 'active' : ''; ?>" href="<?php echo site_url('seller/toko'); ?>">
                            <i class="fas fa-store-alt fa-fw"></i>Toko
                        </a>
                    <?php else: ?>
                        <a class="mobile-dash-link <?php echo ($controller == 'user' && ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard')) ? 'active' : ''; ?>" href="<?php echo site_url('user'); ?>">
                            <i class="fas fa-home fa-fw"></i>Dashboard
                        </a>
                        <a class="mobile-dash-link <?php echo ($this->uri->segment(2) == 'favorit') ? 'active' : ''; ?>" href="<?php echo site_url('user/favorit'); ?>">
                            <i class="fas fa-heart fa-fw"></i>Favorit
                        </a>
                        <a class="mobile-dash-link <?php echo ($this->uri->segment(2) == 'profile') ? 'active' : ''; ?>" href="<?php echo site_url('user/profile'); ?>">
                            <i class="fas fa-user fa-fw"></i>Profil
                        </a>
                    <?php endif; ?>
                </nav>
                
                <!-- Footer Actions -->
                <div class="p-3 border-top mt-auto">
                    <a href="<?php echo $profile_url; ?>" class="btn btn-outline-primary w-100 rounded-pill mb-2">
                        <i class="fas fa-user-edit me-2"></i>Edit Profil
                    </a>
                    <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-outline-danger w-100 rounded-pill">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>

        <style>
        /* Mobile Dashboard Off-Canvas */
        .offcanvas {
            max-width: 280px;
        }
        
        .mobile-dash-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .mobile-dash-link:hover {
            background: rgba(226, 125, 96, 0.1);
            color: var(--primary);
        }
        
        .mobile-dash-link.active {
            background: var(--gradient);
            color: white;
        }
        
        .mobile-dash-link i {
            width: 20px;
            text-align: center;
        }
        </style>

    <!-- Main Content -->
    <main class="container dashboard-main">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title fw-bolder"><?php echo htmlspecialchars($title ?? 'Dashboard'); ?></h1>
            <div class="d-flex align-items-center">
                <span class="badge bg-primary rounded-pill px-3 py-2 me-3">
                    <i class="fas fa-user me-1"></i>
                    <?php echo ucfirst($this->session->userdata('role')); ?>
                </span>
                <small class="text-muted">
                    <i class="fas fa-calendar me-1"></i>
                    <?php echo date('d F Y'); ?>
                </small>
            </div>
        </div>
        
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show fade-in-up" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show fade-in-up" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <!-- Main Content Area -->
        <div class="fade-in-up">
            <?php if (isset($page_content)) { $this->load->view($page_content); } ?>
        </div>
    </main>

    <!-- Enhanced Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-store me-2 text-primary"></i>
                        <span class="fw-bold me-3">UMKM Banggai</span>
                        <span class="text-muted">&copy; <?php echo date('Y'); ?></span>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="text-muted">
                        Dashboard <?php echo ucfirst($this->session->userdata('role')); ?> | 
                        <i class="fas fa-heart text-danger"></i> Mendukung UMKM Lokal
                    </small>
                </div>
            </div>
        </div>
    </footer>
<!-- Script custom kamu di bawah sini -->
    <script>
        $(document).ready(function() {
            // Enhanced navbar scroll effect
            let scrolled = false;
            $(window).scroll(function() {
                if ($(window).scrollTop() > 50 && !scrolled) {
                    $('.header-navbar').addClass('scrolled');
                    scrolled = true;
                } else if ($(window).scrollTop() <= 50 && scrolled) {
                    $('.header-navbar').removeClass('scrolled');
                    scrolled = false;
                }
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);

            // Enhanced loading states
            $('form').on('submit', function() {
                const submitBtn = $(this).find('button[type="submit"]');
                if (submitBtn.length) {
                    submitBtn.prop('disabled', true);
                    submitBtn.addClass('loading');
                    const originalText = submitBtn.html();
                    submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');
                    
                    setTimeout(() => {
                        submitBtn.prop('disabled', false);
                        submitBtn.removeClass('loading');
                        submitBtn.html(originalText);
                    }, 10000);
                }
            });

            // Enhanced table interactions
            $('.table tbody tr').on('click', function() {
                $(this).addClass('table-active').siblings().removeClass('table-active');
            });

            // Quick stats animation
            $('.stats-card').each(function(index) {
                $(this).css('animation-delay', (index * 0.1) + 's');
                $(this).addClass('fade-in-up');
            });

            // ==================================================================
            // PERUBAHAN DIMULAI: Menghapus script hover pada dropdown
            // ==================================================================
            // Blok kode di bawah ini dihapus agar dropdown berfungsi dengan klik (bawaan Bootstrap)
            /*
            $('.dropdown').hover(
                function() {
                    $(this).find('.dropdown-menu').stop(true, true).fadeIn(200);
                },
                function() {
                    $(this).find('.dropdown-menu').stop(true, true).fadeOut(200);
                }
            );
            */
            // ==================================================================
            // PERUBAHAN SELESAI
            // ==================================================================
        });

        // Add scrolled class style
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.createElement('style');
            style.textContent = `
                .header-navbar.scrolled {
                    background: rgba(255, 255, 255, 0.95) !important;
                    backdrop-filter: blur(20px);
                    box-shadow: 0 4px 30px rgba(62, 39, 35, 0.15);
                }
            `;
            document.head.appendChild(style);
        });
    </script>
    
</body>
</html>
