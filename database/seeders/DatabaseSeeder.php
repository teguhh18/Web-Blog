<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin Blog',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('pustik321'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user321'),
            'level' => 'user',
        ]);
    }
}
