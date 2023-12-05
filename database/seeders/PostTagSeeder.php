<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function ($post) {
            Tag::all()->each(function ($tag) use ($post) {
                if (rand(0, 100) > 70) {
                    PostTag::create([
                       'post_id' => $post->id,
                       'tag_id' => $tag->id
                    ]);
                }
            });
        });
    }
}
