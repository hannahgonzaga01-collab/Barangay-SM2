<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Barangay System') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Plus Jakarta Sans',sans-serif;min-height:100vh;background:linear-gradient(135deg,#000052 0%,#04192D 55%,#0E5393 100%);display:flex;align-items:center;justify-content:center;padding:20px;}
        .auth-wrap{width:100%;max-width:480px;}
        .auth-brand{text-align:center;margin-bottom:24px;}
        .auth-brand img{width:72px;height:72px;border-radius:50%;object-fit:cover;background:#fff;margin:0 auto 12px;display:block;box-shadow:0 4px 20px rgba(0,0,0,.3);}
        .auth-brand h1{font-size:16px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.08em;}
        .auth-brand p{font-size:10px;color:rgba(255,255,255,.6);font-weight:600;margin-top:3px;text-transform:uppercase;letter-spacing:.06em;}
        .auth-card{background:#fff;border-radius:20px;box-shadow:0 24px 60px rgba(0,0,52,.5);border-bottom:5px solid #0E5393;overflow:hidden;}
        .auth-card-head{background:linear-gradient(135deg,#000052 0%,#0E5393 100%);padding:20px 24px 18px;}
        .auth-card-head h2{font-size:15px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;}
        .auth-card-head p{font-size:10px;color:rgba(255,255,255,.6);font-weight:600;margin-top:3px;}
        .auth-card-body{padding:24px;}
        .auth-footer{text-align:center;margin-top:18px;}
        .auth-footer p{font-size:10px;color:rgba(255,255,255,.5);font-weight:600;}
        .auth-footer a{color:rgba(255,255,255,.8);font-weight:700;text-decoration:none;}
        .auth-footer a:hover{color:#fff;}
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
            <p>© {{ date('Y') }} Barangay SM2 Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
