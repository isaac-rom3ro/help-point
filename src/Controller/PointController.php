<?php
declare(strict_types = 1);

namespace App\Controller;


use App\Web\ApiResponse;


class PointController {
    private string $path;

    public function __construct() {
        $this->path = "/point";
    }

    public function getPath() {
        return $this->path;
    }

    public function getView() {
        session_start();

        // The idea here is use the token, not JWT yet, to get informations about the user 
        $id = TokenController::decode($_SESSION["token"] ?? null, "id");

        // Get informations about the user 
        // $this->getUserById($)

        require __DIR__ . '/../../pages/Point/point.php';
    }

    public function getUserById(string $id) 
    {
        if (empty($id)) {
            echo die(ApiResponse::respondBadRequest());
        }

        require_once __DIR__ . "../../../bootstrap.php";
        
        $query = "SELECT name FROM `user` WHERE id = :id";
        $stmt = $database->getConnection();
        $stmt->prepare($query);
        // $stmt->bindParam(":id", )
    }
}
