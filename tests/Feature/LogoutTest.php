<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    public function testLogout()
    {
        $user = factory(\App\User::class)->create(['email' => 'testy@example.com']);
        $token = $user->makeApiToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('get', '/api/posts', [], $headers)->assertStatus(200);
        $this->json('post', '/api/logout', [], $headers)->assertStatus(200);

        $user = \App\User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    public function testNullToken()
    {
        $user = factory(\App\User::class)->create(['email' => 'testor@example.com']);
        $token = $user->makeApiToken();
        $headers = ['Authorization' => "Bearer $token"];

        $user->api_token = null;
        $user->save();

        $payload = [
            'title' => 'Testy Post',
            'body' => 'This is an automated test post',
            'visible_at' => '2018-01-01 11:20:00',
        ];

        $this->json('post', '/api/posts', $payload, $headers)->assertStatus(401);
    }
}
