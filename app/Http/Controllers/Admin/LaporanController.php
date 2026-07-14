<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->filteredQuery($request);

        $totalPenjualan = (clone $query)->sum('total_harga');

        $orders = $query->latest('tanggal_pesan')->paginate(15)->withQueryString();

        return view('admin.laporan.index', compact('orders', 'totalPenjualan'));
    }

    public function exportPdf(Request $request)
    {
        $query = $this->filteredQuery($request);

        $totalPenjualan = (clone $query)->sum('total_harga');

        // Tidak dipaginate — PDF berisi seluruh data sesuai filter yang aktif
        $orders = $query->latest('tanggal_pesan')->get();

        $periode = [
            'start' => $request->input('start_date'),
            'end' => $request->input('end_date'),
        ];

        $pdf = Pdf::loadView('admin.laporan.pdf', compact('orders', 'totalPenjualan', 'periode'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-penjualan-'.now()->format('Y-m-d').'.pdf');
    }

    /**
     * Query dasar laporan penjualan (dipakai bareng oleh index() dan exportPdf()
     * supaya filter yang tampil di layar selalu sama persis dengan isi PDF).
     */
    private function filteredQuery(Request $request)
    {
        $query = Order::with('user', 'items.product')->where('status', 'selesai');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_pesan', [$request->start_date, $request->end_date]);
        }

        return $query;
    }
}
