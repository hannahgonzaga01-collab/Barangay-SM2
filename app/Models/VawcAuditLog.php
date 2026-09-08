<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VawcAuditLog extends Model
{
    use HasFactory;

    protected $table = 'vawc_audit_logs';

    protected $fillable = [
        'user_id',
        'staff_name',
        'staff_role',
        'action',
        'case_id',
        'case_code',
        'details',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function issue()
    {
        return $this->belongsTo(IssueReport::class, 'case_id');
    }

    public static function log(string $action, ?int $caseId = null, ?string $caseCode = null, ?string $details = null)
    {
        $user = auth()->user();
        $staffName = $user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : 'System / Guest';
        if (empty(trim($staffName))) {
            $staffName = $user->name ?? 'VAWC Staff';
        }
        $staffRole = $user->role ?? 'Staff';

        return self::create([
            'user_id'    => $user?->id,
            'staff_name' => $staffName,
            'staff_role' => $staffRole,
            'action'     => $action,
            'case_id'    => $caseId,
            'case_code'  => $caseCode,
            'details'    => $details,
            'ip_address' => request()->ip(),
        ]);
    }
}
