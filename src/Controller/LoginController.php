<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Web\ApiResponse;

class LoginController {
    private string $path;

    public function __construct() {
        $this->path = '/login';
    }

    public function getPath(): string {
        return $this->path;
    }

    public function signIn() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(
            $requestMethod !== 'POST'
        ) {
            die(ApiResponse::respondMethodNotAllowed());
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        print_r($data);
    }
}