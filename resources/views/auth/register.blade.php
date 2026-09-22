<x-guest-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .auth-wrap {
            max-width: 580px !important;
        }

        .rp-outer {
            margin: 0;
            border-radius: 20px;
            overflow: hidden;
        }

        .rp-head {
            background: linear-gradient(135deg, #000052 0%, #0E5393 100%);
            padding: 22px 24px 20px;
        }

        .rp-head h2 {
            font-size: 15px;
            font-weight: 900;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: .06em;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }

        .rp-head p {
            font-size: 10px;
            color: rgba(255, 255, 255, .6);
            font-weight: 600;
        }

        .rp-body {
            background: #fff;
            padding: 24px;
        }

        .flbl {
            font-size: 9px;
            font-weight: 900;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .08em;
            display: block;
            margin-bottom: 6px;
        }

        .fwrap {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0 13px;
            transition: border-color .15s, box-shadow .15s, background .15s;
        }

        .fwrap:focus-within {
            border-color: #0E5393;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(14, 83, 147, .1);
        }

        .ficon {
            color: #94a3b8;
            font-size: 12px;
            flex-shrink: 0;
            margin-right: 9px;
        }

        .finput {
            flex: 1;
            border: none;
            background: transparent;
            padding: 12px 0;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            outline: none;
            min-width: 0;
            width: 100%;
        }

        .finput::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .ferr {
            font-size: 10px;
            font-weight: 700;
            color: #dc2626;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .fgrid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .fgrid-bday-row {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 10px;
        }

        @media (max-width: 540px) {
            .rp-outer {
                border-radius: 16px;
            }
            .rp-head {
                padding: 18px 18px 16px !important;
            }
            .rp-body {
                padding: 18px 16px !important;
            }
            .fgrid2 {
                grid-template-columns: 1fr !important;
                gap: 12px !important;
            }
            .fgrid-bday-row {
                grid-template-columns: 2fr 1fr !important;
                gap: 10px !important;
            }
            .fgrid-action-btns {
                flex-direction: column-reverse !important;
                gap: 8px !important;
            }
            .fgrid-action-btns .btn-back-portal,
            .fgrid-action-btns .btn-prev,
            .fgrid-action-btns .btn-sub {
                width: 100% !important;
                text-align: center;
                justify-content: center;
            }
        }

        .btn-sub {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #0E5393 0%, #000052 100%);
            color: #fff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .06em;
            text-transform: uppercase;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all .18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(0, 0, 82, .3);
            margin-top: 6px;
            margin-bottom: 14px;
        }

        .btn-sub:hover {
            background: linear-gradient(135deg, #0a3f72 0%, #020f1c 100%);
            box-shadow: 0 6px 20px rgba(0, 0, 82, .4);
            transform: translateY(-1px);
        }

        .btn-prev {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            background: #f1f5f9;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            color: #475569;
            font-family: inherit;
            font-size: 11.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            cursor: pointer;
            transition: all .18s;
            text-decoration: none;
        }

        .btn-prev:hover {
            background: #e2e8f0;
            color: #0f172a;
            transform: translateX(-2px);
        }

        .login-link {
            text-align: center;
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
        }

        .login-link a {
            color: #0E5393;
            font-weight: 800;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .section-divider {
            font-size: 9px;
            font-weight: 900;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin: 14px 0 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        /* Terms & Conditions */
        .tnc-wrap {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .tnc-wrap input[type="checkbox"] {
            accent-color: #0E5393;
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 2px;
            cursor: pointer;
        }

        .tnc-label {
            font-size: 10px;
            color: #475569;
            font-weight: 600;
            line-height: 1.6;
        }

        .tnc-label a {
            color: #0E5393;
            font-weight: 800;
            text-decoration: underline;
            cursor: pointer;
        }

        /* T&C Modal */
        .tnc-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .55);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .tnc-modal {
            background: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 520px;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 60px rgba(0, 0, 82, .25);
            overflow: hidden;
        }

        .tnc-modal-head {
            background: linear-gradient(135deg, #000052 0%, #0E5393 100%);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tnc-modal-head h3 {
            color: #fff;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .05em;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tnc-modal-close {
            background: rgba(255, 255, 255, .15);
            border: none;
            color: #fff;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .15s;
        }

        .tnc-modal-close:hover {
            background: rgba(255, 255, 255, .3);
        }

        .tnc-modal-body {
            padding: 20px;
            overflow-y: auto;
            flex: 1;
        }

        .tnc-modal-body h4 {
            font-size: 11px;
            font-weight: 900;
            color: #000052;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin: 14px 0 5px;
        }

        .tnc-modal-body h4:first-child {
            margin-top: 0;
        }

        .tnc-modal-body p {
            font-size: 11px;
            color: #475569;
            font-weight: 500;
            line-height: 1.7;
        }

        .tnc-modal-body ul {
            margin: 6px 0 0 16px;
            padding: 0;
        }

        .tnc-modal-body ul li {
            font-size: 11px;
            color: #475569;
            font-weight: 500;
            line-height: 1.7;
            list-style: disc;
        }

        .tnc-modal-footer {
            padding: 14px 20px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: flex-end;
        }

        .tnc-agree-btn {
            background: linear-gradient(135deg, #0E5393 0%, #000052 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 22px;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .05em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all .18s;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .tnc-agree-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0, 0, 82, .3);
        }

        .btn-back-portal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 18px;
            background: rgba(14, 83, 147, 0.08);
            border: 1.5px solid rgba(14, 83, 147, 0.2);
            border-radius: 10px;
            color: #0E5393;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            transition: all .2s;
        }

        .btn-back-portal:hover {
            background: #0E5393;
            border-color: #0E5393;
            color: #fff;
            transform: translateX(-2px);
            box-shadow: 0 6px 15px rgba(14, 83, 147, 0.3);
        }

        /* Notification Banner */
        .notif-banner {
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: slideDown .35s ease;
            position: relative;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notif-banner.notif-error {
            background: #fef2f2;
            border: 1.5px solid #fca5a5;
        }

        .notif-banner.notif-success {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
        }

        .notif-icon {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .notif-error .notif-icon {
            color: #dc2626;
        }

        .notif-success .notif-icon {
            color: #16a34a;
        }

        .notif-content {
            flex: 1;
        }

        .notif-title {
            font-size: 11px;
            font-weight: 900;
            margin-bottom: 3px;
            letter-spacing: .03em;
        }

        .notif-error .notif-title {
            color: #b91c1c;
        }

        .notif-success .notif-title {
            color: #15803d;
        }

        .notif-msg {
            font-size: 10px;
            font-weight: 600;
            line-height: 1.6;
        }

        .notif-error .notif-msg {
            color: #dc2626;
        }

        .notif-success .notif-msg {
            color: #16a34a;
        }

        .notif-close {
            background: none;
            border: none;
            font-size: 11px;
            cursor: pointer;
            flex-shrink: 0;
            padding: 2px;
            line-height: 1;
            opacity: .6;
            transition: opacity .15s;
        }

        .notif-error .notif-close {
            color: #b91c1c;
        }

        .notif-success .notif-close {
            color: #15803d;
        }

        .notif-close:hover {
            opacity: 1;
        }

        .notif-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            border-radius: 0 0 0 12px;
            animation: shrink 6s linear forwards;
        }

        .notif-error .notif-progress {
            background: #dc2626;
        }

        .notif-success .notif-progress {
            background: #16a34a;
        }

        @keyframes shrink {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .combined-id-box {
            display: flex;
            align-items: stretch;
            padding: 0;
            overflow: hidden;
            min-height: 48px;
        }

        .id-select-wrap {
            position: relative;
            width: 46%;
            min-width: 145px;
            background: #f8fafc;
            border-right: 1.5px solid #e2e8f0;
            display: flex;
            align-items: center;
        }

        @media (max-width: 480px) {
            .combined-id-box {
                flex-direction: column;
            }
            .id-select-wrap {
                width: 100% !important;
                border-right: none !important;
                border-bottom: 1.5px solid #e2e8f0;
            }
        }
    </style>

    <div class="rp-outer" x-data="{
        step: {{ ($errors->has('email') || $errors->has('password') || $errors->has('password_confirmation')) ? 2 : 1 }},
        firstName: '{{ addslashes(old('first_name', '')) }}',
        lastName: '{{ addslashes(old('last_name', '')) }}',
        middleName: '{{ addslashes(old('middle_name', '')) }}',
        birthday: '{{ old('birthday', '') }}',
        age: '{{ old('age', '') }}',
        isVoter: '{{ old('is_voter', '') }}',
        precinctNo: '{{ addslashes(old('precinct_no', '0')) }}',
        idType: '{{ old('id_type', 'National ID (PhilSys)') }}',
        fileName: '',
        filePreview: null,
        isDragging: false,
        agreed: false,
        showTnc: false,
        step1Errors: {},
        serverError: '{{ addslashes(session('error', '')) }}',
        isVerifying: false,
        formatPrecinct(val) {
            if (!val || val === '') return '0';
            let str = String(val).toUpperCase().replace(/[^0-9A-Z]/g, '');
            if (!str.startsWith('0')) {
                str = '0' + str.replace(/^0*/, '');
            }
            let digits = '';
            let suffix = '';
            for (let i = 0; i < str.length; i++) {
                const ch = str[i];
                if (/[0-9]/.test(ch)) {
                    if (digits.length < 4 && suffix.length === 0) {
                        digits += ch;
                    }
                } else if (/[A-Z]/.test(ch)) {
                    if (suffix.length < 1) {
                        suffix += ch;
                    }
                }
            }
            let res = (digits || '0') + suffix;
            return res.substring(0, 5);
        },
        triggerUpload() {
            const input = document.getElementById('voter_id_photo') || (this.$refs && this.$refs.voterInput);
            if (input) {
                input.click();
            }
        },
        handleFileSelect(e) {
            const file = e.target.files && e.target.files[0];
            if (file) {
                this.fileName = file.name;
                if (file.type && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        this.filePreview = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    this.filePreview = null;
                }
            } else {
                this.fileName = '';
                this.filePreview = null;
            }
        },
        calculateAge() {
            if(!this.birthday) {
                this.age = '';
                return;
            }
            const bd = new Date(this.birthday);
            if(isNaN(bd.getTime())) {
                this.age = '';
                return;
            }
            const t = new Date();
            let a = t.getFullYear() - bd.getFullYear();
            const m = t.getMonth() - bd.getMonth();
            if(m < 0 || (m === 0 && t.getDate() < bd.getDate())) a--;
            this.age = a;
        },
        goToStep2() {
            this.step1Errors = {};
            this.serverError = '';

            if (!this.firstName.trim()) this.step1Errors.firstName = 'First Name is required.';
            if (!this.lastName.trim()) this.step1Errors.lastName = 'Last Name is required.';
            if (!this.birthday) this.step1Errors.birthday = 'Birthday is required.';
            if (!this.isVoter) this.step1Errors.isVoter = 'Please indicate voter status.';
            if (this.isVoter == '1') {
                if (!this.fileName && (!this.$refs.voterInput || !this.$refs.voterInput.files.length)) {
                    this.step1Errors.file = 'Please upload a photo of your Valid ID / Voter\'s Proof.';
                }
            } else {
                delete this.step1Errors.file;
            }
            if (!this.agreed) {
                this.step1Errors.agreed = 'Please check the box to agree to the Terms & Privacy Policy.';
            }

            if (Object.keys(this.step1Errors).length > 0) {
                return;
            }

            // Advance directly to Step 2 (Office admin will verify upon registration)
            this.step = 2;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }" x-init="calculateAge()">
        <div class="rp-head">
            <h2><i class="fas fa-user-plus"></i> Create Account</h2>
            <p>Register to access Barangay SM2 services</p>
        </div>

        <div class="rp-body">

            {{-- ✦ Error Notification (Triggered when not found in masterlist) --}}
            <div class="notif-banner notif-error" x-show="serverError" x-cloak>
                <i class="fas fa-user-slash notif-icon"></i>
                <div class="notif-content">
                    <div class="notif-title"><i class="fas fa-exclamation-triangle"></i> &nbsp;Not Found in Masterlist</div>
                    <div class="notif-msg" x-text="serverError"></div>
                </div>
                <button class="notif-close" @click="serverError = ''" type="button" title="Dismiss">
                    <i class="fas fa-times"></i>
                </button>
                <div class="notif-progress"></div>
            </div>

            {{-- ✦ Success Notification --}}
            @if(session('success'))
                <div class="notif-banner notif-success" x-data="{ show: true }" x-show="show"
                    x-init="setTimeout(() => show = false, 5000)">
                    <i class="fas fa-check-circle notif-icon"></i>
                    <div class="notif-content">
                        <div class="notif-title">Success!</div>
                        <div class="notif-msg">{{ session('success') }}</div>
                    </div>
                    <button class="notif-close" @click="show = false" type="button" title="Dismiss">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="notif-progress"></div>
                </div>
            @endif

            {{-- ✦ Validation Errors Banner --}}
            @if($errors->any())
                <div class="notif-banner notif-error" x-data="{ show: true }" x-show="show">
                    <i class="fas fa-exclamation-triangle notif-icon"></i>
                    <div class="notif-content">
                        <div class="notif-title">Registration Incomplete / Please Review:</div>
                        <div class="notif-msg">
                            <ul style="margin: 4px 0 0 16px; padding: 0;">
                                @foreach ($errors->all() as $error)
                                    <li style="margin-bottom: 2px;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button class="notif-close" @click="show = false" type="button" title="Dismiss">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="notif-progress"></div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                {{-- ══════════════════════════════════════════════════════════════ --}}
                {{-- ✦ STEP 1: RESIDENTIAL & VOTER VERIFICATION ✦ --}}
                {{-- ══════════════════════════════════════════════════════════════ --}}
                <div x-show="step === 1" x-transition>

                    {{-- Resident Only Notice (Retained) --}}
                    <div style="background:#eff6ff;border:1px solid #bfdbfe;padding:12px 14px;border-radius:10px;margin-bottom:16px;display:flex;gap:10px;align-items:flex-start;">
                        <i class="fas fa-info-circle" style="color:#0E5393;margin-top:2px;font-size:13px;"></i>
                        <p style="font-size:10px;color:#0E5393;font-weight:700;line-height:1.5;margin:0;">
                            Registration is strictly for <strong>legitimate residents</strong> of Brgy. San Miguel II.
                            Non-residents should use the <strong>Guest Request</strong> feature on the home page.
                        </p>
                    </div>

                    {{-- Personal Info Section --}}
                    <div class="section-divider">1. Personal Information</div>

                    {{-- First + Last Name row --}}
                    <div class="fgrid2" style="margin-bottom:10px;">
                        <div>
                            <label class="flbl" for="first_name">First Name *</label>
                            <div class="fwrap" :style="step1Errors.firstName ? 'border-color:#ef4444;background:#fef2f2;' : ''">
                                <i class="fas fa-user ficon"></i>
                                <input id="first_name" type="text" name="first_name" class="finput" placeholder="Juan"
                                    x-model="firstName" autofocus autocomplete="given-name">
                            </div>
                            <template x-if="step1Errors.firstName">
                                <div class="ferr"><i class="fas fa-exclamation-circle"></i> <span x-text="step1Errors.firstName"></span></div>
                            </template>
                            @error('first_name')
                                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="flbl" for="last_name">Last Name *</label>
                            <div class="fwrap" :style="step1Errors.lastName ? 'border-color:#ef4444;background:#fef2f2;' : ''">
                                <i class="fas fa-user ficon"></i>
                                <input id="last_name" type="text" name="last_name" class="finput" placeholder="Dela Cruz"
                                    x-model="lastName" autocomplete="family-name">
                            </div>
                            <template x-if="step1Errors.lastName">
                                <div class="ferr"><i class="fas fa-exclamation-circle"></i> <span x-text="step1Errors.lastName"></span></div>
                            </template>
                            @error('last_name')
                                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Middle Name + Birthday + Age --}}
                    <div class="fgrid2" style="margin-bottom:14px;">
                        <div>
                            <label class="flbl" for="middle_name">Middle Name <span style="font-weight:600;text-transform:none;">(optional)</span></label>
                            <div class="fwrap">
                                <i class="fas fa-user ficon"></i>
                                <input id="middle_name" type="text" name="middle_name" class="finput"
                                    placeholder="Optional" x-model="middleName" autocomplete="additional-name">
                            </div>
                        </div>
                        <div class="fgrid-bday-row" style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 10px;">
                            <div style="min-width: 0;">
                                <label class="flbl" for="birthday">Birthday *</label>
                                <div class="fwrap" :style="step1Errors.birthday ? 'border-color:#ef4444;background:#fef2f2;' : ''">
                                    <input id="birthday" type="date" name="birthday" class="finput" x-model="birthday"
                                        @input="calculateAge()" @change="calculateAge()"
                                        max="{{ date('Y-m-d', strtotime('-15 years')) }}"
                                        style="min-width:0; padding-right:4px;">
                                </div>
                                <template x-if="step1Errors.birthday">
                                    <div class="ferr"><i class="fas fa-exclamation-circle"></i> <span x-text="step1Errors.birthday"></span></div>
                                </template>
                                @error('birthday')
                                    <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div style="min-width: 0;">
                                <label class="flbl">Age</label>
                                <div class="fwrap" style="padding: 0 10px;">
                                    <input type="number" name="age" x-model="age" readonly class="finput"
                                        style="background:#f1f5f9;cursor:not-allowed;min-width:0;text-align:center;"
                                        placeholder="—">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Voter Status Section --}}
                    <div class="section-divider">2. Voter &amp; Residency Verification</div>

                    <div style="margin-bottom:12px;">
                        <label class="flbl">Are you a registered voter in this Barangay? *</label>
                        <div class="fwrap" style="padding:12px 13px;gap:20px;">
                            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-family:inherit;font-size:13px;font-weight:600;color:#334155;">
                                <input type="radio" name="is_voter" value="1" x-model="isVoter" @change="isVoter = '1';"
                                    style="accent-color:#0E5393;width:15px;height:15px;"> Yes, I am
                            </label>
                            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-family:inherit;font-size:13px;font-weight:600;color:#334155;">
                                <input type="radio" name="is_voter" value="0" x-model="isVoter" @change="isVoter = '0'; fileName = ''; filePreview = null; delete step1Errors.file;"
                                    style="accent-color:#0E5393;width:15px;height:15px;"> No, I am not
                            </label>
                        </div>
                        @error('is_voter')
                            <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Hidden real file input --}}
                    <input id="voter_id_photo" type="file" name="voter_id_photo" x-ref="voterInput"
                        accept="image/jpeg,image/png,image/webp,application/pdf"
                        @change="handleFileSelect($event)"
                        style="display:none;">

                    {{-- Registered Voter Fields (Shows ONLY when Yes, I am is selected) --}}
                    <div x-show="isVoter == '1'" x-cloak style="margin-bottom:14px;">
                        <div style="margin-bottom:6px;">
                            <label class="flbl" for="id_type">Valid ID / Proof of Voter Registration *</label>
                            <div class="fwrap" :style="step1Errors.file ? 'border-color:#ef4444;background:#fef2f2;' : ''">
                                <i class="fas fa-id-card ficon" style="color:#0E5393;"></i>
                                <select id="id_type" name="id_type" class="finput" x-model="idType" @change="triggerUpload()" style="cursor:pointer; appearance:none;">
                                    <option value="National ID (PhilSys)">National ID (PhilSys)</option>
                                    <option value="TIN ID (BIR)">TIN ID (BIR)</option>
                                    <option value="Voter's ID / Certificate">Voter's ID / Certificate</option>
                                    <option value="Driver's License">Driver's License</option>
                                    <option value="Philippine Passport">Philippine Passport</option>
                                    <option value="UMID / SSS ID">UMID / SSS ID</option>
                                    <option value="PhilHealth ID">PhilHealth ID</option>
                                    <option value="Postal ID">Postal ID</option>
                                    <option value="PRC ID">PRC ID</option>
                                    <option value="Student / School ID">Student / School ID</option>
                                    <option value="Company / Employee ID">Company / Employee ID</option>
                                    <option value="Senior Citizen / PWD ID">Senior Citizen / PWD ID</option>
                                    <option value="Barangay Certificate / Proof">Barangay Certificate / Proof</option>
                                    <option value="Other Valid ID">Other Valid ID</option>
                                </select>
                                <i class="fas fa-chevron-down" style="color:#94a3b8; font-size:10px; margin-left:6px; pointer-events:none;"></i>
                            </div>

                                {{-- Inline Photo Status directly under ID selector --}}
                                <div x-show="fileName" style="margin-top:5px; font-size:10px; font-weight:700; color:#16a34a; display:flex; align-items:center; gap:4px; flex-wrap:wrap;">
                                    <i class="fas fa-check-circle"></i>
                                    <span>✓ <span x-text="fileName"></span> attached</span>
                                    <a href="javascript:void(0)" @click.prevent="triggerUpload()" style="color:#0E5393; text-decoration:underline; font-weight:800; cursor:pointer; margin-left:3px;">(Change Photo)</a>
                                </div>

                                <div x-show="!fileName" style="margin-top:5px; font-size:9px; font-weight:600; color:#64748b;">
                                    Selecting an ID opens photo picker. <a href="javascript:void(0)" @click.prevent="triggerUpload()" style="color:#0E5393; text-decoration:underline; font-weight:800; cursor:pointer;">(Choose Photo)</a>
                                </div>

                                <template x-if="step1Errors.file">
                                    <div class="ferr"><i class="fas fa-exclamation-circle"></i> <span x-text="step1Errors.file"></span></div>
                                </template>
                                @error('voter_id_photo')
                                    <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    {{-- Terms & Conditions Checkbox --}}
                    <div>
                        <div class="tnc-wrap" :style="step1Errors.agreed ? 'border-color:#ef4444;background:#fef2f2;' : ''">
                            <input type="checkbox" id="agree_tnc" x-model="agreed">
                            <label for="agree_tnc" class="tnc-label">
                                I have read and agree to the
                                <a @click.prevent="showTnc = true">Terms and Conditions</a>
                                and <a @click.prevent="showTnc = true">Privacy Policy</a>
                                of Barangay San Miguel II. I certify that all information I provided is true and accurate.
                            </label>
                        </div>
                        <template x-if="step1Errors.agreed">
                            <div class="ferr" style="margin-bottom:10px;"><i class="fas fa-exclamation-circle"></i> <span x-text="step1Errors.agreed"></span></div>
                        </template>

                        {{-- T&C Modal --}}
                        <div class="tnc-modal-backdrop" x-show="showTnc" x-cloak
                            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @click.self="showTnc = false">
                            <div class="tnc-modal" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100">
                                <div class="tnc-modal-head">
                                    <h3><i class="fas fa-file-contract"></i> Terms &amp; Conditions</h3>
                                    <button class="tnc-modal-close" @click="showTnc = false" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="tnc-modal-body">
                                    <h4><i class="fas fa-info-circle" style="color:#0E5393;"></i> 1. Purpose</h4>
                                    <p>This registration is exclusively for legitimate residents of <strong>Barangay San
                                            Miguel II</strong>. By registering, you acknowledge that this system is intended
                                         for barangay services, document requests, and community engagement purposes only.
                                    </p>

                                    <h4><i class="fas fa-user-shield" style="color:#0E5393;"></i> 2. Eligibility</h4>
                                    <ul>
                                        <li>You must be a current resident of Barangay San Miguel II.</li>
                                        <li>You must be at least 15 years of age to register.</li>
                                        <li>Non-residents should use the <strong>Guest Request</strong> feature instead.</li>
                                    </ul>

                                    <h4><i class="fas fa-lock" style="color:#0E5393;"></i> 3. Privacy &amp; Data Protection</h4>
                                    <p>Your personal information is collected in compliance with the <strong>Data Privacy
                                            Act of 2012 (R.A. 10173)</strong>. Your data will be used solely for barangay
                                        administrative purposes and will not be shared with unauthorized third parties.</p>

                                    <h4><i class="fas fa-check-circle" style="color:#0E5393;"></i> 4. Accuracy of Information</h4>
                                    <p>You certify that all information you provide during registration is <strong>true,
                                            accurate, and complete</strong>. Providing false information may result in the
                                        suspension or cancellation of your account.</p>

                                    <h4><i class="fas fa-key" style="color:#0E5393;"></i> 5. Account Responsibility</h4>
                                    <ul>
                                        <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                                        <li>Do not share your password with anyone.</li>
                                        <li>Report any unauthorized access immediately to the barangay office.</li>
                                    </ul>

                                    <h4><i class="fas fa-ban" style="color:#0E5393;"></i> 6. Prohibited Activities</h4>
                                    <p>The following are strictly prohibited:</p>
                                    <ul>
                                        <li>Registering on behalf of another person without authorization.</li>
                                        <li>Using the system for fraudulent, illegal, or malicious activities.</li>
                                        <li>Uploading false or fabricated identification documents.</li>
                                    </ul>

                                    <h4><i class="fas fa-gavel" style="color:#0E5393;"></i> 7. Acceptance</h4>
                                    <p>By clicking <strong>"I Agree & Continue"</strong>, you confirm that you have read,
                                        understood, and agree to be bound by these Terms and Conditions and our Privacy Policy.</p>

                                    <p style="margin-top:12px;font-size:10px;color:#94a3b8;">Last updated: April 2026
                                        &mdash; Barangay San Miguel II Administration</p>
                                </div>
                                <div class="tnc-modal-footer">
                                    <button class="tnc-agree-btn" type="button" @click="agreed = true; showTnc = false">
                                        <i class="fas fa-check"></i> I Agree &amp; Continue
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 1 Action Buttons --}}
                    <div class="fgrid-action-btns" style="display:flex; align-items:center; gap:10px; margin-top:16px; margin-bottom:14px;">
                        <a href="{{ route('resident.index') }}" class="btn-back-portal" style="white-space:nowrap;">
                            <i class="fas fa-arrow-left"></i> Back to Portal
                        </a>
                        <button type="button" class="btn-sub" @click.prevent="goToStep2()"
                                style="margin-top:0; margin-bottom:0; flex:1; display:flex; align-items:center; justify-content:center; gap:8px;">
                            <span>NEXT STEP</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                </div>

                {{-- ══════════════════════════════════════════════════════════════ --}}
                {{-- ✦ STEP 2: ACCOUNT CREDENTIALS ✦ --}}
                {{-- ══════════════════════════════════════════════════════════════ --}}
                <div x-show="step === 2" x-transition x-cloak>

                    <div class="section-divider">Account Credentials &amp; Security</div>

                    {{-- Email --}}
                    <div style="margin-bottom:12px;">
                        <label class="flbl" for="email">Email Address *</label>
                        <div class="fwrap">
                            <i class="fas fa-envelope ficon"></i>
                            <input id="email" type="email" name="email" class="finput" placeholder="username@gmail.com"
                                value="{{ old('email') }}" :required="step === 2" autocomplete="username">
                        </div>
                        @error('email')
                            <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div style="margin-bottom:12px;" x-data="{
                        show: false,
                        pwd: '',
                        get strength() {
                            let s = 0;
                            if(this.pwd.length >= 8) s++;
                            if(/[A-Z]/.test(this.pwd)) s++;
                            if(/[a-z]/.test(this.pwd)) s++;
                            if(/[0-9]/.test(this.pwd)) s++;
                            if(/[@&*_.\-]/.test(this.pwd)) s++;

                            if(this.pwd.length === 0) return { l: '', c: 'transparent', w: '0%' };
                            if(s <= 2) return { l: 'WEAK', c: '#ef4444', w: '33%' };
                            if(s <= 4) return { l: 'FAIR', c: '#f59e0b', w: '66%' };
                            return { l: 'STRONG', c: '#10b981', w: '100%' };
                        }
                    }">
                        <label class="flbl" for="password"
                            style="display:flex;justify-content:space-between;align-items:center;">
                            <span>Password *</span>
                            <span x-show="pwd.length>0" x-text="strength.l"
                                :style="`color:${strength.c};font-size:8px;padding:2px 6px;border-radius:4px;background:${strength.c}20;`"
                                x-cloak></span>
                        </label>
                        <div class="fwrap"
                            style="position:relative;overflow:hidden;border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:0;border-bottom:none;">
                            <i class="fas fa-lock ficon"></i>
                            <input id="password" :type="show?'text':'password'" name="password" class="finput" x-model="pwd"
                                placeholder="Minimum 8 characters" :required="step === 2" autocomplete="new-password">
                            <button type="button" @click="show=!show"
                                style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:12px;padding:0;flex-shrink:0;">
                                <i class="fas" :class="show?'fa-eye-slash':'fa-eye'"></i>
                            </button>
                            <!-- Progress Bar -->
                            <div style="position:absolute;bottom:0;left:0;right:0;height:3px;background:#e2e8f0;">
                                <div
                                    :style="`width:${strength.w};background:${strength.c};height:100%;transition:all .3s ease;`">
                                </div>
                            </div>
                        </div>
                        <div
                            style="background:#f8fafc;border:1.5px solid #e2e8f0;border-top:none;border-bottom-left-radius:10px;border-bottom-right-radius:10px;padding:8px 12px;">
                            <div style="font-size:9px;color:#64748b;font-weight:700;line-height:1.4;">
                                Tip: Include <span :style="/[A-Z]/.test(pwd) ? 'color:#10b981' : ''">Capital letter</span>,
                                <span :style="/[a-z]/.test(pwd) ? 'color:#10b981' : ''">Small letter</span>,
                                <span :style="/[0-9]/.test(pwd) ? 'color:#10b981' : ''">Number</span>, &
                                <span :style="/[@&*_.\-]/.test(pwd) ? 'color:#10b981' : ''">Symbol (@&*_-)</span>
                            </div>
                        </div>
                        @error('password')
                            <div class="ferr" style="margin-top:6px;"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div style="margin-bottom:14px;" x-data="{ show: false }">
                        <label class="flbl" for="password_confirmation">Confirm Password *</label>
                        <div class="fwrap">
                            <i class="fas fa-lock ficon"></i>
                            <input id="password_confirmation" :type="show?'text':'password'" name="password_confirmation"
                                class="finput" placeholder="Re-enter your password" :required="step === 2" autocomplete="new-password">
                            <button type="button" @click="show=!show"
                                style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:12px;padding:0;flex-shrink:0;">
                                <i class="fas" :class="show?'fa-eye-slash':'fa-eye'"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Step 2 Action Buttons --}}
                    <div class="fgrid-action-btns" style="display:flex; align-items:center; gap:10px; margin-top:16px; margin-bottom:14px;">
                        <button type="button" class="btn-prev" @click.prevent="step = 1">
                            <i class="fas fa-arrow-left"></i> Back
                        </button>
                        <button type="submit" class="btn-sub"
                                style="margin-top:0; margin-bottom:0; flex:1;">
                            <i class="fas fa-user-plus"></i> Create Account
                        </button>
                    </div>

                </div>

            </form>

            <div class="login-link" style="font-size:13px; margin-top:10px;">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>
    </div>

</x-guest-layout>