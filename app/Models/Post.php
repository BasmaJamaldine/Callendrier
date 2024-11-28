<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'text',
        'image_post',
        'user_id'
    ];
    public function user () {

        return $this->belongsTo(User::class);
    }
}