<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'admin' , 
            'username' => 'admin' ,
            'email' => 'admin@admin.com' , 
            'password' => Hash::make('123456789') ,
        ]) ;  
        Admin::create([
            'name' => 'admin2' , 
            'username' => 'admin2' ,
            'email' => 'admin2@admin.com' , 
            'password' => Hash::make('123456789') ,
        ]) ;  
    }
}
