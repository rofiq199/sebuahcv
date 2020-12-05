<?php

class StockIn extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != true) {
            redirect(base_url('Login'));
        }
        $this->load->model('M_user');
        $this->load->library('cart');
        $this->load->helper('string');
    }


    function index()
    {
        $data['kode'] = date('Ymd') . strtoupper(random_string('alnum', 4));;
        $data['barang'] = $this->M_user->getdata('barang');
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('stockin', $data);
        $this->load->view('template/footer');
    }
    function simpan()
    {
        $kode = $this->input->post('kode_beli');
        $data = [
            'kode_beli' => $kode,
        ];
        $this->M_user->insertdata('beli', $data);
        foreach ($this->cart->contents() as $a) {
            $detail_beli = [
                'kode_beli' => $kode,
                'kode_barang' => $a['id'],
                'jumlah' => $a['qty']
            ];
            $this->M_user->insertdata('detail_beli', $detail_beli);
        }
        $this->cart->destroy();
        redirect(base_url('Barang/'));
    }
    function getbarang()
    {
        $id = $this->input->get('id');
        $data = $this->M_user->getwhere('barang', ['nama_barang' => $id]);
        echo json_encode($data);
    }
    function addcart()
    {
        $kode = $this->input->post('produk');
        $nama = $this->input->post('nama');
        $qty = $this->input->post('qty');
        $data = array(
            'id'      => $kode,
            'qty'     => $qty,
            'price'   => 1,
            'name'    => $nama,
        );
        $this->cart->insert($data);
        $show = $this->cart->contents();
        echo json_encode($show);
    }
    function showcart()
    {
        $output = "";
        $no = 1;
        foreach ($this->cart->contents() as $a) {
            $output .= '<tr>
            <td>' . $no . '
            </td>
             <td>' . $a["name"] . '
             </td>
             <td>' . $a["qty"] . '
             </td>
             <td><a href="javascript:;" id="hapus" data-id=' . $a['rowid'] . '><i class="fas fa-trash"></i></a>
             </td>
            <tr>';
            $no++;
        }
        return $output;
    }
    function load_cart()
    {
        echo $this->showcart();
    }
    function deletecart()
    {
        $rowid = $this->input->post('rowid');
        $this->cart->remove($rowid);
        $show = $this->cart->contents();
        echo json_encode($show);
    }
}
