<x-guest-layout>
<style>
[x-cloak]{display:none!important;}

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
.ferr{font-size:10px;font-weight:700;color:#dc2626;margin-top:5px;display:flex;align-items:center;gap:4px;}

.fgrid2{display:grid;grid-template-columns:1fr 1fr;gap:10px;}

.btn-sub{width:100%;padding:13px;background:linear-gradient(135deg,#0E5393 0%,#000052 100%);color:#fff;font-family:inherit;font-size:12px;font-weight:900;letter-spacing:.06em;text-transform:uppercase;border:none;border-radius:10px;cursor:pointer;transition:all .18s;display:flex;align-items:center;justify-content:center;gap:8px;box-shadow:0 4px 14px rgba(0,0,82,.3);margin-top:6px;margin-bottom:14px;}
.btn-sub:hover{background:linear-gradient(135deg,#0a3f72 0%,#020f1c 100%);box-shadow:0 6px 20px rgba(0,0,82,.4);transform:translateY(-1px);}
.login-link{text-align:center;font-size:11px;color:#64748b;font-weight:600;}
.login-link a{color:#0E5393;font-weight:800;text-decoration:none;}
.login-link a:hover{text-decoration:underline;}

.section-divider{font-size:9px;font-weight:900;color:#64748b;text-transform:uppercase;letter-spacing:.08em;margin:14px 0 10px;display:flex;align-items:center;gap:8px;}
.section-divider::before,.section-divider::after{content:'';flex:1;height:1px;background:#e2e8f0;}
</style>

<div class="rp-outer">
    <div class="rp-head">
        <h2><i class="fas fa-user-plus"></i> Create Account</h2>
        <p>Register to access Barangay SM2 services</p>
    </div>

    <div class="rp-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name section --}}
            <div class="section-divider">Personal Information</div>

            {{-- First + Last Name row --}}
            <div class="fgrid2" style="margin-bottom:10px;">
                <div>
                    <label class="flbl" for="first_name">First Name *</label>
                    <div class="fwrap">
                        <i class="fas fa-user ficon"></i>
                        <input id="first_name" type="text" name="first_name" class="finput"
                               placeholder="Juan"
                               value="{{ old('first_name') }}"
                               required autofocus autocomplete="given-name">
                    </div>
                    @error('first_name')
                    <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="flbl" for="last_name">Last Name *</label>
                    <div class="fwrap">
                        <i class="fas fa-user ficon"></i>
                        <input id="last_name" type="text" name="last_name" class="finput"
                               placeholder="Dela Cruz"
                               value="{{ old('last_name') }}"
                               required autocomplete="family-name">
                    </div>
                    @error('last_name')
                    <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Middle Name --}}
            <div style="margin-bottom:10px;">
                <label class="flbl" for="middle_name">Middle Name <span style="font-weight:600;text-transform:none;">(optional)</span></label>
                <div class="fwrap">
                    <i class="fas fa-user ficon"></i>
                    <input id="middle_name" type="text" name="middle_name" class="finput"
                           placeholder="Optional"
                           value="{{ old('middle_name') }}"
                           autocomplete="additional-name">
                </div>
            </div>

            {{-- Email --}}
            <div style="margin-bottom:10px;">
                <label class="flbl" for="email">Email Address *</label>
                <div class="fwrap">
                    <i class="fas fa-envelope ficon"></i>
                    <input id="email" type="email" name="email" class="finput"
                           placeholder="username@gmail.com"
                           value="{{ old('email') }}"
                           required autocomplete="username">
                </div>
                @error('email')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Voter Status --}}
            <div style="margin-bottom:10px;">
                <label class="flbl">Are you a registered voter in this Barangay? *</label>
                <div class="fwrap" style="padding:12px 13px;gap:20px;">
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-family:inherit;font-size:13px;font-weight:500;color:#606a79;">
                        <input type="radio" name="is_voter" value="1" required style="accent-color:#0E5393;width:15px;height:15px;" {{ old('is_voter') == '1' ? 'checked' : '' }}> Yes, I am
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;cursor:pointer;font-family:inherit;font-size:13px;font-weight:500;color:#606a79;">
                        <input type="radio" name="is_voter" value="0" required style="accent-color:#0E5393;width:15px;height:15px;" {{ old('is_voter') == '0' ? 'checked' : '' }}> No, I am not
                    </label>
                </div>
                @error('is_voter')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="section-divider">Security</div>

            <div style="margin-bottom:10px;" x-data="{
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
                <label class="flbl" for="password" style="display:flex;justify-content:space-between;align-items:center;">
                    <span>Password *</span>
                    <span x-show="pwd.length>0" x-text="strength.l" :style="`color:${strength.c};font-size:8px;padding:2px 6px;border-radius:4px;background:${strength.c}20;`" x-cloak></span>
                </label>
                <div class="fwrap" style="position:relative;overflow:hidden;border-bottom-left-radius:0;border-bottom-right-radius:0;margin-bottom:0;border-bottom:none;">
                    <i class="fas fa-lock ficon"></i>
                    <input id="password" :type="show?'text':'password'" name="password" class="finput" x-model="pwd"
                           placeholder="Minimum 8 characters"
                           required autocomplete="new-password">
                    <button type="button" @click="show=!show"
                            style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:12px;padding:0;flex-shrink:0;">
                        <i class="fas" :class="show?'fa-eye-slash':'fa-eye'"></i>
                    </button>
                    <!-- Progress Bar -->
                    <div style="position:absolute;bottom:0;left:0;right:0;height:3px;background:#e2e8f0;">
                        <div :style="`width:${strength.w};background:${strength.c};height:100%;transition:all .3s ease;`"></div>
                    </div>
                </div>
                <div style="background:#f8fafc;border:1.5px solid #e2e8f0;border-top:none;border-bottom-left-radius:10px;border-bottom-right-radius:10px;padding:8px 12px;">
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

            <div style="margin-bottom:4px;" x-data="{ show: false }">
                <label class="flbl" for="password_confirmation">Confirm Password *</label>
                <div class="fwrap">
                    <i class="fas fa-lock ficon"></i>
                    <input id="password_confirmation" :type="show?'text':'password'" name="password_confirmation" class="finput"
                           placeholder="Re-enter your password"
                           required autocomplete="new-password">
                    <button type="button" @click="show=!show"
                            style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:12px;padding:0;flex-shrink:0;">
                        <i class="fas" :class="show?'fa-eye-slash':'fa-eye'"></i>
                    </button>
                </div>
                @error('password_confirmation')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-sub">
                <i class="fas fa-user-plus"></i> Create My Account
            </button>

        </form>

        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Sign in here</a>
        </div>
    </div>
</div>

</x-guest-layout>
