<section class="section">
  <div class="row">
    <div class="col-xl-12 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Walikelas</h5>
          <?php $this->load->view('/layouts/_alert') ?>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <div class="col-md-6">
              <label class="form-label">Nama Walikelas</label>
              <input type="text" class="form-control" value="<?= $input->nama_walikelas ?>" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <?= form_error('password') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Agama</label>
              <input type="text" class="form-control" value="<?= $input->agama ?>" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">NIP</label>
              <input type="number" class="form-control" value="<?= $input->nip ?>" disabled>
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
              <input type="date" class="form-control" value="<?= $input->tanggal_lahir ?>" disabled>
            </div>
            <div class="col-md-12">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="4" required><?= ($input->alamat) ?></textarea>
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