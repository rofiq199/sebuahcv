<?php

class Kasir extends CI_Controller
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
        $this->load->view('kasir', $data);
        $this->load->view('template/footer');
    }
    function simpan()
    {
        $kode = $this->input->post('kode_penjualan');
        $nama = $this->input->post('nama_customer');
        $alamat = $this->input->post('alamat');
        $bayar = $this->input->post('bayar');
        $kembali = $this->input->post('kembali');
        $data = [
            'kode_penjualan' => $kode,
            'nama_customer' => $nama,
            'alamat' => $alamat,
            'total' => $this->cart->total(),
            'bayar' => $bayar,
            'kembali' => $kembali
        ];
        $this->M_user->insertdata('penjualan', $data);
        foreach ($this->cart->contents() as $a) {
            $detail_penjualan = [
                'kode_penjualan' => $kode,
                'kode_barang' => $a['id'],
                'jumlah' => $a['qty']
            ];
            $this->M_user->insertdata('detail_penjualan', $detail_penjualan);
        }
        $this->cart->destroy();
        redirect(base_url('Nota/cetak/' . $kode));
    }
    function getbarang()
    {
        $id = $this->input->get('id');
        $data = $this->M_user->getwhere('barang', ['nama_barang' => $id]);
        echo json_encode($data);
    }
    function add()
    {
        $nama = $this->input->post('nama');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $data = [
            'kode_produk' => uniqid(),
            'nama' => $nama,
            'stok' => $stok,
            'harga' => $harga
        ];
        $proses = $this->M_user->insertdata('produk', $data);
        redirect(base_url('Produk'));
    }
    function update()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');
        $data = [
            'nama' => $nama,
            'stok' => $stok,
            'harga' => $harga
        ];
        $update = $this->M_user->updatedata('produk', ['kode_produk' => $kode], $data);

        redirect(base_url('Produk'));
    }
    function delete()
    {
        $kode = $this->input->post('kode');
        $this->M_user->delete('produk', ['kode_produk' => $kode]);
        redirect(base_url('Produk'));
    }
    function addcart()
    {
        $kode = $this->input->post('produk');
        $nama = $this->input->post('nama');
        $qty = $this->input->post('qty');
        $harga = $this->input->post('harga');
        $data = array(
            'id'      => $kode,
            'qty'     => $qty,
            'price'   => $harga,
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
             <td>' . $a['price'] . '
             </td>
             <td>' . $a["qty"] . '
             </td>
             <td>' . $a['subtotal'] . '
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
    function total()
    {
        $data = ['jumlah' => $this->cart->total()];
        echo $this->cart->total();
    }
}
