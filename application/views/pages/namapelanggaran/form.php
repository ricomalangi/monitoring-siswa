<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Pelanggaran</h5>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <?= isset($input->id_nama_pelanggaran) ? form_hidden('id_nama_pelanggaran', $input->id_nama_pelanggaran) : '' ?>
            <div class="col-md-6">
              <label class="form-label">Nama Pelanggaran</label>
              <input type="text" class="form-control" name="nama_pelanggaran" value="<?= $input->nama_pelanggaran ?>" required>
              <?= form_error('nama_pelanggaran') ?>
            </div>
            <div class="col-md-12">
              <button type="submit" class="btn btn-success btn-md mt-4"><i class="bi bi-save-fill me-1"></i>Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>