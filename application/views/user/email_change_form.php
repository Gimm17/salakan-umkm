<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-envelope-fill me-2"></i>Ganti Email</h5>
                </div>
                <div class="card-body">
                    
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        Email saat ini: <strong><?= htmlspecialchars($user['email']); ?></strong>
                    </div>
                    
                    <form action="<?= site_url('user/email_change_request'); ?>" method="post">
                        <div class="mb-3">
                            <label for="new_email" class="form-label">Email Baru</label>
                            <input type="email" class="form-control" id="new_email" name="new_email" 
                                   placeholder="Masukkan email baru Anda"
                                   value="<?= set_value('new_email'); ?>" required>
                            <div class="form-text">
                                Kode verifikasi akan dikirim ke email lama Anda untuk konfirmasi.
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-2"></i>Kirim Kode Verifikasi
                            </button>
                            <a href="<?= site_url('user/profile'); ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Profil
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
