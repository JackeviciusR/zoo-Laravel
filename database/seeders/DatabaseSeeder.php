<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Hash; // idetas
use DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // https://laravel.com/docs/8.x/seeding
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);

        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'password' => Hash::make('123'), // vrsuje idedam use Hash, use DB
        ]);

        DB::table('authors')->insert([
            'name' => 'Jonas',
            'surname' => 'Basas',
        ]);



    }
}
