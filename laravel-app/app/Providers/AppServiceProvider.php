<?php

namespace App\Providers;

use App\Models\SiteSetting;
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
        View::composer('*', function ($view) {
            $settings = [
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

            // Try to load from JSON file first (persisted admin settings)
            $jsonSettingsPath = storage_path('app/settings.json');
            if (file_exists($jsonSettingsPath)) {
                try {
                    $jsonSettings = json_decode(file_get_contents($jsonSettingsPath), true);
                    if (is_array($jsonSettings)) {
                        $settings = array_merge($settings, array_filter($jsonSettings, fn($v) => $v !== null && $v !== ''));
                    }
                } catch (\Throwable $e) {
                    // Fall back to defaults if JSON is invalid
                }
            }

            // Then try to load from database
            try {
                if (Schema::hasTable('site_settings')) {
                    $storedSettings = SiteSetting::pluck('value', 'key')
                        ->filter(fn ($value) => $value !== null && $value !== '')
                        ->toArray();

                    $settings = array_merge($settings, $storedSettings);
                }
            } catch (\Throwable $exception) {
                // Keep frontend rendering with defaults when settings table is unavailable.
            }

            // Apply admin-configured timezone globally so all timestamps display correctly
            if (!empty($settings['admin_timezone'])) {
                config(['app.timezone' => $settings['admin_timezone']]);
                date_default_timezone_set($settings['admin_timezone']);
            }

            if (! empty($settings['logo_path'])) {
                $settings['logo_url'] = Storage::url($settings['logo_path']);
            }

            if (! empty($settings['certifications_image_path'])) {
                $settings['certifications_image_url'] = Storage::url($settings['certifications_image_path']);
            }

            $view->with('siteSettings', $settings);
        });
    }
}
