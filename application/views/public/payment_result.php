<!doctype html>
<html><head><meta charset="utf-8"><title>Hasil Pembayaran</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head><body class="container py-4">
<h3 class="mb-3">Hasil Pembayaran</h3>
<?php if (!empty($order)): ?>
<div class="card"><div class="card-body">
<p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']) ?></p>
<p><strong>Total:</strong> Rp<?= number_format($order['total'],0,',','.') ?></p>
<p><strong>Status:</strong> <span class="badge bg-<?php $map=['paid'=>'success','pending'=>'warning','failed'=>'danger','canceled'=>'secondary','expired'=>'secondary','refunded'=>'info']; echo $map[$order['status']] ?? 'secondary'; ?>"><?= strtoupper($order['status']) ?></span></p>
<a class="btn btn-primary" href="<?= site_url() ?>">Kembali ke Beranda</a>
</div></div>
<?php else: ?><div class="alert alert-warning">Order tidak ditemukan.</div><?php endif; ?>
</body></html>