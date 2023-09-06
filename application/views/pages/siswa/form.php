<section class="section">
  <div class="row">
    <div class="col-xl-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Siswa</h5>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <?= isset($input->id_siswa) ? form_hidden('id_siswa', $input->id_siswa) : '' ?>
            <?= isset($input->nisn) ? form_hidden('nisn', $input->nisn) : '' ?>
            <?= isset($input->nipd) ? form_hidden('nipd', $input->nipd) : '' ?>
            <div class="col-md-6">
              <label class="form-label">Nama siswa</label>
              <input type="text" name="nama_siswa" class="form-control" value="<?= $input->nama_siswa ?>" required>
              <?= form_error('nama_siswa') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" >
              <?= form_error('password') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Agama</label>
              <select name="agama" class="form-select">
                <option disabled>--pilih--</option>
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
              <label class="form-label">NISN</label>
              <input type="number" name="nisn" class="form-control" value="<?= $input->nisn ?>" required>
              <?= form_error('nisn') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">NIPD</label>
              <input type="number" name="nipd" class="form-control" value="<?= $input->nipd ?>" required>
              <?= form_error('nipd') ?>
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
              <button type="submit" class="btn btn-success mt-4 btn-md"><i class="bi bi-save-fill me-1"></i> Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>