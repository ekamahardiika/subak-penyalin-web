@extends('layouts.landing')

@section('content')
    {{-- HERO SECTION --}}

    <div id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden scroll-mt-20">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('hero/hero11.jpeg') }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 via-emerald-950/70 to-emerald-950/40"></div>

        <div class="relative max-w-7xl mx-auto px-6 w-full py-20 z-10">
            <div class="max-w-2xl space-y-6">

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                    <span class="text-green-400">Gabah Berkualitas</span>
                    <span class="text-white">Langsung dari</span>
                    <br class="hidden lg:block">
                    <span class="text-white">Petani Subak Penyalin</span>
                </h1>

                <p class="text-gray-300 text-sm md:text-base leading-relaxed opacity-90">
                    Mengenal warisan tradisi pertanian berkelanjutan Subak Penyalin. Kami menyediakan gabah segar
                    berkualitas tinggi pilihan langsung dari sawah para petani lokal Kerambitan, Tabanan.
                </p>

                <div class="flex flex-wrap items-center gap-6 pt-2">
                    <a href="#produk"
                        class="bg-green-400 hover:bg-green-500 text-green-950 font-bold px-7 py-3.5 rounded-full transition-all shadow-lg shadow-green-400/20 text-sm flex items-center gap-2 group">
                        Jelajahi Pilihan Gabah
                        <span
                            class="w-5 h-5 bg-green-950 text-green-400 rounded-full flex items-center justify-center group-hover:translate-x-0.5 transition-transform">
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- TENTANG SECTION --}}
    <div id="tentang" class="bg-green-950 text-white py-24 scroll-mt-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-16">
                <div class="lg:col-span-7">
                    <span class="text-green-400 text-xs font-bold tracking-widest uppercase block mb-3">Mengenal Subak
                        Penyalin</span>
                    <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-tight uppercase">
                        Menjaga Tradisi, <br> Menghasilkan Gabah Terbaik
                    </h2>
                </div>
                <div class="lg:col-span-5 lg:pt-8">
                    <p class="text-green-100/80 text-sm md:text-base leading-relaxed">
                        Subak Penyalin adalah komunitas petani di Kerambitan, Tabanan, yang mengelola irigasi dan lahan
                        persawahan secara gotong royong berlandaskan filosofi Tri Hita Karana. Kami berkomitmen menghasilkan
                        gabah unggulan yang melimpah dan berkualitas.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <div class="lg:col-span-7 grid grid-cols-2 gap-4 md:gap-6">
                    <div class="rounded-3xl overflow-hidden aspect-[3/4] shadow-2xl border border-white/10">
                        <img src="{{ asset('hero/Fotosubak4.jpeg') }}" alt="Petani Subak Penyalin 1"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="rounded-3xl overflow-hidden aspect-[3/4] shadow-2xl border border-white/10">
                        <img src="{{ asset('hero/Fotosubak2.jpeg') }}" alt="Petani Subak Penyalin 2"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                </div>

                <div class="lg:col-span-5 space-y-10 pl-0 lg:pl-6">

                    <div class="border-b border-white/10 pb-6 last:border-0 last:pb-0">
                        <p class="text-4xl md:text-4xl font-black text-white tracking-tight">Gabah Asli</p>
                        <p class="text-xs md:text-sm text-green-100/60 mt-1 leading-relaxed">
                            Dipanen langsung dari persawahan Subak Penyalin tanpa campuran, menjamin kesegaran dan mutu
                            gabah.
                        </p>
                    </div>

                    <div class="border-b border-white/10 pb-6 last:border-0 last:pb-0">
                        <p class="text-4xl md:text-4xl font-black text-white tracking-tight">Petani Lokal</p>
                        <p class="text-xs md:text-sm text-green-100/60 mt-1 leading-relaxed">
                            Dikelola oleh puluhan krama subak yang berpengalaman dengan pola tanam teratur dan pengelolaan
                            air yang terjaga.
                        </p>
                    </div>

                    <div class="border-b border-white/10 pb-6 last:border-0 last:pb-0">
                        <p class="text-4xl md:text-4xl font-black text-white tracking-tight">Jujur & Adil</p>
                        <p class="text-xs md:text-sm text-green-100/60 mt-1 leading-relaxed">
                            Membeli gabah langsung dari Subak Penyalin membantu menyejahterakan kehidupan petani lokal
                            secara langsung.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>


    {{-- PRODUK SECTION --}}

    <div id="produk" class="bg-gray-50 py-24 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-green-700 text-xs font-bold tracking-widest uppercase block mb-2">Hasil Panen
                    Pilihan</span>
                <h2 class="text-3xl md:text-4xl font-black text-gray-950 uppercase tracking-tight">Komoditas Gabah Subak
                    Penyalin</h2>
                <p class="text-sm text-gray-600 mt-4">Pilihan jenis gabah unggulan hasil panen persawahan Subak Penyalin
                    yang siap dipesan.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse ($products as $product)
                    <div
                        class="bg-white rounded-none border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between">
                        <div>

                            <div class="h-60 bg-green-950 relative overflow-hidden flex items-center justify-center">

                                @if ($product->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->gambar))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->gambar) }}"
                                        alt="{{ $product->nama_produk }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-green-950 via-green-900/60 to-transparent opacity-40">
                                    </div>
                                    <i class="fa-solid fa-wheat-awn text-green-400/20 text-7xl"></i>
                                @endif
                            </div>

                            <div class="p-6">
                                <h3 class="font-bold text-2xl text-gray-800 tracking-tight mb-3">
                                    {{ $product->nama_produk }}
                                </h3>

                                <p
                                    class="text-xs md:text-sm text-gray-500 italic leading-relaxed border-t border-gray-100 pt-3 line-clamp-3">
                                    {{ $product->deskripsi ?? 'Gabah kualitas unggulan dipanen langsung dari kawasan persawahan Subak Penyalin.' }}
                                </p>
                            </div>
                        </div>

                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('login') }}"
                                class="w-full inline-flex items-center justify-center bg-green-950 hover:bg-green-900 text-white font-bold py-3.5 px-6 rounded-full text-xs tracking-widest uppercase transition-all shadow-md">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 bg-white border border-gray-200 rounded-none p-16 text-center shadow-sm">
                        <i class="fa-solid fa-folder-open text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-sm">Belum ada pasokan gabah yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- HARGA ACUAN SECTION --}}
    <div id="harga" class="bg-white py-20 scroll-mt-20">

        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-10">

                <span class="text-green-700 text-xs font-bold tracking-widest uppercase block mb-2">
                    Harga Acuan
                </span>

                <h2 class="text-3xl md:text-4xl font-black text-gray-950 uppercase tracking-tight">
                    Harga Gabah Provinsi Bali
                </h2>

                <p class="text-sm text-gray-600 mt-3">
                    Rata-rata harga di pasar tradisional se-Bali
                </p>

            </div>


            {{-- FILTER KABUPATEN --}}
            <div class="max-w-md mx-auto mb-10">

                <label for="district_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Pilih Kabupaten/Kota
                </label>

                <select name="district_id" id="district_id"
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm
                       focus:border-green-600 focus:ring-green-600">

                    <option value="">
                        Seluruh Bali
                    </option>

                    @foreach ($districts as $district)
                        <option value="{{ $district['id'] }}" @selected($selectedDistrict == $district['id'])>

                            {{ $district['name'] }}

                        </option>
                    @endforeach

                </select>

            </div>


            {{-- CONTAINER HARGA --}}
            <div id="harga-acuan-container" class="relative transition-opacity duration-200">

                {{-- LOADING OVERLAY --}}
                <div id="harga-loading"
                    class="hidden absolute inset-0 z-10 bg-white/70 backdrop-blur-[1px]
                       flex items-center justify-center rounded-3xl">

                    <div class="flex flex-col items-center gap-3">

                        <div
                            class="w-8 h-8 border-4 border-green-200 border-t-green-700
                               rounded-full animate-spin">
                        </div>

                        <p class="text-xs text-gray-500 font-medium">
                            Memuat harga...
                        </p>

                    </div>

                </div>


                {{-- DATA HARGA --}}
                @include('landing.partials.harga-acuan')

            </div>

        </div>

    </div>


    {{-- SCRIPT FILTER HARGA --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const districtSelect = document.getElementById('district_id');
            const hargaContainer = document.getElementById('harga-acuan-container');
            const loading = document.getElementById('harga-loading');

            if (!districtSelect || !hargaContainer || !loading) {
                return;
            }

            districtSelect.addEventListener('change', async function() {

                const districtId = this.value;

                /*
                |--------------------------------------------------------------------------
                | Tampilkan loading
                |--------------------------------------------------------------------------
                */

                loading.classList.remove('hidden');

                hargaContainer.classList.add('opacity-60');


                /*
                |--------------------------------------------------------------------------
                | Buat URL
                |--------------------------------------------------------------------------
                */

                const url = new URL(
                    '{{ route('home') }}',
                    window.location.origin
                );

                if (districtId) {
                    url.searchParams.set('district_id', districtId);
                }


                /*
                |--------------------------------------------------------------------------
                | Update URL browser tanpa reload
                |--------------------------------------------------------------------------
                */

                window.history.pushState({},
                    '',
                    url
                );


                try {

                    /*
                    |--------------------------------------------------------------------------
                    | Request AJAX
                    |--------------------------------------------------------------------------
                    */

                    const response = await fetch(url, {

                        method: 'GET',

                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }

                    });


                    if (!response.ok) {
                        throw new Error(
                            'Gagal mengambil data harga.'
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Ambil HTML hasil response
                    |--------------------------------------------------------------------------
                    */

                    const html = await response.text();


                    /*
                    |--------------------------------------------------------------------------
                    | Ganti hanya bagian harga
                    |--------------------------------------------------------------------------
                    */

                    hargaContainer.innerHTML = `
                    <div
                        id="harga-loading"
                        class="hidden absolute inset-0 z-10 bg-white/70 backdrop-blur-[1px]
                               flex items-center justify-center rounded-3xl">

                        <div class="flex flex-col items-center gap-3">

                            <div
                                class="w-8 h-8 border-4 border-green-200 border-t-green-700
                                       rounded-full animate-spin">
                            </div>

                            <p class="text-xs text-gray-500 font-medium">
                                Memuat harga...
                            </p>

                        </div>

                    </div>

                    ${html}
                `;

                } catch (error) {

                    console.error(error);

                    hargaContainer.innerHTML = `
                    <div class="rounded-3xl border border-red-200
                                bg-red-50 p-8 text-center">

                        <div
                            class="w-12 h-12 mx-auto mb-4 rounded-full
                                   bg-red-100 flex items-center justify-center">

                            <i class="fa-solid fa-triangle-exclamation
                                      text-red-500">
                            </i>

                        </div>

                        <p class="font-semibold text-red-700">
                            Gagal mengambil data harga
                        </p>

                        <p class="text-sm text-red-500 mt-1">
                            Silakan coba lagi.
                        </p>

                        <button
                            type="button"
                            onclick="window.location.reload()"
                            class="mt-4 px-5 py-2.5 bg-red-600
                                   hover:bg-red-700 text-white
                                   rounded-xl text-sm font-semibold">

                            Muat Ulang

                        </button>

                    </div>
                `;

                } finally {

                    loading.classList.add('hidden');

                    hargaContainer.classList.remove('opacity-60');

                }

            });

        });
    </script>

    {{-- KONTAK SECTION --}}

    <div id="kontak" class="bg-white py-20 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <div class="lg:col-span-5 space-y-8">
                    <div>
                        <span class="text-green-700 text-xs font-bold tracking-widest uppercase block mb-2">Kontak
                            Kami</span>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight uppercase">Hubungi Subak Penyalin</h2>
                        <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                            Ingin memesan gabah hasil panen atau mengunjungi lokasi persawahan kami? Hubungi pengurus subak
                            melalui kontak berikut.
                        </p>
                    </div>

                    <div class="space-y-6 pt-2 border-t border-gray-100">

                        <div class="flex items-start gap-4">
                            <i class="fa-solid fa-location-dot text-green-600 text-lg mt-1 w-5"></i>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Lokasi</h4>
                                <p class="text-sm font-semibold text-gray-800 mt-0.5 leading-snug">
                                    Balai Subak Penyalin, Samsam, Kerambitan, Tabanan, Bali 82115
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <i class="fa-solid fa-phone text-green-600 text-lg mt-1 w-5"></i>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">WhatsApp / Telepon
                                </h4>
                                <a href="https://wa.me/628123456789" target="_blank"
                                    class="text-sm font-semibold text-gray-800 hover:text-green-600 transition-colors mt-0.5 block">
                                    08123456789
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <i class="fa-solid fa-envelope text-green-600 text-lg mt-1 w-5"></i>
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email</h4>
                                <a href="mailto:admin@gabah.com"
                                    class="text-sm font-semibold text-gray-800 hover:text-green-600 transition-colors mt-0.5 block">
                                    admin@gabah.com
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="w-full h-[380px] rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                        <iframe class="w-full h-full border-0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15783.345505200035!2d115.10828956263926!3d-8.515262591053872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23b00349780fd%3A0x529228c5525919d1!2sBalai%20subak%20Penyalin!5e0!3m2!1sid!2sid!4v1786102743597!5m2!1sid!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
