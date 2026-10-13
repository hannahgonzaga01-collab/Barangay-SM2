<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalId extends Model
{
    protected $fillable = [
        'user_id',
        'contact_person',
        'contact_person_number',
        'contact_person_address',
        'status',
        'id_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
