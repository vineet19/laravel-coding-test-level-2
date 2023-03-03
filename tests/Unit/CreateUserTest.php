<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     assertTrue(true);
    // }

    public function test_create_new_user()
    {         
        $admin = User::find('055dbce4-5c04-4fe5-ae54-6608c3f0f8ec'); //Admin User for the middleware
        $user = User::factory()->raw();
        $response = $this->actingAs($admin)->post('/api/users', $user);

        $response->assertStatus(201);
    }
}
