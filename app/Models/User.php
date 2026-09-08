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
        'security_question',
        'security_answer',
        'password_history',
        'photo_updated_at'
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
            'password' => 'hashed',
            'birthday' => 'date',
            'is_voter' => 'boolean',
            'is_non_voter' => 'boolean',
            'is_senior' => 'boolean',
            'is_pwd' => 'boolean',
            'is_single_parent' => 'boolean',
            'is_student' => 'boolean',
            'is_bedridden' => 'boolean',
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
        return $this->hasMany(\App\Models\Pet::class, 'resident_id');
    }

    public function resident()
    {
        return $this->hasOne(\App\Models\Resident::class, 'user_id');
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
