<x-guest-layout>
    <style>
        .auth-card-head::after {
            content: 'Sign in to your account';
            display: none;
        }

        .flbl {
            font-size: 11.5px;
            font-weight: 800;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: .05em;
            display: block;
            margin-bottom: 5px;
        }

        .finput {
            width: 100%;
            padding: 10px 14px 10px 38px;
            background: #f8fafc;
            border: 1.5px solid #cbd5e1;
            border-radius: 9px;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            color: #0f172a;
            outline: none;
            transition: all .15s;
        }

        /* Modern Segmented Tabs for Login */
        .reg-tabs {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 12px;
            border: 1.5px solid #cbd5e1;
            margin-bottom: 16px;
            gap: 4px;
        }

        .reg-tab-btn {
            flex: 1;
            padding: 10px 14px;
            border: none;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .2s;
            outline: none !important;
            background: transparent;
            color: #64748b;
        }

        .reg-tab-btn:focus {
            outline: none !important;
        }

        .reg-tab-btn.active {
            background: #0E5393 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            box-shadow: 0 4px 12px rgba(14, 83, 147, 0.25) !important;
        }

        .reg-tab-btn:not(.active):hover {
            color: #0f172a;
            background: rgba(255, 255, 255, 0.7);
        }

        .btn-send-otp {
            background: #0E5393 !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 8px 14px !important;
            font-size: 12px !important;
            font-weight: 800 !important;
            letter-spacing: .02em !important;
            cursor: pointer !important;
            white-space: nowrap !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            transition: all .15s !important;
            box-shadow: 0 2px 6px rgba(14, 83, 147, 0.25) !important;
            flex-shrink: 0 !important;
            outline: none !important;
        }

        .btn-send-otp:hover:not(:disabled) {
            background: #000052 !important;
            transform: translateY(-1px);
        }

        .btn-send-otp:disabled {
            background: #94a3b8 !important;
            cursor: not-allowed !important;
            box-shadow: none !important;
            opacity: 0.8 !important;
        }

        .finput:focus {
            border-color: #0E5393;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(14, 83, 147, .1);
        }

        .finput::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .finput-wrap {
            position: relative;
        }

        .finput-ico {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 12px;
            pointer-events: none;
        }

        .finput-wrap.has-toggle .finput {
            padding-right: 38px;
        }

        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 12px;
            padding: 2px;
        }

        .toggle-pw:hover {
            color: #0E5393;
        }

        .fgrp {
            margin-bottom: 11px;
        }

        .err-msg {
            font-size: 10px;
            font-weight: 700;
            color: #dc2626;
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-login {
            width: 100%;
            padding: 10px 14px;
            background: linear-gradient(135deg, #0E5393 0%, #04192D 100%);
            color: #fff;
            font-family: inherit;
            font-size: 11.5px;
            font-weight: 900;
            letter-spacing: .06em;
            text-transform: uppercase;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            transition: all .18s;
            box-shadow: 0 4px 14px rgba(0, 0, 82, .3);
            margin-top: 0;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 82, .4);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 16px 0;
        }

        .divider span {
            font-size: 9px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .remember-lbl {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }

        .remember-lbl input {
            accent-color: #0E5393;
            width: 14px;
            height: 14px;
        }

        .remember-lbl span {
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
        }

        .forgot-link {
            font-size: 11px;
            font-weight: 700;
            color: #0E5393;
            text-decoration: none;
        }

        .forgot-link:hover {
            color: #04192D;
        }

        .register-row {
            text-align: center;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        .register-row p {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
        }

        .register-row a {
            color: #0E5393;
            font-weight: 800;
            text-decoration: none;
        }

        .register-row a:hover {
            color: #04192D;
        }

        .status-msg {
            background: #dcfce7;
            border: 1px solid #86efac;
            border-radius: 9px;
            padding: 10px 14px;
            font-size: 11px;
            font-weight: 700;
            color: #15803d;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .btn-back-portal {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
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
            margin-top: 5px;
        }

        .btn-back-portal:hover {
            background: #0E5393;
            border-color: #0E5393;
            color: #fff;
            transform: translateX(-3px);
            box-shadow: 0 6px 15px rgba(14, 83, 147, 0.3);
        }

        .login-btn-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 12px;
            width: 100%;
        }

        .login-btn-actions .btn-login {
            margin-top: 0;
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            padding: 12px 16px;
        }

        .login-btn-actions .btn-back-portal {
            margin-top: 0;
            white-space: nowrap;
            padding: 11px 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 480px) {
            .login-btn-actions {
                flex-direction: column;
                gap: 9px;
            }
            .login-btn-actions .btn-login,
            .login-btn-actions .btn-back-portal {
                width: 100%;
                text-align: center;
                justify-content: center;
                box-sizing: border-box;
            }
        }
    </style>

    <div class="auth-card-head">
        <h2><i class="fas fa-sign-in-alt" style="margin-right:8px;opacity:.8;"></i> Welcome Back</h2>
        <p>Sign in with your Email Address or Mobile Number</p>
    </div>

    <div class="auth-card-body" x-data="{
        tab: 'password',
        otpPhone: '{{ old('contact_number', '') }}',
        otpCode: '',
        otpSending: false,
        otpCooldown: 0,
        otpSent: false,
        mockCode: '',
        otpError: '',
        otpSuccess: '',
        sendOtp() {
            this.otpError = '';
            this.otpSuccess = '';
            let phone = this.otpPhone.trim();
            if (!phone) {
                this.otpError = 'Mangyaring ilagay ang inyong 11-digit mobile number.';
                return;
            }
            if (!/^09\d{9}$/.test(phone)) {
                this.otpError = 'Format: 09XXXXXXXXX (11 digits nagsisimula sa 09).';
                return;
            }

            this.otpSending = true;
            fetch('{{ route('auth.send-otp') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ recipient: phone, purpose: 'login' })
            })
            .then(res => res.json())
            .then(data => {
                this.otpSending = false;
                if (data.success) {
                    this.otpSent = true;
                    this.otpSuccess = data.message || 'Naipadala ang verification code!';
                    if (data.mock && data.code) {
                        this.mockCode = data.code;
                        this.otpCode = data.code; // auto-populate for convenient testing
                    }
                    this.otpCooldown = 60;
                    let timer = setInterval(() => {
                        this.otpCooldown--;
                        if (this.otpCooldown <= 0) clearInterval(timer);
                    }, 1000);
                } else {
                    this.otpError = data.message || 'Hindi maipadala ang OTP. Pakisubukang muli.';
                }
            })
            .catch(() => {
                this.otpSending = false;
                this.otpError = 'Nagkaroon ng problema sa network. Pakisubukang muli.';
            });
        }
    }">
        {{-- Session Flash Messages --}}
        @if(session('status') || session('success'))
            <div class="status-msg">
                <i class="fas fa-check-circle"></i> {{ session('status') ?? session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="err-msg"
                style="background:#fee2e2; border:1px solid #fecaca; padding:10px 14px; border-radius:9px; margin-bottom:14px; color:#991b1b;">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if(session('mock_otp'))
            <div style="background:#eff6ff; border:1.5px dashed #3b82f6; border-radius:9px; padding:10px 14px; margin-bottom:14px; color:#1d4ed8; font-size:12px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                    <strong style="display:flex; align-items:center; gap:6px;"><i class="fas fa-vial"></i> Test Mode Mock OTP:</strong>
                    <span style="font-size:10px; background:#dbeafe; padding:1px 6px; border-radius:4px; font-weight:800;">5 MINS VALID</span>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <span style="font-size:17px; font-weight:900; letter-spacing:2px; color:#1e40af; background:#fff; padding:3px 10px; border-radius:6px; border:1px solid #bfdbfe;">
                        {{ session('mock_otp') }}
                    </span>
                    <span style="font-size:11px; color:#60a5fa;">({{ session('mock_recipient') }})</span>
                </div>
            </div>
        @endif

        {{-- Login Method Navigation Tabs --}}
        <div class="reg-tabs">
            <button type="button" @click="tab = 'password'" class="reg-tab-btn" :class="{ 'active': tab === 'password' }">
                <i class="fas fa-key"></i> <span>Password</span>
            </button>
            <button type="button" @click="tab = 'otp'" class="reg-tab-btn" :class="{ 'active': tab === 'otp' }">
                <i class="fas fa-mobile-alt"></i> <span>Mobile OTP</span>
            </button>
        </div>

        {{-- TAB 1: STANDARD PASSWORD LOGIN (Email OR Phone + Password) --}}
        <form method="POST" action="{{ route('login') }}" x-show="tab === 'password'">
            @csrf

            <div class="fgrp">
                <label class="flbl" for="email"><i class="fas fa-id-badge" style="margin-right:4px;"></i> Email Address or Mobile Number</label>
                <div class="finput-wrap">
                    <i class="fas fa-user finput-ico"></i>
                    <input id="email" type="text" name="email" value="{{ old('email') }}" class="finput"
                        placeholder="username@gmail.com or 09XXXXXXXXX" required autofocus autocomplete="username">
                </div>
                @error('email')<div class="err-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="fgrp" x-data="{ show: false }">
                <label class="flbl" for="password"><i class="fas fa-lock" style="margin-right:4px;"></i> Password</label>
                <div class="finput-wrap has-toggle">
                    <i class="fas fa-shield-alt finput-ico"></i>
                    <input id="password" :type="show ? 'text' : 'password'" name="password" class="finput"
                        placeholder="Enter your password" required autocomplete="current-password">
                    <button type="button" class="toggle-pw" @click="show=!show">
                        <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                    </button>
                </div>
                @error('password')<div class="err-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-row">
                <label class="remember-lbl">
                    <input type="checkbox" name="remember" id="remember_me">
                    <span>Remember me</span>
                </label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            <div class="login-btn-actions">
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt" style="margin-right:7px;"></i> Log In
                </button>
                <a href="{{ route('resident.index') }}" class="btn-back-portal">
                    <i class="fas fa-arrow-left"></i> Back to Portal
                </a>
            </div>

            <div class="register-row" style="border-top:none; margin-top:12px; padding-top:0;">
                <p style="font-size:12px;">Don't have an account yet? <a href="{{ route('register') }}">Create one here</a></p>
            </div>
        </form>

        {{-- TAB 2: PASSWORDLESS MOBILE NUMBER + OTP LOGIN --}}
        <form method="POST" action="{{ route('login.otp') }}" x-show="tab === 'otp'" x-cloak>
            @csrf

            {{-- Mock OTP Banner for OTP Login --}}
            <template x-if="mockCode">
                <div style="background:#eff6ff; border:1.5px dashed #3b82f6; border-radius:10px; padding:12px 14px; margin-bottom:14px; color:#1d4ed8; font-size:12.5px;">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;">
                        <strong style="display:flex; align-items:center; gap:6px;"><i class="fas fa-vial"></i> Test Mode Mock OTP:</strong>
                        <span style="font-size:10px; background:#dbeafe; padding:2px 7px; border-radius:4px; font-weight:800;">AUTO-FILLED</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size:18px; font-weight:900; letter-spacing:2px; color:#1e40af; background:#fff; padding:4px 12px; border-radius:7px; border:1px solid #bfdbfe;" x-text="mockCode"></span>
                        <span style="font-size:11.5px; color:#3b82f6; font-weight:600;">Gamitin ang code na ito para mag-sign in.</span>
                    </div>
                </div>
            </template>

            <template x-if="otpError">
                <div class="err-msg" style="background:#fee2e2; border:1px solid #fecaca; padding:10px 14px; border-radius:9px; margin-bottom:12px; color:#991b1b; font-size:11.5px;">
                    <i class="fas fa-exclamation-circle"></i> <span x-text="otpError"></span>
                </div>
            </template>

            <template x-if="otpSuccess">
                <div class="status-msg" style="margin-bottom:12px; padding:10px 14px; font-size:11.5px; border-radius:9px;">
                    <i class="fas fa-check-circle"></i> <span x-text="otpSuccess"></span>
                </div>
            </template>

            <div class="fgrp">
                <label class="flbl" for="otp_contact_number"><i class="fas fa-mobile-alt" style="margin-right:4px;"></i> Registered Mobile Number</label>
                <div class="finput-wrap" style="padding-right: 6px; display:flex; align-items:center; background:#f8fafc; border:1.5px solid #cbd5e1; border-radius:9px;">
                    <i class="fas fa-phone finput-ico" style="position:static; transform:none; color:#0E5393; font-size:13px; margin:0 8px 0 12px; pointer-events:none;"></i>
                    <input id="otp_contact_number" type="tel" name="contact_number" x-model="otpPhone" class="finput"
                        maxlength="11" placeholder="09XXXXXXXXX" required autocomplete="tel"
                        style="border:none; background:transparent; padding:10px 0; font-size:14.5px; font-weight:700; flex:1;">
                    <button type="button" class="btn-send-otp" @click="sendOtp()" :disabled="otpSending || otpCooldown > 0">
                        <span x-show="!otpSending && otpCooldown === 0"><i class="fas fa-paper-plane"></i> Send OTP</span>
                        <span x-show="otpSending"><i class="fas fa-spinner fa-spin"></i> Sending...</span>
                        <span x-show="otpCooldown > 0" x-text="`Wait ${otpCooldown}s`"></span>
                    </button>
                </div>
                <div style="font-size:11px; color:#64748b; margin-top:5px; font-weight:600;">
                    Ilagay ang iyong 11-digit mobile number na nakarehistro sa account.
                </div>
            </div>

            <div class="fgrp">
                <label class="flbl" for="otp_code"><i class="fas fa-shield-alt" style="margin-right:4px;"></i> 6-Digit One-Time PIN (OTP)</label>
                <div class="finput-wrap">
                    <i class="fas fa-unlock-alt finput-ico" style="color:#0E5393;"></i>
                    <input id="otp_code" type="text" name="otp_code" x-model="otpCode" class="finput"
                        maxlength="6" placeholder="000000" required autocomplete="one-time-code"
                        style="letter-spacing:6px; font-size:16px; font-weight:900; color:#0f172a;">
                </div>
            </div>

            <div class="remember-row">
                <label class="remember-lbl">
                    <input type="checkbox" name="remember" value="1">
                    <span>Remember this device</span>
                </label>
            </div>

            <div class="login-btn-actions">
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt" style="margin-right:7px;"></i> Sign In with OTP
                </button>
                <a href="{{ route('resident.index') }}" class="btn-back-portal">
                    <i class="fas fa-arrow-left"></i> Back to Portal
                </a>
            </div>

            <div class="register-row" style="border-top:none; margin-top:12px; padding-top:0;">
                <p style="font-size:12px;">Don't have an account yet? <a href="{{ route('register') }}">Create one here</a></p>
            </div>
        </form>
    </div>
</x-guest-layout>