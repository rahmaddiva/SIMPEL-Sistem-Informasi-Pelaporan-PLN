<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
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
