<!DOCTYPE html>
<html>
<head>
    <title>Voter ID Verification</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8fafc; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 10px; border-top: 5px solid #0E5393; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h2 { color: #0f172a; margin-top: 0; }
        p { color: #475569; font-size: 14px; line-height: 1.6; }
        .status-box { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .status-approved { background: #dcfce7; border: 1px solid #22c55e; color: #166534; }
        .status-declined { background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; }
        .footer { margin-top: 30px; font-size: 12px; color: #94a3b8; text-align: center; border-top: 1px solid #f1f5f9; padding-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello, {{ $user->first_name }}!</h2>
        
        @if($status === 'approved')
            <div class="status-box status-approved">
                <strong><i class="fas fa-check-circle"></i> Verification Approved!</strong>
                <p style="color: inherit; margin: 5px 0 0;">Your uploaded Voter ID has been verified successfully. Your status is now updated to registered voter.</p>
            </div>
            <p>Thank you for ensuring your records in our Barangay system are accurate.</p>
        @else
            <div class="status-box status-declined">
                <strong><i class="fas fa-exclamation-circle"></i> Verification Declined</strong>
                <p style="color: inherit; margin: 5px 0 0;">Unfortunately, we could not verify the Voter ID you uploaded.</p>
            </div>
            
            <p><strong>Reason provided by the Office:</strong></p>
            <blockquote style="border-left: 4px solid #ef4444; margin-left: 0; padding-left: 15px; color: #1e293b; font-style: italic; background: #f8fafc; padding: 10px 15px;">
                {{ $reason }}
            </blockquote>
            
            <p>Please log in to your resident portal account to upload a valid ID or document.</p>
        @endif
        
        <p>Best regards,<br><strong>Barangay Office Administration</strong></p>
        
        <div class="footer">
            This is an automated message from the Barangay Management System. Please do not reply.
        </div>
    </div>
</body>
</html>
