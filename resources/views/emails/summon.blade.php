<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Arial', sans-serif; color: #111; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px; background-color: #f8fafc; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #0E5393; padding-bottom: 15px; }
        .header h2 { color: #0E5393; margin: 0; text-transform: uppercase; }
        .content { margin-bottom: 20px; background: #fff; padding: 20px; border-radius: 6px; border: 1px solid #e2e8f0; }
        .footer { font-size: 12px; color: #64748b; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 15px; }
        .case-dtl { background: #eff6ff; padding: 12px; border-left: 4px solid #0E5393; margin: 15px 0; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Notice of Hearing (Summons)</h2>
            <p style="margin: 5px 0 0; font-size: 14px; font-weight: bold;">Lupong Tagapamayapa - Barangay San Miguel II</p>
        </div>
        
        <div class="content">
            <p>Dear <span class="bold">{{ $issue->complainant_name ?? 'Resident' }}</span>,</p>
            
            <p>This is an official notice regarding the complaint (Blotter / Issue Report) you have filed with the barangay.</p>
            
            <p>Please be informed that a schedule for your Mediation / Hearing has been set. You are hereby requested to attend at the specified date and place to discuss and resolve the aforementioned issue amicably.</p>

            <div class="case-dtl">
                <p style="margin:0 0 5px;"><strong>Case Type:</strong> {{ $issue->issue_type }}</p>
                <p style="margin:0 0 5px;"><strong>Respondent:</strong> {{ $issue->respondent_name ?? 'N/A' }}</p>
                <p style="margin:0 0 5px;"><strong>Schedule Date & Time:</strong> {{ \Carbon\Carbon::parse($issue->hearing_date)->format('F d, Y - h:i A') }}</p>
                <p style="margin:0;"><strong>Location:</strong> Barangay Hall, San Miguel II</p>
            </div>
            
            <p>Please be reminded that your attendance at the scheduled mediation is crucial for achieving a peaceful resolution.</p>

            <p style="margin-top:20px;">Sincerely,<br>
            <strong>Lupong Tagapamayapa</strong><br>
            Barangay San Miguel II</p>
        </div>
        
        <div class="footer">
            <p>This is an automatically generated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} Barangay SM2 Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
