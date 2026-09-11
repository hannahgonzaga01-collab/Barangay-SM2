<x-guest-layout>
    <style>
        .auth-card-head::after {
            content: 'Sign in to your account';
            display: none;
        }

        .flbl {
            font-size: 9px;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .06em;
            display: block;
            margin-bottom: 5px;
        }

        .finput {
            width: 100%;
            padding: 10px 14px 10px 38px;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 9px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            outline: none;
            transition: all .15s;
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
            margin-bottom: 14px;
        }

        .err-msg {
            font-size: 10px;
            font-weight: 700;
            color: #dc2626;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #0E5393 0%, #04192D 100%);
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
            box-shadow: 0 4px 14px rgba(0, 0, 82, .3);
            margin-top: 6px;
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
            margin-bottom: 14px;
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
            margin-top: 16px;
            padding-top: 16px;
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
        <p>Sign in to access your Barangay San Miguel II account</p>
    </div>

    <div class="auth-card-body">
        @if(session('status') || session('success'))
            <div class="status-msg">
                <i class="fas fa-check-circle"></i> {{ session('status') ?? session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="err-msg"
                style="background:#fee2e2; border:1px solid #fecaca; padding:10px 14px; border-radius:9px; margin-bottom:16px; color:#991b1b;">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="fgrp">
                <label class="flbl" for="email"> Email Address</label>
                <div class="finput-wrap">
                    <i class="fas fa-envelope finput-ico"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="finput"
                        placeholder="username@gmail.com" required autofocus autocomplete="username">
                </div>
                @error('email')<div class="err-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="fgrp" x-data="{ show: false }">
                <label class="flbl" for="password"> Password</label>
                <div class="finput-wrap has-toggle">
                    <i class="fas fa-lock finput-ico"></i>
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
                <p style="font-size:13px;">Don't have an account yet? <a href="{{ route('register') }}">Create one here</a></p>
            </div>
        </form>
    </div>
</x-guest-layout>