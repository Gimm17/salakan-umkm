<?php
$segment1 = $this->uri->segment(1);
?>
<!-- Modern Navbar with Off-Canvas Mobile Menu -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bolder fs-4" href="<?php echo site_url(); ?>">
            <i class="fas fa-store me-2"></i>
            <span style="color: var(--text-dark);">UMKM</span><span style="color: var(--primary);">Banggai</span>
        </a>
        
        <!-- Mobile: Off-Canvas Trigger -->
        <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Desktop Navigation -->
        <div class="collapse navbar-collapse d-none d-lg-flex" id="mainNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo (empty($segment1) || $segment1 == 'home' || $segment1 == 'katalog' && empty($this->uri->segment(2))) ? 'active' : ''; ?>" href="<?php echo site_url(); ?>">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo ($segment1 == 'produk') ? 'active' : ''; ?>" href="<?php echo site_url('produk'); ?>">
                        <i class="fas fa-box me-1"></i>Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?php echo ($segment1 == 'toko') ? 'active' : ''; ?>" href="<?php echo site_url('toko'); ?>">
                        <i class="fas fa-store-alt me-1"></i>Toko
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center">
                <?php if ($this->session->userdata('is_logged_in')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                <i class="fas fa-user fa-sm text-white"></i>
                            </div>
                            <span class="fw-bold"><?php echo htmlspecialchars($this->session->userdata('nama')); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                             <?php 
                                $role = $this->session->userdata('role');
                                $dashboard_url = site_url(($role == 'admin') ? 'admin' : (($role == 'penjual') ? 'seller' : 'user'));
                            ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo $dashboard_url; ?>">
                                    <i class="fas fa-tachometer-alt fa-fw me-2 text-muted"></i>Dashboard
                                </a>
                            </li>
                            <?php if($role == 'pengguna'): ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo site_url('user/favorit'); ?>">
                                    <i class="fas fa-heart fa-fw me-2 text-muted"></i>Favorit
                                </a>
                            </li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="<?php echo site_url('auth/logout'); ?>">
                                    <i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-2">
                        <a href="<?php echo site_url('login'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('register'); ?>" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-user-plus me-1"></i>Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Off-Canvas Menu -->
<div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="mobileNavLabel">
            <i class="fas fa-store me-2 text-primary"></i>Menu
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <!-- Nav Links -->
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link mobile-nav-link <?php echo (empty($segment1) || $segment1 == 'home') ? 'active' : ''; ?>" href="<?php echo site_url(); ?>">
                    <i class="fas fa-home fa-fw me-3"></i>Beranda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mobile-nav-link <?php echo ($segment1 == 'produk') ? 'active' : ''; ?>" href="<?php echo site_url('produk'); ?>">
                    <i class="fas fa-box fa-fw me-3"></i>Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mobile-nav-link <?php echo ($segment1 == 'toko') ? 'active' : ''; ?>" href="<?php echo site_url('toko'); ?>">
                    <i class="fas fa-store-alt fa-fw me-3"></i>Toko
                </a>
            </li>
        </ul>
        
        <!-- Auth Section -->
        <div class="mt-auto pt-3 border-top">
            <?php if ($this->session->userdata('is_logged_in')): ?>
                <?php 
                    $role = $this->session->userdata('role');
                    $dashboard_url = site_url(($role == 'admin') ? 'admin' : (($role == 'penjual') ? 'seller' : 'user'));
                ?>
                <div class="d-flex align-items-center mb-3 p-3 bg-light rounded-3">
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <div class="fw-bold"><?php echo htmlspecialchars($this->session->userdata('nama')); ?></div>
                        <small class="text-muted text-capitalize"><?php echo $role; ?></small>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="<?php echo $dashboard_url; ?>" class="btn btn-primary rounded-pill">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-outline-danger rounded-pill">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            <?php else: ?>
                <div class="d-grid gap-2">
                    <a href="<?php echo site_url('login'); ?>" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    <a href="<?php echo site_url('register'); ?>" class="btn btn-primary rounded-pill">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
/* Mobile Off-Canvas Styles */
.offcanvas {
    max-width: 280px;
}

.mobile-nav-link {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    color: var(--text-dark);
    font-weight: 500;
    border-radius: 0.75rem;
    margin-bottom: 0.25rem;
    transition: all 0.2s ease;
}

.mobile-nav-link:hover,
.mobile-nav-link.active {
    background: linear-gradient(135deg, rgba(226, 125, 96, 0.1), rgba(133, 182, 111, 0.1));
    color: var(--primary);
}

.mobile-nav-link.active {
    font-weight: 600;
}

.mobile-nav-link i {
    font-size: 1.1rem;
    width: 24px;
}

/* Smooth offcanvas animation */
.offcanvas.offcanvas-end {
    transition: transform 0.25s ease-out;
}

.offcanvas-backdrop {
    backdrop-filter: blur(4px);
}
</style>