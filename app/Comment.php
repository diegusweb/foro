<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment','post_id'];

   /* protected $casts = [
        'answer' => 'boolean'
    ];*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function markAsAnswer()
    {
        //$this->post->comments()->where('answer', true)->update(['answer' => false]);

        //$this->answer = true;

        //$this->save();

        $this->post->pending = false;
        $this->post->answer_id = $this->id;

        $this->post->save();
    }

    public function getAnswerAttribute()
    {
        return $this->id === $this->post->answer_id;
    }
}
