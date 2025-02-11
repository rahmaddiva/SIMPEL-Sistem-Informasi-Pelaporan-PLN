<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GarduIndukModel;
use CodeIgniter\HTTP\ResponseInterface;

class GarduIndukController extends BaseController
{

    protected $GarduIndukModel;

    public function __construct()
    {
        $this->GarduIndukModel = new GarduIndukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Gardu Induk',
            'gardu_induk' => $this->GarduIndukModel->getGarduInduk()
        ];

        return view('gardu_induk/index', $data);
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
            return redirect()->to('/gardu_induk')->withInput()->with('validation', $validation);
        }

        $this->GarduIndukModel->save([
            'nama_gi' => $this->request->getPost('nama_gi'),
            'lokasi' => $this->request->getPost('lokasi'),
            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng')
        ]);

        return redirect()->to('/gardu_induk');
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
        $this->GarduIndukModel->update($id, [
            'nama_gi' => $this->request->getPost('nama_gi'),
            'lokasi' => $this->request->getPost('lokasi'),
            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng')
        ]);

        return redirect()->to('/gardu_induk')->with('success', 'Data gardu Induk berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $this->GarduIndukModel->delete($id);
        return redirect()->to('/gardu_induk')->with('hapus', 'Data gardu Induk berhasil dihapus.');
    }

}
