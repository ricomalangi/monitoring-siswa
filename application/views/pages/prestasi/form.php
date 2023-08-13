<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">Form Prestasi</div>
            <div class="card-body">
                <form action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">
                    <?= isset($input->id_prestasi) ? form_hidden('id_prestasi', $input->id_prestasi) : '' ?>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Siswa</label>
                            <select name="id_siswa" class="form-control select2" style="width: 100%;">
                                <option></option>
                                <?php foreach($siswa as $item): ?>
                                    <option value="<?= $item->id_siswa ?>" <?= $input->id_siswa == $item->id_siswa ? 'selected' : '' ?>><?= $item->nama_siswa ?></option>
                                <?php endforeach ?>
                            </select>
                            <?= form_error('id_siswa') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Jenis Prestasi</label>
                            <select name="jenis_prestasi" class="form-control">
                                <option selected disabled>--pilih jenis prestasi--</option>
                                <option value="wilayah" <?= $input->jenis_prestasi == 'wilayah' ? 'selected' : '' ?>>Wilayah</option>
                                <option value="nasional" <?= $input->jenis_prestasi == 'nasional' ? 'selected' : ''?>>Nasional</option>
                                <option value="internasional">Internasional</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Keterangan prestasi</label>
                            <input type="text" name="keterangan_prestasi" class="form-control" value="<?= $input->keterangan_prestasi ?>" required>
                            <?= form_error('keterangan_prestasi') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>File Sertifikat</label>
                            <input type="file" name="sertifikat" class="form-control" accept="application/pdf">
                            <small class="text-muted">File harus <b>PDF</b></small>
                            <?php if ($this->session->flashdata('serti_error')) : ?>
								<small class="form-text text-danger"><?= $this->session->flashdata('serti_error') ?></small>
							<?php endif ?>
                        </div>
                        <?php if (isset($input->sertifikat)): ?>
                        <div class="form-group col-md-6">
                            <?php if($input->sertifikat !== ''): ?>
                                <label>File Sertifikat</label>
                                <a href="<?= base_url("/sertifikat/$input->sertifikat") ?>" class="btn btn-secondary btn-sm btn-show-sertifikat form-control">Lihat sertifikat</a>
                            <?php endif ?>
                        </div>
                        <?php endif ?>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-md"><i class="fas fa-fw fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
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
        $('.select2').select2({
            placeholder: "--pilih siswa--",
            allowClear: true
        })

        let sertifikatAttachment = $('#sertifikat-attachment')
        $('.btn-show-sertifikat').on('click', function(e){
            e.preventDefault()
            sertifikatAttachment.modal('show')
            sertifikatAttachment.find('#frame-preview').html('<iframe class="w-100" style="height:100vh;" src="'+$(this).attr('href')+'"></iframe>')
        })
    })
</script>