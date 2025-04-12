<?php

namespace Tests\Unit\Insights;

use Tests\TestCase;
use App\Models\Insights\Post;
use App\Models\Insights\Category;
use App\Models\Insights\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_factory_creates_valid_post()
    {
        $post = Post::factory()->create();

        $this->assertNotNull($post->user_id);
        $this->assertNotNull($post->created_at);
        $this->assertNotNull($post->updated_at);
        
        // Test translations
        $translation = $post->translations->first();
        $this->assertNotNull($translation);
        $this->assertNotNull($translation->title);
        $this->assertNotNull($translation->slug);
        $this->assertNotNull($translation->post_body);
    }

    /** @test */
    public function post_factory_can_create_published_post()
    {
        $post = Post::factory()->published()->create();

        $this->assertTrue($post->is_published);
        $this->assertNotNull($post->posted_at);
    }

    /** @test */
    public function post_factory_can_create_draft_post()
    {
        $post = Post::factory()->draft()->create();

        $this->assertFalse($post->is_published);
        $this->assertNull($post->posted_at);
    }

    /** @test */
    public function category_factory_creates_valid_category()
    {
        $category = Category::factory()->create();

        $this->assertNotNull($category->created_by);
        $this->assertNotNull($category->created_at);
        $this->assertNotNull($category->updated_at);
        
        // Test translations
        $translation = $category->translations->first();
        $this->assertNotNull($translation);
        $this->assertNotNull($translation->category_name);
        $this->assertNotNull($translation->slug);
    }

    /** @test */
    public function category_factory_can_create_nested_categories()
    {
        $parent = Category::factory()->create();
        $child = Category::factory()->child($parent)->create();

        $this->assertEquals($parent->id, $child->parent_id);
        $this->assertTrue($parent->children->contains($child));
    }

    /** @test */
    public function comment_factory_creates_valid_comment()
    {
        $comment = Comment::factory()->create();

        $this->assertNotNull($comment->post_id);
        $this->assertNotNull($comment->comment);
        $this->assertNotNull($comment->ip);
        $this->assertNotNull($comment->created_at);
    }

    /** @test */
    public function comment_factory_can_create_approved_comment()
    {
        $comment = Comment::factory()->approved()->create();

        $this->assertTrue($comment->approved);
    }

    /** @test */
    public function comment_factory_can_create_pending_comment()
    {
        $comment = Comment::factory()->pending()->create();

        $this->assertFalse($comment->approved);
    }

    /** @test */
    public function comment_factory_can_create_guest_comment()
    {
        $comment = Comment::factory()->guest()->create();

        $this->assertNull($comment->user_id);
        $this->assertNotNull($comment->author_name);
        $this->assertNotNull($comment->author_email);
    }

    /** @test */
    public function comment_factory_can_create_user_comment()
    {
        $comment = Comment::factory()->fromUser()->create();

        $this->assertNotNull($comment->user_id);
        $this->assertNotNull($comment->user);
        $this->assertEquals($comment->author_name, $comment->user->name);
        $this->assertEquals($comment->author_email, $comment->user->email);
    }
}