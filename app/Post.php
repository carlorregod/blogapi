<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    //Relaciones de la clase: un post tiene una categoria
    public function categorias()
    {
        return $this->belongsTo('App\Categoria');
    }
    //Relación: Un post le pertenece a un usuario
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    //Relación: Un post tiene cero, una o varias etiquetas
    public function tags()
    {
        return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id');
    }
    //Relación: Un post tiene varios comentarios
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    

}
