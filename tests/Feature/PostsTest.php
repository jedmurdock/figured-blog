<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \FiguredBlog\User;
use \FiguredBlog\Post;

class PostsTest extends TestCase
{
    public function testCreate()
    {
        $user = factory(User::class)->create();
        $token = $user->makeApiToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
            'visible_at' => '2018-01-01 11:20:00',
        ];

        $this->json('POST', '/api/posts', $payload, $headers)
            ->assertStatus(201)
            ->assertJson([
                'id' => 1, 
                'title' => 'Lorem', 
                'body' => 'Ipsum',
                'visible_at' => '2018-01-01 11:20:00',
            ]);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $token = $user->makeApiToken();
        $headers = ['Authorization' => "Bearer $token"];
        $post = factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
            'visible_at' => '2018-01-01 11:20:00',
        ]);

        $payload = [
            'title' => 'Lorem',
            'body' => 'Ipsum',
            'visible_at' => '2018-01-01 11:20:00',
        ];

        $response = $this->json('PUT', '/api/posts/' . $post->slug, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'title' => 'Lorem', 
                'body' => 'Ipsum',
                'visible_at' => '2018-01-01 11:20:00',
            ]);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create();
        $token = $user->makeApiToken();
        $headers = ['Authorization' => "Bearer $token"];
        $post = factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
            'visible_at' => '2018-01-01 11:20:00',
        ]);

        $this->json('DELETE', '/api/posts/' . $post->slug, [], $headers)
            ->assertStatus(204);
    }

    public function testList()
    {
        factory(Post::class)->create([
            'title' => 'First Post',
            'body' => 'First Body',
            'visible_at' => '2018-01-01 11:20:00',
        ]);

        factory(Post::class)->create([
            'title' => 'Second Post',
            'body' => 'Second Body',
            'visible_at' => '2018-02-01 11:21:00',
        ]);

        $user = factory(User::class)->create();
        $token = $user->makeApiToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/posts', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 
                    'title' => 'First Post', 
                    'body' => 'First Body',
                    'visible_at' => '2018-01-01 11:20:00',
                ],
                [ 
                    'title' => 'Second Post', 
                    'body' => 'Second Body',
                    'visible_at' => '2018-02-01 11:21:00',
                ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at', 'visible_at', 'slug'],
            ]);
    }
}
