<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Data User Admin dan Kesiswaan</h1>
</div>

<!-- Content Row -->
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card shadow h-100 py-2">
			<div class="card-body">
				<a href="<?= base_url('admin/create') ?>" class="btn btn-md btn-primary mb-4"><i class="fas fa-fw fa-plus"></i> Tambah data</a>
				<?php $this->load->view('/layouts/_alert') ?>
                <div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
                                <th>Username</th>
								<th>Nama Admin</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($content as $item) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $item->username ?></td>
									<td><?= $item->nama_admin ?></td>
									<td><?= $item->role_admin ?></td>
									<td>
										<a href="<?= base_url("admin/edit/$item->id_admin") ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="<?= base_url("admin/delete/$item->id_admin") ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $item->id_admin ?>">
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