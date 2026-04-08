<x-app-layout>
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap');
:root{--brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;--body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;--danger:#dc2626;--success:#059669;--card-shadow:0 4px 24px rgba(4,25,45,0.13),0 1.5px 6px rgba(0,0,0,0.07);--btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);--r-card:16px;--r-btn:10px;}
*{box-sizing:border-box;margin:0;padding:0;}
html,body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--body-bg);color:var(--text);}
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
.hero-carousel{width:100%;min-height:260px;max-height:380px;position:relative;overflow:hidden;}
@media(max-width:600px){.hero-carousel{min-height:210px;max-height:300px;}}
.carousel-slide{position:absolute;inset:0;opacity:0;transition:opacity .7s ease;display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center;padding:28px 24px;}
.carousel-slide.active{opacity:1;}
.slide-tag{font-size:9px;font-weight:900;background:rgba(255,255,255,.2);color:#fff;padding:4px 12px;border-radius:99px;text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px;display:inline-block;}
.carousel-slide h2{font-size:clamp(17px,4vw,28px);font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.2;margin-bottom:8px;text-shadow:0 2px 12px rgba(0,0,0,.3);}
.carousel-slide p{font-size:clamp(11px,2vw,13px);color:rgba(255,255,255,.8);font-weight:600;max-width:520px;line-height:1.5;}
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
.navy-box{background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);border-radius:var(--r-card);padding:22px;margin-bottom:20px;box-shadow:var(--card-shadow);}
.section-lbl{font-size:9px;font-weight:900;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.1em;margin-bottom:14px;display:flex;align-items:center;gap:6px;}
.service-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;}
.service-card{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:14px;padding:18px 10px 14px;text-align:center;cursor:pointer;transition:all .2s;text-decoration:none;display:block;}
.service-card:hover{background:rgba(255,255,255,.18);border-color:rgba(255,255,255,.38);transform:translateY(-3px);}
.service-ico{width:46px;height:46px;background:rgba(255,255,255,.14);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 9px;}
.service-ico i{color:#fff;font-size:17px;}
.service-card:hover .service-ico{background:rgba(255,255,255,.26);}
.service-name{font-size:10px;font-weight:800;color:#fff;text-transform:uppercase;letter-spacing:.04em;line-height:1.3;}
.service-sub{font-size:8px;font-weight:600;color:rgba(255,255,255,.58);margin-top:2px;}

/* DUTY WIDGET */
.duty-widget{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);border-radius:12px;padding:12px 16px;margin-bottom:16px;}
.duty-widget-row{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;}
.duty-lbl{font-size:8px;font-weight:900;color:rgba(255,255,255,.55);text-transform:uppercase;letter-spacing:.1em;}
.duty-name{font-size:13px;font-weight:900;color:#fff;margin-top:2px;}
.duty-day-txt{font-size:9px;font-weight:700;color:rgba(255,255,255,.65);text-transform:uppercase;}
.duty-view-btn{background:none;border:1.5px solid rgba(255,255,255,.3);color:rgba(255,255,255,.85);font-size:9px;font-weight:800;padding:5px 12px;border-radius:99px;cursor:pointer;font-family:inherit;text-transform:uppercase;transition:all .15s;display:flex;align-items:center;gap:5px;}
.duty-view-btn:hover{background:rgba(255,255,255,.15);}
.duty-menu{background:#fff;border-radius:12px;box-shadow:var(--card-shadow);border:1px solid var(--border);overflow:hidden;margin-top:10px;}
.duty-menu-item{padding:8px 14px;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #f8fafc;gap:8px;}
.duty-menu-item:last-child{border-bottom:none;}
.duty-menu-item.today-item{background:#eff6ff;}
.duty-day-lbl{font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;width:80px;flex-shrink:0;}
.duty-name-lbl{font-size:10px;font-weight:800;color:var(--text);flex:1;}
.duty-badge{font-size:7px;font-weight:900;background:var(--brand);color:#fff;padding:2px 7px;border-radius:99px;text-transform:uppercase;}

/* NOTIF BELL */
.notif-bell-wrap{position:relative;display:inline-block;}
.notif-bell-btn{background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.3);color:#fff;width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:15px;transition:all .15s;position:relative;}
.notif-bell-btn:hover{background:rgba(255,255,255,.25);}
.notif-bell-badge{position:absolute;top:-5px;right:-5px;background:#ef4444;color:#fff;font-size:8px;font-weight:900;min-width:17px;height:17px;border-radius:99px;display:flex;align-items:center;justify-content:center;border:2px solid #04192D;padding:0 3px;}
.notif-dropdown{position:absolute;top:calc(100% + 10px);right:0;width:300px;background:#fff;border-radius:14px;box-shadow:0 10px 40px rgba(0,0,52,.25);border:1px solid var(--border);z-index:300;overflow:hidden;}
.notif-hd{padding:10px 14px;background:#f8fafc;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.notif-hlbl{font-size:9px;font-weight:900;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;}
.notif-item{display:flex;align-items:flex-start;gap:9px;padding:10px 14px;border-bottom:1px solid #f8fafc;transition:background .1s;}
.notif-item:hover{background:#f8fafc;}
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
.about-tabs{display:flex;gap:5px;padding:5px;background:#f8fafc;border-bottom:1px solid var(--border);}
.about-tab{padding:7px 14px;border-radius:8px;font-size:10px;font-weight:800;color:var(--muted);border:none;background:transparent;cursor:pointer;text-transform:uppercase;letter-spacing:.05em;transition:all .15s;font-family:inherit;}
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
.lp-icon{width:52px;height:52px;background:var(--btn-grad);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;}
.lp-icon i{color:#fff;font-size:20px;}
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
.flbl{font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:4px;}
.finput{width:100%;padding:9px 12px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;font-family:inherit;font-size:12px;font-weight:600;color:var(--text);outline:none;transition:border-color .15s;}
.finput:focus{border-color:var(--brand);background:#fff;}
.finput::placeholder{color:var(--light);font-weight:500;}
.fgrid2{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;}
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

/* BTNS */
.btn-grad{display:inline-flex;align-items:center;gap:6px;padding:10px 17px;background:var(--btn-grad);color:#fff;font-family:inherit;font-size:11px;font-weight:900;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:var(--r-btn);cursor:pointer;transition:all .18s;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,82,.28);text-decoration:none;}
.btn-grad:hover{transform:translateY(-1px);box-shadow:0 4px 14px rgba(0,0,82,.38);}
.btn-grad-red{background:linear-gradient(135deg,#dc2626 0%,#7f1d1d 100%);}
.btn-plain{display:inline-flex;align-items:center;gap:6px;padding:10px 17px;font-family:inherit;font-size:11px;font-weight:800;letter-spacing:.05em;text-transform:uppercase;border:none;border-radius:var(--r-btn);cursor:pointer;transition:all .15s;text-decoration:none;}
.btn-outline{background:transparent;color:var(--brand);border:1.5px solid var(--brand);}
.btn-outline:hover{background:var(--brand);color:#fff;}
.btn-ghost{background:#f1f5f9;color:#475569;}
.btn-ghost:hover{background:#475569;color:#fff;}
.btn-sm{padding:7px 13px;font-size:10px;}

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

/* ASK FLOAT */
.ask-float{position:fixed;bottom:22px;right:22px;z-index:200;background:var(--btn-grad);color:#fff;border:none;border-radius:50px;padding:12px 18px;font-family:inherit;font-size:11px;font-weight:900;text-transform:uppercase;letter-spacing:.06em;cursor:pointer;box-shadow:0 6px 24px rgba(0,0,82,.35);transition:all .2s;display:flex;align-items:center;gap:8px;text-decoration:none;}
.ask-float:hover{transform:translateY(-2px);}
.ask-pulse{width:9px;height:9px;background:#4ade80;border-radius:50%;animation:pulse 1.5s infinite;}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(74,222,128,.6)}50%{box-shadow:0 0 0 7px rgba(74,222,128,0)}}

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

@media(max-width:640px){
    .rp-wrap{padding:0 12px 60px;}
    .docu-grid{grid-template-columns:repeat(3,1fr);}
    .about-grid{grid-template-columns:1fr;}
    .fgrid2{grid-template-columns:1fr;}
    .fspan2{grid-column:span 1;}
    .service-grid{gap:8px;}
    .recent-ann-grid{grid-template-columns:1fr;}
    .recent-ann-list .recent-ann-card{flex-direction:column;align-items:stretch;}
    .recent-ann-list .recent-ann-img, .recent-ann-list .recent-ann-img-placeholder{width:100%;height:160px;}
    .item-modal-img-wrap{height:200px;}
    .modal-box{max-height:85vh;border-radius:16px;}
    .login-notice-btns { flex-direction: column; gap: 8px; }
    .login-notice-btns a, .login-notice-btns button { width: 100%; justify-content: center; }
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

    <div x-data="{
        dutyOpen: false,
        docuModal: false,
        issueModal: false,
        profileModal: false,
        petModal: false,
        digitalIdModal: false,
        digitalIdViewModal: false,
        notifOpen: false,
        loginNoticeModal: false,
        itemModal: false,
        activeItem: {},
        eventTab: 'events',
        viewMode: 'grid',
        filterMonth: '',
        filterYear: '',
         msgModal: false,
        msgText: '',
        msgSubject: '',
        msgSending: false,
        msgSent: false,
        selectedDoc: '',
        petTypeOther: false,
        selectedOffense: '',
        showOtherOffense: false,
        aboutTab: 'about',
        isAuth: {{ $isAuth ? 'true' : 'false' }},
        isVoter: {{ ($isAuth && $authUser?->is_voter) ? 'true' : 'false' }},
        annIdx: 0,
        annTotal: {{ $announcements->count() }},

        slides: JSON.parse(atob('{{ base64_encode(json_encode($announcements->map(function($a){ return ['tag'=>$a->tag,'title'=>$a->title,'desc'=>$a->content,'image'=>$a->image ? asset("storage/".$a->image) : null]; })->values())) }}')),
        currentSlide: 0,
        slideTimer: null,

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
            {key:'yumao',        name:'Death',        icon:'fa-ribbon'},
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
            const name = '{{ addslashes(($authUser?->first_name??"")." ".($authUser?->last_name??"")) }}'.trim();
            const email = '{{ $authUser?->email ?? "" }}';
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
                    resident_code: '{{ $authUser?->resident_code ?? "" }}'
                })
            })
            .then(() => { this.msgSending = false; this.msgSent = true; })
            .catch(() => { this.msgSending = false; this.msgSent = true; });
        },

        init(){
            if(this.slides.length > 0){
                this.slideTimer = setInterval(()=>this.nextSlide(), 5000);
            }
            window.addEventListener('open-profile-modal', () => { this.profileModal = true; });
        },
        nextSlide(){ this.currentSlide=(this.currentSlide+1)%Math.max(this.slides.length,1); },
        prevSlide(){ this.currentSlide=(this.currentSlide-1+Math.max(this.slides.length,1))%Math.max(this.slides.length,1); },
        goSlide(i){ this.currentSlide=i; clearInterval(this.slideTimer); this.slideTimer=setInterval(()=>this.nextSlide(),5000); },

        markNotifRead(){
            fetch('{{ route('resident.notifications.read') }}', {
                method:'POST',
                headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'}
            });
        }
    }">

    {{-- HERO CAROUSEL --}}
    <div class="hero-section">
        <div class="hero-carousel">
            <div class="carousel-slide active">
                <img src="{{ asset('images/circlelogo.png') }}" style="width:54px;height:54px;border-radius:50%;object-fit:contain;margin:0 auto 10px;display:block;opacity:.9;" onerror="this.style.display='none'">
                <span class="slide-tag">Welcome</span>
                <h2>Barangay San Miguel II</h2>
                <p>Your community. Our commitment. Serving residents of Dasmariñas, Cavite.</p>
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
            {{-- Notification Bell (for logged-in) --}}
            @if($isAuth)
            <div style="display:flex;justify-content:flex-end;margin-bottom:12px;">
                <div class="notif-bell-wrap" @click.away="notifOpen=false">
                    <button class="notif-bell-btn" @click="notifOpen=!notifOpen; if(notifOpen) markNotifRead()">
                        <i class="fas fa-bell"></i>
                        @if($unreadNotifications->count() > 0)
                        <span class="notif-bell-badge">{{ $unreadNotifications->count() }}</span>
                        @endif
                    </button>
                    <div x-show="notifOpen" x-cloak x-transition class="notif-dropdown">
                        <div class="notif-hd">
                            <span class="notif-hlbl">Notifications</span>
                            @if($unreadNotifications->count() > 0)
                            <span style="font-size:8px;background:#fee2e2;color:#dc2626;font-weight:900;padding:2px 7px;border-radius:99px;">{{ $unreadNotifications->count() }} unread</span>
                            @endif
                        </div>
                        <div style="max-height:280px;overflow-y:auto;">
                            @forelse($allNotifications as $notif)
                            @php $isUnread = is_null($notif->read_at); @endphp
                            <div class="notif-item {{ $isUnread ? 'notif-item-unread' : '' }}">
                                <div class="notif-item-ico" style="background:{{ $isUnread ? '#dbeafe' : '#f1f5f9' }};">
                                    <i class="fas {{ $notif->data['type'] === 'document_received' ? 'fa-file-alt' : 'fa-bell' }}" style="color:{{ $isUnread ? '#0E5393' : '#94a3b8' }};font-size:11px;"></i>
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
            </div>
            @endif

            {{-- Duty Widget --}}
            <div class="duty-widget">
                <div class="duty-widget-row">
                    <div>
                        <div class="duty-lbl"><i class="fas fa-user-tie" style="margin-right:3px;"></i> Kagawad Duty Today (8am-5pm)</div>
                        <div class="duty-day-txt" x-text="todayDay"></div>
                        <div class="duty-name" x-text="dutyToday"></div>
                    </div>
                    <button class="duty-view-btn" @click="dutyOpen=!dutyOpen">
                        <i class="fas fa-calendar-week"></i> Weekly Schedule
                        <i class="fas fa-chevron-down" :style="dutyOpen?'transform:rotate(180deg);transition:.2s':''"></i>
                    </button>
                </div>
                <div x-show="dutyOpen" x-transition class="duty-menu">
                    <template x-for="d in dutySchedule" :key="d.day">
                        <div class="duty-menu-item" :class="d.day===todayDay?'today-item':''">
                            <span class="duty-day-lbl" x-text="d.day"></span>
                            <span class="duty-name-lbl" x-text="d.name"></span>
                            <span x-show="d.day===todayDay" class="duty-badge">Active</span>
                        </div>
                    </template>
                </div>
            </div>

            <div class="section-lbl" style="justify-content: center; color: #ffffff; font-size: 18px; text-transform: none;"><i class="fas fa-th-large"></i> Our Services</div>
            <div class="service-grid">
                <div class="service-card" @click="isAuth ? (docuModal=true, selectedDoc='') : loginNoticeModal=true">
                    <div class="service-ico"><i class="fas fa-file-alt"></i></div>
                    <div class="service-name">Document Services</div>
                    <div class="service-sub">Request certificates online</div>
                </div>
                <div class="service-card" @click="isAuth ? (msgModal=true, msgSent=false, msgText='', msgSubject='') : loginNoticeModal=true">
                    <div class="service-ico"><i class="fas fa-comment-dots"></i></div>
                    <div class="service-name">Message Us</div>
                    <div class="service-sub">Ask, complain or inquire</div>
                </div>
                <div class="service-card" @click="isAuth ? issueModal=true : loginNoticeModal=true">
                    <div class="service-ico"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="service-name">Report an Issue</div>
                    <div class="service-sub">Blotter, VAWC & more</div>
                </div>
            </div>
        </div>

        {{-- LOGIN PROMPT --}}
        @if(!$isAuth)
        <div class="login-prompt">
            <div class="lp-icon"><i class="fas fa-user-lock"></i></div>
            <h3 style="font-size:14px;font-weight:900;color:#1e3a5f;margin-bottom:5px;">Create an Account or Login</h3>
            <p style="font-size:11px;color:var(--muted);font-weight:600;margin-bottom:14px;line-height:1.5;">Track your document requests, view your profile, register your pet, and request your Digital Barangay ID.</p>
            <div class="lp-btns">
                <a href="{{ route('register') }}" class="btn-grad btn-sm"><i class="fas fa-user-plus"></i> Create Account</a>
                <a href="{{ route('login') }}" class="btn-plain btn-outline btn-sm"><i class="fas fa-sign-in-alt"></i> Login</a>
            </div>
        </div>
        @endif

        {{-- APPLICATION HISTORY --}}
        @if($isAuth)
        <div class="wcard">
            <div class="wcard-head">
                <div class="wcard-title"><i class="fas fa-history"></i> Your Application History</div>
                <div class="wcard-badge">{{ $requests->count() }} requests</div>
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
                    @if($req->status === 'ready')
                    <span style="font-size:9px;font-weight:900;background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:99px;display:inline-block;margin-top:3px;">
                        <i class="fas fa-check-circle"></i> Ready for Pick-up at Brgy. Hall!
                    </span>
                    @endif
                </div>
                <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;flex-shrink:0;">{{ $req->created_at->format('M d') }}</span>
            </div>
            @endforeach

            @foreach($myMessages->whereNotNull('admin_reply') as $msg)
            <div class="event-item">
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas fa-reply" style="color:#0E5393;font-size:13px;"></i>
                </div>
                <div style="flex:1;min-width:0;" x-data="{ viewReply: false }">
                    <div style="font-size:12px;font-weight:800;color:var(--text);">Reply to Inquiry: {{ $msg->subject }}</div>
                    <div style="font-size:10px;color:var(--muted);font-weight:600;" x-show="!viewReply">
                        Office has replied to your message. <a href="#" @click.prevent="viewReply=true" style="color:#0E5393;font-weight:800;text-decoration:underline;">Click to read</a>
                    </div>
                    <div x-show="viewReply" style="display:none;font-size:11px;color:#1e3a8a;font-weight:600;background:#eff6ff;border:1px solid #bfdbfe;padding:8px 10px;border-radius:6px;margin-top:4px;white-space:pre-wrap;">{{ $msg->admin_reply }}
                        <div style="text-align:right;margin-top:4px;"><a href="#" @click.prevent="viewReply=false" style="font-size:9px;color:#0E5393;font-weight:800;"><i class="fas fa-times-circle"></i> Close</a></div>
                    </div>
                </div>
                <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;flex-shrink:0;">{{ $msg->replied_at ? \Carbon\Carbon::parse($msg->replied_at)->format('M d') : '' }}</span>
            </div>
            @endforeach

            @if($requests->isEmpty() && $myMessages->whereNotNull('admin_reply')->isEmpty())
            <div style="padding:30px;text-align:center;color:var(--light);">
                <i class="fas fa-folder-open" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                <p style="font-size:11px;font-weight:700;">No history yet.</p>
            </div>
            @endif
        </div>
        @endif

        {{-- EVENTS & ANNOUNCEMENTS (dynamic from admin) --}}
        <div class="wcard">
            <div class="about-tabs" style="margin-bottom:0;">
                <button class="about-tab" :class="eventTab==='events'?'active':''" @click="eventTab='events'">
                    <i class="fas fa-calendar-alt"></i> Events
                </button>
                <button class="about-tab" :class="eventTab==='announcements'?'active':''" @click="eventTab='announcements'">
                    <i class="fas fa-bullhorn"></i> Announcements
                </button>
            </div>

            <div x-show="eventTab==='events'" x-transition>
                @forelse($events as $evt)
                @php
                    $etColors = ['Community'=>'etag-g','Health'=>'etag-b','Sanitation'=>'etag-o','Governance'=>'etag-p'];
                    $etClass  = $etColors[$evt->tag] ?? 'etag-b';
                @endphp
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Event',title:{{ json_encode($evt->title) }},description:{{ json_encode($evt->description) }},image:{{ $evt->image?json_encode(asset('storage/'.$evt->image)):json_encode(null) }},tag:{{ json_encode($evt->tag) }},date:{{ json_encode($evt->created_at->format('M d, Y')) }},location:{{ json_encode($evt->location) }},time_range:{{ json_encode($evt->time_range) }}}; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div class="event-day-box">
                        <div class="event-day-num">{{ $evt->day_label }}</div>
                        <div class="event-day-sm">{{ \Illuminate\Support\Str::limit($evt->frequency, 6) }}</div>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:13px;font-weight:900;color:var(--text);letter-spacing:.01em;">{{ $evt->title }}</div>
                        <div style="font-size:11px;color:var(--brand);font-weight:800;margin-top:3px;line-height:1.4;">
                            @if($evt->time_range)<strong>{{ $evt->time_range }}</strong>@endif
                            @if($evt->location) • <strong>{{ $evt->location }}</strong>@endif
                        </div>
                        @if($evt->description)<div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">{{ \Illuminate\Support\Str::limit($evt->description, 80) }}</div>@endif
                        <span class="etag {{ $etClass }}">{{ $evt->tag }}</span>
                    </div>
                </div>
                @empty
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-calendar-alt" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No events scheduled yet.</p>
                </div>
                @endforelse
            </div>

            <div x-show="eventTab==='announcements'" x-transition x-cloak>
                @forelse($announcements as $ann)
                @php $tc = $tagColors[$ann->tag] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Announcement',title:{{ json_encode($ann->title) }},description:{{ json_encode($ann->content) }},image:{{ $ann->image?json_encode(asset('storage/'.$ann->image)):json_encode(null) }},tag:{{ json_encode($ann->tag) }},date:{{ json_encode($ann->created_at->format('M d, Y')) }}}; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div class="event-day-box" style="background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">
                        <i class="fas fa-bullhorn" style="font-size:18px;"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:13px;font-weight:900;color:var(--text);letter-spacing:.01em;">{{ $ann->title }}</div>
                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;">{{ \Illuminate\Support\Str::limit($ann->content, 80) }}</div>
                        <span style="font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 7px;border-radius:99px;display:inline-block;margin-top:4px;background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">{{ $ann->tag }}</span>
                    </div>
                </div>
                @empty
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-bullhorn" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No announcements available.</p>
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
                    <i class="fas fa-clock"></i> Past Week Updates
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
                    <div style="display:flex;align-items:center;gap:16px;">
                        <button @click="viewMode='list'" :style="viewMode==='list'?'color:var(--brand)':'color:var(--light)'" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:11px;font-weight:700;display:flex;align-items:center;gap:5px;transition:.2s;"><i class="fas fa-list" style="font-size:14px;"></i> List View</button>
                        <button @click="viewMode='grid'" :style="viewMode==='grid'?'color:var(--brand)':'color:var(--light)'" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:11px;font-weight:700;display:flex;align-items:center;gap:5px;transition:.2s;"><i class="fas fa-th-large" style="font-size:14px;"></i> Grid View</button>
                    </div>
                </div>
                <div :class="viewMode==='grid' ? 'recent-ann-grid' : 'recent-ann-list'">
                    @foreach($recentUpdates as $upd)
                    @php $tc = $tagColors[$upd->tag] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; @endphp
                    <div class="recent-ann-card" style="cursor:pointer;" x-show="(filterMonth === '' || '{{ $upd->created_at->format('m') }}' === filterMonth) && (filterYear === '' || '{{ $upd->created_at->format('Y') }}' === filterYear)" @click="activeItem={type:{{ json_encode($upd->type) }},title:{{ json_encode($upd->title) }},description:{{ json_encode($upd->content ?? $upd->description) }},image:{{ $upd->image?json_encode(asset('storage/'.$upd->image)):json_encode(null) }},tag:{{ json_encode($upd->tag) }},date:{{ json_encode($upd->created_at->format('M d, Y')) }},location:{{ json_encode($upd->location ?? '') }},time_range:{{ json_encode($upd->time_range ?? '') }}}; itemModal=true">
                        @if($upd->image)
                        <img src="{{ asset('storage/'.$upd->image) }}" class="recent-ann-img" alt="{{ $upd->title }}">
                        @else
                        <div class="recent-ann-img-placeholder"><i class="fas {{ $upd->type === 'Event' ? 'fa-calendar-alt' : 'fa-bullhorn' }}"></i></div>
                        @endif
                        <div class="recent-ann-body">
                            <span class="recent-ann-tag" style="background:{{ $tc['bg'] }};color:{{ $tc['color'] }};">{{ $upd->type }} • {{ $upd->tag }}</span>
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
                    <span x-show="isVoter" class="voter-free"><i class="fas fa-check-circle"></i> Registered Voter — FREE</span>
                    <span x-show="!isVoter" class="voter-pay"><i class="fas fa-coins"></i> Non-Voter — Fee applies at Hall</span>
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
                    <form action="{{ route('resident.document.request') }}" method="POST">
                        @csrf
                        <input type="hidden" name="document_type" :value="selectedDoc">
                        @if(!$isAuth)
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-user"></i> Your Name</div>
                            <div class="fgrid2 fgrp">
                                <div><label class="flbl">First Name *</label><input type="text" name="guest_first_name" required class="finput" placeholder="Juan"></div>
                                <div><label class="flbl">Last Name *</label><input type="text" name="guest_last_name" required class="finput" placeholder="Dela Cruz"></div>
                            </div>
                        </div>
                        @endif
                        <div class="sblk">
                            <div class="sblk-ttl"><i class="fas fa-info"></i> Request Details</div>
                            <div class="fgrid2 fgrp">
                                <div class="fspan2"><label class="flbl">Complete Address</label><input type="text" name="address" placeholder="Blk/Lot, Street, Brgy. SM2..." class="finput"></div>
                                <div><label class="flbl">Contact Number</label><input type="text" name="contact" placeholder="09XXXXXXXXX" class="finput"></div>
                                <div><label class="flbl">Purpose</label><input type="text" name="purpose" placeholder="e.g. Employment, Loan..." class="finput"></div>
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
                        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:9px;padding:10px 13px;margin-bottom:12px;font-size:10px;font-weight:700;color:#92400e;">
                            <i class="fas fa-info-circle" style="margin-right:4px;"></i>
                            After submitting, the office will process your request and <strong>notify you via email and notification bell</strong> when it's ready for pick-up.
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:8px;">
                            <button type="button" @click="selectedDoc=''" class="btn-plain btn-ghost">Cancel</button>
                            <button type="submit" class="btn-grad"><i class="fas fa-paper-plane"></i> Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- ══ MESSAGE THE BARANGAY MODAL ══ --}}
    {{-- INSERT THIS ENTIRE BLOCK before the REPORT ISSUE MODAL section --}}
    <div x-show="msgModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="max-width:520px;" @click.away="msgModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl">
                        <div class="modal-ico"><i class="fas fa-comment-dots"></i></div>
                        <div>
                            <div>Message the Barangay</div>
                            <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Ask, complain, inquire — the barangay office will get back to you</div>
                        </div>
                    </div>
                    <button @click="msgModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                {{-- Success state --}}
                <div x-show="msgSent" x-transition style="text-align:center;padding:30px 20px;">
                    <div style="width:64px;height:64px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                        <i class="fas fa-check" style="font-size:26px;color:#15803d;"></i>
                    </div>
                    <div style="font-size:17px;font-weight:900;color:var(--text);margin-bottom:6px;">Message Sent!</div>
                    <div style="font-size:13px;color:var(--muted);font-weight:600;line-height:1.6;">Your message has been successfully sent to the Barangay San Miguel II office. We will get back to you as soon as possible.</div>
                    <button @click="msgModal=false;msgSent=false" class="btn-grad" style="margin-top:18px;"><i class="fas fa-check"></i> Done</button>
                </div>

                {{-- Form state --}}
                <div x-show="!msgSent">
                    
                    {{-- FAQ Dropdown Accordion --}}
                    <div x-data="{ openFaq: false }" style="margin-bottom:18px;">
                        <button @click="openFaq = !openFaq" type="button" style="width:100%; display:flex; justify-content:space-between; align-items:center; padding:12px 14px; background:#eff6ff; border:1px solid #bfdbfe; border-radius:10px; cursor:pointer; text-align:left; outline:none; transition:all .2s;" onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                            <span style="font-size:12px; font-weight:800; color:#1d4ed8;"><i class="fas fa-question-circle" style="margin-right:6px;"></i> Frequently Asked Questions (FAQs)</span>
                            <i class="fas fa-chevron-down" style="font-size:12px; color:#1d4ed8; transition:transform 0.3s;" :style="openFaq ? 'transform:rotate(180deg)' : ''"></i>
                        </button>
                        <div x-show="openFaq" x-transition.opacity.duration.300ms style="margin-top:6px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:14px 16px;">
                            <div style="font-size:11px; color:#334155; line-height:1.6;">
                                <div style="margin-bottom:10px;">
                                    <span style="font-weight:800; color:#0f172a;"><i class="fas fa-clock" style="margin-right:4px; color:#0E5393;"></i> Office Hours:</span> Mon-Fri, 8:00 AM to 5:00 PM.
                                </div>
                                <div style="margin-bottom:10px;">
                                    <span style="font-weight:800; color:#0f172a;"><i class="fas fa-file-alt" style="margin-right:4px; color:#0E5393;"></i> Document Requests:</span> Processing takes 1-2 working days. Check your 'Application History' section for updates.
                                </div>
                                <div style="margin-bottom:10px;">
                                    <span style="font-weight:800; color:#0f172a;"><i class="fas fa-id-badge" style="margin-right:4px; color:#0E5393;"></i> Barangay ID:</span> Only bonafide residents of Brgy. San Miguel II can request this.
                                </div>
                                <div>
                                    <span style="font-weight:800; color:#0f172a;"><i class="fas fa-shield-alt" style="margin-right:4px; color:#0E5393;"></i> Emergency / Incidents:</span> Please use the "Report Incident" feature instead of this message box for urgent matters.
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->check())
                    @php $authU = auth()->user(); @endphp
                    <div style="display:flex;align-items:center;gap:11px;background:#f8fafc;border:1px solid var(--border);border-radius:10px;padding:11px 14px;margin-bottom:13px;">
                        <div style="width:42px;height:42px;border-radius:10px;background:var(--btn-grad);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:14px;font-weight:900;color:#fff;">
                            {{ strtoupper(substr($authU?->first_name??'R',0,1).substr($authU?->last_name??'',0,1)) }}
                        </div>
                        <div>
                            <div style="font-size:13px;font-weight:800;color:var(--text);">{{ ($authU?->first_name??'').' '.($authU?->last_name??'') }}</div>
                        </div>
                    </div>
                    @else
                    <div class="fgrid2 fgrp">
                        <div><label class="flbl">Your Name *</label><input type="text" id="msg_name" required class="finput" placeholder="Juan Dela Cruz"></div>
                        <div><label class="flbl">Your Email</label><input type="email" id="msg_email" class="finput" placeholder="email@gmail.com"></div>
                    </div>
                    @endif

                    <div class="fgrp">
                        <label class="flbl">Subject / Topic *</label>
                        <select x-model="msgSubject" class="finput fselect">
                            <option value="">— Select a topic —</option>
                            <option>General Inquiry</option>
                            <option>Document Request Status</option>
                            <option>Barangay Programs & Services</option>
                            <option>Complaint / Concern</option>
                            <option>Community Event</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="fgrp">
                        <label class="flbl">Your Message *</label>
                        <textarea x-model="msgText" required rows="5" maxlength="1000"
                                  class="finput" style="resize:vertical;"
                                  placeholder="Type your message here..."></textarea>
                        <div style="font-size:10px;color:var(--light);font-weight:600;text-align:right;margin-top:3px;">
                            <span x-text="msgText.length"></span>/1000
                        </div>
                    </div>

                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:9px;padding:10px 14px;margin-bottom:13px;font-size:11px;font-weight:700;color:#1d4ed8;">
                        <i class="fas fa-info-circle" style="margin-right:4px;"></i>
                        <strong>One-time inquiry:</strong> Your message will be received by the barangay office. We will reply to your registered email or notify you in the Application History.
                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:8px;">
                        <button type="button" @click="msgModal=false" class="btn-plain btn-ghost">Cancel</button>
                        <button type="button" class="btn-grad"
                                :disabled="msgSending || !msgText.trim()"
                                @click="sendMessage()">
                            <span x-show="!msgSending"><i class="fas fa-paper-plane"></i> Send Message</span>
                            <span x-show="msgSending"><i class="fas fa-spinner fa-spin"></i> Sending...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END MESSAGE THE BARANGAY MODAL --}}

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
                    <div class="sblk">
                        <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant Information</div>
                        <div class="fgrid2 fgrp">
                            <div><label class="flbl">Full Name *</label><input type="text" name="complainant_name" required class="finput" placeholder="Juan Dela Cruz" @if($isAuth) value="{{ ($authUser?->first_name??'').' '.($authUser?->last_name??'') }}" @endif></div>
                            <div><label class="flbl">Age</label><input type="number" name="complainant_age" class="finput" placeholder="25" min="1"></div>
                            <div><label class="flbl">Contact Number *</label><input type="text" name="contact" required class="finput" placeholder="09XXXXXXXXX"></div>
                            <div><label class="flbl">Gender</label><select name="complainant_gender" class="finput fselect"><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select></div>
                            <div class="fspan2"><label class="flbl">Address</label><input type="text" name="complainant_address" class="finput" placeholder="Blk/Lot, Street, Brgy. SM2..."></div>
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
                            <div><label class="flbl">Date & Time of Incident</label><input type="datetime-local" name="incident_date" class="finput"></div>
                            <div><label class="flbl">Location of Incident</label><input type="text" name="incident_location" class="finput" placeholder="Purok, Street, Block..."></div>
                            <div class="fspan2"><label class="flbl">Description / Narration *</label><textarea name="description" rows="4" required class="finput" style="resize:vertical;" placeholder="Describe the incident in full detail..."></textarea></div>
                        </div>
                    </div>
                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:9px;padding:10px 13px;margin-bottom:12px;font-size:10px;font-weight:700;color:#7f1d1d;">
                        <i class="fas fa-shield-alt" style="margin-right:4px;"></i>
                        For <strong>immediate emergencies</strong>, call <strong>911</strong> or PNP.
                    </div>
                    <div style="display:flex;justify-content:flex-end;gap:8px;">
                        <button type="button" @click="issueModal=false" class="btn-plain btn-ghost">Cancel</button>
                        <button type="submit" class="btn-grad btn-grad-red"><i class="fas fa-flag"></i> Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- LOGIN NOTICE MODAL --}}
    <div x-show="loginNoticeModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="max-width:440px" @click.away="loginNoticeModal=false">
            <div class="modal-in" style="text-align:center;">
                <div style="width:58px;height:58px;background:#eff6ff;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <i class="fas fa-lock" style="font-size:24px;color:var(--brand);"></i>
                </div>
                <h3 style="font-size:16px;font-weight:900;color:var(--text);margin-bottom:8px;">Sign In Required</h3>
                <p style="font-size:12px;color:var(--muted);font-weight:600;line-height:1.5;margin-bottom:20px;">
                    You must have an account to proceed with this service. This ensures your data is secure and properly tracked by the barangay office.
                </p>
                <div class="login-notice-btns" style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                    <button @click="loginNoticeModal=false" class="btn-plain btn-ghost">Cancel</button>
                    <a href="{{ route('register') }}" class="btn-grad"><i class="fas fa-user-plus"></i> Yes, Create Account</a>
                </div>
                <div style="margin-top:14px;">
                    <a href="{{ route('login') }}" style="font-size:11px;font-weight:700;color:var(--brand);text-decoration:underline;">Already have an account? Login here</a>
                </div>
            </div>
        </div>
    </div>

    {{-- FULL ITEM MODAL (EVENTS/ANNOUNCEMENTS) --}}
    <div x-show="itemModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="padding:0;overflow-y:auto;overflow-x:hidden;border-bottom:none;background:#f8fafc;max-width:640px;" @click.away="itemModal=false">
            <template x-if="activeItem.image">
                <div class="item-modal-img-wrap">
                    <img :src="activeItem.image" style="width:100%; height:auto; display:block;" alt="Item Image">
                </div>
            </template>
            <div style="padding:24px;">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px;">
                    <div>
                        <span style="font-size:9px;font-weight:900;text-transform:uppercase;padding:3px 8px;border-radius:99px;background:var(--brand);color:#fff;display:inline-block;margin-bottom:8px;" x-text="activeItem.type + ' • ' + activeItem.tag"></span>
                        <div style="font-size:18px;font-weight:900;color:var(--text);letter-spacing:.01em;line-height:1.3;" x-text="activeItem.title"></div>
                    </div>
                    <button @click="itemModal=false" style="background:none;border:none;color:var(--light);font-size:22px;cursor:pointer;line-height:1;"><i class="fas fa-times-circle"></i></button>
                </div>
                
                <div style="display:flex;flex-wrap:wrap;gap:14px;margin-bottom:18px;padding-bottom:16px;border-bottom:1px solid var(--border);">
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
                
                <div style="display:flex;justify-content:flex-end;margin-top:24px;">
                    <button @click="itemModal=false" class="btn-plain btn-ghost">Close</button>
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
                    <img src="{{ $authUser?->photo ? asset('storage/'.$authUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode(($authUser?->first_name??'').' '.($authUser?->last_name??'')).'&background=0E5393&color=fff&size=128&bold=true' }}"
                         style="width:64px;height:64px;border-radius:12px;object-fit:cover;border:2px solid #fff;box-shadow:var(--card-shadow);">
                    <div>
                        <div style="font-size:17px;font-weight:900;color:var(--text);">{{ ($authUser?->first_name??'').' '.($authUser?->last_name??'') }}</div>
                        <div style="font-size:10px;font-weight:700;color:var(--brand);text-transform:uppercase;letter-spacing:.06em;margin-top:2px;">{{ $authUser?->resident_code ?? 'NO-CODE' }}</div>
                        <div style="margin-top:5px;display:flex;gap:4px;flex-wrap:wrap;">
                            @if($authUser?->is_voter)<span style="font-size:8px;font-weight:900;background:#dbeafe;color:#1d4ed8;padding:2px 7px;border-radius:99px;">Voter</span>@endif
                            @if($authUser?->is_senior)<span style="font-size:8px;font-weight:900;background:#ffedd5;color:#ea580c;padding:2px 7px;border-radius:99px;">Senior</span>@endif
                            @if($authUser?->is_pwd)<span style="font-size:8px;font-weight:900;background:#ede9fe;color:#7c3aed;padding:2px 7px;border-radius:99px;">PWD</span>@endif
                            @if($authUser?->is_single_parent)<span style="font-size:8px;font-weight:900;background:#fce7f3;color:#be185d;padding:2px 7px;border-radius:99px;">Solo Parent</span>@endif
                        </div>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px;">
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

                {{-- DIGITAL ID --}}
                <div style="background:linear-gradient(135deg,#eff6ff,#dbeafe);border:1.5px solid #bfdbfe;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#1d4ed8;text-transform:uppercase;letter-spacing:.07em;margin-bottom:10px;"><i class="fas fa-id-card" style="margin-right:4px;"></i> Digital Barangay ID</div>
                    @if($digitalId && $digitalId->status === 'generated')
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                        <div>
                            <span style="font-size:10px;font-weight:900;background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:99px;"><i class="fas fa-check-circle"></i> ID Generated</span>
                            <div style="font-size:10px;color:#64748b;font-weight:600;margin-top:5px;">ID No: <strong style="color:#0f172a;">{{ $digitalId->id_number }}</strong></div>
                        </div>
                        <button @click="profileModal=false;digitalIdViewModal=true" class="btn-grad btn-sm"><i class="fas fa-id-card"></i> View ID</button>
                    </div>
                    @elseif($digitalId && $digitalId->status === 'pending')
                    <span style="font-size:10px;font-weight:900;background:#fef3c7;color:#a16207;padding:3px 10px;border-radius:99px;"><i class="fas fa-clock"></i> Pending — Being processed by the office</span>
                    @elseif($authUser && $authUser->resident)
                    <p style="font-size:10px;color:#475569;font-weight:600;margin-bottom:10px;">Request your official Digital Barangay ID.</p>
                    <button @click="profileModal=false;digitalIdModal=true" class="btn-grad btn-sm"><i class="fas fa-id-card-alt"></i> Request Digital ID</button>
                    @else
                    <p style="font-size:10px;color:#475569;font-weight:600;margin-bottom:10px;">You must have a verified resident profile on the masterlist to request an ID.</p>
                    <button disabled class="btn-grad btn-sm" style="background:#94a3b8;cursor:not-allowed;box-shadow:none;"><i class="fas fa-lock"></i> Masterlist Verification Required</button>
                    @endif
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
                                <button @click="editingPet={{ json_encode(['id'=>$pet->id,'name'=>$pet->pet_name??$pet->pet_type,'status'=>$pet->status]) }};petStatusModal=true"
                                        style="background:none;border:none;cursor:pointer;color:inherit;font-size:9px;padding:0 0 0 3px;" title="Update status">
                                    <i class="fas fa-edit"></i>
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

                    {{-- PET STATUS MODAL --}}
                    <div x-show="petStatusModal" x-cloak class="modal-ov" x-transition style="z-index:400;">
                        <div class="modal-box" style="max-width:360px;" @click.away="petStatusModal=false">
                            <div class="modal-in">
                                <div class="modal-hd">
                                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-paw"></i></div> Update Pet Status</div>
                                    <button @click="petStatusModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                                </div>
                                <p style="font-size:12px;font-weight:700;color:var(--muted);margin-bottom:14px;">Update status for: <strong x-text="editingPet?.name" style="color:var(--text);"></strong></p>
                                <template x-if="editingPet">
                                    <form :action="'/pets/'+editingPet.id+'/status'" method="POST">
                                        @csrf @method('PATCH')
                                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:16px;">
                                            <label style="cursor:pointer;">
                                                <input type="radio" name="status" value="alive" :checked="editingPet.status==='alive'" style="display:none;" class="peer">
                                                <div style="border:2px solid var(--border);border-radius:10px;padding:12px;text-align:center;transition:all .15s;cursor:pointer;"
                                                     :style="editingPet.status==='alive'?'border-color:#15803d;background:#dcfce7;':''">
                                                    <i class="fas fa-heart" style="color:#15803d;font-size:18px;display:block;margin-bottom:5px;"></i>
                                                    <div style="font-size:11px;font-weight:900;color:#15803d;">Alive & Well</div>
                                                </div>
                                            </label>
                                            <label style="cursor:pointer;">
                                                <input type="radio" name="status" value="deceased" :checked="editingPet.status==='deceased'" style="display:none;" class="peer">
                                                <div style="border:2px solid var(--border);border-radius:10px;padding:12px;text-align:center;transition:all .15s;cursor:pointer;"
                                                     :style="editingPet.status==='deceased'?'border-color:#94a3b8;background:#f1f5f9;':''">
                                                    <i class="fas fa-dove" style="color:#94a3b8;font-size:18px;display:block;margin-bottom:5px;"></i>
                                                    <div style="font-size:11px;font-weight:900;color:#94a3b8;">Crossed the Bridge</div>
                                                </div>
                                            </label>
                                        </div>
                                        <div style="display:flex;gap:8px;justify-content:flex-end;">
                                            <button type="button" @click="petStatusModal=false" class="btn-plain btn-ghost btn-sm">Cancel</button>
                                            <button type="submit" class="btn-grad btn-sm"><i class="fas fa-save"></i> Save</button>
                                        </div>
                                    </form>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;">
                    <button @click="profileModal=false" class="btn-grad btn-sm"><i class="fas fa-check"></i> Done</button>
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
                <form action="{{ url('/pets/store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resident_id" value="{{ $authUser?->id }}">
                    <div class="fgrp"><label class="flbl">Pet Name</label><input type="text" name="pet_name" placeholder="e.g. Bantay, Muning..." class="finput"></div>
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
                                <input type="radio" name="pet_type" value="{{ $type }}" @change="petTypeOther='{{ $type }}'==='Others'" class="hidden" required>
                                <div class="pet-type-card">
                                    {{ $emoji }} {{ $type }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <div x-show="petTypeOther"><input type="text" name="pet_type_other" placeholder="Specify pet type..." class="finput"></div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:11px;">
                        <div><label class="flbl">Breed</label><input type="text" name="breed" placeholder="e.g. Aspin" class="finput"></div>
                        <div><label class="flbl">Age (yrs)</label><input type="number" name="age" min="0" class="finput"></div>
                        <div><label class="flbl">Months</label><input type="number" name="months" min="0" max="11" class="finput"></div>
                    </div>
                    <div class="fgrp">
                        <label class="flbl">Vaccine Status</label>
                        <select name="vaccine_status" class="finput fselect">
                            <option value="Unvaccinated">Unvaccinated</option>
                            <option value="Vaccinated">Vaccinated</option>
                            <option value="Partial">Partially Vaccinated</option>
                        </select>
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
                        <div class="fgrp"><label class="flbl">Contact Number *</label><input type="text" name="contact_person_number" required class="finput" placeholder="09XXXXXXXXX"></div>
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
    <div x-show="digitalIdViewModal" x-cloak class="modal-ov" x-transition x-data="{ idView: 'front' }">
        <div class="modal-box" style="max-width:480px;" @click.away="digitalIdViewModal=false">
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

                {{-- FRONT CARD --}}
                <div x-show="idView==='front'" style="border:1.5px solid #ccc;border-radius:8px;overflow:hidden;background:#fff;font-family:Arial,sans-serif;">
                    <div style="padding:12px 14px 10px;">
                        <div style="text-align:center;margin-bottom:8px;">
                            <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:3px;">
                                <img src="{{ asset('images/dasma.png') }}" style="width:32px;height:32px;object-fit:contain;" onerror="this.style.display='none'">
                                <img src="{{ asset('images/brgysm2_logo.png') }}" style="width:32px;height:32px;object-fit:contain;" onerror="this.style.display='none'">
                            </div>
                            <p style="font-size:7px;font-weight:900;color:#222;margin:0;letter-spacing:.03em;">REPUBLIC OF THE PHILIPPINES • PROVINCE OF CAVITE • CITY OF DASMARIÑAS</p>
                            <p style="font-size:13px;font-weight:900;color:#111;margin:2px 0 1px;">BARANGAY SAN MIGUEL 2</p>
                            <p style="font-size:7px;font-weight:700;color:#555;letter-spacing:.1em;margin-bottom:6px;">RESIDENCE IDENTIFICATION CARD</p>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:11px;">
                            <div style="flex-shrink:0;text-align:center;">
                                <div style="width:72px;height:82px;border:2px solid #aaa;border-radius:5px;overflow:hidden;background:#e8e8e8;display:flex;align-items:center;justify-content:center;">
                                    <img src="{{ $idPhoto }}" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <p style="font-size:6px;font-weight:900;color:#333;margin-top:2px;letter-spacing:.03em;">BARANGAY ID NO.</p>
                                <p style="font-size:6.5px;font-weight:900;color:#111;">{{ $idCode }}</p>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <p style="font-size:12px;font-weight:900;color:#111;line-height:1.2;margin:0 0 4px;word-break:break-word;">{{ $idFullName }}</p>
                                <p style="font-size:7px;font-weight:900;color:#666;letter-spacing:.05em;margin:0 0 1px;">ADDRESS:</p>
                                <p style="font-size:8.5px;font-weight:700;color:#111;line-height:1.3;margin:0 0 5px;word-break:break-word;">{{ strtoupper($idAddress) }}</p>
                                <p style="font-size:7px;font-weight:900;color:#666;letter-spacing:.05em;margin:0 0 1px;">DATE OF BIRTH:</p>
                                <p style="font-size:9.5px;font-weight:900;color:#111;margin:0 0 6px;">{{ strtoupper($idBirthday) }}</p>
                                <div style="display:flex;justify-content:space-between;gap:7px;">
                                    <div><p style="font-size:6px;font-weight:700;color:#666;letter-spacing:.07em;margin:0;">DATE ISSUED</p><p style="font-size:8px;font-weight:900;color:#111;margin:0;">{{ $idIssued }}</p></div>
                                    <div><p style="font-size:6px;font-weight:700;color:#666;letter-spacing:.07em;margin:0;">VALID UNTIL</p><p style="font-size:8px;font-weight:900;color:#111;margin:0;">{{ $idValid }}</p></div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:6px;border-top:1px solid #bbb;padding-top:3px;"><p style="font-size:6.5px;color:#666;margin:0;">SIGNATURE OF CARDHOLDER</p><div style="height:12px;"></div></div>
                    </div>
                </div>

                {{-- BACK CARD --}}
                <div x-show="idView==='back'" style="border:1.5px solid #ccc;border-radius:8px;overflow:hidden;background:#fff;font-family:Arial,sans-serif;position:relative;">
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:.06;pointer-events:none;"><img src="{{ asset('images/brgysm2_logo.png') }}" style="width:120px;height:120px;object-fit:contain;" onerror=""></div>
                    <div style="position:relative;z-index:1;padding:10px 12px;">
                        {{-- Emergency Contact Box --}}
                        <div style="border:2px solid #111;border-radius:4px;padding:6px 10px;margin-bottom:8px;background:#fff;min-height:42px;">
                            <p style="font-size:6px;font-weight:700;color:#555;letter-spacing:.08em;text-align:center;margin:0 0 2px;">— CONTACT PERSON IN CASE OF EMERGENCY —</p>
                            <p style="font-size:11px;font-weight:900;color:#111;text-align:center;margin:0 0 1px;">{{ strtoupper($digitalId->contact_person ?? '___________________________') }}</p>
                            <p style="font-size:7.5px;font-weight:700;color:#333;text-align:center;margin:0;">CONTACT NO: {{ $digitalId->contact_person_number ?? '_______________' }}</p>
                        </div>
                        {{-- Non-transferable + QR --}}
                        <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:7px;">
                            <div style="flex:1;min-width:0;">
                                <p style="font-size:7.5px;font-weight:900;color:#111;margin:0 0 3px;"><strong>THIS CARD IS NON - TRANSFERABLE</strong></p>
                                <p style="font-size:6px;color:#333;line-height:1.6;margin:0 0 5px;">THE CARD HOLDER IS A BONAFIDE RESIDENT OF THIS BARANGAY. IF THIS ID IS FOUND, KINDLY RETURN TO THE BARANGAY SECRETARIAT.</p>
                                <p style="font-size:7px;font-weight:900;color:#111;margin:0 0 1px;"><strong>NOTE:</strong></p>
                                <p style="font-size:5.8px;color:#333;line-height:1.6;margin:0;">THIS CARD IS VALID IF SIGNED BY THE BARANGAY CHAIRMAN. LOSS OF THIS CARD MUST BE REPORTED IMMEDIATELY TO THE BARANGAY HALL.</p>
                            </div>
                            <div style="flex-shrink:0;text-align:center;">
                                <div style="width:68px;height:68px;background:white;border:2px solid #000;border-radius:3px;padding:2px;display:flex;align-items:center;justify-content:center;">
                                    <canvas id="resident-qr-canvas" width="62" height="62" style="display:block;"></canvas>
                                </div>
                                <p style="font-size:5px;color:#888;margin-top:1px;">{{ $idCode }}</p>
                            </div>
                        </div>
                        {{-- Signature --}}
                        <div style="margin-top:4px;">
                            <div style="height:16px;"></div>
                            <div style="border-top:1.5px solid #000;display:inline-block;min-width:140px;padding-top:2px;">
                                <p style="font-weight:900;font-size:7.5px;text-transform:uppercase;letter-spacing:.02em;margin:0;">HON. MARVIN M. BENIS</p>
                                <p style="font-size:6.5px;margin:0;">PUNONG BARANGAY</p>
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

    <script>
    document.addEventListener('alpine:init', () => {
        document.addEventListener('shown-id-back', () => {
            setTimeout(()=>{
                const canvas = document.getElementById('resident-qr-canvas');
                if(!canvas) return;
                try {
                    const url = window.location.origin + '/resident?id={{ $idCode }}';
                    const ctx = canvas.getContext('2d'), size = 62;
                    ctx.fillStyle='#fff'; ctx.fillRect(0,0,size,size);
                    const qr = qrcode(0,'M'); qr.addData(url); qr.make();
                    ctx.fillStyle='#000';
                    const mc=qr.getModuleCount(),cs=Math.floor(size/mc),mg=Math.floor((size-cs*mc)/2);
                    for(let r=0;r<mc;r++) for(let c=0;c<mc;c++) if(qr.isDark(r,c)) ctx.fillRect(mg+c*cs,mg+r*cs,cs,cs);
                } catch(e){}
            }, 100);
        });
    });
    // Auto-generate QR when back is shown
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[\@click*="idView=\'back\'"]').forEach(btn => {
            btn.addEventListener('click', () => {
                setTimeout(()=>{
                    const canvas = document.getElementById('resident-qr-canvas');
                    if(!canvas) return;
                    try {
                        const url = '{{ url("/resident?id=".$idCode) }}';
                        const ctx = canvas.getContext('2d'), size = 62;
                        ctx.fillStyle='#fff'; ctx.fillRect(0,0,size,size);
                        const qr = qrcode(0,'M'); qr.addData(url); qr.make();
                        ctx.fillStyle='#000';
                        const mc=qr.getModuleCount(),cs=Math.floor(size/mc),mg=Math.floor((size-cs*mc)/2);
                        for(let r=0;r<mc;r++) for(let c=0;c<mc;c++) if(qr.isDark(r,c)) ctx.fillRect(mg+c*cs,mg+r*cs,cs,cs);
                    } catch(e){}
                }, 150);
            });
        });
    });
    </script>
    @endif
    @endif

    {{-- ASK FLOAT --}}
    <a href="https://www.facebook.com/share/1KroHtkCf9/" target="_blank" class="ask-float">
        <div class="ask-pulse"></div>
        <i class="fab fa-facebook-messenger"></i> Ask Here
    </a>

    </div>{{-- /x-data --}}

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;background:var(--body-bg);border-top:1px solid var(--border);">
        © {{ date('Y') }} Barangay SM2 Management System. All rights reserved.
    </footer>

</x-app-layout>
