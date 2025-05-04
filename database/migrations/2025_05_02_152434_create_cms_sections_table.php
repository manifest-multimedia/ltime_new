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
        if (!Schema::hasTable('cms_sections')) {
            Schema::create('cms_sections', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cms_page_id')->constrained()->onDelete('cascade');
                $table->string('title')->nullable();
                $table->string('type')->default('standard');
                $table->integer('sort_order')->default(0);
                $table->string('background_color')->nullable();
                $table->string('text_color')->nullable();
                $table->json('settings')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('cms_sections', function (Blueprint $table) {
                if (!Schema::hasColumn('cms_sections', 'cms_page_id')) {
                    $table->foreignId('cms_page_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('cms_sections', 'title')) {
                    $table->string('title')->nullable();
                }
                if (!Schema::hasColumn('cms_sections', 'type')) {
                    $table->string('type')->default('standard');
                }
                if (!Schema::hasColumn('cms_sections', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }
                if (!Schema::hasColumn('cms_sections', 'background_color')) {
                    $table->string('background_color')->nullable();
                }
                if (!Schema::hasColumn('cms_sections', 'text_color')) {
                    $table->string('text_color')->nullable();
                }
                if (!Schema::hasColumn('cms_sections', 'settings')) {
                    $table->json('settings')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_sections');
    }
};
