<!-- Judul Halaman -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark fw-bold mb-0">Dasbor Penjual</h3>
</div>

<!-- Welcome Message -->
<div class="alert alert-light border" role="alert">
    <h4 class="alert-heading">Selamat Datang, <?php echo htmlspecialchars($this->session->userdata('nama')); ?>!</h4>
    <p>Ini adalah pusat kendali untuk toko Anda. Gunakan menu navigasi di atas untuk mengelola produk dan mengatur profil toko Anda.</p>
</div>

<!-- Stat Cards Baru (Dengan Perbaikan) -->
<div class="row">
    <!-- Card Total Produk -->
    <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
        <div class="card h-100 stat-card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Produk Anda</p>
                            <h5 class="font-weight-bolder mb-0">
                                <?php echo $total_produk; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center rounded-circle">
                            <i class="fas fa-box-open text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer p-3 pt-0 border-top-0">
                 <a href="<?php echo site_url('seller/produk'); ?>" class="text-primary text-sm font-weight-bold text-decoration-none">
                    Lihat Detail <i class="fas fa-arrow-right text-xs ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- CARD BARU: Ulasan Produk -->
    <div class="col-lg-4 col-md-6 mb-lg-0 mb-4">
        <div class="card h-100 stat-card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Ulasan Produk</p>
                            <h5 class="font-weight-bolder mb-0">
                                <!-- Jumlah total ulasan produk -->
                                <?php echo isset($total_ulasan_produk) ? $total_ulasan_produk : 0; ?>
                                <span class="text-muted fs-6">ulasan</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center rounded-circle">
                            <i class="fas fa-comments text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer p-3 pt-0 border-top-0">
                <a href="<?php echo site_url('seller/ulasan'); ?>" class="text-primary text-sm font-weight-bold text-decoration-none position-relative">
                    Lihat Ulasan <i class="fas fa-arrow-right text-xs ms-1"></i>
                    <?php
                    if(isset($pending_count) && $pending_count > 0): ?>
                        <span class="badge bg-warning rounded-pill ms-2"><?php echo $pending_count; ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Card Pengaturan Toko -->
    <div class="col-lg-4 col-md-6">
         <div class="card h-100 stat-card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Pengaturan Toko</p>
                            <h5 class="font-weight-bolder mb-0">
                                Ubah profil toko Anda
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape shadow text-center rounded-circle">
                            <i class="fas fa-cogs text-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer p-3 pt-0 border-top-0">
                <a href="<?php echo site_url('seller/toko'); ?>" class="text-primary text-sm font-weight-bold text-decoration-none">
                    Buka Pengaturan <i class="fas fa-arrow-right text-xs ms-1"></i>
                </a>
            </div>
        </div>
    </div>

<!-- PERBAIKAN: CSS yang lebih akurat -->
<style>
.stat-card .icon-shape {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%);
}
.stat-card .icon-shape i {
    color: white !important;
}
</style>
