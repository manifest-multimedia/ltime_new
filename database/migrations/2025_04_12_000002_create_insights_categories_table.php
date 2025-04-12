<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('insights_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("created_by")->nullable()->index()->comment("user id");
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->timestamps();
        });

        Schema::create('insights_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string("category_name")->nullable();
            $table->string("slug")->unique();
            $table->mediumText("category_description")->nullable();
            $table->unsignedInteger("lang_id")->index();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('insights_categories')->onDelete('cascade');
            $table->foreign('lang_id')->references('id')->on('binshops_languages');
        });

        Schema::create('insights_post_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("post_id")->index();
            $table->unsignedInteger("category_id")->index();

            $table->foreign('post_id')->references('id')->on('insights_posts')->onDelete("cascade");
            $table->foreign('category_id')->references('id')->on('insights_categories')->onDelete("cascade");
        });
    }

    public function down()
    {
        Schema::dropIfExists('insights_post_categories');
        Schema::dropIfExists('insights_category_translations');
        Schema::dropIfExists('insights_categories');
    }
};