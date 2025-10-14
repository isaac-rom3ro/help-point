<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeFirstAccess extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'employee_first_access';

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'status',
        'company_id',
        'employee_id'
    ];
}
