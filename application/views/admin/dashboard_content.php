<!-- Stat Cards untuk Admin -->
<div class="row">
    <!-- Card Total Pengguna -->
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <a href="<?php echo site_url('admin/manajemen_pengguna'); ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Pengguna</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $total_user; ?>
                                    <span class="text-success text-sm font-weight-bolder">Akun</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-users text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Card Total Toko -->
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <a href="<?php echo site_url('admin/manajemen_toko'); ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Toko</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $total_toko; ?>
                                    <span class="text-success text-sm font-weight-bolder">UMKM</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                <i class="fas fa-store text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <!-- Card Toko Menunggu Persetujuan -->
    <div class="col-xl-4 col-sm-6">
        <a href="<?php echo site_url('admin/manajemen_toko?filter=menunggu'); ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Persetujuan</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $toko_menunggu; ?>
                                    <span class="text-warning text-sm font-weight-bolder">Toko Menunggu</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                <i class="fas fa-clock text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Selamat Datang, Admin!</h5>
            </div>
            <div class="card-body">
                <p>Anda memiliki akses penuh terhadap manajemen data di platform ini. Gunakan menu navigasi di samping untuk mengelola pengguna, menyetujui toko baru, dan mengatur kategori produk.</p>
            </div>
        </div>
    </div>
</div>

<!-- CSS Tambahan untuk Icon di Stat Card -->
<style>
.icon-shape {
    width: 48px; height: 48px; background-position: center; border-radius: 0.75rem;
    display: flex; align-items: center; justify-content: center;
}
.bg-gradient-primary { background-image: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%); }
.bg-gradient-danger { background-image: linear-gradient(310deg, #ea4c62 0%, #f5365c 100%); }
.bg-gradient-warning { background-image: linear-gradient(310deg, #fb6340 0%, #fbb140 100%); }
.opacity-10 { opacity: 1 !important; color: white !important; }
.border-radius-md { border-radius: 0.5rem; }
</style>
