<?php

namespace App\Http\Controllers;

use App\Models\HargaBroadcast;
use App\Models\Product;
use App\Services\HargaBerasService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class LandingController extends Controller
{
    public function home(HargaBerasService $hargaBeras)
    {
        $products = Product::where('status', 'aktif')
            ->take(6)
            ->get();

        $riwayat = HargaBroadcast::orderByDesc('tanggal')->get();

        $hargaTerbaru = $riwayat->first();

        $riwayatUntukGrafik = $riwayat
            ->take(30)
            ->sortBy('tanggal')
            ->values();

        $chartLabels = $riwayatUntukGrafik
            ->map(fn ($h) => Carbon::parse($h->tanggal)->translatedFormat('d M'))
            ->toArray();

        $chartData = $riwayatUntukGrafik
            ->pluck('harga_gabah')
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Daftar Kabupaten / Kota
        |--------------------------------------------------------------------------
        */

        $districtResponse = Http::timeout(5)
            ->acceptJson()
            ->get(
                config('services.sigapura.url') . '/district'
            );

        $districts = $districtResponse->successful()
            ? $districtResponse->json('data', [])
            : [];

        /*
        |--------------------------------------------------------------------------
        | Kabupaten yang dipilih
        |--------------------------------------------------------------------------
        */

        $selectedDistrict = request()->integer('district_id') ?: null;

        /*
        |--------------------------------------------------------------------------
        | Harga Beras
        |--------------------------------------------------------------------------
        */

        $hargaApi = $hargaBeras->get($selectedDistrict);

        /*
        |--------------------------------------------------------------------------
        | AJAX Request
        |--------------------------------------------------------------------------
        |
        | Jika request berasal dari JavaScript, kita hanya mengembalikan
        | HTML bagian harga. Halaman tidak perlu di-render ulang.
        |
        */

        if (request()->ajax()) {
            return view('landing.partials.harga-acuan', compact(
                'hargaApi',
                'hargaTerbaru'
            ));
        }

        return view('landing.home', compact(
            'products',
            'riwayat',
            'hargaTerbaru',
            'chartLabels',
            'chartData',
            'hargaApi',
            'districts',
            'selectedDistrict'
        ));
    }
}