<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GarduIndukModel;
use App\Models\PerangkatModel;
use App\Models\KeluhanModel;
use App\Models\GangguanModel;
use App\Models\UserModel;

use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{

    protected $garduIndukModel;


    protected $perangkatModel;
    protected $keluhanModel;
    protected $gangguanModel;
    protected $userModel;

    public function __construct()
    {
        $this->garduIndukModel = new GarduIndukModel();
        $this->perangkatModel = new PerangkatModel();
        $this->keluhanModel = new KeluhanModel();
        $this->gangguanModel = new GangguanModel();
        $this->userModel = new UserModel();
    }

    public function pengaturan()
    {
        $userModel = new UserModel();
        $idUser = session()->get('id'); // Pastikan session ID ada

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($idUser, $data);
        session()->setFlashdata('success', 'Data berhasil diperbarui!');
        return redirect()->back();
    }
    public function index()
    {

        $id_gi = session()->get('id_gi'); // Ambil id_gi dari session

        // Ambil data gardu induk dari model
        $garduData = $this->garduIndukModel->where('id', $id_gi)->first();

        if ($garduData) {
            // Set data ke session
            session()->set('nama_gi', $garduData['nama_gi']);
            session()->set('lokasi', $garduData['lokasi']);
        }

        $data = [
            'title' => 'Dashboard',
            'jumlah_keluhan' => $this->keluhanModel->jumlah_keluhan(),
            'jumlah_gangguan' => $this->gangguanModel->getJumlahGangguan(),
            'jumlah_gardu_induk' => $this->garduIndukModel->countAll(),
            'gardu_induk' => $this->garduIndukModel->findAll(),

        ];

        return view('dashboard/index', $data);
    }

    public function user()
    {
        $data = [
            'title' => 'User',
        ];

        return view('dashboard/user', $data);
    }
}
