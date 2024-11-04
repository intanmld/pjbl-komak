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

