<x-guest-layout>
<style>
[x-cloak]{display:none!important;}

/* ── Fill + override the white guest wrapper ── */
.fp-outer {
    margin: -8px;
    border-radius: 20px;
    overflow: hidden;
}

/* ── Gradient header ── */
.fp-head {
    background: linear-gradient(135deg, #000052 0%, #0E5393 100%);
    padding: 24px 26px 22px;
}
.fp-head-title {
    font-size: 16px;
    font-weight: 900;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: .06em;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}
.fp-head-sub {
    font-size: 11px;
    color: rgba(255,255,255,.8);
    font-weight: 600;
    line-height: 1.4;
}

/* ── White body ── */
.fp-body {
    background: #fff;
    padding: 22px 24px 24px;
}

/* ── Method Navigation Tabs ── */
.reset-tabs {
    display: flex;
    gap: 8px;
    background: #f1f5f9;
    padding: 5px;
    border-radius: 12px;
    margin-bottom: 18px;
}
.reset-tab-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 10px 12px;
    border-radius: 9px;
    border: none;
    background: transparent;
    color: #64748b;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .04em;
    cursor: pointer;
    transition: all .2s ease;
}
.reset-tab-btn:hover {
    color: #0E5393;
}
.reset-tab-btn.active {
    background: #0E5393;
    color: #fff;
    box-shadow: 0 3px 10px rgba(14, 83, 147, 0.28);
}

/* ── Status Messages ── */
.status-ok {
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    border-radius: 10px;
    padding: 11px 14px;
    font-size: 11.5px;
    font-weight: 700;
    color: #15803d;
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 16px;
    line-height: 1.5;
}
.status-err {
    background: #fee2e2;
    border: 1px solid #fecaca;
    border-radius: 10px;
    padding: 11px 14px;
    font-size: 11.5px;
    font-weight: 700;
    color: #991b1b;
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 16px;
    line-height: 1.5;
}

/* ── Form Fields ── */
.flbl {
    font-size: 11.5px;
    font-weight: 900;
    color: #334155;
    text-transform: uppercase;
    letter-spacing: .05em;
    display: block;
    margin-bottom: 6px;
}
.fwrap {
    display: flex;
    align-items: center;
    background: #f8fafc;
    border: 1.5px solid #cbd5e1;
    border-radius: 10px;
    padding: 0 12px;
    transition: border-color .15s, box-shadow .15s, background .15s;
}
.fwrap:focus-within {
    border-color: #0E5393;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(14,83,147,.12);
}
.ficon {
    color: #0E5393;
    font-size: 13px;
    flex-shrink: 0;
    margin-right: 9px;
}
.finput {
    flex: 1;
    border: none;
    background: transparent;
    padding: 11px 0;
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    outline: none;
}
.finput::placeholder {
    color: #94a3b8;
    font-weight: 500;
    font-size: 13px;
}
.ferr {
    font-size: 11px;
    font-weight: 700;
    color: #dc2626;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* ── Send OTP Inline Button ── */
.btn-send-otp {
    background: #0E5393;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 7px 13px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .04em;
    cursor: pointer;
    flex-shrink: 0;
    transition: all .2s;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-left: 6px;
}
.btn-send-otp:hover:not(:disabled) {
    background: #000052;
    transform: translateY(-1px);
}
.btn-send-otp:disabled {
    background: #94a3b8;
    cursor: not-allowed;
    opacity: .7;
}

/* ── Submit & Actions ── */
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
    box-shadow: 0 4px 14px rgba(0,0,82,.25);
    margin-top: 16px;
    margin-bottom: 12px;
}
.btn-sub:hover {
    background: linear-gradient(135deg, #0a3f72 0%, #020f1c 100%);
    box-shadow: 0 6px 20px rgba(0,0,82,.35);
    transform: translateY(-1px);
}
.back-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    width: 100%;
    padding: 10px;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-family: inherit;
    font-size: 11px;
    font-weight: 800;
    color: #64748b;
    text-decoration: none;
    transition: all .15s;
    cursor: pointer;
}
.back-btn:hover {
    background: #eff6ff;
    border-color: #0E5393;
    color: #0E5393;
}
</style>

@php
    $initIdent = request('identifier', old('contact_number', old('email', '')));
    $isPhoneInitial = !empty($initIdent) && (!str_contains($initIdent, '@') && preg_match('/^[0-9+]/', $initIdent));
    $initialMode = $isPhoneInitial ? 'phone' : 'email';
@endphp

<div class="fp-outer" x-data="{
    mode: '{{ $initialMode }}',
    phone: '{{ $isPhoneInitial ? $initIdent : old('contact_number', '') }}',
    emailVal: '{{ !$isPhoneInitial ? $initIdent : old('email', '') }}',
    otpCode: '{{ old('otp_code', '') }}',
    otpSending: false,
    otpCooldown: 0,
    otpSent: false,
    otpError: '',
    otpSuccess: '',
    mockOtp: '',
    sendOtp() {
        this.otpError = '';
        this.otpSuccess = '';
        let ph = this.phone.trim();
        if (!ph) {
            this.otpError = 'Mangyaring ilagay ang inyong 11-digit mobile number.';
            return;
        }
        if (!/^09\d{9}$/.test(ph)) {
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
            body: JSON.stringify({ recipient: ph, purpose: 'change_password' })
        })
        .then(r => r.json())
        .then(data => {
            this.otpSending = false;
            if (data.success) {
                this.otpSent = true;
                this.otpSuccess = data.message || 'Naipadala ang verification code sa iyong mobile number!';
                if (data.mock && data.code) {
                    this.mockOtp = data.code;
                    this.otpCode = data.code;
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

    {{-- Header --}}
    <div class="fp-head">
        <div class="fp-head-title">
            <i class="fas fa-key"></i> Forgot Password
        </div>
        <div class="fp-head-sub">
            I-reset ang password gamit ang rehistradong Mobile Number (SMS OTP) o Email Address.
        </div>
    </div>

    {{-- Body --}}
    <div class="fp-body">

        {{-- Session Messages --}}
        @if (session('status'))
            <div class="status-ok">
                <i class="fas fa-check-circle" style="flex-shrink:0;margin-top:2px;"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="status-err">
                <i class="fas fa-exclamation-circle" style="flex-shrink:0;margin-top:2px;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Switcher Tabs --}}
        <div class="reset-tabs">
            <button type="button" @click="mode = 'phone'" class="reset-tab-btn" :class="{ 'active': mode === 'phone' }">
                <i class="fas fa-mobile-alt"></i> <span>Via Mobile OTP</span>
            </button>
            <button type="button" @click="mode = 'email'" class="reset-tab-btn" :class="{ 'active': mode === 'email' }">
                <i class="fas fa-envelope"></i> <span>Via Email</span>
            </button>
        </div>

        {{-- ── OPTION A: MOBILE OTP PASSWORD RESET ── --}}
        <div x-show="mode === 'phone'" x-cloak>
            {{-- OTP Verification Banner --}}
            <template x-if="mockOtp">
                <div style="background:#eff6ff; border:1.5px solid #bfdbfe; border-radius:10px; padding:12px 14px; margin-bottom:14px; color:#1d4ed8; font-size:12px;">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:5px;">
                        <strong style="display:flex; align-items:center; gap:6px; color:#0E5393; font-size:12px;">
                            <i class="fas fa-sms" style="font-size:14px;"></i> Inyong OTP Code (Sent via SMS):
                        </strong>
                        <span style="font-size:10px; background:#dbeafe; color:#1e40af; padding:2px 7px; border-radius:5px; font-weight:800;">SMS DELIVERED</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size:18px; font-weight:900; letter-spacing:3px; color:#0E5393; background:#fff; padding:4px 14px; border-radius:7px; border:1px solid #bfdbfe;" x-text="mockOtp"></span>
                        <span style="font-size:11px; color:#3b82f6; font-weight:600;">Inyong One-Time PIN (naipadala rin sa inyong cellphone via SMS).</span>
                    </div>
                </div>
            </template>

            <template x-if="otpError">
                <div class="status-err">
                    <i class="fas fa-exclamation-circle" style="flex-shrink:0;margin-top:2px;"></i>
                    <span x-text="otpError"></span>
                </div>
            </template>

            <template x-if="otpSuccess">
                <div class="status-ok">
                    <i class="fas fa-check-circle" style="flex-shrink:0;margin-top:2px;"></i>
                    <span x-text="otpSuccess"></span>
                </div>
            </template>

            <form method="POST" action="{{ route('password.otp.reset') }}">
                @csrf

                {{-- Mobile Number with Send OTP --}}
                <div style="margin-bottom:14px;">
                    <label class="flbl" for="fp_phone">Registered Mobile Number *</label>
                    <div class="fwrap" style="padding-right:6px;">
                        <i class="fas fa-mobile-alt ficon"></i>
                        <input id="fp_phone" type="tel" name="contact_number" x-model="phone" class="finput"
                               placeholder="09XXXXXXXXX (11 digits)" maxlength="11" required autocomplete="tel">
                        <button type="button" class="btn-send-otp" @click="sendOtp()" :disabled="otpSending || otpCooldown > 0">
                            <span x-show="!otpSending && otpCooldown === 0"><i class="fas fa-paper-plane"></i> Send OTP</span>
                            <span x-show="otpSending"><i class="fas fa-spinner fa-spin"></i> Sending...</span>
                            <span x-show="otpCooldown > 0" x-text="`Wait ${otpCooldown}s`"></span>
                        </button>
                    </div>
                    @error('contact_number')
                        <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- 6-Digit OTP Code --}}
                <div style="margin-bottom:14px;">
                    <label class="flbl" for="fp_otp_code">6-Digit One-Time PIN (OTP) *</label>
                    <div class="fwrap">
                        <i class="fas fa-shield-alt ficon"></i>
                        <input id="fp_otp_code" type="text" name="otp_code" x-model="otpCode" class="finput"
                               placeholder="000000" maxlength="6" required autocomplete="one-time-code"
                               style="letter-spacing:5px; font-size:16px; font-weight:900;">
                    </div>
                    @error('otp_code')
                        <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- New Password --}}
                <div style="margin-bottom:14px;" x-data="{ show: false }">
                    <label class="flbl" for="fp_password">Bagong Password *</label>
                    <div class="fwrap">
                        <i class="fas fa-lock ficon"></i>
                        <input id="fp_password" :type="show ? 'text' : 'password'" name="password" class="finput"
                               placeholder="8 to 16 characters (no spaces)" maxlength="16" required autocomplete="new-password">
                        <button type="button" @click="show = !show" style="background:none;border:none;color:#94a3b8;cursor:pointer;padding:0;font-size:12px;">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div style="margin-bottom:14px;" x-data="{ show: false }">
                    <label class="flbl" for="fp_password_confirmation">Kumpirmahin ang Bagong Password *</label>
                    <div class="fwrap">
                        <i class="fas fa-check-double ficon"></i>
                        <input id="fp_password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" class="finput"
                               placeholder="Ulitin ang bagong password" maxlength="16" required autocomplete="new-password">
                        <button type="button" @click="show = !show" style="background:none;border:none;color:#94a3b8;cursor:pointer;padding:0;font-size:12px;">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-sub">
                    <i class="fas fa-check-circle"></i> I-reset ang Password
                </button>
            </form>
        </div>

        {{-- ── OPTION B: EMAIL PASSWORD RESET LINK ── --}}
        <div x-show="mode === 'email'">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div style="margin-bottom:16px;">
                    <label class="flbl" for="email">Registered Email Address *</label>
                    <div class="fwrap">
                        <i class="fas fa-envelope ficon"></i>
                        <input id="email" type="email" name="email" x-model="emailVal" class="finput"
                               placeholder="username@gmail.com"
                               required autocomplete="username">
                    </div>
                    @error('email')
                        <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-sub">
                    <i class="fas fa-paper-plane"></i> Send Password Reset Link
                </button>
            </form>
        </div>

        {{-- Back to login inside the card --}}
        <a href="{{ route('login') }}" class="back-btn">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Login
        </a>

    </div>
</div>
</x-guest-layout>
