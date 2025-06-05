<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoryTranslation;

class CategoryTranslationFactory extends Factory
{
    protected $model = CategoryTranslation::class;

    public function definition(): array
    {
        return [
            'locale' => 'en',
            'name' => $this->faker->words(3, true),
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}

