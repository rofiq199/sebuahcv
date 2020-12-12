<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-3">
            <!-- form Toko -->
            <div class="toko col-8 float-center ml-3 mt-5">
                <div class="card">
                    <div class="card-header"><b>Profil Toko</b></div>
                    <div class="card-body">
                        <form action="<?= base_url('Profil/Toko') ?>" method="post">
                            <div class="form-group">
                                <label>Nama Toko</label>
                                <input type="text" name="nama_toko" value="<?= $toko[0]->nama_toko; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control"><?= $toko[0]->alamat_toko; ?></textarea>
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- form User -->
            <div class="toko col-8 float-center ml-3 mt-5">
                <div class="card">
                    <div class="card-header"><b>Profil User</b></div>
                    <div class="card-body">
                        <?= form_open('Profil/user') ?>
                        <div class="text-center text-danger mb-3"><?= $this->session->flashdata('msg'); ?></div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" readonly value="<?= $this->session->userdata('username'); ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type="password" name="password" class="form-control">
                            <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password_baru" class="form-control">
                            <?= form_error('password_baru', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" name="repassword_baru" class="form-control">
                            <?= form_error('repassword_baru', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </main>