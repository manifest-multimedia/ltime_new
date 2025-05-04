<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Keep the latest versions and remove duplicates
        // Note: In a real production environment, you'd need to be more careful
        // This is just to clean up the duplicate migrations we observed
        
        // This migration just serves as documentation - the actual cleanup
        // should be done manually to avoid data loss
        
        // Recommended approach - manually review and keep one set of migrations:
        // - 2025_05_02_162523_create_cms_pages_table.php
        // - 2025_05_02_162532_create_cms_sections_table.php
        // - 2025_05_02_162546_create_cms_content_blocks_table.php
        
        // And delete these duplicates:
        // - 2025_05_02_152116_create_cms_pages_table.php
        // - 2025_05_02_152434_create_cms_sections_table.php
        // - 2025_05_02_152448_create_cms_content_blocks_table.php
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No action needed in down migration
    }
};
