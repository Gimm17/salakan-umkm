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

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-navbar .nav-link {
                margin: 0.25rem 0;
                text-align: center;
            }
            
            .dashboard-main {
                padding: 1rem 0;
            }
            
            .stats-card {
                margin-bottom: 1rem;
            }
            
            .card {
                margin-bottom: 1.5rem;
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
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDashboard" aria-controls="navbarDashboard" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarDashboard">
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
                                    <!-- ================================================================== -->
                                    <!-- PERUBAHAN DIMULAI: Logika untuk menampilkan foto profil dinamis -->
                                    <!-- ================================================================== -->
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
                                    <!-- ================================================================== -->
                                    <!-- PERUBAHAN SELESAI -->
                                    <!-- ================================================================== -->
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
