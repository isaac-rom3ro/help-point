<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeLog extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'time_log';

    public $incrementing = false;
    public $keyType = 'string';

    protected $casts = [
        'other' => 'array'
    ];

    protected $fillable = [
        'company_id',
        'employee_id',
        'time_in',
        'lunch-in',
        'lunch-out',
        'time-out',
        'other',
        'status'
    ];
}
