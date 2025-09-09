<?php
require_once 'bootstrap.php';

use App\Web\Routes;
use App\Controller\IndexController;
use App\Controller\LoginController;
use App\Controller\PointController;
use App\Controller\RegisterController;

$routes = new Routes();

$indexController = new IndexController();
$routes->addNewRoute(
    path: $indexController->getPath(),
    method: 'GET',
    callback: fn() => $indexController->getView()
);

$registerController = new RegisterController();
$routes->addNewRoute(
    path: $registerController->getPath(),
    method: 'POST',
    callback: fn() => $registerController->registerNewUser($database)
);
$routes->addNewRoute(
    path: $registerController->getPath(),
    method: 'GET',
    callback: fn() => $registerController->getView()    
);

$loginController = new LoginController();
$routes->addNewRoute(
    path: $loginController->getPath(),
    method: 'POST',
    callback: fn() => $loginController->signIn(database: $database)
);
$routes->addNewRoute(
    path: $loginController->getPath(),
    method: 'GET',
    callback: fn() => $loginController->getView()
);

$pointerController = new PointController();
$routes->addNewRoute(
    path: $pointerController->getPath(),
    method: 'GET',
    callback: fn() => $pointerController->getView()
);

$routes->run();