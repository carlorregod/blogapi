<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Imagen;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Mi user
        User::create([
            'name'=>'Carlos',
            'email'=>'carlos.orrego@diaz.com',
            // 'password'=>bcrypt('2004330')
            'password'=>'2004330'
        ]);
        factory(Imagen::class,1)->create([
            'imageable_id'=>1,
            'imageable_type'=>User::class
        ]);

        //User falso
        factory(User::class,5)->create()->each(function (User $user) {
            factory(Imagen::class,1)->create([
                'imageable_id'=>$user->id,
                'imageable_type'=>User::class
            ]);
        });

    }
}
