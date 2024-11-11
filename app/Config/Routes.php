<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('/akun1', 'Akun1::index');
$routes->get('/permintaanpembelian', 'PermintaanPembelian::index');
$routes->get('/permintaanpembelian/create', 'PermintaanPembelian::create');
$routes->post('/permintaanpembelian/store', 'PermintaanPembelian::store');

$routes->get('persetujuan', 'Persetujuan::index');
$routes->get('persetujuan/edit/(:num)', 'Persetujuan::edit/$1');
$routes->post('persetujuan/update/(:num)', 'Persetujuan::update/$1');
$routes->get('sync-persetujuan', 'SyncPersetujuan::syncData');

$routes->get('/persetujuan', 'Persetujuan::index');
$routes->post('/persetujuan/update_status/(:num)', 'Persetujuan::update/$1');
$routes->get('/persetujuan/delete/(:num)', 'Persetujuan::delete/$1');
