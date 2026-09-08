<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatrolSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'team_name',
        'personnel_names',
        'schedule_date',
        'patrol_time',
        'status',
        'image_path',
    ];
}
