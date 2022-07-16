<?php

use App\Post;
use App\Category;
use Illuminate\Database\Seeder;

class UpdatePostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        //Ad ogni ciclo estraggo random un id dalla tab categories:
        foreach ($posts as $post){
            $category_id = Category::inRandomOrder()->first()->id;
            $post->category_id = $category_id;
            $post->update();
        }
    }
}
