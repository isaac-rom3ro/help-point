<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeFirstAccess extends Model
{
    //

    protected $table = 'employee_first_access';

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'status',
        'company_id',
        'employee_id'
    ];
}
