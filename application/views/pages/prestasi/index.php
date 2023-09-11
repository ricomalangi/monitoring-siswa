<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Prestasi Siswa</h5>
          <?php $this->load->view('/layouts/_alert') ?>
          <div class="table-responsive">
            <table class="table" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Jenis Prestasi</th>
                  <th>Keterangan</th>
                  <th>Sertifikat</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_siswa ?></td>
                    <td><?= $item->jenis_prestasi ?></td>
                    <td><?= $item->keterangan_prestasi ?></td>
                    <td>
                      <?php if ($item->sertifikat) : ?>
                        <a href="<?= base_url("/sertifikat/$item->sertifikat") ?>" class="btn btn-secondary btn-sm btn-show-sertifikat">Lihat sertifikat</a>
                      <?php else : ?>
                        <button type="button" class="btn btn-warning btn-sm">Tidak ada sertifikat</button>
                      <?php endif ?>
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
  <div class="modal fade" id="sertifikat-attachment">
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
    let sertifikatAttachment = $('#sertifikat-attachment')
    $('.btn-show-sertifikat').on('click', function(e) {
      e.preventDefault()
      sertifikatAttachment.modal('show')
      sertifikatAttachment.find('#frame-preview').html('<iframe class="w-100" style="height:100vh;" src="' + $(this).attr('href') + '"></iframe>')
    })
  })
</script>