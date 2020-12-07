<?php

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url('Login'));
        }
        $this->load->model('M_user');
        $this->load->model('M_barang');
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
    function showbarang()
    {
        $list = $this->M_barang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->nama_barang;
            $row[] = $field->stok;
            $row[] = 'Rp. ' . number_format($field->harga, 0, ',', '.');
            $row[] = '<a href="javascript:;" role="button" id="edit" data-id="' . $field->kode_barang . '"><i class="fas fa-edit"></i></a>
            <a href="javascript:;" role="button" id="hapus" data-id="' . $field->kode_barang . '"><i class="fas fa-trash-alt"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_barang->count_all(),
            "recordsFiltered" => $this->M_barang->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
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
        if ($proses) {
            $this->session->set_flashdata(
                'msg',
                ' <div class="alert alert-success" role="alert">
            Berhasil Menambahkan Barang
        </div>'
            );
        } elseif ($proses == false) {
            $this->session->set_flashdata(
                'msg',
                ' <div class="alert alert-danger" role="alert">
            Nama Barang telah ada pada daftar
        </div>'
            );
        }
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
        redirect(base_url('Barang'));
    }
}
