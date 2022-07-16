<?php

use Illuminate\Database\Seeder;
use App\Tag;
Use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =['frontend', 'backend', 'design', 'UX', 'laravel'];

        foreach ($data as $tag) {
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($tag, '-');
            $new_tag->save();

        }

    }
}
