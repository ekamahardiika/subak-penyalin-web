@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Pengaturan Profil Saya</h1>
        <p class="text-sm text-gray-500 mt-0.5">Kelola informasi data diri, keamanan kata sandi, dan kontrol privasi akun
            Anda.</p>
    </div>

    @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
        <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="mb-6 flex items-center justify-between p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl shadow-xs">
            <div class="flex items-center gap-2.5 text-xs font-semibold">
                <i class="fa-solid fa-circle-check text-base text-emerald-600"></i>
                <span>
                    @if (session('status') === 'profile-updated')
                        Perubahan informasi profil Anda telah berhasil disimpan.
                    @else
                        Kata sandi akun Anda telah berhasil diperbarui.
                    @endif
                </span>
            </div>
            <button @click="show = false"
                class="text-emerald-500 hover:text-emerald-700 transition-colors p-1 rounded-lg cursor-pointer">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    @endif

    <div class="max-w-4xl mx-auto space-y-6">

        <div class="p-6 sm:p-8 bg-white shadow-xs rounded-xl border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-xs rounded-xl border border-gray-100">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-xs rounded-xl border border-gray-100 border-l-red-100">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
@endsection
