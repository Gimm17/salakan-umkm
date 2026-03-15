<?php
// application/views/public/checkout.php
// Dipanggil dari Payment::checkout()
$produk_harga = isset($produk['harga']) ? (int)$produk['harga'] : 0;
$produk_nama  = isset($produk['nama_produk']) ? htmlspecialchars($produk['nama_produk']) : '-';
$toko_nama    = isset($toko['nama_toko']) ? htmlspecialchars($toko['nama_toko']) : '-';
$toko_wa      = isset($toko['no_wa']) ? htmlspecialchars($toko['no_wa']) : '';
$produk_gambar= isset($produk['gambar_produk']) ? base_url('public/img/produk/' . $produk['gambar_produk']) : '';
$csrf_name    = $this->security->get_csrf_token_name();
$csrf_hash    = $this->security->get_csrf_hash();
?>
<style>
:root {
  --clr-primary: #c8681a;
  --clr-primary-dark: #a0521a;
  --clr-navy: #1a2a5e;
  --clr-navy-dark: #111b3d;
}
.checkout-section { padding: 2.5rem 0 4rem; }
.section-card {
  border: 0;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0,0,0,.07);
}
.section-card .card-header {
  border-radius: 16px 16px 0 0 !important;
  background: var(--clr-navy);
  color: #fff;
  font-weight: 700;
  font-size: 1rem;
  padding: 1rem 1.5rem;
}
.form-label { font-weight: 600; font-size: .9rem; color: #444; }
.form-control:focus, .form-select:focus {
  border-color: var(--clr-primary);
  box-shadow: 0 0 0 .2rem rgba(200,104,26,.18);
}
.btn-bayar {
  background: var(--clr-primary);
  color: #fff;
  border: 0;
  border-radius: 12px;
  font-weight: 700;
  padding: .85rem 1.5rem;
  font-size: 1rem;
  width: 100%;
  transition: background .2s;
}
.btn-bayar:hover { background: var(--clr-primary-dark); color: #fff; }
.summary-img {
  width: 72px;
  height: 72px;
  object-fit: cover;
  border-radius: 10px;
  border: 2px solid #f0e8e0;
}
.qty-btn {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  border: 1px solid #ddd;
  background: #f8f8f8;
  font-size: 1.1rem;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: background .15s;
}
.qty-btn:hover { background: #f0e8e0; border-color: var(--clr-primary); }
#qty-display { width: 42px; text-align: center; font-weight: 700; }
.info-box {
  border-radius: 12px;
  background: #e8f4fd;
  border-left: 4px solid #1d6fa4;
  padding: 1rem 1.2rem;
  font-size: .875rem;
  color: #155a80;
}
.total-row {
  border-top: 2px solid #f0e8e0;
  padding-top: .75rem;
  margin-top: .75rem;
}
.secure-badge { font-size: .78rem; color: #888; text-align: center; margin-top: .5rem; }
</style>

<div class="container checkout-section">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-white rounded-pill px-4 py-2 shadow-sm">
      <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>" class="text-decoration-none"><i class="fas fa-home me-1"></i>Beranda</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url('produk'); ?>" class="text-decoration-none">Produk</a></li>
      <li class="breadcrumb-item"><a href="<?php echo site_url('produk/' . $produk['id']); ?>" class="text-decoration-none"><?php echo $produk_nama; ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">Checkout</li>
    </ol>
  </nav>

  <h2 class="fw-bold mb-4" style="color:var(--clr-navy)"><i class="fas fa-shopping-cart me-2" style="color:var(--clr-primary)"></i>Checkout</h2>

  <form id="checkout-form" novalidate>
    <input type="hidden" id="csrf-token-input" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>">
    <input type="hidden" name="produk_id" value="<?php echo (int)$produk['id']; ?>">

    <div class="row g-4">
      <!-- LEFT: Form Detail -->
      <div class="col-lg-8">
        <div class="card section-card h-100">
          <div class="card-header"><i class="fas fa-user me-2"></i>Detail Pembeli & Pengiriman</div>
          <div class="card-body p-4">
            <div class="mb-3">
              <label for="buyer_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="buyer_name" name="buyer_name"
                     placeholder="Masukkan nama lengkap Anda" required
                     value="<?php echo htmlspecialchars($this->session->userdata('nama') ?: ''); ?>">
              <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
            </div>

            <div class="mb-3">
              <label for="buyer_wa" class="form-label"><i class="fab fa-whatsapp text-success me-1"></i>Nomor WhatsApp <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
                <input type="tel" class="form-control" id="buyer_wa" name="buyer_wa"
                       placeholder="08xxxxxxxxxx" required
                       value="<?php echo htmlspecialchars($this->session->userdata('no_hp') ?: ''); ?>">
              </div>
              <div class="invalid-feedback">Nomor WhatsApp wajib diisi.</div>
            </div>

            <div class="mb-3">
              <label for="buyer_address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
              <textarea class="form-control" id="buyer_address" name="buyer_address" rows="3"
                        placeholder="Jl. Contoh No. 123, RT/RW 01/02" required></textarea>
              <div class="invalid-feedback">Alamat wajib diisi.</div>
            </div>

            <div class="mb-3">
              <label for="buyer_city" class="form-label">Kota / Kabupaten <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="buyer_city" name="buyer_city"
                     placeholder="Contoh: Luwuk, Banggai" required>
              <div class="invalid-feedback">Kota/Kabupaten wajib diisi.</div>
            </div>

            <div class="mb-1">
              <label for="buyer_note" class="form-label">Catatan untuk Seller <span class="text-muted">(opsional)</span></label>
              <textarea class="form-control" id="buyer_note" name="buyer_note" rows="2"
                        placeholder="Contoh: titip di teras, jangan buka pintu pagar..."></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- RIGHT: Order Summary -->
      <div class="col-lg-4">
        <div class="card section-card mb-3">
          <div class="card-header"><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</div>
          <div class="card-body p-4">
            <div class="d-flex align-items-start gap-3 mb-3">
              <img src="<?php echo $produk_gambar; ?>"
                   onerror="this.src='https://placehold.co/72x72/fef3ea/c8681a?text=P';"
                   class="summary-img" alt="<?php echo $produk_nama; ?>">
              <div>
                <div class="fw-bold" style="font-size:.95rem"><?php echo $produk_nama; ?></div>
                <div class="text-muted" style="font-size:.82rem"><i class="fas fa-store me-1"></i><?php echo $toko_nama; ?></div>
                <div class="fw-bold mt-1" style="color:var(--clr-primary)">
                  Rp <?php echo number_format($produk_harga, 0, ',', '.'); ?>
                </div>
              </div>
            </div>

            <!-- Qty control -->
            <div class="d-flex align-items-center gap-2 mb-3">
              <span class="text-muted" style="font-size:.88rem">Jumlah:</span>
              <button type="button" class="qty-btn" id="qty-minus">−</button>
              <input type="number" id="qty-display" name="qty" value="1" min="1" max="<?php echo isset($produk['stok']) ? (int)$produk['stok'] : 99; ?>" class="form-control-plaintext">
              <button type="button" class="qty-btn" id="qty-plus">+</button>
            </div>

            <div class="total-row d-flex justify-content-between align-items-center">
              <span class="fw-bold">Total</span>
              <span class="fw-bold fs-5" style="color:var(--clr-primary)" id="total-display">
                Rp <?php echo number_format($produk_harga, 0, ',', '.'); ?>
              </span>
            </div>

            <button type="submit" class="btn-bayar mt-3" id="btn-lanjutkan">
              <i class="fas fa-lock me-2"></i>Lanjutkan Pembayaran
            </button>
            <div class="secure-badge"><i class="fas fa-shield-alt me-1 text-success"></i>Pembayaran aman dengan Midtrans</div>
          </div>
        </div>

        <!-- Info box -->
        <div class="info-box">
          <i class="fas fa-info-circle me-2"></i>
          Setelah pembayaran berhasil, seller akan menghubungi Anda via <strong>WhatsApp</strong> untuk koordinasi pengiriman.
        </div>
      </div>
    </div>
  </form>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo 'CHANGE_ME_MIDTRANS_CLIENT_KEY'; ?>"></script>
<script>
(function(){
  var harga   = <?php echo $produk_harga; ?>;
  var stok    = <?php echo isset($produk['stok']) ? (int)$produk['stok'] : 99; ?>;
  var qty     = 1;
  var qtyEl   = document.getElementById('qty-display');
  var totalEl = document.getElementById('total-display');

  function fmt(n) {
    return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }
  function updateTotal() {
    qtyEl.value = qty;
    totalEl.textContent = fmt(harga * qty);
  }

  document.getElementById('qty-minus').addEventListener('click', function(){
    if(qty > 1){ qty--; updateTotal(); }
  });
  document.getElementById('qty-plus').addEventListener('click', function(){
    if(qty < stok){ qty++; updateTotal(); }
  });
  qtyEl.addEventListener('change', function(){
    qty = Math.max(1, Math.min(stok, parseInt(this.value)||1));
    updateTotal();
  });

  // Form submit → validasi → minta token → snap.pay()
  document.getElementById('checkout-form').addEventListener('submit', function(e){
    e.preventDefault();
    var form = this;
    if(!form.checkValidity()){
      form.classList.add('was-validated');
      return;
    }
    form.classList.remove('was-validated');

    var btn = document.getElementById('btn-lanjutkan');
    var ori = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';

    var csrfInput = document.getElementById('csrf-token-input');
    var params = new URLSearchParams(new FormData(form));
    params.set('qty', qty);

    fetch("<?php echo site_url('payment/create'); ?>", {
      method: 'POST',
      headers:{
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: params
    })
    .then(function(r){
      var fresh = r.headers.get('X-CSRF-Token');
      if(fresh && csrfInput) csrfInput.value = fresh;
      if(!r.ok) return r.text().then(function(t){
        var p=null; try{p=JSON.parse(t);}catch(x){}
        throw new Error(p&&p.error ? p.error : 'HTTP '+r.status+': '+t.slice(0,200));
      });
      return r.json();
    })
    .then(function(res){
      if(!res.token) throw new Error('Token tidak diterima: '+JSON.stringify(res));
      snap.pay(res.token, {
        onSuccess: function(){
          window.location = "<?php echo site_url('payment/success'); ?>?order_id="+res.order_id;
        },
        onPending: function(){
          window.location = "<?php echo site_url('payment/success'); ?>?order_id="+res.order_id+"&status=pending";
        },
        onError: function(r){
          Swal.fire('Pembayaran Gagal','Silakan coba lagi atau gunakan metode bayar lain.','error');
        },
        onClose: function(){
          Swal.fire({icon:'warning',title:'Pembayaran Dibatalkan',text:'Popup ditutup sebelum selesai.',toast:true,position:'top-end',showConfirmButton:false,timer:3000});
        }
      });
    })
    .catch(function(err){
      Swal.fire('Oops...', err.message, 'error');
    })
    .finally(function(){
      btn.disabled = false;
      btn.innerHTML = ori;
    });
  });
})();
</script>
