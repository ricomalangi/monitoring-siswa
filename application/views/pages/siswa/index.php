<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Siswa</h5>
          <a href="<?= base_url('siswa/create') ?>" class="btn btn-md btn-primary mb-4"><i class="bi bi-plus-square-fill"></i> Tambah siswa</a>
          <?php $this->load->view('/layouts/_alert') ?>
          <div class="table-responsive">
            <table class="table" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>NISN</th>
                  <th>NIPD</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_siswa ?></td>
                    <td><?= $item->nisn ?></td>
                    <td><?= $item->nipd ?></td>
                    <td>
                      <a href="<?= base_url("siswa/edit/$item->id_siswa") ?>" class="btn btn-sm btn-warning">Edit</a>
                      <button type="button" class="btn btn-sm btn-primary btn-view-siswa" data-agama="<?= $item->agama ?>" data-jenis_kelamin="<?= $item->jenis_kelamin ?>" data-tempat_lahir="<?= $item->tempat_lahir ?>" data-tanggal_lahir="<?= $item->tanggal_lahir ?>" data-alamat="<?= $item->alamat ?>">
                        View
                      </button>
                      <form action="<?= base_url("siswa/delete/$item->id_siswa") ?>" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $item->id_siswa ?>">
                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                      </form>
                    </td>
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