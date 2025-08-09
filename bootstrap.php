<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use App\Connection\Database;

$dotEnv = DotEnv::createImmutable(__DIR__);
$dotEnv->load();

$database = new Database(host: $_ENV['DB_HOST'], databaseName: $_ENV['DB_NAME'], charset: $_ENV['DB_CHARSET'], username: $_ENV['DB_USERNAME'], password: $_ENV['DB_PASSWORD']); 