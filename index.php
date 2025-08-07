<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

use App\Web\Routes;
use App\Connection\Database;
use App\Controller\LoginController;
use App\Controller\RegisterController;

$dotEnv = DotEnv::createImmutable(__DIR__);
$dotEnv->load();
$database = new Database(host: $_ENV['DB_HOST'], databaseName: $_ENV['DB_NAME'], charset: $_ENV['DB_CHARSET'], username: $_ENV['DB_USERNAME'], password: $_ENV['DB_PASSWORD']);

$routes = new Routes();

$registerController = new RegisterController();
$routes->addNewRoute(
    path: $registerController->getPath(),
    method: 'POST',
    callback: fn() => $registerController->registerNewUser($database)
);

$loginController = new LoginController();
$routes->addNewRoute(
    path: $loginController->getPath(),
    method: 'POST',
    callback: fn() => $loginController->signIn()
);

$routes->run();
