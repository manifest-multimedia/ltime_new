<?php

namespace Tests\Unit\Insights;

use Tests\TestCase;
use App\Models\Insights\Comment;
use App\Models\Insights\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_post()
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['post_id' => $post->id]);

        $this->assertInstanceOf(Post::class, $comment->post);
        $this->assertEquals($post->id, $comment->post->id);
    }

    /** @test */
    public function it_can_belong_to_a_user()
    {
        $user = User::factory()->create();
        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $comment->user);
        $this->assertEquals($user->id, $comment->user->id);
    }

    /** @test */
    public function it_can_be_created_by_guest()
    {
        $comment = Comment::factory()->create([
            'user_id' => null,
            'author_name' => 'John Doe',
            'author_email' => 'john@example.com'
        ]);

        $this->assertNull($comment->user);
        $this->assertEquals('John Doe', $comment->author_name);
        $this->assertEquals('john@example.com', $comment->author_email);
    }

    /** @test */
    public function it_can_be_approved()
    {
        $comment = Comment::factory()->create(['approved' => false]);
        
        $comment->approve();

        $this->assertTrue($comment->fresh()->approved);
    }

    /** @test */
    public function it_can_be_unapproved()
    {
        $comment = Comment::factory()->create(['approved' => true]);
        
        $comment->unapprove();

        $this->assertFalse($comment->fresh()->approved);
    }

    /** @test */
    public function it_can_get_approved_comments()
    {
        Comment::factory()->count(3)->create(['approved' => true]);
        Comment::factory()->count(2)->create(['approved' => false]);

        $approvedComments = Comment::approved()->get();

        $this->assertEquals(3, $approvedComments->count());
    }

    /** @test */
    public function it_can_get_pending_comments()
    {
        Comment::factory()->count(3)->create(['approved' => true]);
        Comment::factory()->count(2)->create(['approved' => false]);

        $pendingComments = Comment::pending()->get();

        $this->assertEquals(2, $pendingComments->count());
    }

    /** @test */
    public function it_stores_ip_address()
    {
        $comment = Comment::factory()->create(['ip' => '192.168.1.1']);

        $this->assertEquals('192.168.1.1', $comment->ip);
    }

    /** @test */
    public function it_can_get_comments_by_user()
    {
        $user = User::factory()->create();
        Comment::factory()->count(2)->create(['user_id' => $user->id]);
        Comment::factory()->count(3)->create();

        $userComments = Comment::byUser($user)->get();

        $this->assertEquals(2, $userComments->count());
    }
}