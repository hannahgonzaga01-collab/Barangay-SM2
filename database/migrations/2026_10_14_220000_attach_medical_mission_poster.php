<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use App\Models\SystemUploadedFile;
use App\Models\Event;
use App\Models\Announcement;

return new class extends Migration
{
    public function up(): void
    {
        $posterPath = public_path('images/medical_mission.jpg');
        if (!file_exists($posterPath)) {
            $posterPath = storage_path('app/public/events/medical_mission.jpg');
        }

        if (file_exists($posterPath)) {
            // Persist to SystemUploadedFile
            SystemUploadedFile::persist('events/medical_mission.jpg', $posterPath);
            SystemUploadedFile::persist('announcements/medical_mission.jpg', $posterPath);
            SystemUploadedFile::persist('images/medical_mission.jpg', $posterPath);
        }

        try {
            // Attach to Event records matching Medical or Mission
            $events = Event::where('title', 'LIKE', '%medical%')
                ->orWhere('title', 'LIKE', '%Medical%')
                ->orWhere('title', 'LIKE', '%mission%')
                ->orWhere('title', 'LIKE', '%Mission%')
                ->get();

            foreach ($events as $evt) {
                if ($evt->image_path && file_exists($posterPath)) {
                    SystemUploadedFile::persist($evt->image_path, $posterPath);
                }
                $evt->update([
                    'image_path' => 'events/medical_mission.jpg',
                    'images'     => ['events/medical_mission.jpg'],
                ]);
            }

            // Attach to Announcement records matching Medical or Mission
            $announcements = Announcement::where('title', 'LIKE', '%medical%')
                ->orWhere('title', 'LIKE', '%Medical%')
                ->orWhere('title', 'LIKE', '%mission%')
                ->orWhere('title', 'LIKE', '%Mission%')
                ->get();

            foreach ($announcements as $ann) {
                if ($ann->image_path && file_exists($posterPath)) {
                    SystemUploadedFile::persist($ann->image_path, $posterPath);
                }
                $ann->update([
                    'image_path' => 'announcements/medical_mission.jpg',
                    'images'     => ['announcements/medical_mission.jpg'],
                ]);
            }
        } catch (\Throwable $e) {}

        // Invalidate public portal data cache
        try {
            Cache::forget('resident_portal_public_data');
        } catch (\Throwable $e) {}
    }

    public function down(): void
    {
        // Non-destructive
    }
};
