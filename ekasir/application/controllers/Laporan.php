<?php

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url('Login'));
        }
        $this->load->model('M_user');
        $this->load->model('M_laporan');
    }

    function index()
    {
        if ($this->input->post()) {
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            $data['laporan'] = $this->M_user->getwhere('penjualan', ['tanggal_penjualan >' => $tanggal_awal, 'tanggal_penjualan <' => $tanggal_akhir]);
        } else {
            $data['laporan'] = $this->M_user->getdata('penjualan');
        }
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rekap_penjualan', $data);
        $this->load->view('template/footer');
    }
    function detail()
    {
        $id = $this->input->get('id');
        $data = $this->M_user->getjoinfilter('detail_penjualan', 'barang', 'detail_penjualan.kode_barang=barang.kode_barang', ['kode_penjualan' => $id]);
        echo json_encode($data);
    }
    function show()
    {
        $output = "";
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $data = $this->M_user->getwhere('dummy', ['tanggal >' => $tanggal_awal, 'tanggal <' => $tanggal_akhir]);
        foreach ($data as $a) {
            $output .= '<tr>
            <td>' . $a->id . '</td>
            <td>' . $a->tanggal . '</td>
            </tr>';
        }
        return $output;
    }
    function tampil()
    {
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $list = $this->M_laporan->get_datatables(['tanggal_penjualan >' => $tanggal_awal, 'tanggal_penjualan <' => $tanggal_akhir]);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] =  date('d-m-Y', strtotime($field->tanggal_penjualan));;
            $row[] = $field->nama_customer;
            $row[] = $field->alamat;
            $row[] = 'Rp. ' . number_format($field->total, 0, ',', '.');
            $row[] = 'Rp. ' . number_format($field->bayar, 0, ',', '.');
            $row[] = 'Rp. ' . number_format($field->kembali, 0, ',', '.');
            $row[] = '<a href="javascript:;" role="button" id="edit" data-id="' . $field->kode_penjualan . '"><i class="fas fa-eye"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_laporan->count_all($data),
            "recordsFiltered" => $this->M_laporan->count_filtered($data),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
