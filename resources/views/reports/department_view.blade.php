<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report->report_title }} - {{ $report->reporting_period }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&family=Plus+Jakarta+Sans:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 24px;
            color: #000;
        }
        .no-print-bar {
            max-width: 1100px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #cbd5e1;
        }
        .btn {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            font-weight: 800;
            padding: 9px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }
        .btn-print { background: #0E5393; color: #fff; box-shadow: 0 2px 8px rgba(14,83,147,0.3); }
        .btn-back { background: #fff; color: #334155; border: 1px solid #cbd5e1; }
        @media print {
            @page { size: landscape; margin: 10mm; }
            body { background: white; padding: 0; }
            .page { width: 100%; height: auto; box-shadow: none; padding: 0; margin: 0; border-radius: 0; border: none; }
            .no-print-bar { display: none !important; }
        }
    </style>
</head>
<body>
    @php
        $data = $report->report_data ?? [];
    @endphp
    <div class="no-print-bar">
        <a href="javascript:history.back()" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back</a>
        <div style="display: flex; gap: 8px; align-items: center;">
            <span style="font-family:'Plus Jakarta Sans', sans-serif; font-size:10px; font-weight:700; color:#475569; background:#fff; padding:6px 12px; border-radius:6px; border:1px solid #cbd5e1;">
                Submitted by: <strong>{{ $report->submitted_by }}</strong> ({{ $report->submitted_role }}) on {{ $report->created_at->format('M d, Y h:i A') }}
            </span>
            @if($report->template_file)
                <a href="{{ asset('storage/' . $report->template_file) }}" target="_blank" class="btn btn-back">
                    <i class="fas fa-paperclip"></i> View Attached Format
                </a>
            @endif
            <button onclick="window.print()" class="btn btn-print"><i class="fas fa-print"></i> Print Official Report</button>
        </div>
    </div>

    <div class="page">
        {{-- Official Header with 3 Logos --}}
        <div style="text-align:center; margin-bottom:14px;">
            <div style="display:flex; align-items:center; justify-content:center; gap:28px; margin-bottom:8px;">
                <img src="{{ asset('images/dasma.png') }}" style="width:68px; height:68px; object-fit:contain;" alt="City of Dasmariñas">
                <img src="{{ asset('images/Bagong_Pilipinas_logo.png') }}" style="width:68px; height:68px; object-fit:contain;" alt="Bagong Pilipinas">
                <img src="{{ asset('images/circlelogo.png') }}" style="width:68px; height:68px; object-fit:contain;" alt="Barangay SM2">
            </div>
            <div style="font-size:12px; text-transform:uppercase; letter-spacing:0.18em; font-weight:bold;">
                REPUBLIC OF THE PHILIPPINES
            </div>
            <div style="font-size:11.5px; text-transform:uppercase; letter-spacing:0.12em; font-weight:bold;">
                PROVINCE OF CAVITE
            </div>
            <div style="font-size:11.5px; text-transform:uppercase; letter-spacing:0.12em; font-weight:bold;">
                CITY OF DASMARIÑAS
            </div>
            <div style="font-size:11.5px; text-transform:uppercase; letter-spacing:0.12em; font-weight:bold;">
                BARANGAY SAN MIGUEL 2
            </div>
            <div style="font-size:12px; text-transform:uppercase; font-weight:bold; margin-top:3px; letter-spacing:0.06em;">
                @if($report->department === 'VAWC')
                    BARANGAY VAW DESK
                @elseif($report->department === 'Peace & Order')
                    COMMITTEE ON PEACE AND ORDER & PUBLIC SAFETY
                @elseif($report->department === 'Justice')
                    OFFICE OF THE LUPON TAGAPAMAYAPA
                @else
                    OFFICE OF THE BARANGAY SECRETARY & CIVIL REGISTRY
                @endif
            </div>
            <div style="border-bottom:1.5px solid #000; width:100%; margin:8px auto 14px;"></div>

            <div style="font-size:13px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em;">
                Office of the Punong Barangay
            </div>
            <div style="font-size:12.5px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em; margin-top:2px;">
                {{ $report->report_title }}
            </div>
            <div style="font-size:11.5px; font-weight:bold; text-transform:uppercase; margin-top:3px;">
                FOR THE MONTH OF {{ $report->reporting_period }}
            </div>
        </div>

        {{-- Sub Meta Top-Left --}}
        <div style="font-size:11px; margin-bottom:10px; line-height:1.4;">
            <div><strong>Province:</strong> {{ $data['province'] ?? 'Cavite' }}</div>
            <div><strong>City:</strong> {{ $data['city'] ?? 'Dasmariñas' }}</div>
            <div><strong>Barangay:</strong> {{ $data['barangay'] ?? 'San Miguel 2' }}</div>
        </div>

        {{-- ══ DEPARTMENT-SPECIFIC MATRIX RENDER ══ --}}
        @if($report->department === 'VAWC')
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:10px; text-align:center; border:1.5px solid #000;">
                    <thead>
                        <tr style="background:#f8fafc;">
                            <th rowspan="2" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:9%;">Presence of Barangay VAWC DESK</th>
                            <th colspan="2" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:17%;">Source of Fund for VAWC DESK Operation</th>
                            <th rowspan="2" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:11%;">Presence of Logbook for VAWC Desk Purposes only</th>
                            <th rowspan="2" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:9%;">No. of VAWC Cases Handled by the Barangay</th>
                            <th colspan="5" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:27%;">No. of VAWC Victims</th>
                            <th colspan="5" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:27%;">No. of CASES ACTED UPON</th>
                        </tr>
                        <tr style="background:#f1f5f9;">
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">5% GAD Fund</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Other Source of Fund (BCPC)</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Physical Abuse</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Economic Abuse</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Sexual Abuse</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Psychological Abuse</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Referred to PNP</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Referred to Court</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Issued BPOs</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Referred to Medical</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height:44px; background:#fff;">
                            <td style="border:1px solid #000; padding:4px; font-weight:bold;">{{ $data['hasDesk'] ?? 'YES' }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['gadFund'] ?? '70,500.00' }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['bcpcFund'] ?? '52,194.00' }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['hasLogbook'] ?? 'Yes' }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold;">{{ $data['casesHandled'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['physicalAbuse'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['economicAbuse'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['sexualAbuse'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['psychAbuse'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['physicalAbuse']??0)+(int)($data['economicAbuse']??0)+(int)($data['sexualAbuse']??0)+(int)($data['psychAbuse']??0) }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['referredPnp'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['referredCourt'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['issuedBpo'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['referredMedical'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['referredPnp']??0)+(int)($data['referredCourt']??0)+(int)($data['issuedBpo']??0)+(int)($data['referredMedical']??0) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @elseif($report->department === 'Peace & Order')
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:10px; text-align:center; border:1.5px solid #000;">
                    <thead>
                        <tr style="background:#f8fafc;">
                            <th colspan="3" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:25%;">Security Desk & Tanod Force</th>
                            <th colspan="6" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:45%;">Blotter Incidents Logged</th>
                            <th colspan="5" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:30%;">Actions Taken & Resolutions</th>
                        </tr>
                        <tr style="background:#f1f5f9;">
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Presence of Desk</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Tanod Logbook</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Tanods on Duty</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Vehicular Accidents</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Noise Disturbance</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Theft / Robbery</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Physical Injuries</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Other Cases</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Settled at Desk</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Escalated to KP</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Referred to PNP</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Transferred VAWC</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height:44px; background:#fff;">
                            <td style="border:1px solid #000; padding:4px; font-weight:bold;">{{ $data['hasDesk'] ?? 'YES' }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['hasLogbook'] ?? 'Yes' }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['tanodsOnDuty'] ?? 12 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['vehicularAccidents'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['noiseDisturbance'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['theftRobbery'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['physicalInjuries'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['otherIncidents'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['vehicularAccidents']??0)+(int)($data['noiseDisturbance']??0)+(int)($data['theftRobbery']??0)+(int)($data['physicalInjuries']??0)+(int)($data['otherIncidents']??0) }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['settledAtDesk'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['escalatedJustice'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['referredPnp'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['transferredVawc'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['settledAtDesk']??0)+(int)($data['escalatedJustice']??0)+(int)($data['referredPnp']??0)+(int)($data['transferredVawc']??0) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @elseif($report->department === 'Justice')
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:10px; text-align:center; border:1.5px solid #000;">
                    <thead>
                        <tr style="background:#f8fafc;">
                            <th colspan="4" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:34%;">Nature of Disputes / Cases Received</th>
                            <th colspan="4" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:33%;">Settled Disputes</th>
                            <th colspan="5" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:33%;">Unsettled & Other Dispositions</th>
                        </tr>
                        <tr style="background:#f1f5f9;">
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Criminal Cases</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Civil Cases</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Other Disputes</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Mediation (PB)</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Conciliation (Pangkat)</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Arbitration</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Withdrawn</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Repudiated</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">CFA (Court Action)</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Pending</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height:44px; background:#fff;">
                            <td style="border:1px solid #000; padding:4px;">{{ $data['criminalCases'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['civilCases'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['othersCases'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['criminalCases']??0)+(int)($data['civilCases']??0)+(int)($data['othersCases']??0) }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['settledMediation'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['settledConciliation'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['settledArbitration'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['settledMediation']??0)+(int)($data['settledConciliation']??0)+(int)($data['settledArbitration']??0) }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['withdrawnCases'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['repudiatedCases'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['certToCourt'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['pendingCases'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['withdrawnCases']??0)+(int)($data['repudiatedCases']??0)+(int)($data['certToCourt']??0)+(int)($data['pendingCases']??0) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:10px; text-align:center; border:1.5px solid #000;">
                    <thead>
                        <tr style="background:#f8fafc;">
                            <th colspan="6" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:45%;">Resident Registry & Special Sectors</th>
                            <th colspan="6" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:40%;">Document Requests & Issuance</th>
                            <th colspan="2" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:15%;">Digital & Welfare</th>
                        </tr>
                        <tr style="background:#f1f5f9;">
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Total Residents</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">New This Month</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Seniors (60+)</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">PWDs</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Solo Parents</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Voters</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Brgy Clearance</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Indigency</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Residency</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Business Clear.</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Jobseeker</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL DOCS</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Digital IDs</th>
                            <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Registered Pets</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height:44px; background:#fff;">
                            <td style="border:1px solid #000; padding:4px; font-weight:bold;">{{ $data['totalResidents'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['newResidentsMonth'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['seniorCount'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['pwdCount'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['soloParentCount'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['votersCount'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['clearanceIssued'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['indigencyIssued'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['residencyIssued'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['businessClearanceIssued'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['firstTimeJobseekerIssued'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px; font-weight:bold; background:#f8fafc;">{{ (int)($data['clearanceIssued']??0)+(int)($data['indigencyIssued']??0)+(int)($data['residencyIssued']??0)+(int)($data['businessClearanceIssued']??0)+(int)($data['firstTimeJobseekerIssued']??0) }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['digitalIdIssued'] ?? 0 }}</td>
                            <td style="border:1px solid #000; padding:4px;">{{ $data['registeredPets'] ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Signatures Footer --}}
        <div style="margin-top:40px; display:flex; justify-content:space-between; align-items:flex-start; padding:0 24px;">
            <div style="width:240px; text-align:left;">
                <div style="font-size:11px;">Prepared by :</div>
                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; font-weight:bold; font-size:11.5px; text-transform:uppercase; text-align:center;">
                    {{ $data['preparedBy'] ?? $report->submitted_by }}
                </div>
                <div style="text-align:center; margin-top:2px; font-size:10.5px;">
                    {{ $data['preparedRole'] ?? $report->submitted_role }}
                </div>
            </div>

            <div style="width:240px; text-align:left;">
                <div style="font-size:11px;">Noted by:</div>
                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; font-weight:bold; font-size:11.5px; text-transform:uppercase; text-align:center;">
                    {{ $data['notedBy'] ?? 'MARVIN M. BENIS' }}
                </div>
                <div style="text-align:center; margin-top:2px; font-size:10.5px;">
                    {{ $data['notedRole'] ?? 'Punong Barangay' }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto trigger print dialog if opened with ?print=1
        if (new URLSearchParams(window.location.search).get('print') === '1') {
            window.addEventListener('load', function() {
                setTimeout(function() {
                    window.print();
                }, 400);
            });
        }
    </script>
</body>
</html>
