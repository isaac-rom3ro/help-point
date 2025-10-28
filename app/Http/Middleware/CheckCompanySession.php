<?php

namespace App\Http\Middleware;

use App\Helpers\Checkers;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanySession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if it's valid, maybe a query can help
        if (!session()->has('company_identifier')) {
            return redirect()->route('company.login.show');
        }

        if (
            Checkers::companyExists(cnpj: null, id: session('company_identifier')) === false
        ) {
            return redirect()->route('company.login.show');

        }

        return $next($request);
    }
}
