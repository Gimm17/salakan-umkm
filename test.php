<?php
// test.php
define('ENVIRONMENT', 'development');
require_once 'index.php';

$ci =& get_instance();
$ci->load->database();

// Mock data
$orders = [
    [
        'order_id' => '1',
        'status' => 'pending',
        'created_at' => date('Y-m-d H:i:s'),
        'total' => 100000,
        'items' => [
            ['nama_produk' => 'Test', 'qty' => 1, 'price' => 100000]
        ]
    ]
];

$ci->load->vars([
    'title' => 'Test Orders',
    'orders' => $orders,
    'page_content' => 'user/orders'
]);
$ci->load->view('layouts/dashboard_layout');
