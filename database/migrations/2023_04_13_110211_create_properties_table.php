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
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('featured')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('beds')->nullable();
            $table->string('baths')->nullable();
            $table->string('squareft')->nullable(); 
            $table->float('price')->nullable(); 
            $table->string('featured-image')->nullable(); 
            $table->string('type')->nullable();
            $table->string('cover-image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
