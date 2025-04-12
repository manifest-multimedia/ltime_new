<?php

namespace App\Console\Commands;

use App\Services\InsightsDataMigrationService;
use Illuminate\Console\Command;

class MigrateInsightsBlogData extends Command
{
    protected $signature = 'insights:migrate-blog-data';
    protected $description = 'Migrate data from Binshops blog to Insights blog';

    protected $migrationService;

    public function __construct(InsightsDataMigrationService $migrationService)
    {
        parent::__construct();
        $this->migrationService = $migrationService;
    }

    public function handle()
    {
        $this->info('Starting blog data migration...');

        try {
            $this->migrationService->migrateAll();
            $this->info('Blog data migration completed successfully!');
            return 0;
        } catch (\Exception $e) {
            $this->error('Blog data migration failed: ' . $e->getMessage());
            return 1;
        }
    }
}