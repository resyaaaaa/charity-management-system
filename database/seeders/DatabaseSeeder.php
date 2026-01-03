<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'role'=>'admin',
            'email' => 'admin@gmail.com',
            'password'=> bcrypt('1234567'),
        ]);

        User::factory()->create([
        'name' => 'staff',
        'role' => 'staff',
        'email' => 'staff@gmail.com',
        'password'=> bcrypt('1234567'),
    ]);
}
}
