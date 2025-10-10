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

    public function getFormattedWhatsappAttribute()
    {
        $number = $this->whatsapp;

        if (!$number) return null; 

        return '( ' . substr($number, 0, 2) . ' ) ' 
             . substr($number, 2, 1) . ' ' 
             . substr($number, 3, 4) . '-' 
             . substr($number, 7);
    }
}
