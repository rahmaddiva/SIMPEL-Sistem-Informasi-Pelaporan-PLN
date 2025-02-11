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
                    <!-- Alert hapus -->
                    <?php if (session()->getFlashdata('hapus')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('hapus') ?>
                        </div>
                    <?php endif; ?>
                    <!-- validation -->
                    <?php if (session()->getFlashdata('validation')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('validation')->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    <!-- Button Tambah -->
                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">Tambah
                        Perangkat</a>

                    <!-- Modal Tambah Fullscreen -->
                    <div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Perangkat</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                                <form action="/proses-perangkat" method="POST">
                                    <div class="modal-body row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Perangkat</label>
                                                <input type="text" class="form-control" id="nama" name="nama">
                                            </div>
                                        </div>

                                        <div class="col-md-6"> <!-- Fixed missing div here -->
                                            <div class="form-group">
                                                <label for="jenis_perangkat">Jenis Perangkat</label>
                                                <input type="text" class="form-control" id="jenis_perangkat"
                                                    name="jenis_perangkat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button"
                                            data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal tambah -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perangkat</th>
                                    <th>Jenis Perangkat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($perangkat as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['jenis_perangkat'] ?></td>
                                        <td>
                                            <!-- button modal edit -->
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#modalEdit<?= $row['id'] ?>"><i
                                                    class="fas fa-edit"></i></button>

                                            <a href="/delete-gi/<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                    class="fas fa-trash"></i></a>

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
<!-- modal edit -->
<?php foreach ($perangkat as $row): ?>
    <!-- Modal Edit -->
    <div class="modal fade bd-example-modal-lg" id="modalEdit<?= $row['id'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Perangkat</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form action="/update-perangkat/<?= $row['id'] ?>" method="POST">
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama<?= $row['id'] ?>">Nama Perangkat</label>
                                <input type="text" class="form-control" id="nama<?= $row['id'] ?>" name="nama"
                                    value="<?= $row['nama'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_perangkat<?= $row['id'] ?>">Jenis Perangkat</label>
                                <input type="text" class="form-control" id="jenis_perangkat<?= $row['id'] ?>"
                                    name="jenis_perangkat" value="<?= $row['jenis_perangkat'] ?>">
                            </div>
                        </div>
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


<!-- /.container-fluid -->
<?= $this->endSection() ?>