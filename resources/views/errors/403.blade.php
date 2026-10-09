<!DOCTYPE html>
<html lang="tl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wala Kayong Pahintulot (403 Forbidden) - Barangay San Miguel II</title>
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
            max-width: 500px;
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
            width: 60px;
            height: 60px;
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
        }
        .err-body {
            padding: 26px 24px;
        }
        .err-desc {
            font-size: 13px;
            line-height: 1.6;
            color: #475569;
            font-weight: 600;
            margin-bottom: 22px;
        }
        .btn-portal {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            background: #0E5393;
            color: #fff;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            text-decoration: none;
            transition: all .2s;
            box-shadow: 0 4px 14px rgba(14, 83, 147, 0.35);
        }
        .btn-portal:hover {
            background: #000052;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="err-card">
        <div class="err-head">
            <img src="/images/circlelogo.png" alt="Barangay Logo" class="err-logo" onerror="this.style.display='none'">
            <div class="err-badge"><i class="fas fa-lock"></i> 403 Forbidden</div>
            <h1 class="err-title">Wala Kayong Pahintulot</h1>
        </div>
        <div class="err-body">
            <p class="err-desc">
                Ang inyong account ay walang sapat na awtorisasyon upang ma-access ang pahinang ito o ang panel ng kawanihan. Mangyaring bumalik sa inyong opisyal na portal.
            </p>
            <a href="/" class="btn-portal">
                <i class="fas fa-home"></i> Bumalik sa Inyong Portal
            </a>
        </div>
    </div>
</body>
</html>
