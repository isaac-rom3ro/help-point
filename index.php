<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

use App\Controller\RegisterController;
use App\Web\Routes;
use App\Connection\Database;

$dotEnv = DotEnv::createImmutable(__DIR__);
$dotEnv->load();

$pdo = new Database(host: $_ENV['DB_HOST'], databaseName: $_ENV['DB_NAME'], charset: $_ENV['DB_CHARSET'], username: $_ENV['DB_USERNAME'], password: $_ENV['DB_PASSWORD']);
$routes = new Routes();

$registerController = new RegisterController();

$routes->addNewRoute(path: $registerController->getPath(), callback: $registerController->registerNewUser(connection: $pdo->getConnection()));

$routes->run();