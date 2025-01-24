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
                'username' => 'hrd1234',
                'email' => 'hrd@example.com',
                'password' => Hash::make('hrd1234'),
                'phone_number' => '1234567890',
                'role' => 'hrd',
            ],
            [
                'username' => 'jppstm1234',
                'email' => 'jppstm@example.com',
                'password' => Hash::make('jppstm1234'),
                'phone_number' => '1234567890',
                'role' => 'jppstm',
            ],

            [
                'username' => 'faculty1234',
                'email' => 'faculty@example.com',
                'password' => Hash::make('faculty1234'),
                'phone_number' => '1234567890',
                'role' => 'faculty/centre',
            ],
            [
                'username' => 'department1234',
                'email' => 'department@example.com',
                'password' => Hash::make('department1234'),
                'phone_number' => '1234567890',
                'role' => 'department/unit',
            ],
            [
                'username' => 'boardmembers1234',
                'email' => 'boardmembers@example.com',
                'password' => Hash::make('boardmembers1234'),
                'phone_number' => '1234567890',
                'role' => 'board members',
            ],
            [
                'username' => 'ar1234',
                'email' => 'ar@example.com',
                'password' => Hash::make('ar1234'),
                'phone_number' => '1234567890',
                'role' => 'assistant registrar',
            ],
            [
                'username' => 'Layla',
                'email' => 'layla@example.com',
                'password' => Hash::make('layla1234'),
                'phone_number' => '0134325671',
                'role' => 'jppstm',
            ],

            [
                'username' => 'Jhonson Lim',
                'email' => 'jhonson@example.com',
                'password' => Hash::make('jhonson1234'),
                'phone_number' => '0134325671',
                'role' => 'hrd',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
