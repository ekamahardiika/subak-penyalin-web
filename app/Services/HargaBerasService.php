<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;

class HargaBerasService
{
    private const KOMODITAS = [
        1  => 'Beras Medium',
        3  => 'Beras Super',
        74 => 'Beras SPHP',
        75 => 'Beras Premium',
    ];

    /**
     * Cache data selama 3 jam.
     */
    private const CACHE_MINUTES = 480;

    /**
     * Maksimal request ke API SIGAPURA.
     */
    private const MAX_API_REQUESTS = 10;

    /**
     * Durasi rate limit dalam detik.
     */
    private const RATE_LIMIT_SECONDS = 60;

    public function get(?int $districtId = null): ?array
    {
        $cacheKey = 'harga_beras_sigapura_' . ($districtId ?? 'all');
        $lastGoodKey = $cacheKey . '_last_good';

        /*
        |--------------------------------------------------------------------------
        | 1. Cek cache utama
        |--------------------------------------------------------------------------
        |
        | Kalau data masih ada, langsung return.
        | Tidak ada request ke SIGAPURA.
        |
        */
        $cached = Cache::get($cacheKey);

        if ($cached !== null) {
            return $cached;
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Rate limit request ke SIGAPURA
        |--------------------------------------------------------------------------
        |
        | Maksimal 10 request dalam 1 menit.
        |
        */
        $rateLimitKey = 'sigapura-api-request';

        if (
            RateLimiter::tooManyAttempts(
                $rateLimitKey,
                self::MAX_API_REQUESTS
            )
        ) {
            return Cache::get($lastGoodKey);
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Tandai bahwa kita akan melakukan request API
        |--------------------------------------------------------------------------
        */
        RateLimiter::hit(
            $rateLimitKey,
            self::RATE_LIMIT_SECONDS
        );

        try {
            /*
            |--------------------------------------------------------------------------
            | 4. Request ke SIGAPURA
            |--------------------------------------------------------------------------
            */
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

            /*
            |--------------------------------------------------------------------------
            | 5. Kalau API gagal
            |--------------------------------------------------------------------------
            */
            if ($res->failed()) {
                return Cache::get($lastGoodKey);
            }

            /*
            |--------------------------------------------------------------------------
            | 6. Normalisasi response
            |--------------------------------------------------------------------------
            */
            $data = $this->normalize($res->json());

            /*
            |--------------------------------------------------------------------------
            | 7. Kalau tidak ada data valid
            |--------------------------------------------------------------------------
            */
            if (empty($data['items'])) {
                return Cache::get($lastGoodKey);
            }

            /*
            |--------------------------------------------------------------------------
            | 8. Simpan cache utama
            |--------------------------------------------------------------------------
            */
            Cache::put(
                $cacheKey,
                $data,
                now()->addMinutes(self::CACHE_MINUTES)
            );

            /*
            |--------------------------------------------------------------------------
            | 9. Simpan backup data terakhir yang valid
            |--------------------------------------------------------------------------
            |
            | Backup ini tidak memiliki expiration.
            |
            */
            Cache::forever(
                $lastGoodKey,
                $data
            );

            return $data;

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | 10. Kalau terjadi exception
            |--------------------------------------------------------------------------
            */
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

            /*
            |--------------------------------------------------------------------------
            | Ambil data harga yang valid
            |--------------------------------------------------------------------------
            */
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

            /*
            |--------------------------------------------------------------------------
            | Harga terbaru
            |--------------------------------------------------------------------------
            */
            $latest = $validPrices->first();

            $hargaSekarang = (float) $latest['avg_market_price'];
            $tanggalSekarang = $latest['input_date'];

            /*
            |--------------------------------------------------------------------------
            | Harga sebelumnya
            |--------------------------------------------------------------------------
            */
            $previous = $validPrices
                ->skip(1)
                ->first();

            $hargaSebelumnya = $previous
                ? (float) $previous['avg_market_price']
                : null;

            /*
            |--------------------------------------------------------------------------
            | Hitung perubahan
            |--------------------------------------------------------------------------
            */
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

            /*
            |--------------------------------------------------------------------------
            | Prioritaskan calculation dari API SIGAPURA
            |--------------------------------------------------------------------------
            */
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

            /*
            |--------------------------------------------------------------------------
            | Masukkan data
            |--------------------------------------------------------------------------
            */
            $items[] = [
                'id' => $commodityId,
                'nama' => self::KOMODITAS[$commodityId],
                'harga' => $hargaSekarang,
                'tanggal' => $tanggalSekarang,
                'selisih' => $selisih,
                'persen' => $persen,
            ];

            /*
            |--------------------------------------------------------------------------
            | Tentukan tanggal terbaru
            |--------------------------------------------------------------------------
            */
            if (
                $tanggal === null
                || $tanggalSekarang > $tanggal
            ) {
                $tanggal = $tanggalSekarang;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Urutkan berdasarkan ID komoditas
        |--------------------------------------------------------------------------
        */
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