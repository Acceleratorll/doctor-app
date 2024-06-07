<?php

namespace Tests\Feature\EndPoints;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_as_pasien()
    {
        $response = $this->post('/login', [
            'email' => 'pasien@mail.com',
            'password' => '12345',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs(User::find(4));
    }

    public function test_login_as_admin()
    {
        $response = $this->post('/login', [
            'email' => 'superadmin@mail.com',
            'password' => '12345',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs(User::find(1));
    }

    public function test_wrong_login()
    {
        $response = $this->from('/login')
            ->post('/login', [
                'email' => 'wrong@mail.com',
                'password' => 'wrong',
            ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
