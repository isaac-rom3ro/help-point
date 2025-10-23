<?php

namespace App\Services\Company;

use Exception;
use App\Helpers\Format;
use App\Models\Employee;
use App\Helpers\Checkers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeFirstAccess;
use Illuminate\Support\Facades\Hash;
use App\Services\Company\EmailService;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mailer\Exception\TransportException;

class EmployeeService {
    public static function inputsAreValid(Request $request)
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
            return false;
        }
    }

    public static function store(Request $request, string $generatedPassword)
    {
        $companyId = session('company_identifier') ?? null;
        
        if ($companyId === null) {
            throw new Exception(message: '', code: 400);
        }

        if (Checkers::companyExists(id: $companyId) === false) {
            throw new Exception(message: '', code: 404);
        }

        $name = $request->input('name');
        $cpf = $request->input('cpf');
        $email = $request->input('email');
        $whatsapp = Format::removeNonDigits($request->input('whatsapp'));
        $role = $request->input('role');
        $assignedHours = intval($request->input('assignedHours'));

        DB::beginTransaction();

        try {
            $employee = Employee::firstOrCreate([
                'name' => $name,
                'cpf' => Format::removeNonDigits(string: $cpf),
                'email' => $email,
                'whatsapp' => $whatsapp,
                'password' => Hash::make($generatedPassword),
                'role' => $role,
                'assigned_hours' => $assignedHours,
                'company_id' => $companyId
            ]); 

            EmployeeFirstAccess::create([
                'company_id' => $companyId,
                'employee_id' => $employee->id
            ]);
        } catch(Exception $e) {
            DB::rollBack();
            throw new Exception(message: '', code: $e->getCode());
        }

        DB::commit();

        return true;
    }

    public static function getRandomPassword()
    {
        return substr(Str::uuid()->toString(), 0, 8);
    }

    public static function sendCredentials(Request $request, string $generatedPassword)
    {
        try {
            EmailService::sendCredentialsToEmployee(
                employeeEmail: $request->input('email'),
                employeeName: $request->input('name'),
                employeeCpf: $request->input('cpf'),
                employeePassword: $generatedPassword
            );
        } catch(TransportException $e) {
            throw new Exception(message: '', code: 503);
        }

        return true;
    }
}