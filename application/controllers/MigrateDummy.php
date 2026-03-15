<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MigrateDummy extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
        echo "<h1>Memulai Migrasi Data Dummy di cPanel...</h1>";
        
        $categories = [
            ['nama_kategori' => 'Makanan', 'slug' => 'makanan'],
            ['nama_kategori' => 'Minuman', 'slug' => 'minuman'],
            ['nama_kategori' => 'Kerajinan', 'slug' => 'kerajinan']
        ];
        
        $cat_ids = [];
        foreach($categories as $cat) {
            $existing = $this->db->get_where('kategori', ['slug' => $cat['slug']])->row();
            if($existing) {
                $cat_ids[$cat['slug']] = $existing->id;
            } else {
                $this->db->insert('kategori', $cat);
                $cat_ids[$cat['slug']] = $this->db->insert_id();
            }
        }
        
        $sellers_data = [
            [
                'user' => [
                    'nama' => 'Ibu Siti (Spesialis Makanan)',
                    'email' => 'siti_makanan@salakan.id',
                    'password' => password_hash('password123', PASSWORD_DEFAULT),
                    'role' => 'penjual',
                    'created_at' => date('Y-m-d H:i:s')
                ],
                'toko' => [
                    'nama_toko' => 'Dapur Ibu Siti',
                    'deskripsi' => 'Menjual aneka ragam makanan lokal khas Salakan yang lezat dan bergizi tinggi.',
                    'alamat' => 'Jl. Mawar No.12, Salakan',
                    'status_persetujuan' => 'disetujui'
                ],
                'products' => [
                    [
                        'nama_produk' => 'Nasi Kuning Komplit Spesial',
                        'deskripsi' => 'Nasi kuning dengan lauk ayam goreng, kering tempe, telur dadar iris, dan sambal terasi khas. Cocok untuk sarapan pagi.',
                        'harga' => 15000,
                        'stok' => 50,
                        'gambar' => 'produk_makanan_1_1773597712359.png',
                        'id_kategori' => $cat_ids['makanan']
                    ],
                    [
                        'nama_produk' => 'Kue Lumpur Surga',
                        'deskripsi' => 'Kue tradisional basah yang sangat lembut, manis, dan lumer di mulut. Terbuat dari bahan-bahan pilihan.',
                        'harga' => 20000,
                        'stok' => 30,
                        'gambar' => 'produk_makanan_2_1773597735590.png',
                        'id_kategori' => $cat_ids['makanan']
                    ],
                    [
                        'nama_produk' => 'Rendang Sapi Khas Salakan',
                        'deskripsi' => 'Rendang daging sapi empuk dengan bumbu rempah meresap yang dimasak perlahan selama 6 jam. Kemasan vacuum tahan lama.',
                        'harga' => 85000,
                        'stok' => 15,
                        'gambar' => 'produk_makanan_1_1773597712359.png', 
                        'id_kategori' => $cat_ids['makanan']
                    ]
                ]
            ],
            [
                'user' => [
                    'nama' => 'Pak Budi (Spesialis Minuman)',
                    'email' => 'budi_minuman@salakan.id',
                    'password' => password_hash('password123', PASSWORD_DEFAULT),
                    'role' => 'penjual',
                    'created_at' => date('Y-m-d H:i:s')
                ],
                'toko' => [
                    'nama_toko' => 'Kedai Kopi & Es Budi',
                    'deskripsi' => 'Penyegar dahaga dengan racikan tradisional dan kopi lokal terbaik.',
                    'alamat' => 'Pasar Tengah Blok B No. 4, Salakan',
                    'status_persetujuan' => 'disetujui'
                ],
                'products' => [
                    [
                        'nama_produk' => 'Es Dawet Ayu Segar',
                        'deskripsi' => 'Es dawet asli dengan gula aren pekat murni dan santan segar. Sensasi dingin yang menyegarkan dahaga di siang hari.',
                        'harga' => 10000,
                        'stok' => 100,
                        'gambar' => 'produk_minuman_1_1773597758641.png',
                        'id_kategori' => $cat_ids['minuman']
                    ],
                    [
                        'nama_produk' => 'Kopi Tubruk Robusta Salakan',
                        'deskripsi' => 'Kopi hitam murni dari biji kopi robusta pilihan dari dataran tinggi Salakan. Aroma kuat dan rasa mantap.',
                        'harga' => 25000,
                        'stok' => 45,
                        'gambar' => 'produk_minuman_1_1773597758641.png', 
                        'id_kategori' => $cat_ids['minuman']
                    ],
                    [
                        'nama_produk' => 'Wedang Saraba Hangat',
                        'deskripsi' => 'Minuman herbal tradisional dengan campuran jahe, rempah, dan susu. Sangat baik untuk menghangatkan tubuh dan menjaga stamina.',
                        'harga' => 15000,
                        'stok' => 60,
                        'gambar' => 'produk_minuman_1_1773597758641.png', 
                        'id_kategori' => $cat_ids['minuman']
                    ]
                ]
            ],
            [
                'user' => [
                    'nama' => 'Bu Ayu (Spesialis Kerajinan)',
                    'email' => 'ayu_kerajinan@salakan.id',
                    'password' => password_hash('password123', PASSWORD_DEFAULT),
                    'role' => 'penjual',
                    'created_at' => date('Y-m-d H:i:s')
                ],
                'toko' => [
                    'nama_toko' => 'Galeri Kriya Ayu',
                    'deskripsi' => 'Kerajinan tangan otentik hasil karya perajin lokal dengan kualitas ekspor.',
                    'alamat' => 'Desa Wisata Salakan RT 02/01',
                    'status_persetujuan' => 'disetujui'
                ],
                'products' => [
                    [
                        'nama_produk' => 'Tas Anyaman Rotan Eksklusif',
                        'deskripsi' => 'Tas anyaman rotan buatan tangan dengan desain modern namun tetap mempertahankan nilai tradisional. Sangat cocok untuk gaya kasual.',
                        'harga' => 150000,
                        'stok' => 20,
                        'gambar' => 'produk_kerajinan_1_1773597778912.png',
                        'id_kategori' => $cat_ids['kerajinan']
                    ],
                    [
                        'nama_produk' => 'Hiasan Dinding Ukir Kayu',
                        'deskripsi' => 'Pajangan dinding dari kayu jati pilihan dengan ukiran motif floral khas daerah. Melengkapi keindahan ruang tamu Anda.',
                        'harga' => 350000,
                        'stok' => 5,
                        'gambar_produk' => 'produk_kerajinan_1_1773597778912.png', 
                        'id_kategori' => $cat_ids['kerajinan']
                    ],
                    [
                        'nama_produk' => 'Dompet Batik Tulis',
                        'deskripsi' => 'Dompet serbaguna dengan sentuhan corak batik tulis asli pembuatan tangan perajin lokal.',
                        'harga' => 85000,
                        'stok' => 35,
                        'gambar_produk' => 'produk_kerajinan_1_1773597778912.png', 
                        'id_kategori' => $cat_ids['kerajinan']
                    ]
                ]
            ]
        ];

        foreach($sellers_data as $seller) {
            $existing_user = $this->db->get_where('users', ['email' => $seller['user']['email']])->row();
            
            if(!$existing_user) {
                // Insert User
                $this->db->insert('users', $seller['user']);
                $user_id = $this->db->insert_id();
                
                // Insert Toko
                $toko_data = $seller['toko'];
                $toko_data['id_user'] = $user_id;
                $this->db->insert('toko', $toko_data);
                $toko_id = $this->db->insert_id();
                
                // Insert Products
                foreach($seller['products'] as $prod) {
                    $prod['id_toko'] = $toko_id;
                    $prod['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('produk', $prod);
                }
                echo "<p>Berhasil membuat akun dan produk untuk: <b>{$seller['user']['nama']}</b></p>";
            } else {
                echo "<p>Akun <b>{$seller['user']['nama']}</b> sudah ada di database, melompati...</p>";
            }
        }
        
        echo "<h2>Migrasi Selesai!</h2>";
        echo "<p>Anda sekarang bisa login menggunakan email: <ul>
            <li>siti_makanan@salakan.id</li>
            <li>budi_minuman@salakan.id</li>
            <li>ayu_kerajinan@salakan.id</li>
        </ul>Password untuk semuanya: <b>password123</b></p>";
    }
}
