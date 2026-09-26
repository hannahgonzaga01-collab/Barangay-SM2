<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'resident_code',
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthday',
        'birthplace',
        'gender',
        'civil_status',
        'spouse_name',
        'occupation',
        'contact_number',
        'photo',
        'is_voter',
        'voter_status',
        'is_non_voter',
        'is_pwd',
        'is_senior',
        'is_single_parent',
        'is_student',
        'is_bedridden',
        'memberships',
        'address',
        'is_household_head',
        'household_id',
        'household_head_id',
        'relationship',
        'age',
        'archived_at',
        'archive_reason',
    ];

    protected $casts = [
        'memberships'       => 'array',
        'is_voter'          => 'boolean',
        'is_non_voter'      => 'boolean',
        'is_pwd'            => 'boolean',
        'is_senior'         => 'boolean',
        'is_single_parent'  => 'boolean',
        'is_student'        => 'boolean',
        'is_bedridden'      => 'boolean',
        'is_household_head' => 'boolean',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function householdMembers()
    {
        return $this->hasMany(Resident::class, 'household_head_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        $name = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? '')) ?: 'Resident';
        $fallback = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0E5393&color=fff&size=128&bold=true';

        if (!empty($this->photo)) {
            $storageFile = storage_path('app/public/' . ltrim($this->photo, '/'));
            $publicFile  = public_path('storage/' . ltrim($this->photo, '/'));
            if (file_exists($storageFile) || file_exists($publicFile)) {
                return asset('storage/' . ltrim($this->photo, '/'));
            }
        }

        return $fallback;
    }
}
