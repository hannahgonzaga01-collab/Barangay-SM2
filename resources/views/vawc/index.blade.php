<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap');
:root{
    --brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;
    --body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;
    --success:#059669;--warn:#d97706;--danger:#dc2626;
    --card-shadow:0 4px 24px rgba(4,25,45,0.10),0 1.5px 6px rgba(0,0,0,0.05);
    --btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);
    --vawc:#7c3aed;
}
*{box-sizing:border-box;margin:0;padding:0;}
html,body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--body-bg);color:var(--text);}
[x-cloak]{display:none!important;}

.portal-wrap{max-width:1200px;margin:0 auto;padding:24px 18px 60px;}

/* HERO */
.hero{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);border-radius:16px;padding:28px 28px 24px;margin-bottom:22px;position:relative;overflow:hidden;box-shadow:var(--card-shadow);}
.hero-bg-ico{position:absolute;right:-20px;bottom:-20px;font-size:160px;color:rgba(255,255,255,.05);line-height:1;pointer-events:none;}
.hero-tag{font-size:9px;font-weight:900;background:rgba(124,58,237,.25);color:#c4b5fd;padding:4px 12px;border-radius:99px;text-transform:uppercase;letter-spacing:.08em;display:inline-block;margin-bottom:12px;border:1px solid rgba(124,58,237,.3);}
.hero-title{font-size:22px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.2;margin-bottom:8px;}
.hero-desc{font-size:12px;color:rgba(255,255,255,.6);font-weight:600;max-width:520px;line-height:1.6;}
.hero-stats{display:flex;gap:14px;margin-top:20px;flex-wrap:wrap;}
.hstat{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:11px;padding:12px 16px;text-align:center;min-width:72px;}
.hstat-n{font-size:22px;font-weight:900;color:#fff;line-height:1;}
.hstat-l{font-size:8px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.07em;margin-top:3px;}

/* CONFIDENTIAL BANNER */
.conf-banner{background:linear-gradient(135deg,#3b0764 0%,#4c1d95 60%,#6d28d9 100%);border-radius:13px;padding:16px 20px;display:flex;align-items:center;gap:14px;margin-bottom:18px;border:1px solid rgba(196,181,253,.15);}
.conf-ico{width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.conf-ico i{color:#c4b5fd;font-size:16px;}
.conf-text{font-size:11px;color:rgba(255,255,255,.8);font-weight:600;line-height:1.5;flex:1;}
.conf-text strong{color:#fff;}
.conf-btn{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#fff;font-family:inherit;font-size:9px;font-weight:900;text-transform:uppercase;padding:7px 14px;border-radius:8px;cursor:pointer;white-space:nowrap;transition:all .15s;flex-shrink:0;}
.conf-btn:hover{background:rgba(255,255,255,.25);}

/* ACTION GRID */
.action-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px;}
.action-card{background:#fff;border:2px solid var(--border);border-radius:14px;padding:20px 14px 18px;text-align:center;cursor:pointer;transition:all .2s;}
.action-card:hover{border-color:var(--brand);transform:translateY(-3px);box-shadow:0 8px 24px rgba(14,83,147,.15);}
.action-card.active{border-color:var(--brand);background:#eff6ff;}
.ac-ico{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 13px;transition:all .2s;}
.ac-ico i{font-size:20px;}
.action-card:hover .ac-ico{transform:scale(1.08);}
.ac-name{font-size:10px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.04em;line-height:1.3;}
.ac-sub{font-size:9px;color:var(--muted);font-weight:600;margin-top:4px;}

/* CARDS */
.card{background:#fff;border-radius:14px;box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.05);overflow:hidden;margin-bottom:18px;}
.card-head{padding:14px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
.card-title{font-size:10px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.09em;display:flex;align-items:center;gap:7px;}
.card-title i{color:var(--brand);}
.cbadge{font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;}
.cbadge-blue{background:#eff6ff;color:var(--brand);}
.cbadge-red{background:#fee2e2;color:#dc2626;}
.cbadge-vawc{background:#f5f3ff;color:#7c3aed;}

/* FILTER BAR — consistent navy theme like other pages */
.filter-bar{background:linear-gradient(100deg,#000052 0%,#04192D 60%,#0E5393 100%);border-radius:11px;padding:10px 14px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:14px;}
.filter-bar input,.filter-bar select{background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);color:#fff;border-radius:8px;padding:7px 10px;font-family:inherit;font-size:10px;font-weight:700;outline:none;transition:all .15s;}
.filter-bar input::placeholder{color:rgba(255,255,255,.5);}
.filter-bar select option{background:#04192D;color:#fff;}
.filter-bar input:focus,.filter-bar select:focus{border-color:rgba(255,255,255,.7);background:rgba(255,255,255,.2);}
.filter-bar .filter-icon{color:rgba(255,255,255,.6);font-size:11px;flex-shrink:0;}
.filter-search{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);border-radius:8px;padding:6px 10px;flex:1;min-width:160px;}
.filter-search input{background:transparent;border:none;color:#fff;font-family:inherit;font-size:10px;font-weight:700;outline:none;width:100%;}
.filter-search input::placeholder{color:rgba(255,255,255,.5);}

/* TABLE */
.tbl{width:100%;border-collapse:collapse;}
.tbl thead tr{background:#f8fafc;}
.tbl th{padding:11px 15px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;}
.tbl tbody tr{border-bottom:1px solid #f8fafc;transition:background .1s;}
.tbl tbody tr:last-child{border-bottom:none;}
.tbl tbody tr:hover{background:#fafbfc;}
.tbl td{padding:11px 15px;vertical-align:middle;font-size:12px;}
.tbl-empty{padding:40px;text-align:center;color:var(--light);}
.tbl-empty i{font-size:28px;display:block;margin-bottom:8px;opacity:.2;}

.spill{font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;text-transform:uppercase;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;}
.spill-new{background:#fee2e2;color:#dc2626;}
.spill-active{background:#dbeafe;color:#1d4ed8;}
.spill-settled{background:#dcfce7;color:#15803d;}
.spill-urgent{background:#fce7f3;color:#be185d;}
.spill-pending{background:#fef3c7;color:#a16207;}

/* BTN */
.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;font-family:inherit;font-size:10px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:9px;cursor:pointer;transition:all .18s;white-space:nowrap;}
.btn-primary{background:var(--btn-grad);color:#fff;box-shadow:0 2px 8px rgba(0,0,82,.25);}
.btn-primary:hover{transform:translateY(-1px);}
.btn-vawc{background:linear-gradient(135deg,#7c3aed,#4c1d95);color:#fff;box-shadow:0 2px 8px rgba(124,58,237,.3);}
.btn-ghost{background:#f1f5f9;color:#475569;}
.btn-sm{padding:5px 10px;font-size:9px;}
.btn-icon{width:30px;height:30px;border-radius:7px;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11px;transition:all .15s;background:#f1f5f9;color:var(--muted);}
.btn-icon:hover{background:var(--btn-grad);color:#fff;}

/* MODALS */
.modal-ov{position:fixed;inset:0;z-index:999;display:flex;align-items:center;justify-content:center;padding:12px;background:rgba(0,0,18,.68);backdrop-filter:blur(5px);}
.modal-box{background:#fff;width:100%;max-width:580px;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,52,.35);border-bottom:5px solid var(--vawc);max-height:94vh;overflow-y:auto;}
.modal-in{padding:22px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:13px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:13px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:8px;}
.modal-ico{width:32px;height:32px;border-radius:8px;background:#f5f3ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.modal-ico i{color:var(--vawc);font-size:13px;}
.modal-close{background:none;border:none;color:var(--light);font-size:19px;cursor:pointer;line-height:1;flex-shrink:0;}
.modal-close:hover{color:var(--danger);}

/* FORMS */
.flbl{font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:4px;}
.finput{width:100%;padding:9px 12px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s;}
.finput:focus{border-color:var(--vawc);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fgrid2{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.fgrp{margin-bottom:12px;}
.fspan2{grid-column:span 2;}
.fselect{appearance:none;cursor:pointer;}
.sblk{background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:12px;border:1px solid var(--border);}
.sblk-ttl{font-size:9px;font-weight:900;text-transform:uppercase;color:var(--muted);margin-bottom:8px;display:flex;align-items:center;gap:5px;}

/* DETAIL FIELD */
.dfield{background:#f5f3ff;border:1px solid #ede9fe;border-radius:9px;padding:10px 13px;margin-bottom:8px;}
.dfield-lbl{font-size:8px;font-weight:900;color:#7c3aed;text-transform:uppercase;letter-spacing:.07em;margin-bottom:3px;}
.dfield-val{font-size:12px;font-weight:800;color:var(--text);}

@media(max-width:768px){
    .action-grid{grid-template-columns:repeat(2,1fr);}
    .hero-stats{gap:8px;}
    .hero{padding:18px 14px 16px;}
    .hero-title{font-size:16px;}
    .conf-banner{flex-wrap:wrap;}
    .conf-btn{width:100%;text-align:center;justify-content:center;display:flex;align-items:center;}
    .portal-wrap{padding:14px 10px 40px;}
    .tbl th,.tbl td{padding:8px 10px;}
    .filter-bar{gap:6px;}
    .filter-search{min-width:120px;}
    .card-head{flex-direction:column;align-items:flex-start;}
    .fgrid2{grid-template-columns:1fr;}
    .fspan2{grid-column:span 1;}
}
@media(max-width:480px){
    .action-grid{grid-template-columns:repeat(2,1fr);}
    .hstat{min-width:56px;padding:9px 10px;}
    .hstat-n{font-size:16px;}
}
</style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white shadow-sm" style="background:linear-gradient(135deg,#7c3aed 0%,#4c1d95 100%);">
                    <i class="fas fa-shield-alt text-lg"></i>
                </div>
                <div>
                    <h2 class="font-black text-xl text-gray-800 leading-tight uppercase tracking-tight">VAWC Portal</h2>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Women & Children Protection — Barangay San Miguel II</p>
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

    <div class="portal-wrap" x-data="{
        activeTab: 'cases',
        viewModal: false,
        newIncidentModal: false,
        activeIssue: null,
        openView(issue) {
            this.activeIssue = issue;
            this.viewModal = true;
        },
        fetchFilters() {
            const form = document.getElementById('filter-form');
            const url = new URL(form.action);
            url.search = new URLSearchParams(new FormData(form)).toString();
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    document.getElementById('cases-table-container').innerHTML = doc.getElementById('cases-table-container').innerHTML;
                });
        }
    }">

        {{-- CONFIDENTIALITY BANNER --}}
        <div class="conf-banner">
            <div class="conf-ico"><i class="fas fa-user-secret"></i></div>
            <div class="conf-text">
                <strong>Strict Confidentiality Enforced</strong><br>
                Unauthorized access or disclosure of VAWC records is strictly prohibited under <strong>Republic Act No. 9262</strong>. All activity is logged for audit.
            </div>
            <button class="conf-btn"><i class="fas fa-clipboard-check" style="margin-right:5px;"></i> Privacy Audit</button>
        </div>

        {{-- HERO --}}
        <div class="hero">
            <i class="fas fa-hand-holding-heart hero-bg-ico"></i>
            <div class="hero-tag"><i class="fas fa-shield-alt" style="margin-right:5px;"></i> VAWC Management System</div>
            <div class="hero-title">Protection for Women & Children</div>
            <div class="hero-desc">Confidential case monitoring and protection services. All records are handled with the utmost sensitivity and in accordance with RA 9262.</div>
            <div class="hero-stats">
                @php
                    $totalV   = \App\Models\IssueReport::where('department','VAWC')->count();
                    $newV     = \App\Models\IssueReport::where('department','VAWC')->where('status','submitted')->count();
                    $urgentV  = \App\Models\IssueReport::where('department','VAWC')->where('status','urgent')->count();
                    $settledV = \App\Models\IssueReport::where('department','VAWC')->where('status','settled')->count();
                    $pendingV = \App\Models\IssueReport::where('department','VAWC')->where('status','pending')->count();
                    $reviewV  = \App\Models\IssueReport::where('department','VAWC')->where('status','under_review')->count();
                @endphp
                <div class="hstat"><div class="hstat-n">{{ $totalV }}</div><div class="hstat-l">Total</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#fca5a5;">{{ $urgentV }}</div><div class="hstat-l">Urgent</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#f9a8d4;">{{ $newV }}</div><div class="hstat-l">New</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#fef08a;">{{ $pendingV }}</div><div class="hstat-l">Pending</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#93c5fd;">{{ $reviewV }}</div><div class="hstat-l">Review</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#86efac;">{{ $settledV }}</div><div class="hstat-l">Resolved</div></div>
            </div>
        </div>

        {{-- ACTION CARDS --}}
        <div class="action-grid">
            <div class="action-card" @click="activeTab='cases'" :class="activeTab==='cases'?'active':''">
                <div class="ac-ico" style="background:#fdf4ff;"><i class="fas fa-folder-open" style="color:#7c3aed;"></i></div>
                <div class="ac-name">Case Records</div>
                <div class="ac-sub">Active protection files</div>
            </div>
            <div class="action-card" @click="activeTab='referral'" :class="activeTab==='referral'?'active':''">
                <div class="ac-ico" style="background:#fee2e2;"><i class="fas fa-ambulance" style="color:#dc2626;"></i></div>
                <div class="ac-name">PNP / DSWD Referral</div>
                <div class="ac-sub">Emergency escalation</div>
            </div>
            <div class="action-card" @click="activeTab='audit'" :class="activeTab==='audit'?'active':''">
                <div class="ac-ico" style="background:#dcfce7;"><i class="fas fa-clipboard-check" style="color:#15803d;"></i></div>
                <div class="ac-name">Resolved Archive</div>
                <div class="ac-sub">Closed cases history</div>
            </div>
        </div>

        {{-- CASES TAB --}}
        <div x-show="activeTab==='cases'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-folder-open"></i> VAWC Protection Records</div>
                    <div style="display:flex;gap:7px;align-items:center;flex-wrap:wrap;">
                        <span class="cbadge cbadge-red">{{ $newV }} New</span>
                        <span class="cbadge cbadge-vawc">{{ $totalV }} Total</span>
                        <button @click="newIncidentModal=true" class="btn btn-vawc btn-sm">
                            <i class="fas fa-plus"></i> New Incident
                        </button>
                    </div>
                </div>

                {{-- FILTER BAR — navy gradient theme --}}
                <div style="padding:12px 18px 0;">
                    @if(session('referral_pdf'))
                    <script>
                        setTimeout(() => { window.open("{{ url('/vawc/issues/'.session('referral_pdf').'/print-referral') }}", '_blank'); }, 600);
                    </script>
                    @endif
                    <form id="filter-form" action="{{ route('vawc.dashboard') }}" method="GET" @submit.prevent="fetchFilters()">
                        <div class="filter-bar">
                            <div class="filter-search">
                                <i class="fas fa-search" style="color:rgba(255,255,255,.5);font-size:10px;flex-shrink:0;"></i>
                                <input type="text" name="search" value="{{ request('search') }}" @input.debounce.500ms="fetchFilters()" placeholder="Search name or ID..." autocomplete="off">
                            </div>
                            <input type="date" name="date" value="{{ request('date') }}" @change="fetchFilters()"
                                   title="Filter by date filed"
                                   style="min-width:120px;">
                            <select name="status_filter" @change="fetchFilters()">
                                <option value="">All Statuses</option>
                                <option value="submitted"       {{ request('status_filter')==='submitted'       ?'selected':'' }}>New / Submitted</option>
                                <option value="under_review"    {{ request('status_filter')==='under_review'    ?'selected':'' }}>Under Review</option>
                                <option value="pending"         {{ request('status_filter')==='pending'         ?'selected':'' }}>Pending</option>
                                <option value="on_going"        {{ request('status_filter')==='on_going'        ?'selected':'' }}>On-going</option>
                                <option value="referred_to_pnp" {{ request('status_filter')==='referred_to_pnp' ?'selected':'' }}>Referred to PNP</option>
                                <option value="urgent"          {{ request('status_filter')==='urgent'          ?'selected':'' }}>Urgent Rescue</option>
                                <option value="settled"         {{ request('status_filter')==='settled'         ?'selected':'' }}>Resolved</option>
                            </select>
                            <noscript><button type="submit" class="btn btn-sm">Filter</button></noscript>
                        </div>
                    </form>
                </div>

                <div id="cases-table-container" style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Case Code</th>
                            <th>Category</th>
                            <th>Complainant</th>
                            <th>Date Filed</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr></thead>
                        <tbody>
                            @forelse($issues as $issue)
                            @php $caseCode = 'VAWC-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT); @endphp
                            <tr>
                                <td>
                                    <div style="font-size:11px;font-weight:900;color:#7c3aed;">#{{ $caseCode }}</div>
                                    <div style="font-size:9px;color:var(--light);font-weight:600;text-transform:uppercase;">Confidential</div>
                                </td>
                                <td>
                                    <span style="background:#f5f3ff;color:#7c3aed;font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;border:1px solid #ede9fe;">{{ $issue->issue_type }}</span>
                                </td>
                                <td>
                                    <div style="font-size:12px;font-weight:800;color:var(--text);">{{ $issue->complainant_name }}</div>
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $issue->contact }}</div>
                                </td>
                                <td><div style="font-size:11px;color:var(--muted);">{{ $issue->created_at->format('M d, Y') }}</div></td>
                                <td>
                                    @php $sc=['submitted'=>'spill-new','under_review'=>'spill-active','settled'=>'spill-settled','urgent'=>'spill-urgent','pending'=>'spill-pending'][$issue->status]??'spill-pending'; @endphp
                                    <span class="spill {{ $sc }}"><i class="fas fa-circle" style="font-size:6px;"></i> {{ ucfirst(str_replace('_',' ',$issue->status)) }}</span>
                                </td>
                                <td style="text-align:right;">
                                    <div style="display:flex;gap:5px;justify-content:flex-end;align-items:center;">
                                        {{-- VIEW BUTTON --}}
                                        <button @click="openView({{ json_encode([
                                            'id'               => $issue->id,
                                            'case_code'        => $caseCode,
                                            'issue_type'       => $issue->issue_type,
                                            'status'           => $issue->status,
                                            'complainant_name' => $issue->complainant_name,
                                            'complainant_age'  => $issue->complainant_age,
                                            'complainant_gender'=> $issue->complainant_gender,
                                            'contact'          => $issue->contact,
                                            'complainant_address'=> $issue->complainant_address,
                                            'respondent_name'  => $issue->respondent_name,
                                            'respondent_address'=> $issue->respondent_address,
                                            'description'      => $issue->description,
                                            'admin_summary'    => $issue->admin_summary,
                                            'incident_date'    => $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('M d, Y h:i A') : 'N/A',
                                            'location'         => $issue->location,
                                            'created_at'       => $issue->created_at->format('M d, Y'),
                                        ]) }})"
                                        class="btn-icon" title="View Details" style="background:#f5f3ff;color:#7c3aed;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        {{-- PNP REFERRAL ACTION --}}
                                        <form action="{{ url('/vawc/issues/'.$issue->id.'/pnp-referral') }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Escalate this to PNP? It will automatically download a PDF Referral Document and mark the case as On-going.')" class="btn-icon" title="Escalate to PNP" style="background:#fee2e2;color:#dc2626;">
                                                <i class="fas fa-shield-alt"></i>
                                            </button>
                                        </form>
                                        {{-- STATUS UPDATE --}}
                                        <form action="{{ url('/vawc/issues/'.$issue->id.'/status') }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                    style="font-size:9px;font-weight:800;border:1.5px solid var(--border);border-radius:7px;padding:5px 8px;background:#f8fafc;cursor:pointer;outline:none;font-family:inherit;">
                                                <option value="submitted"       {{ $issue->status==='submitted'       ? 'selected' : '' }}>Submitted</option>
                                                <option value="under_review"    {{ $issue->status==='under_review'    ? 'selected' : '' }}>Under Review</option>
                                                <option value="pending"         {{ $issue->status==='pending'         ? 'selected' : '' }}>Pending</option>
                                                <option value="on_going"        {{ $issue->status==='on_going'        ? 'selected' : '' }}>On-going</option>
                                                <option value="referred_to_pnp" {{ $issue->status==='referred_to_pnp' ? 'selected' : '' }}>Referred to PNP</option>
                                                <option value="urgent"          {{ $issue->status==='urgent'          ? 'selected' : '' }}>Urgent Rescue</option>
                                                <option value="settled"         {{ $issue->status==='settled'         ? 'selected' : '' }}>Resolved</option>
                                            </select>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6">
                                <div class="tbl-empty"><i class="fas fa-folder-open"></i><p style="font-size:11px;font-weight:700;">No VAWC cases on file.</p></div>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- REFERRAL TAB --}}
        <div x-show="activeTab==='referral'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-ambulance"></i> PNP / DSWD Referrals</div>
                    <span class="cbadge" style="background:#fce7f3;color:#be185d;">Urgent Cases</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Case Code</th>
                            <th>Complainant</th>
                            <th>Escalation Date</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr></thead>
                        <tbody>
                            @forelse(\App\Models\IssueReport::where('department','VAWC')->whereIn('status',['urgent','on_going','referred_to_pnp'])->latest()->get() as $urgentIssue)
                            @php $uCode = 'VAWC-'.$urgentIssue->created_at->format('Y').'-'.str_pad($urgentIssue->id, 3, '0', STR_PAD_LEFT); @endphp
                            <tr>
                                <td><div style="font-size:11px;font-weight:900;color:#dc2626;">#{{ $uCode }}</div></td>
                                <td>
                                    <div style="font-size:12px;font-weight:800;">{{ $urgentIssue->complainant_name }}</div>
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $urgentIssue->contact }}</div>
                                </td>
                                <td><div style="font-size:11px;color:var(--muted);">{{ $urgentIssue->updated_at->format('M d, Y') }}</div></td>
                                <td><span class="spill spill-urgent"><i class="fas fa-exclamation-triangle" style="font-size:8px;"></i> ESCALATED</span></td>
                                <td style="text-align:right;">
                                    <a href="{{ url('/vawc/issues/'.$urgentIssue->id.'/print-referral') }}" target="_blank" class="btn btn-vawc btn-sm" style="display:inline-flex;align-items:center;gap:5px;font-weight:800;background:linear-gradient(135deg,#dc2626,#991b1b);box-shadow:0 2px 8px rgba(220,38,38,.3);text-decoration:none;">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5"><div class="tbl-empty"><i class="fas fa-ambulance"></i><p style="font-size:11px;font-weight:700;">No active escalation referrals.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        {{-- AUDIT TAB (RESOLVED ARCHIVE) --}}
        <div x-show="activeTab==='audit'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-clipboard-check"></i> Resolved Cases Archive</div>
                    <span class="cbadge" style="background:#dcfce7;color:#15803d;">Archived</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Case Code</th>
                            <th>Complainant</th>
                            <th>Date Filed</th>
                            <th>Resolved Date</th>
                            <th>Status</th>
                        </tr></thead>
                        <tbody>
                            @forelse(\App\Models\IssueReport::where('department','VAWC')->where('status','settled')->latest()->get() as $resolvedIssue)
                            @php $rCode = 'VAWC-'.$resolvedIssue->created_at->format('Y').'-'.str_pad($resolvedIssue->id, 3, '0', STR_PAD_LEFT); @endphp
                            <tr>
                                <td><div style="font-size:11px;font-weight:900;color:#15803d;">#{{ $rCode }}</div></td>
                                <td>
                                    <div style="font-size:12px;font-weight:800;">{{ $resolvedIssue->complainant_name }}</div>
                                </td>
                                <td><div style="font-size:11px;color:var(--muted);">{{ $resolvedIssue->created_at->format('M d, Y') }}</div></td>
                                <td><div style="font-size:11px;font-weight:800;color:var(--text);">{{ $resolvedIssue->updated_at->format('M d, Y') }}</div></td>
                                <td><span class="spill spill-settled"><i class="fas fa-check-circle" style="font-size:8px;"></i> RESOLVED</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="5"><div class="tbl-empty"><i class="fas fa-clipboard-check"></i><p style="font-size:11px;font-weight:700;">No resolved cases directly archived here.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ VIEW INCIDENT DETAILS MODAL ══ --}}
        <div x-show="viewModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="viewModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-eye"></i></div>
                            <div>
                                <div>Case Details</div>
                                <div style="font-size:9px;font-weight:700;color:var(--vawc);text-transform:none;" x-text="activeIssue ? '#'+activeIssue.case_code+' — Confidential' : ''"></div>
                            </div>
                        </div>
                        <button @click="viewModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <template x-if="activeIssue">
                        <div>
                            {{-- Status Badge --}}
                            <div style="margin-bottom:14px;">
                                <template x-if="activeIssue.status==='urgent'">
                                    <span class="spill spill-urgent" style="font-size:11px;padding:5px 14px;"><i class="fas fa-exclamation-triangle"></i> URGENT RESCUE</span>
                                </template>
                                <template x-if="activeIssue.status==='submitted'">
                                    <span class="spill spill-new" style="font-size:11px;padding:5px 14px;"><i class="fas fa-clock"></i> New Submission</span>
                                </template>
                                <template x-if="activeIssue.status==='under_review'">
                                    <span class="spill spill-active" style="font-size:11px;padding:5px 14px;"><i class="fas fa-search"></i> Under Review</span>
                                </template>
                                <template x-if="activeIssue.status==='settled'">
                                    <span class="spill spill-settled" style="font-size:11px;padding:5px 14px;"><i class="fas fa-check-circle"></i> Resolved</span>
                                </template>
                                <template x-if="activeIssue.status==='pending'">
                                    <span class="spill spill-pending" style="font-size:11px;padding:5px 14px;"><i class="fas fa-pause-circle"></i> Pending</span>
                                </template>
                            </div>

                            {{-- Case Info --}}
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-tag"></i> Case Information</div>
                                <div class="fgrid2" style="gap:8px;">
                                    <div class="dfield">
                                        <div class="dfield-lbl">Case Code</div>
                                        <div class="dfield-val" x-text="'#'+activeIssue.case_code"></div>
                                    </div>
                                    <div class="dfield">
                                        <div class="dfield-lbl">Category</div>
                                        <div class="dfield-val" x-text="activeIssue.issue_type"></div>
                                    </div>
                                    <div class="dfield">
                                        <div class="dfield-lbl">Date Filed</div>
                                        <div class="dfield-val" x-text="activeIssue.created_at"></div>
                                    </div>
                                    <div class="dfield">
                                        <div class="dfield-lbl">Incident Date & Time</div>
                                        <div class="dfield-val" x-text="activeIssue.incident_date || 'N/A'"></div>
                                    </div>
                                    <div class="dfield" style="grid-column:span 2;">
                                        <div class="dfield-lbl">Incident Location</div>
                                        <div class="dfield-val" x-text="activeIssue.location || 'N/A'"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Complainant --}}
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant Information</div>
                                <div class="fgrid2" style="gap:8px;">
                                    <div class="dfield" style="grid-column:span 2;">
                                        <div class="dfield-lbl">Full Name</div>
                                        <div class="dfield-val" x-text="activeIssue.complainant_name"></div>
                                    </div>
                                    <div class="dfield">
                                        <div class="dfield-lbl">Age</div>
                                        <div class="dfield-val" x-text="activeIssue.complainant_age || 'N/A'"></div>
                                    </div>
                                    <div class="dfield">
                                        <div class="dfield-lbl">Gender</div>
                                        <div class="dfield-val" x-text="activeIssue.complainant_gender || 'N/A'"></div>
                                    </div>
                                    <div class="dfield">
                                        <div class="dfield-lbl">Contact</div>
                                        <div class="dfield-val" x-text="activeIssue.contact"></div>
                                    </div>
                                    <div class="dfield">
                                        <div class="dfield-lbl">Address</div>
                                        <div class="dfield-val" x-text="activeIssue.complainant_address || 'N/A'"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Respondent --}}
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-user-slash"></i> Respondent Information</div>
                                <div class="fgrid2" style="gap:8px;">
                                    <div class="dfield" style="grid-column:span 2;">
                                        <div class="dfield-lbl">Full Name</div>
                                        <div class="dfield-val" x-text="activeIssue.respondent_name || 'N/A'"></div>
                                    </div>
                                    <div class="dfield" style="grid-column:span 2;">
                                        <div class="dfield-lbl">Address</div>
                                        <div class="dfield-val" x-text="activeIssue.respondent_address || 'N/A'"></div>
                                    </div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-file-alt"></i> Resident's Original Narrative</div>
                                <div style="background:#fff;border:1px solid #ede9fe;border-radius:8px;padding:12px;font-size:12px;font-weight:600;color:var(--text);line-height:1.7;white-space:pre-wrap;" x-text="activeIssue.description || 'No description provided.'"></div>
                            </div>

                            {{-- Staff Summary --}}
                            <div class="sblk" style="border-color:#bfdbfe; background:#eff6ff;">
                                <div class="sblk-ttl" style="color:#1d4ed8;"><i class="fas fa-edit"></i> VAWC Staff Official Summary</div>
                                <form :action="'{{ url('/vawc/issues') }}/' + activeIssue.id + '/summary'" method="POST">
                                    @csrf @method('PATCH')
                                    <textarea name="admin_summary" required rows="4" class="finput" style="border-color:#93c5fd; background:#fff; font-size:12px; outline:none;" placeholder="Write a formalized case summary here for escalation and official PNP referral printing..." x-text="activeIssue.admin_summary"></textarea>
                                    <div style="display:flex; justify-content:flex-end; margin-top:8px;">
                                        <button type="submit" class="btn" style="background:#2563eb; color:#fff; padding:6px 12px; font-weight:800; font-size:10px; border-radius:6px; box-shadow:0 2px 6px rgba(37,99,235,0.3); border:none; cursor:pointer;"><i class="fas fa-save"></i> Save Summary</button>
                                    </div>
                                </form>
                            </div>

                            <div style="display:flex;justify-content:flex-end;gap:8px;">
                                <button @click="viewModal=false" class="btn btn-ghost btn-sm">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- ══ NEW INCIDENT MODAL ══ --}}
        <div x-show="newIncidentModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="newIncidentModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-plus"></i></div>
                            <div>
                                <div>New VAWC Incident Report</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Confidential — Barangay San Miguel II</div>
                            </div>
                        </div>
                        <button @click="newIncidentModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ url('/vawc/incidents/store') }}" method="POST">
                        @csrf

                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-tag"></i> Incident Details</div>
                            <div class="fgrp">
                                <label class="flbl">Type of VAWC Case *</label>
                                <select name="issue_type" required class="finput fselect">
                                    <option value="">— Select Type —</option>
                                    <option>VAWC – Domestic Violence</option>
                                    <option>VAWC – Physical Abuse</option>
                                    <option>VAWC – Sexual Harassment</option>
                                    <option>VAWC – Child Abuse</option>
                                    <option>VAWC – Economic Abuse</option>
                                    <option>VAWC – Psychological Abuse</option>
                                    <option>VAWC – Stalking / Harassment</option>
                                    <option>Others</option>
                                </select>
                            </div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Date & Time of Incident</label><input type="datetime-local" name="incident_date" class="finput"></div>
                                <div><label class="flbl">Location</label><input type="text" name="incident_location" placeholder="Purok, Street, Block..." class="finput"></div>
                            </div>
                        </div>

                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant / Victim</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Full Name *</label><input type="text" name="complainant_name" required class="finput" placeholder="Full name"></div>
                                <div><label class="flbl">Age</label><input type="number" name="complainant_age" min="1" class="finput" placeholder="Age"></div>
                                <div>
                                    <label class="flbl">Gender</label>
                                    <select name="complainant_gender" class="finput fselect">
                                        <option value="">Select</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div><label class="flbl">Contact Number *</label><input type="text" name="contact" required class="finput" placeholder="09XXXXXXXXX"></div>
                                <div class="fspan2"><label class="flbl">Address</label><input type="text" name="complainant_address" class="finput" placeholder="Blk/Lot, Street..."></div>
                            </div>
                        </div>

                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user-slash"></i> Respondent / Perpetrator</div>
                            <div class="fgrid2 fgrp">
                                <div class="fspan2"><label class="flbl">Full Name *</label><input type="text" name="respondent_name" required class="finput" placeholder="Name of respondent"></div>
                                <div class="fspan2"><label class="flbl">Address</label><input type="text" name="respondent_address" class="finput" placeholder="Respondent address"></div>
                            </div>
                        </div>

                        <div class="fgrp">
                            <label class="flbl">Description / Narration *</label>
                            <textarea name="description" required rows="4" class="finput" style="resize:vertical;" placeholder="Describe the incident in full detail..."></textarea>
                        </div>

                        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:9px;padding:10px 13px;margin-bottom:14px;font-size:11px;font-weight:700;color:#7f1d1d;">
                            <i class="fas fa-shield-alt" style="margin-right:5px;"></i> This report is <strong>strictly confidential</strong> under RA 9262. For immediate danger, call <strong>911</strong>.
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:9px;">
                            <button type="button" @click="newIncidentModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-vawc"><i class="fas fa-shield-alt"></i> Submit Incident Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;">
        © {{ date('Y') }} Barangay SM2 Management System — VAWC Portal &nbsp;|&nbsp; RA 9262 Compliant
    </footer>

</x-app-layout>
