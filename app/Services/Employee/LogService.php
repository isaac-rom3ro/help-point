<?php

namespace App\Services\Employee;

use App\Models\Employee;
use Illuminate\Support\Collection;

use function PHPUnit\Framework\isEmpty;

class LogService {
    public static function filterLog(
        string $companyId,
        string $employeeId,
        string $type, 
        string $time
    )
    {
        $log = [
                'company_id' => $companyId,
                'employee_id' => $employeeId
        ];

        switch($type) {
            case 'time-in':
                $log['time-in'] = $time; 
            break;

            case 'lunch-in':
                $log['lunch-in'] = $time; 
            break;

            case 'lunch-out':
                $log['lunch-out'] = $time; 
            break;

            case 'time-out':
                $log['time-out'] = $time; 
            break;

            default:
                // TO DO FORMAT IT 
                $log['other'] = $time; 
            break;
        }

        return $log;
    }

    public static function isTherePendingLog(string $employeeId)
    {
        Employee::where('status', '<>', 'DONE')->groupBy($employeeId)->orderBy('created_at', 'desc')->limit(1)->exists();
    }

    public static function getAvailableLogs(string $employeeId)
    {

        $logs = Employee::where('employee_id', '=', $employeeId)->where('status', '<>', 'DONE')->first();

        if (! isEmpty($logs->time_in)) {
            return new Collection(['time-in', 'other']);
        }
    }
}