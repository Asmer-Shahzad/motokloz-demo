<?php

namespace App\Services\DistanceCalculation;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Geocoder using Nominatim (OpenStreetMap) API.
 * Works for ANY country worldwide — no static tables needed.
 * Results are cached for 30 days so the same postal code / city
 * never triggers a second HTTP call.
 */
class FsaCentroidGeocoder
{
    private const CACHE_TTL  = 60 * 60 * 24 * 30; // 30 days
    private const USER_AGENT = 'Motokloz/1.0 (motokloz.ca)';

    private const PROVINCE_BOUNDS = [
        'BC' => ['lat' => [48.3,  60.0],  'lng' => [-139.1, -114.0]],
        'AB' => ['lat' => [49.0,  60.0],  'lng' => [-120.0, -110.0]],
        'SK' => ['lat' => [49.0,  60.0],  'lng' => [-110.0, -101.4]],
        'MB' => ['lat' => [49.0,  60.0],  'lng' => [-102.0,  -88.9]],
        'ON' => ['lat' => [41.7,  56.9],  'lng' => [-95.2,  -74.3]],
        'QC' => ['lat' => [44.9,  62.6],  'lng' => [-79.8,  -57.1]],
        'NB' => ['lat' => [44.6,  48.1],  'lng' => [-69.1,  -63.8]],
        'NS' => ['lat' => [43.4,  47.0],  'lng' => [-66.3,  -59.7]],
        'PE' => ['lat' => [45.9,  47.1],  'lng' => [-64.5,  -61.9]],
        'NL' => ['lat' => [46.6,  60.4],  'lng' => [-67.8,  -52.6]],
        'NT' => ['lat' => [60.0,  78.6],  'lng' => [-136.5,  -60.0]],
        'NU' => ['lat' => [60.0,  83.1],  'lng' => [-95.2,  -61.0]],
        'YT' => ['lat' => [60.0,  69.7],  'lng' => [-141.0, -124.0]],
    ];

    // -------------------------------------------------------------------------
    // PUBLIC API
    // -------------------------------------------------------------------------

    /**
     * Resolve a postal/zip code to [lat, lng].
     * Works for Canada, USA, UK, Australia — any country Nominatim knows.
     */
    public function geocodePostalCode(string $postalCode, ?string $city = null, ?string $country = null): ?array
    {
        $clean = strtoupper(trim(preg_replace('/\s+/', '', $postalCode)));
        if ($clean === '') return null;

        $cacheKey = 'geocode_pc_' . md5($clean . '|' . strtolower($city ?? '') . '|' . strtolower($country ?? ''));

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($clean, $postalCode, $city, $country) {
            $cc = !empty($country) ? $this->resolveCountryCode($country) : null;

            // Attempt 1: postal + country + city
            $params = ['postalcode' => $clean];
            if ($cc)           $params['countrycodes'] = $cc;
            if (!empty($city)) $params['city']         = $city;
            $result = $this->nominatimSearch($params);
            if ($result) return $result;

            // Attempt 2: postal + country only
            if ($cc) {
                $result = $this->nominatimSearch(['postalcode' => $clean, 'countrycodes' => $cc]);
                if ($result) return $result;
            }

            // Attempt 3: free-text
            $q = $postalCode;
            if (!empty($city))    $q .= ', ' . $city;
            if (!empty($country)) $q .= ', ' . $country;
            return $this->nominatimSearch(['q' => $q]);
        });
    }

    /**
     * Resolve a city + province/state to [lat, lng].
     * Works worldwide.
     */
    public function geocodeCityProvince(string $city, string $province, ?string $country = null): ?array
    {
        $cacheKey = 'geocode_cp_' . md5(strtolower("$city|$province|" . ($country ?? '')));

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($city, $province, $country) {
            $cc = !empty($country) ? $this->resolveCountryCode($country) : null;

            // Attempt 1: structured
            $params = ['city' => $city, 'state' => $province];
            if ($cc) $params['countrycodes'] = $cc;
            $result = $this->nominatimSearch($params);
            if ($result) return $result;

            // Attempt 2: free-text
            $q = "$city, $province";
            if (!empty($country)) $q .= ', ' . $country;
            return $this->nominatimSearch(['q' => $q]);
        });
    }

    /**
     * Resolve GPS coordinates to a Canadian province abbreviation.
     */
    public function reverseGeocodeProvince(float $lat, float $lng): ?string
    {
        foreach (self::PROVINCE_BOUNDS as $province => $bounds) {
            if (
                $lat >= $bounds['lat'][0] && $lat <= $bounds['lat'][1] &&
                $lng >= $bounds['lng'][0] && $lng <= $bounds['lng'][1]
            ) {
                return $province;
            }
        }
        return null;
    }

    // -------------------------------------------------------------------------
    // PRIVATE HELPERS
    // -------------------------------------------------------------------------

    /**
     * Convert country name / alpha-3 / full name to ISO 3166-1 alpha-2.
     */
    private function resolveCountryCode(string $country): string
    {
        $c = strtoupper(trim($country));

        if (strlen($c) === 2) return strtolower($c);

        $map = [
            'CAN'                      => 'ca',
            'CANADA'                   => 'ca',
            'USA'                      => 'us',
            'US'                       => 'us',
            'UNITED STATES'            => 'us',
            'UNITED STATES OF AMERICA' => 'us',
            'GBR'                      => 'gb',
            'UK'                       => 'gb',
            'UNITED KINGDOM'           => 'gb',
            'GREAT BRITAIN'            => 'gb',
            'AUS'                      => 'au',
            'AUSTRALIA'                => 'au',
            'NZL'                      => 'nz',
            'NEW ZEALAND'              => 'nz',
            'DEU'                      => 'de',
            'GERMANY'                  => 'de',
            'FRA'                      => 'fr',
            'FRANCE'                   => 'fr',
            'ITA'                      => 'it',
            'ITALY'                    => 'it',
            'ESP'                      => 'es',
            'SPAIN'                    => 'es',
            'NLD'                      => 'nl',
            'NETHERLANDS'              => 'nl',
            'BEL'                      => 'be',
            'BELGIUM'                  => 'be',
            'CHE'                      => 'ch',
            'SWITZERLAND'              => 'ch',
            'AUT'                      => 'at',
            'AUSTRIA'                  => 'at',
            'SWE'                      => 'se',
            'SWEDEN'                   => 'se',
            'NOR'                      => 'no',
            'NORWAY'                   => 'no',
            'DNK'                      => 'dk',
            'DENMARK'                  => 'dk',
            'FIN'                      => 'fi',
            'FINLAND'                  => 'fi',
            'POL'                      => 'pl',
            'POLAND'                   => 'pl',
            'PRT'                      => 'pt',
            'PORTUGAL'                 => 'pt',
            'IRL'                      => 'ie',
            'IRELAND'                  => 'ie',
            'MEX'                      => 'mx',
            'MEXICO'                   => 'mx',
            'BRA'                      => 'br',
            'BRAZIL'                   => 'br',
            'ARG'                      => 'ar',
            'ARGENTINA'                => 'ar',
            'JPN'                      => 'jp',
            'JAPAN'                    => 'jp',
            'CHN'                      => 'cn',
            'CHINA'                    => 'cn',
            'IND'                      => 'in',
            'INDIA'                    => 'in',
            'ZAF'                      => 'za',
            'SOUTH AFRICA'             => 'za',
        ];

        return $map[$c] ?? strtolower(substr($c, 0, 2));
    }

    /**
     * Call Nominatim search API.
     * Returns [lat, lng] on success, null on failure.
     */
    private function nominatimSearch(array $params): ?array
    {
        try {
            $response = Http::timeout(5)
                ->withHeaders(['User-Agent' => self::USER_AGENT])
                ->get('https://nominatim.openstreetmap.org/search', array_merge($params, [
                    'format' => 'json',
                    'limit'  => 1,
                ]));

            if (!$response->successful()) {
                Log::warning('Nominatim HTTP error', ['status' => $response->status(), 'params' => $params]);
                return null;
            }

            $results = $response->json();

            if (empty($results) || !isset($results[0]['lat'], $results[0]['lon'])) {
                return null;
            }

            return [(float) $results[0]['lat'], (float) $results[0]['lon']];

        } catch (\Exception $e) {
            Log::warning('Nominatim geocoding failed', ['error' => $e->getMessage(), 'params' => $params]);
            return null;
        }
    }
}
