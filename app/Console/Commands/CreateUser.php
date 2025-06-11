<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user for the CRMS system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_name = $this->ask('Enter username');
        $user_full_name = $this->ask('Enter full name');
        $user_email = $this->ask('Enter email');
        $password = $this->secret('Enter password');
        $role_id = $this->ask('Enter role ID (e.g., 1=Admin, 2=Service Engineer, 3=DKS Staff)');

        // Create user
        $user = new User();
        $user->user_name = $user_name;
        $user->user_full_name = $user_full_name; // ✅ add this
        $user->user_email = $user_email;
        $user->user_password = Hash::make($password);
        $user->user_role = $role_id;
        $user->save();

        $this->info("User '{$user_name}' created successfully!");
    }

}
