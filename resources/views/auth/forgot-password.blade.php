<x-guest-layout>
    <div class="text-center mb-3 py-6">
        <h2 class="text-2xl font-bold text-gray-900">Lupa Kata Sandi?</h2>
        <p class="text-sm text-gray-500 mt-1">Masukkan alamat email Anda yang terdaftar</p>
    </div>


    <x-auth-session-status
        class="mb-5 text-emerald-600 bg-emerald-50 p-4 rounded-xl border border-emerald-100 text-sm font-medium"
        :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email"
                class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Alamat Email</label>
            <div class="relative">
                <input id="email"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    type="email" name="email" :value="old('email')" required autofocus
                    placeholder="nama@email.com" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 pointer-events-none">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div class="pt-2 space-y-4">
            <button type="submit"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                Kirim Tautan Reset <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}"
                    class="text-xs text-gray-400 hover:text-emerald-600 hover:underline transition-colors font-semibold flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Halaman Masuk
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
