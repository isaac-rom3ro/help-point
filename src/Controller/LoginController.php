<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Connection\Database;
use App\Web\ApiResponse;

use PDO;
use PDOException;

class LoginController {
    private string $path;

    public function __construct() {
        $this->path = '/login';
    }

    public function getPath(): string {
        return $this->path;
    }

    public function getView() {
        require __DIR__ . '/../../pages/Login/login.php';
    }

    public function signIn(Database $database) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if($data === null) {
            die(ApiResponse::respondBadRequest());
        }

        if(! array_key_exists('name', $data) || ! array_key_exists('password', $data)) {
            die(ApiResponse::respondBadRequest());
        }
        
        if(empty($data['name']) || empty($data['password'])) {
            die(ApiResponse::respondBadRequest());
        }
        
        try {
            $query = 'SELECT `id`, `api_key` FROM user WHERE `password` = :password';
            $stmt = $database->getConnection()->prepare($query);
            $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $pdoException) {
            die(ApiResponse::respondInternalServerError(message:$pdoException->getMessage()));
        }

        $response = $stmt->fetch(mode: PDO::FETCH_ASSOC);

        if($response === false) {
            die(ApiResponse::respondNotFound());
        }

        session_start();
        $_SESSION['id'] = $response['id'];
        $_SESSION['api_key'] = $response['api_key'];
        
        // Instead of die here, let's redirect to the main page
        die(ApiResponse::respondOK());
    }
}