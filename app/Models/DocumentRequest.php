<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'guest_first_name', 'guest_last_name', 'guest_email', 'id_proof',
        'document_type', 'purpose', 'address', 'contact', 'age', 'birthday',
        'blk', 'lot', 'move_date', 'landlord', 'family_members',
        'ward_name', 'ward_age', 'ward_relation', 'partner_name',
        'living_since', 'claimant_name', 'claimant_relation',
        'claimant_first_name', 'claimant_middle_name', 'claimant_last_name',
        'claimant_type', 'authorization_letter_path', 'authorized_id_path',
        'disapproval_reason',
        'birth_month', 'birth_year', 'child_name', 'father_name',
        'mother_name', 'birth_attendant', 'born_from', 'residing_since',
        'status', 'admin_notes', 'notified_at',
        'appointment_date', 'appointment_time',
        'reschedule_count',
        'pickup_date', 'pickup_time', 'personnel_in_charge', 'alternate_personnel',
    ];

    protected $casts = [
        'notified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'Pending',
            'processing' => 'Processing',
            'ready'      => 'Ready for Pick-up',
            'released'   => 'Released',
            default      => ucfirst($this->status),
        };
    }
}
