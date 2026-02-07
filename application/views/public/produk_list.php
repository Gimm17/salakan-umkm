<div class="container py-4">
    <!-- Header Halaman -->
    <div class="position-relative overflow-hidden mb-4">
        <div class="card border-0 shadow-lg text-white" style="background: linear-gradient(135deg, #E27D60 0%, #85B66F 100%); min-height: 250px;">
            <!-- Decorative Elements -->
            <div class="position-absolute top-0 end-0 opacity-10">
                <i class="fas fa-shopping-basket" style="font-size: 120px; transform: translate(30px, -20px) rotate(15deg);"></i>
            </div>
            <div class="position-absolute bottom-0 start-0 opacity-10">
                <i class="fas fa-tags" style="font-size: 100px; transform: translate(-30px, 30px) rotate(-15deg);"></i>
            </div>
            
            <div class="card-body p-5 position-relative">
                <div class="row align-items-center h-100">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-semibold">
                                <i class="fas fa-shopping-bag me-1"></i>
                                Koleksi Produk UMKM
                            </span>
                        </div>
                        <h1 class="display-5 fw-bold mb-3">Jelajahi Produk UMKM</h1>
                        <p class="fs-5 mb-4 opacity-90">
                            Temukan berbagai produk unggulan dari para pelaku UMKM di Banggai. 
                            Dari makanan lezat hingga kerajinan tangan unik, semua ada di sini.
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="me-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-box text-warning me-2"></i>
                                    <span class="fw-semibold">Produk Berkualitas</span>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-heart text-warning me-2"></i>
                                    <span class="fw-semibold">Buatan Lokal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center d-none d-lg-block">
                        <div class="position-relative">
                            <div class="bg-white bg-opacity-20 rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 120px; height: 120px;">
                                <i class="fas fa-shopping-basket text-white" style="font-size: 3rem;"></i>
                            </div>
                            <!-- Floating elements -->
                            <div class="position-absolute top-0 start-0">
                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 30px; height: 30px;">
                                    <i class="fas fa-star text-white fa-sm"></i>
                                </div>
                            </div>
                            <div class="position-absolute bottom-0 end-0">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 25px; height: 25px;">
                                    <i class="fas fa-check text-white fa-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom decoration -->
            <div class="position-absolute bottom-0 w-100" style="height: 4px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);"></div>
        </div>
    </div>

    <!-- Fitur Filter dan Pencarian -->
    <div class="card shadow-soft mb-4 border-0">
        <div class="card-body p-4">
            <form action="<?php echo site_url('produk'); ?>" method="get" class="row g-3 align-items-center">
                <div class="col-xl-5 col-lg-4">
                    <div class="position-relative">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="q" 
                                   class="form-control border-start-0 ps-0" 
                                   placeholder="Cari nama produk..." 
                                   value="<?php echo htmlspecialchars($this->input->get('q') ?? ''); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <select name="kategori" class="form-select">
                        <option value="">🏷️ Semua Kategori</option>
                        <?php if(!empty($kategoris)): foreach($kategoris as $kategori): ?>
                            <option value="<?php echo $kategori['slug']; ?>" 
                                    <?php echo ($this->input->get('kategori') == $kategori['slug']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($kategori['nama_kategori']); ?>
                            </option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="col-xl-2 col-lg-3">
                    <select name="sort" class="form-select">
                        <option value="terbaru" <?php echo ($this->input->get('sort') == 'terbaru' || !$this->input->get('sort')) ? 'selected' : ''; ?>>
                            🕒 Terbaru
                        </option>
                        <option value="termurah" <?php echo ($this->input->get('sort') == 'termurah') ? 'selected' : ''; ?>>
                            💰 Termurah
                        </option>
                        <option value="termahal" <?php echo ($this->input->get('sort') == 'termahal') ? 'selected' : ''; ?>>
                            💎 Termahal
                        </option>
                        <option value="rating_tertinggi" <?php echo ($this->input->get('sort') == 'rating_tertinggi') ? 'selected' : ''; ?>>
                            ⭐ Rating Tertinggi
                        </option>
                        <option value="terpopuler" <?php echo ($this->input->get('sort') == 'terpopuler') ? 'selected' : ''; ?>>
                            ❤️ Terpopuler
                        </option>
                    </select>
                </div>
                <div class="col-xl-2 col-lg-2">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">
                        <i class="fas fa-filter me-2"></i>Terapkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Filter Tags (jika ada filter aktif) -->
    <?php if ($this->input->get('q') || $this->input->get('kategori') || $this->input->get('sort')): ?>
    <div class="mb-4">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="text-muted me-2">Filter aktif:</span>
            <?php if ($this->input->get('q')): ?>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    <i class="fas fa-search me-1"></i>
                    "<?php echo htmlspecialchars($this->input->get('q')); ?>"
                    <a href="<?php echo site_url('produk?' . http_build_query(array_filter(array_merge($_GET, ['q' => null])))); ?>" 
                       class="text-white ms-2 text-decoration-none">×</a>
                </span>
            <?php endif; ?>
            <?php if ($this->input->get('kategori')): ?>
                <span class="badge bg-secondary rounded-pill px-3 py-2">
                    <i class="fas fa-tag me-1"></i>
                    <?php 
                    $selected_kategori = array_filter($kategoris, function($k) { return $k['slug'] == $this->input->get('kategori'); });
                    echo !empty($selected_kategori) ? reset($selected_kategori)['nama_kategori'] : $this->input->get('kategori');
                    ?>
                    <a href="<?php echo site_url('produk?' . http_build_query(array_filter(array_merge($_GET, ['kategori' => null])))); ?>" 
                       class="text-white ms-2 text-decoration-none">×</a>
                </span>
            <?php endif; ?>
            <a href="<?php echo site_url('produk'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i class="fas fa-times me-1"></i>Hapus Semua Filter
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Daftar Produk -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php if (!empty($produks)): ?>
            <?php foreach ($produks as $index => $produk): ?>
                <div class="col" style="animation-delay: <?php echo $index * 0.05; ?>s;">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <?php 
                            $gambar_url = base_url('public/img/produk/' . htmlspecialchars($produk['gambar_produk']));
                            $placeholder_url = 'https://placehold.co/600x400/E2E8F0/3E2723?text=' . urlencode(substr($produk['nama_produk'], 0, 10));
                        ?>
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                           <a href="<?php echo site_url('produk/' . $produk['id']); ?>">
                                <img src="<?php echo $gambar_url; ?>" 
                                     onerror="this.onerror=null;this.src='<?php echo $placeholder_url; ?>';" 
                                     class="card-img-top w-100 h-100" 
                                     alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" 
                                     style="object-fit: cover;">
                            </a>
                           <span class="badge bg-primary position-absolute top-0 start-0 m-3 shadow-sm">
                               <?php echo htmlspecialchars($produk['nama_kategori']); ?>
                           </span>
                        </div>
                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="card-title fw-bold mb-2 flex-grow-1">
                                <a href="<?php echo site_url('produk/' . $produk['id']); ?>" 
                                   class="text-decoration-none text-dark stretched-link">
                                    <?php echo htmlspecialchars($produk['nama_produk']); ?>
                                </a>
                            </h6>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-store-alt fa-sm me-2 text-muted"></i>
                                <small class="text-muted"><?php echo htmlspecialchars($produk['nama_toko']); ?></small>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="fw-bold text-primary fs-5">
                                    Rp<?php echo number_format($produk['harga'], 0, ',', '.'); ?>
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
                <div class="empty-state">
                    <i class="fas fa-search fa-3x mb-3"></i>
                    <h5 class="fw-bold">Produk Tidak Ditemukan</h5>
                    <p class="text-muted mb-4">Tidak ada produk yang cocok dengan kriteria pencarian Anda. Coba ubah kata kunci atau filter.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="<?php echo site_url('produk'); ?>" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-refresh me-2"></i>Lihat Semua Produk
                        </a>
                        <a href="<?php echo site_url('toko'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                            <i class="fas fa-store-alt me-2"></i>Jelajahi Toko
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Pagination -->
    <?php if(isset($pagination) && !empty($pagination)): ?>
    <nav class="mt-5 d-flex justify-content-center">
        <div class="pagination-wrapper">
            <?php echo $pagination; ?>
        </div>
    </nav>
    <?php endif; ?>

    <!-- Suggestion Section -->
    <?php if (!empty($produks)): ?>
    <div class="mt-5">
        <div class="card border-0 shadow-soft p-4 text-center">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Tidak menemukan yang Anda cari?</h5>
                <p class="text-muted mb-4">Hubungi kami atau jelajahi kategori lainnya untuk menemukan produk yang sesuai dengan kebutuhan Anda.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="<?php echo site_url('toko'); ?>" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fas fa-store-alt me-2"></i>Lihat Toko
                    </a>
                    <a href="mailto:info@umkmBanggai.com" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-envelope me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
/* Additional styles for product list page */
.pagination-wrapper .pagination {
    gap: 0.25rem;
}

.pagination .page-item {
    margin: 0;
}

.pagination .page-link {
    border-radius: 50px !important;
    margin: 0 0.1rem;
    padding: 0.5rem 1rem;
    font-weight: 500;
    border: none;
    transition: all 0.3s ease;
}

.filter-tags .badge {
    font-size: 0.875rem;
    font-weight: 500;
}

/* Hover effect for filter removal */
.badge a:hover {
    text-decoration: none !important;
    opacity: 0.8;
}

/* Enhanced search input */
.input-group .form-control:focus {
    box-shadow: none;
    border-color: var(--primary);
}

.input-group .input-group-text {
    border-color: var(--primary);
}

.form-control:focus + .input-group-text {
    border-color: var(--primary);
}

/* Product card enhancements */
.product-card .card-img-top {
    transition: transform 0.5s ease;
}

.product-card:hover .card-img-top {
    transform: scale(1.1);
}

/* Badge positioning */
.badge {
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.025em;
}

@media (max-width: 768px) {
    .pagination-wrapper {
        overflow-x: auto;
        padding: 0.5rem 0;
    }
    
    .pagination {
        white-space: nowrap;
        margin: 0;
    }
}
</style>