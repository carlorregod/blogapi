<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('posts'); //lo crea en storage/app/
        Storage::makeDirectory('posts'); //lo crea en storage/app/
        //default
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        // $this->call(ImagenSeeder::class);
    }
}
