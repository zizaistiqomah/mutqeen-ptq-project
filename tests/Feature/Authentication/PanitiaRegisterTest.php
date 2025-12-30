<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class PanitiaRegisterTest extends TestCase
{

    public function test_index(): void
    {
        $response = $this->get('/panitia/register');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $data = [
            'role_id' => 2,
            'name' => 'Panitia',
            'email' => 'panitia3@gmail.com',
            'password' => 'panitia123',
            'password_confirmation' => 'panitia123',
            'phone' => '081234567890',
            'major_id' => 1,
            'nim' => '3121600047',
        ];

        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $this->post('/panitia/register', $data);

        $this->assertDatabaseHas('users', [
            'email' => 'panitia3@gmail.com',
            'role_id' => 2,
            'name' => 'Panitia',
            'phone' => '081234567890',
        ]);

        $newestUser = User::latest()->first();

        $this->assertDatabaseHas('panitias', [
            'nim' => '3121600047',
            'major_id' => 1,
            'user_id' => $newestUser->id,
        ]);
    }
}
