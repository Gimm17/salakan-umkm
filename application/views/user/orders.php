<?php
// application/views/user/orders.php
// Dipanggil via User::orders() — dalam layouts/dashboard_layout
$statuses = [
    'all'       => ['label' => 'Semua',      'color' => 'secondary'],
    'pending'   => ['label' => 'Menunggu',   'color' => 'warning'],
    'paid'      => ['label' => 'Lunas',      'color' => 'success'],
    'failed'    => ['label' => 'Gagal',      'color' => 'danger'],
    'cancelled' => ['label' => 'Dibatalkan', 'color' => 'secondary'],
];
$active = isset($active_filter) ? $active_filter : 'all';
$orders = isset($orders) ? $orders : [];
?>
<style>
:root { --clr-primary:#c8681a; --clr-navy:#1a2a5e; }
.order-card {
  border: 0;
  border-radius: 14px;
  box-shadow: 0 3px 16px rgba(0,0,0,.07);
  margin-bottom: 1.2rem;
  transition: box-shadow .2s;
}
.order-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,.12); }
.order-card .card-header {
  background: var(--clr-navy);
  color: #fff;
  border-radius: 14px 14px 0 0 !important;
  padding: .85rem 1.25rem;
  font-size: .88rem;
}
.order-id-badge {
  font-family: monospace;
  background: rgba(255,255,255,.18);
  border-radius: 6px;
  padding: 2px 10px;
}
.item-thumb {
  width: 48px; height: 48px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #f0e8e0;
}
.btn-wa-sm {
  background: #25D366; color: #fff;
  border: 0; border-radius: 8px; padding: 6px 14px;
  font-size: .8rem; text-decoration: none;
  display: inline-flex; align-items: center; gap: 6px;
  transition: background .2s;
}
.btn-wa-sm:hover { background: #1da851; color: #fff; }
.filter-btn { font-size: .82rem; border-radius: 20px; padding: 5px 16px; }
.filter-btn.active { background: var(--clr-primary); border-color: var(--clr-primary); color: #fff; }
.empty-state { text-align: center; padding: 4rem 1rem; color: #aaa; }
.empty-state i { font-size: 4rem; margin-bottom: 1rem; }
</style>

<div class="p-3 p-lg-4">
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <h4 class="fw-bold mb-0" style="color:var(--clr-navy)">
        <i class="fas fa-history me-2" style="color:var(--clr-primary)"></i>Riwayat Pembelian
      </h4>
      <p class="text-muted mb-0" style="font-size:.85rem">Semua pesanan yang pernah kamu buat</p>
    </div>
    <a href="<?php echo site_url('produk'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill">
      <i class="fas fa-shopping-bag me-1"></i>Belanja Lagi
    </a>
  </div>

  <!-- Filter Tabs -->
  <div class="d-flex flex-wrap gap-2 mb-4">
    <?php foreach($statuses as $key => $s): ?>
    <a href="<?php echo site_url('user/orders?status=' . $key); ?>"
       class="btn btn-outline-secondary filter-btn <?php echo $active === $key ? 'active' : ''; ?>">
      <i class="fas fa-circle me-1" style="font-size:.5rem;vertical-align:middle;color:<?php echo $key === $active ? '#fff' : 'var(--bs-' . $s['color'] . ')'; ?>"></i>
      <?php echo $s['label']; ?>
    </a>
    <?php endforeach; ?>
  </div>

  <?php if(empty($orders)): ?>
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body empty-state">
      <i class="fas fa-box-open" style="color:#ddd"></i>
      <h5 class="fw-bold mt-2">Belum ada pesanan</h5>
      <p class="text-muted">Kamu belum punya pesanan <?php echo $active !== 'all' ? 'dengan status ini' : ''; ?> yet.</p>
      <a href="<?php echo site_url('produk'); ?>" class="btn rounded-pill px-4 text-white" style="background:var(--clr-primary)">
        <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
      </a>
    </div>
  </div>
  <?php else: ?>

  <?php
  $status_info = [
    'pending'   => ['badge' => 'warning',   'icon' => 'clock',        'label' => 'Menunggu Pembayaran'],
    'paid'      => ['badge' => 'success',   'icon' => 'check-circle', 'label' => 'Pembayaran Berhasil'],
    'failed'    => ['badge' => 'danger',    'icon' => 'times-circle', 'label' => 'Gagal'],
    'cancelled' => ['badge' => 'secondary', 'icon' => 'ban',          'label' => 'Dibatalkan'],
  ];
  foreach($orders as $order):
    $si = $status_info[$order['status']] ?? $status_info['pending'];
    $items = $order['items'] ?? [];
    $toko_wa_raw = preg_replace('/[^0-9]/', '', $order['toko_wa'] ?? '');
    if($toko_wa_raw && substr($toko_wa_raw, 0, 2) == '08') $toko_wa_raw = '62' . substr($toko_wa_raw, 1);
    $wa_msg = urlencode("Halo ".(htmlspecialchars($order['nama_toko'])??'Seller').", saya ingin konfirmasi pesanan #".$order['order_id']." di UMKM Banggai.");
    $wa_url = $toko_wa_raw ? "https://wa.me/{$toko_wa_raw}?text={$wa_msg}" : '#';
    $created_fmt = '-';
    try { $dt = new DateTime($order['created_at'] ?? 'now'); $created_fmt = $dt->format('d M Y, H:i'); } catch(Exception $e) {}
  ?>
  <div class="card order-card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div>
        <span class="order-id-badge"><?php echo htmlspecialchars($order['order_id']); ?></span>
        <span class="ms-2 text-white-50" style="font-size:.78rem">
          <i class="fas fa-calendar me-1"></i><?php echo $created_fmt; ?>
        </span>
      </div>
      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-<?php echo $si['badge']; ?> rounded-pill px-3">
          <i class="fas fa-<?php echo $si['icon']; ?> me-1"></i><?php echo $si['label']; ?>
        </span>
      </div>
    </div>
    <div class="card-body px-4 py-3">
      <div class="row g-3 align-items-center">
        <!-- Items -->
        <div class="col-md-7">
          <?php foreach($items as $item): ?>
          <div class="d-flex align-items-center gap-3 mb-2">
            <img src="<?php echo base_url('public/img/produk/' . ($item['gambar_produk'] ?? '')); ?>"
                 onerror="this.src='https://placehold.co/48x48/fef3ea/c8681a?text=P'"
                 class="item-thumb"
                 alt="<?php echo htmlspecialchars($item['nama_produk'] ?? '-'); ?>">
            <div>
              <div class="fw-semibold" style="font-size:.9rem">
                <?php echo htmlspecialchars($item['nama_produk'] ?? '-'); ?>
              </div>
              <div class="text-muted" style="font-size:.8rem">
                <?php echo (int)($item['qty'] ?? 1); ?> x Rp <?php echo number_format($item['price'] ?? 0, 0, ',', '.'); ?>
              </div>
            </div>
          </div>
          <?php endforeach; if(empty($items)): ?>
          <span class="text-muted" style="font-size:.85rem">—</span>
          <?php endif; ?>
        </div>

        <!-- Toko + Total + Actions -->
        <div class="col-md-5">
          <div class="mb-2" style="font-size:.85rem">
            <i class="fas fa-store me-1 text-muted"></i>
            <span class="text-muted">Toko:</span>
            <span class="fw-semibold ms-1"><?php echo htmlspecialchars($order['nama_toko'] ?? '-'); ?></span>
          </div>
          <div class="mb-3" style="font-size:.88rem">
            <span class="text-muted">Total:</span>
            <strong class="ms-2 fs-6" style="color:var(--clr-primary)">
              Rp <?php echo number_format($order['total'] ?? 0, 0, ',', '.'); ?>
            </strong>
          </div>
          <div class="d-flex flex-wrap gap-2">
            <a href="<?php echo site_url('payment/success?order_id=' . urlencode($order['order_id'])); ?>"
               class="btn btn-sm btn-outline-secondary rounded-pill">
              <i class="fas fa-receipt me-1"></i>Lihat Receipt
            </a>
            <?php if($toko_wa_raw): ?>
            <a href="<?php echo $wa_url; ?>" target="_blank" class="btn-wa-sm">
              <i class="fab fa-whatsapp"></i>Hubungi Seller
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
</div>
