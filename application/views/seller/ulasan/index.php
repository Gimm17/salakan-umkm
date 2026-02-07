<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="fw-bold mb-1">
                        <i class="fas fa-comments me-2 text-primary"></i>
                        Ulasan Produk
                    </h4>
                    <p class="text-muted mb-0">Kelola ulasan dari pelanggan untuk produk-produk Anda</p>
                </div>
                <div>
                    <span class="badge bg-primary rounded-pill px-3 py-2">
                        <?php echo count($ulasan_toko); ?> Total Ulasan
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <?php 
        $total_ulasan = count($ulasan_toko);
        $approved = array_filter($ulasan_toko, function($u) { return $u['status'] == 'approved'; });
        $pending = array_filter($ulasan_toko, function($u) { return $u['status'] == 'pending'; });
        $rejected = array_filter($ulasan_toko, function($u) { return $u['status'] == 'rejected'; });
        
        $avg_rating = 0;
        if (!empty($approved)) {
            $total_rating = array_sum(array_column($approved, 'rating'));
            $avg_rating = round($total_rating / count($approved), 1);
        }
        ?>
        
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-2" 
                         style="width: 40px; height: 40px;">
                        <i class="fas fa-comments text-white"></i>
                    </div>
                    <h5 class="fw-bold"><?php echo $total_ulasan; ?></h5>
                    <small class="text-muted">Total Ulasan</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <div class="rounded-circle bg-success d-inline-flex align-items-center justify-content-center mb-2" 
                         style="width: 40px; height: 40px;">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <h5 class="fw-bold"><?php echo count($approved); ?></h5>
                    <small class="text-muted">Disetujui</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <div class="rounded-circle bg-warning d-inline-flex align-items-center justify-content-center mb-2" 
                         style="width: 40px; height: 40px;">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                    <h5 class="fw-bold"><?php echo count($pending); ?></h5>
                    <small class="text-muted">Menunggu</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body">
                    <div class="rounded-circle bg-warning d-inline-flex align-items-center justify-content-center mb-2" 
                         style="width: 40px; height: 40px;">
                        <i class="fas fa-star text-white"></i>
                    </div>
                    <h5 class="fw-bold"><?php echo $avg_rating; ?></h5>
                    <small class="text-muted">Rating Rata-rata</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Ulasan List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pb-0">
                    <ul class="nav nav-tabs card-header-tabs" id="ulasanTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="semua-tab" data-bs-toggle="tab" href="#semua">
                                <i class="fas fa-list me-2"></i>Semua (<?php echo $total_ulasan; ?>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="approved-tab" data-bs-toggle="tab" href="#approved">
                                <i class="fas fa-check me-2"></i>Disetujui (<?php echo count($approved); ?>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending">
                                <i class="fas fa-clock me-2"></i>Menunggu (<?php echo count($pending); ?>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected">
                                <i class="fas fa-times me-2"></i>Ditolak (<?php echo count($rejected); ?>)
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Tab Semua Ulasan -->
                        <div class="tab-pane fade show active" id="semua">
                            <?php if (!empty($ulasan_toko)): ?>
                                <?php foreach ($ulasan_toko as $ulasan): ?>
                                    <?php echo $this->load->view('seller/ulasan/_ulasan_item', ['ulasan' => $ulasan], true); ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                    <h6>Belum Ada Ulasan</h6>
                                    <p class="text-muted">Produk Anda belum mendapat ulasan dari pelanggan.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Tab Approved -->
                        <div class="tab-pane fade" id="approved">
                            <?php if (!empty($approved)): ?>
                                <?php foreach ($approved as $ulasan): ?>
                                    <?php echo $this->load->view('seller/ulasan/_ulasan_item', ['ulasan' => $ulasan], true); ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-check fa-3x text-muted mb-3"></i>
                                    <h6>Belum Ada Ulasan Disetujui</h6>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Tab Pending -->
                        <div class="tab-pane fade" id="pending">
                            <?php if (!empty($pending)): ?>
                                <?php foreach ($pending as $ulasan): ?>
                                    <?php echo $this->load->view('seller/ulasan/_ulasan_item', ['ulasan' => $ulasan], true); ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                                    <h6>Tidak Ada Ulasan Menunggu</h6>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Tab Rejected -->
                        <div class="tab-pane fade" id="rejected">
                            <?php if (!empty($rejected)): ?>
                                <?php foreach ($rejected as $ulasan): ?>
                                    <?php echo $this->load->view('seller/ulasan/_ulasan_item', ['ulasan' => $ulasan], true); ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-times fa-3x text-muted mb-3"></i>
                                    <h6>Tidak Ada Ulasan Ditolak</h6>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Konfirmasi sebelum mengubah status ulasan
    document.addEventListener('click', function(e) {
        if (e.target.matches('.btn-approve') || e.target.closest('.btn-approve')) {
            e.preventDefault();
            const btn = e.target.matches('.btn-approve') ? e.target : e.target.closest('.btn-approve');
            const href = btn.href;
            
            Swal.fire({
                title: 'Setujui Ulasan?',
                text: 'Ulasan ini akan ditampilkan di halaman produk.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        }
        
        if (e.target.matches('.btn-reject') || e.target.closest('.btn-reject')) {
            e.preventDefault();
            const btn = e.target.matches('.btn-reject') ? e.target : e.target.closest('.btn-reject');
            const href = btn.href;
            
            Swal.fire({
                title: 'Tolak Ulasan?',
                text: 'Ulasan ini tidak akan ditampilkan di halaman produk.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        }
        
        if (e.target.matches('.btn-delete') || e.target.closest('.btn-delete')) {
            e.preventDefault();
            const btn = e.target.matches('.btn-delete') ? e.target : e.target.closest('.btn-delete');
            const href = btn.href;
            
            Swal.fire({
                title: 'Hapus Ulasan?',
                text: 'Ulasan akan dihapus permanen dari sistem.',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        }
    });
});
</script>

<style>
/* Card hover effects */
.card {
    transition: all 0.3s ease;
}

/* Tab styling */
.nav-tabs .nav-link {
    border: none;
    background: transparent;
    color: #6c757d;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    background: transparent;
    color: #007bff;
    border-bottom: 2px solid #007bff;
}

.nav-tabs .nav-link:hover {
    border: none;
    background: rgba(0,123,255,0.1);
    color: #007bff;
}

/* Statistics cards */
.rounded-circle {
    transition: transform 0.3s ease;
}

.card:hover .rounded-circle {
    transform: scale(1.1);
}

/* Button styling */
.btn-sm {
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

.btn-approve:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-reject:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
}

.btn-delete:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
}

/* Rating stars */
.rating-stars .fa-star {
    margin-right: 2px;
}

/* Responsive design */
@media (max-width: 768px) {
    .btn-group {
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    
    .btn-group .btn {
        margin-bottom: 0.25rem;
        border-radius: 0.25rem !important;
    }
    
    .btn-group .btn:last-child {
        margin-bottom: 0;
    }
}
</style>