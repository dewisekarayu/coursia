<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\CoursiaDatabaseSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run legacy/default test user seeding.
        User::factory()->create([
         
        ]);

        // Seed the Coursia schema data.
        $this->call(CoursiaDatabaseSeeder::class);
    }
}
