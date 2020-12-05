<?php

class Nota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url('Login'));
        }
        $this->load->model('M_user');
        $this->load->library('cart');
    }
    public function index()
    {
    }
    function cetak($id)
    {
        $data['penjualan'] = $this->M_user->getwhere('penjualan', ['kode_penjualan' => $id]);
        $data['detail'] = $this->M_user->getjoinfilter('detail_penjualan', 'barang', 'detail_penjualan.kode_barang=barang.kode_barang', ['kode_penjualan' => $id]);
        $this->load->view('nota', $data);
    }
}
