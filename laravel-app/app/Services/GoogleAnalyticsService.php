<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GoogleAnalyticsService
{
    private string $propertyId;
    private array  $credentials;

    public function __construct(string $propertyId, string $credentialsJson)
    {
        $this->propertyId  = $propertyId;
        $this->credentials = json_decode($credentialsJson, true) ?? [];
    }

    private function b64url(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function getAccessToken(): ?string
    {
        $cacheKey = 'ga4_token_' . md5($this->credentials['client_email'] ?? '');

        return Cache::remember($cacheKey, 3300, function () {
            $now     = time();
            $header  = $this->b64url(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
            $payload = $this->b64url(json_encode([
                'iss'   => $this->credentials['client_email'] ?? '',
                'scope' => 'https://www.googleapis.com/auth/analytics.readonly',
                'aud'   => 'https://oauth2.googleapis.com/token',
                'exp'   => $now + 3600,
                'iat'   => $now,
            ]));

            $signInput  = $header . '.' . $payload;
            $privateKey = openssl_pkey_get_private($this->credentials['private_key'] ?? '');
            if (!$privateKey) return null;

            openssl_sign($signInput, $sig, $privateKey, OPENSSL_ALGO_SHA256);
            $jwt = $signInput . '.' . $this->b64url($sig);

            $res = Http::asForm()->post('https://oauth2.googleapis.com/token', [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion'  => $jwt,
            ]);

            return $res->json('access_token');
        });
    }

    private function report(array $body): ?array
    {
        $token = $this->getAccessToken();
        if (!$token) return null;

        $res = Http::withToken($token)
            ->post("https://analyticsdata.googleapis.com/v1beta/properties/{$this->propertyId}:runReport", $body);

        return $res->successful() ? $res->json() : null;
    }

    public function getSummary(): array
    {
        $res = $this->report([
            'dateRanges' => [
                ['startDate' => '7daysAgo',  'endDate' => 'today', 'name' => '7d'],
                ['startDate' => '30daysAgo', 'endDate' => 'today', 'name' => '30d'],
            ],
            'metrics' => [
                ['name' => 'activeUsers'],
                ['name' => 'sessions'],
                ['name' => 'bounceRate'],
                ['name' => 'screenPageViews'],
            ],
        ]);

        if (!$res) return [];

        $out = [];
        foreach ($res['rows'] ?? [] as $row) {
            $key  = $row['dimensionValues'][0]['value'] ?? null;
            $vals = $row['metricValues'] ?? [];
            $out[$key] = [
                'activeUsers' => (int)   ($vals[0]['value'] ?? 0),
                'sessions'    => (int)   ($vals[1]['value'] ?? 0),
                'bounceRate'  => round((float)($vals[2]['value'] ?? 0) * 100, 1),
                'pageViews'   => (int)   ($vals[3]['value'] ?? 0),
            ];
        }
        return $out;
    }

    public function getTopPages(int $limit = 8): array
    {
        $res = $this->report([
            'dateRanges' => [['startDate' => '30daysAgo', 'endDate' => 'today']],
            'dimensions' => [['name' => 'pagePath']],
            'metrics'    => [['name' => 'screenPageViews']],
            'orderBys'   => [['metric' => ['metricName' => 'screenPageViews'], 'desc' => true]],
            'limit'      => $limit,
        ]);

        return array_map(fn($r) => [
            'page'  => $r['dimensionValues'][0]['value'] ?? '/',
            'views' => (int)($r['metricValues'][0]['value'] ?? 0),
        ], $res['rows'] ?? []);
    }

    public function getTrafficSources(): array
    {
        $res = $this->report([
            'dateRanges' => [['startDate' => '30daysAgo', 'endDate' => 'today']],
            'dimensions' => [['name' => 'sessionDefaultChannelGrouping']],
            'metrics'    => [['name' => 'sessions']],
            'orderBys'   => [['metric' => ['metricName' => 'sessions'], 'desc' => true]],
            'limit'      => 6,
        ]);

        return array_map(fn($r) => [
            'source'   => $r['dimensionValues'][0]['value'] ?? 'Unknown',
            'sessions' => (int)($r['metricValues'][0]['value'] ?? 0),
        ], $res['rows'] ?? []);
    }

    public function getCountries(): array
    {
        $res = $this->report([
            'dateRanges' => [['startDate' => '30daysAgo', 'endDate' => 'today']],
            'dimensions' => [['name' => 'country']],
            'metrics'    => [['name' => 'sessions']],
            'orderBys'   => [['metric' => ['metricName' => 'sessions'], 'desc' => true]],
            'limit'      => 8,
        ]);

        return array_map(fn($r) => [
            'country'  => $r['dimensionValues'][0]['value'] ?? 'Unknown',
            'sessions' => (int)($r['metricValues'][0]['value'] ?? 0),
        ], $res['rows'] ?? []);
    }
}
