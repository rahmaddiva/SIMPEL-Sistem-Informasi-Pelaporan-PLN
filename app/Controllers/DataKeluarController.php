<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GarduIndukModel;
use App\Models\PerangkatModel;
use App\Models\KeluhanModel;
use App\Models\GangguanModel;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class DataKeluarController extends BaseController
{

    protected $garduIndukModel;
    protected $perangkatModel;
    protected $keluhanModel;
    protected $gangguanModel;
    protected $pegawaiModel;

    public function __construct()
    {
        $this->keluhanModel = new KeluhanModel();
        $this->gangguanModel = new GangguanModel();
        $this->pegawaiModel = new PegawaiModel();
        $this->garduIndukModel = new GarduIndukModel();
        $this->perangkatModel = new PerangkatModel();
    }


    public function data_keluar_keluhan()
    {
        $data = [
            'title' => 'Data Keluar Keluhan',
            'keluhan' => $this->keluhanModel->getKeluhanStatusSelesai(),
        ];

        return view('data_keluar/keluhan', $data);
    }

    public function data_keluhan_gangguan()
    {
        $data = [
            'title' => 'Data Keluar Gangguan',
            'gangguan' => $this->gangguanModel->getGangguanStatusSelesai(),
        ];

        return view('data_keluar/gangguan', $data);
    }

    public function laporan_data_keluar_gangguan()
    {
        $data = [
            'title' => 'Laporan Data Keluar Gangguan',
            'gangguan' => $this->gangguanModel->getGangguanStatusSelesai(),
        ];

        return view('data_keluar/laporan_gangguan', $data);
    }

    public function laporan_data_keluar_keluhan()
    {
        $data = [
            'title' => 'Laporan Data Keluar Keluhan',
            'keluhan' => $this->keluhanModel->getKeluhanStatusSelesai(),
        ];

        return view('data_keluar/laporan_keluhan', $data);
    }


}
