<?php

namespace App\Http\Controllers\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeeFirstAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "employeeCpf" => 
                "required|string|size:14|regex:/^\d{3}.\d{3}.\d{3}-\d{2}$/", 
            "employeePassword" => 
                "required|string" 
        ]);

        if ($validator->fails()) {
            return response()->noContent(400);
        }

        $employeeCpf = preg_replace('/\D/', '',$request->input('employeeCpf'));
        $employeePassword = $request->input('employeePassword');

        $passwordFromBD = Employee::where('cpf', '=' , $employeeCpf)->value('password');

        $isPasswordEqual = Hash::check($employeePassword, $passwordFromBD);

        if ($isPasswordEqual === false) {
            return response()->noContent(403);
        } 

        $employeeId = Employee::where('cpf', '=', $employeeCpf)->value('id');

        // Needs to change the password
        if (
            EmployeeFirstAccess::where('employee_id', '=', $employeeId)->where('status', '=', 'PENDING')->exists() === true
        ) {
            return response()->noContent(202);
        }

        $id = Employee::where('cpf', '=', $employeeCpf)->value('id');

        $request->session()->put('uuid', $id);

        return response()->noContent(200);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "employeeCpf" => 
                "required|string|size:14|regex:/^\d{3}.\d{3}.\d{3}-\d{2}$/", 
            "currentPassword" => 
                "required|string", 
            "newPassword" => 
                "required|string" 
        ]);

        if ($validator->fails()) {
            return response()->noContent(400);
        }

        $employeeCpf = preg_replace('/\D/', '',$request->input('employeeCpf'));
        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('newPassword');


        $passwordFromBD = Employee::where('cpf', '=', $employeeCpf)->value('password');

        $isPasswordEqual = Hash::check($currentPassword, $passwordFromBD);

        if ($isPasswordEqual === false) {
            return response()->noContent(403);
        } 

        Employee::where('cpf', '=', $employeeCpf)->update([
            'password' => Hash::make($newPassword)
        ]);

        $employeeId = Employee::where('cpf', '=', $employeeCpf)->value('id');

        EmployeeFirstAccess::where('employee_id', '=', $employeeId)->update([
            'status' => 'DONE'
        ]);

        return response()->noContent(201);
    }
}
