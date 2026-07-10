@extends('layouts.landing')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-emerald-950 min-h-[85vh] flex items-center pt-24 overflow-hidden">
        <!-- Background Overlay Image (Gunakan gambar bertema sawah/petani jika ada) -->
        <div class="absolute inset-0 opacity-25 bg-cover bg-center mix-blend-overlay"
            style="background-image: url('https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?auto=format&fit=crop&q=80&w=1200');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950 via-emerald-900/80 to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center w-full py-12">
            <div class="space-y-6">
                <span
                    class="inline-block bg-emerald-800/60 text-emerald-400 border border-emerald-700/50 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">
                    Sistem Distribusi Transparan
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight">
                    Transformasi Hasil Tani dengan <span class="text-emerald-400">Kualitas Terbaik</span>
                </h1>
                <p class="text-gray-300 text-base md:text-lg max-w-xl leading-relaxed">
                    Platform penghubung langsung Petani dengan Konsumen demi memotong rantai pasar yang merugikan. Dapatkan
                    gabah bermutu tinggi dengan harga jujur.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="{{ route('produk') }}"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-3 rounded-full transition-all shadow-lg shadow-emerald-500/20 text-sm">
                        Lihat Semua Produk <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ route('tentang') }}"
                        class="border border-white/30 text-white hover:bg-white/10 font-semibold px-6 py-3 rounded-full transition-all text-sm">
                        Tentang Kami
                    </a>
                </div>
            </div>
            <!-- Sisi Kanan: Foto Showcase Mirip Gambar Sampel -->
            <div class="hidden md:flex justify-center relative">
                <div class="w-80 h-[420px] rounded-2xl overflow-hidden shadow-2xl border-4 border-emerald-800/30">
                    <img src="https://images.unsplash.com/photo-1595974482597-4b8da8879bc5?auto=format&fit=crop&q=80&w=600"
                        class="w-full h-full object-cover" alt="Petani Gabah">
                </div>
                <div
                    class="absolute -bottom-6 -left-6 bg-white p-5 rounded-xl shadow-xl border border-gray-100 hidden lg:block">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600">
                            <i class="fa-solid fa-seedling text-lg"></i></div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">100% Organik</p>
                            <p class="text-sm font-bold text-gray-800">Kualitas Premium</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Layanan / Keunggulan (Our Areas of Expertise) -->
    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-emerald-600 text-xs font-bold tracking-widest uppercase">Keunggulan Kami</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Mengapa Memilih Sistem Gabah?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Box 1 -->
            <div
                class="bg-emerald-50/50 rounded-2xl p-6 border border-emerald-100 transition-all hover:shadow-xl hover:bg-white group">
                <div
                    class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center mb-6 shadow-md group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-layer-group text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Produk Terkurasi</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Gabah dipantau sejak masa tanam untuk memastikan bulir padi
                    padat, bersih, dan menghasilkan beras bermutu tinggi.</p>
            </div>
            <!-- Box 2 -->
            <div
                class="bg-emerald-50/50 rounded-2xl p-6 border border-emerald-100 transition-all hover:shadow-xl hover:bg-white group">
                <div
                    class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center mb-6 shadow-md group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-handshake text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Kemitraan Adil</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Sistem keadilan harga menjamin keuntungan yang pantas bagi
                    para petani lokal, sekaligus harga rasional bagi konsumen.</p>
            </div>
            <!-- Box 3 -->
            <div
                class="bg-emerald-50/50 rounded-2xl p-6 border border-emerald-100 transition-all hover:shadow-xl hover:bg-white group">
                <div
                    class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center mb-6 shadow-md group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-truck-ramp-box text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Pengiriman Cepat</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Sistem logistik yang terintegrasi memastikan gabah langsung
                    dikirim pasca proses pengeringan selesai dilakukan.</p>
            </div>
        </div>
    </div>

    <!-- Section Produk Terbaru (Recent Projects Style) -->
    <div class="bg-gray-100 py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <span class="text-emerald-600 text-xs font-bold tracking-widest uppercase">Katalog Pilihan</span>
                    <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Produk Terbaru Bulan Ini</h2>
                </div>
                <a href="{{ route('produk') }}"
                    class="mt-4 md:mt-0 inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold uppercase tracking-wider px-5 py-3 rounded-full shadow-md transition-colors">
                    Lihat Semua Katalog <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-gray-100 group flex flex-col justify-between">
                        <div>
                            <!-- Placeholder Gambar Produk ala Ilustrasi -->
                            <div class="h-48 bg-emerald-900/10 relative overflow-hidden flex items-center justify-center">
                                <i
                                    class="fa-solid fa-wheat-awn text-emerald-600/30 text-6xl group-hover:scale-110 transition-transform duration-300"></i>
                                <span
                                    class="absolute top-4 left-4 bg-emerald-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-full uppercase">Stok
                                    Tersedia</span>
                            </div>
                            <div class="p-6">
                                <h3
                                    class="font-bold text-xl text-gray-800 mb-2 group-hover:text-emerald-600 transition-colors">
                                    {{ $product->nama_produk }}</h3>
                                <p class="text-emerald-600 font-bold text-lg mb-3">
                                    Rp {{ number_format($product->harga_jual) }} <span
                                        class="text-xs text-gray-400 font-normal">/ {{ $product->satuan }}</span>
                                </p>
                                <p class="text-sm text-gray-500 line-clamp-3 leading-relaxed mb-4">{{ $product->deskripsi }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pb-6">
                            <a href="{{ route('login') }}"
                                class="block text-center bg-gray-900 hover:bg-emerald-600 text-white font-medium py-2.5 rounded-xl text-xs transition-colors shadow-md">
                                <i class="fa-solid fa-right-to-bracket mr-1.5"></i> Login untuk Beli
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CTA Section Banner bawah (Ready to design your dream garden?) -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="relative bg-emerald-600 rounded-3xl p-8 md:p-12 overflow-hidden shadow-2xl text-white">
            <div class="absolute inset-0 opacity-10 bg-cover bg-center"
                style="background-image: url('https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?auto=format&fit=crop&q=80&w=600');">
            </div>
            <div class="relative max-w-xl space-y-4">
                <h2 class="text-2xl md:text-4xl font-bold leading-tight">Siap Bermitra dan Mendapatkan Pasokan Gabah
                    Terbaik?</h2>
                <p class="text-emerald-100 text-sm md:text-base opacity-90">Daftarkan akun Anda sekarang baik sebagai
                    kelompok tani ataupun agen distributor industri pabrik beras.</p>
                <div class="pt-2">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 bg-white text-emerald-700 font-bold px-6 py-3 rounded-full shadow-lg hover:bg-emerald-50 transition-colors text-sm">
                        Mulai Konsultasi / Daftar <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
