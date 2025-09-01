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

    public function getPath(): string 
    {
        return $this->path;
    } 

    public function getView() {
        require __DIR__ . '/../../pages/Register/register.php';
    }

    public function registerNewUser(Database $database)  {
        // When using json as request the PHP does not automatically populate POST
        // expecting JSON
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

        // Creates a random valid api key 
        $api_key = bin2hex(random_bytes(16));

        try {
            // `Treat as string literal`
            // Placeholder should not be wrapped 
            $query = 'INSERT INTO `user` (`name`, `api_key`) VALUES (:name, :api_key)';
            $stmt = $database->getConnection()->prepare($query);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':api_key', $api_key, PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $pdoException) {
            die(ApiResponse::respondInternalServerError(message:$pdoException->getMessage()));

        $pdo->closeConnection();            
        }

        if($stmt->rowCount() === 0) {
            die(ApiResponse::respondInternalServerError());
        }

        $database->closeConnection();

        session_start();
        $_SESSION["api_key"];

        die(ApiResponse::respondOK());
    }
}