<?php

namespace App\Services\Company;

use App\Helpers\Format;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterService {
    public static function inputsAreValid(Request $request): bool
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

        return true;
    }

    public static function store(Request $request): bool
    {
        DB::beginTransaction();

        try {
            Company::create([
                'legal_name' => $request->input('legalName'), 
                'cnpj' => Format::removeNonDigits($request->input('cnpj')), 
                'password' => Hash::make($request->input('password'))
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }

        DB::commit();

        return true;
    }
}