@php
    $isResident = auth()->user()?->role === 'resident';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-lg flex items-center justify-center text-white" style="background:linear-gradient(135deg,#0E5393 0%,#04192D 100%);">
                <i class="fas fa-key text-lg"></i>
            </div>
            <div>
                <h2 class="font-black text-xl text-gray-800 leading-tight uppercase tracking-tight">Security Settings</h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Update your account credentials</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ 
        showCurrent: false, 
        showNew: false, 
        showConfirm: false,
        emailInput: '{{ auth()->user()?->email }}',
        otpSent: false,
        otpLoading: false,
        otpMessage: '',
        otpError: false,
        sendOtp() {
            if (!this.emailInput) {
                this.otpMessage = 'Please enter your registered email address.';
                this.otpError = true;
                return;
            }
            this.otpLoading = true;
            this.otpError = false;
            fetch('{{ route('staff.password.otp') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: this.emailInput })
            })
            .then(response => response.json())
            .then(data => {
                this.otpLoading = false;
                this.otpMessage = data.message;
                if (data.success) {
                    this.otpSent = true;
                } else {
                    this.otpError = true;
                }
            })
            .catch(error => {
                this.otpLoading = false;
                this.otpMessage = 'Something went wrong. Please try again.';
                this.otpError = true;
            });
        }
    }">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div style="background:#fff; border-radius:24px; box-shadow:0 10px 40px rgba(0,0,82,0.08); border:1px solid #e2e8f0; overflow:hidden;">
                
                {{-- Form Header --}}
                <div style="background:linear-gradient(135deg,#000052 0%,#0E5393 100%); padding:24px 32px;">
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:6px;">
                        <div style="width:36px; height:36px; border-radius:10px; background:rgba(255,255,255,0.15); display:flex; align-items:center; justify-content:center; color:#fff;">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h3 style="font-size:14px; font-weight:900; color:#fff; text-transform:uppercase; letter-spacing:0.06em; margin:0;">Change Password</h3>
                            <p style="font-size:10px; color:rgba(255,255,255,0.6); font-weight:600; margin:0; text-transform:uppercase; letter-spacing:0.02em;">Secure your account with a new password</p>
                        </div>
                    </div>
                </div>

                <div style="padding:32px;">
                    @if (session('success'))
                        <div style="background:#dcfce7; border:1px solid #bbf7d0; color:#15803d; padding:12px 16px; border-radius:12px; font-size:12px; font-weight:700; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('staff.password.update') }}" class="space-y-6">
                        @csrf

                        {{-- EMAIL VERIFICATION & OTP (FOR ALL ROLES: RESIDENTS & OFFICIALS) --}}
                        <div style="background:#eff6ff; padding:20px; border-radius:16px; border:1.5px dashed #0E5393;">
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:6px;">
                                <label style="display:block; font-size:10px; font-weight:900; color:#0E5393; text-transform:uppercase; letter-spacing:0.08em;">
                                    <i class="fas fa-shield-alt" style="margin-right:4px;"></i> Step 1: Email Verification
                                </label>
                                <span style="font-size:9px; font-weight:800; background:#dbeafe; color:#1d4ed8; padding:2px 8px; border-radius:99px;">OTP SECURITY</span>
                            </div>
                            <p style="font-size:11px; color:#1e40af; font-weight:600; margin-bottom:12px; line-height:1.4;">
                                Click "Send OTP" to receive a 6-digit One-Time Password on your registered email address.
                            </p>

                            <div style="display:flex; gap:10px; margin-bottom:12px; flex-wrap:wrap;">
                                <div style="flex:1; min-width:200px; position:relative;">
                                    <i class="fas fa-envelope" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#0E5393; font-size:12px;"></i>
                                    <input type="email" x-model="emailInput" readonly
                                        style="width:100%; padding:10px 12px 10px 36px; background:#fff; border:1.5px solid #bfdbfe; border-radius:10px; font-size:12px; font-weight:700; color:#0f172a; outline:none;"
                                        placeholder="Registered email address">
                                </div>
                                <button type="button" @click="sendOtp" :disabled="otpLoading"
                                    style="padding:10px 18px; background:linear-gradient(135deg,#0E5393 0%,#000052 100%); color:#fff; font-size:10.5px; font-weight:900; text-transform:uppercase; letter-spacing:.04em; border:none; border-radius:10px; cursor:pointer; display:inline-flex; align-items:center; gap:6px; box-shadow:0 2px 6px rgba(14,83,147,0.3); transition:all .15s;">
                                    <i class="fas fa-paper-plane" x-show="!otpLoading"></i>
                                    <i class="fas fa-spinner fa-spin" x-show="otpLoading"></i>
                                    <span x-text="otpSent ? 'Resend OTP' : 'Send OTP'"></span>
                                </button>
                            </div>

                            <div x-show="otpMessage" :style="{ color: otpError ? '#dc2626' : '#15803d', background: otpError ? '#fee2e2' : '#dcfce7', borderColor: otpError ? '#fca5a5' : '#86efac' }" style="font-size:11px; font-weight:700; padding:8px 12px; border-radius:8px; border:1px solid; margin-bottom:12px; display:flex; align-items:center; gap:6px;">
                                <i :class="otpError ? 'fas fa-exclamation-circle' : 'fas fa-check-circle'"></i>
                                <span x-text="otpMessage"></span>
                            </div>

                            <div>
                                <label style="display:block; font-size:10px; font-weight:900; color:#0E5393; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:4px;">
                                    Step 2: Enter 6-Digit OTP Code
                                </label>
                                <div style="position:relative;">
                                    <i class="fas fa-key" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#0E5393; font-size:12px;"></i>
                                    <input type="text" name="otp" required maxlength="6"
                                        style="width:100%; padding:12px 12px 12px 40px; background:#fff; border:1.5px solid #0E5393; border-radius:12px; font-size:14px; font-weight:800; letter-spacing:2px; color:#0f172a; outline:none; transition:all 0.2s;"
                                        placeholder="Paste or enter 6-digit OTP code">
                                </div>
                                @error('otp')
                                    <p style="font-size:10.5px; color:#dc2626; font-weight:700; margin-top:6px; display:flex; align-items:center; gap:4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- New Password --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label style="display:block; font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:8px;">New Password</label>
                                <div style="position:relative;">
                                    <i class="fas fa-key" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:12px;"></i>
                                    <input :type="showNew ? 'text' : 'password'" name="new_password" required maxlength="16"
                                        style="width:100%; padding:12px 45px 12px 40px; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; font-size:13px; font-weight:600; color:#0f172a; outline:none; transition:all 0.2s;"
                                        placeholder="8 to 16 characters (no spaces)"
                                        onfocus="this.style.borderColor='#0E5393'; this.style.background='#fff'; this.style.boxShadow='0 0 0 4px rgba(14,83,147,0.1)';"
                                        onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none';">
                                    <button type="button" @click="showNew = !showNew" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:14px; cursor:pointer; background:none; border:none; outline:none;">
                                        <i class="fas" :class="showNew ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                                <p style="font-size:10px; color:#64748b; font-weight:600; margin-top:4px;">
                                    Must be 8–16 characters, one word (no spaces).
                                </p>
                                @error('new_password')
                                    <p style="font-size:10px; color:#dc2626; font-weight:700; margin-top:6px; display:flex; align-items:center; gap:4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label style="display:block; font-size:10px; font-weight:900; color:#64748b; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:8px;">Confirm Password</label>
                                <div style="position:relative;">
                                    <i class="fas fa-check-double" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:12px;"></i>
                                    <input :type="showConfirm ? 'text' : 'password'" name="new_password_confirmation" required maxlength="16"
                                        style="width:100%; padding:12px 45px 12px 40px; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:12px; font-size:13px; font-weight:600; color:#0f172a; outline:none; transition:all 0.2s;"
                                        placeholder="Confirm 8 to 16 characters"
                                        onfocus="this.style.borderColor='#0E5393'; this.style.background='#fff'; this.style.boxShadow='0 0 0 4px rgba(14,83,147,0.1)';"
                                        onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none';">
                                    <button type="button" @click="showConfirm = !showConfirm" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:14px; cursor:pointer; background:none; border:none; outline:none;">
                                        <i class="fas" :class="showConfirm ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div style="padding-top:12px; display:flex; gap:16px;">
                            <a href="{{ route('dashboard') }}" 
                                style="flex:1; padding:14px; background:#fff; border:1.5px solid #e2e8f0; color:#64748b; font-size:12px; font-weight:900; text-align:center; text-transform:uppercase; letter-spacing:0.06em; border-radius:12px; text-decoration:none; transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:8px;"
                                onmouseover="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc'; this.style.color='#475569';"
                                onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#fff'; this.style.color='#64748b';">
                                <i class="fas fa-times" style="font-size:10px;"></i> Cancel
                            </a>
                            <button type="submit" 
                                style="flex:2; padding:14px; background:linear-gradient(135deg,#0E5393 0%,#000052 100%); color:#fff; font-size:12px; font-weight:900; text-transform:uppercase; letter-spacing:0.06em; border:none; border-radius:12px; cursor:pointer; transition:all 0.2s; box-shadow:0 4px 12px rgba(0,0,82,0.2); display:flex; align-items:center; justify-content:center; gap:8px;"
                                onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 16px rgba(0,0,82,0.3)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,82,0.2)';">
                                <i class="fas fa-check-circle"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Footer Info --}}
                <div style="background:#f8fafc; padding:20px 32px; border-top:1px solid #e2e8f0; display:flex; align-items:center; gap:12px;">
                    <i class="fas fa-info-circle" style="color:#94a3b8;"></i>
                    <p style="font-size:11px; color:#64748b; font-weight:600; margin:0;">
                        Changing your password will update your credentials across all devices. Please keep your new password safe.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>