<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    protected $fillable = [
        'name', 'department', 'position', 'photo',
        'term_start', 'term_end', 'is_active',
    ];
}
