<?php

namespace App\Services\Company;

use App\Helpers\Checkers;
use App\Helpers\Format;
use App\Helpers\Getters;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginService {
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

    public static function store(Request $request): Exception | true
    {
        $cnpj = Format::removeNonDigits($request->input('cnpj'));   

        if (Checkers::companyExists(cnpj: $cnpj) === false) {
            throw new Exception(message: '', code: 404);
        }
            
        if (self::passwordsMatch(cnpj: $cnpj, formPassword: $request->input('password')) === false) {
            throw new Exception(message: '', code: 401);
        }

        return true;
    }

    public static function sessionStore(Request $request)
    {
        $cnpj = Format::removeNonDigits($request->input('cnpj'));
        $company = Getters::getCompanyByCnpj(cnpj: $cnpj);

        $request->session()->put('company_identifier', $company->id);

        // TO DO: Improve this part haha
        return true;
    }

    private static function passwordsMatch(
        string $cnpj,
        string $formPassword
    )
    {
        $company = Getters::getCompanyByCnpj($cnpj);

        return Hash::check($formPassword, $company->password);

    }
}