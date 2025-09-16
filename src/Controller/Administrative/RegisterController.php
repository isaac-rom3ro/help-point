<?php
declare(strict_types=1);

namespace App\Controller\Administrative;

use App\Connection\Database;
use App\Web\ApiResponse;
use PDO;
use PDOException;

class RegisterController {
    private string $path;

    public function __construct() {
        $this->path = '/adm/register';
    }

    public function getPath(): string 
    {
        return $this->path;
    } 

    public function getView() {
        require __DIR__ . '/../../../pages/Adm/Register/register.php';
    }

    public function registerNewCompany(Database $database)  {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if($data === null) {
            die(ApiResponse::respondBadRequest());
        }
        
        if(
            ! array_key_exists('name', $data) || 
            ! array_key_exists('password', $data) ||
            ! array_key_exists('cnpj', $data)) 
        {
            die(ApiResponse::respondBadRequest());
        }
        
        if(
            empty($data['name']) || 
            empty($data['cnpj']) ||
            empty($data['password'])
        ) {
            die(ApiResponse::respondBadRequest());
        }

        // TODO :: ValidateCNPJ 

        // Creates a random valid api key 
        $api_key = bin2hex(random_bytes(16));

        // Hash for password
        $hash = password_hash($data["password"], PASSWORD_DEFAULT);

        $response = $this->store(database: $database, name: $data["name"], cnpj: $data["cnpj"], hash: $hash, api_key: $api_key);

        if($response !== true) {
            $database->closeConnection();
            die(ApiResponse::respondInternalServerError($response));
        }

        die(ApiResponse::respondOK());
    }

    private function store(Database $database, string $name, string $cnpj, string $hash, string $api_key) {
        try {
            $query = 'INSERT INTO `company` (`name`, `cnpj`, `password`, `api_key`) VALUES (:name, :cnpj, :password, :api_key)';

            $stmt = $database->getConnection()->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
            $stmt->bindParam(':api_key', $api_key, PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $pdoException) {
            return $pdoException->getMessage();
        }

        return true;
    }
}