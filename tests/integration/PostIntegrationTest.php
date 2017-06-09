<?php

use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    //pruebas de integracion que probamos el modelo con la base de datos
    use DatabaseTransactions;

    public function test_a_slug_is_genrated_and_saved_to_the_database()
    {

        $post = factory(Post::class)->create([
            'title' => 'Como instalar laravel'
        ]);

        //dd($post->toArray());

        $this->seeInDatabase('posts',[
            'slug' => 'como-instalar-laravel'
        ]);

        $this->assertSame('como-instalar-laravel', $post->slug);

        /*$this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug
        );*/
    }
}
