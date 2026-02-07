<div class="row">
    <div class="col-12">
        <div class="alert alert-light border" role="alert">
            <h4 class="alert-heading">Selamat Datang, <?php echo htmlspecialchars($this->session->userdata('nama')); ?>!</h4>
            <p>Gunakan menu navigasi di atas untuk melihat produk favorit, ulasan, atau profil Anda.</p>
        </div>
    </div>
</div>

<!-- Stat Cards untuk Pengguna -->
<div class="row">
    <!-- Card Total Favorit -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="<?php echo site_url('user/favorit'); ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Produk Favorit</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $total_favorit; ?>
                                    <span class="text-danger text-sm font-weight-bolder">Produk</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                <i class="fas fa-heart text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Ulasan Saya -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="<?php echo site_url('user/ulasan_saya'); ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Ulasan Saya</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?php echo $total_ulasan; ?>
                                    <span class="text-warning text-sm font-weight-bolder">Ulasan</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                <i class="fas fa-star text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Jelajahi Katalog -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <a href="<?php echo site_url('produk'); ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jelajahi Katalog</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Temukan Produk
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-search text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <!-- Card Profil Saya -->
    <div class="col-xl-3 col-sm-6">
        <a href="<?php echo site_url('user/profile'); ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Profil Saya</p>
                                <h5 class="font-weight-bolder mb-0">
                                    Lihat Profil Anda
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                <i class="fas fa-user-circle text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
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
.bg-gradient-info { background-image: linear-gradient(310deg, #17a2b8 0%, #11cdef 100%); }
.bg-gradient-warning { background-image: linear-gradient(310deg, #ffc107 0%, #fd7e14 100%); }
.opacity-10 { opacity: 1 !important; color: white !important; }
.border-radius-md { border-radius: 0.5rem; }
</style>
