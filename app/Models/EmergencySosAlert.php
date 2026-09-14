<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencySosAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resident_name',
        'contact_number',
        'home_address',
        'latitude',
        'longitude',
        'accuracy',
        'google_maps_url',
        'emergency_type',
        'message',
        'dispatched_units',
        'status',
        'responder_notes',
        'dispatched_at',
        'resolved_at',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'dispatched_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
