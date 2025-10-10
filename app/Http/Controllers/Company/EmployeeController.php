<?php

namespace App\Http\Controllers\Company;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employeeName' => 'required',
            'employeeCpf' => 'required|regex:/^\d{3}.\d{3}.\d{3}-\d{2}$/',
            'employeeEmail' => 'required|email',
            'employeeWhatsapp' => 'required',
            'employeeRole' => 'required',
            'employeeAssignedHours' => 'required|lt:221'
        ]);

        if ($validator->fails()) {
            $failedFiels = array_keys($validator->failed());
            return response()->noContent(400);
        }

        $employeeName = request()->input('employeeName');
        $employeeCpf = preg_replace('/\D/', '', request()->input('employeeCpf'));
        $employeeEmail = request()->input('employeeEmail');
        $employeeWhatsapp = preg_replace('/\D/', '', request()->input('employeeWhatsapp'));
        $employeePassword = substr(Str::uuid()->toString(), 0, 8);
        $employeeRole = request()->input('employeeRole');
        $employeeAssignedHours = intval(request()->input('employeeAssignedHours'));
        $companyId = session('uuid');

        Employee::create([
            'name' => $employeeName,
            'cpf' => $employeeCpf,
            'email' => $employeeEmail,
            'whatsapp' => $employeeWhatsapp,
            'password' => $employeePassword,
            'role' => $employeeRole,
            'assigned_hours' => $employeeAssignedHours,
            'company_id' => $companyId
        ]); 
        
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
