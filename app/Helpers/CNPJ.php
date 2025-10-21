<?php

namespace App\Helpers;

class CNPJ {
    public static function removeNonDigits($cnpj)
    {
        return preg_replace('/\D/', '', $cnpj);
    }
}