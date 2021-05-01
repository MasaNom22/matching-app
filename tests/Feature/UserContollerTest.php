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
    
    public function testGuestfolowings()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.followings', ['id' => $user->id]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthfolowings()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->
        get(route('users.followings', ['id' => $user->id]));

        $response->assertStatus(200)->assertViewIs('users.followings')
        ->assertSee('フォローユーザー一覧画面');
        ;
    }
    
    public function testGuestfollowers()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.followers', ['id' => $user->id]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthfollowers()
    {
        $user1 = factory(User::class)->create();
        $user = factory(User::class)->create();
        $user1->followings()->attach($user);
        $response = $this->actingAs($user)->
        get(route('users.followers', ['id' => $user->id]));
        
        $response->assertStatus(200)->assertViewIs('users.followers')
        ->assertSee($user1->name);
    }
    //アンフォローできるか
    public function testAuthUnfollowers()
    {
        $user1 = factory(User::class)->create();
        $user = factory(User::class)->create();
        $user1->followings()->attach($user);
        //フォローを外す
        $user1->followings()->detach($user);
        $response = $this->actingAs($user)->
        get(route('users.followers', ['id' => $user->id]));
        
        $response->assertStatus(200)->assertViewIs('users.followers')
        ->assertDontSee($user1->name);
    }
    
    public function testGuestfollowings()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.followers', ['id' => $user->id]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthfollowings()
    {
        $user1 = factory(User::class)->create();
        $user = factory(User::class)->create();
        $user->followings()->attach($user1);
        $response = $this->actingAs($user)->
        get(route('users.followings', ['id' => $user->id]));
        
        $response->assertStatus(200)->assertViewIs('users.followings')
        ->assertSee('フォローユーザー一覧画面')
        ->assertSee($user1->name);
    }
    
    public function testAuthunfollowings()
    {
        $user1 = factory(User::class)->create();
        $user = factory(User::class)->create();
        $user->followings()->attach($user1);
        //フォローを外す
        $user->followings()->detach($user1);
        $response = $this->actingAs($user)
        ->get(route('users.followings', ['id' => $user->id]));
        
        $response->assertStatus(200)->assertViewIs('users.followings')
        ->assertSee('フォローユーザー一覧画面')
        ->assertDontSee($user1->name);
    }
    
    public function testGuestMatching()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.matchs', ['user' => $user]));

        $response->assertRedirect(route('login'));
    }
    
    public function testAuthMatching()
    {
        $user1 = factory(User::class)->create();
        $user = factory(User::class)->create();
        //相互フォロー
        $user->followings()->attach($user1);
        $user1->followings()->attach($user);
        $response = $this->actingAs($user)
        ->get(route('users.matchs', ['user' => $user]));

        $response->assertStatus(200)->assertViewIs('users.matchings')
        ->assertSee('マッチングユーザー一覧画面')
        ->assertSee($user->name);
    }
}
