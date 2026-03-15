<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Payment Controller - Midtrans Snap Integration
 * Flow: produk_detail → checkout (form) → payment/create (AJAX token) → snap.pay() → payment/success
 */
class Payment extends CI_Controller {

    private $mt; // midtrans config

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'security'));
        $this->load->library(array('session', 'email'));
        $this->load->model(array('Order_model', 'Produk_model', 'Toko_model'));

        // Load config — hardcoded fallback jika config section tidak terbaca
        $this->config->load('midtrans', TRUE);
        $cfg = $this->config->item('midtrans', 'midtrans');
        if (!$cfg || empty($cfg['server_key'])) {
            $cfg = array(
                'merchant_id' => 'G331745803',
                'client_key'  => 'CHANGE_ME_MIDTRANS_CLIENT_KEY',
                'server_key'  => 'CHANGE_ME_MIDTRANS_SERVER_KEY',
                'is_sandbox'  => true,
            );
        }
        $this->mt = $cfg;
    }

    /**
     * Halaman checkout — form detail pembeli sebelum bayar
     */
    public function checkout($produk_id = 0) {
        $produk_id = (int) ($produk_id ?: $this->input->get('produk_id'));
        if (!$produk_id) show_404();

        $produk = $this->Produk_model->get_produk($produk_id);
        if (!$produk) show_404();

        $toko = $this->Toko_model->get_toko_by_id($produk['id_toko']);

        $data = array(
            'title'  => 'Checkout — ' . $produk['nama_produk'],
            'produk' => $produk,
            'toko'   => $toko,
        );
        $data['page_content'] = 'public/checkout';
        $this->load->view('layouts/public_layout', $data);
    }

    /**
     * GET token Midtrans Snap — dipanggil via AJAX dari form checkout
     */
    public function create() {
        $this->output->set_content_type('application/json');

        if (strtoupper($this->input->server('REQUEST_METHOD')) !== 'POST') {
            $this->output->set_status_header(405)->set_output(json_encode(array('error' => 'Method Not Allowed')));
            return;
        }

        $produk_id    = (int) $this->input->post('produk_id', TRUE);
        $qty          = max(1, (int) $this->input->post('qty', TRUE));
        $buyer_name   = trim($this->input->post('buyer_name',    TRUE));
        $buyer_wa     = trim($this->input->post('buyer_wa',      TRUE));
        $buyer_address= trim($this->input->post('buyer_address', TRUE));
        $buyer_city   = trim($this->input->post('buyer_city',    TRUE));
        $buyer_note   = trim($this->input->post('buyer_note',    TRUE));
        $repay_order_id = trim($this->input->post('repay_order_id', TRUE));

        if (!$buyer_name || !$buyer_wa) {
            $this->output->set_status_header(400)->set_output(json_encode(array('error' => 'Nama dan WhatsApp wajib diisi')));
            return;
        }

        $produk = $this->Produk_model->get_produk($produk_id);
        if (!$produk) {
            $this->output->set_status_header(400)->set_output(json_encode(array('error' => 'Produk tidak ditemukan')));
            return;
        }

        $toko        = $this->Toko_model->get_toko_by_id($produk['id_toko']);
        $buyer_id    = (int) ($this->session->userdata('id') ?: 0);
        $buyer_email = $this->session->userdata('email') ?: 'guest@example.com';

        // ---- REPAY: gunakan order lama, jangan buat baru ----
        if ($repay_order_id) {
            $existing = $this->db->where('order_id', $repay_order_id)
                                 ->where('status', 'pending')
                                 ->get('orders')->row_array();
            if (!$existing) {
                $this->output->set_status_header(400)->set_output(json_encode(array('error' => 'Order tidak ditemukan atau sudah tidak pending')));
                return;
            }
            // Update info pembeli
            $this->db->where('order_id', $repay_order_id)->update('orders', array(
                'buyer_name'    => $buyer_name,
                'buyer_wa'      => $buyer_wa,
                'buyer_address' => $buyer_address,
                'buyer_city'    => $buyer_city,
                'buyer_note'    => $buyer_note,
            ));
            $order_id = $repay_order_id;
            $gross    = (int) $existing['total'];
        } else {
            // ---- ORDER BARU ----
            $order_id  = 'ORDER-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            $gross     = (int) $produk['harga'] * $qty;

            $order_data = array(
                'order_id'      => $order_id,
                'id_toko'       => $produk['id_toko'],
                'id_user'       => $buyer_id,
                'total'         => $gross,
                'status'        => 'pending',
                'buyer_name'    => $buyer_name,
                'buyer_email'   => $buyer_email,
                'buyer_wa'      => $buyer_wa,
                'buyer_address' => $buyer_address,
                'buyer_city'    => $buyer_city,
                'buyer_note'    => $buyer_note,
            );
            $item_data = array(
                'produk_id'   => $produk['id'],
                'nama_produk' => $produk['nama_produk'],
                'price'       => (int) $produk['harga'],
                'qty'         => $qty,
            );

            if (method_exists($this->Order_model, 'create_order_with_item')) {
                $this->Order_model->create_order_with_item($order_data, $item_data);
            } else {
                $this->db->insert('orders', $order_data);
                $inserted_id = $this->db->insert_id();
                if ($inserted_id) {
                    $item_data['order_id'] = $order_id;
                    $this->db->insert('order_items', $item_data);
                }
            }
        }

        // Payload Midtrans Snap
        $payload = array(
            'transaction_details' => array(
                'order_id'     => $order_id,
                'gross_amount' => $gross,
            ),
            'customer_details' => array(
                'first_name' => $buyer_name,
                'email'      => $buyer_email,
                'phone'      => $buyer_wa,
                'billing_address' => array(
                    'address'   => $buyer_address,
                    'city'      => $buyer_city,
                    'country_code' => 'IDN',
                ),
            ),
            'item_details' => array(
                array(
                    'id'       => (string) $produk['id'],
                    'price'    => (int) $produk['harga'],
                    'quantity' => $qty,
                    'name'     => substr($produk['nama_produk'], 0, 50),
                ),
            ),
            'expiry' => array(
                'start_time' => date('Y-m-d H:i:s O'),
                'unit'       => 'minute',
                'duration'   => 10,
            ),
            'callbacks' => array(
                'finish' => site_url('payment/success?order_id=' . $order_id),
            ),
        );

        list($ok, $resp) = $this->_midtrans_snap_token($payload);
        if (!$ok) {
            $this->output->set_status_header(502)->set_output(json_encode(array(
                'error'  => 'Gagal mendapatkan token Midtrans',
                'detail' => $resp,
            )));
            return;
        }

        $this->session->set_userdata('last_order_id', $order_id);
        $this->output->set_output(json_encode(array(
            'token'    => $resp['token'],
            'order_id' => $order_id,
        )));
    }

    /**
     * Halaman sukses / receipt setelah pembayaran
     */
    public function success() {
        $order_id  = $this->input->get('order_id', TRUE) ?: $this->session->userdata('last_order_id');
        $status_in = $this->input->get('transaction_status', TRUE) ?: 'pending';

        $order      = null;
        $order_items = array();
        $toko        = null;

        if ($order_id) {
            if (method_exists($this->Order_model, 'find_by_order_id')) {
                $order = $this->Order_model->find_by_order_id($order_id);
            } else {
                $order = $this->db->where('order_id', $order_id)->get('orders')->row_array();
            }

            if ($order) {
                // Selalu cek status real-time ke Midtrans (bukan hanya saat pending)
                // karena user diredirect ke sini segera setelah bayar, webhook belum tentu masuk
                $midtrans_status = $this->_midtrans_check_status($order_id);
                if ($midtrans_status) {
                    $ts = $midtrans_status['transaction_status'] ?? '';
                    $fs = $midtrans_status['fraud_status'] ?? '';

                    if ($ts === 'settlement') {
                        $status_in = 'paid';
                    } elseif ($ts === 'capture') {
                        $status_in = ($fs === 'accept') ? 'paid' : 'pending';
                    } elseif (in_array($ts, array('cancel','deny','expire'))) {
                        $status_in = 'failed';
                    } else {
                        $status_in = 'pending'; // pending/authorize/etc
                    }
                } else {
                    // API gagal dijangkau — gunakan status dari DB
                    $status_in = $order['status'] ?: 'pending';
                }

                // Update DB hanya jika ada perubahan status
                if ($status_in === 'paid' && $order['status'] !== 'paid') {
                    $this->Order_model->update_by_order_id($order_id, array('status' => 'paid'));
                } elseif ($status_in === 'failed' && $order['status'] !== 'failed') {
                    $this->Order_model->update_by_order_id($order_id, array('status' => 'failed'));
                }
                $order['status'] = $status_in;


                // Ambil items
                if (method_exists($this->Order_model, 'items_by_order_id')) {
                    $order_items = $this->Order_model->items_by_order_id($order_id);
                } else {
                    $order_items = $this->db->where('order_id', $order_id)->get('order_items')->result_array();
                }

                // Ambil toko
                if (!empty($order['id_toko'])) {
                    $toko = $this->Toko_model->get_toko_by_id($order['id_toko']);
                }

                // Send email jika paid
                if ($order['status'] === 'paid' && !empty($order['buyer_email'])) {
                    $this->_send_receipt_email($order, $order_items, $toko);
                }
            }
        }

        $this->session->unset_userdata('last_order_id');

        $data = array(
            'title'       => 'Receipt Pesanan — ' . ($order_id ?: '-'),
            'order'       => $order,
            'order_items' => $order_items,
            'toko'        => $toko,
        );
        $data['page_content'] = 'public/payment_result';
        $this->load->view('layouts/public_layout', $data);
    }

    /**
     * Notifikasi dari Midtrans (webhook)
     */
    public function notify() {
        $raw  = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if (!$data) { http_response_code(400); echo 'Invalid'; return; }

        $order_id           = $data['order_id']           ?? '';
        $transaction_status = $data['transaction_status'] ?? '';
        $fraud_status       = $data['fraud_status']       ?? '';
        $status_code        = $data['status_code']        ?? '';
        $gross_amount       = $data['gross_amount']       ?? '';
        $server_key         = $this->mt['server_key'];

        // Verifikasi signature Midtrans
        $expected_sig = hash('sha512', $order_id . $status_code . $gross_amount . $server_key);
        $recv_sig     = $data['signature_key'] ?? '';
        if ($recv_sig !== $expected_sig) { http_response_code(403); echo 'Bad sig'; return; }

        // Mapping status
        if      ($transaction_status === 'capture')                                       { $new_status = ($fraud_status === 'accept') ? 'paid' : 'pending'; }
        elseif  ($transaction_status === 'settlement')                                    { $new_status = 'paid'; }
        elseif  (in_array($transaction_status, array('cancel','deny','expire')))          { $new_status = 'failed'; }
        else                                                                              { $new_status = 'pending'; }

        if (method_exists($this->Order_model, 'update_by_order_id')) {
            $this->Order_model->update_by_order_id($order_id, array('status' => $new_status, 'gateway_payload' => $raw));
        } else {
            $this->db->where('order_id', $order_id)->update('orders', array('status' => $new_status));
        }
        echo 'OK';
    }

    /**
     * Helper: Cek status Midtrans langsung ke API untuk memastikan data sinkron walau webhook telat
     */
    private function _midtrans_check_status($order_id) {
        $is_sandbox = !empty($this->mt['is_sandbox']);
        $url        = $is_sandbox
            ? "https://api.sandbox.midtrans.com/v2/{$order_id}/status"
            : "https://api.midtrans.com/v2/{$order_id}/status";

        $auth = base64_encode($this->mt['server_key'] . ':');
        $ch   = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array(
                'Accept: application/json',
                'Authorization: Basic ' . $auth,
            ),
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));
        $resp = curl_exec($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http >= 200 && $http < 300) {
            return json_decode($resp, true);
        }
        return false;
    }

    /**
     * Helper: minta Snap token dari Midtrans API
     */
    private function _midtrans_snap_token($payload) {
        $is_sandbox = !empty($this->mt['is_sandbox']);
        $url        = $is_sandbox
            ? 'https://app.sandbox.midtrans.com/snap/v1/transactions'
            : 'https://app.midtrans.com/snap/v1/transactions';

        $auth   = base64_encode($this->mt['server_key'] . ':');
        $body   = json_encode($payload, JSON_UNESCAPED_SLASHES);

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Basic ' . $auth,
            ),
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $body,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ));

        $resp = curl_exec($ch);
        $err  = curl_error($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($err) return array(false, array('curl_error' => $err));
        $parsed = json_decode($resp, true);
        if ($http >= 200 && $http < 300 && isset($parsed['token'])) {
            return array(true, $parsed);
        }
        return array(false, array('http' => $http, 'body' => $resp, 'parsed' => $parsed));
    }

    /**
     * Kirim email receipt ke buyer (jika email tersedia)
     */
    private function _send_receipt_email($order, $items, $toko) {
        try {
            $buyer_email = $order['buyer_email'] ?? '';
            if (!$buyer_email || $buyer_email === 'guest@example.com') return;

            $total    = number_format($order['total'] ?? 0, 0, ',', '.');
            $order_id = $order['order_id'] ?? '-';

            $items_html = '';
            foreach ($items as $item) {
                $items_html .= '<tr>
                  <td>' . htmlspecialchars($item['nama_produk'] ?? '-') . '</td>
                  <td style="text-align:center">' . (int)($item['qty'] ?? 1) . '</td>
                  <td style="text-align:right">Rp ' . number_format($item['price'] ?? 0, 0, ',', '.') . '</td>
                </tr>';
            }

            $msg = '<!DOCTYPE html><html><head><meta charset="utf-8"></head><body style="font-family:Arial,sans-serif;color:#333;max-width:600px;margin:auto">
              <div style="background:#1a2a5e;color:#fff;padding:24px;border-radius:12px 12px 0 0;text-align:center">
                <h2 style="margin:0">🎉 Terima Kasih Sudah Berbelanja!</h2>
                <p style="margin:8px 0 0;opacity:.9">UMKM Banggai</p>
              </div>
              <div style="background:#fff;padding:28px;border:1px solid #eee;border-top:0">
                <p>Halo <strong>' . htmlspecialchars($order['buyer_name']) . '</strong>,</p>
                <p>Pembayaran Anda telah kami terima. Berikut detail pesanannya:</p>
                <div style="background:#f8f5f2;border-radius:8px;padding:16px;margin:16px 0">
                  <p style="margin:0 0 4px;font-size:13px;color:#666">Order ID</p>
                  <p style="margin:0;font-family:monospace;font-weight:bold">' . htmlspecialchars($order_id) . '</p>
                </div>
                <table style="width:100%;border-collapse:collapse;margin-bottom:16px">
                  <thead><tr style="background:#f0eae0">
                    <th style="text-align:left;padding:8px;border:1px solid #ddd">Produk</th>
                    <th style="text-align:center;padding:8px;border:1px solid #ddd">Qty</th>
                    <th style="text-align:right;padding:8px;border:1px solid #ddd">Harga</th>
                  </tr></thead>
                  <tbody>' . $items_html . '</tbody>
                  <tfoot><tr style="background:#f8f5f2;font-weight:bold">
                    <td colspan="2" style="padding:8px;border:1px solid #ddd;text-align:right">Total</td>
                    <td style="padding:8px;border:1px solid #ddd;text-align:right;color:#c8681a">Rp ' . $total . '</td>
                  </tr></tfoot>
                </table>
                <div style="background:#e8f4fd;border-left:4px solid #1d6fa4;padding:12px;border-radius:4px;font-size:13px">
                  📦 Seller akan segera menghubungi Anda via WhatsApp untuk koordinasi pengiriman.
                </div>
                <p style="margin-top:16px">Toko: <strong>' . htmlspecialchars($toko['nama_toko'] ?? '-') . '</strong></p>
              </div>
              <div style="background:#f4f4f4;padding:16px;text-align:center;font-size:12px;color:#888;border-radius:0 0 12px 12px">
                UMKM Banggai &copy; ' . date('Y') . '
              </div></body></html>';

            $this->email->initialize(array('mailtype' => 'html', 'charset' => 'utf-8'));
            $this->email->from('no-reply@banggaiumkm.gimmhost.my.id', 'UMKM Banggai');
            $this->email->to($buyer_email);
            $this->email->subject('Receipt Pesanan #' . $order_id . ' — UMKM Banggai');
            $this->email->message($msg);
            $this->email->send(false);
        } catch (Exception $e) {
            log_message('error', 'Payment email error: ' . $e->getMessage());
        }
    }
}
