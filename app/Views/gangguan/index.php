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
                        <a href="/tambah-gangguan" class="btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Gangguan</a>
                        <a href="/laporan-gangguan" class="btn btn-sm btn-success shadow-sm ml-2"><i
                                class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan</a>
                        <a href="/history-gangguan" class="btn btn-sm btn-info shadow-sm ml-2"><i
                                class="fas fa-history fa-sm text-white-50"></i> Lihat History</a>
                    </div>
                    <!-- end modal tambah -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP </th>
                                    <th>Nama</th>
                                    <th>Kategori Gangguan</th>
                                    <th>Perangkat</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($gangguan as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nip'] ?></td>
                                        <td><?= $row['nama_pegawai'] ?></td>
                                        <td><?= $row['kategori_gangguan'] ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['deskripsi'] ?></td>
                                        <!-- span status -->
                                        <td>
                                            <span
                                                class="badge <?= $row['status'] == 'Belum Diajukan' ? 'badge-secondary' : 'badge-success' ?>">
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
                                                    <!-- Edit -->
                                                    <a class="dropdown-item"
                                                        href="/edit-gangguan/<?= $row['id_gangguan'] ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    <!-- Detail -->
                                                    <a class="dropdown-item text-info"
                                                        href="/detail-gangguan/<?= $row['id_gangguan'] ?>">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>

                                                    <!-- Update Status -->
                                                    <?php if ($row['status'] == 'Belum Diajukan'): ?>
                                                        <a class="dropdown-item text-success"
                                                            href="/update-status_gangguan/<?= $row['id_gangguan'] ?>"
                                                            onclick="return confirm('Apakah anda yakin ingin mengubah status data ini?')">
                                                            <i class="fas fa-check"></i> Update Status
                                                        </a>
                                                    <?php endif; ?>

                                                    <!-- Delete -->
                                                    <a class="dropdown-item text-danger"
                                                        href="/delete-gangguan/<?= $row['id_gangguan'] ?>"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
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

<!-- /.container-fluid -->
<?= $this->endSection() ?>