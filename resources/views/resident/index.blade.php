<x-app-layout>
<style>
:root{--brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;--body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;--danger:#dc2626;--success:#059669;--card-shadow:0 4px 24px rgba(4,25,45,0.13),0 1.5px 6px rgba(0,0,0,0.07);--btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);--r-card:16px;--r-btn:10px;}
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

/* PRIVACY */
.privacy-overlay{position:fixed;inset:0;z-index:9999;background:rgba(0,0,30,.78);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;padding:16px;}
.privacy-box{background:#fff;border-radius:20px;max-width:460px;width:100%;box-shadow:0 24px 60px rgba(0,0,52,.4);border-bottom:5px solid var(--brand);overflow:hidden;}
.privacy-head{background:var(--btn-grad);padding:24px 24px 18px;text-align:center;}
.privacy-seal{width:64px;height:64px;border-radius:50%;object-fit:contain;margin:0 auto 12px;display:block;border:3px solid rgba(255,255,255,.35);}
.privacy-head h2{font-size:15px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;}
.privacy-head p{font-size:10px;color:rgba(255,255,255,.65);font-weight:600;margin-top:3px;}
.privacy-body{padding:22px 24px;}
.privacy-body p{font-size:11px;color:var(--muted);line-height:1.75;font-weight:500;}
.privacy-divider{height:1px;background:var(--border);margin:14px 0;}
.privacy-check{display:flex;align-items:flex-start;gap:10px;margin-bottom:16px;}
.privacy-check input{accent-color:var(--brand);width:15px;height:15px;flex-shrink:0;margin-top:2px;}
.privacy-check label{font-size:11px;font-weight:700;color:var(--text);cursor:pointer;line-height:1.5;}
.privacy-accept{width:100%;padding:13px;background:var(--btn-grad);color:#fff;font-family:inherit;font-size:12px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:10px;cursor:pointer;transition:all .18s;box-shadow:0 4px 14px rgba(0,0,82,.3);}
.privacy-accept:disabled{opacity:.4;cursor:not-allowed;}
.privacy-accept:not(:disabled):hover{transform:translateY(-1px);}
.privacy-footer{text-align:center;margin-top:10px;font-size:10px;color:var(--light);font-weight:600;}

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
.section-lbl{font-size:10px;font-weight:900;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.15em;margin-bottom:18px;display:flex;align-items:center;gap:8px;}
.service-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
@media(max-width:768px){.service-grid{grid-template-columns:repeat(2,1fr);gap:10px;}}
@media(max-width:440px){.service-grid{grid-template-columns:repeat(2,1fr);gap:8px;}}
.duty-grid-cols{display:grid;grid-template-columns:repeat(2,1fr);gap:14px;}
@media(max-width:640px){.duty-grid-cols{grid-template-columns:1fr;gap:10px;}}
.activity-carousel-box{position:relative;width:100%;height:360px;}
@media(max-width:640px){.activity-carousel-box{height:230px;}}
@media(max-width:420px){.activity-carousel-box{height:200px;}}
.service-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);border-radius:18px;padding:24px 12px 20px;text-align:center;cursor:pointer;transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);text-decoration:none;display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;}
.service-card:hover{background:rgba(255,255,255,.12);border-color:rgba(255,255,255,.3);transform:translateY(-5px);box-shadow:0 12px 30px rgba(0,0,0,0.3);}
.service-ico{width:52px;height:52px;background:rgba(255,255,255,0.1);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;transition:all .3s;}
.service-ico i{color:#fff;font-size:20px;}
.service-card:hover .service-ico{background:var(--brand);transform:scale(1.1);box-shadow:0 0 20px rgba(14,83,147,0.4);}
.service-name{font-size:14px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.05em;line-height:1.3;}
.service-sub{font-size:11px;font-weight:500;color:rgba(255,255,255,.8);margin-top:6px;}

/* DUTY WIDGET */
.duty-widget{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:16px 20px;margin-bottom:20px;backdrop-filter:blur(10px);}
.duty-widget-row{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;}
.duty-lbl{font-size:11px;font-weight:800;color:#fff;text-transform:uppercase;letter-spacing:.12em;display:flex;align-items:center;gap:6px;opacity:0.8;}
.duty-name{font-size:18px;font-weight:900;color:#fff;margin-top:4px;letter-spacing:0.02em;}
.duty-day-txt{font-size:12px;font-weight:700;color:#fff;text-transform:uppercase;margin-top:2px;background:var(--brand);padding:3px 12px;border-radius:99px;display:inline-block;box-shadow:0 2px 8px rgba(0,0,0,0.2);}
.duty-view-btn{background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);color:#fff;font-size:12px;font-weight:800;padding:8px 20px;border-radius:99px;cursor:pointer;font-family:inherit;text-transform:uppercase;transition:all .2s;display:flex;align-items:center;gap:8px;letter-spacing:0.05em;}
.duty-view-btn:hover{background:rgba(255,255,255,0.2);border-color:rgba(255,255,255,0.4);}
.duty-menu{background:#fff;border-radius:12px;box-shadow:var(--card-shadow);border:1px solid var(--border);overflow:hidden;margin-top:10px;}
.duty-menu-item{padding:10px 16px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #f8fafc;gap:8px;}
.duty-menu-item:last-child{border-bottom:none;}
.duty-menu-item.today-item{background:#eff6ff;}
.duty-day-lbl{font-size:11px;font-weight:900;color:var(--muted);text-transform:uppercase;width:100px;flex-shrink:0;}
.duty-name-lbl{font-size:13px;font-weight:800;color:var(--text);flex:1;}
.duty-badge{font-size:9px;font-weight:900;background:var(--brand);color:#fff;padding:3px 9px;border-radius:99px;text-transform:uppercase;}

/* NOTIF BELL */
.notif-bell-wrap{position:relative;display:inline-block;}
.notif-bell-btn{background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.3);color:#fff;width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:20px;transition:all .15s;position:relative;}
.notif-bell-btn:hover{background:rgba(255,255,255,.25);transform:scale(1.05);}
.notif-bell-badge{position:absolute;top:-6px;right:-6px;background:#ef4444;color:#fff;font-size:9px;font-weight:900;min-width:20px;height:20px;border-radius:99px;display:flex;align-items:center;justify-content:center;border:2px solid #04192D;padding:0 4px;box-shadow:0 2px 6px rgba(0,0,0,0.3);}
.notif-dropdown{position:absolute;top:calc(100% + 10px);right:0;width:300px;background:#fff;border-radius:14px;box-shadow:0 10px 40px rgba(0,0,52,.25);border:1px solid var(--border);z-index:300;overflow:hidden;}
.notif-hd{padding:10px 14px;background:#f8fafc;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.notif-hlbl{font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;}
.notif-item{display:flex;align-items:flex-start;gap:9px;padding:10px 14px;border-bottom:1px solid #f8fafc;transition:all .2s;cursor:pointer;}
.notif-item:hover{background:#f1f5f9;transform:translateX(3px);}
.notif-item:last-child{border-bottom:none;}
.notif-item-unread{background:#eff6ff;}
.notif-item-ico{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.notif-item-ttl{font-size:11px;font-weight:800;color:var(--text);}
.notif-item-msg{font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;line-height:1.4;}
.notif-item-time{font-size:9px;color:var(--light);font-weight:600;margin-top:3px;}
.notif-ft{padding:9px 14px;text-align:center;background:#f8fafc;border-top:1px solid var(--border);}

/* WCARD */
.wcard{background:#fff;border-radius:var(--r-card);box-shadow:var(--card-shadow);border:1px solid rgba(4,25,45,.05);margin-bottom:16px;overflow:hidden;}
.wcard-head{padding:13px 18px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;}
.wcard-title{font-size:10px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.09em;display:flex;align-items:center;gap:6px;}
.wcard-title i{color:var(--brand);}
.wcard-badge{font-size:9px;background:#eff6ff;color:var(--brand);font-weight:900;padding:3px 9px;border-radius:99px;}

/* ANNOUNCEMENT CAROUSEL */
.ann-carousel{position:relative;overflow:hidden;border-radius:0;}
.ann-slide{display:none;}
.ann-slide.active{display:block;}
.ann-img{width:100%;height:200px;object-fit:cover;}
.ann-content-box{padding:14px 18px;}
.ann-tag-pill{font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 8px;border-radius:99px;display:inline-block;margin-bottom:6px;}
.ann-title{font-size:15px;font-weight:900;color:var(--text);letter-spacing:.01em;}
.ann-body{font-size:12px;color:var(--text);font-weight:700;margin-top:4px;line-height:1.6;}
.ann-date{font-size:9px;color:var(--light);font-weight:600;margin-top:6px;}
.ann-nav{display:flex;align-items:center;justify-content:center;gap:6px;padding:10px;}
.ann-dot{width:7px;height:7px;border-radius:50%;background:#e2e8f0;border:none;cursor:pointer;transition:all .2s;padding:0;}
.ann-dot.active{background:var(--brand);width:20px;border-radius:99px;}

/* EVENTS */
.event-item{display:flex;align-items:flex-start;gap:12px;padding:13px 18px;border-bottom:1px solid #f8fafc;}
.event-item:last-child{border-bottom:none;}
.event-day-box{background:var(--btn-grad);color:#fff;border-radius:10px;min-width:48px;height:48px;padding:0 6px;display:flex;flex-direction:column;align-items:center;justify-content:center;flex-shrink:0;}
.event-day-num{font-size:11px;font-weight:900;line-height:1.2;text-align:center;word-break:keep-all;white-space:nowrap;}
.event-day-sm{font-size:6.5px;font-weight:700;text-transform:uppercase;opacity:.8;text-align:center;}
.etag{font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 7px;border-radius:99px;display:inline-block;margin-top:4px;}
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
.about-tab{padding:7px 14px;border-radius:8px;font-size:10px;font-weight:800;color:var(--muted);border:none;background:transparent;cursor:pointer;text-transform:uppercase;letter-spacing:.05em;transition:all .15s;font-family:inherit;white-space:nowrap;flex-shrink:0;}
.about-tab.active{background:var(--btn-grad);color:#fff;}
.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:16px;}
.about-card{background:linear-gradient(135deg,#eff6ff 0%,#f8fafc 100%);border:1px solid #bfdbfe;border-radius:12px;padding:14px;box-shadow:0 2px 8px rgba(14,83,147,0.06);transition:all .2s;}
.about-card:hover{transform:translateY(-2px);box-shadow:0 6px 14px rgba(14,83,147,0.12);border-color:#93c5fd;}
.about-ico{width:34px;height:34px;background:var(--btn-grad);border-radius:9px;display:flex;align-items:center;justify-content:center;margin-bottom:8px;}
.about-ico i{color:#fff;font-size:13px;}
.about-ttl{font-size:11px;font-weight:900;color:var(--brand-dark);margin-bottom:4px;}
.about-desc{font-size:10px;color:var(--muted);font-weight:600;line-height:1.55;}

/* LOGIN PROMPT */
.login-prompt{background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%);border:1.5px solid #bfdbfe;border-radius:var(--r-card);padding:22px 20px;margin-bottom:16px;text-align:center;}
.lp-icon{width:auto;height:auto;background:none;border-radius:0;box-shadow:none;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;}
.lp-icon i{color:var(--brand);font-size:36px;}
.lp-btns{display:flex;gap:9px;justify-content:center;flex-wrap:wrap;}

/* MODALS */
.modal-ov{position:fixed;inset:0;z-index:300;display:flex;align-items:center;justify-content:center;padding:12px;background:rgba(0,0,18,.68);backdrop-filter:blur(5px);}
.modal-box{background:#fff;width:100%;max-width:580px;border-radius:20px;box-shadow:0 20px 60px rgba(0,0,52,.35);border-bottom:5px solid var(--brand);max-height:94vh;overflow-y:auto;}
.modal-box-red{border-bottom-color:#dc2626;}
.modal-in{padding:20px;}
.modal-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;padding-bottom:13px;border-bottom:1px solid var(--border);}
.modal-ttl{font-size:13px;font-weight:900;color:var(--text);text-transform:uppercase;display:flex;align-items:center;gap:8px;}
.modal-ico{width:32px;height:32px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.modal-ico i{color:var(--brand);font-size:12px;}
.modal-ico-red{background:#fee2e2;}
.modal-ico-red i{color:#dc2626;}
.modal-close{background:none;border:none;color:var(--light);font-size:19px;cursor:pointer;line-height:1;flex-shrink:0;}
.modal-close:hover{color:var(--danger);}

/* FORMS */
.flbl{font-size:11px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:6px;}
.finput{width:100%;min-width:0;padding:12px 16px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:14px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s;}
.finput:focus{border-color:var(--brand);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fgrid2{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;}
.fgrid3{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;}
.fgrid4{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;}
.fgrp{margin-bottom:11px;}
.fspan2{grid-column:span 2;}
.fselect{appearance:none;cursor:pointer;}
.sblk{background:#f8fafc;border-radius:10px;padding:12px;margin-bottom:11px;border:1px solid var(--border);}
.sblk-ttl{font-size:9px;font-weight:900;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:8px;display:flex;align-items:center;gap:5px;}

/* DOCU GRID */
.docu-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:14px;}
.docu-pick{background:#f8fafc;border:1.5px solid var(--border);border-radius:10px;padding:10px 6px 9px;display:flex;flex-direction:column;align-items:center;gap:5px;cursor:pointer;transition:all .18s;text-align:center;}
.docu-pick:hover,.docu-pick.sel{background:var(--btn-grad);border-color:var(--brand);}
.docu-pick-ico{width:30px;height:30px;background:#eff6ff;border-radius:7px;display:flex;align-items:center;justify-content:center;transition:background .18s;}
.docu-pick-ico i{color:var(--brand);font-size:11px;transition:color .18s;}
.docu-pick:hover .docu-pick-ico,.docu-pick.sel .docu-pick-ico{background:rgba(255,255,255,.2);}
.docu-pick:hover .docu-pick-ico i,.docu-pick.sel .docu-pick-ico i{color:#fff;}
.docu-pick-lbl{font-size:7.5px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.03em;transition:color .18s;line-height:1.3;}
.docu-pick:hover .docu-pick-lbl,.docu-pick.sel .docu-pick-lbl{color:#fff;}

/* STYLED UPLOAD */
.upload-card{background:#fff;border:2px dashed #cbd5e1;border-radius:12px;padding:12px;text-align:center;cursor:pointer;transition:all .2s;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;min-height:95px;height:100%;}
.upload-card:hover{border-color:var(--brand);background:#f8fafc;}
.upload-card i{font-size:20px;color:var(--brand);opacity:.7;}
.upload-card .upload-txt{font-size:10px;font-weight:700;color:var(--muted);word-break:break-all;}

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

@media(max-width:640px){
    .duty-table-header, .duty-table-row {
        grid-template-columns: 85px 1fr auto !important;
        padding: 11px 12px !important;
        gap: 8px !important;
    }
    .rp-wrap{padding:0 10px 60px;}
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
    .modal-box{max-height:90vh;border-radius:16px;margin:8px;width:100%;}
    .modal-in{padding:16px 14px;}
    .login-notice-btns, .lp-btns { flex-direction: column; gap: 8px; }
    .login-notice-btns a, .login-notice-btns button, .lp-btns a, .lp-btns button { width: 100%; justify-content: center; }
    .ask-float{bottom:16px;right:14px;padding:10px 14px;font-size:10px;}
    .hero-carousel{min-height:220px;max-height:300px;}
    .carousel-slide{padding:24px 16px;}
    .carousel-slide h2{font-size:22px;}
    .carousel-slide p{font-size:12px;}
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

    {{-- TOAST --}}
    @if(session('success'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="toast">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,6000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="toast" style="background:#ef4444; border-left-color:#b91c1c;">
        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,8000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="toast" style="background:#ef4444; border-left-color:#b91c1c; top:65px;">
        <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
    </div>
    @endif

    @php
        $isAuth   = auth()->check();
        $authUser = auth()->user();
        $tagColors = [
            'Announcement' => ['bg'=>'#dbeafe','color'=>'#1d4ed8'],
            'Health'       => ['bg'=>'#dcfce7','color'=>'#15803d'],
            'Governance'   => ['bg'=>'#ede9fe','color'=>'#7c3aed'],
            'Community'    => ['bg'=>'#ffedd5','color'=>'#ea580c'],
            'Sanitation'   => ['bg'=>'#fef3c7','color'=>'#a16207'],
        ];
    @endphp

    <script>
    function residentPortalApp() {
        return {
            dutyOpen: false,
            tanodOpen: false,
            scheduleModal: false,
            scheduleTab: 'kagawad',
            docuModal: false,
            issueModal: false,
            profileModal: false,
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
            isAuth: {{ $isAuth ? 'true' : 'false' }},
            isVoter: {{ ($isAuth && $authUser?->is_voter) ? 'true' : 'false' }},
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
                        our_services: 'Our Services',
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
                        about_us: 'About Barangay SM2',
                        my_history: 'Your Application History',
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
                    },
                    fil: {
                        welcome: 'Maligayang Pagdating',
                        hero_title: 'Barangay San Miguel II',
                        hero_subtitle: 'Ang inyong komunidad. Aming serbisyo. Naglilingkod sa mga residente ng Dasmariñas, Cavite.',
                        duty_today: 'NAGTATRABAHO NGAYONG ARAW',
                        tanod_patrol: 'Naka-Duty na Patrol ng Tanod',
                        view_schedules: 'TINGNAN ANG MGA SKEDYUL',
                        our_services: 'Aming Mga Serbisyo',
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
                        about_us: 'Tungkol sa Barangay SM2',
                        my_history: 'Kasaysayan ng Aplikasyon',
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

            dutySchedule: [
                { day:'Monday',    name:'Hon. Teresita O. Dulay' },
                { day:'Tuesday',   name:'Hon. Virginia B. Magno' },
                { day:'Wednesday', name:'Hon. Rosemarie N. Gutierrez' },
                { day:'Thursday',  name:'Hon. Raden John V. Galeon' },
                { day:'Friday',    name:'Hon. Ian S. Punzalan' },
                { day:'Saturday',  name:'Hon. Edgardo M. Gutierrez' },
                { day:'Sunday',    name:'Hon. Renato V. Calawin' },
            ],
            get todayDay(){ return ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'][new Date().getDay()]; },
            get dutyToday(){ const d=this.dutySchedule.find(x=>x.day===this.todayDay); return d?d.name:'N/A'; },

            tanodSchedules: @json($tanodSchedulesArray ?? []),
            sosModal: false,
            sosLoading: false,
            sosSuccess: false,
            sosError: null,
            sosEmergencyType: 'general',
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
                this.sosSuccess = false;
                this.sosError = null;
                this.sosLoading = false;
                this.sosLocationStatus = 'detecting';
                this.sosLat = null;
                this.sosLng = null;
                
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (pos) => {
                            this.sosLat = pos.coords.latitude;
                            this.sosLng = pos.coords.longitude;
                            this.sosLocationStatus = 'acquired';
                        },
                        (err) => {
                            this.sosLocationStatus = 'fallback';
                        },
                        { enableHighAccuracy: true, timeout: 8000, maximumAge: 0 }
                    );
                } else {
                    this.sosLocationStatus = 'fallback';
                }
            },

            sendSosAlert() {
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
                        message: this.sosMessage,
                        home_address: @json($authUser?->resident?->address ?? ($authUser?->address ?? "Barangay San Miguel II")),
                    })
                })
                .then(res => res.json())
                .then(data => {
                    this.sosLoading = false;
                    if(data.success) {
                        this.sosSuccess = true;
                    } else {
                        this.sosError = data.message || 'Error sending SOS alert.';
                    }
                })
                .catch(err => {
                    this.sosLoading = false;
                    this.sosError = 'Network error transmitting SOS dispatch. Please call emergency hotline directly.';
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

    <div x-data="residentPortalApp()">

    {{-- HERO CAROUSEL --}}
    <div class="hero-section">
        <div class="hero-carousel">
            <div class="carousel-slide active">
                <img src="{{ asset('images/circlelogo.png') }}" style="width:54px;height:54px;border-radius:50%;object-fit:contain;margin:0 auto 10px;display:block;opacity:.9;" onerror="this.style.display='none'">
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
                                    <i class="fas fa-user-tie"></i> Official on Duty
                                </span>
                                <span class="duty-day-txt" style="margin-top:0;" x-text="todayDay"></span>
                            </div>
                            <div class="duty-name" style="font-size:16px; font-weight:900; color:#fff;" x-text="dutyToday"></div>
                        </div>
                        <div style="font-size:10.5px; color:rgba(255,255,255,0.7); font-weight:600; margin-top:8px;">
                            Barangay Kagawad of the Day
                        </div>
                    </div>

                    {{-- Column 2: On-Duty Tanod Patrol --}}
                    @php
                        $tanodShift = is_object($activeTanodToday) ? ($activeTanodToday->patrol_time ?: '10:00 PM - 1:00 AM') : ($activeTanodToday['patrol_time'] ?? '10:00 PM - 1:00 AM');
                        $tanodMembers = is_object($activeTanodToday) ? ($activeTanodToday->personnel_names ?? 'Kei, Inday, Kikay') : ($activeTanodToday['personnel_names'] ?? 'Kei, Inday, Kikay');
                        $tanodDayLabel = 'Daily';
                        if ($activeTanodToday) {
                            if (!empty($activeTanodToday->schedule_date)) {
                                $tanodDayLabel = \Carbon\Carbon::parse($activeTanodToday->schedule_date)->format('l');
                            } elseif (!empty($activeTanodToday->title)) {
                                $tanodDayLabel = $activeTanodToday->title;
                            }
                        }
                    @endphp
                    <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.14); border-radius:14px; padding:14px 16px; display:flex; flex-direction:column; justify-content:space-between;">
                        <div>
                            <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; margin-bottom:8px;">
                                <span style="font-size:9.5px; font-weight:900; color:#7dd3fc; text-transform:uppercase; letter-spacing:0.08em; display:flex; align-items:center; gap:5px;">
                                    <i class="fas fa-shield-alt"></i> <span x-text="t('tanod_patrol')">On-Duty Tanod Patrol</span>
                                </span>
                                <span style="font-size:10px; font-weight:900; background:rgba(14,165,233,0.25); color:#7dd3fc; border:1px solid rgba(14,165,233,0.4); padding:2px 8px; border-radius:99px; text-transform:uppercase;">
                                    <i class="fas fa-clock" style="font-size:9px; margin-right:3px;"></i> {{ $tanodShift }}
                                </span>
                            </div>
                            <div style="font-size:15px; font-weight:900; color:#fff; line-height:1.35; letter-spacing:0.02em;">
                                {{ $tanodMembers ?: 'Kei, Inday, Kikay' }}
                            </div>
                        </div>
                        <div style="font-size:10.5px; color:rgba(255,255,255,0.7); font-weight:600; margin-top:8px;">
                            Peace & Order Patrol Team ({{ $tanodDayLabel }})
                        </div>
                    </div>

                </div>
            </div>

            <div style="display:flex; align-items:center; justify-content:center; gap:15px; margin-bottom:20px;">
                <div class="section-lbl" style="margin-bottom:0; color:#fff; font-size:14px; text-transform:uppercase; letter-spacing:0.15em;">
                    <i class="fas fa-th-large" style="margin-right:8px; opacity:0.7;"></i> <span x-text="t('our_services')">Our Services</span>
                </div>

                @if($isAuth)
                <div class="notif-bell-wrap" @click.away="notifOpen=false">
                    <button class="notif-bell-btn" @click="notifOpen=!notifOpen; if(notifOpen) markNotifRead()" style="width:38px; height:38px; font-size:16px;">
                        <i class="fas fa-bell"></i>
                        @if($unreadNotifications->count() > 0)
                        <span class="notif-bell-badge" style="width:18px; height:18px; font-size:8px; top:-4px; right:-4px;">{{ $unreadNotifications->count() }}</span>
                        @endif
                    </button>
                    <div x-show="notifOpen" x-cloak x-transition class="notif-dropdown">
                        <div class="notif-hd">
                            <span class="notif-hlbl" x-text="t('notifications')">Notifications</span>
                            @if($unreadNotifications->count() > 0)
                            <span style="font-size:8px;background:#fee2e2;color:#dc2626;font-weight:900;padding:2px 7px;border-radius:99px;">{{ $unreadNotifications->count() }} unread</span>
                            @endif
                        </div>
                        <div style="max-height:280px;overflow-y:auto;">
                            @forelse($allNotifications as $notif)
                            @php 
                                $isUnread = is_null($notif->read_at); 
                                $type = $notif->data['type'] ?? '';
                                $targetId = (str_contains($type, 'document') || str_contains($type, 'reminder') || str_contains($type, 'appointment')) ? 'application-history' : 'incident-reports';
                            @endphp
                            <div class="notif-item {{ $isUnread ? 'notif-item-unread' : '' }}" 
                                 style="cursor:pointer;"
                                 @click="notifOpen=false; document.getElementById('{{ $targetId }}')?.scrollIntoView({behavior:'smooth'})">
                                <div class="notif-item-ico" style="background:{{ $isUnread ? '#dbeafe' : '#f1f5f9' }};">
                                    <i class="fas {{ str_contains($type, 'reminder') || str_contains($type, 'appointment') ? 'fa-clock' : ($type === 'document_received' ? 'fa-file-alt' : 'fa-bell') }}" style="color:{{ $isUnread ? '#0E5393' : '#94a3b8' }};font-size:11px;"></i>
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <div class="notif-item-ttl">{{ $notif->data['title'] ?? 'Notification' }}</div>
                                    <div class="notif-item-msg">{{ $notif->data['message'] ?? '' }}</div>
                                    <div class="notif-item-time">{{ $notif->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @empty
                            <div style="padding:30px;text-align:center;color:var(--light);">
                                <i class="fas fa-bell" style="font-size:24px;display:block;margin-bottom:7px;opacity:.2;"></i>
                                <p style="font-size:11px;font-weight:700;">No notifications yet.</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="notif-ft">
                            <span style="font-size:9px;color:var(--muted);font-weight:600;">Notifications are cleared after 30 days.</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="service-grid">
                <div class="service-card service-card-sos" @click="isAuth ? triggerEmergencySos() : window.location.href='{{ route('login') }}'">
                    <div class="service-ico" style="background: rgba(220, 38, 38, 0.4);"><i class="fas fa-exclamation-triangle" style="color:#fff; font-size: 20px;"></i></div>
                    <div class="service-name" style="color:#fff;" x-text="t('emergency_sos')">EMERGENCY / REQUEST TANOD</div>
                    <div class="service-sub" style="color:rgba(255,255,255,0.95); font-weight:700;" x-text="t('emergency_sub')">Immediate Tanod SOS Dispatch</div>
                </div>
                <div class="service-card" @click="docuModal=true; selectedDoc=''">
                    <div class="service-ico"><i class="fas fa-file-alt"></i></div>
                    <div class="service-name" x-text="t('doc_services')">Document Services</div>
                    <div class="service-sub" x-text="t('doc_services_sub')">Request certificates online</div>
                </div>
                <div class="service-card" @click="faqModal=true">
                    <div class="service-ico"><i class="fas fa-question-circle"></i></div>
                    <div class="service-name" x-text="t('faqs')">FAQs</div>
                    <div class="service-sub" x-text="t('faqs_sub')">How to use & portal guide</div>
                </div>
                <div class="service-card" @click="isAuth ? issueModal=true : window.location.href='{{ route('login') }}'">
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
            <h3 style="font-size:14px;font-weight:900;color:#1e3a5f;margin-bottom:5px;">Resident Portal Access</h3>
            <p style="font-size:11px;color:var(--muted);font-weight:600;margin-bottom:14px;line-height:1.5;">This portal is for legitimate residents. Non-residents can still request documents by clicking the service cards above and selecting "Non-Resident".</p>
            <div class="lp-btns">
                <a href="{{ route('register') }}" class="btn-grad btn-sm"><i class="fas fa-user-plus"></i> Create Account</a>
                <a href="{{ route('login') }}" class="btn-plain btn-outline btn-sm"><i class="fas fa-sign-in-alt"></i> Resident Login</a>
            </div>
        </div>
        @endif

        {{-- APPLICATION HISTORY --}}
        @if($isAuth)
        <div class="wcard" id="application-history">
            <div class="wcard-head">
                <div class="wcard-title"><i class="fas fa-history"></i> <span x-text="t('my_history')">Your Application History</span></div>
                <div class="wcard-badge">{{ $requests->count() }} <span x-text="t('requests')">requests</span></div>
            </div>
            @foreach($requests as $req)
            <div class="event-item">
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas fa-file-invoice" style="color:var(--brand);font-size:13px;"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:12px;font-weight:800;color:var(--text);">{{ ucwords(str_replace('_',' ',$req->document_type)) }}</div>
                    <div style="font-size:10px;color:var(--muted);font-weight:600;">
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
                    @if($req->status === 'disapproved' && $req->disapproval_reason)
                    <div style="background:#fee2e2;border:1px solid #fecaca;border-radius:8px;padding:6px 10px;margin-top:6px;font-size:10px;color:#dc2626;font-weight:700;">
                        <i class="fas fa-exclamation-circle"></i> Reason: {{ $req->disapproval_reason }}
                    </div>
                    @endif
                </div>
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px;">
                    <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;">{{ $req->created_at->format('M d') }}</span>
                    @if($req->status !== 'disapproved' && $req->status !== 'released' && $req->reschedule_count < 1 && $req->appointment_date)
                    <button type="button" @click="activeReq={{ json_encode($req) }}; rescheduleModal=true" 
                            style="background:none;border:none;color:var(--brand);font-size:9.5px;font-weight:800;cursor:pointer;display:flex;align-items:center;gap:3px;padding:2px 4px;border-radius:4px;"
                            onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                        <i class="fas fa-calendar-edit"></i> Reschedule
                    </button>
                    @endif
                </div>
            </div>
            @endforeach

            @if($requests->isEmpty())
            <div style="padding:30px;text-align:center;color:var(--light);">
                <i class="fas fa-folder-open" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                <p style="font-size:11px;font-weight:700;">No document requests submitted yet.</p>
            </div>
            @endif
        </div>
        @endif
        @if($isAuth)
        <div class="wcard" id="incident-reports">
            <div class="wcard-head">
                <div class="wcard-title"><i class="fas fa-shield-alt"></i> Incident Reports History</div>
                <div class="wcard-badge">{{ $issueReports->count() }} reports</div>
            </div>
            @foreach($issueReports as $rep)
            <div class="event-item">
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

            @if($issueReports->isEmpty())
            <div style="padding:30px;text-align:center;color:var(--light);">
                <i class="fas fa-clipboard-check" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                <p style="font-size:11px;font-weight:700;">No reports filed.</p>
            </div>
            @endif
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
                    <i class="fas fa-users"></i> Officials
                </button>
                <button class="about-tab" :class="eventTab==='projects'?'active':''" @click="eventTab='projects'">
                    <i class="fas fa-project-diagram"></i> Projects
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
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Project',title:{{ json_encode($proj->title) }},description:{{ json_encode($proj->description) }},image:{{ $proj->image_path?json_encode(asset('storage/'.$proj->image_path)):json_encode(null) }},images:{{ json_encode($proj->images_list) }},tag:{{ json_encode($proj->category ?? 'Barangay Project') }},date:{{ json_encode(($proj->start_date ? \Carbon\Carbon::parse($proj->start_date)->format('M d, Y') : 'Ongoing') . ($proj->completion_date ? ' - ' . \Carbon\Carbon::parse($proj->completion_date)->format('M d, Y') : '')) }}}; activeImgIndex=0; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
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
                    <i class="fas fa-info-circle"></i> About
                </button>
                <button class="about-tab" :class="aboutTab==='announcements'?'active':''" @click="aboutTab='announcements'">
                    <i class="fas fa-clock"></i> Past Updates
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
                            <div x-text="selectedDoc ? selDocObj.name+' — Request Form' : 'Online Document Services'"></div>
                            <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Barangay San Miguel II</div>
                        </div>
                    </div>
                    <button @click="docuModal=false;selectedDoc=''" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                @if($isAuth)
                <div style="display:flex;align-items:center;justify-content:space-between;background:#f8fafc;border:1px solid var(--border);border-radius:9px;padding:9px 13px;margin-bottom:12px;">
                    <span style="font-size:11px;font-weight:700;color:var(--muted);"><i class="fas fa-user-check" style="margin-right:4px;"></i>Your Status:</span>
                    <span x-show="isVoter" class="voter-free"><i class="fas fa-check-circle"></i> Registered Voter</span>
                    <span x-show="!isVoter" class="voter-pay"><i class="fas fa-user"></i> Non-Voter</span>
                </div>
                @endif

                <div x-show="!selectedDoc">
                    <p style="font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:9px;">Select Document Type</p>
                    <div class="docu-grid">
                        <template x-for="doc in docs" :key="doc.key">
                            <div class="docu-pick" @click="selectedDoc=doc.key" :class="selectedDoc===doc.key?'sel':''">
                                <div class="docu-pick-ico"><i class="fas" :class="doc.icon"></i></div>
                                <div class="docu-pick-lbl" x-text="doc.name"></div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="selectedDoc" x-transition>
                    <button @click="selectedDoc=''" class="btn-plain btn-ghost btn-sm" style="margin-bottom:12px;"><i class="fas fa-arrow-left"></i> Back</button>
                        <form action="{{ route('resident.document.request') }}" method="POST" enctype="multipart/form-data" 
                              x-data="{ 
                                cType: 'self', 
                                selfPurpose: '',
                                selfPurposeSelect: '',
                                selfPurposeCustom: '',
                                age: '{{ $isAuth ? ($resident->age ?? "") : "" }}',
                                birthday: '{{ $isAuth ? ($resident->birthday ?? "") : "" }}',
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
                                    address: '', 
                                    purpose: '', 
                                    purposeSelect: '',
                                    purposeCustom: '',
                                    contact: '', 
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
                                 }
                              }">
                        @csrf
                        <input type="hidden" name="document_type" :value="selectedDoc">

                        {{-- Claimant Selection --}}
                        <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-user-check"></i> Who is claiming this document?</div>
                                <div class="fgrid2 fgrp">
                                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-family:inherit;font-size:11px;font-weight:700;color:var(--text);">
                                        <input type="radio" name="claimant_type" value="self" x-model="cType" required style="accent-color:var(--brand);width:14px;height:14px;"> Self
                                    </label>
                                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-family:inherit;font-size:11px;font-weight:700;color:var(--text);">
                                        <input type="radio" name="claimant_type" value="authorized" x-model="cType" required style="accent-color:var(--brand);width:14px;height:14px;"> Authorized Person
                                    </label>
                                </div>
                            </div>
                            
                            {{-- AUTHORIZED THEME --}}
                            <div x-show="cType === 'authorized'" x-transition class="auth-blue-box">
                                <p style="font-size:10px;color:var(--brand);font-weight:900;margin-bottom:12px;text-transform:uppercase;display:flex;align-items:center;gap:6px;">
                                    <i class="fas fa-shield-alt"></i> Authorization Details
                                </p>
                                
                                <div class="fgrid3 fgrp" style="align-items:stretch;">
                                    <div style="display:flex;flex-direction:column;">
                                        <label class="flbl" style="min-height:30px;display:flex;align-items:flex-end;">Authorization Letter *</label>
                                        <div class="upload-card" style="flex:1;"
                                             :style="isDraggingLetter ? 'border-color:var(--brand); background:#eff6ff; transform:scale(1.02);' : (authLetterName ? 'border-color:#10b981; background:#f0fdf4;' : '')"
                                             @click="$refs.authLetter.click()"
                                             @dragover.prevent.stop="isDraggingLetter = true"
                                             @dragenter.prevent.stop="isDraggingLetter = true"
                                             @dragleave.prevent.stop="isDraggingLetter = false"
                                             @drop.prevent.stop="isDraggingLetter = false; if($event.dataTransfer.files.length){ $refs.authLetter.files = $event.dataTransfer.files; authLetterName = $event.dataTransfer.files[0].name; }">
                                            <i :class="authLetterName ? 'fas fa-check-circle' : 'fas fa-file-signature'" :style="authLetterName ? 'color:#10b981;' : ''"></i>
                                            <div class="upload-txt" :style="authLetterName ? 'color:#15803d; font-weight:800;' : ''" x-text="authLetterName ? authLetterName : 'Upload Signed Letter'"></div>
                                            <div style="font-size:8px; color:var(--light); font-weight:600;" x-text="authLetterName ? 'File selected (Click or drag new to change)' : 'Click or Drag & Drop file here'"></div>
                                            <input type="file" x-ref="authLetter" name="authorization_letter" accept="image/*,.pdf" style="display:none;" :required="cType === 'authorized'" @change="if($event.target.files.length){ authLetterName = $event.target.files[0].name; }">
                                        </div>
                                    </div>
                                    <div style="display:flex;flex-direction:column;">
                                        <label class="flbl" style="min-height:30px;display:flex;align-items:flex-end;">Valid ID of Authorized Person *</label>
                                        <div class="upload-card" style="flex:1;"
                                             :style="isDraggingId ? 'border-color:var(--brand); background:#eff6ff; transform:scale(1.02);' : (authIdName ? 'border-color:#10b981; background:#f0fdf4;' : '')"
                                             @click="$refs.authId.click()"
                                             @dragover.prevent.stop="isDraggingId = true"
                                             @dragenter.prevent.stop="isDraggingId = true"
                                             @dragleave.prevent.stop="isDraggingId = false"
                                             @drop.prevent.stop="isDraggingId = false; if($event.dataTransfer.files.length){ $refs.authId.files = $event.dataTransfer.files; authIdName = $event.dataTransfer.files[0].name; }">
                                            <i :class="authIdName ? 'fas fa-check-circle' : 'fas fa-id-card'" :style="authIdName ? 'color:#10b981;' : ''"></i>
                                            <div class="upload-txt" :style="authIdName ? 'color:#15803d; font-weight:800;' : ''" x-text="authIdName ? authIdName : 'Upload Your Valid ID'"></div>
                                            <div style="font-size:8px; color:var(--light); font-weight:600;" x-text="authIdName ? 'File selected (Click or drag new to change)' : 'Click or Drag & Drop file here'"></div>
                                            <input type="file" x-ref="authId" name="authorized_id" accept="image/*,.pdf" style="display:none;" :required="cType === 'authorized'" @change="if($event.target.files.length){ authIdName = $event.target.files[0].name; }">
                                        </div>
                                    </div>
                                    <div style="display:flex;flex-direction:column;">
                                        <label class="flbl" style="min-height:30px;display:flex;align-items:flex-end;">Valid ID of Person Being Claimed For *</label>
                                        <div class="upload-card" style="flex:1;"
                                             :style="isDraggingId2 ? 'border-color:var(--brand); background:#eff6ff; transform:scale(1.02);' : (authId2Name ? 'border-color:#10b981; background:#f0fdf4;' : '')"
                                             @click="$refs.authId2.click()"
                                             @dragover.prevent.stop="isDraggingId2 = true"
                                             @dragenter.prevent.stop="isDraggingId2 = true"
                                             @dragleave.prevent.stop="isDraggingId2 = false"
                                             @drop.prevent.stop="isDraggingId2 = false; if($event.dataTransfer.files.length){ $refs.authId2.files = $event.dataTransfer.files; authId2Name = $event.dataTransfer.files[0].name; }">
                                            <i :class="authId2Name ? 'fas fa-check-circle' : 'fas fa-user-circle'" :style="authId2Name ? 'color:#10b981;' : ''"></i>
                                            <div class="upload-txt" :style="authId2Name ? 'color:#15803d; font-weight:800;' : ''" x-text="authId2Name ? authId2Name : 'Upload Their Valid ID'"></div>
                                            <div style="font-size:8px; color:var(--light); font-weight:600;" x-text="authId2Name ? 'File selected (Click or drag new to change)' : 'Click or Drag & Drop file here'"></div>
                                            <input type="file" x-ref="authId2" name="authorized_id2" accept="image/*,.pdf" style="display:none;" :required="cType === 'authorized'" @change="if($event.target.files.length){ authId2Name = $event.target.files[0].name; }">
                                        </div>
                                    </div>
                                </div>

                                <div class="privacy-divider" style="opacity:.3;margin:18px 0;"></div>

                                {{-- Applicant Repeater --}}
                                <template x-for="(app, index) in applicants" :key="index">
                                    <div style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px dashed #bfdbfe;" :style="index === applicants.length - 1 ? 'border-bottom:none;margin-bottom:0;padding-bottom:0;' : ''">
                                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                                            <p style="font-size:10px;color:var(--brand);font-weight:900;text-transform:uppercase;">
                                                <i class="fas fa-user"></i> Applicant Details <span x-text="applicants.length > 1 ? '#' + (index + 1) : ''"></span>
                                            </p>
                                            <button type="button" x-show="applicants.length > 1" @click="applicants.splice(index, 1)" style="font-size:9px;color:var(--danger);font-weight:800;background:none;border:none;cursor:pointer;">
                                                <i class="fas fa-minus-circle"></i> REMOVE
                                            </button>
                                        </div>

                                        <div class="fgrp">
                                            <label class="flbl">Relationship to Applicant *</label>
                                            <select :name="'applicants['+index+'][relation]'" class="finput" :required="cType === 'authorized'" x-model="app.relation">
                                                <option value="">— Select Relationship —</option>
                                                <option value="Parent">Parent</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Child">Child</option>
                                                <option value="Sibling">Sibling</option>
                                                <option value="Legal Guardian">Legal Guardian</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>

                                        <div class="fgrid3 fgrp">
                                            <div>
                                                <label class="flbl">First Name * <span style="font-size:8px;opacity:.7;">(Applicant)</span></label>
                                                <input type="text" :name="'applicants['+index+'][first_name]'" class="finput" placeholder="First Name" :required="cType === 'authorized'" x-model="app.first_name">
                                            </div>
                                            <div>
                                                <label class="flbl">Middle Name</label>
                                                <input type="text" :name="'applicants['+index+'][middle_name]'" class="finput" placeholder="Middle Name" x-model="app.middle_name">
                                            </div>
                                            <div>
                                                <label class="flbl">Last Name * <span style="font-size:8px;opacity:.7;">(Applicant)</span></label>
                                                <input type="text" :name="'applicants['+index+'][last_name]'" class="finput" placeholder="Last Name" :required="cType === 'authorized'" x-model="app.last_name">
                                            </div>
                                        </div>

                                        <div class="fgrp">
                                            <label class="flbl">Complete Address (Applicant) *</label>
                                            <input type="text" :name="'applicants['+index+'][address]'" placeholder="Blk/Lot, Street, Brgy. SM2..." class="finput" :required="cType === 'authorized'" x-model="app.address">
                                        </div>

                                        {{-- Conditional Birthday/Age (Only shown when document type requires it) --}}
                                        <div x-show="selectedDoc === 'jobseeker' || selectedDoc === 'latereg'" class="fgrid2 fgrp" style="margin-top:10px;">
                                            <div>
                                                <label class="flbl">Date of Birth (Applicant)</label>
                                                <input type="date" :name="'applicants['+index+'][birthday]'" class="finput" x-model="app.birthday" 
                                                       @input="app.age = calculateAge($event.target.value)"
                                                       @change="app.age = calculateAge($event.target.value)">
                                            </div>
                                            <div>
                                                <label class="flbl">Age (Applicant)</label>
                                                <input type="number" :name="'applicants['+index+'][age]'" class="finput" placeholder="Age" x-model="app.age" readonly style="background:#f1f5f9; cursor:not-allowed;">
                                            </div>
                                        </div>

                                        <div class="fgrid2 fgrp">
                                            <div>
                                                <label class="flbl">Contact Number</label>
                                                <input type="text" :name="'applicants['+index+'][contact]'" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="finput" x-model="app.contact">
                                            </div>
                                            <div>
                                                <label class="flbl">Purpose *</label>
                                                <select class="finput fselect" x-model="app.purposeSelect" @change="if(app.purposeSelect !== 'Others') app.purpose = app.purposeSelect; else app.purpose = app.purposeCustom;" :required="cType === 'authorized'">
                                                    <option value="">— Select Purpose —</option>
                                                    <option value="Employment">Employment</option>
                                                    <option value="Scholarship / School Requirement">Scholarship / School Requirement</option>
                                                    <option value="Financial / Medical Assistance">Financial / Medical Assistance</option>
                                                    <option value="Loan Application">Loan Application</option>
                                                    <option value="ID Requirement / Postal / Passport">ID Requirement / Postal / Passport</option>
                                                    <option value="Legal / Court Requirement">Legal / Court Requirement</option>
                                                    <option value="Business Permit / Registration">Business Permit / Registration</option>
                                                    <option value="Proof of Residency">Proof of Residency</option>
                                                    <option value="Senior Citizen / PWD Benefit">Senior Citizen / PWD Benefit</option>
                                                    <option value="Local / Travel Requirement">Local / Travel Requirement</option>
                                                    <option value="Others">Others (Please Specify)</option>
                                                </select>
                                                <div x-show="app.purposeSelect === 'Others'" x-transition style="margin-top:6px;">
                                                    <input type="text" placeholder="Specify applicant's purpose..." class="finput" x-model="app.purposeCustom" @input="app.purpose = app.purposeCustom" :required="cType === 'authorized' && app.purposeSelect === 'Others'">
                                                </div>
                                                <input type="hidden" :name="'applicants['+index+'][purpose]'" :value="app.purpose">
                                                <div x-show="app.purpose && app.purpose.toLowerCase().includes('loan')" style="font-size:9px;color:var(--warn);margin-top:4px;font-weight:700;"><i class="fas fa-info-circle"></i> Note: Document requests for Loan purposes may have an associated fee.</div>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <div x-show="applicants.length < 2" style="margin-top:15px;">
                                    <button type="button" @click="applicants.push({ first_name: '', middle_name: '', last_name: '', relation: '', address: '', purpose: '', purposeSelect: '', purposeCustom: '', contact: '', age: '', birthday: '' })" class="btn-plain btn-outline btn-sm" style="width:100%;justify-content:center;border-style:dashed;background:#fff;">
                                        <i class="fas fa-plus-circle"></i> Add Another Applicant (Max 2)
                                    </button>
                                </div>

                                <p style="font-size:9px;color:var(--brand);font-weight:700;margin-top:12px;line-height:1.4;opacity:.8;">
                                    <i class="fas fa-info-circle"></i> Only <strong>2 application requests</strong> per Authorized Representative are allowed at a time.
                                </p>
                            </div>

                            {{-- SELF THEME --}}
                            <div x-show="cType === 'self'">
                                @if(!$isAuth)
                                <div class="sblk">
                                    <div class="sblk-ttl"><i class="fas fa-user"></i> Your Name</div>
                                    <div class="fgrid2 fgrp">
                                        <div><label class="flbl">First Name *</label><input type="text" name="guest_first_name" :required="cType==='self' && !{{ $isAuth ? 'true':'false' }}" class="finput" placeholder="Juan"></div>
                                        <div><label class="flbl">Last Name *</label><input type="text" name="guest_last_name" :required="cType==='self' && !{{ $isAuth ? 'true':'false' }}" class="finput" placeholder="Dela Cruz"></div>
                                    </div>
                                </div>
                                @endif
                                <div class="sblk">
                                    <div class="sblk-ttl"><i class="fas fa-info"></i> Request Details</div>
                                    <div class="fgrid2 fgrp" style="margin-bottom: 15px;">
                                        <div class="fspan2"><label class="flbl">Complete Address</label><input type="text" name="address" placeholder="Blk/Lot, Street, Brgy. SM2..." class="finput" value="{{ $isAuth ? $authUser?->address : old('address') }}" {{ $isAuth ? 'readonly style=background:#f1f5f9;cursor:not-allowed;' : '' }}></div>
                                        <div><label class="flbl">Contact Number</label><input type="text" name="contact" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="finput" value="{{ $isAuth ? $authUser?->contact_number : old('contact') }}" {{ $isAuth ? 'readonly style=background:#f1f5f9;cursor:not-allowed;' : '' }}></div>
                                        <div>
                                            <label class="flbl">Purpose *</label>
                                            <select class="finput fselect" x-model="selfPurposeSelect" @change="if(selfPurposeSelect !== 'Others') selfPurpose = selfPurposeSelect; else selfPurpose = selfPurposeCustom;" :required="cType === 'self'">
                                                <option value="">— Select Purpose —</option>
                                                <option value="Employment">Employment</option>
                                                <option value="Scholarship / School Requirement">Scholarship / School Requirement</option>
                                                <option value="Financial / Medical Assistance">Financial / Medical Assistance</option>
                                                <option value="Loan Application">Loan Application</option>
                                                <option value="ID Requirement / Postal / Passport">ID Requirement / Postal / Passport</option>
                                                <option value="Legal / Court Requirement">Legal / Court Requirement</option>
                                                <option value="Business Permit / Registration">Business Permit / Registration</option>
                                                <option value="Proof of Residency">Proof of Residency</option>
                                                <option value="Senior Citizen / PWD Benefit">Senior Citizen / PWD Benefit</option>
                                                <option value="Local / Travel Requirement">Local / Travel Requirement</option>
                                                <option value="Others">Others (Please Specify)</option>
                                            </select>
                                            <div x-show="selfPurposeSelect === 'Others'" x-transition style="margin-top:6px;">
                                                <input type="text" placeholder="Please specify your purpose..." class="finput" x-model="selfPurposeCustom" @input="selfPurpose = selfPurposeCustom" :required="cType === 'self' && selfPurposeSelect === 'Others'">
                                            </div>
                                            <input type="hidden" name="purpose" :value="selfPurpose">
                                            <div x-show="selfPurpose.toLowerCase().includes('loan')" style="font-size:9px;color:var(--warn);margin-top:4px;font-weight:700;"><i class="fas fa-info-circle"></i> Note: Document requests for Loan purposes may have an associated fee.</div>
                                        </div>
                                    </div>

                                    {{-- Conditional Birthday/Age (Only shown when document type requires it) --}}
                                    <div x-show="selectedDoc === 'jobseeker' || selectedDoc === 'latereg'" class="fgrp" style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px; margin-top: 10px;">
                                        <div>
                                            <label class="flbl">Date of Birth</label>
                                            <input type="date" name="birthday" class="finput" x-model="birthday" 
                                                   @input="age = calculateAge($event.target.value)"
                                                   @change="age = calculateAge($event.target.value)"
                                                   {{ $isAuth ? 'readonly style=background:#f1f5f9;cursor:not-allowed;' : '' }}>
                                        </div>
                                        <div>
                                            <label class="flbl">Age</label>
                                            <input type="number" name="age" class="finput" x-model="age" placeholder="Min. 15" min="15" readonly style="background:#f1f5f9; cursor:not-allowed;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div x-show="selectedDoc==='moveout'||selectedDoc==='movein'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-home"></i> Move Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Block No.</label><input type="text" name="blk" class="finput"></div>
                                <div><label class="flbl">Lot No.</label><input type="text" name="lot" class="finput"></div>
                                <div><label class="flbl">Move Date</label><input type="text" name="move_date" placeholder="e.g. March 1, 2026" class="finput"></div>
                                <div><label class="flbl">Landlord / Owner</label><input type="text" name="landlord" class="finput"></div>
                                <div class="fspan2"><label class="flbl">Family Members (comma-separated)</label><input type="text" name="family_members" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='guardianship'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user-shield"></i> Guardianship Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Ward's Full Name</label><input type="text" name="ward_name" class="finput"></div>
                                <div><label class="flbl">Ward's Age</label><input type="text" name="ward_age" class="finput"></div>
                                <div class="fspan2"><label class="flbl">Relation to Ward</label><input type="text" name="ward_relation" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='cohabitation'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user-friends"></i> Cohabitation Details</div>
                            <div class="fgrid2 fgrp">
                                <div class="fspan2"><label class="flbl">Partner's Full Name</label><input type="text" name="partner_name" class="finput"></div>
                                <div><label class="flbl">Living Together Since</label><input type="text" name="living_since" placeholder="e.g. 2020" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='cashgift'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-gift"></i> Cash Gift Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Kaano-anuhan</label><input type="text" name="claimant_name" class="finput"></div>
                                <div><label class="flbl">Relasyon</label><input type="text" name="claimant_relation" class="finput"></div>
                                <div><label class="flbl">Birthday Month</label><input type="text" name="birth_month" placeholder="e.g. February" class="finput"></div>
                                <div><label class="flbl">Birthday Year</label><input type="text" name="birth_year" placeholder="e.g. 2025" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='latereg'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-clock"></i> Late Registration Details</div>
                            <div class="fgrid2 fgrp">
                                <div class="fspan2"><label class="flbl">Child's Full Name</label><input type="text" name="child_name" class="finput"></div>
                                <div><label class="flbl">Father's Name</label><input type="text" name="father_name" class="finput"></div>
                                <div><label class="flbl">Mother's Name</label><input type="text" name="mother_name" class="finput"></div>
                                <div><label class="flbl">Birth Attendant</label><input type="text" name="birth_attendant" class="finput"></div>
                                <div><label class="flbl">Place of Birth</label><input type="text" name="born_from" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='endorsement'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-file-export"></i> Endorsement Details</div>
                            <div><label class="flbl">Residing in Brgy. SM2 Since (Year)</label><input type="text" name="residing_since" placeholder="e.g. 2018" class="finput"></div>
                        </div>
                        <div x-show="selectedDoc==='business'||selectedDoc==='closure'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-store"></i> Business Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Business / Trade Name</label><input type="text" name="company_name" class="finput"></div>
                                <div x-show="selectedDoc==='closure'"><label class="flbl">Non-Operational Since</label><input type="text" name="non_op_since" placeholder="mm/dd/yy" class="finput"></div>
                            </div>
                        </div>
                        <div x-show="selectedDoc==='yumao'" class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-ribbon"></i> Yumao Details</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">Claimant Full Name</label><input type="text" name="claimant_name" class="finput"></div>
                                <div><label class="flbl">Relasyon sa Yumao</label><input type="text" name="claimant_relation" placeholder="e.g. Asawa, Anak" class="finput"></div>
                            </div>
                        </div>

                        <div x-show="cType === 'authorized'" x-transition style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:9px;padding:12px 13px;margin-bottom:12px;font-size:11px;font-weight:700;color:#1d4ed8;line-height:1.4;">
                            <div style="margin-bottom:5px;display:flex;align-items:center;gap:6px;"><i class="fas fa-id-card"></i> <strong>IMPORTANT CLAIMING NOTE:</strong></div>
                            Please <strong>bring your Valid ID</strong> (and the <strong>Authorization Letter</strong> if you are claiming for someone else) when you pick up your documents at the Barangay Hall.
                        </div>

                        {{-- Office-Driven Pickup Notification Banner --}}
                        <div style="background:#f0f9ff;border:1.5px solid #bae6fd;border-radius:10px;padding:12px 14px;margin-bottom:14px;font-size:11px;font-weight:700;color:#0369a1;line-height:1.5;display:flex;align-items:flex-start;gap:8px;">
                            <i class="fas fa-info-circle" style="color:#0284c7;font-size:14px;margin-top:1px;flex-shrink:0;"></i>
                            <span x-text="t('office_pickup_notice')">After submitting, the barangay office will process your request and send your assigned pickup date, time window, and reference details via email.</span>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;">
                            <button type="button" @click="selectedDoc=''" class="btn-plain btn-ghost" x-text="t('cancel')">Cancel</button>
                            <button type="submit" class="btn-grad"><i class="fas fa-paper-plane"></i> <span x-text="t('submit_request')">Submit Request</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- ══ FAQs MODAL ══ --}}
    <div x-show="faqModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="max-width:520px;" @click.away="faqModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico"><i class="fas fa-question-circle"></i></div>
                        <div>
                            <div>Frequently Asked Questions</div>
                            <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Find answers to common inquiries below</div>
                        </div>
                    </div>
                    <button @click="faqModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                <div style="font-size:12px; color:#334155; line-height:1.6; padding:10px 0;">
                    <div style="margin-bottom:14px; padding: 12px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px;">
                        <div style="font-weight:800; color:#0f172a; margin-bottom: 4px;"><i class="fas fa-clock" style="margin-right:4px; color:#0E5393;"></i> Office Hours:</div>
                        Monday to Friday, 8:00 AM to 5:00 PM. We are closed on weekends and regular holidays.
                    </div>
                    <div style="margin-bottom:14px; padding: 12px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px;">
                        <div style="font-weight:800; color:#0f172a; margin-bottom: 4px;"><i class="fas fa-file-alt" style="margin-right:4px; color:#0E5393;"></i> Document Limits:</div>
                        <p style="margin-bottom: 4px;">• <strong>Authorized Reps:</strong> Max 2 active requests at a time.</p>
                        <p>• <strong>Job Seeker Cert:</strong> Can only be requested <strong>ONCE</strong> per person for their lifetime.</p>
                    </div>
                    <div style="margin-bottom:14px; padding: 12px; background:#fef2f2; border:1px solid #fecaca; border-radius:10px;">
                        <div style="font-weight:800; color:#9f1239; margin-bottom: 4px;"><i class="fas fa-exclamation-circle" style="margin-right:4px; color:#be123c;"></i> Incident Reports:</div>
                        Only <strong>one (1) active blotter/report</strong> is allowed per resident. You must wait for your current report to be resolved or closed before filing a new one.
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;margin-top:10px;">
                    <button type="button" @click="faqModal=false" class="btn-plain btn-ghost">Close Guide</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END FAQs MODAL --}}

    {{-- REPORT ISSUE MODAL --}}
    <div x-show="issueModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box modal-box-red" @click.away="issueModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico modal-ico-red"><i class="fas fa-exclamation-triangle"></i></div>
                        <div>
                            <div>Report an Issue / Concern</div>
                            <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Blotter, VAWC, Peace & Order</div>
                        </div>
                    </div>
                    <button @click="issueModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <form action="{{ route('resident.issue.report') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="fgrp">
                        <label class="flbl">Type of Offense / Complaint *</label>
                        <select name="issue_type" class="finput fselect" x-model="selectedOffense" @change="showOtherOffense = selectedOffense === 'Others'" required>
                            <option value="">— Select Type —</option>
                            <template x-for="o in offenses" :key="o"><option :value="o" x-text="o"></option></template>
                        </select>
                    </div>
                    <div x-show="showOtherOffense" x-transition class="fgrp">
                        <label class="flbl">Specify Type *</label>
                        <input type="text" name="issue_type_other" placeholder="Describe the type of offense..." class="finput">
                    </div>
                    <div class="sblk" x-data="{ isOnBehalf: false }">
                        <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant Information</div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Full Name *</label><input type="text" name="complainant_name" required class="finput" placeholder="Juan Dela Cruz" value="{{ $isAuth ? (($authUser?->first_name??'').' '.($authUser?->last_name??'')) : old('complainant_name') }}"></div>
                            <div><label class="flbl">Age *</label><input type="number" name="complainant_age" required class="finput" placeholder="Min. 18" min="18" value="{{ $isAuth ? $authUser?->age : old('complainant_age') }}"></div>
                            <div><label class="flbl">Contact Number *</label><input type="text" name="contact" required class="finput" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="{{ $isAuth ? $authUser?->contact_number : old('contact') }}"></div>
                            @if(!$isAuth)
                            <div class="fspan2"><label class="flbl">Email Address * (For notification)</label><input type="email" name="guest_email" required class="finput" placeholder="example@gmail.com"></div>
                            @endif
                            <div><label class="flbl">Gender</label>
                                <select name="complainant_gender" class="finput fselect">
                                    <option value="">Select</option>
                                    <option value="Male" @if($isAuth && ($authUser?->gender??'') === 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($isAuth && ($authUser?->gender??'') === 'Female') selected @endif>Female</option>
                                    <option value="Other" @if($isAuth && ($authUser?->gender??'') === 'Other') selected @endif>Other</option>
                                </select>
                            </div>
                            <div class="fspan2"><label class="flbl">Address</label><input type="text" name="complainant_address" class="finput" placeholder="Blk/Lot, Street, Brgy. SM2..." value="{{ $isAuth ? $authUser?->address : old('complainant_address') }}"></div>
                        </div>

                        {{-- BEHALF CHECKBOX --}}
                        <div style="margin-top: 10px; padding: 10px 12px; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 8px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 11px; font-weight: 800; color: #1e293b;">
                                <input type="checkbox" name="is_on_behalf" value="1" x-model="isOnBehalf" style="width: 16px; height: 16px; accent-color: var(--brand); cursor: pointer;">
                                <span><i class="fas fa-hands-helping" style="color: var(--brand); margin-right: 4px;"></i> Filing on behalf of a victim / dependent</span>
                            </label>
                        </div>

                        {{-- DEDICATED VICTIM INFORMATION SECTION --}}
                        <div x-show="isOnBehalf" x-transition style="margin-top: 12px; padding: 12px; background: #fdf4ff; border: 1.5px solid #f0abfc; border-radius: 10px;">
                            <div style="font-size: 9px; font-weight: 900; text-transform: uppercase; color: #a21caf; margin-bottom: 8px; display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-shield-alt"></i> Dedicated Victim Information
                            </div>
                            <div class="fgrid2 fgrp">
                                <div class="fspan2">
                                    <label class="flbl" style="color: #86198f;">Victim Full Name <span style="color:#dc2626;">*</span></label>
                                    <input type="text" name="victim_name" :required="isOnBehalf" class="finput" placeholder="Full name of victim/dependent" style="border-color: #f0abfc; background: #fff;">
                                </div>
                                <div>
                                    <label class="flbl" style="color: #86198f;">Victim Age <span style="color:#dc2626;">*</span></label>
                                    <input type="number" name="victim_age" :required="isOnBehalf" min="0" max="120" class="finput" placeholder="e.g. 14" style="border-color: #f0abfc; background: #fff;">
                                </div>
                                <div>
                                    <label class="flbl" style="color: #86198f;">Victim Gender <span style="color:#dc2626;">*</span></label>
                                    <select name="victim_gender" :required="isOnBehalf" class="finput fselect" style="border-color: #f0abfc; background: #fff;">
                                        <option value="">Select Gender</option>
                                        <option value="Female">Female</option>
                                        <option value="Male">Male</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="fspan2">
                                    <label class="flbl" style="color: #86198f;">Relationship to Complainant <span style="color:#dc2626;">*</span></label>
                                    <input type="text" name="victim_relationship" :required="isOnBehalf" class="finput" placeholder="e.g. Daughter, Son, Spouse, Sister, Neighbor, etc." style="border-color: #f0abfc; background: #fff;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sblk">
                        <div class="sblk-ttl"><i class="fas fa-user-slash"></i> Respondent Information</div>
                        <div class="fgrid2 fgrp">
                            <div class="fspan2"><label class="flbl">Respondent Full Name *</label><input type="text" name="respondent_name" required class="finput" placeholder="Name of person being reported"></div>
                            <div class="fspan2"><label class="flbl">Respondent Address</label><input type="text" name="respondent_address" class="finput" placeholder="Address of respondent"></div>
                        </div>
                    </div>
                    <div class="sblk">
                        <div class="sblk-ttl"><i class="fas fa-map-marker-alt"></i> Incident Details</div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Date & Time of Incident *</label><input type="datetime-local" name="incident_date" required class="finput" max="{{ date('Y-m-d\TH:i') }}" min="{{ date('Y-m-d\TH:i', strtotime('-6 months')) }}"></div>
                            <div><label class="flbl">Location of Incident *</label><input type="text" name="incident_location" required class="finput" placeholder="Purok, Street, Block..."></div>
                            <div class="fspan2"><label class="flbl">Description / Narration *</label><textarea name="description" rows="4" required class="finput" style="resize:vertical;" placeholder="Describe the incident in full detail..."></textarea></div>
                            <div><label class="flbl">Witness Name (Optional)</label><input type="text" name="witness_name" class="finput" placeholder="Name of witness"></div>
                            <div x-data="{ evCount: 0, isDragging: false }">
                                <label class="flbl">Upload Proof / Evidence (Optional)</label>
                                <div class="upload-card" 
                                     :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                     @click="$refs.evidenceInput.click()" 
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="isDragging = false; $refs.evidenceInput.files = $event.dataTransfer.files; evCount = $refs.evidenceInput.files.length"
                                     style="padding: 10px;">
                                    <i class="fas fa-file-upload" style="font-size:16px;"></i>
                                    <div class="upload-txt" x-text="evCount > 0 ? evCount + ' file(s) selected' : 'Click or Drag Files'" style="margin-top:4px;"></div>
                                    <input type="file" x-ref="evidenceInput" name="evidence[]" multiple accept="image/*,video/*,.pdf" style="display:none;" @change="evCount = $event.target.files.length">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:9px;padding:12px 13px;margin-bottom:12px;font-size:10px;font-weight:700;color:#7f1d1d;line-height:1.4;">
                        <div style="margin-bottom:4px;display:flex;align-items:center;gap:6px;"><i class="fas fa-exclamation-circle"></i> <strong>REPORTING POLICY:</strong></div>
                        Only <strong>one (1) active incident report</strong> is allowed per resident. Please wait for your current report to be resolved before filing another. For <strong>immediate emergencies</strong>, call <strong>911</strong> or PNP.
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:8px;">
                        <button type="button" @click="issueModal=false" class="btn-plain btn-ghost">Cancel</button>
                        <button type="submit" class="btn-grad btn-grad-red"><i class="fas fa-flag"></i> Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- VIEW ALL SCHEDULES POP-UP MODAL --}}
    <div x-show="scheduleModal" x-cloak class="modal-ov" x-transition style="z-index:9999;" @keydown.window.escape="scheduleModal=false">
        <div class="modal-box" style="max-width:640px; border-radius:20px; overflow:hidden; border-bottom:4px solid var(--brand); box-shadow:0 25px 60px rgba(0,0,52,0.4);" @click.away="scheduleModal=false">
            
            {{-- Header with Navy Gradient --}}
            <div style="background:linear-gradient(135deg,#000052 0%,#04192D 60%,#0E5393 100%); padding:20px 24px; color:#fff; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid rgba(255,255,255,0.1);">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:42px; height:42px; border-radius:12px; background:rgba(255,255,255,0.12); display:flex; align-items:center; justify-content:center; border:1px solid rgba(255,255,255,0.2);">
                        <i class="fas fa-calendar-alt" style="color:#38bdf8; font-size:18px;"></i>
                    </div>
                    <div>
                        <h3 style="font-size:15px; font-weight:900; color:#fff; text-transform:uppercase; letter-spacing:0.04em; margin:0;">
                            Barangay Duty & Patrol Schedules
                        </h3>
                        <p style="font-size:11px; color:rgba(255,255,255,0.75); font-weight:600; margin:3px 0 0 0;">
                            Official Weekly Kagawad Assignments & Tanod Security Patrol Timetable
                        </p>
                    </div>
                </div>
                <button type="button" @click="scheduleModal=false" style="background:rgba(255,255,255,0.1); border:none; color:#fff; width:34px; height:34px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:16px; transition:all .2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-in" style="padding:20px 24px;">
                {{-- Segmented Full-Width Rectangular Tabs --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; padding:4px; margin-bottom:20px; gap:4px;">
                    <button type="button" @click="scheduleTab='kagawad'"
                            :style="scheduleTab==='kagawad' 
                                ? 'background:#e0f2fe; color:#0369a1; border:1.5px solid #7dd3fc; box-shadow:0 2px 8px rgba(14,165,233,0.18); font-weight:900;' 
                                : 'background:transparent; color:#64748b; border:1.5px solid transparent; font-weight:700;'"
                            style="width:100%; padding:11px 14px; border-radius:8px; font-size:11.5px; text-transform:uppercase; letter-spacing:.05em; cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; gap:8px;">
                        <i class="fas fa-user-tie" :style="scheduleTab==='kagawad' ? 'color:#0284c7;' : 'color:#94a3b8;'"></i>
                        <span>Officer on Duty (Kagawad)</span>
                    </button>
                    <button type="button" @click="scheduleTab='tanod'"
                            :style="scheduleTab==='tanod' 
                                ? 'background:#e0f2fe; color:#0369a1; border:1.5px solid #7dd3fc; box-shadow:0 2px 8px rgba(14,165,233,0.18); font-weight:900;' 
                                : 'background:transparent; color:#64748b; border:1.5px solid transparent; font-weight:700;'"
                            style="width:100%; padding:11px 14px; border-radius:8px; font-size:11.5px; text-transform:uppercase; letter-spacing:.05em; cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center; gap:8px;">
                        <i class="fas fa-shield-alt" :style="scheduleTab==='tanod' ? 'color:#0284c7;' : 'color:#94a3b8;'"></i>
                        <span>Tanod Patrol Schedule</span>
                    </button>
                </div>

                {{-- TAB 1: Kagawad Schedule --}}
                <div x-show="scheduleTab==='kagawad'" x-transition>
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                        <div style="font-size:11px; font-weight:900; color:#0f172a; text-transform:uppercase; letter-spacing:.06em;">
                            Weekly Officer Schedule
                        </div>
                        <div style="font-size:10px; font-weight:700; color:#64748b;">
                            Monday – Sunday Rotation
                        </div>
                    </div>

                    <div class="duty-table-card">
                        <div class="duty-table-header">
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em;">Day</div>
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em;">Barangay Official</div>
                            <div style="font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:.06em; text-align:right;">Duty Status</div>
                        </div>

                        <template x-for="d in dutySchedule" :key="d.day">
                            <div class="duty-table-row"
                                 :style="d.day === todayDay 
                                    ? 'background:#eff6ff; border-left-color:#0284c7;' 
                                    : 'background:#ffffff;'">
                                <div>
                                    <span style="font-size:11.5px; font-weight:900; text-transform:uppercase; letter-spacing:.05em;"
                                          :style="d.day === todayDay ? 'color:#0284c7;' : 'color:#334155;'"
                                          x-text="d.day"></span>
                                </div>
                                <div style="min-width:0;">
                                    <div style="font-size:13px; font-weight:800; color:#0f172a; line-height:1.25;" x-text="d.name"></div>
                                    <div style="font-size:10px; color:#64748b; font-weight:600; margin-top:2px;">Barangay Kagawad of the Day</div>
                                </div>
                                <div style="text-align:right; display:flex; align-items:center; justify-content:flex-end;">
                                    <template x-if="d.day === todayDay">
                                        <span style="font-size:9.5px; font-weight:900; background:#0284c7; color:#fff; padding:4px 10px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; display:inline-flex; align-items:center; gap:5px; box-shadow:0 2px 6px rgba(2,132,199,0.25); white-space:nowrap;">
                                            <i class="fas fa-check-circle" style="font-size:9px;"></i> Active Today
                                        </span>
                                    </template>
                                    <template x-if="d.day !== todayDay">
                                        <span style="font-size:9px; font-weight:700; background:#f1f5f9; color:#94a3b8; padding:3px 8px; border-radius:99px; text-transform:uppercase; letter-spacing:.04em; white-space:nowrap;">
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
                        <div style="font-size:11px; font-weight:900; color:#0f172a; text-transform:uppercase; letter-spacing:.06em;">
                            Peace & Order Patrol Timetable
                        </div>
                        <div style="font-size:10px; font-weight:700; color:#64748b;">
                            Night & Community Watch
                        </div>
                    </div>

                    <div style="display:grid; gap:10px;">
                        <template x-for="p in tanodSchedules" :key="p.id">
                            <div style="background:#ffffff; border:1.5px solid #e2e8f0; border-radius:14px; padding:14px 16px; transition:all .2s; box-shadow:0 1px 4px rgba(0,0,0,0.03);">
                                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:10px; flex-wrap:wrap;">
                                    <div>
                                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
                                            <span style="font-size:12px; font-weight:900; color:#0284c7;" x-text="p.day_name"></span>
                                            <span style="font-size:10px; color:#64748b; font-weight:700;" x-text="'• ' + p.schedule_date"></span>
                                        </div>
                                        <div style="display:flex; align-items:center; gap:8px; margin-top:6px;">
                                            <div style="width:26px; height:26px; border-radius:7px; background:#f0f9ff; display:flex; align-items:center; justify-content:center; color:#0284c7; font-size:11px;">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div style="font-size:13px; font-weight:800; color:#0f172a;">
                                                <span style="color:#64748b; font-size:10.5px; font-weight:700;">Personnel: </span>
                                                <span x-text="p.personnel_names"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:6px;">
                                        <span style="font-size:10px; font-weight:900; background:#f0f9ff; color:#0284c7; border:1px solid #bae6fd; padding:3px 10px; border-radius:99px; text-transform:uppercase; display:inline-flex; align-items:center; gap:4px;">
                                            <i class="fas fa-clock" style="font-size:9px;"></i> <span x-text="p.patrol_time"></span>
                                        </span>
                                        <span class="duty-badge" :style="p.status === 'Completed' ? 'background:#64748b;' : 'background:#059669;'" x-text="p.status || 'Active'"></span>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <div x-show="tanodSchedules.length === 0" style="padding: 24px; text-align: center; color: #94a3b8; font-size: 11px; font-weight: 700; background:#f8fafc; border-radius:12px; border:1px dashed #cbd5e1;">
                            <i class="fas fa-shield-alt" style="font-size:24px; margin-bottom:8px; opacity:0.3; display:block;"></i>
                            No patrol schedule entries available at the moment.
                        </div>
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
                             alt="Item Image">
                        
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
                    <div style="position:relative; width:80px; height:80px; flex-shrink:0;" x-data="{ isDragging: false }">
                        <div style="width:100%;height:100%;border-radius:12px;overflow:hidden;border:2px solid #fff;box-shadow:var(--card-shadow);"
                             @if(!$canUpdatePhoto) title="You can update your photo again on {{ $nextPhotoUpdate }}" @endif>
                            <img src="{{ $authUser?->photo ? asset('storage/'.$authUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode(($authUser?->first_name??'').' '.($authUser?->last_name??'')).'&background=0E5393&color=fff&size=128&bold=true' }}"
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
                                @click="warningType='profile'; warningNextDate='{{ now()->addMonths(6)->format('M d, Y') }}'; photoWarningModal=true;" title="Change Profile Picture">
                            <i class="fas fa-camera" style="font-size:11px;"></i>
                        </button>
                        <form id="profilePhotoForm" action="{{ route('resident.profile.photo') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                            @csrf
                            <input type="file" name="photo" id="profilePhotoInput" accept="image/*" @change="document.getElementById('profilePhotoForm').submit()">
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
                        <div class="profile-field-lbl">Address</div>
                        <div class="profile-field-val">{{ $authUser?->address ?? 'N/A' }}</div>
                    </div>
                </div>

                {{-- VOTER ID UPLOAD LOGIC --}}
                @if($authUser && $authUser->voter_status === 'declined')
                <div style="background:#fee2e2;border:1.5px solid #fca5a5;border-radius:11px;padding:14px;margin-bottom:14px;" x-data="{ isDragging: false }">
                    <div style="font-size:9px;font-weight:900;color:#dc2626;text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;"><i class="fas fa-exclamation-circle" style="margin-right:4px;"></i> Voter Verification Declined</div>
                    <p style="font-size:10px;color:#991b1b;font-weight:600;margin-bottom:10px;">Reason: {{ $authUser->decline_reason ?? 'Invalid ID.' }}</p>
                    <form action="{{ route('resident.voter.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="voter_id_photo" x-ref="voterReuploadInput" id="voterProofReupload" required accept="image/*" style="display:none;" onchange="
                        if(this.files.length) { 
                            let btn = document.getElementById('btnReuploadText'); 
                            btn.innerHTML = '<i class=\'fas fa-spinner fa-spin\' style=\'margin-right:6px;\'></i> Uploading...'; 
                            btn.parentElement.style.opacity = '0.7';
                            btn.parentElement.style.pointerEvents = 'none';
                            this.form.submit(); 
                        }
                        ">
                        <label for="voterProofReupload" class="btn-grad btn-grad-red btn-sm" 
                               :style="isDragging ? 'transform:scale(1.05); filter:brightness(1.1);' : ''"
                               @dragover.prevent="isDragging = true"
                               @dragleave.prevent="isDragging = false"
                               @drop.prevent="isDragging = false; $refs.voterReuploadInput.files = $event.dataTransfer.files; $refs.voterReuploadInput.dispatchEvent(new Event('change'))"
                               style="display:inline-flex;cursor:pointer;margin:0;"><i class="fas fa-upload" style="margin-right:6px;"></i> <span id="btnReuploadText">Re-upload Proof</span></label>
                    </form>
                </div>
                @elseif($authUser && $authUser->voter_status === 'pending')
                <div style="background:#fef3c7;border:1.5px solid #fde68a;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#92400e;text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;">
                        <i class="fas fa-clock" style="margin-right:4px;"></i> Voter Verification Pending
                    </div>
                    <p style="font-size:10px;color:#b45309;font-weight:600;margin-bottom:0px;">
                         Your uploaded proof is waiting for approval by the office. You cannot resubmit while pending.
                         @if($authUser->voter_id_photo)<a href="{{ asset('storage/'.$authUser->voter_id_photo) }}" target="_blank" style="color:#d97706;font-weight:800;text-decoration:underline;margin-left:4px;">View Uploaded Photo</a>@endif
                    </p>
                </div>
                @elseif($authUser && $authUser->is_non_voter && empty($authUser->voter_status))
                <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:11px;padding:14px;margin-bottom:14px;" x-data="{ isDragging: false }">
                    <div style="font-size:9px;font-weight:900;color:var(--text);text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;"><i class="fas fa-id-card" style="margin-right:4px;"></i> Voter Verification</div>
                    <p style="font-size:10px;color:var(--muted);font-weight:600;margin-bottom:10px;">Upload a photo of your Voter ID or proof of registration to verify your status.</p>
                    <form action="{{ route('resident.voter.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="voter_id_photo" x-ref="voterUploadInput" id="voterProofUpload" required accept="image/*" style="display:none;" onchange="
                        if(this.files.length) { 
                            let btn = document.getElementById('btnUploadText'); 
                            btn.innerHTML = '<i class=\'fas fa-spinner fa-spin\' style=\'margin-right:6px;\'></i> Uploading...'; 
                            btn.parentElement.style.opacity = '0.7';
                            btn.parentElement.style.pointerEvents = 'none';
                            this.form.submit(); 
                        }
                        ">
                        <label for="voterProofUpload" class="btn-grad btn-sm" 
                               :style="isDragging ? 'transform:scale(1.05); filter:brightness(1.1);' : ''"
                               @dragover.prevent="isDragging = true"
                               @dragleave.prevent="isDragging = false"
                               @drop.prevent="isDragging = false; $refs.voterUploadInput.files = $event.dataTransfer.files; $refs.voterUploadInput.dispatchEvent(new Event('change'))"
                               style="display:inline-flex;cursor:pointer;margin:0;"><i class="fas fa-upload" style="margin-right:6px;"></i> <span id="btnUploadText">Upload Proof</span></label>
                    </form>
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
                    $myFamily = \App\Models\Resident::where('household_head_id', $authUser?->resident?->id ?? -1)
                        ->where('id', '!=', $authUser?->resident?->id ?? -1)
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
                        <button type="button" @click="profileModal=false; familyModal=true"
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
                        <button @click="profileModal=false;petModal=true"
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
                                                       @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>petPhotoPreview=e.target.result; r.readAsDataURL(f); }">
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
                                                <label class="flbl">Upload Vaccine Proof *</label>
                                                <input type="file" name="vaccine_proof" class="finput" accept="image/*,.pdf" :required="vStatusUpdate === 'pending'">
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
                            <label class="flbl">Pet Photo (1x1)</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="width:70px;height:70px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;"
                                     :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.petPhotoInput.files = $event.dataTransfer.files; $refs.petPhotoInput.dispatchEvent(new Event('change')); }">
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
                                       @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>petPhotoPreview=e.target.result; r.readAsDataURL(f) }">
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
                            <label class="flbl">Upload Vaccine Proof (Card/Record) *</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:100px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;"
                                     :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
                                     @dragover.prevent="isDragging = true"
                                     @dragleave.prevent="isDragging = false"
                                     @drop.prevent="isDragging = false; if($event.dataTransfer.files[0]){ $refs.vaccineInput.files = $event.dataTransfer.files; $refs.vaccineInput.dispatchEvent(new Event('change')); }">
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
                                       @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>vaccineProofPreview=e.target.result; r.readAsDataURL(f) }">
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
        $idPhoto = $idUser?->photo ? asset('storage/'.$idUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode(($idUser?->first_name??'R').' '.($idUser?->last_name??'')).'&background=0E5393&color=fff&size=128&bold=true';
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
                                <img src="{{ $idPhoto }}" style="width:100%;height:100%;aspect-ratio:1/1;object-fit:cover;">
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
                <form action="{{ route('resident.family.store') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="fgrid4" style="gap:7px;margin-bottom:12px;">
                        <div><label class="flbl">Birthday</label>
                            <input type="date" name="birthday" x-model="birthday" required @input="if(birthday){const bd=new Date(birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;age=a;}" @change="if(birthday){const bd=new Date(birthday);const t=new Date();let a=t.getFullYear()-bd.getFullYear();const m=t.getMonth()-bd.getMonth();if(m<0||(m===0&&t.getDate()<bd.getDate()))a--;age=a;}" class="finput" style="padding:8px;">
                        </div>
                        <div><label class="flbl">Age</label>
                            <input type="number" name="age" x-model="age" readonly class="finput" style="padding:8px;background:#e2e8f0;">
                        </div>
                        <div><label class="flbl">Voter? (Yes/No)</label>
                            <select name="is_voter" required class="finput fselect" style="padding:8px;">
                                <option value="0">No (Non-Voter)</option>
                                <option value="1">Yes (Voter)</option>
                            </select>
                        </div>
                        <div><label class="flbl">Classification</label>
                            <select name="classification" x-model="classification" class="finput fselect" style="padding:8px;">
                                <option value="">None</option>
                                <option value="PWD">PWD</option>
                                <option value="Senior">Senior</option>
                                <option value="Solo Parent">Solo Parent</option>
                                <option value="Student">Student</option>
                                <option value="Bed-ridden">Bed-ridden</option>
                            </select>
                        </div>
                    </div>

                    <div x-show="age >= 60 || classification === 'Senior'" x-transition style="margin-bottom:12px;background:#fff7ed;padding:10px;border-radius:8px;border:1px solid #fdba74;" x-data="{ isDragging: false }">
                        <label class="flbl" style="color:#c2410c;">Senior Citizen ID Proof *</label>
                        <div class="fwrap" :style="isDragging ? 'border-color:#fdba74; background:#ffedd5;' : ''"
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; $refs.seniorInput.files = $event.dataTransfer.files; $refs.seniorInput.dispatchEvent(new Event('change'))">
                            <input type="file" name="senior_proof" x-ref="seniorInput" accept="image/*,.pdf" :required="age >= 60 || classification === 'Senior'" class="finput" style="padding:6px;background:#fff;">
                        </div>
                    </div>

                    <div x-show="classification === 'PWD'" x-transition style="margin-bottom:12px;background:#faf5ff;padding:10px;border-radius:8px;border:1px solid #d8b4fe;" x-data="{ isDragging: false }">
                        <label class="flbl" style="color:#6b21a8;">PWD ID Proof *</label>
                        <div class="fwrap" :style="isDragging ? 'border-color:#d8b4fe; background:#faf5ff;' : ''"
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; $refs.pwdInput.files = $event.dataTransfer.files; $refs.pwdInput.dispatchEvent(new Event('change'))">
                            <input type="file" name="pwd_proof" x-ref="pwdInput" accept="image/*,.pdf" :required="classification === 'PWD'" class="finput" style="padding:6px;background:#fff;">
                        </div>
                    </div>

                    <div x-show="classification === 'Bed-ridden'" x-transition style="margin-bottom:12px;background:#fef2f2;padding:10px;border-radius:8px;border:1px solid #fca5a5;" x-data="{ isDragging: false }">
                        <label class="flbl" style="color:#b91c1c;">Medical Record (Bed-ridden Proof) *</label>
                        <div class="fwrap" :style="isDragging ? 'border-color:#fca5a5; background:#fef2f2;' : ''"
                             @dragover.prevent="isDragging = true"
                             @dragleave.prevent="isDragging = false"
                             @drop.prevent="isDragging = false; $refs.bedriddenInput.files = $event.dataTransfer.files; $refs.bedriddenInput.dispatchEvent(new Event('change'))">
                            <input type="file" name="bedridden_proof" x-ref="bedriddenInput" accept="image/*,.pdf" :required="classification === 'Bed-ridden'" class="finput" style="padding:6px;background:#fff;">
                        </div>
                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:9px;padding-top:10px;border-top:1px solid var(--border);">
                        <button type="submit" class="btn-grad"><i class="fas fa-save"></i> Submit Member</button>
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

    {{-- EMERGENCY SOS MODAL --}}
    <div x-show="sosModal" x-cloak class="modal-ov" x-transition style="z-index:10000;" @keydown.window.escape="if(!sosLoading) sosModal=false">
        <div class="modal-box" style="max-width:480px;border-top:5px solid #e11d48;border-radius:20px;" @click.away="if(!sosLoading) sosModal=false">
            <div class="modal-in">
                <template x-if="!sosSuccess">
                    <div>
                        <div class="modal-hd" style="margin-bottom:14px;">
                            <div class="modal-ttl">
                                <div class="modal-ico" style="background:rgba(225,29,72,0.12);color:#e11d48;"><i class="fas fa-exclamation-triangle"></i></div>
                                <div>
                                    <div style="color:#991b1b;font-weight:900;font-size:15px;">EMERGENCY SOS ALERT</div>
                                    <div style="font-size:10px;font-weight:700;color:var(--muted);text-transform:none;">Direct Dispatch to Barangay Peace & Order Patrol</div>
                                </div>
                            </div>
                            <button type="button" @click="sosModal=false" class="modal-close" :disabled="sosLoading"><i class="fas fa-times-circle"></i></button>
                        </div>

                        {{-- Geolocation status banner --}}
                        <div style="background:#fff1f2;border:1px solid #fecdd3;border-radius:12px;padding:12px 14px;margin-bottom:16px;">
                            <div style="display:flex;align-items:center;gap:8px;font-size:11px;font-weight:800;color:#be123c;">
                                <i class="fas fa-location-crosshairs" :class="sosLocationStatus==='detecting' ? 'fa-spin' : ''"></i>
                                <span>Location Dispatch Information:</span>
                            </div>
                            <div style="font-size:10.5px;color:#4c0519;font-weight:600;margin-top:4px;">
                                <template x-if="sosLat && sosLng">
                                    <span style="display:inline-flex;align-items:center;gap:4px;color:#15803d;font-weight:800;">
                                        <i class="fas fa-check-circle"></i> GPS Pinpoint Acquired (<span x-text="sosLat.toFixed(5) + ', ' + sosLng.toFixed(5)"></span>)
                                    </span>
                                </template>
                                <template x-if="!sosLat">
                                    <span style="display:inline-flex;align-items:center;gap:4px;color:#b45309;font-weight:700;">
                                        <i class="fas fa-home"></i> Using Registered Address: <strong>{{ $authUser?->resident?->address ?? ($authUser?->address ?? 'Barangay San Miguel II') }}</strong>
                                    </span>
                                </template>
                            </div>
                        </div>

                        {{-- Emergency type selector --}}
                        <div class="fgrp">
                            <label class="flbl">Emergency Nature *</label>
                            <select x-model="sosEmergencyType" class="finput fselect" style="font-weight:800;">
                                <option value="general">🚨 General Emergency / Tanod Assistance</option>
                                <option value="security">🛡️ Security Threat / Disturbance / Intruder</option>
                                <option value="medical">🚑 Medical Emergency / First Responder</option>
                                <option value="fire">🔥 Fire / Hazard Alert</option>
                                <option value="dispute">⚠️ Neighborhood Incident / Domestic Disturbance</option>
                            </select>
                        </div>

                        {{-- Optional notes --}}
                        <div class="fgrp">
                            <label class="flbl">Brief Situation Note / Landmarks (Optional)</label>
                            <textarea x-model="sosMessage" rows="2" class="finput" placeholder="e.g. Near corner sari-sari store, suspect in black shirt..." style="resize:none;"></textarea>
                        </div>

                        <template x-if="sosError">
                            <div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:8px 12px;border-radius:8px;font-size:11px;font-weight:700;margin-bottom:12px;" x-text="sosError"></div>
                        </template>

                        <div style="display:flex;gap:10px;margin-top:18px;">
                            <button type="button" @click="sosModal=false" class="btn-plain btn-ghost" style="flex:1;" :disabled="sosLoading">Cancel</button>
                            <button type="button" @click="sendSosAlert()" class="sos-btn" style="flex:2;justify-content:center;padding:12px;" :disabled="sosLoading">
                                <template x-if="!sosLoading">
                                    <span><i class="fas fa-bullhorn"></i> DISPATCH NOW</span>
                                </template>
                                <template x-if="sosLoading">
                                    <span><i class="fas fa-spinner fa-spin"></i> TRANSMITTING ALERT...</span>
                                </template>
                            </button>
                        </div>
                    </div>
                </template>

                {{-- Success State --}}
                <template x-if="sosSuccess">
                    <div style="text-align:center;padding:10px 0;">
                        <div style="width:64px;height:64px;background:#dcfce7;color:#16a34a;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:28px;box-shadow:0 0 0 8px rgba(22,163,74,0.15);">
                            <i class="fas fa-check"></i>
                        </div>
                        <h3 style="font-size:16px;font-weight:900;color:#166534;margin-bottom:6px;">DISPATCH ALERT TRANSMITTED</h3>
                        <p style="font-size:11px;color:#1e293b;font-weight:600;line-height:1.6;margin-bottom:18px;">
                            Your emergency SOS has been received with <strong>HIGHEST PRIORITY</strong> by the on-duty Barangay Police (Tanod) & Peace and Order Command.
                        </p>
                        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:10px;font-size:10.5px;color:#475569;font-weight:700;margin-bottom:20px;text-align:left;">
                            <div><i class="fas fa-shield-alt" style="color:var(--brand);margin-right:4px;"></i> On-duty patrol units are being notified.</div>
                            <div style="margin-top:4px;"><i class="fas fa-phone-alt" style="color:var(--brand);margin-right:4px;"></i> Keep your line open for Tanod dispatch verification.</div>
                        </div>
                        <button type="button" @click="sosModal=false; sosSuccess=false;" class="btn-grad" style="width:100%;justify-content:center;padding:10px;">
                            Understood & Close
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </div>

    </div>{{-- /main x-data --}}

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;background:var(--body-bg);border-top:1px solid var(--border);">
        © {{ date('Y') }} Barangay San Miguel II, Dasmariñas City ,Cavite. All rights reserved.
    </footer>

</x-app-layout>
