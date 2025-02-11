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
                    <!-- button kembali -->
                    <div class="d-sm-flex align-items-center justify-content mb-4">
                        <a href="/monitoring_gangguan" class="btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-arrow-left"></i>
                            Kembali</a>
                        <!-- cetak laporan monitoring -->
                        <a href="/cetak_monitoring_gangguan" class="btn btn-sm  btn-success shadow-sm ml-2"><i
                                class="fas fa-print"></i> Cetak Laporan Monitoring</a>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gardu Induk</th>
                                    <th>Tanggal Monitoring</th>
                                    <th>Keterangan</th>
                                    <th>Progress</th>
                                    <th>Nama Pegawai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($gangguan as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_gi'] ?></td>
                                        <td><?= $row['tanggal_progress'] ?></td>
                                        <td><?= $row['keterangan'] ?></td>
                                        <td><?= $row['progress'] ?></td>
                                        <td><?= $row['nama_pegawai'] ?></td>
                                        <td>
                                            <span
                                                class="badge <?= $row['status'] == 'Diajukan' ? 'badge-warning' : 'badge-success' ?>">
                                                <?= $row['status'] ?>
                                            </span>

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
                                                        data-target="#detail<?= $row['id_gangguan'] ?>">
                                                        <i class="fas fa-eye"></i> Detail Monitoring
                                                    </a>
                                                    <!-- Modal Update Monitoring -->
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                        data-target="#update<?= $row['id_gangguan'] ?>">
                                                        <i class="fas fa-edit"></i> Update Progress
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
<?php foreach ($gangguan as $row): ?>
    <div class="modal fade bd-example-modal-lg" id="update<?= $row['id_gangguan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Progress <?= $row['nama_pegawai'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/update-progress-gangguan/<?= $row['id_gangguan'] ?>" method="post"
                    enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama GI</label>
                                <input type="text" class="form-control" name="nama_gi" value="<?= $row['nama_gi'] ?>"
                                    readonly>
                                <input type="hidden" name="id_gangguan" value="<?= $row['id_gangguan'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Monitoring</label>
                                <input type="date" class="form-control" id="tanggal_monitoring" name="tanggal_monitoring"
                                    value="<?= date('Y-m-d') ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" value="<?= $row['keterangan'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Progress</label>
                                <input type="text" class="form-control" name="progress" value="<?= $row['progress'] ?>"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6"><!-- Input tanggal selesai akan muncul hanya jika progress 100% -->
                            <div class="form-group" id="tanggalSelesaiContainer" style="display: none;">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                                    value="<?= date('Y-m-d') ?>" readonly>
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
                            <img id="previewImage"
                                src="<?= $row['foto_progress'] !== 'foto_tidak_ada' && !empty($row['foto_progress']) ? base_url('foto_progress/' . $row['foto_progress']) : '#' ?>"
                                alt="Preview Foto"
                                style="<?= $row['foto_progress'] !== 'foto_tidak_ada' && !empty($row['foto_progress']) ? '' : 'display: none;' ?> width: 200px; height: 200px; object-fit: cover; border: 1px solid #ddd; padding: 5px;">
                        </div>

                        <script>
                            function previewFoto() {
                                const input = document.getElementById('foto_progress');
                                const preview = document.getElementById('previewImage');

                                if (input.files && input.files[0]) {
                                    const reader = new FileReader();

                                    reader.onload = function (e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block'; // Tampilkan gambar
                                        preview.style.width = '200px';
                                        preview.style.height = '200px';
                                        preview.style.objectFit = 'cover';
                                        preview.style.border = '1px solid #ddd';
                                        preview.style.padding = '5px';
                                    };

                                    reader.readAsDataURL(input.files[0]);
                                } else {
                                    preview.style.display = 'none'; // Sembunyikan jika tidak ada file
                                }
                            }
                        </script>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" name="jenis_tombol" value="Selesai" id="btnSimpanDataKeluar"
                            style="display: none;" type="submit">
                            Simpan Data Keluar
                        </button>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const progressInput = document.querySelector('input[name="progress"]');
                                const simpanDataKeluarBtn = document.getElementById("btnSimpanDataKeluar");
                                const tanggalSelesaiContainer = document.getElementById('tanggalSelesaiContainer');

                                // Fungsi untuk cek nilai progress dan kontrol tampilan
                                function handleProgressInput(progressValue) {
                                    if (progressValue === '100%') {
                                        simpanDataKeluarBtn.style.display = "inline-block";
                                        tanggalSelesaiContainer.style.display = 'block';
                                    } else {
                                        simpanDataKeluarBtn.style.display = "none";
                                        tanggalSelesaiContainer.style.display = 'none';
                                    }
                                }

                                // Periksa saat halaman dimuat
                                handleProgressInput(progressInput.value);

                                // Tambahkan event listener jika ada perubahan nilai input progress
                                progressInput.addEventListener("input", function () {
                                    handleProgressInput(progressInput.value.trim());
                                });
                            });
                        </script>



                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" name="jenis_tombol" value="On Process" type="submit">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Detail -->
<?php foreach ($gangguan as $row): ?>
    <div class="modal fade bd-example-modal-lg" id="detail<?= $row['id_gangguan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Gangguan <?= $row['nama_pegawai'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- roto dari folder foto_progress -->
                            <img src="<?= $row['foto_progress'] !== 'foto_tidak_ada' && !empty($row['foto_progress']) ? base_url('foto_progress/' . $row['foto_progress']) : '#' ?>"
                                alt="Foto Progress"
                                style="<?= $row['foto_progress'] !== 'foto_tidak_ada' && !empty($row['foto_progress']) ? '' : 'display: none;' ?> width: 250px; height: 250px; object-fit: cover; border: 1px solid #ddd; padding: 5px;">

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
                                    <td><?= $row['nama_pegawai'] ?></td>
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
                                    <td>Progress</td>
                                    <td>:</td>
                                    <td><?= $row['progress'] ?></td>
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