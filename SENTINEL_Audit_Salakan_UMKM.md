# Laporan Audit SENTINEL — Salakan UMKM (CodeIgniter 3)


Tanggal: 7 Februari 2026 | Scope: Source code & konfigurasi dari salakan_umkm.zip


## 1. Ringkasan Eksekutif
Audit ini fokus pada keamanan, performa, dan maintainability aplikasi katalog UMKM berbasis
CodeIgniter 3 (modul publik, pengguna, penjual, admin, dan pembayaran iPaymu). Ditemukan
beberapa isu kritikal yang wajib diperbaiki sebelum deployment produksi.

## 2. Ruang Lingkup
- Konfigurasi: config.php, database.php, email.php, ipaymu.php, routes.php, index.php
- Controllers: Auth, Seller, Admin, User, Katalog, Ipaymu, Report
- Models: User_model, Produk_model, Order_model, Ulasan_model, Favorit_model, Toko_model, Kategori_model
- Skema DB: database/db_umkm_salakan (13).sql

## 3. Temuan Utama (Prioritas)
### CRITICAL
#### Privilege Escalation
- **Lokasi:** application/controllers/Auth.php (register)
- **Temuan:** Role diambil langsung dari input POST sehingga user bisa registrasi sebagai 'admin'.
- **Risiko:** Pengambilalihan penuh panel admin.
- **Rekomendasi:** Whitelist role di server (hanya 'pengguna'/'penjual'); admin dibuat manual.

#### Secrets Exposure
- **Lokasi:** application/config/email.php & application/config/ipaymu.php
- **Temuan:** Kredensial SMTP & API key iPaymu tertanam di repo.
- **Risiko:** Kebocoran akses email/pembayaran, penyalahgunaan akun.
- **Rekomendasi:** Rotasi kredensial segera; pindahkan ke env; commit .example saja.

### HIGH
#### Missing Auth Guard
- **Lokasi:** application/controllers/Seller.php & Report.php
- **Temuan:** Tidak ada pengecekan login/role di constructor; beberapa endpoint bisa diakses tanpa role penjual.
- **Risiko:** Akses tidak sah / error state / potensi modifikasi data.
- **Rekomendasi:** Tambahkan guard is_logged_in + role == 'penjual' + validasi toko disetujui.

#### CSRF Disabled
- **Lokasi:** application/config/config.php
- **Temuan:** csrf_protection = FALSE; banyak aksi POST/GET sensitif tanpa CSRF.
- **Risiko:** CSRF pada aksi admin/seller/user (hapus/edit).
- **Rekomendasi:** Aktifkan CSRF dan update form/AJAX token.

#### Debug/Diagnostic Endpoints
- **Lokasi:** application/controllers/Ipaymu.php (sys/diag)
- **Temuan:** Endpoint bisa membocorkan config dan membuat order test.
- **Risiko:** Info leakage & abuse.
- **Rekomendasi:** Hapus di produksi atau lindungi dengan admin key/IP allowlist.

### MEDIUM
#### Weak Reset OTP
- **Lokasi:** Auth.php + User_model reset_token
- **Temuan:** OTP reset 6 digit disimpan plain; rentan brute force tanpa rate limit.
- **Risiko:** Reset akun tanpa izin (jika brute force berhasil).
- **Rekomendasi:** Gunakan token panjang (random_bytes), simpan hash, rate limit & lockout.

#### ENV default development
- **Lokasi:** index.php
- **Temuan:** ENVIRONMENT default 'development' jika CI_ENV tidak diset.
- **Risiko:** Error detail tampil di produksi.
- **Rekomendasi:** Set CI_ENV=production di server; matikan display_errors.

#### Query/Logic Bug
- **Lokasi:** application/models/Produk_model.php
- **Temuan:** get_produk_by_kategori() mengembalikan produk berdasarkan id_kategori sebagai id produk.
- **Risiko:** Fitur kategori salah / data tidak konsisten.
- **Rekomendasi:** Perbaiki query: filter id_kategori lalu return result_array().

### LOW
#### Redundant Rating Update
- **Lokasi:** Ulasan_model + DB triggers
- **Temuan:** Ada triggers update rating dan juga recalculation di aplikasi.
- **Risiko:** Overhead & potensi inkonsistensi.
- **Rekomendasi:** Pilih salah satu (prefer aplikasi), hapus yang lain.

## 4. Rekomendasi Perbaikan
### 4.1 Perbaikan segera (wajib sebelum produksi)
1. Rotasi semua kredensial yang sudah terlanjur tertanam (SMTP & iPaymu).
2. Perbaiki register: block pendaftaran role 'admin'.
3. Tambahkan auth guard untuk Seller & Report (role-based).
4. Aktifkan CSRF + update semua form dan request AJAX.
5. Matikan endpoint sys/diag iPaymu di produksi.
6. Set CI_ENV=production dan audit error/logging.
### 4.2 Hardening keamanan (1-3 hari)
- Set cookie_secure, cookie_httponly, dan SameSite; paksa HTTPS.
- Tambah login throttling (rate limit) + audit log untuk login/reset.
- Tambah header keamanan (CSP dasar, X-Frame-Options, X-Content-Type-Options).
- Kunci upload directory (deny eksekusi .php), validasi MIME & ukuran gambar.
### 4.3 Optimasi performa (bertahap)
- Optimalkan listing produk: hindari join subquery favorit_count untuk query count/pagination; pertimbangkan precompute total_favorit atau cache.
- Tambah index & FK tambahan pada orders (id_toko, id_user) bila diperlukan untuk laporan/riwayat.
- Implement cache sederhana (home, produk list per filter) dan optimasi gambar (resize + WebP).

## 5. Checklist Deploy Produksi (Ringkas)
- CI_ENV=production, display_errors=Off, logging sesuai kebutuhan
- HTTPS + redirect 80->443 + HSTS
- DB user non-root, password kuat, least privilege
- Secrets via environment, tidak ada key di repo
- CSRF enabled, session cookie secure
- Backup & migrasi DB + uji restore
