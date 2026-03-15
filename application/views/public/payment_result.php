<?php
// application/views/public/payment_result.php
// Receipt halaman setelah pembayaran berhasil/pending
$order_id    = isset($order['order_id'])    ? htmlspecialchars($order['order_id'])    : '-';
$status      = isset($order['status'])      ? $order['status']                        : 'pending';
$total       = isset($order['total'])       ? (int)$order['total']                   : 0;
$buyer_name  = isset($order['buyer_name'])  ? htmlspecialchars($order['buyer_name'])  : '-';
$buyer_wa    = isset($order['buyer_wa'])    ? htmlspecialchars($order['buyer_wa'])    : '-';
$buyer_addr  = isset($order['buyer_address'])? htmlspecialchars($order['buyer_address']) : '-';
$buyer_city  = isset($order['buyer_city'])  ? htmlspecialchars($order['buyer_city'])  : '-';
$buyer_note  = isset($order['buyer_note'])  ? htmlspecialchars($order['buyer_note'])  : '-';
$toko_nama   = isset($toko['nama_toko'])    ? htmlspecialchars($toko['nama_toko'])    : '-';
$toko_wa     = isset($toko['no_wa'])        ? preg_replace('/[^0-9]/', '', $toko['no_wa']) : '';
$items       = isset($order_items) && is_array($order_items) ? $order_items : [];
$created_at  = isset($order['created_at'])  ? $order['created_at']                   : date('Y-m-d H:i:s');

$status_label = array(
    'pending'   => ['Menunggu Pembayaran', 'warning', 'clock'],
    'paid'      => ['Pembayaran Berhasil', 'success', 'check-circle'],
    'failed'    => ['Pembayaran Gagal',    'danger',  'times-circle'],
    'cancelled' => ['Dibatalkan',          'secondary','ban'],
);
$sl = isset($status_label[$status]) ? $status_label[$status] : ['Menunggu', 'warning', 'clock'];

$isPaid    = $status === 'paid';
$isPending = $status === 'pending';

$wa_msg = urlencode(
    "Halo " . strip_tags($toko_nama) . ", saya baru saja melakukan pembayaran di UMKM Banggai.\n"
  . "Order ID: " . strip_tags($order_id) . "\n"
  . "Nama: " . strip_tags($buyer_name) . "\n"
  . "Alamat: " . strip_tags($buyer_addr) . ", " . strip_tags($buyer_city) . "\n"
  . "Total: Rp " . number_format($total, 0, ',', '.') . "\n"
  . "Mohon konfirmasi pesanan saya. Terima kasih!"
);
$wa_url   = $toko_wa ? "https://wa.me/" . ltrim($toko_wa, '0') . "62?text=" . $wa_msg : '#';
if($toko_wa && substr($toko_wa, 0, 2) == '08') {
    $wa_intl = '62' . substr($toko_wa, 1);
    $wa_url  = "https://wa.me/" . $wa_intl . "?text=" . $wa_msg;
}
?>
<style>
:root {
  --clr-primary: #c8681a;
  --clr-navy: #1a2a5e;
}
.result-section { padding: 2.5rem 0 4rem; }
.result-card {
  border: 0;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0,0,0,.08);
}
.result-card .card-header {
  border-radius: 16px 16px 0 0 !important;
  background: var(--clr-navy);
  color: #fff;
  font-weight: 700;
  padding: 1rem 1.5rem;
}
.order-id-badge {
  font-family: monospace;
  background: #f0f4ff;
  border-radius: 8px;
  padding: 4px 12px;
  font-size: .88rem;
  color: var(--clr-navy);
  border: 1px solid #d0d9f0;
}
.table-items th { background: #f8f5f2; font-weight: 600; font-size: .85rem; }
.table-items td { vertical-align: middle; font-size: .9rem; }
.btn-wa {
  background: #25D366;
  color: #fff;
  border: 0;
  border-radius: 12px;
  font-weight: 700;
  padding: .85rem 1.5rem;
  width: 100%;
  font-size: 1rem;
  text-decoration: none;
  display: block;
  text-align: center;
  transition: background .2s;
}
.btn-wa:hover { background: #1da851; color: #fff; }
.info-box-blue {
  border-radius: 12px;
  background: #e8f4fd;
  border-left: 4px solid #1d6fa4;
  padding: 1rem 1.2rem;
  font-size: .875rem;
  color: #155a80;
}
.success-icon { font-size: 5rem; margin-bottom: 1rem; }
.icon-pending { color: #f59e0b; }
.icon-paid    { color: #16a34a; }
.icon-failed  { color: #dc2626; }
.btn-outline-primary { border-color: var(--clr-primary); color: var(--clr-primary); }
.btn-outline-primary:hover { background: var(--clr-primary); color: #fff; }
.print-btn { display: none; }
@media print {
  .no-print { display: none !important; }
  .print-btn { display: block !important; }
}
</style>

<div class="container result-section">
  <!-- Hero status -->
  <div class="text-center mb-5">
    <div class="success-icon icon-<?php echo $sl[1] === 'success' ? 'paid' : ($sl[1] === 'danger' ? 'failed' : 'pending'); ?>">
      <i class="fas fa-<?php echo $sl[2]; ?>"></i>
    </div>
    <h2 class="fw-bold" style="color:var(--clr-navy)"><?php echo $sl[0]; ?></h2>
    <?php if($isPaid): ?>
    <div class="alert alert-success d-inline-flex align-items-center gap-2 rounded-pill px-4">
      <i class="fas fa-check-circle"></i>
      <span>Pesanan Anda telah diterima! Seller akan segera menghubungi Anda.</span>
    </div>
    <?php elseif($isPending): ?>
    <div class="alert alert-warning d-inline-flex align-items-center gap-2 rounded-pill px-4">
      <i class="fas fa-clock"></i>
      <span>Pembayaran sedang diproses. Harap selesaikan pembayaran Anda.</span>
    </div>
    <?php endif; ?>
  </div>

  <div class="row g-4">
    <!-- LEFT: Detail Pesanan -->
    <div class="col-lg-7">
      <div class="card result-card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <span><i class="fas fa-receipt me-2"></i>Detail Pesanan</span>
          <button onclick="window.print()" class="btn btn-sm btn-outline-light no-print">
            <i class="fas fa-print me-1"></i>Cetak
          </button>
        </div>
        <div class="card-body p-4">
          <!-- Order meta -->
          <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
              <div>
                <span class="text-muted me-2" style="font-size:.85rem">Order ID:</span>
                <span class="order-id-badge"><?php echo $order_id; ?></span>
              </div>
              <span class="badge bg-<?php echo $sl[1]; ?> rounded-pill px-3 py-2">
                <i class="fas fa-<?php echo $sl[2]; ?> me-1"></i><?php echo ucfirst($sl[0]); ?>
              </span>
            </div>
            <div class="text-muted" style="font-size:.85rem">
              <i class="fas fa-calendar me-1"></i>
              <?php 
                try { 
                  $dt = new DateTime($created_at); 
                  echo $dt->format('d F Y, H:i'); 
                } catch(Exception $e) { 
                  echo htmlspecialchars($created_at); 
                } 
              ?>
            </div>
          </div>

          <!-- Items table -->
          <table class="table table-items table-bordered mb-3">
            <thead>
              <tr>
                <th>Produk</th>
                <th class="text-center">Qty</th>
                <th class="text-end">Harga</th>
                <th class="text-end">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($items)): foreach($items as $item): ?>
              <tr>
                <td><?php echo htmlspecialchars($item['nama_produk'] ?? $item['item_name'] ?? '-'); ?></td>
                <td class="text-center"><?php echo (int)($item['qty'] ?? 1); ?></td>
                <td class="text-end">Rp <?php echo number_format($item['price'] ?? 0, 0, ',', '.'); ?></td>
                <td class="text-end">Rp <?php echo number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1), 0, ',', '.'); ?></td>
              </tr>
              <?php endforeach; else: ?>
              <tr>
                <td colspan="4" class="text-center text-muted">Data produk tidak tersedia</td>
              </tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr class="table-light fw-bold">
                <td colspan="3" class="text-end">Total Pembayaran</td>
                <td class="text-end" style="color:var(--clr-primary)">
                  Rp <?php echo number_format($total, 0, ',', '.'); ?>
                </td>
              </tr>
            </tfoot>
          </table>

          <!-- Buyer info -->
          <div class="bg-light rounded-3 p-3">
            <h6 class="fw-bold mb-2" style="font-size:.88rem;color:var(--clr-navy)"><i class="fas fa-user me-1"></i>Info Pembeli</h6>
            <div class="row g-1" style="font-size:.85rem">
              <div class="col-4 text-muted">Nama</div>
              <div class="col-8"><?php echo $buyer_name; ?></div>
              <div class="col-4 text-muted">WhatsApp</div>
              <div class="col-8"><?php echo $buyer_wa; ?></div>
              <div class="col-4 text-muted">Alamat</div>
              <div class="col-8"><?php echo $buyer_addr; ?>, <?php echo $buyer_city; ?></div>
              <?php if($buyer_note && $buyer_note !== '-'): ?>
              <div class="col-4 text-muted">Catatan</div>
              <div class="col-8"><?php echo $buyer_note; ?></div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT: Seller + Action -->
    <div class="col-lg-5">
      <!-- Seller card -->
      <div class="card result-card mb-3">
        <div class="card-header"><i class="fas fa-store me-2"></i>Info Seller</div>
        <div class="card-body p-4">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center"
                 style="width:52px;height:52px;background:#f0e8e0;font-size:1.4rem;color:var(--clr-primary)">
              <i class="fas fa-store"></i>
            </div>
            <div>
              <div class="fw-bold" style="color:var(--clr-navy)"><?php echo $toko_nama; ?></div>
              <?php if($toko_wa): ?>
              <div class="text-muted" style="font-size:.82rem"><i class="fab fa-whatsapp text-success me-1"></i><?php echo htmlspecialchars($toko['no_wa'] ?? $toko_wa); ?></div>
              <?php endif; ?>
            </div>
          </div>
          
          <?php if($toko_wa): ?>
          <a href="<?php echo $wa_url; ?>" target="_blank" class="btn-wa">
            <i class="fab fa-whatsapp me-2"></i>Hubungi Seller via WhatsApp
          </a>
          <?php else: ?>
          <div class="alert alert-secondary rounded-3 text-center">
            <i class="fas fa-info-circle me-1"></i>Kontak seller belum tersedia
          </div>
          <?php endif; ?>

          <div class="info-box-blue mt-3">
            <i class="fas fa-truck me-1"></i>
            Koordinasikan pengiriman langsung dengan seller melalui WhatsApp. Website ini belum menyediakan layanan pengiriman otomatis.
          </div>
        </div>
      </div>

      <!-- Navigation buttons (no-print) -->
      <div class="d-grid gap-2 no-print">
        <a href="<?php echo site_url(); ?>" class="btn btn-outline-primary rounded-pill py-2">
          <i class="fas fa-home me-2"></i>Kembali ke Beranda
        </a>
        <?php if($this->session->userdata('id')): ?>
        <a href="<?php echo site_url('user/orders'); ?>" class="btn rounded-pill py-2 text-white" style="background:var(--clr-primary)">
          <i class="fas fa-history me-2"></i>Lihat Riwayat Pembelian
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>