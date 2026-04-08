<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidentMessage extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'resident_code',
        'subject', 'message', 'admin_reply',
        'read_at', 'replied_at',
    ];

    protected $casts = [
        'read_at'    => 'datetime',
        'replied_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
