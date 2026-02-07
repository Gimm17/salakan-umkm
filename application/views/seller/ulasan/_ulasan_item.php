<div class="ulasan-item border rounded p-3 mb-3 bg-white">
    <div class="row align-items-start">
        <!-- Customer Info -->
        <div class="col-md-2 text-center mb-3 mb-md-0">
            <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center text-white fw-bold mb-2" 
                 style="width: 50px; height: 50px;">
                <?php echo strtoupper(substr($ulasan['nama_user'], 0, 1)); ?>
            </div>
            <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($ulasan['nama_user']); ?></h6>
            <small class="text-muted">
                <i class="fas fa-calendar me-1"></i>
                <?php echo date('d M Y', strtotime($ulasan['created_at'])); ?>
            </small>
        </div>
        
        <!-- Product & Review Info -->
        <div class="col-md-7">
            <!-- Product Name -->
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-box me-2 text-primary"></i>
                <h6 class="fw-bold mb-0"><?php echo htmlspecialchars($ulasan['nama_produk']); ?></h6>
            </div>
            
            <!-- Rating -->
            <div class="d-flex align-items-center mb-3">
                <div class="rating-stars me-2">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo ($i <= $ulasan['rating']) ? 'text-warning' : 'text-muted'; ?>"></i>
                    <?php endfor; ?>
                </div>
                <span class="fw-bold me-2"><?php echo $ulasan['rating']; ?>/5</span>
                
                <!-- Status Badge -->
                <?php 
                $status_class = '';
                $status_text = '';
                $status_icon = '';
                
                switch($ulasan['status']) {
                    case 'approved':
                        $status_class = 'bg-success';
                        $status_text = 'Disetujui';
                        $status_icon = 'fas fa-check';
                        break;
                    case 'pending':
                        $status_class = 'bg-warning';
                        $status_text = 'Menunggu';
                        $status_icon = 'fas fa-clock';
                        break;
                    case 'rejected':
                        $status_class = 'bg-danger';
                        $status_text = 'Ditolak';
                        $status_icon = 'fas fa-times';
                        break;
                }
                ?>
                <span class="badge <?php echo $status_class; ?> rounded-pill px-3 py-2">
                    <i class="<?php echo $status_icon; ?> me-1"></i>
                    <?php echo $status_text; ?>
                </span>
            </div>
            
            <!-- Review Comment -->
            <div class="review-comment p-3 bg-light rounded">
                <p class="mb-0 text-muted lh-base">
                    <i class="fas fa-quote-left me-2"></i>
                    <?php echo nl2br(htmlspecialchars($ulasan['komentar'])); ?>
                    <i class="fas fa-quote-right ms-2"></i>
                </p>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="col-md-3 text-end">
            <div class="btn-group-vertical w-100" role="group">
                <?php if ($ulasan['status'] == 'pending'): ?>
                    <a href="<?php echo site_url('seller/setujui_ulasan/' . $ulasan['id']); ?>" 
                       class="btn btn-success btn-sm mb-2 btn-approve">
                        <i class="fas fa-check me-1"></i>Setujui
                    </a>
                    <a href="<?php echo site_url('seller/tolak_ulasan/' . $ulasan['id']); ?>" 
                       class="btn btn-warning btn-sm mb-2 btn-reject">
                        <i class="fas fa-times me-1"></i>Tolak
                    </a>
                <?php elseif ($ulasan['status'] == 'approved'): ?>
                    <a href="<?php echo site_url('seller/tolak_ulasan/' . $ulasan['id']); ?>" 
                       class="btn btn-warning btn-sm mb-2 btn-reject">
                        <i class="fas fa-times me-1"></i>Tolak
                    </a>
                <?php elseif ($ulasan['status'] == 'rejected'): ?>
                    <a href="<?php echo site_url('seller/setujui_ulasan/' . $ulasan['id']); ?>" 
                       class="btn btn-success btn-sm mb-2 btn-approve">
                        <i class="fas fa-check me-1"></i>Setujui
                    </a>
                <?php endif; ?>
                
                <a href="<?php echo site_url('seller/hapus_ulasan/' . $ulasan['id']); ?>" 
                   class="btn btn-danger btn-sm btn-delete">
                    <i class="fas fa-trash me-1"></i>Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.ulasan-item {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef !important;
}

.ulasan-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-color: #007bff !important;
}

.review-comment {
    border-left: 4px solid #007bff;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.btn-group-vertical .btn {
    border-radius: 0.375rem !important;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.btn-group-vertical .btn:last-child {
    margin-bottom: 0;
}

.rating-stars .fa-star {
    margin-right: 2px;
}

@media (max-width: 768px) {
    .btn-group-vertical {
        flex-direction: row !important;
        justify-content: center;
    }
    
    .btn-group-vertical .btn {
        margin-right: 0.5rem;
        margin-bottom: 0;
        flex: 1;
    }
    
    .btn-group-vertical .btn:last-child {
        margin-right: 0;
    }
}
</style>