<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default organization
        $organization = Organization::firstOrCreate(['name' => 'Default Company']);

        // Create the user and assign them to the organization
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'organization_id' => $organization->id,
                'password' => Hash::make('password'),
            ]
        );
    }
}