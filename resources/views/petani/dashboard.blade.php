@extends('layouts.app')

@section('title', 'Dashboard Petani')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Panel Kerja Petani</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau pasokan komoditas gabah serta aktivitas penjualan Anda secara berkala.</p>
    </div>

    {{-- KARTU STATISTIK (1 BARIS TERDIRI DARI 3 CARD) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Card 1: Total Stok --}}
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Akumulasi Total Stok Anda</h3>
                <p class="text-2xl font-extrabold text-emerald-600 tracking-tight">
                    {{ number_format($totalStokSaya, 2, ',', '.') }} <span
                        class="text-sm font-semibold text-gray-500">KG</span>
                </p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3.5 rounded-xl border border-emerald-100 shrink-0">
                <i class="fa-solid fa-boxes-stacked text-xl"></i>
            </div>
        </div>

        {{-- Card 2: Terjual Bulan Ini --}}
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Terjual Bulan Ini</h3>
                <p class="text-2xl font-extrabold text-sky-600 tracking-tight">
                    {{ number_format($totalTerjualKgBulanIni, 2, ',', '.') }} <span
                        class="text-sm font-semibold text-gray-500">KG</span>
                </p>
            </div>
            <div class="bg-sky-50 text-sky-600 p-3.5 rounded-xl border border-sky-100 shrink-0">
                <i class="fa-solid fa-truck-ramp-box text-xl"></i>
            </div>
        </div>

        {{-- Card 3: Pendapatan Bulan Ini --}}
        <div
            class="bg-gradient-to-br from-violet-50 to-violet-100/40 p-6 rounded-xl border border-violet-200/70 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-violet-800 uppercase tracking-wider">Pendapatan Bulan Ini</h3>
                <p class="text-2xl font-extrabold text-violet-950 tracking-tight">
                    Rp {{ number_format($totalPendapatanBulanIni, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-violet-800/80 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-circle-info text-[9px]"></i> Pesanan selesai
                </p>
            </div>
            <div class="bg-white text-violet-600 p-3.5 rounded-xl border border-violet-200/50 shadow-xs shrink-0">
                <i class="fa-solid fa-sack-dollar text-xl"></i>
            </div>
        </div>

    </div>

    <div class="mt-3 text-right">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-gray-100 shadow-xs">
            <h3 class="text-sm font-bold text-gray-700 tracking-tight mb-3">Rincian Stok Gabah Anda</h3>
            <div class="divide-y divide-gray-100">
                @forelse($stokPerProduk as $stok)
                    <div class="flex justify-between items-center py-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 shrink-0 border border-gray-100 flex items-center justify-center">
                                @if (!empty($stok->product->gambar) && file_exists(public_path('storage/' . $stok->product->gambar)))
                                    <img src="{{ asset('storage/' . $stok->product->gambar) }}"
                                        alt="{{ $stok->product->nama_produk ?? 'Produk' }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="bg-gray-50 text-gray-500 w-full h-full flex items-center justify-center text-sm">
                                        <i class="fa-solid fa-seedling"></i>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $stok->product->nama_produk ?? 'Produk Tanpa Nama' }}
                                </p>
                                <p class="text-xs text-gray-400">Terakhir diupdate:
                                    {{ $stok->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($stok->stok_kg, 0, ',', '.') }} KG</p>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 py-4 text-center">Anda belum mendaftarkan komoditas apapun.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-bold text-gray-700 tracking-tight">Persentase Kepemilikan Stok</h3>
                <p class="text-xs text-gray-400 mt-0.5">Proporsi pembagian jenis stok yang Anda simpan.</p>
            </div>
            <div class="mt-4 relative h-48 flex items-center justify-center">
                @if (count($chartLabels) > 0)
                    <canvas id="petaniStockChart"></canvas>
                @else
                    <p class="text-xs text-gray-400">Belum ada data distribusi stok.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs mt-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-sm font-bold text-gray-700 tracking-tight">Aktivitas Pembaruan Stok Terakhir</h3>
                <p class="text-xs text-gray-400 mt-0.5">Log logistik perubahan jumlah pasokan gabah Anda.</p>
            </div>
            <a href="{{ route('petani.stok.index') }}"
                class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg transition-colors">
                Kelola Stok Saya
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Komoditas Gabah</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Jumlah Terkini</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Waktu Update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($riwayatStok as $log)
                        <tr class="hover:bg-gray-50/40 transition-colors">
                            <td class="p-3 font-semibold text-gray-800">{{ $log->product->nama_produk ?? '-' }}</td>
                            <td class="p-3 font-bold text-emerald-600">{{ number_format($log->stok_kg, 0, ',', '.') }} KG
                            </td>
                            <td class="p-3 text-gray-500">{{ $log->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-400 text-sm">Belum ada riwayat aktivitas
                                stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxPetaniStock = document.getElementById('petaniStockChart');
        if (ctxPetaniStock) {
            new Chart(ctxPetaniStock, {
                type: 'doughnut',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        data: @json($chartData),
                        backgroundColor: ['#059669', '#34d399', '#6ee7b7', '#10b981', '#a7f3d0'],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 10,
                                font: {
                                    size: 10
                                },
                                padding: 10
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    </script>
@endsection
