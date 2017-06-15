<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Comment;

class MarkCommentAsAnswerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_post_can_be_answered()
    {
        $post = $this->createPost();
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id
        ]);
        $comment->markAsAnswer();
        $this->assertTrue($comment->fresh()->answer);
        $this->assertFalse($post->fresh()->pending);
    }

    public function test_a_post_can_omly_have_one_answer()
    {
        $post = $this->createPost();
        $comment = factory(Comment::class)->times(2)->create([
            'post_id' => $post->id
        ]);
        $comment->first()->markAsAnswer();

        $comment->last()->markAsAnswer();

        $this->assertFalse($comment->first()->fresh()->answer);

        $this->assertTrue($comment->last()->fresh()->answer);
    }
}
