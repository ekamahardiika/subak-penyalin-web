@section('title', 'Register')

<x-guest-layout>
    <div class="w-full sm:max-w-2xl md:max-w-3xl mx-auto p-2 sm:p-4">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Akun Baru</h2>
            <p class="text-sm text-gray-500 mt-1.5">Bergabung sebagai Konsumen di Subak Penyalin</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">

                <div class="md:col-span-2">
                    <label for="name"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <input id="name"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            placeholder="Masukkan nama lengkap sesuai KTP" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-regular fa-user text-sm"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <div>
                    <label for="email"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat Email</label>
                    <div class="relative">
                        <input id="email"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                            type="email" name="email" :value="old('email')" required autocomplete="username"
                            placeholder="nama@email.com" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-regular fa-envelope text-sm"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <div>
                    <label for="phone"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Nomor Telepon</label>
                    <div class="relative">
                        <input id="phone"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                            type="text" name="phone" :value="old('phone')" autocomplete="tel"
                            placeholder="Contoh: 08123456789" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-phone text-sm"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('phone')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <div>
                    <label for="password"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <div class="relative">
                        <input id="password"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="Minimal 8 karakter" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500" />
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Konfirmasi Kata
                        Sandi</label>
                    <div class="relative">
                        <input id="password_confirmation"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Ulangi kata sandi" />
                        <span
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-lock-open text-sm"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red-500" />
                </div>

            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                    Daftar Konsumen <i class="fa-solid fa-user-plus text-xs"></i>
                </button>
            </div>

            <div class="text-center pt-2 text-sm text-gray-400">
                Sudah memiliki akun? <a href="{{ route('login') }}"
                    class="text-emerald-600 font-semibold hover:underline">Masuk di sini</a>
            </div>
        </form>
    </div>
</x-guest-layout>
