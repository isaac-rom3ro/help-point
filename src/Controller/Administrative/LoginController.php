<?php
declare(strict_types = 1);

namespace App\Controller\Administrative;

use App\Connection\Database;
use App\Web\ApiResponse;
use App\Controller\TokenController;

use PDO;
use PDOException;

class LoginController {
    private string $path;

    public function __construct() {
        $this->path = '/adm/login';
    }

    public function getPath(): string {
        return $this->path;
    }

    public function getView() {
        require __DIR__ . '/../../../pages/Adm/Login/login.php';
    }

    public function signIn(Database $database) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if($data === null) {
            die(ApiResponse::respondBadRequest());
        }

        if(
            ! array_key_exists('cnpj', $data) || 
            ! array_key_exists('password', $data)
        ) {
            die(ApiResponse::respondBadRequest());
        }
        
        if(empty($data['cnpj']) || empty($data['password'])) {
            die(ApiResponse::respondBadRequest());
        }
        
        $response = $this->companyExists(database: $database, cnpj: $data['cnpj']);

        if($response === false) {
            die(ApiResponse::respondNotFound());
        }

        $hashFromBD = $response['password'];
        $passwordFromInput = $data['password'];

        if (
            password_verify($passwordFromInput, $hashFromBD) === false
        ) {
            die(ApiResponse::respondForbidden());
        }

        $company = $this->getCompanyByCNPJ(database: $database, cnpj: $data['cnpj']);

        $token = TokenController::encode(
            ["id", "api_key"],
            [$company["id"], $company["api_key"]]
        );

        session_start();
        $_SESSION["token"] = $token;

        die(ApiResponse::respondOK());
    }

    private function companyExists(Database $database, string $cnpj)
    {
        try {
            $query = 'SELECT `password` FROM company  WHERE `cnpj` = :cnpj';

            $stmt = $database->getConnection()->prepare($query);

            $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);

            $stmt->execute();
        } catch(PDOException $pdoException) {
            return $pdoException->getMessage();
        }

        return $stmt->fetch(mode: PDO::FETCH_ASSOC);
    }

    private function getCompanyByCNPJ(Database $database, string $cnpj)
    {
        try {
            $query = 'SELECT `id`, `api_key` FROM company  WHERE `cnpj` = :cnpj';

            $stmt = $database->getConnection()->prepare($query);

            $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);

            $stmt->execute();
        } catch(PDOException $pdoException) {
            return $pdoException->getMessage();
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}