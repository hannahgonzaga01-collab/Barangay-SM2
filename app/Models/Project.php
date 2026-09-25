<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'start_date',
        'end_date',
        'completion_date',
        'status',
        'budget',
        'contractor_lead',
        'images',
        'image_path',
        'is_active',
        'is_archived',
        'archived_at',
    ];

    protected $casts = [
        'start_date'      => 'date',
        'end_date'        => 'date',
        'completion_date' => 'date',
        'budget'          => 'decimal:2',
        'images'          => 'array',
        'is_active'       => 'boolean',
        'is_archived'     => 'boolean',
        'archived_at'     => 'datetime',
    ];

    protected $appends = ['images_list', 'cover_image_url'];

    public function getCoverImageUrlAttribute(): string
    {
        if (!empty($this->image_path)) {
            $img = $this->image_path;
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                return $img;
            }
            if (str_starts_with($img, 'images/')) {
                return asset($img);
            }
            $clean = ltrim($img, '/');
            if (str_starts_with($clean, 'storage/')) {
                $clean = substr($clean, 8);
            }
            if (file_exists(public_path('storage/' . $clean)) || file_exists(storage_path('app/public/' . $clean))) {
                return asset('storage/' . $clean);
            }
            if (file_exists(public_path($clean))) {
                return asset($clean);
            }
        }

        $list = $this->images;
        if (!empty($list)) {
            $imgs = is_array($list) ? $list : json_decode($list, true);
            if (is_array($imgs) && !empty($imgs)) {
                $first = $imgs[0];
                if (str_starts_with($first, 'http://') || str_starts_with($first, 'https://')) {
                    return $first;
                }
                if (str_starts_with($first, 'images/')) {
                    return asset($first);
                }
                $clean = ltrim($first, '/');
                if (str_starts_with($clean, 'storage/')) {
                    $clean = substr($clean, 8);
                }
                if (file_exists(public_path('storage/' . $clean)) || file_exists(storage_path('app/public/' . $clean))) {
                    return asset('storage/' . $clean);
                }
                if (file_exists(public_path($clean))) {
                    return asset($clean);
                }
            }
        }

        if (stripos($this->category ?? '', 'drainage') !== false || stripos($this->title ?? '', 'drainage') !== false || stripos($this->title ?? '', 'canal') !== false) {
            return asset('images/canal.jpg');
        }

        if (stripos($this->category ?? '', 'clean') !== false || stripos($this->title ?? '', 'clean') !== false || stripos($this->category ?? '', 'environment') !== false) {
            return asset('images/cleanup.jpg');
        }

        return asset('images/canal.jpg');
    }

    public function getImagesListAttribute(): array
    {
        $cover = $this->cover_image_url;

        if (empty($this->images)) {
            return !empty($this->image_path) || $cover ? [$cover] : [];
        }

        $imgs = is_array($this->images) ? $this->images : json_decode($this->images, true);
        if (is_array($imgs) && count($imgs) > 0) {
            return array_map(function ($img) use ($cover) {
                if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                    return $img;
                }
                if (str_starts_with($img, 'images/')) {
                    return asset($img);
                }
                $clean = ltrim($img, '/');
                if (str_starts_with($clean, 'storage/')) {
                    $clean = substr($clean, 8);
                }
                if (file_exists(public_path('storage/' . $clean)) || file_exists(storage_path('app/public/' . $clean))) {
                    return asset('storage/' . $clean);
                }
                if (file_exists(public_path($clean))) {
                    return asset($clean);
                }
                return $cover;
            }, $imgs);
        }

        return [$cover];
    }
}
