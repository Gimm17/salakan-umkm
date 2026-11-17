<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['midtrans'] = [
    'merchant_id' => getenv('MIDTRANS_MERCHANT_ID') ?: '',
    'client_key'  => getenv('MIDTRANS_CLIENT_KEY') ?: '',
    'server_key'  => getenv('MIDTRANS_SERVER_KEY') ?: '',
    'is_sandbox'  => getenv('MIDTRANS_IS_SANDBOX') !== 'false',
];
