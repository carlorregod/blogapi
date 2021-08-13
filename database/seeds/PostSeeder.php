<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Imagen;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class,100)->create()->each(function(Post $post) {
            factory(Imagen::class,4)->create([
                'imageable_id'=>$post->id,
                'imageable_type'=>Post::class
            ]);
            $post->tags()->attach([
                rand(1,4),
                rand(5,8)
            ]);
        });

    }
}
