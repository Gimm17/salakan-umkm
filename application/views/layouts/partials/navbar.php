<?php
$segment1 = $this->uri->segment(1);
?>
<!-- Navbar Modern dengan tema Terracotta -->
<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bolder fs-4" href="<?php echo site_url(); ?>">
            <i class="fas fa-store me-2"></i>
            <span style="color: var(--text-dark);">UMKM</span><span style="color: var(--primary);">Banggai</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="mainNav">
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
                                    <i class="fas fa-tachometer-alt fa-fw me-2 text-muted"></i>Dasbor
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