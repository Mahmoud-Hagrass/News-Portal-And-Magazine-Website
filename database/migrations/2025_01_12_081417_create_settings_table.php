<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name') ; 
            $table->string('favicon')->nullable() ;
            $table->text('small_description')->nullable() ; 
            $table->string('logo')->nullable() ;
            $table->string('email') ;
            $table->string('phone') ;
            $table->string('country') ;
            $table->string('city') ;
            $table->string('street') ;
            $table->string('facebook') ;
            $table->string('twitter') ;
            $table->string('instagram') ;
            $table->string('youtube') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
