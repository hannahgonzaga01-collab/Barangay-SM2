<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap');
:root {
    --grad-start:#0E5393;--grad-mid:#04192D;--grad-end:#000052;
    --brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;
    --white:#ffffff;--body-bg:#f1f5f9;--card-bg:#ffffff;
    --border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;
    --danger:#dc2626;--warn:#d97706;--success:#059669;
    --r-card:16px;--r-btn:8px;
    --card-shadow:6px 5px 5px 2px rgba(4,25,45,0.18),5px 4px 4px 0 rgba(0,0,0,0.10);
    --btn-grad:linear-gradient(135deg,var(--brand) 0%,var(--grad-mid) 100%);
    --btn-grad-hover:linear-gradient(135deg,#0a3f72 0%,#020f1c 100%);
}
*{box-sizing:border-box;margin:0;padding:0;}
html,body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--body-bg);color:var(--text);}
[x-cloak]{display:none!important;}
.btn-grad{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;background:var(--btn-grad);color:#fff;font-family:inherit;font-size:10px;font-weight:800;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:var(--r-btn);cursor:pointer;transition:all .18s;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,82,.30);text-decoration:none;}
.btn-grad:hover{background:var(--btn-grad-hover);box-shadow:0 4px 14px rgba(0,0,82,.40);transform:translateY(-1px);}
.btn-grad-sm{padding:6px 11px;font-size:9px;}
.search-area{background:linear-gradient(100deg,var(--grad-start) 0%,var(--grad-mid) 60%,var(--grad-end) 100%);padding:16px 20px 14px;margin-bottom:20px;border-radius:var(--r-card);box-shadow:var(--card-shadow);}
.search-row{display:flex;align-items:center;gap:10px;margin-bottom:12px;}
.search-field{flex:1;position:relative;}
.search-field input{width:100%;padding:10px 36px 10px 38px;background:#fff;border:1.5px solid rgba(255,255,255,.4);border-radius:var(--r-btn);font-family:inherit;font-size:13px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s,box-shadow .15s;}
.search-field input::placeholder{color:#94a3b8;}
.search-field input:focus{border-color:rgba(255,255,255,.9);box-shadow:0 0 0 3px rgba(255,255,255,.2);}
.search-icon-left{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:12px;pointer-events:none;}
.search-clear-btn{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:#94a3b8;cursor:pointer;font-size:11px;padding:3px;border-radius:50%;transition:color .12s;}
.search-clear-btn:hover{color:var(--danger);}
.suggestions-box{position:absolute;z-index:50;width:100%;top:calc(100% + 4px);background:#fff;border-radius:12px;box-shadow:var(--card-shadow);border:1px solid var(--border);overflow:hidden;max-height:260px;overflow-y:auto;}
.sugg-hd{padding:7px 13px;background:#f8fafc;border-bottom:1px solid var(--border);font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;}
.sugg-item{display:flex;align-items:center;gap:10px;padding:9px 13px;cursor:pointer;transition:background .1s;border-bottom:1px solid #f8fafc;}
.sugg-item:last-child{border-bottom:none;}
.sugg-item:hover{background:#eff6ff;}
.sugg-avatar{width:34px;height:34px;border-radius:8px;object-fit:cover;flex-shrink:0;}
.sugg-name{font-size:12px;font-weight:800;color:var(--text);}
.sugg-meta{font-size:9px;font-weight:600;color:var(--muted);text-transform:uppercase;}
.filter-pill{display:inline-flex;align-items:center;gap:5px;padding:5px 12px;border-radius:99px;font-size:9px;font-weight:800;text-transform:uppercase;letter-spacing:.04em;border:1.5px solid rgba(255,255,255,.25);background:rgba(255,255,255,.10);color:rgba(255,255,255,.85);cursor:pointer;transition:all .15s;white-space:nowrap;}
.filter-pill:hover{background:rgba(255,255,255,.22);border-color:rgba(255,255,255,.5);color:#fff;}
.filter-pill-active{background:#fff!important;color:var(--brand-dark)!important;border-color:#fff!important;font-weight:900;}
.filter-pill .pill-cnt{font-size:8px;background:rgba(255,255,255,.2);padding:1px 5px;border-radius:99px;}
.filter-pill-active .pill-cnt{background:rgba(4,25,45,.12);}
.filter-row{display:flex;align-items:center;gap:7px;flex-wrap:wrap;}
.tab-row{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-top:12px;padding-top:12px;border-top:1px solid rgba(255,255,255,.12);flex-wrap:wrap;}
.tab-pill{display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:99px;font-size:9px;font-weight:800;text-transform:uppercase;letter-spacing:.04em;border:1.5px solid rgba(255,255,255,.25);background:rgba(255,255,255,.10);color:rgba(255,255,255,.85);cursor:pointer;transition:all .15s;}
.tab-pill:hover{background:rgba(255,255,255,.22);}
.tab-pill-active{background:#fff!important;color:var(--brand-dark)!important;border-color:#fff!important;font-weight:900;}
.tab-pill .pill-cnt{font-size:8px;background:rgba(255,255,255,.2);padding:1px 5px;border-radius:99px;}
.tab-pill-active .pill-cnt{background:rgba(4,25,45,.12);}
.page-wrap{max-width:1280px;margin:0 auto;padding:20px 18px;}
.main-grid{display:grid;grid-template-columns:1fr 300px;gap:18px;align-items:start;}
.left-col{display:flex;flex-direction:column;gap:18px;}
.right-col{display:flex;flex-direction:column;gap:18px;}
.card{background:var(--card-bg);border-radius:var(--r-card);box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.06);overflow:hidden;}
.card-head{padding:14px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;}
.card-title{font-size:10px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.09em;display:flex;align-items:center;gap:7px;}
.card-title i{color:var(--brand);}
.card-badge{font-size:9px;background:#eff6ff;color:var(--brand);font-weight:900;padding:3px 9px;border-radius:99px;text-transform:uppercase;letter-spacing:.03em;}
.doc-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:9px;padding:16px;}
.doc-btn{background:#f8fafc;border:1px solid var(--border);border-radius:11px;padding:13px 7px 11px;display:flex;flex-direction:column;align-items:center;gap:6px;cursor:pointer;transition:all .2s;text-align:center;}
.doc-btn:hover{background:var(--btn-grad);border-color:var(--brand);transform:translateY(-2px);box-shadow:0 6px 16px rgba(0,0,82,.22);}
.doc-ico{width:36px;height:36px;background:#eff6ff;border-radius:9px;display:flex;align-items:center;justify-content:center;transition:background .2s;}
.doc-ico i{color:var(--brand);font-size:13px;transition:color .2s;}
.doc-lbl{font-size:8px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.04em;line-height:1.3;transition:color .2s;}
.doc-btn:hover .doc-ico{background:rgba(255,255,255,.2);}
.doc-btn:hover .doc-ico i{color:#fff;}
.doc-btn:hover .doc-lbl{color:#fff;}
.res-row{display:flex;align-items:center;gap:11px;padding:11px 18px;cursor:pointer;transition:background .12s;border-bottom:1px solid #f8fafc;}
.res-row:last-child{border-bottom:none;}
.res-row:hover{background:#eff6ff;}
.res-avatar{width:38px;height:38px;border-radius:9px;object-fit:cover;flex-shrink:0;border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.1);}
.res-name{font-size:13px;font-weight:800;color:var(--text);}
.res-code{font-size:9px;font-weight:600;color:var(--muted);text-transform:uppercase;}
.res-chev{color:var(--border);font-size:10px;flex-shrink:0;margin-left:auto;transition:color .12s;}
.res-row:hover .res-chev{color:var(--brand);}
.pill{font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 6px;border-radius:99px;letter-spacing:.03em;}
.pill-voter{background:#dbeafe;color:#1d4ed8;}
.pill-senior{background:#ffedd5;color:#ea580c;}
.pill-pwd{background:#ede9fe;color:#7c3aed;}
.pill-solo{background:#fce7f3;color:#be185d;}
.pill-student{background:#cffafe;color:#0e7490;}
.pet-inner{background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%);border:1px solid #bfdbfe;border-radius:12px;padding:18px;margin:16px;}
.pet-count{font-size:40px;font-weight:900;color:var(--brand-dark);line-height:1;}
.pet-lbl{font-size:9px;font-weight:800;color:var(--brand);text-transform:uppercase;letter-spacing:.07em;margin-bottom:14px;}
.demo-card{background:linear-gradient(135deg,var(--brand-darker) 0%,var(--brand) 100%);border-radius:var(--r-card);padding:18px;box-shadow:var(--card-shadow);color:#fff;}
.demo-title{font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,.5);margin-bottom:14px;}
.demo-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:9px;}
.demo-row:last-child{margin-bottom:0;}
.demo-lbl{font-size:11px;font-weight:600;color:rgba(255,255,255,.85);}
.demo-val{font-size:10px;font-weight:900;padding:2px 9px;border-radius:99px;}
.dv-def{background:rgba(255,255,255,.12);color:#fff;}
.dv-pink{background:rgba(236,72,153,.3);color:#fce7f3;}
.dv-org{background:rgba(249,115,22,.3);color:#ffedd5;}
.dv-purp{background:rgba(139,92,246,.3);color:#ede9fe;}
.dv-rose{background:rgba(244,63,94,.3);color:#ffe4e6;}
.dv-amb{background:rgba(245,158,11,.3);color:#fef3c7;}
.res-table{width:100%;border-collapse:collapse;}
.res-table thead tr{background:#f8fafc;}
.res-table th{padding:12px 15px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;}
.res-table th:first-child{text-align:center;width:58px;}
.res-table th:last-child{text-align:right;}
.res-table tbody tr{border-bottom:1px solid var(--border);transition:background .1s;}
.res-table tbody tr:last-child{border-bottom:none;}
.res-table tbody tr:hover{background:#f8fafc;}
.res-table td{padding:11px 15px;vertical-align:middle;}
.tbl-acts{display:flex;align-items:center;justify-content:flex-end;gap:5px;}
.tbl-btn{width:30px;height:30px;border-radius:7px;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11px;transition:all .15s;}
.tbl-view{background:#eff6ff;color:var(--brand);}
.tbl-view:hover{background:var(--btn-grad);color:#fff;}
.tbl-pet{background:#fef3c7;color:#d97706;}
.tbl-pet:hover{background:#f59e0b;color:#fff;}
.tbl-edit{background:#f1f5f9;color:#475569;}
.tbl-edit:hover{background:#475569;color:#fff;}
.tbl-del{background:#fee2e2;color:var(--danger);}
.tbl-del:hover{background:var(--danger);color:#fff;}
.view-all-btn{display:flex;align-items:center;justify-content:center;gap:5px;width:calc(100% - 36px);padding:10px;background:#eff6ff;color:var(--brand);font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.05em;border:none;border-radius:9px;cursor:pointer;transition:background .15s;margin:4px 18px 16px;}
.view-all-btn:hover{background:#dbeafe;}
.modal-ov{position:fixed;inset:0;z-index:100;display:flex;align-items:center;justify-content:center;padding:14px;background:rgba(0,0,18,.6);backdrop-filter:blur(4px);}
.modal-box{background:#fff;width:100%;max-width:700px;border-radius:20px;box-shadow:var(--card-shadow);border-bottom:5px solid var(--brand);max-height:94vh;overflow-y:auto;}
.modal-in{padding:22px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;padding-bottom:14px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:14px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:9px;}
.modal-ttl-ico{width:34px;height:34px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;}
.modal-ttl-ico i{color:var(--brand);font-size:13px;}
.modal-close{background:none;border:none;color:var(--light);font-size:20px;cursor:pointer;transition:color .12s;line-height:1;}
.modal-close:hover{color:var(--danger);}
.flbl{font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:4px;}
.finput{width:100%;padding:9px 13px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s,background .15s;}
.finput:focus{border-color:var(--brand);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fgrid2{display:grid;grid-template-columns:repeat(2,1fr);gap:11px;}
.fgrid3{display:grid;grid-template-columns:repeat(3,1fr);gap:11px;}
.fgrp{margin-bottom:12px;}
.fspan2{grid-column:span 2;}
.fspan3{grid-column:span 3;}
.fselect{appearance:none;cursor:pointer;}
.section-blk{background:#f8fafc;border-radius:11px;padding:13px;margin-bottom:12px;border:1px solid var(--border);}
.section-blk-ttl{font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:9px;display:flex;align-items:center;gap:5px;}
.classif-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:7px;}
.classif-lbl{display:flex;align-items:center;gap:7px;padding:9px 11px;background:#f8fafc;border:1.5px solid var(--border);border-radius:9px;cursor:pointer;transition:all .12s;}
.classif-lbl:hover{border-color:var(--brand);background:#eff6ff;}
.classif-lbl input[type=checkbox]{accent-color:var(--brand);width:13px;height:13px;}
.classif-txt{font-size:10px;font-weight:800;color:var(--text);}
.photo-up{width:120px;height:120px;max-width:100%;aspect-ratio:1/1;border-radius:13px;background:#f1f5f9;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;flex-direction:column;overflow:hidden;cursor:pointer;transition:border-color .15s;position:relative;}
.photo-up:hover{border-color:var(--brand);}
.btn-plain{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;font-family:inherit;font-size:10px;font-weight:800;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:8px;cursor:pointer;transition:all .15s;}
.btn-edit{background:#f1f5f9;color:#475569;}
.btn-edit:hover{background:#475569;color:#fff;}
.btn-amber{background:linear-gradient(135deg,#f59e0b 0%,#d97706 100%);color:#fff;box-shadow:0 2px 8px rgba(217,119,6,.3);}
.btn-amber:hover{filter:brightness(.93);}
.btn-green{background:linear-gradient(135deg,var(--success) 0%,#047857 100%);color:#fff;box-shadow:0 2px 8px rgba(5,150,105,.25);}
.doc-preview{border:2px solid var(--border);border-radius:12px;padding:28px;background:#fff;font-family:'Times New Roman',serif;font-size:11px;min-height:420px;margin-bottom:14px;}
.pet-table{width:100%;border-collapse:collapse;}
.pet-table th{padding:11px 13px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;text-align:left;background:#f8fafc;}
.pet-table td{padding:9px 13px;font-size:11px;border-bottom:1px solid #f1f5f9;vertical-align:middle;}
.pet-table tr:last-child td{border-bottom:none;}
.toast{position:fixed;top:18px;right:18px;z-index:999;background:var(--success);color:#fff;padding:11px 18px;border-radius:11px;box-shadow:var(--card-shadow);font-weight:800;font-size:12px;display:flex;align-items:center;gap:7px;}
.empty-st{padding:36px;text-align:center;color:var(--light);}
.empty-st i{font-size:28px;display:block;margin-bottom:6px;opacity:.25;}
.empty-st p{font-size:11px;font-weight:700;}
.header-btn-grad{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);color:#fff;font-family:inherit;font-size:12px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:10px;cursor:pointer;transition:all .18s;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,82,.35);text-decoration:none;}
.header-btn-grad:hover{background:linear-gradient(135deg,#0a3f72 0%,#020f1c 100%);box-shadow:0 4px 16px rgba(0,0,82,.45);transform:translateY(-1px);}
.header-notif-btn{width:40px;height:40px;background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);border:none;border-radius:10px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,82,.35);transition:all .15s;flex-shrink:0;position:relative;}
.header-notif-btn:hover{background:linear-gradient(135deg,#0a3f72 0%,#020f1c 100%);box-shadow:0 4px 16px rgba(0,0,82,.45);transform:translateY(-1px);}
.header-notif-btn i{color:#fff;font-size:15px;}
.duty-day-lbl{font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;width:80px;flex-shrink:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
@media(min-width:480px){.duty-day-lbl{width:95px;}}
@media(max-width:1024px){.main-grid{grid-template-columns:1fr;}.right-col{display:grid;grid-template-columns:1fr 1fr;gap:18px;}}
@media(max-width:768px){
    .doc-grid{grid-template-columns:repeat(4,1fr);gap:7px;}
    .fgrid2,.fgrid3{grid-template-columns:1fr 1fr;}
    .fspan3{grid-column:span 2;}
    .right-col{grid-template-columns:1fr;}
    .duty-widget-row{flex-direction:column;align-items:flex-start;}
    .duty-view-btn{width:100%;justify-content:center;margin-top:8px;}
}
@media(max-width:540px){
    .page-wrap{padding:14px 11px;}
    .header-btn-grad span{display:none;}
    .header-btn-grad i{margin:0;}
}
</style>

    <x-slot name="header"></x-slot>

    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="toast">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @php
        $allResidents = $users->map(function($u) {
            return [
                'id'               => $u->id,
                'first_name'       => $u->first_name,
                'last_name'        => $u->last_name,
                'name'             => $u->first_name . ' ' . $u->last_name,
                'code'             => $u->resident_code ?? 'NO-CODE',
                'address'          => $u->address ?? '',
                'birthday'         => $u->birthday ?? '',
                'gender'           => $u->gender ?? '',
                'civil_status'     => $u->civil_status ?? '',
                'spouse_name'      => $u->spouse_name ?? '',
                'contact'          => $u->contact_number ?? '',
                'birthplace'       => $u->birthplace ?? '',
                'occupation'       => $u->occupation ?? '',
                'is_voter'         => $u->is_voter ? true : false,
                'is_senior'        => $u->is_senior ? true : false,
                'is_pwd'           => $u->is_pwd ? true : false,
                'is_single_parent' => $u->is_single_parent ? true : false,
                'is_student'       => $u->is_student ? true : false,
                'memberships'      => is_array($u->memberships) ? $u->memberships : (is_string($u->memberships) ? json_decode($u->memberships, true) : []),
                'email'            => $u->user ? $u->user->email : '',
                'photo'            => $u->photo ? asset('storage/' . $u->photo) : null,
                'digital_id_generated' => ($u->user && $u->user->digitalId && $u->user->digitalId->status === 'generated') ? true : false,
                'digital_id_number' => ($u->user && $u->user->digitalId && $u->user->digitalId->status === 'generated') ? $u->user->digitalId->id_number : null,
            ];
        });
    @endphp

    <div x-data="{
        activeTab: 'dashboard',
        activeFilter: '',
        searchQuery: '',
        searchOpen: false,
        showProfile: false,
        openAddModal: false,
        openEditModal: false,
        openAddPetModal: false,
        openPetTracker: false,
        petTypeSelection: '',
        photoPreview: null,
        editPhotoPreview: null,
        occupationStatus: 'unemployed',
        editUser: {},
        selectedUser: {},
        openDigitalId: false,
        digitalIdSearch: '',
        digitalIdResident: null,
        digitalIdOpen: false,
        digitalIdCardView: 'front',
        ecName: '',
        ecNum: '',

        init() {
            document.addEventListener('open-digital-id', () => {
                this.openDigitalId = true;
                this.digitalIdSearch = '';
                this.digitalIdResident = null;
                this.ecName = '';
                this.ecNum = '';
            });
            document.addEventListener('open-add-modal', () => {
                this.openAddModal = true;
            });
        },
        get digitalIdSuggestions() {
            if (this.digitalIdSearch.length < 1) return [];
            const q = this.digitalIdSearch.toLowerCase();
            return this.allResidents.filter(r => {
                const n = (r.first_name+' '+r.last_name).toLowerCase();
                return n.includes(q) || r.code.toLowerCase().includes(q);
            }).slice(0,8);
        },
        selectDigitalIdResident(r) {
            this.digitalIdResident = r;
            this.digitalIdSearch = r.name + ' — ' + r.code;
            this.digitalIdOpen = false;
            this.digitalIdCardView = 'front';
        },
        get digitalIdValidUntil() {
            const d = new Date(); d.setFullYear(d.getFullYear()+1);
            return (d.getMonth()+1).toString().padStart(2,'0')+'/'+d.getDate().toString().padStart(2,'0')+'/'+d.getFullYear();
        },
        get digitalIdIssueDate() {
            const d = new Date();
            return (d.getMonth()+1).toString().padStart(2,'0')+'/'+d.getDate().toString().padStart(2,'0')+'/'+d.getFullYear();
        },
        openDoc:'',
        docOwnerSearch:'', docOwnerSelectedId:null, docOwnerOpen:false,
        docOwnerName:'', docOwnerBday:'', docOwnerAge:'', docOwnerAddress:'',
        docOwnerGender:'', docOwnerIsVoter:false, docOwnerBirthplace:'', docOwnerBdayRaw:'',
        docIssuedBy:'', docPosition:'', docClearancePhoto:null, docPurpose:'',
        docBlk:'', docLot:'', docResidenceSince:'', docLandlordName:'',
        docRentalAddress:'', docRentalDate:'', docMoveDate:'', docFamilyMembers:'',
        docClaimantName:'', docClaimantRelation:'', docSpouseName:'',
        docBirthMonth:'', docBirthYear:'', docCompanyName:'', docTradeName:'',
        docOwnerBusiness:'', docNonOpSince:'', docChildName:'', docFatherName:'',
        docMotherName:'', docBirthAttendant:'', docBornFrom:'', docWardName:'',
        docWardRelation:'', docWardAge:'', docPartnerName:'', docLivingSince:'',
        docDate: new Date().toISOString().split('T')[0],
        get docDateFormatted() { return this.formatDocDate(this.docDate); },
        get docDayOrdinal()    { return new Date(this.docDate).getDate(); },
        get docMonth()         { return new Date(this.docDate).toLocaleDateString('en-PH',{month:'long'}); },
        get docYear()          { return new Date(this.docDate).getFullYear(); },

        allResidents: {{ $allResidents->toJson() }},

        get docResidentSuggestions() {
            if (this.docOwnerSearch.length < 1) return [];
            const q = this.docOwnerSearch.toLowerCase();
            return this.allResidents.filter(r => {
                const n = (r.first_name+' '+r.last_name).toLowerCase();
                return n.includes(q) || r.code.toLowerCase().includes(q);
            }).slice(0,8);
        },
        selectDocResident(r) {
            this.docOwnerSearch = r.name+' — '+r.code;
            this.docOwnerSelectedId = r.id;
            this.docOwnerName = r.name;
            this.docOwnerAddress = r.address;
            this.docOwnerGender = r.gender;
            this.docOwnerIsVoter = r.is_voter;
            this.docOwnerBirthplace = r.birthplace||'';
            this.docOwnerBdayRaw = r.birthday||'';
            this.docOwnerOpen = false;
            if(r.birthday){
                const bd=new Date(r.birthday), today=new Date();
                let age=today.getFullYear()-bd.getFullYear();
                const m=today.getMonth()-bd.getMonth();
                if(m<0||(m===0&&today.getDate()<bd.getDate())) age--;
                this.docOwnerAge=age;
                this.docOwnerBday=bd.toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'});
            }
        },
        clearDocOwner() {
            this.docOwnerSearch=''; this.docOwnerSelectedId=null; this.docOwnerName='';
            this.docOwnerBday=''; this.docOwnerAge=''; this.docOwnerAddress='';
            this.docOwnerGender=''; this.docOwnerIsVoter=false; this.docOwnerBirthplace='';
            this.docOwnerBdayRaw=''; this.docIssuedBy=''; this.docPosition='';
            this.docClearancePhoto=null; this.docPurpose=''; this.docBlk=''; this.docLot='';
            this.docResidenceSince=''; this.docLandlordName=''; this.docRentalAddress='';
            this.docRentalDate=''; this.docMoveDate=''; this.docFamilyMembers='';
            this.docClaimantName=''; this.docClaimantRelation=''; this.docSpouseName='';
            this.docBirthMonth=''; this.docBirthYear=''; this.docCompanyName='';
            this.docTradeName=''; this.docOwnerBusiness=''; this.docNonOpSince='';
            this.docChildName=''; this.docFatherName=''; this.docMotherName='';
            this.docBirthAttendant=''; this.docBornFrom=''; this.docWardName='';
            this.docWardRelation=''; this.docWardAge=''; this.docPartnerName='';
            this.docLivingSince=''; this.docOwnerOpen=false;
        },
        get suggestions() {
            if (this.searchQuery.length < 1) return [];
            const q = this.searchQuery.toLowerCase();
            return this.allResidents.filter(r => {
                const n=(r.first_name+' '+r.last_name).toLowerCase();
                return n.includes(q)||r.code.toLowerCase().includes(q);
            }).slice(0,8);
        },
        get filteredResidents() {
            let list = this.allResidents;
            if (this.searchQuery.length > 0) {
                const q = this.searchQuery.toLowerCase();
                list = list.filter(r => {
                    const n=(r.first_name+' '+r.last_name).toLowerCase();
                    return n.includes(q)||r.code.toLowerCase().includes(q);
                });
            }
            if      (this.activeFilter==='birthday') { const m=new Date().getMonth()+1; list=list.filter(r=>r.birthday&&new Date(r.birthday).getMonth()+1===m); }
            else if (this.activeFilter==='senior')   list=list.filter(r=>r.is_senior);
            else if (this.activeFilter==='pwd')      list=list.filter(r=>r.is_pwd);
            else if (this.activeFilter==='solo')     list=list.filter(r=>r.is_single_parent);
            else if (this.activeFilter==='4ps')      list=list.filter(r=>r.memberships && r.memberships.includes('4Ps'));
            else if (this.activeFilter==='kdbm')     list=list.filter(r=>r.memberships && r.memberships.includes('KDBM'));
            else if (this.activeFilter==='any_membership') list=list.filter(r=>r.memberships && r.memberships.length > 0);
            return list;
        },
        selectSuggestion(r) { this.searchQuery=r.name; this.searchOpen=false; this.selectedUser=r; this.showProfile=true; },
        openProfile(r)      { this.selectedUser=r; this.showProfile=true; },
        openEdit(id) {
            fetch('/office/'+id+'/edit').then(r=>r.json()).then(data=>{
                this.editUser=data;
                this.editPhotoPreview=data.photo||null;
                this.openEditModal=true;
            });
        },
        formatDate(d)    { if(!d) return 'N/A'; return new Date(d).toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'}); },
        getAge(d)        { if(!d) return ''; const t=new Date(),b=new Date(d); let a=t.getFullYear()-b.getFullYear(); const m=t.getMonth()-b.getMonth(); if(m<0||(m===0&&t.getDate()<b.getDate())) a--; return a+' yrs old'; },
        formatDocDate(d) { if(!d) return new Date().toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'}); return new Date(d).toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'}); }
    }">

        {{-- ══ HEADER ══ --}}
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white shadow-sm" style="background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);">
                        <i class="fas fa-users-cog text-lg"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-xl text-gray-800 leading-tight uppercase tracking-tight">{{ __('Office Administration Portal') }}</h2>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Barangay San Miguel II • Dasmariñas, Cavite</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">

                    <button onclick="document.dispatchEvent(new CustomEvent('open-add-modal'))" class="header-btn-grad">
                        <i class="fas fa-user-plus"></i><span>Add Resident</span>
                    </button>
                    <button onclick="document.dispatchEvent(new CustomEvent('open-digital-id'))" class="header-btn-grad">
                        <i class="fas fa-id-card"></i><span>Digital ID</span>
                    </button>
                </div>
            </div>
        </x-slot>

        <div class="page-wrap">

            {{-- SEARCH AREA --}}
            <div class="search-area">
                <div class="search-row" @click.away="searchOpen = false">
                    <div class="search-field" style="position:relative;">
                        <i class="fas fa-search search-icon-left"></i>
                        <input type="text" x-model="searchQuery"
                               @focus="searchOpen = true" @input="searchOpen = true"
                               @keydown.escape="searchOpen = false; searchQuery = ''"
                               placeholder="Search residents by name or resident code..."
                               autocomplete="off">
                        <button x-show="searchQuery" @click="searchQuery=''; searchOpen=false" class="search-clear-btn">
                            <i class="fas fa-times"></i>
                        </button>
                        <div x-show="searchOpen && suggestions.length > 0" x-transition class="suggestions-box">
                            <div class="sugg-hd">Suggestions</div>
                            <template x-for="r in suggestions" :key="r.id">
                                <div @click="selectSuggestion(r)" class="sugg-item">
                                    <img :src="r.photo || 'https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'" 
                                         x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                         class="sugg-avatar">
                                    <div style="flex:1;min-width:0;">
                                        <div class="sugg-name" x-text="r.name"></div>
                                        <div class="sugg-meta" x-text="r.code+' • '+(r.address||'No address')"></div>
                                    </div>
                                    <div style="display:flex;gap:3px;flex-wrap:wrap;">
                                        <span x-show="r.is_senior" class="pill pill-senior">Sr</span>
                                        <span x-show="r.is_pwd" class="pill pill-pwd">PWD</span>
                                        <span x-show="r.is_single_parent" class="pill pill-solo">Solo</span>
                                    </div>
                                    <i class="fas fa-chevron-right" style="color:#ccc;font-size:9px;margin-left:6px;"></i>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="filter-row">
                    <button @click="activeFilter = activeFilter==='birthday' ? '' : 'birthday'; if(activeFilter) activeTab='masterlist'"
                            :class="activeFilter==='birthday' ? 'filter-pill filter-pill-active' : 'filter-pill'" class="filter-pill">
                        <i class="fas fa-birthday-cake"></i> Bday This Month <span class="pill-cnt">{{ $birthdayThisMonth->count() }}</span>
                    </button>
                    <button @click="activeFilter = activeFilter==='senior' ? '' : 'senior'; if(activeFilter) activeTab='masterlist'"
                            :class="activeFilter==='senior' ? 'filter-pill filter-pill-active' : 'filter-pill'" class="filter-pill">
                        <i class="fas fa-user-clock"></i> Seniors <span class="pill-cnt">{{ $seniors->count() }}</span>
                    </button>
                    <button @click="activeFilter = activeFilter==='pwd' ? '' : 'pwd'; if(activeFilter) activeTab='masterlist'"
                            :class="activeFilter==='pwd' ? 'filter-pill filter-pill-active' : 'filter-pill'" class="filter-pill">
                        <i class="fas fa-wheelchair"></i> PWD <span class="pill-cnt">{{ $pwds->count() }}</span>
                    </button>
                    <button @click="activeFilter = activeFilter==='solo' ? '' : 'solo'; if(activeFilter) activeTab='masterlist'"
                            :class="activeFilter==='solo' ? 'filter-pill filter-pill-active' : 'filter-pill'" class="filter-pill">
                        <i class="fas fa-heart"></i> Solo Parent <span class="pill-cnt">{{ $soloParents->count() }}</span>
                    </button>
                    <select x-model="activeFilter" @change="if(activeFilter) activeTab='masterlist'"
                            style="appearance:none; padding-right:24px; background-image:url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat:no-repeat; background-position:right .7em top 50%; background-size:.65em auto; outline:none; cursor:pointer;"
                            :class="['any_membership', '4ps', 'kdbm'].includes(activeFilter) ? 'filter-pill filter-pill-active' : 'filter-pill'">
                        <option value="" style="color:#333;">Select Membership...</option>
                        <option value="any_membership" style="color:#333;">All Memberships ({{ $anyMembershipCount ?? 0 }})</option>
                        <option value="4ps" style="color:#333;">4Ps ({{ $fourPsCount ?? 0 }})</option>
                        <option value="kdbm" style="color:#333;">KDBM ({{ $kdbmCount ?? 0 }})</option>
                    </select>
                </div>
                <div class="tab-row">
                    <div style="display:flex;gap:7px;flex-wrap:wrap;">
                        <button @click="activeTab='dashboard'" :class="activeTab==='dashboard' ? 'tab-pill tab-pill-active' : 'tab-pill'" class="tab-pill">
                            <i class="fas fa-th-large"></i> Dashboard
                        </button>
                        <button @click="activeTab='masterlist'" :class="activeTab==='masterlist' ? 'tab-pill tab-pill-active' : 'tab-pill'" class="tab-pill">
                            <i class="fas fa-list"></i> Masterlist <span class="pill-cnt" x-text="filteredResidents.length"></span>
                        </button>
                        <button @click="activeTab='requests'" :class="activeTab==='requests' ? 'tab-pill tab-pill-active' : 'tab-pill'" class="tab-pill">
                            <i class="fas fa-file-alt"></i> Document Requests
                            <span class="pill-cnt">{{ ($pendingDocCount ?? 0) + (isset($digitalIdRequests) ? $digitalIdRequests->count() : 0) }}</span>
                        </button>
                        <button @click="activeTab='non-residents'" :class="activeTab==='non-residents' ? 'tab-pill tab-pill-active' : 'tab-pill'" class="tab-pill">
                            <i class="fas fa-user-times"></i> Non-Residents <span class="pill-cnt">{{ ($nonResidents ?? collect())->count() }}</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- ══ DASHBOARD TAB ══ --}}
            <div x-show="activeTab === 'dashboard'" x-transition>
                <div class="main-grid">
                    <div class="left-col">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-title"><i class="fas fa-file-invoice"></i> Document Issuance</div>
                            </div>
                            @php
                            $docs = [
                                ['key'=>'indigency',    'name'=>'Indigency',    'icon'=>'fa-file-signature'],
                                ['key'=>'clearance',    'name'=>'Clearance',    'icon'=>'fa-shield-alt'],
                                ['key'=>'jobseeker',    'name'=>'Job Seeker',   'icon'=>'fa-user-tie'],
                                ['key'=>'business',     'name'=>'Business',     'icon'=>'fa-store'],
                                ['key'=>'residency',    'name'=>'Residency',    'icon'=>'fa-house-user'],
                                ['key'=>'endorsement',  'name'=>'Endorsement',  'icon'=>'fa-file-export'],
                                ['key'=>'moveout',      'name'=>'Move-Out',     'icon'=>'fa-truck-moving'],
                                ['key'=>'movein',       'name'=>'Move-In',      'icon'=>'fa-sign-in-alt'],
                                ['key'=>'closure',      'name'=>'Closure',      'icon'=>'fa-store-slash'],
                                ['key'=>'latereg',      'name'=>'Late Reg',     'icon'=>'fa-clock'],
                                ['key'=>'guardianship', 'name'=>'Guardianship', 'icon'=>'fa-user-shield'],
                                ['key'=>'cohabitation', 'name'=>'Cohabitation', 'icon'=>'fa-user-friends'],
                                ['key'=>'katibayan',    'name'=>'Katibayan',    'icon'=>'fa-stamp'],
                                ['key'=>'cashgift',     'name'=>'Cash Gift',    'icon'=>'fa-gift'],
                                ['key'=>'yumao',        'name'=>'Yumao',        'icon'=>'fa-ribbon'],
                                ['key'=>'oath',         'name'=>'Oath',         'icon'=>'fa-hand-holding-heart'],
                            ];
                            @endphp
                            <div class="doc-grid">
                                @foreach($docs as $doc)
                                <div class="doc-btn" @click="openDoc='{{ $doc['key'] }}'; clearDocOwner()">
                                    <div class="doc-ico"><i class="fas {{ $doc['icon'] }}"></i></div>
                                    <div class="doc-lbl">{{ $doc['name'] }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">
                                <div class="card-title">
                                    <i class="fas fa-star" style="color:#f59e0b;"></i>
                                    <span x-text="activeFilter==='birthday'?'Birthday This Month':activeFilter==='senior'?'Senior Citizens':activeFilter==='pwd'?'PWD Residents':activeFilter==='solo'?'Solo Parents':'Recent Residents'"></span>
                                </div>
                                <div class="card-badge" x-text="filteredResidents.slice(0,5).length+' shown'"></div>
                            </div>
                            <div>
                                <template x-if="filteredResidents.length === 0">
                                    <div class="empty-st"><i class="fas fa-users"></i><p>Nothing found</p></div>
                                </template>
                                <template x-for="r in filteredResidents.slice(0,5)" :key="r.id">
                                    <div @click="openProfile(r)" class="res-row">
                                        <img :src="r.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'" 
                                             x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                             class="res-avatar">
                                        <div style="flex:1;min-width:0;">
                                            <div class="res-name" x-text="r.name"></div>
                                            <div class="res-code" x-text="r.code"></div>
                                        </div>
                                        <div style="display:flex;gap:4px;flex-wrap:wrap;">
                                            <span x-show="r.is_senior" class="pill pill-senior">Senior</span>
                                            <span x-show="r.is_pwd" class="pill pill-pwd">PWD</span>
                                            <span x-show="r.is_single_parent" class="pill pill-solo">Solo</span>
                                        </div>
                                        <i class="fas fa-chevron-right res-chev"></i>
                                    </div>
                                </template>
                            </div>
                            <div x-show="filteredResidents.length > 5">
                                <button @click="activeTab='masterlist'" class="view-all-btn">
                                    <i class="fas fa-arrow-right"></i> View All <span x-text="filteredResidents.length"></span> in Masterlist
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="right-col">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-title"><i class="fas fa-paw" style="color:var(--brand);"></i> Pet Registry</div>
                            </div>
                            <div class="pet-inner">
                                <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:4px;">
                                    <div>
                                        <div class="pet-lbl">Total Registered</div>
                                        <div class="pet-count">{{ ($pets ?? collect())->count() }}</div>
                                    </div>
                                    <i class="fas fa-paw" style="font-size:34px;color:rgba(14,83,147,.12);"></i>
                                </div>
                                <div style="display:flex;flex-direction:column;gap:7px;margin-top:14px;">
                                    <button @click="openPetTracker = true" class="btn-grad btn-grad-sm" style="width:100%;justify-content:center;">
                                        <i class="fas fa-list"></i> View Pet Tracker
                                    </button>
                                    <button @click="openAddPetModal=true; petTypeSelection=''; selectedUser={}" class="btn-grad btn-grad-sm" style="width:100%;justify-content:center;">
                                        <i class="fas fa-plus"></i> Add Pet
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="demo-card">
                            <div class="demo-title">Demographics</div>
                            <div class="demo-row"><span class="demo-lbl">Total Residents</span><span class="demo-val dv-def">{{ $users->count() }}</span></div>
                            <div class="demo-row"><span class="demo-lbl">Birthday This Month</span><span class="demo-val dv-pink">{{ $birthdayThisMonth->count() }}</span></div>
                            <div class="demo-row"><span class="demo-lbl">Seniors</span><span class="demo-val dv-org">{{ $seniors->count() }}</span></div>
                            <div class="demo-row"><span class="demo-lbl">PWD</span><span class="demo-val dv-purp">{{ $pwds->count() }}</span></div>
                            <div class="demo-row"><span class="demo-lbl">Solo Parents</span><span class="demo-val dv-rose">{{ $soloParents->count() }}</span></div>
                            <div class="demo-row"><span class="demo-lbl">Pets</span><span class="demo-val dv-amb">{{ ($pets ?? collect())->count() }}</span></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══ MASTERLIST TAB ══ --}}
            <div x-show="activeTab === 'masterlist'" x-transition>
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-users"></i> Resident Masterlist</div>
                        <div class="card-badge" x-text="filteredResidents.length+' Residents'"></div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="res-table">
                            <thead><tr>
                                <th>Photo</th><th>Resident Details</th><th>Classification</th><th>Digital ID</th><th style="text-align:right;">Actions</th>
                            </tr></thead>
                            <tbody>
                                <template x-if="filteredResidents.length === 0">
                                    <tr><td colspan="5"><div class="empty-st"><i class="fas fa-users"></i><p>Walang nahanap</p></div></td></tr>
                                </template>
                                <template x-for="r in filteredResidents" :key="r.id">
                                    <tr>
                                        <td style="text-align:center;">
                                             <img :src="r.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                                 x-on:error="$el.src='https://ui-avatars.com/api/?name='+encodeURIComponent(r.name)+'&background=0E5393&color=fff&bold=true&rounded=true'"
                                                 style="width:36px;height:36px;border-radius:9px;object-fit:cover;border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.1);display:block;margin:0 auto;">
                                        </td>
                                        <td>
                                            <div class="res-name" x-text="r.name"></div>
                                            <div class="res-code" x-text="r.code+' • '+(r.contact||'No contact')"></div>
                                            <div class="res-code" style="text-transform:lowercase;font-weight:700;color:var(--brand);margin-top:2px;" x-show="r.email"><i class="fas fa-envelope"></i> <span x-text="r.email"></span></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:4px;flex-wrap:wrap;">
                                                <span x-show="r.is_voter" class="pill pill-voter">Voter</span>
                                                <span x-show="r.is_pwd" class="pill pill-pwd">PWD</span>
                                                <span x-show="r.is_senior" class="pill pill-senior">Senior</span>
                                                <span x-show="r.is_single_parent" class="pill pill-solo">Solo</span>
                                            </div>
                                        </td>
                                        <td style="text-align:center;">
                                            <template x-if="r.digital_id_generated">
                                                <button @click="document.dispatchEvent(new CustomEvent('open-digital-id')); setTimeout(function(){selectDigitalIdResident(r)}, 50)"
                                                        class="btn-outline" style="font-size:9px;padding:3px 8px;border-radius:99px;border:1.5px solid var(--brand);color:var(--brand);background:#fff;display:inline-flex;align-items:center;gap:4px;cursor:pointer;">
                                                    <i class="fas fa-id-card"></i> View ID
                                                </button>
                                            </template>
                                        </td>
                                        <td>
                                            <div class="tbl-acts">
                                                <button @click="openProfile(r)" class="tbl-btn tbl-view" title="View"><i class="fas fa-eye"></i></button>
                                                <button @click="openAddPetModal=true;petTypeSelection='';selectedUser=r" class="tbl-btn tbl-pet" title="Pet"><i class="fas fa-paw"></i></button>
                                                <button @click="openEdit(r.id)" class="tbl-btn tbl-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                                <form :action="'/office/'+r.id+'/archive'" method="POST" class="inline"
                                                      @submit.prevent="if(confirm('Archive '+r.name+'?')) $el.submit()">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="tbl-btn" title="Archive"
                                                            style="width:30px;height:30px;border-radius:7px;background:#fef3c7;color:#d97706;border:none;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11px;">
                                                        <i class="fas fa-archive"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══ DOCUMENT REQUESTS TAB ══ --}}
            <div x-show="activeTab === 'requests'" x-transition>
                @if(isset($digitalIdRequests) && $digitalIdRequests->count() > 0)
                <div class="card" style="margin-bottom:16px;">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-id-card" style="color:var(--brand);"></i> Digital ID Requests</div>
                        <span class="card-badge" style="background:#fef3c7;color:#a16207;">{{ $digitalIdRequests->count() }} Pending</span>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="res-table">
                            <thead><tr>
                                <th style="text-align:left;width:220px;">Resident</th>
                                <th>Date Requested</th>
                                <th>Emergency Contact</th>
                                <th style="text-align:right;">Action</th>
                            </tr></thead>
                            <tbody>
                                @foreach($digitalIdRequests as $idReq)
                                @php
                                    $idUser = $idReq->user;
                                    $idName = $idUser
                                        ? trim(($idUser->first_name ?? '') . ' ' . ($idUser->last_name ?? '')) ?: ($idUser->name ?? $idUser->email ?? 'Unknown')
                                        : 'Unknown Resident';
                                    $idCode = $idUser?->resident_code ?? '—';
                                @endphp
                                <tr>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:10px;">
                                            <img src="{{ $idUser?->photo ? asset('storage/'.$idUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode($idName).'&background=0E5393&color=fff&size=64&bold=true' }}"
                                                 style="width:36px;height:36px;border-radius:9px;object-fit:cover;flex-shrink:0;">
                                            <div>
                                                <div style="font-size:12px;font-weight:800;color:#0f172a;">{{ $idName }}</div>
                                                <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $idCode }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $idReq->created_at->format('M d, Y') }}</div>
                                        <div style="font-size:9px;color:var(--light);">{{ $idReq->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        <div style="font-size:11px;font-weight:700;color:var(--text);">{{ $idReq->contact_person ?? '—' }}</div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $idReq->contact_person_number ?? '' }}</div>
                                    </td>
                                    <td style="text-align:right;">
                                        <form action="{{ route('office.digital.id.generate', $idReq->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-grad btn-grad-sm">
                                                <i class="fas fa-id-card"></i> Generate ID
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-file-alt"></i> Document Requests</div>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <span class="card-badge" style="background:#fee2e2;color:#dc2626;">{{ $pendingDocCount ?? 0 }} Pending</span>
                            <span class="card-badge">{{ ($documentRequests ?? collect())->count() }} Total</span>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="res-table">
                            <thead><tr>
                                <th style="text-align:left;width:180px;">Resident</th>
                                <th>Document</th>
                                <th>Purpose</th>
                                <th>Voter</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th style="text-align:right;">Action</th>
                            </tr></thead>
                            <tbody>
                                @forelse($documentRequests ?? [] as $req)
                                <tr>
                                    <td>
                                        @php
                                            $reqUser = $req->user;
                                            if ($reqUser) {
                                                $displayName = trim(($reqUser->first_name ?? '') . ' ' . ($reqUser->last_name ?? ''));
                                                if (!$displayName) $displayName = $reqUser->name ?? '';
                                                if (!$displayName) $displayName = $reqUser->email ?? 'Unknown User';
                                                $resCode = $reqUser->resident_code ?? '—';
                                                $isGuest = false;
                                            } else {
                                                $displayName = trim(($req->guest_first_name ?? '') . ' ' . ($req->guest_last_name ?? ''));
                                                $resCode = '—';
                                                $isGuest = true;
                                            }
                                        @endphp
                                        <div style="font-size:12px;font-weight:800;color:var(--text);">
                                            {{ $displayName ?: 'Unknown' }}
                                            @if($isGuest)<span style="font-size:9px;background:#f1f5f9;color:#94a3b8;padding:1px 6px;border-radius:99px;margin-left:3px;">Guest</span>@endif
                                        </div>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $resCode }}</div>
                                    </td>
                                    <td><div style="font-size:11px;font-weight:800;color:var(--text);">{{ ucwords(str_replace('_',' ',$req->document_type)) }}</div></td>
                                    <td><div style="font-size:11px;color:var(--muted);font-weight:600;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $req->purpose ?? '' }}">{{ $req->purpose ?? '—' }}</div></td>
                                    <td>
                                        @if($reqUser && $reqUser->is_voter)
                                            <span style="font-size:9px;background:#dcfce7;color:#15803d;font-weight:900;padding:3px 8px;border-radius:99px;"><i class="fas fa-check-circle"></i> Voter</span>
                                        @else
                                            <span style="font-size:9px;background:#fef3c7;color:#a16207;font-weight:900;padding:3px 8px;border-radius:99px;"><i class="fas fa-coins"></i> Non-Voter</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-size:10px;color:var(--muted);font-weight:600;white-space:nowrap;">{{ $req->created_at->format('M d, Y') }}</div>
                                        <div style="font-size:9px;color:var(--light);">{{ $req->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending'    => ['bg'=>'#fef3c7','color'=>'#a16207','icon'=>'fa-clock'],
                                                'processing' => ['bg'=>'#dbeafe','color'=>'#1d4ed8','icon'=>'fa-spinner'],
                                                'ready'      => ['bg'=>'#dcfce7','color'=>'#15803d','icon'=>'fa-check-circle'],
                                                'released'   => ['bg'=>'#f1f5f9','color'=>'#64748b','icon'=>'fa-box-open'],
                                            ];
                                            $sc = $statusColors[$req->status] ?? ['bg'=>'#f1f5f9','color'=>'#64748b','icon'=>'fa-circle'];
                                        @endphp
                                        <span style="font-size:9px;font-weight:900;background:{{ $sc['bg'] }};color:{{ $sc['color'] }};padding:3px 9px;border-radius:99px;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;">
                                            <i class="fas {{ $sc['icon'] }}"></i> {{ ucfirst($req->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display:flex;align-items:center;justify-content:flex-end;gap:6px;flex-wrap:wrap;">
                                            <button
                                                title="Open & Print Document"
                                                @click="
                                                    openDoc='{{ $req->document_type }}';
                                                    clearDocOwner();
                                                    docOwnerName='{{ addslashes(trim(($req->user?->first_name ?? $req->user?->name ?? $req->guest_first_name ?? '').' '.($req->user?->last_name ?? $req->guest_last_name ?? '')))}}'.trim();
                                                    docOwnerAddress='{{ addslashes($req->address ?? $req->user?->address ?? '') }}';
                                                    docPurpose='{{ addslashes($req->purpose ?? '') }}';
                                                    @php $bdRaw = $req->user?->birthday ? \Carbon\Carbon::parse($req->user->birthday)->format('Y-m-d') : ''; @endphp
                                                    docOwnerBdayRaw='{{ $bdRaw }}';
                                                    docOwnerBirthplace='{{ addslashes($req->user?->birthplace ?? '') }}';
                                                    docOwnerIsVoter={{ $req->user?->is_voter ? 'true' : 'false' }};
                                                    @if($bdRaw)
                                                    (function(){const bd=new Date('{{ $bdRaw }}');const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;docOwnerAge=a;docOwnerBday=bd.toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'});})();
                                                    @endif
                                                    docBlk='{{ addslashes($req->blk ?? '') }}';
                                                    docLot='{{ addslashes($req->lot ?? '') }}';
                                                    docMoveDate='{{ addslashes($req->move_date ?? '') }}';
                                                    docLandlordName='{{ addslashes($req->landlord ?? '') }}';
                                                    docFamilyMembers='{{ addslashes($req->family_members ?? '') }}';
                                                    docWardName='{{ addslashes($req->ward_name ?? '') }}';
                                                    docWardAge='{{ addslashes($req->ward_age ?? '') }}';
                                                    docWardRelation='{{ addslashes($req->ward_relation ?? '') }}';
                                                    docPartnerName='{{ addslashes($req->partner_name ?? '') }}';
                                                    docLivingSince='{{ addslashes($req->living_since ?? '') }}';
                                                    docClaimantName='{{ addslashes($req->claimant_name ?? '') }}';
                                                    docClaimantRelation='{{ addslashes($req->claimant_relation ?? '') }}';
                                                    docSpouseName='{{ addslashes($req->claimant_name ?? '') }}';
                                                    docBirthMonth='{{ addslashes($req->birth_month ?? '') }}';
                                                    docBirthYear='{{ addslashes($req->birth_year ?? '') }}';
                                                    docChildName='{{ addslashes($req->child_name ?? '') }}';
                                                    docFatherName='{{ addslashes($req->father_name ?? '') }}';
                                                    docMotherName='{{ addslashes($req->mother_name ?? '') }}';
                                                    docBirthAttendant='{{ addslashes($req->birth_attendant ?? '') }}';
                                                    docBornFrom='{{ addslashes($req->born_from ?? '') }}';
                                                    docResidenceSince='{{ addslashes($req->residing_since ?? '') }}';
                                                "
                                                class="tbl-btn tbl-view" style="width:auto;padding:0 10px;font-size:10px;gap:4px;">
                                                <i class="fas fa-print"></i> Print
                                            </button>
                                            <form action="{{ route('office.document.status', $req->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('PATCH')
                                                <select name="status" onchange="this.form.submit()"
                                                        style="font-size:9px;font-weight:800;border:1.5px solid var(--border);border-radius:7px;padding:5px 8px;background:#f8fafc;color:var(--text);cursor:pointer;outline:none;font-family:inherit;">
                                                    <option value="pending"    {{ $req->status==='pending'    ? 'selected' : '' }}>⏳ Pending</option>
                                                    <option value="processing" {{ $req->status==='processing' ? 'selected' : '' }}>🔄 Processing</option>
                                                    <option value="ready"      {{ $req->status==='ready'      ? 'selected' : '' }}>✅ Ready for Pickup</option>
                                                    <option value="released"   {{ $req->status==='released'   ? 'selected' : '' }}>📦 Released</option>
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6"><div class="empty-st"><i class="fas fa-file-alt"></i><p>No document requests yet.</p></div></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ══ NON-RESIDENTS TAB ══ --}}
            <div x-show="activeTab === 'non-residents'" x-transition>
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><i class="fas fa-user-times"></i> Non-Resident Accounts</div>
                        <div class="card-badge">{{ ($nonResidents ?? collect())->count() }} Online Users Without Profiles</div>
                    </div>
                    <div style="padding:14px 18px;background:#f8fafc;font-size:11px;color:var(--muted);border-bottom:1px solid var(--border);">
                        These are users who registered via the public portal but haven't submitted their Resident Information yet, or do not exist in the masterlist.
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="res-table">
                            <thead><tr>
                                <th style="text-align:center;">Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Registered</th>
                                <th style="text-align:right;">Actions</th>
                            </tr></thead>
                            <tbody>
                                @forelse($nonResidents ?? [] as $nr)
                                <tr>
                                    <td style="text-align:center;">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($nr->name ?: 'U') }}&background=0E5393&color=fff&bold=true&rounded=true"
                                             onerror="this.src='https://ui-avatars.com/api/?name=U&background=0E5393&color=fff&bold=true&rounded=true'"
                                             style="width:36px;height:36px;border-radius:9px;object-fit:cover;border:2px solid #fff;box-shadow:0 1px 4px rgba(0,0,0,.1);display:block;margin:0 auto;">
                                    </td>
                                    <td>
                                        <div class="res-name">{{ $nr->name }}</div>
                                        <div class="res-code">{{ $nr->first_name }} {{ $nr->last_name }}</div>
                                        @if($nr->is_voter)
                                            <div style="margin-top:4px;"><span class="pill pill-voter">Voter</span></div>
                                        @else
                                            <div style="margin-top:4px;"><span class="pill" style="background:#fef3c7;color:#a16207;">Non-Voter</span></div>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="font-size:11px;font-weight:700;color:var(--text);"><i class="fas fa-envelope"></i> {{ $nr->email }}</div>
                                    </td>
                                    <td>
                                        <div style="font-size:10px;font-weight:600;color:var(--muted);">{{ $nr->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td>
                                        <div class="tbl-acts">
                                            <button @click="openAddModal=true; setTimeout(() => { document.querySelector('input[name=\'first_name\']').value='{{ addslashes($nr->first_name) }}'; document.querySelector('input[name=\'last_name\']').value='{{ addslashes($nr->last_name) }}'; document.querySelector('input[name=\'contact_number\']').value='{{ addslashes($nr->contact_number) }}'; if('{{ $nr->is_voter }}'=='1') { document.querySelector('input[name=\'is_voter\']').checked = true; } else { document.querySelector('input[name=\'is_voter\']').checked = false; } }, 50);" class="tbl-btn tbl-edit" title="Create Resident Profile directly"><i class="fas fa-user-plus"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4"><div class="empty-st"><i class="fas fa-check-circle text-green-500"></i><p>No non-resident accounts found.</p></div></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>{{-- /page-wrap --}}

        {{-- ══ DOCUMENT MODALS ══ --}}
        @php
        $docConfigs = [
            ['key'=>'residency',    'title'=>'Certificate of Residency',         'icon'=>'fa-house-user',         'placeholder'=>'e.g. Loan, School requirement',       'body'=>'residency'],
            ['key'=>'indigency',    'title'=>'Certificate of Indigency',          'icon'=>'fa-file-signature',     'placeholder'=>'e.g. Medical assistance, PhilHealth', 'body'=>'indigency'],
            ['key'=>'clearance',    'title'=>'Barangay Clearance',                'icon'=>'fa-shield-alt',         'placeholder'=>'e.g. Employment, Police clearance',   'body'=>'clearance'],
            ['key'=>'jobseeker',    'title'=>'Certificate for Job Seeker',        'icon'=>'fa-user-tie',           'placeholder'=>'e.g. DOLE requirement',               'body'=>'jobseeker'],
            ['key'=>'business',     'title'=>'Business Clearance',                'icon'=>'fa-store',              'placeholder'=>'e.g. Business permit application',    'body'=>'business'],
            ['key'=>'endorsement',  'title'=>'Barangay Endorsement',              'icon'=>'fa-file-export',        'placeholder'=>'e.g. Endorsement to DSWD, Mayor',     'body'=>'endorsement'],
            ['key'=>'moveout',      'title'=>'Certification of Move-Out',         'icon'=>'fa-truck-moving',       'placeholder'=>'e.g. Transfer of residence',          'body'=>'moveout'],
            ['key'=>'movein',       'title'=>'Certification of Move-In',          'icon'=>'fa-sign-in-alt',        'placeholder'=>'e.g. New resident, Transfer',         'body'=>'movein'],
            ['key'=>'closure',      'title'=>'Certification of Business Closure', 'icon'=>'fa-store-slash',        'placeholder'=>'e.g. Cessation of business',          'body'=>'closure'],
            ['key'=>'latereg',      'title'=>'Certificate of Late Registration',  'icon'=>'fa-clock',              'placeholder'=>'e.g. PSA requirement',                'body'=>'latereg'],
            ['key'=>'guardianship', 'title'=>'Certificate of Guardianship',       'icon'=>'fa-user-shield',        'placeholder'=>'e.g. School enrollment',              'body'=>'guardianship'],
            ['key'=>'cohabitation', 'title'=>'Certificate of Cohabitation',       'icon'=>'fa-user-friends',       'placeholder'=>'e.g. SSS, PhilHealth benefit',        'body'=>'cohabitation'],
            ['key'=>'katibayan',    'title'=>'Barangay Certification',            'icon'=>'fa-stamp',              'placeholder'=>'e.g. Educational Assistance, Loan',   'body'=>'katibayan'],
            ['key'=>'cashgift',     'title'=>'Pagpapatunay para sa Cash Gift',    'icon'=>'fa-gift',               'placeholder'=>'e.g. Birthday cash gift',             'body'=>'cashgift'],
            ['key'=>'yumao',        'title'=>'Pagpapatunay para sa Yumao',        'icon'=>'fa-ribbon',             'placeholder'=>'e.g. Death certificate requirement',  'body'=>'yumao'],
            ['key'=>'oath',         'title'=>'Oath of Office',                    'icon'=>'fa-hand-holding-heart', 'placeholder'=>'e.g. Assumption of office',           'body'=>'oath'],
        ];
        @endphp

        @foreach($docConfigs as $doc)
        <div x-show="openDoc === '{{ $doc['key'] }}'" x-cloak class="modal-ov" x-transition style="z-index:110;">
            <div class="modal-box" @click.away="openDoc=''">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ttl-ico"><i class="fas {{ $doc['icon'] }}"></i></div>
                            <div>
                                <div>{{ $doc['title'] }}</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Barangay San Miguel II</div>
                            </div>
                        </div>
                        <button @click="openDoc=''; clearDocOwner()" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div class="section-blk" @click.away="docOwnerOpen=false">
                        <div class="section-blk-ttl"><i class="fas fa-search"></i> Select Resident</div>
                        <div style="position:relative;">
                            <div style="display:flex;align-items:center;background:#fff;border:1.5px solid var(--border);border-radius:9px;padding:9px 13px;gap:7px;">
                                <i class="fas fa-search" style="color:var(--light);font-size:11px;flex-shrink:0;"></i>
                                <input type="text" x-model="docOwnerSearch"
                                       @focus="docOwnerOpen=true" @input="docOwnerOpen=true; docOwnerSelectedId=null; docOwnerName=docOwnerSearch"
                                       placeholder="Type name, code, or walk-in..." autocomplete="off"
                                       style="flex:1;border:none;background:transparent;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;">
                                <span x-show="docOwnerSelectedId && docOwnerIsVoter" style="font-size:9px;background:#dcfce7;color:#15803d;font-weight:900;padding:2px 8px;border-radius:99px;"><i class="fas fa-check-circle"></i> Voter — FREE</span>
                                <span x-show="docOwnerSelectedId && !docOwnerIsVoter" style="font-size:9px;background:#fef3c7;color:#a16207;font-weight:900;padding:2px 8px;border-radius:99px;"><i class="fas fa-coins"></i> Non-Voter</span>
                                <button type="button" x-show="docOwnerSearch" @click="clearDocOwner()" style="background:none;border:none;color:var(--light);cursor:pointer;font-size:11px;"><i class="fas fa-times"></i></button>
                            </div>
                            <div x-show="docOwnerOpen && docResidentSuggestions.length > 0" x-transition class="suggestions-box">
                                <template x-for="r in docResidentSuggestions" :key="r.id">
                                    <div @click="selectDocResident(r)" class="sugg-item">
                                        <div style="flex:1;"><div class="sugg-name" x-text="r.name"></div><div class="sugg-meta" x-text="r.code+' • '+(r.address||'No address')"></div></div>
                                        <span x-show="r.is_voter" class="pill pill-voter">Voter</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="fgrid2 fgrp">
                        <div><label class="flbl">Purpose</label><input type="text" x-model="docPurpose" placeholder="{{ $doc['placeholder'] }}" class="finput"></div>
                        <div><label class="flbl">Date of Issue</label><input type="date" x-model="docDate" class="finput"></div>
                    </div>
                    <div class="fgrid2 fgrp">
                        <div class="fspan2"><label class="flbl">Full Name</label><input type="text" x-model="docOwnerName" placeholder="Full name..." class="finput"></div>
                        <div class="fspan2"><label class="flbl">Address</label><input type="text" x-model="docOwnerAddress" placeholder="Blk/Lot, Street, Barangay..." class="finput"></div>
                        <div>
                            <label class="flbl">Date of Birth</label>
                            <input type="date" x-model="docOwnerBdayRaw"
                                   @change="const bd=new Date($event.target.value);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;docOwnerAge=a;docOwnerBday=bd.toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'})"
                                   class="finput">
                        </div>
                        <div><label class="flbl">Place of Birth</label><input type="text" x-model="docOwnerBirthplace" placeholder="City/Province..." class="finput"></div>
                        <div><label class="flbl">Issued By</label><input type="text" x-model="docIssuedBy" placeholder="Name of staff..." class="finput"></div>
                        <div><label class="flbl">Position</label><input type="text" x-model="docPosition" placeholder="e.g. Barangay BRK..." class="finput"></div>
                    </div>
                    @if($doc['body']==='endorsement')
                    <div class="section-blk"><div class="section-blk-ttl">Endorsement Details</div>
                        <div><label class="flbl">Residing Since (Year)</label><input type="text" x-model="docResidenceSince" placeholder="e.g. 2020" class="finput"></div>
                    </div>
                    @endif
                    @if($doc['body']==='moveout'||$doc['body']==='movein')
                    <div class="section-blk"><div class="section-blk-ttl">{{ $doc['body']==='moveout'?'Move-Out':'Move-In' }} Details</div>
                        <div class="fgrid2" style="gap:9px;">
                            <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                            <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                            <div><label class="flbl">{{ $doc['body']==='moveout'?'Move-Out Date':'Move-In Date' }}</label><input type="text" x-model="docMoveDate" placeholder="e.g. Feb 9, 2023" class="finput"></div>
                            <div><label class="flbl">Landlord / Owner</label><input type="text" x-model="docLandlordName" class="finput"></div>
                            <div><label class="flbl">Rental Agreement Date</label><input type="text" x-model="docRentalDate" class="finput"></div>
                            <div class="fspan2"><label class="flbl">Family Members (comma-separated)</label><input type="text" x-model="docFamilyMembers" class="finput"></div>
                        </div>
                    </div>
                    @endif
                    @if($doc['body']==='yumao')
                    <div class="section-blk"><div class="section-blk-ttl"><i class="fas fa-ribbon"></i> Yumao Details</div>
                        <div class="fgrid2" style="gap:9px;">
                            <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                            <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                            <div class="fspan2"><label class="flbl">Pangalan ng Yumao (Full Name of Deceased)</label><input type="text" x-model="docClaimantName" placeholder="Buong pangalan ng namatay..." class="finput"></div>
                            <div><label class="flbl">Pangalan ng Kumuha (Claimant)</label><input type="text" x-model="docOwnerName" placeholder="Pangalan ng kukuha ng benepisyo..." class="finput"></div>
                            <div><label class="flbl">Relasyon sa Yumao</label><input type="text" x-model="docClaimantRelation" placeholder="e.g. Asawa, Anak, Kapatid..." class="finput"></div>
                        </div>
                    </div>
                    @endif
                    @if($doc['body']==='cashgift')
                    <div class="section-blk"><div class="section-blk-ttl"><i class="fas fa-gift"></i> Cash Gift Details</div>
                        <div class="fgrid2" style="gap:9px;">
                            <div class="fspan2"><label class="flbl">Pangalan ng May Karamdaman (Full Name)</label><input type="text" x-model="docClaimantName" placeholder="Pangalan ng may sakit..." class="finput"></div>
                            <div><label class="flbl">Pangalan ng Kukuha (Claimant)</label><input type="text" x-model="docSpouseName" placeholder="Pangalan ng kukuha..." class="finput"></div>
                            <div><label class="flbl">Relasyon</label><input type="text" x-model="docClaimantRelation" placeholder="e.g. Anak, Asawa, Apo..." class="finput"></div>
                            <div><label class="flbl">Birthday Month</label><input type="text" x-model="docBirthMonth" placeholder="e.g. February" class="finput"></div>
                            <div><label class="flbl">Birthday Year</label><input type="text" x-model="docBirthYear" placeholder="e.g. 2025" class="finput"></div>
                        </div>
                    </div>
                    @endif
                    @if($doc['body']==='closure')
                    <div class="section-blk"><div class="section-blk-ttl">Business Closure Details</div>
                        <div class="fgrid2" style="gap:9px;">
                            <div><label class="flbl">Company / Trade Name</label><input type="text" x-model="docCompanyName" class="finput"></div>
                            <div><label class="flbl">Business Owner</label><input type="text" x-model="docOwnerBusiness" class="finput"></div>
                            <div><label class="flbl">Non-Operational Since (mm/dd/yy)</label><input type="text" x-model="docNonOpSince" placeholder="e.g. 01/15/25" class="finput"></div>
                        </div>
                    </div>
                    @endif
                    @if($doc['body']==='latereg')
                    <div class="section-blk"><div class="section-blk-ttl">Late Registration Details</div>
                        <div class="fgrid2" style="gap:9px;">
                            <div class="fspan2"><label class="flbl">Child's Full Name</label><input type="text" x-model="docChildName" class="finput"></div>
                            <div><label class="flbl">Father's Full Name</label><input type="text" x-model="docFatherName" class="finput"></div>
                            <div><label class="flbl">Mother's Full Name</label><input type="text" x-model="docMotherName" class="finput"></div>
                            <div><label class="flbl">Birth Attendant</label><input type="text" x-model="docBirthAttendant" class="finput"></div>
                            <div><label class="flbl">Born From (Place)</label><input type="text" x-model="docBornFrom" class="finput"></div>
                        </div>
                    </div>
                    @endif
                    @if($doc['body']==='guardianship')
                    <div class="section-blk"><div class="section-blk-ttl">Guardianship Details</div>
                        <div class="fgrid3" style="gap:9px;">
                            <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                            <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                            <div><label class="flbl">Ward's Age</label><input type="text" x-model="docWardAge" class="finput"></div>
                            <div style="grid-column:span 2;"><label class="flbl">Ward's Full Name</label><input type="text" x-model="docWardName" class="finput"></div>
                            <div><label class="flbl">Relation to Guardian</label><input type="text" x-model="docWardRelation" class="finput"></div>
                        </div>
                    </div>
                    @endif
                    @if($doc['body']==='cohabitation')
                    <div class="section-blk"><div class="section-blk-ttl">Cohabitation Details</div>
                        <div class="fgrid3" style="gap:9px;">
                            <div class="fspan3"><label class="flbl">Partner's Full Name</label><input type="text" x-model="docPartnerName" class="finput"></div>
                            <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                            <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                            <div><label class="flbl">Living Together Since</label><input type="text" x-model="docLivingSince" placeholder="e.g. 2024" class="finput"></div>
                        </div>
                    </div>
                    @endif
                    @if($doc['body']==='katibayan')
                    <div class="section-blk"><div class="section-blk-ttl">Katibayan Details</div>
                        <div class="fgrid2" style="gap:9px;">
                            <div><label class="flbl">Blk</label><input type="text" x-model="docBlk" class="finput"></div>
                            <div><label class="flbl">Lot</label><input type="text" x-model="docLot" class="finput"></div>
                        </div>
                    </div>
                    @endif
                    <div id="print-{{ $doc['key'] }}" class="doc-preview">
                        <div style="text-align:center;margin-bottom:14px;">
                            <div style="display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:7px;">
                                <img src="{{ asset('images/dasma.png') }}" style="width:52px;height:52px;object-fit:contain;" onerror="this.style.display='none'">
                                <img src="{{ asset('images/Bagong_Pilipinas_logo.png') }}" style="width:52px;height:52px;object-fit:contain;" onerror="this.style.display='none'">
                                <img src="{{ asset('images/brgysm2_logo.png') }}" style="width:52px;height:52px;object-fit:contain;" onerror="this.style.display='none'">
                            </div>
                            <p style="font-size:10.5px;font-weight:700;color:#333;margin:1px 0;">PROVINCE OF CAVITE</p>
                            <p style="font-size:10.5px;font-weight:700;color:#333;margin:1px 0;">CITY OF DASMARI&Ntilde;AS</p>
                            <p style="font-size:10.5px;font-weight:700;color:#333;margin:1px 0;">BARANGAY SAN MIGUEL 2</p>
                            <p style="font-size:9.5px;color:#666;margin:1px 0;">OFFICE OF THE SANGGUNIANG BARANGAY</p>
                            <div style="border-top:2px solid #000;border-bottom:2px solid #000;margin:8px 0;padding:4px 0;">
                                <p style="font-size:13px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:.05em;margin:0;">{{ $doc['title'] }}</p>
                            </div>
                        </div>
                        <div style="color:#000;line-height:1.6;font-size:10.5px;">
                            @if($doc['body']==='residency')
                            <p>To whom it may concern,</p>
                            <p style="text-indent:40px;margin-top:6px;">This is to certify that <strong><span x-text="docOwnerName||'______________________________'"></span></strong>, born on <strong><span x-text="docOwnerBday||'__________________'"></span></strong>, <strong><span x-text="docOwnerAge||'___'"></span></strong> years old, is a bona fide resident of <strong>Barangay San Miguel II, Dasmariñas City, Cavite.</strong></p>
                            <p style="text-indent:40px;margin-top:6px;">The undersigned has certified that after a reasonable inquiry, I have verified the authenticity of barangay residency showing that the applicant has been residing in the barangay for at least six (6) months prior to the application.</p>
                            <p style="text-indent:40px;margin-top:6px;">This certificate is issued upon the request of the above named person as a supporting document for <strong><span x-text="docPurpose||'______________________________'"></span></strong>.</p>
                            @elseif($doc['body']==='indigency')
                            <p>To whom it may concern:</p>
                            <p style="text-indent:40px;margin-top:6px;">This is to certify that <strong><span x-text="docOwnerName||'______________________________'"></span></strong>, <strong><span x-text="docOwnerAge||'___'"></span></strong> of legal age is a bona fide resident of <strong>Barangay San Miguel II, City of Dasmarinas Cavite.</strong></p>
                            <p style="text-indent:40px;margin-top:6px;">This further certifies that the family above-mentioned belongs to the less fortunate or accredited indigent families in the area of our jurisdiction.</p>
                            <p style="text-indent:40px;margin-top:6px;">This certification is being issued upon request of <strong><span x-text="docOwnerName||'______________________________'"></span></strong> for <strong><span x-text="docPurpose||'______________________________'"></span></strong> purpose only.</p>
                            @elseif($doc['body']==='clearance')
                            <div style="overflow:hidden;">
                                <label style="float:right;cursor:pointer;margin-left:12px;" title="Click to upload photo">
                                    <div style="border:1px solid #000;border-radius:8px;width:78px;height:88px;display:flex;align-items:center;justify-content:center;flex-direction:column;overflow:hidden;position:relative;background:#f5f5f5;">
                                        <img x-show="docClearancePhoto" :src="docClearancePhoto" style="width:100%;height:100%;object-fit:cover;position:absolute;top:0;left:0;">
                                        <div x-show="!docClearancePhoto" style="text-align:center;font-size:8px;color:#999;">📷<br>Upload</div>
                                    </div>
                                    <input type="file" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const r=new FileReader();r.onload=e=>docClearancePhoto=e.target.result;r.readAsDataURL(f)}">
                                </label>
                                <p>To whom it may concern,</p>
                                <p style="text-indent:30px;">This is to certify that the person whose name, picture, signature and thumb mark appear below has requested a Barangay Clearance from this office.</p>
                            </div>
                            <div style="margin-top:9px;">
                                <p>NAME: <span style="border-bottom:1px solid #000;display:inline-block;min-width:220px;" x-text="docOwnerName||''"></span></p>
                                <p>ADDRESS: <span style="border-bottom:1px solid #000;display:inline-block;min-width:200px;" x-text="docOwnerAddress||''"></span></p>
                                <p>DATE OF BIRTH: <span style="border-bottom:1px solid #000;display:inline-block;min-width:140px;" x-text="docOwnerBday||''"></span></p>
                                <p>PLACE OF BIRTH: <span style="border-bottom:1px solid #000;display:inline-block;min-width:140px;" x-text="docOwnerBirthplace||''"></span></p>
                                <p>AGE: <span style="border-bottom:1px solid #000;display:inline-block;min-width:60px;" x-text="docOwnerAge||''"></span></p>
                                <p>CITIZENSHIP: <span style="border-bottom:1px solid #000;display:inline-block;min-width:120px;">FILIPINO</span></p>
                                <p>PURPOSE: <span style="border-bottom:1px solid #000;display:inline-block;min-width:200px;" x-text="docPurpose||''"></span></p>
                                <p>DATE ISSUED: <span style="border-bottom:1px solid #000;display:inline-block;min-width:120px;" x-text="formatDocDate(docDate)"></span></p>
                            </div>
                            <p style="margin-top:7px;font-style:italic;font-size:10px;"><em>This certification is valid for thirty (30) days from the date issued.</em></p>
                            @elseif($doc['body']==='cashgift')
                            <p>Sa lahat ng makababasa nito:</p>
                            <p style="text-indent:40px;margin-top:6px;">Ito ay bilang pagpapatunay na si <strong><span x-text="docClaimantName||'______________________________'"></span></strong> ay may karamdaman at walang kakayahang makuha ang kanyang Birthday Cash Gift.</p>
                            <p style="text-indent:40px;margin-top:6px;">Pinahihintulutan niya ang kanyang <strong><span x-text="docClaimantRelation||'______________'"></span></strong> na si <strong><span x-text="docSpouseName||'______________________________'"></span></strong> na makuha ang kanyang Birthday Cash Gift para sa buwan ng <strong><span x-text="docBirthMonth||'__________'"></span></strong>, taong <strong><span x-text="docBirthYear||'______'"></span></strong>.</p>
                            <p style="text-indent:40px;margin-top:6px;">Pang-unawa po ang aming hiling. Maraming salamat po.</p>
                            @elseif($doc['body']==='yumao')
                            <p>Sa lahat ng makababasa nito:</p>
                            <p style="text-indent:40px;margin-top:6px;">Ito ay nagpapatunay na si <strong><span x-text="docClaimantName||'______________________________'"></span></strong>, naninirahan sa <strong>Blk <span x-text="docBlk||'___'"></span> Lot <span x-text="docLot||'___'"></span>, Barangay San Miguel II, Dasmariñas City, Cavite</strong>, ay pumanaw na.</p>
                            <p style="text-indent:40px;margin-top:6px;">Ang kanyang <strong><span x-text="docClaimantRelation||'______________'"></span></strong> na si <strong><span x-text="docOwnerName||'______________________________'"></span></strong> ay awtorisadong kumuha ng anumang benepisyo o dokumento sa ngalan ng namatay.</p>
                            <p style="text-indent:40px;margin-top:6px;">Ibinibigay ang sertipikasyong ito para sa lahat ng legal na layunin.</p>
                            @else
                            <p style="text-indent:40px;">This is to certify that <strong><span x-text="docOwnerName||'______________________________'"></span></strong>, <strong><span x-text="docOwnerAge||'___'"></span></strong> years old, a bona fide resident of <strong>Barangay San Miguel II</strong>, is hereby issued this <strong>{{ $doc['title'] }}</strong> for <strong><span x-text="docPurpose||'______________________________'"></span></strong>.</p>
                            <p style="text-indent:40px;margin-top:6px;">This certification is being issued upon request of the above-named person for whatever legal purpose it may serve.</p>
                            @endif
                            <p style="margin-top:10px;">Issued this <strong><span x-text="docDayOrdinal"></span></strong> day of <strong><span x-text="docMonth"></span></strong>, year <strong><span x-text="docYear"></span></strong> at Barangay San Miguel II, Dasmariñas City, Cavite.</p>
                        </div>
                        <div style="text-align:right;margin-top:46px;">
                            <div style="display:inline-block;text-align:center;min-width:195px;">
                                <div style="height:38px;"></div>
                                <div style="border-top:2px solid #000;padding-top:3px;">
                                    <p style="font-weight:900;text-transform:uppercase;margin:0;font-size:10.5px;">MARVIN M. BENIS</p>
                                    <p style="font-style:italic;margin:0;font-size:9.5px;">PUNONG BARANGAY</p>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:7px;font-size:10px;color:#666;">
                            <p>Issued by: <span style="border-bottom:1px solid #aaa;display:inline-block;min-width:148px;" x-text="docIssuedBy||''"></span></p>
                            <p>Position: <span style="border-bottom:1px solid #aaa;display:inline-block;min-width:148px;" x-text="docPosition||''"></span></p>
                        </div>
                        <div style="margin-top:10px;border-top:1px solid #ccc;padding-top:7px;text-align:center;">
                            <p style="font-size:8.5px;color:#888;text-transform:uppercase;letter-spacing:.05em;font-style:italic;">NOTE: THIS CERTIFICATION IS NOT VALID IF THERE ARE ERASURE AND WITHOUT DRY SEAL</p>
                        </div>
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:9px;">
                        <button @click="openDoc=''; clearDocOwner()" class="btn-plain btn-edit">Cancel</button>
                        @php $dk = $doc['key']; @endphp
                        <button onclick="printDoc('print-{{ $dk }}')" class="btn-grad"><i class="fas fa-print"></i> Print Document</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- ══ PROFILE MODAL ══ --}}
        <div x-show="showProfile" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="showProfile=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-user-circle"></i></div> Resident Profile</div>
                        <button @click="showProfile=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div style="display:flex;align-items:center;gap:18px;margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid var(--border);">
                        <img :src="selectedUser.photo||'https://ui-avatars.com/api/?name='+encodeURIComponent(selectedUser.name||'')+'&background=0E5393&color=fff&size=128&bold=true'"
                             style="width:84px;height:84px;border-radius:15px;object-fit:cover;box-shadow:var(--card-shadow);border:3px solid #fff;flex-shrink:0;">
                        <div>
                            <div style="font-size:20px;font-weight:900;color:var(--text);line-height:1.2;" x-text="selectedUser.name"></div>
                            <div style="font-size:10px;font-weight:700;color:var(--brand);text-transform:uppercase;letter-spacing:.06em;margin-top:3px;" x-text="selectedUser.code"></div>
                            <div style="display:flex;gap:4px;flex-wrap:wrap;margin-top:7px;">
                                <span x-show="selectedUser.is_senior" class="pill pill-senior">Senior</span>
                                <span x-show="selectedUser.is_pwd" class="pill pill-pwd">PWD</span>
                                <span x-show="selectedUser.is_single_parent" class="pill pill-solo">Solo Parent</span>
                                <span x-show="selectedUser.is_voter" class="pill pill-voter">Voter</span>
                                <span x-show="selectedUser.is_student" class="pill pill-student">Student</span>
                            </div>
                        </div>
                    </div>
                    <div class="fgrid2" style="gap:9px;margin-bottom:14px;">
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Birthday</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="formatDate(selectedUser.birthday)"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Age</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="getAge(selectedUser.birthday)"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Birthplace</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.birthplace||'N/A'"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Gender</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.gender||'N/A'"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Civil Status</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.civil_status||'N/A'"></div></div>
                        <div x-show="selectedUser.civil_status === 'Married'" style="background:#fdf2ff;padding:11px 13px;border-radius:9px;border:1px solid #e9d5ff;"><div style="font-size:9px;font-weight:900;color:#7c3aed;text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Spouse / Husband</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.spouse_name||'N/A'"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Contact No.</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.contact||'N/A'"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Email</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.email||'N/A'"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Occupation</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.occupation||'N/A'"></div></div>
                        <div style="background:#f8fafc;padding:11px 13px;border-radius:9px;border:1px solid var(--border);grid-column:span 2;"><div style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;">Address</div><div style="font-size:12px;font-weight:800;color:var(--text);" x-text="selectedUser.address||'N/A'"></div></div>
                    </div>
                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:11px;padding:13px;margin-bottom:14px;">
                        <div style="font-size:9px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.07em;margin-bottom:9px;"><i class="fas fa-paw" style="margin-right:4px;color:var(--brand);"></i> Beloved Pet Family</div>
                        <div style="display:flex;flex-wrap:wrap;gap:5px;">
                            @foreach($pets ?? [] as $rp)
                            <div x-show="selectedUser.id == {{ $rp->resident_id }}"
                                 style="display:flex;align-items:center;gap:4px;background:#fff;padding:4px 9px;border-radius:99px;border:1px solid #bfdbfe;font-size:10px;font-weight:800;color:#333;">
                                <i class="fas fa-paw" style="color:var(--brand);font-size:8px;"></i> {{ $rp->pet_name ?? $rp->pet_type }}
                            </div>
                            @endforeach
                            <button @click="openAddPetModal=true;showProfile=false"
                                    style="display:flex;align-items:center;gap:4px;background:#eff6ff;padding:4px 9px;border-radius:99px;border:1.5px dashed var(--brand);color:var(--brand);font-size:10px;font-weight:800;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='var(--brand)';this.style.color='#fff'" onmouseout="this.style.background='#eff6ff';this.style.color='var(--brand)'">
                                <i class="fas fa-plus" style="font-size:8px;"></i> Add Pet
                            </button>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:9px;">
                        <button class="btn-plain btn-edit" style="justify-content:center;"><i class="fas fa-print"></i> Print</button>
                        <button @click="openEdit(selectedUser.id);showProfile=false" class="btn-grad" style="justify-content:center;"><i class="fas fa-edit"></i> Edit</button>
                        <form :action="'/office/'+selectedUser.id+'/archive'" method="POST" @submit.prevent="if(confirm('Archive '+selectedUser.name+'?')) $el.submit()">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-plain btn-amber" style="width:100%;justify-content:center;"><i class="fas fa-archive"></i> Archive</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ PET TRACKER MODAL ══ --}}
        <div x-show="openPetTracker" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:860px;" @click.away="openPetTracker=false">
                <div class="modal-in">
                    <div class="modal-hd"><div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-paw"></i></div> Pet Tracker</div><button @click="openPetTracker=false" class="modal-close"><i class="fas fa-times-circle"></i></button></div>
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:11px;margin-bottom:18px;">
                        <div style="background:#eff6ff;padding:14px;border-radius:11px;text-align:center;border:1px solid #bfdbfe;"><div style="font-size:30px;font-weight:900;color:var(--brand-dark);">{{ ($pets??collect())->count() }}</div><div style="font-size:9px;font-weight:800;color:var(--brand);text-transform:uppercase;margin-top:3px;">Total</div></div>
                        <div style="background:#f0fdf4;padding:14px;border-radius:11px;text-align:center;border:1px solid #bbf7d0;"><div style="font-size:30px;font-weight:900;color:#15803d;">{{ ($pets??collect())->where('vaccine_status','Vaccinated')->count() }}</div><div style="font-size:9px;font-weight:800;color:#16a34a;text-transform:uppercase;margin-top:3px;">Vaccinated</div></div>
                        <div style="background:#fef2f2;padding:14px;border-radius:11px;text-align:center;border:1px solid #fecaca;"><div style="font-size:30px;font-weight:900;color:#dc2626;">{{ ($pets??collect())->where('vaccine_status','Unvaccinated')->count() }}</div><div style="font-size:9px;font-weight:800;color:#ef4444;text-transform:uppercase;margin-top:3px;">Unvaccinated</div></div>
                    </div>
                    <div style="background:#f8fafc;border-radius:11px;overflow:hidden;border:1px solid var(--border);">
                        <table class="pet-table">
                            <thead><tr><th>Owner</th><th>Pet Name</th><th>Type</th><th>Breed</th><th>Age</th><th>Qty</th><th>Vaccine</th><th>Last Vacc.</th><th></th></tr></thead>
                            <tbody>
                                @forelse($pets??[] as $pet)
                                <tr>
                                    <td style="font-weight:700;">{{ $pet->resident->first_name??'N/A' }} {{ $pet->resident->last_name??'' }}</td>
                                    <td style="font-weight:700;color:var(--brand);">{{ $pet->pet_name??'-' }}</td>
                                    <td>{{ $pet->pet_type }}</td><td>{{ $pet->breed ?? '-' }}</td><td>{{ $pet->age ?? '-' }}</td><td>{{ $pet->quantity ?? 1 }}</td>
                                    <td>
                                        @if($pet->vaccine_status==='Vaccinated') <span class="pill" style="background:#dcfce7;color:#15803d;">Vaccinated</span>
                                        @elseif($pet->vaccine_status==='Unvaccinated') <span class="pill" style="background:#fee2e2;color:#dc2626;">Unvaccinated</span>
                                        @else <span class="pill" style="background:#dbeafe;color:#1d4ed8;">Partial</span>
                                        @endif
                                    </td>
                                    <td style="font-size:10px;">{{ $pet->last_vaccine_date ? \Carbon\Carbon::parse($pet->last_vaccine_date)->format('M d, Y') : '-' }}</td>
                                    <td><form action="{{ url('/pets/'.$pet->id) }}" method="POST" onsubmit="return confirm('Delete this pet?')">@csrf @method('DELETE')<button type="submit" class="tbl-btn tbl-del"><i class="fas fa-trash"></i></button></form></td>
                                </tr>
                                @empty
                                <tr><td colspan="9"><div class="empty-st"><i class="fas fa-paw"></i><p>No pets yet.</p></div></td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="display:flex;justify-content:flex-end;margin-top:14px;"><button @click="openPetTracker=false" class="btn-plain btn-edit"><i class="fas fa-times"></i> Close</button></div>
                </div>
            </div>
        </div>

        {{-- ══ ADD PET MODAL ══ --}}
        <div x-show="openAddPetModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:500px;" @click.away="openAddPetModal=false">
                <div class="modal-in">
                    <div class="modal-hd"><div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-paw"></i></div> Register Pet</div><button @click="openAddPetModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button></div>
                    <form action="{{ url('/pets/store') }}" method="POST">
                        @csrf
                        <div x-data="{
                            petOwnerSearch:'', petOwnerSelectedId:null, petOwnerOpen:false,
                            residents: {{ $users->map(fn($u)=>['id'=>$u->id,'name'=>$u->first_name.' '.$u->last_name,'code'=>$u->resident_code??'NO-CODE'])->values()->toJson() }},
                            get filtered() { if(this.petOwnerSearch.length<1) return []; const q=this.petOwnerSearch.toLowerCase(); return this.residents.filter(r=>r.name.toLowerCase().includes(q)||r.code.toLowerCase().includes(q)).slice(0,8); },
                            select(r) { this.petOwnerSearch=r.name+' — '+r.code; this.petOwnerSelectedId=r.id; this.petOwnerOpen=false; },
                            init() { this.$watch('$root.selectedUser',(val)=>{ if(val&&val.id){ const f=this.residents.find(r=>r.id==val.id); if(f) this.select(f); } }); }
                        }">
                            <div class="fgrp">
                                <label class="flbl">Owner (Resident)</label>
                                <div style="position:relative;">
                                    <div style="display:flex;align-items:center;background:#f8fafc;border:1.5px solid var(--border);border-radius:9px;padding:9px 13px;gap:7px;">
                                        <i class="fas fa-search" style="color:var(--light);font-size:11px;"></i>
                                        <input type="text" x-model="petOwnerSearch" @focus="petOwnerOpen=true" @input="petOwnerOpen=true; petOwnerSelectedId=null" @click.away="petOwnerOpen=false"
                                               placeholder="Type name or code..." autocomplete="off"
                                               style="flex:1;background:transparent;border:none;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;">
                                        <span x-show="petOwnerSelectedId" class="pill pill-voter">Selected</span>
                                        <button type="button" x-show="petOwnerSearch" @click="petOwnerSearch='';petOwnerSelectedId=null" style="background:none;border:none;color:var(--light);cursor:pointer;"><i class="fas fa-times" style="font-size:10px;"></i></button>
                                    </div>
                                    <div x-show="petOwnerOpen && filtered.length > 0" x-transition class="suggestions-box">
                                        <template x-for="r in filtered" :key="r.id"><div @click="select(r)" class="sugg-item"><div><div class="sugg-name" x-text="r.name"></div><div class="sugg-meta" x-text="r.code"></div></div></div></template>
                                    </div>
                                    <input type="hidden" name="resident_id" :value="petOwnerSelectedId">
                                </div>
                            </div>
                            <div class="fgrp"><label class="flbl">Pet Name</label><input type="text" name="pet_name" placeholder="e.g. Bantay, Muning..." class="finput"></div>
                            <div class="fgrp">
                                <label class="flbl">Pet Type</label>
                                <style>
                                    .pet-type-card { border:2px solid var(--border);border-radius:9px;padding:9px 5px;text-align:center;font-size:10px;font-weight:800;color:var(--muted);transition:all .12s;cursor:pointer; }
                                    .pet-type-card:hover { border-color:var(--brand); background:#eff6ff; color:var(--brand); }
                                    input[name="pet_type"]:checked + .pet-type-card { border-color:var(--brand) !important; background:var(--brand) !important; color:#fff !important; }
                                </style>
                                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-bottom:7px;">
                                    @foreach(['Dog'=>'🐶','Cat'=>'🐱','Bird'=>'🐦','Rabbit'=>'🐰','Fish'=>'🐟','Others'=>'➕'] as $type=>$emoji)
                                    <label style="cursor:pointer;"><input type="radio" name="pet_type" value="{{ $type }}" @change="petTypeSelection='{{ $type }}'" class="hidden" required>
                                        <div class="pet-type-card">{{ $emoji }} {{ $type }}</div>
                                    </label>
                                    @endforeach
                                </div>
                                <div x-show="petTypeSelection==='Others'" x-transition><input type="text" name="pet_type_other" placeholder="Specify pet type..." class="finput"></div>
                            </div>
                            <div class="fgrp"><label class="flbl">Breed</label><input type="text" name="breed" placeholder="e.g. Aspin, Puspin..." class="finput"></div>
                            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:11px;margin-bottom:11px;">
                                <div><label class="flbl">Age (yrs)</label><input type="number" name="age" min="0" placeholder="e.g. 2" class="finput"></div>
                                <div><label class="flbl">Months</label><input type="number" name="months" min="0" max="11" class="finput"></div>
                                <div><label class="flbl">Qty</label><input type="number" name="quantity" min="1" value="1" class="finput"></div>
                            </div>
                            <div class="fgrp"><label class="flbl">Vaccine Status</label><select name="vaccine_status" class="finput fselect"><option value="Unvaccinated">Unvaccinated</option><option value="Vaccinated">Vaccinated</option><option value="Partial">Partially Vaccinated</option></select></div>
                            <div class="fgrp"><label class="flbl">Last Vaccine Date</label><input type="date" name="last_vaccine_date" class="finput"></div>
                            <div style="display:flex;justify-content:flex-end;gap:9px;">
                                <button type="button" @click="openAddPetModal=false" class="btn-plain btn-edit">Cancel</button>
                                <button type="submit" class="btn-grad"><i class="fas fa-paw"></i> Register Pet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ ADD RESIDENT MODAL ══ --}}
        <div x-show="openAddModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-height:92vh;overflow-y:auto;" @click.away="openAddModal=false">
                <div class="modal-in">
                    <div class="modal-hd" style="position:sticky;top:0;background:#fff;z-index:10;padding-bottom:14px;margin-bottom:0;">
                        <div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-user-plus"></i></div> Add New Resident</div>
                        <button @click="openAddModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('office.store') }}" method="POST" enctype="multipart/form-data" style="padding-top:14px;" x-data="{ isHouseholdHead: false, familyMembers: [] }">
                        @csrf
                        <div style="display:flex;justify-content:center;margin-bottom:18px;">
                            <label style="cursor:pointer;">
                                <div class="photo-up" style="position:relative;">
                                    <img x-show="photoPreview" :src="photoPreview" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:11px;">
                                    <div x-show="!photoPreview" style="text-align:center;position:relative;z-index:1;"><i class="fas fa-camera" style="font-size:20px;color:var(--light);display:block;margin-bottom:3px;"></i><span style="font-size:8px;font-weight:700;color:var(--light);text-transform:uppercase;">Upload Photo</span></div>
                                </div>
                                <input type="file" name="photo" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const reader=new FileReader();reader.onload=function(ev){photoPreview=ev.target.result;};reader.readAsDataURL(f);}">
                            </label>
                        </div>
                        <div style="display:grid;grid-template-columns:2fr 1fr 2fr 1fr;gap:11px;margin-bottom:12px;">
                            <div><label class="flbl">First Name *</label><input type="text" name="first_name" required class="finput"></div>
                            <div><label class="flbl">Middle Name</label><input type="text" name="middle_name" class="finput"></div>
                            <div><label class="flbl">Last Name *</label><input type="text" name="last_name" required class="finput"></div>
                            <div><label class="flbl">Suffix</label><input type="text" name="suffix" placeholder="e.g. Jr" class="finput"></div>
                        </div>
                        <div class="fgrid2 fgrp" x-data="{ addCivilStatus: '' }">
                            <div><label class="flbl">Birthday & Age *</label><div style="display:flex;gap:7px;"><input type="date" name="birthday" id="add-main-birthday" required class="finput" style="flex:1;" onchange="let bd=new Date(this.value);let t=new Date();let a=t.getFullYear()-bd.getFullYear();let m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;document.getElementById('add-main-age').value=a;"><input type="number" name="age" id="add-main-age" required placeholder="Age" class="finput" style="width:70px;"></div></div>
                            <div><label class="flbl">Birthplace *</label><input type="text" name="birthplace" required placeholder="City/Municipality" class="finput"></div>
                            <div><label class="flbl">Gender *</label><select name="gender" required class="finput fselect"><option value="">Select Gender *</option><option>Male</option><option>Female</option><option>Other</option></select></div>
                            <div><label class="flbl">Civil Status *</label><select name="civil_status" x-model="addCivilStatus" required class="finput fselect"><option value="">Select</option><option>Single</option><option>Married</option><option>Widowed</option><option>Separated</option></select></div>
                            <div x-show="addCivilStatus === 'Married'" x-transition class="fspan2"><label class="flbl">Spouse / Husband Name</label><input type="text" name="spouse_name" placeholder="Full name of spouse/husband..." class="finput"></div>
                            <div><label class="flbl">Contact No. *</label><input type="text" name="contact_number" required placeholder="09XXXXXXXXX" class="finput"></div>
                            <div>
                                <label class="flbl">Occupation</label>
                                <input type="text" name="occupation" :disabled="occupationStatus==='unemployed'" :placeholder="occupationStatus==='unemployed'?'Unemployed':'Enter occupation'" class="finput">
                                <div style="display:flex;gap:10px;margin-top:5px;">
                                    @foreach(['employed'=>'Employed','unemployed'=>'Unemployed','student'=>'Student'] as $v=>$l)
                                    <label style="display:flex;align-items:center;gap:4px;cursor:pointer;font-size:9px;font-weight:700;color:var(--muted);"><input type="radio" x-model="occupationStatus" value="{{ $v }}" style="accent-color:var(--brand);"> {{ $l }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="fgrp"><label class="flbl">Address *</label><input type="text" name="address" required placeholder="House No., Street, Purok, Barangay San Miguel II" class="finput"></div>
                        <div class="fgrp">
                            <label class="flbl">Classifications</label>
                            <div class="classif-grid">
                                @foreach(['is_voter'=>'Voter','is_senior'=>'Senior Citizen','is_pwd'=>'PWD','is_single_parent'=>'Solo Parent','is_student'=>'Student'] as $field=>$label)
                                <label class="classif-lbl"><input type="checkbox" name="{{ $field }}" value="1"><span class="classif-txt">{{ $label }}</span></label>
                                @endforeach
                            </div>
                        </div>
                        <div class="fgrp" x-data="{ otherMembership: false }">
                            <label class="flbl">Memberships</label>
                            <div class="classif-grid" style="margin-bottom:7px;">
                                <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="4Ps"><span class="classif-txt">4Ps</span></label>
                                <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="KDBM"><span class="classif-txt">KDBM</span></label>
                                <label class="classif-lbl"><input type="checkbox" @change="otherMembership = $el.checked"><span class="classif-txt">Others</span></label>
                            </div>
                            <div x-show="otherMembership" x-transition>
                                <input type="text" name="memberships[]" placeholder="Specify other membership..." class="finput">
                            </div>
                        </div>
                        <div class="fgrp">
                            <label class="classif-lbl" style="display:inline-flex;margin-bottom:12px;">
                                <input type="checkbox" name="is_household_head" value="1" x-model="isHouseholdHead"><span class="classif-txt">Is Household Head</span>
                            </label>
                            
                            <div x-show="isHouseholdHead" x-transition style="margin-top:12px;background:#f8fafc;padding:14px;border-radius:11px;border:1px solid var(--border);overflow-x:auto;">
                                <div style="font-size:10px;font-weight:900;color:var(--brand-dark);margin-bottom:9px;text-transform:uppercase;"><i class="fas fa-users"></i> Family Members</div>
                                <template x-for="(fm, idx) in familyMembers" :key="idx">
                                    <div style="display:flex;min-width:max-content;gap:7px;margin-bottom:7px;align-items:end;">
                                        <div style="width:110px;"><label class="flbl" style="font-size:8px;">First Name</label><input type="text" :name="'family_members['+idx+'][first_name]'" x-model="fm.first_name" required class="finput" style="padding:7px;font-size:11px;"></div>
                                        <div style="width:80px;"><label class="flbl" style="font-size:8px;">Middle</label><input type="text" :name="'family_members['+idx+'][middle_name]'" x-model="fm.middle_name" class="finput" style="padding:7px;font-size:11px;"></div>
                                        <div style="width:110px;"><label class="flbl" style="font-size:8px;">Last Name</label><input type="text" :name="'family_members['+idx+'][last_name]'" x-model="fm.last_name" required class="finput" style="padding:7px;font-size:11px;"></div>
                                        <div style="width:50px;"><label class="flbl" style="font-size:8px;">Suffix</label><input type="text" :name="'family_members['+idx+'][suffix]'" x-model="fm.suffix" class="finput" style="padding:7px;font-size:11px;"></div>
                                        <div style="width:90px;"><label class="flbl" style="font-size:8px;">Rel.</label><select :name="'family_members['+idx+'][relationship]'" x-model="fm.relationship" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="">Select</option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Sibling">Sibling</option><option value="Grandma">Grandma</option><option value="Grandpa">Grandpa</option></select></div>
                                        <div style="width:110px;"><label class="flbl" style="font-size:8px;">Birthday</label><input type="date" :name="'family_members['+idx+'][birthday]'" x-model="fm.birthday" required @change="if(fm.birthday){const bd=new Date(fm.birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;fm.age=a;}" class="finput" style="padding:6px;font-size:11px;"></div>
                                        <div style="width:50px;"><label class="flbl" style="font-size:8px;">Age</label><input type="number" :name="'family_members['+idx+'][age]'" x-model="fm.age" required class="finput" style="padding:7px;font-size:11px;"></div>
                                        <div style="width:70px;"><label class="flbl" style="font-size:8px;">Gender</label><select :name="'family_members['+idx+'][gender]'" x-model="fm.gender" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="Male">Male</option><option value="Female">Female</option></select></div>
                                        <div style="width:80px;"><label class="flbl" style="font-size:8px;">Status</label><select :name="'family_members['+idx+'][civil_status]'" x-model="fm.civil_status" required class="finput fselect" style="padding:7px;font-size:11px;"><option value="Single">Single</option><option value="Married">Married</option><option value="Widowed">Widowed</option><option value="Separated">Separated</option></select></div>
                                        <button type="button" @click="familyMembers.splice(idx,1)" class="btn-plain btn-edit" style="width:34px;height:34px;padding:0;justify-content:center;margin-bottom:2px;"><i class="fas fa-trash" style="color:var(--danger);"></i></button>
                                    </div>
                                </template>
                                <button type="button" @click="familyMembers.push({first_name:'',middle_name:'',last_name:'',suffix:'',relationship:'',birthday:'',age:'',gender:'Male',civil_status:'Single'})" class="btn-plain btn-edit" style="font-size:9px;margin-top:6px;"><i class="fas fa-plus"></i> Add Family Member</button>
                            </div>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;padding-top:4px;">
                            <button type="button" @click="openAddModal=false" class="btn-plain btn-edit">Cancel</button>
                            <button type="submit" class="btn-grad"><i class="fas fa-user-plus"></i> Save Resident</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ EDIT RESIDENT MODAL ══ --}}
        <div x-show="openEditModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="openEditModal=false">
                <div class="modal-in">
                    <div class="modal-hd"><div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-user-edit"></i></div> Edit Resident</div><button @click="openEditModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button></div>
                    <form :action="'/office/'+editUser.id" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div style="display:flex;justify-content:center;margin-bottom:18px;">
                            <label style="cursor:pointer;">
                                <div class="photo-up" style="position:relative;">
                                    <img x-show="editPhotoPreview" :src="editPhotoPreview" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;border-radius:11px;">
                                    <div x-show="!editPhotoPreview" style="text-align:center;position:relative;z-index:1;"><i class="fas fa-camera" style="font-size:20px;color:var(--light);display:block;margin-bottom:3px;"></i><span style="font-size:8px;font-weight:700;color:var(--light);text-transform:uppercase;">Change Photo</span></div>
                                </div>
                                <input type="file" name="photo" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f){const reader=new FileReader();reader.onload=function(ev){editPhotoPreview=ev.target.result;};reader.readAsDataURL(f);}">
                            </label>
                        </div>
                        <div style="display:grid;grid-template-columns:2fr 1fr 2fr 1fr;gap:11px;margin-bottom:12px;">
                            <div><label class="flbl">First Name *</label><input type="text" name="first_name" :value="editUser.first_name" required class="finput"></div>
                            <div><label class="flbl">Middle Name</label><input type="text" name="middle_name" :value="editUser.middle_name" class="finput"></div>
                            <div><label class="flbl">Last Name *</label><input type="text" name="last_name" :value="editUser.last_name" required class="finput"></div>
                            <div><label class="flbl">Suffix</label><input type="text" name="suffix" :value="editUser.suffix" placeholder="e.g. Jr" class="finput"></div>
                        </div>
                        <div class="fgrid2 fgrp" x-data="{ editCivilStatus: '' }" x-init="$watch('editUser', val => { editCivilStatus = val.civil_status || '' }); editCivilStatus = editUser.civil_status || ''">
                            <div><label class="flbl">Birthday & Age</label><div style="display:flex;gap:7px;"><input type="date" name="birthday" :value="editUser.birthday" class="finput" style="flex:1;" id="edit-main-birthday" onchange="let bd=new Date(this.value);let t=new Date();let a=t.getFullYear()-bd.getFullYear();let m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;document.getElementById('edit-main-age').value=a;"><input type="number" name="age" :value="editUser.age" id="edit-main-age" placeholder="Age" class="finput" style="width:70px;"></div></div>
                            <div><label class="flbl">Birthplace</label><input type="text" name="birthplace" :value="editUser.birthplace" class="finput"></div>
                            <div><label class="flbl">Gender</label><select name="gender" class="finput fselect"><option value="">Select</option><template x-for="g in ['Male','Female','Other']"><option :value="g" :selected="editUser.gender===g" x-text="g"></option></template></select></div>
                            <div><label class="flbl">Civil Status</label><select name="civil_status" x-model="editCivilStatus" class="finput fselect"><option value="">Select</option><template x-for="s in ['Single','Married','Widowed','Separated']"><option :value="s" :selected="editCivilStatus===s" x-text="s"></option></template></select></div>
                            <div x-show="editCivilStatus === 'Married'" x-transition class="fspan2"><label class="flbl">Spouse / Husband Name</label><input type="text" name="spouse_name" :value="editUser.spouse_name||''" placeholder="Full name of spouse/husband..." class="finput"></div>
                            <div><label class="flbl">Contact No.</label><input type="text" name="contact_number" :value="editUser.contact_number" class="finput"></div>
                            <div><label class="flbl">Occupation</label><input type="text" name="occupation" :value="editUser.occupation" class="finput"></div>
                        </div>
                        <div class="fgrp"><label class="flbl">Address</label><input type="text" name="address" :value="editUser.address" class="finput"></div>
                        <div class="fgrp">
                            <label class="flbl">Classifications</label>
                            <div class="classif-grid">
                                @foreach(['is_voter'=>'Voter','is_senior'=>'Senior Citizen','is_pwd'=>'PWD','is_single_parent'=>'Solo Parent','is_student'=>'Student'] as $field=>$label)
                                <label class="classif-lbl"><input type="checkbox" name="{{ $field }}" value="1" :checked="editUser.{{ $field }}"><span class="classif-txt">{{ $label }}</span></label>
                                @endforeach
                            </div>
                        </div>
                        <div class="fgrp" x-data="{ 
                            is4ps: false, 
                            isKdbm: false, 
                            otherValue: '', 
                            otherMembership: false 
                        }" 
                        x-init="$watch('editUser', val => { 
                            let m = val.memberships || []; 
                            if(typeof m === 'string') { try { m = JSON.parse(m) || []; } catch(e){ m = []; } }
                            is4ps = m.includes('4Ps'); 
                            isKdbm = m.includes('KDBM'); 
                            let others = m.filter(x => x !== '4Ps' && x !== 'KDBM' && x !== '' && x !== null);
                            if(others.length > 0) {
                                otherMembership = true;
                                otherValue = others[0];
                            } else {
                                otherMembership = false;
                                otherValue = '';
                            }
                        })">
                            <label class="flbl">Memberships</label>
                            <div class="classif-grid" style="margin-bottom:7px;">
                                <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="4Ps" x-model="is4ps"><span class="classif-txt">4Ps</span></label>
                                <label class="classif-lbl"><input type="checkbox" name="memberships[]" value="KDBM" x-model="isKdbm"><span class="classif-txt">KDBM</span></label>
                                <label class="classif-lbl"><input type="checkbox" x-model="otherMembership"><span class="classif-txt">Others</span></label>
                            </div>
                            <div x-show="otherMembership" x-transition>
                                <input type="text" name="memberships[]" x-model="otherValue" placeholder="Specify other membership..." class="finput">
                            </div>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:9px;">
                            <button type="button" @click="openEditModal=false" class="btn-plain btn-edit">Cancel</button>
                            <button type="submit" class="btn-grad"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ DIGITAL ID MODAL ══ --}}
        <div x-show="openDigitalId" x-cloak x-transition class="modal-ov" style="z-index:150;">
            <div class="modal-box" style="max-width:600px;" @click.away="openDigitalId=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl"><div class="modal-ttl-ico"><i class="fas fa-id-badge"></i></div><div><div>Digital ID Generator</div><div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Barangay San Miguel II • Residence ID Card</div></div></div>
                        <button @click="openDigitalId=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <div class="section-blk" @click.away="digitalIdOpen=false">
                        <div class="section-blk-ttl"><i class="fas fa-search"></i> Select Resident</div>
                        <div style="position:relative;">
                            <div style="display:flex;align-items:center;background:#fff;border:1.5px solid var(--border);border-radius:9px;padding:9px 13px;gap:7px;">
                                <i class="fas fa-search" style="color:var(--light);font-size:11px;"></i>
                                <input type="text" x-model="digitalIdSearch" @focus="digitalIdOpen=true" @input="digitalIdOpen=true; digitalIdResident=null"
                                       placeholder="Type resident name or code..." autocomplete="off"
                                       style="flex:1;background:transparent;border:none;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;">
                                <button type="button" x-show="digitalIdSearch" @click="digitalIdSearch=''; digitalIdResident=null" style="background:none;border:none;color:var(--light);cursor:pointer;font-size:10px;"><i class="fas fa-times"></i></button>
                            </div>
                            <div x-show="digitalIdOpen && digitalIdSuggestions.length > 0" x-transition class="suggestions-box">
                                <template x-for="r in digitalIdSuggestions" :key="r.id">
                                    <div @click="selectDigitalIdResident(r)" class="sugg-item">
                                        <div style="flex:1;"><div class="sugg-name" x-text="r.name"></div><div class="sugg-meta" x-text="r.code+' • '+(r.address||'No address')"></div></div>
                                        <i class="fas fa-chevron-right" style="color:#ccc;font-size:9px;"></i>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div x-show="digitalIdResident" x-transition>
                        {{-- Emergency contact fields --}}
                        <div class="section-blk">
                            <div class="section-blk-ttl"><i class="fas fa-phone"></i> In Case of Emergency (printed on back of ID)</div>
                            <div class="fgrid2" style="gap:9px;">
                                <div><label class="flbl">Contact Person Name</label><input type="text" x-model="ecName" placeholder="e.g. Maria Dela Cruz" class="finput"></div>
                                <div><label class="flbl">Contact Number</label><input type="text" x-model="ecNum" placeholder="09XXXXXXXXX" class="finput"></div>
                            </div>
                        </div>

                        <div style="display:flex;gap:7px;margin-bottom:14px;justify-content:center;">
                            <button @click="digitalIdCardView='front'" :class="digitalIdCardView==='front'?'btn-grad btn-grad-sm':'btn-plain btn-edit'" class="btn-grad-sm"><i class="fas fa-id-card"></i> Front</button>
                            <button @click="digitalIdCardView='back'; $nextTick(()=>{ if(digitalIdResident) generateQRCode(digitalIdResident.id,digitalIdResident.code) })"
                                    :class="digitalIdCardView==='back'?'btn-grad btn-grad-sm':'btn-plain btn-edit'" class="btn-grad-sm"><i class="fas fa-qrcode"></i> Back</button>
                        </div>

                        {{-- ── ID FRONT: plain white, globe crosshatch pattern, correct logos ── --}}
                        <div x-show="digitalIdCardView==='front'" id="digital-id-front"
                             style="background:#fff;border-radius:12px;overflow:hidden;border:1px solid #ccc;position:relative;font-family:Arial,sans-serif;width:340px;height:214px;margin:0 auto;">
                            {{-- Globe crosshatch lines only (no fill/grain) --}}
                            <div style="position:absolute;inset:0;background:
                                repeating-linear-gradient(0deg,transparent,transparent 19px,rgba(0,0,0,.06) 20px),
                                repeating-linear-gradient(90deg,transparent,transparent 19px,rgba(0,0,0,.06) 20px);
                                pointer-events:none;"></div>
                            {{-- Globe circle lines --}}
                            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:260px;height:260px;border-radius:50%;border:1px solid rgba(0,0,0,.07);pointer-events:none;"></div>
                            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:200px;height:200px;border-radius:50%;border:1px solid rgba(0,0,0,.06);pointer-events:none;"></div>
                            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:140px;height:140px;border-radius:50%;border:1px solid rgba(0,0,0,.05);pointer-events:none;"></div>

                            <div style="position:relative;z-index:1;padding:14px 16px 11px;">
                                {{-- Header: Dasma logo | text | SM2 circle logo --}}
                                <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:6px;">
                                    <img src="{{ asset('images/dasma.png') }}" style="width:40px;height:40px;object-fit:contain;" onerror="this.style.display='none'">
                                    <div style="text-align:center;flex:1;">
                                        <div style="font-size:7px;font-weight:700;color:#333;text-transform:uppercase;letter-spacing:.04em;">REPUBLIC OF THE PHILIPPINES</div>
                                        <div style="font-size:7px;font-weight:700;color:#333;">PROVINCE OF CAVITE</div>
                                        <div style="font-size:7px;font-weight:700;color:#333;">CITY OF DASMARIÑAS</div>
                                        <div style="font-size:14px;font-weight:900;color:#000;text-transform:uppercase;margin-top:2px;letter-spacing:.01em;">BARANGAY SAN MIGUEL 2</div>
                                        <div style="font-size:7px;font-weight:700;color:#555;text-transform:uppercase;letter-spacing:.07em;">RESIDENCE IDENTIFICATION CARD</div>
                                    </div>
                                    <img src="{{ asset('images/circlelogo.png') }}" style="width:40px;height:40px;object-fit:contain;" onerror="this.style.display='none'">
                                </div>
                                <div style="height:2px;background:linear-gradient(90deg,#1a5276,#2980b9,#1a5276);margin-bottom:10px;border-radius:1px;"></div>
                                {{-- Photo + details --}}
                                <div style="display:flex;gap:12px;align-items:flex-start;">
                                    <div style="flex-shrink:0;text-align:center;">
                                        <label style="cursor:pointer;" title="Click to upload photo">
                                            <div style="width:76px;height:86px;border:2px solid #555;border-radius:4px;overflow:hidden;background:#e0e8ee;position:relative;display:flex;align-items:center;justify-content:center;">
                                                <template x-if="digitalIdResident && digitalIdResident.photo">
                                                    <img :src="digitalIdResident.photo" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                                                </template>
                                                <template x-if="!digitalIdResident || !digitalIdResident.photo">
                                                    <img :src="'https://ui-avatars.com/api/?name='+encodeURIComponent((digitalIdResident&&digitalIdResident.name)||'R')+'&background=1a5276&color=fff&size=128&bold=true'" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0;">
                                                </template>
                                                <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.45);padding:2px;text-align:center;"><i class="fas fa-camera" style="color:#fff;font-size:7px;"></i></div>
                                            </div>
                                            <input type="file" accept="image/*" style="display:none;" @change="const f=$event.target.files[0];if(f&&digitalIdResident){const rd=new FileReader();rd.onload=e=>{digitalIdResident={...digitalIdResident,photo:e.target.result}};rd.readAsDataURL(f)}">
                                        </label>
                                        <div style="font-size:6px;font-weight:700;color:#555;text-transform:uppercase;margin-top:3px;">Barangay ID No.</div>
                                        <div style="font-size:6.5px;font-weight:900;color:#000;word-break:break-all;" x-text="digitalIdResident?digitalIdResident.code:''"></div>
                                    </div>
                                    <div style="flex:1;min-width:0;">
                                        <div style="font-size:14px;font-weight:900;color:#000;text-transform:uppercase;line-height:1.2;margin-bottom:8px;word-break:break-word;" x-text="digitalIdResident?digitalIdResident.name.toUpperCase():''"></div>
                                        <div style="font-size:7px;font-weight:700;color:#666;text-transform:uppercase;letter-spacing:.05em;margin-bottom:1px;">Address:</div>
                                        <div style="font-size:9px;font-weight:700;color:#000;line-height:1.3;margin-bottom:6px;word-break:break-word;" x-text="digitalIdResident?(digitalIdResident.address||'Barangay San Miguel II, Dasmariñas, Cavite'):''"></div>
                                        <div style="font-size:7px;font-weight:700;color:#666;text-transform:uppercase;letter-spacing:.05em;margin-bottom:1px;">Date of Birth:</div>
                                        <div style="font-size:11px;font-weight:900;color:#000;margin-bottom:6px;text-transform:uppercase;" x-text="digitalIdResident&&digitalIdResident.birthday?new Date(digitalIdResident.birthday).toLocaleDateString('en-PH',{year:'numeric',month:'long',day:'numeric'}).toUpperCase():'N/A'"></div>
                                        <div style="display:flex;gap:14px;">
                                            <div><div style="font-size:6.5px;font-weight:700;color:#666;letter-spacing:.07em;text-transform:uppercase;">Date Issue</div><div style="font-size:8px;font-weight:900;color:#000;" x-text="digitalIdIssueDate"></div></div>
                                            <div><div style="font-size:6.5px;font-weight:700;color:#666;letter-spacing:.07em;text-transform:uppercase;">Valid Until</div><div style="font-size:8px;font-weight:900;color:#000;" x-text="digitalIdValidUntil"></div></div>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top:8px;border-top:1px solid #bbb;padding-top:4px;display:flex;justify-content:space-between;align-items:flex-end;">
                                    <div>
                                        <div style="font-size:6.5px;color:#666;text-transform:uppercase;">Signature</div>
                                        <div style="height:14px;border-bottom:1px solid #333;width:110px;margin-top:4px;"></div>
                                    </div>
                                    <div style="text-align:center;">
                                        <div style="height:16px;"></div>
                                        <div style="border-top:1.5px solid #000;padding-top:2px;min-width:130px;">
                                            <div style="font-size:7px;font-weight:900;text-transform:uppercase;color:#000;">HON. MARVIN M. BENIS</div>
                                            <div style="font-size:6.5px;font-style:italic;color:#333;">Punong Barangay</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ── ID BACK: plain white, big watermark logo ── --}}
                        <div x-show="digitalIdCardView==='back'" id="digital-id-back"
                             style="background:#fff;border-radius:12px;overflow:hidden;border:1px solid #ccc;position:relative;font-family:Arial,sans-serif;width:340px;height:214px;margin:0 auto;">
                            {{-- Big watermark --}}
                            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:.15;pointer-events:none;">
                                <img src="{{ asset('images/brgysm2_logo.png') }}" style="width:240px;height:240px;object-fit:contain;" onerror="">
                            </div>
                            <div style="position:relative;z-index:1;padding:14px 16px;">
                                <div style="border:2px solid #222;border-radius:6px;padding:8px 12px;margin-bottom:10px;background:rgba(255,255,255,.88);text-align:center;">
                                    <div style="font-size:7px;font-weight:700;color:#444;text-transform:uppercase;margin-bottom:4px;">— CONTACT PERSON IN CASE OF EMERGENCY —</div>
                                    <div style="font-size:13px;font-weight:900;color:#000;" x-text="(ecName || '___________________________').toUpperCase()"></div>
                                    <div style="font-size:9px;color:#444;margin-top:2px;">CONTACT NO: <span x-text="ecNum || '_______________'"></span></div>
                                </div>
                                <div style="display:flex;gap:12px;align-items:flex-start;">
                                    <div style="flex:1;min-width:0;">
                                        <div style="font-size:8px;font-weight:900;color:#000;margin-bottom:3px;">THIS CARD IS NON-TRANSFERABLE</div>
                                        <div style="font-size:7px;color:#444;line-height:1.5;margin-bottom:5px;">THE CARD HOLDER IS A BONAFIDE RESIDENT OF THIS BARANGAY. IF THIS ID IS FOUND, KINDLY RETURN TO THE BARANGAY SECRETARIAT.</div>
                                        <div style="font-size:8px;font-weight:700;color:#000;margin-bottom:2px;">NOTE:</div>
                                        <div style="font-size:7px;color:#444;line-height:1.5;padding-left:8px;">THIS CARD IS VALID IF SIGNED BY THE BARANGAY CHAIRMAN. LOSS OF THIS CARD MUST BE REPORTED IMMEDIATELY TO THE BARANGAY HALL.</div>
                                    </div>
                                    <div style="flex-shrink:0;text-align:center;">
                                        <div style="width:76px;height:76px;background:white;border:1px solid #ccc;border-radius:4px;padding:2px;display:flex;align-items:center;justify-content:center;">
                                            <canvas id="qr-main-canvas" width="70" height="70" style="display:block;"></canvas>
                                        </div>
                                        <div style="font-size:5.5px;color:#888;margin-top:2px;word-break:break-all;" x-text="digitalIdResident?digitalIdResident.code:''"></div>
                                    </div>
                                </div>
                                <div style="margin-top:8px;">
                                    <div style="height:18px;"></div>
                                    <div style="border-top:2px solid #000;display:inline-block;min-width:150px;padding-top:3px;">
                                        <div style="font-size:8px;font-weight:900;text-transform:uppercase;color:#000;">HON. MARVIN M. BENIS</div>
                                        <div style="font-size:7px;font-style:italic;color:#333;">PUNONG BARANGAY</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:9px;margin-top:14px;">
                            <button @click="openDigitalId=false" class="btn-plain btn-edit">Cancel</button>
                            <button @click="printDigitalId(digitalIdResident)" class="btn-grad"><i class="fas fa-print"></i> Print ID</button>
                        </div>
                    </div>

                    <div x-show="!digitalIdResident" class="empty-st">
                        <i class="fas fa-id-badge" style="font-size:38px;"></i>
                        <p style="font-size:13px;font-weight:700;color:var(--muted);">Search for a resident above to generate their Digital ID</p>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /x-data --}}

    <footer style="text-align:center;padding:18px;font-size:10px;color:var(--light);font-weight:600;">
        © {{ date('Y') }} Barangay SM2 Management System. All rights reserved.
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
    function generateQRCode(residentId,residentCode){
        if(!residentCode) return;
        const canvas=document.getElementById('qr-main-canvas');
        if(!canvas) return;
        const ctx=canvas.getContext('2d'),size=70;
        canvas.width=size; canvas.height=size;
        ctx.fillStyle='#ffffff'; ctx.fillRect(0,0,size,size);
        const url=window.location.origin+'/verify-id/'+residentCode;
        try{
            const qr=qrcode(0,'M'); qr.addData(url); qr.make();
            const mc=qr.getModuleCount(),cs=Math.floor(size/mc),mg=Math.floor((size-cs*mc)/2);
            ctx.fillStyle='#000000';
            for(let r=0;r<mc;r++) for(let c=0;c<mc;c++) if(qr.isDark(r,c)) ctx.fillRect(mg+c*cs,mg+r*cs,cs,cs);
        }catch(e){ console.warn('QR error',e); }
    }
    function printDigitalId(resident){
        if(!resident) return;
        generateQRCode(resident.id,resident.code);
        setTimeout(()=>{
            const front=document.getElementById('digital-id-front');
            const back=document.getElementById('digital-id-back');
            if(!front||!back) return;
            let backHtml=back.outerHTML;
            const canvas=document.getElementById('qr-main-canvas');
            if(canvas){ const src=canvas.toDataURL('image/png'); backHtml=backHtml.replace(/<canvas[^>]*id="qr-main-canvas"[^>]*>[\s\S]*?<\/canvas>/,`<img src="${src}" style="width:70px;height:70px;display:block;">`); }
            const win=window.open('','_blank');
            win.document.write(`<!DOCTYPE html><html><head><title>ID - ${resident.name}</title>
            <style>*{box-sizing:border-box;margin:0;padding:0;}html,body{background:white;font-family:Arial,sans-serif; -webkit-print-color-adjust:exact;}
            @page { size: portrait; margin: 15mm; }
            body { display: flex; flex-direction: column; align-items: center; justify-content: flex-start; gap: 12mm; padding: 20px; }
            .cw { display: inline-block; width: max-content; max-width: 100%; }
            .cw > div { border: 2px dashed #444 !important; border-radius: 4px !important; margin: 0 auto !important; box-shadow: none !important; display: block !important; }
            img{max-width:100%;}</style></head><body>
            <div class="cw">${front.outerHTML}</div><div class="cw">${backHtml}</div>
            <script>window.onload=function(){setTimeout(()=>window.print(),500)};<\/script></body></html>`);
            win.document.close();
        },200);
    }
    function printDoc(elementId){
        const el=document.getElementById(elementId);
        if(!el) return;
        const win=window.open('','_blank');
        win.document.write(`<!DOCTYPE html><html><head><title></title>
        <style>@page{size:A4 portrait;margin:15mm 18mm 10mm 18mm;}html{-webkit-print-color-adjust:exact;}*{box-sizing:border-box;}html,body{margin:0;padding:0;width:100%;}body{font-family:'Times New Roman',serif;font-size:11pt;color:#000;padding-top:6mm;}p{margin:2px 0;line-height:1.45;}strong{font-weight:bold;}img{display:inline-block;}</style></head><body>${el.innerHTML}</body></html>`);
        win.document.close();
        setTimeout(()=>{ win.print(); },700);
    }
    </script>

</x-app-layout>
