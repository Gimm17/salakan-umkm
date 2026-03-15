<?php
// application/views/user/orders.php
// Riwayat Pembelian — dalam layouts/dashboard_layout
$EXPIRE_MINUTES = 10; // batas waktu pending sebelum otomatis gagal (menit)

$statuses = [
    'all'     => ['label' => 'Semua',    'icon' => 'list'],
    'pending' => ['label' => 'Pending',  'icon' => 'clock'],
    'paid'    => ['label' => 'Lunas',    'icon' => 'check-circle'],
    'failed'  => ['label' => 'Gagal',    'icon' => 'times-circle'],
];
$active  = isset($active_filter) ? $active_filter : 'all';
$orders  = isset($orders) ? $orders : [];

// Auto-expire: tandai pending yang sudah > EXPIRE_MINUTES jadi failed (client-side display saja)
// Update DB sebenarnya dilakukan di controller saat orders() dipanggil
$now = time();
foreach ($orders as &$o) {
    if ($o['status'] === 'pending') {
        $created_ts = strtotime($o['created_at'] ?? 'now');
        $elapsed_m  = ($now - $created_ts) / 60;
        if ($elapsed_m > $EXPIRE_MINUTES) {
            $o['status'] = 'expired'; // hanya untuk display
        }
    }
}
unset($o);

$status_info = [
    'pending' => ['badge' => 'warning',   'icon' => 'clock',         'label' => 'Menunggu Pembayaran', 'text' => 'dark'],
    'paid'    => ['badge' => 'success',   'icon' => 'check-circle',  'label' => 'Pembayaran Berhasil', 'text' => 'white'],
    'failed'  => ['badge' => 'danger',    'icon' => 'times-circle',  'label' => 'Gagal',               'text' => 'white'],
    'expired' => ['badge' => 'secondary', 'icon' => 'hourglass-end', 'label' => 'Kadaluarsa',          'text' => 'white'],
    'cancelled'=>['badge' => 'secondary', 'icon' => 'ban',           'label' => 'Dibatalkan',          'text' => 'white'],
];
?>
<style>
:root { --clr-primary:#c8681a; --clr-navy:#1a2a5e; }

.order-card {
    border: 0;
    border-radius: 14px;
    box-shadow: 0 2px 14px rgba(0,0,0,.07);
    margin-bottom: 1.2rem;
    transition: box-shadow .2s, transform .2s;
    overflow: hidden;
}
.order-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,.12); transform: translateY(-2px); }

.order-card-header {
    background: var(--clr-navy);
    color: #fff;
    padding: .8rem 1.25rem;
    font-size: .86rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: .5rem;
}
.order-id-badge {
    font-family: monospace;
    background: rgba(255,255,255,.18);
    border-radius: 6px;
    padding: 2px 10px;
    font-size: .82rem;
}
.item-thumb {
    width: 46px; height: 46px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #f0e8e0;
    flex-shrink: 0;
}
.btn-repay {
    background: var(--clr-primary);
    color: #fff;
    border: 0;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: .8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    transition: background .2s;
    cursor: pointer;
}
.btn-repay:hover { background: #a8531a; color: #fff; }

.btn-wa-sm {
    background: #25D366; color: #fff;
    border: 0; border-radius: 8px; padding: 6px 14px;
    font-size: .8rem; text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px;
    transition: background .2s;
}
.btn-wa-sm:hover { background: #1da851; color: #fff; }

.filter-pill { font-size: .8rem; border-radius: 20px; padding: 5px 16px; }
.filter-pill.active { background: var(--clr-primary); border-color: var(--clr-primary); color: #fff; }

.empty-state { text-align: center; padding: 4rem 1rem; color: #aaa; }
.empty-state i { font-size: 3.5rem; margin-bottom: 1rem; color: #ddd; display: block; }

.expire-bar {
    height: 4px;
    border-radius: 0;
    background: #e9ecef;
    position: relative;
    overflow: hidden;
}
.expire-fill {
    height: 100%;
    border-radius: 0;
    background: linear-gradient(90deg, #f59e0b, #ef4444);
    transition: width 1s linear;
}
.countdown-text { font-size: .72rem; color: #f59e0b; }
</style>

<div class="p-3 p-lg-4">
  <!-- Header -->
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <h4 class="fw-bold mb-0" style="color:var(--clr-navy)">
        <i class="fas fa-history me-2" style="color:var(--clr-primary)"></i>Riwayat Pembelian
      </h4>
      <p class="text-muted mb-0" style="font-size:.82rem">
        Total <?php echo count($orders); ?> pesanan ditemukan
      </p>
    </div>
    <a href="<?php echo site_url('produk'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill">
      <i class="fas fa-shopping-bag me-1"></i>Belanja Lagi
    </a>
  </div>

  <!-- Filter Tabs -->
  <div class="d-flex flex-wrap gap-2 mb-4">
    <?php foreach($statuses as $key => $s): ?>
    <a href="<?php echo site_url('user/orders?status=' . $key); ?>"
       class="btn btn-outline-secondary filter-pill <?php echo $active === $key ? 'active' : ''; ?>">
      <i class="fas fa-<?php echo $s['icon']; ?> me-1"></i><?php echo $s['label']; ?>
    </a>
    <?php endforeach; ?>
  </div>

  <?php if(empty($orders)): ?>
  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-body empty-state">
      <i class="fas fa-box-open"></i>
      <h5 class="fw-bold">Belum ada pesanan</h5>
      <p class="text-muted">Kamu belum punya pesanan<?php echo $active !== 'all' ? ' dengan status ini' : ''; ?>.</p>
      <a href="<?php echo site_url('produk'); ?>" class="btn rounded-pill px-4 text-white mt-1" style="background:var(--clr-primary)">
        <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
      </a>
    </div>
  </div>
  <?php else: ?>

  <?php foreach($orders as $order):
    $si = $status_info[$order['status']] ?? $status_info['pending'];
    $items = $order['items'] ?? [];
    
    // Hitung sisa waktu untuk pending
    $created_ts  = strtotime($order['created_at'] ?? 'now');
    $expire_ts   = $created_ts + ($EXPIRE_MINUTES * 60);
    $sisa_detik  = max(0, $expire_ts - $now);
    $pct_expired = min(100, round(($now - $created_ts) / ($EXPIRE_MINUTES * 60) * 100));
    $sisa_jam    = floor($sisa_detik / 3600);
    $sisa_menit  = floor(($sisa_detik % 3600) / 60);
    $can_repay   = ($order['status'] === 'pending') && ($sisa_detik > 0);

    // WhatsApp seller
    $toko_wa_raw = preg_replace('/[^0-9]/', '', $order['toko_wa'] ?? '');
    if($toko_wa_raw && substr($toko_wa_raw, 0, 2) == '08') $toko_wa_raw = '62' . substr($toko_wa_raw, 1);
    $wa_msg = urlencode("Halo ".htmlspecialchars($order['nama_toko'] ?? 'Seller').", saya ingin konfirmasi pesanan #".$order['order_id'].".");
    $wa_url = $toko_wa_raw ? "https://wa.me/{$toko_wa_raw}?text={$wa_msg}" : '#';

    $created_fmt = '-';
    try { $dt = new DateTime($order['created_at'] ?? 'now'); $created_fmt = $dt->format('d M Y, H:i'); } catch(Exception $e) {}
  ?>
  <div class="order-card card">
    <!-- Card Header -->
    <div class="order-card-header">
      <div>
        <span class="order-id-badge"><?php echo htmlspecialchars($order['order_id']); ?></span>
        <span class="ms-2 text-white-50" style="font-size:.76rem">
          <i class="fas fa-calendar me-1"></i><?php echo $created_fmt; ?>
        </span>
      </div>
      <span class="badge bg-<?php echo $si['badge']; ?> text-<?php echo $si['text']; ?> rounded-pill px-3">
        <i class="fas fa-<?php echo $si['icon']; ?> me-1"></i><?php echo $si['label']; ?>
      </span>
    </div>

    <!-- Expire bar untuk pending -->
    <?php if($order['status'] === 'pending' && $sisa_detik > 0): ?>
    <div class="expire-bar">
      <div class="expire-fill" style="width:<?php echo $pct_expired; ?>%"></div>
    </div>
    <?php endif; ?>

    <div class="card-body px-4 py-3">
      <div class="row g-3 align-items-center">
        <!-- Items -->
        <div class="col-md-7">
          <?php foreach(array_slice($items, 0, 2) as $item): ?>
          <div class="d-flex align-items-center gap-3 mb-2">
            <img src="<?php echo base_url('public/img/produk/' . ($item['gambar_produk'] ?? '')); ?>"
                 onerror="this.src='https://placehold.co/46x46/fef3ea/c8681a?text=P'"
                 class="item-thumb"
                 alt="<?php echo htmlspecialchars($item['nama_produk'] ?? '-'); ?>">
            <div>
              <div class="fw-semibold" style="font-size:.88rem"><?php echo htmlspecialchars($item['nama_produk'] ?? '-'); ?></div>
              <div class="text-muted" style="font-size:.78rem">
                <?php echo (int)($item['qty'] ?? 1); ?> x Rp <?php echo number_format($item['price'] ?? 0, 0, ',', '.'); ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php if(count($items) > 2): ?>
          <div class="text-muted" style="font-size:.76rem;padding-left:58px">+<?php echo count($items)-2; ?> item lainnya…</div>
          <?php endif; ?>
          <?php if(empty($items)): ?>
          <span class="text-muted" style="font-size:.82rem"><i class="fas fa-box-open me-1"></i>Tidak ada item</span>
          <?php endif; ?>
        </div>

        <!-- Info + Actions -->
        <div class="col-md-5">
          <div class="mb-1" style="font-size:.82rem">
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

          <!-- Timer countdown untuk pending -->
          <?php if($order['status'] === 'pending' && $sisa_detik > 0): ?>
          <div class="countdown-text mb-2" id="cd-<?php echo htmlspecialchars($order['order_id']); ?>">
            <i class="fas fa-clock me-1"></i>Batas bayar: <?php echo $sisa_jam > 0 ? $sisa_jam . 'j ' : ''; ?><?php echo $sisa_menit; ?>m lagi
          </div>
          <?php elseif($order['status'] === 'pending'): ?>
          <div class="text-danger mb-2" style="font-size:.76rem">
            <i class="fas fa-exclamation-triangle me-1"></i>Waktu pembayaran habis
          </div>
          <?php endif; ?>

          <div class="d-flex flex-wrap gap-2">
            <!-- Tombol Bayar Sekarang untuk pending yang masih bisa dibayar -->
            <?php if($can_repay && !empty($items)):
              $produk_id = $items[0]['produk_id'] ?? 0;
            ?>
            <a href="<?php echo site_url('payment/checkout/' . $produk_id . '?repay=' . urlencode($order['order_id'])); ?>"
               class="btn-repay">
              <i class="fas fa-credit-card"></i>Bayar Sekarang
            </a>
            <?php endif; ?>

            <a href="<?php echo site_url('payment/success?order_id=' . urlencode($order['order_id'])); ?>"
               class="btn btn-sm btn-outline-secondary rounded-pill">
              <i class="fas fa-receipt me-1"></i>Receipt
            </a>

            <?php if($toko_wa_raw && $order['status'] === 'paid'): ?>
            <a href="<?php echo $wa_url; ?>" target="_blank" class="btn-wa-sm">
              <i class="fab fa-whatsapp"></i>Seller
            </a>
            <?php endif; ?>

            <?php if($order['status'] === 'paid' && !empty($items)): 
               $id_produk_ulasan = $items[0]['id_produk'] ?? ($items[0]['produk_id'] ?? 0);
            ?>
            <a href="<?php echo site_url('produk/' . $id_produk_ulasan . '#reviewForm'); ?>" class="btn btn-sm btn-outline-primary rounded-pill">
              <i class="fas fa-star me-1"></i>Beri Ulasan
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

<script>
// Live countdown untuk semua order pending
(function() {
  var countdowns = document.querySelectorAll('[id^="cd-"]');
  if (!countdowns.length) return;
  
  setInterval(function() {
    var now = Math.floor(Date.now() / 1000);
    countdowns.forEach(function(el) {
      var orderId = el.id.replace('cd-', '');
      // Data diembed via PHP sudah terrender, hanya update tampilan
      // Untuk realtime countdown kita perlu expire_ts embedded
    });
  }, 60000);
})();
</script>
