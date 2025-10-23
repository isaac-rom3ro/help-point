<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Company\EmployeeService;
use Exception;

class EmployeeController extends Controller
{
    // Register new user
    public function store(Request $request)
    {
        if (
            EmployeeService::inputsAreValid($request) === false
        ) {
            return response()->noContent(400);
        }

        $password = EmployeeService::getRandomPassword();

        try {
            EmployeeService::store(request: $request, generatedPassword: $password);
        } catch (Exception $e) {
            return response()->noContent($e->getCode());
        }

        try {
            EmployeeService::sendCredentials(request: $request, generatedPassword: $password);
        } catch (Exception $e) {
             return response()->noContent($e->getCode());
        }

        // TODO
        // If the email was not sent, send to company registered email.
        // If not successful, delete the registered employee
        
        return response()->noContent(201);
    }
}