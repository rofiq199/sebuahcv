<?php

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
    }


    function index()
    {
        $data['barang'] = $this->M_user->getdata('barang');
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('barang', $data);
        $this->load->view('template/footer');
    }
    function getbarang()
    {
        $id = $this->input->get('id');
        $data = $this->M_user->getwhere('barang', ['kode_barang' => $id]);
        echo json_encode($data);
    }
    function add()
    {
        $nama = $this->input->post('nama');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $data = [
            'kode_barang' => uniqid(),
            'nama_barang' => $nama,
            'stok' => $stok,
            'harga' => $harga
        ];
        $proses = $this->M_user->insertdata('barang', $data);
        redirect(base_url('Barang'));
    }
    function update()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $data = [
            'nama_barang' => $nama,
            'stok' => $stok,
            'harga' => $harga
        ];
        $update = $this->M_user->updatedata('barang', ['kode_barang' => $kode], $data);

        redirect(base_url('Barang'));
    }
    function delete()
    {
        $kode = $this->input->post('kode');
        $this->M_user->delete('barang', ['kode_barang' => $kode]);
    }
}
