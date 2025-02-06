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
                        Gudang Induk</a>

                    <!-- Modal Tambah Fullscreen -->
                    <div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Gudang Induk</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                                <form action="/proses-gi" method="POST">
                                    <div class="modal-body row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_gi">Nama GI</label>
                                                <input type="text" class="form-control" id="nama_gi" name="nama_gi">
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi">Lokasi</label>
                                                <input type="text" class="form-control" id="lokasi" name="lokasi">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lat">Latitude</label>
                                                <input type="text" class="form-control" id="lat" name="lat" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="lng">Longitude</label>
                                                <input type="text" class="form-control" id="lng" name="lng" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div id="map" style="height: 500px; width: 100%;"></div>
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
                    <!-- Leaflet CSS -->
                    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                    <!-- Leaflet JS -->
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                    <script>
                        // Inisialisasi Map dengan pusat default
                        var map = L.map('map').setView([-3.475040, 114.798923], 13);
                        // Layer tile OSM
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);
                        // Tambahkan marker yang bisa digeser
                        var marker = L.marker([-3.475040, 114.798923], { draggable: true }).addTo(map);
                        // Perbarui Latitude dan Longitude di form
                        marker.on('moveend', function (event) {
                            var position = marker.getLatLng();
                            document.getElementById('lat').value = position.lat.toFixed(6);
                            document.getElementById('lng').value = position.lng.toFixed(6);
                        });
                    </script>
                    <!-- end modal tambah -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama GI</th>
                                    <th>Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($gudang_induk as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_gi'] ?></td>
                                        <td><?= $row['lokasi'] ?></td>
                                        <td><?= $row['lat'] ?></td>
                                        <td><?= $row['lng'] ?></td>
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
<?php foreach ($gudang_induk as $row): ?>
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
                <form action="/update-gi/<?= $row['id'] ?>" method="POST">
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_gi_<?= $row['id'] ?>">Nama GI</label>
                                <input type="text" class="form-control" id="nama_gi_<?= $row['id'] ?>" name="nama_gi"
                                    value="<?= $row['nama_gi'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="lokasi_<?= $row['id'] ?>">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi_<?= $row['id'] ?>" name="lokasi"
                                    value="<?= $row['lokasi'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lat_<?= $row['id'] ?>">Latitude</label>
                                <input type="text" class="form-control" id="lat_<?= $row['id'] ?>" name="lat"
                                    value="<?= $row['lat'] ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="lng_<?= $row['id'] ?>">Longitude</label>
                                <input type="text" class="form-control" id="lng_<?= $row['id'] ?>" name="lng"
                                    value="<?= $row['lng'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div id="mapEdit<?= $row['id'] ?>" style="height: 500px; width: 100%;"></div>
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

    <script>
        // Inisialisasi Map Edit
        var lat<?= $row['id'] ?> = <?= $row['lat'] ?>;
        var lng<?= $row['id'] ?> = <?= $row['lng'] ?>;
        var mapEdit<?= $row['id'] ?> = L.map('mapEdit<?= $row['id'] ?>').setView([lat<?= $row['id'] ?>, lng<?= $row['id'] ?>], 13);

        // Layer tile OSM
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapEdit<?= $row['id'] ?>);

        // Tambahkan marker berdasarkan koordinat dari database
        var markerEdit<?= $row['id'] ?> = L.marker([lat<?= $row['id'] ?>, lng<?= $row['id'] ?>], { draggable: true }).addTo(mapEdit<?= $row['id'] ?>);

        // Perbarui nilai lat dan lng saat marker dipindahkan
        markerEdit<?= $row['id'] ?>.on('moveend', function (event) {
            var position = markerEdit<?= $row['id'] ?>.getLatLng();
            document.getElementById('lat_<?= $row['id'] ?>').value = position.lat.toFixed(6);
            document.getElementById('lng_<?= $row['id'] ?>').value = position.lng.toFixed(6);
        });
    </script>
<?php endforeach; ?>


<!-- /.container-fluid -->
<?= $this->endSection() ?>