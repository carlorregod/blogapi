<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriaSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(TagSeeder::class);
        //default
        $this->call(UserSeeder::class);
    }
}
