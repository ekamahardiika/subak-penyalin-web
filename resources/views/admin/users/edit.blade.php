@extends('layouts.app')

@section('title', 'Edit Konsumen')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center gap-1 text-xs font-semibold text-gray-400 hover:text-emerald-600 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Konsumen
        </a>
    </div>

    <div class="w-full">
        <div class="bg-white p-6 border border-gray-100 rounded-xl shadow-xs">
            <div class="mb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Edit Akun Konsumen</h2>
                <p class="text-xs text-gray-500 mt-0.5">Perbarui kredensial data profil atau atur ulang kata sandi milik
                    konsumen terdaftar.</p>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4"
                @submit.prevent="$dispatch('open-confirm-modal', {
                    form: $el,
                    type: 'primary',
                    title: 'Perbarui Data Konsumen?',
                    message: 'Perubahan akan langsung disimpan ke akun konsumen ini.',
                    confirmLabel: 'Ya, Perbarui'
                })">
                @csrf
                @method('PUT')

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" name="name" value="{{ $user->name }}" required
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
                        <input type="email" name="email" value="{{ $user->email }}" required
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
                        <input type="text" name="phone" value="{{ $user->phone }}"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-phone text-sm"></i>
                        </span>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Ganti Kata
                        Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah"
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
                        Perbarui Data Konsumen <i class="fa-solid fa-user-check text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
