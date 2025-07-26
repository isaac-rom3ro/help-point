<?php
declare(strict_types=1);

namespace App\Controller;

use PDO;

class RegisterController {
    private string $path;

    public function __construct() {
        $this->path = '/register';
    }

    public function registerNewUser(PDO $connection) {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(
            $requestMethod !== 'POST'
        ) {
            die(json_encode(['message' => 'Method Not Allowed']));
        }


        echo 'User Created';
        die();
    }

    public function getPath(): string 
    {
        return $this->path;
    } 
}