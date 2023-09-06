<?php
$role = $this->session->userdata('role');
$permit = ['admin', 'gurubk'];
?>
<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Pelanggaran</h5>
          <form action="<?= $form_action ?>" class="row g-3" method="POST">
            <?= isset($input->id_petugas_piket) ? form_hidden('id_petugas_piket', $input->id_petugas_piket) : '' ?>
            <div class="col-md-6">
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
              <label class="form-label">Pelanggaran</label>
              <select name="id_nama_pelanggaran" class="form-select select2 <?= form_error('id_nama_pelanggaran') !== '' ? 'is-invalid' : '' ?>" style="width: 100%;" required>
                <option></option>
                <?php foreach ($nama_pelanggaran as $item) : ?>
                  <option value="<?= $item->id_nama_pelanggaran ?>" <?= $input->id_nama_pelanggaran == $item->id_nama_pelanggaran ? 'selected' : '' ?>><?= $item->nama_pelanggaran ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('id_nama_pelanggaran') ?>
            </div>
            <?php if(in_array($role, $permit)) : ?>
            <div class="col-md-6">
              <label class="form-label">Ketegori Pelanggaran</label>
              <select name="kategori_pelanggaran" class="form-select <?= form_error('kategori_pelanggaran') !== '' ? 'is-invalid' : '' ?>" style="width: 100%;" required>
                <option value="">--pilih kategori--</option>
                <option value="ringan" <?= $input->kategori_pelanggaran === 'ringan' ? 'selected' : '' ?>>Ringan</option>
                <option value="sedang" <?= $input->kategori_pelanggaran === 'sedang' ? 'selected' : '' ?>>Sedang</option>
                <option value="berat" <?= $input->kategori_pelanggaran === 'berat' ? 'selected' : '' ?>>Berat</option>
              </select>
              <?= form_error('kategori_pelanggaran') ?>
            </div>
            <div class="col-md-6">
              <label class="form-label">Poin Pelanggaran</label>
              <input type="number" class="form-control <?= form_error('poin_pelanggaran') !== '' ? 'is-invalid' : '' ?>" name="poin_pelanggaran" value="<?= $input->poin_pelanggaran ?>">
              <?= form_error('poin_pelanggaran') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Status</label>
              <select name="status" class="form-select <?= form_error('status') !== '' ? 'is-invalid' : '' ?>" required>
                <option value="">--status--</option>
                <option value="waiting" <?= $input->status == 'waiting' ? 'selected' : '' ?>>waiting</option>
                <option value="approve" <?= $input->status == 'approve' ? 'selected' : '' ?>>approve</option>
              </select>
              <?= form_error('status') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Keterangan</label>
              <textarea name="keterangan" rows="4" class="form-control <?= form_error('keterangan') !== '' ? 'is-invalid' : '' ?>"><?= $input->keterangan ?></textarea>
              <?= form_error('keterangan') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Walikelas yang bertanggung jawab</label>
              <select name="id_walikelas" class="form-select select2 <?= form_error('id_walikelas') !== '' ? 'is-invalid' : '' ?>" required>
                <option value=""></option>
                <?php foreach($walikelas as $item) : ?>
                  <option value="<?= $item->id_walikelas ?>" <?= $input->id_walikelas == $item->id_walikelas ? 'selected' : '' ?>><?= $item->nama_walikelas ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('id_walikelas') ?>
            </div>
            <?php endif ?>
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