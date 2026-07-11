@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.harga.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Riwayat Broadcast
        </a>
    </div>

    <div class="w-full">
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Buat Broadcast Harga Gabah</h2>
                <p class="text-xs text-gray-500 mt-0.5">Informasikan acuan patokan harga pasar harian kepada seluruh mitra
                    petani dan konsumen.</p>
            </div>

            <form action="{{ route('admin.harga.store') }}" method="POST" class="space-y-5"
                @submit.prevent="$dispatch('open-confirm-modal', {
                    form: $el,
                    type: 'primary',
                    title: 'Siarkan Informasi Harga?',
                    message: 'Patokan harga gabah harian baru ini akan segera disebarkan ke semua mitra dan konsumen.',
                    confirmLabel: 'Ya, Siarkan'
                })">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Tanggal
                        Berlaku</label>
                    <div class="relative">
                        <input type="date" name="tanggal" required
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Harga Gabah Acuan
                        (Rp/KG)</label>
                    <div class="relative">
                        <input type="number" name="harga_gabah" required min="0" placeholder="Contoh: 7500"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 font-semibold text-xs pointer-events-none">
                            IDR / KG
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Keterangan / Catatan
                        Tambahan</label>
                    <textarea name="keterangan" rows="3"
                        placeholder="Contoh: Kenaikan harga mengikuti acuan regulasi Bapanas terbaru."
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                        Simpan & Siarkan Informasi <i class="fa-solid fa-bullhorn text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
