<!-- application/views/seller/produk/create.php -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-plus-circle me-2 text-primary"></i>
                Tambah Produk Baru
            </h5>
            <a href="<?php echo site_url('seller/produk'); ?>" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Flash Messages -->
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php echo validation_errors('<div class="alert alert-warning alert-dismissible fade show"><i class="fas fa-exclamation-circle me-2"></i>', '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>'); ?>

        <?php echo form_open_multipart('seller/tambah_produk', ['id' => 'productForm']); ?>
            <!-- Basic Product Information -->
            <div class="row mb-4">
                <div class="col-12">
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Dasar Produk
                    </h6>
                </div>
            </div>

            <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">
                    Nama Produk <span class="text-danger">*</span>
                </label>
                <input type="text" 
                       name="nama_produk" 
                       id="nama_produk" 
                       class="form-control form-control-lg" 
                       value="<?php echo set_value('nama_produk'); ?>" 
                       placeholder="Masukkan nama produk yang menarik..."
                       required>
                <div class="form-text">
                    <i class="fas fa-lightbulb me-1"></i>
                    Gunakan nama yang jelas dan mudah dipahami pelanggan
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="id_kategori" class="form-label fw-semibold">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select name="id_kategori" id="id_kategori" class="form-select form-select-lg" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach($kategori as $kat): ?>
                        <option value="<?php echo $kat['id']; ?>" <?php echo set_select('id_kategori', $kat['id']); ?>>
                            <?php echo htmlspecialchars($kat['nama_kategori']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label fw-semibold">
                        Harga (Rp) <span class="text-danger">*</span>
                    </label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light">
                            <i class="fas fa-tag text-primary"></i>
                        </span>
                        <input type="number" 
                               name="harga" 
                               id="harga" 
                               class="form-control" 
                               value="<?php echo set_value('harga'); ?>" 
                               placeholder="15000" 
                               min="0"
                               step="500"
                               required>
                    </div>
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Masukkan harga dalam rupiah tanpa titik atau koma
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">
                    Deskripsi Produk
                </label>
                <textarea name="deskripsi" 
                          id="deskripsi" 
                          class="form-control" 
                          rows="4" 
                          placeholder="Ceritakan tentang produk Anda... (bahan, rasa, keunggulan, dll)"><?php echo set_value('deskripsi'); ?></textarea>
                <div class="form-text">
                    <i class="fas fa-edit me-1"></i>
                    Deskripsi yang detail akan membantu pelanggan memahami produk Anda
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status_produk" class="form-label fw-semibold">
                        Status Ketersediaan
                    </label>
                    <select name="status_produk" id="status_produk" class="form-select">
                        <option value="Tersedia" <?php echo set_select('status_produk', 'Tersedia', TRUE); ?>>
                            <i class="fas fa-check"></i> Tersedia
                        </option>
                        <option value="Habis" <?php echo set_select('status_produk', 'Habis'); ?>>
                            <i class="fas fa-times"></i> Habis
                        </option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="gambar_produk" class="form-label fw-semibold">
                        Gambar Produk <span class="text-danger">*</span>
                    </label>
                    <input type="file" 
                           name="gambar_produk" 
                           id="gambar_produk" 
                           class="form-control" 
                           accept="image/*"
                           required>
                    <div class="form-text">
                        <i class="fas fa-camera me-1"></i>
                        Format: JPG, PNG, GIF | Maksimal: 2MB
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                    </div>
                </div>
            </div>
            
            <!-- Delivery Links Section -->
            <hr class="my-4">
            <div class="row mb-4">
                <div class="col-12">
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="fas fa-link me-2"></i>
                        Link Pemesanan Online (Opsional)
                    </h6>
                    <p class="text-muted mb-3">
                        <i class="fas fa-info-circle me-1"></i>
                        Tambahkan link pemesanan dari platform delivery untuk memudahkan pelanggan memesan produk Anda
                    </p>
                </div>
            </div>

            <!-- Delivery Links -->
            <?php
            $links = [
                'whatsapp' => [
                    'label' => 'WhatsApp', 
                    'placeholder' => 'https://wa.me/628123456789?text=Halo, saya ingin memesan...',
                    'icon' => 'fab fa-whatsapp',
                    'color' => 'success'
                ],
                'gofood' => [
                    'label' => 'GoFood', 
                    'placeholder' => 'https://gofood.link/a/resto-name',
                    'icon' => 'fas fa-motorcycle',
                    'color' => 'success'
                ],
                'grabfood' => [
                    'label' => 'GrabFood', 
                    'placeholder' => 'https://food.grab.com/id/en/restaurant/...',
                    'icon' => 'fas fa-utensils',
                    'color' => 'success'
                ],
                'shopeefood' => [
                    'label' => 'ShopeeFood', 
                    'placeholder' => 'https://shopeefood.co.id/restaurant/...',
                    'icon' => 'fas fa-shopping-bag',
                    'color' => 'warning'
                ],
                'maxim' => [
                    'label' => 'Maxim Food', 
                    'placeholder' => 'https://maximfood.id/restaurant/...',
                    'icon' => 'fas fa-car',
                    'color' => 'info'
                ]
            ];
            
            foreach($links as $key => $val): ?>
            <div class="mb-3">
                <div class="card border-light">
                    <div class="card-body p-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input link-enabler" 
                                   type="checkbox" 
                                   name="enable_link_<?php echo $key; ?>" 
                                   id="enable_link_<?php echo $key; ?>" 
                                   data-bs-target="#container_link_<?php echo $key; ?>">
                            <label class="form-check-label fw-semibold" for="enable_link_<?php echo $key; ?>">
                                <i class="<?php echo $val['icon']; ?> me-2 text-<?php echo $val['color']; ?>"></i>
                                Aktifkan Link <?php echo $val['label']; ?>
                            </label>
                        </div>
                        <div id="container_link_<?php echo $key; ?>" style="display: none;" class="mt-2">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="<?php echo $val['icon']; ?> text-<?php echo $val['color']; ?>"></i>
                                </span>
                                <input type="url" 
                                       name="link_<?php echo $key; ?>" 
                                       class="form-control" 
                                       placeholder="<?php echo $val['placeholder']; ?>">
                            </div>
                            <div class="form-text">
                                <small>Pastikan link dapat diakses dan mengarah ke halaman produk Anda</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Action Buttons -->
            <hr class="my-4">
            <div class="d-flex gap-3 justify-content-end">
                <a href="<?php echo site_url('seller/produk'); ?>" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary btn-lg px-4" id="submitBtn">
                    <i class="fas fa-save me-2"></i>Simpan Produk
                </button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
$(document).ready(function(){
    // Image preview functionality
    $('#gambar_produk').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
                $('#imagePreview').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#imagePreview').hide();
        }
    });

    // Toggle delivery links
    $('.link-enabler').on('change', function(){
        const target = $(this).data('bs-target');
        if(this.checked) {
            $(target).slideDown(300);
            $(target).find('input').focus();
        } else {
            $(target).slideUp(300);
            $(target).find('input').val('');
        }
    });

    // Form validation enhancement
    $('#productForm').on('submit', function(e) {
        let isValid = true;
        
        // Check required fields
        $('input[required], select[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
            }
        });

        // Check image file
        const fileInput = $('#gambar_produk')[0];
        if (!fileInput.files[0]) {
            $('#gambar_produk').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Form Tidak Lengkap',
                text: 'Mohon lengkapi semua field yang wajib diisi!',
                confirmButtonColor: '#e74c3c'
            });
            return false;
        }

        // Show loading state
        const submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
    });

    // Real-time validation
    $('input, select, textarea').on('blur', function() {
        if ($(this).prop('required') && !$(this).val()) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Price formatting
    $('#harga').on('input', function() {
        let value = $(this).val().replace(/[^\d]/g, '');
        if (value) {
            // Show formatted preview
            const formatted = new Intl.NumberFormat('id-ID').format(value);
            $(this).attr('title', 'Rp ' + formatted);
        }
    });

    // Auto-resize textarea
    $('#deskripsi').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});
</script>

<style>
/* Enhanced form styling */
.form-control:focus,
.form-select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(226, 125, 96, 0.25);
}

.form-control.is-valid {
    border-color: #28a745;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

/* Card hover effects */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

/* Image preview styling */
#imagePreview {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Switch styling */
.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

/* Button enhancements */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.btn-primary:hover {
    box-shadow: 0 6px 20px rgba(226, 125, 96, 0.4);
}

/* Responsive design */
@media (max-width: 768px) {
    .d-flex.gap-3 {
        flex-direction: column;
    }
    
    .btn-lg {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>