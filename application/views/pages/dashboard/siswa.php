<section class="section dashboard">
  <div class="row">
    <div class="col-xxl-4 col-md-12">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Data Saya</h5>
          <table class="table table-bordered">
            <tr>
              <th style="width: 20%;">Nama Siswa</th>
              <td><?= $nama_siswa ?></td>
            </tr>
            <tr>
              <th>NIPD</th>
              <td><?= $nipd ?></td>
            </tr>
            <tr>
              <th>NISN</th>
              <td><?= $nisn ?></td>
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
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Prestasi Saya</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-trophy"></i>
            </div>
            <div class="ps-3">
              <?php if($total_prestasi_siswa == 0): ?>
                <h6 style="font-size: 20px;">Kamu belum ada prestasi, yuk buat prestasimu!!</h6>
              <?php else : ?>
                <h6><?= $total_prestasi_siswa ?> Prestasi</h6>
              <?php endif ?>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Pelanggaran</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i class="bi bi-people"></i>
            </div>
            <div class="ps-3">
              <h6>10 Walikelas</h6>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>