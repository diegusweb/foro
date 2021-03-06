<?php



class SubscribeToPostsTest extends FeatureTestCase
{

    public function test_a_use_can_suscribeto_a_post()
    {
        //HAving
        $post = $this->createPost();

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

        //when
        $this->visit($post->url)
            ->press('Suscribirse al post');

        //then
        $this->seeInDatabase('subscriptions',[
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        $this->seePageIs($post->url)
            ->dontSee('Suscribirse al post');
    }

    public function test_a_user_can_unsubcribe_from_a_post()
    {
        //HAving
        $post = $this->createPost();

        $user = factory(\App\User::class)->create();

        $user->SubscribeTo($post);

        $this->actingAs($user);

        //when
        $this->visit($post->url)
            ->dontSee('Suscribirse al post')
            ->press('Desuscribirse del post');

        $this->dontSeeInDatabase('subscriptions',[
            'user_id' => $user->id,
            'post_id' =>$post->id
        ]);

        $this->seePageIs($post->url);
    }
}
