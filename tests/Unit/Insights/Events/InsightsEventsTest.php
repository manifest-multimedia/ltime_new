<?php

namespace Tests\Unit\Insights\Events;

use Tests\TestCase;
use App\Models\Insights\Post;
use App\Models\Insights\Comment;
use App\Events\Insights\PostPublished;
use App\Events\Insights\CommentSubmitted;
use App\Listeners\Insights\NotifyPostAuthor;
use App\Listeners\Insights\NotifyAdminsNewComment;
use App\Notifications\Insights\NewCommentNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

class InsightsEventsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Notification::fake();
    }

    /** @test */
    public function post_published_event_is_dispatched()
    {
        Event::fake();
        
        $post = Post::factory()->create();
        $post->publish();

        Event::assertDispatched(PostPublished::class, function ($event) use ($post) {
            return $event->post->id === $post->id;
        });
    }

    /** @test */
    public function comment_submitted_event_is_dispatched()
    {
        Event::fake();
        
        $comment = Comment::factory()->create();

        Event::assertDispatched(CommentSubmitted::class, function ($event) use ($comment) {
            return $event->comment->id === $comment->id;
        });
    }

    /** @test */
    public function post_author_is_notified_of_new_comments()
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->create(['post_id' => $post->id]);
        
        $event = new CommentSubmitted($comment);
        $listener = new NotifyPostAuthor();
        
        $listener->handle($event);

        Notification::assertSentTo(
            $post->author,
            NewCommentNotification::class,
            function ($notification) use ($comment) {
                return $notification->comment->id === $comment->id;
            }
        );
    }

    /** @test */
    public function admins_are_notified_of_new_comments()
    {
        $comment = Comment::factory()->create();
        $admins = User::factory()->count(3)->create()->each(function ($user) {
            $user->assignRole('admin');
        });
        
        $event = new CommentSubmitted($comment);
        $listener = new NotifyAdminsNewComment();
        
        $listener->handle($event);

        Notification::assertSentTo(
            $admins,
            NewCommentNotification::class,
            function ($notification) use ($comment) {
                return $notification->comment->id === $comment->id;
            }
        );
    }

    /** @test */
    public function notifications_are_not_sent_for_spam_comments()
    {
        $comment = Comment::factory()->state(['is_spam' => true])->create();
        
        $event = new CommentSubmitted($comment);
        $listener = new NotifyPostAuthor();
        
        $listener->handle($event);

        Notification::assertNothingSent();
    }

    /** @test */
    public function post_author_notifications_respect_user_preferences()
    {
        $author = User::factory()->create(['notification_preferences' => ['new_comments' => false]]);
        $post = Post::factory()->create(['user_id' => $author->id]);
        $comment = Comment::factory()->create(['post_id' => $post->id]);
        
        $event = new CommentSubmitted($comment);
        $listener = new NotifyPostAuthor();
        
        $listener->handle($event);

        Notification::assertNotSentTo($author, NewCommentNotification::class);
    }
}