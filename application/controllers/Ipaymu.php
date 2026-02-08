<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipaymu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','security'));
        $this->load->library(array('session','email'));
        $this->load->model(array('Order_model','Produk_model','Toko_model','User_model'));
        $this->config->load('ipaymu', TRUE);
        $this->ipay = $this->config->item('ipaymu');
        if (method_exists($this->Order_model, 'ensure_tables')) {
            $this->Order_model->ensure_tables();
        }
    }

    private function ipaymu_request($endpoint, $payload) {
        $va  = $this->ipay['va'];
        $key = $this->ipay['api_key'];
        $host = !empty($this->ipay['is_sandbox']) ? 'https://sandbox.ipaymu.com' : 'https://my.ipaymu.com';
        $url = $host . $endpoint;
        $ts  = gmdate('Y-m-d H:i:s');

        $body = json_encode($payload);
        $stringToSign = 'POST:' . $va . ':' . $body . ':' . $key;
        $signature = hash_hmac('sha256', $stringToSign, $key);

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'va: ' . $va,
                'signature: ' . $signature,
                'timestamp: ' . $ts
            ),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_TIMEOUT => 30
        ));
        $resp = curl_exec($ch);
        if ($resp === false) {
            $err = curl_error($ch);
            curl_close($ch);
            return array(false, array('curl_error'=>$err));
        }
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $data = json_decode($resp, true);
        if ($http >= 200 && $http < 300 && isset($data['Status']) && (int)$data['Status'] === 200) {
            return array(true, $data);
        }
        return array(false, array('http'=>$http, 'raw'=>$resp, 'parsed'=>$data));
    }

    private function ipaymu_status($ref) {
        $payload = ['referenceId' => $ref];
        return $this->ipaymu_request('/api/v2/payment/detail', $payload);
    }

    public function sys() {
        // Security: Disable debug endpoint in production
        if (ENVIRONMENT !== 'development') { show_404(); return; }
        
        $out = array(
            'php_version' => PHP_VERSION,
            'curl_enabled' => function_exists('curl_init') ? true : false,
            'allow_url_fopen' => (bool) ini_get('allow_url_fopen'),
            'database' => $this->db->database
        );
        $this->output->set_content_type('application/json')
            ->set_output(json_encode($out));
    }

    public function diag() {
        // Security: Disable debug endpoint in production
        if (ENVIRONMENT !== 'development') { show_404(); return; }
        
        $this->output->set_content_type('application/json');
        $out = array();
        $out['db_connected'] = $this->db->conn_id ? true : false;
        $out['orders_exists'] = $this->db->table_exists('orders');
        $out['order_items_exists'] = $this->db->table_exists('order_items');

        $ai_orders = $this->db->query("SHOW COLUMNS FROM `orders` LIKE 'id'")->row_array();
        $ai_items  = $this->db->query("SHOW COLUMNS FROM `order_items` LIKE 'id'")->row_array();
        $out['orders_id_extra'] = isset($ai_orders['Extra']) ? $ai_orders['Extra'] : null;
        $out['order_items_id_extra'] = isset($ai_items['Extra']) ? $ai_items['Extra'] : null;

        $this->db->trans_start();
        $oid = 'TEST-'.date('YmdHis').'-'.mt_rand(100,999);
        $this->db->insert('orders', array(
            'order_id' => $oid,
            'id_toko'  => 1,
            'id_user'  => 0,
            'total'    => 12345,
            'status'   => 'pending',
            'buyer_email' => 'debug@example.com',
            'buyer_name'  => 'Debug'
        ));
        $out['insert_orders_error'] = $this->db->error();
        $order_db_id = $this->db->insert_id();
        $out['insert_orders_id'] = $order_db_id;
        if ($order_db_id) {
            $this->db->insert('order_items', array(
                'order_db_id' => $order_db_id,
                'order_id'    => $oid,
                'produk_id'   => 1,
                'nama_produk' => 'DEBUG',
                'price'       => 12345,
                'qty'         => 1
            ));
            $out['insert_order_items_error'] = $this->db->error();
        }
        $this->db->trans_complete();
        $this->db->trans_rollback();
        echo json_encode($out);
    }

    public function create() {
        $this->output->set_content_type('application/json');
        try {
            if (strtoupper($this->input->server('REQUEST_METHOD')) !== 'POST') {
                $this->output->set_status_header(405)->set_output(json_encode(array('error'=>'Method Not Allowed'))); return;
            }
            if ($this->config->item('csrf_protection')) { $this->security->csrf_verify(); }

            $produk_id = (int)$this->input->post('produk_id', TRUE);
            $qty = max(1, (int)$this->input->post('qty', TRUE));

            $produk = $this->Produk_model->get_produk($produk_id);
            if (!$produk) {
                $this->output->set_status_header(400)->set_output(json_encode(array('error'=>'Produk tidak ditemukan'))); return;
            }

            $order_id = 'ORDIP-' . date('YmdHis') . '-' . mt_rand(1000,9999);
            $buyer_id = (int) ($this->session->userdata('id') ?: 0);
            $gross = (int)$produk['harga'] * $qty;

            $order = array(
                'order_id'    => $order_id,
                'id_toko'     => $produk['id_toko'],
                'id_user'     => $buyer_id,
                'total'       => $gross,
                'status'      => 'pending',
                'buyer_email' => $this->session->userdata('email'),
                'buyer_name'  => $this->session->userdata('nama')
            );
            $this->Order_model->create_order_with_item($order, array(
                'produk_id'   => $produk['id'],
                'nama_produk' => $produk['nama_produk'],
                'price'       => (int)$produk['harga'],
                'qty'         => $qty
            ));
            $e = $this->db->error();
            if (!empty($e['code'])) {
                $this->output->set_status_header(500)->set_output(json_encode(array('stage'=>'insert_local_order','db_error'=>$e))); return;
            }

            $this->session->set_userdata('last_order_id', $order_id);

            $returnUrl = site_url('payment/ipaymu/return');
            $cancelUrl = site_url('payment/ipaymu/cancel');
            $notifyUrl = site_url('payment/ipaymu/notify');

            $payload = array(
                'product'     => array(substr($produk['nama_produk'],0,50)),
                'qty'         => array($qty),
                'price'       => array((int)$produk['harga']),
                'amount'      => $gross,
                'returnUrl'   => $returnUrl.'?ref='.$order_id,
                'cancelUrl'   => $cancelUrl.'?ref='.$order_id,
                'notifyUrl'   => $notifyUrl,
                'referenceId' => $order_id,
                'buyerName'   => $this->session->userdata('nama') ?: 'Guest',
                'buyerEmail'  => $this->session->userdata('email') ?: 'guest@example.com'
            );

            if (!function_exists('curl_init')) {
                $this->output->set_status_header(500)->set_output(json_encode(array('stage'=>'curl','error'=>'cURL PHP extension is not enabled'))); return;
            }

            list($ok, $resp) = $this->ipaymu_request('/api/v2/payment', $payload);
            if (!$ok) {
                $this->output->set_status_header(502)->set_output(json_encode(array('stage'=>'ipaymu_request','detail'=>$resp,'payload'=>$payload))); return;
            }
            $redirect = isset($resp['Data']['Url']) ? $resp['Data']['Url'] : null;
            $this->output->set_output(json_encode(array('redirect_url'=>$redirect,'order_id'=>$order_id)));
        } catch (Exception $e) {
            $this->output->set_status_header(500)->set_output(json_encode(array('exception'=>$e->getMessage())));
        }
    }

    public function notify() {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true);
        if (!$data) { show_error('Invalid payload', 400); return; }
        $ref = isset($data['ReferenceId']) ? $data['ReferenceId'] : (isset($data['reference_id']) ? $data['reference_id'] : '');
        if (!$ref) { show_error('Bad Request', 400); return; }

        list($ok, $stat) = $this->ipaymu_status($ref);
        if (!$ok || !isset($stat['Data'])) { show_error('Upstream verify failed', 502); return; }

        $status = strtolower(isset($stat['Data']['Status']) ? $stat['Data']['Status'] : 'pending');
        $map = array(
            'success'=>'paid','berhasil'=>'paid','pending'=>'pending',
            'failed'=>'failed','gagal'=>'failed','cancel'=>'canceled','expired'=>'expired'
        );
        $new_status = isset($map[$status]) ? $map[$status] : 'pending';

        $order = $this->Order_model->find_by_order_id($ref);
        if ($order && isset($stat['Data']['Amount'])) {
            if ((int)$order['total'] !== (int)$stat['Data']['Amount']) {
                log_message('error','iPaymu amount mismatch for '.$ref);
                show_error('Amount mismatch', 400); return;
            }
        }

        $this->Order_model->update_by_order_id($ref, array(
            'status' => $new_status,
            'gateway_payload' => $raw
        ));

        if ($new_status === 'paid') {
            if (!$order) $order = $this->Order_model->find_by_order_id($ref);
            if ($order) {
                $toko = $this->Toko_model->get_toko_by_id($order['id_toko']);
                $seller_email = isset($toko['email_pemilik']) ? $toko['email_pemilik'] : null;
                $this->_send_payment_emails($seller_email, $order['buyer_email'] ? $order['buyer_email'] : '', $order);
            }
        }
        echo 'OK';
    }

    public function return() {
        $ref = $this->input->get('ref', TRUE) ?: $this->session->userdata('last_order_id');
        $order = $this->Order_model->find_by_order_id($ref);
        if (!$order) { show_404(); return; }

        list($ok, $stat) = $this->ipaymu_status($ref);
        if ($ok && isset($stat['Data']['Status'])) {
            $status = strtolower($stat['Data']['Status']);
            $map = array(
                'success'=>'paid','berhasil'=>'paid','pending'=>'pending',
                'failed'=>'failed','gagal'=>'failed','cancel'=>'canceled','expired'=>'expired'
            );
            $new = isset($map[$status]) ? $map[$status] : $order['status'];
            if ($new !== $order['status']) {
                $this->Order_model->update_by_order_id($ref, array('status'=>$new));
                $order = $this->Order_model->find_by_order_id($ref);
            }
        }
        $this->session->unset_userdata('last_order_id');
        $this->load->view('public/payment_result', array('order'=>$order));
    }

    public function cancel() {
        $ref = $this->input->get('ref', TRUE);
        $data = [
            'title' => 'Pembayaran Dibatalkan',
            'order_id' => $ref
        ];
        $this->load->view('public/payment_canceled', $data);
    }

    private function _send_payment_emails($seller_email, $buyer_email, $order) {
        $subject = 'Pembayaran Berhasil - '.$order['order_id'];
        $message = "Halo,\n\nPesanan {$order['order_id']} telah dibayar.\nTotal: Rp".number_format($order['total'],0,',','.')."\nStatus: {$order['status']}\n\nTerima kasih.";
        if ($seller_email) {
            $this->email->from('no-reply@umkm.com', 'UMKM Banggai');
            $this->email->to($seller_email);
            $this->email->subject($subject);
            $this->email->message($message);
            @$this->email->send();
        }
        if ($buyer_email) {
            $this->email->from('no-reply@umkm.com', 'UMKM Banggai');
            $this->email->to($buyer_email);
            $this->email->subject($subject);
            $this->email->message($message);
            @$this->email->send();
        }
    }
}
