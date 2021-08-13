<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    //Acá debe coincidir el nombre de la variable polimórfica 'imageable' en este caso
    public function imageable()
    {
        return $this->morphTo();
    }
}
