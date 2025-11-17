<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rute Autentikasi Pengguna
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attemptLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::attemptRegister');
$routes->get('/logout', 'Auth::logout');
$routes->get('/verify-email', 'Auth::verifyEmail');
$routes->get('/resend-verification', 'Auth::resendVerificationPage'); 
$routes->post('/resend-verification', 'Auth::attemptResendVerification'); 
// Rute Pendaftaran (dilindungi filter 'auth')
$routes->group('pendaftaran', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Pendaftaran::index');
    $routes->post('save', 'Pendaftaran::save');
    $routes->get('success', 'Pendaftaran::success');
    $routes->post('update', 'Pendaftaran::update');  
    $routes->get('bukti', 'Pendaftaran::bukti');
    $routes->get('downloadPDF', 'Pendaftaran::downloadPDF');
});

// --- Rute Admin ---
$routes->get('/admin/login', 'Admin\Auth::login');
$routes->post('/admin/login/process', 'Admin\Auth::processLogin');
$routes->get('/admin/logout', 'Admin\Auth::logout'); 

// Grup untuk halaman admin yang dilindungi filter
// INI BAGIAN YANG DIPERBAIKI: 'filter's' menjadi 'filter'
$routes->group('admin', ['filter' => 'adminauth'], static function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Rute CRUD Pendaftar
    $routes->get('pendaftar', 'Admin\Pendaftar::index');             // Menampilkan halaman tabel
    $routes->post('pendaftar/data', 'Admin\Pendaftar::getData');      // RUTE UNTUK AMBIL DATA AJAX
    $routes->post('pendaftar/update', 'Admin\Pendaftar::updateStatus'); // Update status via modal
    $routes->post('pendaftar/fullupdate', 'Admin\Pendaftar::fullUpdate'); // RUTE UNTUK EDIT DATA LENGKAP
    $routes->get('pendaftar/delete/(:num)', 'Admin\Pendaftar::delete/$1'); // Hapus data
    $routes->get('pendaftar/export', 'Admin\Pendaftar::exportExcel'); // Export Excel
});