<?php

use App\Notifications\PostCommented;
use Illuminate\Notifications\Messages\MailMessage;
use App\Post;
use App\User;;
use App\Comment;

class PostCommentedTest extends TestCase
{

    //use DatabaseTransactions;
    /**
     * @test
     */
    public function it_builds_a_mail_message()
    {
        $post = new Post([
            'title' => 'Titulo del post'
        ]);

        $author = new User([
            'name' => 'Diego Rueda'
        ]);

        $comment = new Comment();
        $comment->post = $post;
        $comment->user = $author;

        $notification = new PostCommented($comment);

        //$this->assertInstanceOf(PostCommented::class, $notification);

        $subscriber = factory(\App\User::class)->create();

        $message = $notification->toMail($subscriber);

        $this->assertInstanceOf(MailMessage::class, $message);

       // dd($message);
        $this->assertSame(
            'Nuevo comentario en: Titulo del post',
            $message->subject
        );

        $this->assertSame(
            'Diego Rueda escribio un comentario en: Titulo del post',
            $message->introLines[0]
        );

        $this->assertSame($comment->post->url, $message->actionUrl);
    }
}
