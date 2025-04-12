<?php

namespace Database\Factories\Insights;

use App\Models\Insights\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'posted_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'is_published' => $this->faker->boolean(80),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $post->translations()->create([
                'title' => $this->faker->sentence(),
                'subtitle' => $this->faker->sentence(),
                'short_description' => $this->faker->paragraph(),
                'post_body' => $this->faker->paragraphs(3, true),
                'slug' => Str::slug($this->faker->sentence()),
                'meta_desc' => $this->faker->sentence(),
                'seo_title' => $this->faker->words(5, true),
                'lang_id' => 1,
            ]);
        });
    }

    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => true,
                'posted_at' => now()->subDays(rand(1, 30)),
            ];
        });
    }

    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => false,
                'posted_at' => null,
            ];
        });
    }
}