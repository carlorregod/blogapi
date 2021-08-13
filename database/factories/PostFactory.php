<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $name = $this->faker->unique()->word(20);
    return [
        'name'=>$name,
        'slug'=>Str::slug($name),
        'extract'=>$this->faker->text(240),
        'body'=>$this->faker->text(1000),
        'status'=>$this->faker->randomElement(['App\Post'::BORRADOR,'App\Post'::PUBLICADO]),
        'categoria_id'=>'App\Categoria'::all()->random()->id,
        'user_id'=>'App\User'::all()->random()->id,
    ];
});
