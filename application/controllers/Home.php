<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Produk_model', 'Toko_model', 'Kategori_model'));
	}

	public function index()
	{
		$data['title'] = 'Selamat Datang di Katalog UMKM Salakan';
        $data['produk_terbaru'] = $this->Produk_model->get_all_filtered(8, 0, null, null, 'terbaru');
        $data['toko'] = $this->Toko_model->get_approved_toko();
        $data['kategori'] = $this->Kategori_model->get_all();

        $data['page_content'] = 'public/home';
		$this->load->view('layouts/public_layout', $data);
	}
}
