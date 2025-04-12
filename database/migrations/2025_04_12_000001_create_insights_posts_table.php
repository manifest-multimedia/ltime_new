<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('insights_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id")->index()->nullable();
            $table->dateTime("posted_at")->index()->nullable()->comment("Public posted at time, if this is in future then it wont appear yet");
            $table->boolean("is_published")->default(true);
            $table->timestamps();
        });

        Schema::create('insights_post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->nullable();
            $table->string("slug");
            $table->string("title")->nullable()->default("New blog post");
            $table->string("subtitle")->nullable()->default("");
            $table->text("meta_desc")->nullable();
            $table->string("seo_title")->nullable();
            $table->mediumText("post_body")->nullable();
            $table->text("short_description")->nullable();
            $table->string("use_view_file")->nullable()->comment("should refer to a blade file in /views/");
            $table->string('image_large')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_thumbnail')->nullable();
            $table->unsignedInteger("lang_id")->index();
            $table->timestamps();
            
            $table->unique(['slug', 'lang_id']);
            $table->foreign('post_id')->references('id')->on('insights_posts')->onDelete('cascade');
            $table->foreign('lang_id')->references('id')->on('binshops_languages');
        });
    }

    public function down()
    {
        Schema::dropIfExists('insights_post_translations');
        Schema::dropIfExists('insights_posts');
    }
};