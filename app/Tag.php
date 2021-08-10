<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //Relación: Un post tiene cero, una o varias etiquetas
    public function posts()
    {
        return $this->belongsToMany('App\Post','post_tag','tag_id','post_id');
    }
}
