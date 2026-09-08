<x-app-layout>
<style>
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

.master-tbl{table-layout:fixed;}
.master-tbl th:nth-child(1){text-align:center;width:65px;}
.master-tbl th:nth-child(2){width:35%;}
.master-tbl th:nth-child(3){width:25%;}
.master-tbl th:nth-child(4){text-align:center;width:15%;}
.master-tbl th:nth-child(5){text-align:right;width:15%;}

.res-table th:last-child{text-align:right;}
.res-table thead tr th { border-bottom: 2px solid #e2e8f0; }

    @media (max-width: 768px) {
        .res-table thead { display: none; }
        .res-table tr { 
            display: block; 
            margin-bottom: 1rem; 
            border: 1.5px solid var(--border); 
            border-radius: 12px; 
            padding: 12px; 
            background: #fff; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .res-table td { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 8px 0; 
            border: none; 
            text-align: right; 
            font-size: 11px; 
        }
        .res-table td::before { 
            content: attr(data-label); 
            font-weight: 800; 
            color: var(--muted); 
            text-align: left; 
            font-size: 10px; 
            text-transform: uppercase; 
            margin-right: 15px;
        }
        .res-table td:last-child { 
            border-top: 1px solid var(--border); 
            margin-top: 8px; 
            padding-top: 12px; 
            justify-content: flex-end; 
            gap: 5px;
        }

        /* Portal Responsiveness Refinements */
        .page-wrap { padding: 12px 10px; }
        .search-area { padding: 12px 15px; margin-bottom: 15px; }
        .filter-row, .tab-row { gap: 5px; }
        .filter-pill, .tab-pill { padding: 4px 10px; font-size: 8px; }
        .doc-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .main-grid { grid-template-columns: 1fr; gap: 15px; }
        .header-btn-grad { padding: 8px 12px; font-size: 10px; }
        .modal-box { width: 98%; margin: 5px; max-height: 95vh; }
        .fgrid2, .fgrid3 { grid-template-columns: 1fr; }
        .btn-grad, .btn-plain { padding: 10px; font-size: 10px; flex: 1; justify-content: center; }
    }
    .highlight-row {
        background-color: #eff6ff !important;
        transition: background-color 0.5s ease;
    }
    .res-row-hover { cursor: pointer; transition: background 0.1s; }
    .res-row-hover:hover { background: #f1f5f9 !important; }
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
.finput{width:100%;min-width:0;padding:9px 13px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s,background .15s;}
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
    .header-btn-grad{padding:8px 10px; font-size:11px; flex:1; justify-content:center;}
    .header-btn-grad span{display:none;}
    .header-btn-grad i{margin:0; font-size:14px;}
}
@media(max-width:400px){
    .header-btn-grad span{display:none;}
    .flex-wrap.items-center.gap-2{flex-direction:column; width:100%;}
    .header-btn-grad{width:100%;}
}
@keyframes notif-pulse {
    0%,100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(239,68,68,.5); }
    50%      { transform: scale(1.1); box-shadow: 0 0 0 5px rgba(239,68,68,0); }
}
.highlight-row {
    background-color: #e0f2fe !important;
    outline: 2px solid #38bdf8 !important;
    box-shadow: 0 0 14px rgba(14, 165, 233, 0.3) !important;
    animation: highlight-pulse 3.5s ease-out !important;
}
.highlight-row td {
    background-color: #e0f2fe !important;
}
@keyframes highlight-pulse {
    0%   { background-color: #bae6fd; }
    50%  { background-color: #e0f2fe; }
    100% { background-color: inherit; }
}
</style>



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
                'is_non_voter'     => $u->is_non_voter ? true : false,
                'is_senior'        => $u->is_senior ? true : false,
                'is_pwd'           => $u->is_pwd ? true : false,
                'is_single_parent' => $u->is_single_parent ? true : false,
                'is_student'       => $u->is_student ? true : false,
                'is_bedridden'     => $u->is_bedridden ? true : false,
                'is_household_head'=> $u->is_household_head ? true : false,
                'household_id'     => $u->household_id,
                'household_head_id'=> $u->household_head_id,
                'relationship'     => $u->relationship ?? 'Member',
                'verification_status'=> $u->verification_status ?? 'verified',
                'memberships'      => is_array($u->memberships) ? $u->memberships : (is_string($u->memberships) ? json_decode($u->memberships, true) : []),
                'email'            => $u->user ? $u->user->email : '',
                'photo'            => $u->photo ? asset('storage/' . $u->photo) : null,
                'digital_id_generated' => ($u->user && $u->user->digitalId && $u->user->digitalId->status === 'generated') ? true : false,
                'digital_id_number' => ($u->user && $u->user->digitalId && $u->user->digitalId->status === 'generated') ? $u->user->digitalId->id_number : null,
                'emergency_contact_name' => ($u->user && $u->user->digitalId) ? ($u->user->digitalId->emergency_contact_name ?? '') : ($u->emergency_contact_name ?? ''),
                'emergency_contact_number' => ($u->user && $u->user->digitalId) ? ($u->user->digitalId->emergency_contact_number ?? '') : ($u->emergency_contact_number ?? ''),
            ];
        });
    @endphp

    <script>
        window._allResidents = @json($allResidents);
    </script>

    <div x-data="officePortal()">

        {{-- ══ HEADER ══ --}}
        <x-slot name="header">
            <div class="flex flex-wrap items-center justify-between gap-y-4">
                <div class="flex items-center gap-4 min-w-max">
                    <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white shadow-sm flex-shrink-0" style="background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);">
                        <i class="fas fa-users-cog text-lg"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-xl text-gray-800 leading-tight uppercase tracking-tight">{{ __('Office Administration Portal') }}</h2>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Barangay San Miguel II • Dasmariñas, Cavite</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2 sm:gap-3 justify-end flex-1 sm:flex-none w-full sm:w-auto">
                    <div x-data="{ openNotif: false }" class="relative">
                        <button @click="openNotif = !openNotif" class="header-notif-btn">
                            <i class="fas fa-bell"></i>
                            @php
                                $totalPending = ($pendingDocCount ?? 0) + ($pendingIdCount ?? 0) + ($pendingVotersCount ?? 0) + ($pendingResidentsCount ?? 0) + ($pendingPetVaccines ?? 0);
                            @endphp
                            @if($totalPending > 0)
                                <span style="position:absolute;top:-3px;right:-3px;background:#ef4444;color:#fff;font-size:8px;font-weight:900;min-width:15px;height:15px;border-radius:99px;display:flex;align-items:center;justify-content:center;padding:0 3px;border:1.5px solid #fff;animation:notif-pulse 1.8s infinite;">
                                    {{ $totalPending }}
                                </span>
                            @endif
                        </button>
                        <div x-show="openNotif" @click.away="openNotif = false" class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden" x-transition x-cloak>
                            <div class="p-3 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase tracking-wider text-gray-500">Pending Tasks</span>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                @forelse($documentRequests->where('status', 'pending') as $req)
                                    <button type="button" @click="openNotif=false; goToNotificationTask({ tab: 'requests', docFilter: 'all', rowId: 'doc-req-{{ $req->id }}' })" class="w-full text-left p-3 hover:bg-blue-50 border-b border-gray-50 flex items-center gap-3 transition-colors cursor-pointer">
                                        <div class="h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0"><i class="fas fa-file-alt"></i></div>
                                        <div style="min-width:0;flex:1;">
                                            <div class="text-xs font-bold text-gray-800 truncate">{{ ucwords(str_replace('_',' ',$req->document_type)) }} Request</div>
                                            <div class="text-[9px] text-gray-500 truncate">From: {{ trim(($req->user?->first_name ?? '') . ' ' . ($req->user?->last_name ?? '')) ?: trim(($req->guest_first_name ?? '') . ' ' . ($req->guest_last_name ?? '')) ?: 'Unknown' }}</div>
                                            <div class="text-[8px] text-blue-500 font-bold mt-0.5">{{ $req->created_at->diffForHumans() }}</div>
                                        </div>
                                    </button>
                                @empty
                                @endforelse

                                @forelse($digitalIdRequests as $idReq)
                                    <button type="button" @click="openNotif=false; goToNotificationTask({ tab: 'requests', rowId: 'id-req-{{ $idReq->id }}' })" class="w-full text-left p-3 hover:bg-amber-50 border-b border-gray-50 flex items-center gap-3 transition-colors cursor-pointer">
                                        <div class="h-8 w-8 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0"><i class="fas fa-id-card"></i></div>
                                        <div style="min-width:0;flex:1;">
                                            <div class="text-xs font-bold text-gray-800 truncate">Digital ID Request</div>
                                            <div class="text-[9px] text-gray-500 truncate">Resident: {{ trim(($idReq->user?->first_name ?? '') . ' ' . ($idReq->user?->last_name ?? '')) ?: 'Unknown' }}</div>
                                            <div class="text-[8px] text-amber-500 font-bold mt-0.5">{{ $idReq->created_at->diffForHumans() }}</div>
                                        </div>
                                    </button>
                                @empty
                                @endforelse

                                @forelse($pendingVoters as $pv)
                                    <button type="button" @click="openNotif=false; goToNotificationTask({ tab: 'requests', rowId: 'voter-req-{{ $pv->id }}' })" class="w-full text-left p-3 hover:bg-red-50 border-b border-gray-50 flex items-center gap-3 transition-colors cursor-pointer">
                                        <div class="h-8 w-8 rounded-lg bg-red-100 flex items-center justify-center text-red-600 flex-shrink-0"><i class="fas fa-user-check"></i></div>
                                        <div style="min-width:0;flex:1;">
                                            <div class="text-xs font-bold text-gray-800 truncate">Voter Verification</div>
                                            <div class="text-[9px] text-gray-500 truncate">Voter: {{ $pv->first_name }} {{ $pv->last_name }}</div>
                                            <div class="text-[8px] text-red-500 font-bold mt-0.5">{{ $pv->created_at->diffForHumans() }}</div>
                                        </div>
                                    </button>
                                @empty
                                @endforelse

                                @forelse($pendingResidents as $pr)
                                    <button type="button" @click="openNotif=false; goToNotificationTask({ tab: 'masterlist', filter: '', rowId: 'res-{{ $pr->id }}' })" 
                                            class="w-full text-left p-3 hover:bg-purple-50 border-b border-gray-50 flex items-center gap-3 transition-colors cursor-pointer">
                                        <div class="h-8 w-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 flex-shrink-0"><i class="fas fa-user-clock"></i></div>
                                        <div style="min-width:0;flex:1;">
                                            <div class="text-xs font-bold text-gray-800 truncate">New Resident Verification</div>
                                            <div class="text-[9px] text-gray-500 truncate">Resident: {{ $pr->first_name }} {{ $pr->last_name }}</div>
                                            <div class="text-[8px] text-purple-500 font-bold mt-0.5">{{ $pr->created_at->diffForHumans() }}</div>
                                        </div>
                                    </button>
                                @empty
                                @endforelse

                                @forelse(($pendingVerifications ?? collect()) as $pv)
                                    <button type="button" @click="openNotif=false; activeTab='verifications'" class="w-full text-left p-3 hover:bg-emerald-50 border-b border-gray-50 flex items-center gap-3 transition-colors cursor-pointer">
                                        <div class="h-8 w-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0"><i class="fas fa-user-check"></i></div>
                                        <div style="min-width:0;flex:1;">
                                            <div class="text-xs font-bold text-gray-800 truncate">Verification Request ({{ $pv->confidence_score }}% Match)</div>
                                            <div class="text-[9px] text-gray-500 truncate">Registrant: {{ $pv->name }}</div>
                                            <div class="text-[8px] text-emerald-600 font-bold mt-0.5">{{ $pv->created_at ? $pv->created_at->diffForHumans() : 'Pending' }}</div>
                                        </div>
                                    </button>
                                @empty
                                @endforelse

                                @forelse(($pets ?? collect())->where('vaccination_status', 'pending') as $petPending)
                                    <button type="button" @click="openNotif=false; goToNotificationTask({ modal: 'petTracker', rowId: 'pet-row-{{ $petPending->id }}' })" class="w-full text-left p-3 hover:bg-yellow-50 border-b border-gray-50 flex items-center gap-3 transition-colors cursor-pointer">
                                        <div class="h-8 w-8 rounded-lg bg-yellow-100 flex items-center justify-center text-yellow-600 flex-shrink-0"><i class="fas fa-paw"></i></div>
                                        <div style="min-width:0;flex:1;">
                                            <div class="text-xs font-bold text-gray-800 truncate">Vaccine Review: {{ $petPending->pet_name }}</div>
                                            <div class="text-[9px] text-gray-500 truncate">Owner: {{ $petPending->resident->first_name ?? 'N/A' }} {{ $petPending->resident->last_name ?? '' }}</div>
                                            <div class="text-[8px] text-yellow-600 font-bold mt-0.5">{{ $petPending->created_at ? $petPending->created_at->diffForHumans() : 'Pending' }}</div>
                                        </div>
                                    </button>
                                @empty
                                @endforelse

                                @if($totalPending == 0)
                                    <div class="p-8 text-center text-gray-400">
                                        <i class="fas fa-check-circle text-2xl mb-2 opacity-20"></i>
                                        <div class="text-[10px] font-bold">All caught up!</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <button onclick="window.dispatchEvent(new CustomEvent('open-import-modal'))" class="header-btn-grad">
                        <i class="fas fa-file-import"></i><span>Import</span>
                    </button>
                    <button onclick="window.dispatchEvent(new CustomEvent('open-add-modal'))" class="header-btn-grad">
                        <i class="fas fa-user-plus"></i><span>Add Resident</span>
                    </button>
                    <button onclick="window.dispatchEvent(new CustomEvent('open-digital-id'))" class="header-btn-grad">
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
                        <i class="fas fa-birthday-cake"></i> Bday This Month
                    </button>
                    <select x-model="activeFilter" @change="if(activeFilter) activeTab='masterlist'"
                            style="appearance:none; padding-right:24px; background-image:url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat:no-repeat; background-position:right .7em top 50%; background-size:.65em auto; outline:none; cursor:pointer;"
                            :class="['heads'].includes(activeFilter) ? 'filter-pill filter-pill-active' : 'filter-pill'">
                        <option value="" style="color:#333;">All Residents</option>
                        <option value="heads" style="color:#333;">Household Heads Only</option>
                    </select>
                    <select x-model="activeFilter" @change="if(activeFilter) activeTab='masterlist'"
                            style="appearance:none; padding-right:24px; background-image:url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat:no-repeat; background-position:right .7em top 50%; background-size:.65em auto; outline:none; cursor:pointer;"
                            :class="['senior','pwd','solo','nonvoter','bedridden'].includes(activeFilter) ? 'filter-pill filter-pill-active' : 'filter-pill'">
                        <option value="" style="color:#333;">Classification...</option>
                        <option value="senior" style="color:#333;">Seniors</option>
                        <option value="pwd" style="color:#333;">PWD</option>
                        <option value="solo" style="color:#333;">Solo Parent</option>
                        <option value="nonvoter" style="color:#333;">Non-Voters</option>
                        <option value="bedridden" style="color:#333;">Bed-ridden</option>
                    </select>
                    <select x-model="activeFilter" @change="if(activeFilter) activeTab='masterlist'"
                            style="appearance:none; padding-right:24px; background-image:url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-repeat:no-repeat; background-position:right .7em top 50%; background-size:.65em auto; outline:none; cursor:pointer;"
                            :class="['any_membership', '4ps', 'kdbm'].includes(activeFilter) ? 'filter-pill filter-pill-active' : 'filter-pill'">
                        <option value="" style="color:#333;">Select Membership...</option>
                        <option value="any_membership" style="color:#333;">All Memberships</option>
                        <option value="4ps" style="color:#333;">4Ps</option>
                        <option value="kdbm" style="color:#333;">KDBM</option>
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
                        <button @click="activeTab='verifications'" :class="activeTab==='verifications' ? 'tab-pill tab-pill-active' : 'tab-pill'" class="tab-pill">
                            <i class="fas fa-user-check"></i> Verification Requests
                            <span class="pill-cnt">{{ $pendingVerificationsCount ?? 0 }}</span>
                        </button>
                        <button @click="activeTab='archived'" :class="activeTab==='archived' ? 'tab-pill tab-pill-active' : 'tab-pill'" class="tab-pill">
                            <i class="fas fa-archive"></i> Archived Residents
                            <span class="pill-cnt">{{ $archivedResidentsCount ?? 0 }}</span>
                        </button>
                        <button @click="activeTab='reports'" :class="activeTab==='reports' ? 'tab-pill tab-pill-active' : 'tab-pill'" class="tab-pill">
                            <i class="fas fa-file-invoice"></i> Reports & Transmittals
                        </button>
                    </div>
                </div>
            </div>

            @include('office.partials._tab_dashboard')
            @include('office.partials._tab_masterlist')
            @include('office.partials._tab_requests')
            @include('office.partials._tab_verifications')
            @include('office.partials._tab_archived')
            @include('office.partials._tab_reports')

        </div>{{-- /page-wrap --}}

        @include('office.partials._modals')

    </div>{{-- /officePortal x-data --}}

    <footer style="text-align:center;padding:18px;font-size:10px;color:var(--light);font-weight:600;">
        © {{ date('Y') }} Barangay San Miguel II, Dasmariñas City, Cavite. All rights reserved.
    </footer>

    @include('office.partials._scripts')

</x-app-layout>
