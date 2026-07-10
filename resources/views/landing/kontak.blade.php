@extends('layouts.landing')

@section('content')
    <div class="bg-emerald-950 pt-32 pb-16 text-center text-white">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl md:text-4xl font-extrabold">Hubungi Kontak</h1>
            <p class="text-emerald-300 text-sm mt-2">Kritik, saran, atau kendala transaksi? Kami siap melayani Anda.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-16">
        <div
            class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-10">
            <div>
                <span class="text-emerald-600 text-xs font-bold uppercase tracking-wider">Layanan Bantuan</span>
                <h2 class="text-2xl font-extrabold text-gray-900 mt-1 mb-4">Hubungi Admin</h2>
                <p class="text-sm text-gray-500 leading-relaxed mb-6">Jangan ragu hubungi tim kami jika Anda mengalami
                    kesulitan teknis dalam penggunaan sistem atau terkait verifikasi data petani.</p>

                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400">Alamat Email Resmi</p>
                            <p class="text-sm font-bold text-gray-800">admin@gabah.com</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-phone"></i></div>
                        <div>
                            <p class="text-xs font-semibold text-gray-400">Nomor Hot-Line Telepon</p>
                            <p class="text-sm font-bold text-gray-800">08123456789</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kontak Sederhana untuk mempercantik Layout kanan -->
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                <h3 class="text-base font-bold text-gray-800 mb-4">Kirim Pesan Cepat</h3>
                <form action="#" method="POST" class="space-y-3" onsubmit="event.preventDefault();">
                    <input type="text" placeholder="Nama Anda"
                        class="w-full bg-white text-sm px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-emerald-500">
                    <input type="email" placeholder="Email Aktif"
                        class="w-full bg-white text-sm px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-emerald-500">
                    <textarea placeholder="Pesan Anda..." rows="3"
                        class="w-full bg-white text-sm px-4 py-2.5 rounded-xl border border-gray-200 focus:outline-emerald-500"></textarea>
                    <button
                        class="w-full bg-emerald-600 text-white font-semibold py-2.5 rounded-xl text-xs hover:bg-emerald-700 shadow-md">Kirim
                        Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endsection
