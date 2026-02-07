<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-shield-check me-2"></i>Verifikasi Email</h5>
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
                    
                    <div class="text-center mb-4">
                        <div class="display-1 text-success mb-3">
                            <i class="bi bi-envelope-check"></i>
                        </div>
                        <h5>Kode Verifikasi Telah Dikirim</h5>
                        <p class="text-muted">
                            Silakan cek email lama Anda dan masukkan kode 6 digit yang telah dikirim.
                        </p>
                    </div>
                    
                    <form action="<?= site_url('user/email_change_verify'); ?>" method="post">
                        <div class="mb-4">
                            <label for="code" class="form-label">Kode Verifikasi</label>
                            <input type="text" class="form-control form-control-lg text-center" 
                                   id="code" name="code" 
                                   placeholder="______"
                                   maxlength="6" 
                                   pattern="[0-9]{6}"
                                   style="letter-spacing: 10px; font-size: 1.5rem; font-weight: bold;"
                                   required autofocus>
                            <div class="form-text text-center">
                                Kode berlaku selama 30 menit
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle me-2"></i>Verifikasi
                            </button>
                            <a href="<?= site_url('user/email'); ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Tidak menerima kode? Cek folder spam atau 
                            <a href="<?= site_url('user/email'); ?>">kirim ulang kode</a>.
                        </small>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
