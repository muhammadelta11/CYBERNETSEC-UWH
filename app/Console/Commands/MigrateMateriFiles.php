<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Materi;

class MigrateMateriFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'materi:migrate-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate existing materi files from public to local storage';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $publicDisk = Storage::disk('public');
        $localDisk = Storage::disk('local');

        // Get all files in public materi_files directory
        $publicFiles = $publicDisk->allFiles('materi_files');

        if (empty($publicFiles)) {
            $this->info('No existing files found in public storage.');
            return 0;
        }

        $this->info('Found ' . count($publicFiles) . ' files to migrate.');

        $migratedCount = 0;
        foreach ($publicFiles as $filePath) {
            // Ensure it's a file in materi_files
            if (strpos($filePath, 'materi_files/') === 0) {
                $content = $publicDisk->get($filePath);
                $localDisk->put($filePath, $content);
                $publicDisk->delete($filePath);

                // Update DB if needed; assuming url is already 'materi_files/filename.pdf'
                // No change needed for url field as relative path remains the same

                $migratedCount++;
                $this->info("Migrated: {$filePath}");
            }
        }

        // Optional: Update any urls that might have 'public/' prefix (if any)
        $updated = Materi::where('url', 'like', 'public/materi_files/%')
            ->update(['url' => DB::raw("REPLACE(url, 'public/', '')")]);

        if ($updated > 0) {
            $this->info("Updated {$updated} database records.");
        }

        $this->info("Migration completed. {$migratedCount} files moved to local storage.");
        return 0;
    }
}
