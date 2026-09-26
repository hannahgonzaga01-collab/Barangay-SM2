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
            <i class="fas fa-shield-alt"></i> Security Challenge
        </div>
        <div class="fp-head-sub">Answer your security question to reset your password</div>
    </div>

    {{-- Body --}}
    <div class="fp-body">
        
        <form method="POST" action="{{ route('password.security-question.verify') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div style="margin-bottom:16px;">
                <label class="flbl">Your Security Question</label>
                <div style="font-size:14px;font-weight:800;color:#0f172a;margin-bottom:12px;padding:12px 14px;background:#f8fafc;border-radius:10px;border:1.5px solid #e2e8f0;">
                    <i class="fas fa-question-circle" style="color:#0E5393;margin-right:6px;"></i> {{ $question }}
                </div>
            </div>

            <div style="margin-bottom:16px;">
                <label class="flbl" for="security_answer">Your Answer</label>
                <div class="fwrap">
                    <i class="fas fa-key ficon"></i>
                    <input id="security_answer" type="text" name="security_answer" class="finput"
                           placeholder="Enter your security answer..."
                           required autofocus autocomplete="off">
                </div>
                @error('security_answer')
                <div class="ferr"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-sub">
                <i class="fas fa-unlock-alt"></i> Verify Answer
            </button>
        </form>

        {{-- Alternate option: Send Reset Link to Registered Email --}}
        <div style="text-align:center;margin:18px 0 14px;position:relative;">
            <hr style="border:none;border-top:1.5px solid #e2e8f0;margin:0;">
            <span style="position:relative;top:-9px;background:#fff;padding:0 10px;font-size:9.5px;font-weight:900;color:#94a3b8;text-transform:uppercase;letter-spacing:.08em;">OR RECOVER VIA EMAIL</span>
        </div>

        <form method="POST" action="{{ route('password.email') }}" style="margin-bottom:12px;">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="force_email" value="1">
            <button type="submit" style="width:100%;padding:11px;background:#f0fdf4;border:1.5px solid #bbf7d0;border-radius:10px;font-family:inherit;font-size:11px;font-weight:800;color:#166534;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:7px;transition:all .15s;box-shadow:0 2px 6px rgba(22,101,52,0.06);"
                    onmouseover="this.style.background='#dcfce7';this.style.borderColor='#86efac';"
                    onmouseout="this.style.background='#f0fdf4';this.style.borderColor='#bbf7d0';">
                <i class="fas fa-paper-plane" style="font-size:10.5px;"></i> Send Reset Link to Registered Email
            </button>
        </form>

        {{-- Back to login inside the card --}}
        <a href="{{ route('password.request') }}" class="back-btn">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Cancel Reset
        </a>

    </div>
</div>
</x-guest-layout>
