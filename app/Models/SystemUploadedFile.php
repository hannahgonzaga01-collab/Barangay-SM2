<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class SystemUploadedFile extends Model
{
    protected $fillable = [
        'path',
        'mime_type',
        'content',
    ];

    /**
     * Save an uploaded file or file on disk to DB for permanent persistence across deployments.
     */
    public static function persist(string $path, $file): ?self
    {
        try {
            $cleanPath = ltrim(preg_replace('#^storage/#', '', $path), '/');
            $data = null;
            $mime = null;

            if ($file instanceof UploadedFile) {
                $mime = $file->getClientMimeType() ?: $file->getMimeType();
                $data = base64_encode(file_get_contents($file->getRealPath()));
            } elseif (is_string($file) && file_exists($file)) {
                $mime = @mime_content_type($file) ?: 'application/octet-stream';
                $data = base64_encode(file_get_contents($file));
            } elseif (is_string($file) && !empty($file)) {
                $data = base64_encode($file);
                $mime = 'image/jpeg';
            }

            if (!$data) {
                return null;
            }

            return self::updateOrCreate(
                ['path' => $cleanPath],
                [
                    'mime_type' => $mime,
                    'content'   => $data,
                ]
            );
        } catch (\Throwable $e) {
            Log::warning("SystemUploadedFile persist error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Retrieve file content and write to disk if missing on container.
     */
    public static function restoreToDisk(string $cleanPath, string $targetDiskPath): ?string
    {
        try {
            $record = self::where('path', $cleanPath)->first();
            if (!$record || empty($record->content)) {
                return null;
            }

            $binary = base64_decode($record->content);
            if (!$binary) {
                return null;
            }

            @mkdir(dirname($targetDiskPath), 0775, true);
            @file_put_contents($targetDiskPath, $binary);
            return $binary;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
