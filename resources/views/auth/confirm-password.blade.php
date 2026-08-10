@section('title', 'Konfirmasi Password')

<x-guest-layout>
    <div class="text-center mb-6 py-3">
        <div
            class="inline-flex items-center justify-center bg-emerald-50 text-emerald-600 p-3 rounded-2xl border border-emerald-100 mb-3 shadow-xs">
            <i class="fa-solid fa-shield-halved text-2xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Sandi</h2>
        <p class="text-sm text-gray-500 mt-1">Keamanan ekstra untuk akun Anda</p>
    </div>

    <div class="mb-5 text-sm text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
        {{ __('Ini adalah area aman aplikasi. Silakan konfirmasi kata sandi Anda sebelum melanjutkan ke tindakan berikutnya.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Kata
                Sandi Anda</label>
            <div class="relative">
                <input id="password"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                    <i class="fa-solid fa-lock text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                Konfirmasi <i class="fa-solid fa-check text-xs"></i>
            </button>
        </div>
    </form>
</x-guest-layout>
