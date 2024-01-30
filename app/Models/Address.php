<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';

    protected $fillable = [
        'name',
        'department',
        'city',
        'neighborhood',
        'street_type',
        'street',
        'number',
        'phone_number',
        'user_id',
    ];
}
