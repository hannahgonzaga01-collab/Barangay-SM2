<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || request()->header('x-forwarded-proto') === 'https' || str_contains((string)config('app.url'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        $sources = [
            'C:/Users/Administrator/.gemini/antigravity/brain/d60c782f-eb68-4616-ac9e-0d2e9b3733be/.user_uploaded/media_1787883671344.jpg',
            'C:/Users/Administrator/.gemini/antigravity/brain/d60c782f-eb68-4616-ac9e-0d2e9b3733be/.user_uploaded/media_1787882864514.jpg',
        ];
        $bgDest = public_path('images/id_front_bg.jpg');
        foreach ($sources as $bgSource) {
            if (file_exists($bgSource) && (!file_exists($bgDest) || filesize($bgDest) === 0)) {
                @copy($bgSource, $bgDest);
                break;
            }
        }

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('emergency_sos_alerts')) {
                \Illuminate\Support\Facades\Schema::table('emergency_sos_alerts', function (\Illuminate\Database\Schema\Blueprint $table) {
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('emergency_sos_alerts', 'emergency_type')) {
                        $table->string('emergency_type')->nullable()->after('home_address');
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('emergency_sos_alerts', 'message')) {
                        $table->text('message')->nullable()->after('emergency_type');
                    }
                    if (!\Illuminate\Support\Facades\Schema::hasColumn('emergency_sos_alerts', 'dispatched_units')) {
                        $table->string('dispatched_units')->nullable()->after('status');
                    }
                });
            }
        } catch (\Throwable $e) {
            // Ignored during early container boot or offline migrations
        }
    }
}
