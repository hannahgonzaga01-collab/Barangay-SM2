<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'verified_resident' => \App\Http\Middleware\VerifiedResidentMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'logout',
            'resident/*',
            'resident/**',
            'resident/family',
            'resident/family/*',
            'resident/document-request',
            'resident/document-request/*',
            'resident/issue-report',
            'resident/issue-report/*',
            'resident/digital-id',
            'resident/digital-id/*',
            'resident/digital-id/request',
            'resident/voter/upload',
            'resident/message',
            'resident/notifications/read',
            'resident/profile-photo',
            'resident/pet/*',
            'resident/emergency-sos',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Database\QueryException|\PDOException $e, $request) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pansamantalang hindi maabot ang database. Mangyaring maghintay ng sandali at subukang muli.',
                ], 503);
            }
            if ($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('patch') || $request->isMethod('delete')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Pansamantalang hindi maabot ang database server. Ligtas at napapanatili ang inyong mga in-input na datos; mangyaring subukang i-submit muli.');
            }
            return response()->view('errors.500', [
                'title' => 'Pansamantalang Hindi Maabot ang Database',
                'message' => 'Kasalukuyang hindi makakonekta ang server sa database. Huwag mag-alala, ligtas ang inyong talaan habang inaayos ito ng teknikal na koponan.',
            ], 500);
        });
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your session has expired. Please refresh and try again.'], 419);
            }
            return redirect()->back()->withInput()->with('error', 'Na-refresh ang inyong sesyon. Napanatili ang inyong mga in-input; mangyaring i-submit muli.');
        });
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            if ($e->getStatusCode() === 419) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Your session has expired. Please refresh and try again.'], 419);
                }
                return redirect()->back()->withInput()->with('error', 'Na-refresh ang inyong sesyon. Napanatili ang inyong mga in-input; mangyaring i-submit muli.');
            }
        });
    })->create();
