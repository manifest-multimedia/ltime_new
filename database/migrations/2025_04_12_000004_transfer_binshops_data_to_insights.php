<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Transfer categories
        DB::statement('INSERT INTO insights_categories (id, created_by, parent_id, lft, rgt, depth, created_at, updated_at)
            SELECT id, created_by, parent_id, lft, rgt, depth, created_at, updated_at
            FROM binshops_categories');

        // Transfer category translations
        DB::statement('INSERT INTO insights_category_translations (category_id, category_name, slug, category_description, lang_id, created_at, updated_at)
            SELECT category_id, category_name, slug, category_description, lang_id, created_at, updated_at
            FROM binshops_category_translations');

        // Transfer posts
        DB::statement('INSERT INTO insights_posts (id, user_id, posted_at, is_published, created_at, updated_at)
            SELECT id, user_id, posted_at, is_published, created_at, updated_at
            FROM binshops_posts');

        // Transfer post translations
        DB::statement('INSERT INTO insights_post_translations (post_id, slug, title, subtitle, meta_desc, seo_title, post_body, short_description, use_view_file, image_large, image_medium, image_thumbnail, lang_id, created_at, updated_at)
            SELECT post_id, slug, title, subtitle, meta_desc, seo_title, post_body, short_description, use_view_file, image_large, image_medium, image_thumbnail, lang_id, created_at, updated_at
            FROM binshops_post_translations');

        // Transfer post categories relationships
        DB::statement('INSERT INTO insights_post_categories (post_id, category_id)
            SELECT post_id, category_id
            FROM binshops_post_categories');

        // Transfer comments
        DB::statement('INSERT INTO insights_comments (post_id, user_id, ip, author_name, comment, approved, author_email, author_website, created_at, updated_at)
            SELECT post_id, user_id, ip, author_name, comment, approved, author_email, author_website, created_at, updated_at
            FROM binshops_comments');

        // Transfer uploaded photos
        DB::statement('INSERT INTO insights_uploaded_photos (uploaded_images, image_title, source, uploader_id, created_at, updated_at)
            SELECT uploaded_images, image_title, source, uploader_id, created_at, updated_at
            FROM binshops_uploaded_photos');
    }

    public function down()
    {
        DB::statement('DELETE FROM insights_uploaded_photos');
        DB::statement('DELETE FROM insights_comments');
        DB::statement('DELETE FROM insights_post_categories');
        DB::statement('DELETE FROM insights_post_translations');
        DB::statement('DELETE FROM insights_posts');
        DB::statement('DELETE FROM insights_category_translations');
        DB::statement('DELETE FROM insights_categories');
    }
};