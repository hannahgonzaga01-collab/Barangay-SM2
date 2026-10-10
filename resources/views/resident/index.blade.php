<x-app-layout>
<style>
:root{--brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;--body-bg:#f1f5f9;--border:#cbd5e1;--text:#0f172a;--muted:#334155;--light:#475569;--danger:#dc2626;--success:#059669;--card-shadow:0 4px 24px rgba(4,25,45,0.13),0 1.5px 6px rgba(0,0,0,0.07);--btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);--r-card:16px;--r-btn:10px;}
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
    overflow-x: hidden;
    width: 100%;
    max-width: 100vw;
    font-size: 14px;
    line-height: 1.5;
}
[x-cloak]{display:none!important;}

@keyframes shakeAndGlow {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-5px); }
    40%, 80% { transform: translateX(5px); }
}
.input-field-missing {
    animation: shakeAndGlow 0.4s ease-in-out !important;
    border: 2px solid #ef4444 !important;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.25) !important;
    background-color: #fff1f2 !important;
}

/* PRIVACY */
.privacy-overlay{position:fixed;inset:0;z-index:9999;background:rgba(0,0,30,.78);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:16px;}
.privacy-box{background:#fff;border-radius:20px;max-width:480px;width:100%;box-shadow:0 24px 60px rgba(0,0,52,.4);border-bottom:5px solid var(--brand);overflow:hidden;}
.privacy-head{background:var(--btn-grad);padding:24px 24px 18px;text-align:center;}
.privacy-seal{width:64px;height:64px;border-radius:50%;object-fit:contain;margin:0 auto 12px;display:block;border:3px solid rgba(255,255,255,.35);}
.privacy-head h2{font-size:16px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;}
.privacy-head p{font-size:11.5px;color:rgba(255,255,255,.8);font-weight:600;margin-top:3px;}
.privacy-body{padding:22px 24px;}
.privacy-body p{font-size:12.5px;color:var(--text);line-height:1.75;font-weight:500;}
.privacy-divider{height:1px;background:var(--border);margin:14px 0;}
.privacy-check{display:flex;align-items:flex-start;gap:10px;margin-bottom:16px;}
.privacy-check input{accent-color:var(--brand);width:16px;height:16px;flex-shrink:0;margin-top:2px;}
.privacy-check label{font-size:12.5px;font-weight:700;color:var(--text);cursor:pointer;line-height:1.5;}
.privacy-accept{width:100%;padding:13px;background:var(--btn-grad);color:#fff;font-family:inherit;font-size:13px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:10px;cursor:pointer;transition:all .18s;box-shadow:0 4px 14px rgba(0,0,82,.3);}
.privacy-accept:disabled{opacity:.4;cursor:not-allowed;}
.privacy-accept:not(:disabled):hover{transform:translateY(-1px);}
.privacy-footer{text-align:center;margin-top:10px;font-size:11px;color:var(--light);font-weight:600;}

/* HERO */
.hero-section{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);position:relative;}
.hero-carousel{width:100%;min-height:280px;max-height:400px;position:relative;overflow:hidden;}
@media(max-width:600px){.hero-carousel{min-height:220px;max-height:320px;}}
.carousel-slide{position:absolute;inset:0;opacity:0;transition:opacity .8s cubic-bezier(0.4, 0, 0.2, 1);display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center;padding:32px 24px;}
.carousel-slide.active{opacity:1;}
.slide-tag{font-size:10px;font-weight:900;background:rgba(255,255,255,0.15);backdrop-filter:blur(4px);color:#fff;padding:5px 14px;border-radius:99px;text-transform:uppercase;letter-spacing:.1em;margin-bottom:12px;display:inline-block;border:1px solid rgba(255,255,255,0.2);}
.carousel-slide h2{font-size:clamp(20px,5vw,32px);font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.05em;line-height:1.1;margin-bottom:10px;text-shadow:0 4px 15px rgba(0,0,0,0.4);}
.carousel-slide p{font-size:clamp(12px,2.5vw,15px);color:rgba(255,255,255,.85);font-weight:500;max-width:580px;line-height:1.6;}
.carousel-dots{position:absolute;bottom:14px;left:50%;transform:translateX(-50%);display:flex;gap:7px;z-index:5;}
.carousel-dot{width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,.4);cursor:pointer;transition:all .25s;border:none;padding:0;}
.carousel-dot.active{background:#fff;width:24px;border-radius:99px;}
.c-arrow{position:absolute;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.18);border:1.5px solid rgba(255,255,255,.35);color:#fff;width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:5;transition:all .18s;font-size:12px;}
.c-arrow:hover{background:rgba(255,255,255,.32);}
.c-prev{left:12px;} .c-next{right:12px;}
.wave-gap{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);display:block;line-height:0;}
.wave-gap svg{display:block;width:100%;height:auto;}
.section-gap{height:50px;background:var(--body-bg);}

/* WRAP */
.rp-wrap{max-width:960px;margin:0 auto;padding:0 16px 60px;}

/* NAVY BOX */
.navy-box{background:linear-gradient(165deg,#000052 0%,#04192D 60%,#0E5393 100%);border-radius:24px;padding:28px;margin-bottom:24px;box-shadow:var(--card-shadow);border:1px solid rgba(255,255,255,0.1);}
.section-lbl{font-size:11px;font-weight:900;color:rgba(255,255,255,.8);text-transform:uppercase;letter-spacing:.15em;margin-bottom:18px;display:flex;align-items:center;gap:8px;}
.service-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
@media(max-width:768px){.service-grid{grid-template-columns:repeat(2,1fr);gap:10px;}}
@media(max-width:440px){.service-grid{grid-template-columns:repeat(2,1fr);gap:8px;}}
.duty-grid-cols{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}
@media(max-width:640px){.duty-grid-cols{grid-template-columns:1fr;gap:10px;}}
.activity-carousel-box{position:relative;width:100%;height:360px;}
@media(max-width:640px){.activity-carousel-box{height:230px;}}
@media(max-width:420px){.activity-carousel-box{height:200px;}}
.service-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);border-radius:18px;padding:24px 12px 20px;text-align:center;cursor:pointer;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);text-decoration:none;display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;min-width:0;overflow:hidden;word-break:break-word;}
.service-card:hover{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.3);transform:translateY(-5px);box-shadow:0 12px 30px rgba(0,0,0,0.3);}
.service-ico{width:52px;height:52px;background:rgba(255,255,255,0.1);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;transition:all .3s;}
.service-ico i{color:#fff;font-size:20px;}
.service-card:hover .service-ico{background:var(--brand);transform:scale(1.1);box-shadow:0 0 20px rgba(14,83,147,0.4);}
.service-name{font-size:14px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.05em;line-height:1.3;word-break:break-word;overflow-wrap:break-word;}
.service-sub{font-size:12px;font-weight:600;color:rgba(255,255,255,.9);margin-top:6px;word-break:break-word;overflow-wrap:break-word;}

/* DUTY WIDGET */
.duty-widget{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:16px 20px;margin-bottom:20px;backdrop-filter:blur(10px);}
.duty-widget-row{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
.duty-lbl{font-size:11.5px;font-weight:800;color:#fff;text-transform:uppercase;letter-spacing:.12em;display:flex;align-items:center;gap:6px;opacity:0.9;}
.duty-name{font-size:18px;font-weight:900;color:#fff;margin-top:4px;letter-spacing:0.02em;}
.duty-day-txt{font-size:12px;font-weight:700;color:#fff;text-transform:uppercase;margin-top:2px;background:var(--brand);padding:3px 12px;border-radius:99px;display:inline-block;box-shadow:0 2px 8px rgba(0,0,0,0.2);}
.duty-view-btn{background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);color:#fff;font-size:12px;font-weight:800;padding:8px 20px;border-radius:99px;cursor:pointer;font-family:inherit;text-transform:uppercase;transition:all .2s;display:flex;align-items:center;gap:8px;letter-spacing:0.05em;}
.duty-view-btn:hover{background:rgba(255,255,255,0.2);border-color:rgba(255,255,255,0.4);}
.duty-menu{background:#fff;border-radius:12px;box-shadow:var(--card-shadow);border:1px solid var(--border);overflow:hidden;margin-top:10px;}
.duty-menu-item{padding:10px 16px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #f8fafc;gap:8px;}
.duty-menu-item:last-child{border-bottom:none;}
.duty-menu-item.today-item{background:#eff6ff;}
.duty-day-lbl{font-size:11.5px;font-weight:900;color:var(--muted);text-transform:uppercase;width:100px;flex-shrink:0;}
.duty-name-lbl{font-size:13.5px;font-weight:800;color:var(--text);flex:1;}
.duty-badge{font-size:10px;font-weight:900;background:var(--brand);color:#fff;padding:3px 9px;border-radius:99px;text-transform:uppercase;}

/* NOTIF BELL */
.notif-bell-wrap{position:relative;display:inline-block;}
.notif-bell-btn{background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.3);color:#fff;width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:20px;transition:all .15s;position:relative;}
.notif-bell-btn:hover{background:rgba(255,255,255,.25);transform:scale(1.05);}
.notif-bell-badge{position:absolute;top:-6px;right:-6px;background:#ef4444;color:#fff;font-size:10px;font-weight:900;min-width:20px;height:20px;border-radius:99px;display:flex;align-items:center;justify-content:center;border:2px solid #04192D;padding:0 4px;box-shadow:0 2px 6px rgba(0,0,0,0.3);}
.notif-dropdown{position:absolute;top:calc(100% + 10px);right:0;width:320px;background:#fff;border-radius:14px;box-shadow:0 10px 40px rgba(0,0,52,.25);border:1px solid var(--border);z-index:300;overflow:hidden;}
.notif-hd{padding:10px 14px;background:#f8fafc;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.notif-hlbl{font-size:10.5px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;}
.notif-item{display:flex;align-items:flex-start;gap:9px;padding:10px 14px;border-bottom:1px solid #f8fafc;transition:all .2s;cursor:pointer;}
.notif-item:hover{background:#f1f5f9;transform:translateX(3px);}
.notif-item:last-child{border-bottom:none;}
.notif-item-unread{background:#eff6ff;}
.notif-item-ico{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.notif-item-ttl{font-size:12.5px;font-weight:800;color:var(--text);}
.notif-item-msg{font-size:11.5px;color:#334155;font-weight:600;margin-top:2px;line-height:1.45;}
.notif-item-time{font-size:10.5px;color:#475569;font-weight:600;margin-top:3px;}
.notif-ft{padding:9px 14px;text-align:center;background:#f8fafc;border-top:1px solid var(--border);}

/* WCARD */
.wcard{background:#fff;border-radius:var(--r-card);box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.05);margin-bottom:16px;overflow:hidden;}
.wcard-head{padding:13px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;}
.wcard-title{font-size:11.5px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.09em;display:flex;align-items:center;gap:6px;}
.wcard-title i{color:var(--brand);}
.wcard-badge{font-size:10px;background:#eff6ff;color:var(--brand);font-weight:900;padding:3px 9px;border-radius:99px;}

/* ANNOUNCEMENT CAROUSEL */
.ann-carousel{position:relative;overflow:hidden;border-radius:0;}
.ann-slide{display:none;}
.ann-slide.active{display:block;}
.ann-img{width:100%;height:200px;object-fit:cover;}
.ann-content-box{padding:14px 18px;}
.ann-tag-pill{font-size:9.5px;font-weight:900;text-transform:uppercase;padding:2px 8px;border-radius:99px;display:inline-block;margin-bottom:6px;}
.ann-title{font-size:15px;font-weight:900;color:var(--text);letter-spacing:.01em;}
.ann-body{font-size:13px;color:#1e293b;font-weight:600;margin-top:4px;line-height:1.6;}
.ann-date{font-size:10.5px;color:#475569;font-weight:600;margin-top:6px;}
.ann-nav{display:flex;align-items:center;justify-content:center;gap:6px;padding:10px;}
.ann-dot{width:7px;height:7px;border-radius:50%;background:#e2e8f0;border:none;cursor:pointer;transition:all .2s;padding:0;}
.ann-dot.active{background:var(--brand);width:20px;border-radius:99px;}

/* EVENTS */
.event-item{display:flex;align-items:flex-start;gap:12px;padding:13px 18px;border-bottom:1px solid #f8fafc;}
.event-item:last-child{border-bottom:none;}
.event-day-box{background:var(--btn-grad);color:#fff;border-radius:10px;min-width:48px;height:48px;padding:0 6px;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;}
.event-day-num{font-size:12px;font-weight:900;line-height:1.2;text-align:center;word-break:keep-all;white-space:nowrap;}
.event-day-sm{font-size:8px;font-weight:800;text-transform:uppercase;opacity:.9;text-align:center;}
.etag{font-size:9.5px;font-weight:900;text-transform:uppercase;padding:2px 7px;border-radius:99px;display:inline-block;margin-top:4px;}
.etag-g{background:#dcfce7;color:#15803d;}
.etag-b{background:#dbeafe;color:#1d4ed8;}
.etag-o{background:#ffedd5;color:#ea580c;}
.etag-p{background:#ede9fe;color:#7c3aed;}

/* STATUS */
.s-pending{color:#d97706;font-weight:900;}
.s-processing{color:#0E5393;font-weight:900;}
.s-ready{color:#059669;font-weight:900;}
.s-released{color:#64748b;font-weight:900;}

/* ABOUT TABS */
.about-tabs{display:flex;gap:5px;padding:5px;background:#f8fafc;border-bottom:1px solid var(--border);overflow-x:auto;-webkit-overflow-scrolling:touch;}
.about-tab{padding:7px 14px;border-radius:8px;font-size:11px;font-weight:800;color:var(--muted);border:none;background:transparent;cursor:pointer;text-transform:uppercase;letter-spacing:.05em;transition:all .15s;font-family:inherit;white-space:nowrap;flex-shrink:0;}
.about-tab.active{background:var(--btn-grad);color:#fff;}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:16px;}
.about-card{background:linear-gradient(135deg,#eff6ff 0%,#f8fafc 100%);border:1px solid #bfdbfe;border-radius:12px;padding:14px;box-shadow:0 2px 8px rgba(14,83,147,0.06);transition:all .2s;}
.about-card:hover{transform:translateY(-2px);box-shadow:0 6px 14px rgba(14,83,147,0.12);border-color:#93c5fd;}
.about-ico{width:34px;height:34px;background:var(--btn-grad);border-radius:9px;display:flex;align-items:center;justify-content:center;margin-bottom:8px;}
.about-ico i{color:#fff;font-size:13px;}
.about-ttl{font-size:12px;font-weight:900;color:var(--brand-dark);margin-bottom:4px;}
.about-desc{font-size:11.5px;color:var(--muted);font-weight:600;line-height:1.55;}

/* LOGIN PROMPT */
.login-prompt{background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%);border:1.5px solid #bfdbfe;border-radius:var(--r-card);padding:22px 20px;margin-bottom:16px;text-align:center;}
.lp-icon{width:auto;height:auto;background:none;border-radius:0;box-shadow:none;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;}
.lp-icon i{color:var(--brand);font-size:36px;}
.lp-btns{display:flex;gap:9px;justify-content:center;flex-wrap:wrap;}

/* MODALS */
.modal-ov{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;padding:12px;background:rgba(0,0,18,.68);backdrop-filter:blur(5px);overflow-y:auto;-webkit-overflow-scrolling:touch;}
.modal-box{background:#fff;width:100%;max-width:580px;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,52,.35);border-bottom:5px solid var(--brand);max-height:94vh;overflow-y:auto;margin:0 auto;box-sizing:border-box;}
.modal-box-red{border-bottom-color:#dc2626;}
.modal-in{padding:20px;}

/* RESPONSIVE ISSUE MODAL & FORM GRIDS */
.issue-modal-header { padding: 16px 20px; background: #fff; border-bottom: 1px solid #e2e8f0; flex-shrink: 0; }
.issue-modal-body { flex: 1; overflow-y: auto; -webkit-overflow-scrolling: touch; padding: 16px 20px; background: #f8fafc; }
.issue-modal-footer { padding: 12px 20px; background: #fff; border-top: 1px solid #e2e8f0; flex-shrink: 0; display: flex; justify-content: space-between; align-items: center; z-index: 10; gap: 8px; }
.issue-grid-2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; align-items: start; }
.issue-grid-split2 { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; align-items: start; }
.issue-grid-span2 { grid-column: span 2; }
.schedule-modal-scroll{overflow-y:auto !important;max-height:calc(88vh - 84px) !important;scrollbar-width:thin;scrollbar-color:#0284c7 #e2e8f0;}
.schedule-modal-scroll::-webkit-scrollbar{width:8px;}
.schedule-modal-scroll::-webkit-scrollbar-track{background:#f1f5f9;border-radius:8px;}
.schedule-modal-scroll::-webkit-scrollbar-thumb{background:#0284c7;border-radius:8px;}
.schedule-modal-scroll::-webkit-scrollbar-thumb:hover{background:#0369a1;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:13px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:13.5px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:8px;}
.modal-ico{width:32px;height:32px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.modal-ico i{color:var(--brand);font-size:12px;}
.modal-ico-red{background:#fee2e2;}
.modal-ico-red i{color:#dc2626;}
.modal-close{background:none;border:none;color:var(--light);font-size:19px;cursor:pointer;line-height:1;flex-shrink:0;}
.modal-close:hover{color:var(--danger);}

/* FORMS */
.flbl{font-size:12px;font-weight:800;color:#1e293b;text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:6px;}
.finput{width:100%;min-width:0;padding:12px 16px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:14px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s;}
.finput:focus{border-color:var(--brand);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fgrid2{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;}
.fgrid3{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;}
.fgrid4{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;}
.fgrp{margin-bottom:11px;}
.fspan2{grid-column:span 2;}
.fselect{appearance:auto;-webkit-appearance:menulist;cursor:pointer;}
.sblk{background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:11px;border:1px solid var(--border);}
.sblk-ttl{font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:8px;display:flex;align-items:center;gap:5px;}

/* DOCU GRID */
.docu-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:14px;}
.docu-pick{background:#f8fafc;border:1.5px solid var(--border);border-radius:10px;padding:10px 6px 9px;display:flex;flex-direction:column;align-items:center;gap:5px;cursor:pointer;transition:all .18s;text-align:center;}
.docu-pick:hover,.docu-pick.sel{background:var(--btn-grad);border-color:var(--brand);}
.docu-pick-ico{width:30px;height:30px;background:#eff6ff;border-radius:7px;display:flex;align-items:center;justify-content:center;transition:background .18s;}
.docu-pick-ico i{color:var(--brand);font-size:11px;transition:color .18s;}
.docu-pick:hover .docu-pick-ico,.docu-pick.sel .docu-pick-ico{background:rgba(255,255,255,.2);}
.docu-pick:hover .docu-pick-ico i,.docu-pick.sel .docu-pick-ico i{color:#fff;}
.docu-pick-lbl{font-size:10px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.03em;transition:color .18s;line-height:1.3;}
.docu-pick:hover .docu-pick-lbl,.docu-pick.sel .docu-pick-lbl{color:#fff;}

/* STYLED UPLOAD */
.upload-card{background:#fff;border:2px dashed #cbd5e1;border-radius:12px;padding:12px;text-align:center;cursor:pointer;transition:all .2s;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;min-height:95px;height:100%;}
.upload-card:hover{border-color:var(--brand);background:#f8fafc;}
.upload-card i{font-size:20px;color:var(--brand);opacity:.7;}
.upload-card .upload-txt{font-size:11px;font-weight:700;color:#334155;word-break:break-all;}

/* AUTH BLUE THEME */
.auth-blue-box{background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%);border:1.5px solid #bfdbfe;border-radius:14px;padding:16px;margin-bottom:12px;box-shadow:0 4px 12px rgba(14,83,147,0.08);}
.auth-blue-box .flbl{color:var(--brand);opacity:.8;}
.auth-blue-box .sblk-ttl{color:var(--brand);font-weight:900;}

/* APPOINTMENT SLOTS */
.slot-btn{width:100%;padding:8px 10px;background:#f8fafc;border:1.5px solid var(--border);border-radius:10px;cursor:pointer;transition:all .2s;display:flex;flex-direction:column;gap:3px;font-family:inherit;}
.slot-btn:hover{border-color:var(--brand);background:#eff6ff;}
.slot-btn-sel{width:100%;padding:8px 10px;background:var(--brand);border:1.5px solid var(--brand);border-radius:10px;color:#fff;cursor:pointer;display:flex;flex-direction:column;gap:3px;box-shadow:0 4px 12px rgba(14,83,147,0.3);font-family:inherit;}
.slot-btn-full{width:100%;padding:8px 10px;background:#f1f5f9;border:1.5px solid var(--border);border-radius:10px;color:var(--light);cursor:not-allowed;display:flex;flex-direction:column;gap:3px;opacity:.6;font-family:inherit;}
.slot-btn-full div{color:var(--light)!important;}

/* BTNS */
.btn-grad{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:var(--btn-grad);color:#fff;font-family:inherit;font-size:13px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:var(--r-btn);cursor:pointer;transition:all .18s;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,82,.28);text-decoration:none;}
.btn-grad:hover{transform:translateY(-1px);box-shadow:0 4px 14px rgba(0,0,82,.38);}
.btn-grad-red{background:linear-gradient(135deg,#dc2626 0%,#7f1d1d 100%);}
.btn-plain{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;font-family:inherit;font-size:13px;font-weight:800;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:var(--r-btn);cursor:pointer;transition:all .15s;text-decoration:none;}
.btn-outline{background:transparent;color:var(--brand);border:1.5px solid var(--brand);}
.btn-outline:hover{background:var(--brand);color:#fff;}
.btn-ghost{background:#f1f5f9;color:#475569;}
.btn-ghost:hover{background:#475569;color:#fff;}
.btn-sm{padding:10px 18px;font-size:12px;}

/* PROFILE */
.profile-field{background:#f8fafc;border:1px solid var(--border);border-radius:9px;padding:10px 13px;margin-bottom:8px;}
.profile-field-lbl{font-size:8px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:2px;}
.profile-field-val{font-size:12px;font-weight:800;color:var(--text);}
.pet-tag{display:inline-flex;align-items:center;gap:5px;border-radius:99px;padding:4px 10px;font-size:10px;font-weight:800;margin:3px;}
.pet-tag-alive{background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;}
.pet-tag-deceased{background:#f1f5f9;color:#94a3b8;border:1px solid #e2e8f0;text-decoration:line-through;}

/* VOTER */
.voter-free{background:#dcfce7;color:#15803d;font-size:9px;font-weight:900;padding:2px 8px;border-radius:99px;}
.voter-pay{background:#fef3c7;color:#a16207;font-size:9px;font-weight:900;padding:2px 8px;border-radius:99px;}

/* TOAST */
.toast{position:fixed;top:16px;right:16px;z-index:9999;background:var(--success);color:#fff;padding:11px 18px;border-radius:11px;box-shadow:var(--card-shadow);font-weight:800;font-size:12px;display:flex;align-items:center;gap:7px;}

/* ASK & SOS FLOAT */
.ask-float{position:fixed;bottom:22px;right:22px;z-index:200;background:var(--btn-grad);color:#fff;border:none;border-radius:50px;padding:12px 18px;font-family:inherit;font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.06em;cursor:pointer;box-shadow:0 6px 24px rgba(0,0,82,.35);transition:all .2s;display:flex;align-items:center;gap:8px;text-decoration:none;}
.ask-float:hover{transform:translateY(-2px);}
.ask-pulse{width:9px;height:9px;background:#4ade80;border-radius:50%;animation:pulse 1.5s infinite;}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(74,222,128,.6)}50%{box-shadow:0 0 0 7px rgba(74,222,128,0)}}

.sos-float{position:fixed;bottom:22px;left:22px;z-index:200;background:linear-gradient(135deg,#dc2626 0%,#991b1b 100%);color:#fff;border:2px solid #fca5a5;border-radius:50px;padding:12px 20px;font-family:inherit;font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.06em;cursor:pointer;box-shadow:0 6px 24px rgba(220,38,38,.55);transition:all .2s;display:flex;align-items:center;gap:8px;animation:sos-pulse 2s infinite;}
.sos-float:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(220,38,38,.75);}
.btn-sos{background:linear-gradient(135deg,#dc2626 0%,#7f1d1d 100%) !important;color:#fff !important;border:2px solid #ef4444 !important;box-shadow:0 0 15px rgba(239,68,68,.6),0 4px 15px rgba(0,0,0,.35) !important;animation:sos-pulse 2s infinite;}
.service-card-sos{background:linear-gradient(135deg,rgba(220,38,38,0.22) 0%,rgba(127,29,29,0.38) 100%) !important;border:1.5px solid rgba(239,68,68,0.7) !important;box-shadow:0 0 18px rgba(239,68,68,0.35) !important;animation:sos-pulse 2.5s infinite;}
.service-card-sos:hover{background:linear-gradient(135deg,rgba(220,38,38,0.45) 0%,rgba(127,29,29,0.65) 100%) !important;border-color:#ef4444 !important;box-shadow:0 0 25px rgba(239,68,68,0.6) !important;}
@keyframes sos-pulse{0%,100%{box-shadow:0 0 14px rgba(239,68,68,.5),0 4px 12px rgba(0,0,0,.3);transform:scale(1);}50%{box-shadow:0 0 26px rgba(239,68,68,.85),0 6px 20px rgba(220,38,38,.5);transform:scale(1.02);}}

/* RECENT ANNOUNCEMENTS SECTION */
.recent-ann-section{margin-bottom:20px;}
.recent-ann-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;padding:16px;}
.recent-ann-card{background:#f8fafc;border:1px solid var(--border);border-radius:12px;overflow:hidden;transition:all .18s;}
.recent-ann-card:hover{box-shadow:var(--card-shadow);transform:translateY(-2px);}
.recent-ann-img{width:100%;height:120px;object-fit:cover;}
.recent-ann-img-placeholder{width:100%;height:120px;background:linear-gradient(135deg,#eff6ff,#dbeafe);display:flex;align-items:center;justify-content:center;}
.recent-ann-img-placeholder i{font-size:28px;color:#bfdbfe;}
.recent-ann-body{padding:10px 12px;}
.recent-ann-tag{font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 7px;border-radius:99px;display:inline-block;margin-bottom:5px;}
.recent-ann-title{font-size:13px;font-weight:900;color:var(--text);line-height:1.3;letter-spacing:.01em;}
.recent-ann-date{font-size:9px;color:var(--light);font-weight:600;margin-top:4px;}

.recent-ann-list{display:flex;flex-direction:column;gap:12px;padding:16px;}
.recent-ann-list .recent-ann-card{display:flex;flex-direction:row;align-items:center;}
.recent-ann-list .recent-ann-img, .recent-ann-list .recent-ann-img-placeholder{width:140px;height:140px;flex-shrink:0;}
.recent-ann-list .recent-ann-body{padding:14px 16px;flex:1;min-width:0;}

.item-modal-img-wrap{width:100%;height:300px;overflow-y:auto;overflow-x:hidden;}

/* DUTY SCHEDULE TABLE */
.duty-table-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.03);
}
.duty-table-header {
    display: grid;
    grid-template-columns: 110px 1fr 120px;
    align-items: center;
    padding: 10px 18px;
    background: #f8fafc;
    border-bottom: 1.5px solid #e2e8f0;
    border-left: 4px solid transparent;
    gap: 12px;
}
.duty-table-row {
    display: grid;
    grid-template-columns: 110px 1fr 120px;
    align-items: center;
    padding: 13px 18px;
    gap: 12px;
    transition: background .15s;
    border-bottom: 1px solid #f1f5f9;
    border-left: 4px solid transparent;
}
.duty-table-row:last-child {
    border-bottom: none;
}

@media(max-width:768px) and (min-width:641px){
    .fgrid4{grid-template-columns:repeat(2,1fr);}
}

@media(max-width:640px){
    .duty-table-header, .duty-table-row {
        grid-template-columns: 85px 1fr auto !important;
        padding: 11px 12px !important;
        gap: 8px !important;
    }
    .duty-table-card {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .rp-wrap{padding:0 10px 60px;width:100%;max-width:100vw;overflow-x:hidden;}
    .navy-box{padding:18px 14px;border-radius:18px;margin-bottom:16px;}
    .duty-widget{padding:14px 12px;border-radius:14px;}
    .duty-name{font-size:15px;}
    .duty-view-btn{padding:6px 14px;font-size:10px;}
    .service-card{padding:16px 8px 14px;border-radius:14px;}
    .service-ico{width:42px;height:42px;border-radius:12px;margin-bottom:8px;}
    .service-ico i{font-size:16px;}
    .service-name{font-size:11px;letter-spacing:0.02em;line-height:1.2;}
    .service-sub{font-size:9.5px;margin-top:4px;line-height:1.25;}
    .docu-grid{grid-template-columns:repeat(3,1fr);gap:6px;}
    .about-grid{grid-template-columns:1fr;padding:12px;gap:10px;}
    .fgrid2,.fgrid3,.fgrid4{grid-template-columns:1fr;}
    .fspan2{grid-column:span 1;}
    .service-grid{gap:8px;}
    .recent-ann-grid{grid-template-columns:1fr;}
    .recent-ann-list{padding:12px;}
    .recent-ann-list .recent-ann-card{flex-direction:column;align-items:stretch;}
    .recent-ann-list .recent-ann-img, .recent-ann-list .recent-ann-img-placeholder{width:100%;height:160px;}
    .item-modal-img-wrap{height:200px;}
    .modal-ov{padding:8px;}
    .modal-box{max-height:92vh;border-radius:16px;margin:0 auto;width:100%;}
    .modal-in{padding:14px 12px;}
    .login-notice-btns, .lp-btns { flex-direction: column; gap: 8px; }
    .login-notice-btns a, .login-notice-btns button, .lp-btns a, .lp-btns button { width: 100%; justify-content: center; }
    .ask-float{bottom:16px;right:14px;padding:9px 13px;font-size:10px;}
    .sos-float{bottom:16px;left:14px;padding:9px 13px;font-size:10px;}
    .hero-carousel{min-height:220px;max-height:300px;}
    .carousel-slide{padding:24px 16px;}
    .carousel-slide h2{font-size:22px;}
    .carousel-slide p{font-size:12px;}

    /* Modal adaptations for mobile */
    .issue-modal-header { padding: 12px 14px !important; }
    .issue-modal-body { padding: 12px 10px !important; }
    .issue-modal-footer { padding: 10px 12px !important; }
    .issue-grid-2 { grid-template-columns: 1fr !important; gap: 9px !important; }
    .issue-grid-span2 { grid-column: span 1 !important; }
    .issue-grid-split2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; gap: 8px !important; }
    .sched-tabs-grid { grid-template-columns: 1fr !important; gap: 6px !important; }
}
</style>

    <x-slot name="header"></x-slot>

    {{-- PRIVACY MODAL --}}
    <div x-data="{ accepted: localStorage.getItem('brgy_privacy_v4') === '1', checked: false }"
         x-show="!accepted" x-cloak class="privacy-overlay">
        <div class="privacy-box">
            <div class="privacy-head">
                <img src="{{ asset('images/circlelogo.png') }}" class="privacy-seal" onerror="this.style.display='none'">
                <h2>Privacy Notice</h2>
                <p>Barangay San Miguel II • Republic Act No. 10173</p>
            </div>
            <div class="privacy-body">
                <p>In accordance with the <strong>Data Privacy Act of 2012</strong>, Barangay San Miguel II collects and processes your personal information solely for barangay service delivery purposes.</p>
                <div class="privacy-divider"></div>
                <p>Your data is kept <strong>strictly confidential</strong> and will not be shared with third parties without your consent, except as required by law.</p>
                <div class="privacy-divider"></div>
                <div class="privacy-check">
                    <input type="checkbox" id="prv3" x-model="checked">
                    <label for="prv3">I have read and understood the Privacy Notice and I consent to the collection and processing of my personal data by Barangay San Miguel II.</label>
                </div>
                <button class="privacy-accept" :disabled="!checked"
                        @click="localStorage.setItem('brgy_privacy_v4','1'); accepted=true;">
                    <i class="fas fa-check-circle" style="margin-right:6px;"></i> I Accept & Continue
                </button>
                <div class="privacy-footer">This notice is shown once per browser session.</div>
            </div>
        </div>
    </div>

    {{-- TOAST: Handled centrally by layouts/app.blade.php (showToast) --}}
    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof showToast === 'function') {
                    showToast(@json($errors->first()), 'error');
                }
            });
        </script>
    @endif

    @php
        $isAuth   = auth()->check();
        $authUser = auth()->user();
        $authUserAge = null;
        if ($isAuth && $authUser) {
            if (!empty($authUser->resident?->age)) {
                $authUserAge = $authUser->resident->age;
            } elseif (!empty($authUser->birthday)) {
                try {
                    $authUserAge = \Carbon\Carbon::parse($authUser->birthday)->age;
                } catch (\Exception $e) {}
            } elseif (!empty($authUser->resident?->birthday)) {
                try {
                    $authUserAge = \Carbon\Carbon::parse($authUser->resident->birthday)->age;
                } catch (\Exception $e) {}
            }
        }
        $tagColors = [
            'Announcement' => ['bg'=>'#dbeafe','color'=>'#1d4ed8'],
            'Health'       => ['bg'=>'#dcfce7','color'=>'#15803d'],
            'Governance'   => ['bg'=>'#ede9fe','color'=>'#7c3aed'],
            'Community'    => ['bg'=>'#ffedd5','color'=>'#ea580c'],
            'Sanitation'   => ['bg'=>'#fef3c7','color'=>'#a16207'],
        ];
    @endphp

    <script>
    function issueEvidenceUploader() {
        return {
            evFiles: [],
            previewUrl: null,
            previewName: '',
            previewModal: false,
            handleFileSelect(e) {
                const files = Array.from(e.target.files || []);
                for (let f of files) {
                    if (f.size > 5 * 1024 * 1024) {
                        alert('Ang file "' + f.name + '" ay lampas sa 5MB (' + (f.size / 1024 / 1024).toFixed(1) + 'MB)! Ang maximum allowed size ay 5MB bawat file.');
                        this.evFiles = [];
                        this.previewUrl = null;
                        this.previewName = '';
                        if (this.$refs.evidenceInput) this.$refs.evidenceInput.value = '';
                        return;
                    }
                }
                this.evFiles = files;
                if (files.length > 0 && files[0].type.startsWith('image/')) {
                    this.previewUrl = URL.createObjectURL(files[0]);
                    this.previewName = files[0].name;
                } else {
                    this.previewUrl = null;
                    this.previewName = files.length > 0 ? files[0].name : '';
                }
            },
            removeFile(e) {
                if (e) e.stopPropagation();
                this.evFiles = [];
                this.previewUrl = null;
                this.previewName = '';
                if (this.$refs.evidenceInput) this.$refs.evidenceInput.value = '';
            }
        };
    }

    function residentPortalApp() {
        return {
            dutyOpen: false,
            tanodOpen: false,
            scheduleModal: false,
            scheduleTab: 'kagawad',
            docuModal: false,
            issueModal: false,
            issueConfirmModal: false,
            confirmData: { offense: '', complainant: '', contact: '', respondent: '', dateTime: '', location: '', description: '' },
            issueStep: 1,
            incidentDatePart: '{{ date('Y-m-d') }}',
            incidentTimePart: '{{ date('H:i') }}',
            legalAcknowledged: false,
            isSubmittingReport: false,
            issueErrorMsg: '',
            profileModal: false,
            emailEditModal: false,
            idUploadModal: false,
            viewPhotoModal: false,
            photoModalUrl: '',
            photoModalTitle: 'Uploaded ID Proof',
            openPhotoModal(url, title = 'Uploaded ID Proof') {
                this.photoModalUrl = url;
                this.photoModalTitle = title;
                this.viewPhotoModal = true;
            },
            selectedIdType: 'PhilSys National ID',
            otherIdType: '',
            idPreviewUrl: null,
            sosResidentEmail: '',
            familyModal: false,
            classification: '',
            age: 0,
            birthday: '',
            petModal: false,
            digitalIdModal: false,
            digitalIdViewModal: false,
            idView: 'front',
            notifOpen: false,
            idProofPreview: null,
            photoWarningModal: false,
            warningType: 'profile',
            warningNextDate: '',
            itemModal: false,
            activeItem: {},
            activeImgIndex: 0,
            nextImg(){
                if(this.activeItem.images && this.activeItem.images.length > 1) {
                    this.activeImgIndex = (this.activeImgIndex + 1) % this.activeItem.images.length;
                }
            },
            prevImg(){
                if(this.activeItem.images && this.activeItem.images.length > 1) {
                    this.activeImgIndex = (this.activeImgIndex - 1 + this.activeItem.images.length) % this.activeItem.images.length;
                }
            },
            eventTab: 'events',
            viewMode: 'grid',
            filterMonth: '',
            filterYear: '',
            msgModal: false,
            msgText: '',
            msgSent: false,
            faqModal: false,
            activeService: '',
            selectedDoc: '',
            petTypeOther: false,
            selectedOffense: '',
            showOtherOffense: false,
            aboutTab: 'about',
            rescheduleModal: false,
            activeReq: {},
            trackerModal: false,
            selectedTrackerReq: null,
            reqFilter: 'all',
            openTrackerModal(req) {
                this.selectedTrackerReq = req;
                this.trackerModal = true;
            },
            jobseekerLockedModal: false,
            hasAvailedJobseeker: {{ $hasAvailedJobseeker ? 'true' : 'false' }},
            isAuth: {{ $isAuth ? 'true' : 'false' }},
            isVoter: {{ ($isAuth && $authUser?->is_voter) ? 'true' : 'false' }},
            isPendingVerification: {{ ($isAuth && in_array($authUser?->status, ['pending_verification', 'declined']) && $authUser?->voter_status !== 'approved' && $authUser?->resident?->verification_status !== 'approved') ? 'true' : 'false' }},
            pendingLockModal: false,
            annIdx: 0,
            annTotal: {{ $announcements->count() }},

            lang: localStorage.getItem('resident_lang') || 'en',
            setLang(l) {
                this.lang = l;
                localStorage.setItem('resident_lang', l);
                window.dispatchEvent(new CustomEvent('lang-changed', {detail: l}));
            },
            t(key) {
                const dict = {
                    en: {
                        welcome: 'Welcome',
                        hero_title: 'Barangay San Miguel II',
                        hero_subtitle: 'Your community. Our commitment. Serving residents of Dasmariñas, Cavite.',
                        duty_today: 'BARANGAY DUTY TODAY',
                        tanod_patrol: 'On-Duty Tanod Patrol',
                        view_schedules: 'VIEW SCHEDULES',
                        official_on_duty: 'Official on Duty',
                        kagawad_of_day: 'Barangay Kagawad of the Day',
                        peace_order_patrol: 'Peace & Order Patrol',
                        our_services: 'Our Services',
                        notifications: 'Notifications',
                        no_notifications: 'No notifications yet.',
                        emergency_sos: 'EMERGENCY / REQUEST TANOD',
                        emergency_sub: 'Immediate Tanod SOS Dispatch',
                        doc_services: 'Document Services',
                        doc_services_sub: 'Request certificates online',
                        faqs: 'FAQs',
                        faqs_sub: 'How to use & portal guide',
                        report_issue: 'Report an Issue',
                        report_sub: 'Blotter, VAWC & more',
                        activities_title: 'Barangay Activities & Highlights',
                        announcements: 'Announcements & Updates',
                        events: 'Events & Programs',
                        officials: 'Officials',
                        projects: 'Projects',
                        about_us: 'About Barangay SM2',
                        about_tab: 'About',
                        past_updates_tab: 'Past Updates',
                        my_history: 'Request Tracker',
                        requests: 'requests',
                        no_announcements: 'No active announcements at the moment.',
                        no_events: 'No scheduled events at the moment.',
                        read_more: 'Read More',
                        close: 'Close',
                        submit_request: 'Submit Request',
                        cancel: 'Cancel',
                        select_doc: 'Select Document Type',
                        who_is_claiming: 'Who is claiming this document?',
                        self: 'Self',
                        authorized: 'Authorized Person',
                        full_address: 'Complete Address',
                        contact_num: 'Contact Number',
                        purpose: 'Purpose',
                        select_purpose: '— Select Purpose —',
                        office_pickup_notice: 'After submitting, the barangay office will process your request and send your assigned pickup date, time window, and reference details via email.',
                        lp_title: 'Resident Portal Access',
                        lp_desc: 'Please log in or create an account to request barangay certificates, clearances, report blotter issues, or dispatch emergency SOS.',
                        lp_create: 'Create Account',
                        lp_login: 'Resident Login',

                        // Pending Masterlist Verification Warning Banner
                        pending_banner_title: 'Account Pending Masterlist Verification',
                        pending_banner_badge: 'FOR OFFICE VALIDATION',
                        pending_banner_desc: 'Your account is currently under review by Barangay Office Staff against the Official Masterlist. If you are newly moving into the barangay, you may submit a Certification of Move-In request. Other document services, blotters, and digital IDs are temporarily locked until approved.',

                        // Declined Banner
                        declined_banner_title: 'Account Verification Declined',
                        declined_banner_badge: 'ACTION REQUIRED',
                        declined_banner_reason_lbl: 'Reason from Office:',
                        declined_banner_action: 'Please review your profile details and re-upload a clear copy of your valid ID.',
                        declined_banner_btn: 'Update Profile / Re-upload ID',

                        // Verified Banner
                        verified_banner_title: 'Verified Resident Account',
                        verified_banner_desc: '• Full access granted to document requests and digital services.',
                        verified_banner_btn: 'Update Profile',

                        // Feature Locked Modal
                        pending_modal_title: 'Feature Locked - Verification Pending',
                        pending_modal_heading: 'Temporarily Locked',
                        pending_modal_desc: 'This service requires official verification from Barangay Office Staff to confirm your identity against the Masterlist.',
                        pending_modal_why_label: 'Why is this locked?',
                        pending_modal_why_desc: 'In accordance with barangay policy, official documents, blotter records, and digital IDs are restricted to verified residents. If you are newly moving into Barangay San Miguel II, please use the Move-In Certificate Request.',
                        pending_modal_btn_profile: 'View My Profile',
                        pending_modal_btn_understand: 'I Understand',

                        // Emergency SOS Modal
                        sos_modal_title: 'EMERGENCY SOS ALERT',
                        sos_modal_sub: 'Direct Dispatch to Barangay Peace & Order Patrol',
                        sos_advisory_title: '⚠️ IMPORTANT REMINDER:',
                        sos_advisory_desc: 'Emergency SOS is strictly for genuine emergencies within the territorial jurisdiction of Barangay San Miguel II. On-duty Tanod patrols can only respond within our barangay. If an accident or emergency occurs in another barangay or city, please call 911, PNP, or the respective local emergency hotline immediately.',
                        sos_advisory_penalty: 'Pranks or false alarms are strictly prohibited and punishable by law.',
                        sos_loc_info: 'Location Dispatch Information:',
                        sos_reg_addr: 'Registered Address:',
                        sos_gps_acquired: 'GPS Pinpoint Acquired',
                        sos_nature_label: 'Emergency Nature / Reason',
                        sos_landmark_label: 'Exact Landmark / Incident Location',
                        sos_landmark_ph: 'e.g. In front of Covered Court, Corner of Phase 2 store...',
                        sos_landmark_hint: 'Where exactly is the emergency taking place? Please specify landmark especially if not at home.',
                        sos_landmark_err: 'Please provide an exact landmark or location before dispatching.',
                        sos_btn_dispatch: 'DISPATCH NOW',
                        sos_confirm_title: 'DISPATCH CONFIRMATION',
                        sos_confirm_desc: 'Are you sure you want to send an Emergency Dispatch to the Barangay Peace & Order Patrol?',
                        sos_confirm_nature: '🚨 Emergency Nature:',
                        sos_confirm_landmark: '📍 Target Landmark / Location:',
                        sos_confirm_warning: 'THIS IS NOT A GAME OR PRANK. On-duty Tanods can only respond within the territorial jurisdiction of Barangay San Miguel II. Responding officers will proceed immediately to the specified location.',
                        sos_btn_back: 'Back',
                        sos_btn_confirm: 'YES, DISPATCH NOW',
                        sos_transmitting: 'TRANSMITTING...',
                        sos_success_title: 'DISPATCH ALERT TRANSMITTED',
                        sos_success_desc: 'Your emergency SOS has been received with HIGHEST PRIORITY by the on-duty Barangay Police (Tanod) & Peace and Order Command.',
                        sos_email_sent_to: 'Confirmation receipt sent to:',
                        sos_notice_1: 'On-duty patrol units are being notified.',
                        sos_notice_2: 'Keep your line open for Tanod dispatch verification.',
                        sos_btn_close: 'Understood & Close',

                        // Schedules Modal
                        sched_title: 'Barangay Duty & Patrol Schedules',
                        sched_sub: 'Official Weekly Kagawad Assignments & Tanod Security Patrol Timetable',
                        sched_tab_kagawad: 'Officer on Duty (Kagawad)',
                        sched_tab_tanod: 'Tanod Patrol Schedule',
                        sched_kagawad_head: 'Weekly Officer Schedule',
                        sched_rotation: 'Monday – Sunday Rotation',
                        sched_col_day: 'Day',
                        sched_col_official: 'Barangay Official',
                        sched_col_status: 'Duty Status',
                        sched_active_today: 'Active Today',
                        sched_scheduled: 'Scheduled',
                        sched_tanod_head: 'Peace & Order Patrol Teams',
                        sched_security_rotation: 'Official Security Rotation',
                        sched_assigned_days: 'Assigned Days:',
                        sched_personnel: 'Personnel:',

                        // FAQs Modal (Concise, Senior/PWD Friendly & Accurate Fees)
                        faq_title: 'Frequently Asked Questions & Resident Guide',
                        faq_subtitle: 'Important reminders, document fees, and emergency guidelines',
                        faq_search_ph: 'Search FAQs (e.g. Jobseeker, Representative, Hotlines, Payment, Fees)...',
                        faq_hotline_title: 'Slow or No Internet Connection (Direct Hotlines):',
                        faq_hotline_desc: 'If you have slow or no internet connection, you can directly call or copy-paste the Barangay Hotlines: Tanod Desk & Emergency at (046) 416-0283, Desk Officer Mobile at 0917-543-2100, or National Emergency 911 for immediate response.',
                        faq_rep_title: 'Authorized Representative Rules:',
                        faq_rep_desc: 'If claiming via representative, bring: (1) Representative\'s valid ID, (2) Copy of the resident\'s valid ID, and (3) Signed authorization letter. Up to 2 requests per representative are allowed.',
                        faq_fees_title: 'Document Fees (Free vs. Loan Applications & Jobseeker):',
                        faq_fees_desc: 'Barangay Clearance, Certificate of Indigency, and Residency are 100% FREE. First-Time Jobseeker (RA 11261) is also FREE and strictly ONE-TIME ONLY in a lifetime. ONLY Loan Applications have a processing fee, payable strictly at the official Barangay Cashier upon pickup.',
                        faq_reports_title: 'Incident Reports (₱100 Fee & Multiple Reports):',
                        faq_reports_desc: 'Residents may submit multiple incident reports. A standard ₱100.00 filing fee is required at the Barangay Hall for official blotter processing. Prank or joke reports are strictly prohibited by law.',
                        faq_hours_title: 'Barangay Office Hours & 24/7 Tanod Desk:',
                        faq_hours_desc: 'Office hours: Monday to Friday, 8:00 AM to 5:00 PM. The Barangay Tanod Desk and Emergency SOS dispatch are active 24/7 for community security and emergencies.',
                        faq_close: 'Close Guide',
                    },
                    fil: {
                        welcome: 'Maligayang Pagdating',
                        hero_title: 'Barangay San Miguel II',
                        hero_subtitle: 'Ang inyong komunidad. Aming serbisyo. Naglilingkod sa mga residente ng Dasmariñas, Cavite.',
                        duty_today: 'NAGTATRABAHO NGAYONG ARAW',
                        tanod_patrol: 'Naka-Duty na Patrol ng Tanod',
                        view_schedules: 'TINGNAN ANG MGA SKEDYUL',
                        official_on_duty: 'Opisyal na Naka-Duty',
                        kagawad_of_day: 'Barangay Kagawad ng Araw',
                        peace_order_patrol: 'Patrol ng Kapayapaan at Kaayusan',
                        our_services: 'Aming Mga Serbisyo',
                        notifications: 'Mga Notipikasyon',
                        no_notifications: 'Walang mga notipikasyon sa ngayon.',
                        emergency_sos: 'EMERGENCY / HUMINGI NG TANOD',
                        emergency_sub: 'Agad na Pagresponde ng Tanod',
                        doc_services: 'Serbisyo sa Dokumento',
                        doc_services_sub: 'Humiling ng mga sertipiko online',
                        faqs: 'Mga Madalas Itanong (FAQs)',
                        faqs_sub: 'Gabay sa paggamit ng portal',
                        report_issue: 'Mag-ulat ng Reklamo',
                        report_sub: 'Blotter, VAWC at iba pa',
                        activities_title: 'Mga Aktibidad at Kaganapan sa Barangay',
                        announcements: 'Mga Anunsyo at Balita',
                        events: 'Mga Kaganapan at Programa',
                        officials: 'Mga Opisyal',
                        projects: 'Mga Proyekto',
                        about_us: 'Tungkol sa Barangay SM2',
                        about_tab: 'Tungkol sa Barangay',
                        past_updates_tab: 'Mga Nakaraang Update',
                        my_history: 'Tagasubaybay ng Kahilingan (Tracker)',
                        requests: 'mga kahilingan',
                        no_announcements: 'Walang aktibong anunsyo sa ngayon.',
                        no_events: 'Walang nakatakdang programa sa ngayon.',
                        read_more: 'Magbasa Pa',
                        close: 'Isara',
                        submit_request: 'Isumite ang Kahilingan',
                        cancel: 'Kanselahin',
                        select_doc: 'Pumili ng Uri ng Dokumento',
                        who_is_claiming: 'Sino ang kukuha ng dokumentong ito?',
                        self: 'Para sa Sarili',
                        authorized: 'Awtorisadong Kinatawan',
                        full_address: 'Kumpletong Tirahan',
                        contact_num: 'Numero ng Telepono / Mobile',
                        purpose: 'Layunin / Dahilan',
                        select_purpose: '— Pumili ng Layunin —',
                        office_pickup_notice: 'Pagkatapos isumite, ipoproseso ng tanggapan ng barangay ang iyong kahilingan at ipapadala ang itinalagang petsa, oras ng pagkuha, at detalye ng sanggunian sa pamamagitan ng email.',
                        lp_title: 'Akses sa Resident Portal',
                        lp_desc: 'Mangyaring mag-log in o gumawa ng account upang humiling ng mga sertipiko ng barangay, clearance, mag-ulat ng blotter, o magpadala ng emergency SOS.',
                        lp_create: 'Gumawa ng Account',
                        lp_login: 'Mag-log In',

                        // Pending Masterlist Verification Warning Banner
                        pending_banner_title: 'Naghihintay ng Beripikasyon sa Masterlist',
                        pending_banner_badge: 'KASALUKUYANG BINIBERIPIKA',
                        pending_banner_desc: 'Kasalukuyang sinusuri ng Tanggapan ng Barangay ang inyong account batay sa Opisyal na Masterlist. Kung kayo ay bagong lipat sa barangay, maaari kayong magsumite ng Certification of Move-In. Pansamantalang naka-lock ang iba pang serbisyo hanggang ma-aprubahan.',

                        // Declined Banner
                        declined_banner_title: 'Tinanggihan ang Beripikasyon ng Account',
                        declined_banner_badge: 'KAILANGAN NG AKSYON',
                        declined_banner_reason_lbl: 'Dahilan mula sa Tanggapan:',
                        declined_banner_action: 'Mangyaring suriin at i-update ang inyong profile at mag-upload muli ng malinaw na kopya ng inyong valid ID.',
                        declined_banner_btn: 'I-update ang Profile / Mag-upload Muli',

                        // Verified Banner
                        verified_banner_title: 'Beripikadong Resident Account',
                        verified_banner_desc: '• Ganap na access sa mga kahilingan ng dokumento at digital services.',
                        verified_banner_btn: 'I-update ang Profile',

                        // Feature Locked Modal
                        pending_modal_title: 'Naka-Lock ang Serbisyo - Naghihintay ng Beripikasyon',
                        pending_modal_heading: 'Pansamantalang Naka-Lock',
                        pending_modal_desc: 'Ang serbisyong ito ay nangangailangan ng opisyal na beripikasyon mula sa Kawani ng Tanggapan ng Barangay upang matiyak ang inyong pagkakakilanlan sa Masterlist.',
                        pending_modal_why_label: 'Bakit ito naka-lock?',
                        pending_modal_why_desc: 'Alinsunod sa patakaran ng barangay, ang iba pang opisyal na dokumento, blotter, at digital ID ay limitado lamang sa mga beripikadong residente. Kung kayo ay bagong lipat sa Barangay San Miguel II, gamitin ang Move-In Certificate Request.',
                        pending_modal_btn_profile: 'Tingnan ang Aking Profile',
                        pending_modal_btn_understand: 'Naiintindihan Ko',

                        // Emergency SOS Modal
                        sos_modal_title: 'ALERTO NG EMERGENCY SOS',
                        sos_modal_sub: 'Direktang Pagresponde ng Barangay Peace & Order Patrol',
                        sos_advisory_title: '⚠️ MAHALAGANG PAALALA:',
                        sos_advisory_desc: 'Ang Emergency SOS ay para lamang sa mga totoong emergency sa loob ng nasasakupan ng Barangay San Miguel II. Tanging sa loob lamang ng ating barangay makaka-responde ang ating mga Tanod on-duty. Kung naganap ang aksidente o emergency sa ibang barangay o bayan, mangyaring tumawag agad sa 911, PNP, o sa hotline ng kaukulang barangay.',
                        sos_advisory_penalty: 'Ang prank o biruan ay mahigpit na ipinagbabawal at may karampatang parusa ayon sa batas.',
                        sos_loc_info: 'Impormasyon sa Lokasyon ng Dispatch:',
                        sos_reg_addr: 'Nakarehistrong Tirahan:',
                        sos_gps_acquired: 'Nakuha ang GPS Pinpoint',
                        sos_nature_label: 'Uri o Dahilan ng Emergency',
                        sos_landmark_label: 'Eksaktong Landmark / Lokasyon ng Insidente',
                        sos_landmark_ph: 'hal. Tapat ng Covered Court, Kanto ng Phase 2 sari-sari store...',
                        sos_landmark_hint: 'Saan mismong lugar nagaganap ang emergency? Ilagay ang landmark lalo na kung wala sa inyong bahay.',
                        sos_landmark_err: 'Kinakailangan ilagay ang eksaktong landmark o lokasyon bago mag-dispatch.',
                        sos_btn_dispatch: 'I-DISPATCH NA',
                        sos_confirm_title: 'KUMPIRMASYON SA PAG-DISPATCH',
                        sos_confirm_desc: 'Sigurado ka bang nais mong magpadala ng Emergency Dispatch sa Barangay Peace & Order Patrol?',
                        sos_confirm_nature: '🚨 Uri ng Emergency:',
                        sos_confirm_landmark: '📍 Pupuntahang Landmark / Lokasyon:',
                        sos_confirm_warning: 'HINDI ITO LARO O BIRO. Tanging sa nasasakupan lamang ng Barangay San Miguel II makaka-responde ang ating mga Tanod on-duty. Agad na tutungo ang mga rumespondeng Tanod sa nasabing lokasyon.',
                        sos_btn_back: 'Bumalik',
                        sos_btn_confirm: 'OO, I-DISPATCH NA',
                        sos_transmitting: 'IPINAPADALA...',
                        sos_success_title: 'NAIPADALA NA ANG ALERTO NG DISPATCH',
                        sos_success_desc: 'Ang inyong emergency SOS ay natanggap na nang may PINAKAMATAAS NA PRIYORIDAD ng mga naka-duty na Tanod ng Barangay at Peace and Order Command.',
                        sos_email_sent_to: 'Kumpirmasyon ay ipinadala sa:',
                        sos_notice_1: 'Inaabisuhan na ang mga naka-duty na patrol unit.',
                        sos_notice_2: 'Panatilihing bukas ang inyong linya para sa beripikasyon ng Tanod.',
                        sos_btn_close: 'Naiintindihan at Isara',

                        // Schedules Modal
                        sched_title: 'Mga Skedyul ng Trabaho at Patrol ng Barangay',
                        sched_sub: 'Opisyal na Lingguhang Pagtatalaga ng Kagawad at Skedyul ng Tanod Patrol',
                        sched_tab_kagawad: 'Opisyal na Naka-Duty (Kagawad)',
                        sched_tab_tanod: 'Skedyul ng Patrol ng Tanod',
                        sched_kagawad_head: 'Lingguhang Skedyul ng mga Opisyal',
                        sched_rotation: 'Pagpapalitan Lunes Hanggang Linggo',
                        sched_col_day: 'Araw',
                        sched_col_official: 'Opisyal ng Barangay',
                        sched_col_status: 'Katayuan sa Trabaho',
                        sched_active_today: 'Naka-Duty Ngayong Araw',
                        sched_scheduled: 'Nakatakda',
                        sched_tanod_head: 'Mga Pangkat ng Patrol sa Kapayapaan at Kaayusan',
                        sched_security_rotation: 'Opisyal na Pagpapalitan sa Seguridad',
                        sched_assigned_days: 'Mga Nakatakdang Araw:',
                        sched_personnel: 'Mga Tauhan:',

                        // FAQs Modal (Maikli, Madaling Basahin ng Senior/PWD & Tamang Bayarin)
                        faq_title: 'Mga Madalas Itanong (FAQs) at Gabay sa Residente',
                        faq_subtitle: 'Mahalagang paalala, bayarin sa dokumento, at emergency guidelines',
                        faq_search_ph: 'Maghanap sa FAQs (hal. Jobseeker, Kinatawan, Hotline, Bayad, Oras)...',
                        faq_hotline_title: 'Mabagal o Walang Internet (Direktang Hotline):',
                        faq_hotline_desc: 'Kung walang internet o mabagal ang inyong koneksyon, maaari ninyong direktang tawagan o kopyahin (copy-paste) ang mga opisyal na numero ng Barangay: Tanod Desk & Emergency sa (046) 416-0283, Desk Officer Mobile sa 0917-543-2100, o National Emergency 911 para sa agarang tulong.',
                        faq_rep_title: 'Panuntunan sa Awtorisadong Kinatawan (Representative):',
                        faq_rep_desc: 'Kung kinatawan ang kukuha, dalhin sa Barangay Hall ang: (1) Valid ID ng kinatawan, (2) Kopya ng ID ng residente, at (3) Nilagdaang Authorization Letter. Hanggang 2 requests lamang ang pinapayagan.',
                        faq_fees_title: 'Bayad sa Dokumento (Libre vs. Loan Application at Jobseeker):',
                        faq_fees_desc: 'LIBRE ang Barangay Clearance, Indigency, at Residency. Ang First-Time Jobseeker (RA 11261) ay LIBRE rin at ISANG BESES LAMANG (ONE-TIME ONLY) sa buong buhay. Tanging ang Loan Application / Requirements lamang ang may bayad, na binabayaran LAMANG sa opisyal na Barangay Cashier sa oras ng pagkuha.',
                        faq_reports_title: 'Ulat ng Insidente (₱100 Bayad at Maramihang Ulat):',
                        faq_reports_desc: 'Pinapayagan ang pagsumite ng maraming ulat ng insidente. May standard na ₱100.00 filing fee sa Barangay Hall para sa opisyal na blotter. Mahigpit na bawal ang mga birong sumbong o prank reports.',
                        faq_hours_title: 'Oras ng Tanggapan at 24/7 Tanod Desk:',
                        faq_hours_desc: 'Lunes hanggang Biyernes, 8:00 AM – 5:00 PM ang opisina. Ang Tanod Desk at Emergency SOS ay bukas 24/7 para sa anumang sakuna o emergency.',
                        faq_close: 'Isara ang Gabay',
                    }
                };
                return (dict[this.lang] && dict[this.lang][key]) ? dict[this.lang][key] : (dict['en'][key] || key);
            },

            activitySlides: @json($carouselSlides->map(function($s){ return ['title'=>$s->title, 'image'=>asset('storage/'.$s->image_path)]; })),
            currentActivitySlide: 0,
            activityTimer: null,
            getDefaultActivities(){
                return [
                    { title: 'Celebrating Women\'s Month', image: '{{ asset('images/womens.jpg') }}' },
                    { title: 'Operational Linis Canal', image: '{{ asset('images/canal.jpg') }}' },
                    { title: 'Manila Bay Weekly Clean Up Drive', image: '{{ asset('images/cleanup.jpg') }}' }
                ];
            },
            get activeSlides(){
                return this.activitySlides.length > 0 ? this.activitySlides : this.getDefaultActivities();
            },

            dutySchedule: @json($kagawadSchedule ?? []),
            dutyTodayDynamic: @json($activeKagawadTodayName ?? null),
            isKagawadOverriddenToday: {{ !empty($isKagawadOverriddenToday) ? 'true' : 'false' }},
            kagawadOverrideReason: @json($kagawadOverrideReason ?? ''),
            originalKagawadToday: @json($originalKagawadToday ?? ''),
            get todayDayKey(){ return ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'][new Date().getDay()]; },
            get todayDay(){ 
                if (this.lang === 'fil') {
                    const filDays = ['Linggo','Lunes','Martes','Miyerkules','Huwebes','Biyernes','Sabado'];
                    return filDays[new Date().getDay()];
                }
                return this.todayDayKey;
            },
            get dutyToday(){ 
                if (this.dutyTodayDynamic) return this.dutyTodayDynamic;
                const d=this.dutySchedule.find(x=>x.day===this.todayDayKey); 
                return d?d.name:'N/A'; 
            },
            tanodTeams: @json($tanodTeams ?? []),
            tanodWeeklySchedule: @json($tanodWeeklySchedule ?? []),
            isTeamActiveToday(days) { return Array.isArray(days) && days.includes(this.todayDayKey); },
            tanodSchedules: @json($tanodSchedulesArray ?? []),
            sosModal: false,
            sosConfirmStep: false,
            sosLoading: false,
            sosSuccess: false,
            sosError: null,
            sosLandmarkError: false,
            sosMessageError: false,
            sosEmergencyType: 'general',
            sosLandmark: '',
            sosMessage: '',
            sosLat: null,
            sosLng: null,
            sosLocationStatus: 'detecting',

            triggerEmergencySos() {
                if(!this.isAuth) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }

                this.sosModal = true;
                this.sosConfirmStep = false;
                this.sosSuccess = false;
                this.sosError = null;
                this.sosLandmarkError = false;
                this.sosMessageError = false;
                this.sosLoading = false;
                this.sosLandmark = '';
                this.sosMessage = '';
                this.sosLat = null;
                this.sosLng = null;
            },

            proceedToConfirm() {
                this.sosError = null;
                this.sosLandmarkError = false;

                const landmarkClean = (this.sosLandmark || '').trim();

                if (!landmarkClean || landmarkClean.length < 3) {
                    this.sosError = this.lang === 'fil' 
                        ? '⚠️ Pakilagay po ang eksaktong landmark o lokasyon ng emergency bago mag-dispatch.' 
                        : '⚠️ Please provide an exact landmark or emergency location before dispatching.';
                    this.sosLandmarkError = true;
                    return;
                }

                this.sosConfirmStep = true;
            },

            getEmergencyTypeLabel(type) {
                const mapEn = {
                    'general': '🚨 General Emergency / Tanod Assistance',
                    'security': '🛡️ Security Threat / Disturbance / Intruder',
                    'medical': '🚑 Medical Emergency / First Responder',
                    'fire': '🔥 Fire / Hazard Alert',
                    'dispute': '⚠️ Neighborhood Incident / Domestic Disturbance'
                };
                const mapFil = {
                    'general': '🚨 Pangkalahatang Emergency / Saklolo ng Tanod',
                    'security': '🛡️ Banta sa Seguridad / Kaguluhan / Estranghero',
                    'medical': '🚑 Serbisyong Medikal / Unang Lunas',
                    'fire': '🔥 Sunog / Alerto sa Panganib',
                    'dispute': '⚠️ Alitan sa Kapitbahay / Kaguluhan sa Tahanan'
                };
                const map = this.lang === 'fil' ? mapFil : mapEn;
                return map[type] || (this.lang === 'fil' ? 'Saklolo sa Emergency' : 'Emergency Assistance');
            },

            sendSosAlert() {
                const landmarkClean = (this.sosLandmark || '').trim();
                if (!landmarkClean || landmarkClean.length < 3) {
                    this.sosError = this.lang === 'fil' 
                        ? '⚠️ Pakilagay po ang eksaktong landmark o lokasyon ng emergency.' 
                        : '⚠️ Please provide an exact landmark or emergency location.';
                    this.sosConfirmStep = false;
                    this.sosLandmarkError = true;
                    return;
                }

                this.sosLoading = true;
                this.sosError = null;

                fetch('{{ route('resident.emergency.sos') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        latitude: this.sosLat,
                        longitude: this.sosLng,
                        emergency_type: this.sosEmergencyType,
                        landmark: this.sosLandmark,
                        message: this.getEmergencyTypeLabel(this.sosEmergencyType),
                        home_address: @json($authUser?->resident?->address ?? ($authUser?->address ?? "Barangay San Miguel II")),
                    })
                })
                .then(res => res.json())
                .then(data => {
                    this.sosLoading = false;
                    if(data.success) {
                        this.sosSuccess = true;
                        this.sosResidentEmail = data.resident_email || '';
                    } else {
                        this.sosError = data.message || (this.lang === 'fil' ? 'May error sa pagpapadala ng alerto.' : 'Error sending SOS alert.');
                    }
                })
                .catch(err => {
                    this.sosLoading = false;
                    this.sosError = this.lang === 'fil'
                        ? 'Nagkaroon ng problema sa network. Tumawag agad sa emergency hotline.'
                        : 'Network error transmitting SOS dispatch. Please call emergency hotline directly.';
                });
            },

            docs: [
                {key:'indigency',    name:'Indigency',    icon:'fa-file-signature'},
                {key:'clearance',    name:'Clearance',    icon:'fa-shield-alt'},
                {key:'jobseeker',    name:'1st Time Job Seeker',   icon:'fa-user-tie'},
                {key:'business',     name:'Business',     icon:'fa-store'},
                {key:'residency',    name:'Residency',    icon:'fa-house-user'},
                {key:'endorsement',  name:'Endorsement',  icon:'fa-file-export'},
                {key:'moveout',      name:'Move-Out',     icon:'fa-truck-moving'},
                {key:'movein',       name:'Move-In',      icon:'fa-sign-in-alt'},
                {key:'closure',      name:'Closure',      icon:'fa-store-slash'},
                {key:'latereg',      name:'Late Reg',     icon:'fa-clock'},
                {key:'guardianship', name:'Guardianship', icon:'fa-user-shield'},
                {key:'cohabitation', name:'Cohabitation', icon:'fa-user-friends'},
                {key:'katibayan',    name:'Katibayan',    icon:'fa-stamp'},
                {key:'cashgift',     name:'Cash Gift',    icon:'fa-gift'},
                {key:'yumao',        name:'Death Cert',    icon:'fa-ribbon'},
                {key:'oath',         name:'Oath',         icon:'fa-hand-holding-heart'},
            ],
            get selDocObj(){ return this.docs.find(d=>d.key===this.selectedDoc)||{}; },
            getDocName(doc){
                if(this.lang === 'fil') {
                    const filNames = {
                        'indigency': 'Katunayan ng Kahirapan (Indigency)',
                        'clearance': 'Barangay Clearance',
                        'jobseeker': 'First Time Job Seeker',
                        'business': 'Permiso sa Negosyo (Business)',
                        'residency': 'Katunayan ng Paninirahan (Residency)',
                        'endorsement': 'Endorsement',
                        'moveout': 'Paglipat Palabas (Move-Out)',
                        'movein': 'Paglipat Papasok (Move-In)',
                        'closure': 'Pagsasara ng Negosyo',
                        'latereg': 'Huling Pagpaparehistro (Late Reg)',
                        'guardianship': 'Sertipiko ng Tagapangalaga',
                        'cohabitation': 'Katibayan ng Pagsasama',
                        'katibayan': 'Katibayan',
                        'cashgift': 'Cash Gift / Ayuda',
                        'yumao': 'Sertipiko para sa Yumao',
                        'oath': 'Panunumpa (Oath)',
                    };
                    return filNames[doc.key] || doc.name;
                }
                return doc.name;
            },

            offenses: [
                'Physical Assault','Oral Defamation / Slander','Trespassing',
                'Theft / Robbery','Estafa / Fraud','Vandalism / Property Damage',
                'Noise Disturbance','Illegal Gambling','Drug-Related Incident',
                'Threat / Intimidation','Missing Person',
                'VAWC – Domestic Violence','VAWC – Sexual Harassment',
                'VAWC – Child Abuse','VAWC – Economic Abuse',
                'Public Disturbance','Illegal Parking / Road Blockage',
                'Environmental Violation','Others'
            ],

            sendMessage(){
                if(!this.msgText.trim()) return;
                if(!this.msgSubject) this.msgSubject = 'General Inquiry';
                this.msgSending = true;
                const name = @json(trim(($authUser?->first_name ?? '') . ' ' . ($authUser?->last_name ?? '')));
                const email = @json($authUser?->email ?? '');
                fetch('{{ route("resident.message.send") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        subject: this.msgSubject,
                        message: this.msgText,
                        name: name,
                        email: email,
                        resident_code: @json($authUser?->resident_code ?? '')
                    })
                })
                .then(() => { this.msgSending = false; this.msgSent = true; })
                .catch(() => { this.msgSending = false; this.msgSent = true; });
            },

            focusIssueField(step, inputSelector, errorMsg) {
                this.issueStep = step;
                this.issueErrorMsg = errorMsg;
                this.$nextTick(() => {
                    const form = document.getElementById('issueReportForm');
                    if (!form) return;
                    const el = form.querySelector(inputSelector);
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        try { el.focus(); } catch (err) {}
                        el.style.borderColor = '#ef4444';
                        el.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.2)';
                        setTimeout(() => { 
                            el.style.borderColor = ''; 
                            el.style.boxShadow = '';
                        }, 3500);
                    }
                });
            },

            goToIssueStep2() {
                this.issueErrorMsg = '';
                const form = document.getElementById('issueReportForm');
                if (!form) return;

                if (!this.selectedOffense) {
                    return this.focusIssueField(1, 'select[name="issue_type"]', 
                        this.lang === 'fil' ? 'Pumili po ng Uri ng Reklamo / Offense.' : 'Please select the Type of Offense / Complaint.');
                }
                if (this.selectedOffense === 'Others') {
                    const otherInput = form.querySelector('input[name="issue_type_other"]');
                    if (!otherInput || !otherInput.value.trim()) {
                        return this.focusIssueField(1, 'input[name="issue_type_other"]', 
                            this.lang === 'fil' ? 'Pakitukoy ang uri ng reklamo.' : 'Please specify the type of offense.');
                    }
                }

                const nameInput = form.querySelector('input[name="complainant_name"]');
                if (!nameInput || !nameInput.value.trim()) {
                    return this.focusIssueField(1, 'input[name="complainant_name"]', 
                        this.lang === 'fil' ? 'Pakilagay ang buong pangalan ng nagrereklamo.' : 'Please enter complainant full name.');
                }

                const ageInput = form.querySelector('input[name="complainant_age"]');
                if (!ageInput || !ageInput.value || parseInt(ageInput.value) < 18) {
                    return this.focusIssueField(1, 'input[name="complainant_age"]', 
                        this.lang === 'fil' ? 'Kailangang 18 taong gulang pataas ang nagrereklamo.' : 'Complainant must be at least 18 years old.');
                }

                const contactInput = form.querySelector('#issueContactInput') || form.querySelector('input[name="contact"]');
                const rawContact = contactInput ? contactInput.value.replace(/[^0-9]/g, '').trim() : '';
                if (!contactInput || rawContact.length !== 11 || !rawContact.startsWith('09')) {
                    return this.focusIssueField(1, '#issueContactInput', 
                        this.lang === 'fil' ? 'Kailangang eksaktong 11-digit ang contact number na nagsisimula sa 09 (hal. 09XXXXXXXXX).' : 'Contact number must be exactly 11 digits starting with 09 (e.g. 09XXXXXXXXX).');
                }
                contactInput.value = rawContact;

                if (!this.isAuth) {
                    const emailInput = form.querySelector('input[name="guest_email"]');
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailInput || !emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
                        return this.focusIssueField(1, 'input[name="guest_email"]', 
                            this.lang === 'fil' ? 'Pakilagay ang wastong email address para sa mga update.' : 'Please enter a valid email address for notifications.');
                    }
                }

                const behalfCheckbox = form.querySelector('input[name="is_on_behalf"]');
                if (behalfCheckbox && behalfCheckbox.checked) {
                    const victimName = form.querySelector('input[name="victim_name"]');
                    const victimAge = form.querySelector('input[name="victim_age"]');
                    const victimGender = form.querySelector('select[name="victim_gender"]');
                    const victimRel = form.querySelector('input[name="victim_relationship"]');
                    if (!victimName || !victimName.value.trim()) {
                        return this.focusIssueField(1, 'input[name="victim_name"]', 
                            this.lang === 'fil' ? 'Pakilagay ang buong pangalan ng biktima.' : 'Please enter the victim full name.');
                    }
                    if (!victimAge || !victimAge.value) {
                        return this.focusIssueField(1, 'input[name="victim_age"]', 
                            this.lang === 'fil' ? 'Pakilagay ang edad ng biktima.' : 'Please enter the victim age.');
                    }
                    if (!victimGender || !victimGender.value) {
                        return this.focusIssueField(1, 'select[name="victim_gender"]', 
                            this.lang === 'fil' ? 'Pumili ng kasarian ng biktima.' : 'Please select the victim gender.');
                    }
                    if (!victimRel || !victimRel.value.trim()) {
                        return this.focusIssueField(1, 'input[name="victim_relationship"]', 
                            this.lang === 'fil' ? 'Pakilagay ang relasyon sa nagrereklamo.' : 'Please enter relationship to complainant.');
                    }
                }

                const respNameInput = form.querySelector('input[name="respondent_name"]');
                if (!respNameInput || !respNameInput.value.trim()) {
                    return this.focusIssueField(1, 'input[name="respondent_name"]', 
                        this.lang === 'fil' ? 'Pakilagay ang pangalan ng inirereklamo (Respondent).' : 'Please enter the name of the person being reported (Respondent).');
                }

                this.issueStep = 2;
                this.$nextTick(() => {
                    const formBody = document.getElementById('issueReportFormBody');
                    if (formBody) formBody.scrollTop = 0;
                    const modalBox = document.getElementById('issueReportModalBox');
                    if (modalBox) modalBox.scrollTop = 0;
                });
            },

            validateAndReviewIssueReport() {
                this.issueErrorMsg = '';
                const form = document.getElementById('issueReportForm');
                if (!form) return;

                // --- Step 1 Validation (Parties & Offense) ---
                if (!this.selectedOffense) {
                    return this.focusIssueField(1, 'select[name="issue_type"]', 
                        this.lang === 'fil' ? 'Pumili po ng Uri ng Reklamo / Offense.' : 'Please select the Type of Offense / Complaint.');
                }
                if (this.selectedOffense === 'Others') {
                    const otherInput = form.querySelector('input[name="issue_type_other"]');
                    if (!otherInput || !otherInput.value.trim()) {
                        return this.focusIssueField(1, 'input[name="issue_type_other"]', 
                            this.lang === 'fil' ? 'Pakitukoy ang uri ng reklamo.' : 'Please specify the type of offense.');
                    }
                }

                const nameInput = form.querySelector('input[name="complainant_name"]');
                if (!nameInput || !nameInput.value.trim()) {
                    return this.focusIssueField(1, 'input[name="complainant_name"]', 
                        this.lang === 'fil' ? 'Pakilagay ang buong pangalan ng nagrereklamo.' : 'Please enter complainant full name.');
                }

                const ageInput = form.querySelector('input[name="complainant_age"]');
                if (!ageInput || !ageInput.value || parseInt(ageInput.value) < 18) {
                    return this.focusIssueField(1, 'input[name="complainant_age"]', 
                        this.lang === 'fil' ? 'Kailangang 18 taong gulang pataas ang nagrereklamo.' : 'Complainant must be at least 18 years old.');
                }

                const contactInput = form.querySelector('#issueContactInput') || form.querySelector('input[name="contact"]');
                const rawContact = contactInput ? contactInput.value.replace(/[^0-9]/g, '').trim() : '';
                if (!contactInput || rawContact.length !== 11 || !rawContact.startsWith('09')) {
                    return this.focusIssueField(1, '#issueContactInput', 
                        this.lang === 'fil' ? 'Kailangang eksaktong 11-digit ang contact number na nagsisimula sa 09 (hal. 09XXXXXXXXX).' : 'Contact number must be exactly 11 digits starting with 09 (e.g. 09XXXXXXXXX).');
                }
                contactInput.value = rawContact;

                if (!this.isAuth) {
                    const emailInput = form.querySelector('input[name="guest_email"]');
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailInput || !emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
                        return this.focusIssueField(1, 'input[name="guest_email"]', 
                            this.lang === 'fil' ? 'Pakilagay ang wastong email address para sa mga update.' : 'Please enter a valid email address for notifications.');
                    }
                }

                const behalfCheckbox = form.querySelector('input[name="is_on_behalf"]');
                if (behalfCheckbox && behalfCheckbox.checked) {
                    const victimName = form.querySelector('input[name="victim_name"]');
                    const victimAge = form.querySelector('input[name="victim_age"]');
                    const victimGender = form.querySelector('select[name="victim_gender"]');
                    const victimRel = form.querySelector('input[name="victim_relationship"]');
                    if (!victimName || !victimName.value.trim()) {
                        return this.focusIssueField(1, 'input[name="victim_name"]', 
                            this.lang === 'fil' ? 'Pakilagay ang buong pangalan ng biktima.' : 'Please enter the victim full name.');
                    }
                    if (!victimAge || !victimAge.value) {
                        return this.focusIssueField(1, 'input[name="victim_age"]', 
                            this.lang === 'fil' ? 'Pakilagay ang edad ng biktima.' : 'Please enter the victim age.');
                    }
                    if (!victimGender || !victimGender.value) {
                        return this.focusIssueField(1, 'select[name="victim_gender"]', 
                            this.lang === 'fil' ? 'Pumili ng kasarian ng biktima.' : 'Please select the victim gender.');
                    }
                    if (!victimRel || !victimRel.value.trim()) {
                        return this.focusIssueField(1, 'input[name="victim_relationship"]', 
                            this.lang === 'fil' ? 'Pakilagay ang relasyon sa nagrereklamo.' : 'Please enter relationship to complainant.');
                    }
                }

                const respNameInput = form.querySelector('input[name="respondent_name"]');
                if (!respNameInput || !respNameInput.value.trim()) {
                    return this.focusIssueField(1, 'input[name="respondent_name"]', 
                        this.lang === 'fil' ? 'Pakilagay ang pangalan ng inirereklamo (Respondent).' : 'Please enter the name of the person being reported (Respondent).');
                }

                // --- Step 2 Validation (Incident Details & Legal Notice) ---
                if (!this.incidentDatePart) {
                    return this.focusIssueField(2, 'input[name="incident_date_only"]', 
                        this.lang === 'fil' ? 'Pakilagay ang petsa ng insidente.' : 'Please specify the date of the incident.');
                }

                const incLoc = form.querySelector('input[name="incident_location"]');
                if (!incLoc || !incLoc.value.trim()) {
                    return this.focusIssueField(2, 'input[name="incident_location"]', 
                        this.lang === 'fil' ? 'Pakilagay ang lokasyon ng insidente.' : 'Please specify the location of the incident.');
                }

                const desc = form.querySelector('textarea[name="description"]');
                if (!desc || !desc.value.trim()) {
                    return this.focusIssueField(2, 'textarea[name="description"]', 
                        this.lang === 'fil' ? 'Pakilagay ang buong salaysay o detalye ng insidente.' : 'Please provide the incident description / narration.');
                }

                if (!this.legalAcknowledged) {
                    return this.focusIssueField(2, 'input[name="legal_acknowledgment"]', 
                        this.lang === 'fil' ? 'Kailangan ninyong lagyan ng tsek ang legal certification / warning laban sa maling ulat bago magsumite.' : 'You must check the legal certification against false/prank reporting before submitting.');
                }

                // Sync incident date
                let incDateVal = this.incidentDatePart ? (this.incidentDatePart + ' ' + (this.incidentTimePart || '12:00')) : '';
                const incDate = form.querySelector('input[name="incident_date"]');
                if (incDate && incDateVal) {
                    incDate.value = incDateVal;
                }

                const otherInput = form.querySelector('input[name="issue_type_other"]');
                const offenseDisplayName = (this.selectedOffense === 'Others' && otherInput && otherInput.value.trim())
                    ? otherInput.value.trim()
                    : this.selectedOffense;

                // Prepare confirmation data
                this.confirmData = {
                    offense: offenseDisplayName,
                    complainant: nameInput.value.trim(),
                    contact: rawContact,
                    respondent: respNameInput.value.trim(),
                    dateTime: this.incidentDatePart + (this.incidentTimePart ? (' @ ' + this.incidentTimePart) : ''),
                    location: incLoc.value.trim(),
                    description: desc.value.trim().length > 140 ? (desc.value.trim().substring(0, 140) + '...') : desc.value.trim(),
                };

                // Launch confirmation pop-up modal
                this.issueConfirmModal = true;
            },

            finalSubmitIssueReport() {
                const form = document.getElementById('issueReportForm');
                if (!form) return;
                this.isSubmittingReport = true;
                form.submit();
            },

            submitIssueReport(e) {
                this.validateAndReviewIssueReport();
            },

            init(){
                if(this.activeSlides.length > 0){
                    this.activityTimer = setInterval(()=>this.nextActivitySlide(), 5000);
                }
                window.addEventListener('open-profile-modal', () => { this.profileModal = true; });
                window.addEventListener('lang-changed', (e) => { this.lang = e.detail; });
            },
            nextActivitySlide(){ this.currentActivitySlide=(this.currentActivitySlide+1)%this.activeSlides.length; },
            prevActivitySlide(){ this.currentActivitySlide=(this.currentActivitySlide-1+this.activeSlides.length)%this.activeSlides.length; },
            goActivitySlide(i){ this.currentActivitySlide=i; clearInterval(this.activityTimer); this.activityTimer=setInterval(()=>this.nextActivitySlide(),5000); },

            markNotifRead(){
                fetch('{{ route('resident.notifications.read') }}', {
                    method:'POST',
                    headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'}
                });
            }
        };
    }
    </script>

    <div x-data="residentPortalApp()" x-on:lang-changed.window="lang = $event.detail">

    {{-- HERO CAROUSEL --}}
    <div class="hero-section">
        <div class="hero-carousel">
            <div class="carousel-slide active">
                <a href="{{ url('/') }}" style="display:inline-block;text-decoration:none;cursor:pointer;margin:0 auto 12px;" title="Barangay San Miguel II • Home">
                    <img src="{{ asset('images/circlelogo.png') }}" 
                         alt="Barangay San Miguel II Logo"
                         style="width:96px;height:96px;border-radius:50%;object-fit:contain;margin:0 auto;display:block;opacity:1;box-shadow:0 8px 25px rgba(0,0,0,0.35);border:3.5px solid rgba(255,255,255,0.95);background:#ffffff;padding:2px;cursor:pointer;transition:transform .25s ease, box-shadow .25s ease;" 
                         onmouseover="this.style.transform='scale(1.1)';this.style.boxShadow='0 12px 30px rgba(0,0,0,0.5)'" 
                         onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 8px 25px rgba(0,0,0,0.35)'" 
                         onerror="this.style.display='none'">
                </a>
                <span class="slide-tag" x-text="t('welcome')">Welcome</span>
                <h2 x-text="t('hero_title')">Barangay San Miguel II</h2>
                <p x-text="t('hero_subtitle')">Your community. Our commitment. Serving residents of Dasmariñas, Cavite.</p>
            </div>
        </div>
        <div class="wave-gap">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none">
                <path fill="#f1f5f9" fill-opacity="1" d="M0,40 C240,80 480,0 720,40 C960,80 1200,0 1440,40 L1440,80 L0,80 Z"></path>
            </svg>
        </div>
    </div>

    <div class="section-gap"></div>

    <div class="rp-wrap">

        {{-- NAVY BOX: Duty + Services --}}
        <div class="navy-box">
            {{-- Duty Widget (2 Distinct Columns: Kagawad + Tanod Patrol Synchronized) --}}
            <div class="duty-widget" style="margin-bottom:24px;">
                <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:14px; flex-wrap:wrap;">
                    <div class="duty-lbl" style="font-size:12px; font-weight:900; letter-spacing:0.12em;">
                        <i class="fas fa-calendar-check" style="color:#38bdf8;"></i> <span x-text="t('duty_today')">BARANGAY DUTY TODAY</span>
                    </div>
                    <div>
                        <button class="duty-view-btn" @click="scheduleModal=true" style="box-shadow: 0 4px 14px rgba(0,0,0,0.25);">
                            <i class="fas fa-calendar-alt"></i> <span x-text="t('view_schedules')">VIEW SCHEDULES</span>
                        </button>
                    </div>
                </div>

                {{-- 2 Distinct Columns Layout --}}
                <div class="duty-grid-cols">
                    
                    {{-- Column 1: Official on Duty (Kagawad) --}}
                    <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.14); border-radius:14px; padding:14px 16px; display:flex; flex-direction:column; justify-content:space-between;">
                        <div>
                            <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; margin-bottom:8px;">
                                <span style="font-size:9.5px; font-weight:900; color:#93c5fd; text-transform:uppercase; letter-spacing:0.08em; display:flex; align-items:center; gap:5px;">
                                    <i class="fas fa-user-tie"></i> <span x-text="t('official_on_duty')">Official on Duty</span>
                                </span>
                                <span class="duty-day-txt" style="margin-top:0;" x-text="todayDay"></span>
                            </div>
                            <div class="duty-name" style="font-size:16px; font-weight:900; color:#fff;" x-text="dutyToday"></div>
                            <template x-if="isKagawadOverriddenToday">
                                <div style="font-size:10px; color:#fde047; font-weight:800; margin-top:5px; display:inline-flex; align-items:center; gap:5px; background:rgba(250,204,21,0.18); border:1px solid rgba(250,204,21,0.35); padding:2px 8px; border-radius:99px;">
                                    <i class="fas fa-user-clock"></i> <span>Substitute Duty for <strong x-text="originalKagawadToday"></strong></span>
                                </div>
                            </template>
                        </div>
                        <div style="font-size:10.5px; color:rgba(255,255,255,0.7); font-weight:600; margin-top:8px;">
                            <span x-text="t('kagawad_of_day')">Barangay Kagawad of the Day</span>
                        </div>
                    </div>

                    {{-- Column 2: On-Duty Tanod Patrol --}}
                    @php
                        $tanodMembers = $activeTanodMembers ?? 'Danilo Cruz, Ramon Santos, Ernesto Reyes';
                        $tanodTeamLabel = $activeTanodTeamName ?? 'Team A';
                        $tanodDaysLabel = $activeTanodDays ?? 'Monday, Wednesday, Friday';
                    @endphp
                    <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.14); border-radius:14px; padding:14px 16px; display:flex; flex-direction:column; justify-content:space-between;">
                        <div>
                            <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; margin-bottom:8px;">
                                <span style="font-size:9.5px; font-weight:900; color:#7dd3fc; text-transform:uppercase; letter-spacing:0.08em; display:flex; align-items:center; gap:5px;">
                                    <i class="fas fa-shield-alt"></i> <span x-text="t('tanod_patrol')">On-Duty Tanod Patrol</span>
                                </span>
                                <span class="duty-day-txt" style="margin-top:0;" x-text="todayDay"></span>
                            </div>
                            <div style="font-size:15px; font-weight:900; color:#fff; line-height:1.35; letter-spacing:0.02em;">
                                {{ $tanodMembers }}
                            </div>
                        </div>
                        <div style="font-size:10.5px; color:rgba(255,255,255,0.7); font-weight:600; margin-top:8px;">
                            <span x-text="t('peace_order_patrol')">Peace & Order Patrol</span> — {{ $tanodTeamLabel }} ({{ $tanodDaysLabel }})
                        </div>
                    </div>

                </div>
            </div>

            <div style="display:flex; align-items:center; justify-content:center; margin-bottom:20px;">
                <div class="section-lbl" style="margin-bottom:0; color:#fff; font-size:14px; text-transform:uppercase; letter-spacing:0.15em;">
                    <i class="fas fa-th-large" style="margin-right:8px; opacity:0.7;"></i> <span x-text="t('our_services')">Our Services</span>
                </div>
            </div>

            @if($isAuth && ($authUser?->status === 'declined' || $authUser?->voter_status === 'declined'))
            {{-- CRIMSON/RED BANNER FOR DECLINED VERIFICATION (WITH UPDATE PROFILE / REUPLOAD BUTTON) --}}
            <div style="background:linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); border:1.5px solid #ef4444; border-radius:12px; padding:12px 16px; margin-bottom:18px; box-shadow:0 2px 10px rgba(239, 68, 68, 0.12);">
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <div style="width:34px; height:34px; border-radius:10px; background:#dc2626; color:#fff; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:16px; box-shadow:0 2px 6px rgba(220, 38, 38, 0.3);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; flex-wrap:wrap; margin-bottom:4px;">
                            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                <span style="font-size:12.5px; font-weight:900; color:#991b1b; letter-spacing:0.02em;">⚠️ <span x-text="t('declined_banner_title')">Account Verification Declined</span></span>
                                <span style="font-size:9px; font-weight:800; background:#fee2e2; color:#b91c1c; border:1px solid #fca5a5; padding:1px 7px; border-radius:99px;" x-text="t('declined_banner_badge')">ACTION REQUIRED</span>
                            </div>
                            <button type="button" @click="profileModal=true" class="btn-grad btn-sm" style="font-size:11px; padding:5px 12px; background:#dc2626; border-color:#b91c1c; border-radius:8px; display:inline-flex; align-items:center; gap:6px;">
                                <i class="fas fa-user-edit"></i> <span x-text="t('declined_banner_btn')">Update Profile / Re-upload ID</span>
                            </button>
                        </div>
                        <p style="font-size:11.5px; color:#7f1d1d; line-height:1.45; margin:0; font-weight:600;">
                            <span x-text="t('declined_banner_reason_lbl')">Reason from Office:</span>
                            <span style="font-weight:700; color:#991b1b;">"{{ $authUser->decline_reason ?? 'Your submitted details or valid ID did not match the Barangay Masterlist.' }}"</span>
                            — <span x-text="t('declined_banner_action')">Please review your profile details and re-upload a clear copy of your valid ID.</span>
                        </p>
                    </div>
                </div>
            </div>
            @elseif($isAuth && ($authUser?->status === 'pending_verification' || $authUser?->voter_status === 'pending'))
            {{-- COMPACT BANNER FOR PENDING VERIFICATION --}}
            @if(empty($authUser->voter_id_photo))
            {{-- CASE 1: NO ID UPLOADED YET (e.g. non-voter or unmatched resident) --}}
            <div style="background:linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%); border:1.5px solid #bfdbfe; border-radius:12px; padding:14px 16px; margin-bottom:18px; box-shadow:0 2px 8px rgba(37, 99, 235, 0.08);">
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <div style="width:36px; height:36px; border-radius:10px; background:linear-gradient(135deg,#0E5393 0%,#000052 100%); color:#fff; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:16px; box-shadow:0 2px 6px rgba(14, 83, 147, 0.25);">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; flex-wrap:wrap; margin-bottom:4px;">
                            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                <span style="font-size:13px; font-weight:900; color:#1e3a8a; letter-spacing:0.02em;">🆔 Identity Verification Proof</span>
                                <span style="font-size:9px; font-weight:800; background:#dbeafe; color:#1d4ed8; border:1px solid #93c5fd; padding:1px 8px; border-radius:99px;">FOR VERIFICATION</span>
                            </div>
                        </div>
                        <p style="font-size:11.5px; color:#334155; line-height:1.45; margin:0 0 10px 0; font-weight:600;">
                            Note: For identity verification, you may submit a photo of your Valid ID (PhilSys, Student ID, TIN ID, Voter ID, or any valid Gov't ID / Proof of Residency) so the Barangay Office can verify or update your records.
                        </p>
                        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                            <button type="button" @click="idUploadModal=true" class="btn-grad btn-sm" style="background:linear-gradient(135deg,#0E5393 0%,#000052 100%); font-size:10.5px; font-weight:800; padding:6px 14px; border-radius:8px; border:none; cursor:pointer; color:#fff; display:inline-flex; align-items:center; gap:6px; box-shadow:0 2px 6px rgba(14,83,147,0.3);">
                                <i class="fas fa-upload"></i> Upload Valid ID / Proof
                            </button>
                            <button type="button" @click="docuModal=true; selectedDoc='movein'" class="btn-plain btn-sm" style="background:#fff; font-size:10px; font-weight:800; padding:6px 12px; border-radius:8px; border:1px solid #cbd5e1; cursor:pointer; color:#334155; display:inline-flex; align-items:center; gap:5px;">
                                <i class="fas fa-sign-in-alt"></i> Request Move-In Certificate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            {{-- CASE 2: ID WAS UPLOADED, CURRENTLY PENDING OFFICE VALIDATION --}}
            <div style="background:linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border:1.5px solid #f59e0b; border-radius:12px; padding:12px 16px; margin-bottom:18px; box-shadow:0 2px 10px rgba(245, 158, 11, 0.12);">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:34px; height:34px; border-radius:10px; background:#f59e0b; color:#fff; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:16px; box-shadow:0 2px 6px rgba(245, 158, 11, 0.3);">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-bottom:3px;">
                            <span style="font-size:12.5px; font-weight:900; color:#92400e; letter-spacing:0.02em;">⏳ <span x-text="t('pending_banner_title')">Account Pending Masterlist Verification</span></span>
                            <span style="font-size:9px; font-weight:800; background:#fef3c7; color:#b45309; border:1px solid #fcd34d; padding:1px 7px; border-radius:99px;" x-text="t('pending_banner_badge')">FOR OFFICE VALIDATION</span>
                        </div>
                        <p style="font-size:11.5px; color:#78350f; line-height:1.45; margin:0 0 8px 0; font-weight:600;">
                            Your verification proof has been submitted and is currently being reviewed by the Barangay Office against the Official Masterlist. If you are newly moving into the barangay, you may submit a Move-In Certificate.
                        </p>
                        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                            <button type="button" @click="openPhotoModal('{{ asset('storage/'.$authUser->voter_id_photo) }}', 'Submitted Verification ID')" style="background:none; border:none; padding:0; cursor:pointer; font-size:10.5px; font-weight:800; color:#b45309; text-decoration:underline; display:inline-flex; align-items:center; gap:4px;">
                                <i class="fas fa-image"></i> View Submitted ID
                            </button>
                            <button type="button" @click="profileModal=true" style="background:#fff; border:1px solid #fcd34d; border-radius:6px; padding:3px 9px; font-size:10px; font-weight:700; color:#92400e; cursor:pointer;">
                                <i class="fas fa-sync-alt" style="margin-right:3px;"></i> Re-upload / Change ID
                            </button>
                            <button type="button" @click="docuModal=true; selectedDoc='movein'" class="btn-grad btn-sm" style="background:linear-gradient(135deg,#059669 0%,#047857 100%); font-size:10px; font-weight:800; padding:4px 10px; border-radius:6px; border:none; cursor:pointer; color:#fff; display:inline-flex; align-items:center; gap:4px;">
                                <i class="fas fa-sign-in-alt"></i> <span x-text="lang==='fil'?'Move-In Cert':'Move-In Cert'">Move-In Cert</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif

            <div class="service-grid">
                <div class="service-card service-card-sos" @click="isAuth ? (isPendingVerification ? pendingLockModal=true : triggerEmergencySos()) : window.location.href='{{ route('login') }}'">
                    <div class="service-ico" style="background: rgba(220, 38, 38, 0.4);"><i class="fas fa-truck-medical" style="color:#fff; font-size: 20px;"></i></div>
                    <div class="service-name" style="color:#fff;" x-text="t('emergency_sos')">EMERGENCY / REQUEST TANOD</div>
                    <div class="service-sub" style="color:rgba(255,255,255,0.95); font-weight:700;" x-text="t('emergency_sub')">Immediate Tanod SOS Dispatch</div>
                </div>
                <div class="service-card" @click="isAuth ? (docuModal=true, selectedDoc='') : window.location.href='{{ route('login') }}'">
                    <div class="service-ico"><i class="fas fa-file-alt"></i></div>
                    <div class="service-name" x-text="t('doc_services')">Document Services</div>
                    <div class="service-sub" x-text="isPendingVerification ? (lang==='fil'?'Move-In bukas para sa bagong lipat':'Move-In open for new residents') : t('doc_services_sub')">Request certificates online</div>
                </div>
                <div class="service-card" @click="faqModal=true">
                    <div class="service-ico"><i class="fas fa-question-circle"></i></div>
                    <div class="service-name" x-text="t('faqs')">FAQs</div>
                    <div class="service-sub" x-text="t('faqs_sub')">How to use & portal guide</div>
                </div>
                <div class="service-card" @click="issueModal = true; issueStep = 1; issueErrorMsg = ''; legalAcknowledged = false; isSubmittingReport = false; issueConfirmModal = false;">
                    <div class="service-ico"><i class="fas fa-flag"></i></div>
                    <div class="service-name" x-text="t('report_issue')">Report an Issue</div>
                    <div class="service-sub" x-text="t('report_sub')">Blotter, VAWC & more</div>
                </div>
            </div>
        </div>

        {{-- BARANGAY ACTIVITIES & HIGHLIGHTS --}}
        <div class="wcard" style="position:relative; margin-bottom:20px; box-shadow:var(--card-shadow); border-radius:var(--r-card); overflow:hidden; background-color:#04192D;">
            <div class="activity-carousel-box">
                <template x-for="(item, index) in activeSlides" :key="index">
                    <div x-show="currentActivitySlide === index" 
                         x-transition.opacity.duration.700ms
                         style="position:absolute; inset:0; background-color:#04192D;">
                        
                        <img :src="item.image" x-on:error="$event.target.src='{{ asset('images/womens.jpg') }}'" style="width:100%; height:100%; object-fit:cover; object-position:center;" alt="Carousel Highlight">
                        
                        {{-- Title Overlay --}}
                        <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(4,25,45,0.95), transparent); padding:50px 22px 20px;">
                            <h3 x-text="item.title" style="color:#fff; font-size:16px; font-weight:900; text-transform:uppercase; letter-spacing:0.04em; text-shadow:0 2px 10px rgba(0,0,0,0.6);"></h3>
                        </div>
                    </div>
                </template>
            </div>
            
            {{-- Nav Controls --}}
            <button @click="prevActivitySlide()" class="c-arrow c-prev" style="position:absolute; top:45%;"><i class="fas fa-chevron-left"></i></button>
            <button @click="nextActivitySlide()" class="c-arrow c-next" style="position:absolute; top:45%;"><i class="fas fa-chevron-right"></i></button>

            {{-- Dots --}}
            <div class="carousel-dots" style="bottom:12px; z-index:10;">
                <template x-for="(item, index) in activeSlides" :key="index">
                    <button @click="goActivitySlide(index)" class="carousel-dot" :class="currentActivitySlide === index ? 'active' : ''" style="box-shadow:0 1px 3px rgba(0,0,0,0.3);"></button>
                </template>
            </div>
        </div>



        {{-- LOGIN PROMPT --}}
        @if(!$isAuth)
        <div class="login-prompt">
            <div class="lp-icon"><i class="fas fa-home"></i></div>
            <h3 style="font-size:14px;font-weight:900;color:#1e3a5f;margin-bottom:5px;" x-text="t('lp_title')">Resident Portal Access</h3>
            <p style="font-size:11px;color:var(--muted);font-weight:600;margin-bottom:14px;line-height:1.5;" x-text="t('lp_desc')">Please log in or create an account to request barangay certificates, clearances, report blotter issues, or dispatch emergency SOS.</p>
            <div class="lp-btns">
                <a href="{{ route('register') }}" class="btn-grad btn-sm"><i class="fas fa-user-plus"></i> <span x-text="t('lp_create')">Create Account</span></a>
                <a href="{{ route('login') }}" class="btn-plain btn-outline btn-sm"><i class="fas fa-sign-in-alt"></i> <span x-text="t('lp_login')">Resident Login</span></a>
            </div>
        </div>
        @endif

        {{-- APPLICATION HISTORY --}}
        @if($isAuth)
        <div class="wcard" id="application-history"
             x-data="{ 
                isAppHistoryCollapsed: false, 
                showAllApps: false 
             }"
             @hashchange.window="if(window.location.hash === '#application-history') { isAppHistoryCollapsed = false; }">
            <div class="wcard-head" style="display:flex; align-items:center; justify-content:space-between; cursor:pointer;" @click="isAppHistoryCollapsed = !isAppHistoryCollapsed">
                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                    <div class="wcard-title"><i class="fas fa-history"></i> <span x-text="t('my_history')">Your Application History</span></div>
                    <div class="wcard-badge">{{ $requests->count() }} <span x-text="t('requests')">requests</span></div>
                    {{-- Status Dropdown Filter beside Request Tracker --}}
                    <div @click.stop style="display:inline-flex; align-items:center;">
                        <select x-model="reqFilter" 
                                style="background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; padding:3px 8px; font-size:11.5px; font-weight:800; color:var(--text); cursor:pointer; outline:none; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                            <option value="all">All ({{ $requests->count() }})</option>
                            <option value="pending">Pending ({{ $requests->where('status', 'pending')->count() }})</option>
                            <option value="processing">Processing ({{ $requests->where('status', 'processing')->count() }})</option>
                            <option value="ready">Ready for Pickup ({{ $requests->where('status', 'ready')->count() }})</option>
                            <option value="released">Released ({{ $requests->where('status', 'released')->count() }})</option>
                        </select>
                    </div>
                </div>

                {{-- Collapse / Hide Arrow Button --}}
                <button type="button" @click.stop="isAppHistoryCollapsed = !isAppHistoryCollapsed" 
                        style="border:none; background:transparent; color:#64748b; font-size:11px; font-weight:800; cursor:pointer; display:flex; align-items:center; gap:5px; padding:4px 8px; border-radius:6px; transition:all .15s;"
                        :title="isAppHistoryCollapsed ? 'Expand section' : 'Hide / Collapse section'">
                    <span x-text="isAppHistoryCollapsed ? 'Expand' : 'Hide'" style="font-size:10px; text-transform:uppercase; letter-spacing:0.04em;"></span>
                    <i class="fas" :class="isAppHistoryCollapsed ? 'fa-chevron-down' : 'fa-chevron-up'" style="font-size:10px;"></i>
                </button>
            </div>

            {{-- Collapsible Body --}}
            <div x-show="!isAppHistoryCollapsed" x-transition:enter.duration.200ms>

                @foreach($requests as $index => $req)
                <div class="event-item" x-show="(reqFilter === 'all' || reqFilter === '{{ $req->status }}') && (reqFilter !== 'all' || showAllApps || {{ $index }} < 3)" x-transition
                     @click="openTrackerModal({{ json_encode($req) }})"
                     style="cursor:pointer; transition:all .15s; border-radius:10px; padding:10px 12px; margin-bottom:8px;"
                     onmouseover="this.style.background='#f0fdf4'; this.style.borderColor='#86efac';" onmouseout="this.style.background='#fff'; this.style.borderColor='var(--border)';">
                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-file-invoice" style="color:var(--brand);font-size:13px;"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                            <span style="font-family:monospace;font-size:9.5px;font-weight:900;color:#0369a1;background:#f0f9ff;border:1px solid #bae6fd;padding:1px 5px;border-radius:4px;">REQ-{{ $req->created_at->format('Y') }}-{{ str_pad($req->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <div style="font-size:12px;font-weight:800;color:var(--text);">{{ ucwords(str_replace('_',' ',$req->document_type)) }}</div>
                        </div>
                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">
                            Purpose: {{ $req->purpose ?? 'N/A' }} •
                            Status: <span class="s-{{ $req->status }}">{{ ucfirst($req->status) }}</span>
                        </div>
                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;display:flex;align-items:center;gap:4px;">
                            <i class="fas fa-calendar-alt" style="color:var(--brand);font-size:9px;"></i> 
                            Appointment: 
                            <span style="color:var(--text);font-weight:800;">
                                @if($req->appointment_date)
                                    {{ \Carbon\Carbon::parse($req->appointment_date)->format('M d, Y') }} ({{ \Carbon\Carbon::parse($req->appointment_time)->format('h:i A') }})
                                @else
                                    <span style="color:#0284c7;">Assigned upon processing</span>
                                @endif
                            </span>
                        </div>
                        @if($req->status === 'ready')
                        <div style="background:#ecfdf5;border:1.5px solid #a7f3d0;border-radius:8px;padding:6px 10px;margin-top:6px;font-size:10.5px;color:#065f46;font-weight:700;">
                            <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                                <i class="fas fa-check-circle" style="color:#059669;"></i>
                                <span style="text-transform:uppercase;letter-spacing:.04em;font-size:9.5px;color:#047857;font-weight:900;">Handa nang kunin sa Barangay Hall!</span>
                            </div>
                            <div>
                                Petsa ng Pagkuha: <strong style="color:#065f46;">{{ $req->pickup_date ? \Carbon\Carbon::parse($req->pickup_date)->format('M d, Y') : ($req->appointment_date ? \Carbon\Carbon::parse($req->appointment_date)->format('M d, Y') : 'Available Now') }}</strong>
                            </div>
                            <div style="font-size:9.5px;color:#047857;margin-top:2px;">
                                Duty Personnel / Desk: <strong>{{ $req->personnel_in_charge ?: 'MARVIN M. BENIS (Barangay Secretary)' }}</strong>
                            </div>
                        </div>
                        @endif
                        @if($req->status === 'disapproved' && $req->disapproval_reason)
                        <div style="background:#fee2e2;border:1px solid #fecaca;border-radius:8px;padding:6px 10px;margin-top:6px;font-size:10px;color:#dc2626;font-weight:700;">
                            <i class="fas fa-exclamation-circle"></i> Reason: {{ $req->disapproval_reason }}
                        </div>
                        @endif
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px;">
                        <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;">{{ $req->created_at->format('M d') }}</span>
                        <span style="font-size:9px;font-weight:800;color:var(--brand);display:flex;align-items:center;gap:3px;">
                            <i class="fas fa-external-link-alt" style="font-size:8px;"></i> Track
                        </span>
                        @if($req->status !== 'disapproved' && $req->status !== 'released' && $req->reschedule_count < 1 && $req->appointment_date)
                        <button type="button" @click.stop="activeReq={{ json_encode($req) }}; rescheduleModal=true" 
                                style="background:none;border:none;color:var(--brand);font-size:9.5px;font-weight:800;cursor:pointer;display:flex;align-items:center;gap:3px;padding:2px 4px;border-radius:4px;margin-top:2px;"
                                onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            <i class="fas fa-calendar-edit"></i> Reschedule
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach

                @if($requests->count() > 3)
                <div style="padding:10px 14px 14px; text-align:center;">
                    <button type="button" @click="showAllApps = !showAllApps" 
                            style="width:100%; padding:7px 12px; background:#f8fafc; border:1.5px dashed #cbd5e1; border-radius:8px; font-size:11px; font-weight:800; color:var(--brand); cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px; transition:all .2s;">
                        <i class="fas" :class="showAllApps ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        <span x-text="showAllApps ? 'Show Less (Top 3)' : 'View all {{ $requests->count() }} requests'"></span>
                    </button>
                </div>
                @endif

                @if($requests->isEmpty())
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-folder-open" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No document requests submitted yet.</p>
                </div>
                @endif
            </div>
        </div>
        @endif
        @if($isAuth)
        <div class="wcard" x-data="{ 
                reportHistoryTab: (window.location.hash === '#incident-reports' ? 'incidents' : 'sos'), 
                isCardCollapsed: false,
                showAllSos: false,
                showAllIncidents: false 
             }"
             @hashchange.window="if(window.location.hash === '#incident-reports') { reportHistoryTab = 'incidents'; isCardCollapsed = false; } if(window.location.hash === '#sos-history') { reportHistoryTab = 'sos'; isCardCollapsed = false; }">
            
            {{-- Tabs Header with Collapse Arrow Toggle --}}
            <div class="about-tabs" style="margin-bottom:0; background:#f8fafc; border-bottom:1.5px solid var(--border); padding:6px 12px; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:6px; flex-wrap:wrap;">
                    <button type="button" class="about-tab" :class="reportHistoryTab === 'sos' ? 'active' : ''" @click="reportHistoryTab = 'sos'; isCardCollapsed = false;" style="display:flex; align-items:center; gap:7px;">
                        <i class="fas fa-bullhorn" :style="reportHistoryTab === 'sos' ? 'color:#fff;' : 'color:#dc2626;'"></i>
                        <span>Emergency SOS Dispatches</span>
                        <span class="wcard-badge" style="padding:2px 7px; font-size:8.5px; border-radius:99px; {{ $sosHistory->count() > 0 ? 'background:#fee2e2;color:#dc2626;' : '' }}" :style="reportHistoryTab === 'sos' ? 'background:rgba(255,255,255,0.25);color:#fff;' : ''">
                            {{ $sosHistory->count() }}
                        </span>
                    </button>
                    <button type="button" class="about-tab" :class="reportHistoryTab === 'incidents' ? 'active' : ''" @click="reportHistoryTab = 'incidents'; isCardCollapsed = false;" style="display:flex; align-items:center; gap:7px;">
                        <i class="fas fa-shield-alt" :style="reportHistoryTab === 'incidents' ? 'color:#fff;' : 'color:var(--brand);'"></i>
                        <span>Incident Reports History</span>
                        <span class="wcard-badge" style="padding:2px 7px; font-size:8.5px; border-radius:99px;" :style="reportHistoryTab === 'incidents' ? 'background:rgba(255,255,255,0.25);color:#fff;' : ''">
                            {{ $issueReports->count() }}
                        </span>
                    </button>
                </div>

                {{-- Collapse / Hide Arrow Button --}}
                <button type="button" @click="isCardCollapsed = !isCardCollapsed" 
                        style="border:none; background:transparent; color:#64748b; font-size:11px; font-weight:800; cursor:pointer; display:flex; align-items:center; gap:5px; padding:4px 8px; border-radius:6px; transition:all .15s;"
                        :title="isCardCollapsed ? 'Expand section' : 'Hide / Collapse section'">
                    <span x-text="isCardCollapsed ? 'Expand' : 'Hide'" style="font-size:10px; text-transform:uppercase; letter-spacing:0.04em;"></span>
                    <i class="fas" :class="isCardCollapsed ? 'fa-chevron-down' : 'fa-chevron-up'" style="font-size:10px;"></i>
                </button>
            </div>

            {{-- Collapsible Body --}}
            <div x-show="!isCardCollapsed" x-transition:enter.duration.200ms>
                
                {{-- 1. SOS DISPATCHES TAB CONTENT --}}
                <div x-show="reportHistoryTab === 'sos'" id="sos-history" style="padding:10px 14px 14px;">
                    <div style="font-size:9.5px;color:var(--muted);font-weight:600;margin-bottom:10px;display:flex;align-items:center;gap:5px;">
                        <i class="fas fa-history" style="color:var(--brand);"></i> <span>Resolved dispatches are automatically cleared from your history after 30 days.</span>
                    </div>
                    @foreach($sosHistory as $index => $sos)
                    <div class="event-item" x-show="showAllSos || {{ $index }} < 3" x-transition style="margin-bottom:8px;">
                        <div style="background:{{ $sos->status === 'resolved' ? '#f0fdf4' : '#fef2f2' }};border:1px solid {{ $sos->status === 'resolved' ? '#bbf7d0' : '#fecaca' }};border-radius:10px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas {{ $sos->status === 'resolved' ? 'fa-check-circle' : 'fa-ambulance' }}" style="color:{{ $sos->status === 'resolved' ? '#16a34a' : '#dc2626' }};font-size:14px;"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:12px;font-weight:800;color:var(--text);display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                                <span>{{ $sos->emergency_type ?? 'Emergency SOS' }}</span>
                                <span style="font-size:10px;font-weight:700;color:var(--muted);">#SOS-{{ sprintf('%04d', $sos->id) }}</span>
                            </div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">
                                @if($sos->landmark)
                                    <span><i class="fas fa-map-marker-alt" style="color:#dc2626;"></i> {{ $sos->landmark }}</span> • 
                                @endif
                                Status: 
                                @if($sos->status === 'resolved')
                                    <span style="font-weight:900;text-transform:uppercase;color:#15803d;background:#dcfce7;padding:2px 8px;border-radius:99px;border:1px solid #bbf7d0;font-size:9px;"><i class="fas fa-check"></i> Resolved</span>
                                @elseif($sos->status === 'responding')
                                    <span style="font-weight:900;text-transform:uppercase;color:#1d4ed8;background:#eff6ff;padding:2px 8px;border-radius:99px;border:1px solid #bfdbfe;font-size:9px;"><i class="fas fa-motorcycle"></i> Tanod Responding</span>
                                @elseif($sos->status === 'acknowledged')
                                    <span style="font-weight:900;text-transform:uppercase;color:#7c3aed;background:#fdf4ff;padding:2px 8px;border-radius:99px;border:1px solid #e9d5ff;font-size:9px;"><i class="fas fa-check-double"></i> Acknowledged</span>
                                @else
                                    <span style="font-weight:900;text-transform:uppercase;color:#be123c;background:#fff1f2;padding:2px 8px;border-radius:99px;border:1px solid #fecdd3;font-size:9px;"><i class="fas fa-satellite-dish"></i> Alert Dispatched</span>
                                @endif
                            </div>

                            @if($sos->dispatched_units)
                            <div style="font-size:9.5px;font-weight:800;color:#1e40af;background:#eff6ff;padding:3px 10px;border-radius:8px;display:inline-flex;align-items:center;gap:5px;margin-top:5px;border:1px solid #dbeafe;">
                                <i class="fas fa-shield-alt"></i> Assigned Unit: {{ $sos->dispatched_units }}
                            </div>
                            @endif

                            @if($sos->responder_notes)
                            <div style="font-size:9.5px;font-weight:700;color:#475569;background:#f8fafc;padding:4px 9px;border-radius:6px;margin-top:4px;border:1px dashed #cbd5e1;">
                                <i class="fas fa-clipboard-list" style="color:#64748b;"></i> Tanod Notes: {{ $sos->responder_notes }}
                            </div>
                            @endif
                        </div>
                        <div style="text-align:right;flex-shrink:0;">
                            <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;display:block;">{{ $sos->created_at->format('M d') }}</span>
                            <span style="font-size:9px;color:var(--light);font-weight:600;">{{ $sos->created_at->format('h:i A') }}</span>
                        </div>
                    </div>
                    @endforeach

                    @if($sosHistory->count() > 3)
                    <div style="text-align:center; margin-top:8px;">
                        <button type="button" @click="showAllSos = !showAllSos" 
                                style="width:100%; padding:7px 12px; background:#f8fafc; border:1.5px dashed #cbd5e1; border-radius:8px; font-size:11px; font-weight:800; color:var(--brand); cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px; transition:all .2s;">
                            <i class="fas" :class="showAllSos ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            <span x-text="showAllSos ? 'Show Less (Top 3)' : 'View all {{ $sosHistory->count() }} dispatches'"></span>
                        </button>
                    </div>
                    @endif

                    @if($sosHistory->isEmpty())
                    <div style="padding:30px;text-align:center;color:var(--light);">
                        <i class="fas fa-shield-heart" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                        <p style="font-size:11px;font-weight:700;">No emergency SOS dispatches recorded.</p>
                    </div>
                    @endif
                </div>

                {{-- 2. INCIDENT REPORTS TAB CONTENT --}}
                <div x-show="reportHistoryTab === 'incidents'" id="incident-reports" x-cloak style="padding:10px 14px 14px;">
                    @foreach($issueReports as $index => $rep)
                    <div class="event-item" x-show="showAllIncidents || {{ $index }} < 3" x-transition style="margin-bottom:8px;">
                        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-flag" style="color:#dc2626;font-size:13px;"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:12px;font-weight:800;color:var(--text);">{{ $rep->issue_type }} — {{ $rep->department }}</div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;">
                                Case No: {{ $rep->case_no ?? 'Pending' }} •
                                Status: 
                                @if($rep->status === 'under_review' && str_contains((string)$rep->admin_notes, 'AUTO-FLAGGED'))
                                    <span style="font-weight:900;text-transform:uppercase;color:#7c3aed;background:#fdf4ff;padding:2px 8px;border-radius:99px;border:1px solid #e9d5ff;font-size:9px;"><i class="fas fa-shield-alt"></i> Under Review (Auto-Flagged)</span>
                                @elseif(str_contains((string)$rep->admin_notes, 'PENDING CLASSIFICATION'))
                                    <span style="font-weight:900;text-transform:uppercase;color:#b45309;background:#fef3c7;padding:2px 8px;border-radius:99px;border:1px solid #fde68a;font-size:9px;"><i class="fas fa-hourglass-half"></i> Pending Classification</span>
                                @else
                                    <span style="font-weight:900;text-transform:uppercase;color:{{ 
                                        $rep->status === 'settled' || $rep->status === 'resolved' ? '#15803d' : 
                                        ($rep->status === 'on-going' ? '#1d4ed8' : '#92400e') 
                                    }}">{{ ucfirst(str_replace('_',' ',$rep->status)) }}</span>
                                @endif
                            </div>
                            @if($rep->hearing_date)
                            <div style="font-size:9px;font-weight:900;background:#eff6ff;color:#1d4ed8;padding:3px 10px;border-radius:99px;display:inline-block;margin-top:5px;border:1px solid #bfdbfe;">
                                <i class="fas fa-calendar-alt"></i> Hearing: {{ \Carbon\Carbon::parse($rep->hearing_date)->format('M d, Y h:i A') }}
                            </div>
                            @endif
                        </div>
                        <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;flex-shrink:0;">{{ $rep->created_at->format('M d') }}</span>
                    </div>
                    @endforeach

                    @if($issueReports->count() > 3)
                    <div style="text-align:center; margin-top:8px;">
                        <button type="button" @click="showAllIncidents = !showAllIncidents" 
                                style="width:100%; padding:7px 12px; background:#f8fafc; border:1.5px dashed #cbd5e1; border-radius:8px; font-size:11px; font-weight:800; color:var(--brand); cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px; transition:all .2s;">
                            <i class="fas" :class="showAllIncidents ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            <span x-text="showAllIncidents ? 'Show Less (Top 3)' : 'View all {{ $issueReports->count() }} reports'"></span>
                        </button>
                    </div>
                    @endif

                    @if($issueReports->isEmpty())
                    <div style="padding:30px;text-align:center;color:var(--light);">
                        <i class="fas fa-clipboard-check" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                        <p style="font-size:11px;font-weight:700;">No reports filed.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- EVENTS & ANNOUNCEMENTS (dynamic from admin) --}}
        <div class="wcard">
            <div class="about-tabs" style="margin-bottom:0;">
                <button class="about-tab" :class="eventTab==='events'?'active':''" @click="eventTab='events'">
                    <i class="fas fa-calendar-alt"></i> <span x-text="t('events')">Events</span>
                </button>
                <button class="about-tab" :class="eventTab==='announcements'?'active':''" @click="eventTab='announcements'">
                    <i class="fas fa-bullhorn"></i> <span x-text="t('announcements')">Announcements</span>
                </button>
                <button class="about-tab" :class="eventTab==='officials'?'active':''" @click="eventTab='officials'">
                    <i class="fas fa-users"></i> <span x-text="t('officials')">Officials</span>
                </button>
                <button class="about-tab" :class="eventTab==='projects'?'active':''" @click="eventTab='projects'">
                    <i class="fas fa-project-diagram"></i> <span x-text="t('projects')">Projects</span>
                </button>
            </div>

            <div x-show="eventTab==='events'" x-transition>
                @forelse($events as $evt)
                @php
                    $etColors = ['Community'=>'etag-g','Health'=>'etag-b','Sanitation'=>'etag-o','Governance'=>'etag-p'];
                    $etClass  = $etColors[$evt->tag] ?? 'etag-b';
                @endphp
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Event',title:{{ json_encode($evt->title) }},description:{{ json_encode($evt->description) }},image:{{ $evt->image_path?json_encode(asset('storage/'.$evt->image_path)):json_encode(null) }},images:{{ json_encode($evt->images_list) }},tag:{{ json_encode($evt->tag) }},date:{{ json_encode($evt->created_at->format('M d, Y')) }},location:{{ json_encode($evt->location) }},time_range:{{ json_encode($evt->time_range) }}}; activeImgIndex=0; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div class="event-day-box">
                        <div class="event-day-num">{{ $evt->day_label }}</div>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:13px;font-weight:900;color:var(--text);letter-spacing:.01em;">{{ $evt->title }}</div>
                        <div style="font-size:11px;color:var(--brand);font-weight:800;margin-top:3px;line-height:1.4;">
                            @if($evt->time_range)<strong>{{ $evt->time_range }}</strong>@endif
                            @if($evt->location) • <strong>{{ $evt->location }}</strong>@endif
                        </div>
                        @if($evt->description)<div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">{{ \Illuminate\Support\Str::limit($evt->description, 80) }}</div>@endif
                        <div style="display:flex;align-items:center;gap:6px;margin-top:4px;">
                            <span class="etag {{ $etClass }}">{{ $evt->tag }}</span>
                            @if(count($evt->images_list) > 1)
                                <span style="font-size:8px;font-weight:900;background:rgba(14,83,147,0.1);color:var(--brand);padding:2px 6px;border-radius:99px;display:inline-flex;align-items:center;gap:3px;">
                                    <i class="fas fa-images"></i> {{ count($evt->images_list) }} photos
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-calendar-alt" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;" x-text="t('no_events')">No events scheduled yet.</p>
                </div>
                @endforelse
            </div>

            <div x-show="eventTab==='announcements'" x-transition x-cloak>
                @forelse($announcements as $ann)
                @php $tc = $tagColors[$ann->tag] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Announcement',title:{{ json_encode($ann->title) }},description:{{ json_encode($ann->content) }},image:{{ $ann->image_path?json_encode(asset('storage/'.$ann->image_path)):json_encode(null) }},images:{{ json_encode($ann->images_list) }},tag:{{ json_encode($ann->tag) }},date:{{ json_encode($ann->date ? \Carbon\Carbon::parse($ann->date)->format('M d, Y') : $ann->created_at->format('M d, Y')) }}}; activeImgIndex=0; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div class="event-day-box" style="background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">
                        <i class="fas fa-bullhorn" style="font-size:18px;"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:13px;font-weight:900;color:var(--text);letter-spacing:.01em;">{{ $ann->title }}</div>
                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">{{ \Illuminate\Support\Str::limit($ann->content, 80) }}</div>
                        <div style="display:flex;align-items:center;gap:6px;margin-top:4px;">
                            <span style="font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 7px;border-radius:99px;display:inline-block;background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">{{ $ann->tag }}</span>
                            @if(count($ann->images_list) > 1)
                                <span style="font-size:8px;font-weight:900;background:rgba(14,83,147,0.1);color:var(--brand);padding:2px 6px;border-radius:99px;display:inline-flex;align-items:center;gap:3px;">
                                    <i class="fas fa-images"></i> {{ count($ann->images_list) }} photos
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-bullhorn" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;" x-text="t('no_announcements')">No announcements available.</p>
                </div>
                @endforelse
            </div>

            <div x-show="eventTab==='officials'" x-transition x-cloak style="padding:20px;">
                @if($isAuth)
                    <div style="text-align:center;">
                        <h3 style="font-size:16px; font-weight:900; color:var(--brand-dark); text-transform:uppercase; letter-spacing:.05em; margin-bottom:5px;">Organizational Chart</h3>
                        <p style="font-size:10px; color:var(--muted); font-weight:600; margin-bottom:20px;">Barangay San Miguel II — Current Term</p>
                        
                        @if($orgChartPath)
                            <div style="background:#fff; border:1px solid var(--border); border-radius:12px; overflow:hidden; box-shadow:var(--card-shadow);">
                                <img src="{{ asset('storage/' . $orgChartPath) }}" style="width:100%; height:auto; display:block;" alt="Barangay Organizational Chart" onerror="this.parentElement.style.display='none'; document.getElementById('org-chart-missing').style.display='block';">
                            </div>
                            <div id="org-chart-missing" style="display:none; padding:40px 20px; background:#f8fafc; border:2px dashed var(--border); border-radius:12px; color:var(--light); text-align:center;">
                                <i class="fas fa-sitemap" style="font-size:40px; margin-bottom:12px; opacity:.3;"></i>
                                <div style="font-size:12px; font-weight:800;">Organizational Chart is currently being updated.</div>
                                <div style="font-size:10px; font-weight:600; margin-top:4px;">Please check back later.</div>
                            </div>
                        @else
                            <div style="padding:40px 20px; background:#f8fafc; border:2px dashed var(--border); border-radius:12px; color:var(--light); text-align:center;">
                                <i class="fas fa-sitemap" style="font-size:40px; margin-bottom:12px; opacity:.3;"></i>
                                <div style="font-size:12px; font-weight:800;">Organizational Chart is currently being updated.</div>
                                <div style="font-size:10px; font-weight:600; margin-top:4px;">Please check back later.</div>
                            </div>
                        @endif
                    </div>
                @else
                    <div style="text-align:center; padding:30px 20px; background:linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-radius:16px; border:1.5px solid #bfdbfe;">
                        <div style="width:50px; height:50px; background:var(--brand); color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 15px; font-size:20px;">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 style="font-size:14px; font-weight:900; color:var(--brand-dark); margin-bottom:8px;">Protected Information</h3>
                        <p style="font-size:11px; color:var(--muted); font-weight:600; line-height:1.6; max-width:300px; margin:0 auto 15px;">To protect the privacy of our community leaders and maintain security, the organizational chart is only visible to <strong>legitimate residents</strong>.</p>
                        <a href="{{ route('login') }}" class="btn-grad btn-sm"><i class="fas fa-sign-in-alt"></i> Login to View</a>
                    </div>
                @endif
            </div>

            <div x-show="eventTab==='projects'" x-transition x-cloak>
                @forelse($projects as $proj)
                @php
                    $statBadges = [
                        'planning'    => ['bg'=>'#e0e7ff', 'color'=>'#3730a3', 'label'=>'Planning'],
                        'in_progress' => ['bg'=>'#fef3c7', 'color'=>'#92400e', 'label'=>'In Progress'],
                        'completed'   => ['bg'=>'#dcfce7', 'color'=>'#166534', 'label'=>'Completed'],
                    ];
                    $sb = $statBadges[$proj->status] ?? ['bg'=>'#f1f5f9','color'=>'#475569','label'=>ucfirst($proj->status)];
                @endphp
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Project',title:{{ json_encode($proj->title) }},description:{{ json_encode($proj->description) }},image:{{ json_encode($proj->cover_image_url) }},images:{{ json_encode($proj->images_list) }},tag:{{ json_encode($proj->category ?? 'Barangay Project') }},date:{{ json_encode(($proj->start_date ? \Carbon\Carbon::parse($proj->start_date)->format('M d, Y') : 'Ongoing') . ($proj->completion_date ? ' - ' . \Carbon\Carbon::parse($proj->completion_date)->format('M d, Y') : '')) }}}; activeImgIndex=0; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div class="event-day-box" style="background:#eff6ff;color:#1d4ed8;">
                        <i class="fas fa-hammer" style="font-size:18px;"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                            <div style="font-size:13px;font-weight:900;color:var(--text);letter-spacing:.01em;">{{ $proj->title }}</div>
                            <span style="font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 8px;border-radius:99px;background:{{ $sb['bg'] }};color:{{ $sb['color'] }};white-space:nowrap;">{{ $sb['label'] }}</span>
                        </div>
                        <div style="font-size:11px;color:var(--brand);font-weight:800;margin-top:3px;line-height:1.4;">
                            <i class="fas fa-calendar-alt" style="font-size:9px;"></i> 
                            {{ $proj->start_date ? \Carbon\Carbon::parse($proj->start_date)->format('M d, Y') : 'Start TBA' }}
                            @if($proj->completion_date) — {{ \Carbon\Carbon::parse($proj->completion_date)->format('M d, Y') }} @endif
                        </div>
                        @if($proj->description)<div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">{{ \Illuminate\Support\Str::limit($proj->description, 85) }}</div>@endif
                        <div style="display:flex;align-items:center;gap:6px;margin-top:4px;">
                            <span style="font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 7px;border-radius:99px;display:inline-block;background:#f1f5f9;color:#475569;">{{ $proj->category ?? 'Infrastructure' }}</span>
                            @if(count($proj->images_list) > 1)
                                <span style="font-size:8px;font-weight:900;background:rgba(14,83,147,0.1);color:var(--brand);padding:2px 6px;border-radius:99px;display:inline-flex;align-items:center;gap:3px;">
                                    <i class="fas fa-images"></i> {{ count($proj->images_list) }} photos
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-project-diagram" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No active barangay projects listed.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- ABOUT / ANNOUNCEMENTS TABS --}}
        <div class="wcard">
            <div class="about-tabs">
                <button class="about-tab" :class="aboutTab==='about'?'active':''" @click="aboutTab='about'">
                    <i class="fas fa-info-circle"></i> <span x-text="t('about_tab')">About</span>
                </button>
                <button class="about-tab" :class="aboutTab==='announcements'?'active':''" @click="aboutTab='announcements'">
                    <i class="fas fa-clock"></i> <span x-text="t('past_updates_tab')">Past Updates</span>
                </button>
            </div>

            {{-- ABOUT TAB --}}
            <div x-show="aboutTab==='about'" x-transition>
                <div class="about-grid">
                    <div class="about-card"><div class="about-ico"><i class="fas fa-bullseye"></i></div><div class="about-ttl">Mission</div><div class="about-desc">To deliver accessible, efficient, and transparent barangay services that uphold the dignity and welfare of every resident.</div></div>
                    <div class="about-card"><div class="about-ico"><i class="fas fa-eye"></i></div><div class="about-ttl">Vision</div><div class="about-desc">A progressive, peaceful, and self-reliant barangay where every resident thrives in a safe and inclusive environment.</div></div>
                    <div class="about-card"><div class="about-ico"><i class="fas fa-laptop"></i></div><div class="about-ttl">Digital Services</div><div class="about-desc">Our platform streamlines document requests, resident registration, and community communication — reducing wait times for all.</div></div>
                    <div class="about-card"><div class="about-ico"><i class="fas fa-map-marker-alt"></i></div><div class="about-ttl">Location & Contact</div><div class="about-desc">Barangay San Miguel II, Dasmariñas City, Cavite. Hall open Mon–Fri 8AM–5PM. Contact: (046) XXX-XXXX.</div></div>
                </div>
            </div>

            {{-- PAST WEEK UPDATES TAB --}}
            <div x-show="aboutTab==='announcements'" x-transition x-cloak>
                @if($recentUpdates->count() > 0)
                <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;padding:12px 16px 0;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <select x-model="filterMonth" class="finput fselect" style="padding:6px 10px;font-size:11px;width:auto;min-width:110px;margin:0;">
                            <option value="">All Months</option>
                            <option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option>
                            <option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option>
                            <option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>
                        </select>
                        <select x-model="filterYear" class="finput fselect" style="padding:6px 10px;font-size:11px;width:auto;min-width:90px;margin:0;">
                            <option value="">All Years</option>
                            @foreach(range('2020', (string)((int)date('Y')+2)) as $y)
                            <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px;">
                        <button @click="viewMode='grid'" class="btn btn-sm" :class="viewMode==='grid'?'btn-primary':'btn-ghost'" title="Grid View" style="padding:6px 10px; border-radius:7px; min-width:32px; height:30px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer;">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button @click="viewMode='list'" class="btn btn-sm" :class="viewMode==='list'?'btn-primary':'btn-ghost'" title="List View" style="padding:6px 10px; border-radius:7px; min-width:32px; height:30px; display:inline-flex; align-items:center; justify-content:center; cursor:pointer;">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
                <div :class="viewMode==='grid' ? 'recent-ann-grid' : 'recent-ann-list'">
                    @foreach($recentUpdates as $upd)
                    @php $tc = $tagColors[$upd->tag] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                    <div class="recent-ann-card" style="cursor:pointer;" x-show="(filterMonth === '' || '{{ $upd->created_at->format('m') }}' === filterMonth) && (filterYear === '' || '{{ $upd->created_at->format('Y') }}' === filterYear)" @click="activeItem={type:{{ json_encode($upd->type) }},title:{{ json_encode($upd->title) }},description:{{ json_encode($upd->content ?? $upd->description) }},image:{{ $upd->image_path?json_encode(asset('storage/'.$upd->image_path)):json_encode(null) }},images:{{ json_encode($upd->images_list) }},tag:{{ json_encode($upd->tag) }},date:{{ json_encode($upd->created_at->format('M d, Y')) }},location:{{ json_encode($upd->location ?? '') }},time_range:{{ json_encode($upd->time_range ?? '') }}}; activeImgIndex=0; itemModal=true">
                        @if($upd->image_path)
                        <div style="position:relative;">
                            <img src="{{ asset('storage/'.$upd->image_path) }}" class="recent-ann-img" alt="{{ $upd->title }}" onerror="this.onerror=null; this.src='{{ asset('images/canal.jpg') }}';">
                            @if(count($upd->images_list) > 1)
                                <span style="position:absolute;bottom:8px;right:8px;background:rgba(4,25,45,0.85);color:#fff;font-size:10px;font-weight:800;padding:3px 7px;border-radius:6px;backdrop-filter:blur(4px);display:flex;align-items:center;gap:4px;box-shadow:0 2px 6px rgba(0,0,0,0.3);">
                                    <i class="fas fa-images"></i> +{{ count($upd->images_list) }}
                                </span>
                            @endif
                        </div>
                        @else
                        <div class="recent-ann-img-placeholder"><i class="fas {{ $upd->type === 'Event' ? 'fa-calendar-alt' : 'fa-bullhorn' }}"></i></div>
                        @endif
                        <div class="recent-ann-body">
                            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                                <span class="recent-ann-tag" style="background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">{{ $upd->type }} • {{ $upd->tag }}</span>
                                @if(!$upd->is_active)
                                <span style="font-size:8px;font-weight:900;text-transform:uppercase;color:var(--muted);background:#f1f5f9;padding:2px 6px;border-radius:4px;letter-spacing:.05em;">Past Update</span>
                                @endif
                            </div>
                            <div class="recent-ann-title">{{ $upd->title }}</div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:4px;line-height:1.4;">{{ \Illuminate\Support\Str::limit($upd->content ?? $upd->description, 80) }}</div>
                            <div class="recent-ann-date"><i class="fas fa-clock" style="margin-right:3px;"></i>{{ $upd->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-history" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No updates in the past week.</p>
                </div>
                @endif
            </div>
        </div>

    </div>{{-- /rp-wrap --}}

    {{-- DOCUMENT REQUEST MODAL --}}
    <div x-show="docuModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" @click.away="docuModal=false;selectedDoc=''">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico"><i class="fas fa-file-alt"></i></div>
                        <div>
                            <div x-text="selectedDoc ? (getDocName(selDocObj)+' — '+(lang==='fil'?'Form ng Kahilingan':'Request Form')) : (lang==='fil'?'Mga Serbisyo sa Dokumento Online':'Online Document Services')"></div>
                            <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Barangay San Miguel II</div>
                        </div>
                    </div>
                    <button @click="docuModal=false;selectedDoc=''" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                @if($isAuth)
                <div style="display:flex;align-items:center;justify-content:space-between;background:#f8fafc;border:1px solid var(--border);border-radius:9px;padding:9px 13px;margin-bottom:12px;">
                    <span style="font-size:11px;font-weight:700;color:var(--muted);"><i class="fas fa-user-check" style="margin-right:4px;"></i><span x-text="lang==='fil'?'Inyong Katayuan:':'Your Status:'">Your Status:</span></span>
                    <span x-show="isPendingVerification" class="card-badge" style="background:#fef3c7; color:#b45309; font-weight:800; font-size:9.5px; padding:3px 9px; border-radius:99px;"><i class="fas fa-user-clock"></i> <span x-text="lang==='fil'?'Bago / Pending Verification':'New / Pending Verification'">New / Pending Verification</span></span>
                    <span x-show="!isPendingVerification && isVoter" class="voter-free"><i class="fas fa-check-circle"></i> <span x-text="lang==='fil'?'Rehistradong Botante':'Registered Voter'">Registered Voter</span></span>
                    <span x-show="!isPendingVerification && !isVoter" class="voter-pay"><i class="fas fa-user"></i> <span x-text="lang==='fil'?'Hindi Botante':'Non-Voter'">Non-Voter</span></span>
                </div>
                @endif

                <div x-show="!selectedDoc">
                    <p style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:9px;" x-text="t('select_doc')">Select Document Type</p>

                    {{-- Notice for Pending Verification Accounts --}}
                    <div x-show="isPendingVerification" style="background:linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border:1.5px solid #93c5fd; border-radius:10px; padding:10px 14px; margin-bottom:14px; display:flex; align-items:center; gap:10px;">
                        <div style="width:30px; height:30px; border-radius:8px; background:#0E5393; color:#fff; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:13px; box-shadow:0 2px 6px rgba(14,83,147,0.3);">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div style="flex:1; min-width:0; font-size:11px; color:#1e40af; line-height:1.45;">
                            <span x-show="lang==='fil'"><strong>Bukas para sa Bagong Lipat (Move-In):</strong> Habang ang inyong account ay hindi pa beripikado sa Masterlist, tanging ang <strong>Certification of Move-In</strong> lamang ang bukas na request. Ang iba pang sertipiko ay magagamit kapag na-aprubahan na ang inyong paninirahan.</span>
                            <span x-show="lang!=='fil'"><strong>Open for New Residents (Move-In):</strong> While your account is pending masterlist verification, only the <strong>Certification of Move-In</strong> request is open. Other certificates will unlock once your residency is verified by the Barangay Office.</span>
                        </div>
                    </div>

                    <div class="docu-grid">
                        <template x-for="doc in docs" :key="doc.key">
                            <div class="docu-pick" 
                                 @click="
                                     if (isPendingVerification && doc.key !== 'movein') { pendingLockModal=true; return; }
                                     if (doc.key === 'jobseeker' && hasAvailedJobseeker) { jobseekerLockedModal=true; return; }
                                     selectedDoc=doc.key;
                                 " 
                                 :class="[
                                     selectedDoc===doc.key ? 'sel' : '',
                                     (isPendingVerification && doc.key !== 'movein') ? 'docu-pick-locked' : '',
                                     (doc.key === 'jobseeker' && hasAvailedJobseeker) ? 'docu-pick-locked' : '',
                                     (isPendingVerification && doc.key === 'movein') ? 'docu-pick-open' : ''
                                 ]"
                                 :style="(isPendingVerification && doc.key !== 'movein') ? 'opacity:0.55; position:relative;' : ((doc.key === 'jobseeker' && hasAvailedJobseeker) ? 'opacity:0.6; position:relative; background:#fff1f2;' : ((isPendingVerification && doc.key === 'movein') ? 'border:2px solid #059669; background:#ecfdf5; position:relative;' : ''))">
                                <template x-if="isPendingVerification && doc.key !== 'movein'">
                                    <div style="position:absolute; top:4px; right:4px; font-size:8px; color:#94a3b8;"><i class="fas fa-lock"></i></div>
                                </template>
                                <template x-if="doc.key === 'jobseeker' && hasAvailedJobseeker">
                                    <div style="position:absolute; top:3px; right:3px; background:#dc2626; color:#fff; font-size:7px; font-weight:900; padding:1px 5px; border-radius:4px; text-transform:uppercase;">1x Used</div>
                                </template>
                                <template x-if="isPendingVerification && doc.key === 'movein'">
                                    <div style="position:absolute; top:3px; right:3px; background:#059669; color:#fff; font-size:7px; font-weight:900; padding:1px 5px; border-radius:4px; text-transform:uppercase; letter-spacing:0.04em;">Open</div>
                                </template>
                                <div class="docu-pick-ico" :style="(isPendingVerification && doc.key === 'movein') ? 'background:#d1fae5;' : ((doc.key === 'jobseeker' && hasAvailedJobseeker) ? 'background:#fee2e2;color:#dc2626;' : '')">
                                    <i class="fas" :class="doc.icon" :style="(isPendingVerification && doc.key === 'movein') ? 'color:#059669;' : ((doc.key === 'jobseeker' && hasAvailedJobseeker) ? 'color:#dc2626;' : '')"></i>
                                </div>
                                <div class="docu-pick-lbl" :style="(isPendingVerification && doc.key === 'movein') ? 'color:#065f46; font-weight:900;' : ''" x-text="getDocName(doc)"></div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="selectedDoc" x-transition>
                    <button @click="selectedDoc=''" class="btn-plain btn-ghost btn-sm" style="margin-bottom:12px;"><i class="fas fa-arrow-left"></i> <span x-text="lang==='fil'?'Bumalik':'Back'">Back</span></button>
                    @php
                        $rawSelfAddress = $isAuth ? ($resident->address ?? $authUser?->address ?? '') : old('address', '');
                    @endphp
                    <script>
                    function residentDocFormState() {
                        return { 
                            cType: 'self', 
                            init() {
                                if (this.selectedDoc === 'yumao') {
                                    this.cType = 'authorized';
                                } else if (this.selectedDoc === 'movein' || this.selectedDoc === 'moveout' || this.selectedDoc === 'jobseeker') {
                                    this.cType = 'self';
                                }
                                this.$watch('selectedDoc', (val) => {
                                    if (val === 'yumao') {
                                        this.cType = 'authorized';
                                    } else if (val === 'movein' || val === 'moveout' || val === 'jobseeker') {
                                        this.cType = 'self';
                                    }
                                });
                            },
                            selfPurpose: '',
                            selfPurposeSelect: '',
                            selfPurposeCustom: '',
                            validationAlertMsg: '',
                            showDocConfirmModal: false,
                            isSubmitting: false,
                            age: @json($isAuth ? ($resident->age ?? ($authUser?->birthday ? \Carbon\Carbon::parse($authUser->birthday)->age : '')) : ''),
                            birthday: @json($isAuth ? ($resident->birthday ?? ($authUser?->birthday ? \Carbon\Carbon::parse($authUser->birthday)->format('Y-m-d') : '')) : ''),
                            authLetterName: '',
                            authIdName: '',
                            authId2Name: '',
                            isDraggingLetter: false,
                            isDraggingId: false,
                            isDraggingId2: false,
                            applicants: [{ 
                                first_name: '', 
                                middle_name: '', 
                                last_name: '', 
                                relation: '', 
                                blk_no: '',
                                lot_no: '',
                                address: 'Barangay San Miguel II, Dasmariñas City, Cavite', 
                                purpose: '', 
                                purposeSelect: '', 
                                purposeCustom: '', 
                                contact: @json($isAuth ? ($authUser?->contact_number ?? $resident?->contact_number ?? '') : ''), 
                                age: '', 
                                birthday: '' 
                            }],
                            calculateAge(bday) {
                                 if(!bday) return '';
                                 const bd = new Date(bday);
                                 const today = new Date();
                                 let a = today.getFullYear() - bd.getFullYear();
                                 const m = today.getMonth() - bd.getMonth();
                                 if(m < 0 || (m === 0 && today.getDate() < bd.getDate())) a--;
                                 return a;
                            },
                            updateApplicantAddress(app) {
                                let b = (app.blk_no || '').trim();
                                let l = (app.lot_no || '').trim();
                                let parts = [];
                                if (b) parts.push('Block ' + b);
                                if (l) parts.push('Lot ' + l);
                                let prefix = parts.join(' ');
                                app.address = prefix ? prefix + ', Barangay San Miguel II, Dasmariñas City, Cavite' : 'Barangay San Miguel II, Dasmariñas City, Cavite';
                            },
                            handleDocSubmit() {
                                this.validationAlertMsg = '';
                                const form = this.$refs.docReqForm;

                                // Sync claimant type with checked DOM radio
                                const claimantRadio = form.querySelector('input[name="claimant_type"]:checked');
                                const currentClaimant = claimantRadio ? claimantRadio.value : this.cType;
                                this.cType = currentClaimant;

                                const flagMissing = (targetEl, msg) => {
                                    this.validationAlertMsg = msg || 'Pakisagutan po ang kulang na field bago magpatuloy.';
                                    if (!targetEl) return;
                                    
                                    // Smoothly scroll the modal-box container directly to the missing element!
                                    const modalBox = targetEl.closest('.modal-box') || document.querySelector('.modal-box');
                                    if (modalBox) {
                                        const boxRect = modalBox.getBoundingClientRect();
                                        const elRect = targetEl.getBoundingClientRect();
                                        const targetScrollTop = modalBox.scrollTop + (elRect.top - boxRect.top) - (modalBox.clientHeight / 2) + (elRect.height / 2);
                                        modalBox.scrollTo({ top: Math.max(0, targetScrollTop), behavior: 'smooth' });
                                    } else {
                                        targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    }

                                    if (typeof targetEl.focus === 'function') {
                                        try { targetEl.focus({ preventScroll: true }); } catch(e){}
                                    }
                                    targetEl.classList.remove('input-field-missing');
                                    void targetEl.offsetWidth;
                                    targetEl.classList.add('input-field-missing');
                                    if (typeof targetEl.reportValidity === 'function') {
                                        try { targetEl.reportValidity(); } catch(e){}
                                    }
                                    setTimeout(() => {
                                        targetEl.classList.remove('input-field-missing');
                                    }, 4000);
                                };

                                if (currentClaimant === 'authorized') {
                                    if (!this.$refs.authLetter?.files?.length && !this.authLetterName) {
                                        flagMissing(this.$refs.authLetterCard, 'Pakilagay po ang Authorization Letter.');
                                        return;
                                    }
                                    if (!this.$refs.authId?.files?.length && !this.authIdName) {
                                        flagMissing(this.$refs.authIdCard, 'Pakilagay po ang Valid ID ng Authorized Person.');
                                        return;
                                    }
                                    if (!this.$refs.authId2?.files?.length && !this.authId2Name) {
                                        flagMissing(this.$refs.authId2Card, 'Pakilagay po ang Valid ID ng taong kinakatawan.');
                                        return;
                                    }

                                    for (let i = 0; i < this.applicants.length; i++) {
                                        const app = this.applicants[i];
                                        if (!app.relation) {
                                            const el = form.querySelector(`select[name="applicants[${i}][relation]"]`);
                                            flagMissing(el, `Pakipili po ang relasyon sa Applicant #${i + 1}.`);
                                            return;
                                        }
                                        if (!app.first_name || !app.first_name.trim()) {
                                            const el = form.querySelector(`input[name="applicants[${i}][first_name]"]`);
                                            flagMissing(el, `Pakilagay po ang Pangalan (First Name) ng Applicant #${i + 1}.`);
                                            return;
                                        }
                                        if (!app.last_name || !app.last_name.trim()) {
                                            const el = form.querySelector(`input[name="applicants[${i}][last_name]"]`);
                                            flagMissing(el, `Pakilagay po ang Apelyido (Last Name) ng Applicant #${i + 1}.`);
                                            return;
                                        }
                                        if (!app.blk_no || !app.blk_no.trim()) {
                                            const el = form.querySelectorAll('.app-blk-input')[i];
                                            flagMissing(el, `Pakilagay po ang Block No. ng tirahan sa Brgy. San Miguel II.`);
                                            return;
                                        }
                                        if (!app.lot_no || !app.lot_no.trim()) {
                                            const el = form.querySelectorAll('.app-lot-input')[i];
                                            flagMissing(el, `Pakilagay po ang Lot No. ng tirahan sa Brgy. San Miguel II.`);
                                            return;
                                        }
                                        if (!app.purpose || !app.purpose.trim()) {
                                            const el = form.querySelectorAll('.app-purpose-select')[i];
                                            flagMissing(el, `Pakipili po ang Layunin (Purpose) ng dokumento.`);
                                            return;
                                        }
                                    }
                                } else {
                                    @if(!$isAuth)
                                    const guestFn = form.querySelector('input[name="guest_first_name"]');
                                    if (guestFn && !guestFn.value.trim()) {
                                        flagMissing(guestFn, 'Pakilagay po ang inyong Pangalan (First Name).');
                                        return;
                                    }
                                    const guestLn = form.querySelector('input[name="guest_last_name"]');
                                    if (guestLn && !guestLn.value.trim()) {
                                        flagMissing(guestLn, 'Pakilagay po ang inyong Apelyido (Last Name).');
                                        return;
                                    }
                                    const guestEmail = form.querySelector('input[name="guest_email"]');
                                    if (guestEmail && (!guestEmail.value.trim() || !guestEmail.checkValidity())) {
                                        flagMissing(guestEmail, 'Pakilagay po ang inyong valid na Gmail address.');
                                        return;
                                    }
                                    const guestAddr = form.querySelector('input[name="address"]');
                                    if (guestAddr && !guestAddr.value.trim()) {
                                        flagMissing(guestAddr, 'Pakilagay po ang inyong address sa Brgy. San Miguel II.');
                                        return;
                                    }
                                    @endif

                                    if (!this.selfPurpose || !this.selfPurpose.trim() || (this.selfPurposeSelect === 'Others' && (!this.selfPurposeCustom || !this.selfPurposeCustom.trim()))) {
                                        const purEl = this.selfPurposeSelect === 'Others' ? form.querySelector('.self-purpose-custom') : form.querySelector('.self-purpose-select');
                                        flagMissing(purEl, 'Pakipili o isulat po ang inyong Layunin (Purpose).');
                                        return;
                                    }

                                    if (this.selectedDoc === 'jobseeker') {
                                        const bdayInput = form.querySelector('input[name="birthday"]');
                                        if (!this.birthday || (bdayInput && !bdayInput.value)) {
                                            flagMissing(bdayInput, 'Pakilagay po ang petsa ng kapanganakan para sa First-Time Jobseeker.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'movein' || this.selectedDoc === 'moveout') {
                                        const blkInput = form.querySelector('input[name="blk"]');
                                        if (blkInput && !blkInput.value.trim()) {
                                            flagMissing(blkInput, 'Pakilagay po ang Block No. para sa move details.');
                                            return;
                                        }
                                        const lotInput = form.querySelector('input[name="lot"]');
                                        if (lotInput && !lotInput.value.trim()) {
                                            flagMissing(lotInput, 'Pakilagay po ang Lot No. para sa move details.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'business' || this.selectedDoc === 'closure') {
                                        const compInput = form.querySelector('input[name="company_name"]');
                                        if (compInput && !compInput.value.trim()) {
                                            flagMissing(compInput, 'Pakilagay po ang Business / Trade Name.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'guardianship') {
                                        const wName = form.querySelector('input[name="ward_name"]');
                                        if (wName && !wName.value.trim()) {
                                            flagMissing(wName, 'Pakilagay po ang buong pangalan ng Ward.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'cohabitation') {
                                        const pName = form.querySelector('input[name="partner_name"]');
                                        if (pName && !pName.value.trim()) {
                                            flagMissing(pName, 'Pakilagay po ang pangalan ng partner.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'cashgift') {
                                        const cName = form.querySelector('input[name="claimant_name"]');
                                        if (cName && !cName.value.trim()) {
                                            flagMissing(cName, 'Pakilagay po ang pangalan ng kaano-ano.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'latereg') {
                                        const chName = form.querySelector('input[name="child_name"]');
                                        if (chName && !chName.value.trim()) {
                                            flagMissing(chName, 'Pakilagay po ang buong pangalan ng anak.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'yumao') {
                                        const yName = form.querySelector('input[name="claimant_name"]');
                                        if (yName && !yName.value.trim()) {
                                            flagMissing(yName, 'Pakilagay po ang buong pangalan ng claimant.');
                                            return;
                                        }
                                    }

                                    if (this.selectedDoc === 'endorsement') {
                                        const resSince = form.querySelector('input[name="residing_since"]');
                                        if (resSince && !resSince.value.trim()) {
                                            flagMissing(resSince, 'Pakilagay po ang taon mula nang nanirahan sa Brgy. SM2.');
                                            return;
                                        }
                                    }
                                }

                                const visibleInputs = Array.from(form.querySelectorAll('input:required, select:required, textarea:required'));
                                for (const el of visibleInputs) {
                                    if (el.type === 'file' && el.style.display === 'none') continue;
                                    if (el.offsetParent === null) continue;
                                    if (currentClaimant === 'self' && el.closest('.auth-blue-box')) continue;
                                    if (currentClaimant === 'authorized' && el.closest('.self-section-container')) continue;
                                    if (!el.checkValidity() || !el.value.trim()) {
                                        flagMissing(el, el.validationMessage || 'Pakisagutan po ang field na ito bago magpatuloy.');
                                        return;
                                    }
                                }

                                this.showDocConfirmModal = true;
                            },
                            getPurposes(docKey) {
                                if (docKey === 'clearance') {
                                    return [
                                        'Local Employment',
                                        'Overseas Employment (Abroad)',
                                        'Student Enrollment / School Requirement / Scholarship',
                                        'Postal ID / Passport / Gov ID Application',
                                        'Bank Account Opening',
                                        'Police Clearance Requirement',
                                        'Others'
                                    ];
                                } else if (docKey === 'indigency') {
                                    return [
                                        'Medical Assistance (DSWD / Malasakit / Hospital)',
                                        'Financial Assistance',
                                        'Educational / Scholarship Subsidy',
                                        'Burial / Funeral Assistance',
                                        'Legal Aid (PAO)',
                                        'Others'
                                    ];
                                } else if (docKey === 'residency') {
                                    return [
                                        'Proof of Address / Residency',
                                        'Utility Connection (Meralco / Water / Internet)',
                                        'Loan Application',
                                        'Bank Requirement',
                                        'School / University Requirement',
                                        'Others'
                                    ];
                                } else if (docKey === 'business') {
                                    return [
                                        'New Business Permit / Mayor\'s Permit',
                                        'Business Permit Renewal',
                                        'DTI / SEC Registration',
                                        'Tricycle / Franchise Permit',
                                        'Others'
                                    ];
                                } else if (docKey === 'jobseeker') {
                                    return [
                                        'First-Time Jobseeker Employment (RA 11261)',
                                        'Government Examination / Pre-Employment',
                                        'Others'
                                    ];
                                } else if (docKey === 'movein' || docKey === 'moveout') {
                                    return [
                                        'New Resident Transfer / Relocation',
                                        'Proof of Residency Transfer',
                                        'Others'
                                    ];
                                }
                                return [
                                    'Employment',
                                    'Scholarship / School Requirement',
                                    'Financial / Medical Assistance',
                                    'Loan Application',
                                    'ID Requirement / Postal / Passport',
                                    'Proof of Residency',
                                    'Legal / Court Requirement',
                                    'Others'
                                ];
                            },
                            init() {
                                this.validationAlertMsg = '';
                                if (this.selectedDoc === 'yumao') {
                                    this.cType = 'authorized';
                                } else {
                                    this.cType = 'self';
                                }
                                if (this.selectedDoc === 'movein') {
                                    this.selfPurposeSelect = 'New Resident Transfer / Relocation';
                                    this.selfPurpose = 'New Resident Transfer / Relocation';
                                }
                                this.$watch('selectedDoc', (val) => {
                                    if (val === 'yumao') {
                                        this.cType = 'authorized';
                                    } else {
                                        this.cType = 'self';
                                    }
                                    this.validationAlertMsg = '';
                                    this.selfPurposeSelect = '';
                                    this.selfPurpose = '';
                                    this.selfPurposeCustom = '';
                                    if (val === 'movein') {
                                        this.selfPurposeSelect = 'New Resident Transfer / Relocation';
                                        this.selfPurpose = 'New Resident Transfer / Relocation';
                                    }
                                });
                            }
                        };
                    }
                    </script>
                    <form action="{{ route('resident.document.request') }}" method="POST" enctype="multipart/form-data" 
                          x-ref="docReqForm"
                          id="docReqForm"
                          @submit.prevent="handleDocSubmit()"
                          x-data="residentDocFormState()">
                        @csrf
                        <input type="hidden" name="document_type" :value="selectedDoc">

                        {{-- Claimant Selection --}}
                        <div class="sblk">
                                <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-user-check"></i> Who is claiming this document?</div>
                                <div class="fgrid2 fgrp" style="gap:12px;">
                                    <label style="display:flex;align-items:center;gap:10px;font-family:inherit;font-size:13.5px;font-weight:800;padding:10px 14px;border-radius:10px;transition:all .15s;"
                                           :style="selectedDoc === 'yumao' ? 'opacity:0.4;cursor:not-allowed;background:#f1f5f9;border:1.5px solid #cbd5e1;color:#94a3b8;' : (cType === 'self' ? 'border:2px solid var(--brand);background:#eff6ff;color:var(--brand);box-shadow:0 2px 6px rgba(14,83,147,0.1);' : 'cursor:pointer;border:1.5px solid #cbd5e1;background:#fff;color:#334155;')">
                                        <input type="radio" name="claimant_type" value="self" x-model="cType" @change="validationAlertMsg=''" :disabled="selectedDoc === 'yumao'" required style="accent-color:var(--brand);width:17px;height:17px;">
                                        <span>Self (Personal)</span>
                                    </label>
                                    <label style="display:flex;align-items:center;gap:10px;font-family:inherit;font-size:13.5px;font-weight:800;padding:10px 14px;border-radius:10px;transition:all .15s;"
                                           :style="(selectedDoc === 'movein' || selectedDoc === 'moveout' || selectedDoc === 'jobseeker') ? 'opacity:0.4;cursor:not-allowed;background:#f1f5f9;border:1.5px solid #cbd5e1;color:#94a3b8;' : (cType === 'authorized' ? 'border:2px solid var(--brand);background:#eff6ff;color:var(--brand);box-shadow:0 2px 6px rgba(14,83,147,0.1);' : 'cursor:pointer;border:1.5px solid #cbd5e1;background:#fff;color:#334155;')">
                                        <input type="radio" name="claimant_type" value="authorized" x-model="cType" @change="validationAlertMsg=''" :disabled="selectedDoc === 'movein' || selectedDoc === 'moveout' || selectedDoc === 'jobseeker'" required style="accent-color:var(--brand);width:17px;height:17px;">
                                        <span>Authorized Person</span>
                                    </label>
                                </div>
                                <template x-if="selectedDoc === 'yumao'">
                                    <div style="background:#fef2f2;border:2px solid #ef4444;border-radius:10px;padding:12px 15px;margin-top:10px;font-size:13px;color:#991b1b;font-weight:700;line-height:1.55;">
                                        <i class="fas fa-ribbon" style="color:#ef4444;font-size:16px;"></i> <strong>Authorized Representative Required:</strong> Para sa Pagpapatunay para sa Yumao, Authorized Representative (kamag-anak o kinatawan) lamang ang maaaring mag-asikaso at kumuha sa Barangay Hall.
                                    </div>
                                </template>
                                <template x-if="selectedDoc === 'movein' || selectedDoc === 'moveout'">
                                    <div style="background:#f0fdf4;border:2px solid #10b981;border-radius:10px;padding:12px 15px;margin-top:10px;font-size:13px;color:#065f46;font-weight:700;line-height:1.55;">
                                        <i class="fas fa-home" style="color:#10b981;font-size:16px;"></i> <strong>Personal Appearance Strictly Required:</strong> Ang pag-asikaso ng Move-In at Move-Out certification ay personal lamang na inaasikaso ng mismong residente (Personal / Self-Request lamang).
                                    </div>
                                </template>
                                <template x-if="selectedDoc === 'jobseeker'">
                                    <div style="background:#fef3c7;border:2px solid #f59e0b;border-radius:10px;padding:12px 15px;margin-top:10px;font-size:13px;color:#78350f;font-weight:700;line-height:1.55;">
                                        <i class="fas fa-exclamation-triangle" style="color:#d97706;font-size:16px;"></i> <strong>Personal Appearance Strictly Required (RA 11261):</strong> Bawal po ang Authorized Representative sa First-Time Jobseeker Certificate dahil kailangan pong personal na pirmahan ng aplikante ang Sworn Undertaking sa Barangay Hall.
                                    </div>
                                </template>
                            </div>
                            
                            {{-- AUTHORIZED THEME --}}
                            <div x-show="cType === 'authorized'" x-transition class="auth-blue-box" style="background:#f8fafc; border:1.5px solid #bfdbfe; border-radius:14px; padding:16px 18px; margin-top:14px;">
                                <div style="font-size:13px; color:var(--brand); font-weight:900; margin-bottom:12px; text-transform:uppercase; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:6px;">
                                    <span style="display:flex; align-items:center; gap:7px;">
                                        <i class="fas fa-shield-alt" style="font-size:15px;"></i> Authorization Required Files
                                    </span>
                                    <span style="font-size:10.5px; font-weight:700; color:#2563eb; background:#eff6ff; border:1px solid #bfdbfe; padding:2px 8px; border-radius:6px;">
                                        Max 5MB bawat file (JPG, PNG, PDF)
                                    </span>
                                </div>
                                
                                {{-- 3 Equal Row Boxes for Authorization Uploads (Aligned in a Row, Label Inside, Equal Height) --}}
                                <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:10px; margin-bottom:16px;">
                                    {{-- Box 1: Authorization Letter --}}
                                    <div x-ref="authLetterCard"
                                         @click="$refs.authLetter.click()" 
                                         style="background:#fff; border:1.5px dashed #cbd5e1; border-radius:12px; padding:12px 8px; text-align:center; cursor:pointer; display:flex; flex-direction:column; align-items:center; justify-content:space-between; min-height:140px; height:100%; box-sizing:border-box; transition:all .2s;"
                                         :style="authLetterName ? 'border:1.5px solid #10b981; background:#f0fdf4;' : 'border-color:#cbd5e1;'">
                                        <div style="display:flex; flex-direction:column; align-items:center; gap:6px; width:100%;">
                                            <div style="width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;"
                                                 :style="authLetterName ? 'background:#dcfce7; color:#15803d;' : 'background:#eff6ff; color:var(--brand);'">
                                                <i :class="authLetterName ? 'fas fa-check' : 'fas fa-file-signature'" style="font-size:15px;"></i>
                                            </div>
                                            <div style="font-size:11.5px; font-weight:800; color:#1e293b; line-height:1.25;">
                                                1. Authorization Letter <span style="color:#dc2626;">*</span>
                                            </div>
                                            <div style="font-size:10px; font-weight:600; color:#64748b; line-height:1.25; word-break:break-word; max-width:100%; overflow:hidden; text-overflow:ellipsis; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;"
                                                 :style="authLetterName ? 'color:#15803d; font-weight:700;' : ''"
                                                 x-text="authLetterName ? authLetterName : 'Pirmadong liham ng awtorisasyon'">
                                            </div>
                                        </div>
                                        <div style="margin-top:8px; width:100%;">
                                            <span style="font-size:10px; font-weight:700; padding:4px 8px; border-radius:6px; display:inline-block; border:1px solid #cbd5e1;"
                                                  :style="authLetterName ? 'background:#dcfce7; color:#15803d; border-color:#86efac;' : 'background:#f1f5f9; color:#334155;'"
                                                  x-text="authLetterName ? 'Palitan File' : 'Pumili ng File'">
                                            </span>
                                        </div>
                                        <input type="file" x-ref="authLetter" name="authorization_letter" accept="image/*,.pdf" style="display:none;" @change="if($event.target.files.length){ const f=$event.target.files[0]; if(f.size > 5*1024*1024){ alert('Masyadong malaki ang file ('+(f.size/1024/1024).toFixed(1)+'MB)! Ang maximum allowed size ay 5MB lamang.'); $event.target.value=''; authLetterName=''; return; } authLetterName = f.name; }">
                                    </div>

                                    {{-- Box 2: Valid ID of Representative --}}
                                    <div x-ref="authIdCard"
                                         @click="$refs.authId.click()" 
                                         style="background:#fff; border:1.5px dashed #cbd5e1; border-radius:12px; padding:12px 8px; text-align:center; cursor:pointer; display:flex; flex-direction:column; align-items:center; justify-content:space-between; min-height:140px; height:100%; box-sizing:border-box; transition:all .2s;"
                                         :style="authIdName ? 'border:1.5px solid #10b981; background:#f0fdf4;' : 'border-color:#cbd5e1;'">
                                        <div style="display:flex; flex-direction:column; align-items:center; gap:6px; width:100%;">
                                            <div style="width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;"
                                                 :style="authIdName ? 'background:#dcfce7; color:#15803d;' : 'background:#eff6ff; color:var(--brand);'">
                                                <i :class="authIdName ? 'fas fa-check' : 'fas fa-id-card'" style="font-size:15px;"></i>
                                            </div>
                                            <div style="font-size:11.5px; font-weight:800; color:#1e293b; line-height:1.25;">
                                                2. Valid ID ng Kinatawan <span style="color:#dc2626;">*</span>
                                            </div>
                                            <div style="font-size:10px; font-weight:600; color:#64748b; line-height:1.25; word-break:break-word; max-width:100%; overflow:hidden; text-overflow:ellipsis; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;"
                                                 :style="authIdName ? 'color:#15803d; font-weight:700;' : ''"
                                                 x-text="authIdName ? authIdName : 'Valid ID ng Authorized Person'">
                                            </div>
                                        </div>
                                        <div style="margin-top:8px; width:100%;">
                                            <span style="font-size:10px; font-weight:700; padding:4px 8px; border-radius:6px; display:inline-block; border:1px solid #cbd5e1;"
                                                  :style="authIdName ? 'background:#dcfce7; color:#15803d; border-color:#86efac;' : 'background:#f1f5f9; color:#334155;'"
                                                  x-text="authIdName ? 'Palitan File' : 'Pumili ng File'">
                                            </span>
                                        </div>
                                        <input type="file" x-ref="authId" name="authorized_id" accept="image/*,.pdf" style="display:none;" @change="if($event.target.files.length){ const f=$event.target.files[0]; if(f.size > 5*1024*1024){ alert('Masyadong malaki ang ID ('+(f.size/1024/1024).toFixed(1)+'MB)! Ang maximum allowed size ay 5MB lamang.'); $event.target.value=''; authIdName=''; return; } authIdName = f.name; }">
                                    </div>

                                    {{-- Box 3: Valid ID of Resident Being Claimed For --}}
                                    <div x-ref="authId2Card"
                                         @click="$refs.authId2.click()" 
                                         style="background:#fff; border:1.5px dashed #cbd5e1; border-radius:12px; padding:12px 8px; text-align:center; cursor:pointer; display:flex; flex-direction:column; align-items:center; justify-content:space-between; min-height:140px; height:100%; box-sizing:border-box; transition:all .2s;"
                                         :style="authId2Name ? 'border:1.5px solid #10b981; background:#f0fdf4;' : 'border-color:#cbd5e1;'">
                                        <div style="display:flex; flex-direction:column; align-items:center; gap:6px; width:100%;">
                                            <div style="width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;"
                                                 :style="authId2Name ? 'background:#dcfce7; color:#15803d;' : 'background:#eff6ff; color:var(--brand);'">
                                                <i :class="authId2Name ? 'fas fa-check' : 'fas fa-user-check'" style="font-size:15px;"></i>
                                            </div>
                                            <div style="font-size:11.5px; font-weight:800; color:#1e293b; line-height:1.25;">
                                                3. Valid ID ng May-ari <span style="color:#dc2626;">*</span>
                                            </div>
                                            <div style="font-size:10px; font-weight:600; color:#64748b; line-height:1.25; word-break:break-word; max-width:100%; overflow:hidden; text-overflow:ellipsis; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;"
                                                 :style="authId2Name ? 'color:#15803d; font-weight:700;' : ''"
                                                 x-text="authId2Name ? authId2Name : 'Valid ID ng taong kinakatawan'">
                                            </div>
                                        </div>
                                        <div style="margin-top:8px; width:100%;">
                                            <span style="font-size:10px; font-weight:700; padding:4px 8px; border-radius:6px; display:inline-block; border:1px solid #cbd5e1;"
                                                  :style="authId2Name ? 'background:#dcfce7; color:#15803d; border-color:#86efac;' : 'background:#f1f5f9; color:#334155;'"
                                                  x-text="authId2Name ? 'Palitan File' : 'Pumili ng File'">
                                            </span>
                                        </div>
                                        <input type="file" x-ref="authId2" name="authorized_id2" accept="image/*,.pdf" style="display:none;" @change="if($event.target.files.length){ const f=$event.target.files[0]; if(f.size > 5*1024*1024){ alert('Masyadong malaki ang ID ('+(f.size/1024/1024).toFixed(1)+'MB)! Ang maximum allowed size ay 5MB lamang.'); $event.target.value=''; authId2Name=''; return; } authId2Name = f.name; }">
                                    </div>
                                </div>

                                <div class="privacy-divider" style="opacity:.3;margin:18px 0;"></div>

                                {{-- Applicant Repeater --}}
                                <template x-for="(app, index) in applicants" :key="index">
                                    <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px dashed #bfdbfe;" :style="index === applicants.length - 1 ? 'border-bottom:none;margin-bottom:0;padding-bottom:0;' : ''">
                                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                                            <p style="font-size:13px;color:var(--brand);font-weight:900;text-transform:uppercase;">
                                                <i :class="selectedDoc === 'yumao' ? 'fas fa-ribbon' : 'fas fa-user'"></i> 
                                                <span x-text="selectedDoc === 'yumao' ? 'Detalye ng Yumao / Pumanaw na Residente' : 'Applicant Details'">Applicant Details</span> 
                                                <span x-text="applicants.length > 1 ? '#' + (index + 1) : ''"></span>
                                            </p>
                                            <button type="button" x-show="applicants.length > 1" @click="applicants.splice(index, 1)" style="font-size:12px;color:var(--danger);font-weight:800;background:none;border:none;cursor:pointer;">
                                                <i class="fas fa-minus-circle"></i> REMOVE
                                            </button>
                                        </div>

                                        {{-- Row 1: First Name & Last Name (Matching Self tab) --}}
                                        <div class="fgrid2 fgrp">
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;"><span x-text="selectedDoc === 'yumao' ? 'First Name ng Pumanaw *' : 'First Name * (Applicant)'">First Name *</span></label>
                                                <input type="text" :name="'applicants['+index+'][first_name]'" class="finput" :placeholder="selectedDoc === 'yumao' ? 'Unang Pangalan ng Pumanaw' : 'First Name'" :required="cType === 'authorized'" x-model="app.first_name">
                                            </div>
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;"><span x-text="selectedDoc === 'yumao' ? 'Last Name ng Pumanaw *' : 'Last Name * (Applicant)'">Last Name *</span></label>
                                                <input type="text" :name="'applicants['+index+'][last_name]'" class="finput" :placeholder="selectedDoc === 'yumao' ? 'Apelyido ng Pumanaw' : 'Last Name'" :required="cType === 'authorized'" x-model="app.last_name">
                                            </div>
                                        </div>

                                        {{-- Row 2: Middle Name & Relationship to Applicant --}}
                                        <div class="fgrid2 fgrp">
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;">Middle Name <span style="font-size:11px;opacity:.7;">(Optional)</span></label>
                                                <input type="text" :name="'applicants['+index+'][middle_name]'" class="finput" placeholder="Middle Name" x-model="app.middle_name">
                                            </div>
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;"><span x-text="selectedDoc === 'yumao' ? 'Relasyon sa Yumao *' : 'Relationship to Applicant *'">Relationship to Applicant *</span></label>
                                                <select :name="'applicants['+index+'][relation]'" class="finput fselect" :required="cType === 'authorized'" x-model="app.relation">
                                                    <option value="">— Select Relationship —</option>
                                                    <option value="Parent">Parent</option>
                                                    <option value="Spouse">Spouse</option>
                                                    <option value="Child">Child</option>
                                                    <option value="Sibling">Sibling</option>
                                                    <option value="Legal Guardian">Legal Guardian</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Structured Address: Block & Lot in ONE single field with locked barangay/city text (NO BADGE, NO STREET) --}}
                                        <div class="fgrp">
                                            <label class="flbl" style="font-size:12.5px;font-weight:800;color:var(--text);margin-bottom:6px;">
                                                Residence Address in Barangay San Miguel II *
                                            </label>
                                            <div style="display:flex;align-items:center;flex-wrap:nowrap;white-space:nowrap;gap:6px;background:#f8fafc;border:1.5px solid var(--border);border-radius:9px;padding:8px 12px;font-size:12.5px;color:var(--text);font-weight:700;overflow-x:auto;">
                                                <span>Block</span>
                                                <input type="text" 
                                                       inputmode="numeric"
                                                       pattern="[0-9]*"
                                                       maxlength="3"
                                                       placeholder="___" 
                                                       class="app-blk-input" 
                                                       style="width:44px;padding:3px 4px;border:1.5px solid #cbd5e1;border-radius:6px;font-size:13px;font-weight:800;text-align:center;background:#fff;color:var(--text);outline:none;flex-shrink:0;"
                                                       x-model="app.blk_no"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);"
                                                       @input="updateApplicantAddress(app)"
                                                       :required="cType === 'authorized'">
                                                <span>Lot</span>
                                                <input type="text" 
                                                       inputmode="numeric"
                                                       pattern="[0-9]*"
                                                       maxlength="3"
                                                       placeholder="___" 
                                                       class="app-lot-input" 
                                                       style="width:44px;padding:3px 4px;border:1.5px solid #cbd5e1;border-radius:6px;font-size:13px;font-weight:800;text-align:center;background:#fff;color:var(--text);outline:none;flex-shrink:0;"
                                                       x-model="app.lot_no"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);"
                                                       @input="updateApplicantAddress(app)"
                                                       :required="cType === 'authorized'">
                                                <span style="color:#334155;font-weight:700;flex-shrink:0;">, Barangay San Miguel II, Dasmariñas City, Cavite</span>
                                            </div>
                                            <input type="hidden" :name="'applicants['+index+'][address]'" :value="app.address">
                                        </div>

                                        {{-- Conditional Birthday/Age (Only shown when document type requires it) --}}
                                        <div x-show="selectedDoc === 'jobseeker' || selectedDoc === 'latereg'" class="fgrid2 fgrp" style="margin-top:10px;">
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;">Date of Birth (Applicant)</label>
                                                <input type="date" :name="'applicants['+index+'][birthday]'" class="finput" x-model="app.birthday" 
                                                       @input="app.age = calculateAge($event.target.value)"
                                                       @change="app.age = calculateAge($event.target.value)">
                                            </div>
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;">Age (Applicant)</label>
                                                <input type="number" :name="'applicants['+index+'][age]'" class="finput" placeholder="Age" x-model="app.age" readonly style="background:#f1f5f9; cursor:not-allowed;">
                                            </div>
                                        </div>

                                        <div class="fgrid2 fgrp">
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;">Contact Number</label>
                                                <input type="text" :name="'applicants['+index+'][contact]'" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="finput" x-model="app.contact">
                                            </div>
                                            <div>
                                                <label class="flbl" style="font-size:12.5px;font-weight:800;">Purpose *</label>
                                                <select class="finput fselect app-purpose-select" x-model="app.purposeSelect" @change="if(app.purposeSelect !== 'Others') app.purpose = app.purposeSelect; else app.purpose = app.purposeCustom;" :required="cType === 'authorized'">
                                                    <option value="">— Select Purpose —</option>
                                                    <template x-for="p in getPurposes(selectedDoc)" :key="p">
                                                        <option :value="p" x-text="p"></option>
                                                    </template>
                                                </select>
                                                <div x-show="app.purposeSelect === 'Others'" x-transition style="margin-top:6px;">
                                                    <input type="text" placeholder="Specify applicant's purpose..." class="finput app-purpose-custom" x-model="app.purposeCustom" @input="app.purpose = app.purposeCustom" :required="cType === 'authorized' && app.purposeSelect === 'Others'">
                                                </div>
                                                <input type="hidden" :name="'applicants['+index+'][purpose]'" :value="app.purpose">
                                                <div x-show="app.purpose && app.purpose.toLowerCase().includes('loan')" style="background:#fef9c3;border:2px solid #eab308;border-radius:9px;padding:12px 14px;margin-top:8px;font-size:13px;color:#854d0e;font-weight:700;line-height:1.5;">
                                                    <i class="fas fa-coins" style="color:#d97706;font-size:15px;"></i> <strong>Paalala sa Bayad:</strong> Ang mga kahilingan para sa Loan / Commercial ay may kaukulang processing fee (₱50.00 / ₱20.00) na babayaran sa cashier ng Barangay Hall sa araw ng pick-up.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <div x-show="applicants.length < 2" style="margin-top:15px;">
                                    <button type="button" @click="applicants.push({ first_name: '', middle_name: '', last_name: '', relation: '', blk_no: '', lot_no: '', address: 'Barangay San Miguel II, Dasmariñas City, Cavite', purpose: '', purposeSelect: '', purposeCustom: '', contact: @json($isAuth ? ($authUser?->contact_number ?? $resident?->contact_number ?? '') : ''), age: '', birthday: '' })" class="btn-plain btn-outline btn-sm" style="width:100%;justify-content:center;border-style:dashed;background:#fff;font-size:13px;padding:10px;">
                                        <i class="fas fa-plus-circle"></i> Add Another Applicant (Max 2)
                                    </button>
                                </div>

                                <p style="font-size:12.5px;color:var(--brand);font-weight:700;margin-top:14px;line-height:1.5;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;padding:10px 14px;">
                                    <i class="fas fa-info-circle" style="color:#2563eb;"></i> Only <strong>2 application requests</strong> per Authorized Representative are allowed at a time.
                                </p>
                            </div>

                            {{-- SELF THEME --}}
                            <div x-show="cType === 'self'" class="self-section-container">
                                @if(!$isAuth)
                                <div class="sblk">
                                    <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-user"></i> Your Details</div>
                                    <div class="fgrid2 fgrp">
                                        <div><label class="flbl" style="font-size:12.5px;font-weight:800;">First Name *</label><input type="text" name="guest_first_name" :required="cType==='self' && !{{ $isAuth ? 'true':'false' }}" class="finput" placeholder="Juan"></div>
                                        <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Last Name *</label><input type="text" name="guest_last_name" :required="cType==='self' && !{{ $isAuth ? 'true':'false' }}" class="finput" placeholder="Dela Cruz"></div>
                                    </div>
                                    <div class="fgrp" style="margin-top:8px;">
                                        <label class="flbl" style="font-size:12.5px;font-weight:800;">Email Address * (For pick-up updates & confirmation)</label>
                                        <input type="email" name="guest_email" :required="cType==='self' && !{{ $isAuth ? 'true':'false' }}" class="finput" placeholder="juan@example.com">
                                    </div>
                                </div>
                                @endif
                                <div class="sblk">
                                    <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-info"></i> Request Details</div>
                                    <div class="fgrid2 fgrp" style="margin-bottom: 15px;">
                                        {{-- Clean Single-Field Self Address from Masterlist (NO BADGES) --}}
                                        <div class="fspan2">
                                            <label class="flbl" style="font-size:12.5px;font-weight:800;color:var(--text);margin-bottom:6px;">
                                                Registered Residence Address in Barangay San Miguel II *
                                            </label>
                                            @if($isAuth)
                                            <input type="text" name="address" class="finput" value="{{ $rawSelfAddress }}" readonly style="background:#f8fafc;color:#1e293b;font-weight:700;">
                                            @else
                                            <input type="text" name="address" class="finput" placeholder="e.g. Block 12 Lot 34, Barangay San Miguel II, Dasmariñas City, Cavite" :required="cType === 'self'">
                                            @endif
                                        </div>

                                        <div>
                                            <label class="flbl" style="font-size:12.5px;font-weight:800;">Contact Number</label>
                                            <input type="text" name="contact" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="finput" value="{{ $isAuth ? ($authUser?->contact_number ?? $resident?->contact_number) : old('contact') }}">
                                        </div>
                                        <div>
                                            <label class="flbl" style="font-size:12.5px;font-weight:800;">Purpose *</label>
                                            <select class="finput fselect self-purpose-select" x-model="selfPurposeSelect" @change="if(selfPurposeSelect !== 'Others') selfPurpose = selfPurposeSelect; else selfPurpose = selfPurposeCustom;" :required="cType === 'self'">
                                                <option value="">— Select Purpose —</option>
                                                <template x-for="p in getPurposes(selectedDoc)" :key="p">
                                                    <option :value="p" x-text="p"></option>
                                                </template>
                                            </select>
                                            <div x-show="selfPurposeSelect === 'Others'" x-transition style="margin-top:6px;">
                                                <input type="text" placeholder="Please specify your purpose..." class="finput self-purpose-custom" x-model="selfPurposeCustom" @input="selfPurpose = selfPurposeCustom" :required="cType === 'self' && selfPurposeSelect === 'Others'">
                                            </div>
                                            <input type="hidden" name="purpose" :value="selfPurpose">
                                            <div x-show="selfPurpose && selfPurpose.toLowerCase().includes('loan')" style="background:#fef9c3;border:2px solid #eab308;border-radius:9px;padding:12px 14px;margin-top:8px;font-size:13px;color:#854d0e;font-weight:700;line-height:1.5;">
                                                <i class="fas fa-coins" style="color:#d97706;font-size:15px;"></i> <strong>Paalala sa Bayad:</strong> Ang mga kahilingan para sa Loan / Commercial ay may kaukulang processing fee (₱50.00 / ₱20.00) na babayaran sa cashier ng Barangay Hall sa araw ng pick-up.
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Conditional Birthday/Age (Only shown when document type requires it) --}}
                                    <div x-show="selectedDoc === 'jobseeker' || selectedDoc === 'latereg'" class="fgrp" style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px; margin-top: 10px;">
                                        <div>
                                            <label class="flbl" style="font-size:12.5px;font-weight:800;">Date of Birth</label>
                                            <input type="date" name="birthday" class="finput" x-model="birthday" 
                                                   @input="age = calculateAge($event.target.value)"
                                                   @change="age = calculateAge($event.target.value)"
                                                   {{ $isAuth ? 'readonly style=background:#f1f5f9;cursor:not-allowed;' : '' }}>
                                        </div>
                                        <div>
                                            <label class="flbl" style="font-size:12.5px;font-weight:800;">Age</label>
                                            <input type="number" name="age" class="finput" x-model="age" placeholder="Min. 15" min="15" readonly style="background:#f1f5f9; cursor:not-allowed;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div x-show="selectedDoc==='moveout'||selectedDoc==='movein'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-home"></i> Move Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Block No.</label><input type="text" name="blk" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Lot No.</label><input type="text" name="lot" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Move Date</label><input type="text" name="move_date" placeholder="e.g. March 1, 2026" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Landlord / Owner</label><input type="text" name="landlord" class="finput"></div>
                                <div class="fspan2"><label class="flbl" style="font-size:12.5px;font-weight:800;">Family Members (comma-separated)</label><input type="text" name="family_members" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='guardianship'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-user-shield"></i> Guardianship Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Ward's Full Name</label><input type="text" name="ward_name" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Ward's Age</label><input type="text" name="ward_age" class="finput"></div>
                                <div class="fspan2"><label class="flbl" style="font-size:12.5px;font-weight:800;">Relation to Ward</label><input type="text" name="ward_relation" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='cohabitation'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-user-friends"></i> Cohabitation Details</div>
                            <div class="fgrid2 fgrp">
                                <div class="fspan2"><label class="flbl" style="font-size:12.5px;font-weight:800;">Partner's Full Name</label><input type="text" name="partner_name" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Living Together Since</label><input type="text" name="living_since" placeholder="e.g. 2020" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='cashgift'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-gift"></i> Cash Gift Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Kaano-anuhan</label><input type="text" name="claimant_name" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Relasyon</label><input type="text" name="claimant_relation" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Birthday Month</label><input type="text" name="birth_month" placeholder="e.g. February" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Birthday Year</label><input type="text" name="birth_year" placeholder="e.g. 2025" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='latereg'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-clock"></i> Late Registration Details</div>
                            <div class="fgrid2 fgrp">
                                <div class="fspan2"><label class="flbl" style="font-size:12.5px;font-weight:800;">Child's Full Name</label><input type="text" name="child_name" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Father's Name</label><input type="text" name="father_name" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Mother's Name</label><input type="text" name="mother_name" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Birth Attendant</label><input type="text" name="birth_attendant" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Place of Birth</label><input type="text" name="born_from" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='endorsement'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-file-export"></i> Endorsement Details</div>
                            <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Residing in Brgy. SM2 Since (Year)</label><input type="text" name="residing_since" placeholder="e.g. 2018" class="finput"></div>
                        </div>
                        <div x-show="selectedDoc==='business'||selectedDoc==='closure'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-store"></i> Business Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Business / Trade Name</label><input type="text" name="company_name" class="finput"></div>
                                <div x-show="selectedDoc==='closure'"><label class="flbl" style="font-size:12.5px;font-weight:800;">Non-Operational Since</label><input type="text" name="non_op_since" placeholder="mm/dd/yy" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='yumao'" class="sblk">
                            <div class="sblk-ttl" style="font-size:13.5px;"><i class="fas fa-ribbon"></i> Yumao Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Claimant Full Name</label><input type="text" name="claimant_name" class="finput"></div>
                                <div><label class="flbl" style="font-size:12.5px;font-weight:800;">Relasyon sa Yumao</label><input type="text" name="claimant_relation" placeholder="e.g. Asawa, Anak" class="finput"></div>
                            </div>
                        </div>

                        {{-- Highly Readable Claiming Note for PWD and Seniors --}}
                        <div x-show="cType === 'authorized'" x-transition style="background:#eff6ff;border:2px solid #93c5fd;border-radius:10px;padding:14px 16px;margin-bottom:14px;font-size:13px;font-weight:700;color:#1e40af;line-height:1.55;">
                            <div style="margin-bottom:6px;display:flex;align-items:center;gap:8px;font-size:14px;color:#1e3a8a;"><i class="fas fa-id-card text-blue-600"></i> <strong style="letter-spacing:0.02em;">MAHALAGANG PAALALA SA PAG-CLAIM:</strong></div>
                            Mangyaring <strong>dalhin ang inyong Valid ID</strong> (at ang orihinal na <strong>Authorization Letter</strong>) kapag kukunin ang dokumento sa Barangay Hall.
                        </div>

                        {{-- Highly Readable Office-Driven Pickup Notification Banner --}}
                        <div style="background:#f0f9ff;border:2px solid #7dd3fc;border-radius:11px;padding:14px 16px;margin-bottom:16px;font-size:13px;font-weight:700;color:#0369a1;line-height:1.55;display:flex;align-items:flex-start;gap:10px;">
                            <i class="fas fa-info-circle" style="color:#0284c7;font-size:18px;margin-top:2px;flex-shrink:0;"></i>
                            <span x-text="t('office_pickup_notice')">Pagkatapos isumite, ipoproseso ng Barangay Office ang inyong kahilingan at ipapadala ang itinalagang petsa, oras ng pagkuha, at reference details sa inyong email.</span>
                        </div>

                        {{-- Validation Alert Notice Banner --}}
                        <div x-show="validationAlertMsg" x-transition style="background:#fef2f2;border:2px solid #f87171;border-radius:10px;padding:12px 16px;margin-bottom:14px;display:flex;align-items:center;gap:10px;color:#991b1b;font-size:13px;font-weight:800;">
                            <i class="fas fa-exclamation-triangle" style="font-size:16px;color:#dc2626;flex-shrink:0;"></i>
                            <span x-text="validationAlertMsg"></span>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:10px;">
                            <button type="button" @click="selectedDoc=''" class="btn-plain btn-ghost" style="font-size:13px;padding:10px 18px;" x-text="t('cancel')">Cancel</button>
                            <button type="button" @click="handleDocSubmit()" class="btn-grad" style="font-size:13px;padding:10px 22px;">
                                <i class="fas fa-paper-plane"></i> <span x-text="t('submit_request')">Submit Request</span>
                            </button>
                        </div>

                        {{-- ✦ Pre-Submission Review & Confirmation Modal (PWD & Senior Readable) ✦ --}}
                        <div x-show="showDocConfirmModal" x-cloak class="modal-ov" style="z-index:99999;" x-transition>
                            <div class="modal-box" style="max-width:460px;" @click.away="showDocConfirmModal=false">
                                <div class="modal-in" style="padding:22px;">
                                    <div class="modal-hd">
                                        <div class="modal-ttl">
                                            <div class="modal-ico" style="background:#eff6ff;color:var(--brand);width:40px;height:40px;font-size:18px;"><i class="fas fa-clipboard-check"></i></div>
                                            <div>
                                                <div style="font-weight:900;color:var(--text);font-size:15px;">Confirm Your Request Details</div>
                                                <div style="font-size:12.5px;color:var(--muted);font-weight:700;margin-top:2px;">Sigurado po ba kayo na tama ang lahat ng detalye?</div>
                                            </div>
                                        </div>
                                        <button type="button" @click="showDocConfirmModal=false" class="modal-close" style="font-size:18px;"><i class="fas fa-times-circle"></i></button>
                                    </div>

                                    <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;padding:14px 16px;margin-bottom:16px;">
                                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;border-bottom:1px solid #e2e8f0;padding-bottom:8px;">
                                            <span style="font-size:12px;font-weight:800;color:var(--muted);text-transform:uppercase;">Document:</span>
                                            <strong style="font-size:13.5px;color:var(--brand);" x-text="getDocName(selDocObj)"></strong>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;border-bottom:1px solid #e2e8f0;padding-bottom:8px;">
                                            <span style="font-size:12px;font-weight:800;color:var(--muted);text-transform:uppercase;">Claimant Type:</span>
                                            <span style="font-size:13px;font-weight:800;color:var(--text);" x-text="cType === 'self' ? 'Self (Personal)' : 'Authorized Representative'"></span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;border-bottom:1px solid #e2e8f0;padding-bottom:8px;">
                                            <span style="font-size:12px;font-weight:800;color:var(--muted);text-transform:uppercase;">Purpose:</span>
                                            <strong style="font-size:13px;color:var(--text);" x-text="cType === 'self' ? (selfPurpose || 'Standard') : (applicants[0]?.purpose || 'Standard')"></strong>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;align-items:center;">
                                            <span style="font-size:12px;font-weight:800;color:var(--muted);text-transform:uppercase;">Jurisdiction:</span>
                                            <span style="font-size:12.5px;font-weight:800;color:#059669;"><i class="fas fa-check-circle"></i> Brgy. San Miguel II, Dasmariñas</span>
                                        </div>
                                    </div>

                                    <div style="background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;padding:12px 14px;margin-bottom:18px;">
                                        <div style="font-size:13px;font-weight:900;color:#1e40af;margin-bottom:4px;display:flex;align-items:center;gap:6px;">
                                            <i class="fas fa-clock"></i> <strong>SLA & Processing Notice:</strong>
                                        </div>
                                        <p style="font-size:12.5px;color:#1e3a8a;line-height:1.55;margin:0;">
                                            Standard processing time is <strong>1 to 2 business days</strong> (Monday to Friday, 8:00 AM – 5:00 PM). If not released within 2 days, you will receive an update notification or you may proceed directly to the Barangay Hall.
                                        </p>
                                    </div>

                                    <div style="display:flex;gap:12px;justify-content:flex-end;">
                                        <button type="button" @click="showDocConfirmModal=false" class="btn-plain btn-ghost" style="font-size:13px;padding:10px 16px;">
                                            <i class="fas fa-edit"></i> Review Details
                                        </button>
                                        <button type="button" @click="$refs.docReqForm.submit(); isSubmitting=true;" class="btn-grad" style="font-size:13px;padding:10px 20px;font-weight:800;" :disabled="isSubmitting">
                                            <span x-show="!isSubmitting"><i class="fas fa-check-circle"></i> Yes, Submit Request</span>
                                            <span x-show="isSubmitting"><i class="fas fa-spinner fa-spin"></i> Submitting...</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ✦ Jobseeker Locked Modal (Statutory Once-in-a-Lifetime Limit) ✦ --}}
    <div x-show="jobseekerLockedModal" x-cloak class="modal-ov" style="z-index:99999;" x-transition>
        <div class="modal-box" style="max-width:440px;" @click.away="jobseekerLockedModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-ban"></i></div>
                        <div>
                            <div style="font-weight:900;color:var(--text);font-size:14px;">Statutory Limit Reached</div>
                            <div style="font-size:9.5px;color:var(--muted);font-weight:600;">RA 11261 (First-Time Jobseekers Assistance Act)</div>
                        </div>
                    </div>
                    <button type="button" @click="jobseekerLockedModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <div style="background:#fff1f2;border:1px solid #fecdd3;border-radius:10px;padding:12px 14px;margin-bottom:14px;">
                    <p style="font-size:11px;color:#9f1239;line-height:1.5;margin:0;font-weight:700;">
                        <i class="fas fa-exclamation-triangle" style="margin-right:4px;"></i>
                        Paalala: Na-avail niyo na po dati ang inyong First-Time Jobseeker Certificate. Alinsunod sa probisyon ng Batas Republika Blg. 11261, ang pribilehiyong ito ay maaaring gamitin nang <strong>ISANG (1) BESES LAMANG</strong> sa buong buhay.
                    </p>
                    <p style="font-size:10px;color:#881337;line-height:1.45;margin-top:8px;margin-bottom:0;">
                        Kung kailangan niyo po ng legal na dokumento para sa bagong trabaho o school requirement, mangyaring piliin ang <strong>Barangay Clearance</strong> o <strong>Certificate of Residency</strong>.
                    </p>
                </div>
                <div style="display:flex;justify-content:flex-end;">
                    <button type="button" @click="jobseekerLockedModal=false" class="btn-grad" style="padding:8px 16px;font-size:11px;">Naiintindihan Ko</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ✦ Live Request Tracker Modal ✦ --}}
    <div x-show="trackerModal" x-cloak class="modal-ov" style="z-index:99999;" x-transition>
        <div class="modal-box" style="max-width:540px; max-height:92vh; overflow-y:auto;" @click.away="trackerModal=false">
            <div class="modal-in" x-show="selectedTrackerReq" style="padding:20px;">
                <div class="modal-hd" style="margin-bottom:12px;">
                    <div class="modal-ttl">
                        <div class="modal-ico" style="background:#eff6ff;color:var(--brand);"><i class="fas fa-search-location"></i></div>
                        <div>
                            <div style="font-weight:900;color:var(--text);font-size:14px;">Live Request Tracker</div>
                            <div style="font-size:9.5px;color:var(--muted);font-weight:600;" x-text="'Tracking Code: REQ-' + (selectedTrackerReq?.created_at ? new Date(selectedTrackerReq.created_at).getFullYear() : '2026') + '-' + (selectedTrackerReq?.id ? String(selectedTrackerReq.id).padStart(5,'0') : '')"></div>
                        </div>
                    </div>
                    <button type="button" @click="trackerModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                {{-- Document Summary Header --}}
                <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:12px 14px;margin-bottom:14px;">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:8px;">
                        <div>
                            <div style="font-size:13.5px;font-weight:900;color:var(--text);" x-text="(selectedTrackerReq?.document_type || '').toUpperCase().replace(/_/g,' ')"></div>
                            <div style="font-size:11px;color:var(--muted);font-weight:600;margin-top:2px;">
                                Layunin / Purpose: <strong style="color:var(--text);" x-text="selectedTrackerReq?.purpose || 'N/A'"></strong>
                            </div>
                        </div>
                        <span style="font-size:9.5px;font-weight:900;padding:4px 11px;border-radius:99px;text-transform:uppercase;letter-spacing:.04em;"
                              :class="'s-' + selectedTrackerReq?.status"
                              x-text="selectedTrackerReq?.status"></span>
                    </div>
                </div>

                {{-- 4-Step Progress Indicator --}}
                <div style="padding:10px 6px;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;position:relative;">
                        <div style="position:absolute;top:14px;left:20px;right:20px;height:3px;background:#e2e8f0;z-index:1;"></div>
                        
                        {{-- Step 1: Submitted --}}
                        <div style="position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;width:25%;">
                            <div style="width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;background:#059669;color:#fff;">
                                <i class="fas fa-check"></i>
                            </div>
                            <span style="font-size:9.5px;font-weight:800;color:var(--text);margin-top:5px;text-align:center;">Submitted</span>
                        </div>

                        {{-- Step 2: Processing --}}
                        <div style="position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;width:25%;">
                            <div style="width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;"
                                 :style="['processing','ready','released'].includes(selectedTrackerReq?.status) ? 'background:#059669;color:#fff;' : 'background:#e2e8f0;color:#94a3b8;'">
                                <i class="fas" :class="['processing','ready','released'].includes(selectedTrackerReq?.status) ? 'fa-check' : 'fa-hourglass-half'"></i>
                            </div>
                            <span style="font-size:9.5px;font-weight:800;margin-top:5px;text-align:center;"
                                  :style="['processing','ready','released'].includes(selectedTrackerReq?.status) ? 'color:var(--text);' : 'color:#94a3b8;'">Processing</span>
                        </div>

                        {{-- Step 3: Ready for Pickup --}}
                        <div style="position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;width:25%;">
                            <div style="width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;"
                                 :style="['ready','released'].includes(selectedTrackerReq?.status) ? 'background:#059669;color:#fff;' : 'background:#e2e8f0;color:#94a3b8;'">
                                <i class="fas" :class="['ready','released'].includes(selectedTrackerReq?.status) ? 'fa-check' : 'fa-calendar-check'"></i>
                            </div>
                            <span style="font-size:9.5px;font-weight:800;margin-top:5px;text-align:center;"
                                  :style="['ready','released'].includes(selectedTrackerReq?.status) ? 'color:var(--text);' : 'color:#94a3b8;'">Ready</span>
                        </div>

                        {{-- Step 4: Released --}}
                        <div style="position:relative;z-index:2;display:flex;flex-direction:column;align-items:center;width:25%;">
                            <div style="width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:900;"
                                 :style="selectedTrackerReq?.status === 'released' ? 'background:#059669;color:#fff;' : 'background:#e2e8f0;color:#94a3b8;'">
                                <i class="fas" :class="selectedTrackerReq?.status === 'released' ? 'fa-check' : 'fa-box-open'"></i>
                            </div>
                            <span style="font-size:9.5px;font-weight:800;margin-top:5px;text-align:center;"
                                  :style="selectedTrackerReq?.status === 'released' ? 'color:var(--text);' : 'color:#94a3b8;'">Released</span>
                        </div>
                    </div>
                </div>

                {{-- ✦ PROMINENT READY FOR PICK-UP ALERT (Visible when status is 'ready') ✦ --}}
                <template x-if="selectedTrackerReq?.status === 'ready'">
                    <div style="background:#ecfdf5;border:2px solid #10b981;border-radius:12px;padding:13px 15px;margin-bottom:14px;box-shadow:0 3px 10px rgba(16,185,129,0.12);">
                        <div style="font-size:12px;font-weight:900;color:#065f46;margin-bottom:6px;display:flex;align-items:center;gap:6px;text-transform:uppercase;letter-spacing:.04em;">
                            <i class="fas fa-check-circle" style="color:#059669;font-size:15px;"></i> HANDA NA PARA SA PAGKUHA (READY FOR PICK-UP)
                        </div>
                        <div style="font-size:11.5px;color:#064e3b;line-height:1.6;">
                            <div>
                                📅 <strong>Petsa ng Pagkuha:</strong> 
                                <span style="color:#059669;font-weight:900;" x-text="selectedTrackerReq?.pickup_date || selectedTrackerReq?.appointment_date || 'Nakatakda ngayong araw'"></span>
                            </div>
                            <div>
                                ⏰ <strong>Oras ng Pagkuha:</strong> 8:00 AM – 5:00 PM (Lunes hanggang Biyernes)
                            </div>
                            <div>
                                👤 <strong>Sino ang Pagkukunan (Duty Personnel):</strong> 
                                <strong style="color:#047857;" x-text="selectedTrackerReq?.personnel_in_charge || 'MARVIN M. BENIS (Barangay Secretary)'"></strong>
                                <template x-if="selectedTrackerReq?.alternate_personnel">
                                    <span style="font-size:10px;color:#065f46;" x-text="' (Alternate: ' + selectedTrackerReq.alternate_personnel + ')'"></span>
                                </template>
                            </div>
                            <div>
                                🏢 <strong>Desk / Lugar:</strong> Barangay San Miguel II Hall — Frontline Releasing Window
                            </div>
                        </div>
                    </div>
                </template>

                {{-- ✦ MISMONG MGA DETALYE NA SINUBMIT (SUBMITTED DETAILS) ✦ --}}
                <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;padding:13px 15px;margin-bottom:14px;">
                    <div style="font-size:11px;font-weight:900;color:var(--brand);text-transform:uppercase;letter-spacing:.05em;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-file-lines"></i> Mga Detalye ng Sinumite (Submitted Request Details)
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:9px;font-size:11px;line-height:1.45;">
                        <div>
                            <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Pangalan (Applicant):</span>
                            <strong style="color:var(--text);" x-text="selectedTrackerReq?.claimant_name || (selectedTrackerReq?.guest_first_name ? (selectedTrackerReq.guest_first_name + ' ' + selectedTrackerReq.guest_last_name) : 'Resident')"></strong>
                        </div>
                        <div>
                            <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Claimant Type:</span>
                            <span style="font-weight:800;color:var(--brand);" x-text="selectedTrackerReq?.claimant_type === 'authorized' ? 'Authorized Representative' : 'Self (Personal)'"></span>
                        </div>
                        <template x-if="selectedTrackerReq?.claimant_type === 'authorized'">
                            <div style="grid-column: span 2; background:#eff6ff; padding:8px 10px; border-radius:8px; border:1px solid #bfdbfe;">
                                <div style="font-size:9.5px;font-weight:800;color:#1e40af;text-transform:uppercase;">Authorized Representative:</div>
                                <div style="font-weight:800;color:#1e3a8a;" x-text="(selectedTrackerReq?.claimant_first_name ? (selectedTrackerReq.claimant_first_name + ' ' + (selectedTrackerReq.claimant_middle_name ? selectedTrackerReq.claimant_middle_name + ' ' : '') + selectedTrackerReq.claimant_last_name) : selectedTrackerReq?.claimant_name) + ' (' + (selectedTrackerReq?.claimant_relation || 'Representative') + ')'"></div>
                            </div>
                        </template>
                        <div style="grid-column: span 2;">
                            <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Tirahan (Address):</span>
                            <strong style="color:var(--text);" x-text="selectedTrackerReq?.address || ((selectedTrackerReq?.blk ? 'Blk ' + selectedTrackerReq.blk + ' ' : '') + (selectedTrackerReq?.lot ? 'Lot ' + selectedTrackerReq.lot + ', ' : '') + 'Brgy. San Miguel II, Dasmariñas, Cavite')"></strong>
                        </div>
                        <div>
                            <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Contact Number:</span>
                            <span style="color:var(--text);font-weight:700;" x-text="selectedTrackerReq?.contact || 'N/A'"></span>
                        </div>
                        <div>
                            <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Layunin (Purpose):</span>
                            <strong style="color:var(--text);" x-text="selectedTrackerReq?.purpose || 'Standard'"></strong>
                        </div>
                        <template x-if="selectedTrackerReq?.birthday || selectedTrackerReq?.age">
                            <div>
                                <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Kaarawan / Edad:</span>
                                <span style="color:var(--text);font-weight:700;" x-text="(selectedTrackerReq?.birthday ? selectedTrackerReq.birthday + ' ' : '') + (selectedTrackerReq?.age ? '(' + selectedTrackerReq.age + ' taong gulang)' : '')"></span>
                            </div>
                        </template>
                        <template x-if="selectedTrackerReq?.move_date">
                            <div>
                                <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Petsa ng Paglipat:</span>
                                <span style="color:var(--text);font-weight:700;" x-text="selectedTrackerReq?.move_date"></span>
                            </div>
                        </template>
                        <template x-if="selectedTrackerReq?.child_name">
                            <div style="grid-column: span 2;">
                                <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Pangalan ng Anak (Late Reg):</span>
                                <span style="color:var(--text);font-weight:700;" x-text="selectedTrackerReq?.child_name"></span>
                            </div>
                        </template>
                        <template x-if="selectedTrackerReq?.landlord">
                            <div>
                                <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Landlord / May-ari:</span>
                                <span style="color:var(--text);font-weight:700;" x-text="selectedTrackerReq?.landlord"></span>
                            </div>
                        </template>
                        <template x-if="selectedTrackerReq?.residing_since || selectedTrackerReq?.living_since">
                            <div>
                                <span style="color:var(--muted);font-weight:700;display:block;font-size:9.5px;text-transform:uppercase;">Nakatira Mula Noong:</span>
                                <span style="color:var(--text);font-weight:700;" x-text="selectedTrackerReq?.residing_since || selectedTrackerReq?.living_since"></span>
                            </div>
                        </template>
                    </div>

                    {{-- Attached Proofs / Documents --}}
                    <div style="display:flex;gap:7px;margin-top:10px;flex-wrap:wrap;padding-top:8px;border-top:1px solid #e2e8f0;">
                        <template x-if="selectedTrackerReq?.id_proof">
                            <button type="button" @click="openPhotoModal('/storage/' + selectedTrackerReq.id_proof, 'Uploaded ID Proof')" style="padding:4px 9px;border-radius:6px;background:#fff;border:1px solid #cbd5e1;font-size:10px;font-weight:800;color:var(--brand);cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                                <i class="fas fa-image"></i> Tingnan ang ID Proof
                            </button>
                        </template>
                        <template x-if="selectedTrackerReq?.authorization_letter_path">
                            <button type="button" @click="openPhotoModal('/storage/' + selectedTrackerReq.authorization_letter_path, 'Authorization Letter')" style="padding:4px 9px;border-radius:6px;background:#fff;border:1px solid #cbd5e1;font-size:10px;font-weight:800;color:var(--brand);cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                                <i class="fas fa-file-contract"></i> Tingnan ang Authorization Letter
                            </button>
                        </template>
                        <template x-if="selectedTrackerReq?.authorized_id_path">
                            <button type="button" @click="openPhotoModal('/storage/' + selectedTrackerReq.authorized_id_path, 'Representative ID')" style="padding:4px 9px;border-radius:6px;background:#fff;border:1px solid #cbd5e1;font-size:10px;font-weight:800;color:var(--brand);cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                                <i class="fas fa-id-card"></i> Tingnan ang ID ng Kinatawan
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Standard Pickup Office Reference Card --}}
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px;padding:11px 14px;margin-bottom:14px;">
                    <div style="font-size:10.5px;font-weight:800;color:#1e40af;margin-bottom:4px;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-building"></i> Barangay Office General Schedule:
                    </div>
                    <div style="font-size:11px;color:#1e3a8a;line-height:1.5;">
                        <div><strong>Hours:</strong> 8:00 AM – 5:00 PM (Monday to Friday, Fixed Office Hours)</div>
                    </div>
                </div>

                <template x-if="selectedTrackerReq?.status === 'disapproved' && selectedTrackerReq?.disapproval_reason">
                    <div style="background:#fee2e2;border:1px solid #fecaca;border-radius:10px;padding:10px 12px;margin-bottom:14px;font-size:11px;color:#dc2626;font-weight:700;">
                        <i class="fas fa-exclamation-circle"></i> Reason for Disapproval: <span x-text="selectedTrackerReq?.disapproval_reason"></span>
                    </div>
                </template>

                <div style="display:flex;justify-content:flex-end;">
                    <button type="button" @click="trackerModal=false" class="btn-plain btn-ghost" style="font-size:11px;padding:6px 16px;">Close</button>
                </div>
            </div>
        </div>
    </div>

{{-- ══ FAQs MODAL ══ --}}
    <div x-show="faqModal" x-cloak class="modal-ov" x-transition x-data="{ faqSearch: '' }">
        <div class="modal-box" style="max-width:640px; max-height:90vh; overflow-y:auto; border-radius:20px;" @click.away="faqModal=false">
            <div class="modal-in" style="padding:22px 24px;">
                <div class="modal-hd" style="margin-bottom:14px; padding-bottom:12px;">
                    <div class="modal-ttl">
                        <div class="modal-ico" style="background:#eff6ff; color:#0E5393; width:36px; height:36px;"><i class="fas fa-circle-question" style="font-size:16px;"></i></div>
                        <div>
                            <div style="font-size:15px; font-weight:900; color:#0f172a; letter-spacing:-0.2px;" x-text="t('faq_title')">Frequently Asked Questions & Resident Guide</div>
                            <div style="font-size:11.5px; font-weight:600; color:#475569; text-transform:none; margin-top:2px;" x-text="t('faq_subtitle')">Important reminders, priority procedures, and official service guidelines</div>
                        </div>
                    </div>
                    <button type="button" @click="faqModal=false" class="modal-close" style="font-size:22px;"><i class="fas fa-times-circle"></i></button>
                </div>

                {{-- Real-time Search Filter --}}
                <div style="margin-bottom:16px; position:relative;">
                    <i class="fas fa-search" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#64748b; font-size:13px;"></i>
                    <input type="text" x-model="faqSearch" :placeholder="t('faq_search_ph')" class="finput" style="padding:10px 14px 10px 38px; font-size:13px; border-radius:10px; background:#f8fafc; border:1.5px solid #cbd5e1;">
                    <button type="button" x-show="faqSearch" @click="faqSearch=''" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; color:#64748b; cursor:pointer; font-size:12px;"><i class="fas fa-times"></i></button>
                </div>

                <div style="display:flex; flex-direction:column; gap:12px; padding-bottom:10px;">
                    {{-- 1. Offline Hotlines & Direct Call (When No Internet) --}}
                    <div x-show="!faqSearch || (t('faq_hotline_title') + ' ' + t('faq_hotline_desc')).toLowerCase().includes(faqSearch.toLowerCase())"
                         style="padding:14px 16px; background:#eff6ff; border:1.5px solid #93c5fd; border-radius:12px;">
                        <div style="font-size:14px; font-weight:900; color:#1e3a8a; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-phone-volume" style="color:#2563eb; font-size:16px;"></i>
                            <span x-text="t('faq_hotline_title')">Slow or No Internet Connection (Direct Hotlines):</span>
                        </div>
                        <div style="font-size:13px; color:#1e293b; line-height:1.6; font-weight:600;" x-text="t('faq_hotline_desc')"></div>
                    </div>

                    {{-- 2. Document Fees (Free vs Loan) --}}
                    <div x-show="!faqSearch || (t('faq_fees_title') + ' ' + t('faq_fees_desc')).toLowerCase().includes(faqSearch.toLowerCase())"
                         style="padding:14px 16px; background:#f0fdf4; border:1.5px solid #86efac; border-radius:12px;">
                        <div style="font-size:14px; font-weight:900; color:#14532d; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-receipt" style="color:#16a34a; font-size:16px;"></i>
                            <span x-text="t('faq_fees_title')">Document Fees (Free vs. Loan Applications):</span>
                        </div>
                        <div style="font-size:13px; color:#1e293b; line-height:1.6; font-weight:600;" x-text="t('faq_fees_desc')"></div>
                    </div>

                    {{-- 3. Incident Blotter & ₱100 Filing Fee --}}
                    <div x-show="!faqSearch || (t('faq_reports_title') + ' ' + t('faq_reports_desc')).toLowerCase().includes(faqSearch.toLowerCase())"
                         style="padding:14px 16px; background:#fef2f2; border:1.5px solid #fca5a5; border-radius:12px;">
                        <div style="font-size:14px; font-weight:900; color:#991b1b; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-flag" style="color:#dc2626; font-size:16px;"></i>
                            <span x-text="t('faq_reports_title')">Incident Reports (₱100 Fee & Multiple Reports):</span>
                        </div>
                        <div style="font-size:13px; color:#1e293b; line-height:1.6; font-weight:600;" x-text="t('faq_reports_desc')"></div>
                    </div>

                    {{-- 4. Authorized Representative Rules --}}
                    <div x-show="!faqSearch || (t('faq_rep_title') + ' ' + t('faq_rep_desc')).toLowerCase().includes(faqSearch.toLowerCase())"
                         style="padding:14px 16px; background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:12px;">
                        <div style="font-size:14px; font-weight:900; color:#0f172a; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-user-shield" style="color:#0E5393; font-size:16px;"></i>
                            <span x-text="t('faq_rep_title')">Authorized Representative Rules:</span>
                        </div>
                        <div style="font-size:13px; color:#1e293b; line-height:1.6; font-weight:600;" x-text="t('faq_rep_desc')"></div>
                    </div>

                    {{-- 5. Office Hours & Tanod Desk --}}
                    <div x-show="!faqSearch || (t('faq_hours_title') + ' ' + t('faq_hours_desc')).toLowerCase().includes(faqSearch.toLowerCase())"
                         style="padding:14px 16px; background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:12px;">
                        <div style="font-size:14px; font-weight:900; color:#0f172a; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                            <i class="fas fa-clock" style="color:#0E5393; font-size:16px;"></i>
                            <span x-text="t('faq_hours_title')">Barangay Office Hours & 24/7 Tanod Desk:</span>
                        </div>
                        <div style="font-size:13px; color:#1e293b; line-height:1.6; font-weight:600;" x-text="t('faq_hours_desc')"></div>
                    </div>
                </div>

                {{-- Assisted Counter Note for Seniors/PWDs --}}
                <div style="background:#f1f5f9; border:1.5px solid #cbd5e1; border-radius:12px; padding:12px 16px; margin-top:10px; display:flex; align-items:center; gap:12px;">
                    <i class="fas fa-headset" style="color:#0E5393; font-size:22px; flex-shrink:0;"></i>
                    <div style="font-size:12.5px; color:#0f172a; line-height:1.45; font-weight:700;">
                        <strong>Kailangan ng tulong o impormasyon?</strong> Tawagan ang Barangay Tanod / Office Desk sa <strong>(046) 416-0283</strong> o pumunta sa Barangay Hall (Lunes – Biyernes, 8:00 AM – 5:00 PM).
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; margin-top:16px;">
                    <button type="button" @click="faqModal=false" class="btn-plain btn-ghost" style="font-size:13px; font-weight:800; padding:8px 20px;" x-text="t('faq_close')">Close Guide</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END FAQs MODAL --}}

    {{-- UPDATE EMAIL MODAL --}}
    @if($isAuth)
    <div x-show="emailEditModal" x-cloak class="modal-ov" x-transition style="z-index:99999;">
        <div class="modal-box" style="max-width:420px;" @click.away="emailEditModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico"><i class="fas fa-envelope"></i></div>
                        <div>Update Registered Email</div>
                    </div>
                    <button @click="emailEditModal=false; profileModal=true;" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <form action="{{ route('resident.email.update') }}" method="POST">
                    @csrf
                    <p style="font-size:11px;color:var(--muted);line-height:1.5;margin-bottom:14px;">
                        Enter your active personal email address where you want to receive document pickup notices and emergency SOS dispatch receipts.
                    </p>
                    <div class="fgrp">
                        <label class="flbl">New Email Address *</label>
                        <input type="email" name="email" required class="finput" value="{{ $authUser?->email }}" placeholder="your-email@gmail.com">
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:16px;">
                        <button type="button" @click="emailEditModal=false; profileModal=true;" class="btn-plain btn-ghost btn-sm">Cancel</button>
                        <button type="submit" class="btn-grad btn-sm"><i class="fas fa-save"></i> Save Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- ADD PET MODAL --}}

    {{-- REPORT ISSUE MODAL (2-STEP WIZARD WITH SEGMENTED TABS & PROMINENT ₱100 FILING FEE) --}}
    <div x-show="issueModal" x-cloak class="modal-ov" x-transition style="z-index:9999;" @keydown.window.escape="issueModal=false">
        <div class="modal-box modal-box-red" id="issueReportModalBox" style="max-width:580px; width:100%; max-height:86vh; display:flex; flex-direction:column; overflow:hidden; border-radius:20px; box-shadow:0 25px 60px rgba(0,0,52,0.35); padding:0;" @click.away="issueModal=false">
            
            <form id="issueReportForm" action="{{ route('resident.issue.report') }}" method="POST" enctype="multipart/form-data" novalidate @submit.prevent="submitIssueReport($event)" style="display:flex; flex-direction:column; height:100%; min-height:0; overflow:hidden; margin:0;">
                @csrf

                {{-- 1. FIXED MODAL HEADER --}}
                <div class="issue-modal-header">
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:38px; height:38px; border-radius:10px; background:#fee2e2; color:#dc2626; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0;">
                                <i class="fas fa-flag"></i>
                            </div>
                            <div>
                                <div style="font-size:clamp(12px, 3.8vw, 14px); font-weight:900; color:#0f172a; text-transform:uppercase; letter-spacing:0.02em;">Report an Issue / Concern</div>
                                <div style="font-size:11px; font-weight:600; color:#64748b; display:flex; align-items:center; gap:6px; margin-top:2px;">
                                    <span style="background:#fee2e2; color:#dc2626; padding:1px 7px; border-radius:6px; font-weight:800; font-size:10px;" x-text="issueStep === 1 ? (lang==='fil'?'Hakbang 1 ng 2':'Step 1 of 2') : (lang==='fil'?'Hakbang 2 ng 2':'Step 2 of 2')">Step 1 of 2</span>
                                    <span x-text="issueStep === 1 ? (lang==='fil'?'Parties & Reklamo':'Parties & Offense') : (lang==='fil'?'Detalye ng Insidente & Paunawa':'Incident Details & Legal Notice')">Parties & Offense</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" @click="issueModal=false" class="modal-close" style="margin:0; width:30px; height:30px; font-size:15px;"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                {{-- 2. SCROLLABLE FORM BODY --}}
                <div id="issueReportFormBody" class="issue-modal-body">
                    
                    {{-- Dynamic Error Alert Banner --}}
                    <div x-show="issueErrorMsg" x-transition style="background:#fef2f2; border:1.5px solid #f87171; border-radius:10px; padding:10px 14px; margin-bottom:12px; display:flex; align-items:center; gap:8px; color:#991b1b; font-size:11px; font-weight:700; word-break:break-word;">
                        <i class="fas fa-exclamation-circle" style="font-size:14px; flex-shrink:0;"></i>
                        <span x-text="issueErrorMsg"></span>
                    </div>

                    {{-- ==================== STEP 1: PARTIES & OFFENSE ==================== --}}
                    <div x-show="issueStep === 1" x-transition:enter.opacity.duration.200ms>
                        
                        {{-- Type of Offense --}}
                        <div class="fgrp" style="margin-bottom:12px;">
                            <label class="flbl" style="font-weight:800; font-size:11px; color:#1e293b; height:18px; display:flex; align-items:center; margin-bottom:4px;">Type of Offense / Complaint <span style="color:#dc2626; margin-left:2px;">*</span></label>
                            <select name="issue_type" x-model="selectedOffense" @change="showOtherOffense = selectedOffense === 'Others'" required style="width:100%; height:40px; padding:6px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; cursor:pointer; font-family:inherit; box-sizing:border-box;">
                                <option value="">— Select Offense Type —</option>
                                <template x-for="o in offenses" :key="o"><option :value="o" x-text="o"></option></template>
                            </select>
                        </div>
                        <div x-show="showOtherOffense" x-transition class="fgrp" style="margin-bottom:12px;">
                            <label class="flbl" style="font-weight:800; font-size:11px; color:#1e293b; height:18px; display:flex; align-items:center; margin-bottom:4px;">Specify Offense Type <span style="color:#dc2626; margin-left:2px;">*</span></label>
                            <input type="text" name="issue_type_other" placeholder="Describe the type of offense..." style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;">
                        </div>

                        {{-- Complainant Information Card --}}
                        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:12px 14px; margin-bottom:12px; box-shadow:0 1px 3px rgba(0,0,0,0.03);" x-data="{ isOnBehalf: false }">
                            <div style="font-size:11px; font-weight:800; color:#1e293b; margin-bottom:10px; display:flex; align-items:center; justify-content:space-between;">
                                <span><i class="fas fa-user" style="color:var(--brand); margin-right:5px;"></i> Complainant Information</span>
                                @if(!$isAuth)
                                <span style="font-size:9px; background:#e0f2fe; color:#0369a1; padding:2px 7px; border-radius:6px; font-weight:700;">Open to All</span>
                                @endif
                            </div>
                            <div class="issue-grid-2">
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Full Name <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                    <input type="text" name="complainant_name" required style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Juan Dela Cruz" value="{{ $isAuth ? (($authUser?->first_name??'').' '.($authUser?->last_name??'')) : old('complainant_name') }}">
                                </div>
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Contact Number (11 digits) <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                    <input type="text" name="contact" id="issueContactInput" required style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="{{ $isAuth ? $authUser?->contact_number : old('contact') }}">
                                </div>
                                <div class="issue-grid-span2">
                                    <div class="issue-grid-split2">
                                        <div>
                                            <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Age <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                            <input type="number" name="complainant_age" required style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Min. 18" min="18" value="{{ $isAuth ? ($authUserAge ?? '') : old('complainant_age') }}">
                                        </div>
                                        <div>
                                            <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Gender</label>
                                            <select name="complainant_gender" style="width:100%; height:40px; padding:6px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; cursor:pointer; font-family:inherit; box-sizing:border-box;">
                                                <option value="">Select Gender</option>
                                                <option value="Male" @if($isAuth && ($authUser?->gender??'') === 'Male') selected @endif>Male</option>
                                                <option value="Female" @if($isAuth && ($authUser?->gender??'') === 'Female') selected @endif>Female</option>
                                                <option value="Other" @if($isAuth && ($authUser?->gender??'') === 'Other') selected @endif>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if(!$isAuth)
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Email Address <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                    <input type="email" name="guest_email" required style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="example@gmail.com">
                                </div>
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Address / Location</label>
                                    <input type="text" name="complainant_address" style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="House/Blk/Lot, Street, Barangay, City..." value="{{ old('complainant_address') }}">
                                </div>
                                @else
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Address / Location</label>
                                    <input type="text" name="complainant_address" style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Blk/Lot, Street, Brgy..." value="{{ $authUser?->address }}">
                                </div>
                                @endif
                            </div>

                            {{-- Filing on Behalf Checkbox --}}
                            <div style="margin-top:10px; padding:8px 10px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px;">
                                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:10.5px; font-weight:800; color:#1e293b; margin:0;">
                                    <input type="checkbox" name="is_on_behalf" value="1" x-model="isOnBehalf" style="width:15px; height:15px; accent-color:var(--brand); cursor:pointer;">
                                    <span><i class="fas fa-hands-helping" style="color:var(--brand); margin-right:3px;"></i> Filing on behalf of a victim / dependent</span>
                                </label>
                            </div>

                            {{-- Dedicated Victim Section --}}
                            <div x-show="isOnBehalf" x-transition style="margin-top:10px; padding:10px 12px; background:#fdf4ff; border:1.5px solid #f0abfc; border-radius:10px;">
                                <div style="font-size:9.5px; font-weight:900; text-transform:uppercase; color:#a21caf; margin-bottom:8px; display:flex; align-items:center; gap:5px;">
                                    <i class="fas fa-shield-alt"></i> Dedicated Victim Information
                                </div>
                                <div class="issue-grid-2">
                                    <div class="issue-grid-span2">
                                        <label class="flbl" style="color:#86198f; font-size:10px; font-weight:700; height:16px; display:flex; align-items:center; margin-bottom:3px;">Victim Full Name <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                        <input type="text" name="victim_name" :required="isOnBehalf" placeholder="Full name of victim/dependent" style="width:100%; height:38px; padding:6px 12px; font-size:12.5px; font-weight:600; color:#1e293b; border:1.5px solid #f0abfc; background:#fff; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;">
                                    </div>
                                    <div class="issue-grid-span2">
                                        <div class="issue-grid-split2">
                                            <div>
                                                <label class="flbl" style="color:#86198f; font-size:10px; font-weight:700; height:16px; display:flex; align-items:center; margin-bottom:3px;">Victim Age <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                                <input type="number" name="victim_age" :required="isOnBehalf" min="0" max="120" placeholder="e.g. 14" style="width:100%; height:38px; padding:6px 12px; font-size:12.5px; font-weight:600; color:#1e293b; border:1.5px solid #f0abfc; background:#fff; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;">
                                            </div>
                                            <div>
                                                <label class="flbl" style="color:#86198f; font-size:10px; font-weight:700; height:16px; display:flex; align-items:center; margin-bottom:3px;">Victim Gender <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                                <select name="victim_gender" :required="isOnBehalf" style="width:100%; height:38px; padding:6px 12px; font-size:12.5px; font-weight:600; color:#1e293b; border:1.5px solid #f0abfc; background:#fff; border-radius:8px; outline:none; cursor:pointer; font-family:inherit; box-sizing:border-box;">
                                                    <option value="">Select Gender</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="issue-grid-span2">
                                        <label class="flbl" style="color:#86198f; font-size:10px; font-weight:700; height:16px; display:flex; align-items:center; margin-bottom:3px;">Relationship to Complainant <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                        <input type="text" name="victim_relationship" :required="isOnBehalf" placeholder="e.g. Daughter, Son, Spouse, Sister, Neighbor, etc." style="width:100%; height:38px; padding:6px 12px; font-size:12.5px; font-weight:600; color:#1e293b; border:1.5px solid #f0abfc; background:#fff; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Respondent Information Card --}}
                        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:12px 14px; box-shadow:0 1px 3px rgba(0,0,0,0.03);">
                            <div style="font-size:11px; font-weight:800; color:#1e293b; margin-bottom:10px;">
                                <i class="fas fa-user-slash" style="color:#dc2626; margin-right:5px;"></i> Respondent (Person being reported)
                            </div>
                            <div class="issue-grid-2">
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Respondent Full Name <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                    <input type="text" name="respondent_name" required style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Name of person being reported">
                                </div>
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Respondent Address (Optional)</label>
                                    <input type="text" name="respondent_address" style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Address or known location">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ==================== STEP 2: INCIDENT DETAILS & LEGAL NOTICE ==================== --}}
                    <div x-show="issueStep === 2" x-transition:enter.opacity.duration.200ms>
                        {{-- Incident Details Card --}}
                        <div style="background:#fff; border:1px solid #e2e8f0; border-radius:12px; padding:12px 14px; box-shadow:0 1px 3px rgba(0,0,0,0.03);">
                            <div style="font-size:11px; font-weight:800; color:#1e293b; margin-bottom:10px;">
                                <i class="fas fa-map-marker-alt" style="color:#dc2626; margin-right:5px;"></i> Incident Details
                            </div>
                            <div class="issue-grid-2">
                                <div class="issue-grid-span2">
                                    <div class="issue-grid-split2">
                                        <div>
                                            <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Date of Incident <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                            <input type="date" name="incident_date_only" x-model="incidentDatePart" required style="width:100%; height:40px; padding:6px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box; cursor:pointer;" max="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-6 months')) }}">
                                        </div>
                                        <div>
                                            <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Time of Incident (Optional)</label>
                                            <input type="time" name="incident_time_only" x-model="incidentTimePart" style="width:100%; height:40px; padding:6px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box; cursor:pointer;">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="incident_date" :value="incidentDatePart ? (incidentDatePart + ' ' + (incidentTimePart || '12:00')) : ''">
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Location of Incident <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                    <input type="text" name="incident_location" required style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Purok, Street, Landmark...">
                                </div>
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Description / Narration <span style="color:#dc2626; margin-left:2px;">*</span></label>
                                    <textarea name="description" rows="3" required style="width:100%; padding:10px 12px; font-size:13px; font-weight:500; line-height:1.45; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; resize:vertical; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Describe what happened in complete detail (chronological events, actions, dialogue)..."></textarea>
                                </div>
                                <div class="issue-grid-span2">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Witness Name (Optional)</label>
                                    <input type="text" name="witness_name" style="width:100%; height:40px; padding:8px 12px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; outline:none; font-family:inherit; box-sizing:border-box;" placeholder="Name of witness (if any)">
                                </div>
                                <div class="issue-grid-span2" x-data="issueEvidenceUploader()">
                                    <label class="flbl" style="font-size:10.5px; font-weight:700; color:#334155; margin-bottom:4px;">Proof / Evidence (Optional) <span style="font-size:9px;color:var(--brand);font-weight:700;">— Max: 5MB bawat file (JPG, PNG, PDF)</span></label>
                                    
                                    {{-- Responsive upload box matching inputs --}}
                                    <div @click="evFiles.length > 0 && previewUrl ? previewModal = true : $refs.evidenceInput.click()" 
                                         style="width:100%; min-height:40px; padding:6px 10px; font-size:13px; font-weight:600; color:#1e293b; background:#fff; border:1.5px solid #cbd5e1; border-radius:8px; display:flex; align-items:center; justify-content:space-between; cursor:pointer; box-sizing:border-box; transition:border-color .15s; flex-wrap:wrap; gap:6px;">
                                        
                                        {{-- Left: Icon & Text / Filename --}}
                                        <div style="display:flex; align-items:center; gap:8px; overflow:hidden; min-width:0; flex:1;">
                                            <i class="fas fa-paperclip" style="color:var(--brand); font-size:13px; flex-shrink:0;"></i>
                                            
                                            <template x-if="evFiles.length === 0">
                                                <span style="color:#94a3b8; font-size:12px; font-weight:500;">Attach photo / proof (Optional)</span>
                                            </template>
                                            
                                            <template x-if="evFiles.length > 0">
                                                <span style="color:#0f172a; font-size:12px; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" x-text="evFiles.length === 1 ? evFiles[0].name : evFiles.length + ' files attached'"></span>
                                            </template>
                                        </div>

                                        {{-- Right: Action Button (View Pill / Remove Button / Browse) --}}
                                        <div style="display:flex; align-items:center; gap:6px; flex-shrink:0;">
                                            <template x-if="evFiles.length > 0 && previewUrl">
                                                <span style="font-size:10px; background:#eff6ff; color:#0284c7; border:1px solid #bfdbfe; padding:2px 8px; border-radius:6px; font-weight:800; display:flex; align-items:center; gap:4px;">
                                                    <i class="fas fa-eye"></i> View
                                                </span>
                                            </template>
                                            <template x-if="evFiles.length > 0">
                                                <button type="button" @click.stop="removeFile($event)" style="background:none; border:none; color:#ef4444; font-size:12px; cursor:pointer; padding:2px 4px;" title="Remove file">
                                                    <i class="fas fa-times-circle"></i>
                                                </button>
                                            </template>
                                            <template x-if="evFiles.length === 0">
                                                <span style="font-size:11px; background:#f1f5f9; color:#475569; border:1px solid #e2e8f0; padding:3px 8px; border-radius:6px; font-weight:700;">
                                                    Browse
                                                </span>
                                            </template>
                                        </div>

                                        <input type="file" x-ref="evidenceInput" name="evidence[]" multiple accept="image/*,video/*,.pdf" style="display:none;" @change="handleFileSelect($event)">
                                    </div>

                                    {{-- PHOTO LIGHTBOX MODAL WITH BACK BUTTON --}}
                                    <div x-show="previewModal" x-cloak class="modal-ov" style="z-index:99999;" @keydown.window.escape="previewModal = false">
                                        <div class="modal-box" style="max-width:500px; width:95%; border-radius:16px; overflow:hidden; box-shadow:0 25px 60px rgba(0,0,0,0.4);" @click.away="previewModal = false">
                                            <div style="padding:12px 16px; background:#0f172a; color:#fff; display:flex; align-items:center; justify-content:space-between;">
                                                <div style="display:flex; align-items:center; gap:8px;">
                                                    <i class="fas fa-image" style="color:#38bdf8;"></i>
                                                    <span style="font-size:12px; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:300px;" x-text="previewName || 'Proof Photo'"></span>
                                                </div>
                                                <button type="button" @click="previewModal = false" style="background:none; border:none; color:#94a3b8; font-size:16px; cursor:pointer;"><i class="fas fa-times"></i></button>
                                            </div>
                                            <div style="padding:16px; background:#020617; display:flex; align-items:center; justify-content:center; min-height:240px; max-height:55vh; overflow:auto;">
                                                <img :src="previewUrl" alt="Proof Preview" style="max-width:100%; max-height:50vh; object-fit:contain; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.3);">
                                            </div>
                                            <div style="padding:10px 16px; background:#0f172a; display:flex; justify-content:space-between; align-items:center;">
                                                <button type="button" @click="previewModal = false; $refs.evidenceInput.click()" style="padding:6px 12px; background:#1e293b; border:1px solid #334155; color:#cbd5e1; border-radius:6px; font-size:11px; font-weight:700; cursor:pointer;">
                                                    <i class="fas fa-sync-alt" style="margin-right:4px;"></i> Change Photo
                                                </button>
                                                <button type="button" @click="previewModal = false" class="btn-grad" style="padding:6px 16px; font-size:11.5px; display:inline-flex; align-items:center; gap:6px;">
                                                    <i class="fas fa-arrow-left"></i> Back to Form
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- PROMINENT LEGAL ADVISORY & ₱100 FILING FEE CERTIFICATION BOX --}}
                        <div style="background:#fff; border:1.5px solid #fca5a5; border-radius:14px; padding:14px 16px; margin-top:14px; box-shadow:0 2px 10px rgba(220,38,38,0.08);">
                            {{-- Title --}}
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; padding-bottom:8px; border-bottom:1.5px solid #fee2e2; flex-wrap:wrap; gap:8px;">
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div style="width:32px; height:32px; border-radius:8px; background:#fee2e2; color:#dc2626; display:flex; align-items:center; justify-content:center; font-size:15px; flex-shrink:0;">
                                        <i class="fas fa-balance-scale"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:12px; font-weight:900; color:#991b1b; text-transform:uppercase; letter-spacing:0.02em;">
                                            Official Legal Advisory & Fees
                                        </div>
                                        <div style="font-size:9.5px; font-weight:600; color:#7f1d1d;">
                                            Barangay San Miguel II • Peace & Order Desk
                                        </div>
                                    </div>
                                </div>
                                <div style="background:#fef2f2; border:1.5px solid #f87171; color:#991b1b; font-size:12px; font-weight:900; padding:3px 10px; border-radius:8px; white-space:nowrap; flex-shrink:0;">
                                    ₱100.00 Filing Fee
                                </div>
                            </div>

                            {{-- Bullet Notes --}}
                            <div style="font-size:10.5px; color:#7f1d1d; line-height:1.5; margin-bottom:12px;">
                                <div style="display:flex; align-items:flex-start; gap:8px; margin-bottom:6px;">
                                    <i class="fas fa-ban" style="color:#dc2626; margin-top:2px; flex-shrink:0; font-size:12px;"></i>
                                    <span><strong>Strictly No False or Joke Reports:</strong> Filing a fabricated, joke, or non-serious report is punishable under <strong>Article 183 of the Revised Penal Code (Perjury / False Testimony)</strong> and Barangay Ordinances.</span>
                                </div>
                                <div style="display:flex; align-items:flex-start; gap:8px;">
                                    <i class="fas fa-receipt" style="color:#d97706; margin-top:2px; flex-shrink:0; font-size:12px;"></i>
                                    <span><strong>₱100.00 Filing Fee:</strong> Any case or blotter filed requires a standard <strong>₱100.00 filing fee</strong> payable upon official processing or summon hearing at the Barangay Hall.</span>
                                </div>
                            </div>

                            {{-- Mandatory Legal Acknowledgment Checkbox --}}
                            <label style="display:flex; align-items:center; gap:10px; cursor:pointer; background:#fef2f2; border:1.5px solid #fca5a5; padding:10px 12px; border-radius:10px; transition:all .2s;">
                                <input type="checkbox" name="legal_acknowledgment" value="1" x-model="legalAcknowledged" style="width:18px; height:18px; accent-color:#dc2626; cursor:pointer; flex-shrink:0;" required>
                                <span style="font-size:11px; font-weight:800; color:#991b1b; line-height:1.35;" x-text="lang==='fil'?'Pinatutunayan ko sa ilalim ng batas na ang aking sumbong ay totoo, seryoso, at hindi biro o gawa-gawa.':'I solemnly certify under penalty of law that this report is true, serious, and not a prank or false complaint.'">
                                    I solemnly certify under penalty of law that this report is true, serious, and not a prank or false complaint.
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- 3. FIXED MODAL FOOTER WITH PERMANENT BACK / NEXT / SUBMIT BUTTONS --}}
                <div class="issue-modal-footer">
                    {{-- Step 1 Footer Controls --}}
                    <template x-if="issueStep === 1">
                        <div style="display:flex; justify-content:space-between; align-items:center; width:100%; gap:8px;">
                            <button type="button" @click="issueModal=false" class="btn-plain btn-ghost" style="padding:8px 14px; font-size:11.5px; flex-shrink:0;">Cancel</button>
                            <button type="button" @click="goToIssueStep2()" class="btn-grad btn-grad-red" style="padding:8px 16px; font-size:11.5px; display:inline-flex; align-items:center; gap:6px;">
                                <span x-text="lang==='fil'?'Susunod: Detalye ng Insidente':'Next: Incident Details'">Next: Incident Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </template>

                    {{-- Step 2 Footer Controls (ALWAYS VISIBLE BACK BUTTON & SUBMIT) --}}
                    <template x-if="issueStep === 2">
                        <div style="display:flex; justify-content:space-between; align-items:center; width:100%; gap:8px;">
                            <button type="button" @click="issueStep = 1; issueErrorMsg = '';" class="btn-plain btn-outline" style="padding:8px 14px; font-size:11.5px; display:inline-flex; align-items:center; gap:6px; flex-shrink:0;">
                                <i class="fas fa-arrow-left"></i>
                                <span x-text="lang==='fil'?'Hakbang 1':'Back'">Back</span>
                            </button>
                            <button type="submit" :disabled="!legalAcknowledged || isSubmittingReport" class="btn-grad btn-grad-red" :style="(!legalAcknowledged || isSubmittingReport) ? 'opacity:0.6; cursor:not-allowed;' : ''" style="padding:8px 16px; font-size:11.5px; display:inline-flex; align-items:center; gap:6px;">
                                <template x-if="!isSubmittingReport">
                                    <span style="display:flex; align-items:center; gap:6px;"><i class="fas fa-flag"></i> <span x-text="lang==='fil'?'Isumite ang Reklamo':'Submit Official Report'">Submit Official Report</span></span>
                                </template>
                                <template x-if="isSubmittingReport">
                                    <span style="display:flex; align-items:center; gap:6px;"><i class="fas fa-spinner fa-spin"></i> <span x-text="lang==='fil'?'Isinusumite...':'Submitting...'">Submitting...</span></span>
                                </template>
                            </button>
                        </div>
                    </template>
                </div>
            </form>
        </div>
    </div>

    {{-- INCIDENT REPORT FINAL CONFIRMATION MODAL --}}
    <div x-show="issueConfirmModal" x-cloak class="modal-ov" x-transition style="z-index:10000;" @keydown.window.escape="issueConfirmModal=false">
        <div class="modal-box" style="max-width:540px; width:95%; border-radius:20px; overflow:hidden; box-shadow:0 25px 60px rgba(0,0,52,0.4); padding:0; border-top:5px solid #dc2626;" @click.away="issueConfirmModal=false">
            
            {{-- Header --}}
            <div style="padding:18px 22px; background:#fff; border-bottom:1.5px solid #fee2e2; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="width:38px; height:38px; border-radius:10px; background:#fee2e2; color:#dc2626; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0;">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:900; color:#0f172a; text-transform:uppercase; letter-spacing:0.02em;" x-text="lang==='fil'?'Kumpirmahin ang Ulat ng Insidente':'Confirm Incident Report'">
                            Confirm Incident Report
                        </div>
                        <div style="font-size:11px; font-weight:600; color:#64748b; margin-top:1px;" x-text="lang==='fil'?'Panghuling pagsusuri ng mga detalye bago opisyal na isumite':'Final review of details before official submission'">
                            Final review of details before official submission
                        </div>
                    </div>
                </div>
                <button type="button" @click="issueConfirmModal=false" class="modal-close" style="width:30px; height:30px; font-size:15px;"><i class="fas fa-times"></i></button>
            </div>

            {{-- Body --}}
            <div style="padding:20px 22px; max-height:70vh; overflow-y:auto; background:#fff;">
                
                {{-- Details Summary Card --}}
                <div style="background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:14px 16px; margin-bottom:16px;">
                    <div style="font-size:11.5px; font-weight:800; color:#334155; text-transform:uppercase; margin-bottom:10px; display:flex; align-items:center; gap:6px;">
                        <i class="fas fa-info-circle" style="color:var(--brand);"></i> <span x-text="lang==='fil'?'Buod ng Impormasyon':'Summary of Information'">Summary of Information</span>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; font-size:12px; line-height:1.45;">
                        <div style="grid-column:span 2; background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:8px 10px;">
                            <span style="font-size:10.5px; color:#64748b; font-weight:700; display:block;" x-text="lang==='fil'?'URI NG REKLAMO':'OFFENSE TYPE'">OFFENSE TYPE</span>
                            <span style="font-weight:900; color:#0f172a; font-size:13px;" x-text="confirmData.offense"></span>
                        </div>

                        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:8px 10px;">
                            <span style="font-size:10.5px; color:#64748b; font-weight:700; display:block;" x-text="lang==='fil'?'NAGREREKLAMO':'COMPLAINANT'">COMPLAINANT</span>
                            <span style="font-weight:800; color:#0f172a;" x-text="confirmData.complainant"></span>
                            <span style="font-size:11px; color:#475569; display:block;" x-text="confirmData.contact"></span>
                        </div>

                        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:8px 10px;">
                            <span style="font-size:10.5px; color:#64748b; font-weight:700; display:block;" x-text="lang==='fil'?'INIREREKLAMO':'RESPONDENT'">RESPONDENT</span>
                            <span style="font-weight:800; color:#991b1b;" x-text="confirmData.respondent"></span>
                        </div>

                        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:8px 10px;">
                            <span style="font-size:10.5px; color:#64748b; font-weight:700; display:block;" x-text="lang==='fil'?'PETSA AT ORAS':'DATE & TIME'">DATE & TIME</span>
                            <span style="font-weight:800; color:#0f172a;" x-text="confirmData.dateTime"></span>
                        </div>

                        <div style="background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:8px 10px;">
                            <span style="font-size:10.5px; color:#64748b; font-weight:700; display:block;" x-text="lang==='fil'?'LOKASYON':'LOCATION'">LOCATION</span>
                            <span style="font-weight:800; color:#0f172a; overflow:hidden; text-overflow:ellipsis; display:block; white-space:nowrap;" x-text="confirmData.location"></span>
                        </div>

                        <div style="grid-column:span 2; background:#fff; border:1px solid #cbd5e1; border-radius:8px; padding:8px 10px;">
                            <span style="font-size:10.5px; color:#64748b; font-weight:700; display:block;" x-text="lang==='fil'?'PAUNANG SALAYSAY':'NARRATION PREVIEW'">NARRATION PREVIEW</span>
                            <span style="font-weight:600; color:#334155; font-size:11.5px; display:block; font-style:italic;" x-text="confirmData.description"></span>
                        </div>
                    </div>
                </div>

                {{-- Prominent Warning & ₱100 Filing Fee Box --}}
                <div style="background:#fef2f2; border:2px solid #f87171; border-radius:12px; padding:14px 16px;">
                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:8px;">
                        <i class="fas fa-exclamation-triangle" style="color:#dc2626; font-size:16px;"></i>
                        <span style="font-size:12.5px; font-weight:900; color:#991b1b; text-transform:uppercase; letter-spacing:0.02em;" x-text="lang==='fil'?'Mahalagang Paunawa & Bayarin sa Blotter':'Important Advisory & Filing Fee'">
                            Mahalagang Paunawa & Bayarin sa Blotter
                        </span>
                    </div>

                    <div style="font-size:11.5px; color:#7f1d1d; line-height:1.55;">
                        <div style="display:flex; align-items:flex-start; gap:8px; margin-bottom:8px;">
                            <span style="background:#fee2e2; color:#991b1b; font-weight:900; padding:1px 6px; border-radius:4px; font-size:11px; white-space:nowrap;">₱100.00 FEE</span>
                            <span x-text="lang==='fil'?'May standard na ₱100.00 filing fee na babayaran sa Barangay Hall Cashier sa araw ng opisyal na pagproseso o pagdinig ng reklamo.':'A standard ₱100.00 filing fee is payable at the Barangay Hall Cashier upon official blotter processing or hearing.'">
                                May standard na ₱100.00 filing fee na babayaran sa Barangay Hall Cashier sa araw ng opisyal na pagproseso o pagdinig ng reklamo.
                            </span>
                        </div>
                        <div style="display:flex; align-items:flex-start; gap:8px;">
                            <span style="background:#fee2e2; color:#dc2626; font-weight:900; padding:1px 6px; border-radius:4px; font-size:11px; white-space:nowrap;">BAWAL ANG PRANK</span>
                            <span x-text="lang==='fil'?'Mahigpit na ipinagbabawal ang mga prank, biro, o gawa-gawang ulat. Ang pagsisinungaling sa opisyal na sumbong ay may kaparusahan sa ilalim ng Article 183 ng Revised Penal Code (Perjury) at Barangay Ordinances.':'Strictly no prank or fabricated reports. False testimony or fake complaints are punishable under Article 183 of the Revised Penal Code (Perjury) and Barangay Ordinances.'">
                                Mahigpit na ipinagbabawal ang mga prank, biro, o gawa-gawang ulat. Ang pagsisinungaling sa opisyal na sumbong ay may kaparusahan sa ilalim ng Article 183 ng Revised Penal Code (Perjury) at Barangay Ordinances.
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer Buttons --}}
            <div style="padding:14px 22px; background:#f8fafc; border-top:1.5px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center; gap:10px;">
                <button type="button" @click="issueConfirmModal=false" class="btn-plain btn-outline" style="padding:9px 16px; font-size:12px; font-weight:800; display:inline-flex; align-items:center; gap:6px;">
                    <i class="fas fa-arrow-left"></i>
                    <span x-text="lang==='fil'?'Bumalik at I-edit':'Back to Edit'">Bumalik at I-edit</span>
                </button>
                <button type="button" @click="finalSubmitIssueReport()" :disabled="isSubmittingReport" class="btn-grad btn-grad-red" style="padding:9px 20px; font-size:12px; font-weight:900; display:inline-flex; align-items:center; gap:6px;">
                    <template x-if="!isSubmittingReport">
                        <span style="display:flex; align-items:center; gap:6px;">
                            <i class="fas fa-check-circle"></i>
                            <span x-text="lang==='fil'?'Oo, Isumite ang Ulat':'Confirm & Submit Report'">Oo, Isumite ang Ulat</span>
                        </span>
                    </template>
                    <template x-if="isSubmittingReport">
                        <span style="display:flex; align-items:center; gap:6px;">
                            <i class="fas fa-spinner fa-spin"></i>
                            <span x-text="lang==='fil'?'Isinusumite...':'Submitting...'">Isinusumite...</span>
                        </span>
                    </template>
                </button>
            </div>

        </div>
    </div>
    {{-- END INCIDENT REPORT FINAL CONFIRMATION MODAL --}}

    {{-- VIEW ALL SCHEDULES POP-UP MODAL --}}
    <div x-show="scheduleModal" x-cloak class="modal-ov" x-transition style="z-index:9999;" @keydown.window.escape="scheduleModal=false">
        <div class="modal-box" style="max-width:640px; border-radius:20px; border-bottom:4px solid var(--brand); box-shadow:0 25px 60px rgba(0,0,52,0.4); max-height:88vh; display:flex; flex-direction:column; overflow:hidden;" @click.away="scheduleModal=false">
            
            {{-- Header with Navy Gradient --}}
            <div style="background:linear-gradient(135deg,#000052 0%,#04192D 60%,#0E5393 100%); padding:20px 24px; color:#fff; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1); flex-shrink:0;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:42px; height:42px; border-radius:12px; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; border:1px solid rgba(255,255,255,0.2);">
                        <i class="fas fa-calendar-alt" style="color:#38bdf8; font-size:18px;"></i>
                    </div>
                    <div>
                        <h3 style="font-size:15px; font-weight:900; color:#fff; text-transform:uppercase; letter-spacing:0.04em; margin:0;" x-text="t('sched_title')">
                            Barangay Duty & Patrol Schedules
                        </h3>
                        <p style="font-size:11px; color:rgba(255,255,255,0.75); font-weight:600; margin:3px 0 0 0;" x-text="t('sched_sub')">
                            Official Weekly Kagawad Assignments & Tanod Security Patrol Timetable
                        </p>
                    </div>
                </div>
                <button type="button" @click="scheduleModal=false" style="background:rgba(255,255,255,0.1); border:none; color:#fff; width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:16px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-in schedule-modal-scroll" style="padding:20px 24px; flex:1;">
                {{-- Segmented Full-Width Rectangular Tabs --}}
                <div class="sched-tabs-grid" style="display:grid; grid-template-columns:1fr 1fr; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:4px; margin-bottom:20px; gap:4px;">
                    <button type="button" @click="scheduleTab='kagawad'"
                            :style="scheduleTab==='kagawad' 
                                ? 'background:#e0f2fe; color:#0369a1; border:1.5px solid #7dd3fc; box-shadow:0 2px 8px rgba(14,165,233,0.18); font-weight:900;' 
                                : 'background:transparent; color:#64748b; border:1.5px solid transparent; font-weight:700;'"
                            style="width:100%; padding:11px 14px; border-radius:8px; font-size:11.5px; text-transform:uppercase; letter-spacing:.05em; cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; gap:8px;">
                        <i class="fas fa-user-tie" :style="scheduleTab==='kagawad' ? 'color:#0284c7;' : 'color:#94a3b8;'"></i>
                        <span x-text="t('sched_tab_kagawad')">Officer on Duty (Kagawad)</span>
                    </button>
                    <button type="button" @click="scheduleTab='tanod'"
                            :style="scheduleTab==='tanod' 
                                ? 'background:#e0f2fe; color:#0369a1; border:1.5px solid #7dd3fc; box-shadow:0 2px 8px rgba(14,165,233,0.18); font-weight:900;' 
                                : 'background:transparent; color:#64748b; border:1.5px solid transparent; font-weight:700;'"
                            style="width:100%; padding:11px 14px; border-radius:8px; font-size:11.5px; text-transform:uppercase; letter-spacing:.05em; cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; gap:8px;">
                        <i class="fas fa-shield-alt" :style="scheduleTab==='tanod' ? 'color:#0284c7;' : 'color:#94a3b8;'"></i>
                        <span x-text="t('sched_tab_tanod')">Tanod Patrol Schedule</span>
                    </button>
                </div>

                {{-- TAB 1: Kagawad Schedule --}}
                <div x-show="scheduleTab==='kagawad'" x-transition>
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                        <div style="font-size:11px; font-weight:900; color:#0f172a; text-transform:uppercase; letter-spacing:.06em;" x-text="t('sched_kagawad_head')">
                            Weekly Officer Schedule
                        </div>
                        <div style="font-size:10px; font-weight:700; color:#64748b;" x-text="t('sched_rotation')">
                            Monday – Sunday Rotation
                        </div>
                    </div>

                    <div class="duty-table-card">
                        <div class="duty-table-header">
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em;" x-text="t('sched_col_day')">Day</div>
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em;" x-text="t('sched_col_official')">Barangay Official</div>
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em; text-align:right;" x-text="t('sched_col_status')">Duty Status</div>
                        </div>

                        <template x-for="d in dutySchedule" :key="d.day">
                            <div class="duty-table-row"
                                 :style="d.day === todayDayKey 
                                    ? 'background:#eff6ff; border-left-color:#0284c7;' 
                                    : 'background:#ffffff;'">
                                <div>
                                    <span style="font-size:11.5px; font-weight:900; text-transform:uppercase; letter-spacing:.05em;"
                                          :style="d.day === todayDayKey ? 'color:#0284c7;' : 'color:#334155;'"
                                          x-text="lang==='fil' ? ({'Sunday':'Linggo','Monday':'Lunes','Tuesday':'Martes','Wednesday':'Miyerkules','Thursday':'Huwebes','Friday':'Biyernes','Saturday':'Sabado'}[d.day] || d.day) : d.day"></span>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:13px; font-weight:800; color:#0f172a; line-height:1.25;" x-text="d.name"></div>
                                    <template x-if="d.is_substitute">
                                        <div style="font-size:10px; color:#d97706; font-weight:800; margin-top:2px; display:flex; align-items:center; gap:4px;">
                                            <i class="fas fa-exchange-alt"></i> <span>Substitute Duty for <span x-text="d.original_name"></span></span>
                                        </div>
                                    </template>
                                    <template x-if="!d.is_substitute">
                                        <div style="font-size:10px; color:#64748b; font-weight:600; margin-top:2px;" x-text="t('kagawad_of_day')">Barangay Kagawad of the Day</div>
                                    </template>
                                </div>
                                <div style="text-align:right; display:flex; align-items:center; justify-content:flex-end;">
                                    <template x-if="d.day === todayDayKey && d.is_substitute">
                                        <span style="font-size:9.5px; font-weight:900; background:#f59e0b; color:#fff; padding:4px 10px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; display:inline-flex; align-items:center; gap:5px; box-shadow:0 2px 6px rgba(245,158,11,0.25); white-space:nowrap;">
                                            <i class="fas fa-check-circle" style="font-size:9px;"></i> <span>Substitute Active</span>
                                        </span>
                                    </template>
                                    <template x-if="d.day === todayDayKey && !d.is_substitute">
                                        <span style="font-size:9.5px; font-weight:900; background:#0284c7; color:#fff; padding:4px 10px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; display:inline-flex; align-items:center; gap:5px; box-shadow:0 2px 6px rgba(2,132,199,0.25); white-space:nowrap;">
                                            <i class="fas fa-check-circle" style="font-size:9px;"></i> <span x-text="t('sched_active_today')">Active Today</span>
                                        </span>
                                    </template>
                                    <template x-if="d.day !== todayDayKey">
                                        <span style="font-size:9px; font-weight:700; background:#f1f5f9; color:#94a3b8; padding:3px 8px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; white-space:nowrap;" x-text="t('sched_scheduled')">
                                            Scheduled
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- TAB 2: Tanod Patrol Schedule --}}
                <div x-show="scheduleTab==='tanod'" x-transition>
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                        <div style="font-size:11px; font-weight:900; color:#0f172a; text-transform:uppercase; letter-spacing:.06em;" x-text="t('sched_tanod_head')">
                            Peace &amp; Order Patrol Teams
                        </div>
                        <div style="font-size:10px; font-weight:700; color:#64748b;" x-text="t('sched_security_rotation')">
                            Official Security Rotation
                        </div>
                    </div>

                    {{-- Two Tanod Teams Overview Cards --}}
                    <div style="display:grid; gap:10px; margin-bottom:18px;">
                        <template x-for="team in tanodTeams" :key="team.team_name">
                            <div style="background:#ffffff; border-radius:14px; padding:14px 16px; transition:all .2s; box-shadow:0 1px 4px rgba(0,0,0,0.03);"
                                 :style="isTeamActiveToday(team.days) 
                                    ? 'border:1.5px solid #7dd3fc; background:linear-gradient(to right, #f0f9ff, #ffffff);' 
                                    : 'border:1.5px solid #e2e8f0;'">
                                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:10px; flex-wrap:wrap;">
                                    <div>
                                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                            <span style="font-size:13px; font-weight:900; color:#0284c7; text-transform:uppercase; letter-spacing:.04em; display:flex; align-items:center; gap:6px;">
                                                <i class="fas fa-shield-alt"></i>
                                                <span x-text="team.team_name"></span>
                                            </span>
                                        </div>
                                        <div style="display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                                            <span style="font-size:10.5px; font-weight:700; color:#64748b;" x-text="t('sched_assigned_days')">Assigned Days:</span>
                                            <span style="font-size:11.5px; font-weight:900; color:#0f172a;" x-text="team.days_label"></span>
                                        </div>
                                        <div style="display:flex; align-items:center; gap:8px; margin-top:6px;">
                                            <div style="width:24px; height:24px; border-radius:6px; background:#f0f9ff; display:flex; align-items:center; justify-content:center; color:#0284c7; font-size:10.5px; flex-shrink:0;">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div style="font-size:12.5px; font-weight:800; color:#0f172a;">
                                                <span style="color:#64748b; font-size:10.5px; font-weight:700;" x-text="t('sched_personnel')">Personnel: </span>
                                                <span x-text="team.personnel_names"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:6px;">
                                        <template x-if="isTeamActiveToday(team.days)">
                                            <span style="font-size:9.5px; font-weight:900; background:#0284c7; color:#fff; padding:4px 10px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; display:inline-flex; align-items:center; gap:5px; box-shadow:0 2px 6px rgba(2,132,199,0.25); white-space:nowrap;">
                                                <i class="fas fa-check-circle" style="font-size:9px;"></i> <span x-text="t('sched_active_today')">Active Today</span>
                                            </span>
                                        </template>
                                        <template x-if="!isTeamActiveToday(team.days)">
                                            <span style="font-size:9px; font-weight:700; background:#f1f5f9; color:#94a3b8; padding:3px 8px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; white-space:nowrap;" x-text="t('sched_scheduled')">
                                                Scheduled
                                            </span>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Weekly Day-by-Day Patrol Rotation Table --}}
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                        <div style="font-size:11px; font-weight:900; color:#0f172a; text-transform:uppercase; letter-spacing:.06em;">
                            Weekly Patrol Rotation by Day
                        </div>
                        <div style="font-size:10px; font-weight:700; color:#64748b;">
                            Monday – Sunday
                        </div>
                    </div>

                    <div class="duty-table-card">
                        <div class="duty-table-header">
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em;">Day</div>
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em;">Patrol Team &amp; Personnel</div>
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em; text-align:right;">Duty Status</div>
                        </div>

                        <template x-for="s in tanodWeeklySchedule" :key="s.day">
                            <div class="duty-table-row"
                                 :style="s.day === todayDay 
                                    ? 'background:#eff6ff; border-left-color:#0284c7;' 
                                    : 'background:#ffffff;'">
                                <div>
                                    <span style="font-size:11.5px; font-weight:900; text-transform:uppercase; letter-spacing:.05em;"
                                          :style="s.day === todayDay ? 'color:#0284c7;' : 'color:#334155;'"
                                          x-text="s.day"></span>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:13px; font-weight:800; color:#0f172a; line-height:1.25;">
                                        <span style="color:#0284c7;" x-text="s.team"></span>
                                        <span style="font-size:11.5px; font-weight:700; color:#475569;" x-text="' — ' + s.personnel"></span>
                                    </div>
                                    <div style="font-size:10px; color:#64748b; font-weight:600; margin-top:2px;">Routine Barangay Security Patrol</div>
                                </div>
                                <div style="text-align:right; display:flex; align-items:center; justify-content:flex-end;">
                                    <template x-if="s.day === todayDay">
                                        <span style="font-size:9.5px; font-weight:900; background:#0284c7; color:#fff; padding:4px 10px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; display:inline-flex; align-items:center; gap:5px; box-shadow:0 2px 6px rgba(2,132,199,0.25); white-space:nowrap;">
                                            <i class="fas fa-check-circle" style="font-size:9px;"></i> Active Today
                                        </span>
                                    </template>
                                    <template x-if="s.day !== todayDay">
                                        <span style="font-size:9px; font-weight:700; background:#f1f5f9; color:#94a3b8; padding:3px 8px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; white-space:nowrap;">
                                            Scheduled
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div style="display:flex; justify-content:flex-end; margin-top:20px; padding-top:14px; border-top:1px solid #f1f5f9;">
                    <button type="button" @click="scheduleModal=false" class="btn-plain btn-ghost btn-sm" style="padding:8px 20px; font-size:11px;">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- FULL ITEM MODAL (EVENTS/ANNOUNCEMENTS - FACEBOOK STYLE VIEWER) --}}
    <div x-show="itemModal" x-cloak class="modal-ov" x-transition @keydown.window.escape="itemModal=false" @keydown.window.arrow-right="if(itemModal) nextImg()" @keydown.window.arrow-left="if(itemModal) prevImg()">
        <div class="modal-box" style="padding:0;overflow-y:auto;overflow-x:hidden;border-bottom:none;background:#ffffff;max-width:680px;border-radius:20px;box-shadow:0 25px 60px rgba(0,0,0,0.35);" @click.away="itemModal=false">
            
            {{-- FB STYLE PHOTO VIEWER / CAROUSEL --}}
            <template x-if="(activeItem.images && activeItem.images.length > 0) || activeItem.image">
                <div style="position:relative;background:#090d16;overflow:hidden;border-top-left-radius:20px;border-top-right-radius:20px;">
                    {{-- Main Photo Display --}}
                    <div style="width:100%;height:380px;display:flex;align-items:center;justify-content:center;position:relative;user-select:none;">
                        <img :src="activeItem.images && activeItem.images.length > 0 ? activeItem.images[activeImgIndex] : activeItem.image" 
                             style="max-width:100%;max-height:100%;object-fit:contain;transition:all .2s ease-in-out;" 
                             alt="Item Image"
                             onerror="this.onerror=null; this.src='{{ asset('images/canal.jpg') }}';">
                        
                        {{-- Counter Pill (e.g. 1 / 4) --}}
                        <template x-if="activeItem.images && activeItem.images.length > 1">
                            <div style="position:absolute;top:14px;left:14px;background:rgba(0,0,0,0.65);color:#fff;font-size:11px;font-weight:800;padding:4px 12px;border-radius:20px;backdrop-filter:blur(6px);display:flex;align-items:center;gap:6px;box-shadow:0 2px 8px rgba(0,0,0,0.4);">
                                <i class="fas fa-images"></i>
                                <span x-text="(activeImgIndex + 1) + ' / ' + activeItem.images.length"></span>
                            </div>
                        </template>

                        {{-- Next / Prev Floating Navigation Buttons --}}
                        <template x-if="activeItem.images && activeItem.images.length > 1">
                            <button type="button" @click.stop="prevImg()" 
                                    style="position:absolute;left:14px;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.9);color:#0f172a;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.35);transition:all .15s;font-size:16px;z-index:5;"
                                    onmouseover="this.style.background='#ffffff';this.style.transform='translateY(-50%) scale(1.08)'"
                                    onmouseout="this.style.background='rgba(255,255,255,0.9)';this.style.transform='translateY(-50%) scale(1)'">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        </template>
                        <template x-if="activeItem.images && activeItem.images.length > 1">
                            <button type="button" @click.stop="nextImg()" 
                                    style="position:absolute;right:14px;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.9);color:#0f172a;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.35);transition:all .15s;font-size:16px;z-index:5;"
                                    onmouseover="this.style.background='#ffffff';this.style.transform='translateY(-50%) scale(1.08)'"
                                    onmouseout="this.style.background='rgba(255,255,255,0.9)';this.style.transform='translateY(-50%) scale(1)'">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </template>
                    </div>
                </div>
            </template>

            <div style="padding:22px 24px;">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px;gap:12px;">
                    <div>
                        <span style="font-size:9px;font-weight:900;text-transform:uppercase;padding:3px 9px;border-radius:99px;background:var(--brand);color:#fff;display:inline-block;margin-bottom:8px;letter-spacing:.04em;" x-text="activeItem.type + ' • ' + activeItem.tag"></span>
                        <div style="font-size:18px;font-weight:900;color:var(--text);letter-spacing:.01em;line-height:1.3;" x-text="activeItem.title"></div>
                    </div>
                    <button @click="itemModal=false" style="background:none;border:none;color:var(--light);font-size:22px;cursor:pointer;line-height:1;transition:color .15s;" onmouseover="this.style.color='var(--danger)'" onmouseout="this.style.color='var(--light)'"><i class="fas fa-times-circle"></i></button>
                </div>
                
                <div style="display:flex;flex-wrap:wrap;gap:14px;margin-bottom:16px;padding-bottom:14px;border-bottom:1px solid var(--border);">
                    <div style="font-size:11px;color:var(--muted);font-weight:700;display:flex;align-items:center;gap:5px;">
                        <i class="fas fa-calendar-day" style="color:var(--brand);"></i> <span x-text="activeItem.date"></span>
                    </div>
                    <template x-if="activeItem.time_range">
                        <div style="font-size:11px;color:var(--muted);font-weight:700;display:flex;align-items:center;gap:5px;">
                            <i class="fas fa-clock" style="color:var(--brand);"></i> <span x-text="activeItem.time_range"></span>
                        </div>
                    </template>
                    <template x-if="activeItem.location">
                        <div style="font-size:11px;color:var(--muted);font-weight:700;display:flex;align-items:center;gap:5px;">
                            <i class="fas fa-map-marker-alt" style="color:var(--brand);"></i> <span x-text="activeItem.location"></span>
                        </div>
                    </template>
                </div>

                <div style="font-size:13px;color:var(--text);font-weight:600;line-height:1.7;white-space:pre-wrap;" x-text="activeItem.description"></div>
                
                <div style="display:flex;justify-content:flex-end;margin-top:22px;">
                    <button @click="itemModal=false" class="btn-plain btn-ghost" style="padding:8px 20px;font-size:11px;font-weight:800;border-radius:8px;">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- PROFILE MODAL --}}
    @if($isAuth)
    <div x-show="profileModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" @click.away="profileModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico"><i class="fas fa-user-circle"></i></div>
                        <div>
                            <div>My Profile</div>
                        </div>
                    </div>
                    <button @click="profileModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                <div style="display:flex;align-items:center;gap:14px;padding:14px;background:#f8fafc;border-radius:12px;margin-bottom:14px;border:1px solid var(--border);">
                    @php
                        $canUpdatePhoto = true;
                        $nextPhotoUpdate = null;
                        if ($authUser && $authUser->photo_updated_at && $authUser->photo_updated_at->copy()->addMonths(6)->isFuture()) {
                            $canUpdatePhoto = false;
                            $nextPhotoUpdate = $authUser->photo_updated_at->copy()->addMonths(6)->format('M d, Y');
                        }
                    @endphp
                    @php
                        $authProfName = trim(($authUser?->first_name??'') . ' ' . ($authUser?->last_name??'')) ?: 'Resident';
                        $authProfFallback = 'https://ui-avatars.com/api/?name=' . urlencode($authProfName) . '&background=0E5393&color=fff&size=128&bold=true';
                    @endphp
                    <div style="position:relative; width:80px; height:80px; flex-shrink:0;" x-data="{ isDragging: false }">
                        <div style="width:100%;height:100%;border-radius:12px;overflow:hidden;border:2px solid #fff;box-shadow:var(--card-shadow);"
                             @if(!$canUpdatePhoto) title="You can update your photo again on {{ $nextPhotoUpdate }}" @endif>
                            <img src="{{ $authUser?->profile_photo_url ?? $authProfFallback }}"
                                 onerror="this.onerror=null; this.src='{{ $authProfFallback }}';"
                                 style="width:100%;height:100%;object-fit:cover;aspect-ratio:1/1;"
                                 @if($canUpdatePhoto)
                                 :style="isDragging ? 'transform:scale(1.1); transition:.2s;' : ''"
                                 @dragover.prevent="isDragging = true"
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ warningType='profile'; warningNextDate='{{ now()->addMonths(6)->format('M d, Y') }}'; photoWarningModal=true; window.pendingPhotoFiles = $event.dataTransfer.files; }"
                                 @endif>
                        </div>
                        @if($canUpdatePhoto)
                        <button style="position:absolute;bottom:-4px;right:-4px;background:var(--brand);color:#fff;border:none;border-radius:50%;width:26px;height:26px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 5px rgba(0,0,0,0.3);z-index:10;"
                                @click="warningType='profile'; warningNextDate='{{ now()->addMonths(6)->format('M d, Y') }}'; photoWarningModal=true;" title="Change Profile Picture (Max: 5MB)">
                            <i class="fas fa-camera" style="font-size:11px;"></i>
                        </button>
                        <form id="profilePhotoForm" action="{{ route('resident.profile.photo') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                            @csrf
                            <input type="file" name="photo" id="profilePhotoInput" accept="image/*" @change="if($event.target.files.length){ const f=$event.target.files[0]; if(f.size > 5*1024*1024){ alert('Masyadong malaki ang larawan ('+(f.size/1024/1024).toFixed(1)+'MB)! Ang maximum allowed size ay 5MB lamang.'); $event.target.value=''; return; } document.getElementById('profilePhotoForm').submit(); }">
                        </form>
                        @endif
                    </div>
                    <div>
                        <div style="font-size:17px;font-weight:900;color:var(--text);">{{ ($authUser?->first_name??'').' '.($authUser?->last_name??'') }}</div>
                        <div style="font-size:10px;font-weight:700;color:var(--brand);text-transform:uppercase;letter-spacing:.06em;margin-top:2px;">{{ $authUser?->resident_code ?? 'NO-CODE' }}</div>
                        <div style="margin-top:5px;display:flex;gap:4px;flex-wrap:wrap;">
                            @if($authUser?->is_voter)
                                @if($authUser->voter_status == 'pending')
                                    <span style="font-size:8px;font-weight:900;background:#fef3c7;color:#a16207;padding:2px 7px;border-radius:99px;">Voter (Pending)</span>
                                @elseif($authUser->voter_status == 'declined')
                                    <span style="font-size:8px;font-weight:900;background:#fee2e2;color:#dc2626;padding:2px 7px;border-radius:99px;">Voter (Declined)</span>
                                @else
                                    <span style="font-size:8px;font-weight:900;background:#dbeafe;color:#1d4ed8;padding:2px 7px;border-radius:99px;">Voter</span>
                                @endif
                            @endif
                            @if($authUser && $authUser->voter_status === 'pending' && !$authUser->is_voter)
                                <span style="font-size:8px;font-weight:900;background:#fef3c7;color:#a16207;padding:2px 7px;border-radius:99px;">Voter (Pending)</span>
                            @endif
                            @if($authUser?->is_non_voter && $authUser->voter_status !== 'pending' && $authUser->voter_status !== 'approved')
                                <span style="font-size:8px;font-weight:900;background:#fef3c7;color:#a16207;padding:2px 7px;border-radius:99px;">Non-Voter</span>
                            @endif
                            @if($authUser?->is_senior)<span style="font-size:8px;font-weight:900;background:#ffedd5;color:#ea580c;padding:2px 7px;border-radius:99px;">Senior</span>@endif
                            @if($authUser?->is_pwd)<span style="font-size:8px;font-weight:900;background:#ede9fe;color:#7c3aed;padding:2px 7px;border-radius:99px;">PWD</span>@endif
                            @if($authUser?->is_bedridden)<span style="font-size:8px;font-weight:900;background:#fee2e2;color:#dc2626;padding:2px 7px;border-radius:99px;">Bed-ridden</span>@endif
                            @if($authUser?->is_single_parent)<span style="font-size:8px;font-weight:900;background:#fce7f3;color:#be185d;padding:2px 7px;border-radius:99px;">Solo Parent</span>@endif
                        </div>
                    </div>
                </div>

                <div class="fgrid2" style="gap:8px;margin-bottom:14px;">
                    @foreach([
                        ['Birthday', $authUser?->birthday ? \Carbon\Carbon::parse($authUser->birthday)->format('F d, Y') : 'N/A'],
                        ['Gender', $authUser?->gender ?? 'N/A'],
                        ['Civil Status', $authUser?->civil_status ?? 'N/A'],
                        ['Contact', $authUser?->contact_number ?? 'N/A'],
                        ['Birthplace', $authUser?->birthplace ?? 'N/A'],
                        ['Occupation', $authUser?->occupation ?? 'N/A'],
                    ] as [$lbl,$val])
                    <div class="profile-field">
                        <div class="profile-field-lbl">{{ $lbl }}</div>
                        <div class="profile-field-val">{{ $val }}</div>
                    </div>
                    @endforeach
                    <div class="profile-field" style="grid-column:span 2;">
                        <div class="profile-field-lbl">Registered Email Address (For Notifications & Receipts)</div>
                        <div class="profile-field-val" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:6px;">
                            <span style="word-break:break-all;">{{ $authUser?->email ?? 'No email set' }}</span>
                            <button type="button" @click="profileModal=false; emailEditModal=true" class="btn-plain btn-sm" style="padding:4px 10px;font-size:9.5px;font-weight:800;color:var(--brand);background:#eff6ff;border:1px solid #bfdbfe;border-radius:6px;cursor:pointer;">
                                <i class="fas fa-edit"></i> Change Email
                            </button>
                        </div>
                    </div>
                    <div class="profile-field" style="grid-column:span 2;">
                        <div class="profile-field-lbl">Address</div>
                        <div class="profile-field-val">{{ $authUser?->address ?? 'N/A' }}</div>
                    </div>
                </div>

                {{-- VOTER / RESIDENT ID UPLOAD LOGIC --}}
                @if($authUser && ($authUser->voter_status === 'declined' || $authUser->status === 'declined'))
                <div style="background:#fee2e2;border:1.5px solid #fca5a5;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#dc2626;text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;"><i class="fas fa-exclamation-circle" style="margin-right:4px;"></i> ID / Voter Verification Declined</div>
                    <p style="font-size:10px;color:#991b1b;font-weight:600;margin-bottom:10px;">Reason: {{ $authUser->decline_reason ?? 'Invalid ID.' }}</p>
                    <button type="button" @click="profileModal=false; idUploadModal=true" class="btn-grad btn-grad-red btn-sm" style="display:inline-flex;cursor:pointer;margin:0;">
                        <i class="fas fa-upload" style="margin-right:6px;"></i> Re-upload Proof
                    </button>
                </div>
                @elseif($authUser && empty($authUser->voter_id_photo))
                {{-- IDENTITY VERIFICATION NOTE (OPTIONAL) --}}
                <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                        <div style="font-size:9.5px;font-weight:900;color:#334155;text-transform:uppercase;letter-spacing:.06em;">
                            <i class="fas fa-id-card" style="margin-right:5px;color:var(--brand);"></i> Identity Verification
                        </div>
                        <span style="font-size:8.5px;font-weight:800;background:#f1f5f9;color:#64748b;padding:2px 8px;border-radius:99px;">OPTIONAL / VERIFICATION</span>
                    </div>
                    <p style="font-size:10.5px;color:#64748b;font-weight:600;line-height:1.45;margin-bottom:10px;">
                        Note: For identity verification, you may submit a photo of any valid ID (Student ID, PhilSys, TIN, Voter ID, or any valid Gov't / School ID) so the Barangay Office can verify or update your resident profile.
                    </p>
                    <button type="button" @click="profileModal=false; idUploadModal=true" class="btn-grad btn-sm" style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;margin:0;background:linear-gradient(135deg,#0E5393 0%,#000052 100%);">
                        <i class="fas fa-upload"></i> <span>Upload Valid ID / Proof</span>
                    </button>
                </div>
                @elseif($authUser && ($authUser->voter_status === 'pending' || ($authUser->status === 'pending_verification' && $authUser->voter_status !== 'approved' && $authUser->resident?->verification_status !== 'approved')))
                {{-- ID WAS UPLOADED AND IS PENDING --}}
                <div style="background:#fef3c7;border:1.5px solid #fde68a;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                        <div style="font-size:9.5px;font-weight:900;color:#92400e;text-transform:uppercase;letter-spacing:.06em;">
                            <i class="fas fa-clock" style="margin-right:4px;"></i> ID Verification Pending Approval
                        </div>
                        <span style="font-size:8.5px;font-weight:800;background:#fef9c3;color:#854d0e;padding:2px 7px;border-radius:99px;">FOR OFFICE REVIEW</span>
                    </div>
                    <p style="font-size:10.5px;color:#b45309;font-weight:600;line-height:1.45;margin-bottom:8px;">
                         Your uploaded ID has been submitted and is currently waiting for approval by the Barangay Office.
                    </p>
                    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                        @if($authUser->voter_id_photo)
                            <button type="button" @click="openPhotoModal('{{ asset('storage/'.$authUser->voter_id_photo) }}', 'Uploaded ID Proof')" style="color:#d97706;font-weight:800;font-size:10.5px;text-decoration:underline;display:inline-flex;align-items:center;gap:4px;background:none;border:none;cursor:pointer;padding:0;">
                                <i class="fas fa-image"></i> View Uploaded Photo
                            </button>
                        @endif
                        <button type="button" @click="profileModal=false; idUploadModal=true" style="background:#fff;border:1px solid #cbd5e1;border-radius:6px;padding:3px 9px;font-size:10px;font-weight:700;color:#475569;cursor:pointer;">
                            <i class="fas fa-sync-alt" style="margin-right:3px;"></i> Change / Re-upload ID
                        </button>
                    </div>
                </div>
                @elseif($authUser)
                {{-- APPROVED / ACTIVE RESIDENT (ALLOW UPGRADING VOTER STATUS OR UPDATING ID) --}}
                @php
                    $idPhoto = $authUser->voter_id_photo ?? $authUser->resident?->valid_id_photo ?? null;
                @endphp
                <div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:11px;padding:12px 14px;margin-bottom:14px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                        <div style="display:flex;align-items:center;gap:12px;min-width:0;">
                            @if($idPhoto)
                                <div style="position:relative;cursor:pointer;flex-shrink:0;" @click="openPhotoModal('{{ asset('storage/'.$idPhoto) }}', 'Verified Valid ID Proof')" title="Click to view full ID proof">
                                    <img src="{{ asset('storage/'.$idPhoto) }}" alt="Valid ID Proof" style="width:52px;height:36px;border-radius:6px;object-fit:cover;border:1.5px solid #86efac;box-shadow:0 1px 3px rgba(0,0,0,0.08);" onerror="this.onerror=null; this.style.display='none';">
                                    <div style="position:absolute;bottom:1px;right:1px;background:rgba(0,0,0,0.65);color:#fff;border-radius:3px;font-size:7px;padding:1px 3px;font-weight:900;"><i class="fas fa-search-plus"></i></div>
                                </div>
                            @endif
                            <div style="min-width:0;">
                                <div style="font-size:9.5px;font-weight:900;color:#14532d;text-transform:uppercase;letter-spacing:.06em;display:flex;align-items:center;gap:5px;flex-wrap:wrap;">
                                    <i class="fas fa-certificate" style="color:#16a34a;"></i> ID Verification:
                                    <span style="background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:99px;font-size:9px;font-weight:900;">
                                        <i class="fas fa-check-circle"></i> VERIFIED & APPROVED
                                    </span>
                                </div>
                                <div style="font-size:10px;font-weight:700;color:#166534;margin-top:3px;">
                                    @if($authUser->is_voter)
                                        <i class="fas fa-check-circle"></i> Official Registered Voter of Brgy. San Miguel II
                                    @else
                                        <i class="fas fa-user-check"></i> Verified Resident (Non-Voter)
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">
                            @if($idPhoto)
                                <button type="button" @click="openPhotoModal('{{ asset('storage/'.$idPhoto) }}', 'Verified Valid ID Proof')" style="background:#15803d;border:none;border-radius:6px;padding:5px 12px;font-size:9.5px;font-weight:800;color:#fff;cursor:pointer;display:inline-flex;align-items:center;gap:4px;box-shadow:0 2px 6px rgba(21,128,61,0.25);">
                                    <i class="fas fa-id-card"></i> View ID Proof
                                </button>
                            @endif
                            <button type="button" @click="profileModal=false; idUploadModal=true" style="background:#fff;border:1px solid #86efac;border-radius:6px;padding:4px 10px;font-size:9px;font-weight:700;color:#15803d;cursor:pointer;display:inline-flex;align-items:center;gap:3px;">
                                <i class="fas fa-upload" style="font-size:8.5px;"></i> {{ $idPhoto ? 'Update ID' : 'Upload ID Proof' }}
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                {{-- DIGITAL ID --}}
                <div style="background:linear-gradient(135deg,#eff6ff,#dbeafe);border:1.5px solid #bfdbfe;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#1d4ed8;text-transform:uppercase;letter-spacing:.07em;margin-bottom:10px;"><i class="fas fa-id-card" style="margin-right:4px;"></i> Digital Barangay ID</div>
                    @if($digitalId && $digitalId->status === 'generated')
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                        <div>
                            <span style="font-size:10px;font-weight:900;background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:99px;"><i class="fas fa-check-circle"></i> ID Generated</span>
                            <div style="font-size:10px;color:#64748b;font-weight:600;margin-top:5px;">ID No: <strong style="color:#0f172a;">{{ $digitalId->id_number }}</strong></div>
                        </div>
                        <button type="button" @click="profileModal=false; digitalIdViewModal=true;" class="btn-grad btn-sm"><i class="fas fa-id-card"></i> View Digital ID</button>
                    </div>
                    @elseif($digitalId && $digitalId->status === 'pending')
                    <span style="font-size:10px;font-weight:900;background:#fef3c7;color:#a16207;padding:3px 10px;border-radius:99px;"><i class="fas fa-clock"></i> Pending — Being processed by the office</span>
                    @elseif($authUser && $authUser->resident)
                    <p style="font-size:10px;color:#475569;font-weight:600;margin-bottom:10px;">Request your official Digital Barangay ID.</p>
                    <button type="button" @click.prevent.stop="profileModal=false;digitalIdModal=true" class="btn-grad btn-sm"><i class="fas fa-id-card-alt"></i> Request Digital ID</button>
                    @else
                    <p style="font-size:10px;color:#475569;font-weight:600;margin-bottom:10px;">You must have a verified resident profile on the masterlist to request an ID.</p>
                    <button disabled class="btn-grad btn-sm" style="background:#94a3b8;cursor:not-allowed;box-shadow:none;"><i class="fas fa-lock"></i> Masterlist Verification Required</button>
                    @endif
                </div>

                {{-- MY FAMILY --}}
                @php 
                    $userResId = $authUser?->resident?->id 
                        ?? \App\Models\Resident::where('user_id', $authUser?->id ?? -1)->value('id') 
                        ?? ($authUser?->resident_code ? \App\Models\Resident::where('resident_code', $authUser->resident_code)->value('id') : null)
                        ?? -1;
                    $myFamily = \App\Models\Resident::where('household_head_id', $userResId)
                        ->where('id', '!=', $userResId)
                        ->get(); 
                @endphp
                <div>
                    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:11px;padding:12px;margin-bottom:14px;">
                        <div style="font-size:9px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;display:flex;align-items:center;justify-content:space-between;">
                            <span><i class="fas fa-users" style="color:var(--brand);margin-right:4px;"></i> My Family</span>
                        </div>
                        <div style="display:flex;flex-wrap:wrap;">
                            @forelse($myFamily as $fm)
                            <div style="display:inline-flex;align-items:center;gap:5px;border-radius:99px;padding:4px 10px;font-size:10px;font-weight:800;margin:3px;background:#f1f5f9;color:#334155;border:1px solid #cbd5e1;flex-wrap:wrap;">
                                <i class="fas fa-user" style="font-size:8px;"></i>
                                {{ $fm->first_name }} {{ $fm->last_name }} ({{ $fm->relationship ?? 'Member' }})
                                @if($fm->is_voter)<span style="font-size:8px;background:#dbeafe;color:#1d4ed8;padding:1px 6px;border-radius:99px;font-weight:900;">Voter</span>@endif
                                @if($fm->is_senior)<span style="font-size:8px;background:#ffedd5;color:#ea580c;padding:1px 6px;border-radius:99px;font-weight:900;">Senior</span>@endif
                                @if($fm->is_pwd)<span style="font-size:8px;background:#ede9fe;color:#7c3aed;padding:1px 6px;border-radius:99px;font-weight:900;">PWD</span>@endif
                                @if($fm->is_bedridden)<span style="font-size:8px;background:#fee2e2;color:#dc2626;padding:1px 6px;border-radius:99px;font-weight:900;">Bed-ridden</span>@endif
                                @if($fm->is_single_parent)<span style="font-size:8px;background:#fce7f3;color:#be185d;padding:1px 6px;border-radius:99px;font-weight:900;">Solo Parent</span>@endif
                                @if($fm->is_student)<span style="font-size:8px;background:#fef3c7;color:#a16207;padding:1px 6px;border-radius:99px;font-weight:900;">Student</span>@endif
                                @if($fm->verification_status === 'pending')<span style="font-size:8px;opacity:.8;color:#d97706;background:#fef3c7;padding:1px 4px;border-radius:3px;margin-left:4px;" title="Awaiting office approval">(Pending)</span>@endif
                            </div>
                            @empty
                            <span style="font-size:10px;color:var(--light);font-weight:600;">No family members added.</span>
                            @endforelse
                        </div>
                        <button type="button" @click="isPendingVerification ? (profileModal=false, pendingLockModal=true) : (profileModal=false, familyModal=true)"
                                style="margin-top:9px;background:none;border:1.5px dashed var(--brand);color:var(--brand);font-size:10px;font-weight:800;padding:5px 12px;border-radius:99px;cursor:pointer;font-family:inherit;display:inline-flex;align-items:center;gap:4px;transition:all 0.2s;" onmouseover="this.style.background='var(--brand)';this.style.color='#fff'" onmouseout="this.style.background='none';this.style.color='var(--brand)'">
                            <i class="fas fa-user-plus" style="font-size:8px;"></i> Add Family Member
                        </button>
                    </div>

                </div>

                {{-- PETS --}}
                @php $myPets = $authUser?->pets ?? collect(); @endphp
                <div x-data="{ petStatusModal: false, editingPet: null }">
                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:11px;padding:12px;margin-bottom:14px;">
                        <div style="font-size:9px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;display:flex;align-items:center;justify-content:space-between;">
                            <span><i class="fas fa-paw" style="color:var(--brand);margin-right:4px;"></i> My Pets</span>
                        </div>
                        <div style="display:flex;flex-wrap:wrap;">
                            @forelse($myPets as $pet)
                            <div style="display:inline-flex;align-items:center;gap:5px;border-radius:99px;padding:4px 10px;font-size:10px;font-weight:800;margin:3px;{{ $pet->status === 'deceased' ? 'background:#f1f5f9;color:#94a3b8;border:1px solid #e2e8f0;' : 'background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;' }}">
                                <i class="fas fa-paw" style="font-size:8px;"></i>
                                {{ $pet->pet_name ?? $pet->pet_type }}
                                @if($pet->status === 'deceased')<span style="font-size:8px;opacity:.7;">(Deceased)</span>@endif
                                @if($pet->vaccination_status === 'pending')<span style="font-size:8px;opacity:.8;color:#d97706;background:#fef3c7;padding:1px 4px;border-radius:3px;margin-left:4px;">(Pending Verification)</span>@endif
                                @if($pet->vaccination_status === 'verified')<span style="font-size:8px;opacity:.8;color:#15803d;background:#dcfce7;padding:1px 4px;border-radius:3px;margin-left:4px;"><i class="fas fa-check-circle"></i> Verified</span>@endif
                                @if($pet->vaccination_status === 'rejected')
                                    <span style="font-size:8px;opacity:.9;color:#dc2626;background:#fee2e2;padding:2px 7px;border-radius:99px;margin-left:4px;cursor:help;display:inline-flex;align-items:center;gap:3px;" 
                                          @click.stop="editingPet={{ json_encode($pet) }}; petStatusModal=true"
                                          title="Click to view rejection reason">
                                        <i class="fas fa-exclamation-circle"></i> Rejected
                                    </span>
                                @endif
                                <button @click="editingPet={{ json_encode($pet) }}; petStatusModal=true"
                                        style="background:none;border:none;cursor:pointer;color:inherit;font-size:9px;padding:0 0 0 3px;" title="View Pet Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ url('/pets/'.$pet->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Archive this pet?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background:none;border:none;cursor:pointer;color:inherit;font-size:9px;padding:0 0 0 3px;" title="Archive request">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </form>
                            </div>
                            @empty
                            <span style="font-size:10px;color:var(--light);font-weight:600;">No pets registered yet.</span>
                            @endforelse
                        </div>
                        <button @click="isPendingVerification ? (profileModal=false, pendingLockModal=true) : (profileModal=false, petModal=true)"
                                style="margin-top:9px;background:none;border:1.5px dashed var(--brand);color:var(--brand);font-size:10px;font-weight:800;padding:5px 12px;border-radius:99px;cursor:pointer;font-family:inherit;display:inline-flex;align-items:center;gap:4px;transition:all 0.2s;" onmouseover="this.style.background='var(--brand)';this.style.color='#fff'" onmouseout="this.style.background='none';this.style.color='var(--brand)'">
                            <i class="fas fa-plus" style="font-size:8px;"></i> Add Pet
                        </button>
                    </div>

                    {{-- PET DETAILS & STATUS MODAL --}}
                    <div x-show="petStatusModal" x-cloak class="modal-ov" x-transition style="z-index:400;">
                        <div class="modal-box" style="max-width:440px;" @click.away="petStatusModal=false">
                            <div class="modal-in" x-data="{ vStatusUpdate: 'unvaccinated', petPhotoPreview: null }">
                                <div class="modal-hd">
                                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-paw"></i></div> Pet Details</div>
                                    <button @click="petStatusModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                                </div>
                                
                                <template x-if="editingPet">
                                    <form :action="'/resident/pet/'+editingPet.id" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div style="display:flex;gap:14px;margin-bottom:18px;align-items:center;background:#f8fafc;padding:12px;border-radius:12px;border:1px solid var(--border);">
                                            <div style="position:relative; width:70px; height:70px; flex-shrink:0;">
                                                <div style="width:100%;height:100%;border-radius:10px;overflow:hidden;border:2px solid #fff;box-shadow:var(--card-shadow);">
                                                    <img :src="petPhotoPreview || (editingPet.pet_photo ? '/storage/'+editingPet.pet_photo : 'https://ui-avatars.com/api/?name='+encodeURIComponent(editingPet.pet_name)+'&background=0E5393&color=fff&size=128&bold=true')"
                                                         style="width:100%;height:100%;object-fit:cover;">
                                                </div>
                                                <button type="button" style="position:absolute;bottom:-4px;right:-4px;background:var(--brand);color:#fff;border:none;border-radius:50%;width:24px;height:24px;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 5px rgba(0,0,0,0.3);z-index:10;"
                                                        @click="warningType='pet'; warningNextDate='{{ now()->addMonths(6)->format('M d, Y') }}'; photoWarningModal=true;" title="Update Pet Photo">
                                                    <i class="fas fa-camera" style="font-size:10px;"></i>
                                                </button>
                                                <input type="file" name="pet_photo" id="petPhotoInput" style="display:none;" accept="image/*"
                                                       @change="const f=$event.target.files[0]; if(f){ if(f.size > 5*1024*1024){ alert('File exceeds 5MB limit. Please upload an image under 5MB.'); $event.target.value=''; return; } const r=new FileReader(); r.onload=e=>petPhotoPreview=e.target.result; r.readAsDataURL(f); }">
                                            </div>
                                            <div>
                                                <div style="font-size:15px;font-weight:900;color:var(--text);" x-text="editingPet.pet_name"></div>
                                                <div style="font-size:10px;font-weight:700;color:var(--brand);text-transform:uppercase;" x-text="editingPet.pet_type + (editingPet.breed ? ' • ' + editingPet.breed : '')"></div>
                                                <div style="font-size:9px;color:var(--muted);font-weight:600;margin-top:2px;">
                                                    Age: <span x-text="editingPet.age || 0"></span>y <span x-text="editingPet.months || 0"></span>m
                                                </div>
                                            </div>
                                        </div>

                                        <div style="margin-bottom:16px;">
                                            <label class="flbl">Current Health Status</label>
                                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                                                <label style="cursor:pointer;">
                                                    <input type="radio" name="status" value="alive" x-model="editingPet.status" style="display:none;">
                                                    <div style="border:2px solid var(--border);border-radius:10px;padding:10px;text-align:center;transition:all .15s;"
                                                         :style="editingPet.status==='alive'?'border-color:#15803d;background:#dcfce7;':''">
                                                        <i class="fas fa-heart" style="color:#15803d;font-size:16px;display:block;margin-bottom:4px;"></i>
                                                        <div style="font-size:10px;font-weight:900;color:#15803d;">Alive & Well</div>
                                                    </div>
                                                </label>
                                                <label style="cursor:pointer;">
                                                    <input type="radio" name="status" value="deceased" x-model="editingPet.status" style="display:none;">
                                                    <div style="border:2px solid var(--border);border-radius:10px;padding:10px;text-align:center;transition:all .15s;"
                                                         :style="editingPet.status==='deceased'?'border-color:#94a3b8;background:#f1f5f9;':''">
                                                        <i class="fas fa-dove" style="color:#94a3b8;font-size:16px;display:block;margin-bottom:4px;"></i>
                                                        <div style="font-size:10px;font-weight:900;color:#94a3b8;">Crossed the Bridge</div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <div x-show="editingPet.vaccination_status === 'unvaccinated' || editingPet.vaccination_status === 'rejected'" style="background:#f8fafc;padding:12px;border-radius:12px;border:1.5px dashed var(--border);margin-bottom:16px;">
                                            <template x-if="editingPet.vaccination_status === 'rejected'">
                                                <div style="margin-bottom:12px; padding:10px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px;">
                                                    <div style="font-size:9px; font-weight:900; color:#dc2626; text-transform:uppercase; margin-bottom:4px; display:flex; align-items:center; gap:5px;">
                                                        <i class="fas fa-exclamation-triangle"></i> Rejection Reason:
                                                    </div>
                                                    <div style="font-size:11px; color:#991b1b; font-weight:700; line-height:1.4;" x-text="editingPet.rejection_reason || 'No reason provided.'"></div>
                                                </div>
                                            </template>

                                            <label class="flbl" x-text="editingPet.vaccination_status === 'rejected' ? 'Resubmit Vaccination Proof?' : 'Is your pet vaccinated now?'"></label>
                                            <select name="vaccination_status" class="finput" x-model="vStatusUpdate">
                                                <option value="unvaccinated">No, not yet</option>
                                                <option value="pending" x-text="editingPet.vaccination_status === 'rejected' ? 'Yes, Resubmit Updated Proof' : 'Yes, Update Vaccination Record'"></option>
                                            </select>
                                            
                                            <div x-show="vStatusUpdate === 'pending'" style="margin-top:10px;">
                                                <label class="flbl">Upload Vaccine Proof * <span style="font-size:9px;color:var(--muted);font-weight:600;">(Max: 5MB — JPG, PNG, PDF)</span></label>
                                                <input type="file" name="vaccine_proof" class="finput" accept="image/*,.pdf" :required="vStatusUpdate === 'pending'"
                                                       @change="if($event.target.files[0] && $event.target.files[0].size > 5*1024*1024){ alert('File exceeds 5MB limit. Please upload a file under 5MB.'); $event.target.value=''; }">
                                                <p style="font-size:8px;color:var(--muted);margin-top:4px;">New proof will be reviewed by the office.</p>
                                            </div>
                                        </div>

                                        <div x-show="editingPet.vaccination_status === 'verified'" style="margin-bottom:16px;">
                                            <div style="display:flex;align-items:center;gap:8px;padding:10px;background:#dcfce7;border:1px solid #bbf7d0;border-radius:10px;color:#15803d;">
                                                <i class="fas fa-check-circle"></i>
                                                <div style="font-size:10px;font-weight:800;">Vaccination Verified by Office</div>
                                            </div>
                                        </div>

                                        <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:20px;">
                                            <button type="button" @click="petStatusModal=false" class="btn-plain btn-ghost btn-sm">Cancel</button>
                                            <button type="submit" class="btn-grad btn-sm"><i class="fas fa-save"></i> Save Changes</button>
                                        </div>
                                    </form>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    {{-- VIEW PHOTO PREVIEW MODAL --}}
    <div x-show="viewPhotoModal" x-cloak class="modal-ov" style="z-index: 9999999;" @keydown.window.escape="viewPhotoModal=false" @click.self="viewPhotoModal=false">
        <div class="modal-box" style="max-width: 560px; width: 95%; background: #fff; border-radius: 18px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.5);">
            <div class="modal-hd" style="background: linear-gradient(135deg, #0E5393 0%, #000052 100%); padding: 14px 18px; color: #fff; display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: .05em; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-id-card"></i> <span x-text="photoModalTitle">Uploaded ID Proof</span>
                </span>
                <button type="button" @click="viewPhotoModal = false" title="Close (Esc)" style="background: rgba(255,255,255,0.15); border: none; color: #fff; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .15s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div style="padding: 18px; text-align: center; background: #0b1120; min-height: 240px; display: flex; align-items: center; justify-content: center;">
                <template x-if="photoModalUrl && photoModalUrl.toLowerCase().split('?')[0].endsWith('.pdf')">
                    <iframe :src="photoModalUrl" style="width: 100%; height: 65vh; border: none; border-radius: 8px; background: #fff;"></iframe>
                </template>
                <template x-if="!photoModalUrl || !photoModalUrl.toLowerCase().split('?')[0].endsWith('.pdf')">
                    <img :src="photoModalUrl" alt="ID Proof" style="max-width: 100%; max-height: 65vh; border-radius: 8px; object-fit: contain; box-shadow: 0 8px 30px rgba(0,0,0,0.5);">
                </template>
            </div>
            <div style="padding: 12px 18px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span style="font-size: 11px; color: #64748b; font-weight: 600;">
                    <i class="fas fa-shield-alt" style="color:var(--brand);"></i> Verification Document Preview
                </span>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <a :href="photoModalUrl" target="_blank" class="btn-plain btn-ghost btn-sm" style="background:#eff6ff; color:#0E5393; font-weight:800; padding:6px 14px; border-radius:8px; cursor:pointer; font-size:11px; display:inline-flex; align-items:center; gap:6px; text-decoration:none;">
                        <i class="fas fa-external-link-alt"></i> Open Tab
                    </a>
                    <button type="button" @click="viewPhotoModal = false" class="btn-plain btn-ghost btn-sm" style="background:#e2e8f0; color:#1e293b; font-weight:800; padding:6px 16px; border-radius:8px; cursor:pointer; font-size:11px; display:inline-flex; align-items:center; gap:6px;">
                        <i class="fas fa-arrow-left"></i> Close / Bumalik
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- UPLOAD / CHANGE VERIFICATION ID MODAL --}}
    <div x-show="idUploadModal" x-cloak class="modal-ov" x-transition style="z-index: 999999;">
        <div class="modal-box" style="max-width:480px; border-radius:18px; overflow:hidden;" @click.away="idUploadModal=false">
            <div class="modal-in" style="padding:0;">
                <div class="modal-hd" style="background:linear-gradient(135deg,#0E5393 0%,#000052 100%); padding:16px 20px; color:#fff; display:flex; align-items:center; justify-content:space-between;">
                    <div class="modal-ttl" style="color:#fff; display:flex; align-items:center; gap:8px; font-size:13px; font-weight:900; text-transform:uppercase; letter-spacing:.04em;">
                        <i class="fas fa-id-card" style="font-size:16px;"></i>
                        <span>Identity Verification Proof</span>
                    </div>
                    <button type="button" @click="idUploadModal=false; profileModal=true;" style="background:none; border:none; color:#fff; font-size:18px; cursor:pointer; opacity:.85;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='.85'">&times;</button>
                </div>

                <form action="{{ route('resident.voter.upload') }}" method="POST" enctype="multipart/form-data" style="padding:20px;" x-data="{ isDragging: false }">
                    @csrf
                    
                    <div style="background:#f0f9ff; border:1px solid #bae6fd; border-radius:10px; padding:12px; margin-bottom:16px;">
                        <p style="font-size:11px; color:#0369a1; font-weight:600; line-height:1.45; margin:0;">
                            <i class="fas fa-info-circle" style="margin-right:4px;"></i> 
                            Please select the type of ID you are submitting and attach a clear image. This helps the Barangay Office verify and update your resident profile.
                        </p>
                    </div>

                    {{-- 1. SELECT ID TYPE --}}
                    <div style="margin-bottom:14px;">
                        <label class="flbl" style="font-size:10.5px; font-weight:800; color:#1e293b; margin-bottom:6px; display:block;">
                            1. Select ID / Document Type <span style="color:#e11d48;">*</span>
                        </label>
                        <select name="id_type" x-model="selectedIdType" class="finput" style="width:100%; font-size:11.5px; font-weight:700; padding:9px 12px; border-radius:8px; border:1.5px solid #cbd5e1;" required>
                            <option value="PhilSys National ID">PhilSys National ID</option>
                            <option value="Student ID">Student ID</option>
                            <option value="TIN ID">TIN ID</option>
                            <option value="Voter's ID / Certification">Voter's ID / COMELEC Certification</option>
                            <option value="Driver's License">Driver's License</option>
                            <option value="Passport">Passport</option>
                            <option value="SSS / UMID / GSIS">SSS / UMID / GSIS</option>
                            <option value="Postal ID">Postal ID</option>
                            <option value="Senior Citizen / PWD / Solo Parent ID">Senior Citizen / PWD / Solo Parent ID</option>
                            <option value="Barangay Certificate / Proof of Residency">Barangay Certificate / Proof of Residency</option>
                            <option value="Other">Other (Please Specify)</option>
                        </select>
                        
                        {{-- SPECIFY FIELD IF OTHER --}}
                        <div x-show="selectedIdType === 'Other'" x-cloak style="margin-top:8px;">
                            <input type="text" name="id_type_other" x-model="otherIdType" placeholder="Specify ID type (e.g. Employee ID, PRC ID, NBI Clearance)..." class="finput" style="width:100%; font-size:11px; padding:8px 12px; border-radius:8px; border:1.5px solid #93c5fd;">
                        </div>
                    </div>

                    {{-- 2. UPLOAD ID PHOTO --}}
                    <div style="margin-bottom:18px;">
                        <label class="flbl" style="font-size:10.5px; font-weight:800; color:#1e293b; margin-bottom:6px; display:block;">
                            2. Upload Photo of ID / Document <span style="color:#e11d48;">*</span>
                            <span style="font-size:9.5px;color:var(--brand);font-weight:700;margin-left:6px;">(Max: 5MB — JPG, PNG, WEBP)</span>
                        </label>
                        <input type="file" name="voter_id_photo" x-ref="idModalFileInput" id="idModalFileInput" required accept="image/*" style="display:none;" 
                               @change="if($event.target.files[0]) {
                                   let f = $event.target.files[0];
                                   if(f.size > 5*1024*1024){
                                       alert('Masyadong malaki ang litrato ng ID ('+(f.size/1024/1024).toFixed(1)+'MB)! Ang maximum allowed size ay 5MB lamang.');
                                       $event.target.value='';
                                       idPreviewUrl=null;
                                       return;
                                   }
                                   let reader = new FileReader();
                                   reader.onload = (e) => { idPreviewUrl = e.target.result; };
                                   reader.readAsDataURL(f);
                               }">

                        <div @click="$refs.idModalFileInput.click()" 
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.idModalFileInput.files = $event.dataTransfer.files; $refs.idModalFileInput.dispatchEvent(new Event('change')); }"
                             :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                             style="border:2px dashed #94a3b8; border-radius:12px; padding:18px; text-align:center; cursor:pointer; background:#f8fafc; transition:all 0.2s;">
                            
                            <template x-if="!idPreviewUrl">
                                <div>
                                    <div style="width:42px; height:42px; border-radius:50%; background:#e2e8f0; color:#475569; display:inline-flex; align-items:center; justify-content:center; font-size:18px; margin-bottom:8px;">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <div style="font-size:11.5px; font-weight:800; color:#1e293b;">Click or Drag & Drop photo here</div>
                                    <div style="font-size:9.5px; color:#64748b; margin-top:2px;">Supports JPG, PNG, WEBP (Max 5MB)</div>
                                </div>
                            </template>

                            <template x-if="idPreviewUrl">
                                <div>
                                    <img :src="idPreviewUrl" alt="ID Preview" style="max-height:160px; max-width:100%; border-radius:8px; object-fit:contain; box-shadow:0 2px 8px rgba(0,0,0,0.15); margin-bottom:8px;">
                                    <div style="font-size:10.5px; font-weight:800; color:var(--brand);"><i class="fas fa-check-circle"></i> Photo Selected (Click to change)</div>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div style="display:flex; gap:10px; justify-content:flex-end;">
                        <button type="button" @click="idUploadModal=false; profileModal=true;" class="btn-plain btn-ghost btn-sm" style="font-weight:700;">Cancel</button>
                        <button type="submit" class="btn-grad btn-sm" style="background:linear-gradient(135deg,#0E5393 0%,#000052 100%); padding:8px 20px; font-weight:800; font-size:11px; display:inline-flex; align-items:center; gap:6px;">
                            <i class="fas fa-upload"></i> Submit Verification ID
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ADD PET MODAL --}}
    <div x-show="petModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="max-width:460px;" @click.away="petModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-paw"></i></div><div>Register My Pet</div></div>
                    <button @click="petModal=false;profileModal=true" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" x-data="{ petPhotoPreview: null, vaccineProofPreview: null, vStatus: 'unvaccinated', petTypeOther: false }">
                    @csrf
                    <input type="hidden" name="resident_id" value="{{ $authUser?->resident?->id ?? '' }}">
                    
                    <div style="display:flex;gap:12px;margin-bottom:12px;align-items:flex-start;">
                        {{-- Pet Photo --}}
                        <div style="flex-shrink:0;" x-data="{ isDragging: false }">
                            <label class="flbl">Pet Photo (1x1) <span style="font-size:9px;color:var(--muted);font-weight:600;">(Max: 5MB)</span></label>
                            <label style="cursor:pointer;display:block;">
                                <div style="width:70px;height:70px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;"
                                     :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ if($event.dataTransfer.files[0].size > 5*1024*1024){ alert('File exceeds 5MB limit. Please upload an image under 5MB.'); return; } $refs.petPhotoInput.files = $event.dataTransfer.files; $refs.petPhotoInput.dispatchEvent(new Event('change')); }">
                                    <template x-if="petPhotoPreview">
                                        <img :src="petPhotoPreview" style="width:100%;height:100%;object-fit:cover;">
                                    </template>
                                    <template x-if="!petPhotoPreview">
                                        <div style="text-align:center;">
                                            <i class="fas fa-camera" style="color:var(--light);font-size:16px;margin-bottom:2px;"></i>
                                            <div style="font-size:7px;font-weight:800;color:var(--muted);text-transform:uppercase;">Click or Drag</div>
                                        </div>
                                    </template>
                                </div>
                                <input type="file" name="pet_photo" x-ref="petPhotoInput" accept="image/*" style="display:none;" 
                                       @change="const f=$event.target.files[0]; if(f){ if(f.size > 5*1024*1024){ alert('File exceeds 5MB limit. Please upload an image under 5MB.'); $event.target.value=''; return; } const r=new FileReader(); r.onload=e=>petPhotoPreview=e.target.result; r.readAsDataURL(f) }">
                            </label>
                        </div>
                        <div style="flex:1;">
                            <label class="flbl">Pet Name *</label>
                            <input type="text" name="pet_name" required class="finput" placeholder="e.g. Browny">
                        </div>
                    </div>

                    <div class="fgrp">
                        <label class="flbl">Pet Type</label>
                        <style>
                            .pet-type-card { border:2px solid var(--border);border-radius:9px;padding:8px 5px;text-align:center;font-size:10px;font-weight:800;color:var(--muted);cursor:pointer;transition:all .12s; }
                            .pet-type-card:hover { border-color:var(--brand); background:#eff6ff; color:var(--brand); }
                            input[name="pet_type"]:checked + .pet-type-card { border-color:var(--brand) !important; background:var(--brand) !important; color:#fff !important; }
                        </style>
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-bottom:7px;">
                            @foreach(['Dog'=>'🐶','Cat'=>'🐱','Bird'=>'🐦','Rabbit'=>'🐰','Fish'=>'🐟','Others'=>'➕'] as $type=>$emoji)
                            <label style="cursor:pointer;">
                                <input type="radio" name="pet_type" value="{{ $type }}" style="display:none;" @change="petTypeOther = ($event.target.value === 'Others')" required>
                                <div class="pet-type-card">
                                    {{ $emoji }} {{ $type }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <div x-show="petTypeOther"><input type="text" name="pet_type_other" placeholder="Specify pet type..." class="finput"></div>
                    </div>
                    <div class="fgrid3" style="gap:10px;margin-bottom:11px;">
                        <div><label class="flbl">Breed</label><input type="text" name="breed" placeholder="e.g. Aspin" class="finput"></div>
                        <div><label class="flbl">Age (yrs)</label><input type="number" name="age" min="0" class="finput"></div>
                        <div><label class="flbl">Months</label><input type="number" name="months" min="0" max="11" class="finput"></div>
                    </div>
                    <div class="fgrp">
                        <label class="flbl">Vaccination Status</label>
                        <select name="vaccination_status" class="finput fselect" x-model="vStatus">
                            <option value="unvaccinated">Unvaccinated</option>
                            <option value="pending">Vaccinated (Need Verification)</option>
                        </select>
                        <div x-show="vStatus === 'pending'" x-transition style="margin-top:10px;" x-data="{ isDragging: false }">
                            <label class="flbl">Upload Vaccine Proof (Card/Record) * <span style="font-size:9px;color:var(--muted);font-weight:600;">(Max: 5MB — JPG, PNG, PDF)</span></label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:100px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;"
                                     :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ if($event.dataTransfer.files[0].size > 5*1024*1024){ alert('File exceeds 5MB limit. Please upload a file under 5MB.'); return; } $refs.vaccineInput.files = $event.dataTransfer.files; $refs.vaccineInput.dispatchEvent(new Event('change')); }">
                                    <template x-if="vaccineProofPreview">
                                        <img :src="vaccineProofPreview" style="width:100%;height:100%;object-fit:contain;">
                                    </template>
                                    <template x-if="!vaccineProofPreview">
                                        <div style="text-align:center;">
                                            <i class="fas fa-file-medical" style="color:var(--brand);font-size:22px;margin-bottom:5px;"></i>
                                            <div style="font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;">Click or Drag Vaccine Card</div>
                                        </div>
                                    </template>
                                </div>
                                <input type="file" name="vaccine_proof" x-ref="vaccineInput" accept="image/*,.pdf" style="display:none;" :required="vStatus === 'pending'"
                                       @change="const f=$event.target.files[0]; if(f){ if(f.size > 5*1024*1024){ alert('File exceeds 5MB limit. Please upload a file under 5MB.'); $event.target.value=''; return; } const r=new FileReader(); r.onload=e=>vaccineProofPreview=e.target.result; r.readAsDataURL(f) }">
                            </label>
                            <p style="font-size:8px;color:var(--muted);margin-top:5px;"><i class="fas fa-info-circle"></i> The status will remain 'Pending' until the office verifies the record.</p>
                        </div>
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:8px;">
                        <button type="button" @click="petModal=false;profileModal=true" class="btn-plain btn-ghost">Cancel</button>
                        <button type="submit" class="btn-grad"><i class="fas fa-paw"></i> Register Pet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DIGITAL ID REQUEST MODAL --}}
    <div x-show="digitalIdModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="max-width:460px;" @click.away="digitalIdModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-id-card-alt"></i></div><div>Request Digital Barangay ID</div></div>
                    <button @click="digitalIdModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <form action="{{ route('resident.digital.id.request') }}" method="POST">
                    @csrf
                    <div class="sblk">
                        <div class="sblk-ttl"><i class="fas fa-phone"></i> Emergency Contact</div>
                        <div class="fgrp"><label class="flbl">Contact Person *</label><input type="text" name="contact_person" required class="finput" placeholder="e.g. Maria Dela Cruz"></div>
                        <div class="fgrp"><label class="flbl">Contact Number *</label><input type="text" name="contact_person_number" required class="finput" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');"></div>
                    </div>
                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:9px;padding:10px 14px;margin-bottom:13px;font-size:10px;font-weight:700;color:#1d4ed8;line-height:1.5;">
                        <i class="fas fa-info-circle" style="margin-right:4px;"></i> 
                        <strong>Note:</strong> Digital ID Request is strictly for <strong>bonafide residents</strong> of Barangay San Miguel II only. The office will review and generate your Digital ID. You'll be notified once it's ready.
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:8px;">
                        <button type="button" @click="digitalIdModal=false;profileModal=true" class="btn-plain btn-ghost">Cancel</button>
                        <button type="submit" class="btn-grad"><i class="fas fa-paper-plane"></i> Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DIGITAL ID VIEW MODAL --}}
    @if($digitalId && $digitalId->status === 'generated')
    @php
        $idUser = $authUser;
        $idFullName = strtoupper(($idUser?->first_name??'').' '.($idUser?->middle_name ? $idUser->middle_name.' ' : '').($idUser?->last_name??''));
        $idAddress = $idUser?->address ?? 'BARANGAY SAN MIGUEL II DASMARIÑAS CAVITE';
        $idBirthday = $idUser?->birthday ? \Carbon\Carbon::parse($idUser->birthday)->format('F j, Y') : 'N/A';
        $idPhotoFallback = 'https://ui-avatars.com/api/?name='.urlencode(($idUser?->first_name??'R').' '.($idUser?->last_name??'')).'&background=0E5393&color=fff&size=128&bold=true';
        $idPhoto = $idUser?->profile_photo_url ?? $idPhotoFallback;
        $idCode = $idUser?->resident_code ?? $digitalId->id_number;
        $idIssued = \Carbon\Carbon::parse($digitalId->created_at)->format('m/d/Y');
        $idValid = \Carbon\Carbon::parse($digitalId->created_at)->addYears(3)->format('m/d/Y');
    @endphp
    <div x-show="digitalIdViewModal" x-cloak class="modal-ov" style="z-index:99999;">
        <div class="modal-box" style="max-width:480px;">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-id-card"></i></div><div>Digital Barangay ID</div></div>
                    <button @click="digitalIdViewModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                {{-- Front/Back Toggle --}}
                <div style="display:flex;gap:7px;margin-bottom:14px;justify-content:center;">
                    <button @click="idView='front'" :class="idView==='front'?'btn-grad btn-sm':'btn-plain btn-edit'" style="min-width:90px;"><i class="fas fa-id-card"></i> Front</button>
                    <button @click="idView='back'" :class="idView==='back'?'btn-grad btn-sm':'btn-plain btn-edit'" style="min-width:90px;"><i class="fas fa-qrcode"></i> Back</button>
                </div>

                {{-- FRONT & BACK CARD CONTAINER --}}
                <div style="width:100%; overflow-x:auto; -webkit-overflow-scrolling:touch; padding:4px 0;">
                {{-- FRONT CARD: 3-ROW EXACT STRUCTURE --}}
                <div x-show="idView==='front'" style="width:100%;max-width:440px;min-width:320px;height:270px;border:1.5px solid #000;border-radius:10px;overflow:hidden;background:#ffffff url('{{ asset('images/id_front_bg.jpg') }}') center/cover no-repeat;font-family:Arial,Helvetica,sans-serif;box-shadow:0 6px 18px rgba(0,0,0,0.15);margin:0 auto;box-sizing:border-box;padding:10px 14px 4px;display:flex;flex-direction:column;justify-content:space-between;">
                    {{-- 1. Top Header --}}
                    <div style="display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:6px;">
                        <img src="{{ asset('images/dasma.png') }}" style="width:38px;height:38px;object-fit:contain;flex-shrink:0;" onerror="this.style.display='none'">
                        <div style="text-align:center;line-height:1.15;">
                            <div style="font-size:7px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.03em;">REPUBLIC OF THE PHILIPPINES</div>
                            <div style="font-size:7px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.03em;">PROVINCE OF CAVITE</div>
                            <div style="font-size:7px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.03em;">CITY OF DASMARIÑAS</div>
                            <div style="font-size:12.5px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.02em;margin-top:1px;">BARANGAY SAN MIGUEL 2</div>
                        </div>
                        <img src="{{ asset('images/circlelogo.png') }}" style="width:38px;height:38px;object-fit:contain;flex-shrink:0;" onerror="this.style.display='none'">
                    </div>

                    {{-- 2. Center: Photo + ID No on Left, Details on Right (Photo aligned with Name) --}}
                    <div style="display:flex;gap:12px;align-items:flex-start;margin-top:2px;">
                        <div style="width:85px;flex-shrink:0;text-align:center;padding-top:11px;">
                            <div style="width:80px;height:80px;aspect-ratio:1/1;border:1px solid #000;border-radius:0;overflow:hidden;background:#e8e8e8;position:relative;display:flex;align-items:center;justify-content:center;margin:0 auto;">
                                <img src="{{ $idPhoto }}" onerror="this.onerror=null; this.src='{{ $idPhotoFallback }}';" style="width:100%;height:100%;aspect-ratio:1/1;object-fit:cover;">
                            </div>
                            <div style="font-size:6.5px;font-weight:900;color:#000;text-transform:uppercase;margin-top:2px;letter-spacing:0.03em;">BARANGAY ID NO.</div>
                            <div style="font-size:7.5px;font-weight:900;color:#000;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:85px;margin:1px auto 0;">{{ $idCode }}</div>
                        </div>
                        <div style="flex:1;min-width:0;padding-top:11px;">
                            <div style="font-size:7.5px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:2px;">RESIDENCE IDENTIFICATION CARD</div>
                            <div style="font-size:13px;font-weight:900;color:#000;text-transform:uppercase;line-height:1.15;margin-bottom:5px;word-break:break-word;" x-text="'{{ $idFullName }}'"></div>
                            <div style="font-size:6.5px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1px;">ADDRESS:</div>
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;line-height:1.3;margin-bottom:5px;word-break:break-word;" x-text="'{{ strtoupper($idAddress) }}'"></div>
                            <div style="font-size:6.5px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:1px;">DATE OF BIRTH:</div>
                            <div style="font-size:9.5px;font-weight:900;color:#000;text-transform:uppercase;" x-text="'{{ strtoupper($idBirthday) }}'"></div>
                        </div>
                    </div>

                    {{-- 3. Bottom: Signature on Left, Date Issue in Center, Valid Until on Right (further down at bottom edge) --}}
                    <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:10px;margin-top:auto;padding-bottom:0px;margin-bottom:0px;">
                        <div style="width:90px;text-align:center;">
                            <div style="border-top:1.5px solid #000;width:80px;margin:0 auto;padding-top:1px;">
                                <div style="font-size:6px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.05em;">SIGNATURE</div>
                            </div>
                        </div>
                        <div style="text-align:left;">
                            <div style="font-size:6px;font-weight:800;color:#000;text-transform:uppercase;letter-spacing:0.05em;">DATE ISSUE</div>
                            <div style="font-size:8.5px;font-weight:900;color:#000;">{{ $idIssued }}</div>
                        </div>
                        <div style="text-align:right;padding-right:4px;">
                            <div style="font-size:6px;font-weight:800;color:#000;text-transform:uppercase;letter-spacing:0.05em;">VALID UNTIL</div>
                            <div style="font-size:8.5px;font-weight:900;color:#000;">{{ $idValid }}</div>
                        </div>
                    </div>
                </div>

                {{-- BACK CARD --}}
                <div x-show="idView==='back'" style="width:100%;max-width:440px;height:270px;border:1.5px solid #000;border-radius:10px;overflow:hidden;background:#fff;font-family:Arial,Helvetica,sans-serif;position:relative;margin:0 auto;box-sizing:border-box;padding:12px 14px;box-shadow:0 6px 18px rgba(0,0,0,0.15);display:flex;flex-direction:column;justify-content:space-between;">
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:0.38;pointer-events:none;z-index:0;">
                        <img src="{{ asset('images/circlelogo.png') }}" style="width:210px;height:210px;object-fit:contain;" onerror="this.src='{{ asset('images/brgysm2_logo.png') }}'">
                    </div>
                    <div style="position:relative;z-index:1;display:flex;flex-direction:column;height:100%;justify-content:space-between;">
                        <div style="border:1.5px solid #000;border-radius:0;padding:5px 8px;background:rgba(255,255,255,0.7);text-align:center;margin-bottom:8px;">
                            <div style="font-size:7.5px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.04em;">— CONTACT PERSON IN CASE OF EMERGENCY —</div>
                            <div style="font-size:11px;font-weight:900;color:#000;text-transform:uppercase;margin:1px 0;">{{ strtoupper($digitalId->contact_person ?? 'MARINEL V. GANITNIT') }}</div>
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;margin-bottom:1px;">{{ strtoupper($digitalId->contact_person_address ?? 'BLK.6 LOT.7 CHESTER VILLE BUROL MAIN') }}</div>
                            <div style="font-size:8px;font-weight:900;color:#000;text-transform:uppercase;">CONTACT NO: {{ $digitalId->contact_person_number ?? '0917-933-0940' }}</div>
                        </div>
                        <div style="margin-top:0;">
                            <div style="font-size:7.5px;font-weight:900;color:#000;text-transform:uppercase;margin-bottom:1px;">THIS CARD IS NON - TRANSFERABLE</div>
                            <div style="font-size:6.5px;font-weight:800;color:#000;line-height:1.35;margin-bottom:3px;">THE CARD HOLDER IS A BONAFIDE RESIDENT OF THIS BARANGAY. IF THIS ID IS FOUND , KINDLY RETURN TO THE BARANGAY SECRETARIAT.</div>
                            <div style="font-size:7px;font-weight:900;color:#000;margin-bottom:1px;">NOTE:</div>
                            <div style="font-size:6.5px;font-weight:800;color:#000;line-height:1.35;">THIS CARD IS VALID IF SIGNED BY THE BARANGAY CHAIRMAN. LOSS OF THIS CARD MUST BE REPORTED IMMEDIATELY TO THE BARANGAY HALL.</div>
                        </div>
                        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-top:auto;padding-bottom:1px;">
                            <div>
                                <div style="font-size:10px;font-weight:900;color:#000;text-transform:uppercase;letter-spacing:0.02em;">HON. MARVIN M. BENIS</div>
                                <div style="font-size:7px;font-weight:800;color:#000;text-transform:uppercase;letter-spacing:0.05em;margin-top:1px;">PUNONG BARANGAY</div>
                            </div>
                            <div style="text-align:center;flex-shrink:0;">
                                <div style="width:78px;height:78px;aspect-ratio:1/1;background:#ffffff;border:1.5px solid #000;border-radius:3px;padding:2px;display:flex;align-items:center;justify-content:center;box-sizing:border-box;">
                                    <div id="resident-qr-canvas" style="width:72px;height:72px;aspect-ratio:1/1;display:flex;align-items:center;justify-content:center;"></div>
                                </div>
                                <div style="font-size:4.5px;font-weight:800;color:#000;margin-top:1px;">{{ $idCode }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <div style="display:flex;justify-content:flex-end;margin-top:12px;">
                    <button @click="digitalIdViewModal=false" class="btn-grad btn-sm"><i class="fas fa-check"></i> Done</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(()=>{
            const container = document.getElementById('resident-qr-canvas');
            if(!container || container.innerHTML.trim() !== '') return;
            try {
                const url = '{{ url("/resident?id=".$idCode) }}';
                new QRCode(container, {
                    text: url,
                    width: 62,
                    height: 62,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.M
                });
            } catch(e){ console.error(e); }
        }, 500);
    });
    </script>
    @endif
    @endif

    {{-- ASK FLOAT --}}
    <a href="https://www.facebook.com/share/1KroHtkCf9/" target="_blank" class="ask-float">
        <div class="ask-pulse"></div>
        <i class="fab fa-facebook-messenger"></i> Ask Here
    </a>



    {{-- ADD FAMILY MEMBER MODAL --}}
    <div x-show="familyModal" x-cloak class="modal-ov" x-transition style="z-index:400;">
        <div class="modal-box" style="max-width:550px;width:100%;" @click.away="familyModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-user-plus"></i></div> Add Family Member</div>
                    <button type="button" @click="familyModal=false;profileModal=true" class="modal-close"><i class="fas fa-arrow-circle-left"></i></button>
                </div>
                <p style="font-size:11px;font-weight:600;color:var(--muted);margin-bottom:14px;">Family members added here are pending approval. You cannot edit them once submitted.</p>
                <form action="{{ route('resident.family.store') }}" method="POST" enctype="multipart/form-data" x-data="{ isSubmitting: false }" @submit="isSubmitting = true">
                    @csrf
                    <div class="fgrid4" style="gap:7px;margin-bottom:12px;">
                        <div class="fspan2"><label class="flbl">First Name</label><input type="text" name="first_name" required class="finput" style="padding:8px;"></div>
                        <div><label class="flbl">Middle</label><input type="text" name="middle_name" class="finput" style="padding:8px;"></div>
                        <div><label class="flbl">Last Name</label><input type="text" name="last_name" required class="finput" style="padding:8px;"></div>
                    </div>
                    
                    <div class="fgrid4" style="gap:7px;margin-bottom:12px;">
                        <div><label class="flbl">Suffix</label><input type="text" name="suffix" class="finput" style="padding:8px;" placeholder="Jr, Sr"></div>
                        <div><label class="flbl">Relationship</label>
                            <select name="relationship" required class="finput fselect" style="padding:8px;">
                                <option value="">Select</option>
                                <option value="Wife">Wife</option>
                                <option value="Husband">Husband</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Sibling">Sibling</option>
                                <option value="Grandma">Grandma</option>
                                <option value="Grandpa">Grandpa</option>
                                <option value="Child">Child</option>
                            </select>
                        </div>
                        <div><label class="flbl">Gender</label>
                            <select name="gender" required class="finput fselect" style="padding:8px;">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div><label class="flbl">Status</label>
                            <select name="civil_status" required class="finput fselect" style="padding:8px;">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                    </div>

                    {{-- Row 3: Birthday & Age --}}
                    <div class="fgrid2" style="grid-template-columns: 2fr 1fr; gap:10px; margin-bottom:12px;">
                        <div>
                            <label class="flbl">Birthday</label>
                            <input type="date" name="birthday" x-model="birthday" required @input="if(birthday){const bd=new Date(birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;age=a;}" @change="if(birthday){const bd=new Date(birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;age=a;}" class="finput" style="padding:8px;">
                        </div>
                        <div>
                            <label class="flbl">Age</label>
                            <input type="number" name="age" x-model="age" readonly class="finput" style="padding:8px;background:#e2e8f0;font-weight:700;">
                        </div>
                    </div>

                    {{-- Row 4: Voter Status & Classification (Ample width, never truncated) --}}
                    <div class="fgrid2" style="gap:10px; margin-bottom:12px;">
                        <div>
                            <label class="flbl">Voter? (Yes/No)</label>
                            <select name="is_voter" required class="finput fselect" style="padding:8px; font-weight:600;">
                                <option value="0">No (Non-Voter)</option>
                                <option value="1">Yes (Registered Voter)</option>
                            </select>
                        </div>
                        <div>
                            <label class="flbl">Classification</label>
                            <select name="classification" x-model="classification" class="finput fselect" style="padding:8px; font-weight:600;">
                                <option value="">None / Regular</option>
                                <option value="PWD">PWD</option>
                                <option value="Senior">Senior</option>
                                <option value="Solo Parent">Solo Parent</option>
                                <option value="Student">Student</option>
                                <option value="Bed-ridden">Bed-ridden</option>
                            </select>
                        </div>
                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:9px;padding-top:10px;border-top:1px solid var(--border);">
                        <button type="button" @click="familyModal=false;profileModal=true" class="btn-plain btn-ghost" :disabled="isSubmitting">Cancel</button>
                        <button type="submit" class="btn-grad" :disabled="isSubmitting" style="display:inline-flex;align-items:center;gap:6px;">
                            <span x-show="!isSubmitting"><i class="fas fa-save"></i> Submit Member</span>
                            <span x-show="isSubmitting" style="display:inline-flex;align-items:center;gap:6px;"><i class="fas fa-spinner fa-spin"></i> Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- PHOTO UPDATE WARNING MODAL --}}
    <div x-show="photoWarningModal" x-cloak class="modal-ov" x-transition style="z-index:9999;">
        <div class="modal-box" style="max-width:380px; border-top: 5px solid var(--brand);" @click.away="photoWarningModal = false">
            <div class="modal-in" style="text-align:center; padding: 30px 24px;">
                <div style="width:60px; height:60px; background:#eff6ff; border-radius:50%; display:flex; align-items:center; justify-content:center; margin: 0 auto 18px;">
                    <i class="fas fa-camera-retro" style="font-size:24px; color:var(--brand);"></i>
                </div>
                <h3 style="font-size:16px; font-weight:900; color:var(--text); margin-bottom:10px;">Update Photo?</h3>
                <p style="font-size:11px; color:var(--muted); line-height:1.6; margin-bottom:24px;">
                    Note: <span x-text="warningType === 'pet' ? 'Pet photos' : 'Profile photos'"></span> can only be updated **once every 6 months**.
                    <br>Once updated, you won't be able to change it again until <strong style="color:var(--text);" x-text="warningNextDate"></strong>.
                </p>
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
                    <button @click="photoWarningModal = false" class="btn-plain btn-ghost" style="font-size:11px; font-weight:800;">Cancel</button>
                    <button @click="photoWarningModal = false; 
                            if(window.pendingPhotoFiles){ 
                                const inp = document.getElementById(warningType === 'pet' ? 'petPhotoInput' : 'profilePhotoInput');
                                inp.files = window.pendingPhotoFiles;
                                inp.dispatchEvent(new Event('change'));
                                if(warningType === 'profile') document.getElementById('profilePhotoForm').submit();
                                window.pendingPhotoFiles = null;
                            } else { 
                                document.getElementById(warningType === 'pet' ? 'petPhotoInput' : 'profilePhotoInput').click(); 
                            }" class="btn-grad" style="font-size:11px; font-weight:900;">Continue</button>
                </div>
            </div>
        </div>
    </div>

    {{-- RESCHEDULE MODAL --}}
    <div x-show="rescheduleModal" x-cloak class="modal-ov" x-transition style="z-index:9999;">
        <div class="modal-box" style="max-width:420px;" @click.away="rescheduleModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico"><i class="fas fa-calendar-alt"></i></div>
                        <div>
                            <div>Reschedule Appointment</div>
                            <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;" x-text="'Request ID: #' + activeReq.id"></div>
                        </div>
                    </div>
                    <button @click="rescheduleModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                <form :action="'/resident/document-request/' + activeReq.id + '/reschedule'" method="POST"
                      x-data="{ 
                        appDate: '', 
                        slots: [], 
                        loadingSlots: false, 
                        selectedTime: '',
                        getMaxDate() {
                            const d = new Date();
                            d.setDate(d.getDate() + 90);
                            return d.toISOString().split('T')[0];
                        },
                        fetchSlots() {
                            if(!this.appDate) return;
                            this.loadingSlots = true;
                            fetch('{{ route('resident.document.availability') }}?date=' + this.appDate)
                                .then(r => r.json())
                                .then(data => {
                                    this.slots = data;
                                    this.loadingSlots = false;
                                });
                        },
                        init() {
                             this.$watch('activeReq', value => {
                                if(value.appointment_date) {
                                    this.appDate = value.appointment_date;
                                    this.selectedTime = value.appointment_time;
                                    this.fetchSlots();
                                }
                             });
                        }
                      }">
                    @csrf
                    <div style="background:#f0f9ff; border:1px solid #bae6fd; border-radius:10px; padding:12px; margin-bottom:16px; font-size:11px; color:#0369a1; font-weight:700; line-height:1.4;">
                        <i class="fas fa-info-circle"></i> You can change your preferred pickup schedule. No reason is required for rescheduling (limit: 1 time).
                    </div>

                    <div class="fgrp">
                        <label class="flbl">Preferred Date *</label>
                        <input type="date" name="appointment_date" required class="finput" 
                               x-model="appDate" @change="fetchSlots()"
                               min="{{ date('Y-m-d') }}" :max="getMaxDate()">
                    </div>
                    <div class="fgrp">
                        <label class="flbl">Preferred Time *</label>
                        <select name="appointment_time" required class="finput fselect" x-model="selectedTime">
                            <option value="">— Select Time —</option>
                            <template x-for="s in slots" :key="s.time">
                                <option :value="s.time" :disabled="s.full"
                                        :style="s.full ? 'color:#dc2626;background:#fee2e2;' : ''"
                                        x-text="s.display + (s.full ? ' (Fully Booked)' : ' (' + s.remaining + ' slots left)')">
                                </option>
                            </template>
                        </select>
                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:20px;">
                        <button type="button" @click="rescheduleModal=false" class="btn-plain btn-ghost">Cancel</button>
                        <button type="submit" class="btn-grad"><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- PENDING VERIFICATION LOCK MODAL --}}
    <div x-show="pendingLockModal" x-cloak class="modal-ov" x-transition style="z-index:99999;" @keydown.window.escape="pendingLockModal=false">
        <div class="modal-box" style="max-width:480px; border-top:5px solid #f59e0b; border-bottom:none; border-radius:20px;" @click.away="pendingLockModal=false">
            <div class="modal-in">
                <div class="modal-hd" style="border-bottom-color:#fef3c7; margin-bottom:14px;">
                    <div class="modal-ttl">
                        <div class="modal-ico" style="background:#fef3c7; color:#d97706;"><i class="fas fa-lock"></i></div>
                        <div style="color:#92400e; font-size:14px; font-weight:900;" x-text="t('pending_modal_title')">Feature Locked - Verification Pending</div>
                    </div>
                    <button type="button" @click="pendingLockModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <div style="text-align:center; padding:8px 4px 14px;">
                    <div style="width:62px; height:62px; border-radius:50%; background:#fef3c7; color:#d97706; display:flex; align-items:center; justify-content:center; margin:0 auto 14px; font-size:26px; box-shadow:0 4px 14px rgba(245, 158, 11, 0.25);">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <h3 style="font-size:16px; font-weight:900; color:#1e293b; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.02em;" x-text="t('pending_modal_heading')">
                        Temporarily Locked
                    </h3>
                    <p style="font-size:12.5px; color:#64748b; line-height:1.6; margin-bottom:14px; font-weight:500;" x-text="t('pending_modal_desc')">
                        This service requires official verification from Barangay Office Staff to confirm your identity against the Masterlist.
                    </p>
                    <div style="background:#fffbeb; border:1px solid #fde68a; border-radius:10px; padding:12px 14px; font-size:11.5px; color:#92400e; text-align:left; margin-bottom:16px; line-height:1.55;">
                        <i class="fas fa-shield-halved" style="color:#d97706; margin-right:4px;"></i>
                        <strong x-text="t('pending_modal_why_label')">Why is this locked?</strong> <span x-text="t('pending_modal_why_desc')">In accordance with barangay policy, official documents, blotter records, and digital IDs are restricted to residents whose identity has been validated using valid ID or voter proof.</span>
                    </div>
                    <div style="display:flex; flex-wrap:wrap; gap:10px; justify-content:center;">
                        <button type="button" @click="pendingLockModal=false; docuModal=true; selectedDoc='movein';" class="btn-grad" style="padding:10px 18px; font-size:12px; background:linear-gradient(135deg,#059669 0%,#047857 100%); box-shadow:0 2px 6px rgba(5,150,105,0.3);">
                            <i class="fas fa-sign-in-alt"></i> <span x-text="lang==='fil'?'Humiling ng Move-In Certificate':'Request Move-In Certificate'">Request Move-In Certificate</span>
                        </button>
                        <button type="button" @click="pendingLockModal=false; profileModal=true;" class="btn-plain btn-outline" style="padding:10px 18px; font-size:12px;">
                            <i class="fas fa-user-edit"></i> <span x-text="t('pending_modal_btn_profile')">View My Profile</span>
                        </button>
                        <button type="button" @click="pendingLockModal=false" class="btn-plain btn-ghost" style="padding:10px 18px; font-size:12px;" x-text="t('pending_modal_btn_understand')">
                            I Understand
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- EMERGENCY SOS MODAL --}}
    <script>
    window.callOrCopyHotline = function(num, formattedNum, name) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(num).catch(() => {});
        } else {
            const ta = document.createElement('textarea');
            ta.value = num;
            document.body.appendChild(ta);
            ta.select();
            try { document.execCommand('copy'); } catch(e){}
            document.body.removeChild(ta);
        }

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: `<span style="font-size:20px; font-weight:900; color:#0f172a; text-transform:uppercase;">${name}</span>`,
                html: `
                    <div style="background:#eff6ff; border:2px solid #3b82f6; border-radius:14px; padding:16px 12px; margin:16px 0; text-align:center;">
                        <div style="font-size:12px; font-weight:800; color:#1d4ed8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:4px;">Hotline Number:</div>
                        <div style="font-size:26px; font-weight:900; color:#0f172a; font-family:monospace; letter-spacing:1px;">${formattedNum}</div>
                    </div>
                    <div style="background:#f0fdf4; border:1.5px solid #86efac; border-radius:10px; padding:12px 14px; margin-bottom:14px; text-align:left;">
                        <p style="font-size:13.5px; color:#14532d; font-weight:800; margin:0; line-height:1.5;">
                            ✓ <strong>Nakopya na sa clipboard!</strong> Pwede mo itong i-paste o tawagan agad kahit mabagal o walang internet.
                        </p>
                    </div>
                    <div style="display:flex; justify-content:center; gap:10px; margin-top:8px;">
                        <a href="tel:${num}" style="display:inline-flex; align-items:center; gap:8px; background:#16a34a; color:#fff; padding:12px 24px; border-radius:10px; font-weight:900; font-size:14px; text-decoration:none; box-shadow:0 4px 12px rgba(22,163,74,0.3);">
                            <i class="fas fa-phone-alt"></i> <span>Tawagan Agad (Call Now)</span>
                        </a>
                    </div>
                `,
                icon: 'success',
                showConfirmButton: true,
                confirmButtonColor: '#0E5393',
                confirmButtonText: 'Sige, Naintindihan ko',
                customClass: {
                    container: 'swal2-high-zindex',
                    popup: 'rounded-2xl shadow-2xl border border-slate-200'
                }
            });
        } else if (typeof showToast === 'function') {
            showToast('Nakopya ang numero: ' + formattedNum, 'info');
        } else {
            alert('Hotline ' + name + ': ' + formattedNum + ' (Nakopya sa clipboard)');
        }
    };
    </script>
    <div x-show="sosModal" x-cloak class="modal-ov" x-transition style="z-index:10000;" @keydown.window.escape="if(!sosLoading) sosModal=false">
        <div class="modal-box" style="max-width:520px; max-height:90vh; overflow-y:auto; border-top:5px solid #e11d48; border-radius:20px;" @click.away="if(!sosLoading) sosModal=false">
            <div class="modal-in" style="padding:20px 22px;">
                {{-- STEP 1: FILL OUT & DETAILS --}}
                <template x-if="!sosSuccess && !sosConfirmStep">
                    <div>
                        <div class="modal-hd" style="margin-bottom:16px;">
                            <div class="modal-ttl">
                                <div class="modal-ico" style="background:rgba(225,29,72,0.1);color:#e11d48;width:38px;height:38px;"><i class="fas fa-truck-medical" style="font-size:17px;"></i></div>
                                <div>
                                    <div style="color:var(--text);font-weight:900;font-size:16px;letter-spacing:-0.2px;" x-text="t('sos_modal_title')">EMERGENCY SOS ALERT</div>
                                    <div style="font-size:11.5px;font-weight:700;color:var(--muted);text-transform:none;margin-top:1px;" x-text="t('sos_modal_sub')">Direct Dispatch to Barangay Peace & Order Patrol</div>
                                </div>
                            </div>
                            <button type="button" @click="sosModal=false" class="modal-close" :disabled="sosLoading"><i class="fas fa-times-circle"></i></button>
                        </div>

                        {{-- ONE-TAP DIRECT EMERGENCY HOTLINES (Enlarged & Senior/PWD Readable) --}}
                        <div style="background:#f0fdf4; border:2px solid #86efac; border-radius:14px; padding:12px 14px; margin-bottom:16px; box-shadow:0 2px 10px rgba(22,101,52,0.08); width:100%; box-sizing:border-box; overflow:hidden;">
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; flex-wrap:wrap; gap:6px;">
                                <div style="font-size:12px; font-weight:900; color:#14532d; display:flex; align-items:center; gap:6px; text-transform:uppercase; letter-spacing:0.02em;">
                                    <i class="fas fa-phone-volume" style="color:#16a34a; font-size:14px;"></i>
                                    <span>Direct Emergency Hotlines (24/7)</span>
                                </div>
                                <span style="font-size:9px; font-weight:900; background:#dcfce7; color:#15803d; border:1px solid #86efac; padding:2px 8px; border-radius:99px; letter-spacing:0.04em;">DIAL O COPY-PASTE</span>
                            </div>
                            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 210px), 1fr)); gap:8px; width:100%; box-sizing:border-box;">
                                {{-- Hotline 1 --}}
                                <button type="button" @click="callOrCopyHotline('0464160283', '(046) 416-0283', 'Brgy. SM2 Tanod Desk')" style="text-align:left; display:flex; align-items:center; gap:9px; background:#fff; border:1.5px solid #86efac; padding:9px 11px; border-radius:10px; color:#0f172a; cursor:pointer; transition:all .15s; box-shadow:0 1px 3px rgba(0,0,0,0.05); width:100%; box-sizing:border-box; min-width:0; overflow:hidden;" onmouseover="this.style.background='#dcfce7';this.style.borderColor='#16a34a';" onmouseout="this.style.background='#fff';this.style.borderColor='#86efac';">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#16a34a;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px;"><i class="fas fa-shield-alt"></i></div>
                                    <div style="overflow:hidden;line-height:1.25;min-width:0;flex:1;">
                                        <div style="font-size:10.5px;color:#15803d;font-weight:800;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Brgy. Tanod Desk</div>
                                        <div style="font-family:monospace;font-size:12.5px;font-weight:900;color:#0f172a;letter-spacing:0.2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">(046) 416-0283</div>
                                    </div>
                                </button>
                                {{-- Hotline 2 --}}
                                <button type="button" @click="callOrCopyHotline('09175432100', '0917-543-2100', 'Desk Officer Mobile')" style="text-align:left; display:flex; align-items:center; gap:9px; background:#fff; border:1.5px solid #86efac; padding:9px 11px; border-radius:10px; color:#0f172a; cursor:pointer; transition:all .15s; box-shadow:0 1px 3px rgba(0,0,0,0.05); width:100%; box-sizing:border-box; min-width:0; overflow:hidden;" onmouseover="this.style.background='#dcfce7';this.style.borderColor='#16a34a';" onmouseout="this.style.background='#fff';this.style.borderColor='#86efac';">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#16a34a;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px;"><i class="fas fa-mobile-alt"></i></div>
                                    <div style="overflow:hidden;line-height:1.25;min-width:0;flex:1;">
                                        <div style="font-size:10.5px;color:#15803d;font-weight:800;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Desk Officer Mobile</div>
                                        <div style="font-family:monospace;font-size:12.5px;font-weight:900;color:#0f172a;letter-spacing:0.2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">0917-543-2100</div>
                                    </div>
                                </button>
                                {{-- Hotline 3 --}}
                                <button type="button" @click="callOrCopyHotline('0464160278', '(046) 416-0278', 'Dasma PNP Police')" style="text-align:left; display:flex; align-items:center; gap:9px; background:#fff; border:1.5px solid #93c5fd; padding:9px 11px; border-radius:10px; color:#0f172a; cursor:pointer; transition:all .15s; box-shadow:0 1px 3px rgba(0,0,0,0.05); width:100%; box-sizing:border-box; min-width:0; overflow:hidden;" onmouseover="this.style.background='#eff6ff';this.style.borderColor='#2563eb';" onmouseout="this.style.background='#fff';this.style.borderColor='#93c5fd';">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#2563eb;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px;"><i class="fas fa-building-shield"></i></div>
                                    <div style="overflow:hidden;line-height:1.25;min-width:0;flex:1;">
                                        <div style="font-size:10.5px;color:#1d4ed8;font-weight:800;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Dasma PNP Police</div>
                                        <div style="font-family:monospace;font-size:12.5px;font-weight:900;color:#0f172a;letter-spacing:0.2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">(046) 416-0278</div>
                                    </div>
                                </button>
                                {{-- Hotline 4 --}}
                                <button type="button" @click="callOrCopyHotline('911', '911 / (046) 481-8000', 'CDRRMO / Rescue')" style="text-align:left; display:flex; align-items:center; gap:9px; background:#fff; border:1.5px solid #fca5a5; padding:9px 11px; border-radius:10px; color:#0f172a; cursor:pointer; transition:all .15s; box-shadow:0 1px 3px rgba(0,0,0,0.05); width:100%; box-sizing:border-box; min-width:0; overflow:hidden;" onmouseover="this.style.background='#fee2e2';this.style.borderColor='#dc2626';" onmouseout="this.style.background='#fff';this.style.borderColor='#fca5a5';">
                                    <div style="width:32px;height:32px;border-radius:8px;background:#dc2626;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px;"><i class="fas fa-ambulance"></i></div>
                                    <div style="overflow:hidden;line-height:1.25;min-width:0;flex:1;">
                                        <div style="font-size:10.5px;color:#b91c1c;font-weight:800;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">CDRRMO Rescue</div>
                                        <div style="font-family:monospace;font-size:12.5px;font-weight:900;color:#0f172a;letter-spacing:0.2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">911 / 481-8000</div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {{-- Registered Address info --}}
                        <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:12px;padding:12px 14px;margin-bottom:14px;">
                            <div style="display:flex;align-items:center;gap:8px;font-size:12px;font-weight:700;color:var(--text);flex-wrap:wrap;">
                                <i class="fas fa-home" style="color:var(--brand);font-size:14px;"></i>
                                <span style="color:#475569;" x-text="lang==='fil' ? 'Nakatala na Tirahan:' : 'Registered Address:'">Registered Address:</span>
                                <strong style="color:#0f172a;margin-left:auto;font-weight:900;">{{ $authUser?->resident?->address ?? ($authUser?->address ?? 'Barangay San Miguel II') }}</strong>
                            </div>
                        </div>

                        {{-- Emergency type selector (Enlarged & Bold for Senior/PWD) --}}
                        <div class="fgrp" style="margin-bottom:14px;">
                            <label class="flbl" style="font-size:13px; font-weight:800; color:#0f172a; margin-bottom:6px; display:flex; align-items:center; gap:6px;">
                                <i class="fas fa-exclamation-triangle" style="color:#e11d48;"></i>
                                <span x-text="t('sos_nature_label')">Uri ng Emergency / Emergency Nature</span> <span style="color:#dc2626;">*</span>
                            </label>
                            <select x-model="sosEmergencyType" class="finput fselect" style="font-size:13.5px; font-weight:800; padding:12px 14px; border:2px solid #cbd5e1; border-radius:10px; color:#0f172a; background:#fff;">
                                <option value="general" x-text="lang==='fil' ? '🚨 Pangkalahatang Emergency / Saklolo ng Tanod' : '🚨 General Emergency / Tanod Assistance'"></option>
                                <option value="security" x-text="lang==='fil' ? '🛡️ Banta sa Seguridad / Kaguluhan / Estranghero' : '🛡️ Security Threat / Disturbance / Intruder'"></option>
                                <option value="medical" x-text="lang==='fil' ? '🚑 Serbisyong Medikal / Unang Lunas' : '🚑 Medical Emergency / First Responder'"></option>
                                <option value="fire" x-text="lang==='fil' ? '🔥 Sunog / Alerto sa Panganib' : '🔥 Fire / Hazard Alert'"></option>
                                <option value="dispute" x-text="lang==='fil' ? '⚠️ Alitan sa Kapitbahay / Kaguluhan sa Tahanan' : '⚠️ Neighborhood Incident / Domestic Disturbance'"></option>
                            </select>
                        </div>

                        {{-- Dedicated Incident Landmark / Location Input --}}
                        <div class="fgrp" style="margin-bottom:16px;">
                            <label class="flbl" style="font-size:13px; font-weight:800; color:#0f172a; margin-bottom:6px; display:flex; align-items:center; gap:6px;">
                                <i class="fas fa-map-marker-alt" style="color:#0E5393;"></i>
                                <span x-text="t('sos_landmark_label')">Exact Landmark / Incident Location</span> <span style="color:#dc2626;">*</span>
                            </label>
                            <input type="text" x-model="sosLandmark" 
                                   @input="if(sosLandmark.trim().length >= 3) { sosLandmarkError = false; sosError = null; }"
                                   class="finput" 
                                   style="font-size:13.5px; font-weight:700; padding:12px 14px; border:2px solid #cbd5e1; border-radius:10px;"
                                   :placeholder="t('sos_landmark_ph')" 
                                   :style="sosLandmarkError ? 'border-color:#dc2626 !important; background:#fff1f2 !important;' : ''">
                            <div style="font-size:11px;color:#475569;font-weight:600;margin-top:4px;" x-text="t('sos_landmark_hint')">
                                Saan mismong lugar nagaganap ang emergency? Ilagay ang landmark lalo na kung wala sa inyong bahay.
                            </div>
                            <template x-if="sosLandmarkError">
                                <div style="color:#dc2626;font-size:11.5px;font-weight:800;margin-top:5px;">
                                    <i class="fas fa-exclamation-circle"></i> <span x-text="t('sos_landmark_err')">Kinakailangan ilagay ang eksaktong landmark o lokasyon bago mag-dispatch.</span>
                                </div>
                            </template>
                        </div>

                        <template x-if="sosError">
                            <div style="background:#fef2f2;border:1.5px solid #fecaca;color:#dc2626;padding:10px 14px;border-radius:10px;font-size:12px;font-weight:800;margin-bottom:14px;" x-text="sosError"></div>
                        </template>

                        <div style="display:flex;gap:12px;margin-top:16px;">
                            <button type="button" @click="sosModal=false" class="btn-plain btn-ghost" style="flex:1;font-size:13px;font-weight:800;padding:12px;" :disabled="sosLoading" x-text="t('cancel')">Cancel</button>
                            <button type="button" @click="proceedToConfirm()" class="sos-btn" style="flex:2;justify-content:center;padding:14px;font-size:14px;font-weight:900;letter-spacing:0.04em;" :disabled="sosLoading">
                                <span><i class="fas fa-bullhorn"></i> <span x-text="t('sos_btn_dispatch')">DISPATCH NOW</span></span>
                            </button>
                        </div>
                    </div>
                </template>

                {{-- STEP 2: CONFIRMATION PROMPT (AFTER CLICKING DISPATCH NOW) --}}
                <template x-if="!sosSuccess && sosConfirmStep">
                    <div style="text-align:center;padding:6px 2px;">
                        <div style="width:58px;height:58px;background:#fee2e2;color:#dc2626;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:24px;box-shadow:0 0 0 8px rgba(220,38,38,0.12);">
                            <i class="fas fa-triangle-exclamation"></i>
                        </div>
                        <h3 style="font-size:16px;font-weight:900;color:var(--text);margin-bottom:4px;text-transform:uppercase;letter-spacing:0.5px;" x-text="t('sos_confirm_title')">
                            KUMPIRMASYON SA PAG-DISPATCH
                        </h3>
                        <p style="font-size:11.5px;color:var(--muted);font-weight:600;line-height:1.5;margin-bottom:14px;" x-text="t('sos_confirm_desc')">
                            Sigurado ka bang nais mong magpadala ng Emergency Dispatch sa Barangay Peace & Order Patrol?
                        </p>

                        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:12px 14px;text-align:left;margin-bottom:14px;font-size:11.5px;color:var(--text);line-height:1.6;">
                            <div style="margin-bottom:8px;">
                                <span style="color:var(--muted);font-weight:700;font-size:10px;text-transform:uppercase;" x-text="t('sos_confirm_nature')">🚨 Uri ng Emergency:</span><br>
                                <strong style="color:#dc2626;font-size:12px;" x-text="getEmergencyTypeLabel(sosEmergencyType)"></strong>
                            </div>
                            <div style="margin-bottom:8px;">
                                <span style="color:var(--muted);font-weight:700;font-size:10px;text-transform:uppercase;" x-text="t('sos_confirm_landmark')">📍 Pupuntahang Landmark / Lokasyon:</span><br>
                                <strong style="color:var(--text);font-size:12px;background:#e2e8f0;padding:2px 8px;border-radius:4px;display:inline-block;" x-text="sosLandmark"></strong>
                            </div>
                            <hr style="border:0;border-top:1px solid #e2e8f0;margin:8px 0;">
                            <div style="color:#dc2626;font-weight:700;font-size:10.5px;display:flex;align-items:flex-start;gap:6px;">
                                <i class="fas fa-shield-alt" style="margin-top:2px;"></i>
                                <span x-text="t('sos_confirm_warning')">HINDI ITO LARO O BIRO. Tanging sa nasasakupan lamang ng Barangay San Miguel II makaka-responde ang ating mga Tanod on-duty. Agad na tutungo ang mga rumespondeng Tanod sa nasabing lokasyon.</span>
                            </div>
                        </div>

                        <template x-if="sosError">
                            <div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:8px 12px;border-radius:8px;font-size:11px;font-weight:700;margin-bottom:12px;" x-text="sosError"></div>
                        </template>

                        <div style="display:flex;gap:10px;margin-top:14px;">
                            <button type="button" @click="sosConfirmStep=false" class="btn-plain btn-ghost" style="flex:1;" :disabled="sosLoading">
                                <i class="fas fa-arrow-left"></i> <span x-text="t('sos_btn_back')">Bumalik</span>
                            </button>
                            <button type="button" @click="sendSosAlert()" class="sos-btn" style="flex:2;justify-content:center;padding:12px;background:#dc2626;color:#fff;" :disabled="sosLoading">
                                <template x-if="!sosLoading">
                                    <span><i class="fas fa-bullhorn"></i> <span x-text="t('sos_btn_confirm')">OO, I-DISPATCH NA</span></span>
                                </template>
                                <template x-if="sosLoading">
                                    <span><i class="fas fa-spinner fa-spin"></i> <span x-text="t('sos_transmitting')">TRANSMITTING...</span></span>
                                </template>
                            </button>
                        </div>
                    </div>
                </template>

                {{-- Success State --}}
                <template x-if="sosSuccess">
                    <div style="text-align:center;padding:10px 0;">
                        <div style="width:68px;height:68px;background:#dcfce7;color:#16a34a;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:32px;box-shadow:0 0 0 8px rgba(22,163,74,0.15);">
                            <i class="fas fa-check"></i>
                        </div>
                        <h3 style="font-size:18px;font-weight:900;color:#14532d;margin-bottom:6px;text-transform:uppercase;" x-text="t('sos_success_title')">DISPATCH ALERT TRANSMITTED</h3>
                        <p style="font-size:13px;color:#1e293b;font-weight:700;line-height:1.6;margin-bottom:14px;" x-text="t('sos_success_desc')">
                            Your emergency SOS has been received with <strong>HIGHEST PRIORITY</strong> by the on-duty Barangay Police (Tanod) & Peace and Order Command.
                        </p>

                        {{-- IMPORTANT REMINDER & JURISDICTION NOTES (MOVED HERE AS REQUESTED) --}}
                        <div style="background:#fff1f2;border:1.5px solid #fecdd3;border-left:5px solid #e11d48;border-radius:12px;padding:12px 16px;margin-bottom:14px;text-align:left;">
                            <div style="font-size:12px;font-weight:900;color:#9f1239;text-transform:uppercase;margin-bottom:4px;display:flex;align-items:center;gap:6px;">
                                <i class="fas fa-triangle-exclamation" style="color:#e11d48;font-size:15px;"></i>
                                <span x-text="t('sos_advisory_title')">⚠️ IMPORTANT REMINDER:</span>
                            </div>
                            <div style="font-size:12px;color:#881337;line-height:1.55;font-weight:600;">
                                <span x-text="t('sos_advisory_desc')">Emergency SOS is strictly for genuine emergencies within the territorial jurisdiction of Barangay San Miguel II. On-duty Tanod patrols can only respond within our barangay. If an accident or emergency occurs in another barangay or city, please call 911, PNP, or the respective local emergency hotline immediately.</span>
                                <span style="font-size:11px;color:#be123c;display:block;margin-top:4px;font-weight:800;" x-text="t('sos_advisory_penalty')">Pranks or false alarms are strictly prohibited and punishable by law.</span>
                            </div>
                        </div>

                        <template x-if="sosResidentEmail || @json($authUser?->email)">
                            <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:10px 14px;margin-bottom:14px;font-size:12px;color:#1e40af;font-weight:700;text-align:left;">
                                <i class="fas fa-envelope-circle-check" style="color:var(--brand);margin-right:6px;"></i>
                                <span x-text="t('sos_email_sent_to')">Confirmation receipt sent to:</span> <strong style="color:#0E5393;margin-left:4px;" x-text="sosResidentEmail || @json($authUser?->email)"></strong>
                            </div>
                        </template>
                        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:12px 14px;font-size:12px;color:#334155;font-weight:700;margin-bottom:20px;text-align:left;line-height:1.6;">
                            <div><i class="fas fa-shield-alt" style="color:var(--brand);margin-right:6px;"></i> <span x-text="t('sos_notice_1')">On-duty patrol units are being notified.</span></div>
                            <div style="margin-top:6px;"><i class="fas fa-phone-alt" style="color:var(--brand);margin-right:6px;"></i> <span x-text="t('sos_notice_2')">Keep your line open for Tanod dispatch verification.</span></div>
                        </div>
                        <button type="button" @click="sosModal=false; sosSuccess=false; sosConfirmStep=false; window.location.href='#sos-history'; window.location.reload();" class="btn-grad" style="width:100%;justify-content:center;padding:12px;font-size:14px;font-weight:800;" x-text="t('sos_btn_close')">
                            Understood & Close
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>

    </div>{{-- /main x-data --}}

    {{-- Auto Draft Persistence System for Resident Forms (Document Requests & Incident Reports) --}}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function setupFormDraft(formId, storageKey) {
            const form = document.getElementById(formId);
            if (!form) return;

            // Restore draft if available
            try {
                const savedData = localStorage.getItem(storageKey);
                if (savedData) {
                    const parsed = JSON.parse(savedData);
                    let restoredCount = 0;
                    Object.keys(parsed).forEach(fieldName => {
                        const input = form.querySelector(`[name="${fieldName}"]`);
                        if (input && input.type !== 'file' && input.type !== 'password' && input.type !== 'hidden') {
                            if (!input.value) {
                                input.value = parsed[fieldName];
                                input.dispatchEvent(new Event('input', { bubbles: true }));
                                input.dispatchEvent(new Event('change', { bubbles: true }));
                                restoredCount++;
                            }
                        }
                    });
                }
            } catch(e) {}

            // Auto-save on input or change
            let timeout;
            form.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(saveDraft, 400);
            });
            form.addEventListener('change', function() {
                clearTimeout(timeout);
                timeout = setTimeout(saveDraft, 400);
            });

            function saveDraft() {
                try {
                    const formData = new FormData(form);
                    const dataObj = {};
                    formData.forEach((value, key) => {
                        if (key !== '_token' && !(value instanceof File)) {
                            dataObj[key] = value;
                        }
                    });
                    localStorage.setItem(storageKey, JSON.stringify(dataObj));
                } catch(e) {}
            }

            // Clear draft when form is submitted
            form.addEventListener('submit', function() {
                setTimeout(() => {
                    localStorage.removeItem(storageKey);
                }, 3000);
            });
        }

        setupFormDraft('docReqForm', 'brgy_doc_request_draft');
        setupFormDraft('issueReportForm', 'brgy_issue_report_draft');
    });
    </script>

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;background:var(--body-bg);border-top:1px solid var(--border);">
        © {{ date('Y') }} Barangay San Miguel II, Dasmariñas City ,Cavite. All rights reserved.
    </footer>

</x-app-layout>
