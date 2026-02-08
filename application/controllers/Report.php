<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Order_model');
        $this->load->library('session');
        $this->load->helper('url');

        // Auth Guard - pastikan user login sebagai penjual
        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') !== 'penjual') {
            redirect('login');
        }
    }

    public function seller() {
        $this->load->view('seller/report_view');
    }

    public function sales_json($year = null) {
        $uid = (int)$this->session->userdata('id');
        if (!$uid) { show_error('Unauthorized', 401); return; }
        $year = $year ?: date('Y');
        $rows = $this->Order_model->sales_by_month_for_seller($uid, $year);
        $labels = []; $values = [];
        foreach ($rows as $r) { $labels[] = $r->ym; $values[] = (int)$r->total; }
        $this->output->set_content_type('application/json')->set_output(json_encode([
            'labels'=>$labels, 'values'=>$values
        ]));
    }
}
