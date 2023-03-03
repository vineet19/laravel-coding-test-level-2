<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class CreateUser extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_new_user()
    {
        Http::fake();
        
        $response = Http::post('/api/users', [
            'name' => $this->faker->word(),
            'email' => $this->faker->word(),
            'username' => $this->faker->word(),
            'password' => $this->faker->word()
        ]);
        
        $response->assertStatus(200);
    }
}
