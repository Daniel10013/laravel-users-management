<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creates an default admin account
        User::factory()->create([
            'name' => 'Admin Example',
            'email' => 'admin@example.com',
            'password' => Hash::make('DefaultAdmin123!!'),
            'role' => 'admin'
        ]);

        //creates an default user account
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'regular@example.com',
            'password' => Hash::make('DefaultUser123!!'),
        ]);
    }
}
