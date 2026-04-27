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

    private function getAccessToken(): string
    {
        $cacheKey = 'ga4_token_' . md5($this->credentials['client_email'] ?? '');

        $cached = Cache::get($cacheKey);
        if ($cached) return $cached;

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
        if (!$privateKey) {
            throw new \RuntimeException('Invalid private key in service account JSON.');
        }

        openssl_sign($signInput, $sig, $privateKey, OPENSSL_ALGO_SHA256);
        $jwt = $signInput . '.' . $this->b64url($sig);

        $res   = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ]);
        $token = $res->json('access_token');

        if (!$token) {
            $err = $res->json('error_description') ?? $res->json('error') ?? 'unknown error';
            throw new \RuntimeException("Google OAuth failed: {$err}");
        }

        Cache::put($cacheKey, $token, 3300);
        return $token;
    }

    private function report(array $body): array
    {
        $token = $this->getAccessToken();

        $res = Http::withToken($token)
            ->post("https://analyticsdata.googleapis.com/v1beta/properties/{$this->propertyId}:runReport", $body);

        if (!$res->successful()) {
            $err = $res->json('error.message') ?? $res->json('error') ?? $res->status();
            throw new \RuntimeException("GA4 API error: {$err}");
        }

        return $res->json();
    }

    private function metricsFromRow(?array $row): array
    {
        $vals = $row['metricValues'] ?? [];
        return [
            'activeUsers' => (int)   ($vals[0]['value'] ?? 0),
            'sessions'    => (int)   ($vals[1]['value'] ?? 0),
            'bounceRate'  => round((float)($vals[2]['value'] ?? 0) * 100, 1),
            'pageViews'   => (int)   ($vals[3]['value'] ?? 0),
        ];
    }

    public function getSummary(): array
    {
        $metrics = [
            ['name' => 'activeUsers'],
            ['name' => 'sessions'],
            ['name' => 'bounceRate'],
            ['name' => 'screenPageViews'],
        ];

        $res30 = $this->report([
            'dateRanges' => [['startDate' => '30daysAgo', 'endDate' => 'today']],
            'metrics'    => $metrics,
        ]);
        $res7 = $this->report([
            'dateRanges' => [['startDate' => '7daysAgo', 'endDate' => 'today']],
            'metrics'    => $metrics,
        ]);

        return [
            '30d' => $this->metricsFromRow($res30['rows'][0] ?? null),
            '7d'  => $this->metricsFromRow($res7['rows'][0]  ?? null),
        ];
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
