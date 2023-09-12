<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Petugas</h5>
          <?php $this->load->view('/layouts/_alert') ?>
          <div class="row mb-3">
            <div class="col-md-12">
              <label class="form-label">Nama Petugas</label>
              <input type="text" class="form-control" value="<?= $nama_petugas ?>" disabled>
            </div>
          </div>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <div class="col-md-12">
              <label class="form-label">Password</label>
              <input type="password" class="form-control <?= form_error('password') !== '' ? 'is-invalid' : '' ?>" name="password">
              <?= form_error('password') ?>
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