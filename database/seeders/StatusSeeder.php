<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Status::insert([
            ['status_title' => 'Pending'],
            ['status_title' => 'In Progress'],
            ['status_title' => 'Completed'],
            ['status_title' => 'Closed'],
            ['status_title' => 'Canceled'],
        ]);
    }
}
