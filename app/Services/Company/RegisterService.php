<?php

namespace App\Services\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterService {
    public static function inputsAreValid(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            "legalName" => 
                "required|string", 
            "cnpj" => 
                "required|string|size:18|regex:/^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$/", 
            "password" => 
                "required|string" 
        ]);

        if ($validator->fails()) {
            return false;
        }
    }
}