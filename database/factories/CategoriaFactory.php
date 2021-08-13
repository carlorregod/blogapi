<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categoria;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Categoria::class, function (Faker $faker) {
    $name = $this->faker->unique()->word(20);
    return [
        'name'=>$name,
        'slug'=>Str::slug($name)
    ];
});
