<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MigrateProducts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $config = array(
            'hostname' => 'localhost',
            'username' => 'gimmhost_banggaiumkm',
            'password' => 'CHANGE_ME_DB_PASSWORD',
            'database' => 'gimmhost_banggaiumkm',
            'dbdriver' => 'mysqli',
            'pconnect' => FALSE,
            'db_debug' => TRUE
        );
        $this->load->database($config);
    }

    public function index() {
        echo "<h1>Migrasi Produk ke Database Live...</h1>";

        // Ambil ID toko berdasarkan nama toko
        $toko_siti = $this->db->get_where('toko', ['nama_toko' => 'Dapur Ibu Siti'])->row();
        $toko_budi = $this->db->get_where('toko', ['nama_toko' => 'Kedai Kopi & Es Budi'])->row();
        $toko_ayu  = $this->db->get_where('toko', ['nama_toko' => 'Galeri Kriya Ayu'])->row();

        // Ambil ID kategori
        $kat_makanan  = $this->db->get_where('kategori', ['slug' => 'makanan'])->row();
        $kat_minuman  = $this->db->get_where('kategori', ['slug' => 'minuman'])->row();
        $kat_kerajinan = $this->db->get_where('kategori', ['slug' => 'kerajinan'])->row();

        if (!$toko_siti || !$toko_budi || !$toko_ayu) {
            echo "<p style='color:red'>ERROR: Toko tidak ditemukan di database! Pastikan migrasi seller sudah berhasil.</p>";
            return;
        }
        if (!$kat_makanan || !$kat_minuman || !$kat_kerajinan) {
            echo "<p style='color:red'>ERROR: Kategori tidak ditemukan!</p>";
            return;
        }

        $produk_list = [
            // Produk Dapur Ibu Siti (Makanan)
            [
                'nama_produk'  => 'Nasi Kuning Komplit Spesial',
                'deskripsi'    => 'Nasi kuning dengan lauk ayam goreng, kering tempe, telur dadar iris, dan sambal terasi khas. Cocok untuk sarapan pagi.',
                'harga'        => 15000,
                'stok'         => 50,
                'gambar'       => 'produk_makanan_1_1773597712359.png',
                'id_kategori'  => $kat_makanan->id,
                'id_toko'      => $toko_siti->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            [
                'nama_produk'  => 'Kue Lumpur Surga',
                'deskripsi'    => 'Kue tradisional basah yang sangat lembut, manis, dan lumer di mulut. Terbuat dari bahan-bahan pilihan.',
                'harga'        => 20000,
                'stok'         => 30,
                'gambar'       => 'produk_makanan_2_1773597735590.png',
                'id_kategori'  => $kat_makanan->id,
                'id_toko'      => $toko_siti->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            [
                'nama_produk'  => 'Rendang Sapi Khas Salakan',
                'deskripsi'    => 'Rendang daging sapi empuk dengan bumbu rempah meresap yang dimasak perlahan selama 6 jam. Kemasan vacuum tahan lama.',
                'harga'        => 85000,
                'stok'         => 15,
                'gambar'       => 'produk_makanan_1_1773597712359.png',
                'id_kategori'  => $kat_makanan->id,
                'id_toko'      => $toko_siti->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            // Produk Kedai Kopi & Es Budi (Minuman)
            [
                'nama_produk'  => 'Es Dawet Ayu Segar',
                'deskripsi'    => 'Es dawet asli dengan gula aren pekat murni dan santan segar. Sensasi dingin yang menyegarkan dahaga di siang hari.',
                'harga'        => 10000,
                'stok'         => 100,
                'gambar'       => 'produk_minuman_1_1773597758641.png',
                'id_kategori'  => $kat_minuman->id,
                'id_toko'      => $toko_budi->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            [
                'nama_produk'  => 'Kopi Tubruk Robusta Salakan',
                'deskripsi'    => 'Kopi hitam murni dari biji kopi robusta pilihan dari dataran tinggi Salakan. Aroma kuat dan rasa mantap.',
                'harga'        => 25000,
                'stok'         => 45,
                'gambar'       => 'produk_minuman_1_1773597758641.png',
                'id_kategori'  => $kat_minuman->id,
                'id_toko'      => $toko_budi->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            [
                'nama_produk'  => 'Wedang Saraba Hangat',
                'deskripsi'    => 'Minuman herbal tradisional dengan campuran jahe, rempah, dan susu. Sangat baik untuk menghangatkan tubuh.',
                'harga'        => 15000,
                'stok'         => 60,
                'gambar'       => 'produk_minuman_1_1773597758641.png',
                'id_kategori'  => $kat_minuman->id,
                'id_toko'      => $toko_budi->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            // Produk Galeri Kriya Ayu (Kerajinan)
            [
                'nama_produk'  => 'Tas Anyaman Rotan Eksklusif',
                'deskripsi'    => 'Tas anyaman rotan buatan tangan dengan desain modern namun tetap mempertahankan nilai tradisional.',
                'harga'        => 150000,
                'stok'         => 20,
                'gambar'       => 'produk_kerajinan_1_1773597778912.png',
                'id_kategori'  => $kat_kerajinan->id,
                'id_toko'      => $toko_ayu->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            [
                'nama_produk'  => 'Hiasan Dinding Ukir Kayu',
                'deskripsi'    => 'Pajangan dinding dari kayu jati pilihan dengan ukiran motif floral khas daerah. Melengkapi keindahan ruang tamu Anda.',
                'harga'        => 350000,
                'stok'         => 5,
                'gambar'       => 'produk_kerajinan_1_1773597778912.png',
                'id_kategori'  => $kat_kerajinan->id,
                'id_toko'      => $toko_ayu->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
            [
                'nama_produk'  => 'Dompet Batik Tulis',
                'deskripsi'    => 'Dompet serbaguna dengan sentuhan corak batik tulis asli pembuatan tangan perajin lokal.',
                'harga'        => 85000,
                'stok'         => 35,
                'gambar'       => 'produk_kerajinan_1_1773597778912.png',
                'id_kategori'  => $kat_kerajinan->id,
                'id_toko'      => $toko_ayu->id,
                'created_at'   => date('Y-m-d H:i:s')
            ],
        ];

        $berhasil = 0;
        foreach ($produk_list as $produk) {
            // Cek apakah produk sudah ada berdasarkan nama dan toko
            $existing = $this->db->get_where('produk', [
                'nama_produk' => $produk['nama_produk'],
                'id_toko'     => $produk['id_toko']
            ])->row();

            if (!$existing) {
                $this->db->insert('produk', $produk);
                echo "<p>✅ Produk ditambahkan: <b>{$produk['nama_produk']}</b></p>";
                $berhasil++;
            } else {
                echo "<p>⏭️ Produk sudah ada, dilompati: <b>{$produk['nama_produk']}</b></p>";
            }
        }

        echo "<h2>Selesai! $berhasil produk baru berhasil ditambahkan.</h2>";
        echo "<p><a href='/produk'>Lihat halaman produk</a></p>";
    }
}
