<?php

namespace App\Services\Company;

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class EmailService {
    public static function sendCredentialsToEmployee(
        string $employeeEmail)
    {
            Mail::to($employeeEmail)->send(new WelcomeEmail());
    }
}