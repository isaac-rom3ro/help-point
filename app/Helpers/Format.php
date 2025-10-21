<?php

namespace App\Helpers;

class Format {
    public static function removeNonDigits(string $string)
    {
        return preg_replace('/\D/', '', $string);
    }
}