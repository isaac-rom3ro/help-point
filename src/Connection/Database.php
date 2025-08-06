<?php
declare(strict_types = 1);

namespace App\Connection;

use App\Web\ApiResponse;
use PDO;
use PDOException;

class Database {
    private ?PDO $pdo;

    public function __construct(
                            private string $host, 
                            private string $databaseName, 
                            private string $charset, 
                            private string $username, 
                            private string $password
    ) {
    }

    public function getConnection(): PDO {
        try {
            $this->pdo = new PDO(
                dsn: "mysql:host=$this->host;dbname=$this->databaseName;charset=$this->charset;",
                username: $this->username,
                password: $this->password
            );
        } catch(PDOException $pdoException) {
            die(ApiResponse::respondInternalServerError(message: $pdoException->getMessage()));
        }

        return $this->pdo;
    }

    public function closeConnection(): void {
        $this->pdo = null;
    }
}