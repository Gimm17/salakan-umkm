<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// TEMPORARY DEBUG - HAPUS SETELAH SELESAI
class IpaymuDebug extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Hanya boleh diakses di production untuk debug sementara
        $this->load->helper('url');
        $this->config->load('ipaymu', TRUE);
    }

    public function index() {
        $this->output->set_content_type('application/json');

        $cfg = $this->config->item('ipaymu');
        $va  = $cfg['va'];
        $key = $cfg['api_key'];
        $sandbox = !empty($cfg['is_sandbox']);
        $host = $sandbox ? 'https://sandbox.ipaymu.com' : 'https://my.ipaymu.com';
        $url  = $host . '/api/v2/payment';

        // Payload mini untuk test
        $payload = array(
            'product'     => array('Test Product'),
            'qty'         => array(1),
            'price'       => array(10000),
            'amount'      => 10000,
            'returnUrl'   => site_url('test/return'),
            'cancelUrl'   => site_url('test/cancel'),
            'notifyUrl'   => site_url('test/notify'),
            'referenceId' => 'DEBUG-' . date('YmdHis'),
            'buyerName'   => 'Debug User',
            'buyerEmail'  => 'debug@test.com'
        );

        $ts      = date('YmdHis');
        $body    = json_encode($payload, JSON_UNESCAPED_SLASHES);
        $bodyHash = strtolower(hash('sha256', $body));
        $stringToSign = 'POST:' . $va . ':' . $bodyHash . ':' . $key;
        $signature    = hash_hmac('sha256', $stringToSign, $key);

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,  // Tampilkan headers response juga
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'va: ' . $va,
                'signature: ' . $signature,
                'timestamp: ' . $ts
            ),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ));

        $raw  = curl_exec($ch);
        $err  = curl_error($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        curl_close($ch);

        $responseHeaders = substr($raw, 0, $headerSize);
        $responseBody    = substr($raw, $headerSize);

        $out = array(
            'config' => array(
                'va' => $va,
                'api_key_prefix' => substr($key, 0, 12) . '...',  // Jangan tampilkan full key
                'is_sandbox' => $sandbox,
                'host' => $host
            ),
            'request' => array(
                'url' => $url,
                'timestamp' => $ts,
                'body_hash' => $bodyHash,
                'string_to_sign' => 'POST:' . $va . ':' . $bodyHash . ':<apikey>',
                'signature_preview' => substr($signature, 0, 20) . '...',
                'payload' => $payload
            ),
            'response' => array(
                'http_code' => $http,
                'curl_error' => $err,
                'body' => $responseBody,
                'parsed' => json_decode($responseBody, true)
            )
        );

        $this->output->set_output(json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
