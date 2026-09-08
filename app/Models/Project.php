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

    public function getImagesListAttribute(): array
    {
        if (empty($this->images)) {
            return $this->image_path ? [asset('storage/' . $this->image_path)] : [];
        }

        $imgs = is_array($this->images) ? $this->images : json_decode($this->images, true);
        if (is_array($imgs)) {
            return array_map(function ($img) {
                if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                    return $img;
                }
                return asset('storage/' . ltrim($img, '/'));
            }, $imgs);
        }

        return [$this->images];
    }
}
