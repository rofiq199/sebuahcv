<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-3">
            <div class="card mb-4">
                <div class="card-header">
                    Rekap Penjualan
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row mb-3">
                            <div class="col-5">
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
                            </div>
                            <div class="col-5">
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary" id="tampil">Filter</button></div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Nama Pembeli</th>
                                    <th>Alamat</th>
                                    <th>Grand Total</th>
                                    <th>Uang yang Dibayarkan</th>
                                    <th>Kembalian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($laporan as $index => $laporans) { ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= $laporans->tanggal_penjualan; ?></td>
                                        <td><?= $laporans->nama_customer; ?></td>
                                        <td><?= $laporans->alamat; ?></td>
                                        <td><?= $laporans->total; ?></td>
                                        <td><?= $laporans->bayar; ?></td>
                                        <td><?= $laporans->kembali; ?></td>
                                        <td><a href="javascript:;" data-id="<?= $laporans->kode_penjualan; ?>" id="detail"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="tampildetail">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submit">s</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('tbody ').on('click', '#detail', function() {
                $('#modal').modal('show');
                $('#modal-title').empty();
                $('#modal-title').append('Edit Barang');
                var id = $(this).data('id');
                $("#tampildetail").empty();
                console.log(id);
                $.ajax({
                    url: "<?= base_url('Laporan') ?>/detail",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        var no = 1;
                        for (i = 0; i < data.length; i++) {
                            $("#tampildetail").append('<tr><td>' + no + '</td><td>' + data[i]['nama_barang'] + '</td><td>' + data[i]['jumlah'] + '</td><td>' + data[i]['harga'] + '</td><td>' + data[i]['jumlah'] * data[i]['harga'] + '</td></tr>');
                            no++;
                        }
                    }
                });
            })
        });
    </script>