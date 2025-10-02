<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            "companyName" => 
                "required|string", 
            "companyCNPJ" => 
                "required|string|size:18|regex:/^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$/", 
            "companyPassword" => 
                "required|string" 
        ]);

        if ($validator->fails()) {
            return response()->noContent(400);
        }

        $companyName = $request->input('companyName');
        $companyCNPJ = preg_replace('/\D/', '',$request->input('companyCNPJ'));
        $companyPassword = Hash::make($request->input('companyPassword'));

        Company::create([
            'name' => $companyName, 
            'cnpj' => $companyCNPJ, 
            'password' => $companyPassword
        ]);

        return response()->noContent(201);
    }
}
