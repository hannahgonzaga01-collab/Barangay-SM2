<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'role',
        'status',
        'is_active',
        'contact_number',
        'birthday',
        'birthplace',
        'gender',
        'civil_status',
        'spouse_name',
        'address',
        'occupation',
        'photo',
        'resident_code',
        'is_voter',
        'precinct_no',
        'voter_id_photo',
        'voter_status',
        'decline_reason',
        'is_non_voter',
        'is_senior',
        'is_pwd',
        'is_single_parent',
        'is_student',
        'is_bedridden',
        'is_third_gen',
        'security_question',
        'security_answer',
        'password_history',
        'photo_updated_at',
        'id_type',
        'last_login_at',
        'otp',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'photo_updated_at' => 'datetime',
            'last_login_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
            'is_voter' => 'boolean',
            'is_non_voter' => 'boolean',
            'is_senior' => 'boolean',
            'is_pwd' => 'boolean',
            'is_single_parent' => 'boolean',
            'is_student' => 'boolean',
            'is_bedridden' => 'boolean',
            'is_third_gen' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function documentRequests()
    {
        return $this->hasMany(\App\Models\DocumentRequest::class, 'user_id');
    }

    public function issueReports()
    {
        return $this->hasMany(\App\Models\IssueReport::class, 'user_id');
    }

    public function digitalId()
    {
        return $this->hasOne(\App\Models\DigitalId::class, 'user_id');
    }

    public function pets()
    {
        return $this->hasManyThrough(\App\Models\Pet::class, \App\Models\Resident::class, 'user_id', 'resident_id', 'id', 'id');
    }

    public function getPetsAttribute()
    {
        $residentId = $this->resident?->id ?: \App\Models\Resident::where('user_id', $this->id)->value('id');
        $userId = $this->id;

        return \App\Models\Pet::where('is_archived', false)
            ->where(function($q) use ($residentId, $userId) {
                if ($residentId) {
                    $q->where('resident_id', $residentId);
                    if ($userId) {
                        $q->orWhere('resident_id', $userId);
                    }
                } elseif ($userId) {
                    $q->where('resident_id', $userId);
                }
            })
            ->latest()
            ->get();
    }

    public function resident()
    {
        return $this->hasOne(\App\Models\Resident::class, 'user_id');
    }

    public function getFamilyMembersAttribute()
    {
        $residentId = $this->resident?->id ?: \App\Models\Resident::where('user_id', $this->id)->value('id');
        if (!$residentId && $this->resident_code) {
            $residentId = \App\Models\Resident::where('resident_code', $this->resident_code)->value('id');
        }

        if (!$residentId) {
            return collect();
        }

        $res = \App\Models\Resident::find($residentId);
        $headId = ($res && $res->household_head_id) ? $res->household_head_id : $residentId;

        $members = \App\Models\Resident::where('household_head_id', $headId)
            ->where('id', '!=', $residentId)
            ->get();

        if ($res && $res->household_head_id && $headId !== $residentId) {
            $headMember = \App\Models\Resident::find($headId);
            if ($headMember && !$members->contains('id', $headMember->id)) {
                $headMember->relationship = $headMember->relationship ?: 'Household Head';
                $members->prepend($headMember);
            }
        }

        return $members;
    }


    public function getProfilePhotoUrlAttribute(): string
    {
        $name = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? '')) ?: ($this->name ?? 'User');
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

    public function recordPasswordHistory(string $hash)
    {
        $history = [];
        if ($this->password_history) {
            $history = is_array($this->password_history)
                ? $this->password_history
                : (json_decode($this->password_history, true) ?? []);
        }

        array_unshift($history, $hash);

        if (count($history) > 3) {
            $history = array_slice($history, 0, 3);
        }

        $this->update(['password_history' => json_encode($history)]);
    }
}
