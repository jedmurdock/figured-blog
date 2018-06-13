<?php

use Illuminate\Database\Seeder;
use \FiguredBlog\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = factory(User::class, 4)->create();
    }
}
