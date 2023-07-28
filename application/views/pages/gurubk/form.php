<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">Form Guru</div>
            <div class="card-body">
                <form action="<?= $form_action ?>" method="POST">
                    <?= isset($input->id_guru) ? form_hidden('id_guru', $input->id_guru) : '' ?>
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
                            <label>Nama Guru BK</label>
                            <input type="text" name="nama_bk" class="form-control" value="<?= $input->nama_bk ?>" required>
                            <?= form_error('nama_bk') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option disabled>--pilih--</option>
                                <option value="islam" <?= ($input->agama === 'islam' ? 'checked' : '') ?>>Islam</option>
                                <option value="kristen protestan" <?= ($input->agama === 'kristen protestan' ? 'checked' : '') ?>>Kristen protestan</option>
                                <option value="kristen katolik" <?= ($input->agama === 'kristen katolik' ? 'checked' : '') ?>>Kristen katolik</option>
                                <option value="hindu" <?= ($input->agama === 'hindu' ? 'checked' : '') ?>>Hindu</option>
                                <option value="konghucu" <?= ($input->agama === 'konghucu' ? 'checked' : '') ?>>Konghucu</option>
                                <option value="budha" <?= ($input->agama === 'budha' ? 'checked' : '') ?>>Budha</option>
                            </select>
                            <?= form_error('agama') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>NIP</label>
                            <input type="number" name="nip" class="form-control" value="<?= $input->nip ?>" required>
                            <?= form_error('nip') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-4">Jenis kelamin</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" <?= ($input->jenis_kelamin === 'L' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="exampleRadios1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="P" <?= ($input->jenis_kelamin === 'P' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="exampleRadios1">
                                    Perempuan
                                </label>
                            </div>
                            <?= form_error('jenis_kelamin') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tempat lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" value="<?= $input->tempat_lahir ?? '' ?>" required>
                            <?= form_error('ttl') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $input->tanggal_lahir ?? '' ?>" required>
                            <?= form_error('ttl') ?>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="4"><?= ($input->alamat ?? '') ?></textarea>
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