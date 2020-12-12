<?php

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url('Login'));
        }
        $this->load->model('M_user');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['user'] = $this->M_user->getwhere('user', ['username' => $this->session->userdata('username')]);
        $data['toko'] = $this->M_user->getwhere('toko', ['id' => '1']);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('profil', $data);
        $this->load->view('template/footer');
    }
    public function toko()
    {
        $nama = $this->input->post('nama_toko');
        $alamat = $this->input->post('alamat');
        $data = [
            'nama_toko' => $nama,
            'alamat_toko' => $alamat,
        ];
        $this->M_user->updatedata('toko', ['id' => '1'], $data);
        redirect(base_url('Profil'));
    }
    public function user()
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required');
        $this->form_validation->set_rules('repassword_baru', 'Konfirmasi Password', 'required|matches[password_baru]');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $user = $this->M_user->getwhere('user', ['username' => $this->session->userdata('username')]);
            if ($user[0]->password == $this->input->post('password')) {
                $password = $this->input->post('password_baru');
                $data = [
                    'password' => $password
                ];
                $update = $this->M_user->updatedata('user', ['username' => $this->session->userdata('username')], $data);
                redirect(base_url('Profil'));
            }
            $this->session->set_flashdata(
                'msg',
                'Password Yang Anda Masukkan Salah!!!'
            );
            redirect(base_url('Profil'));
        }
    }
}
