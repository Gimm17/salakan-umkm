<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-soft">
                <div class="card-header bg-gradient text-dark text-center border-0 p-4">
                    <div class="mb-3">
                        <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-user-plus text-primary fs-3"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-1">Buat Akun Baru</h4>
                    <p class="mb-0 opacity-90">Daftarkan diri Anda untuk memulai</p>
                </div>
                
                <div class="card-body p-4">
                    <?php echo validation_errors('<div class="alert alert-danger border-0 rounded-3 mb-4 d-flex align-items-center"><i class="fas fa-exclamation-triangle me-3"></i><div>', '</div></div>'); ?>
                    
                    <?php echo form_open('auth/register'); ?>
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-semibold">
                                <i class="fas fa-user me-2 text-primary"></i>Nama Lengkap
                            </label>
                            <input type="text" name="nama" id="nama" class="form-control form-control-lg" placeholder="Masukkan nama lengkap" value="<?php echo set_value('nama'); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email
                            </label>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Masukkan email valid" value="<?php echo set_value('email'); ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-primary"></i>Password (min. 8 karakter)
                            </label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Buat password Anda" required>
                                <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-1" onclick="togglePassword('password', 'togglePasswordIcon')">
                                    <i class="fas fa-eye text-muted" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="pass_confirm" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-primary"></i>Konfirmasi Password
                            </label>
                             <div class="position-relative">
                                <input type="password" name="pass_confirm" id="pass_confirm" class="form-control form-control-lg" placeholder="Ulangi password Anda" required>
                                <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-1" onclick="togglePassword('pass_confirm', 'togglePassConfirmIcon')">
                                    <i class="fas fa-eye text-muted" id="togglePassConfirmIcon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                             <label for="role" class="form-label fw-semibold">
                                <i class="fas fa-users me-2 text-primary"></i>Daftar Sebagai
                            </label>
                             <select name="role" id="role" class="form-select form-select-lg" required>
                                <option value="pengguna" <?php echo set_select('role', 'pengguna', TRUE); ?>>Pembeli / Pengguna</option>
                                <option value="penjual" <?php echo set_select('role', 'penjual'); ?>>Penjual / Pemilik UMKM</option>
                             </select>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                
                <div class="card-footer bg-light border-0 text-center p-4">
                    <p class="mb-0">
                        Sudah punya akun? 
                        <a href="<?php echo site_url('login'); ?>" class="fw-bold text-decoration-none">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Reusable function to toggle password visibility
function togglePassword(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(iconId);
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.className = 'fas fa-eye-slash text-muted';
    } else {
        passwordField.type = 'password';
        toggleIcon.className = 'fas fa-eye text-muted';
    }
}

// Auto-focus on the first input field when the page loads
document.addEventListener('DOMContentLoaded', function() {
    const firstInput = document.getElementById('nama');
    if (firstInput) {
        firstInput.focus();
    }
});
</script>