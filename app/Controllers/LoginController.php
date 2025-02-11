<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];

        return view('login/index.php', $data);
    }

    public function prosesLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Input tidak valid atau kosong!');
            return redirect()->to('/')->withInput();
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            session()->setFlashdata('error', 'Username atau password salah!');
            return redirect()->back();
        }

        // Set Session Data
        session()->set([
            'id' => $user['id'],
            'nama' => $user['nama'],
            'username' => $user['username'],
            'hak' => $user['hak'], // Tambahkan hak dari tabel user
            'id_gi' => $user['id_gi'],
            'isLoggedIn' => true
        ]);

        session()->setFlashdata('success', 'Login berhasil!');
        // Redirect Berdasarkan hak
        if ($user['hak'] === 'admin') {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/dashboard');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
