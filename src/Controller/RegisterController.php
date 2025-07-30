<?php
declare(strict_types=1);

namespace App\Controller;

use App\Connection\Database;
use App\Web\ApiResponse;
use PDO;
use PDOException;

class RegisterController {
    private string $path;

    public function __construct() {
        $this->path = '/register';
    }

    public function registerNewUser(Database $database) {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(
            $requestMethod !== 'POST'
        ) {
            die(ApiResponse::respondMethodNotAllowed());
        }

        // When using json as request the PHP does not automatically populate POST
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if($data === null) {
            die(ApiResponse::respondBadRequest());
        }
        
        if(! array_key_exists('name', $data)) {
            die(ApiResponse::respondBadRequest());
        }
        
        if(empty($data['name'])) {
            die(ApiResponse::respondBadRequest());
        }

        try {
            // `Treat as string literal`
            // Placeholder should not be wrapped 
            $query = 'INSERT INTO `user` (`name`) VALUES (:name)';
            $stmt = $database->getConnection()->prepare($query);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $pdoException) {
            die($pdoException);

        $pdo->closeConnection();            
        }

        if($stmt->rowCount() === 0) {
            die(ApiResponse::respondInternalServerError());
        }

        $database->closeConnection();
        die(ApiResponse::respondCreated(createdResource: 'User Created'));
    }

    public function getPath(): string 
    {
        return $this->path;
    } 
}