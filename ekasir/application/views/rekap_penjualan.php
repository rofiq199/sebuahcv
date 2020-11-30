<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-3">
            <div class="card mb-4">
                <div class="card-header">
                    Rekap Penjualan
                    <div class="float-right">
                        <button type="button" id="tambah" class="btn btn-primary">Tambah Barang</button>
                    </div>
                </div>
                <div class="card-body">
                <input class="form-control mb-3" placeholder="Bulan" list="namaBulan" id="nama_bulan" name="nama_barang">
                                <datalist id="namaBulan">
                                        <option value="Bulan"></option>
                                </datalist>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Nama Pembeli</th>
                                    <th>Alamat</th>
                                    <th>Grand Total</th>
                                    <th>Uang yang Dibayarkan</th>
                                    <th>Kembalian</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5>Apakah Anda Yakin akan Menghapus Data ini?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                    <form action="<?= base_url('Barang/delete') ?>" method="post">
                                                        <input type="hidden" name="kode" value="<?= $a->kode_barang; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger" id="submit">Hapus</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="kode" id="kode">
                            <label for="nama">Nama Barang</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" name="stok" id="stok" class="form-control" placeholder="Masukkan Stok">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukkan Nama Kategori">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submit">s</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tambah').click(function() {
                $('form').attr('action', '<?= base_url('Barang/add') ?>');
                $('#modal-title').empty();
                $('#modal-title').append('Tambah Barang');
                $('#modal').modal('show');
                $('#nama').val('');
                $('#stok').val('');
                $('#harga').val('');
                $('#submit').text('Tambah Barang');
            });
            $('tbody tr').on('click', '#edit', function() {
                $('form').attr('action', '<?= base_url('Barang/update') ?>');
                $('#modal').modal('show');
                $('#modal-title').empty();
                $('#modal-title').append('Edit Barang');
                $('#submit').empty();
                $('#submit').append('Edit');
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: "<?= base_url('Barang') ?>/getbarang",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        $('#kode').val(data[0]['kode_barang']);
                        $('#nama').val(data[0]['nama_barang']);
                        $('#stok').val(data[0]['stok']);
                        $('#harga').val(data[0]['harga']);
                    }
                });
            })
        });
    </script>