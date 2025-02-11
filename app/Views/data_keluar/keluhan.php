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
                    <!-- Button Tambah, cetak dan history -->
                    <div class="d-sm-flex align-items-center justify-content mb-4">
                        <a href="/laporan-data_keluar_keluhan" class="btn btn-sm btn-success shadow-sm ml-2"><i
                                class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan</a>

                    </div>
                    <!-- end modal tambah -->
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
                                                class="badge <?= $row['status'] == 'Belum Diajukan' ? 'badge-secondary' : 'badge-success' ?>">
                                                <?= $row['status'] ?>
                                            </span>
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

<!-- /.container-fluid -->
<?= $this->endSection() ?>