<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-user-circle me-2 text-primary"></i>Profil Saya</h5>
    </div>
    <div class="card-body p-4">
        <?php echo validation_errors('<div class="alert alert-warning p-2 small">', '</div>'); ?>
        <form action="<?php echo site_url('user/profile'); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4 text-center mb-4 mb-lg-0">
                    <div class="position-relative d-inline-block">
                        <?php 
                            $foto_url = base_url('public/img/profile/' . ($user['foto'] ?? 'default.png'));
                            $placeholder = 'https://placehold.co/150x150/E2E8F0/4A5568?text=Foto';
                        ?>
                        <img src="<?php echo $foto_url; ?>" onerror="this.src='<?php echo $placeholder; ?>'" id="imagePreview" class="img-thumbnail rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;" alt="Foto Profil">
                    </div>
                    <div>
                        <label for="foto_profil" class="btn btn-sm btn-outline-primary">
                           <i class="fas fa-camera"></i> Ganti Foto
                        </label>
                        <input type="file" name="foto_profil" id="foto_profil" class="d-none" onchange="previewImage(event)">
                        <div class="form-text mt-2">Format: JPG, PNG. Maks 2MB</div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama', $user['nama']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" value="<?php echo $user['email']; ?>" readonly disabled>
                        <div class="form-text">Email tidak dapat diubah.</div>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-semibold">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Banggai, Sulawesi Tengah" value="<?php echo set_value('lokasi', $user['lokasi'] ?? ''); ?>">
                    </div>
                </div>
            </div>
             <hr class="my-4">
            <h6 class="text-muted mb-3">Ubah Password (Opsional)</h6>
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
            <div class="mt-4 text-end">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk toggle password visibility
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

// Fungsi untuk preview gambar profil
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('imagePreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
