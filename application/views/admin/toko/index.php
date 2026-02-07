<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Manajemen Toko UMKM</h5>
    </div>
    <div class="card-body">
        <!-- Tambahkan tombol filter di atas tabel -->
        <div class="mb-3">
            <a href="<?php echo site_url('admin/manajemen_toko'); ?>" 
               class="btn <?php echo (!isset($filter_active) || $filter_active == 'semua') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                Semua Toko
            </a>
            <a href="<?php echo site_url('admin/manajemen_toko?filter=menunggu'); ?>" 
               class="btn <?php echo (isset($filter_active) && $filter_active == 'menunggu') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                Menunggu Persetujuan
            </a>
            <a href="<?php echo site_url('admin/manajemen_toko?filter=disetujui'); ?>" 
               class="btn <?php echo (isset($filter_active) && $filter_active == 'disetujui') ? 'btn-primary' : 'btn-outline-primary'; ?>">
                Disetujui
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th>Pemilik</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($toko)): $no = 1; ?>
                        <?php foreach($toko as $t): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($t['nama_toko']); ?></td>
                            <td><?php echo htmlspecialchars($t['nama_pemilik']); ?></td>
                            <td>
                                <?php 
                                    $status_class = 'bg-secondary';
                                    if ($t['status_persetujuan'] == 'disetujui') $status_class = 'bg-success';
                                    if ($t['status_persetujuan'] == 'menunggu') $status_class = 'bg-warning text-dark';
                                    if ($t['status_persetujuan'] == 'ditolak') $status_class = 'bg-danger';
                                ?>
                                <span class="badge <?php echo $status_class; ?>"><?php echo ucfirst($t['status_persetujuan']); ?></span>
                            </td>
                            <td class="text-center">
                                <?php if($t['status_persetujuan'] == 'menunggu'): ?>
                                    <!-- Sudah ada: Setujui/Tolak -->
                                    <a href="<?php echo site_url('admin/setujui_toko/'.$t['id']); ?>" 
                                       class="btn btn-sm btn-success btn-confirm" 
                                       data-message="Anda yakin ingin menyetujui toko ini?">
                                       <i class="fa fa-check"></i> Setujui
                                    </a>
                                    <a href="<?php echo site_url('admin/tolak_toko/'.$t['id']); ?>" 
                                       class="btn btn-sm btn-danger btn-confirm"
                                       data-message="Anda yakin ingin menolak toko ini?">
                                       <i class="fa fa-times"></i> Tolak
                                    </a>
                                <?php else: ?>
                                    <!-- Tambahan: Nonaktifkan & Hapus -->
                                    <a href="<?php echo site_url('admin/nonaktifkan_toko/'.$t['id']); ?>"
                                       class="btn btn-sm btn-warning btn-confirm"
                                       data-message="Nonaktifkan toko ini sementara? Toko tidak akan tampil di publik.">
                                       <i class="fa fa-ban"></i> Nonaktifkan
                                    </a>
                                    <a href="<?php echo site_url('admin/hapus_toko/'.$t['id']); ?>"
                                       class="btn btn-sm btn-danger btn-confirm"
                                       data-message="Hapus toko ini secara permanen? Semua data toko akan hilang!">
                                       <i class="fa fa-trash"></i> Hapus
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">Belum ada toko yang mendaftar.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- PERUBAHAN: Tambahkan script JavaScript untuk SweetAlert -->
<script>
$(document).ready(function(){
    $('.btn-confirm').on('click', function(e){
        e.preventDefault(); // Mencegah link langsung diakses
        var href = $(this).attr('href');
        var message = $(this).data('message');

        Swal.fire({
            title: 'Konfirmasi Aksi',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, lanjutkan ke link tujuan
                window.location.href = href;
            }
        });
    });
});
</script>
