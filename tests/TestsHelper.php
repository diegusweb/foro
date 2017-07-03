<?php

namespace Tests;

trait TestsHelper
{

    protected $defaultUser;

    public function defaultUser(array $attributes = [])
    {
        if($this->defaultUser){
            return $this->defaultUser;
        }

        return $this->defaultUser = factory(\App\User::class)->create($attributes);
    }

    protected function createPost(array $attributes = [])
    {
        return factory(\App\Post::class)->create($attributes);
    }
}