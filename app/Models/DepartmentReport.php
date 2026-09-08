<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentReport extends Model
{
    protected $fillable = [
        'department',
        'report_title',
        'reporting_period',
        'report_data',
        'template_file',
        'submitted_by',
        'submitted_role',
        'status',
    ];

    protected $casts = [
        'report_data' => 'array',
    ];
}
