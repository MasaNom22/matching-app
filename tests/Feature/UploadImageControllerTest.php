<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UploadImageControllerTest extends TestCase
{
    use RefreshDatabase;
    
    //非ログインユーザーが画像投稿ページにアクセスするとログインページに戻される
    public function testGuestShow()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('upload_form'));

        $response->assertRedirect(route('login'));
    }
    
    //ログインユーザーがトップページにアクセスすると正常にアクセスできる
    public function testAuthShow()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('upload_form'));

        $response->assertStatus(200)
            ->assertViewIs('upload_form');
    }
}
