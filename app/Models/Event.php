<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = ['title','description','location','day_label','frequency','time_range','tag','image','image_path','images','is_active','archived_at','created_by'];
    protected $casts = [
        'archived_at' => 'datetime',
        'images' => 'array',
    ];
    protected $appends = ['images_list'];

    public function getImagesListAttribute() {
        $resolve = function($img) {
            if (!$img) return null;
            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) return $img;
            if (str_starts_with($img, 'images/') || str_starts_with($img, 'assets/') || str_starts_with($img, 'storage/')) return asset($img);
            return asset('storage/' . $img);
        };

        if (!empty($this->images) && is_array($this->images)) {
            return array_values(array_filter(array_map($resolve, $this->images)));
        }
        if (!empty($this->image_path)) {
            $url = $resolve($this->image_path);
            return $url ? [$url] : [];
        }
        return [];
    }
}
