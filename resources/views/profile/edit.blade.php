@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Pengaturan Profil Saya</h1>
        <p class="text-sm text-gray-500 mt-0.5">Kelola informasi data diri, keamanan kata sandi, dan kontrol privasi akun
            Anda.</p>
    </div>

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
