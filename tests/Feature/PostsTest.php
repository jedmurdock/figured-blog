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
            ->assertJsonFragment([
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
            ->assertJsonFragment([ 
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
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'body', 
                        'title', 
                        'created_at', 
                        'updated_at', 
                        'visible_at', 
                        'slug'
                        ]
                    ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ]);
    }
}
