@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Manajemen Stok Gabah Mandiri</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola pasokan hasil panen gabah Anda ke dalam gudang alokasi pesanan konsumen.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

        <!-- DAFTAR STOK (KIRI) -->
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs md:col-span-2 md:order-1">
            <div class="mb-4">
                <h2 class="font-bold text-gray-900 text-base">Daftar Stok Gabah di Gudang</h2>
                <p class="text-xs text-gray-400 mt-0.5">Sisa stok aktif mandiri Anda yang siap dialokasikan untuk pesanan.
                    Klik salah satu produk untuk melihat detail dan koreksi jumlah.</p>
            </div>

            <div class="space-y-3">
                @forelse($stocks as $stock)
                    <a href="{{ route('petani.stok.edit', $stock->id) }}"
                        class="p-4 bg-gray-50/70 border border-gray-100 rounded-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-all hover:border-emerald-200 hover:bg-emerald-50/40 group cursor-pointer">
                        <div class="flex items-center gap-3.5">
                            <div class="bg-emerald-50 text-emerald-600 p-2.5 rounded-xl border border-emerald-100">
                                <i class="fa-solid fa-wheat-awn text-sm"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm group-hover:text-emerald-700 transition-colors">
                                    {{ $stock->product->nama_produk ?? 'Varietas Gabah' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">Sisa Siap Alokasi: <span
                                        class="text-emerald-600 font-bold">{{ number_format($stock->stok_kg, 2, ',', '.') }}
                                        KG</span>
                                </p>
                            </div>
                        </div>

                        <span
                            class="inline-flex items-center gap-1.5 bg-white hover:bg-emerald-600 hover:text-white text-emerald-700 font-bold px-3 py-1.5 rounded-lg text-xs border border-emerald-200/60 transition-all w-fit shrink-0">
                            <i class="fa-regular fa-pen-to-square text-xs"></i> Koreksi
                        </span>
                    </a>
                @empty
                    <div class="py-8 text-center text-gray-400 flex flex-col items-center justify-center space-y-2">
                        <i class="fa-solid fa-box-open text-3xl text-gray-300"></i>
                        <p class="text-xs">Anda belum menyetor pasokan produk apa pun.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- SETOR PASOKAN (KANAN) -->
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs md:order-2">
            <div class="mb-4">
                <h2 class="font-bold text-gray-900 text-base">Setor Pasokan</h2>
                <p class="text-xs text-gray-400 mt-0.5">Tambahkan kuantitas panen baru.</p>
            </div>

            <form action="{{ route('petani.stok.store') }}" method="POST" x-data="{
                productName(id) {
                    const opts = { @foreach ($products as $p) {{ $p->id }}: @js($p->nama_produk), @endforeach };
                    return opts[id] || 'produk terpilih';
                }
            }"
                @submit.prevent="$dispatch('open-confirm-modal', {
                    form: $el,
                    title: 'Setor Tambahan Stok?',
                    message: `Kuantitas panen sebesar ${$el.stok_kg.value || 0} KG untuk varietas '${productName($el.product_id.value)}' akan ditambahkan ke gudang stok Anda.`,
                    confirmLabel: 'Ya, Setor Sekarang',
                    type: 'primary'
                })"
                class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Varietas
                        Komoditas</label>
                    <div class="relative">
                        <select name="product_id" required
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs appearance-none cursor-pointer">
                            @foreach ($products as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_produk }} (Rp
                                    {{ number_format($p->harga_jual, 0, ',', '.') }})</option>
                            @endforeach
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Jumlah Kuantitas
                        (KG)</label>
                    <div class="relative">
                        <input type="number" step="0.01" name="stok_kg" required
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                            min="0" placeholder="0.00" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 font-bold text-xs pointer-events-none">
                            KG
                        </span>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                        Setor Tambah Stok <i class="fa-solid fa-plus text-xs"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
