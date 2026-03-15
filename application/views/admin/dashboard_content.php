<!-- Modern Stats Cards with Theme Colors -->
<div class="row g-3 mb-4">
    <!-- Card Total Pengguna -->
    <div class="col-12 col-md-4">
        <a href="<?php echo site_url('admin/manajemen_pengguna'); ?>" class="text-decoration-none">
            <div class="stats-card h-100 position-relative overflow-hidden border-0 shadow-sm" style="border-radius: 1rem; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fas fa-users fa-4x" style="color: var(--primary);"></i>
                </div>
                <div class="p-4 d-flex flex-column justify-content-center position-relative z-1">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background: rgba(226, 125, 96, 0.1);">
                            <i class="fas fa-users fs-5" style="color: var(--primary);"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Total Pengguna</h6>
                    </div>
                    <div>
                        <h2 class="fw-bolder mb-1" style="color: var(--text-dark); font-size: 2.2rem;"><?php echo $total_user; ?></h2>
                        <span class="badge" style="background-color: var(--primary); font-weight: 500;">Akun Terdaftar</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Total Toko -->
    <div class="col-12 col-md-4">
        <a href="<?php echo site_url('admin/manajemen_toko'); ?>" class="text-decoration-none">
            <div class="stats-card h-100 position-relative overflow-hidden border-0 shadow-sm" style="border-radius: 1rem; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fas fa-store fa-4x" style="color: var(--secondary);"></i>
                </div>
                <div class="p-4 d-flex flex-column justify-content-center position-relative z-1">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background: rgba(133, 182, 111, 0.1);">
                            <i class="fas fa-store fs-5" style="color: var(--secondary);"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Total UMKM</h6>
                    </div>
                    <div>
                        <h2 class="fw-bolder mb-1" style="color: var(--text-dark); font-size: 2.2rem;"><?php echo $total_toko; ?></h2>
                        <span class="badge" style="background-color: var(--secondary); font-weight: 500;">Toko Aktif</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Toko Menunggu -->
    <div class="col-12 col-md-4">
        <a href="<?php echo site_url('admin/manajemen_toko?filter=menunggu'); ?>" class="text-decoration-none">
            <div class="stats-card h-100 position-relative overflow-hidden border-0 shadow-sm" style="border-radius: 1rem; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div class="position-absolute top-0 end-0 p-3 opacity-25">
                    <i class="fas fa-clock fa-4x" style="color: var(--accent);"></i>
                </div>
                <div class="p-4 d-flex flex-column justify-content-center position-relative z-1">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background: rgba(255, 209, 102, 0.2);">
                            <i class="fas fa-clock fs-5" style="color: #dba934;"></i>
                        </div>
                        <h6 class="text-muted mb-0 fw-bold text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Persetujuan</h6>
                    </div>
                    <div>
                        <h2 class="fw-bolder mb-1" style="color: var(--text-dark); font-size: 2.2rem;"><?php echo $toko_menunggu; ?></h2>
                        <span class="badge text-dark" style="background-color: var(--accent); font-weight: 500;">Menunggu Review</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<style>
/* Hover animation for new stats cards */
.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(62, 39, 35, 0.1) !important;
}
</style>

<!-- Welcome Card -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h6 class="fw-bold mb-2">Selamat Datang, Admin!</h6>
        <p class="text-muted mb-0 small">Kelola pengguna, setujui toko baru, dan atur kategori produk melalui menu navigasi.</p>
    </div>
</div>
