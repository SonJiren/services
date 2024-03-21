<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayAmount extends Model
{
    protected $fillable = ['amount', 'job_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}


//use HasFactory;