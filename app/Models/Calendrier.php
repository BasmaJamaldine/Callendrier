<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    //
    protected $fillable = [
        'start',
        'end',
        'user'
    ];
}
