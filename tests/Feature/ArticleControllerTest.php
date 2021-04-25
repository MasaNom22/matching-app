<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }
    
    public function testGuestIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertRedirect(route('login'));
    }
    
    
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }
    
    public function testGuestShow()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $response = $this->get(route('articles.show', ['article' => $article]));

        $response->assertRedirect(route('login'));
    }
    
    public function testtAuthShow()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $response = $this->actingAs($user)
        ->get(route('articles.show', ['article' => $article]));

        $response->assertStatus(200)->assertViewIs('articles.show');
        ;
    }
}
