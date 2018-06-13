<?php

use Illuminate\Database\Seeder;
use \FiguredBlog\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        $post = factory(Post::class, 20)->create();
    }
}
