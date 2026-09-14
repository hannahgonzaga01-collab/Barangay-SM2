<?php

namespace App\Http\Controllers;

use App\Models\DocumentTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentTemplateController extends Controller
{
    /**
     * Update or create a customized template for a specific document key.
     */
    public function update(Request $request, string $key)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'header_line1' => 'nullable|string|max:255',
            'header_line2' => 'nullable|string|max:255',
            'header_line3' => 'nullable|string|max:255',
            'header_line4' => 'nullable|string|max:255',
            'body_template' => 'nullable|string',
            'captain_name' => 'nullable|string|max:255',
            'captain_title' => 'nullable|string|max:255',
            'footer_note' => 'nullable|string',
            'show_header_logos' => 'nullable|in:0,1,true,false',
            'custom_bg' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'custom_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $existing = DocumentTemplate::getByKey($key) ?? [];

        $data = [
            'title' => $request->filled('title') ? $request->title : ($existing['title'] ?? null),
            'header_line1' => $request->filled('header_line1') ? $request->header_line1 : ($existing['header_line1'] ?? 'PROVINCE OF CAVITE'),
            'header_line2' => $request->filled('header_line2') ? $request->header_line2 : ($existing['header_line2'] ?? 'CITY OF DASMARIÑAS'),
            'header_line3' => $request->filled('header_line3') ? $request->header_line3 : ($existing['header_line3'] ?? 'BARANGAY SAN MIGUEL 2'),
            'header_line4' => $request->filled('header_line4') ? $request->header_line4 : ($existing['header_line4'] ?? 'OFFICE OF THE SANGGUNIANG BARANGAY'),
            'body_template' => $request->input('body_template', $existing['body_template'] ?? ''),
            'captain_name' => $request->filled('captain_name') ? $request->captain_name : ($existing['captain_name'] ?? 'MARVIN M. BENIS'),
            'captain_title' => $request->filled('captain_title') ? $request->captain_title : ($existing['captain_title'] ?? 'PUNONG BARANGAY'),
            'footer_note' => $request->filled('footer_note') ? $request->footer_note : ($existing['footer_note'] ?? 'NOTE: THIS CERTIFICATION IS NOT VALID IF THERE ARE ERASURE AND WITHOUT DRY SEAL'),
            'show_header_logos' => $request->has('show_header_logos') ? filter_var($request->show_header_logos, FILTER_VALIDATE_BOOLEAN) : ($existing['show_header_logos'] ?? true),
            'is_custom' => true,
        ];

        // Handle custom background/letterhead upload
        if ($request->hasFile('custom_bg')) {
            $path = $request->file('custom_bg')->store('templates/backgrounds', 'public');
            $data['custom_bg_path'] = $path;
        } elseif (isset($existing['custom_bg_path'])) {
            $data['custom_bg_path'] = $existing['custom_bg_path'];
        }

        // Handle custom logo upload
        if ($request->hasFile('custom_logo')) {
            $path = $request->file('custom_logo')->store('templates/logos', 'public');
            $data['custom_logo_path'] = $path;
        } elseif (isset($existing['custom_logo_path'])) {
            $data['custom_logo_path'] = $existing['custom_logo_path'];
        }

        // If user requested to clear background
        if ($request->boolean('clear_bg')) {
            $data['custom_bg_path'] = null;
        }

        $saved = DocumentTemplate::storeOrUpdate($key, $data);

        return response()->json([
            'success' => true,
            'message' => 'Document template updated successfully.',
            'template' => $saved,
        ]);
    }

    /**
     * Reset a document template back to system default.
     */
    public function reset(string $key)
    {
        DocumentTemplate::resetKey($key);

        return response()->json([
            'success' => true,
            'message' => 'Document template reset to default.',
        ]);
    }

    /**
     * Get all templates as JSON
     */
    public function all()
    {
        return response()->json([
            'success' => true,
            'templates' => DocumentTemplate::getAllKeyed(),
        ]);
    }
}
