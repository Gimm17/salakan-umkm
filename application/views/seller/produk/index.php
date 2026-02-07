<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-dark">Katalog Produk Saya</h5>
            <a href="<?php echo site_url('seller/produk/tambah'); ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-plus me-1"></i> Tambah Produk Baru
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($produk)): $no = 1; ?>
                        <?php foreach($produk as $p): ?>
                        <tr>
                            <td class="fw-bold"><?php echo $no++; ?></td>
                            <td>
                                <img src="<?php echo base_url('public/img/produk/' . htmlspecialchars($p['gambar_produk'])); ?>" 
                                     alt="<?php echo htmlspecialchars($p['nama_produk']); ?>" 
                                     style="width: 80px; height: 80px; object-fit: cover;" 
                                     class="rounded">
                            </td>
                            <td><?php echo htmlspecialchars($p['nama_produk']); ?></td>
                            <td>Rp <?php echo number_format($p['harga'], 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge <?php echo ($p['status_produk'] == 'Tersedia') ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo htmlspecialchars($p['status_produk']); ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo site_url('seller/produk/edit/'.$p['id']); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <?php echo form_open('seller/produk/hapus/'.$p['id'], array('class' => 'd-inline form-delete')); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                <?php echo form_close(); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <p class="mb-1">Anda belum memiliki produk.</p>
                                <a href="<?php echo site_url('seller/produk/tambah'); ?>">Tambahkan produk pertama Anda.</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Script untuk SweetAlert konfirmasi hapus (sudah ada dan tidak perlu diubah)
$(document).ready(function(){
    $('.form-delete').on('submit', function(e){
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan produk ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
