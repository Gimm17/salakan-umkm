<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsertProduk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $config = array(
            'hostname' => 'localhost',
            'username' => 'gimmhost_banggaiumkm',
            'password' => 'CHANGE_ME_DB_PASSWORD',
            'database' => 'gimmhost_banggaiumkm',
            'dbdriver' => 'mysqli',
            'pconnect' => FALSE,
            'db_debug' => FALSE  // Nonaktifkan agar error tampil manual
        );
        $this->load->database($config);
    }

    public function index() {
        echo "<h1>Insert Produk via Raw SQL...</h1>";

        // Toko ID dari live DB:
        // ID=5 = Dapur Ibu Siti (user 14)
        // ID=6 = Kedai Kopi & Es Budi (user 15)
        // ID=7 = Galeri Kriya Ayu (user 16)
        
        // Kategori ID dari live DB:
        // ID=1 = Makanan Berat
        // ID=2 = Minuman
        // ID=4 = Camilan Enak
        // ID=6 = Makanan (dibuat oleh script lama, perlu dicek)
        // ID=7 = Kerajinan (dibuat oleh script lama, perlu dicek)

        // Cek dulu apakah kategori ID=6 (Makanan) dan ID=7 (Kerajinan) exist
        $kat6 = $this->db->query("SELECT id FROM kategori WHERE id=6")->row();
        $kat7 = $this->db->query("SELECT id FROM kategori WHERE id=7")->row();

        if (!$kat6) {
            $this->db->query("INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`) VALUES (6, 'Makanan', 'makanan')");
            echo "<p>✅ Kategori 'Makanan' (ID=6) dibuat</p>";
        } else {
            echo "<p>✅ Kategori 'Makanan' (ID=6) sudah ada</p>";
        }

        if (!$kat7) {
            $this->db->query("INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`) VALUES (7, 'Kerajinan', 'kerajinan')");
            echo "<p>✅ Kategori 'Kerajinan' (ID=7) dibuat</p>";
        } else {
            echo "<p>✅ Kategori 'Kerajinan' (ID=7) sudah ada</p>";
        }

        // Hapus produk yang mungkin salah insert dari toko baru kita
        $this->db->query("DELETE FROM produk WHERE id_toko IN (5,6,7)");
        echo "<p>🗑️ Produk lama dari toko 5,6,7 dihapus</p>";

        // Insert produk langsung via raw SQL dengan nilai yang sudah pasti benar
        $sqls = [
            // Toko Dapur Ibu Siti (ID=5), Kategori Makanan (ID=6)
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (5, 6, 'Nasi Kuning Komplit Spesial', 'Nasi kuning dengan lauk ayam goreng, kering tempe, telur dadar iris, dan sambal terasi khas.', 15000, 'Tersedia', 'produk_makanan_1_1773597712359.png')",
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (5, 6, 'Kue Lumpur Surga', 'Kue tradisional basah yang sangat lembut, manis, dan lumer di mulut.', 20000, 'Tersedia', 'produk_makanan_2_1773597735590.png')",
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (5, 6, 'Rendang Sapi Khas Salakan', 'Rendang daging sapi empuk dengan bumbu rempah meresap yang dimasak perlahan selama 6 jam.', 85000, 'Tersedia', 'produk_makanan_1_1773597712359.png')",
            // Toko Kedai Kopi & Es Budi (ID=6), Kategori Minuman (ID=2)
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (6, 2, 'Es Dawet Ayu Segar', 'Es dawet asli dengan gula aren pekat murni dan santan segar.', 10000, 'Tersedia', 'produk_minuman_1_1773597758641.png')",
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (6, 2, 'Kopi Tubruk Robusta Salakan', 'Kopi hitam murni dari biji kopi robusta pilihan dari dataran tinggi Salakan.', 25000, 'Tersedia', 'produk_minuman_1_1773597758641.png')",
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (6, 2, 'Wedang Saraba Hangat', 'Minuman herbal tradisional dengan campuran jahe, rempah, dan susu.', 15000, 'Tersedia', 'produk_minuman_1_1773597758641.png')",
            // Toko Galeri Kriya Ayu (ID=7), Kategori Kerajinan (ID=7)
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (7, 7, 'Tas Anyaman Rotan Eksklusif', 'Tas anyaman rotan buatan tangan dengan desain modern namun tetap mempertahankan nilai tradisional.', 150000, 'Tersedia', 'produk_kerajinan_1_1773597778912.png')",
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (7, 7, 'Hiasan Dinding Ukir Kayu', 'Pajangan dinding dari kayu jati pilihan dengan ukiran motif floral khas daerah.', 350000, 'Tersedia', 'produk_kerajinan_1_1773597778912.png')",
            "INSERT INTO `produk` (`id_toko`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `status_produk`, `gambar_produk`) VALUES (7, 7, 'Dompet Batik Tulis', 'Dompet serbaguna dengan sentuhan corak batik tulis asli pembuatan tangan perajin lokal.', 85000, 'Tersedia', 'produk_kerajinan_1_1773597778912.png')",
        ];

        $berhasil = 0;
        foreach ($sqls as $sql) {
            $result = $this->db->query($sql);
            if ($result) {
                preg_match("/VALUES \(\d+, \d+, '([^']+)'/", $sql, $m);
                echo "<p>✅ <b>" . ($m[1] ?? 'Produk') . "</b> berhasil diinsert</p>";
                $berhasil++;
            } else {
                echo "<p style='color:red'>❌ GAGAL: " . $this->db->error()['message'] . "</p>";
                echo "<p style='color:red;font-size:11px'>$sql</p>";
            }
        }

        // Cek jumlah produk sekarang
        $total = $this->db->query("SELECT COUNT(*) as total FROM produk WHERE id_toko IN (5,6,7)")->row();
        echo "<h2>✅ Selesai! $berhasil produk diinsert. Total di DB: {$total->total} produk dari toko baru.</h2>";
        echo "<p><a href='/produk'>🔗 Lihat halaman produk</a></p>";
    }
}
