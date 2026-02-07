<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-user-tag me-2 text-primary"></i>Profil Penjual</h5>
    </div>
    <div class="card-body p-4">
        <?php echo validation_errors('<div class="alert alert-warning p-2 small">', '</div>'); ?>
        <form action="<?php echo site_url('seller/profile'); ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?php echo set_value('nama', $user['nama']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" value="<?php echo $user['email']; ?>" readonly disabled>
                    <div class="form-text">Email tidak dapat diubah.</div>
                </div>
            </div>
            <hr class="my-4">
            <h6 class="text-muted mb-3">Ubah Password (Opsional)</h6>
            
            <!-- PERUBAHAN: Menambahkan input-group untuk ikon mata -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label fw-semibold">Password Baru</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin diubah">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pass_confirm" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                    <div class="input-group">
                         <input type="password" name="pass_confirm" id="pass_confirm" class="form-control" placeholder="Konfirmasi password baru">
                         <button class="btn btn-outline-secondary" type="button" id="togglePassConfirm">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- PERUBAHAN SELESAI -->
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Sembunyikan ikon mata bawaan di Chrome, Safari, Edge */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-webkit-password-reveal-button {
        display: none !important;
    }
</style>

<!-- PERUBAHAN: Menambahkan JavaScript untuk ikon mata -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    function setupPasswordToggle(inputId, buttonId) {
        const toggleButton = document.getElementById(buttonId);
        const passwordInput = document.getElementById(inputId);
        if (toggleButton && passwordInput) {
            toggleButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    }
    
    setupPasswordToggle('password', 'togglePassword');
    setupPasswordToggle('pass_confirm', 'togglePassConfirm');
});
</script>
<!-- PERUBAHAN SELESAI -->
