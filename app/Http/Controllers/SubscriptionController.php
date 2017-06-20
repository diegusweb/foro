<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Post $post)
    {
       /* Subscription::create([
            'post_id' => $post->id,
            'user_id' => auth()->id()
        ]);*/

        //auth()->user()->subscription()->attach($post);

        auth()->user()->subscribeTo($post);

        return redirect($post->url);
    }
}
