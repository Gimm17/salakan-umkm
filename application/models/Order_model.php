<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create_order_with_item($order, $item) {
        $this->db->insert('orders', $order);
        $order_db_id = $this->db->insert_id();
        $item['order_db_id'] = $order_db_id;
        $item['order_id'] = $order['order_id'];
        $this->db->insert('order_items', $item);
        return $order_db_id;
    }

    public function update_by_order_id($order_id, $data) {
        $this->db->where('order_id', $order_id)->update('orders', $data);
        return $this->db->affected_rows();
    }

    public function find_by_order_id($order_id) {
        return $this->db->get_where('orders', ['order_id' => $order_id])->row_array();
    }

    public function items_by_order_id($order_id) {
        return $this->db->get_where('order_items', ['order_id' => $order_id])->result_array();
    }
}
