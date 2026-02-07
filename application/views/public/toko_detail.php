<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-white rounded-pill px-4 py-2 shadow-sm">
            <li class="breadcrumb-item">
                <a href="<?php echo site_url(); ?>" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Beranda
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo site_url('toko'); ?>" class="text-decoration-none">Toko</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo htmlspecialchars($toko['nama_toko']); ?>
            </li>
        </ol>
    </nav>

    <!-- Store Header -->
    <div class="card border-0 shadow-soft mb-5 overflow-hidden">
        <!-- Cover Background -->
        <div class="position-relative">
            <div class="bg-gradient" style="height: 200px;">
                <div class="position-absolute top-0 end-0 m-3">
                    <button class="btn btn-light rounded-circle p-2 shadow" 
                            onclick="shareStore()" 
                            title="Bagikan Toko">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Store Info -->
        <div class="card-body p-4 pt-0">
            <div class="row align-items-center">
                <div class="col-md-auto text-center text-md-start">
                    <?php 
                        $logo_url = base_url('public/img/logo/' . htmlspecialchars($toko['logo']));
                        $inisial = strtoupper(substr(htmlspecialchars($toko['nama_toko']), 0, 2));
                        $placeholder_url = 'https://placehold.co/200x200/E27D60/FFFFFF?text=' . urlencode($inisial);
                    ?>
                    <img src="<?php echo $logo_url; ?>" 
                         onerror="this.onerror=null;this.src='<?php echo $placeholder_url; ?>';"
                         class="rounded-circle img-fluid store-logo shadow-lg" 
                         alt="Logo <?php echo htmlspecialchars($toko['nama_toko']); ?>" 
                         style="width: 120px; height: 120px; object-fit: cover; border: 5px solid #fff; margin-top: -60px;">
                </div>
                <div class="col-md mt-3 mt-md-0">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
                        <div>
                            <h1 class="fw-bold mb-2"><?php echo htmlspecialchars($toko['nama_toko']); ?></h1>
                            <p class="text-muted lead mb-3"><?php echo htmlspecialchars($toko['deskripsi']); ?></p>
                            
                            <!-- Store Stats -->
                            <div class="d-flex flex-wrap gap-4 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                         style="width: 30px; height: 30px;">
                                        <i class="fas fa-box text-white fa-sm"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold"><?php echo isset($total_produk) ? $total_produk : count($produks); ?></div>
                                        <small class="text-muted">Produk</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" 
                                         style="width: 30px; height: 30px;">
                                        <i class="fas fa-star text-white fa-sm"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">UMKM</div>
                                        <small class="text-muted">Terpercaya</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle accent-bg d-flex align-items-center justify-content-center me-2" 
                                         style="width: 30px; height: 30px;">
                                        <i class="fas fa-clock text-dark fa-sm"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Aktif</div>
                                        <small class="text-muted">Status</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-md-end">
                            <button class="btn btn-primary rounded-pill px-4 mb-2" onclick="contactStore()">
                                <i class="fas fa-phone me-2"></i>Hubungi Toko
                            </button>
                            <br>
                            <button class="btn btn-outline-secondary rounded-pill px-3" onclick="shareStore()">
                                <i class="fas fa-share-alt me-2"></i>Bagikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Details -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card border-0 shadow-soft h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-info-circle me-2 text-primary"></i>
                        Informasi Toko
                    </h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-map-marker-alt me-3 mt-1 text-primary"></i>
                                <div>
                                    <strong>Alamat:</strong><br>
                                    <span class="text-muted"><?php echo htmlspecialchars($toko['alamat']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-clock me-3 mt-1 text-secondary"></i>
                                <div>
                                    <strong>Jam Operasional:</strong><br>
                                    <span class="text-muted"><?php echo htmlspecialchars($toko['jam_operasional']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-calendar-alt me-3 mt-1 text-accent"></i>
                                <div>
                                    <strong>Bergabung:</strong><br>
                                    <span class="text-muted">
                                        <?php 
                                        if(isset($toko['tanggal_bergabung'])) {
                                            echo date('F Y', strtotime($toko['tanggal_bergabung'])); 
                                        } else {
                                            echo 'Member UMKM Banggai';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-soft h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-handshake me-2 text-primary"></i>
                        Tentang Kami
                    </h5>
                    <div class="accent-border ps-3">
                        <p class="text-muted lh-lg mb-4">
                            <?php echo nl2br(htmlspecialchars($toko['deskripsi'])); ?>
                        </p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary rounded-pill px-3 py-2">UMKM Lokal</span>
                        <span class="badge bg-secondary rounded-pill px-3 py-2">Produk Berkualitas</span>
                        <span class="badge accent-bg rounded-pill px-3 py-2">Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="card border-0 shadow-soft">
        <div class="card-header bg-white border-0 p-4">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="fw-bold mb-0">
                        <i class="fas fa-box me-2 text-primary"></i>
                        Produk dari <?php echo htmlspecialchars($toko['nama_toko']); ?>
                    </h3>
                    <p class="text-muted mb-0">Temukan berbagai produk unggulan yang kami tawarkan</p>
                </div>
                <div class="col-auto">
                    <?php if(!empty($produks)): ?>
                    <span class="badge bg-primary rounded-pill px-3 py-2">
                        <?php echo count($produks); ?> Produk Tersedia
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php if (!empty($produks)): ?>
                    <?php foreach ($produks as $index => $produk): ?>
                        <div class="col" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="card h-100 shadow-sm border-0 product-card">
                                <?php 
                                    // Pastikan $produk adalah array dan memiliki key yang diperlukan
                                    $nama_produk = isset($produk['nama_produk']) ? $produk['nama_produk'] : 'Produk';
                                    $gambar_produk = isset($produk['gambar_produk']) ? $produk['gambar_produk'] : '';
                                    $harga = isset($produk['harga']) ? $produk['harga'] : 0;
                                    $nama_kategori = isset($produk['nama_kategori']) ? $produk['nama_kategori'] : 'Umum';
                                    $views = isset($produk['views']) ? $produk['views'] : 0;
                                    $produk_id = isset($produk['id']) ? $produk['id'] : 0;
                                    
                                    // Generate placeholder URL
                                    $nama_pendek = substr($nama_produk, 0, 10);
                                    $placeholder_url = 'https://placehold.co/600x400/E2E8F0/3E2723?text=' . urlencode($nama_pendek);
                                    
                                    // Cek apakah file gambar ada
                                    $gambar_url = '';
                                    if (!empty($gambar_produk) && file_exists(FCPATH . 'public/img/produk/' . $gambar_produk)) {
                                        $gambar_url = base_url('public/img/produk/' . htmlspecialchars($gambar_produk));
                                    }
                                ?>
                                
                                <div class="position-relative overflow-hidden" style="height: 200px;">
                                    <a href="<?php echo site_url('produk/' . $produk_id); ?>">
                                        <?php if (!empty($gambar_url)): ?>
                                            <img src="<?php echo $gambar_url; ?>" 
                                                 onerror="this.onerror=null;this.src='<?php echo $placeholder_url; ?>';" 
                                                 class="card-img-top w-100 h-100" 
                                                 alt="<?php echo htmlspecialchars($nama_produk); ?>" 
                                                 style="object-fit: cover;">
                                        <?php else: ?>
                                            <img src="<?php echo $placeholder_url; ?>" 
                                                 class="card-img-top w-100 h-100" 
                                                 alt="<?php echo htmlspecialchars($nama_produk); ?>" 
                                                 style="object-fit: cover;">
                                        <?php endif; ?>
                                    </a>
                                    <span class="badge bg-primary position-absolute top-0 start-0 m-3 shadow-sm">
                                        <?php echo htmlspecialchars($nama_kategori); ?>
                                    </span>
                                </div>
                                
                                <div class="card-body d-flex flex-column p-3">
                                    <h6 class="card-title fw-bold mb-2 flex-grow-1">
                                        <a href="<?php echo site_url('produk/' . $produk_id); ?>" 
                                           class="text-decoration-none text-dark stretched-link">
                                            <?php echo htmlspecialchars($nama_produk); ?>
                                        </a>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-primary fs-5">
                                            Rp<?php echo number_format($harga, 0, ',', '.'); ?>
                                        </span>
                                        <small class="text-muted">
                                            <i class="fas fa-heart me-1 text-danger"></i>
                                            <?php echo isset($produk['total_favorit']) ? $produk['total_favorit'] : '0'; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-shopping-basket fa-3x mb-3 text-muted"></i>
                            <h5 class="fw-bold">Belum Ada Produk</h5>
                            <p class="text-muted mb-4">Toko ini belum menambahkan produk apapun ke dalam katalog.</p>
                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                                <a href="<?php echo site_url('produk'); ?>" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-search me-2"></i>Jelajahi Produk Lain
                                </a>
                                <a href="<?php echo site_url('toko'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="fas fa-store-alt me-2"></i>Lihat Toko Lain
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Related Stores Section -->
    <div class="mt-5">
        <div class="card border-0 shadow-soft p-4 text-center">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Jelajahi Toko UMKM Lainnya</h5>
                <p class="text-muted mb-4">Temukan lebih banyak produk berkualitas dari pengusaha lokal lainnya di Banggai.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="<?php echo site_url('toko'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fas fa-store-alt me-2"></i>Lihat Semua Toko
                    </a>
                    <a href="<?php echo site_url('produk'); ?>" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contact store functionality
    window.contactStore = function() {
        Swal.fire({
            title: 'Hubungi <?php echo htmlspecialchars($toko['nama_toko']); ?>',
            html: `
                <div class="text-start">
                    <p class="mb-3">Pilih cara untuk menghubungi toko:</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" onclick="window.open('https://wa.me/62<?php echo substr(htmlspecialchars($toko['no_telepon'] ?? '81234567890'), 1); ?>?text=Halo, saya tertarik dengan produk di toko <?php echo urlencode($toko['nama_toko']); ?>', '_blank')">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp
                        </button>
                        <button class="btn btn-primary" onclick="window.location.href='tel:<?php echo htmlspecialchars($toko['no_telepon'] ?? '081234567890'); ?>'">
                            <i class="fas fa-phone me-2"></i>Telepon
                        </button>
                        <button class="btn btn-info" onclick="window.location.href='mailto:<?php echo htmlspecialchars($toko['email'] ?? 'info@umkmBanggai.com'); ?>'">
                            <i class="fas fa-envelope me-2"></i>Email
                        </button>
                    </div>
                </div>
            `,
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonText: 'Tutup',
            cancelButtonColor: '#6c757d',
            width: '400px'
        });
    };

    // Share store functionality
    window.shareStore = function() {
        if (navigator.share) {
            navigator.share({
                title: '<?php echo htmlspecialchars($toko['nama_toko']); ?>',
                text: 'Lihat toko UMKM menarik ini di Banggai!',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Link Disalin!',
                    text: 'Link toko telah disalin ke clipboard',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }
    };

    // Store logo animation
    const storeLogo = document.querySelector('.store-logo');
    if (storeLogo) {
        storeLogo.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        storeLogo.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    }

    // Product cards animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.product-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
});
</script>

<style>
/* Store detail specific styling */
.store-logo {
    transition: all 0.3s ease;
    cursor: pointer;
}

/* Enhanced gradient background */
.bg-gradient {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
    position: relative;
    overflow: hidden;
}

.bg-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

/* Stats cards animation */
.d-flex .rounded-circle {
    transition: all 0.3s ease;
}

.d-flex:hover .rounded-circle {
    transform: scale(1.1);
}

/* Product cards in store page */
.product-card {
    transition: all 0.4s ease;
}

.product-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 20px 50px rgba(62, 39, 35, 0.15);
}

.product-card .card-img-top {
    transition: transform 0.5s ease;
}

.product-card:hover .card-img-top {
    transform: scale(1.1);
}

/* Badge enhancements */
.badge {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    transition: all 0.3s ease;
}

.badge:hover {
    transform: translateY(-1px);
}

/* Contact buttons styling */
.swal2-popup .btn {
    margin: 0.25rem 0;
    font-weight: 600;
}

/* Breadcrumb enhancements */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: var(--primary);
    font-weight: bold;
}

.breadcrumb-item a {
    color: var(--text-dark);
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: var(--primary);
}

/* Enhanced empty state */
.empty-state {
    background: linear-gradient(135deg, var(--bg-ivory) 0%, rgba(255, 248, 240, 0.8) 100%);
    border: 2px dashed rgba(62, 39, 35, 0.1);
    transition: all 0.3s ease;
}

.empty-state:hover {
    border-color: var(--primary);
    background: linear-gradient(135deg, rgba(226, 125, 96, 0.05) 0%, var(--bg-ivory) 100%);
}

/* Enhanced info cards */
.card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .store-logo {
        width: 100px !important;
        height: 100px !important;
        margin-top: -50px !important;
    }
    
    .bg-gradient {
        height: 150px !important;
    }
    
    .d-flex.flex-wrap.gap-4 {
        gap: 1rem !important;
    }
}
</style>