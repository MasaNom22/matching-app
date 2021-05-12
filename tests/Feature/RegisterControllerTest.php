<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSignUpGet()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('signup.get'));

        $response->assertStatus(200);
    }

}
