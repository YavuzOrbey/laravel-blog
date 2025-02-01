<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserTableSeeder;  // Correct namespace import
use Database\Seeders\LaratrustSeeder;  // Correct namespace import
use Database\Seeders\TagsTableSeeder;  // Correct namespace import
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LaratrustSeeder::class,
            UserTableSeeder::class,
            TagsTableSeeder::class,
            PostsTableSeeder::class,
            CategoryTableSeeder::class,
        ]);
    }
}
