<section>
    <header class="mb-4">
        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Perbarui Kata Sandi') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password"
                class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">{{ __('Kata Sandi Saat Ini') }}</label>
            <div class="relative">
                <input id="update_password_current_password" name="current_password" type="password"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    autocomplete="current-password" placeholder="••••••••" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                    <i class="fa-solid fa-lock text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div>
            <label for="update_password_password"
                class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">{{ __('Kata Sandi Baru') }}</label>
            <div class="relative">
                <input id="update_password_password" name="password" type="password"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    autocomplete="new-password" placeholder="Minimal 8 karakter baru" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                    <i class="fa-solid fa-key text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div>
            <label for="update_password_password_confirmation"
                class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">{{ __('Konfirmasi Kata Sandi Baru') }}</label>
            <div class="relative">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    autocomplete="new-password" placeholder="Ulangi kata sandi baru" />
                <span class="absolute inset-y-0right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                    <i class="fa-solid fa-lock-open text-sm"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5 text-xs text-red-500" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-xl text-xs transition-all shadow-md shadow-emerald-700/10 cursor-pointer">
                {{ __('Perbarui Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                    <i class="fa-solid fa-circle-check"></i> {{ __('Sandi berhasil diubah.') }}
                </p>
            @endif
        </div>
    </form>
</section>
