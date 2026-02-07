<!-- Footer Modern dengan tema Terracotta -->
<footer class="bg-white pt-5 pb-4 border-top mt-auto mobile-footer" style="border-color: rgba(62, 39, 35, 0.1) !important;">
    <div class="container text-center text-md-start">
        <div class="row gy-4">
            <!-- Brand Section -->
            <div class="col-md-4 col-lg-5 mx-auto">
                <h5 class="fw-bold mb-4 d-flex align-items-center justify-content-center justify-content-md-start">
                    <i class="fas fa-store me-2" style="color: var(--primary);"></i>
                    <span style="color: var(--text-dark);">UMKM</span>
                    <span style="color: var(--primary);">Banggai</span>
                </h5>
                <p class="text-muted mb-4 mobile-description">
                    Platform digital untuk mempromosikan produk unggulan dari para pelaku Usaha Mikro, Kecil, dan Menengah di Banggai. Dukung ekonomi lokal dengan berbelanja produk berkualitas.
                </p>
                <div class="d-flex justify-content-center justify-content-md-start">
                    <a href="#" class="btn btn-primary btn-floating me-2" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-primary btn-floating me-2" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-success btn-floating" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #25D366; border: none;">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            
            <!-- Navigation Links -->
            <div class="col-md-2 col-lg-2 mx-auto mobile-nav-section">
                <h6 class="fw-bold mb-4" style="color: var(--text-dark);">Navigasi</h6>
                <p class="mb-2">
                    <a href="<?php echo site_url(); ?>" class="nav-link-footer">
                        <i class="fas fa-home fa-sm" style="color: var(--primary);"></i>
                        Beranda
                    </a>
                </p>
                <p class="mb-2">
                    <a href="<?php echo site_url('produk'); ?>" class="nav-link-footer">
                        <i class="fas fa-box fa-sm" style="color: var(--primary);"></i>
                        Produk
                    </a>
                </p>
                <p class="mb-2">
                    <a href="<?php echo site_url('toko'); ?>" class="nav-link-footer">
                        <i class="fas fa-store-alt fa-sm" style="color: var(--primary);"></i>
                        Toko
                    </a>
                </p>
            </div>
            
            <!-- Contact Information -->
            <div class="col-md-4 col-lg-3 mx-auto mobile-contact-section">
                <h6 class="fw-bold mb-4" style="color: var(--text-dark);">Kontak</h6>
                <div class="mb-3">
                    <div class="d-flex align-items-start mb-2">
                        <i class="fas fa-map-marker-alt me-3 mt-1" style="color: var(--primary);"></i>
                        <span class="text-muted">Kab. Banggai Kepulauan, Sulawesi Tengah</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-envelope me-3" style="color: var(--primary);"></i>
                        <a href="mailto:info@umkmBanggai.com" class="text-muted text-decoration-none">info@umkmBanggai.com</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone me-3" style="color: var(--primary);"></i>
                        <span class="text-muted">+62 xxx xxxx xxxx</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Divider -->
        <hr class="my-4 mobile-divider" style="border-color: rgba(62, 39, 35, 0.1);">
        
        <!-- Bottom Section -->
        <div class="row align-items-center mobile-bottom-section">
            <div class="col-md-8">
                <p class="text-muted mb-0">
                    © <?php echo date('Y'); ?> UMKM Banggai. Semua hak dilindungi. 
                    <span class="d-none d-md-inline">|</span>
                    <span class="d-md-inline d-block mt-1 mt-md-0">Mendukung ekonomi kreatif lokal.</span>
                </p>
            </div>
            <div class="col-md-4 text-center text-md-end mobile-heart-section">
                <small class="text-muted">
                    <i class="fas fa-heart text-danger"></i> Dibuat dengan cinta untuk UMKM Banggai
                </small>
            </div>
        </div>
    </div>
</footer>

<style>
/* Footer link hover effects */
footer a.text-muted:hover {
    color: var(--primary) !important;
    transition: color 0.3s ease;
}

footer .btn-floating {
    width: 48px;
    height: 48px;
    border-radius: 50% !important;
    padding: 0 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 16px rgba(226,125,96,0.10);
    font-size: 1.4rem;
    margin-right: 12px;
    margin-bottom: 0;
}

footer .btn-floating:last-child {
    margin-right: 0;
}

footer .btn-floating:hover {
    transform: translateY(-2px) scale(1.1);
}

footer .nav-link-footer {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-muted, #6c757d);
    text-decoration: none;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

footer .nav-link-footer i {
    font-size: 1.15em;
    min-width: 22px;
    text-align: center;
    vertical-align: middle;
    line-height: 1;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    /* Mobile Footer Optimizations */
    .mobile-footer {
        padding-top: 1.5rem !important;
        padding-bottom: 1rem !important;
    }
    
    .mobile-footer .container {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    
    /* Hide description on mobile to save space */
    .mobile-description {
        display: none !important;
    }
    
    /* Hide navigation section on mobile */
    .mobile-nav-section {
        display: none !important;
    }
    
    /* Simplify contact section */
    .mobile-contact-section {
        margin-bottom: 0.5rem !important;
    }
    
    .mobile-contact-section h6 {
        font-size: 1rem !important;
        margin-bottom: 0.5rem !important;
    }
    
    .mobile-contact-section .mb-3 {
        margin-bottom: 0.5rem !important;
    }
    
    .mobile-contact-section .d-flex {
        margin-bottom: 0.3rem !important;
        font-size: 0.8rem !important;
    }
    
    /* Compact divider */
    .mobile-divider {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }
    
    /* Simplify bottom section */
    .mobile-bottom-section {
        text-align: center !important;
    }
    
    .mobile-bottom-section p {
        font-size: 0.75rem !important;
        line-height: 1.3 !important;
    }
    
    /* Hide heart section on mobile */
    .mobile-heart-section {
        display: none !important;
    }
    
    /* Compact brand section */
    .mobile-footer h5 {
        font-size: 1.2rem !important;
        margin-bottom: 0.8rem !important;
    }
    
    /* Smaller social buttons */
    .mobile-footer .btn-floating {
        width: 32px !important;
        height: 32px !important;
        font-size: 0.9rem !important;
        margin-right: 6px !important;
    }
    
    /* Reduce row spacing */
    .mobile-footer .row {
        margin-bottom: 0 !important;
    }
    
    .mobile-footer .gy-4 {
        --bs-gutter-y: 1rem !important;
    }
    
    footer .row {
        text-align: center;
    }
    
    footer .d-flex {
        justify-content: center !important;
    }
}
</style>