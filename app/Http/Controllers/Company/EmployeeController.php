<?php

namespace App\Http\Controllers\Company;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\EmployeeFirstAccess;
use Illuminate\Support\Facades\Hash;
use App\Services\Company\EmailService;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mailer\Exception\TransportException;

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

        DB::beginTransaction();

        $employee = Employee::firstOrCreate([
            'name' => $employeeName,
            'cpf' => $employeeCpf,
            'email' => $employeeEmail,
            'whatsapp' => $employeeWhatsapp,
            'password' => Hash::make($employeePassword),
            'role' => $employeeRole,
            'assigned_hours' => $employeeAssignedHours,
            'company_id' => $companyId
        ]); 

        if ($employee->wasRecentlyCreated == false) {
            DB::rollBack();
            return response()->noContent(500);
        }
    
        EmployeeFirstAccess::create([
            'company_id' => $companyId,
            'employee_id' => $employee->id
        ]);

        try {
            EmailService::sendCredentialsToEmployee(
                employeeEmail: $employeeEmail,
                employeeName: $employeeName,
                employeeCpf: $request->input('employeeCpf'),
                employeePassword: $employeePassword
            );
        } catch(TransportException $e) {
            DB::rollBack();
            return response()->noContent(500);
        }

        DB::commit();
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
