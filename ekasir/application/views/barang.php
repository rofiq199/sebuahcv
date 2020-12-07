<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-3">
            <?= $this->session->flashdata('msg'); ?>
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- Modal -->
    <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-tambah">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="formtambah">
                        <div class="form-group">
                            <input type="hidden" name="kode" id="kode">
                            <label for="nama">Nama Barang</label>
                            <input type="text" name="nama" id="namat" class="form-control" required placeholder="Masukkan Nama Barang">
                            <small class="text-danger" id="duplikasi"><strong></strong></small>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" min="1" required name="stok" id="stokt" class="form-control" placeholder="Masukkan Stok">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" onkeypress="return hanyaAngka(event)" required id="hargat" class="form-control" placeholder="Masukkan Harga Barang">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitadd">s</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
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
                    <form action="" method="post" id="form">
                        <div class="form-group">
                            <input type="hidden" name="kode" id="kode">
                            <label for="nama">Nama Barang</label>
                            <input type="text" name="nama" id="nama" class="form-control" required placeholder="Masukkan Nama Barang">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" min="1" required name="stok" id="stok" class="form-control" placeholder="Masukkan Stok">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" onkeypress="return hanyaAngka(event)" required id="harga" class="form-control" placeholder="Masukkan Harga Barang">
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

    <!-- modal hapus -->
    <div class="modal fade" id="modalhapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Apakah Anda Yakin akan Menghapus Data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                    <form action="<?= base_url('Barang/delete') ?>" id="formhapus" method="post">
                        <input type="hidden" name="kode" id="kodehapus" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            //datatables
            var table = $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= base_url('Barang/showbarang') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });
            $('#namat').blur(function() {
                $("#duplikasi").empty();

                var barang = $(this).val();
                $.ajax({
                    url: "<?= base_url('Kasir') ?>/getbarang",
                    dataType: "JSON",
                    data: {
                        id: barang
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.length <= 0) {
                            $("#submitadd").prop('disabled', false);
                        } else {
                            $("#duplikasi").append("Nama Barang Telah Terdaftar");
                            $("#submitadd").prop('disabled', true);
                        }

                    }
                });
            })
            $('#tambah').click(function() {
                $('#formtambah').attr('action', '<?= base_url('Barang/add') ?>');
                $('#modal-title-tambah').empty();
                $('#modal-title-tambah').append('Tambah Barang');
                $('#modaltambah').modal('show');
                $('#namat').val('');
                $('#stokt').val('');
                $('#hargat').val('');
                $('#submitadd').text('Tambah Barang');
            });
            $('tbody ').on('click', '#edit', function() {
                $('#form').attr('action', '<?= base_url('Barang/update') ?>');
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
            $('tbody ').on('click', '#hapus', function() {

                $('#modalhapus').modal('show');
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
                        $('#kodehapus').val(data[0]['kode_barang']);

                    }
                });
            })
        });
    </script>