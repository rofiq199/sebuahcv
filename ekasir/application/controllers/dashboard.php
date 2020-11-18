<?php

class dashboard extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }


    function index(){
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('template/footer');
    }

}



?>