</main>
    
    <?php $this->load->view('layouts/partials/footer'); ?>
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Custom JavaScript for enhanced UX -->
    <script>
        $(document).ready(function() {
            // Flash messages dengan SweetAlert2
            <?php if ($this->session->flashdata('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?php echo addslashes($this->session->flashdata('success')); ?>',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true,
                    position: 'top-end',
                    background: '#fff',
                    color: '#3E2723'
                });
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?php echo addslashes($this->session->flashdata('error')); ?>',
                    confirmButtonColor: '#E27D60',
                    background: '#fff',
                    color: '#3E2723'
                });
            <?php endif; ?>

            // Smooth scrolling untuk anchor links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 80
                    }, 1000);
                }
            });

            // Card hover animations dengan intersection observer
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Apply fade-in animation to cards
            $('.product-card, .store-card, .card').each(function(index) {
                $(this).css({
                    'opacity': '0',
                    'transform': 'translateY(30px)',
                    'transition': 'opacity 0.6s ease ' + (index * 0.1) + 's, transform 0.6s ease ' + (index * 0.1) + 's'
                });
                observer.observe(this);
            });

            // Enhanced navbar scroll effect
            $(window).scroll(function() {
                if ($(window).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });

            // Image lazy loading fallback
            $('img').on('error', function() {
                if (!$(this).hasClass('error-handled')) {
                    $(this).addClass('error-handled');
                    const altText = $(this).attr('alt') || 'Gambar';
                    const placeholder = 'https://placehold.co/400x300/E2E8F0/3E2723?text=' + encodeURIComponent(altText);
                    $(this).attr('src', placeholder);
                }
            });

            // Loading state untuk form submit
            $('form').on('submit', function() {
                const submitBtn = $(this).find('button[type="submit"]');
                if (submitBtn.length) {
                    submitBtn.prop('disabled', true);
                    const originalText = submitBtn.html();
                    submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Memproses...');
                    
                    // Restore button setelah 10 detik (failsafe)
                    setTimeout(() => {
                        submitBtn.prop('disabled', false);
                        submitBtn.html(originalText);
                    }, 10000);
                }
            });
        });

        // Add scrolled class to navbar
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.createElement('style');
            style.textContent = `
                .navbar.scrolled {
                    box-shadow: 0 4px 30px rgba(62, 39, 35, 0.15);
                    backdrop-filter: blur(10px);
                    background: rgba(255, 255, 255, 0.95) !important;
                }
                
                @media (prefers-reduced-motion: reduce) {
                    * {
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                        transition-duration: 0.01ms !important;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>