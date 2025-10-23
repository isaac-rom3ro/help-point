<?php

namespace App\Http\Controllers\Company;

use App\Helpers\Format;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Company\RegisterService;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('company.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (RegisterService::inputsAreValid($request) === false)
        {
            return response()->noContent(400);
        }

        $legalName = $request->input('legalName');
        $cnpj = Format::removeNonDigits($request->input('cnpj'));
        $password = Hash::make($request->input('password'));

        Company::create([
            'legal_name' => $legalName, 
            'cnpj' => $cnpj, 
            'password' => $password
        ]);

        return response()->noContent(201);
    }
}
