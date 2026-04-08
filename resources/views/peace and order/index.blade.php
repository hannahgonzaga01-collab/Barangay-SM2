<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap');
:root{
    --brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;
    --body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;
    --success:#059669;--warn:#d97706;--danger:#dc2626;
    --card-shadow:0 4px 24px rgba(4,25,45,0.10),0 1.5px 6px rgba(0,0,0,0.05);
    --btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);
    --accent:#0ea5e9;
}
*{box-sizing:border-box;margin:0;padding:0;}
html,body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--body-bg);color:var(--text);}
[x-cloak]{display:none!important;}

.portal-wrap{max-width:1200px;margin:0 auto;padding:24px 18px 60px;}

.hero{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);border-radius:16px;padding:28px 28px 24px;margin-bottom:22px;position:relative;overflow:hidden;box-shadow:var(--card-shadow);}
.hero-bg-ico{position:absolute;right:-20px;bottom:-20px;font-size:160px;color:rgba(255,255,255,.05);line-height:1;pointer-events:none;}
.hero-tag{font-size:9px;font-weight:900;background:rgba(14,165,233,.25);color:#7dd3fc;padding:4px 12px;border-radius:99px;text-transform:uppercase;letter-spacing:.08em;display:inline-block;margin-bottom:12px;border:1px solid rgba(14,165,233,.3);}
.hero-title{font-size:22px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.2;margin-bottom:8px;}
.hero-desc{font-size:12px;color:rgba(255,255,255,.6);font-weight:600;max-width:520px;line-height:1.6;}
.hero-stats{display:flex;gap:14px;margin-top:20px;flex-wrap:wrap;}
.hstat{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:11px;padding:12px 16px;text-align:center;min-width:72px;}
.hstat-n{font-size:22px;font-weight:900;color:#fff;line-height:1;}
.hstat-l{font-size:8px;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.07em;margin-top:3px;}

.action-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;margin-bottom:22px;}
.action-card{background:#fff;border:2px solid var(--border);border-radius:14px;padding:20px 14px 18px;text-align:center;cursor:pointer;transition:all .2s;}
.action-card:hover{border-color:var(--brand);transform:translateY(-3px);box-shadow:0 8px 24px rgba(14,83,147,.15);}
.action-card.active{border-color:var(--brand);background:#eff6ff;}
.ac-ico{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 13px;transition:all .2s;}
.ac-ico i{font-size:20px;}
.action-card:hover .ac-ico{transform:scale(1.1);}
.ac-name{font-size:10px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.04em;line-height:1.3;}
.ac-sub{font-size:9px;color:var(--muted);font-weight:600;margin-top:4px;}

.card{background:#fff;border-radius:14px;box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.05);overflow:hidden;margin-bottom:18px;}
.card-head{padding:14px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;}
.card-title{font-size:10px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.09em;display:flex;align-items:center;gap:7px;}
.card-title i{color:var(--brand);}
.cbadge{font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;}
.cbadge-blue{background:#eff6ff;color:var(--brand);}
.cbadge-red{background:#fee2e2;color:#dc2626;}
.cbadge-green{background:#dcfce7;color:#15803d;}

/* FILTER BAR — navy gradient consistent theme */
.filter-bar{background:linear-gradient(100deg,#000052 0%,#04192D 60%,#0E5393 100%);border-radius:11px;padding:10px 14px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin:0 18px 14px;}
.filter-search{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);border-radius:8px;padding:6px 10px;flex:1;min-width:150px;}
.filter-search input{background:transparent;border:none;color:#fff;font-family:inherit;font-size:10px;font-weight:700;outline:none;width:100%;}
.filter-search input::placeholder{color:rgba(255,255,255,.5);}
.filter-bar select{background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);color:#fff;border-radius:8px;padding:7px 10px;font-family:inherit;font-size:10px;font-weight:700;outline:none;}
.filter-bar select option{background:#04192D;color:#fff;}

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
.spill-pending{background:#fef3c7;color:#a16207;}
.spill-warn{background:#fef3c7;color:#a16207;}

.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;font-family:inherit;font-size:10px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:9px;cursor:pointer;transition:all .18s;white-space:nowrap;}
.btn-primary{background:var(--btn-grad);color:#fff;box-shadow:0 2px 8px rgba(0,0,82,.25);}
.btn-primary:hover{transform:translateY(-1px);}
.btn-success{background:linear-gradient(135deg,#059669,#047857);color:#fff;}
.btn-warn{background:linear-gradient(135deg,#d97706,#b45309);color:#fff;}
.btn-ghost{background:#f1f5f9;color:#475569;}
.btn-ghost:hover{background:#e2e8f0;}
.btn-sm{padding:5px 10px;font-size:9px;}
.btn-icon{width:30px;height:30px;border-radius:7px;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11px;transition:all .15s;background:#f1f5f9;color:var(--muted);}
.btn-icon:hover{background:var(--btn-grad);color:#fff;}

.alert-banner{background:linear-gradient(135deg,#0c1445 0%,#1e3a8a 100%);border-radius:13px;padding:16px 20px;display:flex;align-items:center;gap:14px;margin-bottom:18px;border:1px solid rgba(59,130,246,.2);}
.alert-ico{width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.alert-ico i{color:#7dd3fc;font-size:16px;}
.alert-text{font-size:11px;color:rgba(255,255,255,.75);font-weight:600;line-height:1.5;}
.alert-text strong{color:#fff;}

.modal-ov{position:fixed;inset:0;z-index:999;display:flex;align-items:center;justify-content:center;padding:12px;background:rgba(0,0,18,.68);backdrop-filter:blur(5px);}
.modal-box{background:#fff;width:100%;max-width:580px;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,52,.35);border-bottom:5px solid var(--brand);max-height:94vh;overflow-y:auto;}
.modal-in{padding:22px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:13px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:13px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:9px;}
.modal-ico{width:32px;height:32px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.modal-ico i{color:var(--brand);font-size:13px;}
.modal-close{background:none;border:none;color:var(--light);font-size:20px;cursor:pointer;line-height:1;}
.modal-close:hover{color:var(--danger);}

.flbl{font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:4px;}
.finput{width:100%;padding:9px 12px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s;}
.finput:focus{border-color:var(--brand);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fgrid2{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.fgrp{margin-bottom:12px;}
.fspan2{grid-column:span 2;}
.fselect{appearance:none;cursor:pointer;}
.sblk{background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:12px;border:1px solid var(--border);}
.sblk-ttl{font-size:9px;font-weight:900;text-transform:uppercase;color:var(--muted);margin-bottom:8px;display:flex;align-items:center;gap:5px;}
.vfield{background:#f8fafc;border:1.5px solid var(--border);border-radius:9px;padding:10px 13px;margin-bottom:8px;}
.vfield-lbl{font-size:8px;font-weight:900;color:var(--brand);text-transform:uppercase;letter-spacing:.07em;margin-bottom:3px;}
.vfield-val{font-size:12px;font-weight:700;color:var(--text);}

@media(max-width:768px){
    .action-grid{grid-template-columns:repeat(2,1fr);}
    .hero-stats{gap:8px;}
    .hero{padding:18px 14px 16px;}
    .hero-title{font-size:16px;}
    .portal-wrap{padding:14px 10px 40px;}
    .tbl th,.tbl td{padding:8px 10px;}
    .filter-bar{margin:0 12px 12px;}
    .fgrid2{grid-template-columns:1fr;}
    .fspan2{grid-column:span 1;}
    .card-head{gap:6px;}
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
                <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white shadow-sm" style="background:linear-gradient(135deg,#0ea5e9 0%,#0369a1 100%);">
                    <i class="fas fa-shield-alt text-lg"></i>
                </div>
                <div>
                    <h2 class="font-black text-xl text-gray-800 leading-tight uppercase tracking-tight">Peace & Order Portal</h2>
                    <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Barangay Security & Safety — San Miguel II</p>
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

    @if($errors->any())
    <div style="position:fixed;top:16px;right:16px;z-index:9999;background:#dc2626;color:#fff;padding:11px 18px;border-radius:11px;box-shadow:var(--card-shadow);font-weight:800;font-size:12px;">
        <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
    </div>
    @endif

    <div class="portal-wrap" x-data="{
        activeTab: 'cases',
        viewModal: false,
        addBlotterModal: false,
        addPatrolModal: false,
        activeIssue: null,
        searchQuery: '',
        filterStatus: '',
        openView(issue) { this.activeIssue = issue; this.viewModal = true; }
    }">

        {{-- HERO --}}
        <div class="hero">
            <i class="fas fa-shield-alt hero-bg-ico"></i>
            <div class="hero-tag"><i class="fas fa-shield-alt" style="margin-right:5px;"></i> Peace & Order Portal</div>
            <div class="hero-title">Barangay Security & Safety</div>
            <div class="hero-desc">Ensuring a peaceful and orderly community for all residents of Barangay San Miguel II.</div>
            <div class="hero-stats">
                @php
                    $totalPeace   = \App\Models\IssueReport::where('department','Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->count();
                    $newPeace     = \App\Models\IssueReport::where('department','Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->where('status','submitted')->count();
                    $activePeace  = \App\Models\IssueReport::where('department','Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->whereIn('status',['submitted','under_review'])->count();
                    $settledPeace = \App\Models\IssueReport::where('department','Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->where('status','settled')->count();
                @endphp
                <div class="hstat"><div class="hstat-n">{{ $totalPeace }}</div><div class="hstat-l">Total</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#fca5a5;">{{ $newPeace }}</div><div class="hstat-l">New</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#7dd3fc;">{{ $activePeace }}</div><div class="hstat-l">Active</div></div>
                <div class="hstat"><div class="hstat-n" style="color:#86efac;">{{ $settledPeace }}</div><div class="hstat-l">Settled</div></div>
            </div>
        </div>

        {{-- ACTION CARDS --}}
        <div class="action-grid">
            <div class="action-card" @click="activeTab='cases'" :class="activeTab==='cases'?'active':''">
                <div class="ac-ico" style="background:#fee2e2;"><i class="fas fa-flag" style="color:#dc2626;"></i></div>
                <div class="ac-name">Blotter Reports</div>
                <div class="ac-sub">Review new cases</div>
            </div>
            <div class="action-card" @click="activeTab='patrol'" :class="activeTab==='patrol'?'active':''">
                <div class="ac-ico" style="background:#dcfce7;"><i class="fas fa-route" style="color:#15803d;"></i></div>
                <div class="ac-name">Patrol Schedule</div>
                <div class="ac-sub">Duty roster</div>
            </div>
        </div>

        {{-- ══ BLOTTER REPORTS TAB ══ --}}
        <div x-show="activeTab==='cases'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-flag"></i> Blotter Reports — Peace & Order</div>
                    <div style="display:flex;gap:7px;align-items:center;flex-wrap:wrap;">
                        <span class="cbadge cbadge-red">{{ $newPeace }} New</span>
                        <span class="cbadge cbadge-blue">{{ $totalPeace }} Total</span>
                    </div>
                </div>
                {{-- FILTER BAR navy theme --}}
                <div class="filter-bar">
                    <i class="fas fa-filter" style="color:rgba(255,255,255,.6);font-size:11px;flex-shrink:0;"></i>
                    <div class="filter-search">
                        <i class="fas fa-search" style="color:rgba(255,255,255,.5);font-size:10px;flex-shrink:0;"></i>
                        <input type="text" x-model="searchQuery" placeholder="Search complainant or case ID...">
                    </div>
                    <select x-model="filterStatus">
                        <option value="">All Statuses</option>
                        <option value="submitted">New / Submitted</option>
                        <option value="under_review">Under Review</option>
                        <option value="pending">Pending</option>
                        <option value="settled">Settled</option>
                    </select>
                    <button @click="addBlotterModal=true" style="background:#fff;color:var(--brand-darker);border:none;padding:7px 14px;border-radius:8px;font-size:10px;font-weight:900;display:flex;align-items:center;gap:6px;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,.15);margin-left:auto;">
                        <i class="fas fa-plus"></i> Add Entry
                    </button>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Complainant</th>
                            <th>Type</th>
                            <th>Incident Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr></thead>
                        <tbody>
                            @forelse(\App\Models\IssueReport::where('department','Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->latest()->get() as $issue)
                            @php $caseCode = 'PO-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT); @endphp
                            <tr x-show="
                                (searchQuery === '' || '{{ strtolower($issue->complainant_name) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($caseCode) }}'.includes(searchQuery.toLowerCase())) &&
                                (filterStatus === '' || '{{ $issue->status }}' === filterStatus)">
                                <td>
                                    <div style="font-size:12px;font-weight:800;color:var(--text);">{{ $issue->complainant_name }}</div>
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $issue->contact }}</div>
                                </td>
                                <td><div style="font-size:11px;font-weight:700;">{{ $issue->issue_type }}</div></td>
                                <td><div style="font-size:11px;color:var(--muted);">{{ $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('M d, Y') : $issue->created_at->format('M d, Y') }}</div></td>
                                <td><div style="font-size:11px;color:var(--muted);">{{ $issue->location ?? '—' }}</div></td>
                                <td>
                                    @php $sc=['submitted'=>'spill-new','under_review'=>'spill-active','settled'=>'spill-settled','pending'=>'spill-pending'][$issue->status]??'spill-pending'; @endphp
                                    <span class="spill {{ $sc }}"><i class="fas fa-circle" style="font-size:6px;"></i> {{ ucfirst(str_replace('_',' ',$issue->status)) }}</span>
                                </td>
                                <td style="text-align:right;">
                                    <div style="display:flex;gap:5px;justify-content:flex-end;align-items:center;flex-wrap:wrap;">
                                        {{-- VIEW BUTTON --}}
                                        <button @click="openView({{ json_encode([
                                            'id'               => $issue->id,
                                            'case_code'        => $caseCode,
                                            'issue_type'       => $issue->issue_type,
                                            'status'           => $issue->status,
                                            'complainant_name' => $issue->complainant_name,
                                            'complainant_age'  => $issue->complainant_age ?? 'N/A',
                                            'complainant_gender'=> $issue->complainant_gender ?? 'N/A',
                                            'contact'          => $issue->contact,
                                            'complainant_address'=> $issue->complainant_address ?? 'N/A',
                                            'respondent_name'  => $issue->respondent_name ?? 'N/A',
                                            'respondent_address'=> $issue->respondent_address ?? 'N/A',
                                            'description'      => $issue->description,
                                            'incident_date'    => $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('M d, Y h:i A') : 'N/A',
                                            'location'         => $issue->location ?? 'N/A',
                                            'created_at'       => $issue->created_at->format('M d, Y'),
                                        ]) }})"
                                        class="btn-icon" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        {{-- ESCALATE TO JUSTICE --}}
                                        <form action="{{ url('/peace/issues/'.$issue->id.'/escalate') }}" method="POST" style="display:inline;" onsubmit="return confirm('Escalate this case to the Justice portal?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn-icon" title="Escalate to Justice" style="background:#fef3c7;color:#a16207;">
                                                <i class="fas fa-gavel"></i>
                                            </button>
                                        </form>
                                        {{-- STATUS UPDATE --}}
                                        <form action="{{ url('/peace/issues/'.$issue->id.'/status') }}" method="POST" style="display:inline;">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                    style="font-size:9px;font-weight:800;border:1.5px solid var(--border);border-radius:7px;padding:5px 8px;background:#f8fafc;cursor:pointer;outline:none;font-family:inherit;">
                                                <option value="submitted"    {{ $issue->status==='submitted'    ? 'selected' : '' }}>Submitted</option>
                                                <option value="under_review" {{ $issue->status==='under_review' ? 'selected' : '' }}>Under Review</option>
                                                <option value="pending"      {{ $issue->status==='pending'      ? 'selected' : '' }}>Pending</option>
                                                <option value="settled"      {{ $issue->status==='settled'      ? 'selected' : '' }}>Settled</option>
                                            </select>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6"><div class="tbl-empty"><i class="fas fa-flag"></i><p style="font-size:11px;font-weight:700;">No blotter reports yet.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ PATROL TAB ══ --}}
        <div x-show="activeTab==='patrol'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-route"></i> Patrol Schedule / Duty Roster</div>
                    <button @click="addPatrolModal=true" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Schedule</button>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Personnel</th>
                            <th>Area / Sector</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                        </tr></thead>
                        <tbody>
                            @forelse(\App\Models\IssueReport::where('issue_type', 'Patrol Schedule')->latest()->get() as $patrol)
                            <tr>
                                <td style="font-size:12px;font-weight:800;">{{ $patrol->complainant_name }}</td>
                                <td style="font-size:11px;color:var(--muted);">{{ $patrol->location }}</td>
                                <td style="font-size:11px;color:var(--muted);">{{ $patrol->incident_date ? \Carbon\Carbon::parse($patrol->incident_date)->format('M d, Y') : 'N/A' }}</td>
                                <td><span class="spill spill-active"><i class="fas fa-circle" style="font-size:6px;"></i> Scheduled</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="4"><div class="tbl-empty"><i class="fas fa-route"></i><p style="font-size:11px;font-weight:700;">No patrol schedules yet.</p><p style="font-size:10px;color:var(--light);margin-top:4px;font-weight:600;">Click "Add Schedule" to set a patrol duty.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ VIEW INCIDENT MODAL ══ --}}
        <div x-show="viewModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="viewModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-eye"></i></div>
                            <div>
                                <div>Incident Details</div>
                                <div style="font-size:9px;font-weight:700;color:var(--muted);text-transform:none;" x-text="activeIssue ? '#'+activeIssue.case_code : ''"></div>
                            </div>
                        </div>
                        <button @click="viewModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <template x-if="activeIssue">
                        <div>
                            <div style="margin-bottom:14px;">
                                <template x-if="activeIssue.status==='submitted'"><span class="spill spill-new" style="font-size:11px;padding:5px 14px;"><i class="fas fa-clock"></i> New Submission</span></template>
                                <template x-if="activeIssue.status==='under_review'"><span class="spill spill-active" style="font-size:11px;padding:5px 14px;"><i class="fas fa-search"></i> Under Review</span></template>
                                <template x-if="activeIssue.status==='settled'"><span class="spill spill-settled" style="font-size:11px;padding:5px 14px;"><i class="fas fa-check-circle"></i> Settled</span></template>
                                <template x-if="activeIssue.status==='pending'"><span class="spill spill-pending" style="font-size:11px;padding:5px 14px;"><i class="fas fa-pause-circle"></i> Pending</span></template>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-tag"></i> Case Information</div>
                                <div class="fgrid2" style="gap:8px;">
                                    <div class="vfield"><div class="vfield-lbl">Case Code</div><div class="vfield-val" x-text="'#'+activeIssue.case_code"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Category</div><div class="vfield-val" x-text="activeIssue.issue_type"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Date Filed</div><div class="vfield-val" x-text="activeIssue.created_at"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Incident Date</div><div class="vfield-val" x-text="activeIssue.incident_date"></div></div>
                                    <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Location</div><div class="vfield-val" x-text="activeIssue.location"></div></div>
                                </div>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant</div>
                                <div class="fgrid2" style="gap:8px;">
                                    <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Full Name</div><div class="vfield-val" x-text="activeIssue.complainant_name"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Age / Gender</div><div class="vfield-val" x-text="activeIssue.complainant_age + ' / ' + activeIssue.complainant_gender"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Contact</div><div class="vfield-val" x-text="activeIssue.contact"></div></div>
                                    <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Address</div><div class="vfield-val" x-text="activeIssue.complainant_address"></div></div>
                                </div>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-user-slash"></i> Respondent</div>
                                <div class="fgrid2" style="gap:8px;">
                                    <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Full Name</div><div class="vfield-val" x-text="activeIssue.respondent_name"></div></div>
                                    <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Address</div><div class="vfield-val" x-text="activeIssue.respondent_address"></div></div>
                                </div>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-file-alt"></i> Description</div>
                                <div style="background:#fff;border:1px solid var(--border);border-radius:8px;padding:12px;font-size:12px;font-weight:600;color:var(--text);line-height:1.7;white-space:pre-wrap;" x-text="activeIssue.description || 'No description provided.'"></div>
                            </div>
                            <div style="display:flex;justify-content:space-between;gap:8px;flex-wrap:wrap;">
                                <form :action="'/peace/issues/'+activeIssue.id+'/escalate'" method="POST" @submit.prevent="if(confirm('Escalate to Justice portal?')) $el.submit()">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-warn btn-sm"><i class="fas fa-gavel"></i> Escalate to Justice</button>
                                </form>
                                <button @click="viewModal=false" class="btn btn-ghost btn-sm">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- ══ ADD BLOTTER MODAL ══ --}}
        <div x-show="addBlotterModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="addBlotterModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#dbeafe;"><i class="fas fa-book" style="color:#1d4ed8;"></i></div>
                            <div>
                                <div>Add Blotter Entry</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Peace & Order — Barangay SM2</div>
                            </div>
                        </div>
                        <button @click="addBlotterModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('peace.blotter.store') }}" method="POST">
                        @csrf
                        <div class="fgrp">
                            <label class="flbl">Type of Case *</label>
                            <select name="issue_type" required class="finput fselect">
                                <option value="">— Select —</option>
                                <option>Noise Disturbance</option>
                                <option>Theft / Robbery</option>
                                <option>Physical Altercation</option>
                                <option>Verbal Altercation</option>
                                <option>Vandalism</option>
                                <option>Trespassing</option>
                                <option>Illegal Gambling</option>
                                <option>Public Disturbance</option>
                                <option>Illegal Parking / Road Blockage</option>
                                <option>Drug-Related Incident</option>
                                <option>Threat / Intimidation</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant</div>
                            <div class="fgrid2">
                                <div class="fgrp"><label class="flbl">Full Name *</label><input type="text" name="complainant_name" required class="finput" placeholder="Juan Dela Cruz"></div>
                                <div class="fgrp"><label class="flbl">Contact *</label><input type="text" name="contact" required class="finput" placeholder="09XXXXXXXXX"></div>
                                <div class="fgrp"><label class="flbl">Age</label><input type="number" name="complainant_age" min="1" class="finput"></div>
                                <div class="fgrp"><label class="flbl">Gender</label><select name="complainant_gender" class="finput fselect"><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select></div>
                                <div class="fgrp fspan2"><label class="flbl">Address</label><input type="text" name="complainant_address" class="finput" placeholder="Blk/Lot, Street..."></div>
                            </div>
                        </div>
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user-slash"></i> Respondent</div>
                            <div class="fgrid2">
                                <div class="fgrp fspan2"><label class="flbl">Full Name *</label><input type="text" name="respondent_name" required class="finput" placeholder="Name of respondent"></div>
                                <div class="fgrp fspan2"><label class="flbl">Address</label><input type="text" name="respondent_address" class="finput" placeholder="Respondent address"></div>
                            </div>
                        </div>
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-map-marker-alt"></i> Incident Details</div>
                            <div class="fgrid2">
                                <div class="fgrp"><label class="flbl">Date & Time *</label><input type="datetime-local" name="incident_date" required class="finput"></div>
                                <div class="fgrp"><label class="flbl">Location *</label><input type="text" name="incident_location" required class="finput" placeholder="Purok, Street..."></div>
                                <div class="fgrp fspan2"><label class="flbl">Description *</label><textarea name="description" required rows="3" class="finput" style="resize:vertical;" placeholder="Describe the incident..."></textarea></div>
                            </div>
                        </div>
                        <input type="hidden" name="department" value="Peace & Order">
                        <input type="hidden" name="status" value="submitted">
                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="addBlotterModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Entry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ ADD PATROL MODAL ══ --}}
        <div x-show="addPatrolModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:460px;" @click.away="addPatrolModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#dcfce7;"><i class="fas fa-route" style="color:#15803d;"></i></div>
                            <div>
                                <div>Add Patrol Schedule</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Assign Duty Roster</div>
                            </div>
                        </div>
                        <button @click="addPatrolModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('peace.patrol.store') }}" method="POST">
                        @csrf
                        <div class="fgrp"><label class="flbl">Assigned Personnel *</label><input type="text" name="personnel" required class="finput" placeholder="e.g. Tanod Juan dela Cruz"></div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Patrol Date *</label><input type="date" name="patrol_date" required class="finput"></div>
                            <div><label class="flbl">Time</label><input type="time" name="patrol_time" class="finput"></div>
                        </div>
                        <div class="fgrp"><label class="flbl">Area / Sector *</label><input type="text" name="area" required class="finput" placeholder="e.g. Purok 1, Phase 2..."></div>
                        <div class="fgrp"><label class="flbl">Notes</label><textarea name="notes" rows="2" class="finput" style="resize:vertical;" placeholder="Optional instructions..."></textarea></div>
                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="addPatrolModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-calendar-check"></i> Add Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;">
        © {{ date('Y') }} Barangay SM2 Management System — Peace & Order Portal
    </footer>

</x-app-layout>
