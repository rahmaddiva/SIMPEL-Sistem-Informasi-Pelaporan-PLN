<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class PegawaiController extends BaseController
{

    protected $PegawaiModel;

    public function __construct()
    {
        $this->PegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pegawai',
            'pegawai' => $this->PegawaiModel->getAllPegawai()
        ];

        return view('pegawai/index', $data);
    }

    public function prosesTambah()
    {
    //    form validation 
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'jabatan' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/pegawai')->withInput()->with('validation', $validation);
        }

        $this->PegawaiModel->save([
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'nip' => $this->request->getPost('nip'),
            'jabatan' => $this->request->getPost('jabatan')
        ]);


        return redirect()->to('/pegawai')->with('success', 'Data Gudang Induk berhasil ditambahkan.');
    }

    public function update($id)
    {
        // Validasi form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'jabatan' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/pegawai')->withInput()->with('validation', $validation);
        }

        $this->PegawaiModel->update($id, [
            'nama_pegawai' => $this->request->getPost('nama_pegawai'),
            'nip' => $this->request->getPost('nip'),
            'jabatan' => $this->request->getPost('jabatan')
        ]);

        return redirect()->to('/pegawai')->with('success', 'Data Pegawai berhasil diubah.');
    }

    public function delete($id)
    {
        $this->PegawaiModel->delete($id);
        return redirect()->to('/pegawai')->with('hapus', 'Data Pegawai berhasil dihapus.');
    }
}
