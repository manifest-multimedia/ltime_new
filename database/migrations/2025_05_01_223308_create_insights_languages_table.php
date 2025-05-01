<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insights_languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale', 10)->unique();
            $table->string('iso_code', 5)->nullable();
            $table->string('language_code', 5)->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // Insert default language
        DB::table('insights_languages')->insert([
            'name' => 'English',
            'locale' => 'en',
            'iso_code' => 'en',
            'language_code' => 'en',
            'active' => true,
            'is_default' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insights_languages');
    }
};
