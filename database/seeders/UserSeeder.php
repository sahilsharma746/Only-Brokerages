<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Admin',
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'account_type' => 1,
                'username' => 'admin',
                'country' => 'Bangladesh',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin@gmail.com'),
                'role' => 'admin',
                'referal_id' => 1,
                'created_at' => Carbon::now()
            ]
        ]);

    }
}
