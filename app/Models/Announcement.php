<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {
    protected $fillable = ['title','content','tag','date','image','image_path','images','is_active','archived_at','created_by'];
    protected $casts = [
        'archived_at' => 'datetime',
        'images' => 'array',
    ];
    protected $appends = ['images_list'];

    public function getImagesListAttribute() {
        if (!empty($this->images) && is_array($this->images)) {
            return array_values(array_map(function($img) {
                return str_starts_with($img, 'http') ? $img : asset('storage/' . $img);
            }, $this->images));
        }
        if (!empty($this->image_path)) {
            return [str_starts_with($this->image_path, 'http') ? $this->image_path : asset('storage/' . $this->image_path)];
        }
        return [];
    }
}
