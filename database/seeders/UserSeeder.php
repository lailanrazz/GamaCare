<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'phone' => '081234567890',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'User',
                'phone' => '081234567891',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];
        // Insert the users into the database
        DB::table('users')->insert($users);
    }
}
