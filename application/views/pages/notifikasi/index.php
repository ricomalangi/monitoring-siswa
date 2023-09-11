<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Notifikasi</h5>
          <a href="<?= base_url('notifikasi/create') ?>" class="btn btn-md btn-primary mb-4"><i class="bi bi-plus-square-fill"></i> Kirim notifkasi</a>
          <?php $this->load->view('/layouts/_alert') ?>
          <div class="table-responsive">
            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Siswa</th>
                  <th>Guru BK</th>
                  <th>Walikelas</th>
                  <th>Keterangan</th>
                  <th>Surat</th>
                  <th>notifikasi dikirim</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_siswa ?></td>
                    <td><?= $item->nama_bk ?></td>
                    <td><?= $item->nama_walikelas ?></td>
                    <td><?= $item->keterangan ?></td>
                    <td>
                      <?php if ($item->surat) : ?>
                        <a href="<?= base_url("/surat/$item->surat") ?>" class="btn btn-secondary btn-sm btn-show-surat">Lihat surat</a>
                      <?php else : ?>
                        <div class="alert alert-warning">Tidak ada surat</div>
                      <?php endif ?>
                    </td>
                    <td><?= $item->date_created ?></td>
                    <td>
                      <a href="<?= base_url("notifikasi/edit/$item->id_notifikasi") ?>" class="btn btn-sm btn-warning">Edit</a>
                      <form action="<?= base_url("notifikasi/delete/$item->id_notifikasi") ?>" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $item->id_notifikasi ?>">
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
    let suratAttachment = $('#surat-attachment')
    $('.btn-show-surat').on('click', function(e) {
      e.preventDefault()
      suratAttachment.modal('show')
      suratAttachment.find('#frame-preview').html('<iframe class="w-100" style="height:100vh;" src="' + $(this).attr('href') + '"></iframe>')
    })
  })
</script>