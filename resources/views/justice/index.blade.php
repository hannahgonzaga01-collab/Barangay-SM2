<x-app-layout>
<style>
:root{
    --brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;
    --body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;
    --danger:#dc2626;--success:#059669;--warn:#d97706;
    --card-shadow:0 4px 24px rgba(4,25,45,0.11),0 1.5px 6px rgba(0,0,0,0.06);
    --btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);
    --r-card:16px;
}
*, *::before, *::after {
    box-sizing: border-box;
}
input, button, select, textarea {
    font-family: inherit;
}
html, body {
    margin: 0;
    padding: 0;
    background: var(--body-bg);
    color: var(--text);
}
[x-cloak]{display:none!important;}
.page-wrap{max-width:1240px;width:100%;margin:0 auto;padding:20px 16px 60px;}

.portal-hero{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);border-radius:var(--r-card);padding:24px 26px;margin-bottom:16px;box-shadow:var(--card-shadow);position:relative;overflow:hidden;}
.portal-hero::after{content:'\f0e3';font-family:'Font Awesome 5 Free';font-weight:900;position:absolute;right:-10px;bottom:-20px;font-size:130px;color:rgba(255,255,255,.05);line-height:1;pointer-events:none;}
.portal-tag{font-size:9px;font-weight:900;background:rgba(255,255,255,.15);color:rgba(255,255,255,.9);padding:4px 12px;border-radius:99px;text-transform:uppercase;letter-spacing:.08em;display:inline-block;margin-bottom:10px;}
.portal-hero h2{font-size:clamp(18px,3vw,26px);font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.2;margin-bottom:6px;}
.portal-hero p{font-size:13px;color:rgba(255,255,255,.75);font-weight:600;max-width:550px;line-height:1.5;}
.hero-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:16px;}
.hstat{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:11px;padding:10px 14px;text-align:center;}
.hstat-n{font-size:20px;font-weight:900;color:#fff;line-height:1;}
.hstat-l{font-size:8px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.07em;margin-top:3px;}

.nav-toolbar-row{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:16px;flex-wrap:wrap;}
.portal-tabs-scroll{display:flex;gap:6px;background:rgba(14,83,147,.07);padding:5px;border-radius:12px;border:1px solid rgba(14,83,147,.12);overflow-x:auto;-webkit-overflow-scrolling:touch;max-width:100%;}
.portal-tab{padding:8px 14px;border-radius:9px;font-size:11px;font-weight:800;color:var(--muted);border:none;background:transparent;cursor:pointer;display:inline-flex;align-items:center;gap:6px;white-space:nowrap;transition:all .15s;font-family:inherit;}
.portal-tab:hover{color:var(--brand);background:rgba(14,83,147,.05);}
.portal-tab.active{background:var(--btn-grad);color:#fff;box-shadow:0 2px 8px rgba(0,0,52,.18);}
.tab-badge{font-size:8px;background:rgba(14,83,147,.12);color:var(--brand);font-weight:900;padding:1px 6px;border-radius:99px;}
.portal-tab.active .tab-badge{background:rgba(255,255,255,.25);color:#fff;}
.nav-actions-group{display:flex;align-items:center;gap:6px;flex-wrap:wrap;}

.wcard{background:#fff;border-radius:var(--r-card);box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.05);margin-bottom:16px;overflow:hidden;}
.wcard-head{padding:13px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;}
.wcard-title{font-size:11px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.08em;display:flex;align-items:center;gap:6px;}
.wcard-title i{color:var(--brand);}
.wcard-badge{font-size:9px;background:#eff6ff;color:var(--brand);font-weight:900;padding:3px 9px;border-radius:99px;}

.ptbl{width:100%;border-collapse:collapse;}
.ptbl thead tr{background:#f8fafc;}
.ptbl th{padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;white-space:nowrap;}
.ptbl tbody tr{border-bottom:1px solid #f8fafc;transition:background .1s;}
.ptbl tbody tr:last-child{border-bottom:none;}
.ptbl tbody tr:hover{background:#fafbfc;}
.ptbl td{padding:10px 14px;vertical-align:middle;font-size:11px;}
.empty-st{padding:36px;text-align:center;color:var(--light);}
.empty-st i{font-size:30px;display:block;margin-bottom:8px;opacity:.22;}
.empty-st p{font-size:12px;font-weight:700;}

.spill{font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;text-transform:uppercase;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;}
.spill-open{background:#dbeafe;color:#1d4ed8;}
.spill-closed{background:#dcfce7;color:#15803d;}
.spill-pending{background:#fef3c7;color:#a16207;}
.spill-urgent{background:#fee2e2;color:#dc2626;}

.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 13px;font-family:inherit;font-size:10px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:9px;cursor:pointer;transition:all .18s;white-space:nowrap;}
.btn-primary{background:var(--btn-grad);color:#fff;box-shadow:0 2px 8px rgba(0,0,82,.25);}
.btn-primary:hover{transform:translateY(-1px);}
.btn-ghost{background:#f1f5f9;color:#475569;}
.btn-ghost:hover{background:#475569;color:#fff;}
.btn-sm{padding:6px 11px;font-size:9px;}
.btn-icon{width:30px;height:30px;border-radius:7px;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11px;transition:all .15s;background:#eff6ff;color:var(--brand);}
.btn-icon:hover{background:var(--btn-grad);color:#fff;}
.acts{display:flex;gap:5px;align-items:center;justify-content:flex-end;flex-wrap:wrap;}

.modal-ov{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;padding:16px;background:rgba(0,0,18,.65);backdrop-filter:blur(5px);}
.modal-box{background:#fff;width:100%;max-width:580px;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,52,.35);border-bottom:5px solid var(--brand);max-height:94vh;overflow-y:auto;}
.modal-in{padding:22px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:13px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:13px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:9px;}
.modal-ico{width:32px;height:32px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.modal-ico i{color:var(--brand);font-size:13px;}
.modal-close{background:none;border:none;color:var(--light);font-size:20px;cursor:pointer;line-height:1;transition:color .15s;}
.modal-close:hover{color:var(--danger);}

.vfield{background:#f8fafc;border:1.5px solid var(--border);border-radius:9px;padding:10px 13px;margin-bottom:8px;}
.vfield-lbl{font-size:8px;font-weight:900;color:var(--brand);text-transform:uppercase;letter-spacing:.07em;margin-bottom:3px;}
.vfield-val{font-size:12px;font-weight:700;color:var(--text);}
.sblk{background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:11px;border:1px solid var(--border);}
.sblk-ttl{font-size:9px;font-weight:900;text-transform:uppercase;color:var(--muted);margin-bottom:8px;display:flex;align-items:center;gap:5px;letter-spacing:.07em;}
.fgrp{margin-bottom:12px;}
.flbl{font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;display:block;margin-bottom:4px;letter-spacing:.06em;}
.req{color:var(--danger);margin-left:2px;}
.finput{width:100%;padding:9px 12px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s;}
.finput:focus{border-color:var(--brand);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fselect{appearance:none;cursor:pointer;}
.fgrid2{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.fspan2{grid-column:span 2;}
.upload-card{background:#f8fafc;border:1.5px dashed #cbd5e1;border-radius:8px;padding:9px 12px;text-align:center;cursor:pointer;transition:all .18s;display:flex;align-items:center;justify-content:center;gap:8px;min-height:40px;width:100%;font-family:'Plus Jakarta Sans',sans-serif;}
.upload-card:hover{border-color:var(--brand);background:#eff6ff;}
.upload-txt{font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:600;color:var(--text);letter-spacing:0;}

.time-slot-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-top:8px;}
.slot-card{border-radius:10px;padding:9px 8px;text-align:center;border:1.5px solid #e2e8f0;background:#ffffff;transition:all .18s ease-in-out;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px;min-height:44px;box-shadow:0 1px 3px rgba(0,0,0,.03);user-select:none;}
.slot-card.slot-available{background:#ffffff;border-color:#cbd5e1;cursor:pointer;}
.slot-card.slot-available:hover{border-color:var(--brand);background:#eff6ff;transform:translateY(-1px);box-shadow:0 3px 10px rgba(14,83,147,.12);}
.slot-card.slot-selected{background:linear-gradient(135deg,#0E5393 0%,#04192D 100%)!important;border-color:#38bdf8!important;box-shadow:0 4px 14px rgba(14,83,147,.35)!important;transform:translateY(-2px);}
.slot-card.slot-selected .slot-time{color:#ffffff!important;font-weight:900!important;}
.slot-card.slot-occupied{background:#fef2f2;border-color:#fecaca;opacity:0.75;cursor:not-allowed;}
.slot-card.slot-occupied .slot-time{color:#991b1b;}
.slot-card.slot-past{background:#f8fafc;border-color:#e2e8f0;opacity:0.55;cursor:not-allowed;}
.slot-card.slot-past .slot-time{color:#94a3b8;}
.slot-time{font-size:11.5px;font-weight:800;color:var(--text);letter-spacing:0.02em;line-height:1.1;}
.slot-badge{font-size:7.5px;font-weight:900;text-transform:uppercase;letter-spacing:0.04em;padding:1px 6px;border-radius:99px;display:inline-flex;align-items:center;gap:3px;}
.slot-badge-occupied{background:#fee2e2;color:#dc2626;}
.slot-badge-past{background:#e2e8f0;color:#64748b;}

@media(max-width:992px){
    .nav-toolbar-row{flex-direction:column;align-items:stretch;}
    .portal-tabs-scroll{width:100%;}
    .nav-actions-group{width:100%;justify-content:flex-start;overflow-x:auto;padding-bottom:2px;}
}
@media(max-width:768px){
    .page-wrap{padding:14px 10px 50px;}
    .portal-hero{padding:18px 16px;}
    .hero-stats{grid-template-columns:repeat(2,1fr);gap:8px;}
    .wcard-head{flex-direction:column;align-items:flex-start;}
}
@media(max-width:480px){
    .hstat{padding:8px;}
    .hstat-n{font-size:18px;}
    .portal-tab{padding:7px 9px;font-size:10px;}
}
</style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white shadow-sm" style="background:linear-gradient(135deg,#6366f1 0%,#4338ca 100%);">
                    <i class="fas fa-gavel text-lg"></i>
                </div>
                <div>
                    <h2 class="font-black text-xl text-gray-800 leading-tight uppercase tracking-tight">Justice Portal</h2>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Lupong Tagapamayapa — Barangay San Miguel II</p>
                </div>
            </div>
        </div>
    </x-slot>

    @if(session('success'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         style="position:fixed;top:16px;right:16px;z-index:9999;background:#059669;color:#fff;padding:11px 18px;border-radius:11px;box-shadow:var(--card-shadow);font-weight:800;font-size:12px;display:flex;align-items:center;gap:7px;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         style="position:fixed;top:16px;right:16px;z-index:9999;background:#dc2626;color:#fff;padding:11px 18px;border-radius:11px;box-shadow:var(--card-shadow);font-weight:800;font-size:12px;display:flex;align-items:center;gap:7px;">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif
    <div class="page-wrap" x-data="justicePortal()">
    

        {{-- HERO --}}
        <div class="portal-hero">
            <span class="portal-tag"><i class="fas fa-gavel" style="margin-right:5px;"></i> Official Justice Portal</span>
            <h2>Katarungang Pambarangay</h2>
            <p>Systematic mediation and conflict resolution for a harmonious Barangay SM2.</p>
            <div class="hero-stats">
                @php
                    $totalJ   = \App\Models\IssueReport::where('department','Justice')->count();
                    $openJ    = \App\Models\IssueReport::where('department','Justice')->whereIn('status',['submitted','under_review'])->count();
                    $settledJ = \App\Models\IssueReport::where('department','Justice')->whereIn('status',['settled','resolved'])->count();
                    $pendingJ = \App\Models\IssueReport::where('department','Justice')->where('status','pending')->count();
                    $urgentJ  = \App\Models\IssueReport::where('department','Justice')->whereIn('status',['escalated','unresolved','urgent'])->count();
                @endphp
                <div class="hstat"><div class="hstat-n">{{ $totalJ }}</div><div class="hstat-l">Total</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#93c5fd;">{{ $openJ }}</div><div class="hstat-l">Open</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#fef08a;">{{ $pendingJ }}</div><div class="hstat-l">Pending</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#86efac;">{{ $settledJ }}</div><div class="hstat-l">Settled</div></div>
            </div>
        </div>

        {{-- ══ TOP PRIMARY NAVIGATION TABS + ACTIONS BAR ══ --}}
        <div class="nav-toolbar-row">
            <div class="portal-tabs-scroll">
                <button type="button" class="portal-tab" :class="activeTab==='blotter'?'active':''" @click="activeTab='blotter'">
                    <i class="fas fa-book"></i> <span>Blotter Records</span>
                    <span class="tab-badge">{{ $totalJ }}</span>
                </button>
                <button type="button" class="portal-tab" :class="activeTab==='mediation'?'active':''" @click="activeTab='mediation'">
                    <i class="fas fa-handshake"></i> <span>Settlements</span>
                    <span class="tab-badge" style="background:#dcfce7;color:#15803d;">{{ $settledJ }}</span>
                </button>
                <button type="button" class="portal-tab" :class="activeTab==='calendar'?'active':''" @click="activeTab='calendar'">
                    <i class="fas fa-calendar-alt"></i> <span>Hearing Schedule</span>
                </button>
                <button type="button" class="portal-tab" :class="activeTab==='requests'?'active':''" @click="activeTab='requests'">
                    <i class="fas fa-inbox"></i> <span>Issue Reports</span>
                    <span class="tab-badge">{{ $totalJ }}</span>
                </button>
                <button type="button" class="portal-tab" :class="activeTab==='reports'?'active':''" @click="activeTab='reports'">
                    <i class="fas fa-file-invoice"></i> <span>KP Reports</span>
                </button>
            </div>
            <div class="nav-actions-group">
                <button type="button" class="btn btn-ghost btn-sm" style="border:1.5px solid var(--border);" @click="exportModal=true" title="Export Blotter & Transmittal Reports">
                    <i class="fas fa-file-export"></i> Export
                </button>
                <button type="button" class="btn btn-ghost btn-sm" style="border:1.5px solid var(--border);" @click="importModal=true" title="Import Records">
                    <i class="fas fa-file-import"></i> Import
                </button>
                <button type="button" class="btn btn-ghost btn-sm" style="border:1.5px solid var(--border);color:var(--brand);" @click="formsModal=true" title="KP Form Templates & Document Settings">
                    <i class="fas fa-file-alt"></i> KP Forms
                </button>
            </div>
        </div>

        {{-- ══ BLOTTER TAB ══ --}}
        <div x-show="activeTab==='blotter'" x-transition>
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-title">
                        <i class="fas fa-book"></i> Blotter Records
                        <span class="wcard-badge">{{ $totalJ }} Records</span>
                    </div>
                    <button @click="blotterModal=true" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Blotter Entry
                    </button>
                </div>

                <!-- Filter Controls Bar with Literal Calendar Date Picker -->
                <div style="padding:10px 18px;border-bottom:1px solid #f1f5f9;background:#fafbfc;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;flex:1;">
                        @php $justiceCaseTypes = collect($reports)->pluck('issue_type')->unique(); @endphp
                        <input type="text" x-model="searchQuery" placeholder="Search case, name..." style="padding:6px 10px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;min-width:180px;background:#fff;">
                        
                        <!-- ⭐ LITERAL FULL CALENDAR DATE PICKER (DAY, MONTH, YEAR) ⭐ -->
                        <div style="display:inline-flex;align-items:center;background:#fff;border:1.5px solid var(--border);border-radius:8px;padding:4px 10px;gap:6px;">
                            <i class="fas fa-calendar-day" style="color:var(--brand);font-size:12px;"></i>
                            <input type="date" x-model="filterDate" style="border:none;outline:none;font-size:11px;font-weight:700;font-family:inherit;color:var(--text);background:transparent;cursor:pointer;" title="Filter by date (Day / Month / Year)">
                            <button type="button" x-show="filterDate" @click="filterDate=''" title="Clear Date" style="background:none;border:none;color:var(--muted);cursor:pointer;font-size:11px;padding:0 2px;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <select x-model="filterStatus" style="padding:6px 10px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;cursor:pointer;background:#fff;">
                            <option value="">All Statuses</option>
                            <option value="submitted">Open / Submitted</option>
                            <option value="under_review">Under Review / Hearing</option>
                            <option value="pending">Pending</option>
                            <option value="settled">Settled</option>
                            <option value="escalated">Escalated / CFA</option>
                        </select>

                        <select x-model="filterType" style="padding:6px 10px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;cursor:pointer;background:#fff;">
                            <option value="">All Case Types</option>
                            @foreach($justiceCaseTypes as $ct)
                            <option value="{{ $ct }}">{{ $ct }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="ptbl">
                        <thead><tr>
                            <th>Case No.</th><th>Complainant</th><th>Issue Type</th><th>Incident Date</th><th>Report Date</th><th>Status</th><th style="text-align:center;">Actions</th>
                        </tr></thead>
                        <tbody>
                            @forelse($reports as $rep)
                            @php
                                $caseNo = 'JUS-'.$rep->created_at->format('Y').'-'.str_pad($rep->id,3,'0',STR_PAD_LEFT);
                                $hasUpcomingHearing = !empty($rep->hearing_date) && !in_array($rep->status, ['settled', 'resolved', 'escalated']);
                                $effStatus = $hasUpcomingHearing ? 'under_review' : $rep->status;
                                $stMap  = [
                                    'submitted'=>'spill-open',
                                    'under_review'=>'spill-open',
                                    'pending'=>'spill-pending',
                                    'settled'=>'spill-closed',
                                    'urgent'=>'spill-urgent',
                                    'escalated'=>'spill-urgent'
                                ];
                                $stCls  = $stMap[$effStatus] ?? 'spill-pending';
                                $stLabel = ($effStatus === 'under_review') ? 'HEARING SCHEDULED' : strtoupper(str_replace('_',' ',$effStatus));
                                $searchStr = strtolower($caseNo . ' ' . ($rep->complainant_name??'') . ' ' . $rep->issue_type . ' ' . $rep->status . ' ' . $stLabel);
                                $reportDateStr = $rep->created_at->format('Y-m-d');
                                $incidentDateStr = $rep->incident_date ? \Carbon\Carbon::parse($rep->incident_date)->format('Y-m-d') : '';
                            @endphp
                            <tr x-show="('{{ addslashes($searchStr) }}'.includes(searchQuery.toLowerCase())) && (filterDate === '' || filterDate === '{{ $reportDateStr }}' || filterDate === '{{ $incidentDateStr }}') && (filterStatus === '' || filterStatus === '{{ $rep->status }}') && (filterType === '' || filterType === '{{ $rep->issue_type }}')">
                                <td>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand);">#{{ $caseNo }}</div>
                                    <div style="font-size:9px;color:var(--light);font-weight:600;text-transform:uppercase;">Blotter</div>
                                    @if($rep->transfer_count > 0 || str_contains((string)$rep->admin_summary, 'Peace & Order') || str_contains((string)$rep->admin_summary, 'KP'))
                                        <span class="wcard-badge" style="font-size:7px;background:#fef3c7;color:#b45309;padding:2px 6px;border-radius:4px;font-weight:900;display:inline-block;margin-top:2px;">
                                            <i class="fas fa-gavel"></i> FROM PEACE & ORDER
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-size:11px;font-weight:800;color:var(--text);">
                                        {{ $rep->complainant_name ?? '—' }}
                                        @if(!$rep->user_id)
                                             <span class="wcard-badge" style="font-size:7px; background:#fee2e2; color:#dc2626; padding:2px 6px; vertical-align:middle; margin-left:4px;">GUEST</span>
                                        @endif
                                    </div>
                                    <div style="font-size:9px;color:var(--muted);font-weight:600;">{{ $rep->contact ?? '' }}</div>
                                </td>
                                <td><span style="background:#eff6ff;color:var(--brand);font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;">{{ $rep->issue_type }}</span></td>
                                <td style="font-size:11px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $rep->incident_date ? \Carbon\Carbon::parse($rep->incident_date)->format('M d, Y') : 'N/A' }}</td>
                                <td style="font-size:11px;color:var(--brand);font-weight:800;white-space:nowrap;">{{ $rep->created_at->format('M d, Y') }}</td>
                                <td><span class="spill {{ $stCls }}"><i class="fas fa-circle" style="font-size:5px;"></i> {{ $stLabel }}</span></td>
                                <td>
                                    <div class="acts" style="justify-content:center;">
                                        <button type="button" class="btn-icon" title="View Details & Case Actions"
                                                @click="openView({{ json_encode([
                                                    'id'            => $rep->id,
                                                    'case_no'       => $caseNo,
                                                    'issue_type'    => $rep->issue_type,
                                                    'complainant'   => $rep->complainant_name ?? '',
                                                    'contact'       => $rep->contact ?? '',
                                                    'respondent'    => $rep->respondent_name ?? '',
                                                    'description'   => $rep->description ?? '',
                                                    'admin_summary' => $rep->admin_summary ?? '',
                                                    'location'      => $rep->location ?? '',
                                                    'incident_date' => $rep->incident_date ? \Carbon\Carbon::parse($rep->incident_date)->format('M d, Y') : 'N/A',
                                                    'witness_name'  => $rep->witness_name ?? '',
                                                    'evidence'      => $rep->evidence ? json_decode($rep->evidence) : [],
                                                    'status'        => $effStatus,
                                                    'hearing_date'  => $rep->hearing_date ? \Carbon\Carbon::parse($rep->hearing_date)->format('M d, Y h:i A') : '',
                                                    'is_restricted' => (bool)$rep->is_restricted,
                                                    'user_id'       => $rep->user_id,
                                                    'date_filed'    => $rep->created_at->format('M d, Y h:i A')
                                                ]) }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7">
                                <div class="empty-st">
                                    <i class="fas fa-book"></i>
                                    <p>No blotter entries yet.</p>
                                    <p style="font-size:10px;color:var(--light);margin-top:4px;font-weight:600;">Click "Add Blotter Entry" to create the first record.</p>
                                </div>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ SETTLEMENTS & AMICABLE AGREEMENTS TAB ══ --}}
        <div x-show="activeTab==='mediation'" x-transition>
            <div class="wcard" style="padding:20px;">
                <div class="wcard-head" style="margin-bottom:16px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
                    <div>
                        <div class="wcard-title"><i class="fas fa-handshake" style="color:#059669;"></i> Amicable Settlements & Resolved Disputes</div>
                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">Archive of cases successfully settled with binding KP Form 16 agreements</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span class="wcard-badge" style="background:#dcfce7;color:#166534;font-size:10px;padding:4px 10px;">
                            <i class="fas fa-check-double"></i> {{ $reports->where('status','settled')->count() }} Settled Cases
                        </span>
                    </div>
                </div>

                @php
                    $settledList = $reports->where('status', 'settled');
                @endphp

                @if($settledList->isEmpty())
                    <div class="empty-st" style="padding:40px 10px;">
                        <i class="fas fa-file-signature" style="font-size:36px;color:#cbd5e1;"></i>
                        <p style="font-size:12px;font-weight:800;color:var(--text);margin-top:10px;">No settlement records yet.</p>
                        <p style="font-size:10px;color:var(--light);margin-top:4px;font-weight:600;">When a hearing is concluded and KP Form 16 (Amicable Settlement) is recorded, the settled case will be archived here.</p>
                    </div>
                @else
                    <div style="overflow-x:auto;">
                        <table class="ptbl">
                            <thead>
                                <tr>
                                    <th>Case No.</th>
                                    <th>Complainant vs Respondent</th>
                                    <th>Dispute Nature</th>
                                    <th>Settlement Date</th>
                                    <th>Status</th>
                                    <th style="text-align:center;">Official KP Form 16</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settledList as $sRep)
                                @php
                                    $sCaseNo = 'JUS-'.$sRep->created_at->format('Y').'-'.str_pad($sRep->id,3,'0',STR_PAD_LEFT);
                                @endphp
                                <tr>
                                    <td>
                                        <div style="font-size:11px;font-weight:900;color:var(--brand);">#{{ $sCaseNo }}</div>
                                        <div style="font-size:8.5px;color:var(--light);font-weight:700;text-transform:uppercase;">Settlement</div>
                                    </td>
                                    <td>
                                        <div style="font-size:11px;font-weight:800;color:var(--text);">
                                            {{ $sRep->complainant_name ?? '—' }} <span style="font-size:9px;color:var(--muted);font-weight:600;">vs</span> {{ $sRep->respondent_name ?? '—' }}
                                        </div>
                                        <div style="font-size:9px;color:var(--muted);">{{ $sRep->contact ?? '' }}</div>
                                    </td>
                                    <td>
                                        <span style="background:#eff6ff;color:var(--brand);font-size:9px;font-weight:900;padding:3px 8px;border-radius:99px;">
                                            {{ $sRep->issue_type }}
                                        </span>
                                    </td>
                                    <td style="font-size:11px;color:#059669;font-weight:800;white-space:nowrap;">
                                        {{ $sRep->updated_at->format('M d, Y') }}
                                    </td>
                                    <td>
                                        <span class="spill spill-closed"><i class="fas fa-check-circle" style="font-size:6px;"></i> SETTLED</span>
                                    </td>
                                    <td style="text-align:center;">
                                        <div style="display:inline-flex;gap:6px;">
                                            <button type="button" @click="openDocDraft('kp16', {
                                                id: {{ $sRep->id }},
                                                case_no: '{{ $sCaseNo }}',
                                                issue_type: '{{ addslashes($sRep->issue_type) }}',
                                                complainant: '{{ addslashes($sRep->complainant_name ?? '') }}',
                                                respondent: '{{ addslashes($sRep->respondent_name ?? '') }}',
                                                description: '{{ addslashes($sRep->description ?? '') }}'
                                            })" class="btn btn-sm" style="background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;font-size:9px;" title="View & Print Amicable Settlement Form">
                                                <i class="fas fa-file-contract"></i> View KP Form 16
                                            </button>
                                            <button type="button" @click="openView({
                                                id: {{ $sRep->id }},
                                                case_no: '{{ $sCaseNo }}',
                                                issue_type: '{{ addslashes($sRep->issue_type) }}',
                                                complainant: '{{ addslashes($sRep->complainant_name ?? '') }}',
                                                contact: '{{ addslashes($sRep->contact ?? '') }}',
                                                respondent: '{{ addslashes($sRep->respondent_name ?? '') }}',
                                                description: '{{ addslashes($sRep->description ?? '') }}',
                                                location: '{{ addslashes($sRep->location ?? '') }}',
                                                incident_date: '{{ $sRep->incident_date ? \Carbon\Carbon::parse($sRep->incident_date)->format('M d, Y') : 'N/A' }}',
                                                witness_name: '{{ addslashes($sRep->witness_name ?? '') }}',
                                                evidence: @js($sRep->evidence),
                                                status: 'settled',
                                                hearing_date: '{{ $sRep->hearing_date ? \Carbon\Carbon::parse($sRep->hearing_date)->format('M d, Y h:i A') : '' }}',
                                                is_restricted: {{ $sRep->is_restricted ? 'true' : 'false' }},
                                                user_id: {{ $sRep->user_id ?: 'null' }},
                                                date_filed: '{{ $sRep->created_at->format('M d, Y h:i A') }}'
                                            })" class="btn btn-sm btn-ghost" style="padding:4px 8px;" title="View Case Record">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- ══ HEARING CALENDAR TAB ══ --}}
        @php
            $today = \Carbon\Carbon::now()->startOfDay();
            $schedulesJSON = $reports->filter(function($r) use ($today) {
                if(empty($r->hearing_date)) return false;
                if(in_array($r->status, ['settled', 'resolved', 'escalated'])) return false;
                
                $hDate = \Carbon\Carbon::parse($r->hearing_date)->startOfDay();
                if($hDate->lt($today)) return false;
                
                return true;
            })->map(function($r) {
                $dt = \Carbon\Carbon::parse($r->hearing_date);
                $createdAt = \Carbon\Carbon::parse($r->created_at)->startOfDay();
                $diff = $dt->startOfDay()->diffInDays($createdAt);
                
                $phase = 'Mediation';
                $stage = '1st Trial';
                if ($diff > 30) {
                    $phase = 'Arbitration';
                    $stage = '3rd Trial';
                } elseif ($diff > 15) {
                    $phase = 'Conciliation';
                    $stage = '2nd Trial';
                }

                return [
                    'id' => $r->id,
                    'case_no' => 'JUS-'.$r->created_at->format('Y').'-'.str_pad($r->id,3,'0',STR_PAD_LEFT),
                    'issue_type' => $r->issue_type,
                    'date_str' => $dt->format('Y-m-d'),
                    'time_str' => $dt->format('h:i A'),
                    'complainant' => $r->complainant_name ?? 'Unknown',
                    'respondent' => $r->respondent_name ?? 'N/A',
                    'contact' => $r->contact ?? '',
                    'description' => $r->description ?? '',
                    'phase' => $phase,
                    'stage' => $stage
                ];
            })->values()->toJson();
        @endphp
        <script>window._hearingSchedules = {!! $schedulesJSON !!};</script>
        <div x-show="activeTab==='calendar'" x-transition x-data="calendarComponent()" x-init="initCal()" style="margin-bottom:20px;">
            
            <div class="cal-header-row" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px; flex-wrap:wrap; gap:12px;">
                <div>
                   <h3 style="font-size:16px; font-weight:900; color:var(--brand-dark);">Hearing Schedule & Calendar</h3>
                   <div style="font-size:10px; color:var(--muted); font-weight:600;">Manage Court Appearances, Mediation Trials, and Summon Records</div>
                </div>
                <button @click="summonModal=true" class="btn btn-primary" style="padding:10px 16px; font-size:11px;">
                    <i class="fas fa-calendar-plus"></i> Create Hearing Sched
                </button>
            </div>
            
            <div class="calendar-wrapper" style="display:flex; gap:16px; align-items:flex-start;">
                <!-- Left: Calendar -->
                <div class="calendar-box wcard" style="flex:1.7; padding:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                        <div style="font-size:15px; font-weight:900; color:var(--text);" x-text="monthNames[currMonth] + ' ' + currYear"></div>
                        <div style="display:flex; gap:6px; background:#f1f5f9; padding:4px; border-radius:9px;">
                            <button class="btn btn-ghost btn-sm" @click="prevM" :disabled="!canPrev" :style="!canPrev ? 'opacity:0.3; cursor:not-allowed;' : 'background:#fff; box-shadow:0 2px 5px rgba(0,0,0,.05);'"><i class="fas fa-chevron-left"></i></button>
                            <button class="btn btn-ghost btn-sm" @click="resetToCurrent" style="background:#fff; box-shadow:0 2px 5px rgba(0,0,0,.05); text-transform:uppercase; font-size:10px; min-width:80px;" x-text="monthNames[currMonth]"></button>
                            <button class="btn btn-ghost btn-sm" @click="nextM" :disabled="!canNext" :style="!canNext ? 'opacity:0.3; cursor:not-allowed;' : 'background:#fff; box-shadow:0 2px 5px rgba(0,0,0,.05);'"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                    
                    <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:6px; text-align:center; margin-bottom:10px;">
                        <template x-for="d in ['Sun','Mon','Tue','Wed','Thu','Fri','Sat']">
                            <div style="font-size:9px; font-weight:900; color:var(--muted); text-transform:uppercase; letter-spacing:.05em;" x-text="d"></div>
                        </template>
                    </div>
                    <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:6px;">
                        <template x-for="(day, idx) in days" :key="idx">
                            <div @click="selDate(day)" 
                                :style="!day ? 'min-height:70px; padding:6px; background:#f8fafc; border-radius:10px; border:1.5px dashed #e2e8f0; opacity:0.4;' : (isDayDisabled(day) ? 'min-height:70px; padding:6px; background:#f8fafc; border-radius:10px; border:1.5px solid #f1f5f9; opacity:0.35; cursor:not-allowed;' : (hasEvents(day) ? (formatDate(day) === selectedDate ? 'cursor:pointer; border-radius:10px; min-height:70px; padding:6px; border:2px solid #1d4ed8; position:relative; transition:all .15s; background:#dbeafe; outline:2.5px solid #1d4ed8; outline-offset:-1px; box-shadow:0 4px 14px rgba(29,78,216,.25);' : 'cursor:pointer; border-radius:10px; min-height:70px; padding:6px; border:2px solid #3b82f6; position:relative; transition:all .15s; background:#eff6ff; box-shadow:0 2px 8px rgba(59,130,246,0.14);') : 'cursor:pointer; border-radius:10px; min-height:70px; padding:6px; border:1.5px solid #e2e8f0; position:relative; transition:all .15s; background:#fff;'))"
                                :class="day && !isDayDisabled(day) && !hasEvents(day) ? 'cal-day-empty' : (day && !isDayDisabled(day) && hasEvents(day) ? 'cal-day-has-events' : '')">
                                
                                <div x-show="day" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:5px;">
                                    <!-- Scheduled Count Badge (Visible on all days that have hearings) -->
                                    <template x-if="hasEvents(day)">
                                        <span style="font-size:7px; font-weight:900; background:#2563eb; color:#fff; padding:1px 5px; border-radius:10px; text-transform:uppercase; letter-spacing:0.3px; display:inline-flex; align-items:center; gap:2px;">
                                            <i class="fas fa-clock" style="font-size:6px;"></i> <span x-text="getEvents(day).length"></span>
                                        </span>
                                    </template>
                                    <template x-if="!hasEvents(day)">
                                        <span></span>
                                    </template>
                                    <div x-text="day" style="font-size:11px; font-weight:900;"
                                         :style="isDayDisabled(day) ? 'color:#94a3b8;' : (hasEvents(day) ? 'color:#1e40af;' : 'color:var(--text); opacity:0.9;')"></div>
                                </div>

                                <div style="display:flex; flex-direction:column; gap:3px;">
                                    <template x-for="(ev, j) in getEvents(day)" :key="j">
                                        <div style="font-size:7.5px; display:flex; flex-direction:column; margin-bottom:1px;">
                                            <span style="font-weight:900; border-left:3px solid #0E5393; background:#dbeafe; color:#1e40af; padding:2px 5px; border-radius:4px; max-width:100%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; text-align:left; box-shadow:0 1px 2px rgba(0,0,0,.05);"
                                                  :style="ev.phase==='Conciliation' ? 'border-left-color:#7c3aed;background:#f5f3ff;color:#5b21b6;' : (ev.phase==='Arbitration' ? 'border-left-color:#dc2626;background:#fef2f2;color:#991b1b;' : '')"
                                                  x-text="ev.time_str + ' • ' + ev.case_no"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Right: Schedules List & Stage Filter Sidebar -->
                <div class="calendar-sidebar wcard" style="flex:1.2; padding:18px; min-width:320px; align-self:stretch; display:flex; flex-direction:column; gap:12px;">
                    
                    <!-- Top Header with Counter -->
                    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1.5px solid #f1f5f9; padding-bottom:10px;">
                        <div>
                            <div style="font-size:12px; font-weight:900; color:var(--brand-dark); text-transform:uppercase; letter-spacing:.05em;">
                                <i class="fas fa-calendar-alt" style="color:var(--brand);"></i> Scheduled Hearings
                            </div>
                            <div style="font-size:9.5px; color:var(--muted); font-weight:600;" x-text="viewScope === 'month' ? ('All hearings for ' + monthNames[currMonth] + ' ' + currYear) : ('Hearings for ' + formatDateDisplay(selectedDate))"></div>
                        </div>
                        <span class="wcard-badge" style="background:#eff6ff; color:var(--brand); font-size:9px; font-weight:900;" x-text="displayedSchedules.length + ' Cases'"></span>
                    </div>

                    <!-- Filter Bar: View Scope (Selected Day vs Entire Month) & Trial Filter -->
                    <div style="display:flex; flex-direction:column; gap:8px; background:#f8fafc; padding:10px; border-radius:10px; border:1px solid var(--border);">
                        <!-- Scope Toggle -->
                        <div style="display:flex; gap:4px; background:#e2e8f0; padding:3px; border-radius:8px;">
                            <button type="button" @click="viewScope = 'selected_date'" 
                                    class="btn btn-sm" style="flex:1; justify-content:center; font-size:9px; padding:4px 0; border:none;"
                                    :style="viewScope === 'selected_date' ? 'background:#fff; color:var(--brand); font-weight:900; box-shadow:0 1px 3px rgba(0,0,0,.08);' : 'background:transparent; color:#64748b; font-weight:700;'">
                                <i class="fas fa-calendar-day"></i> Selected Day
                            </button>
                            <button type="button" @click="viewScope = 'month'" 
                                    class="btn btn-sm" style="flex:1; justify-content:center; font-size:9px; padding:4px 0; border:none;"
                                    :style="viewScope === 'month' ? 'background:#fff; color:var(--brand); font-weight:900; box-shadow:0 1px 3px rgba(0,0,0,.08);' : 'background:transparent; color:#64748b; font-weight:700;'">
                                <i class="fas fa-calendar-week"></i> All Month
                            </button>
                        </div>

                        <!-- Trial Stage Filter -->
                        <div style="display:flex; align-items:center; gap:6px;">
                            <span style="font-size:9px; font-weight:800; color:var(--muted);"><i class="fas fa-filter"></i> Trial Stage:</span>
                            <select x-model="stageFilter" style="flex:1; padding:4px 8px; font-size:9px; border-radius:6px; border:1px solid var(--border); font-family:inherit; outline:none; background:#fff; cursor:pointer;">
                                <option value="">All Trial Stages</option>
                                <option value="Mediation">1st Trial (Mediation)</option>
                                <option value="Conciliation">2nd Trial (Conciliation)</option>
                                <option value="Arbitration">3rd Trial (Arbitration)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Schedules List -->
                    <div style="display:flex; flex-direction:column; gap:10px; max-height:550px; overflow-y:auto; padding-right:2px;">
                        <template x-if="displayedSchedules.length === 0">
                            <div class="empty-st" style="padding:32px 10px; border:1.5px dashed var(--border); border-radius:12px; background:#fff;">
                                <i class="fas fa-mug-hot" style="font-size:24px; opacity:0.3;"></i>
                                <p style="font-size:11px; font-weight:800; color:var(--text); margin-top:8px;" x-text="viewScope === 'month' ? 'No hearings scheduled for this month.' : 'No hearings scheduled for this date.'"></p>
                                <p style="font-size:9.5px; color:var(--light); margin-top:2px;">Click "Create Hearing Sched" to schedule a case.</p>
                            </div>
                        </template>

                        <template x-for="(ev, i) in displayedSchedules" :key="ev.id">
                            <div style="padding:12px 14px; background:#fff; border-radius:10px; border:1.5px solid var(--border); border-left-width:5px; box-shadow:0 1px 4px rgba(0,0,0,.04); transition:all .15s;"
                                 :style="ev.phase === 'Conciliation' ? 'border-left-color:#7c3aed;' : (ev.phase === 'Arbitration' ? 'border-left-color:#dc2626;' : 'border-left-color:var(--brand);')">
                                
                                <!-- Card Header -->
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:6px;">
                                    <div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">
                                        <span style="font-size:11px; font-weight:900; color:var(--brand);" x-text="'#' + ev.case_no"></span>
                                        <span style="font-size:11px; font-weight:800;"
                                              :style="ev.phase === 'Conciliation' ? 'color:#7c3aed;' : (ev.phase === 'Arbitration' ? 'color:#dc2626;' : 'color:#1d4ed8;')"
                                              x-text="ev.stage + ' (' + ev.phase + ')'"></span>
                                    </div>
                                    <span style="font-size:9.5px; font-weight:900; color:#1e293b; background:#f1f5f9; padding:3px 8px; border-radius:6px; display:inline-flex; align-items:center; gap:3px;">
                                        <i class="fas fa-clock" style="font-size:8px; color:var(--brand);"></i> <span x-text="ev.time_str"></span>
                                    </span>
                                </div>

                                <!-- Date & Parties -->
                                <div style="font-size:9px; color:var(--muted); font-weight:700; margin-bottom:4px;" x-show="viewScope === 'month'">
                                    <i class="fas fa-calendar-day"></i> <span x-text="formatDateDisplay(ev.date_str)"></span>
                                </div>
                                <div style="font-size:11px; font-weight:800; color:var(--text); margin-bottom:2px;">
                                    <span x-text="ev.complainant"></span> <span style="font-size:9px; color:var(--muted); font-weight:600;">vs</span> <span x-text="ev.respondent"></span>
                                </div>
                                <div style="font-size:8.5px; font-weight:800; color:var(--brand); text-transform:uppercase; letter-spacing:.03em; margin-bottom:10px;" x-text="ev.issue_type"></div>

                                <!-- Actions Grid -->
                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:6px; border-top:1px solid #f1f5f9; padding-top:8px;">
                                    <button type="button" @click="settleSchedule(ev)" class="btn btn-sm" style="background:#dcfce7; color:#15803d; border:1px solid #bbf7d0; font-size:8.5px; justify-content:center; padding:4px 0;" title="Mark as Settled (KP Form 16)">
                                        <i class="fas fa-handshake"></i> Mark Settled
                                    </button>
                                    <button type="button" @click="selectedIssueId = ev.id; summonModal = true" class="btn btn-sm" style="background:#eff6ff; color:var(--brand); border:1px solid #bfdbfe; font-size:8.5px; justify-content:center; padding:4px 0;" title="Schedule 2nd / Next Trial">
                                        <i class="fas fa-calendar-plus"></i> Next Trial Sched
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
            
            <style>
            .cal-day-empty:hover { background-color: #f8fafc !important; border-color: #cbd5e1 !important; }
            .cal-day-has-events:hover { transform: translateY(-2px); box-shadow: 0 4px 14px rgba(59,130,246,0.25) !important; }

            /* ── Hearing Calendar Responsive ── */
            @media(max-width:900px) {
                .calendar-wrapper { flex-direction:column !important; }
                .calendar-box    { flex:none !important; width:100%; }
                .calendar-sidebar{ flex:none !important; width:100% !important; min-width:unset !important; align-self:auto !important; }
            }
            @media(max-width:640px) {
                /* Header row: title + button stack vertically */
                .cal-header-row { flex-direction:column !important; align-items:flex-start !important; gap:10px !important; }
                .cal-header-row .btn { width:100%; justify-content:center; }

                /* Shrink day-cell heights */
                .calendar-box [style*="min-height:70px"] {
                    min-height:48px !important;
                    padding:3px !important;
                }
                .calendar-box { padding:12px !important; }

                /* Day number font size */
                .calendar-box [style*="font-size:11px; font-weight:900"] {
                    font-size:9px !important;
                    margin-bottom:2px !important;
                }

                /* Case pill in cell */
                .calendar-box [style*="font-size:7.5px"] {
                    font-size:6px !important;
                }

                /* Sidebar inner padding */
                .calendar-sidebar { padding:14px !important; }
            }
            </style>
        </div>

        {{-- ══ ISSUE REPORTS TAB (ANALYTICS & TRANSMITTAL DASHBOARD) ══ --}}
        <div x-show="activeTab==='requests'" x-transition>
            
            {{-- 1. Analytics KPI Metrics Grid --}}
            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:12px;margin-bottom:16px;">
                <div class="wcard" style="padding:16px;border-left:4px solid var(--brand);display:flex;align-items:center;justify-content:space-between;">
                    <div>
                        <div style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;">Total Cases Handled</div>
                        <div style="font-size:24px;font-weight:900;color:var(--brand-dark);margin-top:2px;">{{ $totalJ }}</div>
                        <div style="font-size:9px;color:var(--light);font-weight:600;margin-top:2px;">All Katarungang Pambarangay records</div>
                    </div>
                    <div style="width:42px;height:42px;border-radius:10px;background:#eff6ff;color:var(--brand);display:flex;align-items:center;justify-content:center;font-size:18px;">
                        <i class="fas fa-gavel"></i>
                    </div>
                </div>

                <div class="wcard" style="padding:16px;border-left:4px solid #059669;display:flex;align-items:center;justify-content:space-between;">
                    <div>
                        <div style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;">Settlement Rate</div>
                        <div style="font-size:24px;font-weight:900;color:#059669;margin-top:2px;">
                            {{ $totalJ > 0 ? round(($settledJ / $totalJ) * 100, 1) : 0 }}%
                        </div>
                        <div style="font-size:9px;color:var(--light);font-weight:600;margin-top:2px;">{{ $settledJ }} of {{ $totalJ }} amicably settled</div>
                    </div>
                    <div style="width:42px;height:42px;border-radius:10px;background:#dcfce7;color:#059669;display:flex;align-items:center;justify-content:center;font-size:18px;">
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>

                <div class="wcard" style="padding:16px;border-left:4px solid #6366f1;display:flex;align-items:center;justify-content:space-between;">
                    <div>
                        <div style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;">Active Hearings</div>
                        <div style="font-size:24px;font-weight:900;color:#4f46e5;margin-top:2px;">{{ $pendingJ }}</div>
                        <div style="font-size:9px;color:var(--light);font-weight:600;margin-top:2px;">In Mediation or Conciliation</div>
                    </div>
                    <div style="width:42px;height:42px;border-radius:10px;background:#e0e7ff;color:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:18px;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>

                <div class="wcard" style="padding:16px;border-left:4px solid #d97706;display:flex;align-items:center;justify-content:space-between;">
                    <div>
                        <div style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;">Escalated (CFA)</div>
                        <div style="font-size:24px;font-weight:900;color:#d97706;margin-top:2px;">{{ $urgentJ }}</div>
                        <div style="font-size:9px;color:var(--light);font-weight:600;margin-top:2px;">Issued Certificate to File Action</div>
                    </div>
                    <div style="width:42px;height:42px;border-radius:10px;background:#fef3c7;color:#d97706;display:flex;align-items:center;justify-content:center;font-size:18px;">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                </div>
            </div>

            {{-- 2. Top Incident Categories Breakdown & Cases Register --}}
            <div style="display:grid;grid-template-columns:1.2fr 2fr;gap:14px;align-items:start;margin-bottom:16px;">
                <!-- Left: Incident Categories Breakdown -->
                <div class="wcard" style="padding:18px;">
                    <div class="wcard-title" style="margin-bottom:14px;font-size:12px;font-weight:900;color:var(--brand-dark);">
                        <i class="fas fa-chart-pie" style="color:var(--brand);"></i> Top Incident Categories
                    </div>
                    @php
                        $groupedTypes = $reports->groupBy('issue_type')->map(function($g){ return $g->count(); })->sortDesc();
                    @endphp
                    @if($groupedTypes->count() > 0)
                        <div style="display:flex;flex-direction:column;gap:12px;">
                            @foreach($groupedTypes as $typeName => $tCount)
                                @php $pct = $totalJ > 0 ? round(($tCount / $totalJ) * 100, 1) : 0; @endphp
                                <div>
                                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;font-size:11px;">
                                        <span style="font-weight:800;color:var(--text);">{{ $typeName }}</span>
                                        <span style="font-weight:900;color:var(--brand);">{{ $tCount }} ({{ $pct }}%)</span>
                                    </div>
                                    <div style="width:100%;height:7px;background:#f1f5f9;border-radius:99px;overflow:hidden;">
                                        <div style="width:{{ $pct }}%;height:100%;background:linear-gradient(90deg,var(--brand),#38bdf8);border-radius:99px;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-st" style="padding:20px 0;"><i class="fas fa-chart-bar"></i><p>No incidents recorded yet.</p></div>
                    @endif
                </div>

                <!-- Right: Cases Transmittal Table -->
                <div class="wcard">
                    <div class="wcard-head">
                        <div class="wcard-title"><i class="fas fa-list-alt"></i> Recent Transmittal Records</div>
                        <span class="wcard-badge">{{ $totalJ }} Records</span>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="ptbl">
                            <thead>
                                <tr>
                                    <th>Case No.</th>
                                    <th>Dispute Type</th>
                                    <th>Parties</th>
                                    <th>Status</th>
                                    <th style="text-align:right;">Document</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports->take(10) as $rep)
                                    @php 
                                        $caseNo = 'JUS-'.$rep->created_at->format('Y').'-'.str_pad($rep->id,3,'0',STR_PAD_LEFT); 
                                        $stCls = ['submitted'=>'spill-open','under_review'=>'spill-open','pending'=>'spill-pending','settled'=>'spill-closed'][$rep->status]??'spill-pending'; 
                                    @endphp
                                    <tr>
                                        <td><span style="font-size:11px;font-weight:900;color:var(--brand);">#{{ $caseNo }}</span></td>
                                        <td><span style="background:#eff6ff;color:var(--brand);font-size:9px;font-weight:900;padding:2px 7px;border-radius:99px;">{{ $rep->issue_type }}</span></td>
                                        <td>
                                            <div style="font-size:10px;font-weight:800;color:var(--text);">{{ $rep->complainant_name }}</div>
                                            <div style="font-size:9px;color:var(--muted);font-weight:600;">vs. {{ $rep->respondent_name ?? '—' }}</div>
                                        </td>
                                        <td><span class="spill {{ $stCls }}"><i class="fas fa-circle" style="font-size:5px;"></i> {{ ucfirst(str_replace('_',' ',$rep->status)) }}</span></td>
                                        <td style="text-align:right;">
                                            <button type="button" class="btn-icon" title="View & Issue Document"
                                                    @click="openView({
                                                        id: {{ $rep->id }},
                                                        case_no: '{{ $caseNo }}',
                                                        issue_type: '{{ addslashes($rep->issue_type) }}',
                                                        complainant: '{{ addslashes($rep->complainant_name ?? '') }}',
                                                        contact: '{{ addslashes($rep->contact ?? '') }}',
                                                        respondent: '{{ addslashes($rep->respondent_name ?? '') }}',
                                                        description: '{{ addslashes($rep->description ?? '') }}',
                                                        location: '{{ addslashes($rep->location ?? '') }}',
                                                        incident_date: '{{ $rep->incident_date ? \Carbon\Carbon::parse($rep->incident_date)->format('M d, Y') : 'N/A' }}',
                                                        witness_name: '{{ addslashes($rep->witness_name ?? '') }}',
                                                        evidence: @js($rep->evidence),
                                                        status: '{{ $rep->status }}',
                                                        hearing_date: '{{ $rep->hearing_date ? \Carbon\Carbon::parse($rep->hearing_date)->format('M d, Y h:i A') : '' }}',
                                                        is_restricted: {{ $rep->is_restricted ? 'true' : 'false' }},
                                                        user_id: {{ $rep->user_id ?: 'null' }},
                                                        date_filed: '{{ $rep->created_at->format('M d, Y h:i A') }}'
                                                    })">
                                                <i class="fas fa-file-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5"><div class="empty-st"><i class="fas fa-inbox"></i><p>No records found.</p></div></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ KP REPORTS TAB (EDITABLE KATARUNGANG PAMBARANGAY FORM 7 MATRIX, EXPORT PDF & SEND TO ADMIN) ══ --}}
        <div x-show="activeTab==='reports'" x-transition>
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-title"><i class="fas fa-file-invoice" style="color:var(--brand);"></i> Katarungang Pambarangay (KP) Monthly Monitoring Report</div>
                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                        <button type="button" @click="templateUploadModal=true" class="btn btn-ghost btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-cloud-upload-alt"></i> Format / Template
                        </button>
                        <button type="button" @click="printJusticeReport()" class="btn btn-ghost btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-print"></i> Export / Print PDF
                        </button>
                        <form action="{{ route('department.reports.submit') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="department" value="Justice">
                            <input type="hidden" name="report_title" value="MONITORING REPORT ON THE IMPLEMENTATION OF KATARUNGANG PAMBARANGAY">
                            <input type="hidden" name="reporting_period" :value="justiceRep.monthYear">
                            <input type="hidden" name="report_data" :value="JSON.stringify(justiceRep)">
                            <input type="hidden" name="submitted_by" :value="justiceRep.preparedBy">
                            <input type="hidden" name="submitted_role" :value="justiceRep.preparedRole">
                            <button type="submit" class="btn btn-sm" style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#059669,#064e3b);color:#fff;">
                                <i class="fas fa-paper-plane"></i> Send / Transfer to Admin
                            </button>
                        </form>
                    </div>
                </div>

                <div style="padding:20px;background:#f8fafc;border-bottom:1px solid var(--border);">
                    <div id="justice-printable-report" style="background:#fff;padding:24px;border-radius:12px;border:1.5px solid #cbd5e1;box-shadow:0 4px 12px rgba(0,0,0,0.04);font-family:'Times New Roman', serif;color:#000;">
                        {{-- 3 LOGOS AND OFFICIAL LETTERHEAD --}}
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
                                OFFICE OF THE LUPON TAGAPAMAYAPA
                            </div>
                            <div style="border-bottom:1.5px solid #000; width:100%; margin:8px auto 14px;"></div>

                            <div style="font-size:13px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em;">
                                Office of the Punong Barangay / Lupon Chairman
                            </div>
                            <div style="font-size:12.5px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em; margin-top:2px;">
                                MONITORING REPORT ON THE IMPLEMENTATION OF KATARUNGANG PAMBARANGAY (KP FORM 7)
                            </div>
                            <div style="font-size:11.5px; font-weight:bold; text-transform:uppercase; margin-top:3px; display:flex; align-items:center; justify-content:center; gap:6px;">
                                FOR THE MONTH OF 
                                <input type="text" x-model="justiceRep.monthYear" title="Click to edit Month & Year"
                                       style="font-weight:bold; text-transform:uppercase; width:160px; text-align:center; font-family:'Times New Roman', serif; font-size:11.5px; border-bottom:1px solid #000; border-top:none; border-left:none; border-right:none; background:transparent; outline:none;">
                            </div>
                        </div>

                        {{-- Sub Meta Top-Left --}}
                        <div style="font-size:11px; margin-bottom:10px; line-height:1.4;">
                            <div><strong>Province:</strong> <input type="text" x-model="justiceRep.province" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:120px; font-weight:bold; background:transparent;"></div>
                            <div><strong>City:</strong> <input type="text" x-model="justiceRep.city" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                            <div><strong>Barangay:</strong> <input type="text" x-model="justiceRep.barangay" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                        </div>

                        {{-- Official KP Matrix Table --}}
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
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.criminalCases" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.civilCases" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.othersCases" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="justiceRep.totalCases"></td>

                                        {{-- Settled breakdown --}}
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.settledMediation" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.settledConciliation" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.settledArbitration" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="justiceRep.totalSettled"></td>

                                        {{-- Unsettled breakdown --}}
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.withdrawnCases" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.repudiatedCases" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.certToCourt" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="justiceRep.pendingCases" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="(Number(justiceRep.withdrawnCases)||0) + (Number(justiceRep.repudiatedCases)||0) + (Number(justiceRep.certToCourt)||0) + (Number(justiceRep.pendingCases)||0)"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Signatures Footer --}}
                        <div style="margin-top:40px; display:flex; justify-content:space-between; align-items:flex-start; padding:0 24px;">
                            <div style="width:240px; text-align:left;">
                                <div style="font-size:11px;">Prepared by :</div>
                                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                                    <input type="text" x-model="justiceRep.preparedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                                </div>
                                <div style="text-align:center; margin-top:2px;">
                                    <input type="text" x-model="justiceRep.preparedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </div>
                            </div>

                            <div style="width:240px; text-align:left;">
                                <div style="font-size:11px;">Noted by:</div>
                                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                                    <input type="text" x-model="justiceRep.notedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                                </div>
                                <div style="text-align:center; margin-top:2px;">
                                    <input type="text" x-model="justiceRep.notedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBMITTED REPORTS HISTORY TABLE --}}
                <div style="padding:16px 20px;">
                    <div style="font-size:11px;font-weight:900;color:var(--text);text-transform:uppercase;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-history" style="color:var(--brand);"></i> Submitted KP Monitoring Reports to Admin History
                    </div>
                    <table class="ptbl">
                        <thead><tr>
                            <th>Report Title</th>
                            <th>Period</th>
                            <th>Submitted By</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr></thead>
                        <tbody>
                            @forelse(($justiceReports ?? collect()) as $rep)
                            <tr>
                                <td><div style="font-size:11px;font-weight:900;color:var(--text);">{{ $rep->report_title }}</div></td>
                                <td><span class="spill spill-open" style="font-size:9.5px;">{{ $rep->reporting_period }}</span></td>
                                <td><div style="font-size:11px;font-weight:700;">{{ $rep->submitted_by }} <span style="font-size:9px;color:var(--muted);">({{ $rep->submitted_role }})</span></div></td>
                                <td><div style="font-size:11px;color:var(--brand);font-weight:800;">{{ $rep->created_at->format('M d, Y h:i A') }}</div></td>
                                <td><span class="spill spill-closed" style="font-size:9px;"><i class="fas fa-check-circle"></i> {{ $rep->status }}</span></td>
                                <td style="text-align:right;">
                                    <div style="display:inline-flex;gap:6px;">
                                        <a href="{{ route('department.reports.show', $rep->id) }}" target="_blank" class="btn btn-sm btn-primary" title="Preview / Print Landscape Report">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($rep->template_file)
                                        <a href="{{ asset('storage/' . $rep->template_file) }}" target="_blank" class="btn btn-sm btn-ghost" title="View Attached Template">
                                            <i class="fas fa-paperclip"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6"><div class="empty-st"><i class="fas fa-file-invoice"></i><p style="font-size:11px;font-weight:700;">No KP monitoring reports submitted to admin yet.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ ADD BLOTTER MODAL ══ --}}
        <div x-show="blotterModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="blotterModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-book"></i></div>
                            <div>
                                <div>New Blotter Entry</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Katarungang Pambarangay — Barangay San Miguel II</div>
                            </div>
                        </div>
                        <button @click="blotterModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('justice.blotter.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="fgrp">
                            <label class="flbl">Type of Case <span class="req">*</span></label>
                            <select name="issue_type" class="finput fselect" required>
                                <option value="">— Select Case Type —</option>
                                <option>Dispute over Property</option>
                                <option>Noise / Disturbance</option>
                                <option>Verbal Altercation</option>
                                <option>Physical Altercation</option>
                                <option>Debt / Lending Dispute</option>
                                <option>Neighbor Dispute</option>
                                <option>Family Dispute</option>
                                <option>Barangay Ordinance Violation</option>
                                <option>Estafa / Fraud</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user" style="color:var(--brand);"></i> Complainant Information</div>
                            <div class="fgrid2">
                                <div class="fgrp"><label class="flbl">Full Name <span class="req">*</span></label><input type="text" name="complainant_name" class="finput" placeholder="Juan Dela Cruz" required></div>
                                <div class="fgrp"><label class="flbl">Contact Number <span class="req">*</span></label><input type="text" name="contact" class="finput" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required></div>
                                <div class="fgrp"><label class="flbl">Age *</label><input type="number" name="complainant_age" class="finput" placeholder="Min. 18" min="18" required></div>
                                <div class="fgrp"><label class="flbl">Gender</label><select name="complainant_gender" class="finput fselect"><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select></div>
                            </div>
                        </div>
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user-slash" style="color:var(--danger);"></i> Respondent Information</div>
                            <div class="fgrid2">
                                <div class="fgrp fspan2"><label class="flbl">Full Name <span class="req">*</span></label><input type="text" name="respondent_name" class="finput" placeholder="Name of respondent" required></div>
                                <div class="fgrp fspan2"><label class="flbl">Address</label><input type="text" name="respondent_address" class="finput" placeholder="Respondent's address"></div>
                            </div>
                        </div>
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-map-marker-alt" style="color:var(--brand);"></i> Incident Details</div>
                            <div class="fgrid2">
                                <div class="fgrp"><label class="flbl">Date of Incident <span class="req">*</span></label><input type="date" name="incident_date" class="finput" required max="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-6 months')) }}"></div>
                                <div class="fgrp"><label class="flbl">Location <span class="req">*</span></label><input type="text" name="incident_location" class="finput" placeholder="Purok, Street, Block..." required></div>
                                <div class="fgrp fspan2"><label class="flbl">Description / Narration <span class="req">*</span></label><textarea name="description" rows="4" class="finput" style="resize:vertical;" placeholder="Describe the incident clearly and completely..." required></textarea></div>
                                <div class="fgrp"><label class="flbl">Witness Name (Optional)</label><input type="text" name="witness_name" class="finput" placeholder="Name of witness"></div>
                                <div class="fgrp fspan2" x-data="{ filesCount: 0, fileNames: '', isDragging: false }">
                                    <label class="flbl">Upload Evidence Files (Max 5 files • JPG, PNG, PDF max 5MB • MP4 max 25MB)</label>
                                    <div class="upload-card"
                                         :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                         @click="$refs.evidenceInput.click()"
                                         @dragover.prevent="isDragging = true"
                                         @dragleave.prevent="isDragging = false"
                                         @drop.prevent="isDragging = false; if ($event.dataTransfer.files.length > 5) { alert('You can only upload a maximum of 5 files.'); return; } $refs.evidenceInput.files = $event.dataTransfer.files; filesCount = $refs.evidenceInput.files.length; fileNames = Array.from($refs.evidenceInput.files).map(f => f.name).join(', ')">
                                        <i class="fas fa-cloud-upload-alt" style="font-size:16px;color:var(--brand);"></i>
                                        <div class="upload-txt" style="font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:600;color:var(--text);" x-text="filesCount > 0 ? filesCount + ' file(s) selected (Max 5)' : 'Choose up to 5 files or drag & drop (JPG, PNG, PDF, MP4)'"></div>
                                        <input type="file" x-ref="evidenceInput" name="evidence[]" multiple accept=".jpg,.jpeg,.png,.pdf,.mp4" style="display:none;" @change="if ($event.target.files.length > 5) { alert('You can only select up to 5 files.'); $event.target.value = ''; filesCount = 0; fileNames = ''; return; } filesCount = $event.target.files.length; fileNames = Array.from($event.target.files).map(f => f.name).join(', ')">
                                    </div>
                                    <div x-show="filesCount > 0" style="font-size:9px;color:var(--brand);font-weight:700;margin-top:3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" x-text="fileNames"></div>
                                </div>

                                <div class="fgrp fspan2">
                                    <label class="flbl">External Cloud Evidence Link (Optional — Google Drive / CCTV Video Link)</label>
                                    <div style="position:relative;">
                                        <input type="url" name="external_evidence_link" class="finput" placeholder="https://drive.google.com/..." style="padding-left:32px;">
                                        <i class="fab fa-google-drive" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#059669;font-size:14px;"></i>
                                    </div>
                                    <div style="font-size:8.5px;color:var(--muted);margin-top:2px;font-weight:600;">Use for heavy CCTV video files to prevent server storage bloat.</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="department" value="Justice">
                        <input type="hidden" name="status" value="submitted">
                        <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;padding:9px 13px;margin-bottom:14px;font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:700;color:var(--brand-dark);display:flex;align-items:center;gap:6px;">
                            <i class="fas fa-info-circle" style="color:var(--brand);font-size:13px;flex-shrink:0;"></i>
                            <span>Fields marked <span style="color:var(--danger);">*</span> are required. Entry will be saved to the official Barangay Blotter.</span>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="blotterModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Blotter Entry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ ISSUE SUMMONS MODAL ══ --}}
        {{-- ══ CREATE HEARING SCHEDULE MODAL ══ --}}
        <div x-show="summonModal" x-cloak class="modal-ov" x-transition style="z-index:99998;">
            <div class="modal-box" @click.away="summonModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-envelope-open-text"></i></div>
                            <div>
                                <div>Create Hearing Sched</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Generate Notice & Issue Summons (KP Form No. 8)</div>
                            </div>
                        </div>
                        <button type="button" @click.prevent="summonModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form @submit.prevent="promptConfirmSchedule()">
                        <div class="sblk" style="margin-bottom:14px;">
                            <label class="flbl">Select Active Case <span class="req">*</span></label>
                            <select name="issue_id" class="finput fselect" required x-model="selectedIssueId">
                                <option value="">— Select Case —</option>
                                @foreach($reports->whereNotIn('status',['settled','resolved']) as $rep)
                                    @php $cno = 'JUS-'.$rep->created_at->format('Y').'-'.str_pad($rep->id,3,'0',STR_PAD_LEFT); @endphp
                                    <option value="{{ $rep->id }}">#{{ $cno }} : {{ $rep->complainant_name }} (vs {{ $rep->respondent_name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-calendar-alt"></i> Select Hearing Date</div>
                            
                            {{-- MODAL CALENDAR --}}
                            <div style="background:#fff; border:1px solid var(--border); border-radius:12px; padding:12px; margin-top:8px;">
                                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                                    <button type="button" @click="prevCal()" :disabled="!canPrevCal" class="btn-icon" :style="!canPrevCal ? 'opacity:0.3; cursor:not-allowed;' : ''"><i class="fas fa-chevron-left"></i></button>
                                    <div style="font-size:11px; font-weight:900; text-transform:uppercase; letter-spacing:.05em;" x-text="mName + ' ' + calYear"></div>
                                    <button type="button" @click="nextCal()" :disabled="!canNextCal" class="btn-icon" :style="!canNextCal ? 'opacity:0.3; cursor:not-allowed;' : ''"><i class="fas fa-chevron-right"></i></button>
                                </div>
                                <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:4px; text-align:center; margin-bottom:6px;">
                                    <template x-for="w in ['S','M','T','W','T','F','S']">
                                        <div style="font-size:8px; font-weight:900; color:var(--light);" x-text="w"></div>
                                    </template>
                                </div>
                                <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:4px;">
                                    <template x-for="d in calDays">
                                        <button type="button" @click="selDate(d)" 
                                             :disabled="!d || isPastDate(d)"
                                             style="border-radius:8px; padding:8px 0; font-size:11px; font-weight:800; transition:all 0.15s; border:1px solid transparent; display:flex; align-items:center; justify-content:center; min-height:32px;"
                                             :class="d ? (isSelDate(d) ? 'btn-primary' : (isPastDate(d) ? 'opacity-25 cursor-not-allowed bg-slate-50 text-slate-400' : 'btn-ghost hover:scale-105 bg-transparent')) : 'invisible'"
                                             :style="d && !isPastDate(d) && !isSelDate(d) ? 'border:1px solid #e2e8f0;' : ''">
                                            <span x-text="d || ''"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                            
                            <input type="hidden" name="hearing_date" x-model="scheduledDate">

                            <div style="margin-top:14px;">
                                <div style="margin-bottom:8px;">
                                    <label class="flbl" style="margin-bottom:0;">
                                        <i class="fas fa-clock" style="color:var(--brand);margin-right:4px;"></i> Select Hearing Time for <span x-text="formatDateDisplay(scheduledDate)" style="color:var(--brand);font-weight:900;"></span>
                                    </label>
                                </div>

                                {{-- Today past 5pm notice --}}
                                <template x-if="scheduledDate === getTodayDateStr() && isTodayPast5PM">
                                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:9px 12px;font-size:10px;font-weight:700;color:#991b1b;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                                        <i class="fas fa-exclamation-triangle"></i> Sched for today is closed (past 5:00 PM). Please choose tomorrow or another day.
                                    </div>
                                </template>

                                <div class="time-slot-grid">
                                    <template x-for="slot in slotsList" :key="slot.time">
                                        <label style="position:relative;display:block;"
                                               :style="getSlotStatus(slot.time) !== 'available' ? 'cursor:not-allowed;' : 'cursor:pointer;'">
                                            <input type="radio" name="time" :value="slot.val" x-model="selectedTimeSlot"
                                                   :disabled="getSlotStatus(slot.time) !== 'available'" required style="position:absolute;opacity:0;pointer-events:none;">
                                            <div class="slot-card"
                                                 :class="{
                                                     'slot-selected': selectedTimeSlot === slot.val && getSlotStatus(slot.time) === 'available',
                                                     'slot-available': selectedTimeSlot !== slot.val && getSlotStatus(slot.time) === 'available',
                                                     'slot-occupied': getSlotStatus(slot.time) === 'occupied',
                                                     'slot-past': getSlotStatus(slot.time) === 'past'
                                                 }">
                                                <div style="display:flex;align-items:center;justify-content:center;gap:5px;">
                                                    <span class="slot-time" x-text="slot.time"></span>
                                                    <template x-if="selectedTimeSlot === slot.val && getSlotStatus(slot.time) === 'available'">
                                                        <i class="fas fa-check-circle" style="font-size:10px;color:#38bdf8;"></i>
                                                    </template>
                                                </div>
                                                <template x-if="getSlotStatus(slot.time) === 'occupied'">
                                                    <span class="slot-badge slot-badge-occupied"><i class="fas fa-times-circle" style="font-size:6px;"></i> Booked</span>
                                                </template>
                                                <template x-if="getSlotStatus(slot.time) === 'past'">
                                                    <span class="slot-badge slot-badge-past"><i class="fas fa-history" style="font-size:6px;"></i> Closed</span>
                                                </template>
                                            </div>
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:9px;padding:9px 13px;margin:14px 0;font-size:10px;font-weight:700;color:#92400e;line-height:1.5;">
                            <i class="fas fa-info-circle"></i> Selecting a slot will notify the resident via Email and queue an SMS summary text.
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click.prevent="summonModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-calendar-check"></i> Proceed to Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ HEARING SCHEDULE CONFIRMATION & RESIDENT NOTIFICATION DISPATCH MODAL ══ --}}
        <div x-show="confirmScheduleModal" x-cloak class="modal-ov" x-transition style="z-index:999999;">
            <div class="modal-box" @click.away="confirmScheduleModal=false" style="max-width:480px;border-top:4px solid #4338ca;">
                <div class="modal-in">
                    <div class="modal-hd" style="border-bottom:1px solid var(--border);padding-bottom:12px;">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eef2ff;color:#4338ca;"><i class="fas fa-bell"></i></div>
                            <div>
                                <div style="font-size:13px;font-weight:900;">Confirm Hearing Schedule</div>
                                <div style="font-size:9.5px;color:var(--muted);">Dispatches automated Notice/Summons & SMS alerts</div>
                            </div>
                        </div>
                        <button type="button" @click.prevent="confirmScheduleModal=false" class="modal-close"><i class="fas fa-times"></i></button>
                    </div>

                    <div style="padding:14px 0;">
                        <!-- Schedule Summary Card -->
                        <div style="background:#f8fafc;border:1.5px solid var(--border);border-radius:12px;padding:14px;margin-bottom:14px;">
                            <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:10px;">
                                <span style="color:var(--muted);font-weight:700;">Case Selected:</span>
                                <span style="font-weight:900;color:var(--brand);" x-text="confirmCaseSummary.case_no ? ('Case #' + confirmCaseSummary.case_no) : 'Selected Case'"></span>
                            </div>
                            <div style="display:flex;justify-content:space-between;margin-bottom:8px;font-size:10px;">
                                <span style="color:var(--muted);font-weight:700;">Complainant:</span>
                                <span style="font-weight:800;color:var(--text);" x-text="confirmCaseSummary.complainant"></span>
                            </div>
                            <div style="display:flex;justify-content:space-between;margin-bottom:10px;font-size:10px;">
                                <span style="color:var(--muted);font-weight:700;">Respondent:</span>
                                <span style="font-weight:800;color:#991b1b;" x-text="confirmCaseSummary.respondent"></span>
                            </div>
                            <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;padding:10px;display:flex;align-items:center;gap:10px;">
                                <div style="width:32px;height:32px;border-radius:8px;background:var(--brand);color:#fff;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand-dark);" x-text="formatDateDisplay(scheduledDate)"></div>
                                    <div style="font-size:10px;font-weight:800;color:#2563eb;">Time Slot: <span x-text="selectedTimeSlotLabel"></span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Notification Warning Box -->
                        <div style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:10px;padding:12px;display:flex;gap:10px;">
                            <i class="fas fa-exclamation-triangle" style="color:#d97706;font-size:16px;margin-top:2px;"></i>
                            <div style="font-size:9.5px;color:#92400e;line-height:1.5;">
                                <div style="font-weight:900;margin-bottom:2px;">Automated Resident Notifications Will Be Dispatched:</div>
                                <div>• <strong>Official Email:</strong> Summon & Notice with hearing details sent to resident's email.</div>
                                <div>• <strong>SMS Notification:</strong> Queued summary message to registered mobile contact.</div>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:8px;border-top:1px solid var(--border);padding-top:12px;">
                        <button type="button" @click.prevent="confirmScheduleModal=false" class="btn btn-ghost">Modify / Back</button>
                        <button type="button" @click.prevent="submitHearingScheduleAjax()" :disabled="isSubmittingSchedule" class="btn btn-primary" style="background:#4338ca;box-shadow:0 2px 8px rgba(67,56,202,0.35);">
                            <span x-show="!isSubmittingSchedule"><i class="fas fa-paper-plane"></i> Yes, Confirm & Dispatch</span>
                            <span x-show="isSubmittingSchedule"><i class="fas fa-spinner fa-spin"></i> Dispatching...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ VIEW RECORD MODAL (POPUP DIALOG WITH CASE ACTION MENU) ══ --}}
        <div x-show="viewModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="viewModal=false" style="max-width:620px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-eye"></i></div>
                            <div>
                                <div x-text="'Case #' + (activeRecord?.case_no ?? '')"></div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Blotter Record — Barangay San Miguel II</div>
                            </div>
                        </div>
                        <button type="button" @click.prevent="viewModal=false" class="modal-close" title="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <template x-if="activeRecord">
                        <div>
                            <div style="margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                                <div>
                                    <template x-if="activeRecord.status==='submitted'"><span class="spill spill-open"><i class="fas fa-circle" style="font-size:6px;"></i> Open / Submitted</span></template>
                                    <template x-if="activeRecord.status==='under_review'"><span class="spill spill-open"><i class="fas fa-calendar-check" style="font-size:7px;"></i> Hearing Scheduled</span></template>
                                    <template x-if="activeRecord.status==='pending'"><span class="spill spill-pending"><i class="fas fa-clock" style="font-size:7px;"></i> Pending</span></template>
                                    <template x-if="activeRecord.status==='settled'||activeRecord.status==='resolved'"><span class="spill spill-closed"><i class="fas fa-check-circle" style="font-size:8px;"></i> Settled (KP Form 16)</span></template>
                                    <template x-if="activeRecord.status==='escalated'||activeRecord.status==='unresolved'"><span class="spill spill-urgent"><i class="fas fa-gavel" style="font-size:8px;"></i> Escalated / CFA (KP Form 20)</span></template>
                                </div>
                                <div x-show="activeRecord.hearing_date" style="font-size:10px;color:var(--brand);font-weight:800;background:#eff6ff;padding:3px 8px;border-radius:6px;">
                                    <i class="fas fa-calendar-alt"></i> Hearing: <span x-text="activeRecord.hearing_date"></span>
                                </div>
                            </div>

                            <div class="vfield" style="background:#eff6ff;border-color:#bfdbfe;margin-bottom:12px;">
                                <div class="vfield-lbl">Case Type / Complaint Issue</div>
                                <div class="vfield-val" style="font-size:14px;font-weight:900;color:var(--brand);" x-text="activeRecord.issue_type"></div>
                            </div>

                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:12px;">
                                <div class="vfield">
                                    <div class="vfield-lbl">Complainant</div>
                                    <div class="vfield-val">
                                        <span x-text="activeRecord.complainant || 'N/A'"></span>
                                        <template x-if="!activeRecord.user_id">
                                            <span class="wcard-badge" style="font-size:7px; background:#fee2e2; color:#dc2626; padding:2px 6px; vertical-align:middle; margin-left:4px; border-radius:4px; font-weight:900; text-transform:uppercase;">GUEST</span>
                                        </template>
                                    </div>
                                </div>
                                <div class="vfield"><div class="vfield-lbl">Contact Number</div><div class="vfield-val" x-text="activeRecord.contact || 'N/A'"></div></div>
                                <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Respondent</div><div class="vfield-val" style="font-weight:800;color:#991b1b;" x-text="activeRecord.respondent || 'N/A'"></div></div>
                                <div class="vfield"><div class="vfield-lbl">Date of Incident</div><div class="vfield-val" x-text="activeRecord.incident_date || 'N/A'"></div></div>
                                <div class="vfield"><div class="vfield-lbl">Incident Location</div><div class="vfield-val" x-text="activeRecord.location || 'N/A'"></div></div>
                                <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Date Filed</div><div class="vfield-val" x-text="activeRecord.date_filed"></div></div>
                                <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Witness Name</div><div class="vfield-val" x-text="activeRecord.witness_name || 'N/A'"></div></div>
                            </div>

                            <template x-if="activeRecord.admin_summary">
                                <div class="vfield" style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:10px;padding:12px;margin-bottom:12px;">
                                    <div class="vfield-lbl" style="color:#92400e;display:flex;align-items:center;gap:5px;">
                                        <i class="fas fa-gavel" style="color:#b45309;"></i> Endorsement / Escalation Notes
                                    </div>
                                    <div class="vfield-val" style="font-size:11.5px;font-weight:700;color:#78350f;white-space:pre-wrap;line-height:1.6;" x-text="activeRecord.admin_summary"></div>
                                </div>
                            </template>

                            <div class="vfield" style="margin-bottom:12px;">
                                <div class="vfield-lbl">Description / Incident Narration</div>
                                <div class="vfield-val" style="font-size:12px;font-weight:600;line-height:1.6;" x-text="activeRecord.description || 'No description provided.'"></div>
                            </div>

                            {{-- ══ UPLOADED EVIDENCE GALLERY GRID (MAX 5 FILES) ══ --}}
                            <div class="vfield" style="margin-bottom:14px;" x-show="parsedEvidenceList.length > 0">
                                <div class="vfield-lbl" style="display:flex;justify-content:space-between;align-items:center;">
                                    <span><i class="fas fa-paperclip"></i> Uploaded Evidence (<span x-text="parsedEvidenceList.length"></span> files)</span>
                                    <span style="font-size:7.5px;color:var(--muted);font-weight:700;">Max 5 files verified • Click to preview</span>
                                </div>
                                <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(130px, 1fr));gap:8px;margin-top:8px;">
                                    <template x-for="(ev, idx) in parsedEvidenceList" :key="idx">
                                        <div style="background:#fff;border:1.5px solid var(--border);border-radius:10px;overflow:hidden;transition:all .15s;display:flex;flex-direction:column;box-shadow:0 1px 3px rgba(0,0,0,.04);cursor:pointer;" @click="openEvidencePreview(ev)">
                                            <!-- Thumbnail Header -->
                                            <template x-if="['jpg','jpeg','png','webp','gif'].includes(ev.ext)">
                                                <div style="height:75px;background:#f1f5f9;overflow:hidden;position:relative;">
                                                    <img :src="'/storage/'+ev.path" style="width:100%;height:100%;object-fit:cover;">
                                                    <span style="position:absolute;top:4px;right:4px;background:rgba(0,0,0,.65);color:#fff;font-size:7px;font-weight:900;padding:1px 5px;border-radius:4px;text-transform:uppercase;" x-text="ev.ext"></span>
                                                </div>
                                            </template>
                                            <template x-if="ev.ext === 'pdf'">
                                                <div style="height:75px;background:#fee2e2;display:flex;align-items:center;justify-content:center;color:#dc2626;font-size:24px;position:relative;">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <span style="position:absolute;top:4px;right:4px;background:#dc2626;color:#fff;font-size:7px;font-weight:900;padding:1px 5px;border-radius:4px;">PDF</span>
                                                </div>
                                            </template>
                                            <template x-if="ev.ext === 'mp4'">
                                                <div style="height:75px;background:#ede9fe;display:flex;align-items:center;justify-content:center;color:#7c3aed;font-size:24px;position:relative;">
                                                    <i class="fas fa-video"></i>
                                                    <span style="position:absolute;top:4px;right:4px;background:#7c3aed;color:#fff;font-size:7px;font-weight:900;padding:1px 5px;border-radius:4px;">VIDEO</span>
                                                </div>
                                            </template>
                                            <template x-if="!['jpg','jpeg','png','webp','gif','pdf','mp4'].includes(ev.ext)">
                                                <div style="height:75px;background:#eff6ff;display:flex;align-items:center;justify-content:center;color:var(--brand);font-size:24px;">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                            </template>

                                            <!-- Metadata & Action -->
                                            <div style="padding:8px;display:flex;flex-direction:column;gap:3px;flex:1;justify-content:space-between;" @click.stop>
                                                <div>
                                                    <div style="font-size:9.5px;font-weight:800;color:var(--text);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" :title="ev.name" x-text="ev.name"></div>
                                                    <div style="font-size:8px;color:var(--muted);font-weight:600;" x-text="ev.size"></div>
                                                </div>
                                                <button type="button" @click="openEvidencePreview(ev)" style="margin-top:4px;background:#eff6ff;color:var(--brand);font-size:8.5px;font-weight:900;border:1px solid #bfdbfe;padding:4px 6px;border-radius:6px;text-align:center;display:flex;align-items:center;justify-content:center;gap:4px;cursor:pointer;width:100%;">
                                                    <i class="fas fa-eye" style="font-size:7px;"></i> View File
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- External Cloud Link Display if Present -->
                            <template x-if="extractCloudLink(activeRecord.description)">
                                <div style="background:#f0fdf4;border:1.5px solid #bbf7d0;border-radius:10px;padding:10px 12px;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap;">
                                    <div style="display:flex;align-items:center;gap:8px;">
                                        <div style="width:30px;height:30px;border-radius:8px;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:15px;">
                                            <i class="fab fa-google-drive"></i>
                                        </div>
                                        <div>
                                            <div style="font-size:10px;font-weight:900;color:#166534;">External Cloud Evidence (CCTV / Heavy Video)</div>
                                            <div style="font-size:8.5px;color:#15803d;font-weight:600;">Hosted on secure cloud storage link</div>
                                        </div>
                                    </div>
                                    <a :href="extractCloudLink(activeRecord.description)" target="_blank" class="btn btn-sm" style="background:#16a34a;color:#fff;text-decoration:none;font-size:9px;">
                                        <i class="fas fa-external-link-alt"></i> Open Cloud Drive
                                    </a>
                                </div>
                            </template>

                            <!-- ⭐ AUTOMATED KP FORMS ISSUANCE (STAGE-DRIVEN) ⭐ -->
                            <div style="background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:12px;padding:12px;margin-bottom:14px;">
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;flex-wrap:wrap;gap:6px;">
                                    <div style="font-size:10px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.06em;display:flex;align-items:center;gap:6px;">
                                        <i class="fas fa-stamp" style="color:var(--brand);"></i> Issue Official Katarungang Pambarangay Form
                                    </div>
                                    <span style="font-size:8px;background:#dbeafe;color:var(--brand-dark);font-weight:800;padding:2px 6px;border-radius:4px;">Draft View & Interactive Review</span>
                                </div>
                                <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                    <!-- KP 7 (Complaint) -->
                                    <button type="button" @click="openDocDraft('kp7', activeRecord)" class="btn btn-sm" :style="activeRecord.status==='submitted' ? 'background:var(--brand);color:#fff;box-shadow:0 2px 6px rgba(14,83,147,.3);' : 'background:#fff;color:var(--text);border:1px solid #cbd5e1;'" title="KP Form 7 - Complaint (Pagsusumbong)">
                                        <i class="fas fa-file-contract"></i> KP 7 (Complaint)
                                    </button>
                                    <!-- KP 8 (Notice of Hearing) -->
                                    <button type="button" @click="openDocDraft('kp8', activeRecord)" class="btn btn-sm" :style="activeRecord.status==='submitted' ? 'background:#2563eb;color:#fff;' : 'background:#fff;color:var(--text);border:1px solid #cbd5e1;'" title="KP Form 8 - Notice of Hearing">
                                        <i class="fas fa-bell"></i> KP 8 (Notice)
                                    </button>
                                    <!-- KP 9 (Summons) -->
                                    <button type="button" @click="openDocDraft('kp9', activeRecord)" class="btn btn-sm" :style="activeRecord.status==='under_review' ? 'background:#4338ca;color:#fff;' : 'background:#fff;color:var(--text);border:1px solid #cbd5e1;'" title="KP Form 9 - Summons to Respondent">
                                        <i class="fas fa-envelope-open-text"></i> KP 9 (Summons)
                                    </button>
                                    <!-- KP 12 (Conciliation Notice) -->
                                    <button type="button" @click="openDocDraft('kp12', activeRecord)" class="btn btn-sm" :style="activeRecord.status==='pending' ? 'background:#7c3aed;color:#fff;' : 'background:#fff;color:var(--text);border:1px solid #cbd5e1;'" title="KP Form 12 - Conciliation Notice">
                                        <i class="fas fa-users"></i> KP 12 (Conciliation)
                                    </button>
                                    <!-- KP 16 (Amicable Settlement) -->
                                    <button type="button" @click="openDocDraft('kp16', activeRecord)" class="btn btn-sm" :style="activeRecord.status==='settled'||activeRecord.status==='resolved' ? 'background:#059669;color:#fff;' : 'background:#fff;color:var(--text);border:1px solid #cbd5e1;'" title="KP Form 16 - Amicable Settlement">
                                        <i class="fas fa-handshake"></i> KP 16 (Settlement)
                                    </button>
                                    <!-- KP 20 (Certificate to File Action) -->
                                    <button type="button" @click="openDocDraft('kp20', activeRecord)" class="btn btn-sm" :style="activeRecord.status==='escalated'||activeRecord.status==='unresolved' ? 'background:#dc2626;color:#fff;' : 'background:#fff;color:var(--text);border:1px solid #cbd5e1;'" title="KP Form 20 - Certificate to File Action">
                                        <i class="fas fa-gavel"></i> KP 20 (CFA / Court)
                                    </button>
                                </div>
                            </div>

                            <!-- ⭐ CASE PROCEEDINGS & STATUS TRANSITION ACTIONS ⭐ -->
                            <div style="background:#f8fafc;border:1.5px solid var(--border);border-radius:12px;padding:12px;margin-bottom:14px;">
                                <div style="font-size:10px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;display:flex;align-items:center;gap:6px;">
                                    <i class="fas fa-tasks" style="color:var(--brand);"></i> Case Actions & Proceedings
                                </div>
                                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                    <!-- Schedule Hearing -->
                                    <button type="button" @click="selectedIssueId=activeRecord.id; summonModal=true" class="btn btn-sm" style="background:#eef2ff;color:#4338ca;border:1.5px solid #c7d2fe;">
                                        <i class="fas fa-calendar-plus"></i> Schedule Hearing
                                    </button>

                                    <!-- Issue Settlement (KP Form 16) -->
                                    <template x-if="activeRecord.status !== 'settled' && activeRecord.status !== 'resolved'">
                                        <button type="button" @click.prevent="promptConfirmSettlement()" class="btn btn-sm" style="background:#dcfce7;color:#15803d;border:1.5px solid #bbf7d0;">
                                            <i class="fas fa-handshake"></i> Finalize Settlement (KP Form 16)
                                        </button>
                                    </template>

                                    <!-- Issue Certificate to File Action (KP Form 20) -->
                                    <template x-if="activeRecord.status !== 'settled' && activeRecord.status !== 'resolved' && activeRecord.status !== 'escalated'">
                                        <button type="button" @click.prevent="promptConfirmEscalate()" class="btn btn-sm" style="background:#fee2e2;color:#dc2626;border:1.5px solid #fecaca;">
                                            <i class="fas fa-gavel"></i> Escalate to Court (KP Form 20)
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <div style="display:flex;justify-content:flex-end;">
                                <button type="button" @click.prevent="viewModal=false" class="btn btn-ghost">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- ══ IMPORT BLOTTER MODAL ══ --}}
        <div x-show="importModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="importModal=false" style="max-width: 600px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:var(--brand);"><i class="fas fa-file-excel"></i></div>
                            <div>
                                <div>Import Blotter Records</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Upload Excel (.xlsx, .xls) or CSV files into the Justice Portal</div>
                            </div>
                        </div>
                        <button @click="importModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ route('justice.import') }}" method="POST" enctype="multipart/form-data" x-data="{ importCount: 0, importFileName: '', isDragging: false }">
                        @csrf

                        {{-- TEMPLATE DOWNLOAD BANNER --}}
                        <div style="background:linear-gradient(135deg,#eff6ff 0%,#f0fdf4 100%);border:1.5px solid #bfdbfe;border-radius:12px;padding:12px 14px;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:9px;background:#dbeafe;display:flex;align-items:center;justify-content:center;color:var(--brand);font-size:15px;flex-shrink:0;">
                                    <i class="fas fa-file-csv"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand-dark);">Download Sample Template</div>
                                    <div style="font-size:9px;font-weight:600;color:var(--muted);">Use this pre-formatted CSV template to organize your data.</div>
                                </div>
                            </div>
                            <a href="{{ route('justice.sample.template') }}" class="btn btn-sm" style="background:var(--brand);color:#fff;text-decoration:none;box-shadow:0 2px 6px rgba(14,83,147,0.25);">
                                <i class="fas fa-download"></i> Get Template
                            </a>
                        </div>

                        {{-- UPLOAD DROPZONE --}}
                        <div class="sblk" style="margin-bottom:12px;">
                            <div class="sblk-ttl"><i class="fas fa-cloud-upload-alt" style="color:var(--brand);"></i> Select File To Import</div>
                            <div class="upload-card"
                                 :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                 @click="$refs.importFileInput.click()"
                                 @dragover.prevent="isDragging = true"
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="isDragging = false; $refs.importFileInput.files = $event.dataTransfer.files; importCount = $refs.importFileInput.files.length; importFileName = $refs.importFileInput.files[0]?.name || ''"
                                 style="padding:20px 14px;min-height:95px;border-width:2px;flex-direction:column;">
                                <i class="fas fa-file-excel" style="font-size:26px;color:#16a34a;margin-bottom:4px;"></i>
                                <div class="upload-txt" style="font-size:11px;font-weight:800;color:var(--text);" x-text="importFileName ? importFileName : 'Click to browse or drag & drop file here'"></div>
                                <div style="font-size:8.5px;font-weight:600;color:var(--muted);margin-top:2px;">Supported formats: .xlsx, .xls, .csv, .txt (Max: 10MB)</div>
                                <input type="file" x-ref="importFileInput" name="import_file" accept=".csv,.xlsx,.xls,.txt" style="display:none;" required @change="importCount = $event.target.files.length; importFileName = $event.target.files[0]?.name || ''">
                            </div>
                        </div>

                        {{-- GUIDELINES --}}
                        <div class="sblk" style="background:#f8fafc;border-radius:10px;padding:11px;margin-bottom:14px;">
                            <div class="sblk-ttl"><i class="fas fa-info-circle" style="color:var(--brand);"></i> Expected Columns</div>
                            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:5px;font-size:9px;font-weight:700;color:#475569;">
                                <div>• <span style="color:var(--brand);">Issue Type</span> (e.g. Noise Disturbance)</div>
                                <div>• <span style="color:var(--brand);">Complainant Name</span> (Full Name)</div>
                                <div>• <span style="color:var(--brand);">Contact Number</span> (e.g. 09123456789)</div>
                                <div>• <span style="color:var(--brand);">Respondent Name</span> (Full Name)</div>
                                <div>• <span style="color:var(--brand);">Incident Date</span> (YYYY-MM-DD)</div>
                                <div>• <span style="color:var(--brand);">Status</span> (submitted, pending, settled)</div>
                            </div>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="importModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" :disabled="!importFileName">
                                <i class="fas fa-file-import"></i> Upload & Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ EXPORT OPTIONS MODAL ══ --}}
        <div x-show="exportModal" x-cloak class="modal-ov" x-transition x-data="{ exportPeriod: 'all' }">
            <div class="modal-box" @click.away="exportModal=false" style="max-width:560px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:var(--brand);"><i class="fas fa-file-export"></i></div>
                            <div>
                                <div>Export Reports & Transmittals</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Piliin ang report at i-click ang PDF o CSV para i-export</div>
                            </div>
                        </div>
                        <button type="button" @click="exportModal=false" class="modal-close"><i class="fas fa-times"></i></button>
                    </div>

                    <!-- Date Scope Filter -->
                    <div style="display:flex;align-items:center;justify-content:space-between;background:#f8fafc;padding:8px 14px;border-radius:10px;border:1px solid var(--border);margin-bottom:12px;">
                        <span style="font-size:10px;font-weight:800;color:var(--brand-dark);display:flex;align-items:center;gap:6px;">
                            <i class="fas fa-calendar-alt" style="color:var(--brand);"></i> Filter Period / Saklaw:
                        </span>
                        <select x-model="exportPeriod" style="padding:4px 10px;font-size:10px;font-weight:800;border-radius:6px;border:1px solid var(--border);background:#fff;font-family:inherit;outline:none;cursor:pointer;">
                            <option value="all">Buong Kasaysayan (All Records)</option>
                            <option value="month">Kasalukuyang Buwan ({{ date('F Y') }})</option>
                            <option value="year">Kasalukuyang Taon ({{ date('Y') }})</option>
                        </select>
                    </div>

                    <!-- Clean Report Boxes -->
                    <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:14px;">
                        
                        <!-- Box 1: DILG Transmittal -->
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid var(--border);border-radius:10px;background:#fff;transition:all .15s;" onmouseover="this.style.borderColor='var(--brand)';this.style.background='#eff6ff';" onmouseout="this.style.borderColor='var(--border)';this.style.background='#fff';">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:36px;height:36px;border-radius:9px;background:#dbeafe;color:var(--brand);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand-dark);">DILG Monthly Transmittal Report</div>
                                    <div style="font-size:9px;color:var(--muted);font-weight:600;">Official DILG compliance matrix and dispute settlement rates</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:5px;flex-shrink:0;">
                                <button type="button" @click="exportModal=false; printDILGTransmittal(exportPeriod); triggerToast('success','PDF Generated','DILG Transmittal Report preview opened.');" class="btn btn-sm" style="background:#eff6ff;color:var(--brand);border:1px solid #bfdbfe;font-size:9px;padding:5px 10px;font-weight:900;" title="Print or Save PDF">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                                <a :href="'{{ route('justice.export') }}?report=dilg&period=' + exportPeriod" @click="exportModal=false; triggerToast('success','Exporting CSV','DILG Transmittal CSV is downloading.');" class="btn btn-sm" style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;font-size:9px;padding:5px 10px;font-weight:900;text-decoration:none;" title="Download CSV">
                                    <i class="fas fa-file-csv"></i> CSV
                                </a>
                            </div>
                        </div>

                        <!-- Box 2: Full Blotter Masterlist -->
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid var(--border);border-radius:10px;background:#fff;transition:all .15s;" onmouseover="this.style.borderColor='var(--brand)';this.style.background='#eff6ff';" onmouseout="this.style.borderColor='var(--border)';this.style.background='#fff';">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:36px;height:36px;border-radius:9px;background:#dbeafe;color:var(--brand);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">
                                    <i class="fas fa-list-alt"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand-dark);">Full Blotter & Justice Records</div>
                                    <div style="font-size:9px;color:var(--muted);font-weight:600;">Buong talaan ng mga kaso, parties, incident dates, at status</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:5px;flex-shrink:0;">
                                <button type="button" @click="exportModal=false; printBlotterMasterlist(exportPeriod); triggerToast('success','PDF Generated','Blotter Masterlist preview opened.');" class="btn btn-sm" style="background:#eff6ff;color:var(--brand);border:1px solid #bfdbfe;font-size:9px;padding:5px 10px;font-weight:900;">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                                <a :href="'{{ route('justice.export') }}?report=blotter&period=' + exportPeriod" @click="exportModal=false; triggerToast('success','Exporting CSV','Blotter spreadsheet is downloading.');" class="btn btn-sm" style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;font-size:9px;padding:5px 10px;font-weight:900;text-decoration:none;">
                                    <i class="fas fa-file-csv"></i> CSV
                                </a>
                            </div>
                        </div>

                        <!-- Box 3: Settlements Register -->
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid var(--border);border-radius:10px;background:#fff;transition:all .15s;" onmouseover="this.style.borderColor='#059669';this.style.background='#f0fdf4';" onmouseout="this.style.borderColor='var(--border)';this.style.background='#fff';">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:36px;height:36px;border-radius:9px;background:#dcfce7;color:#059669;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:#065f46;">Settlements & Amicable Agreements</div>
                                    <div style="font-size:9px;color:var(--muted);font-weight:600;">Lahat ng na-settle na kaso na may KP Form 16 references</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:5px;flex-shrink:0;">
                                <button type="button" @click="exportModal=false; printSettlementsList(exportPeriod); triggerToast('success','PDF Generated','Settlements register preview opened.');" class="btn btn-sm" style="background:#eff6ff;color:var(--brand);border:1px solid #bfdbfe;font-size:9px;padding:5px 10px;font-weight:900;">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                                <a :href="'{{ route('justice.export') }}?report=settled&period=' + exportPeriod" @click="exportModal=false; triggerToast('success','Exporting CSV','Settlements CSV is downloading.');" class="btn btn-sm" style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;font-size:9px;padding:5px 10px;font-weight:900;text-decoration:none;">
                                    <i class="fas fa-file-csv"></i> CSV
                                </a>
                            </div>
                        </div>

                        <!-- Box 4: Hearing Schedules -->
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid var(--border);border-radius:10px;background:#fff;transition:all .15s;" onmouseover="this.style.borderColor='#7c3aed';this.style.background='#f5f3ff';" onmouseout="this.style.borderColor='var(--border)';this.style.background='#fff';">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:36px;height:36px;border-radius:9px;background:#ede9fe;color:#7c3aed;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:#5b21b6;">Hearing & Summon Schedules</div>
                                    <div style="font-size:9px;color:var(--muted);font-weight:600;">Calendar masterlist of scheduled mediation and conciliation trials</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:5px;flex-shrink:0;">
                                <button type="button" @click="exportModal=false; printHearingSchedulesList(exportPeriod); triggerToast('success','PDF Generated','Hearing schedules preview opened.');" class="btn btn-sm" style="background:#eff6ff;color:var(--brand);border:1px solid #bfdbfe;font-size:9px;padding:5px 10px;font-weight:900;">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                                <a :href="'{{ route('justice.export') }}?report=hearings&period=' + exportPeriod" @click="exportModal=false; triggerToast('success','Exporting CSV','Hearing schedules CSV is downloading.');" class="btn btn-sm" style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;font-size:9px;padding:5px 10px;font-weight:900;text-decoration:none;">
                                    <i class="fas fa-file-csv"></i> CSV
                                </a>
                            </div>
                        </div>

                        <!-- Box 5: Annual Report -->
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px;border:1.5px solid var(--border);border-radius:10px;background:#fff;transition:all .15s;" onmouseover="this.style.borderColor='#d97706';this.style.background='#fef3c7';" onmouseout="this.style.borderColor='var(--border)';this.style.background='#fff';">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:36px;height:36px;border-radius:9px;background:#fef3c7;color:#d97706;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:#92400e;">Annual KP Accomplishment Report</div>
                                    <div style="font-size:9px;color:var(--muted);font-weight:600;">Executive summary of annual dispute resolutions and performance</div>
                                </div>
                            </div>
                            <div style="display:flex;gap:5px;flex-shrink:0;">
                                <button type="button" @click="exportModal=false; printAnnualSummary(exportPeriod); triggerToast('success','PDF Generated','Annual Accomplishment Report preview opened.');" class="btn btn-sm" style="background:#eff6ff;color:var(--brand);border:1px solid #bfdbfe;font-size:9px;padding:5px 10px;font-weight:900;">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                                <a :href="'{{ route('justice.export') }}?report=annual&period=' + exportPeriod" @click="exportModal=false; triggerToast('success','Exporting CSV','Annual report CSV is downloading.');" class="btn btn-sm" style="background:#f0fdf4;color:#15803d;border:1px solid #bbf7d0;font-size:9px;padding:5px 10px;font-weight:900;text-decoration:none;">
                                    <i class="fas fa-file-csv"></i> CSV
                                </a>
                            </div>
                        </div>

                    </div>

                    <div style="display:flex;justify-content:flex-end;">
                        <button type="button" @click="exportModal=false" class="btn btn-ghost">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ KP FORMS TEMPLATE MANAGEMENT MODAL ══ --}}
        <div x-show="formsModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="formsModal=false" style="max-width:760px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:var(--brand);"><i class="fas fa-stamp"></i></div>
                            <div>
                                <div>KP Form Templates & Document Settings</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Manage official legal templates, layout files, and signatory variables</div>
                            </div>
                        </div>
                        <button type="button" @click="formsModal=false" class="modal-close"><i class="fas fa-times"></i></button>
                    </div>

                    <!-- Global Signatory & Header Settings -->
                    <div class="sblk" style="margin-bottom:16px;">
                        <div class="sblk-ttl"><i class="fas fa-user-tie" style="color:var(--brand);"></i> Official Signatory & Header Variables (Auto-updates All Forms)</div>
                        <div class="fgrid2">
                            <div class="fgrp">
                                <label class="flbl">Punong Barangay / Lupon Chairman</label>
                                <input type="text" x-model="pbName" @input="saveSignatorySettings()" class="finput" placeholder="Hon. Punong Barangay Name">
                            </div>
                            <div class="fgrp">
                                <label class="flbl">Lupon Secretary Name</label>
                                <input type="text" x-model="secName" @input="saveSignatorySettings()" class="finput" placeholder="Lupon Secretary Name">
                            </div>
                            <div class="fgrp">
                                <label class="flbl">Barangay Jurisdiction</label>
                                <input type="text" x-model="jurisdiction" @input="saveSignatorySettings()" class="finput" placeholder="Barangay San Miguel II">
                            </div>
                            <div class="fgrp">
                                <label class="flbl">City / Province</label>
                                <input type="text" x-model="cityProvince" @input="saveSignatorySettings()" class="finput" placeholder="City of Dasmariñas, Cavite">
                            </div>
                        </div>
                    </div>

                    <!-- Templates Library -->
                    <div class="sblk-ttl" style="margin-bottom:10px;"><i class="fas fa-folder-open" style="color:var(--brand);"></i> Official KP Forms Catalog (View, Edit & Replace Layouts)</div>
                    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(210px, 1fr));gap:12px;margin-bottom:18px;">
                        
                        <!-- KP 7 -->
                        <div style="border:1.5px solid var(--border);border-radius:12px;padding:14px;background:#fff;display:flex;flex-direction:column;justify-content:space-between;gap:10px;box-shadow:0 1px 3px rgba(0,0,0,.04);">
                            <div>
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                                    <div style="font-size:11px;font-weight:900;color:var(--brand);">KP Form No. 7</div>
                                    <template x-if="customTemplates['kp7']">
                                        <span style="font-size:7.5px;font-weight:800;padding:2px 6px;border-radius:4px;background:#dcfce7;color:#166534;"><i class="fas fa-check-circle"></i> Custom File Active</span>
                                    </template>
                                </div>
                                <div style="font-size:10px;font-weight:800;color:var(--text);">Complaint (Pagsusumbong)</div>
                                <div style="font-size:8.5px;color:var(--muted);margin-top:3px;line-height:1.4;">Initial filing of dispute with relief demanded and narrative.</div>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <button type="button" @click.prevent="openDocDraft('kp7', null)" class="btn btn-sm" style="background:#eff6ff;color:var(--brand);border:1px solid #bfdbfe;width:100%;justify-content:center;font-size:9px;">
                                    <i class="fas fa-edit"></i> View / Edit Template
                                </button>
                                <label class="btn btn-sm btn-ghost" style="border:1px dashed #94a3b8;width:100%;justify-content:center;font-size:8.5px;cursor:pointer;color:var(--muted);">
                                    <i class="fas fa-upload"></i> Replace Layout Image/PDF
                                    <input type="file" accept=".pdf,.png,.jpg,.jpeg" style="display:none;" @change="handleTemplateUpload($event, 'kp7')">
                                </label>
                            </div>
                        </div>

                        <!-- KP 8 -->
                        <div style="border:1.5px solid var(--border);border-radius:12px;padding:14px;background:#fff;display:flex;flex-direction:column;justify-content:space-between;gap:10px;box-shadow:0 1px 3px rgba(0,0,0,.04);">
                            <div>
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                                    <div style="font-size:11px;font-weight:900;color:#2563eb;">KP Form No. 8</div>
                                    <template x-if="customTemplates['kp8']">
                                        <span style="font-size:7.5px;font-weight:800;padding:2px 6px;border-radius:4px;background:#dcfce7;color:#166534;"><i class="fas fa-check-circle"></i> Custom File Active</span>
                                    </template>
                                </div>
                                <div style="font-size:10px;font-weight:800;color:var(--text);">Notice of Hearing</div>
                                <div style="font-size:8.5px;color:var(--muted);margin-top:3px;line-height:1.4;">Notice to complainant for mediation appearance.</div>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <button type="button" @click.prevent="openDocDraft('kp8', null)" class="btn btn-sm" style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;width:100%;justify-content:center;font-size:9px;">
                                    <i class="fas fa-edit"></i> View / Edit Template
                                </button>
                                <label class="btn btn-sm btn-ghost" style="border:1px dashed #94a3b8;width:100%;justify-content:center;font-size:8.5px;cursor:pointer;color:var(--muted);">
                                    <i class="fas fa-upload"></i> Replace Layout Image/PDF
                                    <input type="file" accept=".pdf,.png,.jpg,.jpeg" style="display:none;" @change="handleTemplateUpload($event, 'kp8')">
                                </label>
                            </div>
                        </div>

                        <!-- KP 9 -->
                        <div style="border:1.5px solid var(--border);border-radius:12px;padding:14px;background:#fff;display:flex;flex-direction:column;justify-content:space-between;gap:10px;box-shadow:0 1px 3px rgba(0,0,0,.04);">
                            <div>
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                                    <div style="font-size:11px;font-weight:900;color:#4338ca;">KP Form No. 9</div>
                                    <template x-if="customTemplates['kp9']">
                                        <span style="font-size:7.5px;font-weight:800;padding:2px 6px;border-radius:4px;background:#dcfce7;color:#166534;"><i class="fas fa-check-circle"></i> Custom File Active</span>
                                    </template>
                                </div>
                                <div style="font-size:10px;font-weight:800;color:var(--text);">Summons (Patawag)</div>
                                <div style="font-size:8.5px;color:var(--muted);margin-top:3px;line-height:1.4;">Summons to respondent for mediation hearing.</div>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <button type="button" @click.prevent="openDocDraft('kp9', null)" class="btn btn-sm" style="background:#eff6ff;color:#4338ca;border:1px solid #bfdbfe;width:100%;justify-content:center;font-size:9px;">
                                    <i class="fas fa-edit"></i> View / Edit Template
                                </button>
                                <label class="btn btn-sm btn-ghost" style="border:1px dashed #94a3b8;width:100%;justify-content:center;font-size:8.5px;cursor:pointer;color:var(--muted);">
                                    <i class="fas fa-upload"></i> Replace Layout Image/PDF
                                    <input type="file" accept=".pdf,.png,.jpg,.jpeg" style="display:none;" @change="handleTemplateUpload($event, 'kp9')">
                                </label>
                            </div>
                        </div>

                        <!-- KP 12 -->
                        <div style="border:1.5px solid var(--border);border-radius:12px;padding:14px;background:#fff;display:flex;flex-direction:column;justify-content:space-between;gap:10px;box-shadow:0 1px 3px rgba(0,0,0,.04);">
                            <div>
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                                    <div style="font-size:11px;font-weight:900;color:#7c3aed;">KP Form No. 12</div>
                                    <template x-if="customTemplates['kp12']">
                                        <span style="font-size:7.5px;font-weight:800;padding:2px 6px;border-radius:4px;background:#dcfce7;color:#166534;"><i class="fas fa-check-circle"></i> Custom File Active</span>
                                    </template>
                                </div>
                                <div style="font-size:10px;font-weight:800;color:var(--text);">Conciliation Notice</div>
                                <div style="font-size:8.5px;color:var(--muted);margin-top:3px;line-height:1.4;">Notice for Pangkat Tagapagkasundo appearance.</div>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <button type="button" @click.prevent="openDocDraft('kp12', null)" class="btn btn-sm" style="background:#eff6ff;color:#7c3aed;border:1px solid #bfdbfe;width:100%;justify-content:center;font-size:9px;">
                                    <i class="fas fa-edit"></i> View / Edit Template
                                </button>
                                <label class="btn btn-sm btn-ghost" style="border:1px dashed #94a3b8;width:100%;justify-content:center;font-size:8.5px;cursor:pointer;color:var(--muted);">
                                    <i class="fas fa-upload"></i> Replace Layout Image/PDF
                                    <input type="file" accept=".pdf,.png,.jpg,.jpeg" style="display:none;" @change="handleTemplateUpload($event, 'kp12')">
                                </label>
                            </div>
                        </div>

                        <!-- KP 16 -->
                        <div style="border:1.5px solid var(--border);border-radius:12px;padding:14px;background:#fff;display:flex;flex-direction:column;justify-content:space-between;gap:10px;box-shadow:0 1px 3px rgba(0,0,0,.04);">
                            <div>
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                                    <div style="font-size:11px;font-weight:900;color:#059669;">KP Form No. 16</div>
                                    <template x-if="customTemplates['kp16']">
                                        <span style="font-size:7.5px;font-weight:800;padding:2px 6px;border-radius:4px;background:#dcfce7;color:#166534;"><i class="fas fa-check-circle"></i> Custom File Active</span>
                                    </template>
                                </div>
                                <div style="font-size:10px;font-weight:800;color:var(--text);">Amicable Settlement</div>
                                <div style="font-size:8.5px;color:var(--muted);margin-top:3px;line-height:1.4;">Formal written agreement binding both parties.</div>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <button type="button" @click.prevent="openDocDraft('kp16', null)" class="btn btn-sm" style="background:#eff6ff;color:#059669;border:1px solid #bfdbfe;width:100%;justify-content:center;font-size:9px;">
                                    <i class="fas fa-edit"></i> View / Edit Template
                                </button>
                                <label class="btn btn-sm btn-ghost" style="border:1px dashed #94a3b8;width:100%;justify-content:center;font-size:8.5px;cursor:pointer;color:var(--muted);">
                                    <i class="fas fa-upload"></i> Replace Layout Image/PDF
                                    <input type="file" accept=".pdf,.png,.jpg,.jpeg" style="display:none;" @change="handleTemplateUpload($event, 'kp16')">
                                </label>
                            </div>
                        </div>

                        <!-- KP 20 -->
                        <div style="border:1.5px solid var(--border);border-radius:12px;padding:14px;background:#fff;display:flex;flex-direction:column;justify-content:space-between;gap:10px;box-shadow:0 1px 3px rgba(0,0,0,.04);">
                            <div>
                                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;">
                                    <div style="font-size:11px;font-weight:900;color:#dc2626;">KP Form No. 20</div>
                                    <template x-if="customTemplates['kp20']">
                                        <span style="font-size:7.5px;font-weight:800;padding:2px 6px;border-radius:4px;background:#dcfce7;color:#166534;"><i class="fas fa-check-circle"></i> Custom File Active</span>
                                    </template>
                                </div>
                                <div style="font-size:10px;font-weight:800;color:var(--text);">Certificate to File Action</div>
                                <div style="font-size:8.5px;color:var(--muted);margin-top:3px;line-height:1.4;">CFA endorsement for higher court escalation.</div>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <button type="button" @click.prevent="openDocDraft('kp20', null)" class="btn btn-sm" style="background:#eff6ff;color:#dc2626;border:1px solid #bfdbfe;width:100%;justify-content:center;font-size:9px;">
                                    <i class="fas fa-edit"></i> View / Edit Template
                                </button>
                                <label class="btn btn-sm btn-ghost" style="border:1px dashed #94a3b8;width:100%;justify-content:center;font-size:8.5px;cursor:pointer;color:var(--muted);">
                                    <i class="fas fa-upload"></i> Replace Layout Image/PDF
                                    <input type="file" accept=".pdf,.png,.jpg,.jpeg" style="display:none;" @change="handleTemplateUpload($event, 'kp20')">
                                </label>
                            </div>
                        </div>

                    </div>

                    <div style="display:flex;justify-content:flex-end;">
                        <button type="button" @click.prevent="formsModal=false" class="btn btn-primary">Done</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ EVIDENCE PREVIEW MODAL (LIGHTBOX POPUP WITH CLOSE & DOWNLOAD) ══ --}}
        <div x-show="evidencePreviewModal" x-cloak class="modal-ov" x-transition style="z-index:99999;">
            <div class="modal-box" @click.away="evidencePreviewModal=false" style="max-width:800px;background:#0f172a;border-color:#334155;color:#fff;">
                <div class="modal-in" style="padding:16px;">
                    <div class="modal-hd" style="border-bottom:1px solid #334155;padding-bottom:10px;margin-bottom:14px;">
                        <div class="modal-ttl" style="color:#fff;">
                            <div class="modal-ico" style="background:#1e293b;color:#38bdf8;"><i class="fas fa-file-image"></i></div>
                            <div>
                                <div style="font-size:12px;font-weight:900;color:#fff;overflow:hidden;text-overflow:ellipsis;max-width:420px;white-space:nowrap;" x-text="previewingEvidence?.name || 'Evidence Preview'"></div>
                                <div style="font-size:9px;color:#94a3b8;" x-text="(previewingEvidence?.size || '') + ' • ' + (previewingEvidence?.ext?.toUpperCase() || '')"></div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <!-- Download Icon Button -->
                            <template x-if="previewingEvidence">
                                <a :href="'/storage/'+previewingEvidence.path" :download="previewingEvidence.name" class="btn btn-sm" style="background:#0284c7;color:#fff;text-decoration:none;padding:6px 12px;border-radius:8px;font-size:10px;" title="Download Evidence File">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </template>
                            <!-- Close Button -->
                            <button type="button" @click.prevent="evidencePreviewModal=false" class="modal-close" style="background:#1e293b;color:#fff;" title="Close Preview"><i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <!-- Preview Content Area -->
                    <div style="min-height:280px;max-height:65vh;overflow:auto;display:flex;align-items:center;justify-content:center;background:#020617;border-radius:10px;padding:10px;">
                        <!-- Image Preview -->
                        <template x-if="previewingEvidence && ['jpg','jpeg','png','webp','gif'].includes(previewingEvidence.ext)">
                            <img :src="'/storage/'+previewingEvidence.path" style="max-width:100%;max-height:60vh;object-fit:contain;border-radius:6px;box-shadow:0 4px 20px rgba(0,0,0,.5);">
                        </template>

                        <!-- PDF Preview -->
                        <template x-if="previewingEvidence && previewingEvidence.ext === 'pdf'">
                            <iframe :src="'/storage/'+previewingEvidence.path" style="width:100%;height:58vh;border:none;border-radius:6px;background:#fff;"></iframe>
                        </template>

                        <!-- Video (MP4) Preview -->
                        <template x-if="previewingEvidence && previewingEvidence.ext === 'mp4'">
                            <video controls autoplay :src="'/storage/'+previewingEvidence.path" style="max-width:100%;max-height:58vh;border-radius:6px;background:#000;"></video>
                        </template>

                        <!-- Fallback for other file types -->
                        <template x-if="previewingEvidence && !['jpg','jpeg','png','webp','gif','pdf','mp4'].includes(previewingEvidence.ext)">
                            <div style="text-align:center;padding:40px;color:#94a3b8;">
                                <i class="fas fa-file-alt" style="font-size:48px;color:#38bdf8;margin-bottom:12px;"></i>
                                <div style="font-size:13px;font-weight:800;color:#fff;" x-text="previewingEvidence.name"></div>
                                <div style="font-size:10px;margin-top:6px;">Preview not supported directly in browser for this file type.</div>
                                <a :href="'/storage/'+previewingEvidence.path" :download="previewingEvidence.name" class="btn btn-primary btn-sm" style="margin-top:14px;text-decoration:none;">
                                    <i class="fas fa-download"></i> Download File
                                </a>
                            </div>
                        </template>
                    </div>

                    <div style="display:flex;justify-content:flex-end;margin-top:12px;">
                        <button type="button" @click.prevent="evidencePreviewModal=false" class="btn btn-ghost" style="color:#94a3b8;border:1px solid #334155;">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ KP DOCUMENT DRAFT & INTERACTIVE VIEWER MODAL ══ --}}
        <div x-show="docDraftModal" x-cloak class="modal-ov" x-transition style="z-index:99998;">
            <div class="modal-box" @click.away="docDraftModal=false" style="max-width:860px;max-height:92vh;display:flex;flex-direction:column;">
                <div class="modal-in" style="display:flex;flex-direction:column;max-height:90vh;padding:0;">
                    
                    <!-- Sticky Action Controls Header -->
                    <div style="background:#0f172a;color:#fff;padding:14px 20px;border-top-left-radius:14px;border-top-right-radius:14px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;border-bottom:1px solid #334155;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:9px;background:#1e293b;display:flex;align-items:center;justify-content:center;color:#38bdf8;font-size:16px;">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <div>
                                <div style="font-size:12px;font-weight:900;color:#fff;" x-text="draftDoc.formNo + ' — ' + draftDoc.title"></div>
                                <div style="font-size:9px;color:#94a3b8;">Interactive Document Viewer & Template Editor</div>
                            </div>
                        </div>
                        
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                            <!-- Edit Content Toggle -->
                            <button type="button" @click.prevent="draftDoc.isEditing = !draftDoc.isEditing" class="btn btn-sm" :style="draftDoc.isEditing ? 'background:#10b981;color:#fff;' : 'background:#334155;color:#fff;border:1px solid #475569;'" title="Toggle Direct Text Editing">
                                <i class="fas" :class="draftDoc.isEditing ? 'fa-check' : 'fa-edit'"></i>
                                <span x-text="draftDoc.isEditing ? 'Done Editing' : 'Edit Content'"></span>
                            </button>

                            <!-- Print / Export PDF -->
                            <button type="button" @click.prevent="printCurrentDraft()" class="btn btn-sm" style="background:#0284c7;color:#fff;" title="Print or Export Document to PDF">
                                <i class="fas fa-print"></i> Print / Export PDF
                            </button>

                            <!-- Close Button -->
                            <button type="button" @click.prevent="docDraftModal=false" class="modal-close" style="background:#1e293b;color:#fff;margin:0;" title="Close"><i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <!-- Scrollable Document Sheet (8.5in Standard Paper Look) -->
                    <div style="flex:1;overflow-y:auto;background:#e2e8f0;padding:24px 16px;display:flex;justify-content:center;">
                        <div id="kp-printable-sheet" style="background:#fff;width:100%;max-width:780px;min-height:900px;padding:45px 55px;box-shadow:0 4px 20px rgba(0,0,0,.15);border-radius:4px;font-family:'Times New Roman',Times,serif;color:#000;position:relative;line-height:1.45;">
                            
                            <!-- Form No Top Left -->
                            <div style="position:absolute;top:35px;left:55px;font-size:10pt;font-weight:bold;" x-text="draftDoc.formNo"></div>

                            <!-- Header -->
                            <div style="text-align:center;margin-bottom:25px;">
                                <div style="font-size:10.5pt;">Republic of the Philippines</div>
                                <div style="font-size:10.5pt;" x-text="cityProvince"></div>
                                <div style="font-size:11pt;font-weight:bold;text-transform:uppercase;margin-top:2px;" x-text="jurisdiction"></div>
                                <div style="font-size:10.5pt;font-weight:bold;margin-top:3px;letter-spacing:1px;">OFFICE OF THE LUPONG TAGAPAMAYAPA</div>
                                <h2 style="font-size:16pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:2px;margin:12px 0 2px 0;" x-text="draftDoc.title"></h2>
                                <div style="font-size:10.5pt;font-style:italic;" x-show="draftDoc.subTitle" x-text="'(' + draftDoc.subTitle + ')'"></div>
                            </div>

                            <!-- Case Info Bar -->
                            <div style="display:flex;justify-content:space-between;margin-bottom:18px;font-size:11pt;gap:20px;">
                                <div style="flex:1;display:flex;align-items:center;gap:8px;">
                                    <span>Barangay Case No:</span>
                                    <template x-if="!draftDoc.isEditing">
                                        <span style="border-bottom:1px solid #000;flex:1;font-weight:bold;text-align:center;" x-text="draftDoc.caseNo || '___________________'"></span>
                                    </template>
                                    <template x-if="draftDoc.isEditing">
                                        <input type="text" x-model="draftDoc.caseNo" style="border:1px dashed #3b82f6;padding:2px 6px;flex:1;font-family:inherit;font-weight:bold;font-size:10.5pt;">
                                    </template>
                                </div>
                                <div style="flex:1;display:flex;align-items:center;gap:8px;">
                                    <span>For:</span>
                                    <template x-if="!draftDoc.isEditing">
                                        <span style="border-bottom:1px solid #000;flex:1;font-weight:bold;text-align:center;" x-text="draftDoc.forIssue || '___________________'"></span>
                                    </template>
                                    <template x-if="draftDoc.isEditing">
                                        <input type="text" x-model="draftDoc.forIssue" style="border:1px dashed #3b82f6;padding:2px 6px;flex:1;font-family:inherit;font-weight:bold;font-size:10.5pt;">
                                    </template>
                                </div>
                            </div>

                            <!-- Parties Grid -->
                            <div style="display:flex;justify-content:space-between;margin-bottom:15px;gap:20px;">
                                <div style="width:46%;">
                                    <template x-if="!draftDoc.isEditing">
                                        <div style="font-weight:bold;font-size:11.5pt;border-bottom:1px solid #000;padding-bottom:2px;text-transform:uppercase;text-align:center;" x-text="draftDoc.complainant || '___________________________'"></div>
                                    </template>
                                    <template x-if="draftDoc.isEditing">
                                        <input type="text" x-model="draftDoc.complainant" placeholder="Complainant Name" style="border:1px dashed #3b82f6;width:100%;padding:2px 6px;font-family:inherit;font-weight:bold;text-align:center;">
                                    </template>
                                    <div style="text-align:center;font-size:9.5pt;margin-top:2px;">Complainant/s (May-Sumbong)</div>
                                </div>
                                <div style="text-align:right;font-size:11pt;align-self:center;">— against —</div>
                            </div>

                            <div style="display:flex;justify-content:space-between;margin-bottom:22px;">
                                <div style="width:46%;">
                                    <template x-if="!draftDoc.isEditing">
                                        <div style="font-weight:bold;font-size:11.5pt;border-bottom:1px solid #000;padding-bottom:2px;text-transform:uppercase;text-align:center;" x-text="draftDoc.respondent || '___________________________'"></div>
                                    </template>
                                    <template x-if="draftDoc.isEditing">
                                        <input type="text" x-model="draftDoc.respondent" placeholder="Respondent Name" style="border:1px dashed #3b82f6;width:100%;padding:2px 6px;font-family:inherit;font-weight:bold;text-align:center;">
                                    </template>
                                    <div style="text-align:center;font-size:9.5pt;margin-top:2px;">Respondent/s (Ipinagsusumbong)</div>
                                </div>
                            </div>

                            <!-- Body Content / Narration / Clauses -->
                            <div style="font-size:11.5pt;line-height:1.55;margin-bottom:18px;">
                                <!-- Salutation / Heading -->
                                <template x-if="draftDoc.formType === 'kp8' || draftDoc.formType === 'kp9'">
                                    <div style="font-weight:bold;margin-bottom:12px;">
                                        TO: <span style="border-bottom:1px solid #000;padding:0 10px;font-weight:bold;" x-text="draftDoc.formType==='kp8' ? draftDoc.complainant : draftDoc.respondent"></span>
                                    </div>
                                </template>

                                <!-- Lead Paragraph -->
                                <div style="text-align:justify;text-indent:30px;margin-bottom:12px;">
                                    <template x-if="!draftDoc.isEditing">
                                        <span x-text="draftDoc.leadText"></span>
                                    </template>
                                    <template x-if="draftDoc.isEditing">
                                        <textarea x-model="draftDoc.leadText" rows="2" style="width:100%;border:1px dashed #3b82f6;padding:6px;font-family:inherit;font-size:11pt;"></textarea>
                                    </template>
                                </div>

                                <!-- Main Narrative Box (Complaint / Settlement / Summons) -->
                                <div style="border:1px solid #333;padding:12px;min-height:90px;font-size:11pt;line-height:1.6;margin-bottom:15px;background:#fafafa;">
                                    <template x-if="!draftDoc.isEditing">
                                        <div style="white-space:pre-wrap;" x-text="draftDoc.bodyText"></div>
                                    </template>
                                    <template x-if="draftDoc.isEditing">
                                        <textarea x-model="draftDoc.bodyText" rows="5" style="width:100%;border:none;background:transparent;outline:none;font-family:inherit;font-size:11pt;resize:vertical;" placeholder="Enter narrative text or template placeholders..."></textarea>
                                    </template>
                                </div>

                                <!-- Relief / Prayer / Terms -->
                                <template x-if="draftDoc.termsText">
                                    <div>
                                        <div style="text-indent:30px;margin-bottom:6px;">THEREFORE, the following conditions/terms are set:</div>
                                        <div style="border-bottom:1px solid #000;min-height:28px;margin-bottom:16px;">
                                            <template x-if="!draftDoc.isEditing">
                                                <span x-text="draftDoc.termsText"></span>
                                            </template>
                                            <template x-if="draftDoc.isEditing">
                                                <input type="text" x-model="draftDoc.termsText" style="border:1px dashed #3b82f6;width:100%;padding:2px 6px;font-family:inherit;">
                                            </template>
                                        </div>
                                    </div>
                                </template>

                                <!-- Date Issued / Made -->
                                <div style="margin-top:20px;">
                                    Issued/Made this <strong x-text="draftDoc.issueDay"></strong> day of <strong x-text="draftDoc.issueMonth"></strong>, <strong x-text="draftDoc.issueYear"></strong>.
                                </div>
                            </div>

                            <!-- Signatories Section -->
                            <div style="margin-top:40px;">
                                <template x-if="draftDoc.formType === 'kp16'">
                                    <div style="display:flex;justify-content:space-between;margin-bottom:30px;">
                                        <div style="text-align:center;width:220px;">
                                            <div style="border-top:1px solid #000;padding-top:4px;font-weight:bold;text-transform:uppercase;font-size:10pt;" x-text="draftDoc.complainant || 'Complainant'"></div>
                                            <div style="font-size:9pt;">Complainant</div>
                                        </div>
                                        <div style="text-align:center;width:220px;">
                                            <div style="border-top:1px solid #000;padding-top:4px;font-weight:bold;text-transform:uppercase;font-size:10pt;" x-text="draftDoc.respondent || 'Respondent'"></div>
                                            <div style="font-size:9pt;">Respondent</div>
                                        </div>
                                    </div>
                                </template>

                                <div style="display:flex;justify-content:space-between;margin-top:20px;">
                                    <div style="text-align:center;width:240px;" x-show="draftDoc.formType === 'kp20'">
                                        <div style="border-top:1px solid #000;padding-top:4px;font-weight:bold;text-transform:uppercase;font-size:10pt;" x-text="secName"></div>
                                        <div style="font-size:9pt;">Lupon / Pangkat Secretary</div>
                                    </div>
                                    <div style="text-align:center;width:240px;margin-left:auto;">
                                        <div style="border-top:1px solid #000;padding-top:4px;font-weight:bold;text-transform:uppercase;font-size:10pt;" x-text="pbName"></div>
                                        <div style="font-size:9pt;">Punong Barangay / Lupon Chairman</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Footer -->
                    <div style="background:#f8fafc;padding:12px 20px;border-bottom-left-radius:14px;border-bottom-right-radius:14px;border-top:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-size:9px;color:var(--muted);font-weight:700;"><i class="fas fa-info-circle"></i> You can edit text directly by clicking 'Edit Content' before printing.</span>
                        <button type="button" @click.prevent="docDraftModal=false" class="btn btn-ghost">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ FLOATING TOAST NOTIFICATION POPUP ══ --}}
        <div x-show="toast.show" x-cloak
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-[-20px] scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-[-20px] scale-95"
             style="position:fixed;top:24px;right:24px;z-index:9999999;max-width:380px;background:#ffffff;border-radius:12px;box-shadow:0 12px 36px rgba(0,0,0,0.15),0 4px 12px rgba(0,0,0,0.08);border:1.5px solid #e2e8f0;overflow:hidden;pointer-events:auto;"
             :style="toast.type === 'error' ? 'border-left:5px solid #ef4444;' : (toast.type === 'warning' ? 'border-left:5px solid #f59e0b;' : 'border-left:5px solid #10b981;')">
            <div style="padding:14px 18px;display:flex;align-items:flex-start;gap:12px;background:#fff;">
                <div style="width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;"
                     :style="toast.type === 'error' ? 'background:#fee2e2;color:#dc2626;' : (toast.type === 'warning' ? 'background:#fef3c7;color:#d97706;' : 'background:#dcfce7;color:#166534;')">
                    <i class="fas" :class="toast.type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle'" style="font-size:15px;"></i>
                </div>
                <div style="flex:1;">
                    <div style="font-size:12px;font-weight:900;color:#1e293b;margin-bottom:2px;" x-text="toast.title"></div>
                    <div style="font-size:10px;line-height:1.45;color:#64748b;font-weight:600;" x-text="toast.message"></div>
                </div>
                <button type="button" @click.prevent="toast.show = false" style="background:transparent;border:none;color:#94a3b8;cursor:pointer;font-size:14px;padding:2px;display:flex;align-items:center;justify-content:center;" title="Dismiss">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        {{-- ══ UPLOAD CUSTOM TEMPLATE / FORMAT MODAL ══ --}}
        <div x-show="templateUploadModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:520px;" @click.away="templateUploadModal=false">
                <div class="modal-in" style="padding:22px 24px;">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:#0E5393;"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div>
                                <div>Upload Custom Report Format / Template</div>
                                <div style="font-size:9px;color:var(--muted);font-weight:600;text-transform:none;">Upload updated DILG / KP Monitoring template (PDF, DOCX, XLSX, JPG, PNG)</div>
                            </div>
                        </div>
                        <button type="button" @click="templateUploadModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ route('department.reports.upload_template') }}" method="POST" enctype="multipart/form-data" style="margin-top:14px;">
                        @csrf
                        <input type="hidden" name="department" value="Justice">
                        <div style="background:#f8fafc;border:2px dashed #cbd5e1;border-radius:12px;padding:24px 16px;text-align:center;cursor:pointer;margin-bottom:16px;"
                             @click="$refs.customTemplateInput.click()">
                            <i class="fas fa-file-upload" style="font-size:32px;color:#0E5393;margin-bottom:8px;"></i>
                            <div style="font-size:12px;font-weight:800;color:var(--text);" x-ref="customTemplateTxt">Click to select new template file</div>
                            <div style="font-size:9px;color:var(--muted);margin-top:4px;">Supported: PDF, XLSX, DOCX, PNG, JPG (Max: 15MB)</div>
                            <input type="file" x-ref="customTemplateInput" name="template_file" style="display:none;" required
                                   @change="$refs.customTemplateTxt.innerText = $event.target.files[0]?.name || 'File selected'">
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;">
                            <button type="button" @click="templateUploadModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="background:#0E5393;color:#fff;">
                                <i class="fas fa-save"></i> Save Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;background:var(--body-bg);border-top:1px solid var(--border);">
        © {{ date('Y') }} Barangay San Miguel II, Dasmariñas City ,Cavite. All rights reserved.
    </footer>

</x-app-layout>

<script>
    function printJusticeReportHelper() {
        const el = document.getElementById('justice-printable-report');
        if (!el) return;
        const printContent = el.innerHTML;
        const printWindow = window.open('', '_blank', 'width=1100,height=800');
        printWindow.document.write('<!DOCTYPE html><html><head><title>MONITORING REPORT ON THE IMPLEMENTATION OF KATARUNGANG PAMBARANGAY</title><link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet"><style>@page{size:landscape;margin:10mm;}body{font-family:\'Times New Roman\',serif;margin:0;padding:15px;color:#000;background:#fff;}input{border:none!important;background:transparent!important;font-family:inherit!important;font-size:inherit!important;font-weight:inherit!important;text-align:center!important;}table{width:100%;border-collapse:collapse;font-size:10px;}th,td{border:1px solid #000;padding:4px 2px;}</style></head><body>' + printContent + '</body></html>');
        printWindow.document.close();
        printWindow.focus();
        setTimeout(() => { printWindow.print(); printWindow.close(); }, 400);
    }
</script>

<script>
    function justicePortal() {
        return {
            activeTab: localStorage.getItem('brgy_justice_tab') || 'blotter',
            notifOpen: false,
            blotterModal: false,
            summonModal: false,
            confirmScheduleModal: false,
            isSubmittingSchedule: false,
            viewModal: false,
            importModal: false,
            exportModal: false,
            formsModal: false,
            templateUploadModal: false,
            evidencePreviewModal: false,
            previewingEvidence: null,
            docDraftModal: false,
            activeRecord: null,
            searchQuery: '',
            filterDate: '',
            filterStatus: '',
            filterType: '',
            selectedIssueId: '',
            scheduledDate: '',
            selectedTimeSlot: '',
            justiceRep: {
                province: 'Cavite',
                city: 'Dasmariñas',
                barangay: 'San Miguel 2',
                monthYear: '{{ strtoupper(now()->format('F Y')) }}',
                totalReceived: {{ $reports->count() }},
                criminalCases: {{ $reports->where('issue_type', 'Criminal / Offense')->count() }},
                civilCases: {{ $reports->where('issue_type', 'Civil / Dispute')->count() }},
                othersCases: {{ $reports->whereNotIn('issue_type', ['Criminal / Offense', 'Civil / Dispute'])->count() }},
                get totalCases() {
                    return (Number(this.criminalCases)||0) + (Number(this.civilCases)||0) + (Number(this.othersCases)||0);
                },
                settledMediation: {{ $reports->where('status', 'settled')->count() }},
                settledConciliation: 0,
                settledArbitration: 0,
                get totalSettled() {
                    return (Number(this.settledMediation)||0) + (Number(this.settledConciliation)||0) + (Number(this.settledArbitration)||0);
                },
                withdrawnCases: 0,
                repudiatedCases: 0,
                certToCourt: 0,
                pendingCases: {{ $reports->whereIn('status', ['submitted', 'under_review', 'pending'])->count() }},
                preparedBy: 'LUPON SECRETARY',
                preparedRole: 'Lupon Tagapamayapa Secretary',
                notedBy: 'MARVIN M. BENIS',
                notedRole: 'Punong Barangay / Lupon Chairman'
            },
            printJusticeReport() {
                printJusticeReportHelper();
            },
            pbName: localStorage.getItem('brgy_pb_name') || 'Hon. Danilo M. Ramos',
            secName: localStorage.getItem('brgy_sec_name') || 'Maria Clara Santos',
            jurisdiction: localStorage.getItem('brgy_jurisdiction') || 'Barangay San Miguel II',
            cityProvince: localStorage.getItem('brgy_city_province') || 'City of Dasmariñas, Cavite',
            customTemplates: JSON.parse(localStorage.getItem('brgy_custom_kp_layouts') || '{}'),
            toast: {
                show: false,
                type: 'success',
                title: '',
                message: '',
                timeout: null
            },
            triggerToast(type, title, message) {
                if (this.toast.timeout) clearTimeout(this.toast.timeout);
                this.toast = {
                    show: true,
                    type: type || 'success',
                    title: title || (type === 'error' ? 'Error' : 'Success'),
                    message: message || '',
                    timeout: setTimeout(() => { this.toast.show = false; }, 4000)
                };
            },
            get confirmCaseSummary() {
                if (!this.selectedIssueId) return { case_no: '', complainant: '', respondent: '' };
                if (this.activeRecord && this.activeRecord.id == this.selectedIssueId) {
                    return {
                        case_no: this.activeRecord.case_no || '',
                        complainant: this.activeRecord.complainant || this.activeRecord.complainant_name || '',
                        respondent: this.activeRecord.respondent || this.activeRecord.respondent_name || ''
                    };
                }
                return { case_no: this.selectedIssueId, complainant: 'Complainant', respondent: 'Respondent' };
            },
            get selectedTimeSlotLabel() {
                const slot = this.slotsList.find(s => s.val === this.selectedTimeSlot);
                return slot ? slot.time : this.selectedTimeSlot;
            },
            draftDoc: {
                formType: 'kp7',
                formNo: 'KP Form No. 7',
                title: 'C O M P L A I N T',
                subTitle: 'Pagsusumbong',
                caseNo: '',
                forIssue: '',
                complainant: '',
                respondent: '',
                hearingDate: '',
                leadText: '',
                bodyText: '',
                termsText: '',
                issueDay: '',
                issueMonth: '',
                issueYear: '',
                isEditing: false
            },
            slotsList: [
                { time: '08:00 AM', val: '08:00' },
                { time: '09:00 AM', val: '09:00' },
                { time: '10:00 AM', val: '10:00' },
                { time: '11:00 AM', val: '11:00' },
                { time: '01:00 PM', val: '13:00' },
                { time: '02:00 PM', val: '14:00' },
                { time: '03:00 PM', val: '15:00' },
                { time: '04:00 PM', val: '16:00' },
            ],
            schedules: {!! $schedulesJSON !!},
            calMonth: new Date().getMonth(),
            calYear: new Date().getFullYear(),
            calDays: [],
            saveSignatorySettings() {
                localStorage.setItem('brgy_pb_name', this.pbName);
                localStorage.setItem('brgy_sec_name', this.secName);
                localStorage.setItem('brgy_jurisdiction', this.jurisdiction);
                localStorage.setItem('brgy_city_province', this.cityProvince);
            },
            openEvidencePreview(ev) {
                this.previewingEvidence = ev;
                this.evidencePreviewModal = true;
            },
            handleTemplateUpload(event, formType) {
                const file = event.target.files[0];
                if (!file) return;
                this.customTemplates[formType] = {
                    name: file.name,
                    size: (file.size / 1024).toFixed(1) + ' KB',
                    date: new Date().toLocaleDateString()
                };
                localStorage.setItem('brgy_custom_kp_layouts', JSON.stringify(this.customTemplates));
                this.triggerToast('success', 'Template Layout Updated', 'Uploaded layout file for ' + formType.toUpperCase() + ' (' + file.name + ')');
            },
            promptConfirmSchedule() {
                if (!this.selectedIssueId) {
                    this.triggerToast('error', 'Selection Required', 'Please select a case to schedule hearing.');
                    return;
                }
                if (!this.scheduledDate) {
                    this.triggerToast('error', 'Date Required', 'Please select a hearing date.');
                    return;
                }
                if (!this.selectedTimeSlot) {
                    this.triggerToast('error', 'Time Slot Required', 'Please select an available time slot.');
                    return;
                }
                this.confirmScheduleModal = true;
            },
            async submitHearingScheduleAjax() {
                this.isSubmittingSchedule = true;
                try {
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                    const res = await fetch('{{ route("justice.summons.issue") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf
                        },
                        body: JSON.stringify({
                            issue_id: this.selectedIssueId,
                            hearing_date: this.scheduledDate,
                            time: this.selectedTimeSlot
                        })
                    });
                    const data = await res.json();
                    if (res.ok && data.success) {
                        if (this.activeRecord && this.activeRecord.id == this.selectedIssueId) {
                            this.activeRecord.hearing_date = data.hearing_date_formatted;
                            if (this.activeRecord.status === 'submitted') {
                                this.activeRecord.status = 'under_review';
                            }
                        }
                        if (data.date_str && data.time_str) {
                            this.schedules.push({
                                date_str: data.date_str,
                                time_str: data.time_str,
                                case_no: this.confirmCaseSummary.case_no,
                                status: 'under_review'
                            });
                        }
                        this.confirmScheduleModal = false;
                        this.summonModal = false;
                        this.triggerToast('success', 'Hearing Scheduled Successfully', data.message);
                    } else {
                        this.triggerToast('error', 'Scheduling Failed', data.message || 'Could not schedule hearing.');
                    }
                } catch (err) {
                    this.triggerToast('error', 'Network Error', 'An unexpected error occurred while scheduling hearing.');
                } finally {
                    this.isSubmittingSchedule = false;
                }
            },
            promptConfirmSettlement() {
                if (!this.activeRecord) return;
                if (confirm('Generate KP Form 16 (Amicable Settlement) and mark Case #' + (this.activeRecord.case_no || '') + ' as SETTLED?')) {
                    this.asyncUpdateStatus(this.activeRecord.id, 'settled');
                }
            },
            promptConfirmEscalate() {
                if (!this.activeRecord) return;
                if (confirm('Issue KP Form 20 (Certificate to File Action) and ESCALATE Case #' + (this.activeRecord.case_no || '') + ' to Court?')) {
                    this.asyncUpdateStatus(this.activeRecord.id, 'escalated');
                }
            },
            async asyncUpdateStatus(issueId, newStatus) {
                try {
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                    const res = await fetch('/justice/blotter/' + issueId + '/status', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrf
                        },
                        body: JSON.stringify({ status: newStatus })
                    });
                    const data = await res.json();
                    if (res.ok && data.success) {
                        if (this.activeRecord && this.activeRecord.id == issueId) {
                            this.activeRecord.status = newStatus;
                        }
                        this.triggerToast('success', 'Status Updated', data.message);
                    } else {
                        this.triggerToast('error', 'Update Failed', data.message || 'Could not update status.');
                    }
                } catch (err) {
                    this.triggerToast('error', 'Network Error', 'An error occurred while updating status.');
                }
            },
            openDocDraft(formType, data) {
                const now = new Date();
                const day = now.toLocaleDateString('en-US', { day: 'numeric' });
                const month = now.toLocaleDateString('en-US', { month: 'long' });
                const year = now.getFullYear();

                let formNo = '', title = '', subTitle = '', leadText = '', bodyText = '', termsText = '';

                switch(formType) {
                    case 'kp7':
                        formNo = 'KP Form No. 7';
                        title = 'C O M P L A I N T';
                        subTitle = 'Pagsusumbong';
                        leadText = 'I/WE hereby complain against above named respondent/s for violating my/our rights and interests in the following manner:';
                        bodyText = data?.description || (data ? 'No description provided.' : '@{{narration_of_incident_or_facts_constituting_the_cause_of_action}}');
                        termsText = 'Peaceful settlement, restitution of damages, and strict compliance with Barangay Ordinances.';
                        break;
                    case 'kp8':
                        formNo = 'KP Form No. 8';
                        title = 'NOTICE OF HEARING';
                        subTitle = 'Paunawa ng Pagdinig para sa May-Sumbong';
                        leadText = 'You are hereby required to appear before me on the scheduled date and time for the hearing and mediation of your complaint.';
                        bodyText = 'Hearing Schedule: ' + (data?.hearing_date || '@{{hearing_date_and_time}}') + '\nLocation: Barangay Hall Mediation Center';
                        termsText = '';
                        break;
                    case 'kp9':
                        formNo = 'KP Form No. 9';
                        title = 'S U M M O N S';
                        subTitle = 'Patawag sa Ipinagsusumbong';
                        leadText = 'You are hereby summoned to appear before me on the scheduled mediation hearing to answer the complaint made against you before the Lupong Tagapamayapa.';
                        bodyText = 'Hearing Schedule: ' + (data?.hearing_date || '@{{hearing_date_and_time}}') + '\nFailure to appear may bar you from filing any counterclaim arising from said complaint.';
                        termsText = '';
                        break;
                    case 'kp12':
                        formNo = 'KP Form No. 12';
                        title = 'NOTICE FOR CONCILIATION';
                        subTitle = 'Paunawa ng Pagdinig sa Pangkat Tagapagkasundo';
                        leadText = 'You are hereby required to appear before the Pangkat Tagapagkasundo for conciliation proceedings of the above-captioned dispute.';
                        bodyText = 'Conciliation Schedule: ' + (data?.hearing_date || '@{{hearing_date_and_time}}') + '\nVenue: Office of the Lupong Tagapamayapa';
                        termsText = '';
                        break;
                    case 'kp16':
                        formNo = 'KP Form No. 16';
                        title = 'AMICABLE SETTLEMENT';
                        subTitle = 'Kasunduang Pag-aayos';
                        leadText = 'We, the complainant/s and respondent/s in the above-captioned case, do hereby agree to settle our dispute amicably as follows:';
                        bodyText = data ? ('Both parties agreed to resolve Case #' + (data.case_no || '') + ' (' + (data.issue_type || 'Dispute') + ') peacefully and uphold mutual respect.') : '@{{terms_and_conditions_of_amicable_settlement_agreement}}';
                        termsText = 'Both parties pledge to comply strictly and in good faith with the terms of this settlement.';
                        break;
                    case 'kp20':
                        formNo = 'KP Form No. 20';
                        title = 'CERTIFICATE TO FILE ACTION';
                        subTitle = 'Katunayan Upang Makadulog sa Hukuman';
                        leadText = 'This is to certify that personal confrontation occurred before the Punong Barangay / Pangkat, mediation was duly conducted, but no settlement was reached.';
                        bodyText = 'Therefore, the corresponding complaint for the dispute may now be filed in Court/proper government agency.';
                        termsText = '';
                        break;
                }

                this.draftDoc = {
                    formType: formType,
                    formNo: formNo,
                    title: title,
                    subTitle: subTitle,
                    caseNo: data?.case_no || (data ? '' : '@{{case_number}}'),
                    forIssue: data?.issue_type || (data ? '' : '@{{complaint_nature_or_for}}'),
                    complainant: data?.complainant || (data ? '' : '@{{complainant_full_name}}'),
                    respondent: data?.respondent || (data ? '' : '@{{respondent_full_name}}'),
                    hearingDate: data?.hearing_date || '',
                    leadText: leadText,
                    bodyText: bodyText,
                    termsText: termsText,
                    issueDay: day,
                    issueMonth: month,
                    issueYear: year,
                    isEditing: false
                };

                this.docDraftModal = true;
            },
            printCurrentDraft() {
                const el = document.getElementById('kp-printable-sheet');
                if (!el) return;
                const printContent = el.innerHTML;
                let win = window.open('', '_blank');
                win.document.write(`
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>${this.draftDoc.formNo} - ${this.draftDoc.title}</title>
                        <style>
                            body { font-family: 'Times New Roman', Times, serif; color: #000; margin: 0; padding: 0; line-height: 1.45; background: white; font-size:12pt; }
                            .page { max-width: 8.5in; margin: 0 auto; padding: 40px 55px; position:relative; }
                            @media print {
                                @page { size: auto; margin: 0; }
                                body { -webkit-print-color-adjust: exact; padding: 0; margin: 0; }
                                .page { padding: 40px; margin: 0; box-shadow: none; width: 100%; }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="page">${printContent}</div>
                        <script>
                            window.onload = function() { setTimeout(() => window.print(), 600); };
                        <\/script>
                    </body>
                    </html>
                `);
                win.document.close();
            },
            get parsedEvidenceList() {
                if (!this.activeRecord || !this.activeRecord.evidence) return [];
                let ev = this.activeRecord.evidence;
                if (typeof ev === 'string') {
                    try { ev = JSON.parse(ev); } catch (e) { ev = [ev]; }
                }
                if (!Array.isArray(ev)) return [];
                return ev.map((item, index) => {
                    if (typeof item === 'object' && item !== null) {
                        return {
                            path: item.path || '',
                            name: item.name || ('Evidence_' + (index + 1)),
                            size: item.size || 'Evidence File',
                            ext: (item.ext || (item.path ? item.path.split('.').pop().toLowerCase() : 'file')),
                            date: item.date || ''
                        };
                    } else if (typeof item === 'string') {
                        const filename = item.split('/').pop() || ('Evidence_' + (index + 1));
                        const ext = filename.split('.').pop().toLowerCase();
                        return {
                            path: item,
                            name: filename,
                            size: 'Evidence File',
                            ext: ext,
                            date: ''
                        };
                    }
                    return null;
                }).filter(Boolean).slice(0, 5);
            },
            extractCloudLink(desc) {
                if (!desc) return null;
                const match = desc.match(/\[External Cloud Evidence\]:\s*(https?:\/\/[^\s]+)/i);
                return match ? match[1] : null;
            },
            get isTodayPast5PM() {
                const now = new Date();
                return now.getHours() >= 17;
            },
            getTodayDateStr() {
                const now = new Date();
                const y = now.getFullYear();
                const m = (now.getMonth() + 1).toString().padStart(2, '0');
                const d = now.getDate().toString().padStart(2, '0');
                return `${y}-${m}-${d}`;
            },
            getDefaultDate() {
                const now = new Date();
                if (now.getHours() >= 17) {
                    now.setDate(now.getDate() + 1);
                }
                const y = now.getFullYear();
                const m = (now.getMonth() + 1).toString().padStart(2, '0');
                const d = now.getDate().toString().padStart(2, '0');
                return `${y}-${m}-${d}`;
            },
            formatDateDisplay(dateStr) {
                if (!dateStr) return '';
                const parts = dateStr.split('-');
                if (parts.length === 3) {
                    const dt = new Date(parts[0], parts[1] - 1, parts[2]);
                    return dt.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                }
                return dateStr;
            },
            get minCalMonth() { return new Date().getMonth(); },
            get minCalYear() { return new Date().getFullYear(); },
            get maxCalDate() {
                let d = new Date();
                d.setMonth(d.getMonth() + 3);
                return d;
            },
            get canPrevCal() {
                return !(this.calYear === this.minCalYear && this.calMonth <= this.minCalMonth);
            },
            get canNextCal() {
                let curr = new Date(this.calYear, this.calMonth, 1);
                let maxM = new Date(this.maxCalDate.getFullYear(), this.maxCalDate.getMonth(), 1);
                return curr < maxM;
            },
            genCal() {
                let d = new Date(this.calYear, this.calMonth + 1, 0).getDate();
                let f = new Date(this.calYear, this.calMonth, 1).getDay();
                this.calDays = [...Array(f).fill(null), ...Array.from({length:d},(_,i)=>i+1)];
            },
            prevCal() {
                if (!this.canPrevCal) return;
                if(this.calMonth==0){this.calMonth=11;this.calYear--;}else{this.calMonth--;}
                this.genCal();
            },
            nextCal() {
                if (!this.canNextCal) return;
                if(this.calMonth==11){this.calMonth=0;this.calYear++;}else{this.calMonth++;}
                this.genCal();
            },
            isPastDate(d) {
                if(!d) return true;
                let slotDate = new Date(this.calYear, this.calMonth, d);
                slotDate.setHours(0,0,0,0);
                
                let today = new Date();
                today.setHours(0,0,0,0);
                
                if (slotDate < today) return true;
                if (slotDate.getTime() === today.getTime() && this.isTodayPast5PM) {
                    return true;
                }

                let limitDate = new Date();
                limitDate.setMonth(limitDate.getMonth() + 3);
                limitDate.setHours(23,59,59,999);
                if (slotDate > limitDate) return true;
                
                return false;
            },
            isSelDate(d) {
                if(!d) return false;
                let dateStr = `${this.calYear}-${(this.calMonth+1).toString().padStart(2,'0')}-${d.toString().padStart(2,'0')}`;
                return this.scheduledDate === dateStr;
            },
            selDate(d) {
                if(!d || this.isPastDate(d)) return;
                this.scheduledDate = `${this.calYear}-${(this.calMonth+1).toString().padStart(2,'0')}-${d.toString().padStart(2,'0')}`;
            },
            isSlotPast(slotTimeStr) {
                const todayStr = this.getTodayDateStr();
                if (this.scheduledDate !== todayStr) return false;
                
                const now = new Date();
                const [time, modifier] = slotTimeStr.split(' ');
                let [hours, minutes] = time.split(':').map(Number);
                if (modifier === 'PM' && hours < 12) hours += 12;
                if (modifier === 'AM' && hours === 12) hours = 0;
                
                const slotDate = new Date();
                slotDate.setHours(hours, minutes, 0, 0);
                return now >= slotDate;
            },
            isSlotOccupied(slotTimeStr) {
                return this.occupiedTimes.includes(slotTimeStr);
            },
            getSlotStatus(slotTimeStr) {
                if (this.isSlotOccupied(slotTimeStr)) return 'occupied';
                if (this.isSlotPast(slotTimeStr)) return 'past';
                return 'available';
            },
            get availableSlotsCount() {
                return this.slotsList.filter(s => this.getSlotStatus(s.time) === 'available').length;
            },
            get mName() { return ['January','February','March','April','May','June','July','August','September','October','November','December'][this.calMonth]; },
            openView(rec){ this.activeRecord = rec; this.viewModal = true; },
            get occupiedTimes() {
                return this.schedules.filter(function(s) { return s.date_str === this.scheduledDate; }.bind(this)).map(function(s) { return s.time_str; });
            },
            init() {
                this.scheduledDate = this.getDefaultDate();
                const d = new Date(this.scheduledDate);
                this.calMonth = d.getMonth();
                this.calYear = d.getFullYear();
                this.genCal();
                this.$watch('activeTab', value => localStorage.setItem('brgy_justice_tab', value));
                this.$watch('scheduledDate', () => { this.selectedTimeSlot = ''; });
                window.addEventListener('toast-notify', (e) => {
                    if (e.detail) {
                        this.triggerToast(e.detail.type, e.detail.title, e.detail.message);
                    }
                });
            }
        };
    }

function calendarComponent() {
    return {
        schedules: window._hearingSchedules || [],
        currMonth: new Date().getMonth(),
        currYear: new Date().getFullYear(),
        selectedDate: '',
        viewScope: 'selected_date', // 'selected_date' or 'month'
        stageFilter: '', // '' (All), 'Mediation', 'Conciliation', 'Arbitration'
        days: [],
        monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        get minMonth() { return new Date().getMonth(); },
        get minYear() { return new Date().getFullYear(); },
        get maxDate() {
            let d = new Date();
            d.setMonth(d.getMonth() + 3);
            return d;
        },
        get maxMonth() { return this.maxDate.getMonth(); },
        get maxYear() { return this.maxDate.getFullYear(); },
        get canPrev() {
            return !(this.currYear === this.minYear && this.currMonth <= this.minMonth);
        },
        get canNext() {
            let curr = new Date(this.currYear, this.currMonth, 1);
            let maxM = new Date(this.maxYear, this.maxMonth, 1);
            return curr < maxM;
        },
        initCal() {
            this.schedules = window._hearingSchedules || [];
            this.generateDays();
            let td = new Date();
            this.selDate(td.getDate());
        },
        generateDays() {
            let daysInMonth = new Date(this.currYear, this.currMonth + 1, 0).getDate();
            let firstDay = new Date(this.currYear, this.currMonth, 1).getDay();
            let emptyDays = Array(firstDay).fill(null);
            let monthDays = Array.from({length: daysInMonth}, (_, i) => i + 1);
            this.days = [...emptyDays, ...monthDays];
        },
        prevM() {
            if (!this.canPrev) return;
            if (this.currMonth === 0) { this.currMonth = 11; this.currYear--; } 
            else { this.currMonth--; }
            this.generateDays();
            this.autoSelectFirstValidDay();
        },
        nextM() {
            if (!this.canNext) return;
            if (this.currMonth === 11) { this.currMonth = 0; this.currYear++; } 
            else { this.currMonth++; }
            this.generateDays();
            this.autoSelectFirstValidDay();
        },
        resetToCurrent() {
            this.currMonth = new Date().getMonth();
            this.currYear = new Date().getFullYear();
            this.generateDays();
            this.selDate(new Date().getDate());
        },
        autoSelectFirstValidDay() {
            for (let d of this.days) {
                if (d && !this.isDayDisabled(d)) {
                    this.selDate(d);
                    return;
                }
            }
        },
        formatDate(d) {
            if(!d) return null;
            let m = (this.currMonth + 1).toString().padStart(2, '0');
            let dObj = d.toString().padStart(2, '0');
            return `${this.currYear}-${m}-${dObj}`;
        },
        formatDateDisplay(dateStr) {
            if (!dateStr) return '';
            const parts = dateStr.split('-');
            if (parts.length === 3) {
                const dt = new Date(parts[0], parts[1] - 1, parts[2]);
                return dt.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
            }
            return dateStr;
        },
        isDayDisabled(d) {
            if(!d) return true;
            let dayDate = new Date(this.currYear, this.currMonth, d);
            dayDate.setHours(0,0,0,0);
            
            let today = new Date();
            today.setHours(0,0,0,0);
            
            if (dayDate < today) return true;
            let limitDate = new Date();
            limitDate.setMonth(limitDate.getMonth() + 3);
            limitDate.setHours(23,59,59,999);
            if (dayDate > limitDate) return true;
            
            return false;
        },
        getEvents(d) {
            if (!d) return [];
            let f = this.formatDate(d);
            return this.schedules.filter(s => s.date_str === f);
        },
        hasEvents(d) {
            return this.getEvents(d).length > 0;
        },
        selDate(d) {
            if(!d || this.isDayDisabled(d)) return;
            this.selectedDate = this.formatDate(d);
            this.viewScope = 'selected_date';
        },
        get monthSchedules() {
            const mPrefix = `${this.currYear}-${(this.currMonth + 1).toString().padStart(2, '0')}`;
            return this.schedules.filter(s => s.date_str.startsWith(mPrefix));
        },
        get displayedSchedules() {
            let list = (this.viewScope === 'month') ? this.monthSchedules : this.schedules.filter(s => s.date_str === this.selectedDate);
            if (this.stageFilter) {
                list = list.filter(s => s.phase === this.stageFilter);
            }
            return list;
        },
        async settleSchedule(ev) {
            if (!confirm('Mark Case #' + ev.case_no + ' as SETTLED (Amicable Settlement recorded)?')) return;
            try {
                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
                const res = await fetch('/justice/blotter/' + ev.id + '/status', {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify({ status: 'settled' })
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    this.schedules = this.schedules.filter(s => s.id !== ev.id);
                    window.dispatchEvent(new CustomEvent('toast-notify', {
                        detail: {
                            type: 'success',
                            title: 'Case Settled',
                            message: 'Case #' + ev.case_no + ' marked as Settled and archived in Settlements tab.'
                        }
                    }));
                } else {
                    alert(data.message || 'Could not update status.');
                }
            } catch (err) {
                alert('An error occurred updating case status.');
            }
        }
    }
}

// ══════════════════════════════════════════════════════════════
// 📜 DILG TRANSMITTAL & ANNUAL REPORT PRINT GENERATORS
// ══════════════════════════════════════════════════════════════

function printDILGTransmittal() {
    const pb = localStorage.getItem('brgy_pb_name') || 'Hon. Danilo M. Ramos';
    const sec = localStorage.getItem('brgy_sec_name') || 'Maria Clara Santos';
    const jur = localStorage.getItem('brgy_jurisdiction') || 'Barangay San Miguel II';
    const now = new Date();
    const monthStr = now.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

    let win = window.open('', '_blank');
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>DILG Monthly Transmittal Report - ${monthStr}</title>
            <style>
                body { font-family: Arial, sans-serif; color: #000; margin: 0; padding: 30px; font-size: 10pt; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h3 { margin: 2px 0; font-size: 11pt; }
                .header h2 { margin: 6px 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
                table { width: 100%; border-collapse: collapse; margin-top: 15px; }
                th, td { border: 1px solid #333; padding: 8px; text-align: center; font-size: 9.5pt; }
                th { background: #f1f5f9; font-weight: bold; }
                .text-left { text-align: left; }
                .signatures { margin-top: 50px; display: flex; justify-content: space-between; }
                .sig-block { text-align: center; width: 220px; }
                .sig-line { border-top: 1px solid #000; padding-top: 5px; font-weight: bold; text-transform: uppercase; }
                @media print { @page { size: landscape; margin: 15mm; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h3>Republic of the Philippines • Province of Cavite • City of Dasmariñas</h3>
                <h3><strong>${jur.toUpperCase()} • LUPONG TAGAPAMAYAPA</strong></h3>
                <h2>KATARUNGANG PAMBARANGAY MONTHLY TRANSMITTAL REPORT</h2>
                <div style="font-weight: bold; margin-top: 4px;">Reporting Period: ${monthStr}</div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th rowspan="2">Nature of Disputes</th>
                        <th rowspan="2">Total Cases Filed</th>
                        <th colspan="3">Settled Cases</th>
                        <th colspan="2">Unresolved / Escalated</th>
                        <th rowspan="2">Pending Mediation</th>
                        <th rowspan="2">Resolution Rate</th>
                    </tr>
                    <tr>
                        <th>Mediation</th>
                        <th>Conciliation</th>
                        <th>Arbitration</th>
                        <th>CFA Issued</th>
                        <th>Repudiated</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left"><strong>A. Criminal / Public Order</strong></td>
                        <td>{{ $reports->whereIn('issue_type',['Physical Altercation','Noise / Disturbance','Barangay Ordinance Violation'])->count() }}</td>
                        <td>{{ $reports->where('status','settled')->whereIn('issue_type',['Physical Altercation','Noise / Disturbance','Barangay Ordinance Violation'])->count() }}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $reports->where('status','escalated')->whereIn('issue_type',['Physical Altercation','Noise / Disturbance','Barangay Ordinance Violation'])->count() }}</td>
                        <td>0</td>
                        <td>{{ $reports->where('status','pending')->whereIn('issue_type',['Physical Altercation','Noise / Disturbance','Barangay Ordinance Violation'])->count() }}</td>
                        <td><strong>{{ $totalJ > 0 ? round(($settledJ / $totalJ)*100, 1) : 0 }}%</strong></td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>B. Civil / Neighbor Disputes</strong></td>
                        <td>{{ $reports->whereIn('issue_type',['Dispute over Property','Debt / Lending Dispute','Neighbor Dispute','Family Dispute'])->count() }}</td>
                        <td>{{ $reports->where('status','settled')->whereIn('issue_type',['Dispute over Property','Debt / Lending Dispute','Neighbor Dispute','Family Dispute'])->count() }}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $reports->where('status','escalated')->whereIn('issue_type',['Dispute over Property','Debt / Lending Dispute','Neighbor Dispute','Family Dispute'])->count() }}</td>
                        <td>0</td>
                        <td>{{ $reports->where('status','pending')->whereIn('issue_type',['Dispute over Property','Debt / Lending Dispute','Neighbor Dispute','Family Dispute'])->count() }}</td>
                        <td><strong>{{ $totalJ > 0 ? round(($settledJ / $totalJ)*100, 1) : 0 }}%</strong></td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>C. Others / Miscellaneous</strong></td>
                        <td>{{ $reports->whereIn('issue_type',['Others','Estafa / Fraud','Verbal Altercation'])->count() }}</td>
                        <td>{{ $reports->where('status','settled')->whereIn('issue_type',['Others','Estafa / Fraud','Verbal Altercation'])->count() }}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $reports->where('status','escalated')->whereIn('issue_type',['Others','Estafa / Fraud','Verbal Altercation'])->count() }}</td>
                        <td>0</td>
                        <td>{{ $reports->where('status','pending')->whereIn('issue_type',['Others','Estafa / Fraud','Verbal Altercation'])->count() }}</td>
                        <td><strong>{{ $totalJ > 0 ? round(($settledJ / $totalJ)*100, 1) : 0 }}%</strong></td>
                    </tr>
                    <tr style="background:#f8fafc;font-weight:bold;">
                        <td class="text-left"><strong>GRAND TOTAL</strong></td>
                        <td><strong>{{ $totalJ }}</strong></td>
                        <td><strong>{{ $settledJ }}</strong></td>
                        <td>0</td>
                        <td>0</td>
                        <td><strong>{{ $urgentJ }}</strong></td>
                        <td>0</td>
                        <td><strong>{{ $pendingJ }}</strong></td>
                        <td><strong>{{ $totalJ > 0 ? round(($settledJ / $totalJ)*100, 1) : 0 }}%</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="signatures">
                <div class="sig-block">
                    <div>Prepared by:</div>
                    <div style="margin-top:35px;" class="sig-line">${sec}<br><small>Lupon Secretary</small></div>
                </div>
                <div class="sig-block">
                    <div>Attested & Verified by:</div>
                    <div style="margin-top:35px;" class="sig-line">${pb}<br><small>Punong Barangay / Lupon Chairman</small></div>
                </div>
            </div>

            <script>window.onload = function(){ setTimeout(() => window.print(), 600); };<\/script>
        </body>
        </html>
    `);
    win.document.close();
}

function printAnnualSummary(period) {
    const pb = localStorage.getItem('brgy_pb_name') || 'Hon. Danilo M. Ramos';
    const jur = localStorage.getItem('brgy_jurisdiction') || 'Barangay San Miguel II';
    const now = new Date();
    const yearStr = now.getFullYear();

    let win = window.open('', '_blank');
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Annual Justice Performance Summary - ${yearStr}</title>
            <style>
                body { font-family: Arial, sans-serif; color: #000; margin: 0; padding: 40px; font-size: 11pt; line-height: 1.5; }
                .header { text-align: center; margin-bottom: 25px; }
                .header h3 { margin: 2px 0; font-size: 11pt; }
                .header h2 { margin: 8px 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
                .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin: 20px 0; }
                .stat-box { border: 1.5px solid #000; padding: 12px; text-align: center; border-radius: 8px; }
                .stat-n { font-size: 20pt; font-weight: bold; }
                .stat-l { font-size: 9pt; text-transform: uppercase; font-weight: bold; margin-top: 4px; }
                .sig-block { text-align: center; width: 260px; margin-top: 60px; margin-left: auto; }
                .sig-line { border-top: 1px solid #000; padding-top: 5px; font-weight: bold; text-transform: uppercase; }
            </style>
        </head>
        <body>
            <div class="header">
                <h3>Republic of the Philippines • Province of Cavite • City of Dasmariñas</h3>
                <h3><strong>${jur.toUpperCase()} • LUPONG TAGAPAMAYAPA</strong></h3>
                <h2>ANNUAL KATARUNGANG PAMBARANGAY ACCOMPLISHMENT REPORT</h2>
                <div style="font-weight: bold;">Calendar Year: ${yearStr}</div>
            </div>

            <p>This document presents the annual performance summary of the Katarungang Pambarangay in ${jur}, Dasmariñas City, Cavite. The Lupong Tagapamayapa aims to preserve community harmony, encourage peaceful dispute resolutions, and decongest court dockets.</p>

            <div class="stat-grid">
                <div class="stat-box"><div class="stat-n">{{ $totalJ }}</div><div class="stat-l">Total Cases Filed</div></div>
                <div class="stat-box"><div class="stat-n">{{ $settledJ }}</div><div class="stat-l">Amicably Settled</div></div>
                <div class="stat-box"><div class="stat-n">{{ $pendingJ }}</div><div class="stat-l">Ongoing Hearings</div></div>
                <div class="stat-box"><div class="stat-n">{{ $totalJ > 0 ? round(($settledJ / $totalJ)*100, 1) : 0 }}%</div><div class="stat-l">Settlement Rate</div></div>
            </div>

            <p>All mediation and conciliation hearings were carried out in compliance with Republic Act No. 7160 and the Katarungang Pambarangay guidelines.</p>

            <div class="sig-block">
                <div class="sig-line">${pb}<br><small>Punong Barangay / Lupon Chairman</small></div>
            </div>

            <script>window.onload = function(){ setTimeout(() => window.print(), 600); };<\/script>
        </body>
        </html>
    `);
    win.document.close();
}

function printBlotterMasterlist(period) {
    const pb = localStorage.getItem('brgy_pb_name') || 'Hon. Danilo M. Ramos';
    const sec = localStorage.getItem('brgy_sec_name') || 'Maria Clara Santos';
    const jur = localStorage.getItem('brgy_jurisdiction') || 'Barangay San Miguel II';
    const dateTitle = period === 'month' ? '{{ date("F Y") }}' : (period === 'year' ? 'Year {{ date("Y") }}' : 'All Recorded Blotter Cases');

    let win = window.open('', '_blank');
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Katarungang Pambarangay Master Blotter Logbook</title>
            <style>
                body { font-family: Arial, sans-serif; color: #000; margin: 0; padding: 25px; font-size: 9.5pt; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h3 { margin: 2px 0; font-size: 10.5pt; }
                .header h2 { margin: 6px 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
                table { width: 100%; border-collapse: collapse; margin-top: 12px; }
                th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; font-size: 9pt; }
                th { background: #f1f5f9; font-weight: bold; text-align: center; }
                .signatures { margin-top: 40px; display: flex; justify-content: space-between; }
                .sig-block { text-align: center; width: 220px; }
                .sig-line { border-top: 1px solid #000; padding-top: 5px; font-weight: bold; text-transform: uppercase; }
                @media print { @page { size: landscape; margin: 12mm; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h3>Republic of the Philippines • Province of Cavite • City of Dasmariñas</h3>
                <h3><strong>${jur.toUpperCase()} • LUPONG TAGAPAMAYAPA</strong></h3>
                <h2>OFFICIAL KATARUNGANG PAMBARANGAY BLOTTER MASTERLIST</h2>
                <div style="font-weight: bold;">Reporting Period: ${dateTitle}</div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width:110px;">Case Number</th>
                        <th>Nature of Dispute</th>
                        <th>Complainant (May-Sumbong)</th>
                        <th>Respondent (Ipinagsusumbong)</th>
                        <th style="width:90px;">Incident Date</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:85px;">Date Filed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $r)
                    <tr>
                        <td style="font-weight:bold;text-align:center;">#JUS-{{ $r->created_at->format('Y') }}-{{ str_pad($r->id,3,'0',STR_PAD_LEFT) }}</td>
                        <td>{{ $r->issue_type }}</td>
                        <td>{{ $r->complainant_name ?? '—' }}</td>
                        <td>{{ $r->respondent_name ?? '—' }}</td>
                        <td style="text-align:center;">{{ $r->incident_date ? \Carbon\Carbon::parse($r->incident_date)->format('M d, Y') : '—' }}</td>
                        <td style="text-align:center;text-transform:uppercase;font-weight:bold;">{{ str_replace('_',' ',$r->status) }}</td>
                        <td style="text-align:center;">{{ $r->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="signatures">
                <div class="sig-block">
                    <div>Prepared by:</div>
                    <div style="margin-top:30px;" class="sig-line">${sec}<br><small>Lupon Secretary</small></div>
                </div>
                <div class="sig-block">
                    <div>Attested by:</div>
                    <div style="margin-top:30px;" class="sig-line">${pb}<br><small>Punong Barangay / Lupon Chairman</small></div>
                </div>
            </div>

            <script>window.onload = function(){ setTimeout(() => window.print(), 600); };<\/script>
        </body>
        </html>
    `);
    win.document.close();
}

function printSettlementsList(period) {
    const pb = localStorage.getItem('brgy_pb_name') || 'Hon. Danilo M. Ramos';
    const sec = localStorage.getItem('brgy_sec_name') || 'Maria Clara Santos';
    const jur = localStorage.getItem('brgy_jurisdiction') || 'Barangay San Miguel II';

    let win = window.open('', '_blank');
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Katarungang Pambarangay Amicable Settlements Register</title>
            <style>
                body { font-family: Arial, sans-serif; color: #000; margin: 0; padding: 25px; font-size: 9.5pt; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h3 { margin: 2px 0; font-size: 10.5pt; }
                .header h2 { margin: 6px 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
                table { width: 100%; border-collapse: collapse; margin-top: 12px; }
                th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; font-size: 9pt; }
                th { background: #f1f5f9; font-weight: bold; text-align: center; }
                .signatures { margin-top: 40px; display: flex; justify-content: space-between; }
                .sig-block { text-align: center; width: 220px; }
                .sig-line { border-top: 1px solid #000; padding-top: 5px; font-weight: bold; text-transform: uppercase; }
                @media print { @page { size: portrait; margin: 15mm; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h3>Republic of the Philippines • Province of Cavite • City of Dasmariñas</h3>
                <h3><strong>${jur.toUpperCase()} • LUPONG TAGAPAMAYAPA</strong></h3>
                <h2>REGISTER OF AMICABLY SETTLED DISPUTES (KP FORM 16 ARCHIVE)</h2>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width:110px;">Case Number</th>
                        <th>Nature of Dispute</th>
                        <th>Parties Involved</th>
                        <th style="width:100px;">Settlement Date</th>
                        <th style="width:110px;">KP Form Ref</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports->whereIn('status',['settled','resolved']) as $r)
                    <tr>
                        <td style="font-weight:bold;text-align:center;">#JUS-{{ $r->created_at->format('Y') }}-{{ str_pad($r->id,3,'0',STR_PAD_LEFT) }}</td>
                        <td>{{ $r->issue_type }}</td>
                        <td><strong>{{ $r->complainant_name }}</strong> vs. <strong>{{ $r->respondent_name ?? '—' }}</strong></td>
                        <td style="text-align:center;">{{ $r->updated_at->format('M d, Y') }}</td>
                        <td style="text-align:center;font-weight:bold;color:#059669;">KP Form 16</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="signatures">
                <div class="sig-block">
                    <div>Recorded by:</div>
                    <div style="margin-top:30px;" class="sig-line">${sec}<br><small>Lupon Secretary</small></div>
                </div>
                <div class="sig-block">
                    <div>Attested by:</div>
                    <div style="margin-top:30px;" class="sig-line">${pb}<br><small>Punong Barangay / Lupon Chairman</small></div>
                </div>
            </div>

            <script>window.onload = function(){ setTimeout(() => window.print(), 600); };<\/script>
        </body>
        </html>
    `);
    win.document.close();
}

function printHearingSchedulesList(period) {
    const pb = localStorage.getItem('brgy_pb_name') || 'Hon. Danilo M. Ramos';
    const sec = localStorage.getItem('brgy_sec_name') || 'Maria Clara Santos';
    const jur = localStorage.getItem('brgy_jurisdiction') || 'Barangay San Miguel II';

    let win = window.open('', '_blank');
    win.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Katarungang Pambarangay Hearing Schedules</title>
            <style>
                body { font-family: Arial, sans-serif; color: #000; margin: 0; padding: 25px; font-size: 9.5pt; }
                .header { text-align: center; margin-bottom: 20px; }
                .header h3 { margin: 2px 0; font-size: 10.5pt; }
                .header h2 { margin: 6px 0; font-size: 14pt; font-weight: bold; text-transform: uppercase; }
                table { width: 100%; border-collapse: collapse; margin-top: 12px; }
                th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; font-size: 9pt; }
                th { background: #f1f5f9; font-weight: bold; text-align: center; }
                .signatures { margin-top: 40px; display: flex; justify-content: space-between; }
                .sig-block { text-align: center; width: 220px; }
                .sig-line { border-top: 1px solid #000; padding-top: 5px; font-weight: bold; text-transform: uppercase; }
                @media print { @page { size: portrait; margin: 15mm; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h3>Republic of the Philippines • Province of Cavite • City of Dasmariñas</h3>
                <h3><strong>${jur.toUpperCase()} • LUPONG TAGAPAMAYAPA</strong></h3>
                <h2>OFFICIAL CALENDAR OF SCHEDULED HEARINGS & CONCILIATIONS</h2>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width:105px;">Case Number</th>
                        <th>Dispute Nature</th>
                        <th>Parties Involved</th>
                        <th style="width:130px;">Hearing Date & Time</th>
                        <th style="width:100px;">Venue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports->whereNotNull('hearing_date')->sortBy('hearing_date') as $r)
                    <tr>
                        <td style="font-weight:bold;text-align:center;">#JUS-{{ $r->created_at->format('Y') }}-{{ str_pad($r->id,3,'0',STR_PAD_LEFT) }}</td>
                        <td>{{ $r->issue_type }}</td>
                        <td><strong>{{ $r->complainant_name }}</strong> vs. <strong>{{ $r->respondent_name ?? '—' }}</strong></td>
                        <td style="text-align:center;font-weight:bold;color:#1e40af;">{{ \Carbon\Carbon::parse($r->hearing_date)->format('M d, Y h:i A') }}</td>
                        <td style="text-align:center;">Barangay Hall Mediation Center</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="signatures">
                <div class="sig-block">
                    <div>Prepared by:</div>
                    <div style="margin-top:30px;" class="sig-line">${sec}<br><small>Lupon Secretary</small></div>
                </div>
                <div class="sig-block">
                    <div>Attested by:</div>
                    <div style="margin-top:30px;" class="sig-line">${pb}<br><small>Punong Barangay / Lupon Chairman</small></div>
                </div>
            </div>

            <script>window.onload = function(){ setTimeout(() => window.print(), 600); };<\/script>
        </body>
        </html>
    `);
    win.document.close();
}
</script>

