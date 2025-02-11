<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeluhanModel;
use App\Models\PegawaiModel;
use App\Models\PerangkatModel;
use App\Models\GarduIndukModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class KeluhanController extends BaseController
{

    protected $keluhanModel;
    protected $pegawaiModel;
    protected $perangkatModel;
    protected $garduIndukModel;


    public function __construct()
    {
        $this->keluhanModel = new KeluhanModel();
        $this->pegawaiModel = new PegawaiModel();
        $this->perangkatModel = new PerangkatModel();
        $this->garduIndukModel = new GarduIndukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Keluhan',
            'keluhan' => $this->keluhanModel->getKeluhan()
        ];

        return view('keluhan/index', $data);
    }

    public function history()
    {
        $data = [
            'title' => 'History Keluhan',
            'keluhan' => $this->keluhanModel->getKeluhanHistory()
        ];

        return view('keluhan/histori', $data);
    }

    public function tambah_data()
    {
        $data = [
            'title' => 'Tambah Data Keluhan',
            'pegawai' => $this->pegawaiModel->findAll(),
            'perangkat' => $this->perangkatModel->findAll(),
            'gardu_induk' => $this->garduIndukModel->findAll()
        ];
        return view('keluhan/tambah', $data);
    }

    public function prosesTambah()
    {
        // form validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pengajuan' => 'required',
            'id_pegawai' => 'required',
            'id_perangkat' => 'required',
            'keterangan' => 'required',


        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/tambah-keluhan')->withInput()->with('error', 'Data gagal ditambahkan')->with('validation', $validation);
        }

        // kodisi jika foto tidak diisi maka akan disimpan "foto_tidak_ada" 
        $foto = $this->request->getFile('foto');
        if (!$foto->isValid()) {
            $fotoName = 'foto_tidak_ada';
        } else {
            $fotoName = $foto->getRandomName();
            $foto->move(FCPATH . 'foto_keluhan', $fotoName);
        }

        $data = [
            'nama_pengajuan' => $this->request->getPost('nama_pengajuan'),
            'id_pegawai' => $this->request->getPost('id_pegawai'),
            'id_user' => session()->get('id_user'),
            'tanggal_mulai' => date('Y-m-d'),
            'id_perangkat' => $this->request->getPost('id_perangkat'),
            'keterangan' => $this->request->getPost('keterangan'),
            'id_gi' => session()->get('id_gi'),
            'foto' => $fotoName,
            'status' => "Belum Diajukan",
        ];

        // var_dump($data);
        // die;

        $this->keluhanModel->insert($data);
        return redirect()->to('/keluhan')->with('success', 'Data keluhan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Keluhan',
            'pegawai' => $this->pegawaiModel->findAll(),
            'perangkat' => $this->perangkatModel->findAll(),
            'gardu_induk' => $this->garduIndukModel->findAll(),
            'keluhan' => $this->keluhanModel->getKeluhanById($id)
        ];
        return view('keluhan/edit', $data);
    }

    public function prosesUpdate($id)
    {
        // Form validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pengajuan' => 'required',
            'id_pegawai' => 'required',
            'id_perangkat' => 'required',
            'keterangan' => 'required',

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to("/keluhan/edit/$id")->withInput()->with('error', 'Data gagal ditambahkan')->with('validation', $validation);
        }

        // Ambil data keluhan lama
        $keluhan = $this->keluhanModel->find($id);

        // Kondisi jika tidak ada upload foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid()) {
            // Hapus foto lama jika ada dan bukan default
            if ($keluhan['foto'] !== 'foto_tidak_ada' && file_exists(FCPATH . 'foto_keluhan/' . $keluhan['foto'])) {
                unlink(FCPATH . 'foto_keluhan/' . $keluhan['foto']);
            }

            // Simpan foto baru
            $fotoName = $foto->getRandomName();
            $foto->move(FCPATH . 'foto_keluhan', $fotoName);
        } else {
            // Gunakan foto lama
            $fotoName = $keluhan['foto'];
        }

        $data = [
            'nama_pengajuan' => $this->request->getPost('nama_pengajuan'),
            'id_pegawai' => $this->request->getPost('id_pegawai'),
            'id_user' => session()->get('id_user'),
            'id_perangkat' => $this->request->getPost('id_perangkat'),
            'keterangan' => $this->request->getPost('keterangan'),
            'id_gi' => session()->get('id_gi'),
            'foto' => $fotoName,
            'status' => "Belum Diajukan",
        ];

        $this->keluhanModel->update($id, $data);

        return redirect()->to('/keluhan')->with('success', 'Data keluhan berhasil diperbarui.');
    }

    public function updateStatus($id)
    {
        $data = [
            'status' => 'Diajukan'
        ];

        $this->keluhanModel->update($id, $data);
        return redirect()->to('/keluhan')->with('success', 'Status keluhan berhasil diubah.');
    }


    public function delete($id)
    {
        $keluhan = $this->keluhanModel->find($id);

        // Hapus foto jika bukan default
        if ($keluhan['foto'] !== 'foto_tidak_ada' && file_exists(FCPATH . 'foto_keluhan/' . $keluhan['foto'])) {
            unlink(FCPATH . 'foto_keluhan/' . $keluhan['foto']);
        }

        $this->keluhanModel->delete($id);
        return redirect()->to('/keluhan')->with('success', 'Data keluhan berhasil dihapus.');
    }

    public function laporan()
    {
        $keluhanData = $this->keluhanModel->getKeluhan();

        // Load view dengan data keluhan
        $data = [
            'title' => 'Laporan Keluhan',
            'keluhan' => $keluhanData
        ];

        return view('keluhan/laporan_pdf', $data);
    }

}
