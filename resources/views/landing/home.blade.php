@extends('layouts.landing')

@section('content')
    {{-- ============================================================ --}}
    {{-- SECTION: HOME / HERO --}}
    {{-- ============================================================ --}}
    <div id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden scroll-mt-20">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&q=80&w=1600');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 via-emerald-950/70 to-emerald-950/40"></div>

        <div class="relative max-w-7xl mx-auto px-6 w-full py-20 z-10">
            <div class="max-w-2xl space-y-6">
                <span
                    class="inline-flex items-center gap-2 bg-white/10 text-gray-200 border border-white/10 text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm">
                    <i class="fa-solid fa-lock-open text-lime-400 text-[11px]"></i>
                    Wujudkan Transparansi Penuh bagi Petani Anda
                </span>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                    <span class="text-lime-400">Solusi Transparan</span>
                    <span class="text-white">untuk Distribusi</span>
                    <br class="hidden lg:block">
                    <span class="text-white">Gabah yang Lebih Adil</span>
                </h1>

                <p class="text-gray-300 text-sm md:text-base leading-relaxed opacity-90">
                    Revolusikan cara petani dan konsumen bertransaksi dengan sistem yang memangkas rantai
                    pasar merugikan, menjaga stok tetap akurat, dan menghadirkan harga yang jujur bagi semua pihak.
                </p>

                <div class="flex flex-wrap items-center gap-6 pt-2">
                    <a href="#produk"
                        class="bg-lime-400 hover:bg-lime-500 text-emerald-950 font-bold px-7 py-3.5 rounded-full transition-all shadow-lg shadow-lime-400/20 text-sm flex items-center gap-2 group">
                        Jelajahi Katalog Produk
                        <span
                            class="w-5 h-5 bg-emerald-950 text-lime-400 rounded-full flex items-center justify-center group-hover:translate-x-0.5 transition-transform">
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </span>
                    </a>
                    <a href="#kontak" class="text-white text-sm font-semibold hover:text-lime-400 transition-colors">
                        Lihat Informasi Harga
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- SECTION: TENTANG (Layout Modern Sesuai Gambar Referensi) --}}
    {{-- ============================================================ --}}
    <div id="tentang" class="bg-emerald-950 text-white py-24 scroll-mt-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Baris Atas: Judul Utama & Deskripsi Singkat --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-16">
                <div class="lg:col-span-7">
                    <span class="text-lime-400 text-xs font-bold tracking-widest uppercase block mb-3">Tentang Kami</span>
                    <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-tight uppercase">
                        Innovating The Future <br> Of Agriculture
                    </h2>
                </div>
                <div class="lg:col-span-5 lg:pt-8">
                    <p class="text-emerald-100/80 text-sm md:text-base leading-relaxed">
                        Sistem Gabah menggabungkan teknologi modern dan metode berkelanjutan untuk membantu petani lokal
                        tumbuh lebih cerdas, lebih cepat, dan lebih ramah lingkungan dalam memangkas ketidakadilan pasar
                        rantai distribusi gabah.
                    </p>
                </div>
            </div>

            {{-- Baris Bawah: Grid Konten Gambar & Statistik Data --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                {{-- Kiri: Dua Gambar Sawah Vertikal Modern (Rounded) --}}
                <div class="lg:col-span-7 grid grid-cols-2 gap-4 md:gap-6">
                    <div class="rounded-3xl overflow-hidden aspect-[3/4] shadow-2xl border border-white/10">
                        <img src="https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?auto=format&fit=crop&q=80&w=600"
                            alt="Petani Padi 1"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="rounded-3xl overflow-hidden aspect-[3/4] shadow-2xl border border-white/10">
                        <img src="https://images.unsplash.com/photo-1500937386664-56d1dfef3854?auto=format&fit=crop&q=80&w=600"
                            alt="Petani Padi 2"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>

                {{-- Kanan: List Statistik Vertikal --}}
                <div class="lg:col-span-5 space-y-10 pl-0 lg:pl-6">

                    {{-- Poin 1 --}}
                    <div class="border-b border-white/10 pb-6 last:border-0 last:pb-0">
                        <p class="text-4xl md:text-5xl font-black text-white tracking-tight">100%</p>
                        <h4 class="text-base font-bold text-lime-400 mt-1">Transparansi Harga</h4>
                        <p class="text-xs md:text-sm text-emerald-100/60 mt-1 leading-relaxed">
                            Kami membangun solusi sistem pencatatan distribusi terbuka yang dipercayai penuh oleh mitra
                            petani dan agen beras.
                        </p>
                    </div>

                    {{-- Poin 2 --}}
                    <div class="border-b border-white/10 pb-6 last:border-0 last:pb-0">
                        <p class="text-4xl md:text-5xl font-black text-white tracking-tight">20+</p>
                        <h4 class="text-base font-bold text-lime-400 mt-1">Kelompok Subak & Tani</h4>
                        <p class="text-xs md:text-sm text-emerald-100/60 mt-1 leading-relaxed">
                            Inovasi berkelanjutan yang mendorong kemajuan ekosistem agrikultur gabah lokal secara digital.
                        </p>
                    </div>

                    {{-- Poin 3 --}}
                    <div class="border-b border-white/10 pb-6 last:border-0 last:pb-0">
                        <p class="text-4xl md:text-5xl font-black text-white tracking-tight">100%</p>
                        <h4 class="text-base font-bold text-lime-400 mt-1">Petani Pilihan Terkurasi</h4>
                        <p class="text-xs md:text-sm text-emerald-100/60 mt-1 leading-relaxed">
                            Menghubungkan langsung gabah kualitas terbaik dari sawah binaan tanpa perantara yang merugikan.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>


    {{-- ============================================================ --}}
    {{-- SECTION: PRODUK (Disesuaikan Dengan Style Emerald Modern) --}}
    {{-- ============================================================ --}}
    <div id="produk" class="bg-gray-50 py-24 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-emerald-700 text-xs font-bold tracking-widest uppercase block mb-2">Katalog Pilihan</span>
                <h2 class="text-3xl md:text-4xl font-black text-gray-950 uppercase tracking-tight">Produk Terbaru Bulan Ini
                </h2>
                <div class="w-12 h-1 bg-lime-400 mx-auto mt-4 rounded-full"></div>
                <p class="text-sm text-gray-600 mt-4">Sebbagian komoditas gabah unggulan yang tersedia di sistem kami saat
                    ini dengan penjaminan kualitas prima.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($products as $product)
                    <div
                        class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col justify-between p-3">
                        <div>
                            {{-- Area Gambar/Ikon Atas --}}
                            <div
                                class="h-48 bg-emerald-950 rounded-2xl relative overflow-hidden flex items-center justify-center border border-emerald-900/10">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/80 to-transparent opacity-40">
                                </div>
                                <i
                                    class="fa-solid fa-wheat-awn text-lime-400/20 text-7xl group-hover:scale-110 group-hover:text-lime-400/30 transition-all duration-500"></i>
                            </div>

                            {{-- Konten Teks --}}
                            <div class="p-5">
                                <h3
                                    class="font-black text-xl text-gray-900 mb-2 group-hover:text-emerald-700 transition-colors tracking-tight uppercase">
                                    {{ $product->nama_produk }}
                                </h3>
                                
                                <p
                                    class="text-xs md:text-sm text-gray-500 line-clamp-3 leading-relaxed border-t border-gray-100 pt-3">
                                    {{ $product->deskripsi ?? 'Tidak ada deskripsi tambahan mengenai spesifikasi produk gabah ini.' }}
                                </p>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="px-5 pb-5 pt-2">
                            <a href="{{ route('login') }}"
                                class="flex items-center justify-center gap-2 bg-emerald-950 hover:bg-emerald-900 text-white font-bold py-3.5 rounded-2xl text-xs transition-all tracking-wider uppercase group-hover:shadow-md">
                                <i class="fa-solid fa-right-to-bracket text-lime-400"></i> Pesang sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white border border-gray-100 rounded-3xl p-16 text-center shadow-sm">
                        <i class="fa-solid fa-folder-open text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-sm">Belum ada produk aktif yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- SECTION: HUBUNGI KAMI (Wadah Terintegrasi Kontak & Maps - Tanpa Form) --}}
    {{-- ============================================================ --}}
    <div id="kontak" class="bg-white py-24 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-emerald-700 text-xs font-bold tracking-widest uppercase block mb-2">Hubungi Kami</span>
                <h2 class="text-3xl md:text-4xl font-black text-gray-950 uppercase tracking-tight">Kontak & Lokasi Kantor
                </h2>
                <div class="w-12 h-1 bg-lime-400 mx-auto mt-4 rounded-full"></div>
                <p class="text-sm text-gray-600 mt-4">Kritik, saran, atau kendala transaksi? Kami siap melayani Anda.</p>
            </div>

            {{-- Wadah Utama Terpadu (Single Card Layout) --}}
            <div
                class="max-w-6xl mx-auto bg-emerald-950 text-white rounded-[32px] p-6 md:p-10 shadow-2xl relative overflow-hidden border border-white/5">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-emerald-950 via-emerald-900/50 to-emerald-950 opacity-60 pointer-events-none">
                </div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12 items-stretch">

                    {{-- Sisi Kiri: Informasi Admin --}}
                    <div class="lg:col-span-6 flex flex-col justify-center space-y-8 py-4">
                        <div>
                            <span class="text-lime-400 text-xs font-bold uppercase tracking-widest">Layanan Bantuan</span>
                            <h3 class="text-2xl md:text-4xl font-black text-white mt-1 mb-4 uppercase tracking-tight">
                                Hubungi Admin</h3>
                            <p class="text-sm text-emerald-100/70 leading-relaxed max-w-md">
                                Jangan ragu hubungi tim kami jika Anda mengalami kesulitan teknis dalam penggunaan sistem
                                atau terkait verifikasi data petani. Kami siap melayani operasional harian Anda.
                            </p>
                        </div>

                        {{-- Info Badge Vertikal --}}
                        <div class="space-y-4 max-w-md">
                            <div
                                class="flex items-center gap-4 bg-white/5 p-4 rounded-2xl border border-white/5 backdrop-blur-sm">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white/10 text-lime-400 flex items-center justify-center shrink-0 border border-white/10">
                                    <i class="fa-solid fa-envelope text-lg"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider">Email Resmi
                                    </p>
                                    <p class="text-sm md:text-base font-bold text-white truncate">admin@gabah.com</p>
                                </div>
                            </div>
                            <div
                                class="flex items-center gap-4 bg-white/5 p-4 rounded-2xl border border-white/5 backdrop-blur-sm">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white/10 text-lime-400 flex items-center justify-center shrink-0 border border-white/10">
                                    <i class="fa-solid fa-phone text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider">Hot-Line
                                        Telepon</p>
                                    <p class="text-sm md:text-base font-bold text-white">08123456789</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sisi Kanan: Alamat Fisik & Peta Terpadu --}}
                    <div
                        class="lg:col-span-6 flex flex-col bg-white/5 border border-white/10 rounded-2xl p-5 md:p-6 backdrop-blur-md">
                        <div class="space-y-5 flex flex-col h-full justify-between">
                            {{-- Baris Keterangan Lokasi --}}
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-11 h-11 rounded-xl bg-lime-400 text-emerald-950 flex items-center justify-center shrink-0 shadow-md">
                                    <i class="fa-solid fa-location-dot text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <span
                                        class="text-lime-400 text-[10px] font-black uppercase tracking-widest block">Lokasi
                                        Sekretariat</span>
                                    <h4 class="text-base font-bold text-white mt-0.5 leading-snug">
                                        Jl. Contoh Alamat No. 123, Desa/Kelurahan
                                    </h4>
                                    <p class="text-xs text-emerald-200/60 mt-0.5">
                                        Kecamatan Contoh, Kabupaten/Kota Contoh, Bali
                                    </p>
                                </div>
                            </div>

                            {{-- Frame Google Maps --}}
                            <div
                                class="relative w-full flex-1 min-h-[300px] rounded-xl overflow-hidden shadow-inner border border-white/10 mt-2">
                                <iframe
                                    class="absolute top-0 left-0 w-full h-full border-0 grayscale opacity-90 contrast-125 focus:outline-none"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126210.23668853675!2d115.1481134107478!3d-8.672455823199853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f7182f04eaf%3A0xf60759f234383c2c!2sDenpasar%2C%20Bali!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
