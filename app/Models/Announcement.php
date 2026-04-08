<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {
    protected $fillable = ['title','content','tag','image','image_path','is_active','archived_at','created_by'];
    protected $casts = ['archived_at' => 'datetime'];
}
