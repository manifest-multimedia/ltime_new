<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('insights_comments', function (Blueprint $table) {
            // drop if table exists
            if (Schema::hasTable('insights_comments')) {
                Schema::dropIfExists('insights_comments');
            }
            $table->increments('id');
            $table->unsignedInteger("post_id")->index();
            $table->unsignedBigInteger("user_id")->nullable()->index()->comment("if user was logged in");
            $table->string("ip")->nullable()->comment("if enabled in the config file");
            $table->string("author_name")->nullable()->comment("if not logged in");
            $table->text("comment")->comment("the comment body");
            $table->boolean("approved")->default(true);
            $table->string("author_email")->nullable();
            $table->string("author_website")->nullable();
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('insights_posts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('insights_uploaded_photos', function (Blueprint $table) {
            // drop if table exists
            if (Schema::hasTable('insights_uploaded_photos')) {
                Schema::dropIfExists('insights_uploaded_photos');
            }
            $table->increments('id');
            $table->text("uploaded_images")->nullable();
            $table->string("image_title")->nullable();
            $table->string("source")->default("unknown");
            $table->unsignedBigInteger("uploader_id")->nullable()->index();
            $table->timestamps();

            $table->foreign('uploader_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('insights_comments');
        Schema::dropIfExists('insights_uploaded_photos');
    }
};