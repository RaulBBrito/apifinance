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
$routes->get('/', 'Home::index');
$routes->get('users',           'UserController::list');
$routes->get('cartao',          'CartaoController::list');
$routes->get('mensal',          'MensalController::list');
$routes->get('itensmes',        'ItensMesController::list');
$routes->get('tipoitemmes',     'TipoItemMesController::list');
$routes->get('recursoitens',    'RecursoItensController::list');
$routes->get('itenscartaomes',  'ItensCartaoMesController::list');

$routes->post('user/createjwt',           'AuthController::create');

$routes->post('users/create',           'UserController::create');
$routes->post('cartao/create',          'CartaoController::create');
$routes->post('mensal/create',          'MensalController::create');
$routes->post('itensmes/create',        'ItensMesController::create');
$routes->post('tipoitemmes/create',     'TipoItemMesController::create');
$routes->post('recursoitens/create',    'RecursoItensController::create');
$routes->post('itenscartaomes/create',  'ItensCartaoMesController::create');

$routes->delete('users/delete/(.*)',           'UserController::delete/$1');
$routes->delete('cartao/delete/(.*)',          'CartaoController::delete/$1');
$routes->delete('mensal/delete/(.*)',          'MensalController::delete/$1');
$routes->delete('itensmes/delete/(.*)',        'ItensMesController::delete/$1');
$routes->delete('tipoitemmes/delete/(.*)',     'TipoItemMesController::delete/$1');
$routes->delete('recursoitens/delete/(.*)',    'RecursoItensController::delete/$1');
$routes->delete('itenscartaomes/delete/(.*)',  'ItensCartaoMesController::delete/$1');

$routes->get('users/buscar/(.*)',           'UserController::buscar/$1');
$routes->get('cartao/buscar/(.*)',          'CartaoController::buscar/$1');
$routes->get('mensal/buscar/(.*)',          'MensalController::buscar/$1');
$routes->get('itensmes/buscar/(.*)',        'ItensMesController::buscar/$1');
$routes->get('tipoitemmes/buscar/(.*)',     'TipoItemMesController::buscar/$1');
$routes->get('recursoitens/buscar/(.*)',    'RecursoItensController::buscar/$1');
$routes->get('itenscartaomes/buscar/(.*)',  'ItensCartaoMesController::buscar/$1');

$routes->put('users/update',           'UserController::update');
$routes->put('cartao/update',           'CartaoController::update');
$routes->put('mensal/update',           'MensalController::update');
$routes->put('itensmes/update',           'ItensMesController::update');
$routes->put('tipoitemmes/update',           'TipoItemMesController::update');
$routes->put('recursoitens/update',           'RecursoItensController::update');
$routes->put('itenscartaomes/update',           'ItensCartaoMesController::update');
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
