<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-soft">
                <div class="card-header bg-gradient text-dark text-center border-0 p-4">
                    <h4 class="fw-bold mb-1">Reset Password Anda</h4>
                    <p class="mb-0 opacity-90">Masukkan kode OTP dan password baru Anda.</p>
                </div>
                <div class="card-body p-4">
                    <?php echo validation_errors('<div class="alert alert-warning p-2 small">', '</div>'); ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <?php echo form_open('auth/reset_password/' . $token); ?>
                        <div class="mb-3">
                            <label for="otp" class="form-label fw-semibold">Kode OTP</label>
                            <input type="text" name="otp" id="otp" class="form-control form-control-lg" placeholder="Masukkan 6 digit kode OTP" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Masukkan password baru" required>
                        </div>
                        <div class="mb-4">
                            <label for="pass_confirm" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                            <input type="password" name="pass_confirm" id="pass_confirm" class="form-control form-control-lg" placeholder="Ulangi password baru" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Reset Password</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
