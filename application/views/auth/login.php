<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <!-- Main Login Card -->
            <div class="card border-0 shadow-soft">
                <!-- Header -->
                <div class="card-header bg-gradient text-dark text-center border-0 p-4">
                    <div class="mb-3">
                        <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center" 
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-sign-in-alt text-primary fs-3"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-1">Selamat Datang Kembali</h4>
                    <p class="mb-0 opacity-90">Masuk ke akun UMKM Banggai Anda</p>
                </div>
                
                <!-- Body -->
                <div class="card-body p-4">
                    <!-- Flash Messages -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-3 fs-5"></i>
                                <div>
                                    <strong>Login Gagal!</strong><br>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fs-5"></i>
                                <div>
                                    <strong>Berhasil!</strong><br>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php echo validation_errors('<div class="alert alert-danger border-0 rounded-3 mb-4"><i class="fas fa-exclamation-triangle me-2"></i>', '</div>'); ?>

                    <!-- Login Form -->
                    <?php echo form_open('auth/login', ['class' => 'login-form']); ?>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email
                            </label>
                            <div class="position-relative">
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control form-control-lg" 
                                       placeholder="Masukkan email Anda"
                                       value="<?php echo set_value('email'); ?>" 
                                       required>
                                <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                                    <i class="fas fa-envelope text-muted"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-primary"></i>Password
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="form-control form-control-lg" 
                                       placeholder="Masukkan password Anda"
                                       required>
                                <button type="button" 
                                        class="btn btn-link position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                                        onclick="togglePassword()">
                                    <i class="fas fa-eye text-muted" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                                <label class="form-check-label text-muted" for="rememberMe">
                                    Ingat saya
                                </label>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                <span class="button-text">Masuk</span>
                            </button>
                        </div>
                    <?php echo form_close(); ?>
                    
                    <!-- ================================================================== -->
                    <!-- PERUBAHAN DIMULAI: Mengubah tautan Lupa Password -->
                    <!-- ================================================================== -->
                    <div class="text-center mb-3">
                        <a href="<?php echo site_url('auth/forgot_password'); ?>" class="text-decoration-none text-muted">
                            <i class="fas fa-question-circle me-1"></i>
                            Lupa password?
                        </a>
                    </div>
                    <!-- ================================================================== -->
                    <!-- PERUBAHAN SELESAI -->
                    <!-- ================================================================== -->
                </div>
                
                <!-- Footer -->
                <div class="card-footer bg-light border-0 text-center p-4">
                    <p class="mb-0">
                        Belum punya akun? 
                        <a href="<?php echo site_url('register'); ?>" class="fw-bold text-decoration-none">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
            
            <!-- Quick Access Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4 text-center">
                    <h6 class="fw-bold mb-3">Akses Cepat</h6>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="<?php echo site_url('produk'); ?>" class="btn btn-outline-primary w-100 rounded-pill">
                                <i class="fas fa-shopping-bag me-2"></i>
                                <small>Belanja</small>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="<?php echo site_url('toko'); ?>" class="btn btn-outline-secondary w-100 rounded-pill">
                                <i class="fas fa-store me-2"></i>
                                <small>Toko</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation and enhancement
    const loginForm = document.querySelector('.login-form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    // Email validation
    emailInput.addEventListener('blur', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            this.classList.add('is-invalid');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('invalid-feedback')) {
                const feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                feedback.textContent = 'Format email tidak valid';
                this.parentNode.appendChild(feedback);
            }
        } else {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.invalid-feedback');
            if (feedback) feedback.remove();
        }
    });

    // Password toggle functionality
    window.togglePassword = function() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.className = 'fas fa-eye-slash text-muted';
        } else {
            passwordField.type = 'password';
            toggleIcon.className = 'fas fa-eye text-muted';
        }
    };


    // Form submission with loading state
    loginForm.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const buttonText = submitBtn.querySelector('.button-text');
        
        // Disable button and show loading
        submitBtn.disabled = true;
        buttonText.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        
        // Re-enable after 10 seconds (failsafe)
        setTimeout(() => {
            submitBtn.disabled = false;
            buttonText.innerHTML = 'Masuk';
        }, 10000);
    });

    // Enhanced input animations
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentNode.style.transform = 'scale(1.02)';
            this.parentNode.style.transition = 'transform 0.2s ease';
        });
        
        input.addEventListener('blur', function() {
            this.parentNode.style.transform = 'scale(1)';
        });
    });

    // Auto-focus on first input
    if (emailInput) {
        emailInput.focus();
    }

    // Demo account quick fill
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'd') {
            e.preventDefault();
            emailInput.value = 'admin@umkm.com';
            passwordInput.value = 'password123';
            Swal.fire({
                icon: 'info',
                title: 'Demo Account',
                text: 'Akun demo admin telah diisi',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
});
</script>

<style>
/* Enhanced login page styling */
.login-form .form-control {
    padding-right: 3rem;
    transition: all 0.3s ease;
    border-width: 2px;
}

.login-form .form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(226, 125, 96, 0.25);
    transform: translateY(-2px);
}

.login-form .position-relative {
    transition: transform 0.2s ease;
}

/* Custom checkbox styling */
.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

.form-check-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.25rem rgba(226, 125, 96, 0.25);
}

/* Enhanced card hover effects */
.card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

/* Button enhancements */
.btn-link {
    border: none;
    background: none;
    color: var(--medium-gray);
    transition: color 0.3s ease;
}

.btn-link:hover {
    color: var(--primary);
}

/* Loading animation for submit button */
.btn[disabled] {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Demo info card styling */
.card small {
    line-height: 1.6;
}

/* Enhanced alert styling */
.alert {
    border-radius: 1rem !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Input icons positioning */
.position-absolute .fas {
    transition: color 0.3s ease;
}

.form-control:focus + .position-absolute .fas {
    color: var(--primary) !important;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .card-body {
        padding: 1.5rem !important;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
}

/* Enhanced gradient background */
.bg-gradient {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    position: relative;
    overflow: hidden;
}

.bg-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
    opacity: 0.3;
}
</style>