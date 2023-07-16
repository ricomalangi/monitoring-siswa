<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Siswa</h1>
</div>

<!-- Content Row -->
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card shadow h-100 py-2">
			<div class="card-body">
				<a href="<?= base_url('siswa/create') ?>" class="btn btn-md btn-primary mb-4"><i class="fas fa-fw fa-plus"></i> Tambah siswa</a>
				<?php $this->load->view('/layouts/_alert') ?>
                <div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Nama Siswa</th>
								<th>NISN</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($content as $item) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $item->username ?></td>
									<td><?= $item->nama_siswa ?></td>
									<td><?= $item->nisn ?></td>
									<td>Status</td>
									<td>
										<a href="<?= base_url("siswa/edit/$item->id_siswa") ?>" class="btn btn-sm btn-warning">Edit</a>
										<a href="<?= base_url("siswa/detail/$item->id_siswa") ?>" class="btn btn-sm btn-primary">View</a>
                                        <form action="<?= base_url("siswa/delete/$item->id_user") ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $item->id_user ?>">
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