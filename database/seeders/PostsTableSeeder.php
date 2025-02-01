<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(20)->create();  // Using the factory correctly

        $tags = \App\Models\Tag::all();
        
        // Populate the pivot table using a closure
        Post::all()->each(function ($post) use ($tags) { 
            $post->tags()->attach(
                $tags->random(3)->pluck('id')->toArray()
            ); 
        });
    }
}
