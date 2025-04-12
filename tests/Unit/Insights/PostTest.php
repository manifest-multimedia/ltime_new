<?php

namespace Tests\Unit\Insights;

use Tests\TestCase;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $post->user);
        $this->assertEquals($user->id, $post->user->id);
    }

    /** @test */
    public function it_can_have_translations()
    {
        $post = Post::factory()->create();

        $this->assertNotEmpty($post->translations);
        $this->assertEquals(1, $post->translations->count());
    }

    /** @test */
    public function it_can_belong_to_multiple_categories()
    {
        $post = Post::factory()->create();
        $categories = Category::factory()->count(3)->create();

        $post->categories()->attach($categories->pluck('id'));

        $this->assertEquals(3, $post->categories->count());
        $this->assertInstanceOf(Category::class, $post->categories->first());
    }

    /** @test */
    public function it_can_be_published()
    {
        $post = Post::factory()->create(['is_published' => false]);
        
        $post->publish();

        $this->assertTrue($post->fresh()->is_published);
        $this->assertNotNull($post->fresh()->posted_at);
    }

    /** @test */
    public function it_can_be_unpublished()
    {
        $post = Post::factory()->create(['is_published' => true]);
        
        $post->unpublish();

        $this->assertFalse($post->fresh()->is_published);
    }

    /** @test */
    public function it_can_get_published_posts()
    {
        Post::factory()->count(3)->create(['is_published' => true]);
        Post::factory()->count(2)->create(['is_published' => false]);

        $publishedPosts = Post::published()->get();

        $this->assertEquals(3, $publishedPosts->count());
    }

    /** @test */
    public function it_can_get_draft_posts()
    {
        Post::factory()->count(3)->create(['is_published' => true]);
        Post::factory()->count(2)->create(['is_published' => false]);

        $draftPosts = Post::draft()->get();

        $this->assertEquals(2, $draftPosts->count());
    }

    /** @test */
    public function it_can_get_posts_by_category()
    {
        $category = Category::factory()->create();
        $postsInCategory = Post::factory()->count(2)->create()
            ->each(function ($post) use ($category) {
                $post->categories()->attach($category);
            });
        Post::factory()->count(3)->create();

        $posts = Post::inCategory($category)->get();

        $this->assertEquals(2, $posts->count());
    }
}