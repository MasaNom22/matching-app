<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikesControllertest extends TestCase
{
    use RefreshDatabase;
    
    public function testGuestIndex()
    {
        $response = $this->get(route('likes.index'));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthIndex()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $article->likes()->attach($user);

        $response = $this->actingAs($user)
            ->get(route('likes.index'));

        $response->assertStatus(200)
            ->assertViewIs('likes.index')
            ->assertSee($article->body);
    }
}
