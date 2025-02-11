<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/dashboarduser', 'DashboardController::user');
$routes->post('/pengaturan', 'DashboardController::pengaturan');


// gardu induk
$routes->get('/gardu_induk', 'GarduIndukController::index');
$routes->post('/proses-gi', 'GarduIndukController::prosesTambah');
$routes->post('/update-gi/(:num)', 'GarduIndukController::update/$1');
$routes->get('/delete-gi/(:num)', 'GarduIndukController::hapus/$1');

// perangkat
$routes->get('/perangkat', 'PerangkatController::index');
$routes->post('/proses-perangkat', 'PerangkatController::prosesTambah');
$routes->post('/update-perangkat/(:num)', 'PerangkatController::update/$1');
$routes->get('/delete-perangkat/(:num)', 'PerangkatController::delete/$1');

// keluhan
$routes->get('/keluhan', 'KeluhanController::index');
$routes->get('/tambah-keluhan', 'KeluhanController::tambah_data');
$routes->get('/edit-keluhan/(:num)', 'KeluhanController::edit/$1');
$routes->post('/proses-keluhan', 'KeluhanController::prosesTambah');
$routes->post('/update-keluhan/(:num)', 'KeluhanController::prosesUpdate/$1');
$routes->get('/update-status/(:num)', 'KeluhanController::updateStatus/$1');
$routes->get('/delete-keluhan/(:num)', 'KeluhanController::delete/$1');
$routes->get('/laporan-keluhan', 'KeluhanController::laporan');
$routes->get('/history-keluhan', 'KeluhanController::history');


// Gangguan
$routes->get('/gangguan', 'GangguanController::index');
$routes->get('/tambah-gangguan', 'GangguanController::tambah');
$routes->get('/edit-gangguan/(:num)', 'GangguanController::edit/$1');
$routes->post('/prosesTambah', 'GangguanController::prosesTambah');
$routes->post('/prosesUpdate/(:num)', 'GangguanController::prosesUpdate/$1');
$routes->get('/update-status_gangguan/(:num)', 'GangguanController::updateStatus/$1');
$routes->get('/delete-gangguan/(:num)', 'GangguanController::delete/$1');
$routes->get('/laporan-gangguan', 'GangguanController::laporan');
$routes->get('/history-gangguan', 'GangguanController::history');
$routes->get('/detail-gangguan/(:num)', 'GangguanController::detail/$1');

// monitoring keluhan
$routes->get('/monitoring_keluhan', 'MonitoringController::monitoring_keluhan');
$routes->get('/lihat_monitoring_keluhan', 'MonitoringController::lihat_monitoring');
$routes->get('/cetak_monitoring_keluhan', 'MonitoringController::cetak_monitoring_keluhan');
$routes->post('/update-monitoring-keluhan/(:num)', 'MonitoringController::updateMonitoringKeluhan/$1');
$routes->post('/update-progress-keluhan/(:num)', 'MonitoringController::updateProgressKeluhan/$1');

// monitoring gangguan
$routes->get('/monitoring_gangguan', 'MonitoringController::monitoring_gangguan');
$routes->get('/lihat_monitoring_gangguan', 'MonitoringController::lihat_monitoring_gangguan');
$routes->post('/update-monitoring-gangguan/(:num)', 'MonitoringController::updateMonitoringGangguan/$1');
$routes->post('/update-progress-gangguan/(:num)', 'MonitoringController::updateProgressGangguan/$1');
$routes->get('/cetak_monitoring_gangguan', 'MonitoringController::cetak_monitoring_gangguan');
$routes->post('/update-status-gangguan/(:num)', 'MonitoringController::updateStatusGangguan/$1');


// data keluar keluhan
$routes->get('/data_keluar_keluhan', 'DataKeluarController::data_keluar_keluhan');
$routes->get('/data_keluar_gangguan', 'DataKeluarController::data_keluhan_gangguan');
$routes->get('/laporan-data_keluar_gangguan', 'DataKeluarController::laporan_data_keluar_gangguan');
$routes->get('/laporan-data_keluar_keluhan', 'DataKeluarController::laporan_data_keluar_keluhan');

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

