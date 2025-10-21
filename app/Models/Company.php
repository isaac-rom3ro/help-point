<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'company'; 

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'legal_name',
        'cnpj',
        'password'
    ];
}
