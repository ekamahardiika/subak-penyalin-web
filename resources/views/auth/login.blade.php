@section('title', 'Login')

<x-guest-layout>
    <div class="text-center mb-6 py-3">
        <h2 class="text-2xl font-bold text-gray-900">Selamat Datang</h2>
        <p class="text-sm text-gray-500 mt-1">Silakan masuk ke akun Sistem Gabah Anda</p>
    </div>

    <x-auth-session-status class="mb-4 text-emerald-600 bg-emerald-50 p-3 rounded-xl border border-emerald-100 text-sm"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Alamat
                Email</label>
            <div class="relative">
                <input id="email"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="nama@email.com" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">Kata
                    Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-emerald-600 hover:text-emerald-700 hover:underline transition-colors font-medium"
                        href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>
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

        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox"
                    class="w-4 h-4 rounded border-gray-300 text-emerald-600 shadow-xs focus:ring-emerald-500 focus:ring-offset-0 focus:ring-0 checked:bg-emerald-600"
                    name="remember">
                <span class="ms-2 text-xs text-gray-500 font-medium">{{ __('Ingat saya di perangkat ini') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                Masuk ke Panel <i class="fa-solid fa-right-to-bracket text-xs"></i>
            </button>
        </div>

        <div class="text-center pt-2 text-xs text-gray-400">
            Belum punya akun? <a href="{{ route('register') }}"
                class="text-emerald-600 font-semibold hover:underline">Daftar Konsumen</a>
        </div>
    </form>
</x-guest-layout>
