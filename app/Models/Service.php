<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'country',
        'city',
        'home',
        'date',
        'service',
        'pay',
    ];


}
