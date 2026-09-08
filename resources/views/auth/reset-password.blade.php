<x-guest-layout>
<style>
[x-cloak]{display:none!important;}

/* Pull out to fill the white guest card wrapper — match -8px like forgot password */
.rp-outer{margin:-8px;border-radius:20px;overflow:hidden;}

.rp-head{background:linear-gradient(135deg,#000052 0%,#0E5393 100%);padding:20px 24px 18px;}
.rp-head h2{font-size:15px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;display:flex;align-items:center;gap:8px;margin-bottom:4px;}
.rp-head p{font-size:10px;color:rgba(255,255,255,.6);font-weight:600;}

.rp-body{background:#fff;padding:24px;}

.flbl{font-size:9px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;display:block;margin-bottom:6px;}
.fwrap{display:flex;align-items:center;background:#f1f5f9;border:1.5px solid #e2e8f0;border-radius:10px;padding:0 13px;transition:border-color .15s,box-shadow .15s,background .15s;}
.fwrap:focus-within{border-color:#0E5393;background:#fff;box-shadow:0 0 0 3px rgba(14,83,147,.1);}
.ficon{color:#94a3b8;font-size:12px;flex-shrink:0;margin-right:9px;}
.finput{flex:1;border:none;background:transparent;padding:12px 0;font-family:inherit;font-size:13px;font-weight:600;color:#0f172a;outline:none;}
.finput::placeholder{color:#94a3b8;font-weight:500;}
.toggle-pw{background:none;border:none;color:#94a3b8;cursor:pointer;font-size:13px;padding:0;flex-shrink:0;transition:color .12s;}
.toggle-pw:hover{color:#0E5393;}
.ferr{font-size:10px;font-weight:700;color:#dc2626;margin-top:5px;display:flex;align-items:center;gap:4px;}
.pw-bars{display:flex;gap:3px;margin-top:6px;margin-bottom:3px;}
.pw-bar{flex:1;height:3px;border-radius:99px;background:#e2e8f0;transition:background .2s;}
.pw-hint{font-size:9px;font-weight:700;}
.btn-sub{width:100%;padding:13px;background:linear-gradient(135deg,#0E5393 0%,#000052 100%);color:#fff;font-family:inherit;font-size:12px;font-weight:900;letter-spacing:.06em;text-transform:uppercase;border:none;border-radius:10px;cursor:pointer;transition:all .18s;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 4px 14px rgba(0,0,82,.3);margin-top:6px;margin-bottom:14px;}
.btn-sub:hover{background:linear-gradient(135deg,#0a3f72 0%,#020f1c 100%);box-shadow:0 6px 20px rgba(0,0,82,.4);transform:translateY(-1px);}
.back-btn{display:flex;align-items:center;justify-content:center;gap:6px;width:100%;padding:10px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;font-family:inherit;font-size:11px;font-weight:800;color:#64748b;text-decoration:none;transition:all .15s;}
.back-btn:hover{background:#eff6ff;border-color:#0E5393;color:#0E5393;}
</style>

<div class="rp-outer"
     x-data="{
        showPw:false, showPwC:false, pw:'',
        get strength(){ let s=0; if(this.pw.length>=8)s++; if(/[A-Z]/.test(this.pw))s++; if(/[0-9]/.test(this.pw))s++; if(/[^A-Za-z0-9]/.test(this.pw))s++; return s; },
        get strengthLabel(){ return ['','Weak','Fair','Good','Strong'][this.strength]||''; },
        get strengthColor(){ return ['','#dc2626','#d97706','#0E5393','#059669'][this.strength]||'#e2e8f0'; }
     }">

    <div class="rp-head">
        <h2><i class="fas fa-key"></i> Reset Password</h2>
        <p>Set your new password below</p>
    </div>

    <div class="rp-body">
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Email --}}
            <div style="margin-bottom:16px;">
                <label class="flbl" for="email">Email Address</label>
                <div class="fwrap">
                    <i class="fas fa-envelope ficon"></i>
                    <input id="email" type="email" name="email" class="finput"
                           placeholder="yourname@email.com"
                           value="{{ old('email', $request->email) }}"
                           required autofocus autocomplete="username">
                </div>
                @error('email')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- New Password --}}
            <div style="margin-bottom:16px;">
                <label class="flbl" for="password">New Password</label>
                <div class="fwrap">
                    <i class="fas fa-lock ficon"></i>
                    <input id="password" :type="showPw?'text':'password'" name="password"
                           class="finput" placeholder="Minimum 8 characters"
                           x-model="pw" required autocomplete="new-password">
                    <button type="button" class="toggle-pw" @click="showPw=!showPw" tabindex="-1">
                        <i class="fas" :class="showPw?'fa-eye-slash':'fa-eye'"></i>
                    </button>
                </div>
                <div x-show="pw.length > 0">
                    <div class="pw-bars">
                        <div class="pw-bar" :style="strength>=1?'background:'+strengthColor:''"></div>
                        <div class="pw-bar" :style="strength>=2?'background:'+strengthColor:''"></div>
                        <div class="pw-bar" :style="strength>=3?'background:'+strengthColor:''"></div>
                        <div class="pw-bar" :style="strength>=4?'background:'+strengthColor:''"></div>
                    </div>
                    <div class="pw-hint" :style="'color:'+strengthColor" x-text="strengthLabel"></div>
                </div>
                @error('password')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div style="margin-bottom:4px;">
                <label class="flbl" for="password_confirmation">Confirm New Password</label>
                <div class="fwrap">
                    <i class="fas fa-lock ficon"></i>
                    <input id="password_confirmation" :type="showPwC?'text':'password'"
                           name="password_confirmation" class="finput"
                           placeholder="Re-enter new password"
                           required autocomplete="new-password">
                    <button type="button" class="toggle-pw" @click="showPwC=!showPwC" tabindex="-1">
                        <i class="fas" :class="showPwC?'fa-eye-slash':'fa-eye'"></i>
                    </button>
                </div>
                @error('password_confirmation')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-sub">
                <i class="fas fa-key"></i> Reset Password
            </button>

        </form>

        <a href="{{ route('login') }}" class="back-btn">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Login
        </a>

    </div>
</div>

</x-guest-layout>
