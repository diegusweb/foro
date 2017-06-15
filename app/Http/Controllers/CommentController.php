<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        /*$comment = new Comment([
            'comment' => $request->get('comment'),
            'post_id' => $post->id
        ]);*/

        //todo: Add validation

        //auth()->user()->comments()->save($comment);
        auth()->user()->comment($post, $request->get('comment'));

        return redirect($post->url);
    }

    public function accept(Comment $comment)
    {
        $this->authorize('accept', $comment);

        $comment->markAsAnswer();

        return redirect($comment->post->url);
    }
}
