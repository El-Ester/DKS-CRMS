<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashPasswords extends Command
{
    protected $signature = 'users:hash-passwords';
    protected $description = 'Hash all existing plain text passwords in users table';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Check if password is already hashed
            if (!Hash::needsRehash($user->user_password)) {
                $this->info("Hashing password for user ID {$user->user_id}");
                $user->user_password = Hash::make($user->user_password);
                $user->save();
            } else {
                $this->info("Password already hashed for user ID {$user->user_id}");
            }
        }

        $this->info('All passwords have been hashed if needed.');

        return 0;
    }
}
