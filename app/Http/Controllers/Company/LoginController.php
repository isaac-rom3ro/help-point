<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Services\Company\LoginService;
use App\Helpers\CNPJ;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('company.login');
    }   

    public function login(Request $request)
    {
        if (LoginService::inputsAreValid(request: $request) === false) {
            return response()->noContent(400);
        } 

        $cnpj = CNPJ::removeNonDigits($request->input('cnpj'));

        if (LoginService::companyExists(cnpj: $cnpj) === false) {
            return response()->noContent(404);
        }
            
        if (LoginService::passwordsMatch(cnpj: $cnpj, formPassword: $request->input('password')) === false) {
            return response()->noContent(401);
        }

        $id = Company::where('cnpj', '=', $cnpj)->value('id');

        $request->session()->put('employee_id', $id);

        return response()->noContent(200);
    }
}
