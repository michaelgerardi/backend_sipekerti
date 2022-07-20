<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/register','register::register');
$routes->post('/login','login::auth');
$routes->get('/nama','Pertemuan::getnama');
$routes->get('/kelas','Kelas::index');
$routes->get('/historykelas','Kelas::history');
$routes->get('/restore/(:segment)','kelas::restore/$1');
$routes->post('/kelas','Kelas::create');
$routes->get('/kelas/(:segment)' , 'Kelas::show/$1');
$routes->put('/kelas/(:segment)','kelas::update/$1');
// $routes->delete('/kelaspermanen/(:segment)','kelas::deletes_permanen/$1');
$routes->delete('/kelas/(:segment)','kelas::delete/$1');
$routes->get('/pertemuan','Pertemuan::index');
$routes->post('/pertemuan','Pertemuan::create');
$routes->get('/historypertemuan','pertemuan::history_pertemuan');
$routes->get('/restore_pertemuan/(:segment)','pertemuan::restore_pertemuan/$1');
$routes->get('/pertemuan/(:segment)' , 'Pertemuan::show/$1');
$routes->put('/pertemuan/(:segment)','Pertemuan::update/$1');
$routes->delete('/pertemuan/(:segment)','Pertemuan::delete/$1');
$routes->get('/materi','materi::index');
$routes->post('/materi','materi::create');
$routes->get('/materi/(:segment)' , 'materi::show/$1');
$routes->put('/materi/(:segment)','materi::update/$1');
$routes->delete('/materi/(:segment)','materi::delete/$1');
$routes->get('/komentar','komentar::index');
$routes->post('/komentar','komentar::create');
$routes->get('/komentar/(:segment)' , 'komentar::show/$1');
$routes->put('/komentar/(:segment)','komentar::update/$1');
$routes->delete('/komentar/(:segment)','komentar::delete/$1');
$routes->get('/tugas','tugas::index');
$routes->post('/tugas','tugas::create');
$routes->get('/tugas/(:segment)' , 'tugas::show/$1');
$routes->put('/tugas/(:segment)','tugas::update/$1');
$routes->delete('/tugas/(:segment)','tugas::delete/$1');
$routes->get('/level','login::select_level');
$routes->get('/level2','login::select_level2');

$routes->post('/inputgambar','gambar::inputgambar');
$routes->get('/nilai','nilai::indexnilai');
$routes->post('/nilai','nilai::createnilai');
$routes->get('/dashboard','nilai::dashboard');
$routes->get('/joinmateri','materi::joindata');
$routes->get('/dafnilai','nilai::nilai_peserta');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
