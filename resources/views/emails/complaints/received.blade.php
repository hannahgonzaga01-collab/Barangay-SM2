<x-mail::message>
# Complaint Report Received

Hello **{{ $report->complainant_name }}**,

We have received your complaint report regarding **{{ $report->issue_type }}**.

**Important Notice:**
@if(!$report->user_id)
<div style="background:#fee2e2; border:1px solid #fca5a5; padding:15px; border-radius:8px; color:#991b1b; font-weight:bold; margin-bottom:15px;">
    ⚠️ ACTION REQUIRED: Since you are not a registered resident, you MUST visit the Barangay Hall personally for verification and to settle the processing fee before we can act on your report.
</div>
@else
To process your report, please visit the **Barangay Hall personally for payment and verification** of your complaint. Your report will be on hold until the processing fee is settled.
@endif

**Report Details:**
- **Incident Date:** {{ $report->incident_date ?? 'N/A' }}
- **Location:** {{ $report->location ?? 'N/A' }}
- **Status:** Pending Payment / Verification

Thanks,<br>
**Barangay San Miguel II Secretariat**
</x-mail::message>
