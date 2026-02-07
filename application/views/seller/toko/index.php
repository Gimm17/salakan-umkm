<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-dark">Pengaturan Profil Toko</h5>
    </div>
    <div class="card-body p-4">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <?php echo form_open_multipart('seller/pengaturan_toko'); ?>
            <div class="row">
                <!-- Kolom Kiri: Detail Teks -->
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="nama_toko" class="form-label">Nama Toko</label>
                        <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="<?php echo htmlspecialchars($toko['nama_toko'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Toko</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" placeholder="Jelaskan tentang toko Anda..."><?php echo htmlspecialchars($toko['deskripsi'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Jl. Contoh No. 123, Banggai"><?php echo htmlspecialchars($toko['alamat'] ?? ''); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="jam_operasional" class="form-label">Jam Operasional</label>
                        <input type="text" name="jam_operasional" id="jam_operasional" class="form-control" value="<?php echo htmlspecialchars($toko['jam_operasional'] ?? ''); ?>" placeholder="Contoh: 08:00 - 21:00">
                    </div>
                </div>
                <!-- Kolom Kanan: Logo -->
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label d-block">Logo Toko</label>
                        <div class="text-center mb-2">
                            <img src="<?php echo base_url('public/img/logo/' . htmlspecialchars($toko['logo'] ?? 'default_logo.jpg')); ?>" 
                                 alt="Logo Toko" 
                                 class="img-thumbnail" 
                                 style="width: 180px; height: 180px; object-fit: cover;">
                        </div>
                        <input type="file" name="logo" class="form-control">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti logo. Maks. 1MB.</small>
                    </div>
                </div>
            </div>
            
            <hr class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save me-1"></i> Simpan Perubahan
            </button>
        <?php echo form_close(); ?>
    </div>
</div>