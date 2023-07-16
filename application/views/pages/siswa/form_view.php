<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header">Form Siswa</div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Username</label>
                        <input type="text" class="form-control" value="<?= $input->username ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Nama siswa</label>
                        <input type="text" class="form-control" value="<?= $input->nama_siswa ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Agama</label>
                        <input type="text" class="form-control" value="<?= $input->agama ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>NISN</label>
                        <input type="number" class="form-control" value="<?= $input->nisn ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-4">Jenis kelamin</label>
                        <input type="text" class="form-control" value="<?= ($input->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tempat lahir</label>
                        <input type="text" class="form-control" value="<?= $input->tempat_lahir ?? '' ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" value="<?= $input->tanggal_lahir ?? '' ?>" readonly>
                        <?= form_error('ttl') ?>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="4" readonly><?= ($input->alamat ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>