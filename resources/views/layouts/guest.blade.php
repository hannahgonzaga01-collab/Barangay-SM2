<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Barangay System') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        html, body{font-family:'Plus Jakarta Sans', sans-serif !important;min-height:100vh;background-color:#000052 !important;background-image:none !important;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:32px 16px;width:100%;}
        input, button, select, textarea{font-family:inherit;}
        .auth-wrap{width:100%;max-width:520px;margin:0 auto;position:relative;z-index:1;}
        .auth-brand{text-align:center;margin-bottom:20px;}
        .auth-brand img{width:68px;height:68px;border-radius:50%;object-fit:cover;background:#fff;margin:0 auto 10px;display:block;box-shadow:0 4px 15px rgba(0,0,0,.3);}
        .auth-brand h1{font-size:16px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.08em;}
        .auth-brand p{font-size:10px;color:rgba(255,255,255,.6);font-weight:600;margin-top:3px;text-transform:uppercase;letter-spacing:.06em;}
        .auth-card{background:#fff;border-radius:20px;box-shadow:0 15px 35px rgba(0,0,0,.35);border:none !important;overflow:hidden;width:100%;}
        .auth-card-head{background:linear-gradient(135deg,#000052 0%,#0E5393 100%);padding:20px 24px 18px;border:none !important;}
        .auth-card-head h2{font-size:15px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;}
        .auth-card-head p{font-size:10px;color:rgba(255,255,255,.6);font-weight:600;margin-top:3px;}
        .auth-card-body{padding:24px;}
        .auth-footer{text-align:center;margin-top:20px;width:100%;}
        .auth-footer p{font-size:10px;color:rgba(255,255,255,.5);font-weight:600;line-height:1.5;}
        .auth-footer a{color:rgba(255,255,255,.8);font-weight:700;text-decoration:none;}
        .auth-footer a:hover{color:#fff;}
        @media (max-width: 540px) {
            html, body{padding:16px 10px;}
            .auth-brand img{width:56px;height:56px;margin-bottom:8px;}
            .auth-brand h1{font-size:14px;}
            .auth-brand p{font-size:9px;}
            .auth-card{border-radius:16px;}
            .auth-card-head{padding:16px 18px 14px;}
            .auth-card-body{padding:18px 14px;}
        }
    </style>
</head>
<body>
    <div class="auth-wrap">
        <div class="auth-brand">
            <img src="/images/circlelogo.png" alt="Brgy. SM2 Logo" onerror="this.style.display='none'">
            <h1>Barangay San Miguel II</h1>
            <p>Dasmariñas City, Cavite • Digital Services Portal</p>
        </div>
        <div class="auth-card">
            {{ $slot }}
        </div>
        <div class="auth-footer">
            <p>© {{ date('Y') }} Barangay San Miguel II, Dasmariñas City ,Cavite. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
