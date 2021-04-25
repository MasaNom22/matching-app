<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserContollerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGuestIndex()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }
    use DatabaseTransactions;
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.index'));

        $response->assertStatus(200)
            ->assertViewIs('users.index');
    }
    public function testGuestShow()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.show', ['user' => $user]));

        $response->assertRedirect(route('login'));
    }
    public function testtAuthShow()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
        ->get(route('users.show', ['user' => $user]));

        $response->assertStatus(200)->assertViewIs('users.show');
        ;
    }
}
