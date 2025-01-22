<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class , 
            CategorySeeder::class ,
            PostSeeder::class ,
            CommentSeeder::class ,
            PostImageSeeder::class ,
            ContactSeeder::class , 
            UsefulLinksSeeder::class , 
        ]) ; 
    }
}
