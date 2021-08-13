<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Comment::class, function (Faker $faker) {
    $name = $this->faker->unique()->word(20);
    return [
        'name'=>$name,
        'comment'=>$this->faker->text(300),
        'slug'=>Str::slug($name),
        'post_id'=>'App\Post'::all()->random()->id
    ];
});
