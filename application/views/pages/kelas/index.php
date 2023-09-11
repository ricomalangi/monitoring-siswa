<section class="section">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Siswa Berdasarkan Kelas</h5>
          <a href="<?= base_url('kelas/create') ?>" class="btn btn-md btn-primary mb-4"><i class="bi bi-plus-square-fill"></i> Tambah data</a>
          <?php $this->load->view('/layouts/_alert') ?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($content as $item) : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $item->nama_siswa ?></td>
                    <td><?= $item->nama_kelas ?></td>
                    <td>
                      <a href="<?= base_url("kelas/edit/$item->id_kelas_siswa") ?>" class="btn btn-sm btn-warning">Edit</a>
                      <form action="<?= base_url("kelas/delete/$item->id_kelas_siswa") ?>" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $item->id_kelas_siswa ?>">
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