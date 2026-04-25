<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\GoogleAnalyticsService;

class AnalyticsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');

        $propertyId      = $settings['ga4_property_id']      ?? null;
        $credentialsJson = $settings['ga4_credentials_json'] ?? null;

        if (!$propertyId || !$credentialsJson) {
            return view('admin.analytics.index', [
                'configured' => false,
                'summary'    => [],
                'pages'      => [],
                'sources'    => [],
                'countries'  => [],
            ]);
        }

        try {
            $ga = new GoogleAnalyticsService($propertyId, $credentialsJson);

            return view('admin.analytics.index', [
                'configured' => true,
                'summary'    => $ga->getSummary(),
                'pages'      => $ga->getTopPages(),
                'sources'    => $ga->getTrafficSources(),
                'countries'  => $ga->getCountries(),
            ]);
        } catch (\Throwable $e) {
            return view('admin.analytics.index', [
                'configured' => true,
                'error'      => $e->getMessage(),
                'summary'    => [],
                'pages'      => [],
                'sources'    => [],
                'countries'  => [],
            ]);
        }
    }
}
