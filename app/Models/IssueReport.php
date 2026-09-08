<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'issue_type',
        'description',
        'location',
        'incident_date',
        'contact',
        'status',
        'admin_notes',
        'admin_summary',
        'department',
        'complainant_name',
        'complainant_age',
        'complainant_gender',
        'complainant_address',
        'is_on_behalf',
        'victim_name',
        'victim_age',
        'victim_gender',
        'victim_relationship',
        'respondent_name',
        'respondent_address',
        'respondent_contact',
        'witness_name',
        'witness_contact',
        'evidence',
        'official_document',
        'official_document_name',
        'hearing_date',
        'rejection_reason',
        'is_restricted',
        'transfer_count',
        'transfer_reason',
        'guest_first_name',
        'guest_last_name',
        'guest_email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}