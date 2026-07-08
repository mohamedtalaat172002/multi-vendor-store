<?php

namespace Database\Seeders;

use App\Models\product;
use App\Models\stores;
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

        /*  User::factory()->create([
              'name' => 'Test User',
              'email' => 'test@example.com',
          ]);*/

        stores::factory()->count(20)->create();
        product::factory()->count(50)->create();
    }
}
