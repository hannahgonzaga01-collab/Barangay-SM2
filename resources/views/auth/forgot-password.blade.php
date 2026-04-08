<x-guest-layout>
<style>
[x-cloak]{display:none!important;}

/* ── Fill + override the white guest wrapper ── */
.fp-outer {
    margin: -8px;           /* pull out to fill the white card padding */
    border-radius: 20px;
    overflow: hidden;
}

/* ── Gradient header ── */
.fp-head {
    background: linear-gradient(135deg, #000052 0%, #0E5393 100%);
    padding: 22px 26px 20px;
}
.fp-head-title {
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
.fp-head-sub {
    font-size: 10px;
    color: rgba(255,255,255,.6);
    font-weight: 600;
}

/* ── White body ── */
.fp-body {
    background: #fff;
    padding: 24px 26px 26px;
}

/* ── Status ── */
.status-ok {
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 11px;
    font-weight: 700;
    color: #15803d;
    display: flex;
    align-items: flex-start;
    gap: 7px;
    margin-bottom: 18px;
    line-height: 1.5;
}

/* ── Fields ── */
.flbl {
    font-size: 9px; font-weight: 900; color: #64748b;
    text-transform: uppercase; letter-spacing: .08em;
    display: block; margin-bottom: 6px;
}
.fwrap {
    display: flex; align-items: center;
    background: #f1f5f9; border: 1.5px solid #e2e8f0;
    border-radius: 10px; padding: 0 13px;
    transition: border-color .15s, box-shadow .15s, background .15s;
}
.fwrap:focus-within {
    border-color: #0E5393; background: #fff;
    box-shadow: 0 0 0 3px rgba(14,83,147,.1);
}
.ficon { color: #94a3b8; font-size: 12px; flex-shrink: 0; margin-right: 9px; }
.finput {
    flex: 1; border: none; background: transparent;
    padding: 12px 0; font-family: inherit; font-size: 13px;
    font-weight: 600; color: #0f172a; outline: none;
}
.finput::placeholder { color: #94a3b8; font-weight: 500; }
.ferr {
    font-size: 10px; font-weight: 700; color: #dc2626;
    margin-top: 5px; display: flex; align-items: center; gap: 4px;
}

/* ── Submit ── */
.btn-sub {
    width: 100%; padding: 13px;
    background: linear-gradient(135deg, #0E5393 0%, #000052 100%);
    color: #fff; font-family: inherit; font-size: 12px; font-weight: 900;
    letter-spacing: .06em; text-transform: uppercase; border: none;
    border-radius: 10px; cursor: pointer; transition: all .18s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    box-shadow: 0 4px 14px rgba(0,0,82,.3); margin-bottom: 14px;
}
.btn-sub:hover {
    background: linear-gradient(135deg, #0a3f72 0%, #020f1c 100%);
    box-shadow: 0 6px 20px rgba(0,0,82,.4);
    transform: translateY(-1px);
}

/* ── Back button (inside, bottom) ── */
.back-btn {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    width: 100%; padding: 10px;
    background: #f8fafc; border: 1.5px solid #e2e8f0;
    border-radius: 10px; font-family: inherit; font-size: 11px;
    font-weight: 800; color: #64748b; text-decoration: none;
    transition: all .15s; cursor: pointer;
}
.back-btn:hover { background: #eff6ff; border-color: #0E5393; color: #0E5393; }
</style>

<div class="fp-outer">

    {{-- Header --}}
    <div class="fp-head">
        <div class="fp-head-title">
            <i class="fas fa-paper-plane"></i> Forgot Password
        </div>
        <div class="fp-head-sub">Enter your email to receive a password reset link</div>
    </div>

    {{-- Body --}}
    <div class="fp-body">

        @if (session('status'))
        <div class="status-ok">
            <i class="fas fa-check-circle" style="flex-shrink:0;margin-top:1px;"></i>
            <span>{{ session('status') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div style="margin-bottom:16px;">
                <label class="flbl" for="email">Email Address</label>
                <div class="fwrap">
                    <i class="fas fa-envelope ficon"></i>
                    <input id="email" type="email" name="email" class="finput"
                           placeholder="yourname@email.com"
                           value="{{ old('email') }}"
                           required autofocus autocomplete="username">
                </div>
                @error('email')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-sub">
                <i class="fas fa-paper-plane"></i> Send Password Reset Link
            </button>

        </form>

        {{-- Back to login inside the card --}}
        <a href="{{ route('login') }}" class="back-btn">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Login
        </a>

    </div>
</div>

</x-guest-layout>
