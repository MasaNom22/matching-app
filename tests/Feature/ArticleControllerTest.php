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
            ->assertViewIs('articles.index')
            ->assertSee('マッチング画面へ');
    }
    
    public function testGuestShow()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $response = $this->get(route('articles.show', ['article' => $article]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthShow()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $response = $this->actingAs($user)
        ->get(route('articles.show', ['article' => $article]));

        $response->assertStatus(200)->assertViewIs('articles.show');
        ;
    }
    
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
            ->assertViewIs('articles.create')
            ->assertSee('メッセージを投稿する');
    }
    
    
    public function testGuestStore()
    {
        $user = factory(User::class)->create();
        $response = $this->post(route('articles.store'));
        $response->assertRedirect('login');
    }
    
    public function testAuthStore()
    {
        $user = factory(User::class)->create();
        $user_id = $user->id;
        $body ='テスト本文';

        $response = $this->actingAs($user)
        ->post(route(
            'articles.store',
            [
            'body' => $body,
            'user_id' => $user_id,
            ]
        ));
        $response->assertRedirect(route('articles.index'));
        //登録したデータが存在するかどうか
        $this->assertDatabaseHas('articles', [
            'body' => $body,
            'user_id' => $user_id
        ]);
    }
    
    public function testGuestEdit()
    {
        $article = factory(Article::class)->create();
        $user = $article->user;
        $response = $this->get(route('articles.edit', ['article' => $article]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthEdit()
    {
        $article = factory(Article::class)->create();
        $user = $article->user;
        $response = $this->actingAs($user)
        ->get(route('articles.edit', ['article' => $article]));

        $response->assertStatus(200)->assertViewIs('articles.edit')
        ->assertSee($article->body);
    }
    //他人の記事を編集出来ないことを確認
    public function testAuthPolicyEdit()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $user1 = $article->user;
        $response = $this->actingAs($user)
        ->get(route('articles.edit', ['article' => $article]));

        $response->assertStatus(403);
    }
    public function testGuestDelete()
    {
        $article = factory(Article::class)->create();
        $user = $article->user;
        $response = $this->delete(route('articles.destroy', ['article' => $article]));

        $response->assertRedirect(route('login'));
    }
    public function testAuthDelete()
    {
        $article = factory(Article::class)->create();
        $user = $article->user;
        $response = $this->actingAs($user)
        ->delete(route('articles.destroy', ['article' => $article]))
        ->assertStatus(302)
        ->assertRedirect(route('articles.index'));
        
        $this->assertDatabaseMissing('articles', [ 'body' => $article->body]);
    }
    //他人の記事を削除出来ないことを確認
    public function testAuthPolicyDelete()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();
        $user1 = $article->user;
        $response = $this->actingAs($user)
        ->delete(route('articles.destroy', ['article' => $article]));

        $response->assertStatus(403);
    }
}
