<section class="section dashboard">
  <div class="row">
    <div class="col-xxl-4 col-md-12">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Data Saya</h5>
          <table class="table table-bordered">
            <tr>
              <th style="width: 20%;">Nama</th>
              <td><?= $nama_bk ?></td>
            </tr>
            <tr>
              <th>NIP</th>
              <td><?= $nip ?></td>
            </tr>
            <tr>
              <th>Agama</th>
              <td><?= $agama ?></td>
            </tr>
            <tr>
              <th>TTL</th>
              <td><?= $tempat_lahir . '/' . $tanggal_lahir ?></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td><?= $alamat ?></td>
            </tr>
          </table>
        </div>

      </div>
    </div>
    <div class="col-xxl-4 col-md-12">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Pelanggaran</h5>
          <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-people"></i>
            </div>
            <div class="ps-3">
              <h6><?= $total_pelanggaran ?></h6>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>