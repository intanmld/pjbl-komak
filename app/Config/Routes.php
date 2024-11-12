<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Home::index');
$routes->get('/akun1', 'Akun1::index');
$routes->get('akun1/edit/(:num)', 'Akun1::edit/$1');
$routes->post('akun1/create', 'Akun1::create');
$routes->get('akun1/delete/(:num)', 'Akun1::delete/$1');
$routes->post('akun1/update/(:num)', 'Akun1::update/$1');


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
$routes->get('/persetujuan/approve/(:num)', 'Persetujuan::approve/$1');

$routes->get('/purchaseorder', 'PurchaseOrder::index');
$routes->get('/purchaseorder/detail/(:num)', 'PurchaseOrder::detail/$1');
$routes->get('/purchaseorder/edit/(:num)', 'PurchaseOrder::edit/$1');
$routes->get('/purchaseorder/delete/(:num)', 'PurchaseOrder::delete/$1');


