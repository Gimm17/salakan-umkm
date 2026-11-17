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
                <a href="<?php echo site_url('produk'); ?>" class="text-decoration-none">Produk</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo htmlspecialchars($produk['nama_produk']); ?>
            </li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Product Image Section -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-soft overflow-hidden">
                <div class="position-relative">
                    <?php 
                        $gambar_url = base_url('public/img/produk/' . htmlspecialchars($produk['gambar_produk']));
                        $placeholder_url = 'https://placehold.co/800x600/E2E8F0/3E2723?text=' . urlencode($produk['nama_produk']);
                    ?>
                    <img src="<?php echo $gambar_url; ?>" 
                         onerror="this.onerror=null;this.src='<?php echo $placeholder_url; ?>';"
                         alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" 
                         class="w-100 product-detail-img" 
                         style="height: 300px; object-fit: cover;">
                    <style>
                        @media (max-width: 768px) {
                            .product-detail-img {
                                height: 250px !important;
                            }
                        }
                    </style>
                    
                    <!-- Category Badge -->
                    <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow">
                        <i class="fas fa-tag me-1"></i>
                        <?php echo htmlspecialchars($produk['nama_kategori']); ?>
                    </span>
                    
                    <!-- Share Button -->
                    <div class="position-absolute top-0 end-0 m-3">
                        <button class="btn btn-light rounded-circle p-2 shadow" 
                                onclick="shareProduct()" 
                                title="Bagikan Produk">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Gallery Thumbnails (if multiple images) -->
            <div class="row g-2 mt-3">
                <div class="col-3">
                    <div class="card border-0 shadow-sm">
                        <img src="<?php echo $gambar_url; ?>" 
                             class="card-img-top rounded" 
                             style="height: 80px; object-fit: cover; cursor: pointer;"
                             onclick="changeMainImage(this.src)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-soft h-100">
                <div class="card-body p-4 mobile-card-body">
                    <style>
                        @media (max-width: 768px) {
                            .mobile-card-body {
                                padding: 1.5rem !important;
                            }
                            .mobile-card-body h1 {
                                font-size: 1.4rem !important;
                                margin-bottom: 1rem !important;
                            }
                            .mobile-card-body h2 {
                                font-size: 1.6rem !important;
                            }
                            .mobile-card-body h5 {
                                font-size: 1.1rem !important;
                                margin-bottom: 0.8rem !important;
                            }
                            .mobile-card-body .mb-4 {
                                margin-bottom: 1.5rem !important;
                            }
                            .mobile-card-body .mb-3 {
                                margin-bottom: 1rem !important;
                            }
                        }
                    </style>
                    <!-- Product Title -->
                    <h1 class="fw-bold mb-3 text-dark"><?php echo htmlspecialchars($produk['nama_produk']); ?></h1>
                    
                    <!-- Rating Section -->
                    <?php if (!empty($rating_stats) && $rating_stats['total_ulasan'] > 0): ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            <div class="d-flex align-items-center">
                                <div class="rating-stars me-2">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?php echo ($i <= $rating_stats['rating_rata']) ? 'text-warning' : 'text-muted'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="fw-bold me-2"><?php echo $rating_stats['rating_rata']; ?></span>
                            </div>
                        </div>
                        <small class="text-muted">
                            (<?php echo $rating_stats['total_ulasan']; ?> ulasan)
                        </small>
                    </div>
                    <?php else: ?>
                    <div class="mb-3">
                        <span class="text-muted">
                            <i class="far fa-star me-1"></i>
                            Belum ada ulasan
                        </span>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Store Info -->
                    <div class="d-flex align-items-center mb-4 p-3 bg-light rounded-3 mobile-store-info">
                        <style>
                            @media (max-width: 768px) {
                                .mobile-store-info {
                                    padding: 0.75rem !important;
                                    margin-bottom: 1.5rem !important;
                                }
                                .mobile-store-info .rounded-circle {
                                    width: 35px !important;
                                    height: 35px !important;
                                }
                                .mobile-store-info h6 {
                                    font-size: 0.9rem !important;
                                    margin-bottom: 0.2rem !important;
                                }
                                .mobile-store-info small {
                                    font-size: 0.75rem !important;
                                }
                            }
                        </style>
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-store text-white"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <a href="<?php echo site_url('toko/'.$produk['id_toko']); ?>" 
                                   class="text-decoration-none text-dark">
                                    <?php echo htmlspecialchars($produk['nama_toko']); ?>
                                </a>
                            </h6>
                            <small class="text-muted">Penjual terpercaya</small>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <h2 class="price-text mb-0">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></h2>
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                <i class="fas fa-check me-1"></i>Tersedia
                            </span>
                        </div>
                        <small class="text-muted">Harga dapat berubah sewaktu-waktu</small>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                        <div class="accent-border ps-3">
                            <p class="text-muted mb-0 lh-lg">
                                <?php echo nl2br(htmlspecialchars($produk['deskripsi'])); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Purchase Options -->
<div class="mb-4">
    <h5 class="fw-bold mb-3">
        <i class="fas fa-shopping-cart me-2 text-primary"></i>
        Pesan Sekarang Melalui:
    </h5>
    <div class="d-flex flex-row gap-2 flex-wrap justify-content-start">
        <?php if(!empty($produk['link_whatsapp'])): ?>
        <a href="<?php echo htmlspecialchars($produk['link_whatsapp']); ?>" target="_blank"
           class="order-link-icon d-flex flex-column align-items-center text-decoration-none"
           title="Pesan via WhatsApp">
            <span class="order-icon rounded-circle shadow"
                  style="background:#25d366; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                <img src="<?php echo base_url('public/img/logo/whatsapp.png'); ?>" alt="WhatsApp" style="width:28px;height:28px;">
            </span>
            <span class="order-label mt-1 text-dark" style="font-size: 0.7rem; font-weight: 600;">WhatsApp</span>
        </a>
        <?php endif; ?>

        <?php if(!empty($produk['link_gofood'])): ?>
        <a href="<?php echo htmlspecialchars($produk['link_gofood']); ?>" target="_blank"
           class="order-link-icon d-flex flex-column align-items-center text-decoration-none"
           title="Pesan via GoFood">
            <span class="order-icon rounded-circle shadow"
                  style="background:#ee2737; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                <img src="<?php echo base_url('public/img/logo/gofood.png'); ?>" alt="GoFood" style="width:28px;height:28px;">
            </span>
            <span class="order-label mt-1 text-dark" style="font-size: 0.7rem; font-weight: 600;">GoFood</span>
        </a>
        <?php endif; ?>

        <?php if(!empty($produk['link_grabfood'])): ?>
        <a href="<?php echo htmlspecialchars($produk['link_grabfood']); ?>" target="_blank"
           class="order-link-icon d-flex flex-column align-items-center text-decoration-none"
           title="Pesan via GrabFood">
            <span class="order-icon rounded-circle shadow"
                  style="background:#ffffff; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                <img src="<?php echo base_url('public/img/logo/grabfood.png'); ?>" alt="GrabFood" style="width:28px;height:28px;">
            </span>
            <span class="order-label mt-1 text-dark" style="font-size: 0.7rem; font-weight: 600;">GrabFood</span>
        </a>
        <?php endif; ?>

        <?php if(!empty($produk['link_shopeefood'])): ?>
        <a href="<?php echo htmlspecialchars($produk['link_shopeefood']); ?>" target="_blank"
           class="order-link-icon d-flex flex-column align-items-center text-decoration-none"
           title="Pesan via ShopeeFood">
            <span class="order-icon rounded-circle shadow"
                  style="background:#ffffff; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                <img src="<?php echo base_url('public/img/logo/shopeefood.png'); ?>" alt="ShopeeFood" style="width:28px;height:28px;">
            </span>
            <span class="order-label mt-1 text-dark" style="font-size: 0.7rem; font-weight: 600;">ShopeeFood</span>
        </a>
        <?php endif; ?>

        <?php if(!empty($produk['link_maxim'])): ?>
        <a href="<?php echo htmlspecialchars($produk['link_maxim']); ?>" target="_blank"
           class="order-link-icon d-flex flex-column align-items-center text-decoration-none"
           title="Pesan via Maxim">
            <span class="order-icon rounded-circle shadow"
                  style="background:#ffd600; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                <img src="<?php echo base_url('public/img/logo/logo-maxim.png'); ?>" alt="Maxim" style="width:28px;height:28px;">
            </span>
            <span class="order-label mt-1 text-dark" style="font-size: 0.7rem; font-weight: 600;">Maxim</span>
        </a>
        <?php endif; ?>
    </div>
</div>

                    <!-- Favorite Button -->
                    <?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') == 'pengguna'): ?>
                    <div class="d-flex gap-3">
                        <button id="favorite-toggle-btn" 
                                class="btn flex-fill <?php echo $isFavorited ? 'btn-danger' : 'btn-outline-danger'; ?> rounded-pill" 
                                data-product-id="<?php echo $produk['id']; ?>">
                            <i class="fa-heart <?php echo $isFavorited ? 'fas' : 'far'; ?> me-2"></i>
                            <span class="button-text">
                                <?php echo $isFavorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit'; ?>
                            </span>
                        </button>
                        <button class="btn btn-outline-primary rounded-circle p-2" 
                                onclick="shareProduct()" 
                                title="Bagikan">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    
<!-- Checkout Page Link -->
<div class="mt-3 d-grid">
  <a href="<?php echo site_url('payment/checkout/' . $produk['id']); ?>"
     id="btn-bayar-sekarang"
     class="btn btn-primary btn-lg rounded-pill text-decoration-none text-center">
    <i class="fas fa-shopping-cart me-2"></i> Bayar Sekarang
  </a>
</div>
</div>
                    <?php elseif(!$this->session->userdata('is_logged_in')): ?>
                    <div class="alert alert-info rounded-3 border-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fs-4"></i>
                            <div>
                                <strong>Ingin menyimpan produk ini?</strong><br>
                                <a href="<?php echo site_url('login'); ?>" class="text-decoration-none">Login</a> 
                                sebagai pengguna untuk menambahkan ke favorit.
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information Tabs -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-soft">
                <div class="card-header bg-white border-0 p-4">
                    <ul class="nav nav-tabs border-0" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill px-4 me-2" 
                                    id="description-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#description" 
                                    type="button" 
                                    role="tab">
                                <i class="fas fa-info-circle me-2"></i>Detail
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 me-2" 
                                    id="reviews-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#reviews" 
                                    type="button" 
                                    role="tab">
                                <i class="fas fa-star me-2"></i>Ulasan (<?php echo isset($total_ulasan) ? $total_ulasan : 0; ?>)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 me-2" 
                                    id="store-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#store" 
                                    type="button" 
                                    role="tab">
                                <i class="fas fa-store me-2"></i>Info Toko
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <h6 class="fw-bold mb-3">Informasi Produk</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-muted">Kategori:</td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($produk['nama_kategori']); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Harga:</td>
                                            <td class="fw-semibold text-primary">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Penjual:</td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($produk['nama_toko']); ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold mb-3">Deskripsi Lengkap</h6>
                                    <p class="text-muted lh-lg"><?php echo nl2br(htmlspecialchars($produk['deskripsi'])); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <!-- Rating Summary -->
                                    <?php if (!empty($rating_stats) && $rating_stats['total_ulasan'] > 0): ?>
                                    <div class="text-center p-4 bg-light rounded">
                                        <h2 class="display-4 fw-bold text-primary mb-0"><?php echo $rating_stats['rating_rata']; ?></h2>
                                        <div class="rating-stars mb-2">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star <?php echo ($i <= $rating_stats['rating_rata']) ? 'text-warning' : 'text-muted'; ?> fs-5"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="text-muted mb-3"><?php echo $rating_stats['total_ulasan']; ?> ulasan</p>
                                        
                                        <!-- Rating Breakdown -->
                                        <?php for($i = 5; $i >= 1; $i--): ?>
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="me-2"><?php echo $i; ?></span>
                                            <i class="fas fa-star text-warning me-2"></i>
                                            <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                <?php 
                                                $count = $rating_stats['bintang_' . $i] ?? 0;
                                                $percentage = $rating_stats['total_ulasan'] > 0 ? ($count / $rating_stats['total_ulasan']) * 100 : 0;
                                                ?>
                                                <div class="progress-bar bg-warning" style="width: <?php echo $percentage; ?>%"></div>
                                            </div>
                                            <small class="text-muted"><?php echo $count; ?></small>
                                        </div>
                                        <?php endfor; ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="text-center p-4 bg-light rounded">
                                        <i class="far fa-star fa-3x text-muted mb-3"></i>
                                        <h6 class="fw-bold">Belum Ada Ulasan</h6>
                                        <p class="text-muted">Jadilah yang pertama memberikan ulasan!</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-8">
                                    <!-- Add Review Form (for logged in users) -->
                                    <?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') == 'pengguna'): ?>
                                        <?php if(isset($kuota_ulasan) && $kuota_ulasan['sisa_kuota'] > 0): ?>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Berikan Ulasan Anda</h6>
                                                <form id="reviewForm">
                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf-token-review">
                                                    <input type="hidden" name="id_produk" value="<?php echo $produk['id']; ?>">
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Rating</label>
                                                        <div class="rating-input">
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <i class="far fa-star rating-star" data-rating="<?php echo $i; ?>"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <input type="hidden" name="rating" id="selectedRating" value="0">
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="komentar" class="form-label fw-semibold">Komentar</label>
                                                        <textarea class="form-control" id="komentar" name="komentar" rows="4" 
                                                                placeholder="Ceritakan pengalaman Anda dengan produk ini (opsional)..."></textarea>
                                                    </div>
                                                    
                                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                                        <i class="fas fa-paper-plane me-2"></i>Kirim Ulasan
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <?php elseif(isset($kuota_ulasan) && $kuota_ulasan['total_purchased'] == 0): ?>
                                        <div class="alert alert-warning mb-4">
                                            <i class="fas fa-shopping-bag me-2"></i>
                                            Anda harus membeli produk ini terlebih dahulu sebelum dapat memberikan ulasan.
                                        </div>
                                        <?php endif; ?>
                                    <?php elseif(!$this->session->userdata('is_logged_in')): ?>
                                    <div class="alert alert-info mb-4">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <a href="<?php echo site_url('login'); ?>" class="alert-link">Login</a> 
                                        untuk memberikan ulasan.
                                    </div>
                                    <?php endif; ?>

                                    <!-- Reviews List -->
                                    <div id="reviewsList">
                                        <?php if(!empty($ulasan_produk)): ?>
                                            <?php foreach($ulasan_produk as $ulasan): ?>
                                            <div class="review-item border-bottom pb-3 mb-3">
                                                <div class="d-flex align-items-start">
                                                    <div class="avatar me-3">
                                                        <?php if(!empty($ulasan['foto_user'])): ?>
                                                        <img src="<?php echo base_url('public/img/profile/' . $ulasan['foto_user']); ?>" 
                                                             class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                                        <?php else: ?>
                                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" 
                                                             style="width: 40px; height: 40px;">
                                                            <?php echo strtoupper(substr($ulasan['nama_user'], 0, 1)); ?>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <h6 class="fw-bold mb-0 me-2"><?php echo htmlspecialchars($ulasan['nama_user']); ?></h6>
                                                            <div class="rating-stars me-2">
                                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                                    <i class="fas fa-star <?php echo ($i <= $ulasan['rating']) ? 'text-warning' : 'text-muted'; ?> fa-sm"></i>
                                                                <?php endfor; ?>
                                                            </div>
                                                            <small class="text-muted"><?php echo date('d M Y', strtotime($ulasan['created_at'])); ?></small>
                                                        </div>
                                                        <p class="text-muted mb-0"><?php echo nl2br(htmlspecialchars($ulasan['komentar'])); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                            
                                            <?php if($total_ulasan > 5): ?>
                                            <div class="text-center">
                                                <button class="btn btn-outline-primary rounded-pill px-4" id="loadMoreReviews" data-page="2">
                                                    <i class="fas fa-chevron-down me-2"></i>Muat Lebih Banyak
                                                </button>
                                            </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                        <div class="text-center py-5">
                                            <i class="far fa-comments fa-3x text-muted mb-3"></i>
                                            <h6 class="fw-bold">Belum Ada Ulasan</h6>
                                            <p class="text-muted">Jadilah yang pertama memberikan ulasan untuk produk ini!</p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Store Tab -->
                        <div class="tab-pane fade" id="store" role="tabpanel">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" 
                                         style="width: 80px; height: 80px;">
                                        <i class="fas fa-store text-white fs-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h5 class="fw-bold mb-2"><?php echo htmlspecialchars($produk['nama_toko']); ?></h5>
                                    <p class="text-muted mb-3">Toko terpercaya yang menjual berbagai produk berkualitas</p>
                                    <a href="<?php echo site_url('toko/'.$produk['id_toko']); ?>" 
                                       class="btn btn-outline-primary rounded-pill px-4">
                                        <i class="fas fa-store-alt me-2"></i>Kunjungi Toko
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Input CSRF Token -->
<input type="hidden" id="csrf-token-input" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Favorite functionality (existing code)
    const favoriteBtn = document.getElementById('favorite-toggle-btn');
    if (favoriteBtn) {
        favoriteBtn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const csrfTokenInput = document.getElementById('csrf-token-input');
            const csrfName = csrfTokenInput.name;
            const csrfHash = csrfTokenInput.value;

            const formData = new FormData();
            formData.append('id_produk', productId);
            formData.append(csrfName, csrfHash);

            this.disabled = true;
            this.querySelector('.button-text').textContent = 'Memproses...';
            this.querySelector('i').className = 'fas fa-spinner fa-spin me-2';

            fetch('<?php echo site_url("user/toggle_favorit"); ?>', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                csrfTokenInput.value = data.csrf_hash;
                const icon = this.querySelector('i');
                const text = this.querySelector('.button-text');

                if (data.action === 'reload') {
                    Swal.fire('Sesi Berakhir', data.message, 'warning').then(() => {
                        window.location.reload();
                    });
                    return;
                }

                if (data.status === 'added') {
                    this.classList.remove('btn-outline-danger');
                    this.classList.add('btn-danger');
                    icon.className = 'fas fa-heart me-2';
                    text.textContent = 'Hapus dari Favorit';
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else if (data.status === 'removed') {
                    this.classList.remove('btn-danger');
                    this.classList.add('btn-outline-danger');
                    icon.className = 'far fa-heart me-2';
                    text.textContent = 'Tambah ke Favorit';
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan tidak diketahui.');
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                Swal.fire('Oops...', error.message, 'error');
                
                const icon = this.querySelector('i');
                const text = this.querySelector('.button-text');
                if(this.classList.contains('btn-danger')){
                    icon.className = 'fas fa-heart me-2';
                    text.textContent = 'Hapus dari Favorit';
                } else {
                    icon.className = 'far fa-heart me-2';
                    text.textContent = 'Tambah ke Favorit';
                }
            })
            .finally(() => {
                this.disabled = false;
            });
        });
    }

    // Rating input functionality
    const ratingStars = document.querySelectorAll('.rating-star');
    const selectedRatingInput = document.getElementById('selectedRating');
    
    ratingStars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            highlightStars(rating);
        });
        
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            selectedRatingInput.value = rating;
            setStars(rating);
        });
    });
    
    // Reset stars on mouse leave
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        const currentRating = parseInt(selectedRatingInput.value);
        if (currentRating > 0) {
            setStars(currentRating);
        } else {
            resetStars();
        }
    });
    
    function highlightStars(rating) {
        ratingStars.forEach((star, index) => {
            if (index < rating) {
                star.className = 'fas fa-star rating-star text-warning';
            } else {
                star.className = 'far fa-star rating-star text-muted';
            }
        });
    }
    
    function setStars(rating) {
        ratingStars.forEach((star, index) => {
            if (index < rating) {
                star.className = 'fas fa-star rating-star text-warning';
            } else {
                star.className = 'far fa-star rating-star text-muted';
            }
        });
    }
    
    function resetStars() {
        ratingStars.forEach(star => {
            star.className = 'far fa-star rating-star text-muted';
        });
    }

    // Review form submission
    const reviewForm = document.getElementById('reviewForm');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const rating = parseInt(selectedRatingInput.value);
            const komentar = document.getElementById('komentar').value.trim();
            
            if (rating === 0) {
                Swal.fire('Peringatan', 'Silakan pilih rating terlebih dahulu.', 'warning');
                return;
            }
            

            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
            
            const formData = new FormData(this);
            
            fetch('<?php echo site_url("user/tambah_ulasan"); ?>', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('csrf-token-review').value = data.csrf_hash;
                
                if (data.action === 'reload') {
                    Swal.fire('Sesi Berakhir', data.message, 'warning').then(() => {
                        window.location.reload();
                    });
                    return;
                }
                
                if (data.status === 'success') {
                    Swal.fire('Berhasil!', data.message, 'success').then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire('Oops...', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Oops...', 'Terjadi kesalahan saat mengirim ulasan.', 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }

    // Load more reviews
    const loadMoreBtn = document.getElementById('loadMoreReviews');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const page = parseInt(this.dataset.page);
            const productId = <?php echo $produk['id']; ?>;
            
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
            
            fetch(`<?php echo site_url("katalog/load_ulasan/{$produk['id']}"); ?>?page=${page}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const reviewsList = document.getElementById('reviewsList');
                    const loadMoreContainer = this.parentElement;
                    
                    data.ulasan.forEach(ulasan => {
                        const reviewHTML = `
                            <div class="review-item border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="avatar me-3">
                                        ${ulasan.foto_user ? 
                                            `<img src="<?php echo base_url('public/img/profile/'); ?>${ulasan.foto_user}" 
                                                 class="rounded-circle" width="40" height="40" style="object-fit: cover;">` :
                                            `<div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" 
                                                 style="width: 40px; height: 40px;">
                                                ${ulasan.nama_user.charAt(0).toUpperCase()}
                                             </div>`
                                        }
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <h6 class="fw-bold mb-0 me-2">${ulasan.nama_user}</h6>
                                            <div class="rating-stars me-2">
                                                ${Array.from({length: 5}, (_, i) => 
                                                    `<i class="fas fa-star ${i < ulasan.rating ? 'text-warning' : 'text-muted'} fa-sm"></i>`
                                                ).join('')}
                                            </div>
                                            <small class="text-muted">${new Date(ulasan.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'short', year: 'numeric'})}</small>
                                        </div>
                                        <p class="text-muted mb-0">${ulasan.komentar.replace(/\n/g, '<br>')}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        loadMoreContainer.insertAdjacentHTML('beforebegin', reviewHTML);
                    });
                    
                    if (data.has_more) {
                        this.dataset.page = data.next_page;
                        this.disabled = false;
                        this.innerHTML = '<i class="fas fa-chevron-down me-2"></i>Muat Lebih Banyak';
                    } else {
                        this.remove();
                    }
                } else {
                    Swal.fire('Oops...', 'Gagal memuat ulasan.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Oops...', 'Terjadi kesalahan saat memuat ulasan.', 'error');
                this.disabled = false;
                this.innerHTML = '<i class="fas fa-chevron-down me-2"></i>Muat Lebih Banyak';
            });
        });
    }

    // Share functionality (existing code)
    window.shareProduct = function() {
        if (navigator.share) {
            navigator.share({
                title: '<?php echo htmlspecialchars($produk['nama_produk']); ?>',
                text: 'Lihat produk menarik ini dari UMKM Banggai!',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Link Disalin!',
                    text: 'Link produk telah disalin ke clipboard',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }
    };

    // Change main image function (existing code)
    window.changeMainImage = function(src) {
        document.querySelector('.product-detail-img').src = src;
    };

    // Tab navigation enhancement (existing code)
    const tabButtons = document.querySelectorAll('#productTabs .nav-link');
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>

<style>
/* Enhanced product detail styling (existing styles) */
.product-detail-img {
    transition: transform 0.3s ease;
    border-radius: 1rem;
}

.product-detail-img:hover {
    transform: scale(1.02);
}

/* Tab styling (existing styles) */
.nav-tabs .nav-link {
    border: 2px solid transparent;
    background: var(--light-gray);
    color: var(--text-dark);
    font-weight: 600;
    transition: all 0.3s ease;
}

.nav-tabs .nav-link.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.nav-tabs .nav-link:hover {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

/* Rating input styling */
.rating-input {
    cursor: pointer;
}

.rating-star {
    font-size: 1.5rem;
    margin-right: 0.25rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.rating-star:hover {
    transform: scale(1.1);
}

/* Rating stars display */
.rating-stars .fa-star {
    margin-right: 2px;
}

/* Review item styling */
.review-item {
    transition: all 0.3s ease;
}

.review-item:hover {
    background-color: rgba(0,0,0,0.02);
    border-radius: 0.5rem;
    padding: 1rem !important;
    margin: 0.5rem 0 !important;
}

/* Progress bar for rating breakdown */
.progress {
    background-color: #e9ecef;
}

.progress-bar {
    transition: width 0.6s ease;
}

/* Avatar styling */
.avatar img {
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Form styling */
#reviewForm .form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(226, 125, 96, 0.25);
}

/* Purchase button animations (existing styles) */
.btn-success:hover,
.btn[style*="background-color"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

/* Breadcrumb styling (existing styles) */
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

/* Price styling (existing styles) */
.price-text {
    background: linear-gradient(45deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Enhanced card hover effects (existing styles) */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(62, 39, 35, 0.1);
    transition: all 0.3s ease;
}

/* Thumbnail hover effect (existing styles) */
img[onclick] {
    transition: all 0.3s ease;
}

img[onclick]:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Load more button styling */
#loadMoreReviews {
    transition: all 0.3s ease;
}

#loadMoreReviews:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* ...existing code... */
.order-link-icon {
    width: 80px;
    text-align: center;
    transition: transform 0.2s;
}
.order-link-icon:hover {
    transform: translateY(-4px) scale(1.08);
    text-decoration: none;
}
.order-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    background: #eee;
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.order-label {
    font-size: 0.95rem;
    color: #222;
    font-weight: 600;
    margin-top: 0.5rem;
    word-break: break-word;
}

/* Responsive design */
@media (max-width: 768px) {
    .rating-star {
        font-size: 1.25rem;
    }
    
    .review-item .d-flex {
        flex-direction: column;
        text-align: center;
    }
    
    .review-item .avatar {
        margin-bottom: 1rem;
        align-self: center;
    }
}
</style>
<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo html_escape($midtrans_client_key ?? (getenv('MIDTRANS_CLIENT_KEY') ?: '')); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var btn = document.getElementById('btn-bayar-sekarang');
  if (!btn) return;

  btn.addEventListener('click', function(){
    var csrfInput = document.getElementById('csrf-token-input');
    var csrfName  = csrfInput ? csrfInput.name  : '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash  = csrfInput ? csrfInput.value : '<?php echo $this->security->get_csrf_hash(); ?>';

    var originalHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';

    var params = new URLSearchParams({ produk_id: "<?php echo $produk['id']; ?>", qty: 1 });
    params.append(csrfName, csrfHash);

    // Minta token Snap dari server
    fetch("<?php echo site_url('payment/create'); ?>", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: params
    })
    .then(function(r) {
      if (csrfInput) {
        var newToken = r.headers.get('X-CSRF-Token');
        if (newToken) csrfInput.value = newToken;
      }
      if (!r.ok) {
        return r.text().then(function(t) {
          var parsed = null;
          try { parsed = JSON.parse(t); } catch(e) {}
          var msg = parsed && parsed.error ? parsed.error : ('HTTP ' + r.status);
          if (parsed && parsed.detail) msg += ' – ' + JSON.stringify(parsed.detail);
          throw new Error(msg);
        });
      }
      return r.json();
    })
    .then(function(res) {
      if (!res.token) throw new Error('Token Midtrans tidak ditemukan: ' + JSON.stringify(res));

      // Buka popup pembayaran Midtrans Snap
      snap.pay(res.token, {
        onSuccess: function(result) {
          Swal.fire('Pembayaran Berhasil!', 'Terima kasih, pesanan Anda sedang diproses.', 'success').then(function() {
            window.location = "<?php echo site_url('payment/finish'); ?>?order_id=" + res.order_id + "&transaction_status=settlement";
          });
        },
        onPending: function(result) {
          Swal.fire('Menunggu Pembayaran', 'Silakan selesaikan pembayaran Anda.', 'info');
        },
        onError: function(result) {
          Swal.fire('Pembayaran Gagal', 'Terjadi kesalahan saat proses pembayaran.', 'error');
        },
        onClose: function() {
          // User menutup popup tanpa bayar
          Swal.fire({
            icon: 'warning',
            title: 'Pembayaran Dibatalkan',
            text: 'Anda menutup halaman pembayaran.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        }
      });
    })
    .catch(function(err) {
      Swal.fire('Oops...', err.message, 'error');
    })
    .finally(function() {
      btn.disabled = false;
      btn.innerHTML = originalHtml;
    });
  });
});
</script>
