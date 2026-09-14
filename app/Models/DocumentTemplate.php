<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class DocumentTemplate extends Model
{
    protected $table = 'document_templates';

    protected $fillable = [
        'doc_key',
        'title',
        'header_line1',
        'header_line2',
        'header_line3',
        'header_line4',
        'body_template',
        'captain_name',
        'captain_title',
        'footer_note',
        'custom_bg_path',
        'custom_logo_path',
        'show_header_logos',
        'is_custom',
    ];

    protected $casts = [
        'show_header_logos' => 'boolean',
        'is_custom' => 'boolean',
    ];

    /**
     * Retrieve all customized document templates, falling back to JSON storage if DB table does not exist.
     */
    public static function getAllKeyed(): array
    {
        $templates = [];

        try {
            if (Schema::hasTable('document_templates')) {
                foreach (self::all() as $item) {
                    $templates[$item->doc_key] = $item->toArray();
                }
                return $templates;
            }
        } catch (\Throwable $e) {
            // Fall through to JSON storage
        }

        // Fallback: Read from local JSON storage
        if (Storage::disk('local')->exists('document_templates.json')) {
            try {
                $content = Storage::disk('local')->get('document_templates.json');
                $decoded = json_decode($content, true);
                if (is_array($decoded)) {
                    return $decoded;
                }
            } catch (\Throwable $e) {}
        }

        return $templates;
    }

    /**
     * Get single template for a document key
     */
    public static function getByKey(string $docKey): ?array
    {
        $all = self::getAllKeyed();
        return $all[$docKey] ?? null;
    }

    /**
     * Save template data to DB and JSON fallback
     */
    public static function storeOrUpdate(string $docKey, array $data): array
    {
        $recordData = array_merge([
            'doc_key' => $docKey,
            'header_line1' => 'PROVINCE OF CAVITE',
            'header_line2' => 'CITY OF DASMARIÑAS',
            'header_line3' => 'BARANGAY SAN MIGUEL 2',
            'header_line4' => 'OFFICE OF THE SANGGUNIANG BARANGAY',
            'captain_name' => 'MARVIN M. BENIS',
            'captain_title' => 'PUNONG BARANGAY',
            'footer_note' => 'NOTE: THIS CERTIFICATION IS NOT VALID IF THERE ARE ERASURE AND WITHOUT DRY SEAL',
            'show_header_logos' => true,
            'is_custom' => true,
        ], $data);

        // Try DB first
        try {
            if (Schema::hasTable('document_templates')) {
                $model = self::updateOrCreate(['doc_key' => $docKey], $recordData);
                $recordData = $model->toArray();
            }
        } catch (\Throwable $e) {}

        // Always sync to JSON file as fallback
        try {
            $all = [];
            if (Storage::disk('local')->exists('document_templates.json')) {
                $decoded = json_decode(Storage::disk('local')->get('document_templates.json'), true);
                if (is_array($decoded)) $all = $decoded;
            }
            $all[$docKey] = $recordData;
            Storage::disk('local')->put('document_templates.json', json_encode($all, JSON_PRETTY_PRINT));
        } catch (\Throwable $e) {}

        return $recordData;
    }

    /**
     * Reset / remove customization
     */
    public static function resetKey(string $docKey): bool
    {
        try {
            if (Schema::hasTable('document_templates')) {
                self::where('doc_key', $docKey)->delete();
            }
        } catch (\Throwable $e) {}

        try {
            if (Storage::disk('local')->exists('document_templates.json')) {
                $all = json_decode(Storage::disk('local')->get('document_templates.json'), true);
                if (is_array($all) && isset($all[$docKey])) {
                    unset($all[$docKey]);
                    Storage::disk('local')->put('document_templates.json', json_encode($all, JSON_PRETTY_PRINT));
                }
            }
        } catch (\Throwable $e) {}

        return true;
    }
}
