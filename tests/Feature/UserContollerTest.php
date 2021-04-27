<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserContollerTest extends TestCase
{
    use RefreshDatabase;
    
    //非ログインユーザーがトップページにアクセスするとログインページに戻される
    public function testGuestIndex()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }
    //ログインユーザーがトップページにアクセスすると正常にアクセスできる
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.index'));

        $response->assertStatus(200)
            ->assertViewIs('users.index')
            ->assertSee('ユーザー一覧');
    }
    
    public function testGuestShow()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.show', ['user' => $user]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthShow()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
        ->get(route('users.show', ['user' => $user]));

        $response->assertStatus(200)->assertViewIs('users.show')
        ->assertSee('趣味');
    }
    
    public function testGuestEdit()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.edit', ['user' => $user]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthEdit()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
        ->get(route('users.edit', ['user' => $user]));

        $response->assertStatus(200)->assertViewIs('users.edit')
        ->assertSee('プロフィール編集');
    }
    
    //他人のプロフィールは変更出来ない
    public function testAuthPolicyEdit()
    {
        $user = factory(User::class)->create();
        $user1 = factory(User::class)->create();
        $response = $this->actingAs($user)
        ->get(route('users.edit', ['user' => $user1]));

        $response->assertStatus(403);
    }
}
