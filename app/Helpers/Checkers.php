<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\Employee;

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

    public static function employeeExists(
        ?string $cpf = null
    )
    {
        if ($cpf !== null) {
            return Employee::where('cpf', '=', $cpf)->exists();
        }

        return false;
    }
}