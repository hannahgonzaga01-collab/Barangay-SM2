<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PNP/DSWD Referral Document - {{ 'VAWC-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&family=Times+New+Roman&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 20px; background: #e2e8f0; color: #0f172a; }
        .page { background: white; width: 210mm; min-height: 297mm; margin: 0 auto; padding: 20mm; box-sizing: border-box; box-shadow: 0 4px 24px rgba(0,0,0,0.12); border-radius: 6px; }
        .no-print-bar { max-width: 210mm; margin: 0 auto 15px; display: flex; justify-content: space-between; align-items: center; }
        .btn { font-family: 'Plus Jakarta Sans', sans-serif; display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; font-size: 11px; font-weight: 800; border-radius: 8px; cursor: pointer; border: none; text-decoration: none; }
        .btn-print { background: #dc2626; color: #fff; box-shadow: 0 2px 8px rgba(220,38,38,0.3); }
        .btn-back { background: #fff; color: #334155; border: 1px solid #cbd5e1; }
        @media print {
            body { background: white; padding: 0; }
            .page { width: 100%; height: auto; box-shadow: none; padding: 15mm; margin: 0; border-radius: 0; }
            .no-print-bar { display: none !important; }
        }
        .header { text-align: center; margin-bottom: 24px; border-bottom: 2px solid #000; padding-bottom: 12px; display: flex; align-items: center; justify-content: center; gap: 20px; }
        .header h1 { font-size: 16px; text-transform: uppercase; margin: 5px 0 0 0; font-weight: bold; }
        .header h2 { font-size: 13px; font-weight: normal; margin: 0; }
        .title { text-align: center; font-size: 16px; font-weight: bold; text-decoration: underline; margin: 18px 0; text-transform: uppercase; }
        .row { display: flex; margin-bottom: 8px; font-size: 13.5px; }
        .col-title { width: 180px; font-weight: bold; }
        .col-value { flex: 1; border-bottom: 1px dotted #000; padding-bottom: 2px; }
        .section-head { margin: 16px 0 8px; text-decoration: underline; font-size: 14px; font-weight: bold; text-transform: uppercase; }
        .narration-box { border: 1px solid #000; padding: 12px 14px; margin-top: 6px; min-height: 120px; font-size: 13px; line-height: 1.6; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; page-break-inside: avoid; }
        .sig-line { width: 240px; text-align: center; font-size: 13px; }
        .sig-line div { border-bottom: 1px solid #000; height: 40px; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="no-print-bar">
        <a href="{{ route('vawc.dashboard') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to VAWC Desk</a>
        <div style="display: flex; gap: 8px;">
            <button onclick="window.print()" class="btn btn-print"><i class="fas fa-print"></i> Print Document</button>
        </div>
    </div>

    <div class="page">
        <div class="header">
            <img src="{{ asset('images/circlelogo.png') }}" style="width: 80px; height: 80px; object-fit: contain;" alt="Barangay Logo">
            <div style="text-align: center;">
                <h2>PROVINCE OF CAVITE &bull; CITY OF DASMARIÑAS</h2>
                <h2>BARANGAY SAN MIGUEL II</h2>
                <h1>OFFICE OF THE SANGGUNIANG BARANGAY &bull; VAWC DESK</h1>
            </div>
        </div>
        
        <div style="text-align: right; font-size: 13px; margin-bottom: 15px;">
            <strong>Date:</strong> {{ now()->format('F d, Y') }}<br>
            <strong>Case No:</strong> {{ 'VAWC-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT) }}
        </div>

        <div class="title">OFFICIAL PNP / DSWD REFERRAL FORM</div>
        <p style="font-size: 13px; text-align: justify; margin-bottom: 18px; line-height: 1.5;">
            This document officially refers the following high-priority VAWC incident for immediate Police Intervention and Protective Assistance pursuant to the provisions of <strong>Republic Act No. 9262</strong> (Anti-Violence Against Women and Their Children Act).
        </p>

        <div class="row"><div class="col-title">Escalation Status:</div><div class="col-value"><strong>{{ strtoupper(str_replace('_', ' ', $issue->status)) }}</strong></div></div>
        <div class="row"><div class="col-title">Incident Category:</div><div class="col-value">{{ $issue->issue_type }}</div></div>
        <div class="row"><div class="col-title">Date & Time Occurred:</div><div class="col-value">{{ $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('F d, Y h:i A') : 'N/A' }}</div></div>
        <div class="row"><div class="col-title">Incident Location:</div><div class="col-value">{{ $issue->location ?? 'Barangay San Miguel II' }}</div></div>
        
        <div class="section-head">Complainant Details</div>
        <div class="row"><div class="col-title">Full Name:</div><div class="col-value">{{ $issue->complainant_name }}</div></div>
        <div class="row"><div class="col-title">Age / Gender:</div><div class="col-value">{{ $issue->complainant_age ?? 'N/A' }} / {{ $issue->complainant_gender ?? 'N/A' }}</div></div>
        <div class="row"><div class="col-title">Contact No:</div><div class="col-value">{{ $issue->contact }}</div></div>
        <div class="row"><div class="col-title">Address:</div><div class="col-value">{{ $issue->complainant_address ?? 'Barangay San Miguel II' }}</div></div>

        @if($issue->is_on_behalf && $issue->victim_name)
        <div class="section-head" style="color: #7c3aed;">Victim / Dependent Information (Filed On Behalf)</div>
        <div class="row"><div class="col-title">Victim Full Name:</div><div class="col-value"><strong>{{ $issue->victim_name }}</strong></div></div>
        <div class="row"><div class="col-title">Age / Gender:</div><div class="col-value">{{ $issue->victim_age ?? 'N/A' }} / {{ $issue->victim_gender ?? 'N/A' }}</div></div>
        <div class="row"><div class="col-title">Relationship to Complainant:</div><div class="col-value">{{ $issue->victim_relationship ?? 'N/A' }}</div></div>
        @endif

        <div class="section-head">Respondent / Alleged Perpetrator Details</div>
        <div class="row"><div class="col-title">Full Name:</div><div class="col-value">{{ $issue->respondent_name }}</div></div>
        <div class="row"><div class="col-title">Address:</div><div class="col-value">{{ $issue->respondent_address ?? 'Barangay San Miguel II' }}</div></div>

        <div class="section-head">Incident Narration & Facts</div>
        <div class="narration-box">
            @if(!empty($issue->admin_summary))
                <strong>Official Case Summary:</strong><br>
                {{ $issue->admin_summary }}
            @else
                <strong>Original Statement:</strong><br>
                {{ $issue->description }}
            @endif
        </div>

        <div class="section-head">Desk Officer Notes & Directives</div>
        <div class="row"><div class="col-title">Admin / Action Notes:</div><div class="col-value">{{ $issue->admin_notes ?? 'Referred for immediate emergency protection and investigation under RA 9262.' }}</div></div>

        <div class="footer">
            <div class="sig-line">
                <div></div>
                {{ auth()->user() ? auth()->user()->name : 'VAWC DESK OFFICER' }}<br>
                <small>VAWC Focal Person / Admin</small>
            </div>
            <div class="sig-line">
                <div></div>
                RECEIVING POLICE / DSWD OFFICER<br>
                <small>Signature over Printed Name / Date</small>
            </div>
        </div>
    </div>
</body>
</html>
