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

                    <!-- Form Tambah Gangguan -->
                    <form action="/prosesTambah" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_pegawai" class="form-label">Pegawai</label>
                                <select class="form-control select2" id="id_pegawai" name="id_pegawai">
                                    <option value="">-- Pilih Pegawai --</option>
                                    <?php foreach ($pegawai as $row): ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['nama_pegawai'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_perangkat" class="form-label">Perangkat</label>
                                <select class="form-control select2" id="id_perangkat" name="id_perangkat">
                                    <option value="">-- Pilih Perangkat --</option>
                                    <?php foreach ($perangkat as $row): ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                                    placeholder="Masukkan deskripsi gangguan"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="kategori_gangguan" class="form-label">Kategori Gangguan</label>
                                <select class="form-control select2" id="kategori_gangguan" name="kategori_gangguan">
                                    <option value="">-- Pilih Kategori Gangguan --</option>
                                    <option value="Major">Major</option>
                                    <option value="Minor">Minor</option>
                                </select>
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
                                <img id="previewImage" src="#" alt="Preview Foto"
                                    style="display: none; width: 100%; max-width: 300px; height: auto; object-fit: cover; border: 1px solid #ddd; padding: 5px;">
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
                                <input type="text" class="form-control" id="lat" name="lat" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="lng" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="lng" name="lng" readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Tambah Gangguan</button>
                        <a href="/gangguan" class="btn btn-secondary mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Leaflet Map -->
<script>
    var map = L.map('map').setView([-3.457220257505901, 114.8335586209902], 11); // Koordinat default Jakarta

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Marker awal di posisi default
    var marker = L.marker([-3.457220257505901, 114.8335586209902], { draggable: true }).addTo(map);

    // Set nilai awal lat dan lng
    document.getElementById('lat').value = -6.200000;
    document.getElementById('lng').value = 106.816666;

    // Perbarui input lat dan lng ketika marker digeser
    marker.on('dragend', function (e) {
        var latLng = marker.getLatLng();
        document.getElementById('lat').value = latLng.lat;
        document.getElementById('lng').value = latLng.lng;
    });

    // Tambahkan event klik pada peta untuk pindah marker
    map.on('click', function (e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Set nilai input lat dan lng
        document.getElementById('lat').value = lat;
        document.getElementById('lng').value = lng;

        // Pindahkan marker ke lokasi baru
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

<?= $this->endSection() ?>