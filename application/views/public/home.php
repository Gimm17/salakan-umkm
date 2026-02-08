
<div class="container py-4">
    <!-- Hero/Banner Section -->
    <div class="p-3 p-md-5 mb-4 mb-md-5 text-white hero-banner shadow-soft fade-in-up">
        <div class="container-fluid py-3 py-md-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 display-md-4 fw-bolder mb-3 mb-md-4">Cita Rasa Asli Banggai</h1>
                    <p class="fs-5 fs-md-4 mb-3 mb-md-4">Jelajahi kehangatan produk lokal, dari kuliner otentik hingga kerajinan tangan penuh makna yang dibuat dengan cinta oleh pengusaha lokal.</p>
                    <div class="d-flex flex-column flex-sm-row gap-2 gap-md-3">
                        <a href="<?php echo site_url('produk'); ?>" class="btn btn-md btn-lg fw-bold accent-bg border-0 rounded-pill px-3 px-md-4">
                            <i class="fas fa-shopping-bag me-2"></i>Jelajahi Sekarang
                        </a>
                        <a href="<?php echo site_url('toko'); ?>" class="btn btn-md btn-lg btn-outline-light fw-bold rounded-pill px-3 px-md-4">
                            <i class="fas fa-store-alt me-2"></i>Lihat Toko
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block">
                    <div class="position-relative">
                        <i class="fas fa-store display-1 text-white opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Section - Auto Carousel -->
    <div class="mb-4 mb-md-5">
        <div class="stats-carousel-container position-relative">
            <!-- Desktop view - show all 3 cards -->
            <div class="row g-3 g-md-4 d-none d-md-flex">
                <div class="col-md-4">
                    <div class="card border-0 shadow-soft text-center p-2 p-md-4 h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-2 mb-md-3 mx-auto" style="width: 50px; height: 50px;">
                                <i class="fas fa-box text-white fs-6 fs-md-4"></i>
                            </div>
                            <h6 class="h6 h5-md fw-bold">Produk Berkualitas</h6>
                            <p class="text-muted mb-0 small">Dipilih langsung dari pengusaha lokal terpercaya</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-soft text-center p-2 p-md-4 h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-2 mb-md-3 mx-auto" style="width: 50px; height: 50px;">
                                <i class="fas fa-handshake text-white fs-6 fs-md-4"></i>
                            </div>
                            <h6 class="h6 h5-md fw-bold">Mendukung Lokal</h6>
                            <p class="text-muted mb-0 small">Setiap pembelian membantu ekonomi masyarakat Banggai</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-soft text-center p-2 p-md-4 h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="rounded-circle accent-bg d-inline-flex align-items-center justify-content-center mb-2 mb-md-3 mx-auto" style="width: 50px; height: 50px;">
                                <i class="fas fa-heart text-dark fs-6 fs-md-4"></i>
                            </div>
                            <h6 class="h6 h5-md fw-bold">Dibuat dengan Cinta</h6>
                            <p class="text-muted mb-0 small">Produk autentik dengan cerita dan tradisi turun-temurun</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile view - auto carousel -->
            <div class="d-md-none">
                <div class="stats-carousel-wrapper overflow-hidden">
                    <div class="stats-carousel-track d-flex transition-transform" style="transform: translateX(0%);">
                        <!-- Card 1 -->
                        <div class="stats-card-slide flex-shrink-0 px-2" style="width: 100%;">
                            <div class="card border-0 shadow-soft text-center p-4">
                                <div class="card-body">
                                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-box text-white fs-4"></i>
                                    </div>
                                    <h5 class="fw-bold mb-2">Produk Berkualitas</h5>
                                    <p class="text-muted mb-0">Dipilih langsung dari pengusaha lokal terpercaya</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="stats-card-slide flex-shrink-0 px-2" style="width: 100%;">
                            <div class="card border-0 shadow-soft text-center p-4">
                                <div class="card-body">
                                    <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-handshake text-white fs-4"></i>
                                    </div>
                                    <h5 class="fw-bold mb-2">Mendukung Lokal</h5>
                                    <p class="text-muted mb-0">Setiap pembelian membantu ekonomi masyarakat Banggai</p>
                                </div>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="stats-card-slide flex-shrink-0 px-2" style="width: 100%;">
                            <div class="card border-0 shadow-soft text-center p-4">
                                <div class="card-body">
                                    <div class="rounded-circle accent-bg d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-heart text-dark fs-4"></i>
                                    </div>
                                    <h5 class="fw-bold mb-2">Dibuat dengan Cinta</h5>
                                    <p class="text-muted mb-0">Produk autentik dengan cerita dan tradisi turun-temurun</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Produk Terbaru Section -->
    <div class="mb-4 mb-md-5">
        <div class="row align-items-center mb-3 mb-md-4">
            <div class="col">
                <h2 class="fw-bold mb-0 text-gradient h4 h2-md">Baru Ditambahkan</h2>
                <p class="text-muted mb-0 small">Temukan produk-produk terbaru dari UMKM lokal</p>
            </div>
            <div class="col-auto">
                <a href="<?php echo site_url('produk'); ?>" class="btn btn-outline-primary btn-sm fw-semibold rounded-pill px-3 px-md-4">
                    <span class="d-none d-md-inline">Lihat Semua</span>
                    <span class="d-md-none">Semua</span>
                    <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
            <?php if (!empty($produk_terbaru)): ?>
                <?php foreach ($produk_terbaru as $index => $produk): ?>
                <div class="col-6 col-sm-6 col-md-4 col-lg-3" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <div class="card h-100 product-card">
                        <?php 
                            $gambar_url = base_url('public/img/produk/' . htmlspecialchars($produk['gambar_produk']));
                            $produklaceholder_url = 'https://placehold.co/600x400/E2E8F0/3E2723?text=' . urlencode(substr($produk['nama_produk'], 0, 10));
                        ?>
                        <div class="position-relative overflow-hidden" style="height: 150px;">
                            <a href="<?php echo site_url('produk/' . $produk['id']); ?>">
                                <img src="<?php echo $gambar_url; ?>" 
                                     onerror="this.onerror=null;this.src='<?php echo $produklaceholder_url; ?>';" 
                                     class="card-img-top w-100 h-100" 
                                     alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" 
                                     style="object-fit: cover;">
                            </a>
                            <span class="badge bg-primary position-absolute top-0 start-0 m-2 shadow-sm" style="font-size: 0.65rem;">
                                <?php echo htmlspecialchars($produk['nama_kategori']); ?>
                            </span>
                        </div>
                        <div class="card-body p-2 p-md-3 d-flex flex-column">
                        <h6 class="card-title fw-bold text-dark mb-1 small" style="flex-grow: 1; line-height: 1.1; min-height: 2.2em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                            <a href="<?php echo site_url('produk/' . $produk['id']); ?>" 
                            class="text-decoration-none text-dark stretched-link">
                                <?php echo htmlspecialchars(strlen($produk['nama_produk']) > 25 ? substr($produk['nama_produk'], 0, 25) . '...' : $produk['nama_produk']); ?>
                            </a>
                        </h6>
                        
                        <p class="card-text text-muted mb-1" style="font-size: 0.7rem; line-height: 1.1;">
                            <i class="fas fa-store-alt fa-sm me-1 text-secondary"></i>
                            <?php echo htmlspecialchars(strlen($produk['nama_toko']) > 15 ? substr($produk['nama_toko'], 0, 15) . '...' : $produk['nama_toko']); ?>
                        </p>
                        
                        <!-- Rating Display - BARU -->
                        <?php if (isset($produk['rating_rata']) && $produk['rating_rata'] > 0): ?>
                        <div class="d-flex align-items-center mb-1">
                            <div class="rating-stars me-1">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo ($i <= round($produk['rating_rata'])) ? 'text-warning' : 'text-muted'; ?>" 
                                    style="font-size: 0.6rem;"></i>
                                <?php endfor; ?>
                            </div>
                            <small class="text-muted" style="font-size: 0.65rem;">
                                <span class="fw-bold"><?php echo $produk['rating_rata']; ?></span>
                                (<?php echo $produk['jumlah_ulasan']; ?>)
                            </small>
                        </div>
                        <?php else: ?>
                        <div class="mb-1">
                            <small class="text-muted" style="font-size: 0.65rem;">
                                <i class="far fa-star me-1" style="font-size: 0.6rem;"></i>
                                <span>Belum ada ulasan</span>
                            </small>
                        </div>
                        <?php endif; ?>
                        
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="card-text fw-bolder text-primary mb-0" style="font-size: 0.9rem;">
                                Rp<?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                            </p>
                            <small class="text-muted" style="font-size: 0.65rem;">
                                <i class="fas fa-heart me-1 text-danger"></i>
                                <?php echo isset($produk['total_favorit']) ? $produk['total_favorit'] : '0'; ?>
                            </small>
                        </div>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>                 <div class="col-12">
                    <div class="empty-state text-center p-4 bg-light rounded">
                        <i class="fas fa-box-open fa-2x mb-3 text-muted"></i>
                        <h6 class="fw-bold mb-2">Belum Ada Produk</h6>
                        <p class="text-muted mb-3 small">Saat ini belum ada produk terbaru yang bisa ditampilkan.</p>
                        <a href="<?php echo site_url('produk'); ?>" class="btn btn-primary btn-sm rounded-pill px-3">
                            Jelajahi Produk Lainnya
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="position-relative overflow-hidden mb-5">
        <div class="card border-0 shadow-lg text-white" style="background: linear-gradient(135deg, #E27D60 0%, #85B66F 100%); min-height: 300px;">
            <!-- Decorative Elements -->
            <div class="position-absolute top-0 end-0 opacity-10">
                <i class="fas fa-store" style="font-size: 150px; transform: translate(50px, -30px) rotate(15deg);"></i>
            </div>
            <div class="position-absolute bottom-0 start-0 opacity-10">
                <i class="fas fa-handshake" style="font-size: 120px; transform: translate(-40px, 40px) rotate(-15deg);"></i>
            </div>
            
            <div class="card-body p-5 position-relative">
                <div class="row align-items-center h-100">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-star me-1"></i>
                                Bergabung Sekarang
                            </span>
                        </div>
                        <h2 class="fw-bold mb-3 display-6">Bergabunglah dengan Komunitas UMKM Banggai</h2>
                        <p class="mb-4 opacity-90 fs-5">
                            Daftarkan usaha Anda atau mulai berbelanja untuk mendukung ekonomi lokal. 
                            Bersama-sama kita membangun Banggai yang lebih maju dan sejahtera.
                        </p>
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users text-warning me-2"></i>
                                    <span class="fw-semibold">500+ UMKM Terdaftar</span>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-shopping-cart text-warning me-2"></i>
                                    <span class="fw-semibold">1000+ Produk Lokal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-lg-end">
                            <?php if (!$this->session->userdata('is_logged_in')): ?>
                                <div class="d-grid gap-3">
                                    <a href="<?php echo site_url('register'); ?>" class="btn btn-light btn-lg fw-bold rounded-pill px-4 py-3 shadow-sm">
                                        <i class="fas fa-user-plus me-2"></i>Daftar Sebagai Penjual
                                    </a>
                                    <a href="<?php echo site_url('produk'); ?>" class="btn btn-outline-light btn-lg fw-bold rounded-pill px-4 py-3">
                                        <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="d-grid gap-3">
                                    <a href="<?php echo site_url('toko'); ?>" class="btn btn-light btn-lg fw-bold rounded-pill px-4 py-3 shadow-sm">
                                        <i class="fas fa-store-alt me-2"></i>Jelajahi Toko
                                    </a>
                                    <a href="<?php echo site_url('login'); ?>" class="btn btn-outline-light btn-lg fw-bold rounded-pill px-4 py-3">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom decoration -->
            <div class="position-absolute bottom-0 w-100" style="height: 4px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);"></div>
        </div>
    </div>
</div>


<!-- CSS untuk rating stars di product cards -->
<style>
.rating-stars .fa-star {
    margin-right: 1px;
}

.product-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border-radius: .75rem;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 0.8rem 1.5rem rgba(0,0,0,.1) !important;
}

.stretched-link::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    content: "";
}

/* Stats Carousel Styles */
.stats-carousel-track {
    transition: transform 0.5s ease-in-out;
}

.stats-card-slide .card {
    transition: transform 0.3s ease;
}

.stats-card-slide .card:hover {
    transform: translateY(-5px);
}

/* Smooth animation for mobile */
@media (max-width: 768px) {
    .stats-carousel-track {
        transition: transform 0.4s ease-in-out;
    }
}

/* Mobile-specific improvements */
@media (max-width: 768px) {
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    /* Force 2 columns on mobile */
    .row[class*="row-cols-"] .col-6 {
        flex: 0 0 48% !important;
        max-width: 48% !important;
        margin-bottom: 1rem;
    }
    
    .row[class*="row-cols-"] {
        margin-left: -1% !important;
        margin-right: -1% !important;
    }
    
    .row[class*="row-cols-"] .col-6 {
        padding-left: 1% !important;
        padding-right: 1% !important;
    }
    
    /* Hero section mobile */
    .hero-banner {
        background: linear-gradient(135deg, #E27D60 0%, #85B66F 100%);
        min-height: 300px;
    }
    
    .hero-banner h1 {
        font-size: 1.75rem !important;
        line-height: 1.2;
    }
    
    .hero-banner p {
        font-size: 0.95rem !important;
        line-height: 1.4;
    }
    
    .hero-banner .btn {
        padding: 0.65rem 1.5rem !important;
        font-size: 0.9rem;
    }
    
    /* Stats cards mobile */
    .card {
        margin-bottom: 1rem;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .rounded-circle {
        width: 45px !important;
        height: 45px !important;
    }
    
    .rounded-circle i {
        font-size: 1rem !important;
    }
    
    /* Product cards mobile */
    .product-card {
        border-radius: 0.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }
    
    .product-card .card-body {
        padding: 0.5rem !important;
    }
    
    .product-card .card-title {
        font-size: 0.75rem !important;
        margin-bottom: 0.25rem !important;
        line-height: 1.1 !important;
    }
    
    .product-card .card-text {
        font-size: 0.65rem !important;
        margin-bottom: 0.25rem !important;
    }
    
    .product-card .badge {
        font-size: 0.55rem !important;
        padding: 0.15rem 0.35rem !important;
    }
    
    /* Image container mobile - smaller for 2 columns */
    .product-card .position-relative.overflow-hidden {
        height: 100px !important;
    }
    
    /* CTA section mobile */
    .card.border-0.shadow-lg {
        min-height: 220px !important;
    }
    
    .card.border-0.shadow-lg h2 {
        font-size: 1.25rem !important;
        line-height: 1.3;
    }
    
    .card.border-0.shadow-lg p {
        font-size: 0.85rem !important;
        line-height: 1.4;
    }
    
    .card.border-0.shadow-lg .btn {
        padding: 0.5rem 1rem !important;
        font-size: 0.85rem !important;
    }
    
    /* Button spacing mobile */
    .d-grid.gap-2 {
        gap: 0.5rem !important;
    }
    
    /* Text adjustments */
    .h6.h5-md {
        font-size: 0.9rem !important;
    }
    
    .h4.h2-md {
        font-size: 1.1rem !important;
    }
    
    .small {
        font-size: 0.7rem !important;
    }
    
    /* Price text in cards */
    .product-card .card-text.fw-bolder {
        font-size: 0.8rem !important;
    }
    
    /* Rating stars mobile */
    .rating-stars .fa-star {
        font-size: 0.5rem !important;
    }
    
    /* Heart icon mobile */
    .product-card .fas.fa-heart {
        font-size: 0.6rem !important;
    }
    
    /* Empty state mobile */
    .empty-state {
        padding: 2rem 1rem !important;
        text-align: center;
    }
    
    .empty-state i {
        font-size: 2rem !important;
    }
    
    .empty-state h5 {
        font-size: 1rem !important;
    }
    
    .empty-state p {
        font-size: 0.85rem !important;
    }
    
    /* Stats info mobile */
    .d-flex.flex-column.flex-md-row div {
        margin-bottom: 0.5rem;
    }
    
    .d-flex.flex-column.flex-md-row div:last-child {
        margin-bottom: 0;
    }
}

/* Extra small screens (phones in portrait) */
@media (max-width: 576px) {
    .container {
        padding-left: 5px;
        padding-right: 5px;
    }
    
    /* Maintain 2 columns even on very small screens */
    .row[class*="row-cols-"] .col-6 {
        flex: 0 0 49% !important;
        max-width: 49% !important;
    }
    
    .row[class*="row-cols-"] {
        margin-left: -0.5% !important;
        margin-right: -0.5% !important;
    }
    
    .row[class*="row-cols-"] .col-6 {
        padding-left: 0.5% !important;
        padding-right: 0.5% !important;
    }
    
    .hero-banner {
        padding: 1rem !important;
        min-height: 250px;
    }
    
    .hero-banner h1 {
        font-size: 1.5rem !important;
    }
    
    .hero-banner p {
        font-size: 0.9rem !important;
    }
    
    .product-card .card-title {
        font-size: 0.7rem !important;
    }
    
    .product-card .card-text {
        font-size: 0.6rem !important;
    }
    
    .product-card .position-relative.overflow-hidden {
        height: 85px !important;
    }
    
    .product-card .card-body {
        padding: 0.4rem !important;
    }
    
    .card.border-0.shadow-lg {
        min-height: 200px !important;
    }
    
    .card.border-0.shadow-lg h2 {
        font-size: 1.1rem !important;
    }
    
    .rounded-circle {
        width: 40px !important;
        height: 40px !important;
    }
    
    .product-card .badge {
        font-size: 0.5rem !important;
        padding: 0.1rem 0.3rem !important;
    }
    
    .rating-stars .fa-star {
        font-size: 0.45rem !important;
    }
    
    .product-card .card-text.fw-bolder {
        font-size: 0.7rem !important;
    }
}

/* Utility classes for responsive text */
.h6.h5-md {
    font-size: 1rem;
}

.h4.h2-md {
    font-size: 1.5rem;
}

@media (min-width: 768px) {
    .h6.h5-md {
        font-size: 1.25rem !important;
    }
    
    .h4.h2-md {
        font-size: 2rem !important;
    }
    
    .display-5.display-md-4 {
        font-size: 2.5rem !important;
    }
    
    .fs-5.fs-md-4 {
        font-size: 1.5rem !important;
    }
    
    .btn-md.btn-lg {
        padding: 0.75rem 1.5rem !important;
    }
    
    .card.border-0.shadow-lg {
        min-height: 300px !important;
    }
    
    .product-card .position-relative.overflow-hidden {
        height: 200px !important;
    }
}
</style>

<script>
// Simple Auto-Play Stats Carousel
document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.stats-carousel-track');
    const slides = document.querySelectorAll('.stats-card-slide');
    
    if (!track || !slides.length) return;
    
    let currentSlide = 0;
    
    function updateCarousel() {
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateCarousel();
    }
    
    // Auto-play
    let autoPlayInterval = setInterval(nextSlide, 3000);
    
    // Pause on hover
    const wrapper = document.querySelector('.stats-carousel-wrapper');
    wrapper.addEventListener('mouseenter', () => {
        clearInterval(autoPlayInterval);
    });
    
    wrapper.addEventListener('mouseleave', () => {
        autoPlayInterval = setInterval(nextSlide, 3000);
    });
    
    // Initialize
    updateCarousel();
});
</script>