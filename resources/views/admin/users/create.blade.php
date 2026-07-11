@extends('layouts.app')

@section('content')
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Konsumen
        </a>
    </div>

    <div class="w-full">
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Tambah Akun Konsumen Manual</h2>
                <p class="text-xs text-gray-500 mt-0.5">Daftarkan akun pembeli/konsumen baru secara manual ke dalam sistem
                    platform.</p>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4"
                @submit.prevent="$dispatch('open-confirm-modal', {
                    form: $el,
                    type: 'primary',
                    title: 'Simpan Akun Konsumen?',
                    message: 'Pastikan data yang Anda masukkan sudah benar sebelum disimpan.',
                    confirmLabel: 'Ya, Simpan'
                })">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" name="name" required placeholder="Nama lengkap konsumen"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-regular fa-user text-sm"></i>
                        </span>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
                    <div class="relative">
                        <input type="email" name="email" required placeholder="konsumen@email.com"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-regular fa-envelope text-sm"></i>
                        </span>
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Telepon /
                        WA</label>
                    <div class="relative">
                        <input type="text" name="phone" placeholder="Contoh: 08234567890"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-phone text-sm"></i>
                        </span>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" required placeholder="••••••••"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                        Simpan Akun Konsumen <i class="fa-solid fa-user-plus text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
