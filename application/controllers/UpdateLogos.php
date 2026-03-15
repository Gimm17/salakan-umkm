<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateLogos extends CI_Controller {

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
        echo "<h1>Update Logo Toko via Raw SQL...</h1>";

        // Toko ID dari live DB:
        // ID=1 = Warung Makan Budi -> logo_warung_budi.png
        // ID=5 = Dapur Ibu Siti -> logo_dapur_siti.png
        // ID=6 = Kedai Kopi & Es Budi -> logo_kedai_budi.png
        // ID=7 = Galeri Kriya Ayu -> logo_galeri_ayu.png
        
        $queries = [
            "UPDATE `toko` SET `logo` = 'logo_warung_budi.png' WHERE `id` = 1",
            "UPDATE `toko` SET `logo` = 'logo_dapur_siti.png' WHERE `id` = 5",
            "UPDATE `toko` SET `logo` = 'logo_kedai_budi.png' WHERE `id` = 6",
            "UPDATE `toko` SET `logo` = 'logo_galeri_ayu.png' WHERE `id` = 7"
        ];

        $berhasil = 0;
        foreach ($queries as $sql) {
            $result = $this->db->query($sql);
            if ($result) {
                echo "<p>✅ <b>Berhasil:</b> $sql</p>";
                $berhasil++;
            } else {
                echo "<p style='color:red'>❌ GAGAL: " . $this->db->error()['message'] . "</p>";
                echo "<p style='color:red;font-size:11px'>$sql</p>";
            }
        }

        echo "<h2>✅ Selesai! $berhasil toko berhasil diperbarui logonya.</h2>";
        echo "<p><a href='/toko'>🔗 Lihat halaman toko</a></p>";
    }
}
