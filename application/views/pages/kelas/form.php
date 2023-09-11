<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form</h5>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <?= isset($input->id_petugas_piket) ? form_hidden('id_petugas_piket', $input->id_petugas_piket) : '' ?>
            <div class="col-md-12">
              <label class="form-label">Nama Siswa</label>
              <select name="id_siswa" class="form-select select2 <?= form_error('id_siswa') !== '' ? 'is-invalid' : '' ?>" style="width: 100%;" required>
                <option></option>
                <?php foreach ($siswa as $item) : ?>
                  <option value="<?= $item->id_siswa ?>" <?= $input->id_siswa == $item->id_siswa ? 'selected' : '' ?>><?= $item->nama_siswa ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('id_siswa') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama Kelas</label>
              <select name="id_kelas" class="form-select select2 <?= form_error('id_kelas') !== '' ? 'is-invalid' : '' ?>" style="width: 100%;" required>
                <option></option>
                <?php foreach ($nama_kelas as $item) : ?>
                  <option value="<?= $item->id_kelas ?>" <?= $input->id_kelas == $item->id_kelas ? 'selected' : '' ?>><?= $item->nama_kelas ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('id_kelas') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nama Walikelas</label>
              <select name="id_walikelas" class="form-select select2 <?= form_error('id_walikelas') !== '' ? 'is-invalid' : '' ?>" style="width: 100%;" required>
                <option></option>
                <?php foreach ($nama_walikelas as $item) : ?>
                  <option value="<?= $item->id_walikelas ?>" <?= $input->id_walikelas == $item->id_walikelas ? 'selected' : '' ?>><?= $item->nama_walikelas ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('id_walikelas') ?>
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
<script>
  document.addEventListener("DOMContentLoaded", () => {
    $('.select2').select2({
      placeholder: "--pilih data--",
      allowClear: true
    })
  })
</script>