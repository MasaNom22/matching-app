<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UploadImageControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testGuestShow()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('upload_form', ['id' => $user->id]));

        $response->assertRedirect(route('login'));
    }
}
