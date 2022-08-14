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
//LOGIN-REGIS
$routes->get('/', 'Home::index');
$routes->post('/register','register::register');
$routes->post('/addPengajar','register::registerPengajar');
$routes->post('/login','login::auth');

$routes->delete('/delete/(:segment)','login::delete/$1');
$routes->delete('/delete-permanent/(:segment)','dosen::delete/$1');
$routes->put('/update/(:segment)','login::update/$1');

//KELAS (clear)
$routes->get('/kelas','kelas::index'); //all
$routes->post('/kelas','kelas::create'); 
$routes->get('/kelas/(:segment)', 'kelas::show/$1'); //byId

$routes->get('/nama','Pertemuan::getnama');
$routes->get('/kelas','Kelas::index');
$routes->get('/historykelas','Kelas::history');
$routes->get('/restore/(:segment)','kelas::restore/$1');
$routes->post('/kelas','Kelas::create');
$routes->get('/kelas/(:segment)' , 'Kelas::show/$1');

$routes->put('/kelas/(:segment)','kelas::update/$1');
// $routes->delete('/kelaspermanen/(:segment)','kelas::deletes_permanen/$1');
$routes->delete('/kelas/(:segment)','kelas::delete/$1');

$routes->delete('/delete-kelas/(:segment)','kelas::deletePermanent/$1');
$routes->get('/historyKelas','Kelas::history');
$routes->get('/restore/(:segment)','kelas::restore/$1');

//PERTEMUAN (clear)
$routes->get('/pertemuan-null','pertemuan::viewAllDeletedNull'); //all
$routes->get('/pertemuan','pertemuan::index'); //all
$routes->get('/get-pertemuan/(:segment)','pertemuan::getbyidkelas/$1'); //all
$routes->get('/pertemuan-pengajar/(:segment)','pertemuan::pertemuanByPengajar/$1');//by id pengajar
$routes->post('/pertemuan','pertemuan::create');
$routes->post('/update-pertemuan/(:segment)','pertemuan::update_pertemuan/$1');
$routes->delete('/pertemuan/(:segment)','pertemuan::delete/$1');
$routes->delete('/delete-pertemuan/(:segment)','pertemuan::deletePermanent/$1');
$routes->get('/historyPertemuan','pertemuan::history_pertemuan');
$routes->get('/restorePertemuan/(:segment)','pertemuan::restore_pertemuan/$1');

//MATERI
$routes->post('/materi','materi::create'); 
$routes->get('/get-materi','materi::index'); //all
$routes->get('/materi/(:segment)','materi::getMateri/$1');//by id pertemuan

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
$routes->delete('/materi/(:segment)','materi::deletePermanent/$1');

//POSTING
$routes->get('/komentar/(:segment)','komentar::getData/$1');
$routes->get('/komentar-peserta/(:segment)','komentar::getByUser/$1');
$routes->post('/komentar','komentar::create');
$routes->put('/komentar/(:segment)','komentar::update/$1');
$routes->get('/komentar-null','komentar::viewAllDeletedNull');//all
$routes->delete('/komentar/(:segment)','komentar::delete/$1');

//TUGAS
$routes->get('/tugas','tugas::index');//all
$routes->get('/task/(:segment)','getid::getTugas/$1');//by id pertemuan
$routes->post('/tugas','tugas::create');
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

//TUGAS-PESERTA
$routes->post('/tugas-peserta','tugaspeserta::create');
$routes->get('/tugas-peserta/(:segment)','tugaspeserta::getData/$1');//by id pertemuan
$routes->get('/tugas-peserta-null','tugaspeserta::viewAllDeletedNull');//all
$routes->delete('/tugas-peserta/(:segment)','tugaspeserta::delete/$1');

//DASHBOARD
$routes->get('/lulus','nilai::datalulus');
$routes->get('/gagal','nilai::datatidaklulus');

//NILAI
$routes->get('/nilai','nilai::index');
$routes->get('/nilai-byId','nilai::nilaiById');
$routes->post('/add-nilai','nilai::create');
$routes->put('/update-nilai/(:segment)','nilai::update_nilai/$1');
$routes->get('/nilai-tugas/(:segment)','nilai::show/$1');
$routes->get('/getnilai/(:segment)','nilai::getnilai/$1');
$routes->delete('/nilai-peserta/(:segment)','nilai::delete/$1');

$routes->get('/meeting/(:segment)','getid::index/$1');
$routes->get('/getNamaKelas/(:segment)','pertemuan::idxKelas/$1');
$routes->get('/getpertemuan/(:segment)','getid::getpertemuan/$1');


$routes->get('/peserta','dosen::select_peserta');
$routes->get('/pengajar','dosen::select_pengajar');
$routes->delete('/dosen/(:segment)','dosen::delete/$1');
$routes->get('/historyDosen','dosen::history');
$routes->get('/restoreDosen/(:segment)','dosen::restore/$1');
$routes->get('/session','Login::getuser');

//$routes->resource('materi');
$routes->get('/material/(:segment)','getid::getMateri/$1');

//$routes->resource('tugas');


// $routes->resource('komentar');
$routes->get('/posting/(:segment)','getid::getPosting/$1');
$routes->get('/namaPertemuan/(:segment)','komentar::getnama_pertemuan/$1');
$routes->post('/add-posting','komentar::create');
$routes->put('/update-posting/(:segment)','komentar::update/$1');
//$routes->delete('/hapus-posting/(:segment)','komentar::delete/$1');


//////////////////

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
