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
        if (!Schema::hasTable('cms_pages')) {
            Schema::create('cms_pages', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('meta_description')->nullable();
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
                $table->string('layout')->default('default');
                $table->timestamps();
            });
        } else {
            Schema::table('cms_pages', function (Blueprint $table) {
                if (!Schema::hasColumn('cms_pages', 'title')) {
                    $table->string('title');
                }
                if (!Schema::hasColumn('cms_pages', 'slug')) {
                    $table->string('slug')->unique();
                }
                if (!Schema::hasColumn('cms_pages', 'meta_description')) {
                    $table->text('meta_description')->nullable();
                }
                if (!Schema::hasColumn('cms_pages', 'status')) {
                    $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
                }
                if (!Schema::hasColumn('cms_pages', 'layout')) {
                    $table->string('layout')->default('default');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
    }
};
