<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

class HargaBerasService
{
    private const KOMODITAS = [
        1  => 'Gabah Medium',
        3  => 'Gabah Super',
        74 => 'Gabah SPHP',
        75 => 'Gabah Premium',
    ];

    private const CACHE_MINUTES = 480;

    private const MAX_API_REQUESTS = 10;

    private const RATE_LIMIT_SECONDS = 60;

    public function get(?int $districtId = null): ?array
    {
        $cacheKey = 'harga_gabah_sigapura_' . ($districtId ?? 'all');
        $lastGoodKey = $cacheKey . '_last_good';

        $cached = Cache::get($cacheKey);

        if ($cached !== null) {
            return $cached;
        }

        $rateLimitKey = 'sigapura-api-request';

        if (
            RateLimiter::tooManyAttempts(
                $rateLimitKey,
                self::MAX_API_REQUESTS
            )
        ) {
            return Cache::get($lastGoodKey);
        }

        RateLimiter::hit(
            $rateLimitKey,
            self::RATE_LIMIT_SECONDS
        );

        try {
            $res = Http::timeout(10)
                ->retry(
                    1,
                    500,
                    throw: false
                )
                ->acceptJson()
                ->get(
                    config('services.sigapura.url') . '/market-price-change-average',
                    [
                        'commodities' => implode(',', array_keys(self::KOMODITAS)),
                        'mart_type' => 'tradisional',
                        'district_id' => $districtId ?? '',
                        'start_date' => now()
                            ->subDays(6)
                            ->toDateString(),
                        'end_date' => now()
                            ->toDateString(),
                    ]
                );

            if ($res->failed()) {
                return Cache::get($lastGoodKey);
            }

            $data = $this->normalize($res->json());

            if (empty($data['items'])) {
                return Cache::get($lastGoodKey);
            }

            Cache::put(
                $cacheKey,
                $data,
                now()->addMinutes(self::CACHE_MINUTES)
            );

            Cache::forever(
                $lastGoodKey,
                $data
            );

            return $data;

        } catch (\Throwable $e) {
            report($e);
            return Cache::get($lastGoodKey);
        }
    }

    private function normalize(array $json): array
    {
        $items = [];
        $tanggal = null;

        $rows = data_get($json, 'data', []);

        if (!is_array($rows)) {
            return [
                'items' => [],
                'tanggal' => null,
            ];
        }

        foreach ($rows as $row) {

            $commodityId = data_get(
                $row,
                'commodity.id'
            );

            if (!isset(self::KOMODITAS[$commodityId])) {
                continue;
            }

            $prices = data_get(
                $row,
                'market_price_data.market_price',
                []
            );

            if (!is_array($prices) || empty($prices)) {
                continue;
            }
            $validPrices = collect($prices)
                ->filter(function ($price) {

                    return is_array($price)
                        && isset($price['avg_market_price'])
                        && isset($price['input_date'])
                        && $price['avg_market_price'] !== null
                        && $price['input_date'] !== null;
                })
                ->sortByDesc(function ($price) {

                    return $price['input_date'];
                })
                ->values();

            if ($validPrices->isEmpty()) {
                continue;
            }

            $latest = $validPrices->first();
            $hargaSekarang = (float) $latest['avg_market_price'];
            $tanggalSekarang = $latest['input_date'];

            $previous = $validPrices
                ->skip(1)
                ->first();

            $hargaSebelumnya = $previous
                ? (float) $previous['avg_market_price']
                : null;

            $selisih = 0;
            $persen = 0;

            if (
                $hargaSebelumnya !== null
                && $hargaSebelumnya > 0
            ) {
                $selisih = $hargaSekarang - $hargaSebelumnya;

                $persen = (
                    $selisih / $hargaSebelumnya
                ) * 100;
            }

            $apiSelisih = data_get(
                $row,
                'market_price_data.calculation.difference_amount'
            );

            $apiPersen = data_get(
                $row,
                'market_price_data.calculation.difference_percentage'
            );

            if (
                $apiSelisih !== null
                && $apiSelisih !== ''
            ) {
                $selisih = (float) $apiSelisih;
            }

            if (
                $apiPersen !== null
                && $apiPersen !== ''
            ) {
                $persen = (float) $apiPersen;
            }

            $items[] = [
                'id' => $commodityId,
                'nama' => self::KOMODITAS[$commodityId],
                'harga' => $hargaSekarang,
                'tanggal' => $tanggalSekarang,
                'selisih' => $selisih,
                'persen' => $persen,
            ];

            if (
                $tanggal === null
                || $tanggalSekarang > $tanggal
            ) {
                $tanggal = $tanggalSekarang;
            }
        }

        usort(
            $items,
            fn ($a, $b) => $a['id'] <=> $b['id']
        );

        return [
            'items' => $items,
            'tanggal' => $tanggal,
        ];
    }
}