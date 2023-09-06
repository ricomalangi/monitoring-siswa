<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Nama Pelanggaran</h5>
          <a href="<?= base_url('namapelanggaran/create') ?>" class="btn btn-md btn-primary mb-4"><i class="bi bi-plus-square-fill"></i> Tambah data</a>
          <?php $this->load->view('/layouts/_alert') ?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pelanggaran</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_pelanggaran ?></td>
                    <td>
                      <a href="<?= base_url("namapelanggaran/edit/$item->id_nama_pelanggaran") ?>" class="btn btn-sm btn-warning">Edit</a>
                      <form action="<?= base_url("namapelanggaran/delete/$item->id_nama_pelanggaran") ?>" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $item->id_nama_pelanggaran ?>">
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
</section>