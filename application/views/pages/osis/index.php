<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data OSIS</h5>
          <a href="<?= base_url('osis/create') ?>" class="btn btn-md btn-primary mb-4"><i class="bi bi-plus-square-fill"></i> Tambah osis</a>
          <?php $this->load->view('/layouts/_alert') ?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Petugas</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_petugas ?></td>
                    <td>
                      <a href="<?= base_url("osis/edit/$item->id_petugas_piket") ?>" class="btn btn-sm btn-warning">Edit</a>
                      <form action="<?= base_url("osis/delete/$item->id_petugas_piket") ?>" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $item->id_petugas_piket ?>">
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