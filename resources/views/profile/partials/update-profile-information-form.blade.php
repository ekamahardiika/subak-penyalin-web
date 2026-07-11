<section>
    <header class="mb-4">
        <h2 class="text-lg font-bold text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            {{ __('Perbarui data informasi profil akun serta alamat email terdaftar Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name"
                class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">{{ __('Nama Lengkap') }}</label>
            <div class="relative">
                <input id="name" name="name" type="text"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                    <i class="fa-regular fa-user text-sm"></i>
                </span>
            </div>
            <x-input-error class="mt-1.5 text-xs text-red-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email"
                class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">{{ __('Alamat Email') }}</label>
            <div class="relative">
                <input id="email" name="email" type="email"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </span>
            </div>
            <x-input-error class="mt-1.5 text-xs text-red-500" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-amber-50 border border-amber-100 rounded-xl text-xs text-amber-800">
                    <p class="flex items-center gap-1.5">
                        <i class="fa-solid fa-triangle-exclamation text-amber-600"></i> Alamat email Anda belum
                        diverifikasi.
                        <button form="send-verification"
                            class="font-bold underline text-emerald-700 hover:text-emerald-800 cursor-pointer">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-semibold text-emerald-600 flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i>
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <label for="phone"
                class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">{{ __('Nomor Telepon / WhatsApp') }}</label>
            <div class="relative">
                <input id="phone" name="phone" type="text"
                    class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors shadow-xs"
                    value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789" autocomplete="tel" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                    <i class="fa-solid fa-phone text-sm"></i>
                </span>
            </div>
            <x-input-error class="mt-1.5 text-xs text-red-500" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-xl text-xs transition-all shadow-md shadow-emerald-700/10 cursor-pointer">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-medium text-emerald-600 flex items-center gap-1">
                    <i class="fa-solid fa-circle-check"></i> {{ __('Berhasil disimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
