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
            'name' => 'required',
            'cpf' => 'required|regex:/^\d{3}.\d{3}.\d{3}-\d{2}$/',
            'email' => 'required|email',
            'whatsapp' => 'required',
            'role' => 'required',
            'assignedHours' => 'required|lt:221'
        ]);

        if ($validator->fails()) {
            $failedFiels = array_keys($validator->failed());
            return response()->noContent(400);
        }

        $name = request()->input('name');
        $cpf = preg_replace('/\D/', '', request()->input('cpf'));
        $email = request()->input('email');
        $whatsapp = preg_replace('/\D/', '', request()->input('whatsapp'));
        $password = substr(Str::uuid()->toString(), 0, 8);
        $role = request()->input('Role');
        $assignedHours = intval(request()->input('AssignedHours'));
        $companyId = session('uuid');

        DB::beginTransaction();

        $employee = Employee::firstOrCreate([
            'name' => $name,
            'cpf' => ,
            'email' => $email,
            'whatsapp' => $whatsapp,
            'password' => Hash::make($password),
            'role' => $role,
            'assigned_hours' => $assignedHours,
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
                employeeEmail: $email,
                employeeName: $name,
                employeeCpf: $request->input('employeeCpf'),
                employeePassword: $password
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
