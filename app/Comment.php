<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Comment extends Model
{
    use ApiTrait;
    //Relación: Un post tiene varios comentarios
    public function posts()
    {
        return $this->belongsTo('App\Post');
    }
}
