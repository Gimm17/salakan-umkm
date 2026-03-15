<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Payment Controller - Midtrans Snap Integration
 * Menggantikan iPaymu sepenuhnya
 */
class Payment extends CI_Controller {

    private $mt; // midtrans config

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'security'));
        $this->load->library(array('session'));
        $this->load->model(array('Order_model', 'Produk_model', 'Toko_model'));
        $this->config->load('midtrans', TRUE);
        $cfg = $this->config->item('midtrans', 'midtrans');
        if (!$cfg) {
            // fallback langsung hardcode jika config section tidak terbaca
            $cfg = array(
                'merchant_id' => 'G331745803',
                'client_key'  => 'CHANGE_ME_MIDTRANS_CLIENT_KEY',
                'server_key'  => 'CHANGE_ME_MIDTRANS_SERVER_KEY',
                'is_sandbox'  => true,
            );
        }
        $this->mt = $cfg;
        if (method_exists($this->Order_model, 'ensure_tables')) {
            $this->Order_model->ensure_tables();
        }
    }

    /**
     * GET token Midtrans Snap — dipanggil via AJAX dari tombol Bayar Sekarang
     */
    public function create() {
        $this->output->set_content_type('application/json');

        if (strtoupper($this->input->server('REQUEST_METHOD')) !== 'POST') {
            $this->output->set_status_header(405)->set_output(json_encode(array('error' => 'Method Not Allowed')));
            return;
        }

        $produk_id = (int) $this->input->post('produk_id', TRUE);
        $qty       = max(1, (int) $this->input->post('qty', TRUE));

        $produk = $this->Produk_model->get_produk($produk_id);
        if (!$produk) {
            $this->output->set_status_header(400)->set_output(json_encode(array('error' => 'Produk tidak ditemukan')));
            return;
        }

        $order_id  = 'ORDER-' . date('YmdHis') . '-' . mt_rand(1000, 9999);
        $buyer_id  = (int) ($this->session->userdata('id') ?: 0);
        $gross     = (int) $produk['harga'] * $qty;
        $buyer_name  = $this->session->userdata('nama')  ?: 'Guest';
        $buyer_email = $this->session->userdata('email') ?: 'guest@example.com';

        // Simpan order ke DB lokal
        $order = array(
            'order_id'    => $order_id,
            'id_toko'     => $produk['id_toko'],
            'id_user'     => $buyer_id,
            'total'       => $gross,
            'status'      => 'pending',
            'buyer_email' => $buyer_email,
            'buyer_name'  => $buyer_name,
        );
        $this->Order_model->create_order_with_item($order, array(
            'produk_id'   => $produk['id'],
            'nama_produk' => $produk['nama_produk'],
            'price'       => (int) $produk['harga'],
            'qty'         => $qty,
        ));

        // Payload Midtrans Snap
        $payload = array(
            'transaction_details' => array(
                'order_id'     => $order_id,
                'gross_amount' => $gross,
            ),
            'customer_details' => array(
                'first_name' => $buyer_name,
                'email'      => $buyer_email,
            ),
            'item_details' => array(
                array(
                    'id'       => (string) $produk['id'],
                    'price'    => (int) $produk['harga'],
                    'quantity' => $qty,
                    'name'     => substr($produk['nama_produk'], 0, 50),
                ),
            ),
            'callbacks' => array(
                'finish' => site_url('payment/finish?order_id=' . $order_id),
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
     * Notifikasi dari Midtrans (webhook)
     */
    public function notify() {
        $raw  = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if (!$data) { show_error('Invalid payload', 400); return; }

        $order_id       = isset($data['order_id']) ? $data['order_id'] : '';
        $transaction_status = isset($data['transaction_status']) ? $data['transaction_status'] : '';
        $fraud_status   = isset($data['fraud_status']) ? $data['fraud_status'] : '';
        $server_key     = $this->mt['server_key'];

        // Verifikasi signature Midtrans
        $status_code    = isset($data['status_code']) ? $data['status_code'] : '';
        $gross_amount   = isset($data['gross_amount']) ? $data['gross_amount'] : '';
        $expected_sig   = hash('sha512', $order_id . $status_code . $gross_amount . $server_key);
        $recv_sig       = isset($data['signature_key']) ? $data['signature_key'] : '';
        if ($recv_sig !== $expected_sig) {
            show_error('Invalid signature', 403); return;
        }

        // Mapping status
        if ($transaction_status === 'capture') {
            $new_status = ($fraud_status === 'accept') ? 'paid' : 'pending';
        } elseif ($transaction_status === 'settlement') {
            $new_status = 'paid';
        } elseif (in_array($transaction_status, array('cancel', 'deny', 'expire'))) {
            $new_status = 'failed';
        } else {
            $new_status = 'pending';
        }

        $this->Order_model->update_by_order_id($order_id, array('status' => $new_status, 'gateway_payload' => $raw));
        echo 'OK';
    }

    /**
     * Halaman setelah pembayaran selesai (redirect dari Snap)
     */
    public function finish() {
        $order_id = $this->input->get('order_id', TRUE) ?: $this->session->userdata('last_order_id');
        $order    = $order_id ? $this->Order_model->find_by_order_id($order_id) : null;
        $this->session->unset_userdata('last_order_id');

        $status = $this->input->get('transaction_status', TRUE) ?: 'pending';
        if ($order && in_array($status, array('settlement', 'capture'))) {
            $this->Order_model->update_by_order_id($order_id, array('status' => 'paid'));
            $order['status'] = 'paid';
        }
        $this->load->view('public/payment_result', array('order' => $order));
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

        if ($err) {
            return array(false, array('curl_error' => $err));
        }
        $data = json_decode($resp, true);
        if ($http >= 200 && $http < 300 && isset($data['token'])) {
            return array(true, $data);
        }
        return array(false, array('http' => $http, 'body' => $resp, 'parsed' => $data));
    }
}
