<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FixProducts extends CI_Controller {

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
        echo "<h1>Fix Produk di Database Live...</h1>";

        // Ambil semua kategori yang ada untuk debug
        $all_cats = $this->db->get('kategori')->result();
        echo "<h3>Kategori di database:</h3><ul>";
        foreach ($all_cats as $c) {
            echo "<li>ID={$c->id} | nama={$c->nama_kategori} | slug={$c->slug}</li>";
        }
        echo "</ul>";

        // Ambil ID toko berdasarkan nama toko
        $toko_siti = $this->db->get_where('toko', ['nama_toko' => 'Dapur Ibu Siti'])->row();
        $toko_budi = $this->db->get_where('toko', ['nama_toko' => 'Kedai Kopi & Es Budi'])->row();
        $toko_ayu  = $this->db->get_where('toko', ['nama_toko' => 'Galeri Kriya Ayu'])->row();

        if (!$toko_siti || !$toko_budi || !$toko_ayu) {
            echo "<p style='color:red'>ERROR: Toko tidak ditemukan!</p>";
            return;
        }

        echo "<p>Toko Siti ID: {$toko_siti->id}</p>";
        echo "<p>Toko Budi ID: {$toko_budi->id}</p>";
        echo "<p>Toko Ayu ID: {$toko_ayu->id}</p>";

        // Hapus produk yang sebelumnya salah masuk (id_kategori = 0 atau NULL)
        $toko_ids = [$toko_siti->id, $toko_budi->id, $toko_ayu->id];
        foreach ($toko_ids as $tid) {
            // Hapus semua produk dari toko baru ini dulu (reset)
            $this->db->where('id_toko', $tid);
            $deleted = $this->db->delete('produk');
            echo "<p>🗑️ Hapus produk lama dari toko ID=$tid</p>";
        }

        // Ambil kategori dengan ID langsung karena slug dari DB berbeda
        // Berdasarkan SQL dump: id=1 makanan-berat, id=2 minuman, id=4 camilan-enak
        // Kita pakai 'makanan-berat' untuk makanan, 'minuman' untuk minuman, dan buat 'kerajinan' baru jika belum ada

        $kat_makanan = $this->db->get_where('kategori', ['slug' => 'makanan-berat'])->row();
        $kat_minuman = $this->db->get_where('kategori', ['slug' => 'minuman'])->row();

        // Cek apakah kategori kerajinan sudah ada
        $kat_kerajinan = $this->db->get_where('kategori', ['slug' => 'kerajinan'])->row();
        if (!$kat_kerajinan) {
            // Coba slug lain
            $kat_kerajinan = $this->db->get_where('kategori', ['slug' => 'kerajinan-tangan'])->row();
        }
        if (!$kat_kerajinan) {
            // Buat kategori kerajinan baru
            $this->db->insert('kategori', ['nama_kategori' => 'Kerajinan', 'slug' => 'kerajinan']);
            $kat_kerajinan_id = $this->db->insert_id();
            echo "<p>✅ Kategori 'Kerajinan' dibuat baru dengan ID=$kat_kerajinan_id</p>";
        } else {
            $kat_kerajinan_id = $kat_kerajinan->id;
            echo "<p>✅ Kategori kerajinan ditemukan ID=$kat_kerajinan_id</p>";
        }

        $kat_makanan_id  = $kat_makanan ? $kat_makanan->id : 1;
        $kat_minuman_id  = $kat_minuman ? $kat_minuman->id : 2;

        echo "<p>Kategori makanan ID: $kat_makanan_id</p>";
        echo "<p>Kategori minuman ID: $kat_minuman_id</p>";
        echo "<p>Kategori kerajinan ID: $kat_kerajinan_id</p>";

        $produk_list = [
            // Produk Dapur Ibu Siti (Makanan)
            ['nama_produk' => 'Nasi Kuning Komplit Spesial', 'deskripsi' => 'Nasi kuning dengan lauk ayam goreng, kering tempe, telur dadar iris, dan sambal terasi khas. Cocok untuk sarapan pagi.', 'harga' => 15000, 'stok' => 50, 'gambar_produk' => 'produk_makanan_1_1773597712359.png', 'id_kategori' => $kat_makanan_id, 'id_toko' => $toko_siti->id],
            ['nama_produk' => 'Kue Lumpur Surga', 'deskripsi' => 'Kue tradisional basah yang sangat lembut, manis, dan lumer di mulut.', 'harga' => 20000, 'stok' => 30, 'gambar_produk' => 'produk_makanan_2_1773597735590.png', 'id_kategori' => $kat_makanan_id, 'id_toko' => $toko_siti->id],
            ['nama_produk' => 'Rendang Sapi Khas Salakan', 'deskripsi' => 'Rendang daging sapi empuk dengan bumbu rempah meresap yang dimasak perlahan selama 6 jam.', 'harga' => 85000, 'stok' => 15, 'gambar_produk' => 'produk_makanan_1_1773597712359.png', 'id_kategori' => $kat_makanan_id, 'id_toko' => $toko_siti->id],
            // Produk Kedai Kopi & Es Budi (Minuman)
            ['nama_produk' => 'Es Dawet Ayu Segar', 'deskripsi' => 'Es dawet asli dengan gula aren pekat murni dan santan segar.', 'harga' => 10000, 'stok' => 100, 'gambar_produk' => 'produk_minuman_1_1773597758641.png', 'id_kategori' => $kat_minuman_id, 'id_toko' => $toko_budi->id],
            ['nama_produk' => 'Kopi Tubruk Robusta Salakan', 'deskripsi' => 'Kopi hitam murni dari biji kopi robusta pilihan dari dataran tinggi Salakan.', 'harga' => 25000, 'stok' => 45, 'gambar_produk' => 'produk_minuman_1_1773597758641.png', 'id_kategori' => $kat_minuman_id, 'id_toko' => $toko_budi->id],
            ['nama_produk' => 'Wedang Saraba Hangat', 'deskripsi' => 'Minuman herbal tradisional dengan campuran jahe, rempah, dan susu.', 'harga' => 15000, 'stok' => 60, 'gambar_produk' => 'produk_minuman_1_1773597758641.png', 'id_kategori' => $kat_minuman_id, 'id_toko' => $toko_budi->id],
            // Produk Galeri Kriya Ayu (Kerajinan)
            ['nama_produk' => 'Tas Anyaman Rotan Eksklusif', 'deskripsi' => 'Tas anyaman rotan buatan tangan dengan desain modern namun tetap mempertahankan nilai tradisional.', 'harga' => 150000, 'stok' => 20, 'gambar_produk' => 'produk_kerajinan_1_1773597778912.png', 'id_kategori' => $kat_kerajinan_id, 'id_toko' => $toko_ayu->id],
            ['nama_produk' => 'Hiasan Dinding Ukir Kayu', 'deskripsi' => 'Pajangan dinding dari kayu jati pilihan dengan ukiran motif floral khas daerah.', 'harga' => 350000, 'stok' => 5, 'gambar_produk' => 'produk_kerajinan_1_1773597778912.png', 'id_kategori' => $kat_kerajinan_id, 'id_toko' => $toko_ayu->id],
            ['nama_produk' => 'Dompet Batik Tulis', 'deskripsi' => 'Dompet serbaguna dengan sentuhan corak batik tulis asli pembuatan tangan perajin lokal.', 'harga' => 85000, 'stok' => 35, 'gambar_produk' => 'produk_kerajinan_1_1773597778912.png', 'id_kategori' => $kat_kerajinan_id, 'id_toko' => $toko_ayu->id],
        ];

        $berhasil = 0;
        foreach ($produk_list as $produk) {
            $produk['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('produk', $produk);
            echo "<p>✅ Produk ditambahkan: <b>{$produk['nama_produk']}</b> (toko ID={$produk['id_toko']}, kat ID={$produk['id_kategori']})</p>";
            $berhasil++;
        }

        echo "<h2>✅ Selesai! $berhasil produk berhasil diinsert ulang dengan benar.</h2>";
        echo "<p><a href='/produk'>Lihat halaman produk &rarr;</a></p>";
    }
}
