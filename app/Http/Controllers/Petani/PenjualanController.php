<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\StockAllocation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        [$baseQuery, $startDate, $endDate] = $this->filteredQuery($request);

        $totalKg = (clone $baseQuery)->sum('stock_allocations.jumlah_kg');
        $totalPendapatan = (clone $baseQuery)->sum(DB::raw('stock_allocations.jumlah_kg * order_items.harga_satuan'));

        $penjualan = $baseQuery
            ->with(['orderItem.order', 'petaniStock.product'])
            ->orderByDesc('orders.tanggal_pesan')
            ->paginate(15)
            ->withQueryString();

        return view('petani.penjualan.index', compact(
            'penjualan', 'totalKg', 'totalPendapatan', 'startDate', 'endDate'
        ));
    }

    public function exportPdf(Request $request)
    {
        [$baseQuery, $startDate, $endDate] = $this->filteredQuery($request);

        $totalKg = (clone $baseQuery)->sum('stock_allocations.jumlah_kg');
        $totalPendapatan = (clone $baseQuery)->sum(DB::raw('stock_allocations.jumlah_kg * order_items.harga_satuan'));

        $penjualan = $baseQuery
            ->with(['orderItem.order', 'petaniStock.product'])
            ->orderByDesc('orders.tanggal_pesan')
            ->get();

        $namaPetani = Auth::user()->name;

        $pdf = Pdf::loadView('petani.penjualan.pdf', compact(
            'penjualan', 'totalKg', 'totalPendapatan', 'startDate', 'endDate', 'namaPetani'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('laporan-penjualan-saya-'.now()->format('Y-m-d').'.pdf');
    }

    private function filteredQuery(Request $request): array
    {
        $userId = Auth::id();

        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        $baseQuery = StockAllocation::query()
            ->select('stock_allocations.*')
            ->join('order_items', 'order_items.id', '=', 'stock_allocations.order_item_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('petani_stocks', 'petani_stocks.id', '=', 'stock_allocations.petani_stock_id')
            ->where('petani_stocks.user_id', $userId)
            ->where('orders.status', 'selesai')
            ->whereDate('orders.tanggal_pesan', '>=', $startDate)
            ->whereDate('orders.tanggal_pesan', '<=', $endDate);

        return [$baseQuery, $startDate, $endDate];
    }
}
