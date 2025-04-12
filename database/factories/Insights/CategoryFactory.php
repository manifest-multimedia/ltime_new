<?php

namespace Database\Factories\Insights;

use App\Models\Insights\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'created_by' => User::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $name = $this->faker->unique()->words(2, true);
            $category->translations()->create([
                'category_name' => ucwords($name),
                'slug' => Str::slug($name),
                'category_description' => $this->faker->sentence(),
                'lang_id' => 1,
            ]);
        });
    }
}