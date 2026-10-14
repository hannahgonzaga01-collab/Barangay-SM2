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
        $hasCustomDiskImage = function(?string $img): ?string {
            if (!$img) return null;
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                return $img;
            }
            if (str_starts_with($img, 'images/') || str_starts_with($img, 'assets/')) {
                return asset($img);
            }
            $clean = ltrim(preg_replace('#^storage/#', '', $img), '/');
            if (file_exists(storage_path('app/public/' . $clean)) || file_exists(public_path('storage/' . $clean)) || file_exists(public_path($clean))) {
                return asset('storage/' . $clean);
            }
            return null;
        };

        if ($valid = $hasCustomDiskImage($this->image_path)) {
            return $valid;
        }

        if (!empty($this->images)) {
            $imgs = is_array($this->images) ? $this->images : json_decode($this->images, true);
            if (is_array($imgs) && !empty($imgs)) {
                if ($valid = $hasCustomDiskImage($imgs[0])) {
                    return $valid;
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
            return $cover ? [$cover] : [];
        }

        $imgs = is_array($this->images) ? $this->images : json_decode($this->images, true);
        if (is_array($imgs) && count($imgs) > 0) {
            $validList = [];
            foreach ($imgs as $img) {
                if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                    $validList[] = $img;
                } elseif (str_starts_with($img, 'images/') || str_starts_with($img, 'assets/')) {
                    $validList[] = asset($img);
                } else {
                    $clean = ltrim(preg_replace('#^storage/#', '', $img), '/');
                    if (file_exists(storage_path('app/public/' . $clean)) || file_exists(public_path('storage/' . $clean)) || file_exists(public_path($clean))) {
                        $validList[] = asset('storage/' . $clean);
                    }
                }
            }
            if (!empty($validList)) {
                return $validList;
            }
        }

        return $cover ? [$cover] : [];
    }
}
