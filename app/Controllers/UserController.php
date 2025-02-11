<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\GarduIndukModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;


    protected $garduIndukModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->garduIndukModel = new GarduIndukModel();
    }
    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->userModel->getUser(),
            'gardu_induk' => $this->garduIndukModel->findAll()
        ];
        return view('user/index', $data);
    }

   

    public function prosesTambah()
    {
        // form validation
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to('/user')->withInput()->with('validation', $validation);
        }

        $this->userModel->save([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'hak' => $this->request->getPost('hak'),
            'id_gi' => $this->request->getPost('id_gi')
        ]);

        return redirect()->to('/user')->with('success', 'Data berhasil ditambahkan');

    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',

        ]);

        if (!$validation->run($this->request->getPost())) {
            return redirect()->to('/user')->withInput()->with('validation', $validation);
        }

        $this->userModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'hak' => $this->request->getPost('hak'),
            'id_gi' => $this->request->getPost('id_gi')
        ]);

        return redirect()->to('/user')->with('success', 'Data berhasil diubah');

    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/user')->with('success', 'Data berhasil dihapus');
    }
}
