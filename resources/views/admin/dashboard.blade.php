@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Dashboard Admin</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan data operasional sistem, kontrol pasokan stok, dan akumulasi omset
            platform.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mitra Petani</h3>
                <p class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $totalPetani }} <span
                        class="text-xs font-medium text-gray-400">Orang</span></p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl border border-emerald-100/70">
                <i class="fa-solid fa-users text-lg"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Stok Gabah</h3>
                <p class="text-2xl font-extrabold text-emerald-600 tracking-tight">
                    {{ number_format($totalStokGabah, 0, ',', '.') }} <span
                        class="text-xs font-medium text-gray-400">KG</span>
                </p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl border border-emerald-100/70">
                <i class="fa-solid fa-boxes-stacked text-lg"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Transaksi</h3>
                <p class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $totalTransaksi }} <span
                        class="text-xs font-medium text-gray-400">Kali</span></p>
            </div>
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl border border-emerald-100/70">
                <i class="fa-solid fa-receipt text-lg"></i>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-emerald-900 to-emerald-950 p-5 rounded-xl shadow-xs flex items-center justify-between text-white">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-emerald-300 uppercase tracking-wider">Omset Selesai</h3>
                <p class="text-xl font-black tracking-tight">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white/10 text-emerald-400 p-3 rounded-xl border border-white/10">
                <i class="fa-solid fa-wallet text-lg"></i>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

        <div class="lg:col-span-2 bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-bold text-gray-700 tracking-tight">Tren Pendapatan Bulanan ({{ date('Y') }})
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Grafik total nominal penjualan selesai per bulan.</p>
            </div>
            <div class="mt-4 relative h-64">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-bold text-gray-700 tracking-tight">Komposisi Pasokan Stok</h3>
                <p class="text-xs text-gray-400 mt-0.5">Perbandingan total jumlah stok per produk di gudang.</p>
            </div>
            <div class="mt-4 relative h-56 flex items-center justify-center">
                @if (count($chartProductLabels) > 0)
                    <canvas id="stockPieChart"></canvas>
                @else
                    <p class="text-xs text-gray-400">Belum ada data pasokan produk.</p>
                @endif
            </div>
        </div>

    </div>

    <div class="bg-white p-5 rounded-xl border border-gray-100 shadow-xs mt-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-sm font-bold text-gray-700 tracking-tight">5 Transaksi Terbaru</h3>
                <p class="text-xs text-gray-400 mt-0.5">Aktivitas pesanan konsumen masuk paling mutakhir.</p>
            </div>
            <a href="{{ route('admin.orders.index') }}"
                class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg transition-colors">
                Lihat Semua Pesanan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">No. Order</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Konsumen</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Total Harga</th>
                        <th class="p-3 text-xs font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50/40 transition-colors">
                            <td class="p-3 font-semibold text-gray-800">{{ $order->no_order }}</td>
                            <td class="p-3 text-gray-600">{{ $order->user->name ?? 'Umum/Anonim' }}</td>
                            <td class="p-3 text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-3 font-bold text-gray-900">Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="p-3 text-center">
                                @if ($order->status == 'pending')
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold bg-amber-50 text-amber-700 rounded-md border border-amber-100">Pending</span>
                                @elseif($order->status == 'selesai')
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700 rounded-md border border-emerald-100">Selesai</span>
                                @else
                                    <span
                                        class="px-2.5 py-1 text-xs font-semibold bg-gray-50 text-gray-600 rounded-md border border-gray-100">{{ $order->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-400 text-sm">Belum ada aktivitas transaksi
                                terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxSales = document.getElementById('salesChart').getContext('2d');
        new Chart(ctxSales, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Omset Bersih (Rp)',
                    data: @json($chartSalesData),
                    backgroundColor: 'rgba(16, 185, 129, 0.85)', 
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        const ctxStock = document.getElementById('stockPieChart');
        if (ctxStock) {
            new Chart(ctxStock, {
                type: 'doughnut',
                data: {
                    labels: @json($chartProductLabels),
                    datasets: [{
                        data: @json($chartProductData),
                        backgroundColor: [
                            '#047857', '#10b981', '#34d399', '#6ee7b7', '#a7f3d0'
                        ],
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
                                boxWidth: 12,
                                font: {
                                    size: 11
                                },
                                padding: 15
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        }
    </script>
@endsection
