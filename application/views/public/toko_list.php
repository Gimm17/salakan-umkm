<div class="container py-4">
    <!-- Header Halaman -->
    <div class="position-relative overflow-hidden mb-5">
        <div class="card border-0 shadow-lg text-white" style="background: linear-gradient(135deg, #E27D60 0%, #85B66F 100%); min-height: 280px;">
            <!-- Decorative Elements -->
            <div class="position-absolute top-0 end-0 opacity-10">
                <i class="fas fa-store-alt" style="font-size: 150px; transform: translate(50px, -30px) rotate(15deg);"></i>
            </div>
            <div class="position-absolute bottom-0 start-0 opacity-10">
                <i class="fas fa-users" style="font-size: 120px; transform: translate(-40px, 40px) rotate(-15deg);"></i>
            </div>
            
            <div class="card-body p-5 position-relative">
                <div class="row align-items-center h-100">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-store me-1"></i>
                                Direktori UMKM Banggai
                            </span>
                        </div>
                        <h1 class="display-5 fw-bold mb-3">Daftar Pelaku UMKM</h1>
                        <p class="fs-5 mb-4 opacity-90">
                            Dukung ekonomi lokal dengan mengenal lebih dekat para pengusaha hebat 
                            di balik produk-produk berkualitas dari Banggai.
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="me-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-handshake text-warning me-2"></i>
                                    <span class="fw-semibold">Mendukung Lokal</span>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-2"></i>
                                    <span class="fw-semibold">Terpercaya</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center d-none d-lg-block">
                        <div class="position-relative">
                            <div class="bg-white bg-opacity-20 rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-store-alt text-white" style="font-size: 3rem;"></i>
                            </div>
                            <!-- Floating elements -->
                            <div class="position-absolute top-0 start-0">
                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 30px; height: 30px;">
                                    <i class="fas fa-heart text-white fa-sm"></i>
                                </div>
                            </div>
                            <div class="position-absolute bottom-0 end-0">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 25px; height: 25px;">
                                    <i class="fas fa-thumbs-up text-white fa-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom decoration -->
            <div class="position-absolute bottom-0 w-100" style="height: 4px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);"></div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-soft text-center p-3">
                <div class="card-body">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-store text-white"></i>
                    </div>
                    <h6 class="fw-bold">Toko Terdaftar</h6>
                    <p class="text-muted small mb-0"><?php echo isset($total_toko) ? $total_toko : count($tokos); ?>+ Toko Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-soft text-center p-3">
                <div class="card-body">
                    <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <h6 class="fw-bold">Pengusaha Lokal</h6>
                    <p class="text-muted small mb-0">Komunitas yang berkembang</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-soft text-center p-3">
                <div class="card-body">
                    <div class="rounded-circle accent-bg d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="fas fa-heart text-dark"></i>
                    </div>
                    <h6 class="fw-bold">Produk Berkualitas</h6>
                    <p class="text-muted small mb-0">Dibuat dengan dedikasi tinggi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Fitur Pencarian Toko -->
    <div class="card mb-5 border-0 shadow-soft">
        <div class="card-body p-4">
            <form action="<?php echo site_url('toko'); ?>" method="get">
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="position-relative">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" 
                                       name="q" 
                                       class="form-control border-start-0 ps-0" 
                                       placeholder="Cari nama toko atau lokasi..." 
                                       value="<?php echo htmlspecialchars($this->input->get('q') ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            <i class="fas fa-search me-2"></i>Cari Toko
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Search Result Info -->
    <?php if ($this->input->get('q')): ?>
    <div class="mb-4">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="text-muted">Hasil pencarian untuk:</span>
            <span class="badge bg-primary rounded-pill px-3 py-2">
                <i class="fas fa-search me-1"></i>
                "<?php echo htmlspecialchars($this->input->get('q')); ?>"
                <a href="<?php echo site_url('toko'); ?>" class="text-white ms-2 text-decoration-none">×</a>
            </span>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Daftar Toko -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <?php if (!empty($tokos)): ?>
            <?php foreach ($tokos as $index => $toko): ?>
                <div class="col" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <div class="card h-100 store-card border-0">
                        <div class="card-img-top-placeholder position-relative">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-white text-dark fw-bold rounded-pill px-3 py-2">
                                    <i class="fas fa-star text-warning me-1"></i>UMKM
                                </span>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0 d-flex flex-column align-items-center">
                            <?php 
                                $logo_url = base_url('public/img/logo/' . htmlspecialchars($toko['logo']));
                                $inisial = strtoupper(substr(htmlspecialchars($toko['nama_toko']), 0, 2));
                                $placeholder_url = 'https://placehold.co/150x150/E27D60/FFFFFF?text=' . urlencode($inisial);
                            ?>
                            <img src="<?php echo $logo_url; ?>" 
                                 onerror="this.onerror=null;this.src='<?php echo $placeholder_url; ?>';"
                                 class="rounded-circle shadow-lg logo" 
                                 alt="Logo <?php echo htmlspecialchars($toko['nama_toko']); ?>">
                            
                            <h5 class="card-title fw-bold mt-3 mb-2">
                                <?php echo htmlspecialchars($toko['nama_toko']); ?>
                            </h5>
                            
                            <div class="d-flex align-items-center mb-3 text-muted">
                                <i class="fas fa-map-marker-alt fa-sm me-2 text-primary"></i>
                                <small><?php echo htmlspecialchars($toko['alamat']); ?></small>
                            </div>
                            
                            <p class="card-text small flex-grow-1 px-2 text-muted text-center mb-3" style="min-height: 3rem;">
                                "<?php echo word_limiter(htmlspecialchars($toko['deskripsi']), 15); ?>"
                            </p>
                            
                            <!-- Info tambahan -->
                            <div class="w-100 mb-3">
                                <?php if(isset($toko['total_produk'])): ?>
                                <div class="row g-2 text-center">
                                    <div class="col-6">
                                        <div class="small">
                                            <i class="fas fa-box text-primary me-1"></i>
                                            <strong><?php echo $toko['total_produk']; ?></strong>
                                            <br><span class="text-muted">Produk</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small">
                                            <i class="fas fa-clock text-secondary me-1"></i>
                                            <strong>Aktif</strong>
                                            <br><span class="text-muted">Status</span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <a href="<?php echo site_url('toko/' . $toko['id']); ?>" 
                               class="btn btn-outline-primary mt-auto rounded-pill px-4 fw-bold">
                                <i class="fas fa-store-alt me-2"></i>Kunjungi Toko
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
             <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-store-slash fa-3x mb-3"></i>
                    <h5 class="fw-bold">Toko Tidak Ditemukan</h5>
                    <p class="text-muted mb-4">Tidak ada toko yang cocok dengan kriteria pencarian Anda.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="<?php echo site_url('toko'); ?>" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-refresh me-2"></i>Lihat Semua Toko
                        </a>
                        <a href="<?php echo site_url('produk'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-box me-2"></i>Jelajahi Produk
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Pagination -->
    <?php if(isset($pagination) && !empty($pagination)): ?>
    <nav class="mt-5 d-flex justify-content-center">
        <div class="pagination-wrapper">
            <?php echo $pagination; ?>
        </div>
    </nav>
    <?php endif; ?>

    <!-- Call to Action Section -->
    <?php if (!empty($tokos)): ?>
    <div class="mt-5">
        <div class="card border-0 shadow-soft p-4 text-center">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Punya Usaha? Bergabunglah dengan Kami!</h5>
                <p class="text-muted mb-4">Daftarkan toko Anda dan jangkau lebih banyak pelanggan melalui platform digital UMKM Banggai.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <?php if (!$this->session->userdata('is_logged_in')): ?>
                        <a href="<?php echo site_url('register'); ?>" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                        <a href="<?php echo site_url('login'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    <?php else: ?>
                        <a href="mailto:info@umkmBanggai.com" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-envelope me-2"></i>Hubungi Admin
                        </a>
                        <a href="<?php echo site_url('produk'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
/* Enhanced store card styling */
.store-card {
    transition: all 0.4s ease;
    overflow: hidden;
}

.store-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 20px 50px rgba(62, 39, 35, 0.15) !important;
}

.store-card .card-img-top-placeholder {
    height: 120px;
    background: var(--gradient);
    position: relative;
    overflow: hidden;
}

.store-card .card-img-top-placeholder::before {
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

.store-card:hover .card-img-top-placeholder::before {
    transform: translateX(100%);
}

.store-card .logo {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border: 4px solid var(--white);
    margin-top: -45px; /* dari -50px ke -45px, agar tidak overlap keluar card */
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    pointer-events: none; /* tambahkan ini agar logo tidak mengganggu hover */
}

.store-card:hover .logo {
    transform: scale(1.15);
    border-color: var(--accent);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

/* Info grid styling */
.store-card .row .col-6 {
    padding: 0.5rem;
    border-right: 1px solid rgba(0,0,0,0.1);
}

.store-card .row .col-6:last-child {
    border-right: none;
}

/* Badge styling */
.badge {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.025em;
}

/* Search enhancement */
.input-group .form-control:focus {
    box-shadow: none;
    border-color: var(--primary);
}

.input-group .input-group-text {
    transition: border-color 0.3s ease;
}

.form-control:focus + .input-group-text {
    border-color: var(--primary);
}

/* Stats cards animation */
.stats-card {
    transition: transform 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
}

/* Enhanced pagination */
.pagination-wrapper .pagination {
    gap: 0.25rem;
}

.pagination .page-link {
    border-radius: 50px !important;
    margin: 0 0.1rem;
    padding: 0.5rem 1rem;
    font-weight: 500;
    border: none;
    transition: all 0.3s ease;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .store-card .logo {
        width: 80px;
        height: 80px;
        margin-top: -45px;
    }
    
    .pagination-wrapper {
        overflow-x: auto;
        padding: 0.5rem 0;
    }
    
    .pagination {
        white-space: nowrap;
        margin: 0;
    }
}

/* Loading state for images */
.store-card img {
    transition: opacity 0.3s ease;
}

.store-card img[src=""] {
    opacity: 0;
}
</style>