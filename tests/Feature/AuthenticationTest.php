<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testLogin()
    {
        $response = $this
            ->json('POST', route('login'), [
                'email' => 'admin@gmail.com',
                'password' => 'admin12345',
            ]);
        $response->assertStatus(204);

        $this->assertAuthenticated();
    }

    public function testLogout()
    {
        $response = $this
            ->json('POST', route('logout'), []);

        $response->assertStatus(204);

        $this->assertGuest();
    }
}
