<?php

namespace App\Http\Middleware;

use App\Helpers\Checkers;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeeSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        session(['employee_identifier' => '5']);

        if (!session()->has('employee_identifier')) {
            return redirect()->route('employee.login.create');
        }

        if (
            Checkers::employeeExists(session('employee_identifier')) === false
        ) 
        {
            return redirect()->route('employee.login.create');
        }

        return $next($request);
    }
}
