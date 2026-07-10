<x-guest-layout>
    <div class="text-center mb-6 py-3">
        <div
            class="inline-flex items-center justify-center bg-emerald-50 text-emerald-600 p-3 rounded-2xl border border-emerald-100 mb-3 shadow-xs">
            <i class="fa-regular fa-envelope-open text-2xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">Verifikasi Email Anda</h2>
        <p class="text-sm text-gray-500 mt-1">Satu langkah lagi sebelum memulai</p>
    </div>

    <div class="mb-5 text-sm text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan ulang.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div
            class="mb-5 font-medium text-sm text-emerald-600 bg-emerald-50 p-4 rounded-xl border border-emerald-100 flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat registrasi.') }}</span>
        </div>
    @endif

    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <button type="submit"
                class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 flex items-center justify-center gap-2 cursor-pointer">
                Kirimi Ulang Email <i class="fa-solid fa-paper-plane text-xs"></i>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
            @csrf
            <button type="submit"
                class="text-sm text-gray-400 hover:text-gray-600 hover:underline transition-colors font-medium flex items-center justify-center gap-1.5 w-full sm:w-auto py-2 cursor-pointer">
                <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i> {{ __('Keluar Akun') }}
            </button>
        </form>
    </div>
</x-guest-layout>
