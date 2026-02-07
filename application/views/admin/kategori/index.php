<div class="row">
    <!-- Kolom Kiri: Form Tambah Kategori -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Kategori</h5>
            </div>
            <div class="card-body">
                <?php echo form_open('admin/manajemen_kategori'); ?>
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori Baru</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" placeholder="Contoh: Kerajinan Tangan" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-2"></i>Simpan</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Daftar Kategori -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2 text-primary"></i>Daftar Kategori</h5>
                    <span class="badge bg-primary rounded-pill"><?php echo count($kategori); ?> Kategori</span>
                </div>
            </div>
            <div class="card-body">
                <!-- Form Pencarian -->
                <form action="<?php echo site_url('admin/manajemen_kategori'); ?>" method="get" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari nama kategori..." value="<?php echo htmlspecialchars($keyword ?? ''); ?>">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>

                <!-- Tabel Kategori -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Slug</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($kategori)): $no = 1; ?>
                                <?php foreach ($kategori as $kat): ?>
                                <tr>
                                    <td class="fw-bold"><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($kat['nama_kategori']); ?></td>
                                    <td><?php echo htmlspecialchars($kat['slug']); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $kat['id']; ?>" data-nama="<?php echo htmlspecialchars($kat['nama_kategori']); ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- ================================================================== -->
                                        <!-- PERUBAHAN DIMULAI: Mengubah tombol hapus untuk SweetAlert -->
                                        <!-- ================================================================== -->
                                        <button class="btn btn-sm btn-danger delete-btn" data-url="<?php echo site_url('admin/kategori/hapus/' . $kat['id']); ?>" data-nama="<?php echo htmlspecialchars($kat['nama_kategori']); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- ================================================================== -->
                                        <!-- PERUBAHAN SELESAI -->
                                        <!-- ================================================================== -->
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <?php echo $keyword ? 'Kategori tidak ditemukan.' : 'Belum ada kategori.'; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="post">
        <div class="modal-body">
            <div class="mb-3">
                <label for="nama_kategori_edit" class="form-label fw-semibold">Nama Kategori</label>
                <input type="text" name="nama_kategori_edit" id="nama_kategori_edit" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JavaScript untuk Modal Edit dan SweetAlert Hapus -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  // JavaScript untuk Modal Edit (tetap sama)
  var editModal = document.getElementById('editModal');
  editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var kategoriId = button.getAttribute('data-id');
    var kategoriNama = button.getAttribute('data-nama');
    var modalForm = editModal.querySelector('#editForm');
    var modalInput = editModal.querySelector('#nama_kategori_edit');
    modalForm.action = '<?php echo site_url('admin/kategori/update/'); ?>' + kategoriId;
    modalInput.value = kategoriNama;
  });

  // ==================================================================
  // PERUBAHAN DIMULAI: Menambahkan script untuk SweetAlert Hapus
  // ==================================================================
  const deleteButtons = document.querySelectorAll('.delete-btn');
  deleteButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault(); // Mencegah aksi default tombol
      
      const deleteUrl = this.getAttribute('data-url');
      const kategoriNama = this.getAttribute('data-nama');

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: `Anda akan menghapus kategori "${kategoriNama}". Tindakan ini tidak dapat dibatalkan!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Jika pengguna mengklik "Ya, hapus!", arahkan ke URL hapus
          window.location.href = deleteUrl;
        }
      });
    });
  });
  // ==================================================================
  // PERUBAHAN SELESAI
  // ==================================================================
});
</script>
