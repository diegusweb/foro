<?php


class ShowPostTest extends FeatureTestCase
{
    /**
     *
     */
    function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios'
        ]);

        $post = factory(\App\Post::class)->create([
            'title' => 'Este es el titulo del post',
            'content' => 'Este es el contenido del post',
            'user_id' => $user->id
        ]);

       //dd(\App\User::all()->toArray());

       // dd(route('posts.show', $post));
        //dd($post->url);

        // When
        $this->visit($post->url)
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see('Duilio Palacios');
    }

    function test_old_urls_are_redirected()
    {
        // Having
        $user = $this->defaultUser();
        $post = factory(\App\Post::class)->create([
            'title' => 'Old title',
        ]);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->visit($url)
            ->seePageIs($post->url);
    }

    /*public function test_post_url_with_wrong_slugs_still()
    {
        // Having
        $user = $this->defaultUser();

        $post = factory(\App\Post::class)->make([
            'title' => 'Old title',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']);

        $this->get($url)
            ->assertResponseStatus(404);

    }*/

}