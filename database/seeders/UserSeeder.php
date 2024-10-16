<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin ',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
            'role' =>'admin'
        ]);
    }
}
