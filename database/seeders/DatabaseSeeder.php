<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            CategorySeeder::class,
        ]);
        // \App\Models\Category::factory()->count(10)->create();
    }
}
