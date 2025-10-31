<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\Employee;

class Getters {
    public static function getCompanyByCnpj($cnpj)
    {
        return Company::firstWhere('cnpj', '=' , $cnpj);
    } 

    public static function getCompanyById(string $id)
    {
        return Company::findOrFail($id);
    }

    public static function getCompanyIdByEmployeeId(string $employeeId)
    {
        return Employee::find($employeeId)->company_id;
    }
}