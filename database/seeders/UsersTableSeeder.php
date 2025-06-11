<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_name' => 'Evva',
                'user_full_name' => 'Evva Evinie',
                'user_email' => 'eva@example.com.my',
                'user_password' => Hash::make('eva123'), // <-- this hashes the password
                'user_role' => '1',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
