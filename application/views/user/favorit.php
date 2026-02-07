<!-- application/views/user/favorit.php -->
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom-0">
        <h5 class="mb-0 fw-bold text-dark">Produk Favorit Saya</h5>
    </div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            
            <?php if (!empty($produk_favorit)): ?>
                <?php foreach ($produk_favorit as $produk): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-light product-card">
                            <?php 
                                // Cek apakah gambar ada, jika tidak gunakan placeholder
                                $gambar_url = base_url('public/img/produk/' . htmlspecialchars($produk['gambar_produk']));
                                $placeholder_url = 'https://placehold.co/600x400/E2E8F0/4A5568?text=Produk';
                            ?>
                            <a href="<?php echo site_url('produk/' . $produk['id']); ?>" class="text-decoration-none">
                                <img src="<?php echo $gambar_url; ?>" 
                                     onerror="this.onerror=null;this.src='<?php echo $placeholder_url; ?>';"
                                     class="card-img-top" 
                                     alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>" 
                                     style="height: 180px; object-fit: cover;">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-bold text-dark mb-1" style="flex-grow: 1;">
                                    <a href="<?php echo site_url('produk/' . $produk['id']); ?>" class="text-decoration-none text-dark stretched-link">
                                        <?php echo htmlspecialchars($produk['nama_produk']); ?>
                                    </a>
                                </h6>
                                <p class="card-text text-muted small mb-2">
                                    <i class="fas fa-store-alt fa-sm me-1 text-secondary"></i>
                                    <?php echo htmlspecialchars($produk['nama_toko']); ?>
                                </p>
                                <p class="card-text fs-5 fw-bolder text-primary mb-0">
                                    Rp<?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                 <div class="col-12">
                    <div class="text-center p-5 bg-light rounded">
                        <i class="fas fa-heart-crack fa-3x mb-3 text-danger"></i>
                        <h5 class="fw-bold">Anda Belum Punya Favorit</h5>
                        <p class="text-muted">Jelajahi produk-produk menarik di UMKM Banggai dan tandai sebagai favorit!</p>
                        <a href="<?php echo site_url(); ?>" class="btn btn-primary mt-2">
                            Mulai Menjelajah
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<style>
    .product-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: .75rem; /* Sudut lebih bulat */
        overflow: hidden; /* Pastikan gambar tidak keluar dari sudut */
    }
    .product-card:hover {
        transform: translateY(-8px); /* Efek mengangkat lebih terasa */
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
</style>
