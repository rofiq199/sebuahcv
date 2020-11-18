<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-3">
            <div class="card mb-4">
                <div class="card-header">
                    List Barang
                    <div class="float-right">
                        <button type="button" id="tambah" class="btn btn-primary">Tambah Barang</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $index => $a) {
                                ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= $a->nama_barang; ?></td>
                                        <td><?= $a->stok; ?></td>
                                        <td>Rp. <?= number_format($a->harga, 0, ',', '.');; ?></td>
                                        <td><a href="javascript:;" role="button" id="edit" data-id="<?= $a->kode_barang ?>"><i class="fas fa-edit"></i></a>
                                            <a href="" role="button" data-toggle="modal" data-target="#modalhapus<?= $a->kode_barang; ?>"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modalhapus<?= $a->kode_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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