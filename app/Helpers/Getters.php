<?php

namespace App\Helpers;

use App\Models\Company;

class Getters {
    public static function getCompanyByCnpj($cnpj)
    {
        return Company::firstWhere('cnpj', '=' , $cnpj);
    } 

    public static function getCompanyById(string $id)
    {
        return Company::findOrFail($id);
    }
}