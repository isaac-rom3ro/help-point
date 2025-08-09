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

    public function signIn(Database $database) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if($data === null) {
            die(ApiResponse::respondBadRequest());
        }

        if(! array_key_exists('name', $data) || ! array_key_exists('api_key', $data)) {
            die(ApiResponse::respondBadRequest());
        }
        
        if(empty($data['name']) || empty($data['api_key'])) {
            die(ApiResponse::respondBadRequest());
        }
        
        try {
            $query = 'SELECT `name` FROM user WHERE api_key = :api_key';
            $stmt = $database->getConnection()->prepare($query);
            $stmt->bindParam(':api_key', $data['api_key'], PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $pdoException) {
            die(ApiResponse::respondInternalServerError(message:$pdoException->getMessage()));
        }

        $response = $stmt->fetch(mode: PDO::FETCH_ASSOC);

        if($response === false) {
            die(ApiResponse::respondNotFound());
        }

        session_start();
        $_SESSION['name'] = $response['name'];
        
        die(ApiResponse::respondOK());
    }
}