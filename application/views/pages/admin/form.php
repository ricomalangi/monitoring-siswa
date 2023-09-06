<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Admin</h5>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <?= isset($input->id_admin) ? form_hidden('id_admin', $input->id_admin) : '' ?>
            <div class="col-md-6">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username" value="<?= $input->username ?>" required>
              <?= form_error('username') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <?= form_error('password') ?>
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