<?php

namespace Database\Factories\Insights;

use App\Models\Insights\Comment;
use App\Models\Insights\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'post_id' => Post::factory(),
            'user_id' => $this->faker->boolean(30) ? User::factory() : null,
            'ip' => $this->faker->ipv4,
            'author_name' => function (array $attributes) {
                return $attributes['user_id'] 
                    ? User::find($attributes['user_id'])->name 
                    : $this->faker->name;
            },
            'author_email' => function (array $attributes) {
                return $attributes['user_id']
                    ? User::find($attributes['user_id'])->email
                    : $this->faker->safeEmail;
            },
            'author_website' => $this->faker->boolean(20) ? $this->faker->url : null,
            'comment' => $this->faker->paragraph(),
            'approved' => $this->faker->boolean(70),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return $attributes['created_at'];
            },
        ];
    }

    public function approved()
    {
        return $this->state(function (array $attributes) {
            return [
                'approved' => true,
            ];
        });
    }

    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'approved' => false,
            ];
        });
    }

    public function fromUser(User $user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user->id,
                'author_name' => $user->name,
                'author_email' => $user->email,
            ];
        });
    }
}