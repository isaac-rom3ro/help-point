<?php
declare(strict_types = 1);

namespace App\Controller;

class IndexController {
    private string $path;

    public function __construct() {
        $this->path = "/";
    }

    public function getPath() {
        return $this->path;
    }

    public function getView() {
        require_once __DIR__ . "/../../pages/Index/index.php"; 
    }
}
