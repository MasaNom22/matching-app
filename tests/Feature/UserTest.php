<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    public function testIsFollowedByNull()
    {
        $user = factory(User::class)->create();

        $result = $user->isFollowedBy(null);

        $this->assertFalse($result);
    }
    
    //フォローされているか
    public function testIsFollowedByTheUser()
    {
        $user1 = factory(User::class)->create();
        $user = factory(User::class)->create();
        $user1->followings()->attach($user);

        $result = $user->isFollowedBy($user1);

        $this->assertTrue($result);
    }
    //フォローされていない
    public function testIsFollosedByAnother()
    {
        $user1 = factory(User::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $user1->followings()->attach($another);

        $result = $user->isFollowedBy($user1);

        $this->assertFalse($result);
    }
}
