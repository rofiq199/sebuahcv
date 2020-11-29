<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-3">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-cash-register"></i>
                    Kasir 16 Jaya Furniture
                </div>
                <div class="card-body">
                    <form action="./Kasir/simpan" method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <input class="form-control" required name="nama_customer" type="text" placeholder="Nama Pembeli" value="" aria-describedby="basic-addon2" />
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" readonly name="tanggal_beli" value="<?= date('Y-m-d H:i:s') ?>" type="text" placeholder="Tanggal Hari Ini" aria-describedby="basic-addon2" />
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" readonly name="kode_penjualan" type="text" placeholder="Nomor Nota" value="<?= $kode; ?>" aria-describedby="basic-addon2" />
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" name="alamat_pengiriman" type="text" placeholder="Alamat" aria-describedby="basic-addon2" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input class="form-control" readonly name="kode_barang" id="kode_barang" type="text" placeholder="kode barang" aria-describedby="basic-addon2" />
                            </div>
                            <div class="col-md-3">
                                <!-- <input class="form-control" name="nama_barang" type="select" placeholder="nama barang"  aria-describedby="basic-addon2" /> -->
                                <input class="form-control" placeholder="Pilih Nama Barang" list="namaBarang" id="nama_barang" name="nama_barang">
                                <datalist id="namaBarang">
                                    <?php foreach ($barang as $b) { ?>
                                        <option value="<?= $b->nama_barang; ?>"></option>
                                    <?php } ?>
                                </datalist>
                                <!-- <select name="" id="" class="form-control">
                                    <option value="">lala</option>
                                    <option value="">awda</option>
                                </select> -->
                            </div>
                            <div class="col-md-3">
                                <input class="form-control" name="harga" id="harga" type="text" readonly placeholder="harga barang satuan" aria-describedby="basic-addon2" />
                            </div>
                            <div class="col-md-2">
                                <input class="form-control" name="jumlah" type="text" placeholder="Qty" id="qty" aria-describedby="basic-addon2" />
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success" id="addcart">
                                    <div class="fas fa-check"></div>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="cart">
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett Winters</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#cart').load("<?= base_url('Kasir/load_cart'); ?>");
            $("#nama_barang").change(function() {
                $("#harga").empty();
                $("#kode_barang").empty();
                var barang = $(this).val();
                $.ajax({
                    url: "<?= base_url('Kasir/getbarang'); ?>",
                    type: 'GET',
                    data: {
                        'id': barang
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $("#harga").val(data[0]["harga"]);
                        $("#kode_barang").val(data[0]["kode_barang"]);
                    }
                })
            })
            $("#addcart").click(function() {
                var produk = $("#kode_barang").val();
                var nama = $("#nama_barang").val();
                var harga = $("#harga").val();
                var qty = $("#qty").val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Kasir/addcart') ?>",
                    dataType: "JSON",
                    data: {
                        produk: produk,
                        nama: nama,
                        qty: qty,
                        harga: harga,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#cart').load("<?= base_url('Kasir/load_cart'); ?>");
                    },
                });
            });
            $("tbody").on("click", "#hapus", function() {
                var rowid = $(this).data('id');
                console.log(rowid);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Kasir/deletecart') ?>",
                    dataType: "JSON",
                    data: {
                        rowid: rowid,
                    },
                    success: function(data) {
                        console.log(data);
                    },
                });
                $('#cart').load("<?= base_url('Kasir/load_cart'); ?>");
            });
            // $.get({
            //     url: "<?= base_url('Kasir/produk') ?>",
            //     data: {

            //     },
            //     success: function(data) {
            //         console.log(data);
            //         var results = data;
            //         for (i = 0; i < results.length; i++) {
            //             $("#produk").append($('<option>', {
            //                 value: results[i]["nama"],
            //                 text: results[i]["kode_produk"]
            //             }));
            //         }


            //     }
            // })

        });
    </script>