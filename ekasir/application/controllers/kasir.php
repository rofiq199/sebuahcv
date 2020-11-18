<?php

class kasir extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }


    function index(){
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('kasir');
        $this->load->view('template/footer');
    }

}



?>