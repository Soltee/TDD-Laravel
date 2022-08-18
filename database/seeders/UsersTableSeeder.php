<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name'   => 'Lary',
            'email'  => 'lary@gmail.com',
            'password' => bcrypt('12345678'),
            // 'password_confirmation' => '12345678'
        ]);
    }
}
