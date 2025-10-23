<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Company\LoginService;

class LoginController extends Controller
{
    // View
    public function showLoginForm()
    {
        return view('company.login');
    }   

    // Login Logic
    public function login(Request $request)
    {
        if (LoginService::inputsAreValid(request: $request) === false) {
            return response()->noContent(400);
        } 

        $isValid = LoginService::store(request: $request);

        if ($isValid !== true) {
            $errorCode = $isValid->getCode();
            response()->noContent($errorCode);
        }

        $isSessioned = LoginService::sessionStore($request);

        if ($isSessioned === false) {
            return response()->noContent(500);
        }

        return response()->noContent(200);
    }
}
