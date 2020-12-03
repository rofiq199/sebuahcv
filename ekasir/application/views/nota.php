<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/') ?>styleku.css">
</head>

<body>
    <div class="container">
        <section class="kop text-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        <img src="<?= base_url('assets/image/logo toko.jpg')?>" alt="">
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <h1>ENAM BELAS JAYA FURNITURE</h1>
                        <p>ALAMAT RUKO DE'ORCHID NO.4 JALAN TEMBUS BARU, SUMBERKOLAK</p>
                        <div class="row text-center">
                            <div class="col">
                                <p>INSTAGRAM: @16JAYA </p>
                            </div>
                            <div class="col">
                                <p>FACEBOOK: @NUGI JAYA </p>
                            </div>
                            <div class="col">
                                <p>WA: 081 231 944 983</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="identitas">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <h4>NOTA NO : <?= $penjualan[0]->kode_penjualan; ?></h4>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h5>Alamat Penjual, <?= date('d-m-Y', strtotime($penjualan[0]->tanggal_penjualan)); ?></h5>
                        <h5><?= $penjualan[0]->nama_customer; ?></h5>
                        <h5><?= $penjualan[0]->alamat; ?></h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="barang">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail as $index => $details) { ?>
                        <tr>
                            <th scope="row"><?= $index + 1; ?></th>
                            <td><?= $details->nama_barang; ?></td>
                            <td><?= $details->jumlah; ?></td>
                            <td><?= $details->harga; ?></td>
                            <td><?= $details->harga * $details->jumlah; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4">Total Harga</td>
                        <td><?= $penjualan[0]->total; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="bawah">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <p>*teliti dahulu sebelum membeli</p>
                        <p>**barang yang sudah dibeli tidak bisa ditukar / dikembalikan</p>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <h6 style="margin-left: 200px;">Hormat kami</h6>

                    </div>
                </div>
            </div>

        </section>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>