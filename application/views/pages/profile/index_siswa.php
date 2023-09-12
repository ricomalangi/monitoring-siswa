<section class="section">
  <div class="row">
    <div class="col-xl-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Siswa</h5>
          <?php $this->load->view('/layouts/_alert') ?>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <div class="col-md-6">
              <label class="form-label">Nama siswa</label>
              <input type="text" class="form-control" value="<?= $input->nama_siswa ?>" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control <?= form_error('password') !== '' ? 'is-invalid' : '' ?>">
              <?= form_error('password') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Agama</label>
              <input type="text" class="form-control" value="<?= $input->agama ?>" disabled>
              <?= form_error('agama') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">NISN</label>
              <input type="number" class="form-control" value="<?= $input->nisn ?>" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">NIPD</label>
              <input type="number" class="form-control" value="<?= $input->nipd ?>" disabled>
            </div>
            <div class="col-md-12">
              <label class="form-label">Jenis kelamin</label>
              <input type="text" class="form-control" value="<?= $input->jenis_kelamin ?>" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tempat lahir</label>
              <input type="text" class="form-control" value="<?= $input->tempat_lahir ?>" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" value="<?= $input->tanggal_lahir?>" disabled>
            </div>
            <div class="col-md-12">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control <?= form_error('alamat') !== '' ? 'is-invalid' : '' ?>" rows="4"><?= ($input->alamat ?? '') ?></textarea>
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