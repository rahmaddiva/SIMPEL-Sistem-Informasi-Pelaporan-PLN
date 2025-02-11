<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GangguanModel;
use App\Models\GarduIndukModel;
use App\Models\PerangkatModel;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class GangguanController extends BaseController
{

    protected $gangguanModel;
    protected $garduIndukModel;
    protected $perangkatModel;
    protected $pegawaiModel;



    public function __construct()
    {
        $this->gangguanModel = new GangguanModel();
        $this->garduIndukModel = new GarduIndukModel();
        $this->perangkatModel = new PerangkatModel();
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Gangguan',
            'gangguan' => $this->gangguanModel->getGangguan(),
            'gardu_induk' => $this->garduIndukModel->findAll(),
            'perangkat' => $this->perangkatModel->findAll(),
            'pegawai' => $this->pegawaiModel->findAll(),
        ];
        return view('gangguan/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Gangguan',
            'gangguan' => $this->gangguanModel->getGangguanById($id),
            'gardu_induk' => $this->garduIndukModel->findAll(),
            'perangkat' => $this->perangkatModel->findAll(),
            'pegawai' => $this->pegawaiModel->findAll(),
        ];
        return view('gangguan/detail', $data);
    }

    public function history()
    {
        $data = [
            'title' => 'History Gangguan',
            'gangguan' => $this->gangguanModel->getHistoryGangguan(),
            'gardu_induk' => $this->garduIndukModel->findAll(),
            'perangkat' => $this->perangkatModel->findAll(),
            'pegawai' => $this->pegawaiModel->findAll(),
        ];
        return view('gangguan/histori', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data Gangguan',
            'gardu_induk' => $this->garduIndukModel->findAll(),
            'perangkat' => $this->perangkatModel->findAll(),
            'pegawai' => $this->pegawaiModel->findAll(),
        ];
        return view('gangguan/tambah', $data);
    }

    public function prosesTambah()
    {
        // form validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_pegawai' => 'required',
            'kategori_gangguan' => 'required',
            'id_perangkat' => 'required',
            'deskripsi' => 'required',
          
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/tambah-gangguan')->withInput()->with('error', 'Data gagal ditambahkan')->with('validation', $validation);
        }


        // kodisi jika foto tidak diisi maka akan disimpan "foto_tidak_ada" 
        $foto = $this->request->getFile('foto');
        if (!$foto->isValid()) {
            $fotoName = 'foto_tidak_ada';
        } else {
            $fotoName = $foto->getRandomName();
            $foto->move(FCPATH . 'foto_gangguan', $fotoName);
        }


        $data = [
            'id_pegawai' => $this->request->getPost('id_pegawai'),
            'id_user' => session()->get('id_user'),
            'id_perangkat' => $this->request->getPost('id_perangkat'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'id_gi' => session()->get('id_gi'),
            'foto' => $fotoName,
            'tanggal_mulai' => date('Y-m-d H:i:s'),
            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng'),
            'status' => "Belum Diajukan",
            'kategori_gangguan' => $this->request->getPost('kategori_gangguan'),
        ];


        $this->gangguanModel->insert($data);
        return redirect()->to('/gangguan')->with('success', 'Data gangguan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Gangguan',
            'gangguan' => $this->gangguanModel->getGangguanById($id),
            'gardu_induk' => $this->garduIndukModel->findAll(),
            'perangkat' => $this->perangkatModel->findAll(),
            'pegawai' => $this->pegawaiModel->findAll(),
        ];
        return view('gangguan/edit', $data);
    }

    public function prosesUpdate($id)
    {
        // form validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_pegawai' => 'required',
            'kategori_gangguan' => 'required',
            'id_perangkat' => 'required',
            'deskripsi' => 'required',
          
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/edit-gangguan/' . $this->request->getPost('id_gangguan'))->withInput()->with('error', 'Data gagal diupdate')->with('validation', $validation);
        }

        // Ambil data gangguan lama
        $gangguan = $this->gangguanModel->find($id);

        // Kondisi jika tidak ada upload foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid()) {
            // Hapus foto lama jika ada dan bukan default
            if ($gangguan['foto'] !== 'foto_tidak_ada' && file_exists(FCPATH . 'foto_gangguan/' . $gangguan['foto'])) {
                unlink(FCPATH . 'foto_gangguan/' . $gangguan['foto']);
            }

            // Simpan foto baru
            $fotoName = $foto->getRandomName();
            $foto->move(FCPATH . 'foto_gangguan', $fotoName);
        } else {
            // Gunakan foto lama
            $fotoName = $gangguan['foto'];
        }
        $data = [
            'id_pegawai' => $this->request->getPost('id_pegawai'),
            'id_user' => session()->get('id_user'),
            'id_perangkat' => $this->request->getPost('id_perangkat'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'id_gi' => session()->get('id_gi'),
            'foto' => $fotoName,
            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng'),
            'kategori_gangguan' => $this->request->getPost('kategori_gangguan'),
        ];

        $this->gangguanModel->update($id, $data);
        return redirect()->to('/gangguan')->with('success', 'Data gangguan berhasil diupdate');
    }




    public function delete($id)
    {
        $gangguan = $this->gangguanModel->find($id);
        if ($gangguan['foto'] !== 'foto_tidak_ada' && file_exists(FCPATH . 'foto_gangguan/' . $gangguan['foto'])) {
            unlink(FCPATH . 'foto_gangguan/' . $gangguan['foto']);
        }
        $this->gangguanModel->delete($id);
        return redirect()->to('/gangguan')->with('success', 'Data gangguan berhasil dihapus');
    }

    public function updateStatus($id)
    {
        $data = [
            'status' => 'Diajukan'
        ];
        $this->gangguanModel->update($id, $data);
        return redirect()->to('/gangguan')->with('success', 'Status gangguan berhasil diupdate');
    }

    public function laporan()
    {
        $Gangguan = $this->gangguanModel->getGangguan();

        // Load view dengan data keluhan
        $data = [
            'title' => 'Laporan Keluhan',
            'gangguan' => $Gangguan
        ];

        return view('gangguan/laporan_pdf', $data);
    }


}
