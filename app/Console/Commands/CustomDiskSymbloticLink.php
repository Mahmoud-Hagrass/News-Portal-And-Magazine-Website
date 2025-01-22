<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CustomDiskSymbloticLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:custom-link {storage-folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link for custom disk';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $argument = $this->argument('storage-folder');

        $source = storage_path($argument);
        $target = public_path('storage' . DIRECTORY_SEPARATOR . $argument);

        $this->info("Source: {$source}");
        $this->info("Target: {$target}");

        // Ensure the parent directory exists
        $parentDirectory = public_path('storage');
        if (!file_exists($parentDirectory)) {
            File::makeDirectory($parentDirectory, 0755, true);
        }

        // Check if the source directory exists
        if (!file_exists($source)) {
            return $this->error("The source directory [{$source}] does not exist.");
        }

        // Check if the target directory already exists
        if (file_exists($target)) {
            return $this->error("The target directory [{$target}] already exists.");
        }

        // Create the symbolic link
        try {
            File::link($source, $target);
            $this->info("The [{$argument}] directory has been linked.");
        } catch (\Exception $e) {
            $this->error("Failed to create symbolic link: " . $e->getMessage());
        }
    }
}
