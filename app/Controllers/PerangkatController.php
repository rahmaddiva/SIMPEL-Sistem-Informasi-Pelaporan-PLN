<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerangkatModel;
use CodeIgniter\HTTP\ResponseInterface;

class PerangkatController extends BaseController
{

    protected $PerangkatModel;

    public function __construct()
    {
        $this->PerangkatModel = new PerangkatModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perangkat',
            'perangkat' => $this->PerangkatModel->getAllPerangkat()
        ];

        return view('perangkat/index', $data);
    }

    public function prosesTambah()
    {
        // form validation
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama' => 'required',
            'jenis_perangkat' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/perangkat')->withInput()->with('validation', $validation);
        }

        $this->PerangkatModel->save([
            'nama' => $this->request->getPost('nama'),
            'jenis_perangkat' => $this->request->getPost('jenis_perangkat')
        ]);

        return redirect()->to('/perangkat')->with('success', 'Data Perangkat berhasil ditambahkan.');
    }

    public function update($id)
    {
        // Validasi form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'jenis_perangkat' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/perangkat')->withInput()->with('validation', $validation);
        }

        $this->PerangkatModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'jenis_perangkat' => $this->request->getPost('jenis_perangkat')
        ]);

        return redirect()->to('/perangkat')->with('success', 'Data Perangkat berhasil diubah.');
    }

    public function delete($id)
    {
        $this->PerangkatModel->delete($id);

        return redirect()->to('/perangkat')->with('hapus', 'Data Perangkat berhasil dihapus.');
    }


}
