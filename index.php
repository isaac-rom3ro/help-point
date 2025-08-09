<?php
require_once 'bootstrap.php';

use App\Web\Routes;
use App\Controller\LoginController;
use App\Controller\RegisterController;

    $routes = new Routes();

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

$routes->run();