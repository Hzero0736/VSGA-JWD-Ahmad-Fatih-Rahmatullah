<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');
$routes->get('packages', 'Pemesanan::index');
$routes->post('packages/tambah', 'Pemesanan::tambah');

$routes->get('pesanan', 'detailPemesanan::index');
$routes->get('pesanan/hapus/(:any)', 'detailPemesanan::hapus/$1');
$routes->post('pesanan/edit/(:num)', 'detailPemesanan::edit/$1');

$routes->get('gallery', 'Home::gallery');
$routes->get('contact', 'Home::contact');
