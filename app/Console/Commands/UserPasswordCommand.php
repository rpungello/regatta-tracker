<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class UserPasswordCommand extends Command
{
    protected $signature = 'user:password {user}';

    protected $description = 'Resets the password for a given user';

    public function handle(): int
    {
        $userArgument = $this->argument('user');
        try {
            if (is_numeric($userArgument)) {
                $user = User::findOrFail($userArgument);
            } else {
                $user = User::whereEmail($userArgument)->firstOrFail();
            }
        } catch (ModelNotFoundException) {
            $this->error('User not found');

            return static::FAILURE;
        }

        $user->update([
            'password' => Hash::make(password('Enter new password')),
        ]);

        $this->info('Password updated successfully');

        return static::SUCCESS;
    }
}
