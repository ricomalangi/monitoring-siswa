<section class="section">
  <div class="row">
    <div class="col-xl-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Walikelas</h5>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <?= isset($input->id_walikelas) ? form_hidden('id_walikelas', $input->id_walikelas) : '' ?>
            <?= isset($input->nip) ? form_hidden('nip', $input->nip) : '' ?>
            <div class="col-md-6">
              <label class="form-label">Nama Walikelas</label>
              <input type="text" name="nama_walikelas" class="form-control" value="<?= $input->nama_walikelas ?>" required>
              <?= form_error('nama_walikelas ') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <?= form_error('password') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Agama</label>
              <select name="agama" class="form-select">
                <option disabled>--pilih agama--</option>
                <option value="ISLAM" <?= ($input->agama === 'ISLAM' ? 'selected' : '') ?>>Islam</option>
                <option value="KRISTEN PROTESTAN" <?= ($input->agama === 'KRISTEN PROTESTAN' ? 'selected' : '') ?>>Kristen protestan</option>
                <option value="KRISTEN KATOLIK" <?= ($input->agama === 'KRISTEN KATOLIK' ? 'selected' : '') ?>>Kristen katolik</option>
                <option value="HINDU" <?= ($input->agama === 'HINDU' ? 'selected' : '') ?>>Hindu</option>
                <option value="KONGHUCU" <?= ($input->agama === 'KONGHUCU' ? 'selected' : '') ?>>Konghucu</option>
                <option value="BUDHA" <?= ($input->agama === 'BUDHA' ? 'selected' : '') ?>>Budha</option>
              </select>
              <?= form_error('agama') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">NIP</label>
              <input type="number" name="nip" class="form-control" value="<?= $input->nip ?>" required>
              <?= form_error('nip') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Jenis kelamin</label>
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
            <div class="col-md-6">
              <label class="form-label">Tempat lahir</label>
              <input type="text" name="tempat_lahir" class="form-control" value="<?= $input->tempat_lahir ?? '' ?>" required>
              <?= form_error('ttl') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" value="<?= $input->tanggal_lahir ?? '' ?>" required>
              <?= form_error('ttl') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="4"><?= ($input->alamat ?? '') ?></textarea>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-success btn-md"><i class="fas fa-fw fa-save"></i> Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>