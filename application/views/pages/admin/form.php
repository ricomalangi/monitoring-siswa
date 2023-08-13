<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">Form Admin</div>
            <div class="card-body">
                <form action="<?= $form_action ?>" method="POST">
                    <?= isset($input->id_admin) ? form_hidden('id_admin', $input->id_admin) : '' ?>
                    <?= isset($input->id_user) ? form_hidden('id_user', $input->id_user) : '' ?>
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
                        <div class="form-group col-md-6">
                            <label>Nama Admin</label>
                            <input type="text" name="nama_admin" class="form-control" value="<?= $input->nama_admin ?>">
                            <?= form_error('id_siswa') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Role</label>
                            <select name="role_admin" class="form-control">
                                <option selected disabled>--pilih role--</option>
                                <option value="admin" <?= $input->role_admin == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="kesiswaan" <?= $input->role_admin == 'kesiswaan' ? 'selected' : ''?>>Kesiswaan</option>
                            </select>
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