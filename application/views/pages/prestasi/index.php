<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Data Prestasi Siswa</h1>
</div>

<!-- Content Row -->
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card shadow h-100 py-2">
			<div class="card-body">
				<a href="<?= base_url('prestasi/create') ?>" class="btn btn-md btn-primary mb-4"><i class="fas fa-fw fa-plus"></i> Tambah prestasi</a>
				<?php $this->load->view('/layouts/_alert') ?>
                <div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Siswa</th>
								<th>Jenis Prestasi</th>
								<th>Keterangan</th>
								<th>Sertifikat</th>
								<th>Action</th>
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
                                        <?php if($item->sertifikat): ?>
                                            <a href="<?= base_url("/sertifikat/$item->sertifikat") ?>" class="btn btn-secondary btn-sm btn-show-sertifikat">Lihat sertifikat</a>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-warning btn-sm">Tidak ada sertifikat</button>
                                        <?php endif ?>
                                    </td>
									<td>
										<a href="<?= base_url("prestasi/edit/$item->id_prestasi") ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="<?= base_url("prestasi/delete/$item->id_prestasi") ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $item->id_prestasi ?>">
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
<div class="modal fade" id="sertifikat-attachment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid" id="frame-preview"></div>
                <div class="mt-3">
                    <button class="btn btn-danger" data-dismiss="modal"> Tutup </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let sertifikatAttachment = $('#sertifikat-attachment')
        $('.btn-show-sertifikat').on('click', function(e){
            e.preventDefault()
            sertifikatAttachment.modal('show')
            sertifikatAttachment.find('#frame-preview').html('<iframe class="w-100" style="height:100vh;" src="'+$(this).attr('href')+'"></iframe>')
        })
    })
</script>