<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('tentang/(:segment)', 'PageController::tentang/$1');
$routes->get('karir', 'PageController::karir');

$routes->get('program', 'ProgramController::index');
$routes->get('program/(:segment)', 'ProgramController::detail/$1');
$routes->get('zakat/(:segment)', 'ZakatController::detail/$1');
$routes->get('layanan/kurban-online/pesan/(:num)', 'LayananController::pesanKurban/$1');
$routes->post('layanan/kurban-online/store', 'LayananController::storeKurban');
$routes->get('layanan/kurban-online/invoice/(:segment)', 'LayananController::invoiceKurban/$1');
$routes->post('layanan/konfirmasi/store', 'LayananController::storeKonfirmasi');
$routes->get('layanan/(:segment)', 'LayananController::detail/$1');

$routes->get('kabar', 'BeritaController::index');
$routes->get('kabar/kategori/(:segment)', 'BeritaController::kategori/$1');
$routes->get('kabar/(:segment)', 'BeritaController::detail/$1');
$routes->get('artikel', 'BeritaController::artikel');
$routes->get('laporan', 'BeritaController::laporan');
$routes->get('pustaka', 'BeritaController::pustaka');
$routes->get('kontak', 'PageController::kontak');
$routes->post('kontak/send', 'PageController::sendContact');

$routes->get('bayar-zakat', 'ZakatController::bayar');
$routes->get('kalkulator', 'LayananController::kalkulator');
$routes->get('setup-admin-initial', 'Setup::index');

$routes->get('login', 'AuthController::login');
$routes->post('login/attempt', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');

// CMS Dashboard Routes
$routes->group('admin', ['filter' => 'adminAuth'], function($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('pages', 'Dashboard::pages');
    $routes->get('pages/create', 'Dashboard::pageCreate');
    $routes->post('pages/save', 'Dashboard::pageSave');
    $routes->get('pages/edit/(:num)', 'Dashboard::pageEdit/$1');
    $routes->get('pages/delete/(:num)', 'Dashboard::pageDelete/$1');

    $routes->get('posts', 'Dashboard::posts');
    $routes->get('posts/create', 'Dashboard::postCreate');
    $routes->post('posts/save', 'Dashboard::postSave');
    $routes->get('posts/edit/(:num)', 'Dashboard::postEdit/$1');
    $routes->get('posts/delete/(:num)', 'Dashboard::postDelete/$1');

    $routes->get('programs', 'Dashboard::programs');
    $routes->get('programs/create', 'Dashboard::programCreate');
    $routes->post('programs/save', 'Dashboard::programSave');
    $routes->get('programs/edit/(:num)', 'Dashboard::programEdit/$1');
    $routes->get('programs/delete/(:num)', 'Dashboard::programDelete/$1');

    $routes->get('transactions', 'Dashboard::transactions');
    $routes->get('contacts', 'Dashboard::contacts');
    $routes->get('contacts/delete/(:num)', 'Dashboard::contactDelete/$1');
    $routes->get('transactions/approve/(:any)/(:segment)', 'Dashboard::transactionUpdateStatus/$1/$2');
    $routes->get('midtrans', 'Dashboard::settings');
    $routes->post('midtrans/toggle', 'Dashboard::toggleMidtrans');
    $routes->get('settings', 'Dashboard::settings');
    $routes->post('settings/update', 'Dashboard::settingsUpdate'); // Assuming I'll add this next
    $routes->post('upload-file', 'Dashboard::uploadFile');
    $routes->get('devices', 'Dashboard::devices');

    // Rekening Management
    $routes->get('rekening', 'Admin\AdminRekeningController::index');
    $routes->get('rekening/create', 'Admin\AdminRekeningController::create');
    $routes->post('rekening/store', 'Admin\AdminRekeningController::store');
    $routes->get('rekening/edit/(:num)', 'Admin\AdminRekeningController::edit/$1');
    $routes->post('rekening/update/(:num)', 'Admin\AdminRekeningController::update/$1');
    $routes->get('rekening/delete/(:num)', 'Admin\AdminRekeningController::delete/$1');
    $routes->get('rekening/toggle-status/(:num)', 'Admin\AdminRekeningController::toggleStatus/$1');

    // Kurban Packages Management
    $routes->get('kurban', 'Admin\AdminKurbanController::index');
    $routes->get('kurban/create', 'Admin\AdminKurbanController::create');
    $routes->post('kurban/store', 'Admin\AdminKurbanController::store');
    $routes->get('kurban/edit/(:num)', 'Admin\AdminKurbanController::edit/$1');
    $routes->post('kurban/update/(:num)', 'Admin\AdminKurbanController::update/$1');
    $routes->get('kurban/delete/(:num)', 'Admin\AdminKurbanController::delete/$1');
    $routes->get('kurban/toggle-status/(:num)', 'Admin\AdminKurbanController::toggleStatus/$1');

    // Kurban Orders Management
    $routes->get('kurban/orders', 'Admin\AdminKurbanController::orders');
    $routes->post('kurban/orders/(:num)/update-status', 'Admin\AdminKurbanController::updateOrderStatus/$1');
    $routes->get('kurban/orders/approve/(:num)/(:segment)', 'Admin\AdminKurbanController::quickUpdateStatus/$1/$2');
    $routes->get('kurban/orders/certificate/(:num)', 'Admin\AdminKurbanController::certificate/$1');
});

// API Gateway Routes
$routes->group('api/v1', function($routes) {
    $routes->post('payment/checkout', 'Api\PaymentController::checkout');
    $routes->post('payment/notification', 'Api\PaymentController::notification'); // Midtrans webhook
});
