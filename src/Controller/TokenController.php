<?php

declare(strict_types = 1);

namespace App\Controller;

class TokenController {
    public static function encode(array $keys, array $values): string | false 
    {
        if (empty($keys) || empty($values)) {
            return false;
        }

        $array = [];
        
        foreach($keys as $index => $key) {
            $array[$key] = $values[$index];
        }

        $token = base64_encode(json_encode(
            $array
        ));

        return $token;
    }

    public static function decode(string $token, string $key) 
    {
        if (empty($token)) {
            return false;
        }

        return json_decode(base64_decode($token), true)[$key];
    }
}