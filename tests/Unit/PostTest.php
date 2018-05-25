<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creation of a Post - slug generation is the only fancy bit
     *
     * @return void
     */
    public function testPostBasic()
    {
        $post = factory(\App\Post::class)->create();

        $this->assertInstanceOf('\App\Post', $post);
        $this->assertStringMatchesFormat('%s', $post->title);
        $this->assertStringMatchesFormat('%s', $post->body);
        $this->assertRegExp('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $post->slug);
    }
}
