<?php

namespace App\Services\Employee;

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
}