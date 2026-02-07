<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katalog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Produk_model', 'Toko_model', 'Kategori_model', 'Favorit_model', 'Ulasan_model']);
        $this->load->library('pagination');
        $this->load->helper('text');
    }

    public function index()
    {
        $this->produk();
    }
    
    public function produk()
    {
        $data['title'] = 'Semua Produk';
        
        $keyword = $this->input->get('q', TRUE);
        $kategori_slug = $this->input->get('kategori', TRUE);
        $sort = $this->input->get('sort', TRUE) ?? 'terbaru';
        
        $config['base_url'] = site_url('produk');
        $config['total_rows'] = $this->Produk_model->count_all_filtered($keyword, $kategori_slug);
        $config['per_page'] = 12;
        $config['reuse_query_string'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';
        
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = '«'; $config['first_tag_open'] = '<li class="page-item">'; $config['first_tag_close'] = '</li>';
        $config['last_link'] = '»'; $config['last_tag_open'] = '<li class="page-item">'; $config['last_tag_close'] = '</li>';
        $config['next_link'] = '›'; $config['next_tag_open'] = '<li class="page-item">'; $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '‹'; $config['prev_tag_open'] = '<li class="page-item">'; $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">'; $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['num_tag_open'] = '<li class="page-item">'; $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = (int)$this->input->get('page', TRUE);
        
        $data['produks'] = $this->Produk_model->get_all_filtered($config['per_page'], $page, $keyword, $kategori_slug, $sort);
        $data['kategoris'] = $this->Kategori_model->get_all();
        $data['pagination'] = $this->pagination->create_links();

        $data['page_content'] = 'public/produk_list';
        $this->load->view('layouts/public_layout', $data);
    }
    
    public function toko()
    {
        $data['title'] = 'Daftar Toko UMKM';
        $keyword = $this->input->get('q', TRUE);

        $config['base_url'] = site_url('toko');
        $config['total_rows'] = $this->Toko_model->count_all_approved($keyword);
        $config['per_page'] = 9;
        $config['reuse_query_string'] = TRUE; $config['page_query_string'] = TRUE; $config['query_string_segment'] = 'page';
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">'; $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link']; $config['first_link'] = '«'; $config['first_tag_open'] = '<li class="page-item">'; $config['first_tag_close'] = '</li>';
        $config['last_link'] = '»'; $config['last_tag_open'] = '<li class="page-item">'; $config['last_tag_close'] = '</li>';
        $config['next_link'] = '›'; $config['next_tag_open'] = '<li class="page-item">'; $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '‹'; $config['prev_tag_open'] = '<li class="page-item">'; $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">'; $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['num_tag_open'] = '<li class="page-item">'; $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = (int)$this->input->get('page', TRUE);
        
        $data['tokos'] = $this->Toko_model->get_all_approved($config['per_page'], $page, $keyword);
        $data['pagination'] = $this->pagination->create_links();

        $data['page_content'] = 'public/toko_list';
        $this->load->view('layouts/public_layout', $data);
    }
    
    public function detail($id)
    {
        $data['produk'] = $this->Produk_model->get_produk((int)$id);
        if (empty($data['produk'])) {
            show_404();
        }
        $data['title'] = $data['produk']['nama_produk'];
        
        $data['isFavorited'] = false;
        $data['sudah_mengulas'] = false;
        $data['ulasan_user'] = null;
        
        if($this->session->userdata('is_logged_in')){
            $user_id = $this->session->userdata('id');
            $data['isFavorited'] = $this->Favorit_model->is_favorited($user_id, $id);
            if($this->session->userdata('role') == 'pengguna') {
                $data['sudah_mengulas'] = $this->Ulasan_model->sudah_mengulas($user_id, $id);
                if($data['sudah_mengulas']) {
                    $data['ulasan_user'] = $this->Ulasan_model->get_ulasan_user_produk($user_id, $id);
                }
            }
        }

        $data['rating_stats'] = $this->Ulasan_model->get_rating_stats($id);
        $data['ulasan_produk'] = $this->Ulasan_model->get_ulasan_produk($id, 5);
        $data['total_ulasan'] = $this->Ulasan_model->count_ulasan_produk($id);

        $data['page_content'] = 'public/produk_detail';
        $this->load->view('layouts/public_layout', $data);
    }

    public function load_ulasan($id_produk)
    {
        if (!$this->input->is_ajax_request()) { show_404(); return; }

        $page = (int)$this->input->get('page', true) ?: 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $ulasan = $this->Ulasan_model->get_ulasan_produk($id_produk, $limit, $offset);
        $total = $this->Ulasan_model->count_ulasan_produk($id_produk);
        
        $has_more = ($offset + $limit) < $total;

        $response = [
            'status' => 'success',
            'ulasan' => $ulasan,
            'has_more' => $has_more,
            'next_page' => $page + 1
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function detail_toko($id)
    {
        $data['toko'] = $this->Toko_model->get_toko_by_id((int)$id);
        if (empty($data['toko']) || $data['toko']['status_persetujuan'] !== 'disetujui') {
            show_404();
        }
        $data['title'] = $data['toko']['nama_toko'];
        $data['produks'] = $this->Produk_model->get_produk_by_toko($id);
        $data['total_produk'] = count($data['produks']);
        
        $data['page_content'] = 'public/toko_detail';
        $this->load->view('layouts/public_layout', $data);
    }
}
