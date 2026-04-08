<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PNP Referral Document - {{ 'VAWC-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 0; background: #e2e8f0; }
        .page { background: white; width: 210mm; min-height: 297mm; margin: 0 auto; padding: 20mm; box-sizing: border-box; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        @media print {
            body { background: white; }
            .page { width: 100%; height: auto; box-shadow: none; padding: 0; margin: 0; }
        }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h1 { font-size: 18px; text-transform: uppercase; margin: 0 0 5px 0; }
        .header h2 { font-size: 14px; font-weight: normal; margin: 0; }
        .title { text-align: center; font-size: 16px; font-weight: bold; text-decoration: underline; margin: 20px 0; text-transform: uppercase; }
        .row { display: flex; margin-bottom: 10px; }
        .col-title { width: 160px; font-weight: bold; font-size: 14px; }
        .col-value { flex: 1; border-bottom: 1px dotted #000; font-size: 14px; }
        .narration-box { border: 1px solid #000; padding: 15px; margin-top: 10px; min-height: 200px; font-size: 14px; line-height: 1.6; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; }
        .sig-line { width: 250px; text-align: center; font-size: 14px; }
        .sig-line div { border-bottom: 1px solid #000; height: 40px; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="page">
        <div class="header" style="display: flex; align-items: center; justify-content: center; gap: 20px;">
            <img src="{{ asset('images/circlelogo.png') }}" style="width: 85px; height: 85px; object-fit: contain;" alt="Barangay Logo">
            <div style="text-align: center;">
                <h2 style="font-size: 14px; margin: 0; font-weight: normal;">PROVINCE OF CAVITE</h2>
                <h2 style="font-size: 14px; margin: 0; font-weight: normal;">CITY OF DASMARIÑAS</h2>
                <h2 style="font-size: 14px; margin: 0; font-weight: bold;">BARANGAY SAN MIGUEL 2</h2>
                <h1 style="font-size: 16px; margin: 5px 0 0 0; text-transform: uppercase;">OFFICE OF THE SANGGUNIANG BARANGAY</h1>
            </div>
        </div>
        
        <div style="text-align: right; font-size: 14px; margin-bottom: 15px;">
            <strong>Date:</strong> {{ now()->format('F d, Y') }}<br>
            <strong>Case No:</strong> {{ 'VAWC-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT) }}
        </div>

        <div class="title">OFFICIAL PNP / DSWD REFERRAL FORM</div>
        <p style="font-size: 14px; text-align: justify; margin-bottom: 20px;">
            This document officially refers the following high-priority VAWC incident for immediate Police Response/Intervention pursuant to the provisions of Republic Act No. 9262.
        </p>

        <div class="row"><div class="col-title">Escalation Status:</div><div class="col-value"><strong>{{ strtoupper(str_replace('_', ' ', $issue->status)) }}</strong></div></div>
        <div class="row"><div class="col-title">Incident Type:</div><div class="col-value">{{ $issue->issue_type }}</div></div>
        
        <h4 style="margin: 20px 0 10px; text-decoration: underline;">Complainant Details</h4>
        <div class="row"><div class="col-title">Date Occurred:</div><div class="col-value">{{ $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('F d, Y h:i A') : 'N/A' }}</div></div>
        <div class="row"><div class="col-title">Incident Location:</div><div class="col-value">{{ $issue->location ?? 'N/A' }}</div></div>
        <div class="row"><div class="col-title">Full Name:</div><div class="col-value">{{ $issue->complainant_name }}</div></div>
        <div class="row"><div class="col-title">Age / Gender:</div><div class="col-value">{{ $issue->complainant_age ?? 'N/A' }} / {{ $issue->complainant_gender ?? 'N/A' }}</div></div>
        <div class="row"><div class="col-title">Contact No:</div><div class="col-value">{{ $issue->contact }}</div></div>
        <div class="row"><div class="col-title">Address:</div><div class="col-value">{{ $issue->complainant_address ?? 'Not specified' }}</div></div>

        <h4 style="margin: 20px 0 10px; text-decoration: underline;">Respondent/Suspect Details</h4>
        <div class="row"><div class="col-title">Full Name:</div><div class="col-value">{{ $issue->respondent_name }}</div></div>
        <div class="row"><div class="col-title">Address:</div><div class="col-value">{{ $issue->respondent_address ?? 'Not specified' }}</div></div>

        <h4 style="margin: 20px 0 10px; text-decoration: underline;">Incident Narration</h4>
        <div class="narration-box">
            @if(!empty($issue->admin_summary))
                <strong>Staff Official Summary:</strong><br><br>
                {{ $issue->admin_summary }}
            @else
                <strong>Resident Original Narrative:</strong><br><br>
                {{ $issue->description }}
            @endif
        </div>

        <h4 style="margin: 20px 0 10px; text-decoration: underline;">System Remarks</h4>
        <div class="row"><div class="col-title" style="width: auto; margin-right: 15px;">Admin Notes:</div><div class="col-value">{{ $issue->admin_notes ?? 'Referred via Automated System.' }}</div></div>

        <div class="footer">
            <div class="sig-line">
                <div></div>
                VAWC Desk Officer / Admin
            </div>
            <div class="sig-line">
                <div></div>
                Receiving Police Officer
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
