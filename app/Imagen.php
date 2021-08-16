<?php

namespace App;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use ApiTrait;
    //Acá debe coincidir el nombre de la variable polimórfica 'imageable' en este caso
    public function imageable()
    {
        return $this->morphTo();
    }
}
