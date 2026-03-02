<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an admin user in order to manage book submissions.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->ask('Provide a username for the admin user');

        $email = $this->ask('Provide an email address for the admin user');

        $password = $this->secret('Provide a password for the admin user');
        $passwordConfirmation = $this->secret('Confirm the password for the admin user');

        try {
            $validated = validator(
                [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'password_confirmation' => $passwordConfirmation
                ], [
                'username' => ['required', 'string', 'max:25'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8'],
            ])->validate();

            User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => \Hash::make($validated['password']),
                'role' => UserRole::Admin
            ]);
            $this->info('Admin user created.');
            return Command::SUCCESS;
        } catch (ValidationException $e) {
            foreach ($e->errors() as $messages) {
                foreach ($messages as $message) {
                    $this->error($message);
                }
            }

            return Command::FAILURE;
        }
    }
}
