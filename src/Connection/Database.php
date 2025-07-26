<?php

namespace App\Connection;

use PDO;

class Database {

    private string $connection;

    public function __construct(
                            private string $host, 
                            private string $databaseName, 
                            private string $charset, 
                            private string $username, 
                            private string $password
    ) {
    }

    public function getConnection(): PDO {
        return new PDO(
            dsn: "mysql:host=$this->host;dbname=$this->databaseName;charset=$this->charset;",
            username: $this->username,
            password: $this->password
        );
    }
}