<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-3">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                            <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input class="form-control" name="nama_customer" type="text" placeholder="Nama Pembeli" value=""  aria-describedby="basic-addon2" />
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" readonly name="tanggal_beli" value="<?= mdate('%Y-%m-%d %h:%i:%s')?>" type="text" placeholder="Tanggal Hari Ini"  aria-describedby="basic-addon2" />
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" readonly name="kode_penjualan" type="text" placeholder="Nomor Nota"  aria-describedby="basic-addon2" />
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" name="alamat_pengiriman" type="text"  placeholder="Alamat"  aria-describedby="basic-addon2" />
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <input class="form-control" readonly name="kode_barang" type="text" placeholder="kode barang"  aria-describedby="basic-addon2" />
                                        </div>
                                        <div class="col-md-3">
                                            <!-- <input class="form-control" name="nama_barang" type="select" placeholder="nama barang"  aria-describedby="basic-addon2" /> -->
                                            <input class="form-control" placeholder="Pilih Nama Barang" list="namaBarang" name="nama_barang">
                                            <datalist id="namaBarang">
                                                <option value="Kursi"></option>
                                                <option value="Lemari"></option>
                                            </datalist>
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" name="harga" type="text" placeholder="harga barang satuan"  aria-describedby="basic-addon2" />
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control" name="jumlah" type="text" placeholder="Qty"  aria-describedby="basic-addon2" />
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-success ">
                                                <div class="fas fa-check"></div>
                                            </button>
                                        </div>
                                    </div>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                        <button type="button" class="btn btn-primary">Cetak</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>