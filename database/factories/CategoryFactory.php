<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_category_id' => null,
            'slug_name' => $this->faker->slug,
            'status' => 'active',
            'user_id' => 1,
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            foreach (['en', 'fr'] as $locale) {
                $category->translateOrNew($locale)->name = $this->faker->words(3, true);
                $category->translateOrNew($locale)->short_description = $this->faker->sentence;
                $category->translateOrNew($locale)->description = $this->faker->paragraph;
            }
            $category->save();
        });
    }
}
