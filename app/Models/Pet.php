<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'resident_id',
        'pet_name',
        'pet_photo',
        'photo_updated_at',
        'pet_type',
        'breed',
        'age',
        'months',
        'quantity',
        'vaccine_status',
        'vaccine_proof_path',
        'last_vaccine_date',
        'vaccine_proof',
        'vaccination_status',
        'rejection_reason',
        'status',
        'is_archived',
    ];

    protected $casts = [
        'photo_updated_at' => 'datetime',
    ];

    // Relationship — pet belongs to a resident
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
