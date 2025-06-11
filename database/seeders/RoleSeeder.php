<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Role::insert([
            ['role_title' => 'Admin', 'created_date' => now()],
            ['role_title' => 'Staff', 'created_date' => now()],
            ['role_title' => 'Service Engineer', 'created_date' => now()],
        ]);
    }


}
