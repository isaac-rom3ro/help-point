<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\Getters;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TimeLog;
use App\Services\Employee\LogService;
use Illuminate\Support\Facades\Validator;

class TimeLogController extends Controller
{
    public function storeNewLog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logType' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^[a-z]+-(in|out)+$/', $value) && $value !== 'other') {
                        $fail("The $attribute must be in the format 'something-in' / 'something-out' or 'other'.");
                    }
                }
            ],
            'otherPurpose' => [
                'nullable',
                'string'
            ]
        ]);

        if ($validator->fails())
        {
            $fails = $validator->failed();
        }

        $type = $request->input('logType');
        $time = $request->input('time');

        $companyId = Getters::getCompanyIdByEmployeeId(session('employee_identifier'));
        $employeeId = session('employee_identifier');

        if (LogService::isTherePendingLog($employeeId) === false) {
            $row = LogService::filterFreshLog(
                companyId: $companyId,
                employeeId: $employeeId,
                type: $type, 
                time: $time
            );
            
            TimeLog::create(
                $row
            );

            return response()->noContent(201);
        } 

        $row = LogService::filterUpdateLog($type, $time);

        if ($row['type'] === 'time_out') {
            TimeLog::where('employee_id', '=', $employeeId)->where('status', '=', 'ACTIVE')->update([
                $row['type'] => $row['time'],
                'status' => 'CLOSED'
            ]);
        }

        TimeLog::where('employee_id', '=', $employeeId)->where('status', '=', 'ACTIVE')->update([
            $row['type'] => $row['time']
        ]);

        return response()->noContent(200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
