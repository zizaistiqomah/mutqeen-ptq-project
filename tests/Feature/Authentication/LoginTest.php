<?php

namespace Tests\Feature\Authentication;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_route_login(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_login(): void
    {
        $data = [
            'email' => 'panitia@gmail.com',
            'password' => 'panitia123'
        ];

        $response = $this->post('/login', $data);

        $response->assertRedirect('/dashboard');
    }
}
