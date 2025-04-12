<?php

namespace Tests\Feature\Insights;

use Tests\TestCase;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicInsightsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_insights_index()
    {
        $posts = Post::factory()->count(5)->published()->create();

        $response = $this->get(route('insights.index'));

        $response->assertStatus(200);
        $response->assertViewIs('insights.index');
        $response->assertViewHas('posts');
        $posts->each(function ($post) use ($response) {
            $response->assertSee($post->translations->first()->title);
        });
    }

    /** @test */
    public function it_only_shows_published_posts_on_index()
    {
        $publishedPost = Post::factory()->published()->create();
        $draftPost = Post::factory()->draft()->create();

        $response = $this->get(route('insights.index'));

        $response->assertSee($publishedPost->translations->first()->title);
        $response->assertDontSee($draftPost->translations->first()->title);
    }

    /** @test */
    public function it_can_display_single_post()
    {
        $post = Post::factory()->published()->create();

        $response = $this->get(route('insights.show', $post->translations->first()->slug));

        $response->assertStatus(200);
        $response->assertViewIs('insights.show');
        $response->assertSee($post->translations->first()->title);
        $response->assertSee($post->translations->first()->post_body);
    }

    /** @test */
    public function it_cannot_display_draft_posts()
    {
        $post = Post::factory()->draft()->create();

        $response = $this->get(route('insights.show', $post->translations->first()->slug));

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_display_posts_by_category()
    {
        $category = Category::factory()->create();
        $postsInCategory = Post::factory()->count(3)->published()->create()
            ->each(function ($post) use ($category) {
                $post->categories()->attach($category);
            });
        $otherPost = Post::factory()->published()->create();

        $response = $this->get(route('insights.category', $category->translations->first()->slug));

        $response->assertStatus(200);
        $response->assertViewIs('insights.category');
        $postsInCategory->each(function ($post) use ($response) {
            $response->assertSee($post->translations->first()->title);
        });
        $response->assertDontSee($otherPost->translations->first()->title);
    }

    /** @test */
    public function guests_can_submit_comments()
    {
        $post = Post::factory()->published()->create();

        $response = $this->post(route('insights.comments.store', $post->translations->first()->slug), [
            'author_name' => 'John Doe',
            'author_email' => 'john@example.com',
            'comment' => 'Great article!',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_comments', [
            'post_id' => $post->id,
            'author_name' => 'John Doe',
            'author_email' => 'john@example.com',
            'comment' => 'Great article!',
            'approved' => false,
        ]);
    }

    /** @test */
    public function authenticated_users_can_submit_comments()
    {
        $user = User::factory()->create();
        $post = Post::factory()->published()->create();

        $response = $this->actingAs($user)->post(
            route('insights.comments.store', $post->translations->first()->slug),
            ['comment' => 'Great article!']
        );

        $response->assertRedirect();
        $this->assertDatabaseHas('insights_comments', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'author_name' => $user->name,
            'author_email' => $user->email,
            'comment' => 'Great article!',
        ]);
    }

    /** @test */
    public function it_can_search_posts()
    {
        $post1 = Post::factory()->published()->create();
        $post1->translations()->first()->update(['title' => 'Laravel Development Tips']);
        
        $post2 = Post::factory()->published()->create();
        $post2->translations()->first()->update(['title' => 'Vue.js Best Practices']);

        $response = $this->get(route('insights.search', ['q' => 'Laravel']));

        $response->assertStatus(200);
        $response->assertSee('Laravel Development Tips');
        $response->assertDontSee('Vue.js Best Practices');
    }
}