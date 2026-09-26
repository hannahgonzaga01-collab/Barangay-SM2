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
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{box-sizing:border-box;}
        html, body{font-family:'Plus Jakarta Sans', sans-serif !important;background:#f1f5f9;margin:0;display:flex;flex-direction:column;min-height:100vh;}
        input, button, select, textarea{font-family:inherit;}
        main{flex:1;}
    </style>
    <script>
        // Styled Toast notification helper
        window.showToast = function(message, type = 'success') {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: type,
                    title: message,
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    background: '#ffffff',
                    customClass: { popup: 'rounded-xl shadow-lg border border-slate-200' }
                });
            }
        };

        // Beautifully override native browser alert() to eliminate "[Host/IP] says..." dialogs
        window._nativeAlert = window.alert;
        window.alert = function(msg) {
            if (typeof Swal !== 'undefined') {
                const text = String(msg || '');
                const isSuccess = text.includes('✓') || text.toLowerCase().includes('success') || text.toLowerCase().includes('tagumpay') || text.toLowerCase().includes('saved') || text.toLowerCase().includes('uploaded');
                const isError = text.toLowerCase().includes('error') || text.toLowerCase().includes('failed') || text.toLowerCase().includes('hindi');
                Swal.fire({
                    title: isSuccess ? 'Tagumpay' : (isError ? 'Pansin / Paalala' : 'Impormasyon'),
                    text: text.replace(/^✓\s*/, ''),
                    icon: isSuccess ? 'success' : (isError ? 'warning' : 'info'),
                    confirmButtonColor: '#0E5393',
                    confirmButtonText: 'Sige, Naintindihan ko',
                    customClass: {
                        popup: 'rounded-2xl shadow-2xl border border-slate-100 font-sans',
                        confirmButton: 'px-6 py-2.5 rounded-lg text-sm font-bold'
                    }
                });
            } else if (window._nativeAlert) {
                window._nativeAlert(msg);
            }
        };
    </script>
</head>
<body class="font-sans antialiased">

    @include('layouts.navigation')

    @isset($header)
    <header class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>
    @endisset

    <main>
        {{ $slot }}
    </main>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof showToast === 'function') {
                    showToast(@json(session('success')), 'success');
                }
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof showToast === 'function') {
                    showToast(@json(session('error')), 'error');
                }
            });
        </script>
    @endif

</body>
</html>
