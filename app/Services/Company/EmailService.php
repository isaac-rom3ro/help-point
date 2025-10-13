<?php

namespace App\Services\Company;

use App\Mail\Company\SendEmployeeCredentials;
use Illuminate\Support\Facades\Mail;

class EmailService {
    public static function sendCredentialsToEmployee(
        string $employeeEmail, 
        string $employeeName, 
        string $employeeCpf, 
        string $employeePassword
    )
    {
        Mail::to($employeeEmail)->send(new SendEmployeeCredentials(
            employeeName: $employeeName, 
            employeeCpf: $employeeCpf, 
            employeePassword: $employeePassword
        ));
    }
}