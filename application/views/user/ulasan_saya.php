<!-- application/views/user/ulasan_saya.php -->
<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom-0">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-star me-2 text-warning"></i>
                Ulasan Saya
            </h5>
            <span class="badge bg-gradient-primary text-white px-3 py-2">
                <?php echo count($ulasan_saya); ?> Ulasan
            </span>
        </div>
    </div>
    <div class="card-body">

    <div class="card-body">
        <!-- Ulasan List -->
        <?php if (!empty($ulasan_saya)): ?>
            <div class="row g-4">
                <?php foreach ($ulasan_saya as $ulasan): ?>
                <div class="col-12">
                    <div class="card h-100 shadow-sm border-light">
                        <div class="card-body">
                            <div class="row align-items-start">
                                <!-- Product Image -->
                                <div class="col-md-2 text-center mb-3 mb-md-0">
                                    <?php 
                                        $gambar_url = base_url('public/img/produk/' . htmlspecialchars($ulasan['gambar_produk']));
                                        $placeholder_url = 'https://placehold.co/150x150/E2E8F0/4A5568?text=' . urlencode(substr($ulasan['nama_produk'], 0, 5));
                                    ?>
                                    <img src="<?php echo $gambar_url; ?>" 
                                         onerror="this.onerror=null;this.src='<?php echo $placeholder_url; ?>';" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height: 100px; object-fit: cover;"
                                         alt="<?php echo htmlspecialchars($ulasan['nama_produk']); ?>">
                                </div>
                                
                                <!-- Product & Review Info -->
                                <div class="col-md-7">
                                    <h6 class="fw-bold mb-2">
                                        <a href="<?php echo site_url('produk/' . $ulasan['id_produk']); ?>" 
                                           class="text-decoration-none text-dark">
                                            <?php echo htmlspecialchars($ulasan['nama_produk']); ?>
                                        </a>
                                    </h6>
                                    
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-store me-2 text-muted"></i>
                                        <small class="text-muted me-3"><?php echo htmlspecialchars($ulasan['nama_toko']); ?></small>
                                        
                                        <div class="rating-stars me-3">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star <?php echo ($i <= $ulasan['rating']) ? 'text-warning' : 'text-muted'; ?> fa-sm"></i>
                                            <?php endfor; ?>
                                        </div>
                                        
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?php echo date('d M Y', strtotime($ulasan['created_at'])); ?>
                                        </small>
                                    </div>
                                    
                                    <div class="review-content mb-3 p-3 bg-light rounded">
                                        <p class="mb-0 text-muted lh-base">
                                            <i class="fas fa-quote-left me-2 text-secondary"></i>
                                            <?php echo nl2br(htmlspecialchars($ulasan['komentar'])); ?>
                                        </p>
                                    </div>
                                    
                                    <!-- Status Badge -->
                                    <?php 
                                    $status_class = '';
                                    $status_text = '';
                                    $status_icon = '';
                                    
                                    switch($ulasan['status']) {
                                        case 'approved':
                                            $status_class = 'bg-gradient-success';
                                            $status_text = 'Disetujui';
                                            $status_icon = 'fas fa-check';
                                            break;
                                        case 'pending':
                                            $status_class = 'bg-gradient-warning';
                                            $status_text = 'Menunggu Persetujuan';
                                            $status_icon = 'fas fa-clock';
                                            break;
                                        case 'rejected':
                                            $status_class = 'bg-gradient-danger';
                                            $status_text = 'Ditolak';
                                            $status_icon = 'fas fa-times';
                                            break;
                                    }
                                    ?>
                                    <span class="badge <?php echo $status_class; ?> text-white px-3 py-2">
                                        <i class="<?php echo $status_icon; ?> me-1"></i>
                                        <?php echo $status_text; ?>
                                    </span>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="col-md-3 text-end">
                                    <div class="d-grid gap-2">
                                        <button type="button" 
                                                class="btn btn-outline-primary btn-sm edit-review-btn"
                                                data-id="<?php echo $ulasan['id']; ?>"
                                                data-rating="<?php echo $ulasan['rating']; ?>"
                                                data-komentar="<?php echo htmlspecialchars($ulasan['komentar']); ?>"
                                                data-produk="<?php echo htmlspecialchars($ulasan['nama_produk']); ?>">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                        
                                        <button type="button" 
                                                class="btn btn-outline-danger btn-sm delete-review-btn"
                                                data-id="<?php echo $ulasan['id']; ?>"
                                                data-produk="<?php echo htmlspecialchars($ulasan['nama_produk']); ?>">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center p-5 bg-light rounded">
                <i class="fas fa-star fa-4x text-muted mb-4"></i>
                <h5 class="fw-bold mb-3">Belum Ada Ulasan</h5>
                <p class="text-muted mb-4">
                    Anda belum memberikan ulasan apapun. Mulai berbelanja dan berikan ulasan 
                    untuk membantu pembeli lain membuat keputusan yang tepat.
                </p>
                <a href="<?php echo site_url('produk'); ?>" class="btn btn-primary">
                    <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Edit Review Modal -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Ulasan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editReviewForm">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="csrf-token-edit">
                    <input type="hidden" name="id_ulasan" id="editUlasanId">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Produk</label>
                        <p class="text-muted" id="editProdukNama"></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Rating</label>
                        <div class="rating-input-edit">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="far fa-star rating-star-edit" data-rating="<?php echo $i; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" id="editSelectedRating" value="0">
                    </div>
                    
                    <div class="mb-3">
                        <label for="editKomentar" class="form-label fw-semibold">Komentar</label>
                        <textarea class="form-control" id="editKomentar" name="komentar" rows="4" 
                                placeholder="Ceritakan pengalaman Anda dengan produk ini..." required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveEditReview">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit Review Modal
    const editReviewModal = new bootstrap.Modal(document.getElementById('editReviewModal'));
    const editReviewBtns = document.querySelectorAll('.edit-review-btn');
    const editRatingStars = document.querySelectorAll('.rating-star-edit');
    const editSelectedRatingInput = document.getElementById('editSelectedRating');
    
    // Edit button handlers
    editReviewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const rating = parseInt(this.dataset.rating);
            const komentar = this.dataset.komentar;
            const produk = this.dataset.produk;
            
            document.getElementById('editUlasanId').value = id;
            document.getElementById('editProdukNama').textContent = produk;
            document.getElementById('editKomentar').value = komentar;
            editSelectedRatingInput.value = rating;
            
            // Set stars
            setEditStars(rating);
            
            editReviewModal.show();
        });
    });
    
    // Rating functionality for edit modal
    editRatingStars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = parseInt(this.dataset.rating);
            highlightEditStars(rating);
        });
        
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            editSelectedRatingInput.value = rating;
            setEditStars(rating);
        });
    });
    
    document.querySelector('.rating-input-edit').addEventListener('mouseleave', function() {
        const currentRating = parseInt(editSelectedRatingInput.value);
        if (currentRating > 0) {
            setEditStars(currentRating);
        } else {
            resetEditStars();
        }
    });
    
    function highlightEditStars(rating) {
        editRatingStars.forEach((star, index) => {
            if (index < rating) {
                star.className = 'fas fa-star rating-star-edit text-warning';
            } else {
                star.className = 'far fa-star rating-star-edit text-muted';
            }
        });
    }
    
    function setEditStars(rating) {
        editRatingStars.forEach((star, index) => {
            if (index < rating) {
                star.className = 'fas fa-star rating-star-edit text-warning';
            } else {
                star.className = 'far fa-star rating-star-edit text-muted';
            }
        });
    }
    
    function resetEditStars() {
        editRatingStars.forEach(star => {
            star.className = 'far fa-star rating-star-edit text-muted';
        });
    }
    
    // Save edit review
    document.getElementById('saveEditReview').addEventListener('click', function() {
        const rating = parseInt(editSelectedRatingInput.value);
        const komentar = document.getElementById('editKomentar').value.trim();
        
        if (rating === 0) {
            Swal.fire('Peringatan', 'Silakan pilih rating terlebih dahulu.', 'warning');
            return;
        }
        
        if (komentar.length < 10) {
            Swal.fire('Peringatan', 'Komentar minimal 10 karakter.', 'warning');
            return;
        }
        
        const originalText = this.innerHTML;
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        
        const formData = new FormData(document.getElementById('editReviewForm'));
        
        fetch('<?php echo site_url("user/edit_ulasan"); ?>', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('csrf-token-edit').value = data.csrf_hash;
            
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
            Swal.fire('Oops...', 'Terjadi kesalahan saat menyimpan ulasan.', 'error');
        })
        .finally(() => {
            this.disabled = false;
            this.innerHTML = originalText;
        });
    });
    
    // Delete review handlers
    const deleteReviewBtns = document.querySelectorAll('.delete-review-btn');
    deleteReviewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const produk = this.dataset.produk;
            
            Swal.fire({
                title: 'Hapus Ulasan?',
                text: `Anda yakin ingin menghapus ulasan untuk "${produk}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('id_ulasan', id);
                    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
                    
                    fetch('<?php echo site_url("user/hapus_ulasan"); ?>', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(response => response.json())
                    .then(data => {
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
                        Swal.fire('Oops...', 'Terjadi kesalahan saat menghapus ulasan.', 'error');
                    });
                }
            });
        });
    });
});
</script>

<style>
/* Card hover effects - konsisten dengan favorit.php */
.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    border-radius: .75rem;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 0.8rem 1.5rem rgba(0,0,0,.1) !important;
}

/* Rating stars styling */
.rating-input-edit {
    cursor: pointer;
}

.rating-star-edit {
    font-size: 1.5rem;
    margin-right: 0.25rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.rating-star-edit:hover {
    transform: scale(1.1);
}

/* Review content styling - konsisten dengan style existing */
.review-content {
    border-left: 4px solid #007bff;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Status badges dengan gradient - sesuai dengan dashboard_content.php */
.bg-gradient-success { 
    background-image: linear-gradient(310deg, #28a745 0%, #20c997 100%); 
}
.bg-gradient-warning { 
    background-image: linear-gradient(310deg, #ffc107 0%, #fd7e14 100%); 
}
.bg-gradient-danger { 
    background-image: linear-gradient(310deg, #dc3545 0%, #e83e8c 100%); 
}
.bg-gradient-primary { 
    background-image: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%); 
}

/* Button styling */
.btn-sm {
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(94, 114, 228, 0.3);
}

.btn-outline-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

/* Rating stars */
.rating-stars .fa-star {
    margin-right: 2px;
}

/* Modal enhancements - konsisten dengan existing style */
.modal-content {
    border: none;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    border-radius: .75rem;
}

.modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    border-radius: .75rem .75rem 0 0;
}

/* Image styling - konsisten dengan favorit.php */
.img-fluid {
    transition: transform 0.3s ease;
}

.img-fluid:hover {
    transform: scale(1.05);
}

/* Responsive design */
@media (max-width: 768px) {
    .d-grid .btn {
        margin-bottom: 0.5rem;
    }
    
    .rating-star-edit {
        font-size: 1.25rem;
    }
    
    .card:hover {
        transform: translateY(-4px); /* Efek hover lebih subtle di mobile */
    }
}
</style>
</style>