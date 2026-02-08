<!-- Clean Stats Cards with Colorful Icons -->
<div class="row g-2 mb-3">
    <!-- Card Total Pengguna -->
    <div class="col-12">
        <a href="<?php echo site_url('admin/manajemen_pengguna'); ?>" class="text-decoration-none">
            <div class="stats-card">
                <div class="stats-icon icon-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value"><?php echo $total_user; ?> Akun</div>
                    <div class="stats-label">Total Pengguna</div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Total Toko -->
    <div class="col-12">
        <a href="<?php echo site_url('admin/manajemen_toko'); ?>" class="text-decoration-none">
            <div class="stats-card">
                <div class="stats-icon icon-danger">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value"><?php echo $total_toko; ?> UMKM</div>
                    <div class="stats-label">Total Toko</div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Toko Menunggu -->
    <div class="col-12">
        <a href="<?php echo site_url('admin/manajemen_toko?filter=menunggu'); ?>" class="text-decoration-none">
            <div class="stats-card">
                <div class="stats-icon icon-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value"><?php echo $toko_menunggu; ?> Menunggu</div>
                    <div class="stats-label">Persetujuan Toko</div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Welcome Card -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h6 class="fw-bold mb-2">Selamat Datang, Admin!</h6>
        <p class="text-muted mb-0 small">Kelola pengguna, setujui toko baru, dan atur kategori produk melalui menu navigasi.</p>
    </div>
</div>
