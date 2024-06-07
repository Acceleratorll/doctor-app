<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{   
    public function test_see_dashboard_as_guest()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_see_dashboard_as_pasien()
    {
        $response = $this->actingAs(User::find(4))->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_see_admin_dashboard_as_guest_redirected_to_login_page()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_see_admin_dashboard_as_pasien_redirected_to_dashboard()
    {
        $response = $this->actingAs(User::find(4))->get('/admin/dashboard');

        $response->assertStatus(401);
    }

    public function test_see_admin_dashboard_as_admin()
    {
        $response = $this->actingAs(User::find(1))->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_access_unknown_url_as_guest_redirected_to_dashboard()
    {
        $response = $this->get('/unknown');

        $response->assertStatus(302)->assertRedirect('/dashboard');
    }

    public function test_access_unknown_url_as_pasien_redirected_to_dashboard()
    {
        $response = $this->actingAs(User::find(4))->get('/unknown');

        $response->assertStatus(302)
            ->assertRedirect('/dashboard');
    }

    public function test_access_unknown_url_as_admin_redirected_to_admin_dashboard()
    {
        $response = $this->actingAs(User::find(1))->get('/unknown');

        $response->assertStatus(302)
            ->assertRedirect('/admin/dashboard');
    }
}
