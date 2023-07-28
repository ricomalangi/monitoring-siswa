<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">Form Osis</div>
            <div class="card-body">
                <form action="<?= $form_action ?>" method="POST">
                    <?= isset($input->id_osis) ? form_hidden('id_osis', $input->id_osis) : '' ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $input->username ?>" required>
                            <?= form_error('username') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                            <?= form_error('password') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Osis</label>
                            <input type="text" name="nama_osis" class="form-control" value="<?= $input->nama_osis ?>" required>
                            <?= form_error('nama_osis') ?>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-md"><i class="fas fa-fw fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>