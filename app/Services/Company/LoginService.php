<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginService {
    public static function passwordsMatch(
        string $cnpj,
        string $formPassword
    )
    {
        $company = self::getCompanyByCnpj($cnpj);

        return Hash::check($formPassword, $company->password);

    }

    public static function companyExists(
        string $cnpj
    )
    {
        return Company::where('cnpj', '=' , $cnpj)->exists();
    }

    public static function inputsAreValid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "cnpj" => 
                "required|string|size:18|regex:/^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$/", 
            "password" => 
                "required|string" 
        ]);

        if ($validator->fails()) {
            return false;
        }

        return  true;
    }

    private static function getCompanyByCnpj($cnpj)
    {
        return Company::firstWhere('cnpj', '=' , $cnpj);
    } 

}