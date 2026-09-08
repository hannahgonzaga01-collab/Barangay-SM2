<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay San Miguel II - VAWC Confidential Transmittal Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&family=Times+New+Roman&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Times New Roman', serif; margin: 0; padding: 20px; background: #e2e8f0; color: #0f172a; }
        .page { background: white; width: 210mm; min-height: 297mm; margin: 0 auto; padding: 18mm; box-sizing: border-box; box-shadow: 0 4px 24px rgba(0,0,0,0.12); border-radius: 6px; }
        .no-print-bar { max-width: 210mm; margin: 0 auto 15px; display: flex; justify-content: space-between; align-items: center; }
        .btn { font-family: 'Plus Jakarta Sans', sans-serif; display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; font-size: 11px; font-weight: 800; border-radius: 8px; cursor: pointer; border: none; text-decoration: none; }
        .btn-print { background: #7c3aed; color: #fff; box-shadow: 0 2px 8px rgba(124,58,237,0.3); }
        .btn-back { background: #fff; color: #334155; border: 1px solid #cbd5e1; }
        @media print {
            body { background: white; padding: 0; }
            .page { width: 100%; height: auto; box-shadow: none; padding: 12mm; margin: 0; border-radius: 0; }
            .no-print-bar { display: none !important; }
        }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 12px; display: flex; align-items: center; justify-content: center; gap: 20px; }
        .header h1 { font-size: 16px; text-transform: uppercase; margin: 4px 0 0 0; font-weight: bold; }
        .header h2 { font-size: 12px; font-weight: normal; margin: 0; }
        .title { text-align: center; font-size: 15px; font-weight: bold; text-decoration: underline; margin: 14px 0 16px; text-transform: uppercase; }
        .meta-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 18px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 11px; border: 1px solid #cbd5e1; padding: 10px 14px; border-radius: 6px; background: #f8fafc; }
        .meta-item strong { display: block; font-size: 9px; text-transform: uppercase; color: #64748b; margin-bottom: 2px; }
        table { width: 100%; border-collapse: collapse; margin-top: 14px; font-size: 11px; }
        th, td { border: 1px solid #94a3b8; padding: 6px 8px; text-align: left; vertical-align: top; }
        th { background-color: #f1f5f9; font-weight: bold; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 9.5px; text-transform: uppercase; }
        .footer { margin-top: 36px; display: flex; justify-content: space-between; page-break-inside: avoid; }
        .sig-line { width: 220px; text-align: center; font-size: 12px; }
        .sig-line div { border-bottom: 1px solid #000; height: 38px; margin-bottom: 4px; }
        .conf-notice { font-size: 10px; text-align: center; margin-top: 25px; color: #475569; font-style: italic; border-top: 1px solid #cbd5e1; padding-top: 8px; }
    </style>
</head>
<body>
    @php
        $period = $period ?? request('period', 'all');
        $reportType = $reportType ?? request('type', 'all');
    @endphp
    <div class="no-print-bar">
        <a href="{{ route('vawc.dashboard') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to VAWC Desk</a>
        <div style="display: flex; gap: 8px;">
            <button onclick="window.print()" class="btn btn-print"><i class="fas fa-print"></i> Print Official Report</button>
        </div>
    </div>

    <div class="page">
        <div class="header">
            <img src="{{ asset('images/circlelogo.png') }}" style="width: 70px; height: 70px; object-fit: contain;" alt="Barangay Logo">
            <div style="text-align: center;">
                <h2>PROVINCE OF CAVITE &bull; CITY OF DASMARIÑAS</h2>
                <h2>BARANGAY SAN MIGUEL II</h2>
                <h1>OFFICE OF THE SANGGUNIANG BARANGAY &bull; VAWC DESK</h1>
            </div>
        </div>

        <div class="title">CONFIDENTIAL VAWC TRANSMITTAL & STATISTICAL REPORT</div>

        <div class="meta-grid">
            <div class="meta-item">
                <strong>Reporting Period</strong>
                <span>{{ ucfirst($period) }} ({{ date('F Y') }})</span>
            </div>
            <div class="meta-item">
                <strong>Report Scope</strong>
                <span>{{ $reportType === 'pnp_referrals' ? 'PNP / DSWD Emergency Referrals' : ($reportType === 'settled' ? 'Resolved / Settled Cases' : 'All VAWC Incidents') }}</span>
            </div>
            <div class="meta-item">
                <strong>Total Records Listed</strong>
                <span><strong>{{ count($issues) }} Cases</strong></span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 14%;">Case Code</th>
                    <th style="width: 16%;">Category</th>
                    <th style="width: 26%;">Complainant / Victim</th>
                    <th style="width: 18%;">Respondent</th>
                    <th style="width: 13%;">Date Filed</th>
                    <th style="width: 13%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues as $issue)
                @php $code = 'VAWC-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT); @endphp
                <tr>
                    <td><strong>#{{ $code }}</strong></td>
                    <td>{{ $issue->issue_type }}</td>
                    <td>
                        <strong>{{ $issue->complainant_name }}</strong>
                        @if($issue->is_on_behalf && $issue->victim_name)
                            <div style="font-size: 9.5px; color: #7c3aed;">
                                <i class="fas fa-hands-helping"></i> Victim: {{ $issue->victim_name }} ({{ $issue->victim_relationship ?? 'Dependent' }})
                            </div>
                        @endif
                    </td>
                    <td>{{ $issue->respondent_name ?: 'N/A' }}</td>
                    <td>{{ $issue->created_at->format('M d, Y') }}</td>
                    <td><strong>{{ strtoupper(str_replace('_', ' ', $issue->status)) }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px; color: #64748b;">No records found for the selected criteria.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <div class="sig-line">
                <div></div>
                {{ auth()->user() ? auth()->user()->name : 'VAWC DESK OFFICER' }}<br>
                <small>Prepared by / VAWC Focal Person</small>
            </div>
            <div class="sig-line">
                <div></div>
                HON. PUNONG BARANGAY<br>
                <small>Barangay Captain / Attested by</small>
            </div>
        </div>

        <div class="conf-notice">
            <strong>CONFIDENTIALITY WARNING:</strong> This document contains sensitive personal information protected under Republic Act No. 9262. Unauthorized reproduction, distribution, or sharing is strictly punishable by law.
        </div>
    </div>
</body>
</html>