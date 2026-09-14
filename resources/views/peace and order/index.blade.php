<x-app-layout>
<style>
:root{
    --brand:#0E5393;--brand-dark:#04192D;--brand-darker:#000052;
    --body-bg:#f1f5f9;--border:#e2e8f0;--text:#0f172a;--muted:#64748b;--light:#94a3b8;
    --success:#059669;--warn:#d97706;--danger:#dc2626;
    --card-shadow:0 4px 24px rgba(4,25,45,0.10),0 1.5px 6px rgba(0,0,0,0.05);
    --btn-grad:linear-gradient(135deg,#0E5393 0%,#04192D 100%);
    --accent:#0ea5e9;
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

.action-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px;}
@media(max-width:768px){.action-grid{grid-template-columns:1fr;}}
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

@keyframes bell-ring {
    0%, 100% { transform: rotate(0); }
    10% { transform: rotate(18deg); }
    20% { transform: rotate(-18deg); }
    30% { transform: rotate(14deg); }
    40% { transform: rotate(-14deg); }
    50% { transform: rotate(10deg); }
    60% { transform: rotate(-10deg); }
    70% { transform: rotate(6deg); }
    80% { transform: rotate(-6deg); }
    90% { transform: rotate(2deg); }
}
.ringing-bell {
    animation: bell-ring 1.1s ease-in-out infinite;
    transform-origin: top center;
    display: inline-block;
}
@keyframes pulse-banner {
    0%, 100% { box-shadow: 0 8px 30px rgba(220,38,38,0.4); }
    50% { box-shadow: 0 8px 38px rgba(220,38,38,0.8), 0 0 24px rgba(239,68,68,0.6); }
}
@keyframes pulse-siren {
    0%, 100% { box-shadow: 0 0 0 0 rgba(225,29,72,0.7); }
    50% { box-shadow: 0 0 0 10px rgba(225,29,72,0); }
}
.siren-badge {
    animation: pulse-siren 1.5s infinite;
}

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

.time-scroll-col {
    scrollbar-width: thin;
    scrollbar-color: #94a3b8 #f1f5f9;
}
.time-scroll-col::-webkit-scrollbar {
    width: 5px;
    display: block;
}
.time-scroll-col::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}
.time-scroll-col::-webkit-scrollbar-thumb {
    background: #94a3b8;
    border-radius: 4px;
}
.time-scroll-col::-webkit-scrollbar-thumb:hover {
    background: var(--brand);
}
.time-btn-opt {
    width: 100%;
    padding: 5px 0;
    text-align: center;
    border: none;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    transition: all .1s;
    margin-bottom: 2px;
}
.time-btn-opt:hover {
    background: #e2e8f0;
}

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
@keyframes pulse-banner {
    0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.6); }
    70% { box-shadow: 0 0 0 14px rgba(239, 68, 68, 0); }
    100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
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
    <script>
        window.playBarangayEmergencySiren = async function() {
            try {
                const AudioCtx = window.AudioContext || window.webkitAudioContext;
                if (!AudioCtx) return;
                let ctx = window._brgyAudioCtx;
                if (!ctx || ctx.state === 'closed') {
                    ctx = new AudioCtx();
                    window._brgyAudioCtx = ctx;
                }
                if (ctx.state === 'suspended') {
                    await ctx.resume();
                }

                const now = ctx.currentTime + 0.03;

                // Dual-horn oscillators for high-intensity "wang-wang" emergency siren
                const osc1 = ctx.createOscillator();
                const osc2 = ctx.createOscillator();
                const gain = ctx.createGain();

                osc1.type = 'sawtooth'; // piercing siren horn
                osc2.type = 'sine';     // deep acoustic siren resonance
                osc2.detune.setValueAtTime(12, now); // slight chorus blare

                // 4 complete wail cycles (Wang-wang-wang-wang)
                const cycles = 4;
                const upDur = 0.28;   // 0.28s rise
                const downDur = 0.28; // 0.28s fall
                let t = now;

                osc1.frequency.setValueAtTime(620, t);
                osc2.frequency.setValueAtTime(620, t);

                for (let i = 0; i < cycles; i++) {
                    // Wail UP (Waaang...)
                    t += upDur;
                    osc1.frequency.exponentialRampToValueAtTime(1380, t);
                    osc2.frequency.exponentialRampToValueAtTime(1380, t);
                    // Wail DOWN (...wang)
                    t += downDur;
                    osc1.frequency.exponentialRampToValueAtTime(620, t);
                    osc2.frequency.exponentialRampToValueAtTime(620, t);
                }

                // Volume envelope (solid sustain throughout with no silent gaps)
                gain.gain.setValueAtTime(0.01, now);
                gain.gain.linearRampToValueAtTime(0.50, now + 0.06);
                gain.gain.setValueAtTime(0.50, t - 0.12);
                gain.gain.exponentialRampToValueAtTime(0.001, t);

                osc1.connect(gain);
                osc2.connect(gain);
                gain.connect(ctx.destination);

                osc1.start(now);
                osc2.start(now);
                osc1.stop(t);
                osc2.stop(t);
            } catch(e) {
                console.warn('Wang-wang siren audio error:', e);
            }
        };

        // Warm up AudioContext on any user interaction so background alerts can play freely
        ['click', 'keydown', 'touchstart'].forEach(evt => {
            window.addEventListener(evt, () => {
                try {
                    if (!window._brgyAudioCtx || window._brgyAudioCtx.state === 'closed') {
                        const AudioCtx = window.AudioContext || window.webkitAudioContext;
                        if (AudioCtx) window._brgyAudioCtx = new AudioCtx();
                    }
                    if (window._brgyAudioCtx && window._brgyAudioCtx.state === 'suspended') {
                        window._brgyAudioCtx.resume();
                    }
                } catch(e){}
            }, { passive: true });
        });
    </script>

    <div class="portal-wrap" x-data="{
        activeTab: localStorage.getItem('brgy_peace_tab') || 'cases',
        viewModal: false,
        addBlotterModal: false,
        addPatrolModal: false,
        rejectModal: false,
        rejectFormData: { id: null, reason: '' },
        escalateModal: false,
        escalateIssueId: null,
        transferModal: false,
        transferIssueId: null,
        importModal: false,
        templateUploadModal: false,
        previewPhotoModal: false,
        previewPhotoSrc: '',
        previewPhotoTitle: '',
        previewPhotoMeta: '',
        openProofPreview(src, title, meta) {
            this.previewPhotoSrc = src;
            this.previewPhotoTitle = title || 'Patrol Proof Photo';
            this.previewPhotoMeta = meta || '';
            this.previewPhotoModal = true;
        },
        activeIssue: null,
        patrolTeam: '',
        patrolModal: false,
        personnelList: [''],
        proofModal: false,
        activePatrolId: null,
        searchQuery: '',
        filterStatus: '',
        filterType: '',
        sosAlerts: {{ json_encode($sosAlerts->map(function($a) {
            return [
                'id'               => $a->id,
                'resident_name'    => $a->resident_name ?? ($a->user ? trim(($a->user->first_name ?? '') . ' ' . ($a->user->last_name ?? '')) : 'Barangay Resident'),
                'resident_contact' => $a->contact_number ?? $a->resident_contact ?? ($a->user?->contact_number ?? $a->user?->phone_number ?? 'N/A'),
                'resident_address' => $a->home_address ?? $a->resident_address ?? ($a->user?->resident?->address ?? ($a->user?->address ?? 'Barangay San Miguel II')),
                'landmark'         => !empty($a->landmark) ? $a->landmark : null,
                'emergency_type'   => !empty($a->emergency_type) ? $a->emergency_type : 'Emergency SOS',
                'message'          => !empty($a->message) ? $a->message : (!empty($a->responder_notes) ? $a->responder_notes : null),
                'latitude'         => $a->latitude,
                'longitude'        => $a->longitude,
                'status'           => $a->status,
                'created_at_fmt'   => $a->created_at ? $a->created_at->format('M d, Y h:i A') : 'Just now',
                'time_ago'         => $a->created_at ? $a->created_at->diffForHumans() : 'Just now',
                'google_maps_url'  => $a->google_maps_url ?: (($a->latitude && $a->longitude) ? 'https://www.google.com/maps?q=' . $a->latitude . ',' . $a->longitude : null),
            ];
        })) }},
        sosPollingInterval: null,
        hasInitialPollRun: false,
        sosTitleInterval: null,
        flashSosTabTitle() {
            if (this.sosTitleInterval) return;
            const originalTitle = document.title;
            let count = 0;
            this.sosTitleInterval = setInterval(() => {
                document.title = (count % 2 === 0) ? '🚨 EMERGENCY SOS DISPATCH! - San Miguel II' : originalTitle;
                count++;
                if (count > 14) {
                    clearInterval(this.sosTitleInterval);
                    this.sosTitleInterval = null;
                    document.title = originalTitle;
                }
            }, 800);
        },
        playEmergencyChime() {
            if (typeof window.playBarangayEmergencySiren === 'function') {
                return window.playBarangayEmergencySiren();
            }
        },
        pollSosAlerts() {
            fetch('{{ route('peace.sos.alerts') }}')
                .then(r => r.json())
                .then(data => {
                    const newAlerts = data.alerts || [];
                    const prevAlerts = this.sosAlerts || [];
                    const prevIds = new Set(prevAlerts.map(a => Number(a.id)));
                    const prevTriggered = prevAlerts.filter(a => a.status === 'triggered' || a.status === 'active').length;
                    const newTriggered = newAlerts.filter(a => a.status === 'triggered' || a.status === 'active').length;

                    // New alert detected if unseen ID arrives or active count increases
                    const hasNewAlert = newAlerts.some(a => !prevIds.has(Number(a.id)));

                    this.sosAlerts = newAlerts;

                    if (this.hasInitialPollRun) {
                        if (hasNewAlert || newTriggered > prevTriggered) {
                            this.playEmergencyChime();
                            this.flashSosTabTitle();
                        }
                    } else {
                        this.hasInitialPollRun = true;
                    }
                }).catch(e => console.error(e));
        },
        updateSosStatus(alertId, newStatus) {
            fetch('/peace/sos-alerts/' + alertId + '/status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            }).then(r => r.json()).then(res => {
                this.pollSosAlerts();
            }).catch(err => {
                alert('Error updating SOS status');
            });
        },
        peaceRep: {
            province: 'Cavite',
            city: 'Dasmariñas',
            barangay: 'San Miguel 2',
            monthYear: '{{ strtoupper(now()->format('F Y')) }}',
            blotterReceived: {{ $issues->count() }},
            vehicularAccidents: 0,
            noiseDisturbance: {{ $issues->where('issue_type', 'Noise Disturbance')->count() }},
            theftRobbery: {{ $issues->where('issue_type', 'Theft / Robbery')->count() }},
            physicalInjuries: {{ $issues->where('issue_type', 'Physical Injury')->count() }},
            otherIncidents: {{ $issues->whereNotIn('issue_type', ['Noise Disturbance', 'Theft / Robbery', 'Physical Injury'])->count() }},
            get totalIncidents() {
                return (Number(this.vehicularAccidents)||0) + (Number(this.noiseDisturbance)||0) + (Number(this.theftRobbery)||0) + (Number(this.physicalInjuries)||0) + (Number(this.otherIncidents)||0);
            },
            patrolsConducted: {{ $patrols->count() }},
            settledAtDesk: {{ $issues->where('status', 'settled')->count() }},
            escalatedJustice: 0,
            referredPnp: 0,
            transferredVawc: 0,
            get totalActed() {
                return (Number(this.settledAtDesk)||0) + (Number(this.escalatedJustice)||0) + (Number(this.referredPnp)||0) + (Number(this.transferredVawc)||0);
            },
            hasDesk: 'YES',
            hasLogbook: 'Yes',
            tanodsOnDuty: 12,
            preparedBy: 'CHIEF TANOD / PEACE OFFICER',
            preparedRole: 'Peace & Order Officer',
            notedBy: 'MARVIN M. BENIS',
            notedRole: 'Punong Barangay'
        },
        printPeaceReport() {
            printPeaceReportHelper();
        },
        openView(issue) { this.activeIssue = issue; this.viewModal = true; },
        openReject(id) { this.rejectFormData.id = id; this.rejectFormData.reason = ''; this.rejectModal = true; },
        openEscalate(id) { this.escalateIssueId = id; this.escalateModal = true; },
        openTransfer(id) { this.transferIssueId = id; this.transferModal = true; },
        init() {
            this.$watch('activeTab', value => localStorage.setItem('brgy_peace_tab', value));
            this.pollSosAlerts();
            this.sosPollingInterval = setInterval(() => {
                this.pollSosAlerts();
            }, 4000);
        }
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
                <div class="hstat" @click="activeTab='sos'; playEmergencyChime();" style="cursor:pointer;transition:all .15s;" onmouseover="this.style.background='rgba(239,68,68,0.2)'" onmouseout="this.style.background='rgba(255,255,255,.08)'" title="Click to view Emergency SOS dispatches and sound alert">
                    <div class="hstat-n" style="display:flex;align-items:center;justify-content:center;gap:6px;color:#fca5a5;">
                        <i class="fas fa-bullhorn" :class="sosAlerts.length > 0 ? 'ringing-bell' : ''" style="font-size:14px;color:#fca5a5;"></i>
                        <span x-text="sosAlerts.length"></span>
                    </div>
                    <div class="hstat-l" style="color:#fca5a5;">Active SOS</div>
                </div>
            </div>
        </div>

        {{-- ACTION CARDS --}}
        <div class="action-grid" style="grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));">
            <div class="action-card" @click="activeTab='cases'" :class="activeTab==='cases'?'active':''">
                <div class="ac-ico" style="background:#fee2e2;"><i class="fas fa-flag" style="color:#dc2626;"></i></div>
                <div class="ac-name">Blotter Reports</div>
                <div class="ac-sub">Review new cases</div>
            </div>
            <div class="action-card" @click="activeTab='patrol'" :class="activeTab==='patrol'?'active':''">
                <div class="ac-ico" style="background:#dcfce7;"><i class="fas fa-route" style="color:#15803d;"></i></div>
                <div class="ac-name">Patrol Schedule</div>
                <div class="ac-sub">Duty roster & proof</div>
            </div>
            <div class="action-card" @click="activeTab='sos'; playEmergencyChime();" :class="activeTab==='sos'?'active':''" :style="sosAlerts.length > 0 ? 'border-color:#ef4444;' : ''" style="position:relative;" title="Click to sound siren and open SOS tab">
                <div class="ac-ico" style="background:#fee2e2;" @click.stop="activeTab='sos'; playEmergencyChime();" title="Click icon to sound siren">
                    <i class="fas fa-bullhorn" :class="sosAlerts.length > 0 ? 'ringing-bell' : ''" style="color:#dc2626;font-size:20px;"></i>
                </div>
                <div class="ac-name">
                    Emergency SOS
                    <span x-show="sosAlerts.length > 0" class="cbadge cbadge-red" style="font-size:8px;margin-left:4px;" x-text="sosAlerts.length + ' ACTIVE'"></span>
                </div>
                <div class="ac-sub">Live alerts & dispatch log</div>
            </div>
            <div class="action-card" @click="activeTab='reports'" :class="activeTab==='reports'?'active':''">
                <div class="ac-ico" style="background:#eff6ff;"><i class="fas fa-file-invoice" style="color:#0E5393;"></i></div>
                <div class="ac-name">Accomplishment Reports</div>
                <div class="ac-sub">Peace & Tanod matrix & send</div>
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
                        <div style="width:1px;height:14px;background:var(--border);margin:0 4px;"></div>
                        <a href="{{ route('peace.export') }}" class="btn btn-ghost btn-sm" style="text-decoration:none;display:inline-flex;align-items:center;gap:5px;">
                            <i class="fas fa-file-export"></i> Export
                        </a>
                        <button type="button" class="btn btn-ghost btn-sm" @click="importModal=true" style="display:inline-flex;align-items:center;gap:5px;">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                    </div>
                </div>
                {{-- FILTER BAR navy theme --}}
                @php $caseTypes = \App\Models\IssueReport::where('department','Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->pluck('issue_type')->unique(); @endphp
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
                        <option value="approved">Approved</option>
                        <option value="settled">Settled</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <select x-model="filterType">
                        <option value="">All Case Types</option>
                        @foreach($caseTypes as $ct)
                        <option value="{{ $ct }}">{{ $ct }}</option>
                        @endforeach
                    </select>
                    <button @click="addBlotterModal=true" style="background:#fff;color:var(--brand-darker);border:none;padding:7px 14px;border-radius:8px;font-size:10px;font-weight:900;display:flex;align-items:center;gap:6px;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,.15);margin-left:auto;">
                        <i class="fas fa-plus"></i> Add Entry
                    </button>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Case Code</th>
                            <th>Complainant</th>
                            <th>Type</th>
                            <th>Incident Date</th>
                            <th>Report Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th style="text-align:right;white-space:nowrap;min-width:240px;">Action</th>
                        </tr></thead>
                        <tbody>
                            @forelse(\App\Models\IssueReport::where('department','Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->latest()->get() as $issue)
                            @php 
                                $caseCode = 'PO-'.$issue->created_at->format('Y').'-'.str_pad($issue->id, 3, '0', STR_PAD_LEFT); 
                                // Case-insensitive and robust sensitive check
                                $isFemale = strtolower($issue->complainant_gender ?? '') === 'female';
                                $isVAWCType = str_contains($issue->issue_type, 'Physical Assault') || str_contains($issue->issue_type, 'Harassment');
                                $isRestrictedCase = $issue->is_restricted || ($isVAWCType && $isFemale);
                            @endphp
                            <tr x-show="
                                (searchQuery === '' || '{{ strtolower($issue->complainant_name) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($caseCode) }}'.includes(searchQuery.toLowerCase())) &&
                                (filterType === '' || '{{ $issue->issue_type }}' === filterType) &&
                                (filterStatus === '' || '{{ $issue->status }}' === filterStatus)">
                                <td>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand);">#{{ $caseCode }}</div>
                                    @if($isRestrictedCase && auth()->user()->role === 'peace')
                                       <div style="font-size:8px;font-weight:900;background:#fef2f2;color:#dc2626;padding:1px 6px;border-radius:4px;display:inline-block;margin-top:2px;text-transform:uppercase;border:1px solid #fecaca;box-shadow:0 1px 3px rgba(220,38,38,0.1);">
                                           <i class="fas fa-exclamation-triangle" style="font-size:7px;"></i> Sensitive — VAWC
                                       </div>
                                    @endif
                                    @if(str_contains((string)$issue->admin_notes, 'PENDING CLASSIFICATION') || ($issue->issue_type === 'Others' && $issue->status === 'submitted'))
                                       <div style="font-size:8px;font-weight:900;background:#fef3c7;color:#b45309;padding:1px 6px;border-radius:4px;display:inline-block;margin-top:2px;text-transform:uppercase;border:1px solid #fde68a;">
                                           <i class="fas fa-hourglass-half" style="font-size:7px;"></i> Pending Classification
                                       </div>
                                    @endif
                                    @if($issue->transfer_count > 0)
                                       <div style="font-size:8px;font-weight:900;background:#ffedd5;color:#ea580c;padding:1px 6px;border-radius:4px;display:inline-block;margin-top:2px;text-transform:uppercase;">
                                           <i class="fas fa-exchange-alt" style="font-size:7px;"></i> Transferred
                                       </div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-size:12px;font-weight:800;color:var(--text);">
                                        @if($isRestrictedCase && auth()->user()->role === 'peace')
                                            <span style="filter: blur(4px); user-select: none;">REDACTED NAME</span>
                                        @else
                                            {{ $issue->complainant_name }}
                                            @if(!$issue->user_id)
                                                <span class="cbadge cbadge-red" style="font-size:7px; padding:2px 6px; vertical-align:middle; margin-left:4px;">GUEST</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div style="font-size:10px;color:var(--muted);font-weight:600;">
                                        @if($isRestrictedCase && auth()->user()->role === 'peace')
                                            <span style="filter: blur(4px);">09000000000</span>
                                        @else
                                            {{ $issue->contact }}
                                        @endif
                                    </div>
                                </td>
                                <td><span style="font-size:11px;font-weight:700;color:var(--text);opacity:0.9;">{{ $issue->issue_type }}</span></td>
                                <td style="font-size:11px;color:var(--muted);font-weight:600;">{{ $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('M d, Y') : 'N/A' }}</td>
                                <td style="font-size:11px;color:var(--brand);font-weight:700;">{{ $issue->created_at->format('M d, Y') }}</td>
                                <td style="font-size:11px;color:var(--muted);font-weight:600;">{{ $issue->location ?? 'N/A' }}</td>
                                <td>
                                    @php $sc=['submitted'=>'spill-new','under_review'=>'spill-active','approved'=>'spill-settled','settled'=>'spill-settled','pending'=>'spill-pending','rejected'=>'spill-new'][$issue->status]??'spill-pending'; @endphp
                                    <span class="spill {{ $sc }}"><i class="fas fa-circle" style="font-size:6px;"></i> {{ ucfirst(str_replace('_',' ',$issue->status)) }}</span>
                                </td>
                                <td style="text-align:right;white-space:nowrap;min-width:240px;">
                                    <div style="display:inline-flex;gap:6px;justify-content:flex-end;align-items:center;white-space:nowrap;">
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
                                            'rejection_reason' => $issue->rejection_reason,
                                            'incident_date'    => $issue->incident_date ? \Carbon\Carbon::parse($issue->incident_date)->format('M d, Y h:i A') : 'N/A',
                                            'location'         => $issue->location ?? 'N/A',
                                            'witness_name'     => $issue->witness_name ?? 'N/A',
                                            'evidence'         => $issue->evidence ? json_decode($issue->evidence) : [],
                                            'is_restricted'    => $isRestrictedCase,
                                            'user_id'          => $issue->user_id,
                                            'created_at'       => $issue->created_at->format('M d, Y'),
                                        ]) }})"
                                        class="btn-icon" title="View Details" style="flex-shrink:0;">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        {{-- ESCALATE TO KP (JUSTICE) --}}
                                        <button type="button" @click="openEscalate({{ $issue->id }})" class="btn-icon" title="Escalate to KP (Refer to Justice)" style="background:#fef3c7;color:#a16207;flex-shrink:0;">
                                            <i class="fas fa-gavel"></i>
                                        </button>
                                        {{-- TRANSFER TO VAWC --}}
                                        <button type="button" @click="openTransfer({{ $issue->id }})" class="btn-icon" title="Transfer to VAWC" style="background:#f5f3ff;color:#7c3aed;flex-shrink:0;">
                                            <i class="fas fa-user-shield"></i>
                                        </button>
                                        {{-- STATUS UPDATE --}}
                                        @php
                                            $peaceRankMap = [
                                                'submitted'    => 1,
                                                'under_review' => 2,
                                                'pending'      => 3,
                                                'approved'     => 4,
                                                'settled'      => 5,
                                                'resolved'     => 5,
                                                'rejected'     => 6,
                                            ];
                                            $curPeaceRank = $peaceRankMap[$issue->status] ?? 1;
                                            $isPeaceTerminal = in_array($issue->status, ['settled', 'resolved', 'rejected']);
                                        @endphp
                                        @if($isPeaceTerminal)
                                            <select disabled style="width:120px;height:30px;box-sizing:border-box;font-size:9px;font-weight:800;border:1.5px solid var(--border);border-radius:7px;padding:4px 8px;background:#f8fafc;color:#94a3b8;cursor:not-allowed;outline:none;font-family:inherit;opacity:0.8;text-align:left;flex-shrink:0;" title="This case is already {{ ucfirst($issue->status) }} and locked.">
                                                <option selected>{{ ucfirst(str_replace('_',' ',$issue->status)) }}</option>
                                            </select>
                                        @else
                                            <form :id="'status-form-{{ $issue->id }}'" action="{{ url('/peace/issues/'.$issue->id.'/status') }}" method="POST" style="display:inline-block;margin:0;padding:0;flex-shrink:0;">
                                                @csrf @method('PATCH')
                                                <select name="status" @change="if($el.value === 'rejected') { openReject({{ $issue->id }}); $el.value='{{ $issue->status }}'; } else if($el.value === 'escalate_kp') { openEscalate({{ $issue->id }}); $el.value='{{ $issue->status }}'; } else { document.getElementById('status-form-{{ $issue->id }}').submit(); }"
                                                        style="width:120px;height:30px;box-sizing:border-box;font-size:9px;font-weight:800;border:1.5px solid var(--border);border-radius:7px;padding:4px 8px;background:#f8fafc;cursor:pointer;outline:none;font-family:inherit;text-align:left;">
                                                    @if($curPeaceRank <= 1)
                                                        <option value="submitted"    {{ $issue->status==='submitted'    ? 'selected' : '' }}>Submitted</option>
                                                    @endif
                                                    @if($curPeaceRank <= 2)
                                                        <option value="under_review" {{ $issue->status==='under_review' ? 'selected' : '' }}>Under Review</option>
                                                    @endif
                                                    @if($curPeaceRank <= 3)
                                                        <option value="pending"      {{ $issue->status==='pending'      ? 'selected' : '' }}>Pending</option>
                                                    @endif
                                                    @if($curPeaceRank <= 4)
                                                        <option value="approved"     {{ $issue->status==='approved'     ? 'selected' : '' }}>Approved</option>
                                                    @endif
                                                    <option value="settled"      {{ $issue->status==='settled'      ? 'selected' : '' }}>Settled</option>
                                                    <option value="escalate_kp"  style="color:#b45309;font-weight:800;">⚖️ Escalate to KP</option>
                                                    <option value="rejected"     {{ $issue->status==='rejected'     ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="8"><div class="tbl-empty"><i class="fas fa-flag"></i><p style="font-size:11px;font-weight:700;">No blotter reports yet.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ PATROL TAB ══ --}}
        <div x-show="activeTab==='patrol'" x-transition x-data="{ 
            proofPreview: null,
            patrolFilterTeam: '',
            patrolFilterDate: ''
        }">
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-calendar-alt"></i> Team Assignments & Roving Logs</div>
                    <div style="display:flex;gap:7px;">
                        <button @click="patrolTeam='Team A'; patrolModal=true" class="btn btn-primary btn-sm" style="background:#1d4ed8;"><i class="fas fa-plus"></i> Assign Team A (MWF)</button>
                        <button @click="patrolTeam='Team B'; patrolModal=true" class="btn btn-primary btn-sm" style="background:#0369a1;"><i class="fas fa-plus"></i> Assign Team B (T-S-TH)</button>
                    </div>
                </div>

                {{-- PATROL FILTER BAR --}}
                <div class="filter-bar" style="justify-content: flex-start; gap: 10px;">
                    <i class="fas fa-filter" style="color:rgba(255,255,255,.6);font-size:11px;flex-shrink:0;"></i>
                    <select x-model="patrolFilterTeam" style="width: 140px; flex: none;">
                        <option value="">All Teams</option>
                        <option value="Team A">Team A</option>
                        <option value="Team B">Team B</option>
                    </select>
                    <div class="filter-search" style="width: 180px; flex: none;">
                        <i class="fas fa-calendar" style="color:rgba(255,255,255,.5);font-size:10px;flex-shrink:0;"></i>
                        <input type="date" x-model="patrolFilterDate" style="color:#fff;">
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead><tr>
                            <th>Team</th>
                            <th>Personnel Assigned</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Roving Proof / Photo</th>
                            <th style="text-align:right;">Action</th>
                        </tr></thead>
                        <tbody>
                            @forelse(\App\Models\PatrolSchedule::latest()->get() as $patrol)
                            <tr x-show="(patrolFilterTeam === '' || '{{ $patrol->team_name }}' === patrolFilterTeam) && (patrolFilterDate === '' || '{{ $patrol->schedule_date }}' === patrolFilterDate)">
                                <td>
                                    <span class="spill {{ $patrol->team_name==='Team A' ? 'spill-active' : 'spill-pending' }}" style="font-size:10px;">
                                        {{ $patrol->team_name }}
                                    </span>
                                </td>
                                <td style="font-size:12px;font-weight:800;color:var(--text);">{{ $patrol->personnel_names }}</td>
                                <td style="font-size:11px;color:var(--muted);font-weight:600;">
                                    <div style="display:flex;flex-direction:column;gap:2px;">
                                        <span><i class="fas fa-calendar-day" style="width:14px;"></i> {{ \Carbon\Carbon::parse($patrol->schedule_date)->format('M d, Y') }}</span>
                                        @if($patrol->patrol_time)
                                        <span><i class="fas fa-clock" style="width:14px;"></i> {{ $patrol->patrol_time }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($patrol->status) {
                                            'On-Roving' => 'spill-active',
                                            'Completed' => 'spill-success',
                                            default     => 'spill-pending',
                                        };
                                    @endphp
                                    <span class="spill {{ $statusClass }}" style="font-size:9px; {{ $patrol->status === 'Completed' ? 'background:#dcfce7;color:#15803d;' : '' }}">
                                        {{ $patrol->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($patrol->image_path)
                                    @php
                                        $images = is_string($patrol->image_path) && str_starts_with($patrol->image_path, '[') ? json_decode($patrol->image_path, true) : [$patrol->image_path];
                                        $firstImg = $images[0] ?? '';
                                        $imgCount = count($images);
                                    @endphp
                                    <div style="display:flex;align-items:center;gap:6px;">
                                        <div @click="openProofPreview('{{ asset('storage/'.$firstImg) }}', '{{ addslashes($patrol->team_name) }} — Patrol Proof', '{{ \Carbon\Carbon::parse($patrol->schedule_date)->format('M d, Y') }} • {{ addslashes($patrol->personnel_names) }}')" 
                                             style="display:inline-flex;align-items:center;gap:6px;padding:3px 8px;background:#f8fafc;border:1.5px solid var(--border);border-radius:8px;cursor:pointer;transition:all .15s;"
                                             onmouseover="this.style.borderColor='var(--brand)';this.style.background='#eff6ff';"
                                             onmouseout="this.style.borderColor='var(--border)';this.style.background='#f8fafc';"
                                             title="Click to preview proof">
                                            <img src="{{ asset('storage/'.$firstImg) }}" style="width:26px;height:26px;border-radius:6px;object-fit:cover;border:1px solid #e2e8f0;flex-shrink:0;">
                                            <span style="font-size:10px;font-weight:800;color:var(--brand);display:flex;align-items:center;gap:4px;">
                                                <i class="fas fa-eye" style="font-size:9px;"></i> View Proof
                                                @if($imgCount > 1)
                                                    <span style="font-size:8px;background:#dbeafe;color:var(--brand);padding:1px 5px;border-radius:99px;">+{{ $imgCount - 1 }}</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    @else
                                    <button @click="activePatrolId={{ $patrol->id }}; proofModal=true" class="btn btn-ghost btn-sm" style="font-size:9px;padding:4px 9px;border:1.5px dashed var(--brand);color:var(--brand);background:#fff;border-radius:7px;font-weight:800;">
                                        <i class="fas fa-camera"></i> Upload Photo
                                    </button>
                                    @endif
                                </td>
                                <td style="text-align:right;">
                                    <div style="display:flex;justify-content:flex-end;gap:5px;align-items:center;">
                                        <form action="{{ route('peace.patrol.status', $patrol->id) }}" method="POST" style="margin:0;">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" style="font-size:9px;padding:2px 4px;border-radius:4px;border:1px solid var(--border);background:#fff;font-weight:700;color:var(--text);cursor:pointer;">
                                                <option value="Scheduled" {{ $patrol->status==='Scheduled'?'selected':'' }}>Scheduled</option>
                                                <option value="On-Roving" {{ $patrol->status==='On-Roving'?'selected':'' }}>On-Roving</option>
                                                <option value="Completed" {{ $patrol->status==='Completed'?'selected':'' }}>Completed</option>
                                            </select>
                                        </form>
                                        <form action="{{ route('peace.patrol.destroy', $patrol->id) }}" method="POST" onsubmit="return confirm('Delete this assignment?');" style="margin:0;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-icon" style="color:var(--danger);"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6"><div class="tbl-empty"><i class="fas fa-users"></i><p style="font-size:11px;font-weight:700;">No team assignments yet.</p><p style="font-size:10px;color:var(--light);margin-top:4px;font-weight:600;">Use the buttons above to assign personnel to Team A or B.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ EMERGENCY SOS DISPATCH TAB ══ --}}
        <div x-show="activeTab==='sos'" x-transition x-cloak>
            {{-- Active Dispatches --}}
            <div class="card" style="margin-bottom:20px;">
                <div class="card-head">
                    <div class="card-title" style="color:var(--text);display:flex;align-items:center;gap:8px;">
                        <div style="width:30px;height:30px;border-radius:8px;background:#fee2e2;color:#dc2626;display:flex;align-items:center;justify-content:center;font-size:13px;cursor:pointer;transition:transform .15s;" @click="playEmergencyChime()" title="Click icon to sound siren" onmouseover="this.style.transform='scale(1.15)'" onmouseout="this.style.transform='scale(1)'">
                            <i class="fas fa-bullhorn" :class="sosAlerts.length > 0 ? 'ringing-bell' : ''"></i>
                        </div>
                        <span>Active SOS Emergency Alerts</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <button type="button" @click="pollSosAlerts()" class="btn btn-ghost btn-sm"><i class="fas fa-sync-alt"></i> Refresh</button>
                        <span class="cbadge" style="background:#fee2e2;color:#dc2626;" x-text="sosAlerts.length + ' Pending Dispatches'"></span>
                    </div>
                </div>

                <template x-if="sosAlerts.length === 0">
                    <div class="tbl-empty" style="padding:40px 20px;">
                        <div style="width:54px;height:54px;border-radius:50%;background:#dcfce7;color:#15803d;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:24px;">
                            <i class="fas fa-shield-check"></i>
                        </div>
                        <p style="font-size:12px;font-weight:800;color:var(--text);margin-bottom:4px;">No Active Emergency SOS Alerts</p>
                        <p style="font-size:10px;color:var(--muted);font-weight:600;">All resident emergency requests have been resolved or attended to.</p>
                    </div>
                </template>

                <template x-if="sosAlerts.length > 0">
                    <div style="padding:18px;display:flex;flex-direction:column;gap:14px;background:#fff;">
                        <template x-for="alert in sosAlerts" :key="alert.id">
                            <div style="background:#ffffff;border:1.5px solid var(--border);border-left:5px solid #dc2626;border-radius:14px;padding:18px 20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:18px;box-shadow:0 3px 14px rgba(4,25,45,0.06);">
                                <div style="flex:1;min-width:280px;">
                                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;flex-wrap:wrap;">
                                        <span style="font-size:9px;font-weight:900;background:#dc2626;color:#fff;padding:2.5px 9px;border-radius:99px;text-transform:uppercase;letter-spacing:0.04em;" x-text="alert.emergency_type"></span>
                                        <span style="font-size:10px;color:var(--muted);font-weight:700;" x-text="alert.created_at_fmt + ' (' + alert.time_ago + ')'"></span>
                                        <span style="font-size:9px;font-weight:900;padding:2.5px 9px;border-radius:99px;" :style="alert.status==='responding'?'background:#fef3c7;color:#92400e;':'background:#fee2e2;color:#dc2626;'" x-text="alert.status.toUpperCase()"></span>
                                    </div>
                                    <div style="font-size:16px;font-weight:900;color:var(--text);margin-top:2px;" x-text="alert.resident_name"></div>
                                    <div style="font-size:11px;color:#475569;font-weight:700;margin-top:4px;">
                                        <i class="fas fa-phone-alt" style="color:var(--brand);margin-right:4px;"></i> <span x-text="alert.resident_contact"></span> &bull; 
                                        <i class="fas fa-home" style="color:var(--brand);margin-right:4px;"></i> <span x-text="'Registered Address: ' + alert.resident_address"></span>
                                    </div>
                                    
                                    {{-- Prominent Incident Landmark / Location Box in SOS Tab --}}
                                    <div style="margin-top:10px;padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;border-left:4px solid #dc2626;border-radius:8px;">
                                        <div style="font-size:9.5px;font-weight:900;color:#991b1b;text-transform:uppercase;letter-spacing:0.05em;display:flex;align-items:center;gap:6px;">
                                            <i class="fas fa-map-marker-alt"></i> INCIDENT LANDMARK / LOCATION:
                                        </div>
                                        <div style="font-size:13px;color:#7f1d1d;font-weight:900;margin-top:3px;line-height:1.4;" x-text="alert.landmark ? alert.landmark : ('Same as registered address: ' + alert.resident_address)"></div>
                                    </div>

                                    {{-- Situation Reason / Notes Box in SOS Tab (Only shown if provided) --}}
                                    <template x-if="alert.message">
                                        <div style="margin-top:7px;padding:9px 13px;background:#fffbeb;border:1px solid #fde68a;border-left:4px solid #d97706;border-radius:8px;">
                                            <div style="font-size:9.5px;font-weight:900;color:#b45309;text-transform:uppercase;letter-spacing:0.05em;display:flex;align-items:center;gap:6px;">
                                                <i class="fas fa-info-circle"></i> SITUATION DETAILS / REASON:
                                            </div>
                                            <div style="font-size:12.5px;color:#78350f;font-weight:700;margin-top:2px;line-height:1.4;" x-text="alert.message"></div>
                                        </div>
                                    </template>
                                </div>

                                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                                    <template x-if="alert.google_maps_url">
                                        <a :href="alert.google_maps_url" target="_blank" class="btn btn-sm" style="background:#0284c7;color:#fff;text-decoration:none;box-shadow:0 2px 6px rgba(2,132,199,0.25);">
                                            <i class="fas fa-map-marked-alt"></i> View GPS Map
                                        </a>
                                    </template>
                                    <template x-if="alert.status !== 'responding'">
                                        <button type="button" @click="updateSosStatus(alert.id, 'responding')" class="btn btn-sm" style="background:#d97706;color:#fff;box-shadow:0 2px 6px rgba(217,119,6,0.25);">
                                            <i class="fas fa-running"></i> Dispatch Tanod
                                        </button>
                                    </template>
                                    <button type="button" @click="updateSosStatus(alert.id, 'resolved')" class="btn btn-sm btn-success" style="box-shadow:0 2px 6px rgba(5,150,105,0.25);">
                                        <i class="fas fa-check-circle"></i> Mark Resolved
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            {{-- Resolved SOS History --}}
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-history"></i> Recent Resolved SOS Dispatches</div>
                    <span class="cbadge cbadge-green">{{ count($recentResolvedSos) }} Recent</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>Alert ID</th>
                                <th>Resident Name</th>
                                <th>Nature / Details</th>
                                <th>Contact & Address</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentResolvedSos as $rsos)
                            @php
                                $rname = $rsos->resident_name ?? ($rsos->user ? $rsos->user->first_name . ' ' . $rsos->user->last_name : 'Barangay Resident');
                                $rcontact = $rsos->resident_contact ?? ($rsos->user?->phone_number ?? 'N/A');
                                $raddr = $rsos->resident_address ?? ($rsos->user?->resident?->address ?? ($rsos->user?->address ?? 'Barangay San Miguel II'));
                            @endphp
                            <tr>
                                <td style="font-weight:900;color:var(--brand);">#SOS-{{ sprintf('%04d', $rsos->id) }}</td>
                                <td style="font-weight:800;color:var(--text);">{{ $rname }}</td>
                                <td>
                                    <span style="font-size:8px;font-weight:900;background:#f1f5f9;color:#475569;padding:2px 6px;border-radius:99px;text-transform:uppercase;">{{ $rsos->emergency_type ?? 'Emergency SOS' }}</span>
                                    @if($rsos->landmark)
                                        <div style="font-size:10px;font-weight:800;color:#991b1b;margin-top:3px;background:#fef2f2;padding:3px 7px;border-radius:4px;border-left:2.5px solid #dc2626;">
                                            <span style="font-size:8.5px;font-weight:900;text-transform:uppercase;">📍 Landmark:</span> {{ \Illuminate\Support\Str::limit($rsos->landmark, 70) }}
                                        </div>
                                    @endif
                                    @if($rsos->message)
                                        <div style="font-size:9.5px;font-weight:600;color:#475569;margin-top:2px;">
                                            <span style="font-weight:800;color:#b45309;">Reason:</span> {{ \Illuminate\Support\Str::limit($rsos->message, 70) }}
                                        </div>
                                    @endif
                                </td>
                                <td style="font-size:10.5px;color:#475569;font-weight:600;">
                                    <div><i class="fas fa-phone-alt" style="font-size:9px;margin-right:2px;"></i> {{ $rcontact }}</div>
                                    <div style="font-size:9.5px;color:var(--muted);">{{ $raddr }}</div>
                                </td>
                                <td style="font-size:10px;color:var(--muted);font-weight:700;">
                                    <div>{{ $rsos->created_at->format('M d, Y') }}</div>
                                    <div style="font-size:9px;color:var(--light);">{{ $rsos->created_at->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <span class="spill spill-settled"><i class="fas fa-check"></i> Resolved</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6"><div class="tbl-empty"><i class="fas fa-clipboard-check"></i><p style="font-size:11px;font-weight:700;">No resolved SOS records found.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ══ REPORTS TAB (EDITABLE PEACE & ORDER / TANOD ACCOMPLISHMENT MATRIX, EXPORT PDF & SEND TO ADMIN) ══ --}}
        <div x-show="activeTab==='reports'" x-transition>
            <div class="card">
                <div class="card-head">
                    <div class="card-title"><i class="fas fa-file-invoice"></i> Peace & Order Monthly Accomplishment Report</div>
                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                        <button type="button" @click="templateUploadModal=true" class="btn btn-ghost btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-cloud-upload-alt"></i> Format / Template
                        </button>
                        <button type="button" @click="printPeaceReport()" class="btn btn-ghost btn-sm" style="display:inline-flex;align-items:center;gap:6px;">
                            <i class="fas fa-print"></i> Export / Print PDF
                        </button>
                        <form action="{{ route('department.reports.submit') }}" method="POST" style="margin:0;">
                            @csrf
                            <input type="hidden" name="department" value="Peace & Order">
                            <input type="hidden" name="report_title" value="MONTHLY PEACE & ORDER & BARANGAY TANOD ACCOMPLISHMENT REPORT">
                            <input type="hidden" name="reporting_period" :value="peaceRep.monthYear">
                            <input type="hidden" name="report_data" :value="JSON.stringify(peaceRep)">
                            <input type="hidden" name="submitted_by" :value="peaceRep.preparedBy">
                            <input type="hidden" name="submitted_role" :value="peaceRep.preparedRole">
                            <button type="submit" class="btn btn-sm" style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#059669,#064e3b);color:#fff;">
                                <i class="fas fa-paper-plane"></i> Send / Transfer to Admin
                            </button>
                        </form>
                    </div>
                </div>

                <div style="padding:20px;background:#f8fafc;border-bottom:1px solid var(--border);">
                    <div id="peace-printable-report" style="background:#fff;padding:24px;border-radius:12px;border:1.5px solid #cbd5e1;box-shadow:0 4px 12px rgba(0,0,0,0.04);font-family:'Times New Roman', serif;color:#000;">
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
                                COMMITTEE ON PEACE AND ORDER & PUBLIC SAFETY
                            </div>
                            <div style="border-bottom:1.5px solid #000; width:100%; margin:8px auto 14px;"></div>

                            <div style="font-size:13px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em;">
                                Office of the Punong Barangay
                            </div>
                            <div style="font-size:12.5px; font-weight:bold; text-transform:uppercase; letter-spacing:0.04em; margin-top:2px;">
                                MONTHLY PEACE & ORDER & BARANGAY TANOD ACCOMPLISHMENT REPORT
                            </div>
                            <div style="font-size:11.5px; font-weight:bold; text-transform:uppercase; margin-top:3px; display:flex; align-items:center; justify-content:center; gap:6px;">
                                FOR THE MONTH OF 
                                <input type="text" x-model="peaceRep.monthYear" title="Click to edit Month & Year"
                                       style="font-weight:bold; text-transform:uppercase; width:160px; text-align:center; font-family:'Times New Roman', serif; font-size:11.5px; border-bottom:1px solid #000; border-top:none; border-left:none; border-right:none; background:transparent; outline:none;">
                            </div>
                        </div>

                        {{-- Sub Meta Top-Left --}}
                        <div style="font-size:11px; margin-bottom:10px; line-height:1.4;">
                            <div><strong>Province:</strong> <input type="text" x-model="peaceRep.province" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:120px; font-weight:bold; background:transparent;"></div>
                            <div><strong>City:</strong> <input type="text" x-model="peaceRep.city" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                            <div><strong>Barangay:</strong> <input type="text" x-model="peaceRep.barangay" style="border:none; border-bottom:1px dashed #cbd5e1; font-family:inherit; font-size:inherit; width:140px; font-weight:bold; background:transparent;"></div>
                        </div>

                        {{-- Official Peace & Order Matrix Table --}}
                        <div style="overflow-x:auto;">
                            <table style="width:100%; border-collapse:collapse; font-size:10px; text-align:center; border:1.5px solid #000;">
                                <thead>
                                    <tr style="background:#f8fafc;">
                                        <th colspan="3" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:25%;">Security Desk & Tanod Force</th>
                                        <th colspan="6" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:45%;">Blotter Incidents Logged</th>
                                        <th colspan="5" style="border:1px solid #000; padding:6px 3px; font-size:9.5px; vertical-align:middle; width:30%;">Actions Taken & Resolutions</th>
                                    </tr>
                                    <tr style="background:#f1f5f9;">
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Presence of Desk</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Tanod Logbook</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Tanods on Duty</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Vehicular Accidents</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Noise Disturbance</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Theft / Robbery</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Physical Injuries</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Other Cases</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Settled at Desk</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Escalated to KP</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Referred to PNP</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold;">Transferred VAWC</th>
                                        <th style="border:1px solid #000; padding:4px 2px; font-size:9px; font-weight:bold; background:#e2e8f0;">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height:44px; background:#fff;">
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="text" x-model="peaceRep.hasDesk" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; font-weight:bold; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="text" x-model="peaceRep.hasLogbook" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.tanodsOnDuty" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        {{-- Incidents breakdown --}}
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.vehicularAccidents" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.noiseDisturbance" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.theftRobbery" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.physicalInjuries" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.otherIncidents" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="peaceRep.totalIncidents"></td>
                                        {{-- Actions taken breakdown --}}
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.settledAtDesk" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.escalatedJustice" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.referredPnp" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px;">
                                            <input type="number" x-model.number="peaceRep.transferredVawc" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                        </td>
                                        <td style="border:1px solid #000; padding:2px; font-weight:bold; background:#f8fafc;" x-text="peaceRep.totalActed"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Signatures Footer --}}
                        <div style="margin-top:40px; display:flex; justify-content:space-between; align-items:flex-start; padding:0 24px;">
                            <div style="width:240px; text-align:left;">
                                <div style="font-size:11px;">Prepared by :</div>
                                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                                    <input type="text" x-model="peaceRep.preparedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                                </div>
                                <div style="text-align:center; margin-top:2px;">
                                    <input type="text" x-model="peaceRep.preparedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </div>
                            </div>

                            <div style="width:240px; text-align:left;">
                                <div style="font-size:11px;">Noted by:</div>
                                <div style="margin-top:35px; border-bottom:1.5px solid #000; padding-bottom:2px; text-align:center;">
                                    <input type="text" x-model="peaceRep.notedBy" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-weight:bold; font-size:11.5px; text-transform:uppercase; outline:none;">
                                </div>
                                <div style="text-align:center; margin-top:2px;">
                                    <input type="text" x-model="peaceRep.notedRole" title="Editable" style="width:100%; text-align:center; border:none; background:transparent; font-family:inherit; font-size:10.5px; outline:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBMITTED REPORTS HISTORY TABLE --}}
                <div style="padding:16px 20px;">
                    <div style="font-size:11px;font-weight:900;color:var(--text);text-transform:uppercase;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-history" style="color:var(--brand);"></i> Submitted Peace & Order Reports to Admin History
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
                            @forelse(($peaceReports ?? collect()) as $rep)
                            <tr>
                                <td><div style="font-size:11px;font-weight:900;color:var(--text);">{{ $rep->report_title }}</div></td>
                                <td><span class="spill spill-active" style="font-size:9.5px;">{{ $rep->reporting_period }}</span></td>
                                <td><div style="font-size:11px;font-weight:700;">{{ $rep->submitted_by }} <span style="font-size:9px;color:var(--muted);">({{ $rep->submitted_role }})</span></div></td>
                                <td><div style="font-size:11px;color:var(--brand);font-weight:800;">{{ $rep->created_at->format('M d, Y h:i A') }}</div></td>
                                <td><span class="spill spill-settled" style="font-size:9px;"><i class="fas fa-check-circle"></i> {{ $rep->status }}</span></td>
                                <td style="text-align:right;">
                                    <div style="display:inline-flex;gap:6px;">
                                        <a href="{{ route('department.reports.show', $rep->id) }}" target="_blank" class="btn btn-sm btn-primary" title="Preview / Print Landscape Report">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($rep->template_file)
                                        <a href="{{ asset('storage/' . $rep->template_file) }}" target="_blank" class="btn btn-sm btn-ghost" title="View Attached Template">
                                            <i class="fas fa-paperclip"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6"><div class="tbl-empty"><i class="fas fa-file-invoice"></i><p style="font-size:11px;font-weight:700;">No accomplishment reports submitted to admin yet.</p></div></td></tr>
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
                                <template x-if="activeIssue.status==='approved'"><span class="spill spill-settled" style="font-size:11px;padding:5px 14px;"><i class="fas fa-thumbs-up"></i> Approved</span></template>
                                <template x-if="activeIssue.status==='settled'"><span class="spill spill-settled" style="font-size:11px;padding:5px 14px;"><i class="fas fa-check-circle"></i> Settled</span></template>
                                <template x-if="activeIssue.status==='pending'"><span class="spill spill-pending" style="font-size:11px;padding:5px 14px;"><i class="fas fa-pause-circle"></i> Pending</span></template>
                                <template x-if="activeIssue.status==='rejected'"><span class="spill spill-new" style="font-size:11px;padding:5px 14px;"><i class="fas fa-times-circle"></i> Rejected</span></template>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-tag"></i> Case Information</div>
                                <div class="fgrid2" style="gap:8px;">
                                    <div class="vfield"><div class="vfield-lbl">Case Code</div><div class="vfield-val" x-text="'#'+activeIssue.case_code"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Category</div><div class="vfield-val" x-text="activeIssue.issue_type"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Report Date</div><div class="vfield-val" x-text="activeIssue.created_at"></div></div>
                                    <div class="vfield"><div class="vfield-lbl">Incident Date</div><div class="vfield-val" x-text="activeIssue.incident_date"></div></div>
                                    <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Location</div><div class="vfield-val" x-text="activeIssue.location"></div></div>
                                    <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Witness Name</div><div class="vfield-val" x-text="activeIssue.witness_name"></div></div>
                                </div>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-user"></i> Complainant</div>
                                <template x-if="activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace'">
                                    <div style="font-size:10px; font-weight:700; color:var(--muted); text-align:center; padding:15px; background:#f8fafc; border-radius:8px;">Complainant details are restricted.</div>
                                </template>
                                <template x-if="!(activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace')">
                                    <div class="fgrid2" style="gap:8px;">
                                         <div class="vfield" style="grid-column:span 2;">
                                             <div class="vfield-lbl">Full Name</div>
                                             <div class="vfield-val">
                                                 <span x-text="activeIssue.complainant_name"></span>
                                                 <template x-if="!activeIssue.user_id">
                                                     <span class="cbadge cbadge-red" style="font-size:7px; padding:2px 6px; vertical-align:middle; margin-left:4px;">GUEST</span>
                                                 </template>
                                             </div>
                                         </div>
                                        <div class="vfield"><div class="vfield-lbl">Age / Gender</div><div class="vfield-val" x-text="activeIssue.complainant_age + ' / ' + activeIssue.complainant_gender"></div></div>
                                        <div class="vfield"><div class="vfield-lbl">Contact</div><div class="vfield-val" x-text="activeIssue.contact"></div></div>
                                        <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Address</div><div class="vfield-val" x-text="activeIssue.complainant_address"></div></div>
                                    </div>
                                </template>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-user-slash"></i> Respondent</div>
                                <template x-if="activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace'">
                                    <div style="font-size:10px; font-weight:700; color:var(--muted); text-align:center; padding:15px; background:#f8fafc; border-radius:8px;">Respondent details are restricted.</div>
                                </template>
                                <template x-if="!(activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace')">
                                    <div class="fgrid2" style="gap:8px;">
                                        <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Full Name</div><div class="vfield-val" x-text="activeIssue.respondent_name"></div></div>
                                        <div class="vfield" style="grid-column:span 2;"><div class="vfield-lbl">Address</div><div class="vfield-val" x-text="activeIssue.respondent_address"></div></div>
                                    </div>
                                </template>
                            </div>
                            <div class="sblk">
                                <div class="sblk-ttl"><i class="fas fa-file-alt"></i> Description</div>
                                <template x-if="activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace'">
                                    <div style="background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border: 1px solid #fed7aa; border-radius: 12px; padding: 24px; text-align: center; box-shadow: inset 0 2px 4px rgba(251,146,60,0.05);">
                                        <div style="width:42px; height:42px; background:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px; box-shadow:0 4px 12px rgba(251,146,60,0.2);">
                                            <i class="fas fa-shield-alt" style="font-size:18px; color:#f97316;"></i>
                                        </div>
                                        <div style="font-size:12px; font-weight:900; color:#9a3412; text-transform:uppercase; letter-spacing:0.03em;">Privacy Restriction Active</div>
                                        <div style="font-size:10px; font-weight:600; color:#c2410c; margin-top:6px; line-height:1.5; max-width:280px; margin-left:auto; margin-right:auto;">
                                            This incident involves sensitive details (Physical Assault/VAWC). Full access is restricted for security. Please transfer to VAWC for appropriate handling.
                                        </div>
                                        <div style="margin-top:14px; display:flex; justify-content:center;">
                                            <button @click="viewModal=false; openTransfer(activeIssue.id)" class="btn btn-sm" style="background:#f97316; color:#fff; font-size:9px; font-weight:800; border-radius:8px; padding:7px 15px; border:none; cursor:pointer; box-shadow:0 4px 10px rgba(249,115,22,0.3);">
                                                <i class="fas fa-paper-plane"></i> Transfer to VAWC
                                            </button>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!(activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace')">
                                    <div style="background:#fff;border:1px solid var(--border);border-radius:8px;padding:12px;font-size:12px;font-weight:600;color:var(--text);line-height:1.7;white-space:pre-wrap;" x-text="activeIssue.description || 'No description provided.'"></div>
                                </template>
                            </div>
                            <div class="sblk" x-show="activeIssue.evidence && activeIssue.evidence.length > 0">
                                <div class="sblk-ttl"><i class="fas fa-paperclip"></i> Uploaded Evidence</div>
                                <template x-if="activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace'">
                                    <div style="font-size:10px; font-weight:700; color:var(--muted); text-align:center; padding:10px;">Files are restricted for sensitive cases.</div>
                                </template>
                                <template x-if="!(activeIssue.is_restricted && '{{ auth()->user()->role }}' === 'peace')">
                                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                                        <template x-for="(ev, idx) in activeIssue.evidence" :key="idx">
                                            <a :href="'/storage/'+ev" target="_blank" style="background:#fff;border:1px solid var(--border);border-radius:6px;padding:8px 12px;font-size:10px;font-weight:700;color:var(--brand);text-decoration:none;display:flex;align-items:center;gap:6px;"><i class="fas fa-file"></i> View File <span x-text="idx+1"></span></a>
                                        </template>
                                    </div>
                                </template>
                            </div>
                            <template x-if="activeIssue.status === 'rejected' && activeIssue.rejection_reason">
                                <div class="sblk" style="border-color:#fca5a5;background:#fef2f2;">
                                    <div class="sblk-ttl" style="color:#dc2626;"><i class="fas fa-times-circle"></i> Reason for Rejection</div>
                                    <div style="background:#fff;border:1px solid #fecaca;border-radius:8px;padding:12px;font-size:12px;font-weight:600;color:#dc2626;line-height:1.7;white-space:pre-wrap;" x-text="activeIssue.rejection_reason"></div>
                                </div>
                            </template>
                            <div style="display:flex;justify-content:space-between;gap:8px;flex-wrap:wrap;">
                                <button type="button" @click="viewModal=false; openEscalate(activeIssue.id)" class="btn btn-warn btn-sm" style="background:linear-gradient(135deg,#d97706,#b45309);color:#fff;"><i class="fas fa-gavel"></i> Escalate to KP (Justice)</button>
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
                    <form action="{{ route('peace.blotter.store') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="fgrp"><label class="flbl">Contact *</label><input type="text" name="contact" required class="finput" placeholder="09XXXXXXXXX" pattern="\d{11}" maxlength="11" minlength="11" title="Please enter exactly 11 digits (e.g. 09123456789)" oninput="this.value = this.value.replace(/[^0-9]/g, '');"></div>
                                <div class="fgrp"><label class="flbl">Age *</label><input type="number" name="complainant_age" required min="18" class="finput" placeholder="Min. 18"></div>
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
                                <div class="fgrp"><label class="flbl">Date & Time *</label><input type="datetime-local" name="incident_date" required class="finput" max="{{ date('Y-m-d\TH:i') }}" min="{{ date('Y-m-d\TH:i', strtotime('-6 months')) }}"></div>
                                <div class="fgrp"><label class="flbl">Location *</label><input type="text" name="incident_location" required class="finput" placeholder="Purok, Street..."></div>
                                <div class="fgrp fspan2"><label class="flbl">Description *</label><textarea name="description" required rows="3" class="finput" style="resize:vertical;" placeholder="Describe the incident..."></textarea></div>
                                <div class="fgrp"><label class="flbl">Witness Name (Optional)</label><input type="text" name="witness_name" class="finput" placeholder="Name of witness"></div>
                                <div class="fgrp"><label class="flbl">Upload Proof (Optional)</label><input type="file" name="evidence[]" multiple accept="image/*,video/*,.pdf" class="finput" style="padding:6px;"></div>
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

        {{-- ══ PATROL ASSIGNMENT MODAL ══ --}}
        <div x-show="patrolModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:440px;" @click.away="patrolModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;"><i class="fas fa-user-plus" style="color:var(--brand);"></i></div>
                            <div>
                                <div x-text="'Assign ' + patrolTeam"></div>
                                <div style="font-size:9px;font-weight:700;color:var(--muted);text-transform:none;" x-text="patrolTeam==='Team A' ? 'Schedule: M W F' : 'Schedule: T, S, TH'"></div>
                            </div>
                        </div>
                        <button @click="patrolModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form action="{{ route('peace.patrol.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="team_name" :value="patrolTeam">
                        
                        <div class="fgrp">
                            <label class="flbl">Personnel Assigned * (Max 10)</label>
                            <template x-for="(name, index) in personnelList" :key="index">
                                <div style="display:flex;gap:6px;margin-bottom:6px;">
                                    <input type="text" name="personnel_names[]" required maxlength="30" class="finput" x-model="personnelList[index]" placeholder="Enter name...">
                                    <template x-if="personnelList.length > 1">
                                        <button type="button" @click="personnelList.splice(index, 1)" style="background:#fee2e2;color:#dc2626;border:none;border-radius:8px;width:34px;flex-shrink:0;cursor:pointer;"><i class="fas fa-times"></i></button>
                                    </template>
                                </div>
                            </template>
                            <button type="button" x-show="personnelList.length < 10" @click="personnelList.push('')" style="font-size:9px;font-weight:800;color:var(--brand);background:none;border:none;cursor:pointer;display:flex;align-items:center;gap:4px;padding:4px 0;">
                                <i class="fas fa-plus-circle"></i> Add More Personnel
                            </button>
                        </div>

                        <div class="fgrp" style="margin-bottom:12px;">
                            <label class="flbl">Patrol Date *</label>
                            <input type="date" name="schedule_date" required class="finput" min="{{ date('Y-m-d') }}">
                        </div>

                        <div x-data="{
                            startHour: '10',
                            startMin: '00',
                            startPeriod: 'PM',
                            startPickerOpen: false,
                            endHour: '01',
                            endMin: '00',
                            endPeriod: 'AM',
                            endPickerOpen: false,
                            hours: ['12','01','02','03','04','05','06','07','08','09','10','11'],
                            minutes: ['00','05','10','15','20','25','30','35','40','45','50','55']
                        }">
                            <input type="hidden" name="patrol_time_start" :value="startHour + ':' + startMin + ' ' + startPeriod">
                            <input type="hidden" name="patrol_time_end" :value="endHour + ':' + endMin + ' ' + endPeriod">

                            <div class="fgrid2" style="gap:12px;position:relative;">
                                {{-- START TIME PICKER --}}
                                <div class="fgrp" style="position:relative;" @click.away="startPickerOpen=false">
                                    <label class="flbl"><i class="fas fa-clock" style="color:var(--brand);margin-right:2px;"></i> Start Time</label>
                                    <div @click="startPickerOpen = !startPickerOpen; endPickerOpen = false" 
                                         class="finput" 
                                         style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;background:#fff;user-select:none;">
                                        <span style="font-weight:800;color:var(--text);" x-text="startHour + ':' + startMin + ' ' + startPeriod"></span>
                                        <i class="fas fa-chevron-down" style="font-size:10px;color:var(--muted);transition:transform .2s;" :style="startPickerOpen ? 'transform:rotate(180deg);color:var(--brand);' : ''"></i>
                                    </div>

                                    {{-- DROPDOWN POPOVER WITH VISIBLE SCROLLBARS --}}
                                    <div x-show="startPickerOpen" x-transition x-cloak
                                         style="position:absolute;top:100%;left:0;width:240px;background:#fff;border:1.5px solid var(--border);border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.15);padding:10px;z-index:999;margin-top:4px;">
                                        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:6px;border-bottom:1px solid #f1f5f9;padding-bottom:8px;margin-bottom:8px;">
                                            {{-- HOURS --}}
                                            <div>
                                                <div style="font-size:8px;font-weight:900;color:var(--muted);text-align:center;margin-bottom:4px;text-transform:uppercase;">Hr</div>
                                                <div class="time-scroll-col" style="max-height:130px;overflow-y:scroll;padding-right:2px;">
                                                    <template x-for="h in hours" :key="h">
                                                        <button type="button" @click="startHour=h"
                                                                :style="startHour===h ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                                class="time-btn-opt"
                                                                x-text="h"></button>
                                                    </template>
                                                </div>
                                            </div>
                                            {{-- MINUTES --}}
                                            <div>
                                                <div style="font-size:8px;font-weight:900;color:var(--muted);text-text:center;margin-bottom:4px;text-transform:uppercase;text-align:center;">Min</div>
                                                <div class="time-scroll-col" style="max-height:130px;overflow-y:scroll;padding-right:2px;">
                                                    <template x-for="m in minutes" :key="m">
                                                        <button type="button" @click="startMin=m"
                                                                :style="startMin===m ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                                class="time-btn-opt"
                                                                x-text="m"></button>
                                                    </template>
                                                </div>
                                            </div>
                                            {{-- AM / PM --}}
                                            <div>
                                                <div style="font-size:8px;font-weight:900;color:var(--muted);text-align:center;margin-bottom:4px;text-transform:uppercase;">Period</div>
                                                <div style="display:flex;flex-direction:column;gap:5px;padding-top:2px;">
                                                    <button type="button" @click="startPeriod='AM'"
                                                            :style="startPeriod==='AM' ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                            class="time-btn-opt">AM</button>
                                                    <button type="button" @click="startPeriod='PM'"
                                                            :style="startPeriod==='PM' ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                            class="time-btn-opt">PM</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;align-items:center;">
                                            <span style="font-size:10px;font-weight:900;color:var(--brand);" x-text="startHour + ':' + startMin + ' ' + startPeriod"></span>
                                            <button type="button" @click="startPickerOpen=false" style="background:var(--brand);color:#fff;border:none;border-radius:6px;padding:3px 10px;font-size:9px;font-weight:800;cursor:pointer;">Done</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- END TIME PICKER --}}
                                <div class="fgrp" style="position:relative;" @click.away="endPickerOpen=false">
                                    <label class="flbl"><i class="fas fa-clock" style="color:var(--brand);margin-right:2px;"></i> End Time</label>
                                    <div @click="endPickerOpen = !endPickerOpen; startPickerOpen = false" 
                                         class="finput" 
                                         style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;background:#fff;user-select:none;">
                                        <span style="font-weight:800;color:var(--text);" x-text="endHour + ':' + endMin + ' ' + endPeriod"></span>
                                        <i class="fas fa-chevron-down" style="font-size:10px;color:var(--muted);transition:transform .2s;" :style="endPickerOpen ? 'transform:rotate(180deg);color:var(--brand);' : ''"></i>
                                    </div>

                                    {{-- DROPDOWN POPOVER WITH VISIBLE SCROLLBARS --}}
                                    <div x-show="endPickerOpen" x-transition x-cloak
                                         style="position:absolute;top:100%;right:0;width:240px;background:#fff;border:1.5px solid var(--border);border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.15);padding:10px;z-index:999;margin-top:4px;">
                                        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:6px;border-bottom:1px solid #f1f5f9;padding-bottom:8px;margin-bottom:8px;">
                                            {{-- HOURS --}}
                                            <div>
                                                <div style="font-size:8px;font-weight:900;color:var(--muted);text-align:center;margin-bottom:4px;text-transform:uppercase;">Hr</div>
                                                <div class="time-scroll-col" style="max-height:130px;overflow-y:scroll;padding-right:2px;">
                                                    <template x-for="h in hours" :key="h">
                                                        <button type="button" @click="endHour=h"
                                                                :style="endHour===h ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                                class="time-btn-opt"
                                                                x-text="h"></button>
                                                    </template>
                                                </div>
                                            </div>
                                            {{-- MINUTES --}}
                                            <div>
                                                <div style="font-size:8px;font-weight:900;color:var(--muted);text-align:center;margin-bottom:4px;text-transform:uppercase;">Min</div>
                                                <div class="time-scroll-col" style="max-height:130px;overflow-y:scroll;padding-right:2px;">
                                                    <template x-for="m in minutes" :key="m">
                                                        <button type="button" @click="endMin=m"
                                                                :style="endMin===m ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                                class="time-btn-opt"
                                                                x-text="m"></button>
                                                    </template>
                                                </div>
                                            </div>
                                            {{-- AM / PM --}}
                                            <div>
                                                <div style="font-size:8px;font-weight:900;color:var(--muted);text-align:center;margin-bottom:4px;text-transform:uppercase;">Period</div>
                                                <div style="display:flex;flex-direction:column;gap:5px;padding-top:2px;">
                                                    <button type="button" @click="endPeriod='AM'"
                                                            :style="endPeriod==='AM' ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                            class="time-btn-opt">AM</button>
                                                    <button type="button" @click="endPeriod='PM'"
                                                            :style="endPeriod==='PM' ? 'background:var(--brand);color:#fff;' : 'background:transparent;color:var(--text);'"
                                                            class="time-btn-opt">PM</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;align-items:center;">
                                            <span style="font-size:10px;font-weight:900;color:var(--brand);" x-text="endHour + ':' + endMin + ' ' + endPeriod"></span>
                                            <button type="button" @click="endPickerOpen=false" style="background:var(--brand);color:#fff;border:none;border-radius:6px;padding:3px 10px;font-size:9px;font-weight:800;cursor:pointer;">Done</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:15px;">
                            <button type="button" @click="patrolModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ ROVING PROOF MODAL ══ --}}
        <div x-show="proofModal" x-cloak class="modal-ov" x-transition x-data="{
            localProofPreviews: [],
            handleFiles(files) {
                if(files.length > 6) { alert('Maximum 6 photos allowed.'); return; }
                this.localProofPreviews = [];
                for(let i=0; i<files.length; i++) {
                    const r = new FileReader();
                    r.onload = e => this.localProofPreviews.push(e.target.result);
                    r.readAsDataURL(files[i]);
                }
            }
        }">
            <div class="modal-box" style="max-width:400px;" @click.away="proofModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#dcfce7;"><i class="fas fa-camera" style="color:#15803d;"></i></div>
                            <div>
                                <div>Upload Roving Proof</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Add photo after patrol roving</div>
                            </div>
                        </div>
                        <button @click="proofModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>
                    <form :action="'/peace/patrol/'+activePatrolId+'/proof'" method="POST" enctype="multipart/form-data">
                        @csrf @method('PATCH')
                        <div class="fgrp">
                            <label class="flbl">Upload Roving Photos (Max 6)</label>
                            <label style="cursor:pointer;display:block;"
                                @dragover.prevent="$refs.dzr.style.border='2px solid var(--brand)';$refs.dzr.style.background='#eff6ff'"
                                @dragleave.prevent="$refs.dzr.style.border='2px dashed var(--border)';$refs.dzr.style.background='#f8fafc'"
                                @drop.prevent="const f=$event.dataTransfer.files;if(f.length){$refs.filer.files=f;handleFiles(f);$refs.dzr.style.border='2px dashed var(--border)';$refs.dzr.style.background='#f8fafc'}">
                                <div x-ref="dzr" style="min-height:150px;padding:15px;border-radius:10px;background:#f8fafc;border:2px dashed var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;transition:all .2s;" :style="localProofPreviews.length?'border:2px solid var(--brand)':''">
                                    <div x-show="localProofPreviews.length > 0" style="display:flex;gap:8px;flex-wrap:wrap;justify-content:center;">
                                        <template x-for="(src, idx) in localProofPreviews" :key="idx">
                                            <img :src="src" style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #ccc;">
                                        </template>
                                    </div>
                                    <div x-show="localProofPreviews.length === 0" style="text-align:center;">
                                        <i class="fas fa-images" style="font-size:24px;color:var(--light);margin-bottom:6px;"></i>
                                        <div style="font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;">Upload Roving Photos</div>
                                        <div style="font-size:9px;font-weight:600;color:var(--light);">Click or Drag & Drop (Up to 6)</div>
                                    </div>
                                </div>
                                <input type="file" name="roving_photo[]" accept="image/*" multiple style="display:none;" x-ref="filer" required @change="const f=$event.target.files;if(f.length){handleFiles(f)}">
                            </label>
                        </div>
                        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:15px;">
                            <button type="button" @click="proofModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Upload Photo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ REJECT INCIDENT MODAL ══ --}}
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
                    <form :action="'/peace/issues/'+rejectFormData.id+'/status'" method="POST">
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

        {{-- ══ ESCALATE TO KP (JUSTICE) CONFIRMATION MODAL ══ --}}
        <div x-show="escalateModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:440px;" @click.away="escalateModal=false">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#fef3c7;"><i class="fas fa-gavel" style="color:#a16207;"></i></div>
                            <div>
                                <div>Escalate to KP (Justice)</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;">Katarungang Pambarangay Referral</div>
                            </div>
                        </div>
                        <button @click="escalateModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <div style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:12px;padding:14px;margin-bottom:16px;">
                        <div style="display:flex;gap:10px;align-items:flex-start;">
                            <i class="fas fa-exclamation-triangle" style="color:#b45309;font-size:16px;margin-top:2px;flex-shrink:0;"></i>
                            <div>
                                <div style="font-size:12px;font-weight:900;color:#92400e;margin-bottom:4px;">Sigurado ka bang nais mong ipasa ang kasong ito sa Justice?</div>
                                <div style="font-size:10.5px;color:#78350f;line-height:1.5;">
                                    Ang kasong ito ay ililipat sa <strong>Justice Portal</strong> para sa pormal na patawag at mediation ng <strong>Lupon Tagapamayapa</strong>.
                                </div>
                                <div style="font-size:9.5px;font-weight:800;color:#b45309;margin-top:8px;background:#fef3c7;padding:4px 8px;border-radius:6px;display:inline-block;">
                                    ⚠️ Paalala: Pinal ang aksyong ito at hindi na mababawi (This cannot be undone).
                                </div>
                            </div>
                        </div>
                    </div>

                    <form :action="'/peace/issues/'+escalateIssueId+'/escalate-justice'" method="POST">
                        @csrf @method('PATCH')
                        <div style="display:flex;justify-content:flex-end;gap:8px;margin-top:10px;">
                            <button type="button" @click="escalateModal=false" class="btn btn-ghost" style="font-weight:700;">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="background:linear-gradient(135deg,#d97706,#b45309);font-weight:800;display:inline-flex;align-items:center;gap:6px;">
                                <i class="fas fa-gavel"></i> Oo, Ipasa sa Justice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- TRANSFER TO VAWC MODAL --}}
        <div class="modal-ov" x-show="transferModal" x-cloak style="display:none;">
            <div class="modal-box" style="max-width:400px;" @click.away="transferModal=false" x-transition>
                <div class="modal-in" style="text-align:center;">
                    <div style="width:60px; height:60px; background:#f5f3ff; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;">
                        <i class="fas fa-user-shield" style="font-size:24px; color:#7c3aed;"></i>
                    </div>
                    <h3 style="font-size:18px; font-weight:900; color:var(--text); margin-bottom:8px;">Transfer to VAWC?</h3>
                    <p style="font-size:12px; font-weight:600; color:var(--muted); line-height:1.6; margin-bottom:24px;">
                        This case will be moved to the <strong>VAWC Portal</strong> for specialized handling. Only VAWC officers will have full access to the details after transfer.
                    </p>
                    <form :action="'/peace/issues/'+transferIssueId+'/transfer-vawc'" method="POST">
                        @csrf @method('PATCH')
                        <div style="display:flex; flex-direction:column; gap:10px;">
                            <button type="submit" class="btn btn-grad" style="background:linear-gradient(135deg,#7c3aed,#5b21b6); width:100%; border-radius:10px; padding:12px; color:#fff; border:none; font-weight:800; cursor:pointer;">
                                <i class="fas fa-check-circle"></i> Confirm Transfer
                            </button>
                            <button type="button" @click="transferModal=false" class="btn btn-ghost" style="width:100%; border:none; background:none; cursor:pointer; font-weight:700; color:var(--muted);">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ IMPORT BLOTTER MODAL ══ --}}
        <div x-show="importModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" @click.away="importModal=false" style="max-width: 600px;">
                <div class="modal-in">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-file-excel"></i></div>
                            <div>
                                <div>Import Peace & Order Records</div>
                                <div style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;letter-spacing:0;">Upload Excel (.xlsx, .xls) or CSV files into Peace & Order</div>
                            </div>
                        </div>
                        <button @click="importModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ route('peace.import') }}" method="POST" enctype="multipart/form-data" x-data="{ importCount: 0, importFileName: '', isDragging: false }">
                        @csrf

                        {{-- TEMPLATE DOWNLOAD BANNER --}}
                        <div style="background:linear-gradient(135deg,#eff6ff 0%,#f0fdf4 100%);border:1.5px solid #bfdbfe;border-radius:12px;padding:12px 14px;margin-bottom:14px;display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:9px;background:#dbeafe;display:flex;align-items:center;justify-content:center;color:var(--brand);font-size:15px;flex-shrink:0;">
                                    <i class="fas fa-file-csv"></i>
                                </div>
                                <div>
                                    <div style="font-size:11px;font-weight:900;color:var(--brand-dark);">Download Sample Template</div>
                                    <div style="font-size:9px;font-weight:600;color:var(--muted);">Use this pre-formatted CSV template to organize your incident data.</div>
                                </div>
                            </div>
                            <a href="{{ route('peace.sample.template') }}" class="btn btn-sm" style="background:var(--brand);color:#fff;text-decoration:none;box-shadow:0 2px 6px rgba(14,83,147,0.25);">
                                <i class="fas fa-download"></i> Get Template
                            </a>
                        </div>

                        {{-- UPLOAD DROPZONE --}}
                        <div class="sblk" style="margin-bottom:12px;">
                            <div class="sblk-ttl" style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;margin-bottom:6px;"><i class="fas fa-cloud-upload-alt" style="color:var(--brand);"></i> Select File To Import</div>
                            <div class="upload-card"
                                 :style="isDragging ? 'border-color:var(--brand); background:#eff6ff;' : ''"
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

                        {{-- GUIDELINES --}}
                        <div class="sblk" style="background:#f8fafc;border-radius:10px;padding:11px;margin-bottom:14px;border:1px solid var(--border);">
                            <div class="sblk-ttl" style="font-size:10px;font-weight:900;color:var(--muted);text-transform:uppercase;margin-bottom:6px;"><i class="fas fa-info-circle" style="color:var(--brand);"></i> Expected Columns</div>
                            <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:5px;font-size:9px;font-weight:700;color:#475569;">
                                <div>• <span style="color:var(--brand);">Issue Type</span> (e.g. Noise Disturbance)</div>
                                <div>• <span style="color:var(--brand);">Complainant Name</span> (Full Name)</div>
                                <div>• <span style="color:var(--brand);">Contact Number</span> (e.g. 09123456789)</div>
                                <div>• <span style="color:var(--brand);">Respondent Name</span> (Full Name)</div>
                                <div>• <span style="color:var(--brand);">Incident Date</span> (YYYY-MM-DD)</div>
                                <div>• <span style="color:var(--brand);">Status</span> (submitted, under_review, pending, settled)</div>
                            </div>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap;">
                            <button type="button" @click="importModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" :disabled="!importFileName" style="background:var(--brand);color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:11px;font-weight:800;cursor:pointer;">
                                <i class="fas fa-file-import"></i> Upload & Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ══ ROVING PROOF PHOTO PREVIEW MODAL ══ --}}
        <div x-show="previewPhotoModal" x-cloak class="modal-ov" x-transition style="z-index:9999;">
            <div class="modal-box" @click.away="previewPhotoModal=false" style="max-width: 480px;">
                <div class="modal-in">
                    <div class="modal-hd" style="border-bottom: 1px solid var(--border); padding-bottom: 10px; margin-bottom: 14px;">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:var(--brand);"><i class="fas fa-camera"></i></div>
                            <div>
                                <div x-text="previewPhotoTitle || 'Patrol Proof Photo'" style="font-size:13px;font-weight:900;"></div>
                                <div x-text="previewPhotoMeta" style="font-size:9px;font-weight:600;color:var(--muted);text-transform:none;"></div>
                            </div>
                        </div>
                        <button @click="previewPhotoModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <div style="background:#f8fafc;border:1.5px solid var(--border);border-radius:12px;padding:12px;display:flex;align-items:center;justify-content:center;overflow:hidden;margin-bottom:14px;box-shadow:inset 0 2px 6px rgba(0,0,0,0.03);">
                        <img :src="previewPhotoSrc" style="max-width:100%;max-height:360px;width:auto;height:auto;object-fit:contain;border-radius:8px;box-shadow:0 4px 14px rgba(0,0,0,0.08);display:block;margin:0 auto;">
                    </div>

                    <div style="display:flex;justify-content:space-between;align-items:center;gap:8px;">
                        <button type="button" @click="previewPhotoModal=false" class="btn btn-ghost" style="font-size:11px;font-weight:700;">
                            Close
                        </button>
                        <a :href="previewPhotoSrc" download class="btn btn-primary" style="background:linear-gradient(135deg,var(--brand) 0%,#04192D 100%);color:#fff;text-decoration:none;display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:11px;font-weight:800;box-shadow:0 2px 8px rgba(14,83,147,0.3);">
                            <i class="fas fa-download"></i> Download Photo
                        </a>
                    </div>
                </div>
            </div>
        {{-- ══ UPLOAD CUSTOM TEMPLATE / FORMAT MODAL ══ --}}
        <div x-show="templateUploadModal" x-cloak class="modal-ov" x-transition>
            <div class="modal-box" style="max-width:520px;" @click.away="templateUploadModal=false">
                <div class="modal-in" style="padding:22px 24px;">
                    <div class="modal-hd">
                        <div class="modal-ttl">
                            <div class="modal-ico" style="background:#eff6ff;color:#0E5393;"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div>
                                <div>Upload Custom Report Format / Template</div>
                                <div style="font-size:9px;color:var(--muted);font-weight:600;text-transform:none;">Upload updated PNP / DILG Peace & Order template (PDF, DOCX, XLSX, JPG, PNG)</div>
                            </div>
                        </div>
                        <button type="button" @click="templateUploadModal=false" class="modal-close"><i class="fas fa-times-circle"></i></button>
                    </div>

                    <form action="{{ route('department.reports.upload_template') }}" method="POST" enctype="multipart/form-data" style="margin-top:14px;">
                        @csrf
                        <input type="hidden" name="department" value="Peace & Order">
                        <div style="background:#f8fafc;border:2px dashed #cbd5e1;border-radius:12px;padding:24px 16px;text-align:center;cursor:pointer;margin-bottom:16px;"
                             @click="$refs.customTemplateInput.click()">
                            <i class="fas fa-file-upload" style="font-size:32px;color:#0E5393;margin-bottom:8px;"></i>
                            <div style="font-size:12px;font-weight:800;color:var(--text);" x-ref="customTemplateTxt">Click to select new template file</div>
                            <div style="font-size:9px;color:var(--muted);margin-top:4px;">Supported: PDF, XLSX, DOCX, PNG, JPG (Max: 15MB)</div>
                            <input type="file" x-ref="customTemplateInput" name="template_file" style="display:none;" required
                                   @change="$refs.customTemplateTxt.innerText = $event.target.files[0]?.name || 'File selected'">
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:8px;">
                            <button type="button" @click="templateUploadModal=false" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-primary" style="background:#0E5393;color:#fff;">
                                <i class="fas fa-save"></i> Save Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <footer style="text-align:center;padding:16px;font-size:10px;color:var(--light);font-weight:600;">
        © {{ date('Y') }} Barangay SM2 Management System — Peace & Order Portal
    </footer>

    <script>
        function printPeaceReportHelper() {
            const el = document.getElementById('peace-printable-report');
            if (!el) return;
            const printContent = el.innerHTML;
            const printWindow = window.open('', '_blank', 'width=1100,height=800');
            printWindow.document.write('<!DOCTYPE html><html><head><title>MONTHLY PEACE & ORDER & BARANGAY TANOD ACCOMPLISHMENT REPORT</title><link href="https://fonts.googleapis.com/css2?family=Times+New+Roman&display=swap" rel="stylesheet"><style>@page{size:landscape;margin:10mm;}body{font-family:\'Times New Roman\',serif;margin:0;padding:15px;color:#000;background:#fff;}input{border:none!important;background:transparent!important;font-family:inherit!important;font-size:inherit!important;font-weight:inherit!important;text-align:center!important;}table{width:100%;border-collapse:collapse;font-size:10px;}th,td{border:1px solid #000;padding:4px 2px;}</style></head><body>' + printContent + '</body></html>');
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => { printWindow.print(); printWindow.close(); }, 400);
        }
    </script>
</x-app-layout>
