<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = ['title','description','location','day_label','frequency','time_range','tag','image','image_path','is_active','archived_at','created_by'];
    protected $casts = ['archived_at' => 'datetime'];
}
