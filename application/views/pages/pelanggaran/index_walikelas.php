<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Pelanggaran</h5>
          <div class="table-responsive">
            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Pelanggaran</th>
                  <th>Kategori Pelanggaran</th>
                  <th>Poin</th>
                  <th>Waktu Dibuat</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_siswa ?></td>
                    <td><?= $item->nama_pelanggaran ?></td>
                    <td><?= $item->kategori_pelanggaran ?></td>
                    <td><?= $item->poin_pelanggaran ?></td>
                    <td><?= $item->date_created ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal detail -->
  <div class="modal fade" id="modal-view-siswa" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Data Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Agama</label>
              <input type="text" id="agama" class="form-control" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">Jenis kelamin</label>
              <input type="text" id="jenis-kelamin" class="form-control" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tempat lahir</label>
              <input type="text" id="tempat-lahir" class="form-control" disabled>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" id="tanggal-lahir" class="form-control" disabled>
              <?= form_error('ttl') ?>
            </div>
            <div class="col-md-12">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" rows="4" disabled></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    let modalView = $('#modal-view-siswa')
    $('.btn-view-siswa').on('click', function(e) {
      e.preventDefault()
      modalView.modal('show')
      $('#agama').val($(this).data('agama'))
      $('#jenis-kelamin').val($(this).data('jenis_kelamin'))
      $('#tempat-lahir').val($(this).data('tempat_lahir'))
      $('#tanggal-lahir').val($(this).data('tanggal_lahir'))
      $('#alamat').val($(this).data('alamat'))
    })
  })
</script>