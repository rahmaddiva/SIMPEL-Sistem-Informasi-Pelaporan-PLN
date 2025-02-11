<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        @page {
            size: A4 landscape;
            margin: 25mm 10mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 20px;
            color: black;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 70px;
            margin-right: 20px;
        }

        .header-text {
            text-align: center;
            flex-grow: 1;
        }

        h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .sub-header {
            font-size: 14px;
            line-height: 1.4;
        }

        hr {
            border: 1px solid black;
            margin-top: 10px;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            font-size: 13px;
        }

        th {
            background-color: #f0f0f0;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0;
            }
        }
    </style>

    <script>
        window.onload = function () {
            window.print();
        };

        window.onfocus = function () {
            window.close();
        };
    </script>
</head>

<body>
    <div class="header">
        <img src="<?= base_url('assets/img/logo_pln.png') ?>" alt="Logo PLN">
        <div class="header-text">
            <h2>PT PLN (PERSERO) UP2B KALIMANTAN SELATAN DAN TENGAH</h2>
            <div class="sub-header">
                Jl. H. Mistar Cokrokusumo,<br>
                Guntung Paikat, Kec. Banjarbaru Selatan,<br>
                Kota Banjarbaru, Kalimantan Selatan, 70732
            </div>
        </div>
    </div>

    <hr>
    <h3 class="title">LAPORAN DATA MONITORING</h3>

    <table>
        <thead>
            <tr>
                <th>NAMA GI</th>
                <th>TANGGAL MONITORING</th>
                <th>KETERANGAN</th>
                <th>PROGRESS</th>
                <th>NAMA PEGAWAI</th>
                <th>FOTO</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($keluhan)): ?>
                <?php foreach ($keluhan as $row): ?>
                    <tr>
                        <td><?= $row['nama_gi'] ?></td>
                        <td><?= $row['tanggal_monitoring'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td><?= $row['progress'] ?></td>
                        <td><?= $row['nama_pegawai'] ?></td>
                        <td>
                            <?php if (!empty($row['foto_progress'])): ?>
                                <img src="<?= base_url('foto_progress/' . $row['foto_progress']) ?>" alt="Foto Keluhan" style="width: 70px;">
                            <?php else: ?>
                                Tidak Ada Foto
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data keluhan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>