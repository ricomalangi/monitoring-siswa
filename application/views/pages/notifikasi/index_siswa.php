<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Notifikasi</h5>
          <div class="table-responsive">
            <table class="table table-striped" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Dikirim Oleh</th>
                  <th>Keterangan</th>
                  <th>Surat</th>
                  <th>notifikasi dikirim</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_bk ?></td>
                    <td><?= $item->keterangan ?></td>
                    <td>
                      <?php if ($item->surat) : ?>
                        <a href="<?= base_url("/surat/$item->surat") ?>" class="btn btn-secondary btn-sm btn-show-surat">Lihat surat</a>
                      <?php else : ?>
                        <div class="alert alert-warning">Tidak ada surat</div>
                      <?php endif ?>
                    </td>
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