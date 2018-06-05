<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \FiguredBlog\Post;

class PostTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * Test creation of a Post - slug generation is the only fancy bit
     *
     * @return void
     */
    public function testPostModelCreate()
    {
        $post = factory(Post::class)->create();

        $this->assertInstanceOf('\FiguredBlog\Post', $post);
        $this->assertStringMatchesFormat('%s', $post->title);
        $this->assertStringMatchesFormat('%s', $post->body);
        $this->assertRegExp('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $post->slug);
    }
}
