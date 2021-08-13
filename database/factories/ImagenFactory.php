<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Imagen;
use Faker\Generator as Faker;

$factory->define(Imagen::class, function (Faker $faker) {
    return [
        'url'=> 'post/' . $this->faker->image('storage/app/public/posts',640,480,null,false), //Si se deja en true deja ruta absoluta y el nombre de imagen falsa

    ];
});
