<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->setAutoRoute(false);

$routes->get('/', 'Home::index');

$routes->options('(:any)', function() {});

$routes->group('api', function($routes) {
    
    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');
    $routes->post('admin/login', 'AuthController::adminLogin');
    $routes->post('user/update', 'AuthController::updateProfile');
    $routes->post('user/apply', 'AuthController::applyWorker');

    $routes->post('booking/create', 'BookingController::create');
    $routes->get('booking/list/(:num)', 'BookingController::list/$1');
    $routes->post('booking/createWorker', 'BookingController::createWorker');
    
    $routes->get('booking/worker-pending/(:segment)', 'BookingController::listPendingForWorker/$1');
    
    $routes->post('booking/update-status', 'BookingController::updateStatus');
    
    $routes->get('booking/worker-history/(:num)', 'BookingController::listWorkerHistory/$1');
    
    $routes->post('booking/submit-review', 'BookingController::submitReview');

    $routes->get('workers/list', 'WorkerController::list');

    $routes->get('admin/applications', 'AdminController::getApplications');
    $routes->post('admin/application/update', 'AdminController::updateStatus');
    $routes->get('admin/worker-salaries', 'AdminController::listWorkerSalaries');

    $routes->post('api/user/update-profile', 'UserController::updateProfile');

    $routes->get('recommendations', 'RecommendationController::getRecommendedWorkers');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}