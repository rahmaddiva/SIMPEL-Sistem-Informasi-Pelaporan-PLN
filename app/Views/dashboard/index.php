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
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Gangguan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahGangguan['jumlah_gangguan'] ?? '0' ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Keluhan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_keluhan['jumlah_keluhan'] ?? '0' ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Gardu Induk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_gardu_induk ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Peta Gardu Induk</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Leaflet Map Container -->
                    <div id="map" style="height: 500px;"></div>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            // Inisialisasi Peta Leaflet
            var map = L.map('map').setView([-6.200000, 106.816666], 7); // Koordinat default untuk Indonesia

            // Tambahkan layer peta dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Data Gardu Induk dari Controller (PHP ke JS)
            var garduData = <?= json_encode($gardu_induk) ?>;

            // Tambahkan Marker untuk setiap Gardu Induk
            garduData.forEach(function (gardu) {
                if (gardu.lat && gardu.lng) {
                    var marker = L.marker([gardu.lat, gardu.lng]).addTo(map);
                    marker.bindPopup(
                        `<strong>${gardu.nama_gi}</strong><br>` +
                        `Lokasi: ${gardu.lokasi}`
                    );
                }
            });
        </script>

    </div>
   



</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>