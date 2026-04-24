<?php

namespace App\Services\DistanceCalculation;

/**
 * Resolves Canadian postal codes (FSA = first 3 chars) to lat/lng centroids.
 * Also resolves province from GPS coordinates using a bounding-box lookup.
 * No external API calls required.
 */
class FsaCentroidGeocoder
{
    /** Per-request cache: postal_code/city_province → [lat, lng] */
    private array $cache = [];

    // ---------------------------------------------------------------------------
    // FSA → Province mapping (first letter of FSA)
    // ---------------------------------------------------------------------------
    private const FSA_PROVINCE = [
        'A' => 'NL',
        'B' => 'NS',
        'C' => 'PE',
        'E' => 'NB',
        'G' => 'QC',
        'H' => 'QC',
        'J' => 'QC',
        'K' => 'ON',
        'L' => 'ON',
        'M' => 'ON',
        'N' => 'ON',
        'P' => 'ON',
        'R' => 'MB',
        'S' => 'SK',
        'T' => 'AB',
        'V' => 'BC',
        'X' => 'NT',
        'Y' => 'YT',
    ];

    // ---------------------------------------------------------------------------
    // Province bounding boxes for reverse-geocoding GPS → province
    // ---------------------------------------------------------------------------
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

    // ---------------------------------------------------------------------------
    // Approximate FSA centroids for common Canadian FSAs
    // This covers the major population centres. Unknown FSAs fall back to
    // province-centre coordinates derived from the first letter.
    // ---------------------------------------------------------------------------
    private const FSA_CENTROIDS = [
        // Ontario
        'M5V' => [43.6426, -79.3871],
        'M5H' => [43.6481, -79.3819],
        'M4W' => [43.6793, -79.3768],
        'M6G' => [43.6629, -79.4197],
        'L4W' => [43.6534, -79.6248],
        'L5N' => [43.5890, -79.7490],
        'K1A' => [45.4215, -75.6972],
        'K2P' => [45.4112, -75.6882],
        'N2L' => [43.4723, -80.5449],
        'N6A' => [42.9849, -81.2453],
        'L3R' => [43.8561, -79.3370],
        'L6T' => [43.7315, -79.7624],
        // British Columbia
        'V6B' => [49.2827, -123.1207],
        'V5K' => [49.2827, -123.0376],
        'V8W' => [48.4284, -123.3656],
        'V1Y' => [49.8880, -119.4960],
        'V2C' => [50.6745, -120.3273],
        'V3M' => [49.2057, -122.9024],
        // Alberta
        'T2P' => [51.0447, -114.0719],
        'T5J' => [53.5461, -113.4938],
        'T6G' => [53.5232, -113.5263],
        'T1J' => [49.6956, -112.8417],
        // Quebec
        'H2Y' => [45.5017, -73.5673],
        'H3A' => [45.5048, -73.5772],
        'G1R' => [46.8139, -71.2080],
        'J4H' => [45.4500, -73.4667],
        // Manitoba
        'R3C' => [49.8951, -97.1384],
        'R2C' => [49.9000, -97.0500],
        // Saskatchewan
        'S4P' => [50.4452, -104.6189],
        'S7K' => [52.1332, -106.6700],
        // Nova Scotia
        'B3H' => [44.6488, -63.5752],
        'B2N' => [45.8700, -64.3600],
        // New Brunswick
        'E3B' => [45.9636, -66.6431],
        'E1C' => [46.0878, -64.7782],
        // Newfoundland
        'A1C' => [47.5615, -52.7126],
        'A1B' => [47.5500, -52.7000],
        // PEI
        'C1A' => [46.2382, -63.1311],
        // Territories
        'X1A' => [62.4540, -114.3718],
        'Y1A' => [60.7212, -135.0568],
    ];

    // Province centre fallbacks (when FSA not in table)
    private const PROVINCE_CENTRES = [
        'NL' => [53.1355, -57.6604],
        'PE' => [46.5107, -63.4168],
        'NS' => [44.6820, -63.7443],
        'NB' => [46.5653, -66.4619],
        'QC' => [52.9399, -73.5491],
        'ON' => [51.2538, -85.3232],
        'MB' => [53.7609, -98.8139],
        'SK' => [52.9399, -106.4509],
        'AB' => [53.9333, -116.5765],
        'BC' => [53.7267, -127.6476],
        'YT' => [64.2823, -135.0000],
        'NT' => [64.8255, -124.8457],
        'NU' => [70.2998, -83.1076],
    ];

    /**
     * Resolve a Canadian postal code (or FSA) to [lat, lng].
     * Returns null if unresolvable.
     */
    public function geocodePostalCode(string $postalCode): ?array
    {
        $key = 'pc:' . strtoupper(trim($postalCode));
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }

        $clean = strtoupper(preg_replace('/\s+/', '', $postalCode));
        $fsa   = substr($clean, 0, 3);

        // Try exact FSA first
        if (isset(self::FSA_CENTROIDS[$fsa])) {
            return $this->cache[$key] = self::FSA_CENTROIDS[$fsa];
        }

        // Fall back to province centre from first letter
        $letter   = substr($fsa, 0, 1);
        $province = self::FSA_PROVINCE[$letter] ?? null;
        if ($province && isset(self::PROVINCE_CENTRES[$province])) {
            return $this->cache[$key] = self::PROVINCE_CENTRES[$province];
        }

        return $this->cache[$key] = null;
    }

    /**
     * Resolve a city + province string to [lat, lng].
     * Returns null if unresolvable.
     */
    public function geocodeCityProvince(string $city, string $province): ?array
    {
        $key = 'cp:' . strtolower($city) . ':' . strtolower($province);
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }

        $prov = strtoupper(trim($province));
        $result = isset(self::PROVINCE_CENTRES[$prov])
            ? self::PROVINCE_CENTRES[$prov]
            : null;

        return $this->cache[$key] = $result;
    }

    /**
     * Resolve GPS coordinates to a Canadian province abbreviation.
     * Returns null if outside all known bounds.
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
}