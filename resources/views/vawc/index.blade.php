<x-app-layout>
<style>
:root{
    --brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;
    --body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;
    --success:#059669;--warn:#d97706;--danger:#dc2626;
    --card-shadow:0 4px 24px rgba(4,25,45,0.10),0 1.5px 6px rgba(0,0,0,0.05);
    --btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);
    --vawc:#7c3aed;--vawc-dark:#5b21b6;
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

.portal-wrap{max-width:1240px;margin:0 auto;padding:24px 18px 60px;}

/* HERO */
.hero{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);border-radius:16px;padding:26px 28px 22px;margin-bottom:22px;position:relative;overflow:hidden;box-shadow:var(--card-shadow);}
.hero-bg-ico{position:absolute;right:-20px;bottom:-20px;font-size:160px;color:rgba(255,255,255,.05);line-height:1;pointer-events:none;}
.hero-tag{font-size:9px;font-weight:900;background:rgba(124,58,237,.25);color:#c4b5fd;padding:4px 12px;border-radius:99px;text-transform:uppercase;letter-spacing:.08em;display:inline-block;margin-bottom:12px;border:1px solid rgba(124,58,237,.3);}
.hero-title{font-size:22px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.2;margin-bottom:8px;}
.hero-desc{font-size:12px;color:rgba(255,255,255,.65);font-weight:600;max-width:560px;line-height:1.6;}
.hero-stats{display:flex;gap:12px;margin-top:20px;flex-wrap:wrap;}
.hstat{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:11px;padding:10px 14px;text-align:center;min-width:70px;}
.hstat-n{font-size:20px;font-weight:900;color:#fff;line-height:1;}
.hstat-l{font-size:8px;font-weight:700;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.07em;margin-top:3px;}

/* CONFIDENTIAL BANNER — RESPONSIVE */
.conf-banner{background:linear-gradient(135deg,#3b0764 0%,#4c1d95 60%,#6d28d9 100%);border-radius:14px;padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:20px;border:1px solid rgba(196,181,253,.2);box-shadow:0 4px 16px rgba(91,33,182,.18);flex-wrap:wrap;}
.conf-banner-content{display:flex;align-items:center;gap:14px;flex:1;min-width:260px;}
.conf-ico{width:42px;height:42px;border-radius:11px;background:rgba(255,255,255,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid rgba(255,255,255,.2);}
.conf-ico i{color:#e9d5ff;font-size:18px;}
.conf-text{font-size:11.5px;color:rgba(255,255,255,.85);font-weight:600;line-height:1.5;}
.conf-text strong{color:#fff;}
.conf-btn{background:rgba(255,255,255,.18);border:1.5px solid rgba(255,255,255,.35);color:#fff;font-family:inherit;font-size:10px;font-weight:900;text-transform:uppercase;letter-spacing:.05em;padding:9px 18px;border-radius:9px;cursor:pointer;white-space:nowrap;transition:all .18s;display:inline-flex;align-items:center;gap:8px;box-shadow:0 2px 8px rgba(0,0,0,.15);flex-shrink:0;}
.conf-btn:hover{background:rgba(255,255,255,.28);border-color:#fff;transform:translateY(-1px);box-shadow:0 4px 12px rgba(0,0,0,.25);}

/* ACTION GRID */
.action-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:22px;}
@media(max-width:960px){.action-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:540px){.action-grid{grid-template-columns:1fr;}}
.action-card{background:#fff;border:2px solid var(--border);border-radius:14px;padding:18px 14px 16px;text-align:center;cursor:pointer;transition:all .2s;}
.action-card:hover{border-color:var(--vawc);transform:translateY(-3px);box-shadow:0 8px 24px rgba(124,58,237,.15);}
.action-card.active{border-color:var(--vawc);background:#faf5ff;}
.ac-ico{width:46px;height:46px;border-radius:13px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;transition:all .2s;}
.ac-ico i{font-size:19px;}
.action-card:hover .ac-ico{transform:scale(1.08);}
.ac-name{font-size:10.5px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.04em;line-height:1.3;}
.ac-sub{font-size:9px;color:var(--muted);font-weight:600;margin-top:4px;}

/* CARDS */
.card{background:#fff;border-radius:14px;box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.05);overflow:hidden;margin-bottom:18px;}
.card-head{padding:14px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
.card-title{font-size:10.5px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.09em;display:flex;align-items:center;gap:7px;}
.card-title i{color:var(--vawc);}
.cbadge{font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;}
.cbadge-blue{background:#eff6ff;color:var(--brand);}
.cbadge-red{background:#fee2e2;color:#dc2626;}
.cbadge-vawc{background:#f5f3ff;color:#7c3aed;border:1px solid #ede9fe;}

/* FILTER BAR */
.filter-bar{background:linear-gradient(100deg,#000052 0%,#04192D 60%,#0E5393 100%);border-radius:11px;padding:10px 14px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:14px;}
.filter-bar input,.filter-bar select{background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);color:#fff;border-radius:8px;padding:7px 10px;font-family:inherit;font-size:10px;font-weight:700;outline:none;transition:all .15s;}
.filter-bar input::placeholder{color:rgba(255,255,255,.5);}
.filter-bar select option{background:#04192D;color:#fff;}
.filter-bar input:focus,.filter-bar select:focus{border-color:rgba(255,255,255,.7);background:rgba(255,255,255,.2);}
.filter-search{display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.25);border-radius:8px;padding:6px 10px;flex:1;min-width:160px;}
.filter-search input{background:transparent;border:none;color:#fff;font-family:inherit;font-size:10px;font-weight:700;outline:none;width:100%;}

/* TABLE */
.tbl{width:100%;border-collapse:collapse;}
.tbl thead tr{background:#f8fafc;}
.tbl th{padding:11px 14px;font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;text-align:left;}
.tbl tbody tr{border-bottom:1px solid #f8fafc;transition:background .1s;}
.tbl tbody tr:last-child{border-bottom:none;}
.tbl tbody tr:hover{background:#fafbfc;}
.tbl td{padding:11px 14px;vertical-align:middle;font-size:12px;}
.tbl-empty{padding:40px;text-align:center;color:var(--light);}
.tbl-empty i{font-size:28px;display:block;margin-bottom:8px;opacity:.25;}

.spill{font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;text-transform:uppercase;display:inline-flex;align-items:center;gap:4px;white-space:nowrap;}
.spill-new{background:#fee2e2;color:#dc2626;}
.spill-active{background:#dbeafe;color:#1d4ed8;}
.spill-settled{background:#dcfce7;color:#15803d;}
.spill-urgent{background:#fce7f3;color:#be185d;}
.spill-pending{background:#fef3c7;color:#a16207;}

/* ACTION BUTTONS GROUP & LAYOUT FIX */
.action-btn-group{display:inline-flex;align-items:center;gap:5px;justify-content:flex-end;white-space:nowrap;}
.btn-action-icon{width:32px;height:32px;border-radius:8px;border:1px solid transparent;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:11.5px;transition:all .18s;flex-shrink:0;text-decoration:none;}
.btn-action-icon:hover{transform:translateY(-1.5px);box-shadow:0 3px 8px rgba(0,0,0,.12);}
.btn-action-view{background:#f5f3ff;color:#7c3aed;border-color:#ede9fe;}
.btn-action-view:hover{background:#7c3aed;color:#fff;}
.btn-action-reroute{background:#eff6ff;color:#2563eb;border-color:#dbeafe;}
.btn-action-reroute:hover{background:#2563eb;color:#fff;}
.btn-action-escalate{background:#fef2f2;color:#dc2626;border-color:#fecaca;}
.btn-action-escalate:hover{background:#dc2626;color:#fff;}
.btn-action-pdf{background:#fff1f2;color:#e11d48;border-color:#ffe4e6;}
.btn-action-pdf:hover{background:#e11d48;color:#fff;}

/* BTN */
.btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;font-family:inherit;font-size:10px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:9px;cursor:pointer;transition:all .18s;white-space:nowrap;}
.btn-primary{background:var(--btn-grad);color:#fff;box-shadow:0 2px 8px rgba(0,0,82,.25);}
.btn-primary:hover{transform:translateY(-1px);}
.btn-vawc{background:linear-gradient(135deg,#7c3aed,#4c1d95);color:#fff;box-shadow:0 2px 8px rgba(124,58,237,.3);}
.btn-vawc:hover{transform:translateY(-1px);box-shadow:0 4px 12px rgba(124,58,237,.4);}
.btn-ghost{background:#f1f5f9;color:#475569;}
.btn-ghost:hover{background:#e2e8f0;color:#0f172a;}
.btn-sm{padding:5px 10px;font-size:9px;}

/* MODALS */
.modal-ov{position:fixed;inset:0;z-index:999;display:flex;align-items:center;justify-content:center;padding:14px;background:rgba(0,0,18,.70);backdrop-filter:blur(5px);}
.modal-box{background:#fff;width:100%;max-width:580px;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,52,.35);border-bottom:5px solid var(--vawc);max-height:94vh;overflow-y:auto;}
.modal-in{padding:22px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:13px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:13px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:8px;}
.modal-ico{width:32px;height:32px;border-radius:8px;background:#f5f3ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.modal-ico i{color:var(--vawc);font-size:13px;}
.modal-close{background:none;border:none;color:var(--light);font-size:19px;cursor:pointer;line-height:1;flex-shrink:0;transition:color .15s;}
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

/* AUDIT LOG LIST */
.audit-item{background:#fff;border:1px solid var(--border);border-radius:10px;padding:12px 14px;margin-bottom:10px;display:flex;gap:12px;align-items:flex-start;transition:all .15s;}
.audit-item:hover{border-color:#c4b5fd;background:#faf5ff;}
.audit-ico{width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:14px;}

/* REFERRAL PREVIEW SHEET INSIDE MODAL */
.referral-preview-sheet{background:#fff;border:1px solid #cbd5e1;border-radius:8px;padding:24px 28px;box-shadow:0 4px 16px rgba(0,0,0,0.06);font-family:'Times New Roman',serif;color:#0f172a;}
.ref-head{text-align:center;border-bottom:2px solid #000;padding-bottom:10px;margin-bottom:16px;display:flex;align-items:center;justify-content:center;gap:14px;}
.ref-head h1{font-size:14px;margin:3px 0 0 0;font-weight:bold;text-transform:uppercase;}
.ref-head h2{font-size:11.5px;margin:0;font-weight:normal;}
.ref-title{text-align:center;font-size:14px;font-weight:bold;text-decoration:underline;text-transform:uppercase;margin:12px 0 14px;}
.ref-row{display:flex;margin-bottom:6px;font-size:12px;}
.ref-col-lbl{width:160px;font-weight:bold;font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;text-transform:uppercase;color:#475569;}
.ref-col-val{flex:1;border-bottom:1px dotted #94a3b8;padding-bottom:2px;font-size:12.5px;}
.ref-sect{margin:14px 0 6px;text-decoration:underline;font-size:12px;font-weight:bold;text-transform:uppercase;font-family:'Plus Jakarta Sans',sans-serif;color:#1e293b;}
.ref-box{border:1px solid #94a3b8;padding:10px 12px;margin-top:4px;min-height:80px;font-size:12px;line-height:1.5;background:#fafbfc;}

@media(max-width:768px){
    .action-grid{grid-template-columns:repeat(2,1fr);}
    .hero-stats{gap:8px;}
    .hero{padding:18px 14px 16px;}
    .hero-title{font-size:16px;}
    .conf-banner{flex-direction:column;align-items:stretch;}
    .conf-banner-content{min-width:100%;}
    .conf-btn{width:100%;text-align:center;justify-content:center;}
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
    .hstat{min-width:56px;padding:8px 10px;}
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

    @if(session('error'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,5000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         style="position:fixed;top:16px;right:16px;z-index:9999;background:#dc2626;color:#fff;padding:11px 18px;border-radius:11px;box-shadow:var(--card-shadow);font-weight:800;font-size:12px;display:flex;align-items:center;gap:7px;">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    <div class="portal-wrap" x-data="{
        activeTab: localStorage.getItem('brgy_vawc_tab') || 'cases',
        viewModal: false,
        newIncidentModal: false,
        importModal: false,
        rejectModal: false,
        exportModal: false,
        auditModal: false,
        rerouteModal: false,
        referralPreviewModal: false,
        isEditingReferral: false,
        uploadPanelOpen: false,
        isUploadingDoc: false,
        templateUploadModal: false,
        docViewMode: 'form',
        exportPeriod: 'all',
        exportType: 'all',
        auditSearch: '',
        activeIssue: null,
        rerouteData: { id: null, case_code: '', complainant: '', reason: '' },
        rejectFormData: { id: null, reason: '' },
        vawcRep: {
            province: 'Cavite',
            city: 'Dasmariñas',
            barangay: 'San Miguel 2',
            monthYear: '{{ strtoupper(now()->format('F Y')) }}',
            hasDesk: 'YES',
            gadFund: '70,500.00',
            bcpcFund: '52,194.00',
            hasLogbook: 'Yes',
            casesHandled: {{ $issues->count() }},
            physicalAbuse: {{ $issues->where('issue_type', 'VAWC – Physical Abuse')->count() }},
            economicAbuse: {{ $issues->where('issue_type', 'VAWC – Economic Abuse')->count() }},
            sexualAbuse: {{ $issues->where('issue_type', 'VAWC – Sexual Harassment')->count() }},
            psychologicalAbuse: {{ $issues->where('issue_type', 'VAWC – Psychological Abuse')->count() }},
            get totalVictims() {
                return (Number(this.physicalAbuse)||0) + (Number(this.economicAbuse)||0) + (Number(this.sexualAbuse)||0) + (Number(this.psychologicalAbuse)||0);
            },
            refPnp: {{ $issues->where('status', 'referred_to_pnp')->count() }},
            refCourt: 0,
            issuedBpos: 0,
            refMedical: 0,
            get totalActed() {
                return (Number(this.refPnp)||0) + (Number(this.refCourt)||0) + (Number(this.issuedBpos)||0) + (Number(this.refMedical)||0);
            },
            preparedBy: 'MA. TERESA L. CALAWIN',
            preparedRole: 'VAWC Desk Officer',
            notedBy: 'MARVIN M. BENIS',
            notedRole: 'Punong Barangay'
        },
        previewData: {
            id: null,
            case_code: '',
            issue_type: '',
            status: '',
            incident_date: '',
            location: '',
            complainant_name: '',
            complainant_age: '',
            complainant_gender: '',
            complainant_address: '',
            contact: '',
            is_on_behalf: false,
            victim_name: '',
            victim_age: '',
            victim_gender: '',
            victim_relationship: '',
            respondent_name: '',
            respondent_address: '',
            admin_summary: '',
            description: '',
            admin_notes: '',
            official_document: null,
            official_document_name: null,
            official_document_url: null,
            created_at: ''
        },
        openView(issue) {
            this.activeIssue = issue;
            this.viewModal = true;
        },
        openReject(id) {
            this.rejectFormData.id = id;
            this.rejectFormData.reason = '';
            this.rejectModal = true;
        },
        openReroute(issue) {
            this.rerouteData.id = issue.id;
            this.rerouteData.case_code = issue.case_code;
            this.rerouteData.complainant = issue.complainant_name;
            this.rerouteData.reason = '';
            this.rerouteModal = true;
        },
        openReferralPreview(issue) {
            this.previewData = Object.assign({}, issue);
            this.isEditingReferral = false;
            this.uploadPanelOpen = false;
            this.docViewMode = issue.official_document ? 'scan' : 'form';
            this.referralPreviewModal = true;
        },
        saveReferralEdits() {
            const form = document.getElementById('referral-edit-form');
            const formData = new FormData(form);
            fetch('/vawc/issues/' + this.previewData.id + '/referral-details', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    this.previewData.admin_notes = formData.get('admin_notes');
                    this.previewData.admin_summary = formData.get('admin_summary');
                    this.previewData.location = formData.get('location');
                    this.previewData.contact = formData.get('contact');
                    this.isEditingReferral = false;
                    alert('Referral details saved securely and logged into Privacy Audit.');
                }
            })
            .catch(err => {
                form.submit();
            });
        },
        uploadDocFile() {
            const fileInput = this.$refs.officialDocFileInput;
            if (!fileInput.files.length) {
                alert('Please select a file to upload.');
                return;
            }
            this.isUploadingDoc = true;
            const formData = new FormData();
            formData.append('document_file', fileInput.files[0]);

            fetch('/vawc/issues/' + this.previewData.id + '/upload-document', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                this.isUploadingDoc = false;
                if(data.success) {
                    this.previewData.official_document = data.file_url;
                    this.previewData.official_document_name = data.file_name;
                    this.previewData.official_document_url = data.file_url;
                    this.uploadPanelOpen = false;
                    this.docViewMode = 'scan';
                    fileInput.value = '';
                    alert('Official document scan uploaded successfully!');
                } else {
                    alert(data.message || 'Upload failed.');
                }
            })
            .catch(err => {
                this.isUploadingDoc = false;
                alert('An error occurred while uploading. Please check file format (PDF, JPG, PNG) and try again.');
            });
        },
        removeDocFile() {
            if(!confirm('Are you sure you want to remove this attached official document scan?')) return;
            fetch('/vawc/issues/' + this.previewData.id + '/remove-document', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    this.previewData.official_document = null;
                    this.previewData.official_document_name = null;
                    this.previewData.official_document_url = null;
                    this.docViewMode = 'form';
                    alert('Official document removed.');
                }
            })
            .catch(err => {
                alert('Failed to remove document.');
            });
        },
        printReferralPreview() {
            printReferralPreviewHelper(this.docViewMode, this.previewData.official_document_url, this.previewData.case_code);
        },
        printVawcReport() {
            printVawcReportHelper();
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
        },
        highlightVawcCase(caseId) {
            if (!caseId) return;
            this.activeTab = 'cases';
            this.$nextTick(() => {
                const row = document.getElementById('vawc-row-' + caseId);
                if (row) {
                    row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    row.style.background = '#faf5ff';
                    row.style.outline = '2.5px solid #7c3aed';
                    row.style.boxShadow = '0 0 16px rgba(124,58,237,0.3)';
                    setTimeout(() => {
                        row.style.background = '';
                        row.style.outline = '';
                        row.style.boxShadow = '';
                    }, 3500);
                }
            });
        },
        init() {
            this.$watch('activeTab', value => localStorage.setItem('brgy_vawc_tab', value));
        }
    }">

        {{-- CONFIDENTIALITY BANNER (RESPONSIVE & CLICKABLE PRIVACY AUDIT) --}}
        <div class="conf-banner">
            <div class="conf-banner-content">
                <div class="conf-ico"><i class="fas fa-user-secret"></i></div>
                <div class="conf-text">
                    <strong>Strict Confidentiality Enforced</strong><br>
                    Unauthorized access or disclosure of VAWC records is strictly prohibited under <strong>Republic Act No. 9262</strong>. All activity is permanently logged for audit.
                </div>
            </div>
            <button type="button" @click="auditModal = true" class="conf-btn">
                <i class="fas fa-clipboard-check"></i> Privacy Audit Trail
            </button>
        </div>

        {{-- HERO --}}
        <div class="hero">
            <i class="fas fa-hand-holding-heart hero-bg-ico"></i>
            <div class="hero-tag"><i class="fas fa-shield-alt" style="margin-right:5px;"></i> VAWC Management System</div>
            <div class="hero-title">Protection for Women & Children</div>
            <div class="hero-desc">Confidential case monitoring, victim-centered assistance, and emergency PNP/DSWD referrals. All records are handled in strict compliance with RA 9262.</div>
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
                <div class="ac-sub">Emergency escalation & PDF</div>
            </div>
            <div class="action-card" @click="activeTab='audit'" :class="activeTab==='audit'?'active':''">
                <div class="ac-ico" style="background:#dcfce7;"><i class="fas fa-clipboard-check" style="color:#15803d;"></i></div>
                <div class="ac-name">Resolved Archive</div>
                <div class="ac-sub">Closed cases history</div>
            </div>
            <div class="action-card" @click="activeTab='reports'" :class="activeTab==='reports'?'active':''">
                <div class="ac-ico" style="background:#eff6ff;"><i class="fas fa-file-invoice" style="color:#2563eb;"></i></div>
                <div class="ac-name">Compliance Reports</div>
                <div class="ac-sub">RA 9262 matrix & send</div>
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
                        <div style="width:1px;height:14px;background:var(--border);margin:0 4px;"></div>
                        {{-- EXPORT BUTTON OPENS MODAL (NO DIRECT DOWNLOAD) --}}
                        <button type="button" @click="exportModal=true" class="btn btn-ghost btn-sm" style="display:inline-flex;align-items:center;gap:5px;">
                            <i class="fas fa-file-export"></i> Export
                        </button>
                        <button type="button" class="btn btn-ghost btn-sm" @click="importModal=true" style="display:inline-flex;align-items:center;gap:5px;">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                        <button @click="newIncidentModal=true" class="btn btn-vawc btn-sm">
                            <i class="fas fa-plus"></i> New Incident
                        </button>
                    </div>
                </div>

                {{-- FILTER BAR --}}
                <div style="padding:12px 18px 0;">
                    <form id="filter-form" action="{{ route('vawc.dashboard') }}" method="GET" @submit.prevent="fetchFilters()">
                        <div class="filter-bar">
                            <div class="filter-search">
                                <i class="fas fa-search" style="color:rgba(255,255,255,.5);font-size:10px;flex-shrink:0;"></i>
                                <input type="text" name="search" value="{{ request('search') }}" @input.debounce.500ms="fetchFilters()" placeholder="Search name, victim, or ID..." autocomplete="off">
                            </div>
                            <input type="date" name="date" value="{{ request('date') }}" @change="fetchFilters()"
                                   title="Filter by date filed"
                                   style="min-width:120px;">
                            @php 
                                $vawcCaseTypesList = [
                                    'VAWC – Domestic Violence',
                                    'VAWC – Physical Abuse',
                                    'VAWC – Sexual Harassment',
                                    'VAWC – Child Abuse',
                                    'VAWC – Economic Abuse',
                                    'VAWC – Psychological Abuse',
                                    'VAWC – Stalking / Harassment',
                                    'Others'
                                ];
                            @endphp
                            <select name="issue_type_filter" @change="fetchFilters()">
                                <option value="">All Case Types</option>
                                @foreach($vawcCaseTypesList as $ct)
                                <option value="{{ $ct }}" {{ request('issue_type_filter') == $ct ? 'selected' : '' }}>{{ $ct }}</option>
                                @endforeach
                            </select>
                            <select name="status_filter" @change="fetchFilters()">
                                <option value="">All Statuses</option>
                                <option value="submitted"       {{ request('status_filter')==='submitted'       ?'selected':'' }}>New / Submitted</option>
                                <option value="under_review"    {{ request('status_filter')==='under_review'    ?'selected':'' }}>Under Review</option>
                                <option value="pending"         {{ request('status_filter')==='pending'         ?'selected':'' }}>Pending</option>
                                <option value="on_going"        {{ request('status_filter')==='on_going'        ?'selected':'' }}>On-going</option>
                                <option value="referred_to_pnp" {{ request('status_filter')==='referred_to_pnp' ?'selected':'' }}>Referred to PNP</option>
                                <option value="urgent"          {{ request('status_filter')==='urgent'          ?'selected':'' }}>Urgent Rescue</option>
                                <option value="approved"        {{ request('status_filter')==='approved'        ?'selected':'' }}>Approved</option>
                                <option value="settled"         {{ request('status_filter')==='settled'         ?'selected':'' }}>Resolved</option>
                                <option value="rejected"        {{ request('status_filter')==='rejected'        ?'selected':'' }}>Rejected</option>
                            </select>

                            {{-- NOTIFICATION BELL: Case Activity & Status Changes --}}
                            <div class="relative" x-data="{ vawcNotifOpen: false }" @click.away="vawcNotifOpen = false" style="display:inline-flex;align-items:center;margin-left:auto;">
                                <button type="button" @click="vawcNotifOpen = !vawcNotifOpen" 
                                        style="width:34px; height:34px; background:rgba(255,255,255,0.15); border:1.5px solid rgba(255,255,255,0.3); border-radius:8px; color:#fff; display:flex; align-items:center; justify-content:center; cursor:pointer; position:relative; transition:all .15s;"
                                        onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                                        onmouseout="this.style.background='rgba(255,255,255,0.15)'"
                                        title="Case Activity & Status Updates">
                                    <i class="fas fa-bell" style="font-size:13px;"></i>
                                    @if(($auditLogs ?? collect())->count() > 0)
                                    <span style="position:absolute; top:-4px; right:-4px; background:#ef4444; color:#fff; font-size:8px; font-weight:900; min-width:16px; height:16px; border-radius:99px; display:flex; align-items:center; justify-content:center; padding:0 3px; border:1.5px solid #000052; box-shadow:0 2px 5px rgba(0,0,0,0.3);">
                                        {{ ($auditLogs ?? collect())->count() > 99 ? '99+' : ($auditLogs ?? collect())->count() }}
                                    </span>
                                    @endif
                                </button>

                                {{-- Activity Dropdown Menu --}}
                                <div x-show="vawcNotifOpen" x-cloak x-transition
                                     style="position:absolute; right:0; top:calc(100% + 8px); width:320px; background:#fff; border-radius:12px; box-shadow:0 10px 40px rgba(0,0,0,0.2); border:1px solid var(--border); z-index:999; text-align:left; color:#0f172a; overflow:hidden;">
                                    <div style="padding:10px 14px; background:#f8fafc; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between;">
                                        <span style="font-size:10px; font-weight:900; text-transform:uppercase; letter-spacing:.05em; color:var(--vawc); display:flex; align-items:center; gap:6px;">
                                            <i class="fas fa-bell"></i> Case Activity & Updates
                                        </span>
                                        <span style="font-size:8px; font-weight:700; color:var(--muted);">Recent Logs</span>
                                    </div>
                                    <div style="max-height:280px; overflow-y:auto;">
                                        @forelse(($auditLogs ?? collect())->take(20) as $log)
                                        <div @click="vawcNotifOpen = false; highlightVawcCase({{ $log->case_id }})" 
                                             style="padding:10px 14px; border-bottom:1px solid #f1f5f9; display:flex; align-items:flex-start; gap:10px; cursor:pointer; transition:background .15s;"
                                             onmouseover="this.style.background='#faf5ff'" onmouseout="this.style.background='#fff'">
                                            <div style="width:28px; height:28px; border-radius:7px; background:#f5f3ff; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;">
                                                <i class="fas {{ $log->action === 'status_update' ? 'fa-exchange-alt' : ($log->action === 'incident_created' ? 'fa-folder-plus' : 'fa-info-circle') }}" style="color:#7c3aed; font-size:10px;"></i>
                                            </div>
                                            <div style="flex:1; min-width:0;">
                                                <div style="display:flex; align-items:center; justify-content:space-between; gap:6px;">
                                                    <span style="font-size:10px; font-weight:900; color:#7c3aed;">#{{ $log->case_code ?? ('VAWC-'.$log->case_id) }}</span>
                                                    <span style="font-size:8px; color:var(--light); font-weight:600;">{{ $log->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div style="font-size:10px; color:var(--text); font-weight:600; line-height:1.3; margin-top:2px;">{{ $log->details }}</div>
                                                <div style="font-size:8.5px; color:var(--muted); font-weight:700; margin-top:3px;">
                                                    <i class="fas fa-user-circle"></i> {{ $log->staff_name ?? 'Staff' }}
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div style="padding:24px; text-align:center; color:var(--light);">
                                            <i class="fas fa-bell-slash" style="font-size:20px; display:block; margin-bottom:6px; opacity:.3;"></i>
                                            <p style="font-size:10px; font-weight:700;">No recent case activity.</p>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <noscript><button type="submit" class="btn btn-sm">Filter</button></noscript>
                        </div>
                    </form>
                </div>

                <div id="cases-table-container" style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Case Code</th>
                            <th>Category</th>
                            <th>Complainant / Victim</th>
                            <th>Incident Date</th>
                            <th>Report Date</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr></thead>
                        <tbody>
                            @forelse($issues as $issue)
                            @php 
                                $caseCode = 'VAWC-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT); 
                                $issueData = [
                                    'id'                     => $issue->id,
                                    'case_code'              => $caseCode,
                                    'issue_type'             => $issue->issue_type,
                                    'status'                 => $issue->status,
                                    'complainant_name'       => $issue->complainant_name,
                                    'complainant_age'        => $issue->complainant_age,
                                    'complainant_gender'     => $issue->complainant_gender,
                                    'contact'                => $issue->contact,
                                    'complainant_address'    => $issue->complainant_address,
                                    'is_on_behalf'           => (bool)$issue->is_on_behalf,
                                    'victim_name'            => $issue->victim_name,
                                    'victim_age'             => $issue->victim_age,
                                    'victim_gender'          => $issue->victim_gender,
                                    'victim_relationship'    => $issue->victim_relationship,
                                    'respondent_name'        => $issue->respondent_name,
                                    'respondent_address'     => $issue->respondent_address,
                                    'description'            => $issue->description,
                                    'rejection_reason'       => $issue->rejection_reason,
                                    'admin_summary'          => $issue->admin_summary,
                                    'admin_notes'            => $issue->admin_notes,
                                    'official_document'      => $issue->official_document,
                                    'official_document_name' => $issue->official_document_name,
                                    'official_document_url'  => $issue->official_document ? asset('storage/' . $issue->official_document) : null,
                                    'transfer_reason'        => $issue->transfer_reason,
                                    'transfer_count'         => $issue->transfer_count,
                                    'witness_name'           => $issue->witness_name,
                                    'evidence'               => $issue->evidence ? json_decode($issue->evidence, true) : [],
                                    'incident_date'          => $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('M d, Y h:i A') : 'N/A',
                                    'location'               => $issue->location,
                                    'is_restricted'          => $issue->is_restricted,
                                    'user_id'                => $issue->user_id,
                                    'created_at'             => $issue->created_at->format('M d, Y'),
                                ];
                            @endphp
                            <tr id="vawc-row-{{ $issue->id }}" style="transition:all 0.5s ease;">
                                <td>
                                    <div style="font-size:11px;font-weight:900;color:#7c3aed;">#{{ $caseCode }}</div>
                                    @if($issue->transfer_count > 0)
                                       <div style="font-size:8px;font-weight:900;background:#eff6ff;color:#1d4ed8;padding:1px 6px;border-radius:4px;display:inline-block;margin-top:2px;text-transform:uppercase;border:1px solid #bfdbfe;" title="Reason: {{ $issue->transfer_reason }}">
                                           <i class="fas fa-exchange-alt" style="font-size:7px;"></i> Transferred
                                       </div>
                                    @elseif($issue->official_document)
                                       <div style="font-size:8px;font-weight:900;background:#fdf4ff;color:#7c3aed;padding:1px 6px;border-radius:4px;display:inline-block;margin-top:2px;text-transform:uppercase;border:1px solid #e9d5ff;" title="Official Signed Scan Attached">
                                           <i class="fas fa-paperclip" style="font-size:7px;"></i> Scan Attached
                                       </div>
                                    @else
                                       <div style="font-size:9px;color:var(--light);font-weight:600;text-transform:uppercase;">Confidential</div>
                                    @endif
                                </td>
                                <td>
                                    <span style="background:#f5f3ff;color:#7c3aed;font-size:9px;font-weight:900;padding:3px 9px;border-radius:99px;border:1px solid #ede9fe;">{{ $issue->issue_type }}</span>
                                </td>
                                <td>
                                    <div style="font-size:12px;font-weight:800;color:var(--text);">
                                        @if($issue->is_restricted && !in_array(strtolower(auth()->user()->role ?? ''), ['vawc', 'admin', 'captain', 'superadmin']))
                                            <span style="filter: blur(4px); user-select: none;">REDACTED NAME</span>
                                        @else
                                            {{ $issue->complainant_name }}
                                            @if(!$issue->user_id)
                                                <span class="cbadge cbadge-red" style="font-size:7px; padding:2px 6px; vertical-align:middle; margin-left:4px;">GUEST</span>
                                            @endif
                                        @endif
                                    </div>
                                    @if($issue->is_on_behalf && $issue->victim_name)
                                    <div style="font-size:10px;color:#7c3aed;font-weight:700;margin-top:2px;">
                                        <i class="fas fa-hands-helping" style="font-size:9px;"></i> Victim: {{ $issue->victim_name }} ({{ $issue->victim_relationship ?? 'Dependent' }})
                                    </div>
                                    @endif
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">
                                        @if($issue->is_restricted && !in_array(strtolower(auth()->user()->role ?? ''), ['vawc', 'admin', 'captain', 'superadmin']))
                                            <span style="filter: blur(4px);">09000000000</span>
                                        @else
                                            {{ $issue->contact }}
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size:11px;color:var(--muted);font-weight:600;">
                                        {{ $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('M d, Y') : 'N/A' }}
                                    </div>
                                </td>
                                <td><div style="font-size:11px;color:var(--brand);font-weight:800;">{{ $issue->created_at->format('M d, Y') }}</div></td>
                                <td>
                                    @php $sc=['submitted'=>'spill-new','under_review'=>'spill-active','approved'=>'spill-settled','settled'=>'spill-settled','urgent'=>'spill-urgent','pending'=>'spill-pending','on_going'=>'spill-active','referred_to_pnp'=>'spill-active','rejected'=>'spill-new'][$issue->status]??'spill-pending'; @endphp
                                    @if($issue->status === 'under_review' && str_contains((string)$issue->admin_notes, 'AUTO-FLAGGED'))
                                        <span class="spill spill-urgent" style="background:#fdf4ff;color:#7c3aed;border:1px solid #e9d5ff;font-size:8.5px;" title="{{ $issue->admin_notes }}"><i class="fas fa-shield-alt" style="font-size:7px;"></i> UNDER REVIEW (AUTO-FLAGGED)</span>
                                    @else
                                        <span class="spill {{ $sc }}"><i class="fas fa-circle" style="font-size:6px;"></i> {{ ucfirst(str_replace('_',' ',$issue->status)) }}</span>
                                    @endif
                                </td>
                                <td style="text-align:right;">
                                    {{-- REFINED ACTION BUTTON GROUP (ALIGNED, CLEAN SPACING) --}}
                                    <div class="action-btn-group">
                                        {{-- 1. VIEW BUTTON --}}
                                        <button type="button" @click="openView({{ json_encode($issueData) }})"
                                                class="btn-action-icon btn-action-view" title="View Case Details">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- 2. TRANSFER (⇄) BUTTON TRIGGERING CONFIRMATION MODAL WITH REASON --}}
                                        <button type="button" @click="openReroute({{ json_encode($issueData) }})"
                                                class="btn-action-icon btn-action-reroute" title="Re-route Case to Peace & Order / KP Desk">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>

                                        {{-- 4. STATUS UPDATE DROPDOWN --}}
                                        @php
                                            $vawcRankMap = [
                                                'submitted'       => 1,
                                                'pending'         => 1,
                                                'under_review'    => 2,
                                                'on_going'        => 3,
                                                'referred_to_pnp' => 3,
                                                'urgent'          => 3,
                                                'approved'        => 3,
                                                'settled'         => 4,
                                                'resolved'        => 4,
                                                'rejected'        => 4,
                                            ];
                                            $curVawcRank = $vawcRankMap[$issue->status] ?? 1;
                                            $isVawcTerminal = in_array($issue->status, ['settled', 'resolved', 'rejected']);
                                        @endphp
                                        @if($isVawcTerminal)
                                            <select disabled style="height:32px;font-size:9px;font-weight:800;border:1.5px solid var(--border);border-radius:8px;padding:0 8px;background:#f8fafc;color:#94a3b8;cursor:not-allowed;outline:none;font-family:inherit;opacity:0.75;" title="This case is already {{ $issue->status === 'settled' ? 'Resolved' : ucfirst($issue->status) }} and locked.">
                                                <option selected>{{ $issue->status === 'settled' ? 'Resolved' : ucfirst(str_replace('_',' ',$issue->status)) }}</option>
                                            </select>
                                        @else
                                            <form :id="'vawc-status-form-{{ $issue->id }}'" action="{{ url('/vawc/issues/'.$issue->id.'/status') }}" method="POST" style="display:inline;margin:0;">
                                                @csrf @method('PATCH')
                                                <select name="status" @change="if($el.value === 'rejected') { openReject({{ $issue->id }}); $el.value='{{ $issue->status }}'; } else { document.getElementById('vawc-status-form-{{ $issue->id }}').submit(); }"
                                                        style="height:32px;font-size:9px;font-weight:800;border:1.5px solid var(--border);border-radius:8px;padding:0 8px;background:#f8fafc;cursor:pointer;outline:none;font-family:inherit;">
                                                    @if($curVawcRank === 1)
                                                        <option value="pending"         {{ in_array($issue->status, ['submitted','pending']) ? 'selected' : '' }}>Pending</option>
                                                    @endif
                                                    @if($curVawcRank <= 2)
                                                        <option value="under_review"    {{ $issue->status==='under_review' ? 'selected' : '' }}>Under Review</option>
                                                    @endif
                                                    @if($curVawcRank <= 3)
                                                        <option value="on_going"        {{ $issue->status==='on_going'        ? 'selected' : '' }}>On-going</option>
                                                        <option value="referred_to_pnp" {{ $issue->status==='referred_to_pnp' ? 'selected' : '' }}>Referred to PNP</option>
                                                        <option value="urgent"          {{ $issue->status==='urgent'          ? 'selected' : '' }}>Urgent Rescue</option>
                                                        <option value="approved"        {{ $issue->status==='approved'        ? 'selected' : '' }}>Approved</option>
                                                    @endif
                                                    <option value="settled"         {{ in_array($issue->status, ['settled','resolved']) ? 'selected' : '' }}>Resolved</option>
                                                    <option value="rejected"        {{ $issue->status==='rejected'        ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7">
                                <div class="tbl-empty"><i class="fas fa-folder-open"></i><p style="font-size:11px;font-weight:700;">No VAWC cases on file.</p></div>
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- REFERRAL TAB (INTERACTIVE PDF PREVIEW TRIGGER) --}}
        <div x-show="activeTab==='referral'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-ambulance"></i> PNP / DSWD Referrals & Emergency Escalation</div>
                    <span class="cbadge" style="background:#fce7f3;color:#be185d;">Urgent Cases</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Case Code</th>
                            <th>Complainant / Victim</th>
                            <th>Official Document</th>
                            <th>Escalation Date</th>
                            <th>Status</th>
                            <th style="text-align:right;">Action</th>
                        </tr></thead>
                        <tbody>
                            @forelse(\App\Models\IssueReport::where('department','VAWC')->whereIn('status',['urgent','on_going','referred_to_pnp'])->latest()->get() as $urgentIssue)
                            @php 
                                $uCode = 'VAWC-'.$urgentIssue->created_at->format('Y').'-'.str_pad($urgentIssue->id, 3, '0', STR_PAD_LEFT); 
                                $urgentData = [
                                    'id'                     => $urgentIssue->id,
                                    'case_code'              => $uCode,
                                    'issue_type'             => $urgentIssue->issue_type,
                                    'status'                 => $urgentIssue->status,
                                    'complainant_name'       => $urgentIssue->complainant_name,
                                    'complainant_age'        => $urgentIssue->complainant_age,
                                    'complainant_gender'     => $urgentIssue->complainant_gender,
                                    'contact'                => $urgentIssue->contact,
                                    'complainant_address'    => $urgentIssue->complainant_address,
                                    'is_on_behalf'           => (bool)$urgentIssue->is_on_behalf,
                                    'victim_name'            => $urgentIssue->victim_name,
                                    'victim_age'             => $urgentIssue->victim_age,
                                    'victim_gender'          => $urgentIssue->victim_gender,
                                    'victim_relationship'    => $urgentIssue->victim_relationship,
                                    'respondent_name'        => $urgentIssue->respondent_name,
                                    'respondent_address'     => $urgentIssue->respondent_address,
                                    'description'            => $urgentIssue->description,
                                    'admin_summary'          => $urgentIssue->admin_summary,
                                    'admin_notes'            => $urgentIssue->admin_notes,
                                    'official_document'      => $urgentIssue->official_document,
                                    'official_document_name' => $urgentIssue->official_document_name,
                                    'official_document_url'  => $urgentIssue->official_document ? asset('storage/' . $urgentIssue->official_document) : null,
                                    'incident_date'          => $urgentIssue->incident_date ? \Carbon\Carbon::parse($urgentIssue->incident_date)->format('M d, Y h:i A') : 'N/A',
                                    'location'               => $urgentIssue->location,
                                    'created_at'             => $urgentIssue->created_at->format('M d, Y'),
                                ];
                            @endphp
                            <tr>
                                <td><div style="font-size:11px;font-weight:900;color:#dc2626;">#{{ $uCode }}</div></td>
                                <td>
                                    <div style="font-size:12px;font-weight:800;color:var(--text);">
                                        {{ $urgentIssue->complainant_name }}
                                    </div>
                                    @if($urgentIssue->is_on_behalf && $urgentIssue->victim_name)
                                    <div style="font-size:10px;color:#7c3aed;font-weight:700;">
                                        Victim: {{ $urgentIssue->victim_name }} ({{ $urgentIssue->victim_relationship ?? 'Dependent' }})
                                    </div>
                                    @endif
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">{{ $urgentIssue->contact }}</div>
                                </td>
                                <td>
                                    @if($urgentIssue->official_document)
                                        <span class="cbadge" style="background:#f5f3ff;color:#7c3aed;border:1px solid #ddd6fe;font-size:8.5px;">
                                            <i class="fas fa-paperclip"></i> Signed Scan Attached
                                        </span>
                                    @else
                                        <span style="font-size:9px;color:var(--light);font-style:italic;">Digital Draft</span>
                                    @endif
                                </td>
                                <td><div style="font-size:11px;color:var(--muted);">{{ $urgentIssue->updated_at->format('M d, Y') }}</div></td>
                                <td><span class="spill spill-urgent"><i class="fas fa-exclamation-triangle" style="font-size:8px;"></i> ESCALATED</span></td>
                                <td style="text-align:right;">
                                    <button type="button" @click="openReferralPreview({{ json_encode($urgentData) }})" class="btn btn-sm" style="background:linear-gradient(135deg,#dc2626,#991b1b);color:#fff;box-shadow:0 2px 8px rgba(220,38,38,.3);display:inline-flex;align-items:center;gap:6px;font-weight:800;">
                                        <i class="fas fa-file-pdf"></i> View Referral
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6"><div class="tbl-empty"><i class="fas fa-ambulance"></i><p style="font-size:11px;font-weight:700;">No active escalation referrals.</p></div></td></tr>
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
                            <th>Complainant / Victim</th>
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
                                    @if($resolvedIssue->is_on_behalf && $resolvedIssue->victim_name)
                                        <div style="font-size:10px;color:#7c3aed;font-weight:700;">Victim: {{ $resolvedIssue->victim_name }}</div>
                                    @endif
                                </td>
                                <td><div style="font-size:11px;color:var(--muted);">{{ $resolvedIssue->created_at->format('M d, Y') }}</div></td>
                                <td><div style="font-size:11px;font-weight:800;color:var(--text);">{{ $resolvedIssue->updated_at->format('M d, Y') }}</div></td>
                                <td><span class="spill spill-settled"><i class="fas fa-check-circle" style="font-size:8px;"></i> RESOLVED</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="5"><div class="tbl-empty"><i class="fas fa-clipboard-check"></i><p style="font-size:11px;font-weight:700;">No resolved cases archived here.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ REPORTS TAB (EDITABLE RA 9262 LANDSCAPE MATRIX, EXPORT PDF & SEND TO ADMIN) ══ --}}
        <div x-show="activeTab==='reports'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-file-invoice"></i> RA 9262 Compliance Monitoring & Transmittal</div>
                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                        <button type="button" @click="templateUploadModal=true" class="btn btn-ghost btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-cloud-upload-alt"></i> Format / Template
                        </button>
                        <button type="button" @click="printVawcReport()" class="btn btn-ghost btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-print"></i> Export / Print PDF
                        </button>
                        <form action="{{ route('department.reports.submit') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="department" value="VAWC">
                            <input type="hidden" name="report_title" value="MONITORING COMPLIANCE TO RA:9262 VAWC">
                            <input type="hidden" name="reporting_period" :value="vawcRep.monthYear">
                            <input type="hidden" name="report_data" :value="JSON.stringify(vawcRep)">
                            <input type="hidden" name="submitted_by" :value="vawcRep.preparedBy">
                            <input type="hidden" name="submitted_role" :value="vawcRep.preparedRole">
                            <input type="hidden" name="template_file_path" value="{{ $customTemplate['path'] ?? '' }}">
                            <button type="submit" class="btn btn-vawc btn-sm" style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#059669,#064e3b);">
                                <i class="fas fa-paper-plane"></i> Send / Transfer to Admin
                            </button>
                        </form>
                    </div>
                </div>

                <div style="padding:20px;background:#f8fafc;border-bottom:1px solid var(--border);">
                    {{-- ACTIVE CUSTOM TEMPLATE BANNER --}}
                    @if(!empty($customTemplate))
                        <div style="margin-bottom:16px;background:#f0fdf4;border:1.5px solid #86efac;border-radius:12px;padding:14px 18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;box-shadow:0 2px 10px rgba(22,163,74,0.06);">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div style="width:38px;height:38px;border-radius:10px;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                                    <i class="fas fa-file-check"></i>
                                </div>
                                <div>
                                    <div style="font-size:12.5px;font-weight:900;color:#166534;display:flex;align-items:center;gap:8px;">
                                        <span>Active Custom Format: <strong>{{ $customTemplate['original_name'] }}</strong></span>
                                        <span style="font-size:9.5px;background:#22c55e;color:#fff;font-weight:900;padding:2px 8px;border-radius:99px;text-transform:uppercase;">Active Template</span>
                                    </div>
                                    <div style="font-size:10px;color:#15803d;font-weight:600;margin-top:2px;">
                                        Uploaded on {{ $customTemplate['uploaded_at'] }} ({{ $customTemplate['size_human'] }}) &bull; Automatically attached when submitting to Admin
                                    </div>
                                </div>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                                <a href="{{ asset('storage/' . $customTemplate['path']) }}" target="_blank" class="btn btn-sm" style="background:#fff;border:1.5px solid #86efac;color:#166534;font-weight:800;font-size:11px;display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;text-decoration:none;">
                                    <i class="fas fa-eye"></i> View / Download Template
                                </a>
                                <button type="button" @click="templateUploadModal=true" class="btn btn-sm btn-ghost" style="border:1.5px solid #cbd5e1;background:#fff;font-weight:800;font-size:11px;display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;">
                                    <i class="fas fa-sync-alt"></i> Upload New Template
                                </button>
                                <form action="{{ route('department.reports.delete_template') }}" method="POST" style="margin:0;" onsubmit="return confirm('Revert to the standard system template matrix for VAWC?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="department" value="VAWC">
                                    <button type="submit" class="btn btn-sm" style="border:1.5px solid #fecaca;background:#fff;color:#dc2626;font-weight:800;font-size:11px;display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;">
                                        <i class="fas fa-trash-alt"></i> Reset to Default
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div id="vawc-printable-report" style="background:#fff;padding:24px;border-radius:12px;border:1.5px solid #cbd5e1;box-shadow:0 4px 12px rgba(0,0,0,0.04);font-family:'Times New Roman', serif;color:#000;">
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
                                OFFICE OF THE SANGGUNIANG BARANGAY
                            </div>
                            <div style="border-bottom:1.5px solid #000; width:100%; margin:8px auto 14px;"></div>

                            <div style="font-size:13px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em;">
                                Office of the Punong Barangay
                            </div>
                            <div style="font-size:12.5px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em; margin-top:2px;">
                                MONITORING COMPLIANCE TO RA:9262 VAWC
                            </div>
                            <div style="font-size:11.5px; font-weight:bold; text-transform:uppercase; margin-top:3px; display:flex; align-items:center; justify-content:center; gap:6px;">
                                FOR THE MONTH OF 
                                <input type="text" x-model="vawcRep.monthYear" title="Click to edit Month & Year"
                                       style="font-weight:bold; text-transform:uppercase; width:160px; text-align:center; font-family:'Times New Roman', serif; font-size:11.5px; border-bottom:1px solid #000; border-top:none; border-left:none; border-right:none; background:transparent; outline:none;">
                            </div>
                        </div>

                        {{-- Sub Meta Top-Left --}}
                        <div style="font-size:11px; margin-bottom:10px; line-height:1.4;">
                            <div><strong>Province:</strong> <input type="text" x-model="vawcRep.province" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:120px; font-weight:bold; background:transparent;"></div>
                            <div><strong>City:</strong> <input type="text" x-model="vawcRep.city" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                            <div><strong>Barangay:</strong> <input type="text" x-model="vawcRep.barangay" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                        </div>

                        {{-- Official RA 9262 Matrix Table (Editable Cells) --}}
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
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="text" x-model="vawcRep.hasDesk" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; font-weight:bold; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="text" x-model="vawcRep.gadFund" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="text" x-model="vawcRep.bcpcFund" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="text" x-model="vawcRep.hasLogbook" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.casesHandled" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:11px; font-weight:bold; outline:none;">
                                        </td>
                                        {{-- Victims breakdown --}}
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.physicalAbuse" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.economicAbuse" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.sexualAbuse" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.psychologicalAbuse" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="vawcRep.totalVictims"></td>
                                        {{-- Actions taken breakdown --}}
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.refPnp" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.refCourt" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.issuedBpos" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="vawcRep.refMedical" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="vawcRep.totalActed"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Signatures Footer Matching Physical Report --}}
                        <div style="margin-top:40px; display:flex; justify-content:space-between; align-items:flex-start; padding:0 24px;">
                            <div style="width:240px; text-align:left;">
                                <div style="font-size:11px;">Prepared by :</div>
                                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                                    <input type="text" x-model="vawcRep.preparedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                                </div>
                                <div style="text-align:center; margin-top:2px;">
                                    <input type="text" x-model="vawcRep.preparedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </div>
                            </div>

                            <div style="width:240px; text-align:left;">
                                <div style="font-size:11px;">Noted by:</div>
                                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                                    <input type="text" x-model="vawcRep.notedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                                </div>
                                <div style="text-align:center; margin-top:2px;">
                                    <input type="text" x-model="vawcRep.notedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBMITTED REPORTS HISTORY TABLE --}}
                <div style="padding:16px 20px;">
                    <div style="font-size:11px;font-weight:900;color:var(--text);text-transform:uppercase;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-history" style="color:var(--vawc);"></i> Submitted Compliance Reports to Admin History
                    </div>
                    <table class="tbl">
                        <thead><tr>
                            <th>Report Title</th>
                            <th>Period</th>
                            <th>Submitted By</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr></thead>
                        <tbody>
                            @forelse(($vawcReports ?? collect()) as $rep)
                            <tr>
                                <td><div style="font-size:11px;font-weight:900;color:var(--text);">{{ $rep->report_title }}</div></td>
                                <td><span class="spill spill-active" style="font-size:9.5px;">{{ $rep->reporting_period }}</span></td>
                                <td><div style="font-size:11px;font-weight:700;">{{ $rep->submitted_by }} <span style="font-size:9px;color:var(--muted);">({{ $rep->submitted_role }})</span></div></td>
                                <td><div style="font-size:11px;color:var(--brand);font-weight:800;">{{ $rep->created_at->format('M d, Y h:i A') }}</div></td>
                                <td><span class="spill spill-settled" style="font-size:9px;"><i class="fas fa-check-circle"></i> {{ $rep->status }}</span></td>
                                <td style="text-align:right;">
                                    <div style="display:inline-flex;gap:6px;">
                                        <a href="{{ route('department.reports.show', $rep->id) }}" target="_blank" class="btn-action-icon btn-action-view" title="Preview / Print Landscape Report">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($rep->template_file)
                                        <a href="{{ asset('storage/' . $rep->template_file) }}" target="_blank" class="btn-action-icon" style="background:#eff6ff;color:#1d4ed8;" title="View Attached Template">
                                            <i class="fas fa-paperclip"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6"><div class="tbl-empty"><i class="fas fa-file-invoice"></i><p style="font-size:11px;font-weight:700;">No compliance reports submitted to admin yet.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ 1. INTERACTIVE PDF PREVIEW, IN-MODAL EDITING & OFFICIAL SCAN UPLOAD MODAL ══ --}}
        <div x-show="referralPreviewModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width: 860px;" @click.away="referralPreviewModal=false">
                <div class="modal-in" style="padding: 20px 24px;">
                    
                    {{-- MODAL HEADER: TOP RIGHT HAS UPLOAD, EDIT, AND CLOSE --}}
                    <div class="modal-hd" style="margin-bottom:12px;flex-wrap:wrap;gap:10px;">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-file-pdf"></i></div>
                            <div>
                                <div>PNP / DSWD Referral Document</div>
                                <div style="font-size:9px;font-weight:700;color:#dc2626;text-transform:none;" x-text="'#' + previewData.case_code + ' — Interactive Preview & Attachment'"></div>
                            </div>
                        </div>

                        {{-- TOP RIGHT ACTION BUTTONS --}}
                        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                            {{-- 📤 UPLOAD / REPLACE OFFICIAL SCAN BUTTON --}}
                            <button type="button" @click="uploadPanelOpen = !uploadPanelOpen" class="btn btn-sm" :style="uploadPanelOpen ? 'background:#7c3aed;color:#fff;' : 'background:#f3e8ff;color:#7c3aed;border:1px solid #e9d5ff;'">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span x-text="previewData.official_document ? '🔄 Replace Scan / File' : '📤 Upload Official Scan'"></span>
                            </button>

                            {{-- ✏️ EDIT DETAILS BUTTON (FORM MODE ONLY) --}}
                            <template x-if="docViewMode === 'form'">
                                <button type="button" @click="isEditingReferral = !isEditingReferral" class="btn btn-sm" :style="isEditingReferral ? 'background:#7c3aed;color:#fff;' : 'background:#f1f5f9;color:#334155;border:1px solid #cbd5e1;'">
                                    <i class="fas" :class="isEditingReferral ? 'fa-eye' : 'fa-edit'"></i>
                                    <span x-text="isEditingReferral ? 'Preview Mode' : '✏️ Edit Details'"></span>
                                </button>
                            </template>

                            <button type="button" @click="referralPreviewModal=false" class="modal-close" style="margin-left:6px;"><i class="fas fa-times-circle"></i></button>
                        </div>
                    </div>

                    {{-- VIEW SWITCHER TABS (IF OFFICIAL SCAN EXISTS) --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;background:#f8fafc;padding:6px 10px;border-radius:10px;margin-bottom:14px;border:1px solid var(--border);flex-wrap:wrap;">
                        <div style="display:flex;gap:6px;">
                            <button type="button" @click="docViewMode = 'form'" class="btn btn-sm" :style="docViewMode === 'form' ? 'background:#7c3aed;color:#fff;' : 'background:#fff;color:#64748b;border:1px solid var(--border);'">
                                <i class="fas fa-file-invoice"></i> System Generated Form
                            </button>
                            <template x-if="previewData.official_document">
                                <button type="button" @click="docViewMode = 'scan'" class="btn btn-sm" :style="docViewMode === 'scan' ? 'background:#059669;color:#fff;' : 'background:#fff;color:#059669;border:1px solid #a7f3d0;'">
                                    <i class="fas fa-paperclip"></i> Attached Official Barangay Scan
                                </button>
                            </template>
                        </div>

                        <template x-if="previewData.official_document">
                            <div style="font-size:10px;color:#059669;font-weight:800;display:flex;align-items:center;gap:6px;">
                                <i class="fas fa-check-circle"></i> <span x-text="previewData.official_document_name || 'Official Document Attached'"></span>
                                <button type="button" @click="removeDocFile()" title="Remove file" style="background:none;border:none;color:#dc2626;cursor:pointer;font-size:11px;padding:2px;"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </template>
                    </div>

                    {{-- 📤 UPLOAD OFFICIAL FILE ACCORDION PANEL --}}
                    <div x-show="uploadPanelOpen" x-transition style="background:#faf5ff;border:2px dashed #c4b5fd;border-radius:14px;padding:16px;margin-bottom:16px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                            <div style="font-size:11px;font-weight:900;text-transform:uppercase;color:#6d28d9;display:flex;align-items:center;gap:6px;">
                                <i class="fas fa-cloud-upload-alt"></i> Upload Official Barangay Signed / Stamped Document
                            </div>
                            <button type="button" @click="uploadPanelOpen=false" style="background:none;border:none;color:#64748b;cursor:pointer;font-size:14px;"><i class="fas fa-times"></i></button>
                        </div>
                        <p style="font-size:10.5px;color:#475569;margin-bottom:12px;line-height:1.5;">
                            Kung mayroon kang opisyal na physical scanned copy, signed form mula sa barangay hall, o PNP/DSWD stamped transmittal, maaari mo itong i-upload dito (PDF o Image). Ito ang magsisilbing opisyal na kalakip ng kasong ito.
                        </p>

                        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                            <input type="file" x-ref="officialDocFileInput" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="finput" style="flex:1;min-width:220px;padding:6px;background:#fff;">
                            <button type="button" @click="uploadDocFile()" :disabled="isUploadingDoc" class="btn btn-vawc" style="padding:8px 18px;">
                                <i class="fas" :class="isUploadingDoc ? 'fa-spinner fa-spin' : 'fa-upload'"></i>
                                <span x-text="isUploadingDoc ? 'Uploading...' : 'Save & Attach Document'"></span>
                            </button>
                        </div>
                        <div style="font-size:9px;color:var(--muted);margin-top:6px;font-weight:600;">
                            Supported Formats: PDF, JPG, PNG, DOC, DOCX &bull; Maximum File Size: 20MB &bull; RA 9262 Compliant Storage
                        </div>
                    </div>

                    {{-- EDIT MODE FORM CONTAINER (SYSTEM FORM ONLY) --}}
                    <div x-show="docViewMode === 'form' && isEditingReferral" x-transition style="background:#fdf4ff;border:1.5px solid #e9d5ff;border-radius:12px;padding:16px;margin-bottom:16px;">
                        <div style="font-size:10.5px;font-weight:900;text-transform:uppercase;color:#7c3aed;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                            <i class="fas fa-pen-nib"></i> Tweak Remarks & Narration Before Finalizing
                        </div>
                        <form id="referral-edit-form" @submit.prevent="saveReferralEdits()">
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="fgrid2 fgrp">
                                <div class="fspan2">
                                    <label class="flbl">Official Staff Incident Summary / Findings</label>
                                    <textarea name="admin_summary" rows="3" class="finput" style="background:#fff;" placeholder="Enter formalized incident facts for PNP/DSWD..." x-model="previewData.admin_summary"></textarea>
                                </div>
                                <div class="fspan2">
                                    <label class="flbl">Admin Directives / Referral Notes</label>
                                    <input type="text" name="admin_notes" class="finput" style="background:#fff;" placeholder="e.g. For immediate protective custody and psycho-social evaluation..." x-model="previewData.admin_notes">
                                </div>
                                <div>
                                    <label class="flbl">Incident Location</label>
                                    <input type="text" name="location" class="finput" style="background:#fff;" x-model="previewData.location">
                                </div>
                                <div>
                                    <label class="flbl">Contact Number</label>
                                    <input type="text" name="contact" class="finput" style="background:#fff;" x-model="previewData.contact">
                                </div>
                            </div>
                            <div style="display:flex;justify-content:flex-end;gap:8px;">
                                <button type="submit" class="btn btn-vawc btn-sm"><i class="fas fa-save"></i> Save Changes to Document</button>
                            </div>
                        </form>
                    </div>

                    {{-- ══ OPTION A: UPLOADED SCAN / OFFICIAL FILE PREVIEW ══ --}}
                    <template x-if="docViewMode === 'scan' && previewData.official_document_url">
                        <div style="background:#f8fafc;border:1px solid #cbd5e1;border-radius:12px;padding:16px;text-align:center;">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;padding-bottom:8px;border-bottom:1px solid var(--border);">
                                <div style="font-size:11px;font-weight:900;color:#0f172a;display:flex;align-items:center;gap:6px;">
                                    <i class="fas fa-file-alt" style="color:#7c3aed;"></i> Official Scanned Copy on Record:
                                    <span style="color:#7c3aed;" x-text="previewData.official_document_name"></span>
                                </div>
                                <div style="display:flex;gap:6px;">
                                    <a :href="previewData.official_document_url" target="_blank" class="btn btn-sm btn-ghost" style="background:#fff;border:1px solid var(--border);">
                                        <i class="fas fa-external-link-alt"></i> Open Full View
                                    </a>
                                </div>
                            </div>

                            {{-- IF PDF: EMBEDDED VIEWER --}}
                            <template x-if="previewData.official_document_url.toLowerCase().endsWith('.pdf')">
                                <iframe :src="previewData.official_document_url" style="width:100%;height:680px;border:1px solid #cbd5e1;border-radius:8px;background:#fff;" title="Official Document PDF Preview"></iframe>
                            </template>

                            {{-- IF IMAGE: IMAGE VIEWER --}}
                            <template x-if="!previewData.official_document_url.toLowerCase().endsWith('.pdf')">
                                <div style="background:#0f172a;border-radius:8px;padding:14px;max-height:750px;overflow:auto;display:flex;justify-content:center;align-items:center;">
                                    <img :src="previewData.official_document_url" alt="Official Scanned Document" style="max-width:100%;max-height:700px;object-fit:contain;border-radius:4px;box-shadow:0 4px 16px rgba(0,0,0,0.4);">
                                </div>
                            </template>
                        </div>
                    </template>

                    {{-- ══ OPTION B: RENDERED SYSTEM REFERRAL FORM (PRINTABLE CANVAS) ══ --}}
                    <div x-show="docViewMode === 'form'" id="referral-printable-sheet" class="referral-preview-sheet">
                        <div class="ref-head">
                            <img src="{{ asset('images/circlelogo.png') }}" style="width: 60px; height: 60px; object-fit: contain;" alt="Barangay Logo">
                            <div style="text-align: center;">
                                <h2>PROVINCE OF CAVITE &bull; CITY OF DASMARIÑAS</h2>
                                <h2>BARANGAY SAN MIGUEL II</h2>
                                <h1>OFFICE OF THE SANGGUNIANG BARANGAY &bull; VAWC DESK</h1>
                            </div>
                        </div>

                        <div style="display:flex;justify-content:space-between;font-size:11.5px;margin-bottom:12px;">
                            <div><strong>Official Document:</strong> RA 9262 Transmittal</div>
                            <div style="text-align:right;">
                                <strong>Date:</strong> {{ now()->format('F d, Y') }}<br>
                                <strong>Case No:</strong> <span x-text="'#' + previewData.case_code"></span>
                            </div>
                        </div>

                        <div class="ref-title">OFFICIAL PNP / DSWD REFERRAL FORM</div>
                        <p style="font-size:12px;line-height:1.5;margin-bottom:14px;text-align:justify;">
                            This document officially refers the following high-priority VAWC incident for immediate Police Response, Investigation, and Protective Services pursuant to <strong>Republic Act No. 9262</strong>.
                        </p>

                        <div class="ref-row"><div class="ref-col-lbl">Escalation Status:</div><div class="ref-col-val"><strong x-text="(previewData.status || '').toUpperCase().replace('_',' ')"></strong></div></div>
                        <div class="ref-row"><div class="ref-col-lbl">Incident Category:</div><div class="ref-col-val" x-text="previewData.issue_type"></div></div>
                        <div class="ref-row"><div class="ref-col-lbl">Date & Time Occurred:</div><div class="ref-col-val" x-text="previewData.incident_date || 'N/A'"></div></div>
                        <div class="ref-row"><div class="ref-col-lbl">Incident Location:</div><div class="ref-col-val" x-text="previewData.location || 'Barangay San Miguel II'"></div></div>

                        {{-- COMPLAINANT --}}
                        <div class="ref-sect">Complainant Details</div>
                        <div class="ref-row"><div class="ref-col-lbl">Full Name:</div><div class="ref-col-val" x-text="previewData.complainant_name"></div></div>
                        <div class="ref-row"><div class="ref-col-lbl">Age / Gender:</div><div class="ref-col-val" x-text="(previewData.complainant_age || 'N/A') + ' / ' + (previewData.complainant_gender || 'N/A')"></div></div>
                        <div class="ref-row"><div class="ref-col-lbl">Contact Number:</div><div class="ref-col-val" x-text="previewData.contact"></div></div>
                        <div class="ref-row"><div class="ref-col-lbl">Address:</div><div class="ref-col-val" x-text="previewData.complainant_address || 'Barangay San Miguel II'"></div></div>

                        {{-- DEDICATED VICTIM SECTION (IF FILED ON BEHALF) --}}
                        <template x-if="previewData.is_on_behalf && previewData.victim_name">
                            <div>
                                <div class="ref-sect" style="color: #7c3aed;">Victim / Dependent Information (Filed On Behalf)</div>
                                <div class="ref-row"><div class="ref-col-lbl">Victim Full Name:</div><div class="ref-col-val"><strong x-text="previewData.victim_name"></strong></div></div>
                                <div class="ref-row"><div class="ref-col-lbl">Age / Gender:</div><div class="ref-col-val" x-text="(previewData.victim_age || 'N/A') + ' / ' + (previewData.victim_gender || 'N/A')"></div></div>
                                <div class="ref-row"><div class="ref-col-lbl">Relationship:</div><div class="ref-col-val" x-text="previewData.victim_relationship || 'Dependent'"></div></div>
                            </div>
                        </template>

                        {{-- RESPONDENT --}}
                        <div class="ref-sect">Respondent / Alleged Perpetrator</div>
                        <div class="ref-row"><div class="ref-col-lbl">Full Name:</div><div class="ref-col-val" x-text="previewData.respondent_name || 'N/A'"></div></div>
                        <div class="ref-row"><div class="ref-col-lbl">Address:</div><div class="ref-col-val" x-text="previewData.respondent_address || 'Barangay San Miguel II'"></div></div>

                        {{-- NARRATION --}}
                        <div class="ref-sect">Incident Facts & Narration</div>
                        <div class="ref-box">
                            <template x-if="previewData.admin_summary">
                                <div>
                                    <strong>Staff Official Summary:</strong><br>
                                    <span x-text="previewData.admin_summary"></span>
                                </div>
                            </template>
                            <template x-if="!previewData.admin_summary">
                                <div>
                                    <strong>Original Statement:</strong><br>
                                    <span x-text="previewData.description || 'No narration recorded.'"></span>
                                </div>
                            </template>
                        </div>

                        {{-- REMARKS --}}
                        <div class="ref-sect">Directives & Notes</div>
                        <div class="ref-row"><div class="ref-col-lbl">Admin Notes:</div><div class="ref-col-val" x-text="previewData.admin_notes || 'Referred for immediate police action and shelter coordination.'"></div></div>

                        <div class="footer" style="margin-top:30px;display:flex;justify-content:space-between;">
                            <div class="sig-line">
                                <div style="border-bottom:1px solid #000;height:35px;margin-bottom:4px;"></div>
                                {{ auth()->user() ? auth()->user()->name : 'VAWC DESK OFFICER' }}<br>
                                <small>VAWC Focal Person / Admin</small>
                            </div>
                            <div class="sig-line">
                                <div style="border-bottom:1px solid #000;height:35px;margin-bottom:4px;"></div>
                                RECEIVING POLICE / DSWD OFFICER<br>
                                <small>Signature over Printed Name / Date</small>
                            </div>
                        </div>
                    </div>

                    {{-- ══ MODAL FOOTER: PRINT & DOWNLOAD BUTTONS AT BOTTOM RIGHT ══ --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;margin-top:18px;padding-top:14px;border-top:1.5px solid #f1f5f9;flex-wrap:wrap;">
                        <button type="button" @click="referralPreviewModal=false" class="btn btn-ghost" style="padding:8px 16px;">
                            <i class="fas fa-times"></i> Close Window
                        </button>

                        <div style="display:flex;align-items:center;gap:8px;">
                            {{-- 📄 DOWNLOAD PDF / SCAN BUTTON --}}
                            <template x-if="docViewMode === 'form'">
                                <a :href="'/vawc/issues/' + previewData.id + '/print-referral'" target="_blank" class="btn" style="background:#eff6ff;color:#2563eb;border:1.5px solid #bfdbfe;text-decoration:none;padding:9px 18px;font-size:10.5px;font-weight:900;border-radius:9px;">
                                    <i class="fas fa-file-pdf"></i> Download PDF
                                </a>
                            </template>
                            <template x-if="docViewMode === 'scan' && previewData.official_document_url">
                                <a :href="previewData.official_document_url" download target="_blank" class="btn" style="background:#eff6ff;color:#2563eb;border:1.5px solid #bfdbfe;text-decoration:none;padding:9px 18px;font-size:10.5px;font-weight:900;border-radius:9px;">
                                    <i class="fas fa-download"></i> Download Scan
                                </a>
                            </template>

                            {{-- 🖨️ PRINT DOCUMENT BUTTON --}}
                            <button type="button" @click="printReferralPreview()" class="btn" style="background:linear-gradient(135deg,#dc2626,#991b1b);color:#fff;box-shadow:0 3px 10px rgba(220,38,38,.35);padding:9px 20px;font-size:10.5px;font-weight:900;border-radius:9px;">
                                <i class="fas fa-print"></i> Print Document
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ══ 2. RE-ROUTING GUARDRAILS MODAL (⇄ BUTTON WITH MANDATORY REASON) ══ --}}
        <div x-show="rerouteModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width: 480px;" @click.away="rerouteModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:#2563eb;"><i class="fas fa-exchange-alt"></i></div>
                            <div>
                                <div>Re-route Case to Peace & Order / KP Desk?</div>
                                <div style="font-size:9px;font-weight:700;color:#2563eb;text-transform:none;" x-text="'Case #' + rerouteData.case_code"></div>
                            </div>
                        </div>
                        <button @click="rerouteModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form :action="'/vawc/issues/' + rerouteData.id + '/transfer-peace'" method="POST">
                        @csrf @method('PATCH')
                        
                        <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px;margin-bottom:14px;font-size:11px;color:#1e3a8a;line-height:1.5;">
                            <div style="font-weight:800;margin-bottom:3px;"><i class="fas fa-info-circle"></i> Case Transfer Guardrail:</div>
                            Transferring this case will move it to the <strong>Peace & Order / Katarungang Pambarangay</strong> desk. Cases can only be transferred <strong>once</strong>.
                        </div>

                        <div class="fgrp">
                            <label class="flbl">Reason for Case Transfer <span style="color:#dc2626;">*</span></label>
                            <textarea name="transfer_reason" required rows="3" class="finput" style="resize:vertical;" placeholder="Please specify why this case does not qualify under RA 9262 or is being re-routed to KP Desk..." x-model="rerouteData.reason"></textarea>
                            <span style="font-size:9px;color:var(--muted);font-weight:600;">* This reason, your staff name, and timestamp will be permanently logged in the Privacy Audit Trail.</span>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:16px;">
                            <button type="button" @click="rerouteModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="background:linear-gradient(135deg,#2563eb,#1d4ed8);" :disabled="!rerouteData.reason || rerouteData.reason.trim().length < 4">
                                <i class="fas fa-exchange-alt"></i> Confirm Re-route
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ 3. PRIVACY AUDIT TRAIL MODAL ══ --}}
        <div x-show="auditModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width: 680px;" @click.away="auditModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#faf5ff;color:#7c3aed;"><i class="fas fa-clipboard-check"></i></div>
                            <div>
                                <div>VAWC Privacy Audit Trail</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">RA 9262 Compliance & Security Activity Log</div>
                            </div>
                        </div>
                        <button @click="auditModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    {{-- AUDIT SEARCH BAR --}}
                    <div style="margin-bottom:14px;">
                        <input type="text" x-model="auditSearch" placeholder="Search audit trail by staff name, action, or case code..." class="finput" style="padding:8px 12px;font-size:11px;">
                    </div>

                    <div style="max-height: 440px; overflow-y: auto; padding-right: 4px;">
                        @forelse($auditLogs as $log)
                        @php
                            $actionConfig = match($log->action) {
                                'case_transfer'    => ['bg' => '#eff6ff', 'color' => '#2563eb', 'ico' => 'fa-exchange-alt', 'label' => 'Case Re-Routed'],
                                'auto_triage_flag' => ['bg' => '#fdf4ff', 'color' => '#7c3aed', 'ico' => 'fa-shield-alt', 'label' => 'Auto-Triage Flagged'],
                                'pnp_escalation'   => ['bg' => '#fef2f2', 'color' => '#dc2626', 'ico' => 'fa-ambulance', 'label' => 'PNP / DSWD Escalation'],
                                'document_upload'  => ['bg' => '#f5f3ff', 'color' => '#7c3aed', 'ico' => 'fa-cloud-upload-alt', 'label' => 'Official Scan Uploaded'],
                                'document_remove'  => ['bg' => '#fff1f2', 'color' => '#e11d48', 'ico' => 'fa-trash-alt', 'label' => 'Document Scan Removed'],
                                'case_view'        => ['bg' => '#faf5ff', 'color' => '#7c3aed', 'ico' => 'fa-eye', 'label' => 'File / PDF Accessed'],
                                'export_pdf'       => ['bg' => '#fdf2f8', 'color' => '#db2777', 'ico' => 'fa-file-pdf', 'label' => 'Exported PDF'],
                                'export_csv'       => ['bg' => '#f0fdf4', 'color' => '#16a34a', 'ico' => 'fa-file-csv', 'label' => 'Exported CSV'],
                                'summary_update'   => ['bg' => '#f0f9ff', 'color' => '#0284c7', 'ico' => 'fa-edit', 'label' => 'Summary Updated'],
                                'status_update'    => ['bg' => '#f8fafc', 'color' => '#475569', 'ico' => 'fa-sync-alt', 'label' => 'Status Updated'],
                                'referral_edit'    => ['bg' => '#fffbeb', 'color' => '#d97706', 'ico' => 'fa-pen-nib', 'label' => 'Referral Edited'],
                                'incident_created' => ['bg' => '#f5f3ff', 'color' => '#6d28d9', 'ico' => 'fa-plus-circle', 'label' => 'Incident Filed'],
                                default            => ['bg' => '#f8fafc', 'color' => '#64748b', 'ico' => 'fa-info-circle', 'label' => ucfirst(str_replace('_',' ',$log->action))]
                            };
                        @endphp
                        <div class="audit-item" x-show="auditSearch === '' || '{{ strtolower($log->staff_name . ' ' . $log->action . ' ' . $log->case_code . ' ' . $log->details) }}'.includes(auditSearch.toLowerCase())">
                            <div class="audit-ico" style="background:{{ $actionConfig['bg'] }};color:{{ $actionConfig['color'] }};">
                                <i class="fas {{ $actionConfig['ico'] }}"></i>
                            </div>
                            <div style="flex:1;">
                                <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap;">
                                    <div style="font-size:11.5px;font-weight:900;color:var(--text);">
                                        <span style="color:{{ $actionConfig['color'] }};">[{{ $actionConfig['label'] }}]</span>
                                        @if($log->case_code)
                                            <span style="color:#7c3aed;margin-left:4px;">#{{ $log->case_code }}</span>
                                        @endif
                                    </div>
                                    <div style="font-size:9.5px;color:var(--muted);font-weight:600;">
                                        {{ $log->created_at->format('M d, Y h:i A') }} ({{ $log->created_at->diffForHumans() }})
                                    </div>
                                </div>
                                <div style="font-size:11px;color:#334155;font-weight:600;margin-top:3px;line-height:1.4;">
                                    {{ $log->details ?: 'Activity performed on confidential records.' }}
                                </div>
                                <div style="display:flex;gap:12px;font-size:9px;color:var(--muted);font-weight:700;margin-top:5px;">
                                    <span><i class="fas fa-user-shield"></i> {{ $log->staff_name }} ({{ $log->staff_role }})</span>
                                    <span><i class="fas fa-network-wired"></i> IP: {{ $log->ip_address ?? '127.0.0.1' }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="tbl-empty"><i class="fas fa-clipboard-check"></i><p style="font-size:11px;font-weight:700;">No audit trail records yet.</p></div>
                        @endforelse
                    </div>

                    <div style="display:flex;justify-content:flex-end;margin-top:14px;">
                        <button type="button" @click="auditModal=false" class="btn btn-ghost btn-sm">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 4. EXPORT SELECTION MODAL (PDF / CSV OPTIONS) ══ --}}
        <div x-show="exportModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width: 520px;" @click.away="exportModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:var(--brand);"><i class="fas fa-file-export"></i></div>
                            <div>
                                <div>Export Confidential VAWC Reports</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Piliin ang format at timeframe para sa pag-export</div>
                            </div>
                        </div>
                        <button @click="exportModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <div class="sblk" style="margin-bottom:14px;">
                        <div class="fgrid2 fgrp">
                            <div>
                                <label class="flbl">Select Timeframe / Period</label>
                                <select x-model="exportPeriod" class="finput fselect">
                                    <option value="all">Buong Kasaysayan (All Records)</option>
                                    <option value="today">Ngayong Araw (Today)</option>
                                    <option value="month">Kasalukuyang Buwan ({{ date('F Y') }})</option>
                                    <option value="year">Kasalukuyang Taon ({{ date('Y') }})</option>
                                </select>
                            </div>
                            <div>
                                <label class="flbl">Report Scope</label>
                                <select x-model="exportType" class="finput fselect">
                                    <option value="all">Lahat ng VAWC Incidents</option>
                                    <option value="pnp_referrals">PNP / DSWD Referrals Lamang</option>
                                    <option value="settled">Resolved / Settled Cases Lamang</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;">
                        {{-- PDF OPTION --}}
                        <a :href="'/vawc/export?format=pdf&period=' + exportPeriod + '&type=' + exportType" target="_blank" @click="exportModal=false"
                           style="background:linear-gradient(135deg,#7c3aed,#5b21b6);color:#fff;border-radius:12px;padding:16px 14px;text-align:center;text-decoration:none;transition:all .18s;box-shadow:0 4px 12px rgba(124,58,237,.25);"
                           onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                            <i class="fas fa-file-pdf" style="font-size:26px;margin-bottom:6px;display:block;"></i>
                            <div style="font-size:12px;font-weight:900;text-transform:uppercase;">Official PDF Transmittal</div>
                            <div style="font-size:8.5px;color:#e9d5ff;margin-top:3px;font-weight:600;">Printable & compliant summary report</div>
                        </a>

                        {{-- CSV OPTION --}}
                        <a :href="'/vawc/export?format=csv&period=' + exportPeriod + '&type=' + exportType" @click="exportModal=false"
                           style="background:linear-gradient(135deg,#16a34a,#15803d);color:#fff;border-radius:12px;padding:16px 14px;text-align:center;text-decoration:none;transition:all .18s;box-shadow:0 4px 12px rgba(22,163,74,.25);"
                           onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                            <i class="fas fa-file-csv" style="font-size:26px;margin-bottom:6px;display:block;"></i>
                            <div style="font-size:12px;font-weight:900;text-transform:uppercase;">Download CSV Spreadsheet</div>
                            <div style="font-size:8.5px;color:#bbf7d0;margin-top:3px;font-weight:600;">Full data for Excel & analysis</div>
                        </a>
                    </div>

                    <div style="display:flex;justify-content:flex-end;">
                        <button type="button" @click="exportModal=false" class="btn btn-ghost btn-sm">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ══ 5. VIEW INCIDENT DETAILS MODAL ══ --}}
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
                            <div style="margin-bottom:14px;display:flex;gap:6px;align-items:center;flex-wrap:wrap;">
                                <template x-if="activeIssue.status==='urgent'">
                                    <span class="spill spill-urgent" style="font-size:11px;padding:5px 14px;"><i class="fas fa-exclamation-triangle"></i> URGENT RESCUE</span>
                                </template>
                                <template x-if="activeIssue.status==='submitted'">
                                    <span class="spill spill-new" style="font-size:11px;padding:5px 14px;"><i class="fas fa-clock"></i> New Submission</span>
                                </template>
                                <template x-if="activeIssue.status==='under_review'">
                                    <span class="spill spill-active" style="font-size:11px;padding:5px 14px;"><i class="fas fa-search"></i> Under Review</span>
                                </template>
                                <template x-if="activeIssue.status==='approved'">
                                    <span class="spill spill-settled" style="font-size:11px;padding:5px 14px;"><i class="fas fa-thumbs-up"></i> Approved</span>
                                </template>
                                <template x-if="activeIssue.status==='settled'">
                                    <span class="spill spill-settled" style="font-size:11px;padding:5px 14px;"><i class="fas fa-check-circle"></i> Resolved</span>
                                </template>
                                <template x-if="activeIssue.status==='pending'">
                                    <span class="spill spill-pending" style="font-size:11px;padding:5px 14px;"><i class="fas fa-pause-circle"></i> Pending</span>
                                </template>
                                <template x-if="activeIssue.status==='rejected'">
                                    <span class="spill spill-new" style="font-size:11px;padding:5px 14px;"><i class="fas fa-times-circle"></i> Rejected</span>
                                </template>
                                <template x-if="activeIssue.transfer_count > 0">
                                    <span class="spill spill-active" style="font-size:11px;padding:5px 14px;background:#eff6ff;color:#1d4ed8;"><i class="fas fa-exchange-alt"></i> Re-routed</span>
                                </template>
                            </div>

                            {{-- Case Info --}}
                            <template x-if="activeIssue.admin_notes && activeIssue.admin_notes.includes('AUTO-FLAGGED')">
                                <div style="background:#fdf4ff;border:1.5px solid #c4b5fd;border-radius:10px;padding:10px 14px;margin-bottom:12px;color:#6d28d9;font-size:11px;font-weight:800;line-height:1.4;">
                                    <i class="fas fa-shield-alt"></i> <span style="text-transform:uppercase;font-weight:900;">Auto-Routing Triage Flag:</span> 
                                    <span style="font-weight:600;color:#4c1d95;" x-text="activeIssue.admin_notes"></span>
                                </div>
                            </template>
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
                                        <div class="dfield-val">
                                            <span x-text="activeIssue.complainant_name"></span>
                                            <template x-if="!activeIssue.user_id">
                                                <span class="cbadge cbadge-red" style="font-size:7px; padding:2px 6px; vertical-align:middle; margin-left:4px;">GUEST</span>
                                            </template>
                                        </div>
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

                            {{-- DEDICATED VICTIM INFO (IF ON BEHALF) --}}
                            <template x-if="activeIssue.is_on_behalf && activeIssue.victim_name">
                                <div class="sblk" style="background:#fdf4ff;border-color:#f0abfc;">
                                    <div class="sblk-ttl" style="color:#a21caf;"><i class="fas fa-shield-alt"></i> Victim Information (Filed On Behalf)</div>
                                    <div class="fgrid2" style="gap:8px;">
                                        <div class="dfield" style="grid-column:span 2;background:#fff;border-color:#f5d0fe;">
                                            <div class="dfield-lbl" style="color:#a21caf;">Victim Full Name</div>
                                            <div class="dfield-val" x-text="activeIssue.victim_name"></div>
                                        </div>
                                        <div class="dfield" style="background:#fff;border-color:#f5d0fe;">
                                            <div class="dfield-lbl" style="color:#a21caf;">Victim Age</div>
                                            <div class="dfield-val" x-text="activeIssue.victim_age || 'N/A'"></div>
                                        </div>
                                        <div class="dfield" style="background:#fff;border-color:#f5d0fe;">
                                            <div class="dfield-lbl" style="color:#a21caf;">Victim Gender</div>
                                            <div class="dfield-val" x-text="activeIssue.victim_gender || 'N/A'"></div>
                                        </div>
                                        <div class="dfield" style="grid-column:span 2;background:#fff;border-color:#f5d0fe;">
                                            <div class="dfield-lbl" style="color:#a21caf;">Relationship to Complainant</div>
                                            <div class="dfield-val" x-text="activeIssue.victim_relationship || 'Dependent'"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>

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

                            {{-- Attached Official Scan if available --}}
                            <template x-if="activeIssue.official_document">
                                <div class="sblk" style="border-color:#a7f3d0;background:#f0fdf4;">
                                    <div class="sblk-ttl" style="color:#059669;"><i class="fas fa-paperclip"></i> Attached Official Barangay Scan / Form</div>
                                    <div style="display:flex;align-items:center;justify-content:space-between;background:#fff;padding:10px 12px;border-radius:8px;border:1px solid #a7f3d0;">
                                        <div style="font-size:11px;font-weight:800;color:#065f46;" x-text="activeIssue.official_document_name || 'Official Document Attached'"></div>
                                        <a :href="activeIssue.official_document_url" target="_blank" class="btn btn-sm btn-ghost" style="background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;">
                                            <i class="fas fa-eye"></i> View Scan
                                        </a>
                                    </div>
                                </div>
                            </template>

                            {{-- Transfer Reason if transferred --}}
                            <template x-if="activeIssue.transfer_reason">
                                <div class="sblk" style="border-color:#bfdbfe;background:#eff6ff;">
                                    <div class="sblk-ttl" style="color:#1d4ed8;"><i class="fas fa-exchange-alt"></i> Re-routing Transfer Reason</div>
                                    <div style="background:#fff;border:1px solid #bfdbfe;border-radius:8px;padding:12px;font-size:12px;font-weight:600;color:#1e3a8a;line-height:1.7;white-space:pre-wrap;" x-text="activeIssue.transfer_reason"></div>
                                </div>
                            </template>

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

                            <div style="display:flex;justify-content:space-between;gap:8px;margin-top:14px;flex-wrap:wrap;">
                                <button type="button" @click="openReferralPreview(activeIssue); viewModal=false;" class="btn btn-vawc btn-sm">
                                    <i class="fas fa-file-pdf"></i> Open Referral Document / Scans
                                </button>
                                <button @click="viewModal=false" class="btn btn-ghost btn-sm">Close</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- ══ 6. NEW INCIDENT MODAL ══ --}}
        <div x-show="newIncidentModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="newIncidentModal=false" x-data="{ newIsOnBehalf: false }">
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

                    <form action="{{ url('/vawc/issues') }}" method="POST" enctype="multipart/form-data">
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
                                <div><label class="flbl">Date & Time of Incident *</label><input type="datetime-local" name="incident_date" required class="finput" max="{{ date('Y-m-d\TH:i') }}" min="{{ date('Y-m-d\TH:i', strtotime('-6 months')) }}"></div>
                                <div><label class="flbl">Location *</label><input type="text" name="incident_location" required placeholder="Purok, Street, Block..." class="finput"></div>
                            </div>
                        </div>

                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant Information</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Full Name *</label><input type="text" name="complainant_name" required class="finput" placeholder="Full name"></div>
                                <div><label class="flbl">Age *</label><input type="number" name="complainant_age" min="18" required class="finput" placeholder="Min. 18"></div>
                                <div>
                                    <label class="flbl">Gender</label>
                                    <select name="complainant_gender" class="finput fselect">
                                        <option value="">Select</option>
                                        <option>Female</option>
                                        <option>Male</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div><label class="flbl">Contact Number *</label><input type="text" name="contact" required class="finput" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');"></div>
                                <div class="fspan2"><label class="flbl">Address</label><input type="text" name="complainant_address" class="finput" placeholder="Blk/Lot, Street..."></div>
                            </div>

                            {{-- BEHALF TOGGLE --}}
                            <div style="margin-top: 10px; padding: 10px 12px; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px;">
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 11px; font-weight: 800; color: #1e293b;">
                                    <input type="checkbox" name="is_on_behalf" value="1" x-model="newIsOnBehalf" style="width: 16px; height: 16px; accent-color: var(--vawc); cursor: pointer;">
                                    <span><i class="fas fa-hands-helping" style="color: var(--vawc); margin-right: 4px;"></i> Filing on behalf of a victim / dependent</span>
                                </label>
                            </div>

                            {{-- VICTIM INFORMATION SECTION --}}
                            <div x-show="newIsOnBehalf" x-transition style="margin-top: 12px; padding: 12px; background: #fdf4ff; border: 1.5px solid #f0abfc; border-radius: 10px;">
                                <div style="font-size: 9px; font-weight: 900; text-transform: uppercase; color: #a21caf; margin-bottom: 8px; display: flex; align-items: center; gap: 5px;">
                                    <i class="fas fa-shield-alt"></i> Dedicated Victim Information
                                </div>
                                <div class="fgrid2 fgrp">
                                    <div class="fspan2">
                                        <label class="flbl" style="color: #86198f;">Victim Full Name <span style="color:#dc2626;">*</span></label>
                                        <input type="text" name="victim_name" :required="newIsOnBehalf" class="finput" placeholder="Full name of victim/dependent" style="border-color: #f0abfc; background: #fff;">
                                    </div>
                                    <div>
                                        <label class="flbl" style="color: #86198f;">Victim Age <span style="color:#dc2626;">*</span></label>
                                        <input type="number" name="victim_age" :required="newIsOnBehalf" min="0" max="120" class="finput" placeholder="e.g. 14" style="border-color: #f0abfc; background: #fff;">
                                    </div>
                                    <div>
                                        <label class="flbl" style="color: #86198f;">Victim Gender <span style="color:#dc2626;">*</span></label>
                                        <select name="victim_gender" :required="newIsOnBehalf" class="finput fselect" style="border-color: #f0abfc; background: #fff;">
                                            <option value="">Select Gender</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="fspan2">
                                        <label class="flbl" style="color: #86198f;">Relationship to Complainant <span style="color:#dc2626;">*</span></label>
                                        <input type="text" name="victim_relationship" :required="newIsOnBehalf" class="finput" placeholder="e.g. Daughter, Son, Spouse, Sister, Neighbor, etc." style="border-color: #f0abfc; background: #fff;">
                                    </div>
                                </div>
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
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Witness Name (Optional)</label><input type="text" name="witness_name" class="finput" placeholder="Name of witness"></div>
                            <div><label class="flbl">Upload Proof / Documents (Optional)</label><input type="file" name="evidence[]" multiple accept="image/*,video/*,.pdf" class="finput" style="padding:6px;"></div>
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

        {{-- ══ 7. REJECT INCIDENT MODAL ══ --}}
        <div x-show="rejectModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:460px;" @click.away="rejectModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#fee2e2;"><i class="fas fa-times" style="color:#dc2626;"></i></div>
                            <div>
                                <div>Reject Incident Report</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Please provide a reason</div>
                            </div>
                        </div>
                        <button @click="rejectModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form :action="'/vawc/issues/'+rejectFormData.id+'/status'" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <div class="fgrp">
                            <label class="flbl">Reason for Rejection *</label>
                            <textarea name="rejection_reason" required rows="3" class="finput" style="resize:vertical;" placeholder="e.g. This appears to be a trivial matter outside barangay jurisdiction..."></textarea>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="rejectModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="background:var(--danger);"><i class="fas fa-times"></i> Reject Case</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ 8. IMPORT VAWC MODAL ══ --}}
        <div x-show="importModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="importModal=false" style="max-width: 600px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#fdf4ff;color:#7c3aed;"><i class="fas fa-file-excel"></i></div>
                            <div>
                                <div>Import Confidential VAWC Records</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Upload Excel (.xlsx, .xls) or CSV files into the VAWC Portal</div>
                            </div>
                        </div>
                        <button @click="importModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ route('vawc.import') }}" method="POST" enctype="multipart/form-data" x-data="{ importCount: 0, importFileName: '', isDragging: false }">
                        @csrf

                        <div style="background:linear-gradient(135deg,#faf5ff 0%,#f5f3ff 100%);border:1.5px solid #ddd6fe;border-radius:12px;padding:12px 14px;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:9px;background:#ede9fe;display:flex;align-items:center;justify-content:center;color:#7c3aed;font-size:15px;flex-shrink:0;">
                                    <i class="fas fa-file-csv"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:#5b21b6;">Download Sample Template</div>
                                    <div style="font-size:9px;font-weight:600;color:var(--muted);">Use this pre-formatted CSV template to organize VAWC confidential records.</div>
                                </div>
                            </div>
                            <a href="{{ route('vawc.sample.template') }}" class="btn btn-sm" style="background:#7c3aed;color:#fff;text-decoration:none;box-shadow:0 2px 6px rgba(124,58,237,0.25);">
                                <i class="fas fa-download"></i> Get Template
                            </a>
                        </div>

                        <div class="sblk" style="margin-bottom:12px;">
                            <div class="sblk-ttl" style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;margin-bottom:6px;"><i class="fas fa-cloud-upload-alt" style="color:#7c3aed;"></i> Select File To Import</div>
                            <div class="upload-card"
                                 :style="isDragging ? 'border-color:#7c3aed; background:#faf5ff;' : ''"
                                 @click="$refs.importFileInput.click()"
                                 @dragover.prevent="isDragging = true"
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="isDragging = false; $refs.importFileInput.files = $event.dataTransfer.files; importCount = $refs.importFileInput.files.length; importFileName = $refs.importFileInput.files[0]?.name || ''"
                                 style="padding:20px 14px;min-height:95px;border:2px dashed var(--border);border-radius:12px;background:#f8fafc;display:flex;align-items:center;justify-content:center;flex-direction:column;cursor:pointer;transition:all .15s;">
                                <i class="fas fa-file-excel" style="font-size:26px;color:#16a34a;margin-bottom:4px;"></i>
                                <div class="upload-txt" style="font-size:11px;font-weight:800;color:var(--text);" x-text="importFileName ? importFileName : 'Click to browse or drag & drop file here'"></div>
                                <div style="font-size:8.5px;font-weight:600;color:var(--muted);margin-top:2px;">Supported formats: .xlsx, .xls, .csv, .txt (Max: 10MB)</div>
                                <input type="file" x-ref="importFileInput" name="import_file" accept=".csv,.xlsx,.xls,.txt" style="display:none;" required @change="importCount = $event.target.files.length; importFileName = $event.target.files[0]?.name || ''">
                            </div>
                        </div>

                        <div class="sblk" style="background:#f8fafc;border-radius:10px;padding:11px;margin-bottom:14px;border:1px solid var(--border);">
                            <div class="sblk-ttl" style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;margin-bottom:6px;"><i class="fas fa-info-circle" style="color:#7c3aed;"></i> Expected Columns</div>
                            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:5px;font-size:9px;font-weight:700;color:#475569;">
                                <div>• <span style="color:#7c3aed;">Category / Type</span> (e.g. Physical Abuse)</div>
                                <div>• <span style="color:#7c3aed;">Complainant Name</span> (Full Name)</div>
                                <div>• <span style="color:#7c3aed;">Victim Name</span> (If on behalf)</div>
                                <div>• <span style="color:#7c3aed;">Contact Number</span> (e.g. 09123456789)</div>
                                <div>• <span style="color:#7c3aed;">Respondent Name</span> (Full Name)</div>
                                <div>• <span style="color:#7c3aed;">Incident Date</span> (YYYY-MM-DD)</div>
                            </div>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="importModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" :disabled="!importFileName" style="background:#7c3aed;color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:11px;font-weight:800;cursor:pointer;">
                                <i class="fas fa-file-import"></i> Upload & Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ UPLOAD CUSTOM TEMPLATE / FORMAT MODAL ══ --}}
        <div x-show="templateUploadModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:520px;" @click.away="templateUploadModal=false">
                <div class="modal-in" style="padding:22px 24px;">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:#2563eb;"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div>
                                <div>Upload Custom Report Format / Template</div>
                                <div style="font-size:9px;color:var(--muted);font-weight:600;text-transform:none;">Upload updated DILG / LGU compliance template (PDF, DOCX, XLSX, JPG, PNG)</div>
                            </div>
                        </div>
                        <button type="button" @click="templateUploadModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ route('department.reports.upload_template') }}" method="POST" enctype="multipart/form-data" style="margin-top:14px;">
                        @csrf
                        <input type="hidden" name="department" value="VAWC">
                        <div style="background:#f8fafc;border:2px dashed #cbd5e1;border-radius:12px;padding:24px 16px;text-align:center;cursor:pointer;margin-bottom:16px;"
                             @click="$refs.customTemplateInput.click()">
                            <i class="fas fa-file-upload" style="font-size:32px;color:#2563eb;margin-bottom:8px;"></i>
                            <div style="font-size:12px;font-weight:800;color:var(--text);" x-ref="customTemplateTxt">Click to select new template file</div>
                            <div style="font-size:9px;color:var(--muted);margin-top:4px;">Supported: PDF, XLSX, DOCX, PNG, JPG (Max: 15MB)</div>
                            <input type="file" x-ref="customTemplateInput" name="template_file" style="display:none;" required
                                   @change="$refs.customTemplateTxt.innerText = $event.target.files[0]?.name || 'File selected'">
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;">
                            <button type="button" @click="templateUploadModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="background:#2563eb;color:#fff;">
                                <i class="fas fa-cloud-upload-alt"></i> Upload & Set Active Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        function printVawcReportHelper() {
            const el = document.getElementById('vawc-printable-report');
            if (!el) return;
            const printContent = el.innerHTML;
            const printWindow = window.open('', '_blank', 'width=1100,height=800');
            printWindow.document.write('<!DOCTYPE html><html><head><title>MONITORING COMPLIANCE TO RA:9262 VAWC</title><link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet"><style>@page{size:landscape;margin:10mm;}body{font-family:\'Times New Roman\',serif;margin:0;padding:15px;color:#000;background:#fff;}input{border:none!important;background:transparent!important;font-family:inherit!important;font-size:inherit!important;font-weight:inherit!important;text-align:center!important;}table{width:100%;border-collapse:collapse;font-size:10px;}th,td{border:1px solid #000;padding:4px 2px;}</style></head><body>' + printContent + '</body></html>');
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => { printWindow.print(); printWindow.close(); }, 400);
        }

        function printReferralPreviewHelper(docViewMode, officialDocUrl, caseCode) {
            if (docViewMode === 'scan' && officialDocUrl) {
                const printWindow = window.open(officialDocUrl, '_blank');
                if (printWindow) {
                    printWindow.focus();
                    printWindow.print();
                }
                return;
            }
            const el = document.getElementById('referral-printable-sheet');
            if (!el) return;
            const printContent = el.innerHTML;
            const printWindow = window.open('', '_blank', 'width=850,height=900');
            printWindow.document.write('<html><head><title>PNP Referral Document - #' + caseCode + '</title><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&family=Times+New+Roman&display=swap" rel="stylesheet"><style>body{font-family:\'Times New Roman\',serif;margin:0;padding:20mm;background:white;color:#000;}.ref-head{text-align:center;border-bottom:2px solid #000;padding-bottom:10px;margin-bottom:16px;display:flex;align-items:center;justify-content:center;gap:14px;}.ref-head h1{font-size:14px;margin:3px 0 0 0;font-weight:bold;text-transform:uppercase;}.ref-head h2{font-size:11.5px;margin:0;font-weight:normal;}.ref-title{text-align:center;font-size:14px;font-weight:bold;text-decoration:underline;text-transform:uppercase;margin:12px 0 14px;}.ref-row{display:flex;margin-bottom:6px;font-size:12px;}.ref-col-lbl{width:170px;font-weight:bold;font-family:\'Plus Jakarta Sans\',sans-serif;font-size:10px;text-transform:uppercase;}.ref-col-val{flex:1;border-bottom:1px dotted #000;padding-bottom:2px;font-size:12.5px;}.ref-sect{margin:14px 0 6px;text-decoration:underline;font-size:12px;font-weight:bold;text-transform:uppercase;font-family:\'Plus Jakarta Sans\',sans-serif;}.ref-box{border:1px solid #000;padding:10px 12px;margin-top:4px;min-height:80px;font-size:12px;line-height:1.5;}.footer{margin-top:35px;display:flex;justify-content:space-between;}.sig-line{width:220px;text-align:center;font-size:12px;}.sig-line div{border-bottom:1px solid #000;height:35px;margin-bottom:4px;}</style></head><body>' + printContent + '</body></html>');
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => { printWindow.print(); printWindow.close(); }, 400);
        }
    </script>
</x-app-layout>