<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()
            ->has(User::factory(2)
                ->has(User::factory(2)
                    ->has(User::factory(2), 'Referers'), 'Referers'), 'Referers')
            ->create([
                'name' => 'Test User',
                'email' => 'test@test.com',
            ]);
    }
}