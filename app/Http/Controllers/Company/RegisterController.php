<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Company\RegisterService;

class RegisterController extends Controller
{
    // View
    public function create()
    {
        return view('company.register');
    }

    // Store new Company
    public function store(Request $request)
    {
        if (RegisterService::inputsAreValid($request) === false)
        {
            return response()->noContent(400);
        }

        if (RegisterService::store(request: $request) === false) {
            return response()->noContent(500);
        }

        return response()->noContent(201);
    }
}
