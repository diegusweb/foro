<?php

/**
 * Created by PhpStorm.
 * User: DIego
 * Date: 6/3/2017
 * Time: 9:47 AM
 */
class CreatePostsTest extends FeatureTestCase
{

    public function test_a_user_create_a_post()
    {
        //Moving
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user = $this->defaultUser());

        //when
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');


        //then
        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
            'slug' => 'esta-es-una-pregunta',
        ]);

        //Test a user is redirect to the posts details after creating it.
        $this->see($title);

    }

    public function test_creating_a_post_requires_athentication()
    {
        //when
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));

        //then
    }

    public function test_create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeErrors([
                'title' => 'El campo título es obligatorio',
                'content' => 'El campo contenido es obligatorio'
            ]);
    }
}