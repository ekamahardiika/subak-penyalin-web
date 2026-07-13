@extends('layouts.landing')

@section('content')
    <div class="bg-emerald-950 pt-32 pb-16 text-center text-white">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-extrabold">Informasi Harga Acuan Gabah</h1>
            <p class="text-emerald-300 text-sm mt-2">
                Patokan harga gabah harian disiarkan secara terbuka demi transparansi petani dan konsumen.
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-16 space-y-8">

        {{-- Harga acuan terbaru --}}
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100">
            @if ($hargaTerbaru)
                <span class="text-emerald-600 text-xs font-bold uppercase tracking-wider">Harga Berlaku Saat Ini</span>
                <p class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2 tracking-tight">
                    Rp {{ number_format($hargaTerbaru->harga_gabah, 0, ',', '.') }}
                    <span class="text-base font-semibold text-gray-400">/ KG</span>
                </p>
                <p class="text-xs text-gray-400 mt-2">
                    Berlaku sejak {{ \Illuminate\Support\Carbon::parse($hargaTerbaru->tanggal)->translatedFormat('d F Y') }}
                </p>
                @if ($hargaTerbaru->keterangan)
                    <p class="text-sm text-gray-500 leading-relaxed mt-4">{{ $hargaTerbaru->keterangan }}</p>
                @endif
            @else
                <p class="text-sm text-gray-400 text-center py-4">Belum ada informasi harga yang dirilis.</p>
            @endif
        </div>

        {{-- Grafik tren harga --}}
        @if (count($chartData) > 1)
            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100">
                <span class="text-emerald-600 text-xs font-bold uppercase tracking-wider">Grafik</span>
                <h2 class="text-2xl font-extrabold text-gray-900 mt-1 mb-6">Tren Harga Acuan (30 Rilis Terakhir)</h2>
                <div class="h-64">
                    <canvas id="hargaTrendChart"></canvas>
                </div>
            </div>
        @endif

        {{-- Riwayat lengkap: search + pagination --}}
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100" x-data="{
            search: '',
            perPage: 10,
            currentPage: 1,
            riwayat: {{ \Illuminate\Support\Js::from($riwayat) }},
        
            get filteredRiwayat() {
                if (this.search.trim() === '') return this.riwayat;
        
                return this.riwayat.filter(h => {
                    const ket = h.keterangan ? h.keterangan.toLowerCase() : '';
                    const tgl = h.tanggal ? h.tanggal.toLowerCase() : '';
                    const hrg = h.harga_gabah ? h.harga_gabah.toString() : '';
        
                    return ket.includes(this.search.toLowerCase()) ||
                        tgl.includes(this.search.toLowerCase()) ||
                        hrg.includes(this.search.toLowerCase());
                });
            },
        
            get totalPages() {
                return Math.ceil(this.filteredRiwayat.length / this.perPage) || 1;
            },
        
            get pagedRiwayat() {
                const start = (this.currentPage - 1) * this.perPage;
                return this.filteredRiwayat.slice(start, start + parseInt(this.perPage));
            },
        
            formatTanggal(dateString) {
                if (!dateString) return '-';
                const options = { day: 'numeric', month: 'short', year: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            },
        
            formatRupiah(value) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
            }
        }"
            x-init="$watch('search', () => currentPage = 1);
            $watch('perPage', () => currentPage = 1);">

            <span class="text-emerald-600 text-xs font-bold uppercase tracking-wider">Arsip</span>
            <h2 class="text-2xl font-extrabold text-gray-900 mt-1 mb-6">Riwayat Broadcast Harga</h2>

            <div
                class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100 mb-4">
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500 w-full sm:w-auto">
                    <span>Tampilkan</span>
                    <div class="relative">
                        <select x-model="perPage"
                            class="appearance-none bg-white border border-gray-200 text-gray-700 py-1.5 pl-3 pr-8 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </span>
                    </div>
                    <span>data</span>
                </div>

                <div class="relative w-full sm:w-72">
                    <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" x-model="search" placeholder="Cari tanggal, harga, keterangan..."
                        class="block w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-xs placeholder-gray-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead
                            class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 font-bold">Tanggal</th>
                                <th scope="col" class="px-6 py-3.5 font-bold">Harga Acuan / KG</th>
                                <th scope="col" class="px-6 py-3.5 font-bold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="h in pagedRiwayat" :key="h.id">
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-gray-900" x-text="formatTanggal(h.tanggal)">
                                    </td>
                                    <td class="px-6 py-4 font-bold text-emerald-600" x-text="formatRupiah(h.harga_gabah)">
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 max-w-xs truncate" x-text="h.keterangan || '-'"></td>
                                </tr>
                            </template>

                            <tr x-show="filteredRiwayat.length === 0">
                                <td colspan="3" class="px-6 py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <i class="fa-solid fa-wheat-awn text-3xl text-gray-300"></i>
                                        <p class="text-sm">Belum ada riwayat harga yang cocok atau tercatat.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div x-show="filteredRiwayat.length > 0"
                class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 text-xs font-medium text-gray-500">
                <div>
                    Menampilkan
                    <span class="text-gray-800"
                        x-text="Math.min((currentPage - 1) * perPage + 1, filteredRiwayat.length)"></span>
                    sampai
                    <span class="text-gray-800" x-text="Math.min(currentPage * perPage, filteredRiwayat.length)"></span>
                    dari
                    <span class="text-gray-800" x-text="filteredRiwayat.length"></span> data
                </div>

                <div class="flex items-center gap-1">
                    <button @click="currentPage = 1" :disabled="currentPage === 1"
                        class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                        <i class="fa-solid fa-angles-left text-[10px]"></i>
                    </button>
                    <button @click="currentPage--" :disabled="currentPage === 1"
                        class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                        <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    </button>
                    <span class="px-3 py-1 bg-gray-50 border border-gray-200 text-gray-700 rounded-lg font-bold">
                        Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
                    </span>
                    <button @click="currentPage++" :disabled="currentPage === totalPages"
                        class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </button>
                    <button @click="currentPage = totalPages" :disabled="currentPage === totalPages"
                        class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                        <i class="fa-solid fa-angles-right text-[10px]"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>

    @if (count($chartData) > 1)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctxHargaTrend = document.getElementById('hargaTrendChart');
            if (ctxHargaTrend) {
                new Chart(ctxHargaTrend, {
                    type: 'line',
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                            label: 'Harga Acuan (Rp/KG)',
                            data: @json($chartData),
                            borderColor: '#059669',
                            backgroundColor: 'rgba(5, 150, 105, 0.1)',
                            fill: true,
                            tension: 0.3,
                            pointBackgroundColor: '#059669',
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
                                ticks: {
                                    callback: (value) => 'Rp ' + new Intl.NumberFormat('id-ID').format(value)
                                }
                            }
                        }
                    }
                });
            }
        </script>
    @endif
@endsection
