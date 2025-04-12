<?php

namespace Database\Seeders;

use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class InsightsSeeder extends Seeder
{
    public function run()
    {
        // Create some categories first
        $categories = Category::factory()
            ->count(5)
            ->create();

        // Create some published posts with categories
        Post::factory()
            ->count(20)
            ->published()
            ->create()
            ->each(function ($post) use ($categories) {
                // Attach 1-3 random categories to each post
                $post->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );

                // Create 0-5 approved comments for each post
                Comment::factory()
                    ->count(rand(0, 5))
                    ->approved()
                    ->create(['post_id' => $post->id]);
            });

        // Create some draft posts
        Post::factory()
            ->count(5)
            ->draft()
            ->create()
            ->each(function ($post) use ($categories) {
                $post->categories()->attach(
                    $categories->random(rand(1, 2))->pluck('id')->toArray()
                );
            });

        // Create some pending comments
        Comment::factory()
            ->count(10)
            ->pending()
            ->create(['post_id' => Post::inRandomOrder()->first()->id]);
    }
}