<?php

namespace App\Helpers;

use App\Models\Company;

class Checkers {
    public static function companyExists(
        ?string $cnpj = null,
        ?string $id = null
    )
    {
        if ($cnpj !== null) {
            return Company::where('cnpj', '=' , $cnpj)->exists();
        }

        if ($id !== null) {
            return Company::where('id', '=', $id)->exists();
        }

        return false;
    }
}