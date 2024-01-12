<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Kirim Notifkasi</h5>
          <form action="<?= $form_action ?>" class="row g-3" method="POST" enctype="multipart/form-data">
            <?= isset($input->id_notifikasi) ? form_hidden('id_notifikasi', $input->id_notifikasi) : '' ?>
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
              <label class="form-label">Nama Walikelas</label>
              <select name="id_walikelas" class="form-select select2 <?= form_error('id_walikelas') !== '' ? 'is-invalid' : '' ?>" style="width: 100%;" required>
                <option></option>
                <?php foreach ($walikelas as $item) : ?>
                  <option value="<?= $item->id_walikelas ?>" <?= $input->id_walikelas == $item->id_walikelas ? 'selected' : '' ?>><?= $item->nama_walikelas ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('id_walikelas') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Keterangan</label>
              <textarea name="keterangan" rows="4" class="form-control <?= form_error('keterangan') !== '' ? 'is-invalid' : '' ?>" required><?= $input->keterangan ?></textarea>
              <?= form_error('keterangan') ?>
            </div>
            <div class="col-md-12">
                <label class="form-label">File Surat</label>
                <input type="file" name="surat" class="form-control" accept="application/pdf" required>
                <small class="text-muted">File harus <b>PDF</b></small>
                <?php if ($this->session->flashdata('surat_error')) : ?>
                  <small class="form-text text-danger"><?= $this->session->flashdata('surat_error') ?></small>
                <?php endif ?>
            </div>
            <?php if (isset($input->surat)) : ?>
              <div class="col-md-4">
                <?php if ($input->surat !== '') : ?>
                  <label class="form-label">File surat</label>
                  <a href="<?= base_url("/surat/$input->surat") ?>" class="btn btn-secondary btn-md btn-show-surat form-control">Lihat surat</a>
                <?php endif ?>
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
  <!-- modal -->
  <div class="modal fade" id="surat-attachment">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="container-fluid" id="frame-preview"></div>
          <div class="mt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
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

    let sertifikatAttachment = $('#surat-attachment')
    $('.btn-show-surat').on('click', function(e) {
      e.preventDefault()
      sertifikatAttachment.modal('show')
      sertifikatAttachment.find('#frame-preview').html('<iframe class="w-100" style="height:100vh;" src="' + $(this).attr('href') + '"></iframe>')
    })
  })
</script>