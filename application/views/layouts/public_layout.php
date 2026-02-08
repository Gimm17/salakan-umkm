<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title) . ' | UMKM Banggai' : 'UMKM Banggai'; ?></title>
    
    <!-- CSS Eksternal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Global dari main_header.php -->
    <style>
        :root {
            --primary: #E27D60;      /* Terracotta */
            --primary-rgb: 226, 125, 96;
            --secondary: #85B66F;    /* Olive Green */
            --accent: #FFD166;       /* Gold Yellow */
            --bg-ivory: #FFF8F0;     /* Ivory Background */
            --text-dark: #3E2723;    /* Dark Brown Font */
            --white: #FFFFFF;
            --light-gray: #F5F5F5;
            --medium-gray: #9E9E9E;
            --shadow: rgba(62, 39, 35, 0.1);
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            --bs-primary-rgb: var(--primary-rgb);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-ivory);
            color: var(--text-dark);
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6, .fw-bold, .fw-bolder, .navbar-brand {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
        }

        main {
            min-height: 80vh;
        }

        /* Navigation Styles */
        .navbar {
            background: var(--white) !important;
            box-shadow: 0 2px 20px var(--shadow);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .navbar-nav .nav-link {
            font-weight: 600;
            color: var(--text-dark) !important;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            color: var(--primary) !important;
            font-weight: 700;
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* Button Styles */
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(226, 125, 96, 0.3);
        }

        .btn-primary:hover, .btn-primary:focus {
            background: #d16749;
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(226, 125, 96, 0.4);
        }

        .btn-outline-primary {
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        .btn-success {
            background: var(--secondary);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: #729a5e;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: var(--primary);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .btn-outline-danger {
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }

        .btn-outline-danger:hover {
            background: var(--primary);
            border-color: var(--primary);
        }

        /* Card Styles */
        .product-card, .store-card, .card {
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
            border: none;
            background: var(--white);
            box-shadow: 0 4px 20px var(--shadow);
        }

        .product-card:hover, .store-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(62, 39, 35, 0.15);
        }

        .card-img-top {
            transition: transform 0.3s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .bg-secondary {
            background-color: var(--secondary) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        /* Form Styles */
        .form-control, .form-select {
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(226, 125, 96, 0.25);
        }

        .input-group-text {
            background: var(--white);
            border: 2px solid #E0E0E0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: var(--medium-gray);
        }

        /* Hero Section */
        .hero-banner {
            background: linear-gradient(rgba(62, 39, 35, 0.4), rgba(133, 182, 111, 0.4)), 
                        url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=1981') center center;
            background-size: cover;
            border-radius: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient);
            opacity: 0.8;
        }

        .hero-banner .container-fluid {
            position: relative;
            z-index: 2;
        }

        /* Pagination */
        .pagination .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .pagination .page-link {
            color: var(--primary);
            border: none;
            margin: 0 0.25rem;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .pagination .page-link:hover {
            background-color: var(--primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(62, 39, 35, 0.15);
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--bg-ivory);
            color: var(--primary);
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: rgba(133, 182, 111, 0.1);
            color: var(--secondary);
        }

        .alert-danger {
            background-color: rgba(226, 125, 96, 0.1);
            color: var(--primary);
        }

        /* Utility Classes */
        .shadow-soft {
            box-shadow: 0 8px 30px var(--shadow);
        }

        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bg-gradient {
            background: var(--gradient);
        }

        .accent-border {
            border-left: 4px solid var(--accent);
        }

        .accent-bg {
            background-color: var(--accent);
            color: var(--text-dark);
        }

        /* Store specific styles */
        .store-card .card-img-top-placeholder {
            height: 120px;
            background: var(--gradient);
        }

        .store-card .logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 4px solid var(--white);
            margin-top: -60px;
            transition: transform 0.3s ease;
        }

        .store-card:hover .logo {
            transform: scale(1.1);
        }

        /* Empty states */
        .empty-state {
            background: var(--white);
            border-radius: 1.5rem;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 4px 20px var(--shadow);
        }

        .empty-state i {
            color: var(--medium-gray);
            margin-bottom: 1rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* P0 FIX: Prevent horizontal scroll */
        html, body {
            overflow-x: hidden;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-banner {
                padding: 2rem 1rem;
            }
            
            .hero-banner h1 {
                font-size: 1.75rem;
            }
            
            .product-card, .store-card {
                margin-bottom: 1.5rem;
            }

            .navbar-nav .nav-link {
                margin: 0.25rem 0;
                padding: 0.75rem 1rem; /* P0 FIX: Better tap targets */
            }

            /* P0 FIX: Login/Register buttons stacking */
            .navbar-nav.align-items-center {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .navbar-nav .btn {
                width: 100%;
                margin: 0.25rem 0 !important;
            }
        }

        /* P1 FIX: Small phones */
        @media (max-width: 576px) {
            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .hero-banner h1 {
                font-size: 1.5rem;
            }

            .hero-banner p {
                font-size: 0.9rem;
            }

            .btn-primary, .btn-outline-primary {
                padding: 0.6rem 1.25rem;
                font-size: 0.9rem;
            }

            .card-body {
                padding: 1rem;
            }
        }

        /* P1 FIX: Extra small phones */
        @media (max-width: 360px) {
            .container {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }

            .hero-banner {
                padding: 1.5rem 0.75rem;
            }

            .hero-banner h1 {
                font-size: 1.3rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .badge {
                font-size: 0.7rem;
                padding: 0.35rem 0.6rem;
            }
        }

        /* Stretched link utility */
        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            content: "";
        }
    </style>
</head>
<body>

    <?php $this->load->view('layouts/partials/navbar'); ?>

    <main class="flex-grow-1">
        <?php 
            if (isset($page_content)) {
                $this->load->view($page_content);
            }
        ?>
    </main>
    
    <?php $this->load->view('layouts/partials/footer'); ?>
    
    <!-- JavaScript Libraries dari main_footer.php -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
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
