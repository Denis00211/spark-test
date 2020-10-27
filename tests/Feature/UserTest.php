<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends PassportTestCase
{
    use RefreshDatabase;

    public function testSuccessLogin()
    {
        $response = $this->post('/api/login', [
            'email' => $this->user->email,
            'password' => "password",
        ]);

        $response->assertStatus(200);
    }

    public function testFailedLogin()
    {
        $response = $this->post('/api/login', [
            'email' => $this->user->email,
            'password' => "test",
        ]);

        $response->assertStatus(401);
    }

    public function testSuccessLogout()
    {
        $response = $this->post('/api/logout', [
        ], $this->headers);

        $response->assertStatus(200);
    }
}
