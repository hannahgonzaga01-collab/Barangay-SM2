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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.alert = function(msg) {
            if (typeof Swal !== 'undefined') {
                const text = String(msg || '');
                const isSuccess = text.includes('✓') || text.toLowerCase().includes('success') || text.toLowerCase().includes('tagumpay') || text.toLowerCase().includes('saved');
                Swal.fire({
                    title: isSuccess ? 'Tagumpay' : 'Paalala',
                    text: text.replace(/^✓\s*/, ''),
                    icon: isSuccess ? 'success' : 'info',
                    confirmButtonColor: '#0E5393',
                    confirmButtonText: 'OK',
                    customClass: { popup: 'rounded-2xl font-sans' }
                });
            }
        };
    </script>
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        html, body{
            font-family:'Plus Jakarta Sans', sans-serif !important;
            min-height:100vh;
            background-color:#000052 !important;
            background-image:none !important;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            padding:12px 16px;
            width:100%;
            overflow-x:hidden;
            scrollbar-width:none;
            -ms-overflow-style:none;
        }
        html::-webkit-scrollbar, body::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }
        @media (min-height: 600px) {
            html, body {
                height: 100vh;
                max-height: 100vh;
                overflow: hidden !important;
            }
        }
        input, button, select, textarea{font-family:inherit;}
        .auth-wrap{width:100%;max-width:480px;margin:0 auto;position:relative;z-index:1;}
        .auth-brand{text-align:center;margin-bottom:12px;}
        .auth-brand img{width:52px;height:52px;border-radius:50%;object-fit:cover;background:#fff;margin:0 auto 6px;display:block;box-shadow:0 4px 15px rgba(0,0,0,.3);}
        .auth-brand h1{font-size:15px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.08em;}
        .auth-brand p{font-size:9.5px;color:rgba(255,255,255,.65);font-weight:600;margin-top:2px;text-transform:uppercase;letter-spacing:.06em;}
        .auth-card{background:#fff;border-radius:18px;box-shadow:0 15px 35px rgba(0,0,0,.35);border:none !important;overflow:hidden;width:100%;}
        .auth-card-head{background:linear-gradient(135deg,#000052 0%,#0E5393 100%);padding:14px 20px 12px;border:none !important;}
        .auth-card-head h2{font-size:14px;font-weight:900;color:#fff;text-transform:uppercase;letter-spacing:.06em;}
        .auth-card-head p{font-size:9.5px;color:rgba(255,255,255,.65);font-weight:600;margin-top:2px;}
        .auth-card-body{padding:18px 22px;}
        .auth-footer{text-align:center;margin-top:10px;width:100%;}
        .auth-footer p{font-size:9.5px;color:rgba(255,255,255,.5);font-weight:600;line-height:1.4;}
        .auth-footer a{color:rgba(255,255,255,.8);font-weight:700;text-decoration:none;}
        .auth-footer a:hover{color:#fff;}
        @media (max-width: 540px) {
            html, body{padding:10px 10px;}
            .auth-brand img{width:46px;height:46px;margin-bottom:6px;}
            .auth-brand h1{font-size:13.5px;}
            .auth-brand p{font-size:9px;}
            .auth-card{border-radius:15px;}
            .auth-card-head{padding:12px 16px 10px;}
            .auth-card-body{padding:14px 16px;}
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
