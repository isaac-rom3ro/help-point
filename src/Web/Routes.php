<?php
declare(strict_types = 1);
namespace App\Web;

class Routes {
    private array $routes = [];

    public function addNewRoute(string $path, string $method, callable $callback): void {
        $method = strtoupper($method);
        $this->routes[$path][$method] = $callback;
    }

    public function run(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = strtok($_SERVER['REQUEST_URI'], '?'); // Remove query string

        if(! array_key_exists($uri, $this->routes)) {
            die(ApiResponse::respondNotFound());
        }
        
        if(! isset($this->routes[$uri][$method])) {
            die(ApiResponse::respondMethodNotAllowed());
        }

        $this->routes[$uri][$method](); // Call the callback
        return;
    }
}