<?php

namespace App\Services\Employee;

use App\Models\TimeLog;

class LogService {
    public static function getAvailableLogs(string $employeeId)
    {
        // If there is no pending log, it should start a fresh log
        $isTherePending = self::isTherePendingLog(employeeId: $employeeId);

        if ($isTherePending === false) {
            return self::getFreshOptionsAsObject();
        }


        return self::getAvailableOptionsAsObject(session('employee_identifier'));
    }

    public static function filterFreshLog(
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
                $log['time_in'] = $time; 
            break;

            case 'lunch-in':
                $log['lunch_in'] = $time; 
            break;

            case 'lunch-out':
                $log['lunch_out'] = $time; 
            break;

            case 'time-out':
                $log['time_out'] = $time; 
            break;

            default:
                // TO DO FORMAT IT 
                $log['other'] = $time; 
            break;
        }

        return $log;
    }

    public static function filterUpdateLog(string $type, string $time)
    {
        switch($type) {
            case 'time-in':
                $log = [
                    'type' => 'time_in',
                    'time' =>  $time 
                ];
            break;

            case 'lunch-in':
                $log = [
                    'type' => 'lunch_in',
                    'time' => $time 
                ];
            break;

            case 'lunch-out':
                $log = [
                    'type' => 'lunch_out',
                    'time' => $time 
                ];
            break;

            case 'time-out':
                $log = [
                    'type' => 'time_out',
                    'time' => $time
                ];
            break;

            default:
                // TO DO FORMAT IT 
                $log = [
                    'type' => 'other',
                    'time' => $time
                ];
            break;
        }

        return $log;
    }

    private static function getFreshOptionsAsObject()
    {
        // Fresh Start 
        $options = [
            [
                'type' => 'time-in',
                'message' => 'Chegada'
            ],
            [
                'type' => 'other',
                'message' => 'Outro Tipo de Registro'
            ]
        ];

        $collection = [];

        foreach($options as $index => $option) {
            $collection[$index] = (object) [
                'type' => $option['type'],
                'message' => $option['message'],
            ];
        }

        return $collection;
    }

    public  static function isTherePendingLog(string $employeeId)
    {
        return TimeLog::where('status', '=', 'ACTIVE')->groupBy('employee_id')->orderBy('created_at', 'desc')->limit(1)->exists();
    }

    private static function getOpenedLog(string $employeeId)
    {
        return TimeLog::where('employee_id', '=', $employeeId)->orderBy('created_at', 'desc')->first();
    }

    private static function checkNotFilledColumn(TimeLog $timeLog)
    {
        if ($timeLog->lunch_in === null) return [
            'type' => 'lunch-in',
            'message' => 'Pausa para Almoço'
        ];

        if ($timeLog->lunch_out === null) return [
            'type' => 'lunch-out',
            'message' => 'De Volta do Almoço'
        ];

        if ($timeLog->time_out === null) return [
            'type' => 'time-out',
            'message' => 'Encerrando o Expediente'
        ];
    }

    private static function getAvailableOptionsAsObject(string $employeeId) 
    {
        $availableOption = self::checkNotFilledColumn(self::getOpenedLog($employeeId));

        $options = [
            [
                'type' => $availableOption['type'],
                'message' => $availableOption['message']
            ],
            [
                'type' => 'other',
                'message' => 'Outro Tipo de Registro'
            ]
        ];

        foreach($options as $index => $option) {
            $collection[$index] = (object) [
                'type' => $option['type'],
                'message' => $option['message'],
            ];
        }

        return $collection;
    }
}