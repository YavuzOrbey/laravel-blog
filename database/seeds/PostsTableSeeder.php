<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 20)->create();

        $tags = App\Tag::all();
        
        // Populate the pivot table using a closure
        App\Post::all()->each(function ($post) use ($tags) { 
            $post->tags()->attach(
                $tags->random(3)->pluck('id')->toArray()
            ); 
        });
    }
}
