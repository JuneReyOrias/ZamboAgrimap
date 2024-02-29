<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //admin
            // [
            //     'name'=>'admin',
            //     'email'=>'admin@gmail.com',
            //     'agri_district'=>'Manicahan',
            //     'password'=> Hash::make('222'),
            //     'role'=> 'admin',

            // ],
            // //agent
            // [
            //     'name'=>'agent',
            //     'email'=>'agent@gmail.com',
            //    'agri_district'=>'Curuan',
            //     'password'=> Hash::make('222'),
            //     'role'=> 'agent',

            // ],
            // //user
            // [
            //     'name'=>'user',
            //     'email'=>'user@gmail.com',
            //    'agri_district'=>'Culianan',
            //     'password'=> Hash::make('222'),
            //     'role'=> 'user',
            // ]
        ]);
    }
}
