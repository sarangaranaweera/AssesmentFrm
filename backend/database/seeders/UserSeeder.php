<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@xyz.com',
            'password' => Hash::make('admin@321'),
        ]);
        DB::table('roles')->insert([
            'user_id' => 1,
            'role' => 'admin',
            
        ]);
    }
}
