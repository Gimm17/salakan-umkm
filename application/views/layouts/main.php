<!-- application/views/layouts/main.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'UMKM Banggai'; ?></title>
    
    <!-- CSS (sama seperti versi sebelumnya) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .card-product:hover { transform: translateY(-5px); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <!-- Header / Navbar -->
    <?php $this->load->view('layouts/partials/navbar'); ?>

    <!-- Content -->
    <main class="container my-4">
        <?php 
            // Bagian ini akan di-load oleh controller yang memanggil layout ini
            if (isset($page_content)) {
                $this->load->view($page_content);
            }
        ?>
    </main>

    <!-- Footer -->
    <?php $this->load->view('layouts/partials/footer'); ?>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Script untuk notifikasi flashdata -->
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')): ?>
                Swal.fire({
                    icon: 'success', title: 'Berhasil!', text: '<?= $this->session->flashdata('success') ?>',
                    showConfirmButton: false, timer: 1500
                });
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                Swal.fire({
                    icon: 'error', title: 'Oops...', text: '<?= $this->session->flashdata('error') ?>',
                });
            <?php endif; ?>
        });
    </script>
    
    <!-- Section untuk script tambahan per halaman -->
    <?php 
        if (isset($extra_scripts)) {
            $this->load->view($extra_scripts);
        }
    ?>
</body>
</html>