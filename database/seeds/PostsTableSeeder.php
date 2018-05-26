<?php

use Illuminate\Database\Seeder;
use \App\Post;

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
