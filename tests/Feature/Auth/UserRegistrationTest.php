<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_new_user()
    {
        $response = $this->postJson('/api/user/register',[
            'name'                  => $this->faker->name(),
            'email'                 => $email = $this->faker->safeEmail(),
            'password'              => $pass = Str::random(10),
            'password_confirmation' => $pass
        ])->assertStatus(200);

        $this   ->assertDatabaseHas('users',['email'=> $email])
                ->assertDatabaseCount('users', 1);
    }
}
