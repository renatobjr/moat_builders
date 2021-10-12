<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Routes for HomeController
$routes->get('/', 'HomeController::index');
$routes->get('/dashboard', 'HomeController::dashboard',['filter' => 'authGuard']);
// Routes for AlbumsController
$routes->match(['get', 'post'],'/dashboard/save-album/','AlbumController::saveAlbum',['filter' => 'authGuard']);
$routes->match(['get', 'post'],'/dashboard/edit-album/(:num)','AlbumController::editAlbum/$1',['filter' => 'authGuard']);
$routes->match(['get', 'post'],'/dashboard/delete-album/(:num)','AlbumController::deleteAlbum/$1',['filter' => 'authGuard']);
$routes->get('/dashboard/new-album','AlbumController::newAlbum',['filter' => 'authGuard']);
// Routes for UsersController
$routes->match(['get','post'], '/save-user', 'UsersController::saveUser');
$routes->match(['get','post'], '/dashboard/edit-profile/(:num)', 'UsersController::profile/$1',['filter' => 'authGuard']);
$routes->match(['get','post'], '/login', 'UsersController::login');
$routes->get('/new-user', 'UsersController::newUser');
$routes->get('/logout', 'UsersController::logout');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
