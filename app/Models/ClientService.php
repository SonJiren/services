<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
