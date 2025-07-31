<?php

namespace App\Web;

class Routes {
    private array $routes;
    
    public function addNewRoute(string $path, ?callable $callback): void {
        // Will save our routes and their functions
        // $routes = [ path => $callback ]
        $this->routes[$path] = $callback;
    }

    public function run(): void {
        $uri = $_SERVER['REQUEST_URI'];

        // The purpose is to match the requested URI to the route already saved
        foreach($this->routes as $path => $callback) {
            if($uri !== $path) continue;

            // Run if it matches with the url requested
            // () in the final will executed the function
            $callback();
        }
    }
}


