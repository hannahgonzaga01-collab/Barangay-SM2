<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'resident_id',
        'pet_name',
        'pet_type',
        'breed',
        'age',
        'months',
        'quantity',
        'vaccine_status',
        'last_vaccine_date',
    ];

    // Relationship — pet belongs to a resident
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
