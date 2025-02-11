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
                    <!-- tombol lihat monitoring -->
                    <div class="d-sm-flex align-items-center justify-content mb-4">
                        <a href="/lihat_monitoring_gangguan" class="btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-eye fa-sm text-white-50"></i> Lihat Monitoring</a>
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
                                                        data-target="#detail<?= $row['id_gangguan'] ?>">
                                                        <i class="fas fa-eye"></i> Detail gangguan
                                                    </a>
                                                    <!-- Modal Update Monitoring -->
                                                    <a class="dropdown-item text-success" href="#" data-toggle="modal"
                                                        data-target="#update<?= $row['id_gangguan'] ?>">
                                                        <i class="fas fa-pen"></i> Tindak Lanjut
                                                    </a>
                                                </div>
                                            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tindak Lanjut Gangguan <?= $row['nama_pegawai'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/update-monitoring-gangguan/<?= $row['id_gangguan'] ?>" method="post"
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
                                <label>Kategori Gangguan</label>
                                <input type="text" class="form-control" name="progress"
                                    value="<?= $row['kategori_gangguan'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Pegawai</label>
                                <input type="text" class="form-control" name="Nama Pegawai"
                                    value="<?= $row['nama_pegawai'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" name="progress" value="<?= $row['deskripsi'] ?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Monitoring</label>
                                <input type="date" class="form-control" id="tanggal_monitoring" name="tanggal_monitoring"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                                    placeholder="Masukkan keterangan"></textarea>
                            </div>
                        </div>
                        <!-- progress -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="progress">Progress</label>
                                <input type="text" class="form-control" id="progress" name="progress"
                                    placeholder="Masukkan progress">
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
                    <form>
                        <?= csrf_field() ?>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="id_pegawai" class="form-label">Pegawai</label>
                                <input type="text" class="form-control" value="<?= $row['nama_pegawai'] ?>" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="id_perangkat" class="form-label">Perangkat</label>
                                <input type="text" class="form-control" value="<?= $row['nama'] ?>" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="tanggal_mulai" class="form-label">Tanggal Gangguan</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                                    value="<?= $row['tanggal_mulai'] ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_gi" class="form-label">Gardu Induk</label>
                                <input type="text" class="form-control" value="<?= $row['nama_gi'] ?>" readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                                    readonly><?= $row['deskripsi'] ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="kategori_gangguan" class="form-label">Kategori Gangguan</label>
                                <select class="form-control select2" id="kategori_gangguan" name="kategori_gangguan"
                                    disabled>
                                    <option value="">-- Pilih Kategori Gangguan --</option>
                                    <option value="Major" <?= $row['kategori_gangguan'] == 'Major' ? 'selected' : '' ?>>Major
                                    </option>
                                    <option value="Minor" <?= $row['kategori_gangguan'] == 'Minor' ? 'selected' : '' ?>>Minor
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <label class="form-label">Preview Foto</label>
                                <br>
                                <img id="previewImage"
                                    src="<?= $row['foto'] !== 'foto_tidak_ada' && !empty($row['foto']) ? base_url('foto_gangguan/' . $row['foto']) : '#' ?>"
                                    alt="Preview Foto"
                                    style="<?= $row['foto'] !== 'foto_tidak_ada' && !empty($row['foto']) ? '' : 'display: none;' ?> width: 250px; height: 250px; object-fit: cover; border: 1px solid #ddd; padding: 5px;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Peta Lokasi</label>
                                <div id="map" style="width: 100%; height: 400px; border: 1px solid #ddd;"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="lat" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="lat" name="lat" value="<?= $row['lat'] ?>"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label for="lng" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="lng" name="lng" value="<?= $row['lng'] ?>"
                                    readonly>
                            </div>
                        </div>


                    </form>


                    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

                    <script>
                        var map = L.map('map').setView([<?= $row['lat'] ?>, <?= $row['lng'] ?>], 11);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        var marker = L.marker([<?= $row['lat'] ?>, <?= $row['lng'] ?>], { draggable: true }).addTo(map);

                        marker.on('dragend', function (e) {
                            var latLng = marker.getLatLng();
                            document.getElementById('lat').value = latLng.lat;
                            document.getElementById('lng').value = latLng.lng;
                        });

                        map.on('click', function (e) {
                            var lat = e.latlng.lat;
                            var lng = e.latlng.lng;

                            document.getElementById('lat').value = lat;
                            document.getElementById('lng').value = lng;

                            marker.setLatLng([lat, lng]);
                        });
                    </script>
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