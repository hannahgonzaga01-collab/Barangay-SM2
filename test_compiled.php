<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
.fgrid3{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;}
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
.upload-card{background:#fff;border:2px dashed #cbd5e1;border-radius:12px;padding:12px;text-align:center;cursor:pointer;transition:all .2s;display:flex;flex-direction:column;align-items:center;gap:6px;}
.upload-card:hover{border-color:var(--brand);background:#f8fafc;}
.upload-card i{font-size:20px;color:var(--brand);opacity:.7;}
.upload-card .upload-txt{font-size:10px;font-weight:700;color:var(--muted);word-break:break-all;}

/* AUTH BLUE THEME */
.auth-blue-box{background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%);border:1.5px solid #bfdbfe;border-radius:14px;padding:16px;margin-bottom:12px;box-shadow:0 4px 12px rgba(14,83,147,0.08);}
.auth-blue-box .flbl{color:var(--brand);opacity:.8;}
.auth-blue-box .sblk-ttl{color:var(--brand);font-weight:900;}

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
    .fgrid2,.fgrid3{grid-template-columns:1fr;}
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

     <?php $__env->slot('header', null, []); ?>  <?php $__env->endSlot(); ?>

    
    <div x-data="{ accepted: localStorage.getItem('brgy_privacy_v4') === '1', checked: false }"
         x-show="!accepted" x-cloak class="privacy-overlay">
        <div class="privacy-box">
            <div class="privacy-head">
                <img src="<?php echo e(asset('images/circlelogo.png')); ?>" class="privacy-seal" onerror="this.style.display='none'">
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

    
    <?php if(session('success')): ?>
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,4000)"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="toast">
        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php
        $isAuth   = auth()->check();
        $authUser = auth()->user();
        $tagColors = [
            'Announcement' => ['bg'=>'#dbeafe','color'=>'#1d4ed8'],
            'Health'       => ['bg'=>'#dcfce7','color'=>'#15803d'],
            'Governance'   => ['bg'=>'#ede9fe','color'=>'#7c3aed'],
            'Community'    => ['bg'=>'#ffedd5','color'=>'#ea580c'],
            'Sanitation'   => ['bg'=>'#fef3c7','color'=>'#a16207'],
        ];
    ?>

    <div x-data="{
        dutyOpen: false,
        docuModal: false,
        issueModal: false,
        profileModal: false,
        petModal: false,
        digitalIdModal: false,
        digitalIdViewModal: false,
        idView: 'front',
        notifOpen: false,
        loginNoticeModal: false,
        resStep: 'ask', // 'ask', 'resident', 'non-resident'
        idProofPreview: null,
        itemModal: false,
        activeItem: {},
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
        isAuth: <?php echo e($isAuth ? 'true' : 'false'); ?>,
        isVoter: <?php echo e(($isAuth && $authUser?->is_voter) ? 'true' : 'false'); ?>,
        annIdx: 0,
        annTotal: <?php echo e($announcements->count()); ?>,

        activitySlides: <?php echo json_encode($carouselSlides->map(function($s){ return ['title'=>$s->title, 'image'=>asset('storage/'.$s->image_path)]; }), 512) ?>,
        currentActivitySlide: 0,
        activityTimer: null,
        getDefaultActivities(){
            return [
                { title: 'Celebrating Women\'s Month', image: '<?php echo e(asset('images/womens.jpg')); ?>' },
                { title: 'Operational Linis Canal', image: '<?php echo e(asset('images/canal.jpg')); ?>' },
                { title: 'Manila Bay Weekly Clean Up Drive', image: '<?php echo e(asset('images/cleanup.jpg')); ?>' }
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
            const name = '<?php echo e(addslashes(($authUser?->first_name??"")." ".($authUser?->last_name??""))); ?>'.trim();
            const email = '<?php echo e($authUser?->email ?? ""); ?>';
            fetch('<?php echo e(route("resident.message.send")); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    subject: this.msgSubject,
                    message: this.msgText,
                    name: name,
                    email: email,
                    resident_code: '<?php echo e($authUser?->resident_code ?? ""); ?>'
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
        },
        nextActivitySlide(){ this.currentActivitySlide=(this.currentActivitySlide+1)%this.activeSlides.length; },
        prevActivitySlide(){ this.currentActivitySlide=(this.currentActivitySlide-1+this.activeSlides.length)%this.activeSlides.length; },
        goActivitySlide(i){ this.currentActivitySlide=i; clearInterval(this.activityTimer); this.activityTimer=setInterval(()=>this.nextActivitySlide(),5000); },

        markNotifRead(){
            fetch('<?php echo e(route('resident.notifications.read')); ?>', {
                method:'POST',
                headers:{'X-CSRF-TOKEN':'<?php echo e(csrf_token()); ?>','Content-Type':'application/json'}
            });
        }
    }">

    
    <div class="hero-section">
        <div class="hero-carousel">
            <div class="carousel-slide active">
                <img src="<?php echo e(asset('images/circlelogo.png')); ?>" style="width:54px;height:54px;border-radius:50%;object-fit:contain;margin:0 auto 10px;display:block;opacity:.9;" onerror="this.style.display='none'">
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

        
        <div class="navy-box">
            
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;gap:10px;">
                
                <div x-data="{ lang: 'en' }" style="background:rgba(255,255,255,0.1); border:1.5px solid rgba(255,255,255,0.25); border-radius:99px; padding:3px; display:flex; gap:2px;">
                    <button @click="lang='en'; changeLanguage('en')" 
                            :style="lang==='en' ? 'background:#fff; color:var(--brand);' : 'background:transparent; color:rgba(255,255,255,0.6);'"
                            style="border:none; padding:4px 12px; border-radius:99px; font-size:9px; font-weight:900; cursor:pointer; text-transform:uppercase; transition:all .2s;">
                        EN
                    </button>
                    <button @click="lang='tl'; changeLanguage('tl')" 
                            :style="lang==='tl' ? 'background:#fff; color:var(--brand);' : 'background:transparent; color:rgba(255,255,255,0.6);'"
                            style="border:none; padding:4px 12px; border-radius:99px; font-size:9px; font-weight:900; cursor:pointer; text-transform:uppercase; transition:all .2s;">
                        Tagalog
                    </button>
                </div>

                <?php if($isAuth): ?>
                <div class="notif-bell-wrap" @click.away="notifOpen=false">
                    <button class="notif-bell-btn" @click="notifOpen=!notifOpen; if(notifOpen) markNotifRead()">
                        <i class="fas fa-bell"></i>
                        <?php if($unreadNotifications->count() > 0): ?>
                        <span class="notif-bell-badge"><?php echo e($unreadNotifications->count()); ?></span>
                        <?php endif; ?>
                    </button>
                    <div x-show="notifOpen" x-cloak x-transition class="notif-dropdown">
                        <div class="notif-hd">
                            <span class="notif-hlbl">Notifications</span>
                            <?php if($unreadNotifications->count() > 0): ?>
                            <span style="font-size:8px;background:#fee2e2;color:#dc2626;font-weight:900;padding:2px 7px;border-radius:99px;"><?php echo e($unreadNotifications->count()); ?> unread</span>
                            <?php endif; ?>
                        </div>
                        <div style="max-height:280px;overflow-y:auto;">
                            <?php $__empty_1 = true; $__currentLoopData = $allNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php $isUnread = is_null($notif->read_at); ?>
                            <div class="notif-item <?php echo e($isUnread ? 'notif-item-unread' : ''); ?>">
                                <div class="notif-item-ico" style="background:<?php echo e($isUnread ? '#dbeafe' : '#f1f5f9'); ?>;">
                                    <i class="fas <?php echo e($notif->data['type'] === 'document_received' ? 'fa-file-alt' : 'fa-bell'); ?>" style="color:<?php echo e($isUnread ? '#0E5393' : '#94a3b8'); ?>;font-size:11px;"></i>
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <div class="notif-item-ttl"><?php echo e($notif->data['title'] ?? 'Notification'); ?></div>
                                    <div class="notif-item-msg"><?php echo e($notif->data['message'] ?? ''); ?></div>
                                    <div class="notif-item-time"><?php echo e($notif->created_at->diffForHumans()); ?></div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div style="padding:30px;text-align:center;color:var(--light);">
                                <i class="fas fa-bell" style="font-size:24px;display:block;margin-bottom:7px;opacity:.2;"></i>
                                <p style="font-size:11px;font-weight:700;">No notifications yet.</p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="notif-ft">
                            <span style="font-size:9px;color:var(--muted);font-weight:600;">Notifications are cleared after 30 days.</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            
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
                <div class="service-card" @click="isAuth ? (docuModal=true, selectedDoc='') : (loginNoticeModal=true, resStep='ask', activeService='document')">
                    <div class="service-ico"><i class="fas fa-file-alt"></i></div>
                    <div class="service-name">Document Services</div>
                    <div class="service-sub">Request certificates online</div>
                </div>
                <div class="service-card" @click="faqModal=true">
                    <div class="service-ico"><i class="fas fa-question-circle"></i></div>
                    <div class="service-name">FAQs</div>
                    <div class="service-sub">How to use & portal guide</div>
                </div>
                <div class="service-card" @click="isAuth ? issueModal=true : (loginNoticeModal=true, resStep='ask', activeService='issue')">
                    <div class="service-ico"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="service-name">Report an Issue</div>
                    <div class="service-sub">Blotter, VAWC & more</div>
                </div>
            </div>
        </div>

        
        <div class="wcard" style="position:relative; margin-bottom:20px; box-shadow:var(--card-shadow); border-radius:var(--r-card); overflow:hidden; background-color:#04192D;">
            <div style="position:relative; width:100%; height:380px;">
                <template x-for="(item, index) in activeSlides" :key="index">
                    <div x-show="currentActivitySlide === index" 
                         x-transition.opacity.duration.700ms
                         style="position:absolute; inset:0; background-color:#04192D;">
                        
                        <img :src="item.image" style="width:100%; height:100%; object-fit:cover; object-position:center;" alt="Carousel Highlight">
                        
                        
                        <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(4,25,45,0.95), transparent); padding:50px 22px 20px;">
                            <h3 x-text="item.title" style="color:#fff; font-size:16px; font-weight:900; text-transform:uppercase; letter-spacing:0.04em; text-shadow:0 2px 10px rgba(0,0,0,0.6);"></h3>
                        </div>
                    </div>
                </template>
            </div>
            
            
            <button @click="prevActivitySlide()" class="c-arrow c-prev" style="position:absolute; top:45%;"><i class="fas fa-chevron-left"></i></button>
            <button @click="nextActivitySlide()" class="c-arrow c-next" style="position:absolute; top:45%;"><i class="fas fa-chevron-right"></i></button>

            
            <div class="carousel-dots" style="bottom:12px; z-index:10;">
                <template x-for="(item, index) in activeSlides" :key="index">
                    <button @click="goActivitySlide(index)" class="carousel-dot" :class="currentActivitySlide === index ? 'active' : ''" style="box-shadow:0 1px 3px rgba(0,0,0,0.3);"></button>
                </template>
            </div>
        </div>



        
        <?php if(!$isAuth): ?>
        <div class="login-prompt">
            <div class="lp-icon"><i class="fas fa-house-user"></i></div>
            <h3 style="font-size:14px;font-weight:900;color:#1e3a5f;margin-bottom:5px;">Resident Portal Access</h3>
            <p style="font-size:11px;color:var(--muted);font-weight:600;margin-bottom:14px;line-height:1.5;">This portal is for legitimate residents. Non-residents can still request documents by clicking the service cards above and selecting "Non-Resident".</p>
            <div class="lp-btns">
                <a href="<?php echo e(route('register')); ?>" class="btn-grad btn-sm"><i class="fas fa-user-plus"></i> Create Account</a>
                <a href="<?php echo e(route('login')); ?>" class="btn-plain btn-outline btn-sm"><i class="fas fa-sign-in-alt"></i> Resident Login</a>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if($isAuth): ?>
        <div class="wcard">
            <div class="wcard-head">
                <div class="wcard-title"><i class="fas fa-history"></i> Your Application History</div>
                <div class="wcard-badge"><?php echo e($requests->count()); ?> requests</div>
            </div>
            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="event-item">
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas fa-file-invoice" style="color:var(--brand);font-size:13px;"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:12px;font-weight:800;color:var(--text);"><?php echo e(ucwords(str_replace('_',' ',$req->document_type))); ?></div>
                    <div style="font-size:10px;color:var(--muted);font-weight:600;">
                        Purpose: <?php echo e($req->purpose ?? 'N/A'); ?> •
                        Status: <span class="s-<?php echo e($req->status); ?>"><?php echo e(ucfirst($req->status)); ?></span>
                    </div>
                    <?php if($req->status === 'ready'): ?>
                    <span style="font-size:9px;font-weight:900;background:#dcfce7;color:#15803d;padding:2px 8px;border-radius:99px;display:inline-block;margin-top:3px;">
                        <i class="fas fa-check-circle"></i> Ready for Pick-up at Brgy. Hall!
                    </span>
                    <?php endif; ?>
                </div>
                <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;flex-shrink:0;"><?php echo e($req->created_at->format('M d')); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($requests->isEmpty()): ?>
            <div style="padding:30px;text-align:center;color:var(--light);">
                <i class="fas fa-folder-open" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                <p style="font-size:11px;font-weight:700;">No history yet.</p>
            </div>
            <?php endif; ?>
        </div>
        <?php if($isAuth): ?>
        <div class="wcard">
            <div class="wcard-head">
                <div class="wcard-title"><i class="fas fa-exclamation-triangle"></i> Your Incident Reports</div>
                <div class="wcard-badge"><?php echo e($issueReports->count()); ?> reports</div>
            </div>
            <?php $__currentLoopData = $issueReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="event-item">
                <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas fa-flag" style="color:#dc2626;font-size:13px;"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:12px;font-weight:800;color:var(--text);"><?php echo e($rep->issue_type); ?> — <?php echo e($rep->department); ?></div>
                    <div style="font-size:10px;color:var(--muted);font-weight:600;">
                        Case No: <?php echo e($rep->case_no ?? 'Pending'); ?> •
                        Status: <span style="font-weight:900;text-transform:uppercase;color:<?php echo e($rep->status === 'settled' || $rep->status === 'resolved' ? '#15803d' : 
                            ($rep->status === 'on-going' ? '#1d4ed8' : '#92400e')); ?>"><?php echo e(ucfirst($rep->status)); ?></span>
                    </div>
                    <?php if($rep->hearing_date): ?>
                    <div style="font-size:9px;font-weight:900;background:#eff6ff;color:#1d4ed8;padding:3px 10px;border-radius:99px;display:inline-block;margin-top:5px;border:1px solid #bfdbfe;">
                        <i class="fas fa-calendar-alt"></i> Hearing: <?php echo e(\Carbon\Carbon::parse($rep->hearing_date)->format('M d, Y h:i A')); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <span style="font-size:10px;font-weight:700;color:var(--light);white-space:nowrap;flex-shrink:0;"><?php echo e($rep->created_at->format('M d')); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($issueReports->isEmpty()): ?>
            <div style="padding:30px;text-align:center;color:var(--light);">
                <i class="fas fa-clipboard-check" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                <p style="font-size:11px;font-weight:700;">No reports filed.</p>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        
        <div class="wcard">
            <div class="about-tabs" style="margin-bottom:0;">
                <button class="about-tab" :class="eventTab==='events'?'active':''" @click="eventTab='events'">
                    <i class="fas fa-calendar-alt"></i> Events
                </button>
                <button class="about-tab" :class="eventTab==='announcements'?'active':''" @click="eventTab='announcements'">
                    <i class="fas fa-bullhorn"></i> Announcements
                </button>
                <button class="about-tab" :class="eventTab==='officials'?'active':''" @click="eventTab='officials'">
                    <i class="fas fa-users"></i> Officials
                </button>
            </div>

            <div x-show="eventTab==='events'" x-transition>
                <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $etColors = ['Community'=>'etag-g','Health'=>'etag-b','Sanitation'=>'etag-o','Governance'=>'etag-p'];
                    $etClass  = $etColors[$evt->tag] ?? 'etag-b';
                ?>
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Event',title:<?php echo e(json_encode($evt->title)); ?>,description:<?php echo e(json_encode($evt->description)); ?>,image:<?php echo e($evt->image_path?json_encode(asset('storage/'.$evt->image_path)):json_encode(null)); ?>,tag:<?php echo e(json_encode($evt->tag)); ?>,date:<?php echo e(json_encode($evt->created_at->format('M d, Y'))); ?>,location:<?php echo e(json_encode($evt->location)); ?>,time_range:<?php echo e(json_encode($evt->time_range)); ?>}; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div class="event-day-box">
                        <div class="event-day-num"><?php echo e($evt->day_label); ?></div>
                        <div class="event-day-sm"><?php echo e(\Illuminate\Support\Str::limit($evt->frequency, 6)); ?></div>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:13px;font-weight:900;color:var(--text);letter-spacing:.01em;"><?php echo e($evt->title); ?></div>
                        <div style="font-size:11px;color:var(--brand);font-weight:800;margin-top:3px;line-height:1.4;">
                            <?php if($evt->time_range): ?><strong><?php echo e($evt->time_range); ?></strong><?php endif; ?>
                            <?php if($evt->location): ?> • <strong><?php echo e($evt->location); ?></strong><?php endif; ?>
                        </div>
                        <?php if($evt->description): ?><div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;"><?php echo e(\Illuminate\Support\Str::limit($evt->description, 80)); ?></div><?php endif; ?>
                        <span class="etag <?php echo e($etClass); ?>"><?php echo e($evt->tag); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-calendar-alt" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No events scheduled yet.</p>
                </div>
                <?php endif; ?>
            </div>

            <div x-show="eventTab==='announcements'" x-transition x-cloak>
                <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ann): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php $tc = $tagColors[$ann->tag] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; ?>
                <div class="event-item" style="cursor:pointer;transition:background .15s" @click="activeItem={type:'Announcement',title:<?php echo e(json_encode($ann->title)); ?>,description:<?php echo e(json_encode($ann->content)); ?>,image:<?php echo e($ann->image_path?json_encode(asset('storage/'.$ann->image_path)):json_encode(null)); ?>,tag:<?php echo e(json_encode($ann->tag)); ?>,date:<?php echo e(json_encode($ann->created_at->format('M d, Y'))); ?>}; itemModal=true" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                    <div class="event-day-box" style="background:<?php echo e($tc['bg']); ?>;color:<?php echo e($tc['color']); ?>;">
                        <i class="fas fa-bullhorn" style="font-size:18px;"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:13px;font-weight:900;color:var(--text);letter-spacing:.01em;"><?php echo e($ann->title); ?></div>
                        <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:2px;"><?php echo e(\Illuminate\Support\Str::limit($ann->content, 80)); ?></div>
                        <span style="font-size:8px;font-weight:900;text-transform:uppercase;padding:2px 7px;border-radius:99px;display:inline-block;margin-top:4px;background:<?php echo e($tc['bg']); ?>;color:<?php echo e($tc['color']); ?>;"><?php echo e($ann->tag); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-bullhorn" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No announcements available.</p>
                </div>
                <?php endif; ?>
            </div>

            <div x-show="eventTab==='officials'" x-transition x-cloak style="padding:20px;">
                <?php if($isAuth): ?>
                    <div style="text-align:center;">
                        <h3 style="font-size:16px; font-weight:900; color:var(--brand-dark); text-transform:uppercase; letter-spacing:.05em; margin-bottom:5px;">Organizational Chart</h3>
                        <p style="font-size:10px; color:var(--muted); font-weight:600; margin-bottom:20px;">Barangay San Miguel II — Current Term</p>
                        
                        <?php if($orgChartPath): ?>
                            <div style="background:#fff; border:1px solid var(--border); border-radius:12px; overflow:hidden; box-shadow:var(--card-shadow);">
                                <img src="<?php echo e(asset('storage/' . $orgChartPath)); ?>" style="width:100%; height:auto; display:block;" alt="Barangay Organizational Chart">
                            </div>
                        <?php else: ?>
                            <div style="padding:40px 20px; background:#f8fafc; border:2px dashed var(--border); border-radius:12px; color:var(--light);">
                                <i class="fas fa-sitemap" style="font-size:40px; margin-bottom:12px; opacity:.3;"></i>
                                <div style="font-size:12px; font-weight:800;">Organizational Chart is currently being updated.</div>
                                <div style="font-size:10px; font-weight:600; margin-top:4px;">Please check back later.</div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div style="text-align:center; padding:30px 20px; background:linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-radius:16px; border:1.5px solid #bfdbfe;">
                        <div style="width:50px; height:50px; background:var(--brand); color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 15px; font-size:20px;">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 style="font-size:14px; font-weight:900; color:var(--brand-dark); margin-bottom:8px;">Protected Information</h3>
                        <p style="font-size:11px; color:var(--muted); font-weight:600; line-height:1.6; max-width:300px; margin:0 auto 15px;">To protect the privacy of our community leaders and maintain security, the organizational chart is only visible to <strong>legitimate residents</strong>.</p>
                        <a href="<?php echo e(route('login')); ?>" class="btn-grad btn-sm"><i class="fas fa-sign-in-alt"></i> Login to View</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="wcard">
            <div class="about-tabs">
                <button class="about-tab" :class="aboutTab==='about'?'active':''" @click="aboutTab='about'">
                    <i class="fas fa-info-circle"></i> About
                </button>
                <button class="about-tab" :class="aboutTab==='announcements'?'active':''" @click="aboutTab='announcements'">
                    <i class="fas fa-clock"></i> Past Week Updates
                </button>
            </div>

            
            <div x-show="aboutTab==='about'" x-transition>
                <div class="about-grid">
                    <div class="about-card"><div class="about-ico"><i class="fas fa-bullseye"></i></div><div class="about-ttl">Mission</div><div class="about-desc">To deliver accessible, efficient, and transparent barangay services that uphold the dignity and welfare of every resident.</div></div>
                    <div class="about-card"><div class="about-ico"><i class="fas fa-eye"></i></div><div class="about-ttl">Vision</div><div class="about-desc">A progressive, peaceful, and self-reliant barangay where every resident thrives in a safe and inclusive environment.</div></div>
                    <div class="about-card"><div class="about-ico"><i class="fas fa-laptop"></i></div><div class="about-ttl">Digital Services</div><div class="about-desc">Our platform streamlines document requests, resident registration, and community communication — reducing wait times for all.</div></div>
                    <div class="about-card"><div class="about-ico"><i class="fas fa-map-marker-alt"></i></div><div class="about-ttl">Location & Contact</div><div class="about-desc">Barangay San Miguel II, Dasmariñas City, Cavite. Hall open Mon–Fri 8AM–5PM. Contact: (046) XXX-XXXX.</div></div>
                </div>
            </div>

            
            <div x-show="aboutTab==='announcements'" x-transition x-cloak>
                <?php if($recentUpdates->count() > 0): ?>
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
                            <?php $__currentLoopData = range('2020', (string)((int)date('Y')+2)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div style="display:flex;align-items:center;gap:16px;">
                        <button @click="viewMode='list'" :style="viewMode==='list'?'color:var(--brand)':'color:var(--light)'" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:11px;font-weight:700;display:flex;align-items:center;gap:5px;transition:.2s;"><i class="fas fa-list" style="font-size:14px;"></i> List View</button>
                        <button @click="viewMode='grid'" :style="viewMode==='grid'?'color:var(--brand)':'color:var(--light)'" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:11px;font-weight:700;display:flex;align-items:center;gap:5px;transition:.2s;"><i class="fas fa-th-large" style="font-size:14px;"></i> Grid View</button>
                    </div>
                </div>
                <div :class="viewMode==='grid' ? 'recent-ann-grid' : 'recent-ann-list'">
                    <?php $__currentLoopData = $recentUpdates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $tc = $tagColors[$upd->tag] ?? ['bg'=>'#f1f5f9','color'=>'#475569']; ?>
                    <div class="recent-ann-card" style="cursor:pointer;" x-show="(filterMonth === '' || '<?php echo e($upd->created_at->format('m')); ?>' === filterMonth) && (filterYear === '' || '<?php echo e($upd->created_at->format('Y')); ?>' === filterYear)" @click="activeItem={type:<?php echo e(json_encode($upd->type)); ?>,title:<?php echo e(json_encode($upd->title)); ?>,description:<?php echo e(json_encode($upd->content ?? $upd->description)); ?>,image:<?php echo e($upd->image_path?json_encode(asset('storage/'.$upd->image_path)):json_encode(null)); ?>,tag:<?php echo e(json_encode($upd->tag)); ?>,date:<?php echo e(json_encode($upd->created_at->format('M d, Y'))); ?>,location:<?php echo e(json_encode($upd->location ?? '')); ?>,time_range:<?php echo e(json_encode($upd->time_range ?? '')); ?>}; itemModal=true">
                        <?php if($upd->image_path): ?>
                        <img src="<?php echo e(asset('storage/'.$upd->image_path)); ?>" class="recent-ann-img" alt="<?php echo e($upd->title); ?>">
                        <?php else: ?>
                        <div class="recent-ann-img-placeholder"><i class="fas <?php echo e($upd->type === 'Event' ? 'fa-calendar-alt' : 'fa-bullhorn'); ?>"></i></div>
                        <?php endif; ?>
                        <div class="recent-ann-body">
                            <span class="recent-ann-tag" style="background:<?php echo e($tc['bg']); ?>;color:<?php echo e($tc['color']); ?>;"><?php echo e($upd->type); ?> • <?php echo e($upd->tag); ?></span>
                            <div class="recent-ann-title"><?php echo e($upd->title); ?></div>
                            <div style="font-size:10px;color:var(--muted);font-weight:600;margin-top:4px;line-height:1.4;"><?php echo e(\Illuminate\Support\Str::limit($upd->content ?? $upd->description, 80)); ?></div>
                            <div class="recent-ann-date"><i class="fas fa-clock" style="margin-right:3px;"></i><?php echo e($upd->created_at->format('M d, Y')); ?></div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div style="padding:30px;text-align:center;color:var(--light);">
                    <i class="fas fa-history" style="font-size:26px;display:block;margin-bottom:7px;opacity:.25;"></i>
                    <p style="font-size:11px;font-weight:700;">No updates in the past week.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    
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

                <?php if($isAuth): ?>
                <div style="display:flex;align-items:center;justify-content:space-between;background:#f8fafc;border:1px solid var(--border);border-radius:9px;padding:9px 13px;margin-bottom:12px;">
                    <span style="font-size:11px;font-weight:700;color:var(--muted);"><i class="fas fa-user-check" style="margin-right:4px;"></i>Your Status:</span>
                    <span x-show="isVoter" class="voter-free"><i class="fas fa-check-circle"></i> Registered Voter</span>
                    <span x-show="!isVoter" class="voter-pay"><i class="fas fa-user"></i> Non-Voter</span>
                </div>
                <?php endif; ?>

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
                    <form action="<?php echo e(route('resident.document.request')); ?>" method="POST" enctype="multipart/form-data" 
                          x-data="{ 
                            cType: 'self', 
                            selfPurpose: '',
                            applicants: [{ first_name: '', middle_name: '', last_name: '', relation: '', address: '', purpose: '', contact: '' }] 
                          }">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="document_type" :value="selectedDoc">                        
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
                            
                            
                            <div x-show="cType === 'authorized'" x-transition class="auth-blue-box">
                                <p style="font-size:10px;color:var(--brand);font-weight:900;margin-bottom:12px;text-transform:uppercase;display:flex;align-items:center;gap:6px;">
                                    <i class="fas fa-shield-alt"></i> Authorization Details
                                </p>
                                
                                <div class="fgrid2 fgrp">
                                    <div>
                                        <label class="flbl">Authorization Letter *</label>
                                        <div class="upload-card" @click="$refs.authLetter.click()">
                                            <i class="fas fa-file-signature"></i>
                                            <div class="upload-txt" x-text="$refs.authLetter.files[0] ? $refs.authLetter.files[0].name : 'Upload Signed Letter'"></div>
                                            <input type="file" x-ref="authLetter" name="authorization_letter" accept="image/*,.pdf" style="display:none;" :required="cType === 'authorized'" @change="$forceUpdate()">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="flbl">Valid ID of Authorized Person *</label>
                                        <div class="upload-card" @click="$refs.authId.click()">
                                            <i class="fas fa-id-card"></i>
                                            <div class="upload-txt" x-text="$refs.authId.files[0] ? $refs.authId.files[0].name : 'Upload Your Valid ID'"></div>
                                            <input type="file" x-ref="authId" name="authorized_id" accept="image/*,.pdf" style="display:none;" :required="cType === 'authorized'" @change="$forceUpdate()">
                                        </div>
                                    </div>
                                </div>

                                <div class="privacy-divider" style="opacity:.3;margin:18px 0;"></div>

                                
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

                                        <div class="fgrid2 fgrp">
                                            <div>
                                                <label class="flbl">Contact Number</label>
                                                <input type="text" :name="'applicants['+index+'][contact]'" placeholder="09XXXXXXXXX" class="finput" x-model="app.contact">
                                            </div>
                                            <div>
                                                <label class="flbl">Purpose *</label>
                                                <input type="text" :name="'applicants['+index+'][purpose]'" placeholder="e.g. Employment, Loan..." class="finput" :required="cType === 'authorized'" x-model="app.purpose">
                                                <div x-show="app.purpose.toLowerCase().includes('loan')" style="font-size:9px;color:var(--warn);margin-top:4px;font-weight:700;"><i class="fas fa-info-circle"></i> Note: Document requests for Loan purposes may have an associated fee.</div>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <div x-show="applicants.length < 2" style="margin-top:15px;">
                                    <button type="button" @click="applicants.push({ first_name: '', middle_name: '', last_name: '', relation: '', address: '', purpose: '', contact: '' })" class="btn-plain btn-outline btn-sm" style="width:100%;justify-content:center;border-style:dashed;background:#fff;">
                                        <i class="fas fa-plus-circle"></i> Add Another Applicant (Max 2)
                                    </button>
                                </div>

                                <p style="font-size:9px;color:var(--brand);font-weight:700;margin-top:12px;line-height:1.4;opacity:.8;">
                                    <i class="fas fa-info-circle"></i> Only <strong>2 application requests</strong> per Authorized Representative are allowed at a time.
                                </p>
                            </div>

                            
                            <div x-show="cType === 'self'">
                                <?php if(!$isAuth): ?>
                                <div class="sblk">
                                    <div class="sblk-ttl"><i class="fas fa-user"></i> Your Name</div>
                                    <div class="fgrid2 fgrp">
                                        <div><label class="flbl">First Name *</label><input type="text" name="guest_first_name" :required="cType==='self' && !<?php echo e($isAuth ? 'true':'false'); ?>" class="finput" placeholder="Juan"></div>
                                        <div><label class="flbl">Last Name *</label><input type="text" name="guest_last_name" :required="cType==='self' && !<?php echo e($isAuth ? 'true':'false'); ?>" class="finput" placeholder="Dela Cruz"></div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="sblk">
                                    <div class="sblk-ttl"><i class="fas fa-info"></i> Request Details</div>
                                    <div class="fgrid2 fgrp">
                                        <div class="fspan2"><label class="flbl">Complete Address</label><input type="text" name="address" placeholder="Blk/Lot, Street, Brgy. SM2..." class="finput"></div>
                                        <div><label class="flbl">Contact Number</label><input type="text" name="contact" placeholder="09XXXXXXXXX" class="finput"></div>
                                        <div>
                                            <label class="flbl">Purpose</label>
                                            <input type="text" name="purpose" placeholder="e.g. Employment, Loan..." class="finput" x-model="selfPurpose">
                                            <div x-show="selfPurpose.toLowerCase().includes('loan')" style="font-size:9px;color:var(--warn);margin-top:4px;font-weight:700;"><i class="fas fa-info-circle"></i> Note: Document requests for Loan purposes may have an associated fee.</div>
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
                <form action="<?php echo e(route('resident.issue.report')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
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
                            <div><label class="flbl">Full Name *</label><input type="text" name="complainant_name" required class="finput" placeholder="Juan Dela Cruz" <?php if($isAuth): ?> value="<?php echo e(($authUser?->first_name??'').' '.($authUser?->last_name??'')); ?>" <?php endif; ?>></div>
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
                            <div><label class="flbl">Witness Name (Optional)</label><input type="text" name="witness_name" class="finput" placeholder="Name of witness"></div>
                            <div x-data="{ evCount: 0 }">
                                <label class="flbl">Upload Proof / Evidence (Optional)</label>
                                <div class="upload-card" @click="$refs.evidenceInput.click()" style="padding: 10px;">
                                    <i class="fas fa-file-upload" style="font-size:16px;"></i>
                                    <div class="upload-txt" x-text="evCount > 0 ? evCount + ' file(s) selected' : 'Click to Upload Files'" style="margin-top:4px;"></div>
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

    
    <div x-show="loginNoticeModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" :style="resStep==='non-resident' ? 'max-width:540px' : 'max-width:440px'" @click.away="loginNoticeModal=false">
            <div class="modal-in">
                
                
                <div x-show="resStep==='ask'" style="text-align:center;">
                    <div style="width:58px;height:58px;background:#eff6ff;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                        <i class="fas fa-house-user" style="font-size:24px;color:var(--brand);"></i>
                    </div>
                    <h3 style="font-size:16px;font-weight:900;color:var(--text);margin-bottom:8px;">Are you a resident of Barangay San Miguel II?</h3>
                    <p style="font-size:12px;color:var(--muted);font-weight:600;line-height:1.5;margin-bottom:24px;">
                        This digital portal is primarily for legitimate residents. Non-residents may still request documents but must undergo additional verification.
                    </p>
                    <div style="display:grid;gap:10px;">
                        <button @click="resStep='resident'" class="btn-grad" style="justify-content:center;padding:14px;">
                            <i class="fas fa-check-circle" style="font-size:14px;"></i> YES, I AM A RESIDENT
                        </button>
                        <button @click="if(activeService==='document'){ resStep='non-resident' } else { loginNoticeModal=false; issueModal=true; }" class="btn-plain btn-outline" style="justify-content:center;padding:14px;">
                            <i class="fas fa-user-friends" style="font-size:14px;"></i> NO, I AM A NON-RESIDENT
                        </button>
                        <button @click="loginNoticeModal=false" class="btn-plain btn-ghost" style="justify-content:center;margin-top:10px;">Cancel</button>
                    </div>
                </div>

                
                <div x-show="resStep==='resident'" style="text-align:center;">
                    <div style="width:58px;height:58px;background:#eff6ff;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                        <i class="fas fa-user-lock" style="font-size:24px;color:var(--brand);"></i>
                    </div>
                    <h3 style="font-size:16px;font-weight:900;color:var(--text);margin-bottom:8px;">Resident Access</h3>
                    <p style="font-size:12px;color:var(--muted);font-weight:600;line-height:1.5;margin-bottom:20px;">
                        Please sign in to your resident account to access all barangay services and track your requests.
                    </p>
                    <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                        <a href="<?php echo e(route('register')); ?>" class="btn-grad"><i class="fas fa-user-plus"></i> Create Account</a>
                        <a href="<?php echo e(route('login')); ?>" class="btn-plain btn-outline"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </div>
                    <div style="margin-top:24px;">
                        <button @click="resStep='ask'" style="background:none;border:none;color:var(--muted);font-size:11px;font-weight:800;cursor:pointer;display:flex;align-items:center;gap:5px;margin:0 auto;"><i class="fas fa-arrow-left"></i> Go Back</button>
                    </div>
                </div>

                
                <div x-show="resStep==='non-resident'">
                    <div class="modal-hd" style="margin-bottom:14px;padding-bottom:10px;">
                        <div class="modal-ttl">
                            <div class="modal-ico"><i class="fas fa-user-friends"></i></div> Non-Resident Document Request
                        </div>
                    </div>
                    <div style="background:#fff7ed;border:1px solid #ffedd5;padding:12px;border-radius:10px;margin-bottom:16px;display:flex;gap:10px;align-items:flex-start;">
                        <i class="fas fa-info-circle" style="color:#ea580c;margin-top:2px;"></i>
                        <p style="font-size:10px;color:#9a3412;font-weight:700;line-height:1.5;">
                            NOTE: After submission, you must <strong>personally go to the Barangay Hall</strong> and bring your <strong>Valid ID</strong> to proceed with your request.
                        </p>
                    </div>
                    <form action="<?php echo e(route('resident.document.request')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="fgrid2">
                            <div class="fgrp">
                                <label class="flbl">First Name *</label>
                                <input type="text" name="guest_first_name" required class="finput" placeholder="e.g. Juan">
                            </div>
                            <div class="fgrp">
                                <label class="flbl">Last Name *</label>
                                <input type="text" name="guest_last_name" required class="finput" placeholder="e.g. Dela Cruz">
                            </div>
                        </div>
                        <div class="fgrp">
                            <label class="flbl">Gmail Address (Email) *</label>
                            <input type="email" name="guest_email" required pattern=".*@gmail\.com$" class="finput" placeholder="example@gmail.com" title="Please use a Gmail address.">
                        </div>
                        <div class="fgrp">
                            <label class="flbl">Complete Address *</label>
                            <input type="text" name="address" required class="finput" placeholder="House #, Street, etc.">
                        </div>
                        <div class="fgrid2">
                            <div class="fgrp">
                                <label class="flbl">Document Type *</label>
                                <select name="document_type" required class="finput">
                                    <option value="">Select...</option>
                                    <option value="indigency">Indigency</option>
                                    <option value="clearance">Brgy Clearance</option>
                                    <option value="residency">Residency</option>
                                    <option value="jobseeker">1st Time Job Seeker</option>
                                    <option value="business">Business</option>
                                    <option value="endorsement">Endorsement</option>
                                    <option value="movein">Move-In</option>
                                    <option value="moveout">Move-Out</option>
                                    <option value="closure">Business Closure</option>
                                    <option value="latereg">Late Registration</option>
                                    <option value="guardianship">Guardianship</option>
                                    <option value="cohabitation">Cohabitation</option>
                                    <option value="katibayan">Katibayan</option>
                                    <option value="cashgift">Cash Gift</option>
                                    <option value="yumao">Pagpapatunay (Death)</option>
                                    <option value="oath">Oath of Office</option>
                                </select>
                            </div>
                            <div class="fgrp">
                                <label class="flbl">Contact Number</label>
                                <input type="text" name="contact" class="finput" placeholder="09XXXXXXXXX">
                            </div>
                        </div>
                        <div class="fgrp">
                            <label class="flbl">Purpose *</label>
                            <input type="text" name="purpose" required class="finput" placeholder="e.g. Scholarship, Employment, Loan" x-model="guestPurpose">
                            <div x-show="guestPurpose.toLowerCase().includes('loan')" style="font-size:9px;color:var(--warn);margin-top:4px;font-weight:700;"><i class="fas fa-info-circle"></i> Note: Document requests for Loan purposes may have an associated fee.</div>
                        </div>
                        <div class="fgrp">
                            <label class="flbl">Valid ID Proof * (Photo)</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:100px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                    <img x-show="idProofPreview" :src="idProofPreview" style="width:100%;height:100%;object-fit:contain;">
                                    <div x-show="!idProofPreview" style="text-align:center;">
                                        <i class="fas fa-id-card" style="color:var(--light);font-size:22px;margin-bottom:5px;"></i>
                                        <div style="font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;">Click to Upload</div>
                                    </div>
                                </div>
                                <input type="file" name="id_proof" required accept="image/*" style="display:none;" 
                                       @change="const f=$event.target.files[0]; if(f){ const r=new FileReader(); r.onload=e=>idProofPreview=e.target.result; r.readAsDataURL(f) }">
                            </label>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;">
                            <button type="button" @click="resStep='ask'" class="btn-plain" style="background:#fee2e2;color:#dc2626;border:1.5px solid #fca5a5;">
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn-grad" style="padding:10px 24px;">Submit Request</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    
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

    
    <?php if($isAuth): ?>
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
                    <img src="<?php echo e($authUser?->photo ? asset('storage/'.$authUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode(($authUser?->first_name??'').' '.($authUser?->last_name??'')).'&background=0E5393&color=fff&size=128&bold=true'); ?>"
                         style="width:64px;height:64px;border-radius:12px;object-fit:cover;border:2px solid #fff;box-shadow:var(--card-shadow);">
                    <div>
                        <div style="font-size:17px;font-weight:900;color:var(--text);"><?php echo e(($authUser?->first_name??'').' '.($authUser?->last_name??'')); ?></div>
                        <div style="font-size:10px;font-weight:700;color:var(--brand);text-transform:uppercase;letter-spacing:.06em;margin-top:2px;"><?php echo e($authUser?->resident_code ?? 'NO-CODE'); ?></div>
                        <div style="margin-top:5px;display:flex;gap:4px;flex-wrap:wrap;">
                            <?php if($authUser?->is_voter): ?>
                                <?php if($authUser->voter_status == 'pending'): ?>
                                    <span style="font-size:8px;font-weight:900;background:#fef3c7;color:#a16207;padding:2px 7px;border-radius:99px;">Voter (Pending)</span>
                                <?php elseif($authUser->voter_status == 'declined'): ?>
                                    <span style="font-size:8px;font-weight:900;background:#fee2e2;color:#dc2626;padding:2px 7px;border-radius:99px;">Voter (Declined)</span>
                                <?php else: ?>
                                    <span style="font-size:8px;font-weight:900;background:#dbeafe;color:#1d4ed8;padding:2px 7px;border-radius:99px;">Voter</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if($authUser && $authUser->voter_status === 'pending' && !$authUser->is_voter): ?>
                                <span style="font-size:8px;font-weight:900;background:#fef3c7;color:#a16207;padding:2px 7px;border-radius:99px;">Voter (Pending)</span>
                            <?php endif; ?>
                            <?php if($authUser?->is_non_voter && $authUser->voter_status !== 'pending' && $authUser->voter_status !== 'approved'): ?>
                                <span style="font-size:8px;font-weight:900;background:#fef3c7;color:#a16207;padding:2px 7px;border-radius:99px;">Non-Voter</span>
                            <?php endif; ?>
                            <?php if($authUser?->is_senior): ?><span style="font-size:8px;font-weight:900;background:#ffedd5;color:#ea580c;padding:2px 7px;border-radius:99px;">Senior</span><?php endif; ?>
                            <?php if($authUser?->is_pwd): ?><span style="font-size:8px;font-weight:900;background:#ede9fe;color:#7c3aed;padding:2px 7px;border-radius:99px;">PWD</span><?php endif; ?>
                            <?php if($authUser?->is_bedridden): ?><span style="font-size:8px;font-weight:900;background:#fee2e2;color:#dc2626;padding:2px 7px;border-radius:99px;">Bed-ridden</span><?php endif; ?>
                            <?php if($authUser?->is_single_parent): ?><span style="font-size:8px;font-weight:900;background:#fce7f3;color:#be185d;padding:2px 7px;border-radius:99px;">Solo Parent</span><?php endif; ?>
                        </div>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px;">
                    <?php $__currentLoopData = [
                        ['Birthday', $authUser?->birthday ? \Carbon\Carbon::parse($authUser->birthday)->format('F d, Y') : 'N/A'],
                        ['Gender', $authUser?->gender ?? 'N/A'],
                        ['Civil Status', $authUser?->civil_status ?? 'N/A'],
                        ['Contact', $authUser?->contact_number ?? 'N/A'],
                        ['Birthplace', $authUser?->birthplace ?? 'N/A'],
                        ['Occupation', $authUser?->occupation ?? 'N/A'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$lbl,$val]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="profile-field">
                        <div class="profile-field-lbl"><?php echo e($lbl); ?></div>
                        <div class="profile-field-val"><?php echo e($val); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="profile-field" style="grid-column:span 2;">
                        <div class="profile-field-lbl">Address</div>
                        <div class="profile-field-val"><?php echo e($authUser?->address ?? 'N/A'); ?></div>
                    </div>
                </div>

                
                <?php if($authUser && $authUser->voter_status === 'declined'): ?>
                <div style="background:#fee2e2;border:1.5px solid #fca5a5;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#dc2626;text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;"><i class="fas fa-exclamation-circle" style="margin-right:4px;"></i> Voter Verification Declined</div>
                    <p style="font-size:10px;color:#991b1b;font-weight:600;margin-bottom:10px;">Reason: <?php echo e($authUser->decline_reason ?? 'Invalid ID.'); ?></p>
                    <form action="<?php echo e(route('resident.voter.upload')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="file" name="voter_id_photo" id="voterProofReupload" required accept="image/*" style="display:none;" onchange="
                        if(this.files.length) { 
                            let btn = this.nextElementSibling; 
                            btn.innerHTML = '<i class=\'fas fa-spinner fa-spin\' style=\'margin-right:6px;\'></i> Uploading...'; 
                            btn.style.opacity = '0.7';
                            btn.style.pointerEvents = 'none';
                            this.form.submit(); 
                        }
                        ">
                        <label for="voterProofReupload" class="btn-grad btn-grad-red btn-sm" style="display:inline-flex;cursor:pointer;margin:0;"><i class="fas fa-upload" style="margin-right:6px;"></i> Re-upload Proof</label>
                    </form>
                </div>
                <?php elseif($authUser && $authUser->voter_status === 'pending'): ?>
                <div style="background:#fef3c7;border:1.5px solid #fde68a;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#92400e;text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;">
                        <i class="fas fa-clock" style="margin-right:4px;"></i> Voter Verification Pending
                    </div>
                    <p style="font-size:10px;color:#b45309;font-weight:600;margin-bottom:0px;">
                         Your uploaded proof is waiting for approval by the office. You cannot resubmit while pending.
                         <?php if($authUser->voter_id_photo): ?><a href="<?php echo e(asset('storage/'.$authUser->voter_id_photo)); ?>" target="_blank" style="color:#d97706;font-weight:800;text-decoration:underline;margin-left:4px;">View Uploaded Photo</a><?php endif; ?>
                    </p>
                </div>
                <?php elseif($authUser && $authUser->is_non_voter && empty($authUser->voter_status)): ?>
                <div style="background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#1e3a8a;text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;">
                        <i class="fas fa-question-circle" style="margin-right:4px;"></i> Are you a registered voter?
                    </div>
                    <p style="font-size:10px;color:#2563eb;font-weight:600;margin-bottom:10px;">
                        If you are a registered voter, please upload your proof of voter. Leave it as is if you are a non-voter.
                    </p>
                    <form action="<?php echo e(route('resident.voter.upload')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="file" name="voter_id_photo" id="voterProofUpload" required accept="image/*" style="display:none;" onchange="
                        if(this.files.length) { 
                            let btn = this.nextElementSibling; 
                            btn.innerHTML = '<i class=\'fas fa-spinner fa-spin\' style=\'margin-right:6px;\'></i> Uploading...'; 
                            btn.style.opacity = '0.7';
                            btn.style.pointerEvents = 'none';
                            this.form.submit(); 
                        }
                        ">
                        <label for="voterProofUpload" class="btn-grad btn-sm" style="display:inline-flex;cursor:pointer;margin:0;"><i class="fas fa-upload" style="margin-right:6px;"></i> Upload Proof</label>
                    </form>
                </div>
                <?php endif; ?>

                
                <div style="background:linear-gradient(135deg,#eff6ff,#dbeafe);border:1.5px solid #bfdbfe;border-radius:11px;padding:14px;margin-bottom:14px;">
                    <div style="font-size:9px;font-weight:900;color:#1d4ed8;text-transform:uppercase;letter-spacing:.07em;margin-bottom:10px;"><i class="fas fa-id-card" style="margin-right:4px;"></i> Digital Barangay ID</div>
                    <?php if($digitalId && $digitalId->status === 'generated'): ?>
                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
                        <div>
                            <span style="font-size:10px;font-weight:900;background:#dcfce7;color:#15803d;padding:3px 10px;border-radius:99px;"><i class="fas fa-check-circle"></i> ID Generated</span>
                            <div style="font-size:10px;color:#64748b;font-weight:600;margin-top:5px;">ID No: <strong style="color:#0f172a;"><?php echo e($digitalId->id_number); ?></strong></div>
                        </div>
                        <button type="button" @click="profileModal=false; digitalIdViewModal=true;" class="btn-grad btn-sm"><i class="fas fa-id-card"></i> View Digital ID</button>
                    </div>
                    <?php elseif($digitalId && $digitalId->status === 'pending'): ?>
                    <span style="font-size:10px;font-weight:900;background:#fef3c7;color:#a16207;padding:3px 10px;border-radius:99px;"><i class="fas fa-clock"></i> Pending — Being processed by the office</span>
                    <?php elseif($authUser && $authUser->resident): ?>
                    <p style="font-size:10px;color:#475569;font-weight:600;margin-bottom:10px;">Request your official Digital Barangay ID.</p>
                    <button type="button" @click.prevent.stop="profileModal=false;digitalIdModal=true" class="btn-grad btn-sm"><i class="fas fa-id-card-alt"></i> Request Digital ID</button>
                    <?php else: ?>
                    <p style="font-size:10px;color:#475569;font-weight:600;margin-bottom:10px;">You must have a verified resident profile on the masterlist to request an ID.</p>
                    <button disabled class="btn-grad btn-sm" style="background:#94a3b8;cursor:not-allowed;box-shadow:none;"><i class="fas fa-lock"></i> Masterlist Verification Required</button>
                    <?php endif; ?>
                </div>

                
                <?php $myPets = $authUser?->pets ?? collect(); ?>
                <div x-data="{ petStatusModal: false, editingPet: null }">
                    <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:11px;padding:12px;margin-bottom:14px;">
                        <div style="font-size:9px;font-weight:900;color:var(--brand-dark);text-transform:uppercase;letter-spacing:.07em;margin-bottom:8px;display:flex;align-items:center;justify-content:space-between;">
                            <span><i class="fas fa-paw" style="color:var(--brand);margin-right:4px;"></i> My Pets</span>
                        </div>
                        <div style="display:flex;flex-wrap:wrap;">
                            <?php $__empty_1 = true; $__currentLoopData = $myPets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div style="display:inline-flex;align-items:center;gap:5px;border-radius:99px;padding:4px 10px;font-size:10px;font-weight:800;margin:3px;<?php echo e($pet->status === 'deceased' ? 'background:#f1f5f9;color:#94a3b8;border:1px solid #e2e8f0;' : 'background:#dcfce7;color:#15803d;border:1px solid #bbf7d0;'); ?>">
                                <i class="fas fa-paw" style="font-size:8px;"></i>
                                <?php echo e($pet->pet_name ?? $pet->pet_type); ?>

                                <?php if($pet->status === 'deceased'): ?><span style="font-size:8px;opacity:.7;">(Deceased)</span><?php endif; ?>
                                <?php if($pet->vaccination_status === 'pending'): ?><span style="font-size:8px;opacity:.8;color:#d97706;background:#fef3c7;padding:1px 4px;border-radius:3px;margin-left:4px;">(Pending Verification)</span><?php endif; ?>
                                <?php if($pet->vaccination_status === 'verified'): ?><span style="font-size:8px;opacity:.8;color:#15803d;background:#dcfce7;padding:1px 4px;border-radius:3px;margin-left:4px;"><i class="fas fa-check-circle"></i> Verified</span><?php endif; ?>
                                <?php if($pet->vaccination_status === 'rejected'): ?><span style="font-size:8px;opacity:.8;color:#dc2626;background:#fee2e2;padding:1px 4px;border-radius:3px;margin-left:4px;" title="Reason: <?php echo e($pet->rejection_reason); ?>">(Proof Rejected <i class="fas fa-question-circle"></i>)</span><?php endif; ?>
                                <button @click="editingPet=<?php echo e(json_encode(['id'=>$pet->id,'name'=>$pet->pet_name??$pet->pet_type,'status'=>$pet->status])); ?>;petStatusModal=true"
                                        style="background:none;border:none;cursor:pointer;color:inherit;font-size:9px;padding:0 0 0 3px;" title="Update status">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="<?php echo e(url('/pets/'.$pet->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Archive this pet?');">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" style="background:none;border:none;cursor:pointer;color:inherit;font-size:9px;padding:0 0 0 3px;" title="Archive request">
                                        <i class="fas fa-archive"></i>
                                    </button>
                                </form>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span style="font-size:10px;color:var(--light);font-weight:600;">No pets registered yet.</span>
                            <?php endif; ?>
                        </div>
                        <button @click="profileModal=false;petModal=true"
                                style="margin-top:9px;background:none;border:1.5px dashed var(--brand);color:var(--brand);font-size:10px;font-weight:800;padding:5px 12px;border-radius:99px;cursor:pointer;font-family:inherit;display:inline-flex;align-items:center;gap:4px;transition:all 0.2s;" onmouseover="this.style.background='var(--brand)';this.style.color='#fff'" onmouseout="this.style.background='none';this.style.color='var(--brand)'">
                            <i class="fas fa-plus" style="font-size:8px;"></i> Add Pet
                        </button>
                    </div>

                    
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
                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
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

                </div>
            </div>
        </div>

    
    <div x-show="petModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="max-width:460px;" @click.away="petModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-paw"></i></div><div>Register My Pet</div></div>
                    <button @click="petModal=false;profileModal=true" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <form action="<?php echo e(route('pets.store')); ?>" method="POST" enctype="multipart/form-data" x-data="{ petPhotoPreview: null, vaccineProofPreview: null, vStatus: 'unvaccinated', petTypeOther: false }">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="resident_id" value="<?php echo e($authUser?->id); ?>">
                    
                    <div style="display:flex;gap:12px;margin-bottom:12px;align-items:flex-start;">
                        
                        <div style="flex-shrink:0;">
                            <label class="flbl">Pet Photo (1x1)</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="width:70px;height:70px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                                    <template x-if="petPhotoPreview">
                                        <img :src="petPhotoPreview" style="width:100%;height:100%;object-fit:cover;">
                                    </template>
                                    <template x-if="!petPhotoPreview">
                                        <div style="text-align:center;">
                                            <i class="fas fa-camera" style="color:var(--light);font-size:16px;margin-bottom:2px;"></i>
                                            <div style="font-size:7px;font-weight:800;color:var(--muted);text-transform:uppercase;">Click</div>
                                        </div>
                                    </template>
                                </div>
                                <input type="file" name="pet_photo" accept="image/*" style="display:none;" 
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
                            <?php $__currentLoopData = ['Dog'=>'🐶','Cat'=>'🐱','Bird'=>'🐦','Rabbit'=>'🐰','Fish'=>'🐟','Others'=>'➕']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type=>$emoji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label style="cursor:pointer;">
                                <input type="radio" name="pet_type" value="<?php echo e($type); ?>" style="display:none;" @change="petTypeOther = ($event.target.value === 'Others')" required>
                                <div class="pet-type-card">
                                    <?php echo e($emoji); ?> <?php echo e($type); ?>

                                </div>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div x-show="petTypeOther"><input type="text" name="pet_type_other" placeholder="Specify pet type..." class="finput"></div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:11px;">
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
                        <div x-show="vStatus === 'pending'" x-transition style="margin-top:10px;">
                            <label class="flbl">Upload Vaccine Proof (Card/Record) *</label>
                            <label style="cursor:pointer;display:block;">
                                <div style="height:100px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;">
                                    <template x-if="vaccineProofPreview">
                                        <img :src="vaccineProofPreview" style="width:100%;height:100%;object-fit:contain;">
                                    </template>
                                    <template x-if="!vaccineProofPreview">
                                        <div style="text-align:center;">
                                            <i class="fas fa-file-medical" style="color:var(--brand);font-size:22px;margin-bottom:5px;"></i>
                                            <div style="font-size:9px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Vaccine Card</div>
                                        </div>
                                    </template>
                                </div>
                                <input type="file" name="vaccine_proof" accept="image/*,.pdf" style="display:none;" :required="vStatus === 'pending'"
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

    
    <div x-show="digitalIdModal" x-cloak class="modal-ov" x-transition>
        <div class="modal-box" style="max-width:460px;" @click.away="digitalIdModal=false">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-id-card-alt"></i></div><div>Request Digital Barangay ID</div></div>
                    <button @click="digitalIdModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>
                <form action="<?php echo e(route('resident.digital.id.request')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
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

    
    <?php if($digitalId && $digitalId->status === 'generated'): ?>
    <?php
        $idUser = $authUser;
        $idFullName = strtoupper(($idUser?->first_name??'').' '.($idUser?->middle_name ? $idUser->middle_name.' ' : '').($idUser?->last_name??''));
        $idAddress = $idUser?->address ?? 'BARANGAY SAN MIGUEL II DASMARIÑAS CAVITE';
        $idBirthday = $idUser?->birthday ? \Carbon\Carbon::parse($idUser->birthday)->format('F j, Y') : 'N/A';
        $idPhoto = $idUser?->photo ? asset('storage/'.$idUser->photo) : 'https://ui-avatars.com/api/?name='.urlencode(($idUser?->first_name??'R').' '.($idUser?->last_name??'')).'&background=0E5393&color=fff&size=128&bold=true';
        $idCode = $idUser?->resident_code ?? $digitalId->id_number;
        $idIssued = \Carbon\Carbon::parse($digitalId->created_at)->format('m/d/Y');
        $idValid = \Carbon\Carbon::parse($digitalId->created_at)->addYears(3)->format('m/d/Y');
    ?>
    <div x-show="digitalIdViewModal" x-cloak class="modal-ov" style="z-index:99999;">
        <div class="modal-box" style="max-width:480px;">
            <div class="modal-in">
                <div class="modal-hd">
                    <div class="modal-ttl"><div class="modal-ico"><i class="fas fa-id-card"></i></div><div>Digital Barangay ID</div></div>
                    <button @click="digitalIdViewModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                </div>

                
                <div style="display:flex;gap:7px;margin-bottom:14px;justify-content:center;">
                    <button @click="idView='front'" :class="idView==='front'?'btn-grad btn-sm':'btn-plain btn-edit'" style="min-width:90px;"><i class="fas fa-id-card"></i> Front</button>
                    <button @click="idView='back'" :class="idView==='back'?'btn-grad btn-sm':'btn-plain btn-edit'" style="min-width:90px;"><i class="fas fa-qrcode"></i> Back</button>
                </div>

                
                <div x-show="idView==='front'" style="border:1.5px solid #ccc;border-radius:8px;overflow:hidden;background:#fff;font-family:Arial,sans-serif;">
                    <div style="padding:12px 14px 10px;">
                        <div style="text-align:center;margin-bottom:8px;">
                            <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-bottom:3px;">
                                <img src="<?php echo e(asset('images/dasma.png')); ?>" style="width:32px;height:32px;object-fit:contain;" onerror="this.style.display='none'">
                                <img src="<?php echo e(asset('images/brgysm2_logo.png')); ?>" style="width:32px;height:32px;object-fit:contain;" onerror="this.style.display='none'">
                            </div>
                            <p style="font-size:7px;font-weight:900;color:#222;margin:0;letter-spacing:.03em;">REPUBLIC OF THE PHILIPPINES • PROVINCE OF CAVITE • CITY OF DASMARIÑAS</p>
                            <p style="font-size:13px;font-weight:900;color:#111;margin:2px 0 1px;">BARANGAY SAN MIGUEL 2</p>
                            <p style="font-size:7px;font-weight:700;color:#555;letter-spacing:.1em;margin-bottom:6px;">RESIDENCE IDENTIFICATION CARD</p>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:11px;">
                            <div style="flex-shrink:0;text-align:center;">
                                <div style="width:72px;height:82px;border:2px solid #aaa;border-radius:5px;overflow:hidden;background:#e8e8e8;display:flex;align-items:center;justify-content:center;">
                                    <img src="<?php echo e($idPhoto); ?>" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <p style="font-size:6px;font-weight:900;color:#333;margin-top:2px;letter-spacing:.03em;">BARANGAY ID NO.</p>
                                <p style="font-size:6.5px;font-weight:900;color:#111;"><?php echo e($idCode); ?></p>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <p style="font-size:12px;font-weight:900;color:#111;line-height:1.2;margin:0 0 4px;word-break:break-word;"><?php echo e($idFullName); ?></p>
                                <p style="font-size:7px;font-weight:900;color:#666;letter-spacing:.05em;margin:0 0 1px;">ADDRESS:</p>
                                <p style="font-size:8.5px;font-weight:700;color:#111;line-height:1.3;margin:0 0 5px;word-break:break-word;"><?php echo e(strtoupper($idAddress)); ?></p>
                                <p style="font-size:7px;font-weight:900;color:#666;letter-spacing:.05em;margin:0 0 1px;">DATE OF BIRTH:</p>
                                <p style="font-size:9.5px;font-weight:900;color:#111;margin:0 0 6px;"><?php echo e(strtoupper($idBirthday)); ?></p>
                                <div style="display:flex;justify-content:space-between;gap:7px;">
                                    <div><p style="font-size:6px;font-weight:700;color:#666;letter-spacing:.07em;margin:0;">DATE ISSUED</p><p style="font-size:8px;font-weight:900;color:#111;margin:0;"><?php echo e($idIssued); ?></p></div>
                                    <div><p style="font-size:6px;font-weight:700;color:#666;letter-spacing:.07em;margin:0;">VALID UNTIL</p><p style="font-size:8px;font-weight:900;color:#111;margin:0;"><?php echo e($idValid); ?></p></div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:6px;border-top:1px solid #bbb;padding-top:3px;"><p style="font-size:6.5px;color:#666;margin:0;">SIGNATURE OF CARDHOLDER</p><div style="height:12px;"></div></div>
                    </div>
                </div>

                
                <div x-show="idView==='back'" style="border:1.5px solid #ccc;border-radius:8px;overflow:hidden;background:#fff;font-family:Arial,sans-serif;position:relative;">
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:.25;pointer-events:none;"><img src="<?php echo e(asset('images/brgysm2_logo.png')); ?>" style="width:240px;height:240px;object-fit:contain;" onerror=""></div>
                    <div style="position:relative;z-index:1;padding:10px 12px;">
                        
                        <div style="border:2px solid #111;border-radius:4px;padding:6px 10px;margin-bottom:8px;background:#fff;min-height:42px;">
                            <p style="font-size:6px;font-weight:700;color:#555;letter-spacing:.08em;text-align:center;margin:0 0 2px;">— CONTACT PERSON IN CASE OF EMERGENCY —</p>
                            <p style="font-size:11px;font-weight:900;color:#111;text-align:center;margin:0 0 1px;"><?php echo e(strtoupper($digitalId->contact_person ?? '___________________________')); ?></p>
                            <p style="font-size:7.5px;font-weight:700;color:#333;text-align:center;margin:0;">CONTACT NO: <?php echo e($digitalId->contact_person_number ?? '_______________'); ?></p>
                        </div>
                        
                        <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:7px;">
                            <div style="flex:1;min-width:0;">
                                <p style="font-size:7.5px;font-weight:900;color:#111;margin:0 0 3px;"><strong>THIS CARD IS NON - TRANSFERABLE</strong></p>
                                <p style="font-size:6px;color:#333;line-height:1.6;margin:0 0 5px;">THE CARD HOLDER IS A BONAFIDE RESIDENT OF THIS BARANGAY. IF THIS ID IS FOUND, KINDLY RETURN TO THE BARANGAY SECRETARIAT.</p>
                                <p style="font-size:7px;font-weight:900;color:#111;margin:0 0 1px;"><strong>NOTE:</strong></p>
                                <p style="font-size:5.8px;color:#333;line-height:1.6;margin:0;">THIS CARD IS VALID IF SIGNED BY THE BARANGAY CHAIRMAN. LOSS OF THIS CARD MUST BE REPORTED IMMEDIATELY TO THE BARANGAY HALL.</p>
                            </div>
                            <div style="flex-shrink:0;text-align:center;">
                                <div style="width:68px;height:68px;background:white;border:2px solid #000;border-radius:3px;padding:2px;display:flex;align-items:center;justify-content:center;">
                                    <div id="resident-qr-canvas" style="width:62px;height:62px;"></div>
                                </div>
                                <p style="font-size:5px;color:#888;margin-top:1px;"><?php echo e($idCode); ?></p>
                            </div>
                        </div>
                        
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(()=>{
            const container = document.getElementById('resident-qr-canvas');
            if(!container || container.innerHTML.trim() !== '') return;
            try {
                const url = '<?php echo e(url("/resident?id=".$idCode)); ?>';
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
    <?php endif; ?>
    <?php endif; ?>

    
    <a href="https://www.facebook.com/share/1KroHtkCf9/" target="_blank" class="ask-float">
        <div class="ask-pulse"></div>
        <i class="fab fa-facebook-messenger"></i> Ask Here
    </a>

    </div>

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;background:var(--body-bg);border-top:1px solid var(--border);">
        © <?php echo e(date('Y')); ?> Barangay San Miguel II, Dasmariñas City ,Cavite. All rights reserved.
    </footer>

    
    <div id="google_translate_element" style="display:none"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,tl',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }
        
        function changeLanguage(lang) {
            var select = document.querySelector('.goog-te-combo');
            if (select) {
                select.value = lang;
                select.dispatchEvent(new Event('change'));
            }
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <style>
        .goog-te-banner-frame.skiptranslate, .goog-te-gadget-icon { display: none !important; }
        body { top: 0px !important; }
        .goog-te-menu-value img { display: none !important; }
        .goog-te-menu-frame { box-shadow: none !important; }
        .skiptranslate iframe { display: none !important; }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
