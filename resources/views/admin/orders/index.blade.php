@extends('layouts.app')

@section('title', 'Pesanan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Semua Pesanan Masuk</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola, konfirmasi pembayaran, dan pantau status logistik pengiriman gabah
            seluruh konsumen.</p>
    </div>

    <div x-data="{
        search: '',
        perPage: 10,
        currentPage: 1,
        orders: {{ \Illuminate\Support\Js::from(method_exists($orders, 'items') ? $orders->items() : $orders) }},
        get filteredOrders() {
            if (this.search.trim() === '') {
                return this.orders;
            }
            return this.orders.filter(o => {
                const consumerName = o.user && o.user.name ? o.user.name.toLowerCase() : 'konsumen tidak dikenal';
                return (o.no_order && o.no_order.toLowerCase().includes(this.search.toLowerCase())) ||
                    consumerName.includes(this.search.toLowerCase()) ||
                    (o.status && o.status.toLowerCase().includes(this.search.toLowerCase()));
            });
        },
        get totalPages() {
            return Math.ceil(this.filteredOrders.length / this.perPage) || 1;
        },
        get pagedOrders() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredOrders.slice(start, start + parseInt(this.perPage));
        },
        formatRupiah(value) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
        }
    }" x-init="$watch('search', () => currentPage = 1);
    $watch('perPage', () => currentPage = 1);" class="space-y-4">

        <div
            class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-4 rounded-xl border border-gray-100 shadow-xs">
            <div class="flex items-center gap-2 text-xs font-medium text-gray-500 w-full sm:w-auto">
                <span>Tampilkan</span>
                <div class="relative">
                    <select x-model="perPage"
                        class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-1.5 pl-3 pr-8 rounded-xl focus:outline-hidden focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
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
                <input type="text" x-model="search" placeholder="Cari No Order, Nama, Status..."
                    class="block w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs placeholder-gray-400 focus:outline-hidden focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3.5 font-bold">No Order</th>
                            <th scope="col" class="px-6 py-3.5 font-bold">Nama Konsumen</th>
                            <th scope="col" class="px-6 py-3.5 font-bold">Total Nilai</th>
                            <th scope="col" class="px-6 py-3.5 font-bold text-center">Status</th>
                            <th scope="col" class="px-6 py-3.5 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="o in pagedOrders" :key="o.id">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-mono font-bold text-emerald-950" x-text="o.no_order"></td>
                                <td class="px-6 py-4 font-medium text-gray-700"
                                    x-text="o.user ? o.user.name : 'Konsumen Tidak Dikenal'"></td>
                                <td class="px-6 py-4 font-bold text-gray-900" x-text="formatRupiah(o.total_harga)"></td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        :class="{
                                            'bg-emerald-50 text-emerald-700 border-emerald-200': ['selesai', 'success']
                                                .includes(o.status.toLowerCase()),
                                            'bg-amber-50 text-amber-700 border-amber-200': ['pending', 'menunggu']
                                                .includes(o.status.toLowerCase()),
                                            'bg-blue-50 text-blue-700 border-blue-200': ['dikonfirmasi', 'diproses']
                                                .includes(o.status.toLowerCase()),
                                            'bg-red-50 text-red-700 border-red-200': !['selesai', 'success', 'pending',
                                                'menunggu', 'dikonfirmasi', 'diproses'
                                            ].includes(o.status.toLowerCase())
                                        }"
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border uppercase tracking-wide"
                                        x-text="o.status">
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a :href="`{{ route('admin.orders.index') }}/${o.id}`"
                                        class="inline-flex items-center gap-1 bg-gray-50 hover:bg-emerald-50 hover:text-emerald-700 text-gray-600 font-bold px-3 py-1.5 rounded-lg text-xs border border-gray-200 hover:border-emerald-200 transition-all cursor-pointer">
                                        <i class="fa-solid fa-gear text-xs"></i> Kelola
                                    </a>
                                </td>
                            </tr>
                        </template>

                        <tr x-show="filteredOrders.length === 0">
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-inbox text-3xl text-gray-300"></i>
                                    <p class="text-sm">Belum ada pesanan masuk atau hasil tidak ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="filteredOrders.length > 0"
            class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 text-xs font-medium text-gray-500">
            <div>
                Menampilkan <span class="text-gray-800"
                    x-text="Math.min((currentPage - 1) * perPage + 1, filteredOrders.length)"></span>
                sampai <span class="text-gray-800" x-text="Math.min(currentPage * perPage, filteredOrders.length)"></span>
                dari <span class="text-gray-800" x-text="filteredOrders.length"></span> data
                <span x-show="search.trim() !== ''" class="text-emerald-600">(difilter dari total keseluruhan)</span>
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
@endsection
