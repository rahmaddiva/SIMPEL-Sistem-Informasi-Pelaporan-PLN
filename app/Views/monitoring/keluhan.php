<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-lg-12">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <!-- Alert -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- validation -->
                    <?php if (session()->getFlashdata('validation')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('validation')->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    <!-- button laporan monitoring -->
                    <div class="d-sm-flex align-items-center justify-content mb-4">
                        <a href="/lihat_monitoring_keluhan" class="btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-eye fa-sm text-white-50"></i> Lihat Monitoring</a>
                    </div>
                    </a> <!-- Closing tag added for the link -->

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelapor</th>
                                    <th>Gardu Induk</th>
                                    <th>Nama Pengajuan</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($keluhan as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_pegawai'] ?></td>
                                        <td><?= $row['nama_gi'] ?></td>
                                        <td><?= $row['nama_pengajuan'] ?></td>
                                        <td> <?= date('d F Y', strtotime($row['tanggal_mulai'])) ?></td>
                                        <td><?= $row['keterangan'] ?></td>
                                        <!-- span status -->
                                        <td>
                                            <span
                                                class="badge <?= $row['status'] == 'Diajukan' ? 'badge-warning' : 'badge-success' ?>">
                                                <?= $row['status'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <!-- Modal Detail -->
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#detail<?= $row['id_keluhan'] ?>">
                                                        <i class="fas fa-eye"></i> Detail Keluhan
                                                    </a>
                                                    <!-- Modal Update Monitoring -->
                                                    <a class="dropdown-item text-success" href="#" data-toggle="modal"
                                                        data-target="#update<?= $row['id_keluhan'] ?>">
                                                        <i class="fas fa-pen"></i> Tindak Lanjut
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update -->
<?php foreach ($keluhan as $row): ?>
    <div class="modal fade bd-example-modal-lg" id="update<?= $row['id_keluhan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tindak Lanjut Keluhan <?= $row['nama_pengajuan'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/update-monitoring-keluhan/<?= $row['id_keluhan'] ?>" method="post"
                    enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama GI</label>
                                <input type="text" class="form-control" name="nama_gi" value="<?= $row['nama_gi'] ?>"
                                    readonly>
                                <input type="hidden" name="id_keluhan" value="<?= $row['id_keluhan'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Monitoring</label>
                                <input type="date" class="form-control" id="tanggal_monitoring" name="tanggal_monitoring"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan">
                            </div>
                            <div class="form-group">
                                <label>Progress</label>
                                <input type="text" class="form-control" name="progress">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="foto_progress" class="form-label">Foto Progress</label>
                            <input type="file" class="form-control" id="foto_progress" name="foto_progress" accept="image/*"
                                onchange="previewFoto()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Preview Foto</label>
                            <br>
                            <img id="previewImage" src="#" alt="Preview Foto"
                                style="display: none; width: 200px; height: 200px; object-fit: cover; border: 1px solid #ddd; padding: 5px;">
                        </div>


                        <script>
                            // Preview Foto Sebelum Upload
                            function previewFoto() {
                                const fotoInput = document.getElementById('foto_progress');
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

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<!-- Modal Detail -->
<?php foreach ($keluhan as $row): ?>
    <div class="modal fade bd-example-modal-lg" id="detail<?= $row['id_keluhan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Keluhan <?= $row['nama_pengajuan'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="/foto_keluhan/<?= $row['foto'] ?>" class="img-thumbnail" alt="foto keluhan"
                                style="width: 100%">
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama Pelapor</td>
                                    <td>:</td>
                                    <td><?= $row['nama_pegawai'] ?></td>
                                </tr>
                                <tr>
                                    <td>Gardu Induk</td>
                                    <td>:</td>
                                    <td><?= $row['nama_gi'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Pengajuan</td>
                                    <td>:</td>
                                    <td><?= $row['nama_pengajuan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Laporan</td>
                                    <td>:</td>
                                    <td><?= date('d F Y', strtotime($row['tanggal_mulai'])) ?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td><?= $row['keterangan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>
                                        <span
                                            class="badge <?= $row['status'] == 'Diajukan' ? 'badge-warning' : 'badge-success' ?>">
                                            <?= $row['status'] ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>




<!-- /.container-fluid -->
<?= $this->endSection() ?>