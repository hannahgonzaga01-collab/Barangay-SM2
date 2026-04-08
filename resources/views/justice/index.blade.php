<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap');
:root{
    --brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;
    --body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;
    --danger:#dc2626;--success:#059669;--warn:#d97706;
    --card-shadow:0 4px 24px rgba(4,25,45,0.13),0 1.5px 6px rgba(0,0,0,0.07);
    --btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);
    --r-card:16px;
}
*{box-sizing:border-box;margin:0;padding:0;}
html,body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--body-bg);color:var(--text);}
[x-cloak]{display:none!important;}
.page-wrap{max-width:1100px;margin:0 auto;padding:24px 16px 60px;}

.portal-hero{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);border-radius:var(--r-card);padding:28px 28px 24px;margin-bottom:20px;box-shadow:var(--card-shadow);position:relative;overflow:hidden;}
.portal-hero::after{content:'\f0e3';font-family:'Font Awesome 5 Free';font-weight:900;position:absolute;right:-10px;bottom:-20px;font-size:130px;color:rgba(255,255,255,.05);line-height:1;pointer-events:none;}
.portal-tag{font-size:9px;font-weight:900;background:rgba(255,255,255,.15);color:rgba(255,255,255,.9);padding:4px 12px;border-radius:99px;text-transform:uppercase;letter-spacing:.08em;display:inline-block;margin-bottom:10px;}
.portal-hero h2{font-size:clamp(18px,3vw,26px);font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.2;margin-bottom:6px;}
.portal-hero p{font-size:13px;color:rgba(255,255,255,.75);font-weight:600;max-width:500px;line-height:1.5;}
.hero-stats{display:flex;gap:12px;margin-top:18px;flex-wrap:wrap;}
.hstat{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:11px;padding:11px 16px;text-align:center;min-width:72px;}
.hstat-n{font-size:20px;font-weight:900;color:#fff;line-height:1;}
.hstat-l{font-size:8px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.07em;margin-top:3px;}

.portal-tabs{display:flex;gap:6px;background:rgba(14,83,147,.06);padding:6px;border-radius:12px;border:1px solid rgba(14,83,147,.12);flex-wrap:wrap;}
.portal-tab{padding:8px 14px;border-radius:9px;font-size:10px;font-weight:800;color:var(--muted);border:none;background:transparent;cursor:pointer;text-transform:uppercase;letter-spacing:.05em;transition:all .15s;font-family:inherit;display:flex;align-items:center;gap:6px;white-space:nowrap;}
.portal-tab.active{background:var(--btn-grad);color:#fff;}

.wcard{background:#fff;border-radius:var(--r-card);box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.05);margin-bottom:16px;overflow:hidden;}
.wcard-head{padding:13px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;}
.wcard-title{font-size:10px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.09em;display:flex;align-items:center;gap:6px;}
.wcard-title i{color:var(--brand);}
.wcard-badge{font-size:9px;background:#eff6ff;color:var(--brand);font-weight:900;padding:3px 9px;border-radius:99px;}

.navy-box{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);border-radius:var(--r-card);padding:20px;margin-bottom:20px;box-shadow:var(--card-shadow);}
.action-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
.action-card{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:14px;padding:18px 12px 15px;text-align:center;cursor:pointer;transition:all .2s;}
.action-card:hover{background:rgba(255,255,255,.18);border-color:rgba(255,255,255,.38);transform:translateY(-3px);}
.action-ico{width:46px;height:46px;background:rgba(255,255,255,.14);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;}
.action-ico i{color:#fff;font-size:18px;}
.action-card:hover .action-ico{background:rgba(255,255,255,.26);}
.action-name{font-size:10px;font-weight:800;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.3;}
.action-sub{font-size:9px;font-weight:600;color:rgba(255,255,255,.6);margin-top:4px;}

.blue-section{background:rgba(14,83,147,.08);border:2px solid rgba(14,83,147,.18);border-radius:var(--r-card);margin-bottom:14px;overflow:hidden;}
.blue-section-head{padding:14px 18px;border-bottom:2px solid rgba(14,83,147,.12);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;background:rgba(14,83,147,.06);}
.blue-section-title{font-size:12px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.06em;display:flex;align-items:center;gap:9px;}
.blue-section-title i{color:var(--brand);}
.blue-section-badge{font-size:9px;background:var(--brand);color:#fff;font-weight:900;padding:5px 13px;border-radius:99px;}

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

.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;font-family:inherit;font-size:10px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:9px;cursor:pointer;transition:all .18s;white-space:nowrap;}
.btn-primary{background:var(--btn-grad);color:#fff;box-shadow:0 2px 8px rgba(0,0,82,.25);}
.btn-primary:hover{transform:translateY(-1px);}
.btn-ghost{background:#f1f5f9;color:#475569;}
.btn-ghost:hover{background:#475569;color:#fff;}
.btn-sm{padding:6px 11px;font-size:9px;}
.btn-icon{width:30px;height:30px;border-radius:7px;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11px;transition:all .15s;background:#eff6ff;color:var(--brand);}
.btn-icon:hover{background:var(--btn-grad);color:#fff;}
.acts{display:flex;gap:5px;align-items:center;justify-content:flex-end;flex-wrap:wrap;}

.notif-bell-wrap{position:relative;}
.notif-bell-btn{background:rgba(14,83,147,.1);border:1.5px solid rgba(14,83,147,.2);color:var(--brand);width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:14px;transition:all .15s;position:relative;}
.notif-bell-btn:hover{background:rgba(14,83,147,.2);}
.notif-badge{position:absolute;top:-5px;right:-5px;background:#ef4444;color:#fff;font-size:8px;font-weight:900;min-width:17px;height:17px;border-radius:99px;display:flex;align-items:center;justify-content:center;border:2px solid #fff;padding:0 3px;}
.notif-dropdown{position:absolute;top:calc(100% + 8px);right:0;width:290px;background:#fff;border-radius:14px;box-shadow:0 10px 40px rgba(0,0,52,.22);border:1px solid var(--border);z-index:300;overflow:hidden;}

.modal-ov{position:fixed;inset:0;z-index:999;display:flex;align-items:center;justify-content:center;padding:12px;background:rgba(0,0,18,.65);backdrop-filter:blur(5px);}
.modal-box{background:#fff;width:100%;max-width:580px;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,52,.35);border-bottom:5px solid var(--brand);max-height:94vh;overflow-y:auto;}
.modal-in{padding:22px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:13px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:13px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:9px;}
.modal-ico{width:32px;height:32px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.modal-ico i{color:var(--brand);font-size:13px;}
.modal-close{background:none;border:none;color:var(--light);font-size:20px;cursor:pointer;line-height:1;}
.modal-close:hover{color:var(--danger);}

.fgrp{margin-bottom:12px;}
.flbl{font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;display:block;margin-bottom:4px;letter-spacing:.06em;}
.req{color:var(--danger);margin-left:2px;}
.finput{width:100%;padding:9px 12px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s;}
.finput:focus{border-color:var(--brand);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fselect{appearance:none;cursor:pointer;}
.fgrid2{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.fspan2{grid-column:span 2;}
.sblk{background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:11px;border:1px solid var(--border);}
.sblk-ttl{font-size:9px;font-weight:900;text-transform:uppercase;color:var(--muted);margin-bottom:8px;display:flex;align-items:center;gap:5px;letter-spacing:.07em;}
.vfield{background:#f8fafc;border:1.5px solid var(--border);border-radius:9px;padding:10px 13px;margin-bottom:8px;}
.vfield-lbl{font-size:8px;font-weight:900;color:var(--brand);text-transform:uppercase;letter-spacing:.07em;margin-bottom:3px;}
.vfield-val{font-size:12px;font-weight:700;color:var(--text);}

@media(max-width:768px){
    .action-grid{grid-template-columns:1fr 1fr;}
    .fgrid2{grid-template-columns:1fr;}
    .fspan2{grid-column:span 1;}
    .page-wrap{padding:14px 11px 50px;}
    .wcard-head{flex-direction:column;align-items:flex-start;}
    .portal-tabs{gap:4px;}
    .portal-tab{padding:7px 10px;font-size:9px;}
}
@media(max-width:480px){
    .hstat{min-width:60px;padding:9px 10px;}
    .hstat-n{font-size:18px;}
    .acts{flex-wrap:wrap;}
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

    <div class="page-wrap" x-data="{
        activeTab: 'blotter',
        notifOpen: false,
        blotterModal: false,
        summonModal: false,
        viewModal: false,
        activeRecord: null,
        searchQuery: '',
        filterMonth: '',
        filterYear: '',
        openView(rec){ this.activeRecord = rec; this.viewModal = true; }
    }">

        {{-- HERO --}}
        <div class="portal-hero">
            <span class="portal-tag"><i class="fas fa-gavel" style="margin-right:5px;"></i> Official Justice Portal</span>
            <h2>Katarungang Pambarangay</h2>
            <p>Systematic mediation and conflict resolution for a harmonious Barangay SM2.</p>
            <div class="hero-stats">
                @php
                    $totalJ   = \App\Models\IssueReport::where('department','Justice')->count();
                    $openJ    = \App\Models\IssueReport::where('department','Justice')->whereIn('status',['submitted','under_review'])->count();
                    $settledJ = \App\Models\IssueReport::where('department','Justice')->where('status','settled')->count();
                    $pendingJ = \App\Models\IssueReport::where('department','Justice')->where('status','pending')->count();
                @endphp
                <div class="hstat"><div class="hstat-n">{{ $totalJ }}</div><div class="hstat-l">Total</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#93c5fd;">{{ $openJ }}</div><div class="hstat-l">Open</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#fef08a;">{{ $pendingJ }}</div><div class="hstat-l">Pending</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#86efac;">{{ $settledJ }}</div><div class="hstat-l">Settled</div></div>
            </div>
        </div>

        {{-- TABS + NOTIF --}}
        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:16px;flex-wrap:wrap;">
            <div class="portal-tabs">
                <button class="portal-tab" :class="activeTab==='blotter'?'active':''" @click="activeTab='blotter'">
                    <i class="fas fa-book"></i> <span>Blotter</span>
                    <span style="font-size:8px;background:rgba(14,83,147,.12);color:var(--brand);padding:1px 6px;border-radius:99px;">{{ $totalJ }}</span>
                </button>
                <button class="portal-tab" :class="activeTab==='mediation'?'active':''" @click="activeTab='mediation'">
                    <i class="fas fa-balance-scale"></i> <span>Mediation</span>
                </button>
                <button class="portal-tab" :class="activeTab==='requests'?'active':''" @click="activeTab='requests'">
                    <i class="fas fa-inbox"></i> <span>Issue Reports</span>
                    <span style="font-size:8px;background:rgba(14,83,147,.12);color:var(--brand);padding:1px 6px;border-radius:99px;">{{ $totalJ }}</span>
                </button>
            </div>
            <div class="notif-bell-wrap" @click.away="notifOpen=false">
                <button class="notif-bell-btn" @click="notifOpen=!notifOpen">
                    <i class="fas fa-bell"></i>
                    @if($openJ > 0)<span class="notif-badge">{{ $openJ }}</span>@endif
                </button>
                <div x-show="notifOpen" x-cloak x-transition class="notif-dropdown">
                    <div style="padding:10px 14px;background:#f8fafc;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;">Notifications</span>
                    </div>
                    @if($openJ > 0)
                    <div style="padding:11px 14px;display:flex;gap:9px;align-items:flex-start;background:#eff6ff;">
                        <i class="fas fa-gavel" style="color:var(--brand);margin-top:2px;font-size:13px;"></i>
                        <div>
                            <div style="font-size:12px;font-weight:800;color:var(--text);">{{ $openJ }} Open Case{{ $openJ > 1 ? 's' : '' }}</div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;">Requiring attention in Justice portal</div>
                        </div>
                    </div>
                    @else
                    <div class="empty-st" style="padding:20px;"><i class="fas fa-bell"></i><p>No new notifications</p></div>
                    @endif
                </div>
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="navy-box">
            <div style="font-size:12px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;margin-bottom:14px;display:flex;align-items:center;gap:8px;">
                <i class="fas fa-th-large"></i> Quick Actions
            </div>
            <div class="action-grid">
                <div class="action-card" @click="blotterModal=true">
                    <div class="action-ico"><i class="fas fa-book-open"></i></div>
                    <div class="action-name">Add Blotter</div>
                    <div class="action-sub">File new case entry</div>
                </div>
                <div class="action-card" @click="activeTab='mediation'">
                    <div class="action-ico"><i class="fas fa-file-signature"></i></div>
                    <div class="action-name">Settlements</div>
                    <div class="action-sub">Record amicable forms</div>
                </div>
                <div class="action-card" @click="summonModal=true">
                    <div class="action-ico"><i class="fas fa-envelope-open-text"></i></div>
                    <div class="action-name">Issue Summons</div>
                    <div class="action-sub">Generate official notices</div>
                </div>
            </div>
        </div>

        {{-- ══ BLOTTER TAB ══ --}}
        <div x-show="activeTab==='blotter'" x-transition>
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-title"><i class="fas fa-book"></i> Blotter Records</div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        <input type="text" x-model="searchQuery" placeholder="Search case, name..." style="padding:6px 10px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;">
                        <select x-model="filterMonth" style="padding:6px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;cursor:pointer;">
                            <option value="">All Months</option>
                            @for($m=1; $m<=12; $m++)
                                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                            @endfor
                        </select>
                        <select x-model="filterYear" style="padding:6px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;cursor:pointer;">
                            <option value="">All Years</option>
                            @php $startYear = date('Y') - 5; @endphp
                            @for($y=date('Y'); $y>=$startYear; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                        <span class="wcard-badge">{{ $totalJ }} Records</span>
                        <button @click="blotterModal=true" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Blotter Entry
                        </button>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="ptbl">
                        <thead><tr>
                            <th>Case No.</th><th>Complainant</th><th>Issue Type</th><th>Date Filed</th><th>Status</th><th style="text-align:right;">Actions</th>
                        </tr></thead>
                        <tbody>
                            @forelse($reports as $rep)
                            @php
                                $caseNo = 'JUS-'.$rep->created_at->format('Y').'-'.str_pad($rep->id,3,'0',STR_PAD_LEFT);
                                $stMap  = ['submitted'=>'spill-open','under_review'=>'spill-open','pending'=>'spill-pending','settled'=>'spill-closed','urgent'=>'spill-urgent'];
                                $stCls  = $stMap[$rep->status] ?? 'spill-pending';
                                $searchStr = strtolower($caseNo . ' ' . ($rep->complainant_name??'') . ' ' . $rep->issue_type . ' ' . $rep->status);
                                $m = $rep->created_at->format('m');
                                $y = $rep->created_at->format('Y');
                            @endphp
                            <tr x-show="('{{ addslashes($searchStr) }}'.includes(searchQuery.toLowerCase())) && (filterMonth === '' || filterMonth === '{{ $m }}') && (filterYear === '' || filterYear === '{{ $y }}')">
                                <td>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand);">#{{ $caseNo }}</div>
                                    <div style="font-size:9px;color:var(--light);font-weight:600;text-transform:uppercase;">Blotter</div>
                                </td>
                                <td>
                                    <div style="font-size:11px;font-weight:800;color:var(--text);">{{ $rep->complainant_name ?? '—' }}</div>
                                    <div style="font-size:9px;color:var(--muted);font-weight:600;">{{ $rep->contact ?? '' }}</div>
                                </td>
                                <td><span style="background:#eff6ff;color:var(--brand);font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;">{{ $rep->issue_type }}</span></td>
                                <td style="font-size:11px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $rep->created_at->format('M d, Y') }}</td>
                                <td><span class="spill {{ $stCls }}"><i class="fas fa-circle" style="font-size:5px;"></i> {{ ucfirst(str_replace('_',' ',$rep->status)) }}</span></td>
                                <td>
                                    <div class="acts">
                                        <button class="btn-icon" title="View Details"
                                                @click="openView({
                                                    case_no: '{{ $caseNo }}',
                                                    issue_type: '{{ addslashes($rep->issue_type) }}',
                                                    complainant: '{{ addslashes($rep->complainant_name ?? '') }}',
                                                    contact: '{{ addslashes($rep->contact ?? '') }}',
                                                    respondent: '{{ addslashes($rep->respondent_name ?? '') }}',
                                                    description: '{{ addslashes($rep->description ?? '') }}',
                                                    location: '{{ addslashes($rep->location ?? '') }}',
                                                    incident_date: '{{ $rep->incident_date ? \Carbon\Carbon::parse($rep->incident_date)->format('M d, Y') : 'N/A' }}',
                                                    status: '{{ $rep->status }}',
                                                    date_filed: '{{ $rep->created_at->format('M d, Y h:i A') }}'
                                                })">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form action="{{ url('/justice/blotter/'.$rep->id.'/status') }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                    style="font-size:9px;font-weight:700;border:1.5px solid var(--border);border-radius:7px;padding:5px 7px;background:#f8fafc;cursor:pointer;outline:none;font-family:inherit;color:var(--text);">
                                                <option value="submitted"    {{ $rep->status==='submitted'    ?'selected':'' }}>Open</option>
                                                <option value="under_review" {{ $rep->status==='under_review' ?'selected':'' }}>Under Review</option>
                                                <option value="pending"      {{ $rep->status==='pending'      ?'selected':'' }}>Pending</option>
                                                <option value="settled"      {{ $rep->status==='settled'      ?'selected':'' }}>Settled</option>
                                            </select>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6">
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

        {{-- ══ MEDIATION TAB ══ --}}
        <div x-show="activeTab==='mediation'" x-transition>
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-title"><i class="fas fa-balance-scale"></i> Mediation & Settlements</div>
                    <span class="wcard-badge">{{ $settledJ }} Settled</span>
                </div>
                <div class="empty-st">
                    <i class="fas fa-file-signature"></i>
                    <p>Settlement records will appear here.</p>
                    <p style="font-size:10px;color:var(--light);margin-top:4px;font-weight:600;">Settled blotter cases will be tracked here.</p>
                </div>
            </div>
        </div>

        {{-- ══ ISSUE REPORTS TAB (routed from residents/peace) ══ --}}
        <div x-show="activeTab==='requests'" x-transition>
            <div class="blue-section">
                <div class="blue-section-head">
                    <div class="blue-section-title"><i class="fas fa-inbox"></i> Issue Reports Routed to Justice</div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        <input type="text" x-model="searchQuery" placeholder="Search report..." style="padding:6px 10px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;">
                        <select x-model="filterMonth" style="padding:6px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;cursor:pointer;">
                            <option value="">All Months</option>
                            @for($m=1; $m<=12; $m++)
                                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                            @endfor
                        </select>
                        <select x-model="filterYear" style="padding:6px;font-size:10px;border-radius:7px;border:1.5px solid var(--border);outline:none;font-family:inherit;cursor:pointer;">
                            <option value="">All Years</option>
                            @php $startYear = date('Y') - 5; @endphp
                            @for($y=date('Y'); $y>=$startYear; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                        <span class="blue-section-badge">{{ $totalJ }} Reports</span>
                    </div>
                </div>
                @if($reports->count() > 0)
                <div style="overflow-x:auto;">
                    <table class="ptbl">
                        <thead><tr><th>Case No.</th><th>Type</th><th>Complainant</th><th>Date</th><th>Status</th><th style="text-align:right;">Action</th></tr></thead>
                        <tbody>
                            @foreach($reports as $rep)
                            @php 
                                $caseNo = 'JUS-'.$rep->created_at->format('Y').'-'.str_pad($rep->id,3,'0',STR_PAD_LEFT); 
                                $stCls = ['submitted'=>'spill-open','under_review'=>'spill-open','pending'=>'spill-pending','settled'=>'spill-closed'][$rep->status]??'spill-pending'; 
                                $searchStr = strtolower($caseNo . ' ' . ($rep->complainant_name??'') . ' ' . $rep->issue_type . ' ' . $rep->status);
                                $m = $rep->created_at->format('m');
                                $y = $rep->created_at->format('Y');
                            @endphp
                            <tr x-show="('{{ addslashes($searchStr) }}'.includes(searchQuery.toLowerCase())) && (filterMonth === '' || filterMonth === '{{ $m }}') && (filterYear === '' || filterYear === '{{ $y }}')">
                                <td style="font-size:11px;font-weight:900;color:var(--brand);">#{{ $caseNo }}</td>
                                <td><span style="background:#eff6ff;color:var(--brand);font-size:9px;font-weight:900;padding:3px 8px;border-radius:99px;">{{ $rep->issue_type }}</span></td>
                                <td style="font-size:11px;font-weight:700;">{{ $rep->complainant_name ?? '—' }}</td>
                                <td style="font-size:10px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $rep->created_at->format('M d, Y') }}</td>
                                <td><span class="spill {{ $stCls }}">{{ ucfirst(str_replace('_',' ',$rep->status)) }}</span></td>
                                <td style="text-align:right;">
                                    <button class="btn-icon" title="View"
                                            @click="openView({
                                                case_no: '{{ $caseNo }}',
                                                issue_type: '{{ addslashes($rep->issue_type) }}',
                                                complainant: '{{ addslashes($rep->complainant_name ?? '') }}',
                                                contact: '{{ addslashes($rep->contact ?? '') }}',
                                                respondent: '{{ addslashes($rep->respondent_name ?? '') }}',
                                                description: '{{ addslashes($rep->description ?? '') }}',
                                                location: '{{ addslashes($rep->location ?? '') }}',
                                                incident_date: '{{ $rep->incident_date ? \Carbon\Carbon::parse($rep->incident_date)->format('M d, Y') : 'N/A' }}',
                                                status: '{{ $rep->status }}',
                                                date_filed: '{{ $rep->created_at->format('M d, Y h:i A') }}'
                                            })">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-st"><i class="fas fa-inbox"></i><p>No requests received yet.</p></div>
                @endif
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
                    <form action="{{ route('justice.blotter.store') }}" method="POST">
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
                                <div class="fgrp"><label class="flbl">Contact Number <span class="req">*</span></label><input type="text" name="contact" class="finput" placeholder="09XXXXXXXXX" required></div>
                                <div class="fgrp"><label class="flbl">Age</label><input type="number" name="complainant_age" class="finput" placeholder="30" min="1"></div>
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
                                <div class="fgrp"><label class="flbl">Date of Incident <span class="req">*</span></label><input type="date" name="incident_date" class="finput" required></div>
                                <div class="fgrp"><label class="flbl">Location <span class="req">*</span></label><input type="text" name="incident_location" class="finput" placeholder="Purok, Street, Block..." required></div>
                                <div class="fgrp fspan2"><label class="flbl">Description / Narration <span class="req">*</span></label><textarea name="description" rows="4" class="finput" style="resize:vertical;" placeholder="Describe the incident clearly and completely..." required></textarea></div>
                            </div>
                        </div>
                        <input type="hidden" name="department" value="Justice">
                        <input type="hidden" name="status" value="submitted">
                        <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:9px;padding:9px 13px;margin-bottom:14px;font-size:10px;font-weight:700;color:var(--brand-dark);">
                            <i class="fas fa-info-circle" style="margin-right:4px;color:var(--brand);"></i>
                            Fields marked <span style="color:var(--danger);">*</span> are required. Entry will be saved to the official Barangay Blotter.
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
        <div x-show="summonModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="summonModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-envelope-open-text"></i></div>
                            <div>
                                <div>Issue Summons</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">KP Form No. 8 — Notice of Hearing</div>
                            </div>
                        </div>
                        <button @click="summonModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('justice.summons.issue') }}" method="POST">
                        @csrf
                        <div class="sblk" style="margin-bottom:14px;">
                            <div class="fgrp">
                                <label class="flbl">Select Active Case <span class="req">*</span></label>
                                <select name="issue_id" class="finput fselect" required>
                                    <option value="">— Select Case —</option>
                                    @foreach($reports->whereNotIn('status',['settled','resolved']) as $rep)
                                        @php $cno = 'JUS-'.$rep->created_at->format('Y').'-'.str_pad($rep->id,3,'0',STR_PAD_LEFT); @endphp
                                        <option value="{{ $rep->id }}">#{{ $cno }} : {{ $rep->complainant_name }} vs {{ $rep->respondent_name ?? 'N/A' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-calendar-alt" style="color:var(--brand);"></i> Mediation Schedule</div>
                            <div class="fgrid2">
                                <div class="fgrp"><label class="flbl">Date of Hearing <span class="req">*</span></label><input type="date" name="hearing_date" class="finput" required min="{{ date('Y-m-d') }}"></div>
                                <div class="fgrp"><label class="flbl">Time <span class="req">*</span></label><input type="time" name="time" class="finput" required></div>
                            </div>
                        </div>
                        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:9px;padding:9px 13px;margin-bottom:14px;font-size:10px;font-weight:700;color:#92400e;line-height:1.5;">
                            <i class="fas fa-exclamation-triangle" style="margin-right:4px;"></i>
                            Upon submission, an email will be sent to the complainant to notify them of this schedule. A "Print" window will actively open so you can print the Physical Summons Form for the respondent.
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="summonModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> Save & Generate Summons</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ VIEW RECORD MODAL ══ --}}
        <div x-show="viewModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="viewModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-eye"></i></div>
                            <div>
                                <div x-text="'Case #' + (activeRecord?.case_no ?? '')"></div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Blotter Record — Barangay San Miguel II</div>
                            </div>
                        </div>
                        <button @click="viewModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <template x-if="activeRecord">
                        <div>
                            <div style="margin-bottom:14px;">
                                <template x-if="activeRecord.status==='submitted'"><span class="spill spill-open"><i class="fas fa-circle" style="font-size:6px;"></i> Open</span></template>
                                <template x-if="activeRecord.status==='under_review'"><span class="spill spill-open"><i class="fas fa-circle" style="font-size:6px;"></i> Under Review</span></template>
                                <template x-if="activeRecord.status==='pending'"><span class="spill spill-pending"><i class="fas fa-circle" style="font-size:6px;"></i> Pending</span></template>
                                <template x-if="activeRecord.status==='settled'"><span class="spill spill-closed"><i class="fas fa-check-circle" style="font-size:8px;"></i> Settled</span></template>
                            </div>
                            <div class="vfield" style="background:#eff6ff;border-color:#bfdbfe;margin-bottom:14px;">
                                <div class="vfield-lbl">Case Type</div>
                                <div class="vfield-val" style="font-size:14px;font-weight:900;color:var(--brand);" x-text="activeRecord.issue_type"></div>
                            </div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px;">
                                <div class="vfield"><div class="vfield-lbl">Complainant</div><div class="vfield-val" x-text="activeRecord.complainant || 'N/A'"></div></div>
                                <div class="vfield"><div class="vfield-lbl">Contact</div><div class="vfield-val" x-text="activeRecord.contact || 'N/A'"></div></div>
                                <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Respondent</div><div class="vfield-val" x-text="activeRecord.respondent || 'N/A'"></div></div>
                                <div class="vfield"><div class="vfield-lbl">Date of Incident</div><div class="vfield-val" x-text="activeRecord.incident_date || 'N/A'"></div></div>
                                <div class="vfield"><div class="vfield-lbl">Location</div><div class="vfield-val" x-text="activeRecord.location || 'N/A'"></div></div>
                                <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Date Filed</div><div class="vfield-val" x-text="activeRecord.date_filed"></div></div>
                            </div>
                            <div class="vfield" style="margin-bottom:16px;">
                                <div class="vfield-lbl">Description / Narration</div>
                                <div class="vfield-val" style="font-size:12px;font-weight:600;line-height:1.6;" x-text="activeRecord.description || 'No description provided.'"></div>
                            </div>
                            <div style="display:flex;justify-content:flex-end;">
                                <button @click="viewModal=false" class="btn btn-ghost">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;background:var(--body-bg);border-top:1px solid var(--border);">
        © {{ date('Y') }} Barangay SM2 Management System. All rights reserved.
    </footer>

    @if(session('print_summon'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sd = @json(session('print_summon'));
        printSummonsForm(sd);
    });

    function printSummonsForm(data) {
        let win = window.open('', '_blank');
        win.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Summons - ${data.case_no}</title>
                <style>
                    body { font-family: 'Times New Roman', Times, serif; color: #000; margin: 0; padding: 0; line-height: 1.4; background: white; font-size:12pt; }
                    .page { max-width: 8.5in; margin: 0 auto; padding: 40px 60px; position:relative; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .header h3, .header h4 { margin: 0; padding: 0; font-weight: normal; font-size: 11pt; }
                    .header h2 { margin: 10px 0; font-size: 18pt; font-weight: bold; text-decoration: underline; text-transform:uppercase; letter-spacing: 2px;}
                    .form-no { position: absolute; top: 40px; left: 60px; font-size: 10pt; font-weight: bold; }
                    .brgy-logo { position: absolute; top: 30px; left: 50%; transform: translateX(-240px); width: 60px; }
                    .city-logo { position: absolute; top: 30px; right: 50%; transform: translateX(240px); width: 60px; }
                    
                    .case-info { display: flex; justify-content: space-between; margin-bottom: 20px; font-size:11pt; }
                    .case-info div { flex: 1; display:flex; gap: 10px; }
                    .case-line { border-bottom: 1px solid #000; flex: 1; text-align:center; display:inline-block; font-weight:bold; }
                    
                    .parties { display: flex; justify-content: space-between; margin-bottom: 30px; }
                    .party-box { width: 45%; }
                    .party-box p { margin: 2px 0; }
                    .party-name { font-weight: bold; font-size:12pt; border-bottom: 1px solid #000; padding-bottom: 2px; text-transform:uppercase; }
                    
                    .body-text { text-align: justify; text-indent: 40px; margin-bottom: 15px; font-size:12pt; line-height: 1.6; }
                    .fill { font-weight: bold; border-bottom: 1px solid #000; padding: 0 15px; display:inline-block; text-align:center; min-width: 100px; }
                    
                    .signatures { margin-top: 60px; display: flex; justify-content: flex-end; }
                    .sig-block { text-align: center; width: 250px; }
                    .sig-line { border-top: 1px solid #000; padding-top: 5px; font-weight: bold; text-transform: uppercase; }
                    
                    @media print {
                        @page { size: auto; margin: 0; }
                        body { -webkit-print-color-adjust: exact; padding: 0; margin: 0; }
                        .page { padding: 40px; margin: 0; box-shadow: none; width: 100%; }
                    }
                </style>
            </head>
            <body>
                <div class="page">
                    <div class="form-no">KP Form No. 8</div>
                    <div class="header">
                        <h4>Republic of the Philippines</h4>
                        <h4>Province of Cavite</h4>
                        <h4>City of Dasmariñas</h4>
                        <h4><strong>BARANGAY SAN MIGUEL II</strong></h4>
                        <h2>S U M M O N S</h2>
                    </div>

                    <div class="case-info">
                        <div><span>Barangay Case No:</span> <span class="case-line">${data.case_no}</span></div>
                        <div style="margin-left:20px;"><span>For:</span> <span class="case-line">${data.issue_type}</span></div>
                    </div>

                    <div class="parties">
                        <div class="party-box">
                            <div class="party-name">${data.complainant}</div>
                            <p style="text-align:center; font-size:10pt;">Complainant/s (Mga May-Sumbo)</p>
                        </div>
                        <div class="party-box" style="text-align:right;">
                            <p>— against —</p>
                        </div>
                    </div>
                    
                    <div class="parties" style="margin-top:-10px;">
                        <div class="party-box">
                            <div class="party-name">${data.respondent}</div>
                            <p style="text-align:center; font-size:10pt;">Respondent/s (Mga Ipinag-susumbong)</p>
                        </div>
                    </div>

                    <p style="font-weight:bold; margin-top:30px;">TO: <span class="fill" style="min-width:300px;">${data.respondent}</span></p>

                    <p class="body-text">
                        You are hereby summoned to appear before me, or the mediation panel that I will appoint 
                        (Lupong Tagapamayapa), on <span class="fill">${data.date}</span>, at exactly 
                        <span class="fill">${data.time}</span> to answer to the complaint filed against you.
                    </p>
                    
                    <p class="body-text">
                        Your attendance is highly prioritized to ensure that the issue can be discussed properly, fairly, and peacefully.
                    </p>

                    <p class="body-text">
                        Failure to appear shall mean a waiver of your right to defend yourself and answer the accusation. Furthermore, this may be considered a ground for filing a formal complaint in a higher court.
                    </p>

                    <p style="margin-top:30px;">Issued this <strong>${new Date().toLocaleDateString('en-US', {day:'numeric'})}</strong> 
                    day of <strong>${new Date().toLocaleDateString('en-US', {month:'long'})}</strong>, 
                    <strong>${new Date().getFullYear()}</strong>.</p>

                    <div class="signatures">
                        <div class="sig-block">
                            <div class="sig-line">Punong Barangay / Lupon Chairman</div>
                        </div>
                    </div>
                </div>
                <script>
                    window.onload = function() {
                        setTimeout(() => window.print(), 800);
                    };
                <\/script>
            </body>
            </html>
        `);
        win.document.close();
    }
    </script>
    @endif

</x-app-layout>
