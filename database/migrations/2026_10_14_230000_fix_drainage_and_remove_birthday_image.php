<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use App\Models\SystemUploadedFile;
use App\Models\Project;
use App\Models\Announcement;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ensure Drainage Rehabilitation has canal.jpg restored permanently
        $canalPath = public_path('images/canal.jpg');
        if (file_exists($canalPath)) {
            SystemUploadedFile::persist('projects/canal.jpg', $canalPath);
            SystemUploadedFile::persist('images/canal.jpg', $canalPath);
        }

        try {
            Project::where('title', 'LIKE', '%drainage%')
                ->orWhere('title', 'LIKE', '%Drainage%')
                ->orWhere('title', 'LIKE', '%canal%')
                ->orWhere('title', 'LIKE', '%Canal%')
                ->orWhere('category', 'LIKE', '%drainage%')
                ->orWhere('category', 'LIKE', '%Drainage%')
                ->update([
                    'image_path' => 'images/canal.jpg',
                    'images'     => ['images/canal.jpg'],
                ]);
        } catch (\Throwable $e) {}

        // 2. Remove image completely from Birthday Cash Gifts / Unclaimed announcement
        try {
            Announcement::where('title', 'LIKE', '%Birthday%')
                ->orWhere('title', 'LIKE', '%Cash Gift%')
                ->orWhere('title', 'LIKE', '%Cash Gifts%')
                ->orWhere('title', 'LIKE', '%Unclaimed%')
                ->update([
                    'image_path' => null,
                    'images'     => null,
                ]);

            SystemUploadedFile::where('path', 'LIKE', '%birthday%')->delete();
        } catch (\Throwable $e) {}

        // 3. Clear public portal cache
        try {
            Cache::forget('resident_portal_public_data');
        } catch (\Throwable $e) {}
    }

    public function down(): void
    {
        // Non-destructive
    }
};
