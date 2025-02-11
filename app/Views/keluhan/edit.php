<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4><?= $title ?></h4>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Form Card -->
        <div class="col-lg-12">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <!-- Validation Alert -->
                    <?php if (session()->getFlashdata('validation')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('validation')->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Update Keluhan -->
                    <form action="/update-keluhan/<?= $keluhan['id_keluhan'] ?>" method="POST"
                        enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_pengajuan" class="form-label">Nama Pengajuan</label>
                                <input type="text" class="form-control" id="nama_pengajuan" name="nama_pengajuan"
                                    value="<?= $keluhan['nama_pengajuan'] ?>" placeholder="Masukkan nama pengajuan">
                            </div>
                            <div class="col-md-6">
                                <label for="id_pegawai" class="form-label">Pegawai</label>
                                <select class="form-control select2" id="id_pegawai" name="id_pegawai">
                                    <option value="">-- Pilih Pegawai --</option>
                                    <?php foreach ($pegawai as $row): ?>
                                        <option value="<?= $row['id'] ?>" <?= $keluhan['id_pegawai'] == $row['id'] ? 'selected' : '' ?>>
                                            <?= $row['nama_pegawai'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_perangkat" class="form-label">Perangkat</label>
                                <select class="form-control select2" id="id_perangkat" name="id_perangkat">
                                    <option value="">-- Pilih Perangkat --</option>
                                    <?php foreach ($perangkat as $row): ?>
                                        <option value="<?= $row['id'] ?>" <?= $keluhan['id_perangkat'] == $row['id'] ? 'selected' : '' ?>>
                                            <?= $row['nama'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4"
                                    placeholder="Masukkan keterangan"><?= $keluhan['keterangan'] ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="foto" class="form-label">Upload Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                                    onchange="previewFoto()">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preview Foto</label>
                                <br>
                                <img id="previewImage"
                                    src="<?= $keluhan['foto'] !== 'foto_tidak_ada' && !empty($keluhan['foto']) ? base_url('foto_keluhan/' . $keluhan['foto']) : '#' ?>"
                                    alt="Preview Foto"
                                    style="<?= $keluhan['foto'] !== 'foto_tidak_ada' && !empty($keluhan['foto']) ? '' : 'display: none;' ?> width: 500px; height: 500px; object-fit: cover; border: 1px solid #ddd; padding: 5px;">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Keluhan</button>
                        <a href="/keluhan" class="btn btn-secondary mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Aktifkan Select2
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: 'Pilih opsi',
            allowClear: true
        });
    });

    // Preview Foto Sebelum Upload
    function previewFoto() {
        const fotoInput = document.getElementById('foto');
        const previewImage = document.getElementById('previewImage');

        if (fotoInput.files && fotoInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(fotoInput.files[0]);
        } else {
            previewImage.style.display = 'none';
        }
    }
</script>



<!-- /.container-fluid -->
<?= $this->endSection() ?>