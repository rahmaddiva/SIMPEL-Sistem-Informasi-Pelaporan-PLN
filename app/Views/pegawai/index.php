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
                        Pegawai</a>

                    <!-- Modal Tambah Fullscreen -->
                    <div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                                <form action="/proses-pegawai" method="POST">
                                    <div class="modal-body row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_pegawai">Nama</label>
                                                <input type="text" class="form-control" id="nama_pegawai"
                                                    name="nama_pegawai">
                                            </div>
                                            <div class="form-group">
                                                <label for="nip">NIP</label>
                                                <input type="text" class="form-control" id="nip" name="nip">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jabatan">Jabatan</label>
                                                <input type="text" class="form-control" id="jabatan" name="jabatan">
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
                                    <th>Nama Pegawai</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pegawai as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_pegawai'] ?></td>
                                        <td><?= $row['nip'] ?></td>
                                        <td><?= $row['jabatan'] ?></td>
                                        <td>
                                            <!-- button modal edit -->
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#modalEdit<?= $row['id'] ?>"><i
                                                    class="fas fa-edit"></i></button>

                                            <a href="/delete-pegawai/<?= $row['id'] ?>" class="btn btn-sm btn-danger"
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
<?php foreach ($pegawai as $row): ?>
    <!-- Modal Edit -->
    <div class="modal fade bd-example-modal-lg" id="modalEdit<?= $row['id'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Gudang Induk</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form action="/update-pegawai/<?= $row['id'] ?>" method="POST">
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_pegawai">Nama</label>
                                <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"
                                    value="<?= $row['nama_pegawai'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="<?= $row['nip'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan"
                                    value="<?= $row['jabatan'] ?>">
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