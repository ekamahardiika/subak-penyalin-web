@section('title', 'Reset Password')

<x-guest-layout>
    <div class="text-center mb-6 py-3">
        <h2 class="text-2xl font-bold text-gray-900">Atur Ulang Sandi</h2>
        <p class="text-sm text-gray-500 mt-1">Silakan masukkan kata sandi baru akun Anda</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Alamat
                Email</label>
            <div class="relative">
                <input id="email"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    type="email" name="email" :value="old('email', $request->email)" required autofocus
                    autocomplete="username" placeholder="nama@email.com" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div>
            <label for="password" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Kata
                Sandi Baru</label>
            <div class="relative">
                <input id="password"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="Minimal 8 karakter baru" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                    <i class="fa-solid fa-lock text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div>
            <label for="password_confirmation"
                class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Konfirmasi Kata Sandi
                Baru</label>
            <div class="relative">
                <input id="password_confirmation"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Ulangi kata sandi baru" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                    <i class="fa-solid fa-lock-open text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                Perbarui Kata Sandi <i class="fa-solid fa-key text-xs"></i>
            </button>
        </div>
    </form>
</x-guest-layout>
