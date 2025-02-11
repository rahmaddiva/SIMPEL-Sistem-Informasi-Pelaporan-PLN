<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GangguanModel;
use App\Models\KeluhanModel;

use CodeIgniter\HTTP\ResponseInterface;

class MonitoringController extends BaseController
{

    protected $gangguanModel;

    protected $keluhanModel;

    public function __construct()
    {
        $this->gangguanModel = new GangguanModel();
        $this->keluhanModel = new KeluhanModel();
    }

    // ----------------------------------------FUNCTION MONITORING KELUHAN -------------------------------------------
    public function monitoring_keluhan()
    {
        $data = [
            'title' => 'Monitoring Keluhan Masuk',
            'keluhan' => $this->keluhanModel->getMonitoringKeluhan()

        ];
        return view('monitoring/keluhan', $data);
    }

    public function lihat_monitoring()
    {
        $data = [
            'title' => 'Data Monitoring Keluhan',
            'keluhan' => $this->keluhanModel->getLihatMonitoring()

        ];
        return view('monitoring/lihat_monitoring', $data);
    }

    public function cetak_monitoring_keluhan()
    {
        $data = [
            'title' => 'Cetak Monitoring Keluhan',
            'keluhan' => $this->keluhanModel->getLihatMonitoring()
        ];
        return view('monitoring/cetak_monitoring_keluhan', $data);
    }


    public function updateProgressKeluhan($id_keluhan)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'progress' => [
                'label' => 'Progress',
                'rules' => 'required',
                'errors' => ['required' => 'Progress tidak boleh kosong.']
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/monitoring_keluhan')
                ->withInput()
                ->with('error', 'Validasi gagal')
                ->with('validation', $validation);
        }

        // Ambil data keluhan lama
        $keluhan = $this->keluhanModel->find($id_keluhan);

        $foto = $this->request->getFile('foto_progress');
        if ($foto && $foto->isValid()) {
            // Hapus foto lama jika ada dan bukan default
            if ($keluhan['foto_progress'] !== 'foto_tidak_ada' && is_file(FCPATH . 'foto_progress/' . $keluhan['foto_progress'])) {
                unlink(FCPATH . 'foto_progress/' . $keluhan['foto_progress']);
            }

            // Simpan foto baru dengan ekstensi
            $fotoName = $foto->getRandomName();
            $ext = $foto->getClientExtension(); // Ambil ekstensi asli
            $fotoName = $fotoName . '.' . $ext;

            $foto->move(FCPATH . 'foto_progress', $fotoName);
        } else {
            // Gunakan foto lama
            $fotoName = $keluhan['foto_progress'];
        }

        // Logika jenis tombol dan status
        $jenis_tombol = $this->request->getPost('jenis_tombol');

        if ($jenis_tombol == 'Selesai') {
            $status = 'Selesai';
            $tanggalSelesai = date('Y-m-d H:i:s'); // Simpan tanggal selesai
        } else {
            $status = 'On Process';
            $tanggalSelesai = null; // Tidak ada tanggal selesai
        }

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'progress' => $this->request->getPost('progress'),
            'foto_progress' => $fotoName,
            'status' => $status,
            'tanggal_selesai' => $tanggalSelesai,
        ];

        $this->keluhanModel->update($id_keluhan, $data);
        session()->setFlashdata('success', 'Data monitoring keluhan berhasil diperbarui');
        return redirect()->to('/lihat_monitoring_keluhan');
    }



    public function updateMonitoringKeluhan($id_keluhan)
    {
        // form validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'progress' => 'required',

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/monitoring_keluhan')->withInput()->with('error', 'Data gagal ditambahkan')->with('validation', $validation);
        }

        $fotoProgress = $this->request->getFile('foto_progress');

        // kodisi jika foto tidak diisi maka akan disimpan "foto_tidak_ada" 
        $fotoProgress = $this->request->getFile('foto_progress');
        if (!$fotoProgress->isValid()) {
            $fotoName = 'foto_tidak_ada';
        } else {
            $fotoName = $fotoProgress->getRandomName();
            $fotoProgress->move(FCPATH . 'foto_progress', $fotoName);
        }


        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'progress' => $this->request->getPost('progress'),
            'foto_progress' => $fotoName,
            'tanggal_monitoring' => $this->request->getPost('tanggal_monitoring'),
            'status' => 'On Process'
        ];



        $this->keluhanModel->update($id_keluhan, $data);
        session()->setFlashdata('success', 'Data monitoring keluhan berhasil ditindaklanjuti');
        return redirect()->to(uri: '/monitoring_keluhan');
    }




    //----------------------------------FUNCTION MONITORING GANGGUAN ----------------------------------------------
    public function monitoring_gangguan()
    {
        $data = [
            'title' => 'Monitoring Gangguan Masuk',
            'gangguan' => $this->gangguanModel->getMonitoringGangguan()

        ];
        return view('monitoring/gangguan', $data);
    }


    public function lihat_monitoring_gangguan()
    {
        $data = [
            'title' => 'Data Monitoring Gangguan',
            'gangguan' => $this->gangguanModel->getLihatMonitoring()

        ];
        return view('monitoring/lihat_monitoring_gangguan', $data);
    }


    public function updateMonitoringGangguan($id_gangguan)
    {
        // form validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'progress' => 'required',

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/monitoring_gangguan')->withInput()->with('error', 'Data gagal ditambahkan')->with('validation', $validation);
        }

        $fotoProgress = $this->request->getFile('foto_progress');

        // kodisi jika foto tidak diisi maka akan disimpan "foto_tidak_ada" 
        $fotoProgress = $this->request->getFile('foto_progress');
        if (!$fotoProgress->isValid()) {
            $fotoName = 'foto_tidak_ada';
        } else {
            $fotoName = $fotoProgress->getRandomName();
            $fotoProgress->move(FCPATH . 'foto_progress', $fotoName);
        }

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'progress' => $this->request->getPost('progress'),
            'foto_progress' => $fotoName,
            'tanggal_progress' => $this->request->getPost('tanggal_progress'),
            'status' => 'On Process'
        ];


        $this->gangguanModel->update($id_gangguan, $data);
        session()->setFlashdata('success', 'Data monitoring gangguan berhasil ditindaklanjuti');
        return redirect()->to(uri: '/monitoring_gangguan');
    }

    public function updateProgressGangguan($id_gangguan)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'progress' => [
                'label' => 'Progress',
                'rules' => 'required',
                'errors' => ['required' => 'Progress tidak boleh kosong.']
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/monitoring_keluhan')
                ->withInput()
                ->with('error', 'Validasi gagal')
                ->with('validation', $validation);
        }

        // Ambil data gangguan lama
        $gangguan = $this->gangguanModel->find($id_gangguan);

        $foto = $this->request->getFile('foto_progress');
        if ($foto && $foto->isValid()) {
            // Hapus foto lama jika ada dan bukan default
            if ($gangguan['foto_progress'] !== 'foto_tidak_ada' && is_file(FCPATH . 'foto_progress/' . $gangguan['foto_progress'])) {
                unlink(FCPATH . 'foto_progress/' . $gangguan['foto_progress']);
            }

            // Simpan foto baru dengan ekstensi
            $fotoName = $foto->getRandomName();
            $ext = $foto->getClientExtension(); // Ambil ekstensi asli
            $fotoName = $fotoName . '.' . $ext;

            $foto->move(FCPATH . 'foto_progress', $fotoName);
        } else {
            // Gunakan foto lama
            $fotoName = $gangguan['foto_progress'];
        }

        // Logika jenis tombol dan status
        $jenis_tombol = $this->request->getPost('jenis_tombol');

        if ($jenis_tombol == 'Selesai') {
            $status = 'Selesai';
            $tanggalSelesai = date('Y-m-d H:i:s'); // Simpan tanggal selesai
        } else {
            $status = 'On Process';
            $tanggalSelesai = null; // Tidak ada tanggal selesai
        }

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'progress' => $this->request->getPost('progress'),
            'foto_progress' => $fotoName,
            'status' => $status,
            'tanggal_selesai' => $tanggalSelesai,
        ];

        $this->gangguanModel->update($id_gangguan, $data);
        session()->setFlashdata('success', 'Data monitoring gangguan berhasil diperbarui');
        return redirect()->to('/lihat_monitoring_gangguan');
    }

    public function cetak_monitoring_gangguan()
    {
        $data = [
            'title' => 'Cetak Monitoring Gangguan',
            'gangguan' => $this->gangguanModel->getLihatMonitoring()
        ];
        return view('monitoring/cetak_monitoring_gangguan', $data);
    }




}
