# Panduan Deployment cPanel (Tanpa Terminal)

Panduan ini akan membantu Anda mengupload project CodeIgniter Anda ke hosting cPanel menggunakan File Manager.

## 1. Persiapan File

Saya telah membuat file zip bernama `project_upload.zip` di folder project Anda. File ini berisi semua file yang diperlukan, **kecuali** folder `v1` sampai `v6` yang tidak Anda butuhkan.

## 2. Upload File ke cPanel

1.  Login ke cPanel hosting Anda.
2.  Buka menu **File Manager**.
3.  Masuk ke folder `public_html` (atau subfolder jika Anda ingin menginstall di sub-domain/sub-folder).
4.  Klik tombol **Upload** di baris atas.
5.  Pilih file `project_upload.zip` dari komputer Anda.
6.  Setelah selesai upload, kembali ke File Manager.
7.  Klik kanan pada `project_upload.zip` dan pilih **Extract**.
8.  Pastikan semua file terekstrak di tempat yang benar.

## 3. Konfigurasi Database

1.  Di cPanel, buka menu **MySQL® Database Wizard**.
2.  **Step 1:** Buat database baru (misal: `username_umkm`). Catat nama database ini.
3.  **Step 2:** Buat user database baru. Catat username dan password yang Anda buat.
4.  **Step 3:** Berikan user akses ke database (pilih **All Privileges**).
5.  Buka menu **phpMyAdmin** di cPanel.
6.  Pilih database yang baru Anda buat di panel kiri.
7.  Klik tab **Import** di bagian atas.
8.  Klik **Choose File** dan pilih file database SQL Anda (misal: `database/db_umkm_salakan (13).sql`).
9.  Klik **Go** atau **Import** di bagian bawah.

## 4. Konfigurasi Koneksi Database

Anda perlu mengedit file `application/config/database.php` di File Manager cPanel.

1.  Di File Manager, buka `application/config/`.
2.  Klik kanan file `database.php` dan pilih **Edit**.
3.  Ubah bagian berikut sesuai data database yang Anda buat di langkah 3:

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'USERNAME_DATABASE_ANDA', // Ganti dengan username user database
    'password' => 'PASSWORD_DATABASE_ANDA', // Ganti dengan password user database
    'database' => 'NAMA_DATABASE_ANDA',     // Ganti dengan nama database lengkap
    'dbdriver' => 'mysqli',
    // ... baris lainnya biarkan standar
);
```

4.  Simpan perubahan (**Save Changes**).

## 5. Konfigurasi Base URL (Sudah Dikonfigurasi)

Saya sudah mengkonfigurasi file `application/config/config.php` dengan URL hosting Anda (`https://independent-lime-mole.195-88-211-74.cpanel.site/`).

Namun, jika Anda ingin memastikan atau mengubahnya di masa depan:

1.  Di File Manager, buka `application/config/`.
2.  Klik kanan file `config.php` dan pilih **Edit**.
3.  Cari `$config['base_url']` dan pastikan isinya:

```php
$config['base_url'] = 'https://independent-lime-mole.195-88-211-74.cpanel.site/';
```

4.  Jika sudah benar, tutup saja file tersebut.

## 6. (Opsional) Menghilangkan index.php

Jika link website Anda error (404 Not Found) saat diklik menu-menunya, pastikan file `.htaccess` ada di folder utama (sejajar dengan `index.php`).

Isi file `.htaccess` standar untuk CodeIgniter:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```

Pastikan juga di `application/config/config.php`:

```php
$config['index_page'] = ''; // Kosongkan jika menggunakan .htaccess
```

## Selesai!

Website Anda sekarang seharusnya sudah bisa diakses.

## Troubleshooting

### Jika Muncul Banyak Tulisan Error (Deprecated)

Jika website Anda penuh dengan tulisan error seperti `Deprecated: Creation of dynamic property...`, itu karena versi PHP di hosting Anda terlalu baru (PHP 8.1+).

**Cara Memperbaiki (Tanpa Upload Ulang Semua):**

1.  Buka File Manager di cPanel.
2.  Edit file `index.php` di folder utama.
3.  Cari baris (sekitar baris 56):
    ```php
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
    ```
4.  Ubah menjadi:
    ```php
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');
    ```
5.  Simpan file. Error tersebut akan hilang.

_(Catatan: File `project_upload.zip` yang baru saya buatkan SUDAH menyertakan perbaikan ini)_
