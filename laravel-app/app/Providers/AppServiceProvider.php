<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $settings = $this->siteSettings();

        // Apply timezone per request so cached settings still update runtime dates.
        if (!empty($settings['admin_timezone'])) {
            config(['app.timezone' => $settings['admin_timezone']]);
            date_default_timezone_set($settings['admin_timezone']);
        }

        View::share('siteSettings', $settings);
    }

    private function siteSettings(): array
    {
        return Cache::remember('site_settings', 3600, function () {
            $defaults = [
                'company_name' => 'Jiva Birth and Beyond',
                'company_email' => 'contact@jivabirthandbeyond.com',
                'company_phone' => '+91 74832 11870',
                'company_address' => 'Tippasandra, Bangalore, Karnataka',
                'company_hours' => 'Mon-Sat: 9 AM - 8 PM',
                'logo_path' => null,
                'logo_url' => null,
                'facebook' => '',
                'instagram' => '',
                'whatsapp' => '',
                'twitter' => '',
                'address_main' => 'Tippasandra, Bangalore',
                'address_sub' => 'Next to Central Park, Bangalore 560075',
                'map_embed' => '',
            ];

            $jsonSettingsPath = storage_path('app/settings.json');
            if (file_exists($jsonSettingsPath)) {
                try {
                    $jsonSettings = json_decode(file_get_contents($jsonSettingsPath), true);
                    if (is_array($jsonSettings)) {
                        $defaults = array_merge($defaults, array_filter($jsonSettings, fn ($v) => $v !== null && $v !== ''));
                    }
                } catch (\Throwable $e) {
                    // Keep rendering with defaults if the settings file is invalid.
                }
            }

            try {
                if (Schema::hasTable('site_settings')) {
                    $storedSettings = SiteSetting::pluck('value', 'key')
                        ->filter(fn ($value) => $value !== null && $value !== '')
                        ->toArray();
                    $defaults = array_merge($defaults, $storedSettings);
                }
            } catch (\Throwable $e) {
                // Keep frontend rendering when the database is unavailable.
            }

            if (!empty($defaults['logo_path'])) {
                $defaults['logo_url'] = Storage::url($defaults['logo_path']);
            }

            if (!empty($defaults['certifications_image_path'])) {
                $defaults['certifications_image_url'] = Storage::url($defaults['certifications_image_path']);
            }

            return $defaults;
        });
    }
}
