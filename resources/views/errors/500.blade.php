<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Pansamantalang Hindi Maabot ang Server' }} - Barangay San Miguel II</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #000052 0%, #04192D 60%, #0E5393 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: #fff;
        }
        .err-card {
            background: #fff;
            color: #0f172a;
            max-width: 520px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 52, 0.45);
            overflow: hidden;
            text-align: center;
        }
        .err-head {
            background: linear-gradient(135deg, #0E5393 0%, #000052 100%);
            padding: 28px 24px 22px;
            color: #fff;
        }
        .err-logo {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin: 0 auto 12px;
            display: block;
            background: #fff;
        }
        .err-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.4);
            color: #fca5a5;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 8px;
        }
        .err-title {
            font-size: 18px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .04em;
            line-height: 1.3;
        }
        .err-body {
            padding: 26px 24px;
        }
        .err-desc {
            font-size: 13px;
            line-height: 1.6;
            color: #475569;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .err-safe-note {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 11.5px;
            color: #166534;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: left;
            margin-bottom: 22px;
        }
        .err-safe-note i {
            font-size: 18px;
            color: #15803d;
            flex-shrink: 0;
        }
        .err-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn-retry {
            flex: 1;
            min-width: 140px;
            padding: 12px 18px;
            background: #0E5393;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            cursor: pointer;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            box-shadow: 0 4px 14px rgba(14, 83, 147, 0.35);
        }
        .btn-retry:hover {
            background: #000052;
            transform: translateY(-1px);
        }
        .btn-portal {
            flex: 1;
            min-width: 140px;
            padding: 12px 18px;
            background: #f1f5f9;
            color: #334155;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: all .2s;
        }
        .btn-portal:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .err-hotlines {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px dashed #e2e8f0;
            font-size: 11px;
            color: #64748b;
        }
        .err-hotlines a {
            color: #0E5393;
            font-weight: 800;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="err-card">
        <div class="err-head">
            <img src="/images/circlelogo.png" alt="Barangay Logo" class="err-logo" onerror="this.style.display='none'">
            <div class="err-badge"><i class="fas fa-exclamation-triangle"></i> System Status Alert</div>
            <h1 class="err-title">{{ $title ?? 'Pansamantalang Hindi Maabot ang Database' }}</h1>
        </div>
        <div class="err-body">
            <p class="err-desc">
                {{ $message ?? 'Kasalukuyang hindi makakonekta ang server sa database. Huwag mag-alala, ligtas ang inyong talaan habang sinisiguro ng aming koponan ang mabilis na koneksyon.' }}
            </p>

            <div class="err-safe-note">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <strong>Ligtas ang inyong mga datos!</strong> Kung kayo ay may sinagutang form, napanatili ang inyong draft at hindi ito mawawala.
                </div>
            </div>

            <div class="err-actions">
                <button type="button" class="btn-retry" onclick="window.location.reload()">
                    <i class="fas fa-sync-alt"></i> Subukang Muli
                </button>
                <a href="/" class="btn-portal">
                    <i class="fas fa-home"></i> Bumalik sa Portal
                </a>
            </div>

            <div class="err-hotlines">
                Para sa mga agarang tawag o emergency:<br>
                <strong>Brgy. Hotline:</strong> <a href="tel:09171234567">0917-123-4567</a> • <strong>Command Center:</strong> <a href="tel:0464160000">(046) 416-0000</a>
            </div>
        </div>
    </div>
</body>
</html>
