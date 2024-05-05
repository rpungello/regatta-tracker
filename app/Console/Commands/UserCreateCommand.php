<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class UserCreateCommand extends Command
{
    protected $signature = 'user:create';

    protected $description = 'Creates a new user';

    public function handle(): int
    {
        User::create([
            'name' => text('Enter name'),
            'email' => text('Enter email'),
            'password' => Hash::make(password('Enter password')),
        ]);

        return static::SUCCESS;
    }
}
