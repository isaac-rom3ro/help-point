<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'employee'; 

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'whatsapp',
        'password',
        'role',
        'assigned_hours',
        'company_id'
    ];
}
