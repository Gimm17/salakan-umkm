<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-soft">
                <div class="card-header bg-gradient text-dark text-center border-0 p-4">
                    <h4 class="fw-bold mb-1">Lupa Password</h4>
                    <p class="mb-0 opacity-90">Masukkan email Anda untuk menerima kode reset.</p>
                </div>
                <div class="card-body p-4">
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    
                    <?php echo form_open('auth/forgot_password'); ?>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email Terdaftar</label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Kirim Kode Reset</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="card-footer bg-light border-0 text-center p-4">
                    <a href="<?php echo site_url('login'); ?>" class="text-decoration-none">Kembali ke halaman Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
