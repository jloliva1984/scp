<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->get('/', 'Home::index');



//rutas para grocery crud de sistemas
$routes->get('/proyectos','Proyectos::proyectos_management');
$routes->post('/proyectos/(:any)','Proyectos::proyectos_management');
$routes->get('/proyectos/(:any)','Proyectos::proyectos_management');
$routes->get('/proyectos/edit/(:any)','Proyectos::proyectos_management/$1');
$routes->post('/proyectos/edit/(:any)','Proyectos::proyectos_management/$1');

$routes->get('/proyectos/delete_descarga/(:any)','Proyectos::delete_descarga/$1');
$routes->post('/proyectos/delete_descarga/(:any)','Proyectos::delete_descarga/$1');


//$routes->match(['get', 'post'],'/proyectos/delete_descarga', 'Proyectos::delete_descarga');
$routes->match(['get', 'post'],'/proyectos/insertar_descarga/(:any)', 'Proyectos::insertar_descarga/$1');

//rutas para grocery crud de subelementos de gasto
$routes->get('/subelementos_gasto','SubElementosGastos::SubElementosGastos_management');
$routes->post('/subelementos_gasto/(:any)','SubElementosGastos::SubElementosGastos_management');
$routes->get('/subelementos_gasto/(:any)','SubElementosGastos::SubElementosGastos_management');
$routes->get('/subelementos_gasto/edit/(:any)','SubElementosGastos::SubElementosGastos_management/$1');
$routes->post('/subelementos_gasto/edit/(:any)','SubElementosGastos::SubElementosGastos_management/$1');

//rutas para grocery crud de subsistemas
$routes->get('/subsistemas','Subsistemas::subsistemas_management');

$routes->post('/subsistemas/(:any)','Subsistemas::subsistemas_management');
$routes->get('/subsistemas/(:any)','Subsistemas::subsistemas_management');
$routes->get('/subsistemas/edit/(:any)','Subsistemas::subsistemas_management/$1');
$routes->post('/subsistemas/edit/(:any)','Subsistemas::subsistemas_management/$1');

$routes->get('/login', 'Login::index');
$routes->get('/incidencias/incidencias_show/(:any)', 'Incidencias::incidencias_show/$1');

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}