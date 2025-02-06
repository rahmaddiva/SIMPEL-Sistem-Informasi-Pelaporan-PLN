<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/dashboarduser', 'DashboardController::user');
$routes->get('/gudang_induk', 'GudangIndukController::index');
$routes->post('/proses-gi', 'GudangIndukController::prosesTambah');
$routes->post('/update-gi/(:num)', 'GudangIndukController::update/$1');
$routes->get('/delete-gi/(:num)', 'GudangIndukController::hapus/$1');


// pegawai
$routes->get('/pegawai', 'PegawaiController::index');
$routes->post('/proses-pegawai', 'PegawaiController::prosesTambah');
$routes->post('/update-pegawai/(:num)', 'PegawaiController::update/$1');
$routes->get('/delete-pegawai/(:num)', 'PegawaiController::delete/$1');

// user
$routes->get('/user', 'UserController::index');
$routes->post('/proses-user', 'UserController::prosesTambah');
$routes->post('/update-user/(:num)', 'UserController::update/$1');
$routes->get('/delete-user/(:num)', 'UserController::delete/$1');

// login
$routes->post('/login/proses', 'LoginController::prosesLogin');
$routes->get('/logout', 'LoginController::logout');

