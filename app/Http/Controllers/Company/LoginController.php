<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('company.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "companyCNPJ" => 
                "required|string|size:18|regex:/^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$/", 
            "companyPassword" => 
                "required|string" 
        ]);

        if ($validator->fails()) {
            return response()->noContent(400);
        }

        $companyCNPJ = preg_replace('/\D/', '',$request->input('companyCNPJ'));
        $companyPassword = $request->input('companyPassword');

        $passwordFromBD = Company::where('cnpj', '=' , $companyCNPJ)->value('password');

        $isPasswordEqual = Hash::check($companyPassword, $passwordFromBD);

        if ($isPasswordEqual === false) {
            return response()->noContent(403);
        } 

        $id = Company::where('cnpj', '=', $companyCNPJ)->value('id');

        $request->session()->put('uuid', $id);

        return response()->noContent(200);
    }
}
