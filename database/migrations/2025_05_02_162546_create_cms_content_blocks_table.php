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
        if (!Schema::hasTable('cms_content_blocks')) {
            Schema::create('cms_content_blocks', function (Blueprint $table) {
                $table->id();
                $table->foreignId('cms_section_id')->constrained()->onDelete('cascade');
                $table->string('type')->default('text');
                $table->string('title')->nullable();
                $table->string('subtitle')->nullable();
                $table->text('content')->nullable();
                $table->string('image')->nullable();
                $table->string('link_text')->nullable();
                $table->string('link_url')->nullable();
                $table->integer('sort_order')->default(0);
                $table->json('settings')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('cms_content_blocks', function (Blueprint $table) {
                if (!Schema::hasColumn('cms_content_blocks', 'cms_section_id')) {
                    $table->foreignId('cms_section_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('cms_content_blocks', 'type')) {
                    $table->string('type')->default('text');
                }
                if (!Schema::hasColumn('cms_content_blocks', 'title')) {
                    $table->string('title')->nullable();
                }
                if (!Schema::hasColumn('cms_content_blocks', 'subtitle')) {
                    $table->string('subtitle')->nullable();
                }
                if (!Schema::hasColumn('cms_content_blocks', 'content')) {
                    $table->text('content')->nullable();
                }
                if (!Schema::hasColumn('cms_content_blocks', 'image')) {
                    $table->string('image')->nullable();
                }
                if (!Schema::hasColumn('cms_content_blocks', 'link_text')) {
                    $table->string('link_text')->nullable();
                }
                if (!Schema::hasColumn('cms_content_blocks', 'link_url')) {
                    $table->string('link_url')->nullable();
                }
                if (!Schema::hasColumn('cms_content_blocks', 'sort_order')) {
                    $table->integer('sort_order')->default(0);
                }
                if (!Schema::hasColumn('cms_content_blocks', 'settings')) {
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
        Schema::dropIfExists('cms_content_blocks');
    }
};
