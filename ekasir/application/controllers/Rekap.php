<?php

class Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url('Login'));
        }
        $this->load->model('M_user');
    }
    function index()
    {
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('rekap_penjualan');
        $this->load->view('template/footer');
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
        echo $this->show();
    }
}
