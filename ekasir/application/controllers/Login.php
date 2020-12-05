<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $user = ['username' => $username, 'password' => $password];
            $cekuser = $this->M_login->ceklogin('user', $user)->num_rows();
            if ($cekuser > 0) {
                $datauser = $this->M_login->ceklogin('user', $user)->result_array();
                $data_session = array(
                    'username' => $datauser[0]['username'],
                    'role' => $datauser[0]['role'],
                    'logged_in' => true
                );
                $this->session->set_userdata($data_session);
                redirect(base_url('Kasir'));
            } else {
                $this->session->set_flashdata('gagal', 'Username atau Password salah!!!');
                redirect(base_url('Login'));
            }
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('Login/'));
    }
}
