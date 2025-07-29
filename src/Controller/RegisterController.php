<?php
declare(strict_types=1);

namespace App\Controller;

use PDO;
use PDOException;

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
            die(json_encode([
                'message' => 'Method Not Allowed',
                'status' => 405
            ]));
        }

        // When using json as request the PHP does not automatically populate POST
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if($data === null) {
            die(json_encode([
                'message' => 'Bad Request', 
                'status' => 400])
            );
        }

        if(! array_key_exists('name', $data)) {
            die(json_encode([
                'message' => 'Bad Request', 
                'status' => 400])
            );
        }
        
        if(empty($data['name'])) {
            die(json_encode([
                'message' => 'Bad Request', 
                'status' => 400])
            );
        }

        try {
            // `Treat as string literal`
            // Placeholder should not be wrapped 
            $query = 'INSERT INTO `user` (`name`) VALUES (:name)';
            $stmt = $connection->prepare($query);
            $stmt->bindParam(':name', $data['name']);
            $stmt->execute();
        } catch(PDOException $pdoException) {
            die($pdoException);
            
        }
        if($stmt->rowCount() > 0) {
            die(json_encode([
                'message' => 'User Created', 
                'status' => 201])
            );
        } else {
            die(json_encode([
                'message' => 'Internal Server Error', 
                'status' => 500])
            );
        }

    }

    public function getPath(): string 
    {
        return $this->path;
    } 
}