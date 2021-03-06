<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'Home::index');
$routes->add('register', 'Login::register');
$routes->add('sk', 'Login::sk');
$routes->add('tips', 'Login::tips');
$routes->add('login', 'Login::login');
$routes->add('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->add('edit', 'Dashboard::edit', ['filter' => 'auth']);
$routes->add('profile', 'Dashboard::profile', ['filter' => 'auth']);
$routes->add('beli', 'Dashboard::beliPage', ['filter' => 'auth']);
$routes->add('admin', 'Transaksi::admin', ['filter' => 'auth']);
$routes->add('detail/(:alphanum)', 'Transaksi::detail/$1', ['filter' => 'auth']);
/**
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
