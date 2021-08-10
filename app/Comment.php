<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //Relación: Un post tiene varios comentarios
    public function posts()
    {
        return $this->belongsTo('App\Post');
    }
}
