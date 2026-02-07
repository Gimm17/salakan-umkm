
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrasi Akun Baru</h4>
            </div>
            <div class="card-body p-4">
                <?php echo validation_errors('<div class="alert alert-danger p-2">', '</div>'); ?>
                <?php echo form_open('auth/register'); ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password (min. 8 karakter)</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="pass_confirm" class="form-control" required>
                    </div>
                    <div class="mb-3">
                         <label class="form-label">Daftar Sebagai:</label>
                         <select name="role" class="form-select" required>
                            <option value="pengguna" <?php echo set_select('role', 'pengguna', TRUE); ?>>Pembeli / Pengguna</option>
                            <option value="penjual" <?php echo set_select('role', 'penjual'); ?>>Penjual / Pemilik UMKM</option>
                         </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
             <div class="card-footer text-center">
                <p class="mb-0">Sudah punya akun? <a href="<?php echo site_url('login'); ?>">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>