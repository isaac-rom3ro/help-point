<?php
declare(strict_types = 1);

namespace App\Web;

class ApiResponse {
    public static function respondCreated(string $createdResource): string | false {
        http_response_code(201);
        return json_encode([
                'message' => "$createdResource", 
                'status' => 201]
            );
    }

    public static function respondBadRequest(): string | false {
        http_response_code(400);
        return json_encode([
                    'message' => 'Bad Request', 
                    'status' => 400
                ]);
    } 

    public static function respondMethodNotAllowed(): string | false {
        http_response_code(405);
        return json_encode([
                    'message' => 'Method Not Allowed',
                    'status' => 405
                ]);
    }

    public static function respondInternalServerError
    (
        string $message = 'Internal Server Error'
    ): string | false 
    {
        http_response_code(500);
        return json_encode([
                    'message' => "$message", 
                    'status' => 500
                ]);
    }
}