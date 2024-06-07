<?php

namespace Tests\Feature\EndPoints;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_logout()
    {
        $response = $this->withoutExceptionHandling()
            ->actingAs(User::find(4))
            ->post(route('logout'));

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }
}
