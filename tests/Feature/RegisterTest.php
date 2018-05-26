<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    public function testRegistration()
    {
        $payload = [
            'name' => 'Testy Testor',
            'email' => 'test@example.com',
            'password' => '8675309',
            'password_confirmation' => '8675309',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);;
    }

    public function testRequiredFields()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([ 
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testPasswordConfirmation()
    {
        $payload = [
            'name' => 'Testy Testor',
            'email' => 'test@example.com',
            'password' => '8675309',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'password' => ['The password confirmation does not match.'],
                ]
            ]);
    }
}
