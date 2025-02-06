<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GudangIndukModel;
use CodeIgniter\HTTP\ResponseInterface;

class GudangIndukController extends BaseController
{

    protected $GudangIndukModel;

    public function __construct()
    {
        $this->GudangIndukModel = new GudangIndukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Gudang Induk',
            'gudang_induk' => $this->GudangIndukModel->getGudangInduk()
        ];

        return view('gudang_induk/index', $data);
    }

    public function prosesTambah()
    {
        // form validation 
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_gi' => 'required',
            'lokasi' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/gudang_induk')->withInput()->with('validation', $validation);
        }

        $this->GudangIndukModel->save([
            'nama_gi' => $this->request->getPost('nama_gi'),
            'lokasi' => $this->request->getPost('lokasi'),
            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng')
        ]);

        return redirect()->to('/gudang_induk');
    }

    public function update($id)
    {
        // Validasi form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_gi' => 'required',
            'lokasi' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // Update data
        $this->GudangIndukModel->update($id, [
            'nama_gi' => $this->request->getPost('nama_gi'),
            'lokasi' => $this->request->getPost('lokasi'),
            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng')
        ]);

        return redirect()->to('/gudang_induk')->with('success', 'Data Gudang Induk berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->GudangIndukModel->delete($id);
        return redirect()->to('/gudang_induk')->with('hapus', 'Data Gudang Induk berhasil dihapus.');
    }

}
