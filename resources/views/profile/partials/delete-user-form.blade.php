<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600">
            {{ __('Hapus Akun Aplikasi') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-bold px-4 py-2.5 rounded-xl text-xs transition-all cursor-pointer shadow-2xs">{{ __('Hapus Akun Permanen') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white rounded-xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-gray-900">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
            </h2>

            <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                {{ __('Tindakan ini tidak dapat dibatalkan. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen dari Sistem Gabah.') }}
            </p>

            <div class="mt-4">
                <label for="password"
                    class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Sandi
                    Anda</label>
                <div class="relative max-w-md">
                    <input id="password" name="password" type="password"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-colors shadow-2xs"
                        placeholder="Masukkan kata sandi akun" />
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5 text-xs text-red-500" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold px-4 py-2.5 rounded-xl text-xs transition-all cursor-pointer">
                    {{ __('Batal') }}
                </button>

                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs transition-all shadow-md shadow-red-700/10 cursor-pointer">
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
