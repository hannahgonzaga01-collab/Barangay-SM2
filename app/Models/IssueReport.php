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
        'respondent_name',
        'respondent_address',
        'respondent_contact',
        'witness_name',
        'witness_contact',
        'evidence',
        'hearing_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
