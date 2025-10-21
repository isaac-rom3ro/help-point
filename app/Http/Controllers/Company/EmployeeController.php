<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Company\EmployeeService;

class EmployeeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (
            EmployeeService::inputsAreValid($request) === false
        ) {
            return response()->noContent(400);
        }

        $password = EmployeeService::getRandomPassword();
        EmployeeService::store(request: $request, generatedPassword: $password);
        EmployeeService::sendCredentials(request: $request, generatedPassword: $password);
        
        return response()->noContent(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
