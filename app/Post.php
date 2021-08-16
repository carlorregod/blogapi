<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ApiTrait;

class Post extends Model
{
    use ApiTrait;

    const BORRADOR = 1;
    const PUBLICADO = 1;

    protected $fillable = ['name','slug','extract','body','categoria_id','user_id'];

    //Relaciones de la clase: un post tiene una categoria
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }
    //Relación: Un post le pertenece a un usuario
    public function user()
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

    //Relación imagen polimórfica uno a muchos
    public function images()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }



}
