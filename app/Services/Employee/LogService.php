<?php

namespace App\Services\Employee;

use App\Models\TimeLog;
use Illuminate\Support\Collection;

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

    private static function getOptionsMessageAsObject($availableOption)
    {
        $type = '';
        $message = '';

        // The other option cant be absent 
        $options = [
            [
                'type' => '',
                'message' => ''
            ],
            [
                'type' => 'other',
                'message' => 'Outro Tipo de Registro'
            ]
        ];

        switch($availableOption) {
            case 'time-in':
                $type = $availableOption;
                $message = 'Chegada';
            break;
            case 'lunch-in':
                $type = $availableOption;
                $message = 'Pausa para Almoço';
            break;
            case 'lunch-out':
                $type = $availableOption;
                $message = 'De Volta do Almoço';
            break;
            case 'time-out':
                $type = $availableOption;
                $message = 'Encerrando o Expediente';
            break;
        }

        $options[0]['type'] = $type;
        $options[0]['message'] = $message;

        $collection = [];

        foreach($options as $index => $option) {
            $collection[$index] = (object) [
                'type' => $option['type'],
                'message' => $option['message'],
            ];
        }

        return $collection;
    }

    public static function isTherePendingLog(string $employeeId)
    {
        return TimeLog::where('status', '<>', 'OPEN')->groupBy('employee_id')->orderBy('created_at', 'desc')->limit(1)->exists();
    }

    public static function getAvailableLogs(string $employeeId)
    {
        // If there is no pending log, it should start a fresh log
        $isTherePending = self::isTherePendingLog(employeeId: $employeeId);
        if ($isTherePending === false) {
            return self::getOptionsMessageAsObject(availableOption: 'time-in');
        }
    }
}