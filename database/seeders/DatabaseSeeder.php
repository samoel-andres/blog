<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // delete directories
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');

        // create directories to save images
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');

        // call seeder of user
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        // call factories
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
    }
}
