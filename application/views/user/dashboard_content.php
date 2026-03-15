<!-- Header Dashboard Pengguna -->
<div class="row mb-4 fade-in-up">
    <div class="col-12">
        <div class="card border-0" style="border-radius: 1rem; overflow: hidden; background-color: var(--white); box-shadow: 0 8px 30px rgba(62, 39, 35, 0.08);">
            <div class="card-body p-4 p-md-5 position-relative">
                <!-- Decorative Background Elements -->
                <div class="position-absolute top-0 end-0 h-100 d-none d-md-block" style="width: 45%; background: linear-gradient(135deg, rgba(226, 125, 96, 0.08) 0%, rgba(133, 182, 111, 0.04) 100%); clip-path: polygon(25% 0, 100% 0, 100% 100%, 0% 100%);"></div>
                <div class="position-absolute top-0 end-0 h-100 d-none d-md-block opacity-50" style="width: 30%; background: linear-gradient(135deg, rgba(255, 209, 102, 0.1) 0%, transparent 100%); clip-path: polygon(0% 0, 100% 0, 100% 100%, 40% 100%);"></div>

                <div class="position-relative" style="z-index: 1;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white d-flex align-items-center justify-content-center rounded-circle me-3 mb-2" style="width: 56px; height: 56px; background: linear-gradient(135deg, var(--primary) 0%, #d16749 100%); box-shadow: 0 4px 15px rgba(226, 125, 96, 0.3);">
                            <i class="fas fa-hand-sparkles fa-lg"></i>
                        </div>
                        <h3 class="fw-bolder mb-0" style="color: var(--text-dark);">
                            Selamat Datang, <span style="color: var(--primary);"><?php echo htmlspecialchars($this->session->userdata('nama')); ?>!</span>
                        </h3>
                    </div>
                    <p class="text-muted mb-0" style="font-size: 1.05rem; max-width: 600px;">
                        Kelola produk favorit Anda, lihat ulasan, dan pantau aktivitas belanja produk UMKM Banggai dengan mudah.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stat Cards Minimalist -->
<div class="row g-4 mb-4 fade-in-up" style="animation-delay: 0.1s;">
    <!-- Card Produk Favorit -->
    <div class="col-xl-3 col-sm-6">
        <a href="<?php echo site_url('user/favorit'); ?>" class="text-decoration-none">
            <div class="stats-card h-100">
                <div class="stats-icon text-white" style="background: linear-gradient(135deg, var(--primary) 0%, #d16749 100%); box-shadow: 0 4px 15px rgba(226, 125, 96, 0.3);">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value text-dark"><?php echo $total_favorit ?? '0'; ?></div>
                    <div class="stats-label">Produk Favorit</div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Ulasan Saya -->
    <div class="col-xl-3 col-sm-6">
        <a href="<?php echo site_url('user/ulasan_saya'); ?>" class="text-decoration-none">
            <div class="stats-card h-100">
                <div class="stats-icon text-dark" style="background: linear-gradient(135deg, var(--accent) 0%, #e6c866 100%); box-shadow: 0 4px 15px rgba(255, 209, 102, 0.4);">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value text-dark"><?php echo $total_ulasan ?? '0'; ?></div>
                    <div class="stats-label">Ulasan Saya</div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Jelajahi Katalog -->
    <div class="col-xl-3 col-sm-6">
        <a href="<?php echo site_url('produk'); ?>" class="text-decoration-none">
            <div class="stats-card h-100">
                <div class="stats-icon text-white" style="background: linear-gradient(135deg, var(--secondary) 0%, #729a5e 100%); box-shadow: 0 4px 15px rgba(133, 182, 111, 0.3);">
                    <i class="fas fa-compass"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value text-dark" style="font-size: 1.15rem; margin-top: 0.2rem;">Jelajahi</div>
                    <div class="stats-label">Katalog Produk</div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Profil Saya -->
    <div class="col-xl-3 col-sm-6">
        <a href="<?php echo site_url('user/profile'); ?>" class="text-decoration-none">
            <div class="stats-card h-100">
                <div class="stats-icon text-white" style="background: linear-gradient(135deg, #4A90E2 0%, #357ABD 100%); box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value text-dark" style="font-size: 1.15rem; margin-top: 0.2rem;">Kelola</div>
                    <div class="stats-label">Profil Saya</div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Tambahan Quick Actions untuk Pembeli -->
<div class="row mt-2 fade-in-up" style="animation-delay: 0.2s;">
    <div class="col-12">
        <h5 class="fw-bold mb-3 d-flex align-items-center" style="color: var(--text-dark);">
            <i class="fas fa-bolt text-warning me-2"></i>Aktivitas Cepat
        </h5>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card h-100 border-0 shadow-sm quick-action-wrapper" style="border-radius: 1rem;">
            <div class="card-body p-4 text-center">
                <div class="quick-icon-wrap bg-light-success text-success mb-3 mx-auto">
                    <i class="fas fa-shopping-bag fa-lg" style="color: var(--secondary);"></i>
                </div>
                <h5 class="fw-bold" style="color: var(--text-dark);">Belanja Sekarang</h5>
                <p class="text-muted small mb-4">Temukan berbagai produk unggulan dari UMKM lokal terpercaya.</p>
                <a href="<?php echo site_url('produk'); ?>" class="btn btn-outline-success rounded-pill px-4 w-100" style="color: var(--secondary); border-color: var(--secondary);">Lihat Produk</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card h-100 border-0 shadow-sm quick-action-wrapper" style="border-radius: 1rem;">
            <div class="card-body p-4 text-center">
                <div class="quick-icon-wrap bg-light-primary text-primary mb-3 mx-auto">
                    <i class="fas fa-store fa-lg" style="color: var(--primary);"></i>
                </div>
                <h5 class="fw-bold" style="color: var(--text-dark);">UMKM Terbaik</h5>
                <p class="text-muted small mb-4">Dukung pengusaha lokal dengan membeli produk karya mereka.</p>
                <a href="<?php echo site_url('toko'); ?>" class="btn btn-outline-primary px-4 rounded-pill w-100">Lihat Toko UMKM</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card h-100 border-0 shadow-sm quick-action-wrapper" style="border-radius: 1rem;">
            <div class="card-body p-4 text-center">
                <div class="quick-icon-wrap mb-3 mx-auto" style="background-color: rgba(255, 209, 102, 0.2);">
                    <i class="fas fa-pen-fancy fa-lg" style="color: #d4a322;"></i>
                </div>
                <h5 class="fw-bold" style="color: var(--text-dark);">Berikan Ulasan</h5>
                <p class="text-muted small mb-4">Bagikan pengalaman Anda menggunakan produk UMKM Banggai.</p>
                <a href="<?php echo site_url('user/ulasan_saya'); ?>" class="btn rounded-pill px-4 w-100" style="background: var(--accent); color: var(--text-dark); border-color: var(--accent); font-weight: 600;">Lihat Ulasan</a>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS Tambahan khusus untuk Dashboard User */
.stats-card:hover .stats-icon i {
    transform: scale(1.15);
    transition: transform 0.3s ease;
}
.stats-card .stats-icon i {
    transition: transform 0.3s ease;
}

.quick-action-wrapper {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.quick-action-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(62, 39, 35, 0.1) !important;
}

.quick-icon-wrap {
    width: 64px; 
    height: 64px; 
    border-radius: 50%; 
    display: flex; 
    align-items: center; 
    justify-content: center;
    transition: all 0.3s ease;
}

.quick-action-wrapper:hover .quick-icon-wrap {
    transform: scale(1.1);
}

.bg-light-success {
    background-color: rgba(133, 182, 111, 0.15);
}

.bg-light-primary {
    background-color: rgba(226, 125, 96, 0.15);
}

.btn-outline-success:hover {
    background-color: var(--secondary) !important;
    border-color: var(--secondary) !important;
    color: white !important;
}
</style>
