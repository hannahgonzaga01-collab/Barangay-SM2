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
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your session has expired. Please refresh and try again.'], 419);
            }
            return redirect()->back()->with('error', 'Session refreshed. Please submit again.');
        });
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            if ($e->getStatusCode() === 419) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Your session has expired. Please refresh and try again.'], 419);
                }
                return redirect()->back()->with('error', 'Session refreshed. Please submit again.');
            }
        });
    })->create();
