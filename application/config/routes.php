<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'home';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

// // --- SEBELUMNYA ---

// // --- Rute Publik ---
// $route['produk'] = 'katalog/index';
// $route['produk/(:num)'] = 'katalog/detail/$1';
// $route['toko'] = 'katalog/toko';
// $route['toko/(:num)'] = 'katalog/detail_toko/$1'; // Perbaiki ini: detailToko -> detail_toko
// $route['kategori/(:any)'] = 'katalog/kategori/$1';

// // --- Rute Autentikasi ---
// $route['login'] = 'auth/login';
// $route['register'] = 'auth/register';
// $route['logout'] = 'auth/logout';

// // --- Rute Aksi (AJAX) ---
// $route['favorit/toggle'] = 'user/toggle_favorit';

// // --- Rute Dasbor Pengguna ---
// $route['user/dashboard'] = 'user/index';
// $route['user/profil'] = 'user/profil';
// $route['user/favorit'] = 'user/favorit';

// // --- Rute Dasbor Penjual ---
// $route['seller/dashboard'] = 'seller/index';
// $route['seller/produk'] = 'seller/produk';
// $route['seller/produk/tambah'] = 'seller/tambah_produk';
// $route['seller/produk/edit/(:num)'] = 'seller/edit_produk/$1';
// // (Rute untuk proses simpan/update/hapus akan ditangani via form action)
// $route['seller/toko'] = 'seller/pengaturan_toko';


// // --- Rute Dasbor Admin ---
// $route['admin/dashboard'] = 'admin/index';
// $route['admin/pengguna'] = 'admin/manajemen_pengguna';
// $route['admin/toko'] = 'admin/manajemen_toko';
// $route['admin/toko/setujui/(:num)'] = 'admin/setujui_toko/$1';
// $route['admin/toko/tolak/(:num)'] = 'admin/tolak_toko/$1';
// $route['admin/kategori'] = 'admin/manajemen_kategori';
// // (Rute untuk proses simpan/update/hapus kategori akan ditangani via form action)

// Tambahkan ini ke file config/routes.php

// Review routes
$route['user/ulasan'] = 'user/ulasan_saya';
$route['user/tambah_ulasan'] = 'user/tambah_ulasan';
$route['user/edit_ulasan'] = 'user/edit_ulasan';
$route['user/hapus_ulasan'] = 'user/hapus_ulasan';

// Email Change routes (v6 patch)
$route['user/email'] = 'user/email';
$route['user/email_verify'] = 'user/email_verify';
$route['user/email_change_request'] = 'user/email_change_request';
$route['user/email_change_verify/(:any)'] = 'user/email_change_verify/$1';
$route['user/email_change_verify'] = 'user/email_change_verify';

// Load more reviews
$route['katalog/load_ulasan/(:num)'] = 'katalog/load_ulasan/$1';

// Existing routes tetap sama...
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Authentication routes
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';

// Public routes
$route['produk'] = 'katalog/produk';
$route['produk/(:num)'] = 'katalog/detail/$1';
$route['toko'] = 'katalog/toko';
$route['toko/(:num)'] = 'katalog/detail_toko/$1';

// Dashboard routes
$route['admin'] = 'admin/index';
$route['admin/dashboard'] = 'admin/index';
$route['admin/users'] = 'admin/manajemen_pengguna';
$route['admin/toko'] = 'admin/manajemen_toko';
$route['admin/profile'] = 'admin/profile'; // Rute Baru Admin

// --- PERUBAHAN DIMULAI: Rute untuk Manajemen Kategori ---
$route['admin/kategori'] = 'admin/manajemen_kategori'; // Nama alias yang lebih baik
$route['admin/manajemen_kategori'] = 'admin/manajemen_kategori';
$route['admin/kategori/update/(:num)'] = 'admin/update_kategori/$1';
$route['admin/kategori/hapus/(:num)'] = 'admin/hapus_kategori/$1';
// --- PERUBAHAN SELESAI ---

$route['seller'] = 'seller/index';
$route['seller/dashboard'] = 'seller/index';
$route['seller/produk'] = 'seller/produk';
$route['seller/produk/tambah'] = 'seller/tambah_produk';
$route['seller/produk/edit/(:num)'] = 'seller/edit_produk/$1';
$route['seller/produk/hapus/(:num)'] = 'seller/hapus_produk/$1';
$route['seller/toko'] = 'seller/pengaturan_toko';
$route['seller/profile'] = 'seller/profile'; // Rute Baru Seller

$route['user'] = 'user/index';
$route['user/dashboard'] = 'user/index';
$route['user/profile'] = 'user/profile';
$route['user/edit-profile'] = 'user/edit_profile';
$route['user/favorit'] = 'user/favorit';

// Tambahkan routes ini untuk seller review management
$route['seller/ulasan'] = 'seller/ulasan';
$route['seller/setujui_ulasan/(:num)'] = 'seller/setujui_ulasan/$1';
$route['seller/tolak_ulasan/(:num)'] = 'seller/tolak_ulasan/$1';
$route['seller/hapus_ulasan/(:num)'] = 'seller/hapus_ulasan/$1';

// --- RUTE BARU UNTUK LUPA PASSWORD ---
$route['auth/forgot_password'] = 'auth/forgot_password';
$route['auth/reset_password/(:any)'] = 'auth/reset_password/$1';

// iPaymu legacy (biarkan agar URL lama tidak 404)
$route['ipaymu/create'] = 'ipaymu/create';
$route['payment/ipaymu/notify'] = 'ipaymu/notify';
$route['payment/ipaymu/return'] = 'ipaymu/return';
$route['payment/ipaymu/cancel'] = 'ipaymu/cancel';

// --- Midtrans Payment routes ---
$route['payment/checkout/(:num)'] = 'payment/checkout/$1';
$route['payment/checkout']        = 'payment/checkout';
$route['payment/create']          = 'payment/create';
$route['payment/success']         = 'payment/success';
$route['payment/notify']          = 'payment/notify';
$route['payment/finish']          = 'payment/success';  // alias finish → success

// --- User: Riwayat Pembelian ---
$route['user/orders']               = 'user/orders';
$route['user/orders/(:any)']        = 'user/order_detail/$1';

