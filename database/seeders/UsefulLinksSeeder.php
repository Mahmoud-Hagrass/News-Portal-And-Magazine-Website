<?php

namespace Database\Seeders;

use App\Models\UsefulLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsefulLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsefulLink::factory()->count(5)->create() ; 
    }
}
