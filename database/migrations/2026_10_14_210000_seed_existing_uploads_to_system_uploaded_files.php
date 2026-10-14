<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use App\Models\SystemUploadedFile;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Project;
use App\Models\Official;

return new class extends Migration
{
    public function up(): void
    {
        $publicStorage = storage_path('app/public');
        if (File::isDirectory($publicStorage)) {
            $allFiles = File::allFiles($publicStorage);
            foreach ($allFiles as $file) {
                $relPath = str_replace('\\', '/', $file->getRelativePathname());
                if (!SystemUploadedFile::where('path', $relPath)->exists()) {
                    SystemUploadedFile::persist($relPath, $file->getRealPath());
                }
            }
        }

        // Also check models and ensure any referenced image files are in SystemUploadedFile
        $persistIfOnDisk = function(?string $path) use ($publicStorage) {
            if (!$path) return;
            $clean = ltrim(preg_replace('#^storage/#', '', $path), '/');
            if (str_starts_with($clean, 'images/') || str_starts_with($clean, 'assets/')) return;
            $fullPath = $publicStorage . '/' . $clean;
            if (file_exists($fullPath) && !SystemUploadedFile::where('path', $clean)->exists()) {
                SystemUploadedFile::persist($clean, $fullPath);
            }
        };

        try {
            foreach (Event::all() as $evt) {
                $persistIfOnDisk($evt->image_path);
                if (is_array($evt->images)) {
                    foreach ($evt->images as $img) {
                        $persistIfOnDisk($img);
                    }
                }
            }

            foreach (Announcement::all() as $ann) {
                $persistIfOnDisk($ann->image_path);
                if (is_array($ann->images)) {
                    foreach ($ann->images as $img) {
                        $persistIfOnDisk($img);
                    }
                }
            }

            foreach (Project::all() as $proj) {
                $persistIfOnDisk($proj->image_path);
                if (is_array($proj->images)) {
                    foreach ($proj->images as $img) {
                        $persistIfOnDisk($img);
                    }
                }
            }

            foreach (Official::all() as $off) {
                $persistIfOnDisk($off->photo);
            }
        } catch (\Throwable $e) {}

        // Invalidate public portal cache
        Cache::forget('resident_portal_public_data');
    }

    public function down(): void
    {
        // Non-destructive: no action needed on rollback
    }
};
