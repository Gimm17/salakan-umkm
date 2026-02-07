<!-- application/views/admin/users/index.php -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Semua Pengguna</h5>
    </div>
    <div class="card-body">
        <!-- Filter buttons - menggunakan gaya yang sama dengan Manajemen Toko -->
        <div class="mb-3">
            <!-- Filter Role -->
            <a href="<?php echo site_url('admin/manajemen_pengguna'); ?>" 
               class="btn <?php echo (!isset($_GET['role'])) ? 'btn-primary' : 'btn-outline-primary'; ?>">
                Semua Pengguna
            </a>
            <a href="<?php echo site_url('admin/manajemen_pengguna?role=penjual'); ?>" 
               class="btn <?php echo (isset($_GET['role']) && $_GET['role'] == 'penjual') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                Penjual
            </a>
            <a href="<?php echo site_url('admin/manajemen_pengguna?role=pengguna'); ?>" 
               class="btn <?php echo (isset($_GET['role']) && $_GET['role'] == 'pengguna') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                Pengguna
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Toko</th>
                        <th>Status Toko</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($users)): $no = 1; ?>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($user['nama']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><span class="badge bg-info"><?php echo htmlspecialchars($user['role']); ?></span></td>
                                <td><?php echo $user['role'] == 'penjual' ? (isset($user['nama_toko']) ? htmlspecialchars($user['nama_toko']) : '-') : '-'; ?></td>
                                <td>
                                    <?php if($user['role'] == 'penjual'): ?>
                                         <?php 
                                            if (isset($user['status_persetujuan'])) {
                                                $status_class = 'bg-secondary';
                                                if ($user['status_persetujuan'] == 'disetujui') $status_class = 'bg-success';
                                                if ($user['status_persetujuan'] == 'menunggu') $status_class = 'bg-warning text-dark';
                                                if ($user['status_persetujuan'] == 'ditolak') $status_class = 'bg-danger';
                                                
                                                echo '<span class="badge ' . $status_class . '">' . ucfirst($user['status_persetujuan']) . '</span>';
                                            } else {
                                                echo '<span class="badge bg-secondary">Tidak Ada</span>';
                                            }
                                         ?>
                                    <?php else: echo '-'; endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
