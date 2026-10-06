<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HargaBerasService
{
    /**
     * ID komoditas SIGAPURA => nama yang ditampilkan
     */
    private const KOMODITAS = [
        1  => 'Beras Medium',
        3  => 'Beras Super',
        74 => 'Beras SPHP',
        75 => 'Beras Premium',
    ];

    public function get(?int $districtId = null): ?array
    {
        $cacheKey = 'harga_beras_sigapura_' . ($districtId ?? 'all');

        return Cache::remember(
            $cacheKey,
            now()->addHours(3),
            function () use ($districtId, $cacheKey) {

                try {

                    $res = Http::timeout(10)
                        ->retry(2, 300)
                        ->acceptJson()
                        ->get(
                            config('services.sigapura.url') . '/market-price-change-average',
                            [
                                'commodities' => implode(
                                    ',',
                                    array_keys(self::KOMODITAS)
                                ),

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
                    | API gagal
                    |--------------------------------------------------------------------------
                    */

                    if ($res->failed()) {
                        return Cache::get(
                            $cacheKey . '_last_good'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Normalisasi
                    |--------------------------------------------------------------------------
                    */

                    $data = $this->normalize(
                        $res->json()
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | Tidak ada data
                    |--------------------------------------------------------------------------
                    */

                    if (empty($data['items'])) {
                        return Cache::get(
                            $cacheKey . '_last_good'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Simpan data terakhir yang valid
                    |--------------------------------------------------------------------------
                    */

                    Cache::forever(
                        $cacheKey . '_last_good',
                        $data
                    );

                    return $data;

                } catch (\Throwable $e) {

                    report($e);

                    return Cache::get(
                        $cacheKey . '_last_good'
                    );
                }
            }
        );
    }

    /**
     * Normalisasi response SIGAPURA.
     */
    private function normalize(array $json): array
    {
        $items = [];

        $tanggal = null;

        $rows = data_get(
            $json,
            'data',
            []
        );

        if (!is_array($rows)) {
            return [
                'items' => [],
                'tanggal' => null,
            ];
        }

        foreach ($rows as $row) {

            /*
            |--------------------------------------------------------------------------
            | ID komoditas
            |--------------------------------------------------------------------------
            */

            $commodityId = data_get(
                $row,
                'commodity.id'
            );

            if (!isset(self::KOMODITAS[$commodityId])) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Data harga
            |--------------------------------------------------------------------------
            */

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
            | Ambil semua harga yang valid
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
            |
            | Kita ambil data harga sebelum harga terbaru.
            |
            */

            $previous = $validPrices->skip(1)->first();

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
            | Kalau API punya calculation,
            | gunakan nilai API jika tersedia.
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

            /*
            |--------------------------------------------------------------------------
            | API calculation valid
            |--------------------------------------------------------------------------
            */

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
            | Tambahkan item
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
            | Tanggal terbaru
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