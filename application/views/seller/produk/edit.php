<!-- application/views/seller/produk/edit.php -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fas fa-edit me-2 text-primary"></i>
                Edit Produk
            </h5>
            <div class="d-flex gap-2">
                <a href="<?php echo site_url('produk/' . $produk['id']); ?>" 
                   class="btn btn-outline-info btn-sm rounded-pill" 
                   target="_blank">
                    <i class="fas fa-eye me-1"></i>Lihat Produk
                </a>
                <a href="<?php echo site_url('seller/produk'); ?>" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
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

        <?php echo form_open_multipart('seller/edit_produk/' . $produk['id'], ['id' => 'editProductForm']); ?>
            <!-- Current Product Info -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Produk Saat Ini
                    </h6>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge bg-<?php echo ($produk['status_produk'] == 'Tersedia') ? 'success' : 'warning'; ?> px-3 py-2">
                        <i class="fas fa-<?php echo ($produk['status_produk'] == 'Tersedia') ? 'check' : 'exclamation'; ?> me-1"></i>
                        <?php echo $produk['status_produk']; ?>
                    </span>
                </div>
            </div>

            <!-- Current Product Image -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card border-light">
                        <div class="card-body text-center p-2">
                            <small class="text-muted d-block mb-2">Gambar Saat Ini</small>
                            <?php 
                                $current_image = base_url('public/img/produk/' . htmlspecialchars($produk['gambar_produk']));
                                $placeholder = 'https://placehold.co/200x200/E2E8F0/4A5568?text=Produk';
                            ?>
                            <img src="<?php echo $current_image; ?>" 
                                 onerror="this.onerror=null;this.src='<?php echo $placeholder; ?>';"
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 120px; object-fit: cover;"
                                 alt="<?php echo htmlspecialchars($produk['nama_produk']); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="bg-light p-3 rounded">
                        <h6 class="mb-1"><?php echo htmlspecialchars($produk['nama_produk']); ?></h6>
                        <p class="text-muted mb-1">
                            <i class="fas fa-tag me-1"></i>
                            Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
                        </p>
                        <p class="text-muted mb-0 small">
                            <?php 
                            // Alternatif untuk character_limiter() tanpa helper
                            $description = $produk['deskripsi'];
                            if (strlen($description) > 100) {
                                echo substr($description, 0, 100) . '...';
                            } else {
                                echo $description;
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">
                    Nama Produk <span class="text-danger">*</span>
                </label>
                <input type="text" 
                       name="nama_produk" 
                       id="nama_produk" 
                       class="form-control form-control-lg" 
                       value="<?php echo htmlspecialchars($produk['nama_produk']); ?>" 
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
                        <?php foreach($kategori as $kat): ?>
                        <option value="<?php echo $kat['id']; ?>" <?php if($produk['id_kategori'] == $kat['id']) echo 'selected'; ?>>
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
                               value="<?php echo htmlspecialchars($produk['harga']); ?>" 
                               min="0"
                               step="500"
                               required>
                    </div>
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Harga saat ini: Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?>
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
                          placeholder="Ceritakan tentang produk Anda..."><?php echo htmlspecialchars($produk['deskripsi']); ?></textarea>
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
                        <option value="Tersedia" <?php if($produk['status_produk'] == 'Tersedia') echo 'selected'; ?>>
                            ✅ Tersedia
                        </option>
                        <option value="Habis" <?php if($produk['status_produk'] == 'Habis') echo 'selected'; ?>>
                            ❌ Habis
                        </option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="gambar_produk" class="form-label fw-semibold">
                        Ganti Gambar Produk (Opsional)
                    </label>
                    <input type="file" 
                           name="gambar_produk" 
                           id="gambar_produk" 
                           class="form-control" 
                           accept="image/*">
                    <div class="form-text">
                        <i class="fas fa-camera me-1"></i>
                        Format: JPG, PNG, GIF | Maksimal: 2MB | Kosongkan jika tidak ingin mengubah
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <small class="text-muted d-block mb-1">Preview Gambar Baru:</small>
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
                        Link Pemesanan Online
                    </h6>
                    <p class="text-muted mb-3">
                        <i class="fas fa-info-circle me-1"></i>
                        Update atau tambahkan link pemesanan dari platform delivery
                    </p>
                </div>
            </div>

            <!-- Delivery Links -->
            <?php
            $links_edit = [
                'whatsapp' => [
                    'label' => 'WhatsApp', 
                    'value' => $produk['link_whatsapp'],
                    'placeholder' => 'https://wa.me/628123456789?text=Halo, saya ingin memesan...',
                    'icon' => 'fab fa-whatsapp',
                    'color' => 'success'
                ],
                'gofood' => [
                    'label' => 'GoFood', 
                    'value' => $produk['link_gofood'],
                    'placeholder' => 'https://gofood.link/a/resto-name',
                    'icon' => 'fas fa-motorcycle',
                    'color' => 'success'
                ],
                'grabfood' => [
                    'label' => 'GrabFood', 
                    'value' => $produk['link_grabfood'],
                    'placeholder' => 'https://food.grab.com/id/en/restaurant/...',
                    'icon' => 'fas fa-utensils',
                    'color' => 'success'
                ],
                'shopeefood' => [
                    'label' => 'ShopeeFood', 
                    'value' => $produk['link_shopeefood'],
                    'placeholder' => 'https://shopeefood.co.id/restaurant/...',
                    'icon' => 'fas fa-shopping-bag',
                    'color' => 'warning'
                ],
                'maxim' => [
                    'label' => 'Maxim Food', 
                    'value' => $produk['link_maxim'],
                    'placeholder' => 'https://maximfood.id/restaurant/...',
                    'icon' => 'fas fa-car',
                    'color' => 'info'
                ]
            ];
            
            foreach($links_edit as $key => $val): 
                $is_enabled = !empty($val['value']);
            ?>
            <div class="mb-3">
                <div class="card border-light">
                    <div class="card-body p-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input link-enabler" 
                                   type="checkbox" 
                                   name="enable_link_<?php echo $key; ?>" 
                                   id="enable_link_<?php echo $key; ?>" 
                                   data-bs-target="#container_link_<?php echo $key; ?>" 
                                   <?php if($is_enabled) echo 'checked'; ?>>
                            <label class="form-check-label fw-semibold" for="enable_link_<?php echo $key; ?>">
                                <i class="<?php echo $val['icon']; ?> me-2 text-<?php echo $val['color']; ?>"></i>
                                Aktifkan Link <?php echo $val['label']; ?>
                            </label>
                        </div>
                        <div id="container_link_<?php echo $key; ?>" style="<?php echo $is_enabled ? 'display:block;' : 'display:none;'; ?>" class="mt-2">
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="<?php echo $val['icon']; ?> text-<?php echo $val['color']; ?>"></i>
                                </span>
                                <input type="url" 
                                       name="link_<?php echo $key; ?>" 
                                       class="form-control" 
                                       value="<?php echo htmlspecialchars($val['value'] ?? ''); ?>"
                                       placeholder="<?php echo $val['placeholder']; ?>">
                            </div>
                            <div class="form-text">
                                <small>
                                    <?php if ($is_enabled): ?>
                                        <i class="fas fa-check-circle text-success me-1"></i>
                                        Link aktif - pelanggan dapat memesan melalui <?php echo $val['label']; ?>
                                    <?php else: ?>
                                        <i class="fas fa-info-circle me-1"></i>
                                        Pastikan link dapat diakses dan mengarah ke halaman produk Anda
                                    <?php endif; ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- Action Buttons -->
            <hr class="my-4">
            <div class="d-flex gap-3 justify-content-between">
                <div>
                    <a href="<?php echo site_url('seller/produk'); ?>" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?php echo site_url('seller/hapus_produk/' . $produk['id']); ?>" 
                       class="btn btn-outline-danger btn-lg px-4"
                       onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')">
                        <i class="fas fa-trash me-2"></i>Hapus Produk
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4" id="updateBtn">
                        <i class="fas fa-save me-2"></i>Update Produk
                    </button>
                </div>
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
    $('#editProductForm').on('submit', function(e) {
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
        const updateBtn = $('#updateBtn');
        updateBtn.prop('disabled', true);
        updateBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...');
    });

    // Real-time validation
    $('input, select, textarea').on('blur', function() {
        if ($(this).prop('required') && !$(this).val()) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Price formatting with comparison
    $('#harga').on('input', function() {
        let value = $(this).val().replace(/[^\d]/g, '');
        if (value) {
            const formatted = new Intl.NumberFormat('id-ID').format(value);
            const currentPrice = <?php echo $produk['harga']; ?>;
            const newPrice = parseInt(value);
            
            let comparison = '';
            if (newPrice > currentPrice) {
                comparison = ' (↑ naik Rp ' + new Intl.NumberFormat('id-ID').format(newPrice - currentPrice) + ')';
            } else if (newPrice < currentPrice) {
                comparison = ' (↓ turun Rp ' + new Intl.NumberFormat('id-ID').format(currentPrice - newPrice) + ')';
            }
            
            $(this).attr('title', 'Rp ' + formatted + comparison);
        }
    });

    // Auto-resize textarea
    $('#deskripsi').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Show changes indicator
    let originalValues = {};
    
    // Store original values
    $('input, select, textarea').each(function() {
        originalValues[$(this).attr('name')] = $(this).val();
    });
    
    // Track changes
    $('input, select, textarea').on('input change', function() {
        const fieldName = $(this).attr('name');
        const currentValue = $(this).val();
        
        if (originalValues[fieldName] !== currentValue) {
            $(this).addClass('changed');
            $(this).closest('.mb-3').find('.form-label').addClass('text-primary fw-bold');
        } else {
            $(this).removeClass('changed');
            $(this).closest('.mb-3').find('.form-label').removeClass('text-primary fw-bold');
        }
        
        // Show unsaved changes indicator
        if ($('.changed').length > 0) {
            if (!$('#unsaved-indicator').length) {
                $('.card-header').append('<span id="unsaved-indicator" class="badge bg-warning text-dark ms-2">Ada perubahan belum disimpan</span>');
            }
        } else {
            $('#unsaved-indicator').remove();
        }
    });

    // Warn before leaving page with unsaved changes
    $(window).on('beforeunload', function() {
        if ($('.changed').length > 0) {
            return 'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman ini?';
        }
    });

    // Remove warning when form is submitted
    $('#editProductForm').on('submit', function() {
        $(window).off('beforeunload');
    });
});
</script>

<style>
/* Enhanced form styling - konsisten dengan create.php */
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

.form-control.changed {
    border-color: var(--primary);
    background-color: rgba(226, 125, 96, 0.05);
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

/* Current product info styling */
.bg-light {
    background-color: #f8f9fa !important;
    border: 1px solid #e9ecef;
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

.btn-outline-danger:hover {
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
}

/* Status badge */
.badge {
    font-size: 0.875rem;
    font-weight: 600;
}

/* Unsaved changes indicator */
#unsaved-indicator {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.7; }
    100% { opacity: 1; }
}

/* Form label changes indicator */
.form-label.text-primary.fw-bold {
    position: relative;
}

.form-label.text-primary.fw-bold::after {
    content: '*';
    color: var(--primary);
    margin-left: 4px;
    font-weight: bold;
}

/* Responsive design */
@media (max-width: 768px) {
    .d-flex.gap-3.justify-content-between {
        flex-direction: column;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-lg {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .d-flex.gap-2 .btn-lg:last-child {
        margin-bottom: 0;
    }
}

/* Current image display */
.card.border-light {
    border: 2px solid #e9ecef !important;
    transition: border-color 0.3s ease;
}

.card.border-light:hover {
    border-color: var(--primary) !important;
}
</style>