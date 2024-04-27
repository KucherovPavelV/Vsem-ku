<?php

namespace Database\Seeders;

use App\Models\Place;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Place::factory(10)->create();
        User::factory()->create([
            'login' => 'Admin',
            'email' => 'admin@exam.com',
            'password' => '123123123',
            'role' => 0
        ]);
    }
}
